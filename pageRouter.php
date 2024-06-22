<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // User is logged in, redirect to profile page
    header("Location: profile.php");
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
}
exit;
?>