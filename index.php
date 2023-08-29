<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location: login.php');
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
    <h2>
      Welcome <?php echo $_SESSION['username']; ?>
    </h2>
  </section>


  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="script.js"></script>
</body>



</html>