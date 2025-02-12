<?php
include 'dbconnect.php';

$movie_id = mysqli_real_escape_string($con, $_POST['mid']);
$city_id = mysqli_real_escape_string($con, $_POST['cid']);
$day_id = mysqli_real_escape_string($con, $_POST['did']);

$query2 = "Select Distinct Time from Screen where Movie_iD = $movie_id And Location = '$city_id' And Date = '$day_id'";

$sql2 = mysqli_query($con, $query2);

$times = array();
while ($row2 = mysqli_fetch_array($sql2)) {
    $times[] = $row2['Time'];
}

echo json_encode($times);

?>
