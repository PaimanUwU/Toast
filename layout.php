<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="assets/cards/card 1/card1Style.css">
    <link rel="stylesheet" href="assets/cards/card 2/card2Style.css">

    <title><?php echo $pageTitle; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <?php if (isset($styles)) echo $styles; ?>
</head>
<body>

<div class="searchBoxControlled d-none">
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
            <div class="searchContainer" onclick="closeSearch()">

            </div> 

            <!-- Sidebar -->
            <div id="sidebar" class="tagsSidebar" style="left: -100vw;">
                <h2>Tags</h2>
                <ul>
                    <?php include 'php/tagsDisplay.php'; ?>
                </ul>
             </div>  


    <?php if (isset($content)) echo $content; ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>



    <script>
        
    </script>
    <?php if (isset($scripts)) echo $scripts; ?>
</body>
</html>
