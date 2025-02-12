<?php
$id = $_GET['Screen_iD'];

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
$stmt = $pdo->prepare("SELECT * FROM Screenexist WHERE Screen_iD=?");
$stmt->execute([$id]);
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    die("Movie not found");
}

// Process the form submission
if(isset($_POST['submit'])){
    $field = $_POST['field'];
    $value = $_POST['value'];
   
        // Update the movie record in the database
        $stmt = $pdo->prepare("UPDATE Screenexist SET $field=? WHERE Screen_iD=?");
        $stmt->execute([$value, $id]);
    
    
        
    
    header("Location: movietable.php");
        exit();
        
    
}

?>
<h1>Movie Edit form</h1>
<form method="post">
    <label for="field">Select field to edit:</label><br>
    <select id="field" name="field">

        <option value="MovieName">Screen Name</option>
       
    </select><br>
    
    

    <label for="value">New value:</label><br>
    <input type="text" id="value" name="value" value="<?php echo $movie[$_POST['field']]; ?>"><br>


    <br>
    <input type="submit" name="submit" value="Update" onclick=" confirmUpdate();">
</form>
