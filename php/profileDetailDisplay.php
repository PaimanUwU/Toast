<?php 
include 'db_connection.php';

$query = "SELECT * FROM profile WHERE Profile_ID = $ProfileID";

$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $profileName = $row['Profile_Name'];
    $profileDesc = $row['Profile_Desc'];
    $profileImage = $row['Profile_Image_ID'];

} else {
    echo "Profile not found.";
}

$query = "SELECT COUNT(*) AS num_followees FROM Follower WHERE Followee_Profile_ID = $ProfileID";

$result = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $num_followees = $row['num_followees'];
}/*  */

mysqli_close($connection);
?>

<div class="profileHeaderTop">
    <h1>My Profile</h1>
    <div class="profileHeaderTopRight">
        <div class="profileHistoryButton"><a href="history.php"><h3>History</h3></a></div>
        <div class="profileSettingsButton"><a href="setting.php"><h3>Account Settings</h3></a></div>
        <div class="logout"><a href="#" onclick="logout()"><h3>Logout</h3></a></div>
        <script>
            function logout() {
                var confirmed = window.confirm("Are you sure you want to logout?");
                if (confirmed) {
                    window.location.href = "../page/logout.php";
                }
            }
        </script>
    </div>
</div>
<div class="profileHeaderMiddle">
    <div class="profileImage">
        <img src="../data/profileImages/GUID-<?php echo $profileImage ?>.png" alt="profile image">
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