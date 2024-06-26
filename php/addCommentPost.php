<?php
require 'db_connection.php';

$postID = $_GET['id'];
$profileID = $_GET['profileID'];
$comment = $_POST['comment'];

$query = "INSERT INTO Post_Comment (Post_ID, Profile_ID, Post_Comment_Content) VALUES ($postID, $profileID, '$comment')";

$result = mysqli_query($connection, $query);

mysqli_close($connection);

header("Location: ../page/post.php?id=$postID");
?>