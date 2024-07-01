<?php
$pageTitle = "Toast/Posts";
$showTags = true;
$showNavBar = true;

$adminDirectory = "posts";

include '../php/db_connection.php';


ob_start();

?>
<!--------------------------------------------CSS-------------------------------------------->
<style>
    .postImage {
        max-width: 4em;
        max-height: 4em;
        border-radius: 1em;
        object-fit: cover;
    }
</style>

<?php
$pageCSS = ob_get_clean();

ob_start();
?>
<!------------------------------------------Content------------------------------------------>
<div class="div">
    <br>
    <h1>POST MANAGEMENT</h1>
    <br>
    <div class="container">
        <a href="view.php?page=report"><button>View Reports</button></a>
    </div>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">Post ID</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Content</th>
      <th scope="col">Likes</th>
      <th scope="col">Image</th>
      <th scope="col">Profile ID</th>
      <th scope="col">Post Tag ID</th>
    </tr>
  </thead>
  <tbody>

  <?php

  $sql="SELECT * FROM Post";
  $result=mysqli_query($connection,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $id=$row['Post_ID'];
        $title=$row['Post_Title'];
        $desc=$row['Post_Desc'];
        $content=$row['Post_Content'];
        $likes=$row['Post_Likes'];
        $image=$row['Post_Image_Path'];
        $profile_id=$row['Profile_ID'];
        $tag_id=$row['Post_Tag_ID'];

        echo ' <tr>
        <th scope="row">'.$id.'</th>
        <td>'.$title.'</td>
        <td>'.$desc.'</td>
        <td>'.$content.'</td>
        <td>'.$likes.'</td>
        <td><image class="postImage" src='.$image.'></image></td>
        <td>'.$profile_id.'</td>
        <td>'.$tag_id.'</td>
        </tr> ';
    }
mysqli_close($connection);

  ?>



<?php
$pageContents = ob_get_clean();

ob_start();
?>

<!------------------------------------------Script------------------------------------------->


<?php
$pageScript = ob_get_clean();
?>