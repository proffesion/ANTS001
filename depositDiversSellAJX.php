<?php
include 'app_data/php/head_no_css.php';

@$check_query_o = "SELECT `id` FROM `error_table` WHERE `sell_id`='$s_id' AND `typ`='D'";

@$total_Bal_Pay_Fr = 0;
@$total_Bal_Pay_Dol = 0;
@$total_Bal_Pay_Fc = 0;


   $date_Q =  preg_replace('#[^a-z0-9@._-]#i', '', $_POST['date']);
   @$mainQuerySearch = "SELECT * FROM `divers_sales` WHERE `date`='$date_Q'";


if (number_ret($mainQuerySearch) == 0) {
/// do nothing
 } else {  // DISPLAY THE DATA ?>

<div class="row">
  <div class="col-xs-8" style="text-align:left;"> <h2>Divers - Sales</h2> </div>
  <div class="col-xs-4" style="text-align:right;"> 
        <h4 style="margin: 0px; padding: 0px;">Date: <b><?php echo $date_Q; ?></b></h4> 
        <small>Printed on:  <?php echo $today_date; ?></small> </div>
</div>

  <table class="table" border="1">
    <tbody>
      <tr>
        <th> # </th>
        <th> Date </th>
        <th> Product </th>
        <th> Quantity </th>
        <th> <b class="fa fa-money" style="font-size: 21px;" title="Payment Type"></b> </th>
        <th> PU </th>

        <th> Pay Frw </th>
        <th> Pay $ </th>
        <th> Pay Fco </th>

        <th> Total (type)</th>
        <th> Total (Frw)</th>

        <th> Closed </th>
        <th> client_name </th>
        <th> Done by </th>
      </tr>

  <?php
  $results = $mysqli->query("$mainQuerySearch");

      while($row = $results->fetch_array()) {
        @$s_id = $row["s_id"];
        @$date = $row["date"];
        @$dateTime = $row["dateTime"];

        @$dv_id = $row["div_id"];
        @$client_name = $row["client_name"];
        @$done_by = retrieve_data('lname','users','user_id',$row["done_by"]);
        @$Cash_type = $row["Cash_type"];
        @$balance = $row["balance"];
        @$avance = $row["avance"];
        @$payed_in = $row["payed_in"];
        @$quantity = $row["quantity"];
        @$price_unit_rw = $row["pu_r"];
        @$price_tot_rw = $row["pt_r"];
        @$price_unit_d = $row["pu_d"];
        @$price_tot_d = $row["pt_d"];
        @$comment = $row["comment"];

        @$Cash_type = $row["Cash_type"];
        @$paym_typ = $row["paym_typ"];

        @$PU = $row["PU"];
        @$Pay_Fr = $row["Pay_Fr"];
        @$Pay_Dol = $row["Pay_Dol"];
        @$Pay_fc = $row["Pay_fc"];

        @$Price_total = $row["Price_total"];
        @$Price_total_Rw = $row["Price_total_Rw"];

        @$Total_Available = $row["Total_Available"];
        @$Total_Available_Rw = $row["Total_Available_Rw"];

  ?>
    <tr>

    <td> <?php echo @$s_id; ?> </td>
    <td> <b> <?php echo @$date; ?> </b> <section class="date"><?php echo @$dateTime; ?></section> </td>
    <td> <?php echo retrieve_data('pro_name','products','pro_id',$dv_id); ?> </td>
    <td> <?php echo @$quantity; ?> </td>
    <td> <?php echo @$paym_typ; ?> </td>
    <td> <?php echo @money($PU); ?> <?php echo @$paym_typ; ?></td>

    <td> <?php echo @money($Pay_Fr); ?> Frw</td>
    <td> <?php echo @money($Pay_Dol); ?> $</td>
    <td> <?php echo @money($Pay_fc); ?> Fc</td>

    <td> <?php echo @money($Total_Available); ?> <?php echo @$paym_typ; ?></td>
    <td> <?php echo @money($Total_Available_Rw); ?> Frw</td>

    <td> <?php echo @$Cash_type; ?> </td>
    <td> <?php echo @$client_name; ?> </td>
    <td> <?php echo @$done_by; ?> </td>
    <!-- <td> -->
   </tr>
  <?php
    // payed in cash
    @$total_Pay_Fr_incr += $Pay_Fr;
    @$total_Pay_Fc_incr += $Pay_fc;
    @$total_Pay_dol_incr += $Pay_Dol;

    @$Price_total_Rw_incr += $Total_Available_Rw;

    @$exedentSum += $exedent;
    // @$manqSum += $manq;

      }
   ?>


   <tr>
     <td colspan="6"> Total </td>
     <td bgcolor="lightblue"> <b> <?php echo @money($total_Pay_Fr_incr); ?> Frw</b> </td>
     <td bgcolor="lightblue"> <b> <?php echo @money($total_Pay_dol_incr); ?> $</b> </td>
     <td bgcolor="lightblue"> <b> <?php echo @money($total_Pay_Fc_incr); ?> Fco</b> </td>


     <td> &nbsp; </td>
     <td bgcolor="lightblue"> <b> <?php echo @money($Price_total_Rw_incr); ?> Frw</b> </td>
     <td colspan="3"> &nbsp; </td>
   </tr>

  </tbody></table>



<?php  } ?>
