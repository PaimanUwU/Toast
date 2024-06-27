<?php
$pageTitle = "Toast/Setting";
$showTags = false;
$showNavBar = true;
$currentPage = "setting.php";

include '../php/session_Maker.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit();
}

if ($_GET['msg'] == 'PASSWORD-ERROR') {
    $error = '<script>alert("Passowrd and confirm password do not match");</script>';
} else {
    $error = '';
}

require '../php/db_connection.php';

$ProfileID = $_SESSION['id'];

$query = "SELECT * FROM Profile WHERE Profile_ID = $ProfileID";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $profileName = $row['Profile_Name'];
    $profileBio = $row['Profile_Desc'];
    $profileEmail = $row['Profile_Email'];
}

ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" href="../css/setting.css">

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<?php echo $error;?>
<div class="sectionControlled">
    <div class="sectionControlledHeader">    
        <div class="headerContainer"><h2>Manage Profile</h2></h2></div>
    </div>
</div>
<div class="sectionControlled">
    <form action="../php/updateProfile.php" method="POST" enctype="multipart/form-data">
        <h2>Name:</h2>
        <div class="profileName">
            <input class="input" type="text" name="name" placeholder="Profile Name" value="<?php echo $profileName; ?>">
        </div>
        
        <h2>Bio:</h2>
        <div class="profileBio">
            <input class="input" type="text" name="bio" placeholder="Profile Bio" value="<?php echo $profileBio; ?>">
        </div>

        <hr height="1px" width="100%" color="#404040" size="1px" border-radius="5px" />

        <div class="profileFooter">
            <div class="profileImage">
                <h2>Image</h2>
                <input class="imageInput" type="file" name="image">
            </div>
            <input class="submitButton" type="submit" name="create" value="Edit">
        </div>
    </form>
</div>

<div id="addGap" class="sectionControlled">
    <div class="sectionControlledHeader">    
        <div class="headerContainer"><h2>Account Setting</h2></h2></div>
    </div>
</div>
<div class="sectionControlled">
    <form id="updateAccountForm" action="../php/updateAccount.php" method="POST">
        <h2>Change Email:</h2>
        <div class="profileEmail">
            <input class="input" type="email" name="email" placeholder="Email" value="<?php echo $profileEmail; ?>">
        </div>

        <h2>Change Password:</h2>
        <div class="profilePassword">
            <input class="input" type="password" name="password" placeholder="Password">
        </div>

        <h2>Confirm Password:</h2>
        <div class="profileConfirmPassword">
            <input class="input" type="password" name="confirmPassword" placeholder="Confirm Password">
        </div>

        <hr height="1px" width="100%" color="#404040" size="1px" border-radius="5px" />

        <div id="profileFooterAccountSetting" class="profileFooter">
            <input class="submitButton" type="submit" name="create" value="Edit">
        </div>
    </form>
</div>

<div id="addGap" class="sectionControlled">
    <div class="sectionControlledHeader">    
        <div class="headerContainer"><h2>Danger Zone</h2></h2></div>
    </div>
</div>
<div class="sectionControlled">
    <form action="../php/deleteAccount.php" method="POST">
        <p>This is danger zone, you must enter your password before deleting your account.</p>

        <h2>Account Deletion:</h2>
        <div class="profileDelete">
            <input class="input" type="password" name="passwordCofirmDelete" placeholder="Password"">
        </div>

        <hr height="1px" width="100%" color="#404040" size="1px" border-radius="5px" />

        <div id="profileFooterAccountSetting" class="profileFooter">
            <input class="submitButton" type="submit" name="create" value="Delete">
        </div>
    </form>
</div>

<?php
$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script---------------------------------------------->


<?php
$pageScript = ob_get_clean();

include '../layout/Layout.php';
?>