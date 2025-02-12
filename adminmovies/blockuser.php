
<?php
session_start();
// Check if an admin is logged in
if (!isset($_SESSION["adminid"])) {
    header("Location: login_admin.php");
    exit;
}

// Connect to the database
include 'dbconnect.php';

// Get the user ID from the URL parameter
$userid = $_GET["userid"];
 
// Block the user
$adminid = $_SESSION["adminid"];
$sql = "INSERT INTO blocked (blocked_userid,adminid) VALUES ('$userid','$adminid')";
$result = mysqli_query($con, $sql);
$sql1 = "UPDATE userinfo SET status = 'blocked' WHERE user_id = '$userid'";
$result1 = mysqli_query($con,$sql1);

if ($result) {
    echo "User blocked successfully";
} else {
    echo "Error blocking user: " ;
}

?>

