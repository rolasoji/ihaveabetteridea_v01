<!-- connection to site database ..... -->
<?php
/* connect to the DB and select database */
include_once "snippet_database_config.php"; // connection variables
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
?>

