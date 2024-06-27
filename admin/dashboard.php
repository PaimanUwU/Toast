<?php
$pageTitle = "Toast/Search Result";
$showTags = false;
$showNavBar = false;
$currentPage = "dashboard.php";

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

<!------------------------------------------Script------------------------------------------->


<?php
$pageScript = ob_get_clean();

include '../layout/admin.php';
?>