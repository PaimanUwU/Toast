<?php
$pageTitle = "Toast/History";
$showTags = true;
$showNavBar = true;
$currentPage = "history";

include '../php/session_Maker.php';

ob_start();
?>
<!--------------------------------------------CSS-------------------------------------------->
<link rel="stylesheet" href="../css/history.css">

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="sectionControlled">
    <div class="headerContainer"><h2>History</h2></div>
        <div class="result">
            <ul>
            <?php 
            require '../php/db_connection.php';
            
            // query and joint tables Post_History, Post and Profile
            $query =   "SELECT 
                        ph.Post_History_ID,
                        ph.Post_History_Date,
                        ph.Post_ID,
                        ph.Profile_ID,
                        ph.Post_isLike,
                        p.Post_Title,
                        p.Post_Desc,
                        p.Post_Likes,
                        p.Post_Image_ID,
                        pr.Profile_Name,
                        pr.Profile_Image_ID
                        FROM 
                            post_history ph
                        JOIN 
                            post p ON ph.Post_ID = p.Post_ID
                        JOIN 
                            profile pr ON ph.Profile_ID = pr.Profile_ID
                        WHERE 
                            ph.Profile_ID = $ProfileID";
            
            $result = mysqli_query($connection, $query);
            
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // row from query result
            
                    $PostHistoryID = $row['Post_History_ID'];
                    $PostHistoryDate = $row['Post_History_Date'];
                    $PostID = $row['Post_ID'];
                    $PostProfileID = $row['Profile_ID'];
                    $PostIsLike = $row['Post_isLike'];
                    $PostTitle = $row['Post_Title'];
                    $PostDesc = $row['Post_Desc'];
                    $PostLikes = $row['Post_Likes'];
                    $PostImageID = $row['Post_Image_ID'];
                    $ProfileName = $row['Profile_Name'];
                    $ProfileImageID = $row['Profile_Image_ID'];
            
            ?>
                <a href="post.php?id=<?php echo $PostID; ?>">
                    <div class="resultContainer">
                        <img src="../data/postImages/GPID-<?php echo $PostImageID; ?>.png" alt="">
                        <div class="resultContent">
                            <div class="resultTitle">
                                <h1><?php echo $PostTitle; ?></h1>
                            </div>
                            <div class="resultDetail">
                                <p><?php echo $PostDesc; ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php
                }
            }
            mysqli_close($connection);
            
            ?>
            </ul>
        </div>
    </div>
</div>

<?php
$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script---------------------------------------------->


<?php
$pageScript = ob_get_clean();

include '../Layout/Layout.php';
?>