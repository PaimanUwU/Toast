<?php
$pageTitle = "Toast/Profile Visit";
$showTags = false;
$showNavBar = true;
$showFooter = false;
$currentPage = "profileVisit.php?id=" . $_GET['id'];

$visitProfileID = intval($_GET['id']);

include '../php/session_Maker.php';
require '../php/db_connection.php';

// Fetch profile details
$query = "SELECT * FROM profile WHERE Profile_ID = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $visitProfileID);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $profileName = $row['Profile_Name'];
    $profileDesc = $row['Profile_Desc'];
    $profileImage = $row['Profile_Image_Path'];
} else {
    echo "Profile not found.";
    exit;
}

$isLoggedIn = "false";


if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $currentProfileID = $_SESSION['id']; // Assuming you store the current profile ID in session

    $query = "SELECT * FROM Follower WHERE Follower_Profile_ID = ? AND Followee_Profile_ID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $currentProfileID, $visitProfileID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $isFollowed = "true";
    }

    $followButton = "onclick=followFunc()";
    $isLoggedIn = "true";
}

ob_start();
?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" href="../css/profile.css">
<link rel="stylesheet" href="../css/profileVisit.css">
<link rel="stylesheet" href="../assets/cards/card 2/card2Style.css">


<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="profileHeader">
    <div class="profileHeaderTop">
        <h1>Profile</h1>
    </div>
    <div class="profileHeaderMiddle">
        <div class="profileImage">
            <img src="<?php echo htmlspecialchars($profileImage, ENT_QUOTES, 'UTF-8'); ?>" alt="profile image">
        </div>
        <div class="profileHeaderMiddleRight">
            <div class="profileName">
                <h2><?php echo htmlspecialchars($profileName, ENT_QUOTES, 'UTF-8'); ?></h2>
            </div>
            <div class="profileDesc"><p><?php echo htmlspecialchars($profileDesc, ENT_QUOTES, 'UTF-8'); ?></p></div>
        </div>
    </div>
    <div class="profileHeaderBottom">

    </div>
</div>

<div class="sectionControlled">
    <div class="sectionControlledHeader">    
        <div class="headerContainer"><h2>Their Posts</h2></div>
    </div>
    <div class="postCard2">
        <?php 
        $query = "SELECT p.Post_ID AS postID, 
        p.Post_Title AS title, 
        p.Post_Image_Path AS food_image, 
        u.Profile_Image_Path AS profile_image, 
        u.Profile_Name AS username, 
        p.Post_Likes AS likes
        FROM POST p
        JOIN PROFILE u ON p.Profile_ID = u.Profile_ID
        WHERE p.Profile_ID = ?";
        
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $visitProfileID);
        $stmt->execute();
        $result = $stmt->get_result();

        $recipes = []; // Initialize the $recipes array

        // Fetch data into $recipes array
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $recipes[] = $row;
            }
        }

        $stmt->close();
        $connection->close();

        // Loop through the fetched recipes
        foreach ($recipes as $recipe):
        ?>
        <div class="card2">
            <a href="../page/post.php?id=<?php echo $recipe['postID']; ?>" id="card2Container<?php echo $recipe['postID']; ?>" class="card2Container">
                <style>
                    #card2Container<?php echo $recipe['postID']; ?>{
                        background-image: url('<?php echo $recipe['food_image']; ?>');
                        background-size: cover;
                    }
                </style>
                <div class="card2OuterControlled">
                    <div class="card2PostDetailContainer">
                        <div class="card2PostDetail">
                            <div class="card2ProfileDetail">
                                <div class="card2ProfileImageContainer">
                                    <img class="card2ProfileImage" src="<?php echo $recipe['profile_image']; ?>"  alt="">
                                </div>
                                <h3><?php echo $recipe['username']; ?></h3>
                            </div>
                            <div>
                                <h1><?php echo $recipe['title']; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script-------------------------------------------->
<script>

</script>


<?php
$pageScript = ob_get_clean();

include '../layout/Layout.php';
?>
