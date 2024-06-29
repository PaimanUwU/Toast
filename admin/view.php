<?php
$pageTitle = "Toast/Admin";
$showSidebar = true;
$showNavBar = true;
$currentPage = "dashboard.php";

if (!isset($_GET['page'])) {
    $_GET['page'] = "dashboard";
}

include 'adminPage/' . $_GET['page'] . '.php';

include '../layout/adminLayout.php';
?>