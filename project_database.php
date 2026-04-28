<?php
//Database connection established
$host = "localhost";
$user = "root";
$password = "";
$database = "student_registration";

//Connect to MySQL database
$conn = new mysqli($host, $user, $password, $database);

//Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
