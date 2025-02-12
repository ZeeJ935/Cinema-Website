<?php
include 'dbconnect.php';
$movie_name = $_GET['movie_name'] ?? '';

$sql = "SELECT Movie_iD, MovieName FROM MovieAdmin WHERE MovieName LIKE CONCAT('%', ?, '%')";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $movie_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="search-result-item" data-href="userreview2.php?Movie_iD=' . $row['Movie_iD'] . '">' . htmlspecialchars($row['MovieName']) . '</div>';
    }
} else {
    echo '<div>No results found.</div>';
}
?>
