<?php
  include 'app_data/php/head_no_css.php';
  secured();


  $inv_total_sales = number_ret("SELECT `s_id` FROM `selling_e` WHERE `date`='$today_date'");
  $div_total_sales = number_ret("SELECT `s_id` FROM `divers_sales` WHERE `date`='$today_date'");
  $total_sales = $inv_total_sales + $div_total_sales;

?>







<h2 class="adm-title" style="font-size:19px;">Rate</h2>
<table class="Rate-table" border="1">
  <tr>
    <td> <b class="fa fa-caret-up"></b> <u><?php echo retrieve_data('giv_dol_rw','taux','id','1'); ?> Frw</u> </td>
    <td> <b class="fa fa-caret-down"></b> <u><?php echo retrieve_data('rec_dol_rw','taux','id','1'); ?> Frw</u> </td>
  </tr>
  <tr>
    <td> <b class="fa fa-caret-up"></b> <u><?php echo retrieve_data('giv_dol_fc','taux','id','1'); ?> Fc</u> </td>
    <td> <b class="fa fa-caret-down"></b> <u><?php echo retrieve_data('rec_dol_fc','taux','id','1'); ?> Fc</u> </td>
  </tr>
</table>


<h2 class="adm-title" style="font-size:19px;">Total</h2>


<div class="cont-section-sale-state">
<section style="padding: 6px;">






<table border="0" width="100%" class="sale-state">
  <tr>
    <td class="td1" rowspan="2" style="">
        <u>
          Total <br>
          Sales
        </u>
        <br> <i> Today </i>
    </td>
    <td class="td2" rowspan="2">
      <h1> <?php echo $total_sales; ?> </h1>
    </td>
      <td class="td3">
        <u> Invitation </u><br>
        <b> <?php echo $inv_total_sales; ?> </b>
      </td>
  </tr>
  <tr>
    <td class="td3">
      <u> Diver </u><br>
      <b> <?php echo $div_total_sales; ?>  </b>
    </td>
  </tr>
</table>
</section>
<section style="background:#75a4fa;">
ANTARES
</section>
</div>
