<?php
// Check if redirect and currentPage variables are set
$redirect = $_GET['redirect'];
$currentPage = $_GET['currentPage'];

session_start();

// Check if the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if ($redirect == "auth") {
        header("Location: page/$currentPage");
    } else {
    header("Location: page/$redirect.php");
    }
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php?redirect=$redirect&currentPage=$currentPage");
}
exit;
?>