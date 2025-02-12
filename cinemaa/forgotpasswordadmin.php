<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login/Sign Up and Sign In</title>
    <link rel="stylesheet" href="forgotpassword.css" />
</head>

<body>

    <?php
    include 'dbconnect.php';
    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($con, $_POST["email"]); //emailid
        $phoneno = mysqli_real_escape_string($con, $_POST["phoneno"]); //phone no
        $password = mysqli_real_escape_string($con, $_POST["password"]); //password
        $confirm_password = mysqli_real_escape_string($con, $_POST["confirm_password"]); //confirm password



        $sql = "SELECT * FROM admininfo WHERE email='$email' and phoneno = '$phoneno'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 0) {
    ?>
            <script>
                alert("You dont have an account as an Admin.");
            </script>
            <?php
        } else {

            if (strlen($password) > 8) {
            ?>
                <script>
                    alert("Password should not exceed 8 characters");
                </script>
                <?php
            }

            // Update the password for the user in the database
            else if ($password == $confirm_password) {
                $updateSql = "UPDATE admininfo SET password='$password' 
                WHERE email='$email' and phoneno='$phoneno'";
                $updateResult = mysqli_query($con, $updateSql);

                if ($updateResult) {
                ?>
                    <script>
                        alert("Password updated successfully!");
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        alert("Password could not be updated. Please try again later.");
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    alert("Password and Confirm Password Do not Match. ");
                </script>
    <?php
            }
        }
    } ?>

    <div class="box">
        <span class="borderline"> </span>
        <form method="post">
            <div class="inputBox">
                <h2>Change Password</h2>
                <br>
                <input type="email" required="Required!" name="email" />
                <span>Email</span>
                <i> </i>
            </div>
            <div class="inputBox">
                <input type="text" required="Required!" name="phoneno" />
                <span>Phone No (0123-1234567)</span>
                <i> </i>
            </div>
            <div class="inputBox">
                <input type="password" required="Required!" name="password" />
                <span>New Password</span>
                <i> </i>
            </div>
            <div class="inputBox">
                <input type="password" required="Required!" name="confirm_password" />
                <span>Confirm New Password</span>
                <i> </i>
            </div>

            <br>
            <input type="submit" value="Enter" name="submit" />

        </form>
    </div>
</body>