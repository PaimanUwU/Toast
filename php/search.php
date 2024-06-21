<?php
// Include database connection file
include 'db_connection.php';

$input = $_GET["input"] ?? '';

// Use prepared statements to prevent SQL injection
$query = $connection->prepare("SELECT Post_ID, Post_Title, Post_Image_ID FROM POST WHERE Post_Title LIKE ? ORDER BY Post_Title ASC");
$searchTerm = "%" . $input . "%";
$query->bind_param("s", $searchTerm);
$query->execute();
$result = $query->get_result();

$allResults = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $title = $row['Post_Title'] ?? '';
        $image_id = $row['Post_Image_ID'] ?? '';
        $post_id = $row['Post_ID'] ?? '';

        if ($title && $post_id) { // Check if all necessary values are set
            $data = ["title" => $title, "image" => $image_id, "postID" => $post_id];
            $allResults[] = $data; // Collect results in the array
        }
    }
}

$query->close();
$connection->close();

// Pass results to the searchResult.php
$results = $allResults;
?>
<?php if (!empty($results)): ?>
    <ul>
        <?php foreach ($results as $recipe): ?>
            <li>
            <a href="post.php?id=<?php echo htmlspecialchars($recipe['postID'], ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="searchResultContentContainer">
                        <div class="searchResultTitle">
                            <img src="data/postImages/GPID-<?php echo htmlspecialchars($recipe['image'], ENT_QUOTES, 'UTF-8'); ?>.png" alt="">
                            <h1><?php echo htmlspecialchars($recipe['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
                        </div>
                        <div class="searchResultCallforAction">
                            redirect ->
                        </div>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No results found.</p>
<?php endif; ?>

