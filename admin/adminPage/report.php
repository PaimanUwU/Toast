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
    <h1>Reports Made by Users</h1>
    <br>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">Post_Report_ID</th>
      <th scope="col">Post_Report_Reason</th>
      <th scope="col">Profile_ID</th>
      <th scope="col">Post_ID</th>
    </tr>
  </thead>
  <tbody>

  <?php

  $sql="SELECT * FROM Post_Report";
  $result=mysqli_query($connection,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $postReportID=$row['post_report_ID'];
        $reason=$row['post_report_reason'];
        $profileID=$row['profile_ID'];
        $postID=$row['post_ID'];

        echo ' <tr>
        <th scope="row">'.$postReportID.'</th>
        <td>'.$reason.'</td>
        <td>'.$profileID.'</td>
        <td>'.$postID.'</td>
        <td><button onclick="viewPost('.$postID.')">View Post</button>   <button onclick="deletePost('.$postID.')">Delete Post</button></td>
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