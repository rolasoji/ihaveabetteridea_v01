<?php 
/* include wordpress blog contents */
define('WP_USE_THEMES', false);
/* derive path to wordpress template file 
 * *** dirname(__FILE__) doesn't work here, looking in /blog/ ... */
//require(dirname(__FILE__)."/wp-blog-header.php");
require(dirname("/home/www/totalpersoninu.co.uk")."/totalpersoninu.co.uk/wp-blog-header.php");
?>
