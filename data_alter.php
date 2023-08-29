<?php
session_start();
include("congfig.php");


if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $txt_date = $_POST['date'];
  $txt_subject_no = $_POST['subject'];
  $txt_summary = $_POST['summary'];
  $txt_acc = $_POST['acc'];
  $txt_price = $_POST['price'];
  $txt_user_no = $_SESSION['user_no'];
  $txt_data_no = $_POST['data_no'];

  if ($txt_acc === "pay") {
    $txt_acc_pay = $txt_price;
    $txt_acc_rec = null;
  } elseif ($txt_acc == "rec") {
    $txt_acc_pay = null;
    $txt_acc_rec = $txt_price;
  }

  try {
    $dbn = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE db2022.s22083013_PTA_data"
      . " SET"
      . " subject_no = :subject_no,"
      . " summary = :summary,"
      . " acc_rec = :acc_rec,"
      . " acc_pay = :acc_pay,"
      . " create_at = :date"
      . " WHERE"
      . " (data_no = :id)";

    $stmt = $dbn->prepare($sql);
    $stmt->bindValue(':subject_no', $txt_subject_no, PDO::PARAM_STR);
    $stmt->bindValue(':summary', $txt_summary, PDO::PARAM_STR);
    $stmt->bindValue(':acc_rec', $txt_acc_rec, PDO::PARAM_STR);
    $stmt->bindValue(':acc_pay', $txt_acc_pay, PDO::PARAM_STR);
    $stmt->bindValue(':date', $txt_date, PDO::PARAM_STR);
    $stmt->bindValue(':id', $txt_data_no, PDO::PARAM_STR);
    $stmt->execute();
    header('Location:search.php');
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}
