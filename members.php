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
<head>
    <h2>CDCS110 (DIPLOMA IN COMPUTER SCIENCE)</h2>
    <h2>CSC264 GROUP PROJECT JCDCS1104B</h2>

</head>
<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Picture</th>
      <th scope="col">Student Number</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>ADI AIMAN PUTRA</td>
      <td><img class="postImage" src="assets/membersImage/adi aiman.png" width="100" height="100"></td>
      <td>2022897414</td>
      <td>2022897414@student.uitm.edu.my</td>

    </tr>
    <tr>
      <th scope="row">2</th>
      <td>NURUL UMAIRAH SUHANA BINTI KHALILUDDIN</td>
      <td><img class="postImage" src="assets/membersImage/umairah suhana.png" width="100" height="100"></td>
      <td>2022825646</td>
      <td>2022825646@student.uitm.edu.my</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>FARAH IZZATI BINTI ZAINALABIDDIN</td>
      <td><img class="postImage" src="assets/membersImage/farah izzati.png" width="100" height="100"></td>
      <td>2022600256</td>
      <td>2022600256@student.uitm.edu.my</td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td>MOHAMMED ZUHAYR BIN MOHD ZAKI</td>
      <td><img class="postImage" src="assets/membersImage/zuha.png" width="100" height="100"></td>
      <td>2022808754</td>
      <td>2022808754@student.uitm.edu.my</td>
    </tr>
  </tbody>
</table>