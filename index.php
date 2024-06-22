<?php
 $pageTitle = "Dashboard";

 ob_start();

 //include
 //select bla bla blae
 
 ?>


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
   



    



        <div class="rightColumn">
<!---------------------------------------------------------the contents----------------------------------------------------------------->
            <!--popular-->
            <div class="sectionControlled">
                <div class="sectionControlledHeader">
                    <div class="headerContainer"><h2>Popular Post</h2></div>
                    <div class="buttonContainer">
                        <a href="#" class="buttons" id="scroll-left-button"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404040"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg></a>
                        <a href="#" class="buttons" id="scroll-right-button"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404040"><path d="M522-480 333-669l51-51 240 240-240 240-51-51 189-189Z"/></svg></a>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const scrollContainer = document.getElementById("popular-card-container");
                            const scrollLeftButton = document.getElementById("scroll-left-button");
                            const scrollRightButton = document.getElementById("scroll-right-button");

                            scrollLeftButton.addEventListener("click", function() {
                                scrollContainer.scrollBy({
                                    top: 0,
                                    left: -400, // Adjust this value to scroll more or less
                                    behavior: 'smooth'
                                });
                            });

                            scrollRightButton.addEventListener("click", function() {
                                scrollContainer.scrollBy({
                                    top: 0,
                                    left: 400, // Adjust this value to scroll more or less
                                    behavior: 'smooth'
                                });
                            });
                        });
                    </script>
                </div>
                <div class="popularCard1" id="popular-card-container">
                    <?php include 'php/card1_Display.php'; ?>
                </div>
            </div>
            <!--discover-->
            <div class="sectionControlled">
                <div class="sectionControlledHeader">    
                    <div class="headerContainer"><h2>For You</h2></div>
                </div>
                <div class="postCard2">
                    <?php include 'php/card2_Display.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    $content = ob_clean();

    ob_start();

?>
<!----------------------------------------------------------------script---------------------------------------------------------------->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var navbar = document.getElementById('navbar');
            var sidebar = document.getElementById('sidebar');
            window.addEventListener('scroll', function() {
                console.log('scroll event fired'); // Check if this logs
                if (window.scrollY > 0) {
                    navbar.classList.add('scrolled');
                    sidebar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                    sidebar.classList.remove('scrolled');
                }
            });
        });
    </script>

<?php
$scripts = ob_clean();

?>


<?php include 'layout.php'; ?>