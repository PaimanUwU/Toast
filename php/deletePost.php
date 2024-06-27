<?php
session_start();

$postId = $_GET['id'];

require 'db_connection.php';

$query = "SELECT Profile_ID FROM Post WHERE Post_ID = $postId";

$result = mysqli_query($connection, $query);

if (($result && mysqli_num_rows($result) > 0) && ($_SESSION['id'] == mysqli_fetch_assoc($result)['Profile_ID'])) {
    try {
        // Delete related records in child tables first
        $query = "DELETE FROM Post_History WHERE Post_ID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $postId);
        mysqli_stmt_execute($stmt);
        
        $query = "DELETE FROM Post_Comment WHERE Post_ID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $postId);
        mysqli_stmt_execute($stmt);
    
        // Delete the post
        $query = "DELETE FROM Post WHERE Post_ID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $postId);
        mysqli_stmt_execute($stmt);
    
        // Commit transaction
        mysqli_commit($connection);
        echo "Post deleted successfully.";

        header("Location: ../index.php");

    } catch (Exception $e) {
        // Rollback transaction in case of error
        mysqli_rollback($connection);
        echo "Error deleting post: " . $e->getMessage();
    }
} else {
    echo "You do not have permission to delete this post.";
    header("Location: ../page/post.php?id=$postId");
    exit();
}

?>