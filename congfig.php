<?php
//データベース接続情報を格納
$host = "db.well-field.co.jp";
$db = "db2022";
$username = "tsb22";
$password = "tsb202204";

$dsn = "mysql:dbname=$db;host=$host;";


try {
  $dbn = new PDO($dsn, $username, $password);
  $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connection successful";
  $sql = "SELECT * FROM db2022.s22083013_PTA_user";

  // prepare 方法來準備一個 SQL 查詢，然後使用 execute 方法來執行這個已準備好的查詢
  $users = $dbn->prepare($sql);
  $users->execute();
  $data = $users->rowCount();

  foreach ($users as $user) {
    echo "<li>" . $user['user_name'] . "</li>";
  }
} catch (PDOException $error) {
  echo $error->getCode();
}





// try {
//   $dbh = new PDO($dsn, $username, $password);
//   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   // 資料取得
//   $sql = "SELECT"
//     . "*"
//     . "FROM 22083013_data;";
//   $stmt = $dbh->prepare($sql);
//   $stmt->execute();

//   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     $category_mast_data[] = $row;
//   }

//   foreach ($category_mast_data as $row) {
//     echo $row;  
//   }
// } catch (PDOException $e) {
//   echo ($e->getMessage());
//   die();
// }
