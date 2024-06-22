<?php
// index will be use for page router

$redirect = $_GET['redirect'] ?? null;
$currentPage = $_GET['currentPage'] ?? null;

if ($redirect == null) {
    header("Location: page/home.php");
    exit;
} else if (in_array($redirect, ["profile", "create", "history", "auth"])) {
    header("Location: auth.php?redirect=$redirect&currentPage=$currentPage");
    exit;
} else if ($redirect == "goback") {
    header("Location: page/$currentPage");
    exit;
} else {
    header("Location: page/$redirect.php");
    exit;
}

?>