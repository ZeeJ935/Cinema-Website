<!DOCTYPE html>
<html>
<head>
	<title>Add Showtime</title>
</head>
<body>
	<h1>Add Showtime</h1>
	<form method="post">
	<label for="screen_id">Screen ID:</label>
		<input type="text" id="screen_id" name="screen_id" required><br><br>

		<label for="movie_id">Movie ID:</label>
		<input type="text" id="movie_id" name="movie_id" required><br><br>

		<label for="location">Location:</label>
		<input type="text" id="location" name="location" required><br><br>

		<label for="date">Date:</label>
		<input type="date" id="date" name="date" required><br><br>

		<label for="time">Time:</label>
		<input type="time" id="time" name="time" required><br><br>

		<input type="submit" value="Add">
	</form>

	<?php
	// Check if the form has been submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Get the form data
		$s_id = $_POST['screen_id'];
		$movie_id = $_POST['movie_id'];
		$location = $_POST['location'];
		$date = $_POST['date'];
		$time = $_POST['time'];

		// Connect to the database
		$host = "localhost";
		$username = "root";
		$password = "";
		$dbname = "seatselect";

		$conn = new mysqli($host, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Prepare the SQL statement
		$sql = "INSERT INTO Screen (Screen_iD,Movie_iD, Location, Date, Time) VALUES (?, ?, ?, ?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("iisss",$s_id ,$movie_id, $location, $date, $time);

		// Execute the statement
		if ($stmt->execute()) {
			echo "Showtime added successfully.";
		} else {
			echo "Error adding showtime: " . $conn->error;
		}

		// Close the statement and the connection
		$stmt->close();
		$conn->close();
	}
	?>
</body>
</html>
