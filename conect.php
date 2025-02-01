<?php
//dados BD
$servername = "localhost";
$username = "lbscode";
$password = "";
$dbname = "lbscode";
//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
$conn->set_charset("utf8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>