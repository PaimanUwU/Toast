<?php
$pageTitle = "Toast/Edit";
$showTags = false;
$showNavBar = true;
$showFooter = false;
$currentPage = "edit.php";

require '../php/db_connection.php';
include '../php/session_Maker.php';

$postEditID = $_GET['id'];
$currentProfileID = $_SESSION['id'];

$queryProfile = "SELECT * FROM Profile WHERE Profile_ID = $currentProfileID";
$resultProfile = mysqli_query($connection, $queryProfile);

if ($resultProfile && mysqli_num_rows($resultProfile) > 0) {
    $rowProfile = mysqli_fetch_assoc($resultProfile);

    $profileName = htmlspecialchars($rowProfile['Profile_Name']);
    $profileImage = $rowProfile['Profile_Image_Path'];
}

$query = "SELECT * FROM Post WHERE Post_ID = $postEditID";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $postTitle = $row['Post_Title'];
    $postDesc = $row['Post_Desc'];
    $postContent = $row['Post_Content'];
    $postLikes = $row['Post_Likes'];
    $postDislikes = $row['Post_Dislikes'];
    $postProfileID = $row['Profile_ID'];
    $postImagePath = $row['Post_Image_Path'];
    $tagID = $row['Post_Tag_ID'];

    // Check if the post belongs to the current profile
    if (!($postProfileID == $currentProfileID)) {
        echo "<alert>You do not have permission to edit this post.</alert>";
        header("Location: post.php?id=$postEditID");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $recipe = trim($_POST['recipe']);
    $profileId = "$_SESSION[id]";
    $tagID = trim($_POST['tagId']);
    $imagePath = $postImagePath;

    // Validate form inputs
    if (empty($title) || empty($description) || empty($recipe)) {
        echo "<alert>All fields are required.</alert>";
        exit();
    }

    // Handle file upload
    if ((isset($_FILES['image']) && $_FILES['image']['error'] == 0) && !empty($_FILES['image']['name'])) {
        $uploadDir = '../data/postImages/';
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        // Prepare the new file name
        $newFileName = 'GPID-' . $postEditID . '.' . $imageFileType;
        $uploadFile = $uploadDir . $newFileName;

        // Check if the file already exists and delete it
        if (file_exists($uploadFile)) {
            if (!unlink($uploadFile)) {
                echo "<alert>Sorry, there was an error deleting the existing file.</alert>";
                exit();
            }
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $imagePath = "../data/postImages/" . $newFileName;
            echo "<alert>File uploaded successfully.</alert>";
        } else {
            echo "<alert>Sorry, there was an error uploading your file.</alert>";
            exit();
        }

        // Update the post details including the new image path
    }

    $query = "UPDATE post 
              SET Post_Title = ?, Post_Desc = ?, Post_Content = ?, Post_Image_Path = ?, Post_Tag_ID = ?
              WHERE Post_ID = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssssii", $title, $description, $recipe, $imagePath, $tagID, $postEditID);
    mysqli_stmt_execute($stmt);

    echo "<alert>Upload successful.</alert>";
    header("Location: post.php?id=$postEditID");
}

ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" href="../css/create.css">

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="sectionControlled">
    <div class="sectionControlledHeader">    
        <div class="headerContainer"><h2>Edit Post</h2></div>
    </div>
</div>
<div class="sectionControlled">
    <form action="edit.php?id=<?php echo $postEditID; ?>" method="POST" enctype="multipart/form-data">
        <h2>Post as:</h2>
        <a class="postProfile" href="#">
            <img src="<?php echo $profileImage; ?>" alt="profile image" class="postProfileImage">
            <div class="profileDetail">
                <h2 class="profileName"><?php echo $profileName; ?></h2>
            </div>
        </a>
        <br>
        <h2>Edit post detail:</h2>
        <div class="createTitle">
            <input class="titleInput" type="text" name="title" placeholder="Title" value="<?php echo $postTitle; ?>">
        </div>
        <div class="createTag">
            <select class="tagInput" name="tagId" id="tagInput">
                <?php
                $query = "SELECT * FROM tags WHERE Tag_ID = $tagID";
                $result = mysqli_query($connection, $query);

                $row = mysqli_fetch_assoc($result);
                $OptionTagId = $row['Tag_ID'];
                $OptionTagCategory = $row['Tag_Category'];

                echo "<option value='$OptionTagId'>$OptionTagCategory (current)</option>";

                $query = "SELECT * FROM tags";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $OptionTagId = $row['Tag_ID'];
                    $OptionTagCategory = $row['Tag_Category'];
                    echo "<option value='$OptionTagId'>$OptionTagCategory</option>";
                }
                ?>
            </select>
        </div>
        <hr height="1px" width="100%" color="#404040" size="1px" border-radius="5px" />
        <div class="createDesc">
            <textarea class="descInput" name="description" placeholder="Description"><?php echo $postDesc; ?></textarea>
        </div>
        <div class="createRecipe">
            <textarea class="recipeInput" name="recipe" placeholder="Recipe goes here..."><?php echo $postContent; ?></textarea>
        </div>
        <hr height="1px" width="100%" color="#404040" size="1px" border-radius="5px" />
        <div class="createFooter">
            <div class="createImage">
                <h2>Image</h2>
                <input class="imageInput" type="file" name="image">
            </div>
            <input class="submitButton" type="submit" name="create" value="Edit">
        </div>
    </form>
</div>
<?php
$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script---------------------------------------------->


<?php
$pageScript = ob_get_clean();

mysqli_close($connection);

include '../layout/Layout.php';
?>