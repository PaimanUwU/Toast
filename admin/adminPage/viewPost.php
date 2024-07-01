<?php
$pageTitle = "Toast/View Post";
$showTags = true;
$showNavBar = true;

$adminDirectory = "viewPost";

include '../php/db_connection.php';

$postID = $_GET['id'];

$query = "SELECT * FROM Post WHERE Post_ID = $postID";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$postID = $row['Post_ID'];
$postTitle = $row['Post_Title'];
$postDesc = $row['Post_Desc'];
$postContent = $row['Post_Content'];
$postLikes = $row['Post_Likes'];
$postImage = $row['Post_Image_Path'];
$profileID = $row['Profile_ID'];
$postTagID = $row['Post_Tag_ID'];


$query = "SELECT * FROM Profile WHERE Profile_ID = $profileID";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$profileName = $row['Profile_Name'];
$profileImage = $row['Profile_Image_Path'];


$query = "SELECT * FROM Tags WHERE Tag_ID = $postTagID";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$tagCategory = $row['Tag_Category'];


ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" href="../css/adminViewPost.css">


<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="sectionControlledHeader">    
    <div class="headerContainer"><h2>View Post</h2></div>
    <a href="view.php?page=report"><button>Back</button></a>
</div>
<div class="sectionControlled">
    <h2>Profile:</h2>
    <a class="postProfile">
        <img src="<?php echo $profileImage; ?>" alt="profile image" class="postProfileImage">
        <div class="profileDetail">
            <h2 class="profileName"><?php echo $profileName; ?></h2>
        </div>
    </a>
    <br>
    <h2>Post detail:</h2>
    <div class="createHeader">
        <div class="createTitle">
            <span class="titleInput">Title: <?php echo $postTitle; ?></span>
        </div>
        <div class="createTag">
            <span class="titleInput">Category: <?php echo $tagCategory; ?></span>
        </div>
    </div>
    <hr height="1px" width="100%" color="#404040" size="1px" border-radius="5px" />
    <div class="createDesc">
        <textarea class="descInput" name="description" placeholder="Description"><?php echo $postDesc; ?></textarea>
    </div>
    <div class="createRecipe">
        <textarea class="recipeInput" name="recipe" placeholder="Recipe goes here..."><?php echo $postContent; ?></textarea>
    </div>
    <hr height="1px" width="100%" color="#404040" size="1px" border-radius="5px" />
    <div class="createFooter">
        <div class="createImage">
            <h2>Image</h2>
            <image src="<?php echo $postImage; ?>"></image>
        </div>
    </div>
</div>


<?php
$pageContents = ob_get_clean();

ob_start();
?>
<!------------------------------------------Script------------------------------------------->



<?php
$pageScript = ob_get_clean();
?>