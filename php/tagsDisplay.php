<?php
require 'db_connection.php';


// Query to select all tags from the TAGS table
$query = "SELECT * FROM TAGS";

// Execute the query
$result = mysqli_query($connection, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Output the HTML markup for the tags

    // Loop through each row to display the tags
    while ($row = mysqli_fetch_assoc($result)) {
        $tagID = $row['Tag_ID'];
        $tagName = $row['Tag_Category'];
        // Generate HTML markup for each tag
        echo '<li><a href="corresponding_to_the_tags.php?tag_id=' . $tagID . '" class="tagItem">' . $tagName . '</a></li>';
    }
} else {
    // If no tags are found, display a message
    echo 'No tags found.';
}

// Close the database connection
mysqli_close($connection);
?>
