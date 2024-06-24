<?php


require '../php/db_connection.php';
include '../php/session_Maker.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $query = "SELECT * FROM Post WHERE Post_ID = $id";

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $postID = $row['Post_ID'];
        $postTitle = htmlspecialchars($row['Post_Title']);
        $postDesc = htmlspecialchars($row['Post_Desc']);
        $postContent = htmlspecialchars($row['Post_Content']);
        $postImage = $row['Post_Image_ID'];
        $postLikes = $row['Post_Likes'];
        $postDislike = $row['Post_Dislikes'];
        $postProfileID = $row['Profile_ID'];

        // Fetch profile information
        $queryProfile = "SELECT * FROM Profile WHERE Profile_ID = $postProfileID";
        $resultProfile = mysqli_query($connection, $queryProfile);

        if ($resultProfile && mysqli_num_rows($resultProfile) > 0) {
            $rowProfile = mysqli_fetch_assoc($resultProfile);

            $profileName = htmlspecialchars($rowProfile['Profile_Name']);
            $profileImage = $rowProfile['Profile_Image_ID'];
        }

        // Fetch follower count
        $queryFollowers = "SELECT COUNT(*) AS num_followees FROM Follower WHERE Followee_Profile_ID = $postProfileID";
        $resultFollowers = mysqli_query($connection, $queryFollowers);

        if ($resultFollowers && $rowFollowers = mysqli_fetch_assoc($resultFollowers)) {
            $num_followees = $rowFollowers['num_followees'];
        }

        // Add post history      
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            $ProfileID = $_SESSION["id"];
            $postID = intval($postID);  // Assuming $postID is defined and comes from a trusted source

            // Use prepared statements to prevent SQL injection
            $query = "SELECT * FROM Post_History WHERE Post_ID = ? AND Profile_ID = ?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'ii', $postID, $ProfileID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) == 0) {
                $postHistoryDate = date('Y-m-d'); 
                $postHistoryTime = date('H:i:s'); 

                $query = "INSERT INTO Post_History (Post_ID, Profile_ID, Post_History_Date, Post_History_Time) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, 'iiss', $postID, $ProfileID, $postHistoryDate, $postHistoryTime);
                mysqli_stmt_execute($stmt);
            }
        }

        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {        
            $query = "SELECT Post_isLike FROM Post_History WHERE Post_ID = $postID AND Profile_ID = $ProfileID";
            $result = mysqli_query($connection, $query);

            if ($result && $row = mysqli_fetch_assoc($result)) {
                $isLike = $row['Post_isLike']; // Corrected column name
            }

            $isLoggedIn = true;
            $likeButton = "onclick=like()";
            $commentForm = "style=display:flex";
        } else {
            $isLoggedIn = false;
            $likeButton = "href=../index.php?redirect=auth&currentPage=post.php?id=$postID"; 
            $commentForm = "style=display:none";
        }
        
        if ($isLoggedIn && $postProfileID == $ProfileID) {
            $moreButton = "onclick=openMenu()"; 
        } else {
            $moreButton = "style=display:none";
        }
    } 

    mysqli_close($connection);
}

$pageTitle = "Toast/$postTitle";
$showTags = true;
$showNavBar = true;
$currentPage = "post.php?id=$postID";

ob_start();
?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" href="../css/post.css">
<link rel="stylesheet" href="../assets/cards/comment card/comment.css">

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="postContainer">
    <img src="../data/postImages/GPID-<?php echo $postImage; ?>.png" alt="post image" class="postImage" id="postImage">
    <div class="postImageGradient" id="background"></div>

    <img src="../data/postImages/GPID-<?php echo $postImage; ?>.png" alt="post image" class="postImageInner" id="postImageInner">

    <div class="postContainerControlled">
        <!--TODO: add like button, dislike button, report button.-->
        <div class="postDetail">
            <div class="postControl">
                <a class="postUtil" id="postUtil" <?php echo $moreButton; ?>>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404040"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
                </a>
                <div class="postDropMenu" id="postDropMenu">
                    <a href="../page/deletePost.php?id=<?php echo $postID; ?>">Delete</a></li>
                    <a href="../page/editPost.php?id=<?php echo $postID; ?>">Edit</a></li>
                </div>
                <a class="postLike" id="postLike" <?php echo $likeButton; ?>>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="#404040"><path d="M480-288q60 0 110.5-31t79.5-84H290q29 53 79.5 84T480-288ZM326-525l34-34 34 34 34-34-68-68-68 68 34 34Zm240 0 34-34 34 34 34-34-68-68-68 68 34 34ZM480-96q-79 0-149-30t-122.5-82.5Q156-261 126-331T96-480q0-80 30-149.5t82.5-122Q261-804 331-834t149-30q80 0 149.5 30t122 82.5Q804-699 834-629.5T864-480q0 79-30 149t-82.5 122.5Q699-156 629.5-126T480-96Zm0-384Zm0 312q130 0 221-91t91-221q0-130-91-221t-221-91q-130 0-221 91t-91 221q0 130 91 221t221 91Z"/></svg>    
                    <span id="postLikeCount" style="font-weight: bold;"><?php echo $postLikes; ?></span>                    
                </a>
            </div>
            <div>
                <h1 class="postTitle"><?php echo $postTitle; ?></h1>
                <p class="postDesc"><?php echo $postDesc; ?></p>
            </div>
        </div>
        <a class="postProfile" href="profileVisit.php?id=<?php echo $postProfileID; ?>">
            <!--TODO: add follow button-->
            <img src="../data/profileImages/GUID-<?php echo $profileImage; ?>.png" alt="profile image" class="postProfileImage">
            <div class="profileDetail">
                <h2 class="profileName"><?php echo $profileName; ?></h2>
                <div>
                    <p class="profileFollowerCount"><?php echo $num_followees; ?> Followers</p>
                </div>
            </div>
        </a>

    </div>

    
    <div class="postContainerControlled">
        <div class="postRecipe">
            <h1>Recipe</h1>
            <p class="postContent"><?php echo $postContent; ?></p>
        </div>
        <hr height="100%" width="1px" color="#404040" size="1px" border-radius="5px" />
        <div class="postComment">
            <!--
                TODO: add comment into php
                TODO: repair div
            -->
            <h1>Comments</h1>
            <form <?php echo $commentForm; ?> action="../php/addCommentPost.php?id=<?php echo $postID; ?>&profileID=<?php echo $ProfileID; ?>" method="POST" class="commentForm">
                <input class="commentInput" type="text" name="comment" placeholder="Write a comment...">
                <input class="commentSubmitButton" type="submit" name="submit" value="Submit">
            </form>
            <?php include '../php/comment_Display.php'; ?>
            
        </div>
    </div>
</div>

<?php
$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script---------------------------------------------->
<script>
var likeButton = document.getElementById("postLike");
var isLiked = <?php echo $isLike; ?>;

if (isLiked === 1) {
    likeButton.classList.add('clicked');
} else {
    likeButton.classList.remove('clicked');
}

function like() {
    var likeCountElement = document.getElementById('postLikeCount');
    var currentLikes = parseInt(likeCountElement.innerText);
    var newLikes;
    
    // Check if the user is logged in
    if (<?php echo $isLoggedIn; ?> === 1) {
        // Proceed with like or dislike functionality
        if (isLiked === 0) {
            isLiked = 1;
            likeButton.classList.add('clicked');
            newLikes = currentLikes + 1;
            updateLikes('like');
        } else {
            isLiked = 0;
            likeButton.classList.remove('clicked');
            newLikes = currentLikes - 1;
            updateLikes('dislike');
        }
        likeCountElement.innerText = newLikes;
    } else {
        // Redirect to login.php if the user is not logged in
        window.location.href = 'login.php';
    }
}    

function openMenu() {
    var menuButton = document.getElementById("postUtil");
    var menu = document.getElementById("postDropMenu");
    if (menu.style.display === "flex") {
        menu.style.display = "none";
        menuButton.classList.remove('clicked');
    } else {
        menu.style.display = "flex";
        menuButton.classList.add('clicked');
    }
}

function updateLikes(action) {
    var postID = <?php echo json_encode($postID); ?>;
    fetch(`../php/updateLike.php?action=${encodeURIComponent(action)}&id=${encodeURIComponent(postID)}`, {
        method: 'GET'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        console.log('Response from server:', data); // Check what response is received
    })
    .catch(error => {
        console.error('Fetch Error:', error);
    });

    fetch(`../php/updateLikesOnHistory.php?action=${encodeURIComponent(action)}&id=${encodeURIComponent(postID)}`, {
        method: 'GET'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        console.log('Response from server:', data); // Check what response is received
    })
    .catch(error => {
        console.error('Fetch Error:', error);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var postImage = document.getElementById('postImage');
    var postImageInner = document.getElementById('postImageInner');
    var gradient = document.getElementById('background');
    window.addEventListener('scroll', function() {
        console.log('scroll event fired'); // Check if this logs

        if (window.scrollY > 260) {
            postImage.classList.add('scrolled');
            postImageInner.classList.add('scrolled'); 
            gradient.classList.add('scrolled');  
        } else {
            postImage.classList.remove('scrolled');
            postImageInner.classList.remove('scrolled');
            gradient.classList.remove('scrolled');
        }
    });
});
</script>

<?php
$pageScript = ob_get_clean();

include '../layout/Layout.php';
?>