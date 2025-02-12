<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Movie Information Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="movieadmin.css">

  </head>
  <body>
    <?php
  include 'dbconnect.php'; 
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $Genre = $_POST['Genre'];
    $showtimes = $_POST['showtimes'];
    $rating = $_POST['rating'];
    $image = $_FILES['image']['name'];
   

    // Prepare and execute the SQL statement to insert the data into the database
        $sql = "INSERT INTO Movieadmin (MovieName,ReleaseDate,Duration,Genre,Showtimes,AvgRating,ImageUrl) VALUES ('$name','$date', '$duration','$Genre','$showtimes','$rating','$image')";
        if (mysqli_query($conn, $sql)) {
            move_uploaded_file($_FILES["image"]["tmp_name"],"cinemaa/".$_FILES["image"]["name"]);
            ?>
            <script>
                alert('data inserted')
                <?php
               header('Location: /adminmovies/movietable.php');
                exit;
                ?>
            </script>
            <?php
        } else {
            ?>
            <script>
                alert('data not inserted')
            </script>
            <?php
         
        }
    
    // Close the database connection
    mysqli_close($conn);
}

 ?>
    <h1>Movie Information Form</h1>
    <form method="post" enctype="multipart/form-data">
      <label for="name">Movie Name:</label><br>
      <input type="text" id="name" name="name"><br>
      
      <label for="date">Date Released:</label><br>
      <input type="date" id="date" name="date"><br>
      
      <label for="duration">Duration:</label><br>
      <input type="text" id="duration" name="duration"><br>

      <label for="Genre">Genre:</label><br>
      <input type="text" id="Genre" name="Genre"><br>
      
      <label for="showtimes">Showtimes:</label><br>
      <input type="text" id="showtimes" name="showtimes"><br>
      
      <label for="rating">Average Rating:</label><br>
      <input type="number" id="rating" name="rating" min="1.00" max="10.00" step="0.01"><br>
      
      <label for="image">Image URL:</label><br>
      <input type="file" id="image" name="image"><br>
      
     
      
      <br>
      <input type="submit" name="submit" value="ADD">
    </a>
    </form>
  </body>
</html>
