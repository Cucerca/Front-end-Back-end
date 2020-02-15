<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pieseauto');
/* connect to MySQL database */
$con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if($con === false){
	die("ERROR: Could not connect. " . $con->connect_error);
}
?>

