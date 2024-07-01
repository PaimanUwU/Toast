<?php
require 'db_connection.php';
include 'session_Maker.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
} else {
    $currentProfileID = $_SESSION['id'];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("location: ../index.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $reason = $_POST['reportReason'];

    $query = "INSERT INTO Post_Report (Post_ID, Post_Report_Reason, Profile_ID) VALUES ($id, '$reason', $currentProfileID)";
    $result = mysqli_query($connection, $query);

    if ($result) {
        header("Location: ../page/post.php?id=$id");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }
}  
?>