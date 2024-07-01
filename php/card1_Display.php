<?php
// Include database connection file
include 'db_connection.php';

// Fetch data from the database, ordered by the highest number of likes in descending order
$query = "SELECT p.Post_ID AS postID, p.Post_Title AS title, p.Post_Image_Path AS food_image, 
                 u.Profile_Image_Path AS profile_image, u.Profile_Name AS username, p.Post_Likes AS likes
          FROM POST p
          JOIN PROFILE u ON p.Profile_ID = u.Profile_ID
          ORDER BY p.Post_Likes DESC
          LIMIT 10";

$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($connection));
}

$recipes = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $recipes[] = $row;
    }
}

mysqli_close($connection);

// Display the cards
$recipeCount = min(count($recipes), 6);
for ($i = 0; $i < $recipeCount; $i++): 
    $recipe = $recipes[$i];
?>
<div class="card1">
    <a href="post.php?id=<?php echo htmlspecialchars($recipe['postID'], ENT_QUOTES, 'UTF-8'); ?>" class="card1Controlled">
        <div class="card1Image">
            <img class="card1FoodImage" src="<?php echo htmlspecialchars($recipe['food_image'], ENT_QUOTES, 'UTF-8'); ?>" alt=""> 
        </div>
        <div class="card1Content">
            <div class="card1Profile">
                <div class="card1ProfileImageContainer">
                    <img class="card1ProfileImage" src="<?php echo htmlspecialchars($recipe['profile_image'], ENT_QUOTES, 'UTF-8'); ?>" alt="">
                </div>
                <div>
                    <h3><?php echo htmlspecialchars($recipe['username'], ENT_QUOTES, 'UTF-8'); ?></h3>
                </div>
            </div>
            <div class="card1FoodTitle">
                <h1><?php echo htmlspecialchars($recipe['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
            </div>
            <div class="card1Likes">
                <p>Likes: <?php echo htmlspecialchars($recipe['likes'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
    </a>
</div>
<?php endfor; ?>
