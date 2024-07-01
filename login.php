<?php
$pageTitle = "Toast/Login";
$showTags = false;
$showNavBar = false;
$showFooter = false;

$redirect = $_GET['redirect'];
$currentPage = $_GET['currentPage'];


include 'php/session_Maker.php';

require 'php/db_connection.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $accountFount = false;

    // Prepare and bind
    $query = "SELECT Profile_ID, Profile_Email, Profile_Password FROM profile WHERE Profile_Email = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['Profile_ID'];
        $stored_password = $row['Profile_Password'];

        if ($password == $stored_password) { // Directly compare the passwords
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["email"] = $email;

            $accountFount = true;

            header("Location: auth.php?redirect=$redirect&currentPage=$currentPage");
            exit();
        } else {
            echo '<script>alert("Wrong password");</script>'; 
        }
    } 

    $query = "SELECT Admin_ID, Admin_Email, Admin_Password FROM Admin WHERE Admin_Email = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['Addmin_ID'];
        $stored_password = $row['Admin_Password'];

        if ($password == $stored_password) { // Directly compare the passwords
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["email"] = $email;

            $accountFount = true;

            header("Location: admin/view.php?page=dashboard");
            exit();
        } else {
            echo '<script>alert("Wrong password");</script>'; 
        }
    }

    if (!$accountFount) {
        echo '<script>alert("Account not found");</script>'; 
    }
}

mysqli_close($connection);

ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" type="text/css" href="css/login.css">
<link rel="stylesheet" type="text/css" href="css/default.css">

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="container">
    <div class="containerSide">
        <div class="logoContainer">
            <img class="logoBackground" src="assets/images/Breakfast Foods.png" alt="logo">
            <img class="logoSimplified" src="assets/images/Toast Logo.png" alt="logo">
        </div>
    </div>
    <form action="login.php?redirect=<?php echo $redirect; ?>&currentPage=<?php echo $currentPage; ?>" method="post">
        <div class="formContainer">
            <div class="formInnerContaier">
                <h1>Login</h1>
                <p>Enter your email and password to login.</p>
            </div>
            <div class="formInnerContaier">
                <div class="inputContainer">
                    <input class="formInputBox" type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="inputContainer">
                    <input class="formInputBox" type="password" id="password" name="password" placeholder="Password" required>
                </div>
            </div>
            
            <p>Don't have an account? <a href="register.php?redirect=<?php echo $redirect;?>&currentPage=<?php echo $currentPage;?>">Register</a></p>
        </div>
        
        <input class="formSubmitButton" type="submit" value="Login">
    </form>
    <div class="backButton"><a href="index.php?redirect=goback&currentPage=<?php echo $currentPage;?>""><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404040"><path d="m252-176-74-76 227-228-227-230 74-76 229 230 227-230 74 76-227 230 227 228-74 76-227-230-229 230Z"/></svg><h3>Go Back</h3></a></div>
</div>
<?php
$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script---------------------------------------------->


<?php
$pageScript = ob_get_clean();

include 'layout/Layout.php';
?>