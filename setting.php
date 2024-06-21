<!DOCTYPE html>
<html lang="en">

<head>
    <!--Meta tags-->   
    <title>Toast/Setting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets\images\Toast Logo Simplified.png" type="image/gif" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!--css link-->
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/setting.css">

    <!--session-->
    <? include 'php/session_Maker.php'; ?>
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
            // else if when the user press escape key then it will close the search
            else if (event.key === 'Escape') {
                closeSearch();
            }
        });
    </script>

<!---------------------------------------------------------- sidebar ------------------------------------------------------------------->

<!-----------------------------------------------------------Nav Bar-------------------------------------------------------------------->
    <div class="nav" id="navbar">
        <div class="headerleft">
            <div class="actionButtonContainer">
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
    
    
    
    
    
    
<!---------------------------------------------------------the contents----------------------------------------------------------------->
    <div class="contents">  
        
    </div>

<!----------------------------------------------------------------script---------------------------------------------------------------->
    <script>
        var navbar = document.getElementById('navbar');
        var sidebar = document.getElementById('sidebar');
        console.log(navbar, sidebar); // Check if elements are correctly selected

        window.addEventListener('scroll', function() {
            console.log('scroll event fired', window.scrollY); // Check if this logs
            if (window.scrollY > 0) {
                navbar.classList.add('scrolled');
                sidebar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
                sidebar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>