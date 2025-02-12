<!DOCTYPE html>
<html lang="en">
<head>
<title>Cinema Profile</title>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Waqar Ahmad">
    <?php include 'dbconnect.php'?>
    <!-- import font icon (fontawesome) -->
    <script src="https://kit.fontawesome.com/b8b432d7d3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
 
    <!-- import css file (style.css) -->
    <link rel="stylesheet" href="suris2.css">
</head> 
<?php
session_start();
 $id = $_SESSION['user_id'];


//$con=OpenCon();

$sql="select * from profile where user_id = $id";
$res=mysqli_query($con,$sql);
if(mysqli_num_rows($res)==0){

    $sql = "INSERT into profile (user_id, name, bio, photo,fblink, twtlink, CP) values ('$id','user2345')";//bing schling
    if (mysqli_query($con, $sql)) {
        echo "Data inserted successfully!";
        var_dump($sql);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    

    header('Location: editprofile.php');
   exit;
}



$sql = "SELECT name,bio,photo FROM profile WHERE user_id = $id";
$result =mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    // Loop through the results
    while($row = mysqli_fetch_assoc($result)) {
        // Store the name in a variable
        $name = $row["name"];
        $Bio=$row["bio"];
        $photo=$row["photo"];
    }
} else {
    echo "0 results";
}

?>
<body>

    <div class="container">

        <div class="profile-card">
            <div class="profile-header"><!-- profile header section -->
             
                <div class="main-profile">
                    <div >
                    

<?php 
    $sql = "SELECT * FROM profile WHERE user_id = $id";
    //$con = OpenCon();
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Loop through the results
        while($row = mysqli_fetch_assoc($result)) {
            // Store the name in a variable
            $photo = $row["photo"];
            echo'<img src="'.  $photo.'" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 10px solid var(--primary-bg);">';
        }      
    }
?>


                    </div>
                    <div class="profile-names">
                        <h1 class="username"><?php echo $name; ?></h1>
                        <small class="page-title">Professional & Talented Film Connoisseur</small>
                    </div>
                </div>
            </div>

            <div class="profile-body"><!-- profile body section -->
                <div class="profile-actions">
                    <a style="text-decoration: none;", href="Book.php">
                    <button class="follow">Book Seats</button></a>
                    <a href="login_page.php"><button class="message" style="text-decoration = none;">Log Out</button></a>
                    <section class="bio">
                        <div class="bio-header">
                            <i class="fa fa-info-circle"></i>
                            Bio
                        </div>
                        <p class="bio-text">
                            <?php echo $Bio;?>
                        </p>
                    </section>
                </div>

                <div class="account-info">
                    <div class="data">
                        <div class="important-data">
                            <section class="data-item">
                                <h3 class="value"></h3>
                                <small class="title"></small>
                            </section>
                            <section class="data-item">
                                <h3 class="value">Cine Points</h3>
                                <small class="title"><?php $sql = "SELECT COUNT(DISTINCT s.Movie_iD) as reps
                                FROM  Screen s 
                                JOIN reservations r ON r.Screen_iD = s.Screen_iD 
                                JOIN payment p ON p.ticket_id = r.ticket_id
                                where p.userid = $id";// here too
                                $result = mysqli_query($con, $sql);
        
                                if (mysqli_num_rows($result) > 0) {
                                    // Display the image
                                    $row = mysqli_fetch_assoc($result);
                                    $cinepoints= $row['reps']*50;
                                } 

                                $sql = "SELECT count(Ticket_iD) FROM booksite WHERE user_id = $id";// here too
                                    $result = mysqli_query($con, $sql);
            
                                    if (mysqli_num_rows($result) > 0) {
                                        // Display the image
                                        $row = mysqli_fetch_assoc($result);
                                        $cinepoints=$cinepoints+ $row["count(Ticket_iD)"]*100;
                                    
                                    }
                                echo $cinepoints;
                                
                                ?></small>
                            </section>
                            </section>
                            <section class="data-item">
                                <h3 class="value"></h3>
                                <small class="title"></small>
                            </section>
                        </div>
                        <div class="other-data">
                            <section class="data-item">
                                <h3 class="value">
                                <?php
                                $sql = "SELECT Genre, COUNT(*) as reps
                                FROM Movieadmin m 
                                JOIN Screen s ON m.Movie_iD = s.Movie_iD 
                                JOIN reservations r ON r.Screen_iD = s.Screen_iD 
                                JOIN payment p ON p.ticket_id = r.ticket_id
                                ORDER BY reps DESC
                                LIMIT 1;
                                ";// here too 
                                $result = mysqli_query($con, $sql);
        
                                if (mysqli_num_rows($result) > 0) {
                                    // Display the image
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['Genre'];
                                }
                                ?>    

                                </h3>
                                <small class="title">Top Genre</small>
                            </section>
                            <section class="data-item">
                            <h3 class="value"><?php
                                    $sql = "SELECT count(Ticket_iD) FROM booksite WHERE user_id = $id";// here too
                                    $result = mysqli_query($con, $sql);
            
                                    if (mysqli_num_rows($result) > 0) {
                                        // Display the image
                                        $row = mysqli_fetch_assoc($result);
                                        echo $row["count(Ticket_iD)"];
                                    }

                                ?>
                                </h3>
                                <small class="title">Watched</small>
                            </section>
                            <section class="data-item">
                                <h3 class="value">
                                <?php
                                $sql = "SELECT COUNT(DISTINCT s.Movie_iD) as reps
                                FROM Screen s 
                                JOIN reservations r ON r.Screen_iD = s.Screen_iD 
                                JOIN payment p ON p.ticket_id = r.ticket_id
                                where p.userid = $id";// here too
                                $result = mysqli_query($con, $sql);
        
                                if (mysqli_num_rows($result) > 0) {
                                    // Display the image
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['reps'];
                                }
                                ?>  
                                </h3>
                                <small class="title">Reservations</small>
                            </section>
                        </div>
                    </div>

                    <div class="social-media">
                        <span>Linked Accounts:</span>
                        <?php $sql = "SELECT fblink,twtlink FROM profile WHERE user_id =$id";// here too
                                    $result = mysqli_query($con, $sql);
            
                                    if (mysqli_num_rows($result) > 0) {
                                        // Display the image
                                        $row = mysqli_fetch_assoc($result);                                       
                                        echo '<a href="'. $row['fblink'] .'" class="media-link"><i class="fab fa-facebook-square"></i></a>';
                                        echo '<a href="'. $row['twtlink'] .'" class="media-link"><i class="fab fa-twitter-square"></i></a>';                        
                                    }?>
                    </div>

                    <div class="last-post">
                    <div class="post-cover">
                            <span class="last-badge">Last Movie Watched</span>
                            <div class="bing" style="margin-top:50px"><?php
                        $sql = "SELECT ImageUrl
                        FROM Movieadmin m 
                        JOIN Screen s ON m.Movie_iD = s.Movie_iD 
                        JOIN reservations r ON r.Screen_iD = s.Screen_iD 
                        JOIN payment p ON p.ticket_id = r.ticket_id 
                        WHERE p.userid = $id AND s.Date<=CURDATE() 
                        ORDER BY s.Date DESC, s.Time DESC 
                        LIMIT 1;
                        ";// here too
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Display the image
                            $row = mysqli_fetch_assoc($result);
                            echo'<img src="'.  $row['ImageUrl'].'" style="width: 150px; height: 150px; object-fit: cover; border-radius: 5%; border: 10px solid var(--primary-bg);">';
                        }
                        ?>
                            </div>
                            <h3 class="post-title">
                                <?php
                        $sql = "SELECT MovieName ,ImageUrl
                        FROM Movieadmin m 
                        JOIN Screen s ON m.Movie_iD = s.Movie_iD 
                        JOIN reservations r ON r.Screen_iD = s.Screen_iD 
                        JOIN payment p ON p.ticket_id = r.ticket_id 
                        WHERE p.userid = $id AND s.Date<=CURDATE() 
                        ORDER BY s.Date DESC, s.Time DESC 
                        LIMIT 1;
                        ";// here too
                        $result = mysqli_query($con, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            // Display the image
                            $row = mysqli_fetch_assoc($result);
                            // echo'<img src="'.  $row['ImageUrl'].'" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 10px solid var(--primary-bg);">';
                            echo $row["MovieName"];
                        }
                        ?></h3>
                        <button class="post-CTA" style=""><a href="editprofile.php">Edit Profile</a></button>
                    </div></div>
                   
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<?php CloseCon($con); ?>
</html>