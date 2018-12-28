<?php
include 'app_data/php/head_no_css.php';

@$check_query_o = "SELECT `id` FROM `error_table` WHERE `sell_id`='$s_id' AND `typ`='D'";

@$total_Bal_Pay_Fr = 0;
@$total_Bal_Pay_Dol = 0;
@$total_Bal_Pay_Fc = 0;


   $date_Q =  preg_replace('#[^a-z0-9@._-]#i', '', $_POST['date']);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////   BALANCE TABLE  ////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////



@$BalanceQuerySearch = "SELECT * FROM `balance_table` WHERE `item`='Divers' AND `date`='$date_Q'";

if (number_ret($BalanceQuerySearch) == 0) { ?>

<div id="diversBalance" class="NoPaper"></div>
<style>
    #diversBalanceButton {
      display: none;
    }

    #diversSellButton { display: none; }
    a.diversBalanceMainButton { display: none; }
    section.noDiversBallance { display: block; }

    
</style>
<?php } else { ?>



<div class="row">
  <div class="col-xs-8" style="text-align:left;"> <h2>Divers - Balance</h2> </div>
  <div class="col-xs-4" style="text-align:right;"> 
        <h4 style="margin: 0px; padding: 0px;">Date: <b><?php echo $date_Q; ?></b></h4> 
        <small>Printed on:  <?php echo $today_date; ?></small> </div>
</div>

  <table class="table" border="1">
    <tbody>
      <tr>
        <th> # </th>
        <th> Date </th>
        <th> E-id </th>
        <th> <b class="fa fa-money" style="font-size: 21px;" title="Payment Type"></b> </th>
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
  $results = $mysqli->query("$BalanceQuerySearch");

@$total_Bal_Total_Available+= 0;
@$total_Bal_Total_Available_Rw = 0;


    $x = 0;

      while($row = $results->fetch_array()) {
        // @$Bal_b_id = $row["balance_id"];
        @$Bal_date = $row["date"];
        @$dateTime = $row["dateTime"];
        @$Bal_item_id = $row["item_id"];
        @$Bal_sell_id = $row["sell_id"];
        @$Bal_client_name = $row["client_name"];
        @$done_by = retrieve_data('lname','users','user_id',$row["done_by"]);

        @$Bal_paym_typ = $row["paym_typ"];
        @$Bal_Pay_Fr = $row["Pay_Fr"];
        @$Bal_Pay_Dol = $row["Pay_Dol"];
        @$Bal_Pay_fc = $row["Pay_fc"];
        @$Bal_Total_Available = $row["Total_Available"];
        @$Bal_Total_Available_Rw = $row["Total_Available_Rw"];

        // @$Bal_closed = $row["closed"];

        // @$Bal_closed = $row["closed"];
        // @$Bal_Rate_R = $row["Rate_R"];
        // @$Bal_Rate_Fc = $row["Rate_Fc"];
        // @$Bal_comment = $row["comment"];
  ?>
    <tr <?php if (number_ret($check_query_o) > 0)  { echo 'style="background:red;color:#fff;"'; } ?>>

    <td> <?php echo @$Bal_sell_id; ?> </td>
    <td> <b> <?php echo @$date; ?> </b> <section class="date"><?php echo @$dateTime; ?></section> </td>
    <td> <?php echo @$Bal_item_id; ?> </td>
    <td> <?php echo @$Bal_paym_typ; ?> </td>

    <td> <?php echo @money($Bal_Pay_Fr); ?> Frw</td>
    <td> <?php echo @money($Bal_Pay_Dol); ?> $</td>
    <td> <?php echo @money($Bal_Pay_fc); ?> Fc</td>

    <td> <?php echo @money($Bal_Total_Available); ?> <?php echo @$paym_typ; ?></td>
    <td> <?php echo @money($Bal_Total_Available_Rw); ?> Frw</td>

    <td> <?php echo @$Bal_closed; ?> </td>
    <td> <?php echo @$Bal_client_name; ?> </td>
    <td> <?php echo @$done_by; ?> </td>
   </tr>

<?php
@$total_Bal_Pay_Fr += $Bal_Pay_Fr;
@$total_Bal_Pay_Dol += $Bal_Pay_Dol;
@$total_Bal_Pay_Fc += $Bal_Pay_fc;

// @$total_Bal_Total_Available += $Bal_Total_Available;
@$total_Bal_Total_Available_Rw += $Bal_Total_Available_Rw;



 }

?>

<tr class="no-border">
  <td colspan="4"> &nbsp;</td>
  <td bgcolor="lightblue"> <?php echo @money($total_Bal_Pay_Fr); ?> Frw</td>
  <td bgcolor="lightblue"> <?php echo @money($total_Bal_Pay_Dol); ?> $</td>
  <td bgcolor="lightblue"> <?php echo @money($total_Bal_Pay_Fc); ?> Fc</td>

  <td> &nbsp; </td>
  <td bgcolor="lightblue"><b> <?php echo @money($total_Bal_Total_Available_Rw); ?> Frw</b></td>

  <td colspan="3"> &nbsp;</td>
</tr>
</tbody></table>

<?php } ?>
