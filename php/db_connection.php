<?php
$host = "localhost"; // Your host name
$username = "root"; // Your database username
$password = "";// Your database password
$database = "ToastDB"; // Your database name

// Create connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>