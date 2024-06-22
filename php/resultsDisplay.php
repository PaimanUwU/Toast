<?php
// Include database connection file
require 'db_connection.php';

$searchInput = trim($_POST['searchQuery'] ?? '');

$query = "SELECT p.Post_ID AS postID, p.Post_Title AS title, p.Post_Image_ID AS food_image, p.Post_Content AS content, p.Post_Desc AS descriptions,
          u.Profile_Image_ID AS profile_image, u.Profile_Name AS username, p.Post_Likes AS likes
          FROM POST p
          JOIN PROFILE u ON p.Profile_ID = u.Profile_ID 
          WHERE Post_Title LIKE '%$searchInput%'
         ";

$result = mysqli_query($connection, $query);

$recipes = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $recipes[] = $row;
    }
}

mysqli_close($connection);

foreach ($recipes as $recipe):
?>
<a href="../page/post.php?id=<?php echo htmlspecialchars($recipe['postID'], ENT_QUOTES, 'UTF-8'); ?>">
    <div class="resultContainer">
        <img src="../data/postImages/GPID-<?php echo htmlspecialchars($recipe['food_image'], ENT_QUOTES, 'UTF-8'); ?>.png" alt="">
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