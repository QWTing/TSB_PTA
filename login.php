<?php
session_start();
if (isset($_SESSION['username'])) {
  header('location: index.php');
}
include("congfig.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PTA_Home</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php include('header.php') ?>

  <section>
    <div class="wrapper">
      <div class="form-box">
        <div class="login-box">
          <form action="login_xxx.php" method="post">
            <h2>Login</h2>
            <div class="input-box">
              <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>

              <input type="email" name="email" required>
              <label for="email">Email</label>
            </div>
            <div class="input-box">
              <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
              <input type="password" name="password" required>
              <label for="password">Password</label>
            </div>

            <div class="remember-forget">
              <label for="">
                <input type="checkbox">
                remember me
              </label>
              <a href="#">Forget Password</a>
            </div>

            <button type="sumbit" name="sumbit">Login</button>

            <div class="register-link">
              <p>Don't have an account ? <a href="#">Register</a></p>
            </div>
          </form>
        </div>


        <div class="register-box">
          <form action="Register.php" method="post">
            <h2>Sign Up</h2>
            <div class="input-box">
              <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
              <input type="text" name="username" required>
              <label for="">Username</label>
            </div>
            <div class="input-box">
              <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
              <input type="email" name="email" required>
              <label for="">Email</label>
            </div>
            <div class="input-box">
              <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
              <input type="password" name="password" required>
              <label for="">Password</label>
            </div>

            <button type="sumbit">Create</button>

            <div class="register-link">
              <p>Already have an account ? <a href="#" class="login-link">Login</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>

  </section>


  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="script.js"></script>
</body>



</html>