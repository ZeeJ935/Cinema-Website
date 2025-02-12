<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login/Sign Up and Sign In</title>
    <link rel="stylesheet" href="admin.css" />
    <?php include 'links.php' ?>
  </head>
  <body>
    
      <div class="home">
      <a style="text-decoration: none;", href="cinema.html">
      <h1 style="color: white;">Home</h1></a>
      </div>
    
    <div class="box">
      <span class="borderline"> </span>
      <form>
        <div class="inputBox">
          <h2>Sign In</h2>
          <input type="text" required="Required!" />
          <span>Username</span>
          <i> </i>
        </div>

        <div class="inputBox">
          <input type="password" required="Required!" />
          <span>Password</span>
          <i>  </i>
        </div>

        <div class="links">
          <a href="#">Forgot Password</a>
          <a href="sign_up_page.html"> Sign Up</a>
        </div>
        <input type="submit" value="Login" />

      </form>
    </div>
  </body>
</html>