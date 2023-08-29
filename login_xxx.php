<?php
session_start();
include("congfig.php");

$txt_email = '';
$txt_password = '';


//GETで値を受け取る

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  //POSTデータの取得
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
      $dbh = new PDO($dsn, $username, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      $sql = "SELECT"
        . " um.user_no,"
        . " um.user_name,"
        . " um.user_email,"
        . " um.user_pw"
        . " FROM db2022.s22083013_PTA_user um"
        . " WHERE um.user_email = :email"
        . " AND um.delete_ku = '0'";

      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':email', $txt_email, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch();

      echo "Input Password: " . $txt_password . "<br>";
      echo "Database Password: " . $result['user_pw'] . "<br>";

      echo "Input Password long: " . strlen($txt_password) . "<br>";
      echo "Database Password long: " . strlen($result['user_pw']) . "<br>";

      // if (password_verify('1111', '1111')) {
      if ($txt_password === $result['user_pw']) {
        // echo $result['user_name'] . "さん、ログイン認証に成功しました";
        $_SESSION['username'] = $result['user_name'];
        $_SESSION['user_no'] = $result['user_no'];
        echo $_SESSION['username'];
        echo $_SESSION['user_no'];
        header("Location:index.php");
      } else {
        echo "ログイン認証に失敗しました";
      }
    } catch (PDOException $e) {
      echo ($e->getMessage());
      die();
    }
  }
}
