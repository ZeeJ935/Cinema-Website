<?php
    // Get the movie ID to delete from the query string parameter
    $movie_id = $_GET['id'];
    
    // Connect to the database using PDO
    $host = "localhost";
    $dbname = "seatselect";
    $user = "root";
    $password = "";

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Prepare and execute the SQL query to delete the movie
    $stmt = $pdo->prepare("DELETE FROM Movieadmin WHERE Movie_iD = ?");
    $stmt->execute([$movie_id]);

    // Redirect back to the movie table page
    header('Location: movietable.php');
    exit;
?>
