<?php
require 'db_connection.php';

// Fetch 20 random posts from the database
$query = "SELECT p.Post_ID AS postID, 
          p.Post_Title AS title, 
          p.Post_Image_Path AS food_image, 
          u.Profile_Image_Path AS profile_image, 
          u.Profile_Name AS username, 
          p.Post_Likes AS likes
          FROM POST p
          JOIN PROFILE u ON p.Profile_ID = u.Profile_ID
          WHERE p.Profile_ID = $ProfileID";

$result = mysqli_query($connection, $query);

$recipes = []; // Initialize the $recipes array

// Fetch data into $recipes array
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $recipes[] = $row;
    }
}

mysqli_close($connection);

// Loop through the fetched recipes
foreach ($recipes as $recipe):
?>
<div class="card2">
    <a href="../page/post.php?id=<?php echo htmlspecialchars($recipe['postID'], ENT_QUOTES, 'UTF-8'); ?>" class="card2Container">
        <style>
            .card2Container{
                background-image: url(<?php echo htmlspecialchars($recipe['food_image'], ENT_QUOTES, 'UTF-8'); ?>);
            }
        </style>
        <div class="card2OuterControlled">
            <div class="card2PostDetailContainer">
                <div class="card2PostDetail">
                    <div class="card2ProfileDetail">
                        <img class="card2ProfileImage" src="<?php echo htmlspecialchars($recipe['profile_image'], ENT_QUOTES, 'UTF-8'); ?>"  alt="">
                        <h3><?php echo htmlspecialchars($recipe['username'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    </div>
                    <div>
                        <h1><?php echo htmlspecialchars($recipe['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<?php endforeach; ?>
