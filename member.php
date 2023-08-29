<?php
$txt_year = $_GET['year'];
if ($_GET['month'] < 10) {
  $txt_month = "0" . $_GET['month'];
  $now_date =  $_GET['year'] . "-0" . $_GET['month'];
} else {
  $txt_month = $_GET['month'];
  $now_date =  $_GET['year'] . "-" . $_GET['month'];
}
include('congfig.php');
try {
  //全員紀錄
  $dbh = new PDO($dsn, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM db2022.s22083013_PTA_user"
    . " WHERE (YEAR(create_at) < :year) OR (YEAR(create_at) = :year AND MONTH(create_at) <= :month)"
    . " or (YEAR(add_at) < :year) OR (YEAR(add_at) = :year AND MONTH(add_at) <= :month)"
    . " ORDER BY create_at asc ,add_at asc";
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':year', $txt_year, PDO::PARAM_STR);
  $stmt->bindValue(':month', $txt_month, PDO::PARAM_STR);
  $stmt->execute();
  $data = $stmt->rowCount();
  $members = array();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $members[] = $row;
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}

$Pastmember_counts_list = [];
$NewMembers_list = [];
$NewAdd_list = [];



foreach ($members as $member) {
  if ($member['delete_ku'] == 0) {
    //新成員
    if ($member['create_at'] != '') {
      $Date = new DateTime($member['create_at']);
      $y = $Date->format('y');
      $m = $Date->format('m');
      $Create_Year = "20" . $y;
      $NewMembers_list[$Create_Year] += 1;
    }
    if ($member['add_at'] != '') {
      $AddDate = new DateTime($member['add_at']);
      $y = $AddDate->format('y');
      $m = $AddDate->format('m');
      $addYear = "20" . $y;

      $NewAdd_list[$addYear] += 1;
    }
  }
}

$past_year = '';
$PastMemberCounts = 0;

for ($i = 2000; $i <= $txt_year; $i++) {
  if ($Pastmember_counts_list[$i] == '') {
    $Pastmember_counts_list[$i] = 0;
  }
  if ($NewMembers_list[$i] == '') {
    $NewMembers_list[$i] = 0;
  }
  if ($NewAdd_list[$i] == '') {
    $NewAdd_list[$i] = 0;
  }
  $Pastmember_counts_list[$i] = $Pastmember_counts_list[$i - 1] + $NewMembers_list[$i - 1] + $NewAdd_list[$i - 1];
}


$rec_totals = 3600 * $NewMembers_list[$txt_year] +  1080 * $Pastmember_counts_list[$txt_year];
