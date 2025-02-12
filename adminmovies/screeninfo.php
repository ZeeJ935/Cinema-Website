<!DOCTYPE html>
<html>
<head>
	<title>Add Showtime</title>
</head>
<body>
	<h1>Add Showtime</h1>
	<form method="post">
		<label for="movie_id">Screen Name:</label>
		<input type="text" id="Name" name="Name" required><br><br>


		<input type="submit" value="Add">
	</form>

	<?php
	// Check if the form has been submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Get the form data
		$SName = $_POST['Name'];
		
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
		$sql = "INSERT INTO Screenexist (Name) VALUES (?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $SName);

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
