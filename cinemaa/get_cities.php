<?php
include 'dbconnect.php';


$movie_id = mysqli_real_escape_string($con, $_POST['mid']);

$query = "SELECT DISTINCT Location FROM Movieadmin JOIN Screen ON Movieadmin.Movie_iD = Screen.Movie_iD WHERE Movieadmin.Movie_iD = $movie_id";

$sql = mysqli_query($con, $query);

$cities = array();
while ($row = mysqli_fetch_array($sql)) {
    $cities[] = $row['Location'];
}
echo json_encode($cities);
?>
