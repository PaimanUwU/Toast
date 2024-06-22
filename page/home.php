<?php
$pageTitle = "Home";
$showTags = true;
$showNavBar = true;
$currentPage = "home.php";

include '../php/session_Maker.php';

ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" href="../css/home.css">
<link rel="stylesheet" href="../assets/cards/card 1/card1Style.css">
<link rel="stylesheet" href="../assets/cards/card 2/card2Style.css">

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="sectionControlled">
    <div class="sectionControlledHeader">
        <div class="headerContainer"><h2>Popular Post</h2></div>
        <div class="buttonContainer">
            <a href="#" class="buttons" id="scroll-left-button"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404040"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg></a>
            <a href="#" class="buttons" id="scroll-right-button"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404040"><path d="M522-480 333-669l51-51 240 240-240 240-51-51 189-189Z"/></svg></a>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const scrollContainer = document.getElementById("popular-card-container");
                const scrollLeftButton = document.getElementById("scroll-left-button");
                const scrollRightButton = document.getElementById("scroll-right-button");

                scrollLeftButton.addEventListener("click", function() {
                    scrollContainer.scrollBy({
                        top: 0,
                        left: -400, // Adjust this value to scroll more or less
                        behavior: 'smooth'
                    });
                });

                scrollRightButton.addEventListener("click", function() {
                    scrollContainer.scrollBy({
                        top: 0,
                        left: 400, // Adjust this value to scroll more or less
                        behavior: 'smooth'
                    });
                });
            });
        </script>
    </div>
    <div class="popularCard1" id="popular-card-container">
        <?php include '../php/card1_Display.php'; ?>
    </div>
</div>
<!--discover-->
<div class="sectionControlled">
    <div class="sectionControlledHeader">    
        <div class="headerContainer"><h2>For You</h2></div>
    </div>
    <div class="postCard2">
        <?php include '../php/card2_Display.php'; ?>
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