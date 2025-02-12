<?php
$id = $_GET['Show_iD'];
var_dump($id);
// Connect to the database using PDO
$host = "localhost";
$dbname = "seatselect";
$user = "root";
$password = "";
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
if ($pdo) {
    echo "Connected to the database successfully!";
} else {
    echo "Failed to connect to the database.";
}

// Get the movie record from the database
$stmt = $pdo->prepare("SELECT * FROM Screen WHERE Show_iD=?");
$stmt->execute([$id]);
$show = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$show) {
    die("Show not found");
}

// Process the form submission
if(isset($_POST['submit'])){
    $field = $_POST['field'];
    $value = $_POST['value'];
    
    // Check if the field is valid
    $validFields = ['Screen_iD', 'Movie_iD', 'Location', 'Date', 'Time'];
    if (!in_array($field, $validFields)) {
        die("Invalid field");
    }

    // Update the movie record in the database
    $stmt = $pdo->prepare("UPDATE Screen SET $field=? WHERE Show_iD=?");
    $stmt->execute([$value, $id]);
}
?>
<h1>Show Edit form</h1>
<form method="post">
    <label for="field">Select field to edit:</label><br>
    <select id="field" name="field">
        <option value="Screen_iD">Screen No</option>
        <option value="Movie_iD">Movie ID</option>
        <option value="Location">Location</option>
        <option value="Date">Day</option>
        <option value="Time">Time</option>
    </select><br>

    <label for="value">New value:</label><br>
    <input type="text" id="value" name="value" value="<?php echo isset($_POST['field']) ? $show[$_POST['field']] : ''; ?>"><br>

    <br>
    <input type="submit" name="submit" value="Update" onclick="return confirmUpdate();">
</form>

<script>
function confirmUpdate() {
    return confirm("Are you sure you want to update the record?");
}
</script>
