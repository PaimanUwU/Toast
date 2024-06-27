<?php
require 'db_connection.php';
include 'session_Maker.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../page/login.php");
    exit();
}

$query = "SELECT * FROM Profile WHERE Profile_ID = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

$accountEmail = $row['Profile_Email'];
$accountPassword = $row['Profile_Password'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPasswword = trim($_POST['confirmPassword']);
    $isChanged = false;

    if ($password != $confirmPasswword) {
        header ("Location: ../page/setting.php?msg=PASSWORD-ERROR");
        exit();
    }

    if (!empty($email)) {
        $accountEmail = $email;

        $query = "UPDATE profile SET Profile_Email = ? WHERE Profile_ID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "si", $accountEmail, $_SESSION['id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $isChanged = true;
    }

    if (!empty($password)) {
        $accountPassword = $password;

        $query = "UPDATE profile SET Profile_Password = ? WHERE Profile_ID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "si", $accountPassword, $_SESSION['id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $isChanged = true;
    }

    if ($isChanged) {
        echo '<script>alert("Account updated successfully!");</script>';
        
        $_SESSION = array();
        session_destroy();
        
        header ("Location: ../page/login.php?redirect=profile&currentPage=0");

        exit();
    }
}

header("Location: ../page/profile.php");
exit();
?>