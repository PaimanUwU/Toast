<?php
session_start();

// Check if session variables are set
if (isset($_SESSION["id"]) && isset($_SESSION["email"])) {
    // Assign session variables
    $ProfileID = $_SESSION["id"];
    $ProfileEmail = $_SESSION["email"];
    $isLoggedIn = $_SESSION["loggedin"];
} else {
    $ProfileID = 0;
    $ProfileEmail = "";
    $isLoggedIn = false;
}
?>