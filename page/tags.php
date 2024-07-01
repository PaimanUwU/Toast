<?php
$pageTitle = "Toast/Tags";
$showTags = true;
$showNavBar = true;
$showFooter = true;
$currentPage = "tags.php?id=" . $_GET['id'];

require '../php/db_connection.php';

$tagID = $_GET['id'];

$query = "SELECT * FROM Tags WHERE Tag_ID = $tagID";

$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $tagName = $row['Tag_Category'];
}

$query = "SELECT p.Post_ID AS postID, p.Post_Title AS title, p.Post_Image_Path AS food_image, p.Post_Content AS content, p.Post_Desc AS descriptions,
          u.Profile_Image_Path AS profile_image, u.Profile_Name AS username, p.Post_Likes AS likes
          FROM POST p
          JOIN PROFILE u ON p.Profile_ID = u.Profile_ID 
          WHERE Post_Tag_ID LIKE '%$tagID%'
         ";

$result = mysqli_query($connection, $query);

$recipes = [];
        
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $recipes[] = $row;
    }
}

mysqli_close($connection);


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
        <div class="headerContainer"><h2>Tag Results</h2> 
            <div id="showSearchInput"><h3>showing results for tag: </h3> <em><?php echo $tagName; ?></em></div>
        </div>
    </div>
    <div class="result">
        <ul>
        <?php foreach ($recipes as $recipe): ?>
        <a href="post.php?id=<?php echo htmlspecialchars($recipe['postID'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="resultContainer">
                <img src="<?php echo htmlspecialchars($recipe['food_image'], ENT_QUOTES, 'UTF-8'); ?>" alt="">
                <div class="resultContent">
                    <div class="resultTitle">
                        <h1><?php echo htmlspecialchars($recipe['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
                    </div>
                    <div class="resultDetail">
                        <p><?php echo htmlspecialchars($recipe['descriptions'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php
$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script-------------------------------------------->


<?php
$pageScript = ob_get_clean();

include '../layout/Layout.php';
?>


