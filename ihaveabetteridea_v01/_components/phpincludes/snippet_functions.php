<!-- connection to site database ..... -->
<?php
/* include the DB configuration file */
include_once "snippet_database_config.php";

/* function starts a session securely */
function secure_session_start() {
    $session_name = 'sec_session_id';   // set a custom session name
    $secure = SECURE;
    // stops JavaScript being able to access the session id
    $httponly = true;
    // forces sessions to only use cookies
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: /zNEWsite_idea/form_error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // gets current cookies params
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // sets the session name to the one set above
    session_name($session_name);
    session_start();            // start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one
    /*echo "snippet_functions.php: <br/><hr/>";
    foreach ($_SESSION as $key=>$val)
        echo "snippet_functions.php: ".$key." : ".$val."<br/>";*/
}
/* function to process login form */
function login($email, $password, $mysqli, $processing_error) {
    // using prepared statements means that SQL injection is not possible
    $processing_error = "";
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
            FROM members_test WHERE email = ?
            LIMIT 1")) {
        $stmt->bind_param('s', $email);  // binds "$email" to parameter
        $stmt->execute();    // execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // if the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $mysqli) == "true") {
                // account is locked 
                // send an email to user saying their account is locked
                $processing_error .= "Your account has been locked because you logged in too many times. Please wait 5 minutes and try again. ";
                $processing_error .= "If that is incorrect, please contact the <a href='mailto:support@balancewellness.co.uk'>webmaster</a>.";
                return $processing_error;
                //return "false";
            } else {
                // check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // password is correct!
                    // get the user-agent string of the user
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    // Login successful.
                    return "true";
                } else {
                    // password is not correct
                    // we record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts_test(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    $processing_error .= "Password is incorrect.";
                    return $processing_error;
                    //return "false";
                }
            }
        } else {
            // user does not exist
            $processing_error .= "Account does not exist. Please <a href='http://www.balancewellness.co.uk/zNEWsite_idea/registration.php'>register</a> to create a new account.";
            return $processing_error;
            //return "false";
        }
    }
}
/* function to lock the user's account after five failed login attempts */
// ... more effective at stopping brute force attacks 
function checkbrute($user_id, $mysqli) {
    // get timestamp of current time 
    $now = time();
 
    // all login attempts are counted from the past 2 hours
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts_test 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // execute the prepared query
        $stmt->execute();
        $stmt->store_result();
 
        // if there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return "true";
        } else {
            return "false";
        }
    }
}
/* function to check login status by checking "user_id" 
 * and the "login_string" SESSION variables 
 * use the browser information because it is very unlikely 
 * the user will change their browser mid-session ...
 * ... helps prevent session hijacking */
function login_check($mysqli) {
    // check if all session variables are set 
    if (isset($_SESSION['user_id'], 
            $_SESSION['username'], 
            $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // get the user-agent string of the user
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                FROM members_test 
                WHERE id = ? LIMIT 1")) {
            // bind "$user_id" to parameter 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // execute the prepared query
            $stmt->store_result();
 
            $processing_error = "";
            if ($stmt->num_rows == 1) {
                // if the user exists get variables from result
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // logged In!!!! 
                    return "true";
                } else {
                    // not logged in 
                    $processing_error .= "TEMP: [login_check] != [login_string].";
                    return $processing_error;
                    //return "false";
                }
            } else {
                // not logged in 
                $processing_error .= "TEMP: returned rows < 1 or > 1.";
                return $processing_error;
                //return "false";
            }
        } else {
            // not logged in 
            $processing_error .= "TEMP: something wrong with [mysqli->prepare()].";
            return $processing_error;
            //return "false";
        }
    } else {
        // not logged in 
        $processing_error .= "TEMP: SESSION[] variables not set.";
        return $processing_error;
        //return "false";
    }
}
/* function sanitizes the output from the PHP_SELF server variable 
 * ... a modificaton of a function of the same name used by 
 * ... WordPress Content Management System */
 function esc_url_custom($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
    $url = htmlentities($url);
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
/* function to xxxx */
/* function to xxxx */
/* function to xxxx */
/* function to xxxx */
/* function to xxxx */
/* function to xxxx */
//function x() {
    
//}
/* function to xxxx */
//function x() {
    
//}
?>
