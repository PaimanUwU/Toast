<?php
include 'php/session_Maker.php';
require 'php/db_connection.php';

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

        // get is logged in
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
            $likeButton = "href=login.php"; 
            $commentForm = "style=display:none";
        }
    } 

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--Meta tags-->   
    <title>Toast/<?php echo $postTitle?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets\images\Toast Logo Simplified.png" type="image/gif" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!--css link-->
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/post.css">
    <link rel="stylesheet" href="assets/cards/comment card/comment.css">
    
    <!--PHP-->
    <!--get post id-->
    <?php $id=$_GET['id']; ?>
</head>





<body>
<!-------------------------------------------------------Search functions--------------------------------------------------------------->
    <div id="searchModule"></div>
    <script>
        function openSearch() {
            const searchBoxHtml = `
            <div class="searchBoxControlled">
                <div class="searchBoxNav">
                    <ul>
                        <li><a href="#" onclick="closeSearch()"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404040"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg><h3>close search</h3></a></li>
                    </ul>
                </div>
                <div class="searchBoxContainer">
                    <form id="searchForm" action="search.php" method="GET">
                        <input id="bigSearchInputBox" type="text" name="searchInput" placeholder="search...">
                    </form>
                </div>
                <div class="searchBoxSaperator">
                    <h3>Results</h3>
                    <hr width="100%" color="#404040" size="1px" border-radius="5px" />
                </div>
                <div class="searchResult">
                    <!--results goes here, it will display dynamically -->
                </div>
            </div>    
            <div class="searchContainer" onclick="closeSearch()"></div> 
            `;
            
            // Select the search background container and insert the search box HTML after it
            const searchBackground = document.querySelector('#searchModule');
            searchBackground.insertAdjacentHTML('afterend', searchBoxHtml);

            // Select elements after they have been inserted into the DOM
            const resultsContainer = document.querySelector('.searchResult');
            const searchModule = document.querySelector('.searchBoxControlled');

            // Show the search box and background
            searchModule.style.display = 'flex';
            searchBackground.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';

            // Focus on the search input field
            const inputBox = document.getElementById('bigSearchInputBox');
            inputBox.focus();

            // Add event listeners for input and keydown events
            inputBox.addEventListener('input', updateSearchResults);
            inputBox.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    submitSearchForm();
                }
            });
        }

        function fetchResults(searchInput) {
            return new Promise((resolve, reject) => {
                fetch(`php/search.php?input=${encodeURIComponent(searchInput)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(data => resolve(data))
                    .catch(error => reject(error));
            });
        }

        function updateSearchResults() {
            const inputBox = document.getElementById('bigSearchInputBox');
            const resultsContainer = document.querySelector('.searchResult');
            const query = inputBox.value.trim();
            if (query === '') {
                resultsContainer.innerHTML = '';
                return;
            }
            fetchResults(query)
                .then(response => {
                    resultsContainer.innerHTML = response;
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                });
        }

        function submitSearchForm() {
            const inputBox = document.getElementById('bigSearchInputBox');
            const query = inputBox.value.trim();
            if (query === '') {
                const resultsContainer = document.querySelector('.searchResult');
                resultsContainer.innerHTML = '';
                return;
            }

            const form = document.createElement('form');
            form.action = 'result.php';
            form.method = 'POST';

            const input = document.createElement('input');
            input.name = 'searchQuery';
            input.value = query;

            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        }

        function closeSearch() {
            const searchModule = document.querySelector('.searchBoxControlled');
            const searchBackground = document.querySelector('.searchContainer');
            if (searchModule) {
                searchModule.remove();
                searchBackground.remove();
            }
            searchBackground.style.display = 'none';
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === '/' && document.activeElement !== document.getElementById('bigSearchInputBox')) {
                event.preventDefault();
                openSearch();
            }
            else if (event.key === 'Escape') {
                closeSearch();
            }
        });
    </script>

<!---------------------------------------------------------- sidebar ------------------------------------------------------------------->
    <div id="sidebar" class="tagsSidebar" style="left: -100vw;">
        <h2>Tags</h2>
        <ul>
            <?php include 'php/tagsDisplay.php'; ?>
        </ul>
    </div>  
    <div class="sidebarContainer" onclick="closecategory()"></div>
    <script>
        function showcategory() {
            const openbutton = document.querySelector('.menubutton');
            const closebutton = document.querySelector('.backbutton');
            const background = document.querySelector('.sidebarContainer');

            closebutton.style.display = 'flex';
            openbutton.style.display = 'none';
            background.style.display = 'flex';

            const sidebar = document.querySelector('.tagsSidebar');
            sidebar.style.left = '0'; // Move sidebar to the left (open position)
        }

        function closecategory() {
            const openbutton = document.querySelector('.menubutton');
            const closebutton = document.querySelector('.backbutton');
            const background = document.querySelector('.sidebarContainer');

            closebutton.style.display = 'none';
            openbutton.style.display = 'flex';  
            background.style.display = 'none';
            
            const sidebar = document.querySelector('.tagsSidebar');
            sidebar.style.left = '-100vw'; // Move sidebar to the left beyond viewport (closed position)
        }
        window.addEventListener('DOMContentLoaded', function() {
            const sidebarContainer = document.querySelector('.sidebarContainer');
            const openbutton = document.querySelector('.menubutton');
            const closebutton = document.querySelector('.backbutton');
            const background = document.querySelector('.sidebarContainer');

            function toggleSidebar() {
                const viewportWidth = window.innerWidth;
                if (viewportWidth > 976) {
                    sidebarContainer.style.display = 'none';

                    closebutton.style.display = 'none';
                    openbutton.style.display = 'flex';  
                    background.style.display = 'none';
                    
                    const sidebar = document.querySelector('.tagsSidebar');
                    sidebar.style.left = '-100vw'; // Move sidebar to the left beyond viewport (closed position)
                        }
            }

            // Initial call to toggleSidebar to set the initial state based on viewport width
            toggleSidebar();

            // Listen for window resize events and re-evaluate the sidebar visibility
            window.addEventListener('resize', toggleSidebar);
        });
    </script>



<!-----------------------------------------------------------Nav Bar-------------------------------------------------------------------->
    <div class="nav" id="navbar">
        <div class="headerleft">
            <div class="actionButtonContainer">
                <div class="backbutton">
                    <ul>
                        <li onclick="closecategory()"><svg xmlns="http://www.w3.org/2000/svg" height="34px" viewBox="0 -960 960 960" width="34px" fill="#404040"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg><a href="#"></a></li>
                    </ul>
                </div>
                <div class="menubutton">
                    <ul>
                        <li onclick="showcategory()"><svg xmlns="http://www.w3.org/2000/svg" height="34px" viewBox="0 -960 960 960" width="34px" fill="#404040"><path d="M144-264v-72h672v72H144Zm0-180v-72h672v72H144Zm0-180v-72h672v72H144Z"/></svg><a href="#"></a></li>
                    </ul>
                </div>
                <div class="createButton">
                    <ul>
                        <li><a href="create.php"><svg xmlns="http://www.w3.org/2000/svg" height="34px" viewBox="0 -960 960 960" width="34px" fill="#404040"><path d="M447-293h67v-153h153v-67H514v-154h-67v154H293v67h154v153Zm33.28 187q-77.19 0-145.35-29.26-68.15-29.27-119.29-80.5Q164.5-267 135.25-335.05 106-403.09 106-480.46q0-77.45 29.26-145.11 29.27-67.65 80.5-118.79Q267-795.5 335.05-824.75 403.09-854 480.46-854q77.45 0 145.11 29.26 67.65 29.27 118.79 80.5Q795.5-693 824.75-625.19T854-480.28q0 77.19-29.26 145.35-29.27 68.15-80.5 119.29Q693-164.5 625.19-135.25T480.28-106Zm-.28-67q127.5 0 217.25-89.75T787-480q0-127.5-89.75-217.25T480-787q-127.5 0-217.25 89.75T173-480q0 127.5 89.75 217.25T480-173Zm0-307Z"/></svg></a></li>
                    </ul>
                </div>
                <div class="historyButton">
                    <ul>
                        <li><a href="history.php"><svg xmlns="http://www.w3.org/2000/svg" height="34px" viewBox="0 -960 960 960" width="34px" fill="#404040"><path d="M479.39-153Q343-153 247.75-248.5T152.5-481h67q0 107.5 76.26 184.25Q372.01-220 479.35-220 586.5-220 663-296.5t76.5-183.73q0-107.23-76.63-183.5Q586.25-740 478.5-740q-60.17 0-111.13 24.85Q316.41-690.3 281.5-648h104v67h-229v-229h67v129q45-58 110.75-92t144.4-34q67.85 0 127.69 25.95t104.15 70.12q44.31 44.16 70.16 103.55Q806.5-548 806.5-480t-25.85 127.38q-25.85 59.39-70.12 103.65-44.26 44.27-103.68 70.12Q547.43-153 479.39-153Zm99.11-196-131-131.87V-667h67v158l112 112-48 48Z"/></svg></a></li> 
                    <ul>
                </div>
            </div>    
            <div class="logobutton">
                <ul>
                    <li><a href="index.php"><img class="logo" src="assets\images\Toast Logo.png" alt="logo"></a></li>
                </ul>
            </div>
            <div class="redirectText">
                <ul>
                    <li><a class="createButton" href="create.php"><svg xmlns="http://www.w3.org/2000/svg" height="34px" viewBox="0 -960 960 960" width="34px" fill="#404040"><path d="M447-293h67v-153h153v-67H514v-154h-67v154H293v67h154v153Zm33.28 187q-77.19 0-145.35-29.26-68.15-29.27-119.29-80.5Q164.5-267 135.25-335.05 106-403.09 106-480.46q0-77.45 29.26-145.11 29.27-67.65 80.5-118.79Q267-795.5 335.05-824.75 403.09-854 480.46-854q77.45 0 145.11 29.26 67.65 29.27 118.79 80.5Q795.5-693 824.75-625.19T854-480.28q0 77.19-29.26 145.35-29.27 68.15-80.5 119.29Q693-164.5 625.19-135.25T480.28-106Zm-.28-67q127.5 0 217.25-89.75T787-480q0-127.5-89.75-217.25T480-787q-127.5 0-217.25 89.75T173-480q0 127.5 89.75 217.25T480-173Zm0-307Z"/></svg><h3> Create Post</h3></a></li>
                    <li><a class="historyButton" href="history.php"><svg xmlns="http://www.w3.org/2000/svg" height="34px" viewBox="0 -960 960 960" width="34px" fill="#404040"><path d="M479.39-153Q343-153 247.75-248.5T152.5-481h67q0 107.5 76.26 184.25Q372.01-220 479.35-220 586.5-220 663-296.5t76.5-183.73q0-107.23-76.63-183.5Q586.25-740 478.5-740q-60.17 0-111.13 24.85Q316.41-690.3 281.5-648h104v67h-229v-229h67v129q45-58 110.75-92t144.4-34q67.85 0 127.69 25.95t104.15 70.12q44.31 44.16 70.16 103.55Q806.5-548 806.5-480t-25.85 127.38q-25.85 59.39-70.12 103.65-44.26 44.27-103.68 70.12Q547.43-153 479.39-153Zm99.11-196-131-131.87V-667h67v158l112 112-48 48Z"/></svg><h3> History</h3></a></li> 

                </ul>
            </div>
        </div>
        <div class="logobuttonMiddle">
                <ul>
                    <li><a href="index.php"><img class="logo" src="assets\images\Toast Logo.png" alt="logo"></a></li>
                </ul>
            </div>
        <div class="headerright">
            <div class="searchTogglebutton">
                <ul>
                    <li><a href="#" onclick="openSearch()"><svg xmlns="http://www.w3.org/2000/svg" height="34" viewBox="0 -960 960 960" width="34" fill="#404040"><path d="M765-144 526-383q-30 22-65.79 34.5-35.79 12.5-76.18 12.5Q284-336 214-406t-70-170q0-100 70-170t170-70q100 0 170 70t70 170.03q0 40.39-12.5 76.18Q599-464 577-434l239 239-51 51ZM384-408q70 0 119-49t49-119q0-70-49-119t-119-49q-70 0-119 49t-49 119q0 70 49 119t119 49Z"/></svg></a></li>
                </ul>
            </div>
            <div class="accountbutton">
                <ul>
                    <li><a href="redirectProfile.php"><svg xmlns="http://www.w3.org/2000/svg" height="34" viewBox="0 -960 960 960" width="34" fill="#404040"><path d="M237-285q54-38 115.5-56.5T480-360q66 0 127.5 18.5T723-285q35-41 52-91t17-104q0-129.67-91.23-220.84-91.23-91.16-221-91.16Q350-792 259-700.84 168-609.67 168-480q0 54 17 104t52 91Zm243-123q-60 0-102-42t-42-102q0-60 42-102t102-42q60 0 102 42t42 102q0 60-42 102t-102 42Zm.28 312Q401-96 331-126t-122.5-82.5Q156-261 126-330.96t-30-149.5Q96-560 126-629.5q30-69.5 82.5-122T330.96-834q69.96-30 149.5-30t149.04 30q69.5 30 122 82.5T834-629.28q30 69.73 30 149Q864-401 834-331t-82.5 122.5Q699-156 629.28-126q-69.73 30-149 30Zm-.28-72q52 0 100-16.5t90-48.5q-43-27-91-41t-99-14q-51 0-99.5 13.5T290-233q42 32 90 48.5T480-168Zm0-312q30 0 51-21t21-51q0-30-21-51t-51-21q-30 0-51 21t-21 51q0 30 21 51t51 21Zm0-72Zm0 319Z"/></svg></a></li>
                </ul>
            </div>
        </div>
    </div>




    <div class="contents">
        <div class="leftColumn">
            <div class="tags">
                <h2>Tags</h2>
                <ul>
                    <?php include 'php/tagsDisplay.php'; ?>
                </ul>
            </div>
        </div>



        <div class="rightColumn">
<!---------------------------------------------------------the contents----------------------------------------------------------------->     
            <div class="postContainer">
                <img src="data/postImages/GPID-<?php echo $postImage; ?>.png" alt="post image" class="postImage" id="postImage">
                <div class="postImageGradient" id="background"></div>

                <img src="data/postImages/GPID-<?php echo $postImage; ?>.png" alt="post image" class="postImageInner" id="postImageInner">

                <div class="postContainerControlled">
                    <!--TODO: add like button, dislike button, report button.-->
                    <div class="postDetail">
                        <div class="postControl">
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
                    <a class="postProfile" href="profileVisit.php?id=<?php echo $postProfileID; ?>'">
                        <!--TODO: add follow button-->
                        <img src="data/profileImages/GUID-<?php echo $profileImage; ?>.png" alt="profile image" class="postProfileImage">
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
                        <form <?php echo $commentForm; ?> action="php/addCommentPost.php?id=<?php echo $postID; ?>&profileID=<?php echo $ProfileID; ?>" method="POST" class="commentForm">
                            <input class="commentInput" type="text" name="comment" placeholder="Write a comment...">
                            <input class="commentSubmitButton" type="submit" name="submit" value="Submit">
                        </form>
                        <?php include 'php/comment_Display.php'; ?>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>

<!----------------------------------------------------------------script---------------------------------------------------------------->
    <script>
        var likeButton = document.getElementById("postLike");
        var isLiked = <?php echo $isLike; ?>;

        if (isLiked === 1) {
            likeButton.classList.add('clicked');
        } else {
            likeButton.classList.remove('clicked');
        }
        
        function like() {
            var  likeCountElement = document.getElementById('postLikeCount');
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

        function updateLikes(action) {
            var postID = <?php echo json_encode($postID); ?>;
            fetch(`php/updateLike.php?action=${encodeURIComponent(action)}&id=${encodeURIComponent(postID)}`, {
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

            fetch(`php/updateLikesOnHistory.php?action=${encodeURIComponent(action)}&id=${encodeURIComponent(postID)}`, {
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
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var navbar = document.getElementById('navbar');
            var sidebar = document.getElementById('sidebar');
            var background = document.getElementById('background');
            var postImage = document.getElementById('postImage');
            var postImageInner = document.getElementById('postImageInner');

            window.addEventListener('scroll', function() {
                console.log('scroll event fired'); // Check if this logs
                if (window.scrollY > 0) {
                    navbar.classList.add('scrolled');
                    sidebar.classList.add('scrolled');
                    background.classList.add('scrolled');
                    postImage.classList.add('scrolled');
                    postImageInner.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                    sidebar.classList.remove('scrolled');
                    background.classList.remove('scrolled');
                    postImage.classList.remove('scrolled');
                    postImageInner.classList.remove('scrolled');
                }
            });
        });
    </script>
</body>
</html>