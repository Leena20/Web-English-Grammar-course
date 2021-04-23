<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "CSC457";

$connection = new mysqli($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
	echo "An error occured while connecting to mysql. Please try again later.";
	exit();
}
