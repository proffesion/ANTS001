<?php
    include_once '../../app_data/php/head_no_css.php'; // connection
    $day   = @$_GET['day'];
    $month = @$_GET['month'];
    $year  = @$_GET['year'];
    if (empty($day) && empty($month) && empty($year)) {
        $today_date_search = $today_date;
    } else {
        $today_date_search = "$day-$month-$year";
    }

    $inv_total_sales = number_ret("SELECT `s_id` FROM `selling_e` WHERE `date`='$today_date_search'");
    $div_total_sales = number_ret("SELECT `s_id` FROM `divers_sales` WHERE `date`='$today_date_search'");
    $total_sales = $inv_total_sales + $div_total_sales;

?>
<div class="">
  <div class="">
    <br>
    <br>
    <h1 style="text-align:center;"> DATE:  <b><?php echo @$today_date_search; ?></b> </h1>
    <hr>
  </div>
  <div class="row" style="margin: 0px;">
    <div class="col-md-6 subCash" style="text-align:center;">
        <!-- <label>Sells</label> -->
        <h3 style="color: #2196F3;">INVITATION</h3>
        <h1 style="font-size: 90px;color: #ff216c;"><?php echo $inv_total_sales; ?></h1>
    </div>
    <div class="col-md-6 subCash" style="text-align:center;">
        <!-- <label>Sells</label> -->
        <h3 style="color: #2196F3;">DIVERS</h3>
        <h1 style="font-size: 90px;color: #ff216c;"><?php echo $div_total_sales; ?></h1>
    </div>
  </div>
  <hr style="margin: 3px;">
  <h1 style="text-align:center;"><label style="font-size: 41px;color: #8e8e8e;">TOTAL: </label>
    <b style="font-weight: 900; font-size: 77px; color: #2196f3;"> <?php echo $total_sales; ?> </b> </h1>
</div>
