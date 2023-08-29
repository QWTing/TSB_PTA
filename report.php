<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location: login.php');
}
include("congfig.php");
include('search_data.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $txt_year = $_GET['year'];
  $txt_month = $_GET['month'];
}
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

  <?php include('report_table.php') ?>

  <div class="back_btn">
    <a href="search.php"><button>Back</button></a>
  </div>




  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="script.js"></script>
</body>



</html>