<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seatselect";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn) {
    ?>
    <script>
        alert('connection successfull')
        </script>
        <?php
 } else{
    ?>
    <script>
        alert('connection not successfull')
        </script>
        <?php

 }

?>