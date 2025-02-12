<?php
    
 include 'dbconnect.php';
// Get the form data

$name = $_POST['name'];
$bio = $_POST['bio'];
$facebook = $_POST['facebook'];
$twitter = $_POST['twitter'];
$photo = $_FILES['photo']['name'];

// Connect to the database
//$conn = OpenCon();
// Check if the connection was successful
if (!$con) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Insert the data into the database
$sql = "update profile 
SET name='$name', bio='$bio', photo='$photo',fblink='$facebook',twtlink='$twitter' where user_id=$id";//bing schling

if (mysqli_query($con, $sql)) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// Close the database connection
//CloseCon($con);
?>



<style>
    
    form {
        max-width: 600px;
        margin: 0 auto;
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 5px;
    }
    input[type=text], textarea {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        resize: none;
    }
    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type=submit]:hover {
        background-color: #45a049;
    }
    .message {
        background-color: #dff0d8;
        border-color: #d6e9c6;
        color: #3c763d;
        padding: 15px;
        margin-top: 20px;
        border-radius: 5px;
    }
</style>

<?php
if(isset($_POST['submit'])) {
    // Include database connection code
    session_start();
$id = $_SESSION['user_id']
var_dump($id);
    include 'dbconnect.php';

    // Get form data
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $photo = $_FILES['photo']['name'];

    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];

    // Upload photo


    // Insert data into database
    $sql = "INSERT INTO profile (user_id,name, bio, photo, fblink, twtlink, CP) VALUES ('$id','$name', '$bio', '$photo', '$facebook', '$twitter','0')";
    $result = mysqli_query($con, $sql);
    var_dump($result);
    // Display confirmation message
    if ($result) {
        move_uploaded_file($_FILES["photo"]["tmp_name"],"css/".$_FILES["photo"]["name"]);
        echo '
        <div class="alert alert-success" role="alert">
  A simple success alert—check it out!
  <div class="message">Profile updated successfully!</div>
  </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
        A simple danger alert—check it out!
      <div class="message">Error updating profile.</div></div>';
    }
}
?>

    <a href="profile.php"><button>profile</button></a>

