<?php
  include 'app_data/php/head_blank.php';
  $date = preg_replace('#[^a-z0-9@._-]#i', '', $_GET['dt']);
  // echo "date id $date";
?>

<div class="print_containner" style="padding:30px;">
  <div class="head_div" style="padding: 4px 7px 12px 0px; border-bottom: 2px solid #333; margin-bottom: 18px;">
    <img src="app_data\imgs\icns\antares_black.png" alt="ANTARES" style="width: 200px;">
  </div>
  <h1 style="text-align: center; border-bottom: 1px solid #33333382; width: fit-content; padding-bottom: 6px; margin: auto; margin-bottom: 20px; font-size: 27px; ">Date: <b><?php echo $date; ?></b></h1>
  <?php
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
  <table class="table table-bordered" style=" margin:auto;text-align:center;">
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




<?php
$query_spent = "SELECT * FROM `spent` WHERE `date`='$date'";

// MySqli Select Query
$resultse = $mysqli->query($query_spent);
if ($resultse->num_rows == NULL) {
  // echo "
  ?>


   <?php //";
} else {
?>

<!-- SPENT DETAILS -->
<div style="margin-top: 12px; ">
  <div style="width:70%; float:left;">


<h2 style="margin: 0px; padding: 0px; height: 36px; font-size: 24px; font-weight: bold; padding-top: 7px; "> Expenses </h2>
<table class="table table-bordered" style="width:97%; border:#000;">
  <tr>
    <th>Cash</th>
    <th>Total</th>
    <th>Type</th>
    <th>Reason</th>
  </tr>
<?php
  while($row = $resultse->fetch_array()) {
       // `id`, `date`, `type`, `cash`, `cash_type`, `rate_rw`, `rate_fc`, `total`, `reason`
       $id = $row["id"];
       $date_spent = $row["date"];
       $type = $row["type"];
       $cash = $row["cash"];
       $cash_type = $row["cash_type"];
       $rate_rw = $row["rate_rw"];
       $rate_fc = $row["rate_fc"];
       $total = $row["total"];
       $reason = $row["reason"];
       ?>
<tr>
  <td><?php echo $cash.' '.$cash_type; ?></td>
  <td><b><?php echo $total; ?> frw </b></td>
  <td><?php echo $type; ?></td>
  <td><?php echo $reason; ?></td>
</tr>
       <?php

  }

?>
</table>



</div> <!-- grind -->
<div  style="width:30%; float:right;">
  <h2 style="margin: 0px; padding: 0px; height: 36px; font-size: 26px; font-weight: bold; padding-top: 7px; "></h2>

  <table class="table table-bordered">
    <tr>
      <th>
         Total Expenses
      </th>
    </tr>
    <tr>
      <td><b class="fa fa-plus-circle" style="font-size: 20px; color: #4caf50;"></b> In: <b> <?php echo @$Spend_sumIn; ?> frw </b></td>
    </tr>
    <tr>
      <td><b class="fa fa-minus-circle" style="font-size: 20px; color: #e9311e;"></b> out: <b> <?php echo @$Spend_sumOut; ?> frw </b></td>
    </tr>
    <tr>
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

      <td>
        Total:  
        <b> <?php echo @$LABEL_icon; ?> <?php echo @$LABEL_Spend_sumTotal; ?> frw </b>
      </td>
    </tr>
  </table>

</div>  <!-- grind -->
 <div style="color:transparent;font-size:0px;clear:both;">x</div>
</div>

<?php
}
// <!-- //////////////////////////// -->
?>









  <?php
   # THE HAND CASH TOTAL
   $last_hand_Total = $Toatal_rw_Hand_Cash - $Spend_sumTotal;
   ?>
  <p>
  <h3 style="margin:auto;font-weight:bold;"> Decission</h3>
  <table class="table table-bordered" style=" margin:auto;text-align:center;">
    <tr>
      <th> Total System </th>
      <th> Hand Cash + Expenses </th>
    </tr>
    <tr>
      <td style="font-size: 20px;"><b> <?php echo @$Systm_Total; ?> Frw </b></td>
      <td style="font-size: 20px;"><b> <?php echo @$last_hand_Total; ?> frw </b></td>
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
      <td colspan="2" style="font-size:20px;">
        <b><?php echo @$decission; ?></b>  &nbsp;&nbsp;&nbsp;
         <b><?php echo @foFixed($exedent); ?>frw </b></td>
    </tr>
  </table>

  </p>


</div>


<style media="screen">
  body {
    background: #000;
  }
  .print_containner {
    background: #fff;
    max-width: 900px;
    width: 100%;
    margin: auto;
    padding: 12px;
  }

  .print_containner .head_div {

  }
  .print_containner .head_div img {
    width: 200px;
  }

</style>

</body>
</html>
