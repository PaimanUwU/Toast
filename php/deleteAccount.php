<?php
    require 'db_connection.php';
    include 'session_Maker.php';

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: ../page/login.php");
        exit();
    }

    $query = "SELECT * FROM Profile WHERE Profile_ID = $_SESSION[id]";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $profilePassword = $row['Profile_Password'];
    } else {
        $profilePassword = "";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password = $_POST['passwordCofirmDelete'];
        $profileID = $_SESSION['id'];

        if ($password == $profilePassword) {
            // delete related records in child tables first
            $queryFollower = "DELETE FROM Follower WHERE Followee_Profile_ID = $profileID";
            $resultFollower = mysqli_query($connection, $queryFollower);

            $queryPostHistory = "DELETE FROM Post_History WHERE Profile_ID = $profileID";
            $resultPostHistory = mysqli_query($connection, $queryPostHistory);
            
            $queryPostComment = "DELETE FROM Post_Comment WHERE Profile_ID = $profileID";
            $resultPostComment = mysqli_query($connection, $queryPostComment);
    
            $queryPost = "DELETE FROM Post WHERE Profile_ID = $profileID";
            $resultPost = mysqli_query($connection, $queryPost);

            $queryProfile = "DELETE FROM Profile WHERE Profile_ID = $profileID";
            $resultProfile = mysqli_query($connection, $queryProfile);
        }

        session_destroy();
        header("location: ../index.php");
        exit();
    }

    mysqli_close($connection);
?>
    

