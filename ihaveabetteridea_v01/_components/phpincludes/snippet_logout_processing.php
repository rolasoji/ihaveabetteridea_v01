<!-- process logout -->
<?php
/*
foreach ($_SESSION as $key=>$val)
    echo "snippet_logout_processing.php: ".$key." : ".$val."<br/>";
*/
// unset all session values 
$_SESSION = array();
 
// get session parameters 
$params = session_get_cookie_params();
 
// Delete the actual cookie. 
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// destroy the session and return to homepage
session_destroy();
header('Location: /zNEWsite_idea/index.php');
//header(dirname("/home/www/balancewellness.co.uk")."/balancewellness.co.uk/zNEWsite_idea/index.php");
exit();
?>
