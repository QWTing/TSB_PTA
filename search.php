<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location: login.php');
}
include("congfig.php");

include("search_data.php");

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


  <div class="search">
    <form action="search.php" method="get">
      <div class="input-box">
        <select name="year" id=n"">
          <?php
          foreach ($yearly_list as $year) {
            echo "<option value=\"$year\">$year</option>";
          }
          ?>

        </select>
        <label for="">年</label>
      </div>
      <div class="input-box">
        <select name="month" id="">
          <?php
          for ($i = 1; $i <= 12; $i++) {
            if ($txt_month == $i) {
              echo "<option value=\"" . $i . "\" selected>" . $i . "</option>";
            } else {
              echo "<option value=\"" . $i . "\">" . $i . "</option>";
            }
          }
          ?>
        </select>
        <label for="">月</label>
      </div>
      <button class="search_btn" type="submit">搜尋</button>
    </form>
  </div>

  <?php include('search_table.php') ?>




  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="script.js"></script>
</body>



</html>