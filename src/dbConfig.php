<?php

$db_host = "db";
$db_username = "root";
$db_password = "root";
$db_name = "kazlegacy";

$con = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($con->connect_error) {
	die("Connection error :" . $con->connect_error);
} else {

}

?>