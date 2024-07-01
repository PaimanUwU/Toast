<?php
$pageTitle = "Toast/Dashboard";
$showTags = true;
$showNavBar = true;

$adminDirectory = "dashboard";

require '../php/db_connection.php';

function avgLikes() {
    $query = "SELECT AVG(Post_Likes) FROM post";
    $result = mysqli_query($connection, $query);
}

$sql = "SELECT COUNT(*) AS  total_users from profile";
$result = $connection->query($sql);
$totalUsers = $result->fetch_assoc()['total_users'];

$sql = "SELECT COUNT(*) AS  total_posts from post";
$result = $connection->query($sql);
$totalPosts = $result->fetch_assoc()['total_posts'];

$sql="SELECT SUM(Post_Likes) AS total_likes FROM post";
$result = $connection->query($sql);
$totalLikes= $result->fetch_assoc()['total_likes'];
//PHP Calculation (Avg Likes)
$avgLikes = round(($totalLikes/$totalPosts), 2);

ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->


<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="div">
    <br>
    <h1>SUMMARY</h1>
    <br>
    <h2>Total no. of users: <?php echo $totalUsers?></h2>
    <br>
    <h2>Total no. of posts created: <?php echo $totalPosts?></h2>
    <br>
    <h2>Average no. of likes for each post: <?php echo $avgLikes?></h2>
</div>
<?php
$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script------------------------------------------->


<?php
$pageScript = ob_get_clean();
?>