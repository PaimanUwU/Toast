<?php
$pageTitle = "Toast/Create";
$showTags = false;
$showNavBar = true;
$currentPage = "create";

include '../php/session_Maker.php';

ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>


<?php
$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script---------------------------------------------->


<?php
$pageScript = ob_get_clean();

include '../Layout/Layout.php';
?>