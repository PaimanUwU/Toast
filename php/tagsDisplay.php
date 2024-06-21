<?php
require 'db_connection.php';


// Query to select all tags from the TAGS table
$query = "SELECT * FROM TAGS";

// Execute the query
$result = mysqli_query($connection, $query);

$rows = [];

$isEmpty = mysql_num_rows($result) > 0 ? false : true;

if(!$isEmpty){
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
}

?>


<?php if($isEmpty) : ?>

<div>No Tags Found</div>
<?php else : ?>
    <?php foreach($rows as $row): ?>
        <li>
            <a href="corresponding_to_the_tags.php?tag_id=<?= $row['Tag_ID'] ?>" 
            class="tagItem"> <?= $row['Tag_Category'] ?>
            </a>
        </li>
    <?php endforeach ?>
<?php endif ?>


<?php 
    mysqli_close($connection);

?>