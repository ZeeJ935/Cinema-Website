<?php
include 'dbconnect.php';
if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    $unblock_query = "DELETE FROM blocked WHERE blocked_userid='$userid'";
    if (mysqli_query($con, $unblock_query)) {
        echo "User unblocked successfully";
        $sql1 = "UPDATE userinfo SET status = 'unblocked' WHERE user_id = '$userid'";
        $result1 = mysqli_query($con,$sql1);
    } else {
        echo "Error unblocking user: " ;
    }
} else {
    echo "No user ID specified";
}
?>
