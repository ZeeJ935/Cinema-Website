<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    <?php include 'Bstyle2.css'?>
    <?php include 'dbconnect.php'?>
    </style>
    <?php
    ob_start();
    ?>
    <script>
                    $(document).ready(function(){
                        $("#movie").change(function(){
                            var mid = $("#movie").val();
                            $.ajax({
                                url: 'get_cities.php',
                                method: 'POST',
                                data: 'mid=' +mid
                            }).done(function(city){
                                var cityArray = JSON.parse(city);
                                $("#city").empty();
                                $("#city").append('<option disabled selected >Please Select Location</option>');
                                var i = 0;
                                while(i<cityArray.length)
                                {
                                    $("#city").append('<option value="'+cityArray[i]+'">'+cityArray[i]+'</option>');
                                    i++;
                                }
                            })
                        })
                    })
    </script>
    <script>
                    $(document).ready(function(){
                        $("#city").change(function(){
                            var mid = $("#movie").val();
                            var cid = $("#city").val();
                            $.ajax({
                                url: 'get_day.php',
                                method: 'POST',
                                data: {
                                      mid: mid,
                                      cid: cid
                                    }
                            }).done(function(day){
                                var dayArray = JSON.parse(day);
                                console.log(dayArray);
                                $("#day").empty();
                                $("#day").append('<option disabled selected >Please Select Day</option>');
                                var i = 0;
                                while(i<dayArray.length)
                                {
                                    $("#day").append('<option value="'+dayArray[i]+'">'+dayArray[i]+'</option>');
                                    i++;
                                }
                            })
                        })
                    })
    </script>
    <script>
                    $(document).ready(function(){
                        $("#day").change(function(){
                            var mid = $("#movie").val();
                            var cid = $("#city").val();
                            var did = $("#day").val();
                            $.ajax({
                                url: 'get_time.php',
                                method: 'POST',
                                data: {
                                      mid: mid,
                                      cid: cid,
                                      did: did
                                    }
                            }).done(function(time){
                                var timeArray = JSON.parse(time);
                                console.log(timeArray);
                                $("#time").empty();
                                $("#time").append('<option disabled selected>Please Select Time</option>');
                                var i = 0;
                                while(i<timeArray.length)
                                {
                                    $("#time").append('<option value="'+timeArray[i]+'">'+timeArray[i]+'</option>');
                                    i++;
                                }
                            })
                        })
                    })
    </script>
</head>
<body>
<?php
    $booker = "SELECT MAX(Ticket_id) FROM booksite";
    $bquery = mysqli_query($con,$booker);
    $max_row = mysqli_fetch_array($bquery);
    if ($max_row[0] != NULL)
    $maxammo = $max_row[0] + 1;
    else
    $maxammo = 0;

    session_start();
    $user_id = $_SESSION["user_id"];
    if(isset($_POST['submit']))
    {
        $movie = mysqli_real_escape_string($con, $_POST['movie']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $day = mysqli_real_escape_string($con, $_POST['day']);
        $time = mysqli_real_escape_string($con, $_POST['time']);
        $pesa = mysqli_real_escape_string($con, $_POST['pesa']);

        if(empty($movie) || empty($city) || empty($day) || empty($time) || empty($pesa))
    {
?>
    <script>
        alert("Error in Selection");
    </script>
<?php
    exit;
    }

        $insertintor = "insert into booksite(User_id,Movie_id, City, Day, Time, paymentmethod) 
        values ('$user_id','$movie','$city','$day','$time','$pesa')";

        $iquery = mysqli_query($con,$insertintor);
        $_SESSION['movie_id'] = $movie;
        
        if($iquery)
{
?>
    <script>
        alert("Booking Successful");
    </script>
<?php
    ob_end_clean();
    header("Location:/seats/seats.php?Ticket_id=" . $maxammo);
}
else
{
?>
<script>
    alert("Booking Unsuccessful");
</script>
<?php
}
    }
?>
    <div class="backgrounds">
        <nav>
            <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Redeem Points</a></li>
            </ul>
        </nav>
        <form class="cont" action="" method="POST">
<?php
            $query = "Select * from Movieadmin";
            $sql = mysqli_query($con,$query);
            
?>
            <h1>Book Your Seats</h1>
            <p>Select Movie</p>
            <select class="movieboy" name="movie" id="movie">
                <option disabled selected = "">Please Select Movie</option>
                <?php while($row = mysqli_fetch_array($sql)){?>
                    <option  value="<?php echo $row['Movie_iD']?>"><?php echo $row['MovieName']; ?> </option>
                <?php } ?>
            </select>
            <p>Select City</p>
            <select class="Cityboy" name="city" id="city">
            <option disabled selected >Please Select Location</option>
            </select>
            <br>
            <p>Select Day</p>
            <select class="dayboy" name="day" id="day">
                <option disabled selected >Please Select Day</option>
            </select>
            <p>Select Time</p>
            <select class="timeboy" name="time" id="time">
            <option disabled selected>Please Select Time</option>
            </select>
            <p>Select Payment Method</p>
            <select class="pesaboy" name="pesa" id="pesa">
                <option disabled selected>Please select Payment method</option>
                <option value="Credit">Credit Card</option>
                <option value="Debit">Debit Card</option>
            </select>
            <button type="submit" name="submit">Book Now</button>
        </form>
    </div>
</body>
</html>