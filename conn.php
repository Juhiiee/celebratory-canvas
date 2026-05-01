<?php
$servername = "localhost"; // or your database host
$username = "root";
$password = "";
$database = "canvas";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
