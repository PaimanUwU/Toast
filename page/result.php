<?php
$pageTitle = "Toast/Search Result";
$showTags = true;
$showNavBar = true;

$searchQuery = $_GET['searchQuery'];
$currentPage = "result.php?searchQuery=$searchQuery";

include '../php/session_Maker.php';

ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" href="../css/result.css">
<link rel="stylesheet" href="../assets/cards/result card/resultCard.css">

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="sectionControlled">
    <div class="sectionControlledHeader">    
        <div class="headerContainer"><h2>Search Results</h2> 
            <div id="showSearchInput"><h3>showing results for: </h3> <em><?php echo $searchQuery; ?></em></div>
        </div>
    </div>
    <div class="result">
        <ul>
            <?php include '../php/resultsDisplay.php'; ?>
        </ul>
    </div>
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