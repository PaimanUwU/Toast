<?php
$pageTitle = "Toast/Upload";
$showTags = false;
$showNavBar = true;
$currentPage = "create.php";

require '../php/db_connection.php';
include '../php/session_Maker.php';

$queryProfile = "SELECT * FROM Profile WHERE Profile_ID = $_SESSION[id]";
$resultProfile = mysqli_query($connection, $queryProfile);

if ($resultProfile && mysqli_num_rows($resultProfile) > 0) {
    $rowProfile = mysqli_fetch_assoc($resultProfile);

    $profileName = htmlspecialchars($rowProfile['Profile_Name']);
    $profileImage = $rowProfile['Profile_Image_Path'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $recipe = trim($_POST['recipe']);
    $profileId = "$_SESSION[id]";
    $postLikes = 0;
    $postDislikes = 0;
    $imagePath = '';

    // Validate form inputs
    if (empty($title) || empty($description) || empty($recipe) || empty($_FILES['image']['name'])) {
        echo "<alert>All fields are required.</alert>";
        exit();
    }

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = '../data/postImages/';
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        // Insert initial data to get the Post_ID
        $query = "INSERT INTO post (Post_Title, Post_Desc, Post_Content, Post_Likes, Post_Dislikes, Post_Image_Path, Profile_ID) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sssiisi", $title, $description, $recipe, $postLikes, $postDislikes, $imagePath, $profileId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $query = "SELECT LAST_INSERT_ID()";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_row($result);
        $postId = $row[0];

        // Define the new image name
        $newFileName = 'GPID-' . $postId . '.' . $imageFileType;
        $uploadFile = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $imagePath = "../data/postImages/" . $newFileName;
        } else {
            echo "<alert>Sorry, there was an error uploading your file.</alert>";
            exit();
        }

        // Update the image path in the database
        $query = "UPDATE post SET Post_Image_Path = ? WHERE Post_ID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "si", $imagePath, $postId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        echo "<alert>Image upload failed.</alert>";
        exit();
    }

    echo "<alert>Upload successful.</alert>";
    header("Location: post.php?id=$postId");
}

mysqli_close($connection);

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
        <div class="headerContainer"><h2>Upload Recipe</h2></div>
    </div>
</div>
<div class="sectionControlled">
    <form action="create.php" method="POST" enctype="multipart/form-data">
        <h2>Post as:</h2>
        <a class="postProfile" href="#">
            <img src="<?php echo $profileImage; ?>" alt="profile image" class="postProfileImage">
            <div class="profileDetail">
                <h2 class="profileName"><?php echo $profileName; ?></h2>
            </div>
        </a>
        <br>
        <h2>Post detail:</h2>
        <div class="createTitle">
            <input class="titleInput" type="text" name="title" placeholder="Title">
        </div>
        <hr height="1px" width="100%" color="#404040" size="1px" border-radius="5px" />
        <div class="createDesc">
            <textarea class="descInput" name="description" placeholder="Description"></textarea>
        </div>
        <div class="createRecipe">
            <textarea class="recipeInput" name="recipe" placeholder="Recipe goes here..."></textarea>
        </div>
        <hr height="1px" width="100%" color="#404040" size="1px" border-radius="5px" />
        <div class="createFooter">
            <div class="createImage">
                <h2>Image</h2>
                <input class="imageInput" type="file" name="image">
            </div>
            <input class="submitButton" type="submit" name="create" value="Upload">
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

include '../layout/Layout.php';
?>