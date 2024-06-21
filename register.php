<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password === $confirmPassword) {
        require 'php/db_connection.php';

        $query = "INSERT INTO PROFILE (Profile_Email, Profile_Password) VALUE ($email, $confirmPassword)";

        mysqli_close($connection);

        header("login.php");
        exit;
    } else {
        echo '<script>alert("Password and confirm passowrd does not matched!");</script>'; 
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Toast/Register</title>
    <link rel="icon" href="assets\images\Toast Logo Simplified.png" type="image/gif" />

    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="containerSide">
            <div class="logoContainer">
                <img class="logoBackground" src="assets/images/Breakfast Foods.png" alt="logo">
                <img class="logoSimplified" src="assets/images/Toast Logo.png" alt="logo">
            </div>
        </div>
        <form action="register.php" method="post">
            <div class="formContainer">
                <div class="formInnerContaier">
                    <h1>Register</h1>
                    <p>Enter your email and password to register.</p>
                </div>
                <div class="formInnerContaier">
                    <div class="inputContainer">
                        <input class="formInputBox" type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="inputContainer">
                        <input class="formInputBox" type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="inputContainer">
                        <input class="formInputBox" type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                    </div>
                </div>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
            <input class="formSubmitButton" type="submit" value="Register">
        </form>
        <div class="backButton"><a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404040"><path d="m252-176-74-76 227-228-227-230 74-76 229 230 227-230 74 76-227 230 227 228-74 76-227-230-229 230Z"/></svg><h3>Back to homepage</h3></a></div>
    </div>
</body>
</html>
