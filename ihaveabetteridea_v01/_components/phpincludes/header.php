<?php
//error_reporting(E_ALL);
//?? display_errors = ON;
/* include the DB configuration file */
include_once "snippet_database_config.php";
/* include the DB configuration file */
include_once "snippet_database_connection.php";
/* include the functions file; also includes config file "snippet_database_config.php"?? */
include_once "snippet_functions.php";

// start a new session using custom secure function call
if(!session_id()) secure_session_start();

$logincheck = login_check($mysqli);
if ($logincheck == "true") {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" data-ng-app="musicApp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>I Have A Better Idea &hellip; &lt;idea / subject / topic name&gt; &ndash; hub</title>
    <!-- meta tags -->
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- favicon -->
	<link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="http://www.balancewellness.co.uk/favicon.ico">
    <!-- styles -->
	<link rel="stylesheet" type="text/css" href="http://www.balancewellness.co.uk/zNEWsite_idea/_components/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="http://www.balancewellness.co.uk/zNEWsite_idea/_components/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://www.balancewellness.co.uk/zNEWsite_idea/_components/alertifyJS/0.3.11/themes/alertify.core.css"> 
    <link rel="stylesheet" type="text/css" href="http://www.balancewellness.co.uk/zNEWsite_idea/_components/alertifyJS/0.3.11/themes/alertify.default.css"> 
	<link rel="stylesheet" type="text/css" href="http://www.balancewellness.co.uk/zNEWsite_idea/_components/css/customstyles.css">
    <script type="text/javascript" src="http://www.balancewellness.co.uk/zNEWsite_idea/_components/js/ajax_captcha.js"></script>
</head>
<!-- end of page header file -->
