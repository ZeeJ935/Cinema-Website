
<html lang en>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width-device-width,initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
        <title>Seats</title>
        <link rel="stylesheet" href="seatcss.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">


        </head>
        <body>
        <?php
        session_start();
include 'dbconnectseats.php';
$ticket_id = $_GET['Ticket_id'];
$_SESSION['ticket_id'] = $ticket_id; 
$movieid = $_SESSION['movie_id'];

$stmt4 = $conn->prepare("SELECT booksite.Day from booksite where Ticket_id = ?");
$stmt4->bind_param("i", $ticket_id);
$stmt4->execute();
$result4 = $stmt4->get_result();

while ($row = $result4->fetch_assoc()) {
  // access the fields of the current row using $row['field_name']
  $Dayer = $row['Day'];
  // do something with the screen ID
}

$stmt3 = $conn->prepare("SELECT booksite.Time from booksite where Ticket_id = ?");
$stmt3->bind_param("i", $ticket_id);
$stmt3->execute();
$result3 = $stmt3->get_result();

while ($row = $result3->fetch_assoc()) {
  // access the fields of the current row using $row['field_name']
  $timer = $row['Time'];
  // do something with the screen ID
}

$stmt2 = $conn->prepare("SELECT City from booksite where Ticket_id = ?");
$stmt2->bind_param("i", $ticket_id);
$stmt2->execute();
$result2 = $stmt2->get_result();

while ($row = $result2->fetch_assoc()) {
  // access the fields of the current row using $row['field_name']
  $cityer= $row['City'];
  // do something with the screen ID
}

$stmt = $conn->prepare("SELECT DISTINCT Screen_iD FROM Movieadmin JOIN Screen ON Movieadmin.Movie_iD = Screen.Movie_iD JOIN booksite ON Screen.Movie_iD = booksite.Movie_id WHERE Ticket_id = ? AND booksite.City = ? AND booksite.Time = ? AND booksite.Day = ?");
$stmt->bind_param("isss", $ticket_id, $cityer, $timer, $Dayer);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  // access the fields of the current row using $row['field_name']
  $screener= $row['Screen_iD'];
  // do something with the screen ID
} 

$rower = array_fill(0, 60, "Seat");
$Payment = 'paid';

$stmt5 = $conn->prepare("Select seat_number from reservations join booksite on booksite.Ticket_iD = reservations.ticket_id where booksite.Movie_id = ? AND Screen_iD = ? AND Day = ? AND Time = ? AND Payment = ?");
$stmt5->bind_param("iisss", $movieid , $screener, $Dayer, $timer,$Payment);
$stmt5->execute();
$result5 = $stmt5->get_result();


while ($row = $result5->fetch_assoc()) {
  $occupied= $row['seat_number'];
  $rower[$occupied-1] = 'Seat Occupied';
  $disabled[$occupied-1] = 'disabled';
}


if(isset($_POST['pay_now'])) { 
  // get seat numbers from request body
  $seatNumbers = $_POST['rating'];
  $ticketTypeAndPrice = explode("|", $_POST['ticket-price']);
    $ticketType = $ticketTypeAndPrice[0];
    $ticketPrice = $ticketTypeAndPrice[1];
    $_SESSION['ticketprice'] = $ticketPrice;

  // Insert the seat numbers into the database
  $sql = "INSERT INTO reservations (ticket_id,Movie_iD, seat_number, Screen_iD, tickettype, ticketprice,Payment) VALUES ";
  $values = array();
  foreach ($seatNumbers as $seat) {
    $count = $count + 1;
    $values[] = "('$ticket_id','$movieid', '$seat','$screener', '$ticketType', '$ticketPrice','Unpaid')";
  }
  $sql .= implode(',', $values);
  $_SESSION['count'] = $count;
  var_dump($values);

  

  if (mysqli_query($conn, $sql)) {
    echo "Seat numbers saved to database.";
    header('Location: /cinemaa/payment_page.php');
     exit;
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  $conn->close();
}
?>
            <form method="post" enctype="multipart/form-data">
            <div class="movie-container">
                <label> Select Ticket Type:</label>
                <select id="movie" name="ticket-price">
             
                  <option value="Silver|800">Silver(Rs800)</option>
                  <option value="Gold|1500">Gold (RS1500)</option>
                  <option value="Platinum|2200">Platinum (Rs2200)</option>
              </select>
              </div>
              <div class="movie-container"></div>
            <ul class="showcase"> 
                <li>
                    <div class="Seat"></div>
                        <small style="color:white">Avaialabe</small>
                    
                </li>
                <li>
                    <div class="Seat Selected"></div>
                    
                        <small style="color:white">Selected</small>
                    


                </li>
                <li>
                    <div class="Seat Occupied"> </div> 
                   
                        <small style="color:white">Occupied</small>
                    
                </li>
                
            </ul>
            <div class="container">
                
            <div class="screen"></div>
                <div class="seat-row Silver" style="color: silver">
                Silver
               <div class="row">
              
                <label>
                 
               <input type="checkbox" name="rating[]" value="1" style="display: none" <?php echo $disabled[0]; ?>>
                <div class="<?php echo $rower[0]; ?>">&nbsp 1</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="2" style="display: none" <?php echo $disabled[1]; ?>>
                <div class="<?php echo $rower[1]; ?>">&nbsp 2</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="3" style="display: none" <?php echo $disabled[2]; ?>>
                <div class="<?php echo $rower[2]; ?>">&nbsp 3</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="4" style="display: none" <?php echo $disabled[3]; ?>>
                <div class="<?php echo $rower[3]; ?>">&nbsp 4</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="5" style="display: none" <?php echo $disabled[4]; ?>>
                <div class="<?php echo $rower[4]; ?>">&nbsp 5</div>
                </label>
                <label class="<?php echo $disabled[5]; ?>">
                <input type="checkbox" name="rating[]" value="6" style="display: none" <?php echo $disabled[5]; ?>>
                <div class="<?php echo $rower[5]; ?>">&nbsp 6</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="7" style="display: none" <?php echo $disabled[6]; ?>>
                <div class="<?php echo $rower[6]; ?>">&nbsp 7</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="8" style="display: none" <?php echo $disabled[7]; ?>> 
                <div class="<?php echo $rower[7]; ?>">&nbsp 8</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="9" style="display: none" <?php echo $disabled[8]; ?>>
                <div class="<?php echo $rower[8]; ?>">&nbsp 9</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="10" style="display: none" <?php echo $disabled[9]; ?>>
                <div class="<?php echo $rower[9]; ?>">&nbsp 10</div>
                </label>
                
               </div>
               <div class="row">
               <label>
               <input type="checkbox" name="rating[]" value="11" style="display: none" <?php echo $disabled[10]; ?>>
                <div class="<?php echo $rower[10]; ?>">&nbsp 11</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="12" style="display: none" <?php echo $disabled[11]; ?>>
                <div class="<?php echo $rower[11]; ?>">&nbsp 12</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="13" style="display: none" <?php echo $disabled[12]; ?>>
                <div class="<?php echo $rower[12]; ?>">&nbsp 13</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="14" style="display: none" <?php echo $disabled[13]; ?>>
                <div class="<?php echo $rower[13]; ?>">&nbsp 14</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="15" style="display: none" <?php echo $disabled[14]; ?>>
                <div class="<?php echo $rower[14]; ?>">&nbsp 15</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="16" style="display: none" <?php echo $disabled[15]; ?>>
                <div class="<?php echo $rower[15]; ?>">&nbsp 16</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="17" style="display: none" <?php echo $disabled[16]; ?>>
                <div class="<?php echo $rower[16]; ?>">&nbsp 17</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="18" style="display: none" <?php echo $disabled[17]; ?>>
                <div class="<?php echo $rower[17]; ?>">&nbsp 18</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="19" style="display: none" <?php echo $disabled[18]; ?>>
                <div class="<?php echo $rower[18]; ?>">&nbsp 19</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="20" style="display: none" <?php echo $disabled[19]; ?>>
                <div class="<?php echo $rower[19]; ?>">&nbsp 20</div>
                </label>
               </div>
               </div>
               <div class="seat-row Gold" style="color: #FF7F24"> 
               Gold
               <div class="row">
               <label>
               <input type="checkbox" name="rating[]" value="21" style="display: none" <?php echo $disabled[20]; ?>>
                <div class="<?php echo $rower[20]; ?>">&nbsp 21</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="22" style="display: none" <?php echo $disabled[21]; ?>>
                <div class="<?php echo $rower[21]; ?>">&nbsp 22</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="23" style="display: none" <?php echo $disabled[22]; ?>>
                <div class="<?php echo $rower[22]; ?>">&nbsp 23</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="24" style="display: none" <?php echo $disabled[23]; ?>>
                <div class="<?php echo $rower[23]; ?>">&nbsp 24</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="25" style="display: none" <?php echo $disabled[24]; ?>>
                <div class="<?php echo $rower[24]; ?>">&nbsp 25</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="26" style="display: none" <?php echo $disabled[25]; ?>>
                <div class="<?php echo $rower[25]; ?>">&nbsp 26</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="27" style="display: none" <?php echo $disabled[26]; ?>>
                <div class="<?php echo $rower[26]; ?>">&nbsp 27</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="28" style="display: none" <?php echo $disabled[27]; ?>>
                <div class="<?php echo $rower[27]; ?>">&nbsp 28</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="29" style="display: none" <?php echo $disabled[28]; ?>>
                <div class="<?php echo $rower[28]; ?>">&nbsp 29</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="30" style="display: none" <?php echo $disabled[29]; ?>>
                <div class="<?php echo $rower[29]; ?>">&nbsp 30</div>
                </label>
               </div>
               <div class="row">
               <label>
               <input type="checkbox" name="rating[]" value="31" style="display: none" <?php echo $disabled[30]; ?>>
                <div class="<?php echo $rower[30]; ?>">&nbsp 31</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="32" style="display: none" <?php echo $disabled[31]; ?>>
                <div class="<?php echo $rower[31]; ?>">&nbsp 32</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="33" style="display: none" <?php echo $disabled[32]; ?>>
                <div class="<?php echo $rower[32]; ?>">&nbsp 33</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="34" style="display: none" <?php echo $disabled[33]; ?>>
                <div class="<?php echo $rower[33]; ?>">&nbsp 34</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="35" style="display: none" <?php echo $disabled[34]; ?>>
                <div class="<?php echo $rower[34]; ?>">&nbsp 35</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="36" style="display: none" <?php echo $disabled[35]; ?>>
                <div class="<?php echo $rower[35]; ?>">&nbsp 36</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="37" style="display: none" <?php echo $disabled[36]; ?>>
                <div class="<?php echo $rower[36]; ?>">&nbsp 37</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="38" style="display: none" <?php echo $disabled[37]; ?>>
                <div class="<?php echo $rower[37]; ?>">&nbsp 38</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="39" style="display: none" <?php echo $disabled[38]; ?>>
                <div class="<?php echo $rower[38]; ?>">&nbsp 39</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="40" style="display: none" <?php echo $disabled[39]; ?>>
                <div class="<?php echo $rower[39]; ?>">&nbsp 40</div>
                </label>
               </div>
               </div>
               <div class="seat-row Platinum" style="color: #8B2500">
               Platinum
               <div class="row">
               <label>
               <input type="checkbox" name="rating[]" value="41" style="display: none" <?php echo $disabled[40]; ?>>
                <div class="<?php echo $rower[40]; ?>">&nbsp 41</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="42" style="display: none" <?php echo $disabled[41]; ?>>
                <div class="<?php echo $rower[41]; ?>">&nbsp 42</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="43" style="display: none" <?php echo $disabled[42]; ?>>
                <div class="<?php echo $rower[42]; ?>">&nbsp 43</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="44" style="display: none" <?php echo $disabled[43]; ?>>
                <div class="<?php echo $rower[43]; ?>">&nbsp 44</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="45" style="display: none" <?php echo $disabled[44]; ?>>
                <div class="<?php echo $rower[44]; ?>">&nbsp 45</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="46" style="display: none" <?php echo $disabled[45]; ?>>
                <div class="<?php echo $rower[45]; ?>">&nbsp 46</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="47" style="display: none" <?php echo $disabled[46]; ?>>
                <div class="<?php echo $rower[46]; ?>">&nbsp 47</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="48" style="display: none" <?php echo $disabled[47]; ?>>
                <div class="<?php echo $rower[47]; ?>">&nbsp 48</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="49" style="display: none" <?php echo $disabled[48]; ?>>
                <div class="<?php echo $rower[48]; ?>">&nbsp 49</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="50" style="display: none" <?php echo $disabled[49]; ?>>
                <div class="<?php echo $rower[49]; ?>">&nbsp 50</div>
                </label>
               </div>
               <div class="row">
               <label>
               <input type="checkbox" name="rating[]" value="51" style="display: none" <?php echo $disabled[50]; ?>>
                <div class="<?php echo $rower[50]; ?>">&nbsp 51</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="52" style="display: none" <?php echo $disabled[51]; ?>>
                <div class="<?php echo $rower[51]; ?>">&nbsp 52</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="53" style="display: none" <?php echo $disabled[52]; ?>>
                <div class="<?php echo $rower[52]; ?>">&nbsp 53</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="54" style="display: none" <?php echo $disabled[53]; ?>>
                <div class="<?php echo $rower[53]; ?>">&nbsp 54</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="55" style="display: none" <?php echo $disabled[54]; ?>>
                <div class="<?php echo $rower[54]; ?>">&nbsp 55</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="56" style="display: none" <?php echo $disabled[55]; ?>>
                <div class="<?php echo $rower[55]; ?>">&nbsp 56</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="57" style="display: none" <?php echo $disabled[56]; ?>>
                <div class="<?php echo $rower[56]; ?>">&nbsp 57</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="58" style="display: none" <?php echo $disabled[57]; ?>>
                <div class="<?php echo $rower[57]; ?>">&nbsp 58</div>
                </label>
                &nbsp &nbsp
                <label>
                <input type="checkbox" name="rating[]" value="59" style="display: none" <?php echo $disabled[58]; ?>>
                <div class="<?php echo $rower[58]; ?>">&nbsp 59</div>
                </label>
                <label>
                <input type="checkbox" name="rating[]" value="60" style="display: none" <?php echo $disabled[59]; ?>>
                <div class="<?php echo $rower[59]; ?>">&nbsp 60</div>
                </label>
               </div>
               </div>
               <input type="hidden" name="selected_seat" id="selected-seat">
            </div>
            <p class="text">
                You have selected <span id="count">0</span> Seats 
            </p>
            <div class="button">
                <a style="text-decoration: none;", href="/cinemaa/payment_page.php">
                <button class="pbutton" name ="pay_now" id="pay-now" >PAY NOW</button></a>
            </div>
            

        </form>
 
        <script src="js.js"></script>

        

        </body>
</html>