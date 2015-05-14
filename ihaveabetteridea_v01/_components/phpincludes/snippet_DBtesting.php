<!-- process login form -->
<pre><?php
/* include the DB configuration file */
include_once "snippet_database_connection.php";
/* include the functions file; also includes config file "snippet_database_config.php"?? */
include_once "snippet_functions.php";

//if ($mysqli->connect_errno) {
//    printf("Connect failed: %s\n", $mysqli->connect_error);
//    exit();
//} else {
//    echo "Connected\n";
//    exit();
//}

//echo 'snippet_DBtesting.php: u_email='.$_POST['u']." / useremail=".$_POST['useremail']." / p=".$_POST['p']."<br/>";
# Show server variables 
print_r($_SERVER);
print ("----------------------------\n");
$stmt = $mysqli->prepare("SELECT first_name, last_name, email, username, password FROM members_test limit 15");
$stmt->execute();
/* bind result variables */
$stmt->bind_result($fname, $lname, $email, $uname, $pname);

// fetch all remaining rows in result set
if ($stmt) {
    // fetch values
    //$members = array();
    while ($nextrow = $stmt->fetch()) {
        //array_push($members,$nextrow);
        printf ("%s %s %s %s %s\n", $fname, $lname, $email, $uname, $pname);
    }
    //print_r ($members); 
} else {
    echo "No data";
}
$stmt->close();
print ("----------------------------\n");
// close connection 
$mysqli->close();
?></pre>
