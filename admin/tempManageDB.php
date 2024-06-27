<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ToastDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        if ($action == 'add_tag') {
            $tag_category = $_POST['tag_category'];
            $sql = "INSERT INTO TAGS (Tag_Category) VALUES ('$tag_category')";
        } elseif ($action == 'remove_tag') {
            $tag_id = $_POST['tag_id'];
            $sql = "DELETE FROM TAGS WHERE Tag_ID = $tag_id";
        } elseif ($action == 'add_profile') {
            $profile_name = $_POST['profile_name'];
            $profile_email = $_POST['profile_email'];
            $profile_desc = $_POST['profile_desc'];
            $profile_password = $_POST['profile_password'];
            $profile_image_id = $_POST['profile_image_id'];
            $sql = "INSERT INTO PROFILE (Profile_Name, Profile_Email, Profile_Desc, Profile_Password, Profile_Image_ID)
                    VALUES ('$profile_name', '$profile_email', '$profile_desc', '$profile_password', '$profile_image_id')";
        } elseif ($action == 'remove_profile') {
            $profile_id = $_POST['profile_id'];
            $sql = "DELETE FROM PROFILE WHERE Profile_ID = $profile_id";
        } elseif ($action == 'add_post') {
            $post_title = $_POST['post_title'];
            $post_desc = $_POST['post_desc'];
            $post_content = $_POST['post_content'];
            $post_likes = $_POST['post_likes'];
            $post_dislikes = $_POST['post_dislikes'];
            $post_image_id = $_POST['post_image_id'];
            $profile_id = $_POST['profile_id'];
            $sql = "INSERT INTO POST (Post_Title, Post_Desc, Post_Content, Post_Likes, Post_Dislikes, Post_Image_ID, Profile_ID)
                    VALUES ('$post_title', '$post_desc', '$post_content', '$post_likes', '$post_dislikes', '$post_image_id', '$profile_id')";
        } elseif ($action == 'remove_post') {
            $post_id = $_POST['post_id'];
            $sql = "DELETE FROM POST WHERE Post_ID = $post_id";
        } elseif ($action == 'add_admin') {
            $admin_name = $_POST['admin_name'];
            $admin_password = $_POST['admin_password'];
            $sql = "INSERT INTO ADMIN (Admin_Name, Admin_Password) VALUES ('$admin_name', '$admin_password')";
        } elseif ($action == 'remove_admin') {
            $admin_id = $_POST['admin_id'];
            $sql = "DELETE FROM ADMIN WHERE Admin_ID = $admin_id";
        } elseif ($action == 'add_post_history') {
            $post_history_date = $_POST['post_history_date'];
            $post_history_time = $_POST['post_history_time'];
            $post_id = $_POST['post_id'];
            $profile_id = $_POST['profile_id'];
            $sql = "INSERT INTO POST_HISTORY (Post_History_Date, Post_History_Time, Post_ID, Profile_ID)
                    VALUES ('$post_history_date', '$post_history_time', '$post_id', '$profile_id')";
        } elseif ($action == 'remove_post_history') {
            $post_history_id = $_POST['post_history_id'];
            $sql = "DELETE FROM POST_HISTORY WHERE Post_History_ID = $post_history_id";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Action executed successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage ToastDB</title>
</head>
<body>
    <h2>Add Tag</h2>
    <form method="post">
        <input type="hidden" name="action" value="add_tag">
        Tag Category: <input type="text" name="tag_category">
        <input type="submit" value="Add Tag">
    </form>

    <h2>Remove Tag</h2>
    <form method="post">
        <input type="hidden" name="action" value="remove_tag">
        Tag ID: <input type="text" name="tag_id">
        <input type="submit" value="Remove Tag">
    </form>

    <h2>Add Profile</h2>
    <form method="post">
        <input type="hidden" name="action" value="add_profile">
        Name: <input type="text" name="profile_name"><br>
        Email: <input type="text" name="profile_email"><br>
        Description: <input type="text" name="profile_desc"><br>
        Password: <input type="text" name="profile_password"><br>
        Image ID: <input type="text" name="profile_image_id"><br>
        <input type="submit" value="Add Profile">
    </form>

    <h2>Remove Profile</h2>
    <form method="post">
        <input type="hidden" name="action" value="remove_profile">
        Profile ID: <input type="text" name="profile_id">
        <input type="submit" value="Remove Profile">
    </form>

    <h2>Add Post</h2>
    <form method="post">
        <input type="hidden" name="action" value="add_post">
        Title: <input type="text" name="post_title"><br>
        Description: <input type="text" name="post_desc"><br>
        Content: <input type="text" name="post_content"><br>
        Likes: <input type="number" name="post_likes" value="0"><br>
        Dislikes: <input type="number" name="post_dislikes" value="0"><br>
        Image ID: <input type="text" name="post_image_id"><br>
        Profile ID: <input type="text" name="profile_id"><br>
        <input type="submit" value="Add Post">
    </form>

    <h2>Remove Post</h2>
    <form method="post">
        <input type="hidden" name="action" value="remove_post">
        Post ID: <input type="text" name="post_id">
        <input type="submit" value="Remove Post">
    </form>

    <h2>Add Admin</h2>
    <form method="post">
        <input type="hidden" name="action" value="add_admin">
        Name: <input type="text" name="admin_name"><br>
        Password: <input type="text" name="admin_password"><br>
        <input type="submit" value="Add Admin">
    </form>

    <h2>Remove Admin</h2>
    <form method="post">
        <input type="hidden" name="action" value="remove_admin">
        Admin ID: <input type="text" name="admin_id">
        <input type="submit" value="Remove Admin">
    </form>

    <h2>Add Post History</h2>
    <form method="post">
        <input type="hidden" name="action" value="add_post_history">
        Date: <input type="date" name="post_history_date"><br>
        Time: <input type="time" name="post_history_time"><br>
        Post ID: <input type="text" name="post_id"><br>
        Profile ID: <input type="text" name="profile_id"><br>
        <input type="submit" value="Add Post History">
    </form>

    <h2>Remove Post History</h2>
    <form method="post">
        <input type="hidden" name="action" value="remove_post_history">
        Post History ID: <input type="text" name="post_history_id">
        <input type="submit" value="Remove Post History">
    </form>

</body>
</html>
