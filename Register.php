<?php
session_start();
include("congfig.php");

$txt_email = '';
$txt_password = '';


//GETで値を受け取る

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  //POSTデータの取得
  $txt_username = $_POST['username'];
  $txt_email = $_POST['email'];
  $txt_password = $_POST['password'];

  $hashedPassword = password_hash($txt_password, PASSWORD_DEFAULT);

  $err = "";

  if ($txt_email == "") {
    $err .= "email is wrong";
  }

  if ($txt_password == "") {
    $err .= "password is wrong";
  }

  if ($err == "") {
    try {
      $dbh = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO"
        . " db2022.s22083013_PTA_user("
        . " user_name,"
        . " user_email,"
        . " user_pw)"
        . " VALUES "
        . " (:username,"
        . " :email,"
        . " :pw)";

      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':username', $txt_username, PDO::PARAM_STR);
      $stmt->bindValue(':email', $txt_email, PDO::PARAM_STR);
      $stmt->bindValue(':pw', $txt_password, PDO::PARAM_STR);
      $stmt->execute();

      $_SESSION['username'] = $txt_username;
      header("Location:index.php");
    } catch (PDOException $e) {
      echo ($e->getMessage());
      die();
    }
  }
}
