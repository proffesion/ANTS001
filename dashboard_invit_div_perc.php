<!-- dashboard_invit_div_perc -->
<?php
  include 'app_data/php/head_no_css.php';
  secured();

  // TODAY ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // Rwanda
  $total_rwandan_sell_today_dv = sum_Of_OneVal ("SELECT `Pay_Fr` FROM `divers_sales` WHERE `date`='$today_date'","Pay_Fr");
  $total_rwandan_sell_today_inv = sum_Of_OneVal ("SELECT `Pay_Fr` FROM `selling_e` WHERE `date`='$today_date'","Pay_Fr");
  $total_rwandan_sell_today_tot = $total_rwandan_sell_today_dv + $total_rwandan_sell_today_inv;

  // Congolais
  $total_congo_sell_today_dv = sum_Of_OneVal ("SELECT `Pay_fc` FROM `divers_sales` WHERE `date`='$today_date'","Pay_fc");
  $total_congo_sell_today_inv =  sum_Of_OneVal ("SELECT `Pay_fc` FROM `selling_e` WHERE `date`='$today_date'","Pay_fc");
  $total_congo_sell_today = $total_congo_sell_today_dv + $total_congo_sell_today_inv;

  // Dolar
  $total_dol_sell_today_dv = sum_Of_OneVal ("SELECT `Pay_Dol` FROM `divers_sales` WHERE `date`='$today_date'","Pay_Dol");
  $total_dol_sell_today_inv =  sum_Of_OneVal ("SELECT `Pay_Dol` FROM `selling_e` WHERE `date`='$today_date'","Pay_Dol");
  $total_dol_sell_today = $total_dol_sell_today_dv + $total_dol_sell_today_inv;

  // totay rwandan today
  $total_rwanda_sell_today_rwanda_invitation =  sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `selling_e` WHERE `date`='$today_date'","Total_Available_Rw");
  $total_rwanda_sell_today_rwanda_diver =  sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `divers_sales` WHERE `date`='$today_date'","Total_Available_Rw");
  $total_rwanda_sell_today_rwanda = $total_rwanda_sell_today_rwanda_invitation + $total_rwanda_sell_today_rwanda_diver;

  if ($total_rwanda_sell_today_rwanda > 0) {
    @$inv_percentage = @round(($total_rwanda_sell_today_rwanda_invitation / $total_rwanda_sell_today_rwanda) * 100);
  } else {
    @$inv_percentage = 0;
  }

  if ($total_rwanda_sell_today_rwanda > 0) {
    @$diver_percentage = @round(($total_rwanda_sell_today_rwanda_diver / $total_rwanda_sell_today_rwanda) * 100);
  } else {
    @$diver_percentage = 0;
  }
  # code...

?>
  <p style="padding-top: 17px;font-size: 16px;letter-spacing: 6px;margin: 0px;">Today</p>
  <h2 style="font-size: 26px; margin-bottom: -5px; "><?php echo $today_date; ?></h2>
  <br>
  <!-- <br> -->

 <table style="width:100%;height:100%;box-shadow:none;background:transparent;" border="0">
 <tr>
 <td style="width: 132px;">

 <div class="c100 p<?php echo @$inv_percentage; ?> green">
   <span><?php echo @$inv_percentage; ?>%</span>
   <div class="slice">
       <div class="bar"></div>
       <div class="fill"></div>
   </div>
</div>

 </td>

 <td valign="top" class="adm-f-itm-val-disp">
   <h3>Invitation</h3>
   <label> Frw: </label>     <b> <?php echo @$total_rwandan_sell_today_inv; ?> Frw </b> <hr>
   <label> Fco: </label>     <b> <?php echo @$total_congo_sell_today_inv; ?> Fc </b> <hr>
   <label> $: </label>       <b> <?php echo @$total_dol_sell_today_inv; ?> $ </b> <hr>
   <label> Total: </label>   <b> <?php echo @$total_rwanda_sell_today_rwanda_invitation; ?> Frw </b>
 </td>
 </tr>

 <tr>
 <td style="padding-top: 16px; border-top: 1px dashed #bbb;">

 <div class="c100 p<?php echo @$diver_percentage; ?> orange">
 <span><?php echo @$diver_percentage; ?>%</span>
 <div class="slice">
     <div class="bar"></div>
     <div class="fill"></div>
 </div>
</div>

 </td>

 <td valign="top" class="adm-f-itm-val-disp" style="padding-top: 16px; border-top: 1px dashed #bbb;">
     <h3>Diver</h3>
     <label> Frw: </label>     <b> <?php echo @$total_rwandan_sell_today_dv; ?> Frw </b> <hr>
     <label> Fco: </label>     <b> <?php echo @$total_congo_sell_today_dv; ?> Fc </b> <hr>
     <label> $: </label>       <b> <?php echo @$total_dol_sell_today_dv; ?> $ </b> <hr>
     <label> Total: </label>   <b> <?php echo @$total_rwanda_sell_today_rwanda_diver; ?> Frw </b>
 </td>
 </tr>
 </table>
