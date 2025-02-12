<?php
// Get the user and movie IDs to delete from the query string parameters
$rating_id = $_GET['rating_iD'];

// Connect to the database using MySQLi
include 'dbconnect.php';

// Prepare and execute the SQL query to delete the review
$sql = "DELETE FROM user_review WHERE rating_iD = $rating_id";
$stmt = mysqli_query($con, $sql);


// Check if any row was affected by the delete operation
if (mysqli_query($con, $sql)) {
    echo "Review deleted successfully";
} else {
    echo "Review not found";
}


?>
