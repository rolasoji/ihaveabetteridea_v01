<!-- process captcha snippet ..... -->
<?php
// call a snippet file which starts a new session securely
include_once "snippet_functions.php";

// start a new session using custom secure function call
secure_session_start();

echo "snippet_captcha_processing.php: 2a-here - ".", un: ".$_POST['inputusername'].", e: ".$_POST['email'].", p: ".$_POST['p'].", sub: ".$_POST['regsubmit']."<br/>";
//echo "<br/><hr /><br/>";

// make sure entry is from a posted form, else quit
if ($_SERVER["REQUEST_METHOD"] <> "POST") 
    die("You can only reach this page by posting from the html form.");

// check if entry code and session value match
if ( ($_REQUEST["captcha_code"] == $_SESSION["captcha_code"]) && 
        (!empty($_REQUEST["captcha_code"]) && !empty($_SESSION["security_code"])) ) {
    echo "<h1>snippet_captcha_processing.php: Test successful!</h1>";
    echo "snippet_captcha_processing.php: 2b-here - ".", un: ".$_POST['inputusername'].", e: ".$_POST['email'].", p: ".$_POST['p'].", sub: ".$_POST['regsubmit']."<br/>";
    // echo "CAPTCHA FINE";
	// insert you code for processing the form here, e.g emailing the submission, entering it into a database.
	unset($_SESSION['captcha_code']);
    return "true";
} else {
    echo "<h1>snippet_captcha_processing.php: Test failed! Try again!</h1>";
    echo "snippet_captcha_processing.php: 2c-here - ".", un: ".$_POST['inputusername'].", e: ".$_POST['email'].", p: ".$_POST['p'].", sub: ".$_POST['regsubmit']."<br/>";
	// insert your code for showing an error message here
    //echo "You entered: ".$_POST['captcha_code']." ... but the CAPTCHA code is: ".$_SESSION['captcha_code'];
    //die("<br/><br/>Sorry, the CAPTCHA code entered was incorrect!");
    return "false";
}
?>
