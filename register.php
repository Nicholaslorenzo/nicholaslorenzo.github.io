<?php
require 'config.php';
if(!empty($_SESSION["id"])) {
  header("Location: index.php");
}
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
  if(mysqli_num_rows($duplicate) > 0) {
    echo
    "<div class='message'><p>Username or Email Has Already Taken</p></div> <br>";
    echo 
    "<a href='register.php'><button class='btn'>Go Back</button>";
  } else {
    if($password == $confirmpassword) {
      $query = "INSERT INTO tb_user VALUES ('','$name','$username','$email','$password')";
      mysqli_query($conn, $query);
      echo
      "<div class='message'><p>Registration Success</p></div> <br>";
    } else {
      echo
      "<div class='message'><p>Password Not Match</p></div> <br>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration</title>
    <link rel="shortcut icon" href="img/odop.png" type="image/x-icon">
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="container">
      <div class="box form-box">
        <header>Sign Up</header>
        <form action="" method="post" autocomplete="off">
          <div class="field input">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required value="">
          </div>
          <div class="field input">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required value="">
          </div>
          <div class="field input">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required value="">
          </div>
          <div class="field input">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required value="">
          </div>
          <div class="field input">
            <label for="confirmpassword">Confirm Password</label>
            <input type="password" name="confirmpassword" id="confirmpassword" required value="">
          </div>
          <div class="field">
            <input type="submit" class="btn" name="submit" value="Register" required>
          </div>
          <div class="links">
            Already a member? <a href="login.php">Sign In</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>