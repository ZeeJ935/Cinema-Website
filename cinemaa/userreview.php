<?php
// Get the Movie_iD parameter from the URL
$Movie_iD = $_GET['Movie_iD'];

include 'dbconnect.php';

// Construct the SQL query to fetch movie details
$sql = "SELECT MovieName, ImageUrl, description, AvgRating, Duration, Genre, ReleaseDate FROM MovieAdmin WHERE Movie_iD = $Movie_iD";

// Execute the query
$result = mysqli_query($con, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Loop through the rows and display the movie name and image URL
    while ($row = mysqli_fetch_assoc($result)) {
        $MovieName= $row['MovieName'];
        $ImageUrl = $row['ImageUrl'];
        $description = $row['description'];
        $AvgRating = $row['AvgRating'];
        $Genre = $row['Genre'];
        $Duration = $row['Duration'];
        $ReleaseDate = $row['ReleaseDate'];
    }
} else {
    echo "No movie found.";
}
?>
<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width-device-width,initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
  <title>Movie</title>
  <link rel="stylesheet" href="userreview.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body>
  <?php
  include 'dbconnect.php';
  if (isset($_POST['submit'])) {
    $rating = $_POST['rating'];

    
    // Get the review text
    $review = $_POST['review-input'];
    session_start();
    $user_id = $_SESSION["user_id"];
    // Insert the rating and review into the database
    $query = "INSERT INTO user_review (rating, review, userid, movie_id) VALUES ('$rating','$review','$user_id',$Movie_iD)";
    $result = mysqli_query($con, $query);
    
    // Check if the query was successful
    if ($result) {
  ?>
      <script>
        alert("Review submitted successfully!!");
      </script>
    <?php
    } else {
    ?>
      <script>
        alert("Review Not Submitted");
      </script>
  <?php
    }
  }
  ?>
  <div class="movie">
    <div class="icon">
      <i style="color: white;" class="fa-solid fa-chevron-left arrow"></i>
      <div class="home">
        <a style="text-decoration: none;" , href="cinema2.php">
          <h2 style="color: white;">Home</h2>
      </div></a>
    </div>
    <div class="movie-name" >
    <h1 style="color:white"><?php echo $MovieName; ?></h1>
      <br>
    </div>
    <div class="movie-poster">
    <img width="250" src="<?php echo $ImageUrl; ?>" alt="Movie Poster">
    </div>
    <div class="avgrating">
      <h2 style="color: white">Average Rating: <?php echo $AvgRating; ?></h2>
    </div>
    <div class="movie-description">
      <p><?php echo $description; ?> </p>
    </div>
    <div class="genre">
      <h4 style="color:white;">Genre: <?php echo $Genre; ?>
    </div>
    <div class="duration">
    <h4 style="color:white;">Duration: <?php echo $Duration; ?> minutes</h4>
    </div>
    <div class="date">
    <h4 style="color:white;">Release Date: <?php echo $ReleaseDate; ?></h4>
    </div>
    <form id="review-form" method="post">
      <div class="ratings">


        <h2 style="color: white;">Rate this movie:</h2>
        <label>
          <input type="radio" name="rating" value="1" style="display: none">
          <span class="star">&#9733;</span>
        </label>
        <label>
          <input type="radio" name="rating" value="2" style="display: none">
          <span class="star">&#9733;</span>
        </label>
        <label>
          <input type="radio" name="rating" value="3" style="display: none">
          <span class="star">&#9733;</span>
        </label>
        <label>
          <input type="radio" name="rating" value="4" style="display: none">
          <span class="star">&#9733;</span>
        </label>
        <label>
          <input type="radio" name="rating" value="5" style="display: none">
          <span class="star">&#9733;</span>
        </label>
        <label>
          <input type="radio" name="rating" value="6" style="display: none">
          <span class="star">&#9733;</span>
        </label>
        <label>
          <input type="radio" name="rating" value="7" style="display: none">
          <span class="star">&#9733;</span>
        </label>
        <label>
          <input type="radio" name="rating" value="8" style="display: none">
          <span class="star">&#9733;</span>
        </label>
        <label>
          <input type="radio" name="rating" value="9" style="display: none">
          <span class="star">&#9733;</span>
        </label>
        <label>
          <input type="radio" name="rating" value="10" style="display: none">
          <span class="star">&#9733;</span>
        </label>
        

      </div>

      <p style="color: white;"><b>Leave a review:</b></p>
      <textarea id="review-input" name="review-input" style="width: 400px ; height: 200px"></textarea>
      <br>
      <br>
      <button type="submit" name="submit" style=" border: none;
  outline: none;
  padding: 9px 25px;
  background: #fff;
  cursor: pointer;
  font-size: 0.9em;
  border-radius: 4px;
  font-weight: 600;
  width: 100px;
  margin-top: 10 px;">Submit</button>
    </form>
  </div>
  <script src="userreview.js"></script>

</body>

</html>
