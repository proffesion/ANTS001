<?php

include 'app_data/php/head_no_css.php';
secured();
$check_query_o = "";

@$total_Bal_Pay_Fr = 0;
@$total_Bal_Pay_Dol = 0;
@$total_Bal_Pay_Fc = 0;

$date_Q = preg_replace('#[^a-z0-9@._-]#i', '', $_POST['date']);

// main query
@$mainQuerySearch = "SELECT * FROM `selling_e` WHERE `date`='$date_Q'";

if (number_ret($mainQuerySearch) == 0) { // if there is no data found ?>

<?php 
} else { // display the data?>

<div class="row">
  <div class="col-xs-8" style="text-align:left;"> <h2>Invitation - Sales</h2> </div>
  <div class="col-xs-4" style="text-align:right;"> 
        <h4 style="margin: 0px; padding: 0px;">Date: <b><?php echo $date_Q; ?></b></h4> 
        <small>Printed on:  <?php echo $today_date; ?></small> </div>
</div>
  
<!-- <h3>Invitation</h3> -->

  <table class="table" border="1">
    <tbody>
      <tr>
        <th> # </th>
        <th> Date </th>
        <th> Inv-id </th>
        <th> Quantity </th>
        <th> <b class="fa fa-money" style="font-size: 21px;" title="Payment Type"></b> </th>
        <th> PU </th>

        <th> Pay Frw </th>
        <th> Pay $ </th>
        <th> Pay Fco </th>

        <th> Total (type)</th>
        <th> Total (Frw)</th>

        <th> Closed </th>
        <th> Client name </th>
        <th> Done by </th>
      </tr>

  <?php
  // run query
  $results = $mysqli->query("$mainQuerySearch");
  $x = 0;

  while ($row = $results->fetch_array()) {
    @$s_id = $row["s_id"];
    @$e_id = $row["e_id"];
    @$typ = $row["typ"];
    @$date = $row["date"];
    @$dateTime = $row["dateTime"];


    @$quantity = $row["quantity"];
    @$client_name = $row["client_name"];
    @$done_by = retrieve_data('lname', 'users', 'user_id', $row["done_by"]);

    @$closed = $row["closed"];
    @$paym_typ = $row["paym_typ"];

    @$Cash_type = $row["Cash_type"];
    @$PU = $row["PU"];
    @$Rate_R = $row["Rate_R"];
    @$Rate_Fc = $row["Rate_Fc"];
    @$Rate_R = $row["Rate_R"];

        // pay in
    @$Pay_Fr = $row["Pay_Fr"];
    @$Pay_Dol = $row["Pay_Dol"];
    @$Pay_fc = $row["Pay_fc"];

    @$Price_total = $row["Price_total"];
    @$Price_total_Rw = $row["Price_total_Rw"];

    @$Total_Available = $row["Total_Available"];
    @$Total_Available_Rw = $row["Total_Available_Rw"];

    @$check_query_o = "SELECT `sell_id` FROM `error_table` WHERE `sell_id`='$s_id' AND typ='I'";

    ?>
    <!-- changing the background for the sell which have some error -->
    <tr <?php if (number_ret($check_query_o) > 0) {
          echo 'style="background:red;color:#fff;"';
        } ?>>

    <td> <?php echo @$s_id; ?> </td>
    <td> <b> <?php echo @$date; ?> </b> <section class="date"><?php echo @$dateTime; ?></section> </td>
    <td> <?php echo @$e_id; ?> </td>
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
   </tr>

  <?php

    // payed in cash
  @$total_Pay_Fr_incr += $Pay_Fr;
  @$total_Pay_Fc_incr += $Pay_fc;
  @$total_Pay_dol_incr += $Pay_Dol;

  @$Price_total_Rw_incr += $Total_Available_Rw;

}

?>

   <tr>
     <td colspan="6"> Total </td>

     <td bgcolor="lightblue">  <?php echo @money($total_Pay_Fr_incr); ?> Frw </td>
     <td bgcolor="lightblue">  <?php echo @money($total_Pay_dol_incr); ?>  $ </td>
     <td bgcolor="lightblue">  <?php echo @money($total_Pay_Fc_incr); ?>  Fco </td>

     <td> &nbsp; </td>
     <td bgcolor="lightblue"> <b> <?php echo @money($Price_total_Rw_incr); ?> Frw</b></td>

     <td colspan="3">  &nbsp; </td>
   </tr>
  </tbody></table>



<?php 
} // end of display data ?>
