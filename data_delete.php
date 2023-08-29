<?php
include('congfig.php');
try {
  $dbh = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "DELETE FROM db2022.s22083013_PTA_data WHERE (data_no = :id)";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_STR);
  $stmt->execute();
  header('Location:search.php');
} catch (PDOException $e) {
  echo $e->getMessage();
}
