<?php
// Get the user and movie IDs to delete from the query string parameters
$screen_id = $_GET['Screen_iD'];

// Connect to the database using PDO
$host = "localhost";
$dbname = "seatselect";
$user = "root";
$password = "";
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Prepare and execute the SQL query to delete the review
$stmt = $pdo->prepare("DELETE FROM Screenexist WHERE Screen_iD = ?");
$stmt->execute([$screen_id]);

// Check if any row was affected by the delete operation
if ($stmt->rowCount() > 0) {
    echo "Screen deleted successfully";
} else {
    echo "Screen not found";
}

// Close the database connection
$pdo = null;
?>
