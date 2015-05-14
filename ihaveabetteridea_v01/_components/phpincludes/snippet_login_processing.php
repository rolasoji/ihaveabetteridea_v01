<!-- process login form -->
<?php
/* include the DB configuration file */
include_once "snippet_database_connection.php";
/* include the functions file; also includes config file "snippet_database_config.php"?? */
include_once "snippet_functions.php";

//echo 'snippet_login_processing.php: u_email='.$_POST['u']." / useremail=".$_POST['useremail']." / p=".$_POST['p']."<br/>";
if (isset($_POST['useremail'], $_POST['p'])) {
    $email = $_POST['useremail'];
    $password = $_POST['p']; // the hashed password.
 
    $logincheck = login($email, $password, $mysqli, $error);
    if ($logincheck == "true") {
        // login successful
        header('Location: /zNEWsite_idea/authorisation_handle.php');
        exit();
        //echo '<p class="text-success">Login in success!</p>';
    } else {
        // login failed 
        header('Location: /zNEWsite_idea/form_error.php?err='.$logincheck);
        exit();
    }
} else {
    // correct POST variables were not sent 
    //echo 'snippet_login_processing.php: ';
    echo 'Invalid Request';
}
?>
