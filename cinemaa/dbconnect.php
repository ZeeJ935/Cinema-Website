<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seatselect";
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($con) {
    ?>

        <?php
 } else{
    ?>
    <script>
        alert('connection not successfull')
        </script>
        <?php

 }

?>