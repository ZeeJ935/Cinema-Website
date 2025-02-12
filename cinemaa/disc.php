<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'dbconnect.php'?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styled.css"> 
    <title>Discounts</title>
  </head>
  <body>

  <?php 
      
  ?>
    <div class="headding">
        <?php 
        session_start();
        $user_id = $_SESSION['user_id'];
       // $conn=OpenCon();
        $sql="SELECT CP FROM PROFILE WHERE user_id = $user_id";
        $result=mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        $CP=$row['CP'];
        echo '<h1>YOU HAVE '.$row['CP'].' CINEPOINTS!!</h1>';
        ?>
        <h2>Check what you can REDEEM</h2>
    </div>
    <div class="gallery">
        <div class="content">
            <?php
            if($CP>=500){
            echo '<h6><span class="badge badge-primary">Redeem at counter</span></h6>
            <img src="cap.jpg">
            <h3>Batman CAP</h3>
            <p>bla  bla bakhkahd sf ifsla d.hdsfhdsskhjsdkfhdfjkdsh</p>            <h6>500 CP</h6>
            <button class="buy-1">REDEEMABLE</button>';
            }
            else{
                echo '<img src="cap.jpg">
            <h3>Batman CAP</h3>
            <p>bla  bla bakhkahd sf ifsla d.hdsfhdsskhjsdkfhdfjkdsh</p>            <h6>500 CP</h6>'; }
            ?>
            
        </div>
        <div class="content">
                <?php
                if($CP>=1000){
               echo '<h6><span class="badge badge-primary">Redeem at counter</span></h6>
                <img src="mug.jpg">
                <h3>Spiderman Mug</h3>
                <p>bla  bla bakhkahd sf ifsla d.hdsfhdsskhjsdkfhdfjkdsh</p>                <h6>1000 CP</h6>
                <button class="buy-1">REDEEMABLE</button>';
                }else{
                    echo '<img src="mug.jpg">
                    <h3>Spiderman Mug</h3>
                    <p>bla  bla bakhkahd sf ifsla d.hdsfhdsskhjsdkfhdfjkdsh</p>                    <h6>1000 CP</h6>';
                        
                }
            
                ?>


        </div>
        <div class="content">
                <?php 
                if($CP>=1500){
                    echo '<h6><span class="badge badge-primary">Redeem at counter</span></h6>
            <img src="shirt.jpg">
            <h3>Batman Shirt</h3>
            <p>bla  bla bakhkahd sf ifsla d.hdsfhdsskhjsdkfhdfjkdsh</p>            <h6>1500 CP</h6>
            <button class="buy-1">REDEEMABLE</button>';

                }
                else{
                    echo '<img src="shirt.jpg">
            <h3>Batman Shirt</h3>
            <p>bla  bla bakhkahd sf ifsla d.hdsfhdsskhjsdkfhdfjkdsh</p>
            <h6>1500 CP</h6>';

                }
                
                ?>

            
        </div>
        <div class="content">
                <?php 
                if($CP>=2000){
                    echo '<h6><span class="badge badge-primary">Redeem at counter</span></h6>
            <img src="ticket.jpg">
            <h3>2 FREE tickets</h3>
            <p>two golden tickets for you and your S/O</p>
            <h6>2000 CP</h6>
            <button class="buy-1">REDEEMABLE</button>';

                }
                else{
                    echo '<img src="ticket.jpg">
            <h3>2 FREE TICKETS</h3>
            <p>two golden tickets for you and your S/O</p>
            <h6>2000 CP</h6>';

                }
                
                ?>

            
        </div>

        

    </div>
    <div class="text">
                <div class="info">
                    <h2>Watch and Win!!</h6>
                    <p style="margin-left:200px;text-align: center;width:80%;">Now, you can earn CINEPOINTS for EVERY movie that you watch. you also earn CINEPOINTS for every reservation you make. Here, you can see what cool merch you can redeem from our merch store.</p>

                </div>

    </div>


    
  </body>
</html>