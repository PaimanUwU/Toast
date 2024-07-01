<?php
$pageTitle = "Toast/Report";
$showTags = true;
$showNavBar = true;

$adminDirectory = "users";

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
    <h1>List of Users</h1>
    <br>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">Profile ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>

  <?php

  $sql="SELECT * FROM profile";
  $result=mysqli_query($connection,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $id=$row['Profile_ID'];
        $name=$row['Profile_Name'];
        $email=$row['Profile_Email'];
        $desc=$row['Profile_Desc'];
        $image=$row['Profile_Image_Path'];

        echo ' <tr>
        <th scope="row">'.$id.'</th>
        <td>'.$name.'</td>
        <td>'.$email.'</td>
        <td>'.$desc.'</td>
        <td><image class="postImage" src='.$image.'></image></td>
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