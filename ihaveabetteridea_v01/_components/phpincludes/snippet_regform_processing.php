<!-- process registration form -->
<?php
// call a snippet file which starts a new session securely
    //includes the functions file; also includes config file "snippet_database_config.php"??
include_once "snippet_functions.php";
/* include the DB configuration file */
include_once "snippet_database_connection.php";

// start a new session using custom secure function call
secure_session_start();

$error_msg = "";

echo "snippet_regform_processing.php: 1-here - ".", un: ".$_POST['inputusername'].", e: ".$_POST['email'].", p: ".$_POST['p'].
        ", sub: ".$_POST['regsubmit'].", sc_c: ".$_SESSION['captcha_code'].", pc_c: ".$_POST['captcha_code']."<br/>";
print_r("snippet_regform_processing.php: ".$_POST."<br/>");

if (isset($_POST['inputusername'], $_POST['email'], $_POST['p'])) {
    echo "snippet_regform_processing.php: 3-here - ".", un: ".$_POST['inputusername'].", e: ".$_POST['email'].", p: ".$_POST['p'].
        ", sub: ".$_POST['regsubmit'].", sc_c: ".$_SESSION['captcha_code'].", pc_c: ".$_POST['captcha_code']."<br/>";

    // sanitize and validate the data passed in
    $inputusername = filter_input(INPUT_POST, 'inputusername', FILTER_SANITIZE_STRING);
    $useremail = filter_input(INPUT_POST, 'useremail', FILTER_SANITIZE_EMAIL);
    $useremail = filter_var($useremail, FILTER_VALIDATE_EMAIL);
    if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        // not a valid email
        $error_msg .= '<p class="text-danger">The email address you entered is not valid.</p>';
    }
 
    $inputpassword = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($inputpassword) != 128) {
        // the hashed pwd should be 128 characters long.
        // if it's not, something really odd has happened
        $error_msg .= '<p class="text-danger">Invalid password configuration.</p>';
    }

    // Username validity and password validity have been checked client side.
    // this should should be adequate as nobody gains any advantage from
    // breaking these rules.
 
    $prep_stmt = "SELECT id FROM members_test WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $useremail);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="text-danger">A user with this email address already exists.</p>';
            $stmt->close();
        }
        $stmt->close();
    } else {
        $error_msg .= '<p class="text-danger">Database error Line 39</p>';
        $stmt->close();
    }
 
    // check existing username
    $prep_stmt = "SELECT id FROM members_test WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $inputusername);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
                // A user with this username already exists
                $error_msg .= '<p class="text-danger">A user with this username already exists.</p>';
                $stmt->close();
        }
        $stmt->close();
    } else {
        $error_msg .= '<p class="text-danger">Database error line 55.</p>';
        $stmt->close();
    }
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if (empty($error_msg)) {
        // create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // create salted password 
        $password = hash('sha512', $inputpassword . $random_salt);
 
        // set values / defaults for other fields
        $userfname = $_POST['userfname'];
            $userfname = mysql_real_escape_string($userfname);
        $userlname = $_POST['userlname'];
            $userlname = mysql_real_escape_string($userlname);
        $companyname = isset($_POST['companyname']) ? $_POST['companyname'] : "";
            $companyname = mysql_real_escape_string($companyname);
        $websiteurl = isset($_POST['websiteurl']) ? $_POST['websiteurl'] : "";
            $websiteurl = mysql_real_escape_string($websiteurl);
        $subscribe = isset($_POST['subscribe']) ? $_POST['subscribe'] : "0";
        $reference = isset($_POST['reference']) ? $_POST['reference'] : "none";
        $address1 = ''; $address2 = ''; $city = ''; $county = '';
        $postcode = ''; $country = ''; $email2 = ''; $telephone = '';
        $mobile = ''; $otherno = ''; $telephone = ''; $comments = '';
        // set default for account type
        $accperms = 'A';
        // set default for email activation
        $emailact = '0';
        
        $thisdate = now();
        $registered = "false";
        // insert the new user into the database 
        //if ($insert_stmt = $mysqli->prepare("INSERT INTO members_test (username, email, password, salt) VALUES (?, ?, ?, ?)")) {
        if ($insert_stmt = $mysqli->prepare("INSERT INTO `members_test`(`date`, `first_name`, `last_name`, `company_name`, 
                `website`, `address_line1`, `address_line2`, `city`, `county`, `postcode`, `country`, `email`, `email_alt`, 
                `telephone`, `mobile`, `other_number`, `username`, `password`, `subscribe`, `reference`, `account_permissions`, 
                `email_activation`, `comments`, `salt`) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
            $insert_stmt->bind_param('ssssssssssssssssssssssss', $thisdate, $userfname, $userlname, $companyname, $websiteurl, $address1, $address2, 
                    $city, $county, $postcode, $country, $email, $email2, $telephone, $mobile, $otherno, $inputusername, $password, 
                    $subscribe, $reference, $accperms, $emailact, $comments, $random_salt);
            // execute the prepared query
            $executequery = false;
            if ($executequery) {
                if (! $insert_stmt->execute()) {
                    $registered = "true";
                    header('Location: /zNEWsite_idea/form_error.php?err=Registration failure: INSERT');
                    exit();
                }
            } else {
                echo "snippet_regform_processing.php: Done!<br/>";
                $registered = "true";
            }
        } else {
            $registered = "false";
        }
		header('Location: /zNEWsite_idea/registration_status.php');
        exit();
    } else {
        echo $error_msg;
    }
} else {
    echo "snippet_regform_processing.php: 4-here - ".", un: ".$_POST['inputusername'].", e: ".$_POST['email'].", p: ".$_POST['p'].
        ", sub: ".$_POST['regsubmit'].", sc_c: ".$_SESSION['captcha_code'].", pc_c: ".$_POST['captcha_code']."<br/>";
}
//echo "<br/><hr /><br/>";
//foreach ($_SESSION as $key => $val)
//    echo $key." ".$val."<br/>";
//phpinfo();
?>
