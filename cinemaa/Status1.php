<?php
include 'dbconnect.php';
if(isset($_GET['track'])) {
    $ticket_id = $_GET['ticket'];
$query = "SELECT * FROM reservations WHERE ticket_id = '$ticket_id' AND Payment = 'paid'";
$result = mysqli_query($con, $query);

// Get the number of rows returned by the query
$num_rows = mysqli_num_rows($result);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
$row = array_fill(0, 60, "seat");

// Loop through the result set and update the $row array
for ($i = 0; $i < $num_rows; $i++) {
    $row[$data[$i]['seat_number']-1] = "seat selected";
}


$query2 = "SELECT * FROM booksite WHERE ticket_id = '$ticket_id'";
$result2 = mysqli_query($con, $query2);
$data2 = mysqli_fetch_assoc($result2);

$query3 = "SELECT * FROM reservations WHERE ticket_id = '$ticket_id'";
$result3= mysqli_query($con, $query3);
$data3 = mysqli_fetch_assoc($result3);

$query4 = "SELECT * FROM payment WHERE ticket_id = '$ticket_id'";
$result4= mysqli_query($con, $query4);
$data4 = mysqli_fetch_assoc($result4);

}
?>
<html lang en>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width-device-width,initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
        <title>Seats</title>
        <link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <style>
        <?php include 'style2.css'?>
        </style>
    </head>
    <body>
        <div class="non-print">
        <h1>Your Status</h1>
        <form method="GET">
            <h1 class = "meh">Ticket ID:</h1>
            <input class = "meh" type="text" id="ticketid" name = "ticket">
            <button class = "eh" type="submit" name="track">Track Now</button>
        </form>
        </div>
        <?php
        if(isset($data)) {
        ?>
        <ul class="showcase"> 
            <li>Location: <?php echo $data2['City']; ?></li>
            <li>Date: <?php echo $data2['Day']; ?></li>
            <li>Time: <?php echo $data2['Time']; ?></li>
            <li>Ticket Type: <?php echo $data3['tickettype']; ?></li>
            <li>Total Amount paid: <?php echo $data4['totalcost']; ?> Rupees</li>
        </ul>
            <div class="container">
               <div class="row">
                <div class="<?php echo $row[0]; ?>"></div>
                <div class="<?php echo $row[1]; ?>"></div>
                <div class="<?php echo $row[2]; ?>"></div>
                <div class="<?php echo $row[3]; ?>"></div>
                <div class="<?php echo $row[4]; ?>"></div>
                <div class="<?php echo $row[5]; ?>"></div>
                <div class="<?php echo $row[6]; ?>"></div>
                <div class="<?php echo $row[7]; ?>"></div>
                <div class="<?php echo $row[8]; ?>"></div>
                <div class="<?php echo $row[9]; ?>"></div>
               </div>
               <div class="row">
                <div class="<?php echo $row[10]; ?>"></div>
                <div class="<?php echo $row[11]; ?>"></div>
                <div class="<?php echo $row[12]; ?>"></div>
                <div class="<?php echo $row[13]; ?>"></div>
                <div class="<?php echo $row[14]; ?>"></div>
                <div class="<?php echo $row[15]; ?>"></div>
                <div class="<?php echo $row[16]; ?>"></div>
                <div class="<?php echo $row[17]; ?>"></div>
                <div class="<?php echo $row[18]; ?>"></div>
                <div class="<?php echo $row[19]; ?>"></div>
               </div>
               <div class="row">
               <div class="<?php echo $row[20]; ?>"></div>
                <div class="<?php echo $row[21]; ?>"></div>
                <div class="<?php echo $row[22]; ?>"></div>
                <div class="<?php echo $row[23]; ?>"></div>
                <div class="<?php echo $row[24]; ?>"></div>
                <div class="<?php echo $row[25]; ?>"></div>
                <div class="<?php echo $row[26]; ?>"></div>
                <div class="<?php echo $row[27]; ?>"></div>
                <div class="<?php echo $row[28]; ?>"></div>
                <div class="<?php echo $row[29]; ?>"></div>
               </div>
               <div class="row">
               <div class="<?php echo $row[30]; ?>"></div>
                <div class="<?php echo $row[31]; ?>"></div>
                <div class="<?php echo $row[32]; ?>"></div>
                <div class="<?php echo $row[33]; ?>"></div>
                <div class="<?php echo $row[34]; ?>"></div>
                <div class="<?php echo $row[35]; ?>"></div>
                <div class="<?php echo $row[36]; ?>"></div>
                <div class="<?php echo $row[37]; ?>"></div>
                <div class="<?php echo $row[38]; ?>"></div>
                <div class="<?php echo $row[39]; ?>"></div>
               </div>
               <div class="row">
               <div class="<?php echo $row[40]; ?>"></div>
                <div class="<?php echo $row[41]; ?>"></div>
                <div class="<?php echo $row[42]; ?>"></div>
                <div class="<?php echo $row[43]; ?>"></div>
                <div class="<?php echo $row[44]; ?>"></div>
                <div class="<?php echo $row[45]; ?>"></div>
                <div class="<?php echo $row[46]; ?>"></div>
                <div class="<?php echo $row[47]; ?>"></div>
                <div class="<?php echo $row[48]; ?>"></div>
                <div class="<?php echo $row[49]; ?>"></div>
               </div>
               <div class="row">
               <div class="<?php echo $row[50]; ?>"></div>
                <div class="<?php echo $row[51]; ?>"></div>
                <div class="<?php echo $row[52]; ?>"></div>
                <div class="<?php echo $row[53]; ?>"></div>
                <div class="<?php echo $row[54]; ?>"></div>
                <div class="<?php echo $row[55]; ?>"></div>
                <div class="<?php echo $row[56]; ?>"></div>
                <div class="<?php echo $row[57]; ?>"></div>
                <div class="<?php echo $row[58]; ?>"></div>
                <div class="<?php echo $row[59]; ?>"></div>
               </div>
            </div>
            <div class="non-print">
            <button id="printButton" class="non-print">Print Ticket</button>
            <script>
            document.getElementById('printButton').addEventListener('click', function() 
            {
            window.print();
            });
            </script>

            <?php
        }
        ?>
        </body>
</html>