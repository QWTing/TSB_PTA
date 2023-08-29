<?php if (!$_GET['year']) : ?>
  <?php foreach ($yearly_list as $year) :
    $current_month = ""; //用來追蹤目前的月份 //歸零
  ?>
    <div class="search_table">
      <table border="1">
        <tr>
          <th colspan="2"><?php echo $year ?>年度</th>
          <th colspan="2">摘要</th>
          <th colspan="3">金額</th>
          <th rowspan="2" colspan="2"></th>

        </tr>
        <tr>
          <td>月</td>
          <td>日</td>
          <td>科目名</td>
          <td>詳細</td>
          <td>収入金額</td>
          <td>支払金額</td>
          <td>差引残額</td>
        </tr>
        <?php foreach ($resultData as $row) : ?>
          <?php
          $createDate = new DateTime($row['create_at']);
          $y = $createDate->format('Y');
          $m = $createDate->format('m');
          $d = $createDate->format('d');

          ?>
          <?php if ($y == $year) : ?>
            <?php if ($current_month == "") {
              $current_month = $m;
              $now_date = $y . "-" . $m;
            } elseif ($current_month != $m) {
              echo "<tr>
                    <td colspan=\"4\">" . $current_month . "月總計</td>
                    <td colspan=\"3\">" . $monthly_totals[$now_date] . "</td>
                  </tr>";
              $current_month = $m;
              $now_date = $y . "-" . $m;
            };
            ?>
            <tr>
              <td><?php echo $m ?></td>
              <td><?php echo $d ?></td>
              <td><?php echo $row['subject_name'] ?></td>
              <td><?php echo $row['summary'] ?></td>
              <td><?php echo $row['acc_rec'] ?></td>
              <td><?php echo $row['acc_pay'] ?></td>
              <td><?php echo $row['acc_rec'] - $row['acc_pay'] ?></td>
              <td><a href="pta_account.php?id=<?php echo $row['data_no'] ?>">修正</a></td>
              <td><a href="data_delete.php?id=<?php echo $row['data_no'] ?>">刪除</a></td>
            </tr>
          <?php endif ?>
        <?php endforeach; ?>
        <tr>
          <td colspan="4"><?php echo $current_month; ?>月總計</td>
          <td colspan="3"><?php echo $monthly_totals[$now_date] ?></td>
        </tr>
        <tr>
          <td colspan="4"><?php echo $year ?>年總計</td>
          <td colspan="3"><?php echo $yearly_totals[$year] ?></td>
        </tr>

      </table>
    </div>
  <?php endforeach ?>
<?php else : ?>
  <?php
  $current_month = ""; //用來追蹤目前的月份 //歸零
  $year = $_GET['year'];
  ?>
  <div class="search_table">
    <table border="1">
      <tr>
        <th colspan="2"><?php echo $year ?>年度</th>
        <th colspan="2">摘要</th>
        <th colspan="3">金額</th>
        <th rowspan="2" colspan="2"></th>

      </tr>
      <tr>
        <td>月</td>
        <td>日</td>
        <td>科目名</td>
        <td>詳細</td>
        <td>収入金額</td>
        <td>支払金額</td>
        <td>差引残額</td>
      </tr>
      <?php foreach ($resultData as $row) : ?>
        <?php
        $createDate = new DateTime($row['create_at']);
        $y = $createDate->format('Y');
        $m = $createDate->format('m');
        $d = $createDate->format('d');

        ?>
        <?php if ($y == $year) : ?>
          <?php if ($current_month == "") {
            $current_month = $m;
            $now_date = $y . "-" . $m;
          } elseif ($current_month != $m) {
            echo "<tr>
                    <td colspan=\"4\">" . $current_month . "月總計</td>
                    <td colspan=\"3\">" . $monthly_totals[$now_date] . "</td>
                  </tr>";
            $current_month = $m;
            $now_date = $y . "-" . $m;
          };
          ?>
          <tr>
            <td><?php echo $m ?></td>
            <td><?php echo $d ?></td>
            <td><?php echo $row['subject_name'] ?></td>
            <td><?php echo $row['summary'] ?></td>
            <td><?php echo $row['acc_rec'] ?></td>
            <td><?php echo $row['acc_pay'] ?></td>
            <td><?php echo $row['acc_rec'] - $row['acc_pay'] ?></td>
            <td><a href="pta_account.php?id=<?php echo $row['data_no'] ?>">修正</a></td>
            <td><a href="data_delete.php?id=<?php echo $row['data_no'] ?>">刪除</a></td>
          </tr>
        <?php endif ?>
      <?php endforeach; ?>
      <tr>
        <td colspan="4"><?php echo $current_month; ?>月總計</td>
        <td colspan="3"><?php echo $monthly_totals[$now_date] ?></td>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td colspan="4"><?php echo $year ?>年總計</td>
        <td colspan="3"><?php echo $yearly_totals[$year] ?></td>
        <td colspan="2"></td>
      </tr>

    </table>
  </div>
<?php endif ?>
<?php if (isset($_GET['year'])) : ?>
  <div class=" report_show">
    <form action="report.php" method="get">
      <input type="hidden" name="year" value="<?php echo $_GET['year'] ?>">
      <input type="hidden" name="month" value="<?php echo $_GET['month'] ?>">
      <button type="submit">show</button>
    </form>
  </div>
<?php endif ?>