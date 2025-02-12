<?php
include 'db_connectivity.php';
$conn = OpenCon();
echo "Connected Successfully";
CloseCon($conn);
?>