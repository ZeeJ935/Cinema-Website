<html lang en>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width-device-width,initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
        <title>Cinema</title>
        <link rel="stylesheet" href="cinema4.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
       <div class="navbar">
       <div class="navbar-container">
        <div class="logo-container"><h3 class="logo">CentralCinema</h3></div>
        <div class="menu-container"></div>
        <input type="text" id="searchInput" placeholder="Search movies..." autocomplete="off">
        <div id="autoCompleteList" class="auto-complete-list"></div>
          <ul class="menu-list">
            <i class="fa-solid fa-house"></i>
            <a style="text-decoration: none;" href="">
            <li class="menu-list-items">Home</li></a>
            <i class="fa-solid fa-location-dot"></i>
            <a style="text-decoration: none;" href="login_page.php">
            <li class="menu-list-items">Booking</li></a>
            <i class="fa-solid fa-globe"></i>
            <a style="text-decoration: none;" href="status1.php">
            <li class="menu-list-items">Status</li></a>
            <i class="fa-solid fa-location-dot"></i>
            <a style="text-decoration: none;" href="location.html">
            <li class="menu-list-items">Location</li></a> 
            <i class="fa-solid fa-user-plus"></i>
            <a style="text-decoration: none;" href="login_page.php">
            <li class="menu-list-items">LogIn/SignUp</li></a>
            <i class="fa-solid fa-lock"></i>
            <a style="text-decoration: none;", href="login_admin.php">
                <li class="menu-list-items">Dashboard</li></a>



            
          </ul>
   
            
        </div>
       </div>
       </div>

       <div class="container">
        <div class="content-container">
        <?php
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "seatselect";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        // Fetch the list of movies from the database
        $sql = "SELECT * FROM Trending";
        $result = $conn->query($sql);

        // Generate the HTML for displaying the movies
        echo'<div class="trending" style="background: linear-gradient(to bottom,rgba(23, 20, 20, 0),#151515);">';
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
       
        echo '<img class="trending-title" src="' . $row["ImageURL"] . '" alt="">';
        echo '<p class="tren-desc" style="margin-top: -270px;"> Trending Now <br> 
        Movie: "' . $row["Movie_Name"] .'"
        </p> <br><br>';
        echo '<a style="text-decoration: none;", href="Book.php">';
        echo '<button class="tren-button" style="margin-top:10px" >BOOK TICKETS NOW!</button></a>';
        }
        echo '</div>';
        } else {
        echo "No movies found.";
        }

        $conn->close();
        ?>  
       </div>
       <div class="movie-list-container">
        <h1 class="movie-list-title"><br><br>&nbsp; NOW SHOWING</h1>
        <div class="movie-list-wrapper">
        <?php
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "seatselect";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        // Fetch the list of movies from the database
        $sql = "SELECT * FROM Movieadmin";
        $result = $conn->query($sql);

        // Generate the HTML for displaying the movies
        echo'<div class="movie-list">';
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
       
        echo '<div class="movie-list-item">';
        echo '<a href="userreview2.php?Movie_iD=' . $row['Movie_iD'] . '">';
        echo '<img class="movie-name" src="' . $row["ImageUrl"] . '" alt=""></a>';
        echo '<div class="movielisttitle">' . $row["MovieName"] . '</div>';
        echo '<a style="text-decoration: none;", href="Book.php">';
        echo '<button class="moviebutton">BOOK TICKETS</button></a>';
        echo '</div>';
        }
        echo '</div>';
        } else {
        echo "No movies found.";
        }

        $conn->close();
        ?>           
            
            </div>
            <i class="fa-solid fa-chevron-right arrow" style="margin-top: 570px"></i>
        </div>
        <div class="movie-list-container1">
            <h1 class="movie-list-title1"><br> <br><br><br><br> &nbsp; COMING SOON</h1>
            <div class="movie-list-wrapper1">
            <?php
            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "seatselect";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            // Fetch the list of movies from the database
            $sql = "SELECT * FROM ComingSoon";
            $result = $conn->query($sql);

            // Generate the HTML for displaying the movies
            echo'<div class="movie-list1">';
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
       
            echo '<div class="movie-list-item1">';
            echo '<img class="movie-name1" src="' . $row["ImageURL"] . '" alt="">';
            echo '<div class="movielisttitle1">' . $row["Movie_Name"] . '</div>';
            echo '<button class="moviebutton1">BOOKING WILL OPEN SOON</button></a>';
            echo '</div>';
        
        
            }
            echo '</div>';
            } else {
            echo "No movies found.";
            }

            $conn->close();
            ?> 
            
            </div>
       </div>
       



            </div>

            
    
        </div>
        <div class="links">
            <div class="link1">
          <div class="linktext-container"><h2 class = "linktext"> FIND US ON </h2></div>
            <div class="link-container">
                <ul class="link-list">
                    <i class="fa-brands fa-twitter icon"></i>
                    <a style="text-decoration: none;", href="https://twitter.com/cuecinemas?lang=en">
                    <li class="link-list-items">Twitter</li></a>
                  
                    <i class="fa-brands fa-instagram icon"></i>
                    <a style="text-decoration: none;", href="https://www.instagram.com/cuecinemas/?theme=dark">
                    <li class="link-list-items">Instagram</li></a>
                    
                    <i class="fa-brands fa-facebook icon"></i>
                    <a style="text-decoration: none;" href="https://www.facebook.com/cuecinema">
                    <li class="link-list-items">Facebook</li></a>

                    <i class="fa-solid fa-phone icon1"></i>
                    <li class="link-list-items">Contact: 0300-0011223</li>
                    &nbsp &nbsp &nbsp
                    <i class="fa-solid fa-location-dot"></i>
                    <a style="text-decoration: none;" href="location.html">
                    <li class="link-list-items">852-B Milaad St, Block B Faisal Town, Lahore</li></a>
                    
                    
            
                </div>
                </div>
            </div>
        </div>
        </div>

       

     <script src="script3.js"></script>
    </body>
</html>
