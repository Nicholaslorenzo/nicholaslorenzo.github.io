<?php
require 'config.php';
if(!empty($_SESSION["id"])) {
  header("Location: index.php");
}
if(isset($_POST["submit"])){
  $usernameemail = $_POST["usernameemail"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0) {
    if($password == $row["password"]) {
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: index.php");
    } else {
      echo
      "<div class='message'><p>Wrong Password</p></div> <br>";
    }
  } else {
    echo
    "<div class='message'><p>User Not Registered</p></div> <br>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="shortcut icon" href="img/odop.png" type="image/x-icon">
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="container">
      <div class="box form-box">
        <header>Login</header>
        <form action="" method="post" autocomplete="off">
          <div class="field input">
            <label for="email">Username or Email</label>
            <input type="text" name="usernameemail" id="usernameemail" required value="">
          </div>
          <div class="field input">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required value="">
          </div>
          <div class="field">
            <input type="submit" class="btn" name="submit" value="Login" required>
          </div>
          <div class="links">
            Don't have account? <a href="register.php">Sign Up</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>