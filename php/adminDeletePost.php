<?php
$postId = $_GET['id'];

require 'db_connection.php';

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

    $query = "DELETE FROM Post_Report WHERE Post_ID = ?";
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

    header("Location: ../admin/view.php?page=report");
    exit();
} catch (Exception $e) {
    // Rollback transaction in case of error
    mysqli_rollback($connection);
    echo "Error deleting post: " . $e->getMessage();

    header("Location: ../admin/view.php?page=report");
    exit();
}

?>