<?php
include 'dbconnect.php';


$movie_id = mysqli_real_escape_string($con, $_POST['mid']);
$city_id = mysqli_real_escape_string($con, $_POST['cid']);

$query1 = "Select Distinct Date from screen Where Movie_iD = $movie_id And Location = '$city_id' AND Date >= CURDATE();";

$sql1 = mysqli_query($con, $query1);    
$days = array();
while ($row1 = mysqli_fetch_array($sql1)) {
    $days[] = $row1['Date'];
}

echo json_encode($days);

?>
