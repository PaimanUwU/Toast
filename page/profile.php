<?php
$pageTitle = "Toast/Profile";
$showTags = false;
$showNavBar = true;
$currentPage = "profile";

include '../php/session_Maker.php';

ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" href="../css/profile.css">
<link rel="stylesheet" href="../assets/cards/card 2/card2Style.css">

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="profileHeader">
    <?php include '../php/profileDetailDisplay.php'; ?>
</div>

<div class="sectionControlled">
    <div class="sectionControlledHeader">    
        <div class="headerContainer"><h2>Your Post</h2></div>
    </div>
    <div class="postCard2">
        <?php include '../php/card2_DisplayOnProfile.php'; ?>
    </div>
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