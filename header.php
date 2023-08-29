<?php session_start(); ?>

<header>
  <h1><a href="index.php">PTA</a></h1>


  <?php
  if (!isset($_SESSION['username'])) {
    echo "<ul>";
    echo "<li><a href=\"#\">Login</a></li>";
    echo "</ul>";
  } else {
    echo "<ul>";
    echo  "<h3> No." . $_SESSION['user_no'] . "  " . $_SESSION["username"] . "</h3>";
    echo  "<li><a href=\"pta_account.php\">出納帳</a><li>";
    echo  "<li><a href=\"search.php\">報告</a><li>";
    echo  "<li><a href=\"logout.php\" >Logout</a></li>";
    echo  "</ul>";
  }
  ?>

</header>