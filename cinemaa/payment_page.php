<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment Page</title>
  <link rel="stylesheet" href="pcss.css" />
  <style>
  .sum1{
    text-align: center;
    margin-top: -40px;
    font-size: 24px;
    color: white;
    margin-right: 80px;
    
  }
</style>
</head>

<body>
  <?php
  session_start();
  $ticket_id = $_SESSION['ticket_id'];
  $ticketprice = $_SESSION['ticketprice'];
  $count = $_SESSION['count'];
  $userid = $_SESSION['user_id'];



  for ($i = 0; $i < $count; $i++) {
    $sum += $ticketprice;
  }
  

  include 'dbconnect.php';


  if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST["name"]); //username
    $email = mysqli_real_escape_string($con, $_POST["email"]); //emailid
    $cardnum = mysqli_real_escape_string($con, $_POST["cardnum"]); //card number
    $expdate = mysqli_real_escape_string($con, $_POST["expdate"]); //expiry date card 
    $cvc = mysqli_real_escape_string($con, $_POST["cvc"]);  // cvc card
    $current_date = date('Y-m-d');

    $sql = "SELECT email FROM userinfo WHERE user_id= '$userid'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 0) {
  ?>
      <script>
        alert("You dont have an account on our page. Create an account first");
      </script>
      <?php
    } else {

      $row = mysqli_fetch_assoc($result);
      $email1 = $row['email'];
      if($email != $email1)
      {
        ?>
      <script>
        alert("Please use your email registered on this website!");
      </script>
      <?php
      }
      // validate cardnum, cvc, and expiry date
      else if (!preg_match('/^\d{4} \d{4} \d{4} \d{4}$/', $cardnum)) {
      ?>
        <script>
          alert("Card number should be in the format: 1234 1234 1234 1234");
        </script>
      <?php
      } else if (!ctype_digit($cvc) || strlen($cvc) != 3) {

      ?>
        <script>
          alert("CVC should be 3 digits.");
        </script>
        <?php
      } else if (!preg_match('/^\d{2}\/\d{4}$/', $expdate)) {
        ?>
        <script>
          alert("Expiry date should be in the format: MM/YYYY");
        </script>
        <?php
      } 

      else {
        $expdate_obj = DateTime::createFromFormat('m/Y', $expdate);
        $expdate_formatted = $expdate_obj->format('Y-m-01');
      if( $expdate_formatted< $current_date)
      {
        ?>
        <script>
          alert("Your Card is expired.");
        </script>
        <?php
      }
      else
      {
        $insertquery = "INSERT INTO payment(ticket_id,paymentdate, name, email, cardnum, expdate, cvc, userid,totalcost) 
        VALUES ('$ticket_id','$current_date','$name','$email','$cardnum','$expdate_formatted','$cvc','$userid','$sum')";
        $iquery = mysqli_query($con, $insertquery);
        if ($iquery) {
          $paid = "UPDATE reservations SET payment = 'paid' WHERE ticket_id = $ticket_id";
          $paid1 = mysqli_query($con, $paid);
        ?>
          <script>
            alert("Payment Successful! Your ticket ID is <?php echo $ticket_id; ?>.");
            header('Location:/cinemaa/Status1.php');
          </script>
        <?php
        } else {
        ?>
          <script>
            alert("Payment Unsuccessful");
          </script>
  <?php
        }
      }
    }
  }
  }
  ?>
   


  <div class="box">
    <span class="borderline"> </span>
    <form method="post">
    <h2>Payment</h2>
    
      <div class="inputBox">
      <h3 class="sum" style="color:white"> Total Amount Payable: <?php echo number_format($sum, 0); ?> Rupees </h3>
        
        
        <input type="text" required="Required!" name="name"/>
        <span>Name</span>
        <i> </i>
      </div>

      <div class="inputBox">
        <input type="email" required="Required!" name="email" />
        <span>Email</span>
        <i> </i>
      </div>

      <div class="inputBox">
        <input type="text" title="CARD_NUMBER_SAMPLE:1234 1234 1234 1234" required="Required!" name="cardnum" />
        <span>Card Number (1234 1234 1234 1234)</span>
        <i> </i>
      </div>

      <div class="inputBox">
        <input type="text" title="CARD_EXPIRY_DATE_SAMPLE:02/2023" required="Required!" name="expdate" />
        <span>Card Expiry Date (MM/YYYY)</span>
        <i> </i>
      </div>

      <div class="inputBox">
        <input type="text" required="Required!" name="cvc"/>
        <span>Card CVC (123)</span>
        <i> </i>
      </div>
      
      <div class="butsub">
        <input type="submit" value="Pay Now" name="submit"/><a href = "Status1.php"></a>
      </div>
    </form>
  </div>
</body>

</html>