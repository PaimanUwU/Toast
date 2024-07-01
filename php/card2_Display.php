<?php
require 'db_connection.php';

// Fetch 20 random posts from the database
$query = "SELECT p.Post_ID AS postID, p.Post_Title AS title, p.Post_Image_Path AS food_image, 
                 u.Profile_Image_Path AS profile_image, u.Profile_Name AS username, p.Post_Likes AS likes
          FROM POST p
          JOIN PROFILE u ON p.Profile_ID = u.Profile_ID
          ORDER BY RAND()
          LIMIT 20";

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
    <a href="post.php?id=<?php echo $recipe['postID']; ?>" id="card2Container<?php echo $recipe['postID']; ?>" class="card2Container">
        <style>
            #card2Container<?php echo $recipe['postID']; ?>{
                background-image: url(<?php echo $recipe['food_image']; ?>);
                background-size: cover;
            }
        </style>
        <div class="card2OuterControlled">
            <div class="card2PostDetailContainer">
                <div class="card2PostDetail">
                    <div class="card2ProfileDetail">
                        <div class="card2ProfileImageContainer">
                            <img class="card2ProfileImage" src="<?php echo $recipe['profile_image']; ?>"  alt="">
                        </div>
                        <h3><?php echo $recipe['username']; ?></h3>
                    </div>
                    <div class="card2FoodTitle">
                        <h1><?php echo $recipe['title']; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<?php endforeach; ?>
