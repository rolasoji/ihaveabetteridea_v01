<?php 
session_start();

if( isset($_POST['submit'])) {
   if( $_SESSION['captcha_code'] == $_POST['captcha_code'] && !empty($_SESSION['captcha_code'] ) ) {
		// Insert you code for processing the form here, e.g emailing the submission, entering it into a database. 
		echo 'Thank you. Your message said "'.$_POST['message'].'"';
		unset($_SESSION['captcha_code']);
   } else {
		// Insert your code for showing an error message here
		echo 'Sorry, you have provided an invalid security code';
   }
} else {
?>

	<form action="form.php" method="post">
		<label for="name">Name: </label><input type="text" name="name" id="name" /><br />
		<label for="email">Email: </label><input type="text" name="email" id="email" /><br />
		<label for="message">Message: </label><textarea rows="5" cols="30" name="message" id="message"></textarea><br />
		<img src="CaptchaSecurityImages.php?width=100&height=40&characters=5" /><br />
		<label for="captcha_code">Security Code: </label><input id="captcha_code" name="captcha_code" type="text" /><br />
		<input type="submit" name="submit" value="Submit" />
	</form>

<?php
	}
?>