<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if ($_GET['year'] != '' & $_GET['month'] != '') {
    $txt_year = $_GET['year'];
    $txt_month = $_GET['month'];
    try {
      $dbn = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * "
        . " FROM db2022.s22083013_PTA_data da"
        . " INNER JOIN db2022.s22083013_PTA_subject su"
        . " ON da.subject_no = su.subject_no"
        . " WHERE year(da.create_at) = :year and month(da.create_at) = :month and user_no = :user_no"
        . " ORDER BY da.create_at desc";

      $stmt = $dbn->prepare($sql);
      $stmt->bindValue(':month', $txt_month, PDO::PARAM_STR);
      $stmt->bindValue(':year', $txt_year, PDO::PARAM_STR);
      $stmt->bindValue(':user_no', $_SESSION['user_no'], PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->rowCount();
      $resultData = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $resultData[] = $row;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  } else {
    $txt_year = '';
    $txt_month = '';
    try {
      $dbn = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * "
        . " FROM db2022.s22083013_PTA_data da"
        . " INNER JOIN db2022.s22083013_PTA_subject su"
        . " ON da.subject_no = su.subject_no"
        . " ORDER BY da.create_at desc";

      $stmt = $dbn->prepare($sql);
      $stmt->execute();
      $data = $stmt->rowCount();
      $resultData = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $resultData[] = $row;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
try {
  $sql = "SELECT * "
    . " FROM db2022.s22083013_PTA_data da"
    . " INNER JOIN db2022.s22083013_PTA_subject su"
    . " ON da.subject_no = su.subject_no"
    . " ORDER BY da.create_at desc";

  $stmt = $dbn->prepare($sql);
  $stmt->execute();
  $data = $stmt->rowCount();
  $ALLData = array();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $ALLData[] = $row;
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}

$date_list = [];
$yearly_list = [];
$monthly_totals = []; //用來存儲每個月份
$yearly_totals = []; //用來存儲每個年份
$yearly_over = []; //用於存儲每年剩餘
$current_year = ""; //用來追蹤目前的年
$company_money = []; //周年行事積立金
$company_monet_interest = []; //周年行事積立金利息
$yearly_company_money_totals = [];

foreach ($resultData as $row) {
  $createDate = new DateTime($row['create_at']);
  $y = $createDate->format('y');
  $m = $createDate->format('m');
  $date = "20" . $y . "-" . $m;
  $year = "20" . $y;
  if (!in_array($date, $date_list)) {
    $date_list[] = $date;
  }
  $total = $row['acc_rec'] - $row['acc_pay'];
  if (!isset($monthly_totals[$date])) {
    $monthly_totals[$date] = 0;
  }
  $monthly_totals[$date] += $total;
}



foreach ($ALLData as $row) {
  $createDate = new DateTime($row['create_at']);
  $y = $createDate->format('y');
  $m = $createDate->format('m');
  $year = "20" . $y;
  if (!in_array($year, $yearly_list)) {
    $yearly_list[] = $year;
  }

  $total = $row['acc_rec'] - $row['acc_pay'];
  if (!isset($monthly_totals[$date])) {
    $month_totals[$date] = 0;
  }
  if (!isset($yearly_totals[$year])) {
    $yearly_totals[$year] = 0;
  }
  $yearly_totals[$year] += $total;

  if (!isset($company_money[$year])) {
    $company_money[$year] = 0;
  }
  if ($row['subject_no'] == 14) {
    $company_money[$year] += ($row['acc_rec'] - $row['acc_pay']);
  }
}


$new_yearly_list = $yearly_list;
sort($new_yearly_list);

foreach ($new_yearly_list as $year) {
  if (!isset($past_year)) {
    $past_year = $year;
    $yearly_company_money_totals[$year] = $company_money[$year];
    $yearly_over[$year] = $yearly_totals[$year];
  } else {
    $yearly_company_money_totals[$year] = $yearly_company_money_totals[$past_year] + $company_monet_interest[$past_year] +  $company_money[$year];
    $yearly_over[$year] += ($yearly_company_money_totals[$year] + $yearly_totals[$year]);
    $past_year = $year;
  }
  $company_monet_interest[$year] = $yearly_company_money_totals[$year] * 0.03;
}
