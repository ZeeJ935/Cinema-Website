<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login/Sign Up and Sign In</title>
  <link rel="stylesheet" href="signupcss.css" />
</head>

<body>
  <?php
  include 'dbconnect.php';
  if (isset($_POST['submit'])) {
    $un = mysqli_real_escape_string($con, $_POST["un"]); //username
    $pwd = mysqli_real_escape_string($con, $_POST["pwd"]); //password
    $pwd1 = mysqli_real_escape_string($con, $_POST["pwd1"]); //confirm password
    $em = mysqli_real_escape_string($con, $_POST["em"]); //email
    $age = mysqli_real_escape_string($con, $_POST["age"]);  // age
    $cnic = mysqli_real_escape_string($con, $_POST["cnic"]); //cnic
    $ph = mysqli_real_escape_string($con, $_POST["ph"]); //phone

    $emailquery = "select * from userinfo where email= '$em'";
    $query = mysqli_query($con, $emailquery);
    $emailcount = mysqli_num_rows($query);
    // Validate CNIC format
    if (!preg_match('/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/', $cnic)) {
  ?>
      <script>
        alert("Invalid CNIC format");
      </script>
    <?php
    }
    // Validate phone number format
    else if (!preg_match('/^[0-9]{4}-[0-9]{7}$/', $ph)) {
    ?>
      <script>
        alert("Invalid phone number format");
      </script>
    <?php
    } else if ($emailcount > 0) {
    ?>
      <script>
        alert("Email Already Exists");
      </script>
      <?php
    } else {
      if (strlen($pwd) > 8) {
      ?>
        <script>
          alert("Password should not exceed 8 characters");
        </script>
        <?php
      }
      else if ($pwd == $pwd1) {
        $insertquery = "INSERT INTO userinfo(username, password, confirm_password, email, age, cnic, phone_no,status) 
        VALUES ('$un','$pwd','$pwd1','$em','$age','$cnic','$ph',"unblocked")";
        $iquery = mysqli_query($con, $insertquery);
        if ($iquery) {
        ?>
          <script>
            alert("Account Created Successfully");
          </script>
        <?php
        } else {
        ?>
          <script>
            alert("Account Not Created");
          </script>
        <?php
        }
      }
       else {
        ?>
        <script>
          alert("Password and Confirm Password Dont Match");
        </script>
  <?php
      }
    }
  }
  ?>
  <div class="box">
    <span class="borderline"> </span>
    <form method="post">
      <div class="inputBox">
        <h2>Sign Up</h2>
        <input type="text" required="Required!" name="un" />
        <span>Username</span>
        <i> </i>
      </div>

      <div class="inputBox">
        <input type="password" required="Required!" name="pwd" />
        <span>Password</span>
        <i> </i>
      </div>

      <div class="inputBox">
        <input type="password" required="Required!" name="pwd1" />
        <span>Confirm Password</span>
        <i> </i>
      </div>

      <div class="inputBox">
        <input type="email" required="Required!" name="em" />
        <span>Email</span>
        <i> </i>
      </div>

      <div class="inputBox">
        <input type="number" min="1" required="Required!" name="age" />
        <span>Age</span>
        <i> </i>
      </div>

      <div class="inputBox">
        <input type="text" title="CNIC_SAMPLE:12345-1234567-1" required="Required!" name="cnic" />
        <span>CNIC (12345-1234567-1)</span>
        <i> </i>
      </div>

      <div class="inputBox">
        <input type="text" title="PHONE_NUMBER_SAMPLE:0123-1234567" required="Required!" name="ph" />
        <span>Phone Number (0123-1234567)</span>
        <i> </i>
      </div>
      <div class="butsub">
        <input type="submit" value="Sign Up" name="submit" />
      </div>
    <div class="links">
      <p>Already Have An Account!</p>
      <a href="login_page.php">Login</a>
    </div>
  </div>
  </form>
</body>

</html>