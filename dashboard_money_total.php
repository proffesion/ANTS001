<?php
  include 'app_data/php/head_no_css.php';
  secured();
  // $yesterday_date
  // $today_date

  // Rwandan yesterday
  $total_rwandan_sell_yesterday_dv = sum_Of_OneVal ("SELECT `Pay_Fr` FROM `divers_sales` WHERE `date`='$yesterday_date'","Pay_Fr");
  $total_rwandan_sell_yesterday_inv = sum_Of_OneVal ("SELECT `Pay_Fr` FROM `selling_e` WHERE `date`='$yesterday_date'","Pay_Fr");
  $total_rwandan_sell_yesterday_tot = $total_rwandan_sell_yesterday_dv + $total_rwandan_sell_yesterday_inv;

  // Congolais yesterday
  $total_congo_sell_yesterday_dv = sum_Of_OneVal ("SELECT `Pay_fc` FROM `divers_sales` WHERE `date`='$yesterday_date'","Pay_fc");
  $total_congo_sell_yesterday_inv =  sum_Of_OneVal ("SELECT `Pay_fc` FROM `selling_e` WHERE `date`='$yesterday_date'","Pay_fc");
  $total_congo_sell_yesterday = $total_congo_sell_yesterday_dv + $total_congo_sell_yesterday_inv;

  // Dolar yesterday
  $total_dol_sell_yesterday_dv = sum_Of_OneVal ("SELECT `Pay_Dol` FROM `divers_sales` WHERE `date`='$yesterday_date'","Pay_Dol");
  $total_dol_sell_yesterday_inv =  sum_Of_OneVal ("SELECT `Pay_Dol` FROM `selling_e` WHERE `date`='$yesterday_date'","Pay_Dol");
  $total_dol_sell_yesterday = $total_dol_sell_yesterday_dv + $total_dol_sell_yesterday_inv;

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

  // total rwandan Yesterday
  $total_rwanda_sell_yesterday_rwanda_invitation =  sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `selling_e` WHERE `date`='$yesterday_date'","Total_Available_Rw");
  $total_rwanda_sell_yesterday_rwanda_diver =  sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `divers_sales` WHERE `date`='$yesterday_date'","Total_Available_Rw");
  $total_rwanda_sell_yesterday_rwanda = $total_rwanda_sell_yesterday_rwanda_diver + $total_rwanda_sell_yesterday_rwanda_invitation;
// echo "total rwanda invitation: $total_rwanda_sell_yesterday_rwanda_invitation<br>";
// echo "total rwanda diver: $total_rwanda_sell_yesterday_rwanda_diver<br>";

?>


<h2 class="adm-title"> Money Sell </h2>

<div class="row money-disp">
  <div class="col-md-4 itm-disp" style="background:#fff;">
     <div class="cnt">
      <h3>
        <b class="fa fa-money"></b> <b> Rwandans </b>
      </h3>
      <section>
        <b><?php echo @$total_rwandan_sell_yesterday_tot; ?>Frw</b> <u>Yesterday</u>
      </section>
      <h2><?php echo @$total_rwandan_sell_today_tot; ?>Frw</h2>
   </div>
  </div><!-- .col-md-4 -->
  <div class="col-md-4 itm-disp" style="background:#f6f6f6;">
     <div class="cnt">
       <h3>
         <b class="fa fa-money"></b> <b> Dolars </b>
       </h3>
       <section>
         <b><?php echo @$total_dol_sell_yesterday; ?>$</b> <u>Yesterday</u>
       </section>
       <h2><?php echo @$total_dol_sell_today; ?>$</h2>
   </div>
  </div>
  <div class="col-md-4 itm-disp" style="background:#fff;">
     <div class="cnt">
         <h3>
           <b class="fa fa-money"></b> <b> Congo </b>
         </h3>
         <section>
           <b><?php echo @$total_congo_sell_yesterday; ?>c</b> <u>Yesterday</u>
         </section>
         <h2><?php echo @$total_congo_sell_today; ?>Fc</h2>
   </div>
  </div>
</div>









        <h2 class="adm-title">Total</h2>

        <div class="admin-total-conyainner-dv">
            <table border="0" width="100%" style="box-shadow: none;">
              <tr>
                <td class="td1">

                  <?php
                  if ($total_rwanda_sell_today_rwanda > $total_rwanda_sell_yesterday_rwanda) {
                    echo '<h1 class="fa fa-caret-up" style="color: #37c337;"></h1>';
                  } else {
                    echo '<h1 class="fa fa-caret-down" style="color: red;"></h1>';
                  }
                   ?>
                  <!--  -->

                </td>
                <td class="td2">
                  <?php if ($total_rwanda_sell_today_rwanda > $total_rwanda_sell_yesterday_rwanda) { ?>
                    <b>Good!</b>
                    Yesterday was:
                    <br> <b><?php echo $total_rwanda_sell_yesterday_rwanda; ?>Frw</b>
                  <?php } else { ?>
                    Yesterday was:
                    <br> <b><?php echo $total_rwanda_sell_yesterday_rwanda; ?>Frw</b>
                  <?php } ?>



                </td>
                <td class="td3">  <?php echo @$total_rwanda_sell_today_rwanda; ?> frw  </td>
              </tr>
            </table>
        </div>
