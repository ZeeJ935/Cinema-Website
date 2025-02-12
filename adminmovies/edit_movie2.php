<?php
$id = $_GET['id'];

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

// Get the movie record from the database
$stmt = $pdo->prepare("SELECT * FROM ComingSoon WHERE Movie_iD=?");
$stmt->execute([$id]);
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    die("Movie not found");
}

// Process the form submission
if(isset($_POST['submit'])){
    $field = $_POST['field'];
    $value = $_POST['value'];
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Delete the old image file if it exists
        if(file_exists($movie['ImageURL'])) {
            unlink($movie['ImageURL']);
        }
        
        // Upload the new image file
        $image = $_FILES['image']['name'];
        $target_dir = "/movietable/uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $imageUrl = $target_file;
    
        // Update the movie record in the database
        $stmt = $pdo->prepare("UPDATE ComingSoon SET ImageURL=? WHERE Movie_iD=?");
        $stmt->execute([$imageUrl, $id]);
    } else {
        // Update the movie record in the database
        $stmt = $pdo->prepare("UPDATE ComingSoon SET $field=? WHERE Movie_iD=?");
        $stmt->execute([$value, $id]);
        echo "Updated values: Field=$field, Value=$value, Movie_iD=$id";
    }
     
    function confirmUpdate() {
        return confirm("Are you sure you want to update this movie?");
    }
        
    
    header("Location: movietable.php");
        exit();
        
    
}

?>
<h1>Movie Edit form</h1>
<form method="post">
    <label for="field">Select field to edit:</label><br>
    <select id="field" name="field">
        <option value="MovieName">Movie Name</option>
        <option value="ReleaseDate">Release Date</option>
        <option value="Duration">Duration</option>
        <option value="Genre">Genre</option>
        <option value="Showtimes">Showtimes</option>
        <option value="AvgRating">Average Rating</option>
    </select><br>
    
    

    <label for="value">New value:</label><br>
    <input type="text" id="value" name="value" value="<?php echo $movie[$_POST['field']]; ?>"><br>
    <label for="image">New Image:</label><br>
    <input type="file" id="image" name="image"><br>

    <br>
    <input type="submit" name="submit" value="Update" onclick=" confirmUpdate();">
</form>
