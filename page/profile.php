<?php
$pageTitle = "Toast/Profile";
$showTags = false;
$showNavBar = true;
$currentPage = "profile.php";

include '../php/session_Maker.php';
require '../php/db_connection.php';

$query = "SELECT * FROM profile WHERE Profile_ID = $ProfileID";

$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $profileName = $row['Profile_Name'];
    $profileDesc = $row['Profile_Desc'];
    $profileImage = $row['Profile_Image_Path'];

} else {
    echo "Profile not found.";
}

$query = "SELECT COUNT(*) AS num_followees FROM Follower WHERE Followee_Profile_ID = $ProfileID";

$result = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $num_followees = $row['num_followees'];
}

ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" href="../css/profile.css">
<link rel="stylesheet" href="../assets/cards/card 2/card2Style.css">

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="profileHeader">
    <div class="profileHeaderTop">
        <h1>My Profile</h1>
        <div class="profileHeaderTopRight">
            <div class="profileHistoryButton"><a href="history.php"><h3>History</h3></a></div>
            <div class="profileSettingsButton"><a href="setting.php?msg=none"><h3>Account Settings</h3></a></div>
            <div class="logout"><a href="#" onclick="logout()"><h3>Logout</h3></a></div>
            <script>
                function logout() {
                    var confirmed = window.confirm("Are you sure you want to logout?");
                    if (confirmed) {
                        window.location.href = "../logout.php";
                    }
                }
            </script>
        </div>
    </div>
    <div class="profileHeaderMiddle">
        <div class="profileImage">
            <img src="<?php echo $profileImage ?>" alt="profile image">
        </div>
        <div class="profileHeaderMiddleRight">
            <div class="profileName">
                <h2><?php echo $profileName ?></h2>
            </div>
            <div class="profileDesc"><p><?php echo $profileDesc ?></p></div>
        </div>
    </div>
    <div class="profileHeaderBottom">
        <div class="profileFollower">
            <h3>Followers:</h3>
            <?php echo $num_followees ?>
        </div>
    </div>
</div>

<div class="sectionControlled">
    <div class="sectionControlledHeader">    
        <div class="headerContainer"><h2>Your Post</h2></div>
    </div>
    <div class="postCard2">
        <?php 
        $query = "SELECT * FROM post WHERE Profile_ID = $ProfileID";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $postID = $row['Post_ID'];
                $postTitle = $row['Post_Title'];
                $postDesc = $row['Post_Desc'];
                $postImage = $row['Post_Image_Path'];

                $queryProfile = "SELECT * FROM profile WHERE Profile_ID = $row[Profile_ID]";
                $resultProfile = mysqli_query($connection, $queryProfile);

                if ($resultProfile && mysqli_num_rows($resultProfile) > 0) {
                    $rowProfile = mysqli_fetch_assoc($resultProfile);
                    $profileName = $rowProfile['Profile_Name'];
                    $profileImage = $rowProfile['Profile_Image_Path'];
                } 
        ?>
        <div class="card2">
            <a href="../page/post.php?id=<?php echo $postID; ?>" id="card2Container<?php echo $postID; ?>" class="card2Container">
                <style>
                    #card2Container<?php echo $postID; ?>{
                        background-image: url(<?php echo $postImage; ?>);
                    }
                </style>
                <div class="card2OuterControlled">
                    <div class="card2PostDetailContainer">
                        <div class="card2PostDetail">
                            <div class="card2ProfileDetail">
                                <img class="card2ProfileImage" src="<?php echo $profileImage; ?>"  alt="">
                                <h3><?php echo $profileName; ?></h3>
                            </div>
                            <div>
                                <h1><?php echo $postTitle; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php 
            }
        }
        ?>
    </div>
</div>

<?php
mysqli_close($connection);

$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script-------------------------------------------->


<?php
$pageScript = ob_get_clean();

include '../layout/Layout.php';
?>