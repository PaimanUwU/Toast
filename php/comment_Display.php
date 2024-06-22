<?php
require 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT * FROM Post_Comment WHERE Post_ID = $id";
    
    $result = mysqli_query($connection, $query);
}

$commentArray = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $commentArray[] = $row;
    }
}

for ($i = 0; $i < count($commentArray); $i++):
    $comment = $commentArray[$i];

    $comment_content = $comment['Post_Comment_Content'];
    $comment_profile_id = $comment['Profile_ID'];

    $query = "SELECT * FROM Profile WHERE Profile_ID = $comment_profile_id";

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $comment_profile_name = $row['Profile_Name'];
        $comment_profile_image = $row['Profile_Image_ID'];
    }
?>

<div class="commentContainer">
    <a class="commentProfile" href="../page/profileVisit.php?id=<?php echo $comment_profile_id; ?>">
        <img class="commentProfileImage" src="../data/profileImages/GUID-<?php echo $comment_profile_image; ?>.png" alt="">
        <h3><?php echo $comment_profile_name; ?></h3>
    </a>
    <div class="comment">
        <p><?php echo $comment_content; ?></p>
    </div>
</div>

<?php 
endfor; 

mysqli_close($connection);
?>