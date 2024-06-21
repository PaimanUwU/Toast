<?php
require 'db_connection.php';
include 'session_Maker.php';

if ((isset($_GET['action']) && isset($_GET['id'])) && (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    $action = $_GET['action'];
    $id = intval($_GET['id']);
    $profileID = intval($_SESSION["id"]);

    if ($action === 'like') {
        $query = "UPDATE Post SET Post_Likes = Post_Likes + 1 WHERE Post_ID = $id";
    } else if ($action === 'dislike') {
        $query = "UPDATE Post SET Post_Likes = Post_Likes - 1 WHERE Post_ID = $id";
    } else {
        echo "Invalid action.";
        exit;
    }

    $result = mysqli_query($connection, $query);

    if ($result && $resultHistory) {
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
    
    mysqli_close($connection);
} 
?>
