<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login/Sign Up and Sign In</title>
    <link rel="stylesheet" href="login_page_css.css" />
</head>

<body>
    <?php
    include 'dbconnect.php';
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare SQL statement to check if email and password exist in userinfo table
        $emailquery = "SELECT user_id, userinfo.status FROM userinfo WHERE email = '$email' AND password = '$password'";
        $query = mysqli_query($con, $emailquery);
        $emailcount = mysqli_num_rows($query);

        // Check if there is a matching record in the database
        if ($emailcount == 1) {

            $row = mysqli_fetch_assoc($query);
            $user_id = $row['user_id'];
            $status = $row['status'];
            if($status == 'unblocked')
            {
                session_start();
            $_SESSION['user_id'] = $user_id;
            header("location:cinema2.php"); // Redirecting to dashboard page
            }
            else{
                ?>
            <script>
                alert("Access Denied."); 
            </script>
    <?php
            }
        } else {
    ?>
            <script>
                alert("Wrong Email or Password."); 
            </script>
    <?php
        }
    }

    ?>
    <div class="box">
        <span class="borderline"> </span>
        <form method="post">
            <div class="inputBox">
                <h2>Sign In</h2>
                <input type="email" required="Required!" name="email" />
                <span>Email</span>
                <i> </i>
            </div>

            <div class="inputBox">
                <input type="password" required="Required!" name="password" />
                <span>Password</span>
                <i> </i>
            </div>

            <div class="links">
                <a href="forgotpassword.php">Forgot Password</a>
                <a href="signup2.php"> Sign Up</a> 
            </div>
            <input type="submit" value="Login" name="submit" />
        </form>
    </div>
</body>

</html>