<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
    <link rel="stylesheet" href="login_page_css.css" />
</head>

<body>
    <?php
    include 'dbconnect.php';
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare SQL statement to check if email and password exist in userinfo table
        $emailquery = "SELECT adminid FROM admininfo WHERE email = '$email' AND password = '$password'";
        $query = mysqli_query($con, $emailquery);
        $emailcount = mysqli_num_rows($query);

        // Check if there is a matching record in the database
        if ($emailcount == 1) {
            $row = mysqli_fetch_assoc($query);
            $adminid = $row['adminid'];
            session_start();
            $_SESSION['adminid'] = $adminid;
            header("location:/adminmovies/movietable.php"); // Redirecting to dashboard page
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
                <h2>Sign In (Admin)</h2>
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
                <a href="forgotpasswordadmin.php">Forgot Password</a>
            </div>
            <input type="submit" value="Login" name="submit" />
        </form>
    </div>
</body>

</html>