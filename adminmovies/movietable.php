<?php
    // Connect to the database using PDO
    $host = "localhost";
    $dbname = "seatselect";
    $user = "root";
    $password = "";
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Check if the delete button was pressed
    if (isset($_POST["delete_movie"])) {
        $movie_id = $_POST["Movie_iD"];

        // Delete the movie record from the database
        $stmt = $pdo->prepare("DELETE FROM Movieadmin WHERE Movie_iD = :id");
        $stmt->bindParam(":id", $movie_id);
        $stmt->execute();

        
    }

    // Retrieve all movies from the database
    $stmt = $pdo->prepare("SELECT * FROM Movieadmin");
    $stmt->execute();

    $stmt1 = $pdo->prepare("SELECT * FROM Trending");
    $stmt1->execute();

    $stmt2 = $pdo->prepare("SELECT * FROM ComingSoon");
    $stmt2->execute();

    $stmt3 = $pdo->prepare("SELECT * FROM user_review");
    $stmt3->execute();

    $stmt4 = $pdo->prepare("SELECT * FROM Screen");
    $stmt4->execute();
    
    $stmt5 = $pdo->prepare("SELECT * FROM Screenexist");
    $stmt5->execute();

    $stmt6 = $pdo->prepare("SELECT * FROM reservations");
    $stmt6->execute();
?>





<html>
    <head>
    <link rel="stylesheet" type="text/css" href="movies.css">
    </head>

    <body>

      <a style="text-decoration: none;" href="/cinemaa/cinema.php">
      <div class="home"><h1>Home</h1></div></a>
      <div class="admin-panel">
      <h1 class="mhead">Movie Listings</h1>
      <div class="table_data">
    <table>
      <thead>
        <tr>
          <th>MovieID</th>
          <th>Movie Title</th>
          <th>Release Date</th>
          <th>Duration</th>
          <th>Genre</th>
          <th>Showtimes</th>
          <th>Average rating</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <div>
              <a href="/movietable/movieadmin.php">
             <button class="button">Add Movies</button></a>
           </div>
           <?php
           
                    // Loop through all the movie records
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["Movie_iD"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["MovieName"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["ReleaseDate"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Duration"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Genre"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Showtimes"]) . "</td>";
                        
                        echo "<td>" . htmlspecialchars($row["AvgRating"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                        echo "<td><a href='edit_movie.php?id=".$row['Movie_iD']."'>Edit</a> | <a href='delete_movie.php?id=".$row['Movie_iD']."' onclick='return confirm(\"Are you sure you want to delete this movie?\");'>Delete</a></td>";

                   
                        echo "</tr>";
                    }

                    
                    
                    ?>
         </tbody>
    </table>
    <div class="trending">
    <h1 class="mhead">Trending Now</h1>
    <table>
      <thead>
        <tr>
          <th>MovieID</th>
          <th>Movie Title</th>
          <th>Release Date</th>
          <th>Duration</th>
          <th>Genre</th>
          <th>Showtimes</th>
          <th>Average rating</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <div>
             <a href="/movietable/movieadmin1.php">
             <button class="button">Add Movies</button></a>
           </div>
           <?php

                    // Loop through all the movie records
                    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["Movie_iD"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Movie_Name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["ReleaseDate"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Duration"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Genre"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Showtimes"]) . "</td>";
                        
                        echo "<td>" . htmlspecialchars($row["AvgRating"]) . "</td>";
                        
                        echo "<td><a href='edit_movie1.php?id=".$row['Movie_iD']."'>Edit</a> | <a href='delete_movie2.php?id=".$row['Movie_iD']."' onclick='return confirm(\"Are you sure you want to delete this movie?\");'>Delete</a></td>";

                   
                        echo "</tr>";
                    }

                    
                    
                    ?>
         </tbody>
    </table>
    </div>

    <div class="Comingsoon">
    <h1 class="mhead">Coming Soon</h1>
    <table>
      <thead>
        <tr>
          <th>MovieID</th>
          <th>Movie Title</th>
          <th>Release Date</th>
          <th>Duration</th>
          <th>Genre</th>
          <th>Showtimes</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <div>
             <a href="/movietable/movieadmin2.php">
             <button class="button">Add Movies</button></a>
           </div>
           <?php

                    // Loop through all the movie records
                    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["Movie_iD"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Movie_Name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["ReleaseDate"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Duration"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Genre"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Showtimes"]) . "</td>";
                        
                        echo "<td><a href='edit_movie2.php?id=".$row['Movie_iD']."'>Edit</a> | <a href='delete_movie1.php?id=".$row['Movie_iD']."' onclick='return confirm(\"Are you sure you want to delete this movie?\");'>Delete</a></td>";

                   
                        echo "</tr>";
                    }

                    
                    
                    ?>
         </tbody>
    </table>
    </div>

    <div class="Userreview">
    <h1 class="mhead">User Ratings</h1>
    <table>
      <thead>
        <tr>
        <th>Rating ID</th>
          <th>User ID</th>
          <th>Movie ID</th>
          <th>Rating</th>
          <th>review</th>
         
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
           <?php

                    // Loop through all the movie records
                    while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["rating_iD"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["userid"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["movie_id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["rating"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["review"]) . "</td>";
                        
                        echo "<td><a href='deletereview.php?rating_iD=".$row['rating_iD']."' onclick='return confirm(\"Are you sure you want to delete this review?\");'>Delete</a></td>";

                   
                        echo "</tr>";
                    }
                    ?>
         </tbody>
    </table>
    </div>
    <div class="Available Screens">
    <h1 class="mhead">Screen info</h1>
    <table>
      <thead>
        <tr>
          <th>Screen ID</th>
          <th>Screen Name</th>
         
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <div>
             <a href="screeninfo.php">
             <button class="button">Add Screen</button></a>
           </div>
           <?php

                    // Loop through all the movie records
                    while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["Screen_iD"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Name"]) . "</td>";
                       
                        
                        echo "<td><a href='deletescreen.php?Screen_iD=".$row['Screen_iD']."' onclick='return confirm(\"Are you sure you want to delete this review?\");'>Delete</a></td>";

                   
                        echo "</tr>";
                    }
                    ?>
         </tbody>
    </table>
    </div>

    <div class="Screen">
    <h1 class="mhead">Show info</h1>
    <table>
      <thead>
        <tr>
        <th>Show ID</th>
          <th>Screen No</th>
          <th>Movie ID</th>
          <th>Location</th>
          <th>Day</th>
          <th>Time</th>
         
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <div>
             <a href="showinfo.php">
             <button class="button">Add Show</button></a>
           </div>
           <?php

                    // Loop through all the movie records
                    while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["Show_iD"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Screen_iD"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Movie_iD"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Location"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Date"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Time"]) . "</td>";
                        
                        echo "<<td><a href='edit_show.php?Show_iD=".$row['Show_iD']."'>Edit</a> | <a href='deleteshow.php?Show_iD=".$row['Show_iD']."' onclick='return confirm(\"Are you sure you want to delete this review?\");'>Delete</a></td>";

                   
                        echo "</tr>";
                    }
                    ?>
         </tbody>
    </table>
    </div>
    <div class="reservation">
    <h1 class="mhead">Booking Information</h1>
    <table>
      <thead>
        <tr>
          <th>Ticket iD</th>
          <th>Seat Number</th>
          <th>Screen ID</th>
          <th>Ticket Type</th>
          <th>Ticket Price</th>
         
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <div>
           <?php

                    // Loop through all the movie records
                    while ($row = $stmt6->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["ticket_id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["seat_number"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Screen_iD"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["tickettype"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["ticketprice"]) . "</td>";
                        
                        echo "<td><a href='deletebooking.php?ticket_iD=".$row['ticket_id']."' onclick='return confirm(\"Are you sure you want to delete this review?\");'>Delete</a></td>";

                   
                        echo "</tr>";
                    }
                    ?>
         </tbody>
    </table>
    </div>

    
    

<div class="blockedd">
  <div class="Blocked">
        <h1 class="mblock">User List</h1>

        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
require 'dbconnect.php';
$sql = "SELECT * FROM userinfo";

$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($rows) > 0) {
    echo "<table>";
    
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        if (is_user_blocked($pdo, $row["user_id"])) {
            echo "<td><a href='unblockuser.php?userid=" . $row["user_id"] . "'>Unblock</a></td>";
        } else {
            echo "<td><a href='blockuser.php?userid=" . $row["user_id"] . "'>Block</a></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found";
}

function is_user_blocked($pdo, $user_id)
{
    $blocked_query = "SELECT * FROM blocked WHERE blocked_userid=:user_id";
    $blocked_result = $pdo->prepare($blocked_query);
    $blocked_result->execute(array(':user_id' => $user_id));
    return $blocked_result->rowCount() > 0;
}
?>



            </tbody>
        </table>
    </div>
</body>
  </html>