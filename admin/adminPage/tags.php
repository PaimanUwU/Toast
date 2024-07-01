<?php
$pageTitle = "Toast/Report";
$showTags = true;
$showNavBar = true;

$adminDirectory = "report";

include '../php/db_connection.php';


ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->


<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="div">
    <br>
    <h1>Tags</h1>
    <br>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">Tag ID</th>
      <th scope="col">Tag Category</th>
    </tr>
  </thead>
  <tbody>

  <?php

  $sql="SELECT * FROM tags";
  $result=mysqli_query($connection,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $tagID=$row['Tag_ID'];
        $tagCategory=$row['Tag_Category'];

        echo ' <tr>
        <th scope="row">'.$tagID.'</th>
        <td>'.$tagCategory.'</td>
        </tr> 
        ';
    }
    mysqli_close($connection);
  ?>



<?php
$pageContents = ob_get_clean();

ob_start();
?>
<!------------------------------------------Script------------------------------------------->
<script>
    function deletePost(postID) {
        if (confirm("Are you sure you want to delete this post?")) {
            window.location.href = "../php/adminDeletePost.php?id=" + postID;
        }
    }

    function viewPost(postID) {
        window.location.href = "view.php?page=viewPost&id=" + postID;
    }
</script>


<?php
$pageScript = ob_get_clean();
?>