<?php
require 'db_connection.php';
include 'session_Maker.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../page/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $bio = trim($_POST['bio']);

    $query = "SELECT Profile_Image_Path FROM Profile WHERE Profile_ID = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $oldImagePath);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $imagePath = $oldImagePath;

    if ((isset($_FILES['image']) && $_FILES['image']['error'] == 0) && !empty($_FILES['image']['name'])) {

        $uploadDir = '../data/profileImages/';
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        $newFileName = 'GPID-' . $_SESSION['id'] . '.' . $imageFileType;
        $uploadFile = $uploadDir . $newFileName;

        // if file exists, delete it
        unlink($uploadFile);
        unlink($oldImagePath);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $imagePath = "../data/profileImages/" . $newFileName;
        } else {
            echo "<alert>Sorry, there was an error uploading your file.</alert>";
            exit();
        }
    }    

    $query = "UPDATE profile SET Profile_Name = ?, Profile_Desc = ?, Profile_Image_Path = ? WHERE Profile_ID = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $bio, $imagePath, $_SESSION['id']);
    mysqli_stmt_execute($stmt);

    mysqli_close($connection);

    header("Location: ../page/profile.php");
    exit();
}
?>