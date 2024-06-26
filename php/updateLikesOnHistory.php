<?php
require 'db_connection.php';
include 'session_Maker.php';

if (isset($_GET['action'], $_GET['id']) && isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $action = $_GET['action'];
    $id = intval($_GET['id']);
    $profileID = intval($_SESSION["id"]);
    
    if ($action === 'like') {
        $query = "UPDATE Post_History SET Post_isLike = 1 WHERE Post_ID = $id AND Profile_ID = $profileID";
    } elseif ($action === 'dislike') {
        $query = "UPDATE Post_History SET Post_isLike = 0 WHERE Post_ID = $id AND Profile_ID = $profileID";
    } else {
        echo "Invalid action.";
        exit;
    }

    $result = mysqli_query($connection, $query);
    
    if ($result) {
        echo "Success";
    }

    mysqli_close($connection);
}
?>
