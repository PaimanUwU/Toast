<?php
$pageTitle = "Toast/Profile Visit";
$showTags = false;
$showNavBar = true;
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

// Fetch number of followers
$query = "SELECT COUNT(*) AS num_followees FROM Follower WHERE Followee_Profile_ID = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $visitProfileID);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $num_followees = $row['num_followees'];
}

$isFollowed = "false";
$isLoggedIn = "false";
$followButton = "href=../index.php?redirect=auth&currentPage=profileVisit.php?id=$visitProfileID";

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
        <a id="followButton" class="followButton" <?php echo $followButton; ?>>
            <h3>Follow</h3>
        </a>
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
        <div class="profileFollower">
            <h3>Followers:</h3>
            <?php echo htmlspecialchars($num_followees, ENT_QUOTES, 'UTF-8'); ?>
        </div>
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
        p.Post_Image_ID AS food_image, 
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
            <a href="../page/post.php?id=<?php echo htmlspecialchars($recipe['postID'], ENT_QUOTES, 'UTF-8'); ?>" class="card2Container">
                <style>
                    .card2Container {
                        background-image: url('<?php echo htmlspecialchars($recipe['food_image'], ENT_QUOTES, 'UTF-8'); ?>');
                    }
                </style>
                <div class="card2OuterControlled">
                    <div class="card2PostDetailContainer">
                        <div class="card2PostDetail">
                            <div class="card2ProfileDetail">
                                <img class="card2ProfileImage" src="<?php echo htmlspecialchars($recipe['profile_image'], ENT_QUOTES, 'UTF-8'); ?>" alt="">
                                <h3><?php echo htmlspecialchars($recipe['username'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            </div>
                            <div>
                                <h1><?php echo htmlspecialchars($recipe['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
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
    var followStyle = document.getElementById('followButton');   
    var isFollowed = <?php echo $isFollowed; ?>;
    var isLoggedIn = <?php echo $isLoggedIn; ?>;

    console.log(isFollowed);
    console.log(isLoggedIn);

    if (isFollowed) {
        followStyle.classList.add('clicked');

        console.log("follow condition fired");
    } else {
        follow.classList.remove('clicked');

        consoleStyle.log("unfollow condition fired");
    }

    function followFunc() {     
        // Check if the user is logged in
        if (isLoggedIn) {
            // Proceed with like or dislike functionality
            if (isFollowed) {
                isFollowed = false;
                followStyle.classList.remove('clicked');
                updateFollow('unfollow');

                console.log("unfollow button fired");
            } else {
                isFollowed = true;
                followStyle.classList.add('clicked');
                updateFollow('follow');

                console.log("follow button fired");
            }
        }

        console.log("button fired");
    }    

    function updateFollow(action) {
        fetch('../php/updateFollow.php?action=' + action + '&visitProfileID=' + <?php echo $visitProfileID; ?>, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                action: action,
                visitProfileID: <?php echo $visitProfileID; ?>
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

</script>


<?php
$pageScript = ob_get_clean();

include '../layout/Layout.php';
?>
