<?php include("member.php") ?>
<h2 class="container">
  <?php echo $txt_year . " 年 " . $txt_month . " 月 " ?>ＰＴＡ決算報告
</h2>
<br>
<p class="container">
</p>
<h4 class="container"><?php echo $txt_year ?>年度 總収入の部</h4>
<div class="container txt_center">
  <table class="table_w" border=1>
    <tr>
      <th>項目</th>
      <th>補正予算額</th>
      <th>決　算　額</th>
      <th>増 減（-）</th>
      <th>備　　　　　考</th>
    </tr>
    <tr>
      <td>会　　費</td>
      <td></td>
      <td><?php echo $rec_totals ?></td>
      <td><?php echo $rec_totals ?></td>
      <td>3,600円×<?php echo $NewMembers_list[$txt_year] ?>名 転出入<?php echo $NewAdd_list[$txt_year] ?>名円<br>
        過年度分<?php echo $Pastmember_counts_list[$txt_year] ?>名 <?php echo 1080 * $Pastmember_counts_list[$txt_year] ?> 円
      </td>
    </tr>
    <tr>
      <td>雑　収　入</td>
      <td></td>
      <td></td>
      <td><?php echo $company_monet_interest[$txt_year - 1] ?></td>
      <td>預金利息
      </td>
    </tr>
    <tr>
      <td>繰　越　金</td>
      <td></td>
      <td><?php echo $yearly_totals[$_GET['year'] - 1] ?></td>
      <td><?php echo $yearly_totals[$_GET['year'] - 1] ?></td>
      <td>前年度繰越金
      </td>
    </tr>
    <tr>
      <td>合　　　　　　　計</td>
      <td></td>
      <td colspan="2"><?php echo $rec_totals + $company_monet_interest[$txt_year - 1] + $yearly_totals[$txt_year - 1] ?></td>
      <td></td>
    </tr>
  </table>
</div>
<br>
<h4 class="container"><?php echo $txt_month ?>月 支出の部</h4>
<div class="container txt_center">
  <table class="table_w" border=1>
    <tr>
      <th>款</th>
      <th>項</th>
      <th>目</th>
      <th>補正予算額</th>
      <th>決　算　額</th>
      <th>増 減（-）</th>
      <th>備　　　　　考</th>
    </tr>
    <tr>
      <?php $total = 0  ?>
      <td rowspan="3">運　営　費</td>
      <td rowspan="2">需　用　費</td>
      <td>消耗品費</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 1;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td>ｲﾝｸｶｰﾄﾘｯｼﾞ・紙代他 コピー代</td>
    <tr>
      <td>備品購入費</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 2;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td>使用料及び賃借料</td>
      <td>印刷費</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 3;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td rowspan="9">活　動　費</td>
      <td rowspan="5">一般活動費</td>
      <td>教育奨励費</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 4;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td>学年委員会</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 5;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td>成人委員会</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 6;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td>校外委員会</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 7;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td>広報委員会</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 8;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td rowspan="2">特別活動費</td>
      <td>行　事　費</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 9;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td>卒業記念品費</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 10;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td>分　担　金</td>
      <td>分　担　金</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 11;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td>渉　外　費</td>
      <td>渉　外　費</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 12;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td>保　険　料</td>
      <td>保　険　料</td>
      <td>保　険　料</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 13;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td>周年行事積立金</td>
      <td>周年行事積立金</td>
      <td>周年行事積立金</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 14;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td>予　備　費</td>
      <td>予　備　費</td>
      <td>予　備　費</td>
      <?php
      $sum = 0;
      foreach ($resultData as $row) :
      ?>
        <?php
        $id = 15;
        if ($row['subject_no'] == $id) {
          $title = $row['subject_name'];
          $sum += $row['acc_rec'];
          $sum -= $row['acc_pay'];
        }
        ?>
      <?php endforeach; ?>
      <?php $total += $sum ?>
      <td></td>
      <td></td>
      <td><?php echo $sum ?></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="3">Total</td>
      <td></td>
      <td></td>
      <td><?php echo $total ?></td>
      <td></td>
    </tr>


  </table>
</div>
<br>
<h4 class="container"><?php echo $txt_year ?>月 残高の部</h4>
<div class="container txt_center">
  <table class="table_w" border="1">
    <tr>
      <th>収入決算額</th>
      <th>支出決算額</th>
      <th>差引残額</th>
    </tr>
    <tr>
      <td><?php echo $rec_totals + $company_monet_interest[$txt_year - 1] + $yearly_totals[$txt_year - 1] ?></td>
      <td><?php echo $yearly_totals[$txt_year] ?></td>
      <td><?php echo $rec_totals + $company_monet_interest[$txt_year - 1] + $yearly_totals[$txt_year - 1] + $yearly_totals[$txt_year] ?></td>
    </tr>
  </table>
</div>
<br>
<h4 class="container">積立金の部　　（周年行事積立金）</h4>
<div class="container txt_center">
  <table class="table_w" border="1">
    <tr>
      <th>前年度 積立総額</th>
      <th>本年度 積立額（利息含む）</th>
      <th>本年度 積立総額</th>
    </tr>
    <tr>
      <td><?php echo $yearly_company_money_totals[$txt_year - 1] ?></td>
      <td><?php echo $company_money[$txt_year] + $company_monet_interest[$txt_year - 1] ?></td>
      <td><?php echo $yearly_company_money_totals[$txt_year] ?></td>
    </tr>
  </table>
</div>