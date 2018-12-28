<?php
    include ('app_data/php/head_no_css.php');
    @$date = $_POST['date'];

    function SumValue($query,$name) {
      global $mysqli;
      $results = $mysqli->query($query);

      if ($results->num_rows == NULL) {
          return 0;
      } else {
        $total = 0;
          while($row = $results->fetch_array()) {
               $value = $row["$name"];
               $total += $value;
          }
          return $total;
      }
    }


    /// SPEND CASH
    $Spend_sumIn = 0;
    $Spend_sumOut = 0;
    $result = $mysqli->query("SELECT `total`,`type` FROM `spent` WHERE `date`='$date'");
    if ($result->num_rows == NULL) {
      $Spend_sumIn = 0;
      $Spend_sumOut = 0;
    } else {
        while($row = $result->fetch_array()) {
          $total = $row["total"];
          $typo = $row["type"];
            if ($typo == 'in') {
                $Spend_sumIn += $total;
            } else {
                $Spend_sumOut += $total;
            }
        }
    }
    $Spend_sumTotal = $Spend_sumOut - $Spend_sumIn;

    // BALANCE
    $bal_TotalQ = SumValue("SELECT `Total_Available_Rw` FROM `balance_table` WHERE `date`='$date'",'Total_Available_Rw');
    $bal_Pay_Fr = SumValue("SELECT `Pay_Fr` FROM `balance_table` WHERE `date`='$date'",'Pay_Fr');
    $bal_Pay_Dol = SumValue("SELECT `Pay_Dol` FROM `balance_table` WHERE `date`='$date'",'Pay_Dol');
    $bal_Pay_fc = SumValue("SELECT `Pay_fc` FROM `balance_table` WHERE `date`='$date'",'Pay_fc');

    // BALANCE
    $Diver_TotalQ = SumValue("SELECT `Total_Available_Rw` FROM `divers_sales` WHERE `date`='$date'",'Total_Available_Rw');
    $Diver_Pay_Fr = SumValue("SELECT `Pay_Fr` FROM `divers_sales` WHERE `date`='$date'",'Pay_Fr');
    $Diver_Pay_Dol = SumValue("SELECT `Pay_Dol` FROM `divers_sales` WHERE `date`='$date'",'Pay_Dol');
    $Diver_Pay_fc = SumValue("SELECT `Pay_fc` FROM `divers_sales` WHERE `date`='$date'",'Pay_fc');

    // INVITATION
    $Invitation_TotalQ = SumValue("SELECT `Total_Available_Rw` FROM `selling_e` WHERE `date`='$date'",'Total_Available_Rw');
    $Invitation_Pay_Fr = SumValue("SELECT `Pay_Fr` FROM `selling_e` WHERE `date`='$date'",'Pay_Fr');
    $Invitation_Pay_Dol = SumValue("SELECT `Pay_Dol` FROM `selling_e` WHERE `date`='$date'",'Pay_Dol');
    $Invitation_Pay_fc = SumValue("SELECT `Pay_fc` FROM `selling_e` WHERE `date`='$date'",'Pay_fc');


    // TOTALS
    $Systm_Total = $Invitation_TotalQ + $Diver_TotalQ + $bal_TotalQ;
    $Systm_Frw = $Invitation_Pay_Fr + $Diver_Pay_Fr + $bal_Pay_Fr;
    $Systm_Dol = $Diver_Pay_Dol + $Invitation_Pay_Dol + $bal_Pay_Dol;
    $Systm_Fco = $Invitation_Pay_fc + $Diver_Pay_fc + $bal_Pay_fc;

    $Toatal_rw_Hand_Cash = @retrieve_data('total_rw','deposit','date',$date);
?>
<table class="table table-bordered" style="width:95%; margin:auto;text-align:center;">
  <tr>
    <th>System Cash</th>
    <th>Hand Cash</th>
  </tr>
  <tr>
    <td>Frw: <b> <?php echo @$Systm_Frw; ?> Frw </b></td>
    <td>Frw: <b> <?php echo @retrieve_data('in_rw','deposit','date',$date); ?>Frw </b></td>
  </tr>
  <tr>
    <td>$: <b> <?php echo @$Systm_Dol; ?> $ </b></td>
    <td>$: <b> <?php echo @retrieve_data('in_do','deposit','date',$date); ?> $ </b></td>
  </tr>
  <tr>
    <td>Fco: <b> <?php echo @$Systm_Fco; ?> Fco </b></td>
    <td>Fco: <b> <?php echo @retrieve_data('in_fc','deposit','date',$date); ?> Fco </b></td>
  </tr>
  <tr>
    <td>Total: <b> <?php echo @$Systm_Total; ?> Frw </b></td>
    <td>Total: <b> <?php echo @$Toatal_rw_Hand_Cash; ?> Frw </b></td>
  </tr>
</table>



<p>
  <br>
<h5 style="width:95%;margin:auto;font-weight:bold;"> Expenses</h5>
<table class="table table-bordered" style="width:95%; margin:auto;text-align:center;">
  <tr>
    <td><b class="fa fa-plus-circle" style="font-size: 20px; color: #4caf50;"></b> In: <b> <?php echo @$Spend_sumIn; ?> frw </b></td>
    <td><b class="fa fa-minus-circle" style="font-size: 20px; color: #e9311e;"></b> out: <b> <?php echo @$Spend_sumOut; ?> frw </b></td>
    <?php
     //# this is for displaying a number without a minus
     if ($Spend_sumIn > $Spend_sumOut) {
       $LABEL_Spend_sumTotal = $Spend_sumIn - $Spend_sumOut;
       $LABEL_icon = '<b class="fa fa-plus-circle" style="font-size: 20px; color: #4caf50;"></b>';
     } else {
       $LABEL_Spend_sumTotal = $Spend_sumOut - $Spend_sumIn;
       $LABEL_icon = '<b class="fa fa-minus-circle" style="font-size: 20px; color: #e9311e;"></b>';
     }
     ?>

    <td>Total: <b> <?php echo @$LABEL_icon; ?> <?php echo @$LABEL_Spend_sumTotal; ?> frw </b></td>
  </tr>
</table>
<?php
 # THE HAND CASH TOTAL
 $last_hand_Total = $Toatal_rw_Hand_Cash - $Spend_sumTotal;
 ?>
</p>
<p>
  <br>
<h5 style="width:95%;margin:auto;font-weight:bold;"> Total</h5>
<table class="table table-bordered" style="width:95%; margin:auto;text-align:center;">
  <tr>
    <td class="total_td">Total System : <b> <?php echo @$Systm_Total; ?> Frw </b></td>
    <td class="total_td">Hand Cash + Expenses: <b> <?php echo @$last_hand_Total; ?> frw </b></td>
  </tr>
  <tr>
    <?php
       if ($Systm_Total > $last_hand_Total) {
         # the hand cash is less than system cash
         # Manqua
        $exedent = $Systm_Total - $last_hand_Total;
        $decission = "Loss";
        $decission_color = "#e9311e";

       } else if ($Systm_Total < $last_hand_Total) {
        # the hand cash is more than system cash
        # Exedent
        $exedent = $last_hand_Total - $Systm_Total;
        $decission = "Exedent";
        $decission_color = "#4caf50";

       } else {
         # the hand cash is more than system cash
         # Exedent
         $exedent = $Systm_Total - $last_hand_Total;
         $decission = "Not Bad";
         $decission_color = "#337ab7bf";


       }

    ?>
    <td colspan="2" style="padding:20px; color:#fff; background:<?php echo $decission_color; ?>;">
      <h2><?php echo @$decission; ?></h2>
       <b><?php echo @foFixed($exedent); ?>frw </b></td>
  </tr>
</table>

</p>
<p style="text-align:right;margin:15px 19px;">
<a href="print_decission.php?dt=<?php echo @$date; ?>" target="_blank">
    <button type="button" class="btn btn-primary"> <b class="fa fa-print"></b> View a Print Version </button>
</a>

<a onclick=" return confirm('are you sure you want to delete this transaction?? \n this will delete the hand-cash only!');" href="delete_cash.php?idu=<?php echo retrieve_data('id','deposit','date',$date); ?>&dt=<?php echo $date; ?>">
  <button type="button" class="btn btn-danger"> <b class="fa fa-trash"></b> Delete </button>
</a>

</p>
