<?php
session_start();
require 'php/db_connection.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $query = "SELECT Profile_ID, Profile_Email, Profile_Password FROM profile WHERE Profile_Email = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['Profile_ID'];
        $stored_password = $row['Profile_Password'];

        if ($password == $stored_password) { // Directly compare the passwords
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["email"] = $email;

            header("Location: profile.php");
            exit;
        } else {
            phpAlert("Invalid password!");
        }
    } else {
        phpAlert("Accound does not exist!"); 
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($connection);
?>




<!DOCTYPE html>
<html>
<head>
    <title>Toast/Login</title>
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
        <form action="login.php" method="post">
            <div class="formContainer">
                <div class="formInnerContaier">
                    <h1>Login</h1>
                    <p>Enter your email and password to login.</p>
                    <?php
                    function phpAlert($msg) {
                        echo "$msg";
                    }
                    ?>
                </div>
                <div class="formInnerContaier">
                    <div class="inputContainer">
                        <input class="formInputBox" type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="inputContainer">
                        <input class="formInputBox" type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
            
            <input class="formSubmitButton" type="submit" value="Login">
        </form>
        <div class="backButton"><a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404040"><path d="m252-176-74-76 227-228-227-230 74-76 229 230 227-230 74 76-227 230 227 228-74 76-227-230-229 230Z"/></svg><h3>Back to homepage</h3></a></div>
    </div>
</body>
</html>
