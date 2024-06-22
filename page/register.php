<?php
$pageTitle = "Toast/Register";
$showTags = false;
$showNavBar = false;

include '../php/session_Maker.php';

ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" type="text/css" href="../css/login.css">

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="container">
    <div class="containerSide">
        <div class="logoContainer">
            <img class="logoBackground" src="../assets/images/Breakfast Foods.png" alt="logo">
            <img class="logoSimplified" src="../assets/images/Toast Logo.png" alt="logo">
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
    <div class="backButton"><a href="../index.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404040"><path d="m252-176-74-76 227-228-227-230 74-76 229 230 227-230 74 76-227 230 227 228-74 76-227-230-229 230Z"/></svg><h3>Back to homepage</h3></a></div>
</div>

<?php
$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script---------------------------------------------->


<?php
$pageScript = ob_get_clean();

include '../Layout/Layout.php';
?>