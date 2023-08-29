<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location: login.php');
}
include("congfig.php");

try {
  $dbn = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT"
    . " *"
    . " FROM"
    . " db2022.s22083013_PTA_subject";
  $data = $dbn->prepare($sql);
  $data->execute();
  $txt_date = '';
  $txt_subject = '';
  $txt_summary = '';
  $txt_acc = '';
  $txt_price = '';
} catch (PDOException $e) {
  echo $e->getCode();
}

if ($_GET['id']) {
  try {
    $dbn = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT"
      . " *"
      . " FROM"
      . " db2022.s22083013_PTA_data data"
      . " INNER JOIN db2022.s22083013_PTA_subject su"
      . " ON data.subject_no = su.subject_no"
      . " WHERE data.data_no = :id";
    $stmt = $dbn->prepare($sql);
    $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();

    $createDate = new DateTime($result['create_at']);
    $y = $createDate->format('Y');
    $m = $createDate->format('m');
    $d = $createDate->format('d');

    $txt_date = $y . '-' . $m . '-' . $d;
    $txt_subject = $result['subject_name'];
    $txt_summary = $result['summary'];
    if ($result['acc_rec']) {
      $txt_acc = "收入";
      $txt_price = $result['acc_rec'];
    } else {
      $txt_acc = "支出";
      $txt_price = $result['acc_pay'];
    }
  } catch (PDOException $e) {
    echo $e->getCode();
  }
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
  <?php
  if ($_GET['id']) {
    echo "<h2>更新</h2>";
  } else {
    echo "<h2>新增</h2>";
  }
  ?>
  <div class="data">
    <form action="<?php if ($_GET['id']) {
                    echo "data_alter.php";
                  } else {
                    echo "data_enter.php";
                  } ?>" method="post">
      <div class="input-box">
        <label for="">日期</label>
        <input type="date" name="date" value="<?php echo $txt_date; ?>">
      </div>
      <div class="input-box">
        <label for="">科目名</label>
        <select name="subject" id="">
          <option value="" selected>請選擇</option>
          <?php
          foreach ($data as $row) {
            if ($txt_subject == $row['subject_name']) {
              echo "<option value=\"" . $row['subject_no'] . "\" selected>" . $row['subject_name'] . "</option>";
            } else {
              echo "<option value=\"" . $row['subject_no'] . "\">" . $row['subject_name'] . "</option>";
            }
          }
          ?>
        </select>
      </div>
      <div class="input-box">
        <label for="">摘要</label>
        <input type="text" name="summary" value="<?php echo $txt_summary ?>">
      </div>
      <div class="input-box">
        <label for="">收支</label>
        <select name="acc" id="">

          <option value="pay" <?php
                              if ($txt_acc == "支出") {
                                echo "selected";
                              } ?>>支出</option>
          <option value="rec" <?php
                              if ($txt_acc == "收入") {
                                echo "selected";
                              } ?>>收入</option>
        </select>
      </div>

      <div class="input-box">
        <label for="">金額</label>
        <input type="text" name="price" value="<?php echo $txt_price; ?>">
      </div>
      <input type="hidden" name="user_no" value="<?php echo $_SESSION['user_no']; ?>">

      <?php
      if ($_GET['id']) {
        echo "<input type=\"hidden\" name=\"data_no\" value=\"" . $_GET['id'] . "\">";
        echo "<button type=\"submit\">更新</button>";
      } else {
        echo "<button type=\"submit\">新增</button>";
      }
      ?>


    </form>
  </div>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="script.js"></script>
</body>



</html>