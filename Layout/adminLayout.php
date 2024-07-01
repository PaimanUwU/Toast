<?php
ob_start();
?>
<div class="backbutton" >
    <ul>
        <li onclick="closecategory()"><svg xmlns="http://www.w3.org/2000/svg" height="34px" viewBox="0 -960 960 960" width="34px" fill="#404040"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg><a href="#"></a></li>
    </ul>
</div>
<div class="menubutton" >
    <ul>
        <li onclick="showcategory()"><svg xmlns="http://www.w3.org/2000/svg" height="34px" viewBox="0 -960 960 960" width="34px" fill="#404040"><path d="M144-264v-72h672v72H144Zm0-180v-72h672v72H144Zm0-180v-72h672v72H144Z"/></svg><a href="#"></a></li>
    </ul>
</div>
<?php
$menu = ob_get_clean();


ob_start();
?>

<div  id="tagsBar" class="tagsSidebar" style="left: -100vw; display: <?php echo $tagsVisibility; ?>;">
    <h2>Menu</h2>
    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Database Management</a></li>
        <li><a href="#">User Management</a></li>
        <li><a href="#">Post Management</a></li>
        <li><a href="#">Tag Management</a></li>
    </ul>
</div>  
<div  id="sideBar" class="sidebarContainer" onclick="closecategory()" ></div>
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

<?php
$sidebar = ob_get_clean();




if ($showSidebar) {
    $sidebarVisibility = "flex";
} else {
    $sidebarVisibility = "none";
    $menu = "";
    $sidebar = "";
}

if ($showNavBar) {
    $navBarVisibility = "flex";
} else {
    $navBarVisibility = "none";
}

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $loginButtonVisibility = "none";
} else {
    $loginButtonVisibility = "flex";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--Meta tags-->   
    <title><?php echo $pageTitle?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="..\assets\images\Toast Logo Simplified.png" type="image/gif" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!--css link-->
    <link rel="stylesheet" href="../css/adminDefault.css">
    <?php echo $pageCSS; ?>
</head>





<body>


    <?php echo $sidebar; ?>



    <div style="display: <?php echo $navBarVisibility; ?>" class="nav" id="navbar">
        <div class="headerleft">
            <div class="actionButtonContainer">
                <?php echo $menu; ?>
            </div>    
            <div class="logobutton">
                <ul>
                    <li><a href="view.php?page=dashboard"><img class="logo" src="..\assets\images\Toast Logo.png" alt="logo"></a></li>
                </ul>
            </div>
            <h3>Admin/<?php echo $adminDirectory?></h3>
        </div>
        <div class="logobuttonMiddle">
            <ul>
                <li><a href="view.php?page=dashboard"><img class="logo" src="..\assets\images\Toast Logo.png" alt="logo"></a></li>
            </ul>
        </div>
        <div class="headerright">
            <div class="actionButtonContainer"></div>
                <a href="#" onclick="logout()"><h3>Logout</h3></a>
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
    </div>








    <div class="contents">
        <div class="leftColumn">
            <div class="tags">
                <h2>Menu</h2>
                <ul>
                    <li><a href="view.php?page=dashboard">Dashboard</a></li>
                    <li><a href="view.php?page=database">Database Management</a></li>
                    <li><a href="view.php?page=users">User Management</a></li>
                    <li><a href="view.php?page=posts">Post Management</a></li>
                    <li><a href="view.php?page=tags">Tag Management</a></li>
                </ul>
            </div>
        </div>
        <div class="rightColumn">
            <!--popular-->
            <?php if ($showSidebar) {echo $pageContents;}?>
        </div>
        <?php if (!$showSidebar) {echo $pageContents;}?>


        
        <style>
            .leftColumn, .rightColumn, .tagsSidebar, .menubutton {
                display: <?php echo $tagsVisibility; ?>;
            } 
            
            @media (max-width: 975px) {
                .menubutton {
                    display: <?php echo $tagsVisibility; ?>;
                    align-items: center;
                }
                
                .actionButtonContainer {
                    display: flex;
                    align-items: center;
                }

                .leftColumn {
                    display: none;
                }
                .rightColumn {
                    width: 100%; /* Ensure right column takes the full width */
                    padding: 10px 20px; /* Adjust padding as needed */
                }
            }
        </style>
    </div>






    
    <div class="footer">
        
    </div>





    <?php echo $pageScript; ?>




</body>
</html>