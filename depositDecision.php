<?php
include 'app_data/php/head_no_css.php';

$date = preg_replace('#[^a-z0-9@._-]#i', '', $_POST['date']);

?>


<?php
if (number_ret("SELECT `id` FROM `deposit` WHERE `date`='$date'") == 0) {
  // do nothing
} else { ?>



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


      /////////////
      $bal_total_invitation = SumValue("SELECT `Total_Available_Rw` FROM `balance_table` WHERE `date`='$date' AND `item`='Invitation'",'Total_Available_Rw');
      $bal_total_Divers = SumValue("SELECT `Total_Available_Rw` FROM `balance_table` WHERE `date`='$date' AND `item`='Divers'",'Total_Available_Rw');

      // BIVERS
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



















    <div class="row noMP">
      <div class="col-xs-6 noMP">
        <table class="table table-bordered" style=" margin:auto;text-align:center;">
          <tr>
            <th>INVITATION</th>
            <th>DIVERS</th>
          </tr>
          <tr>
            <td>Sales: <b> <?php echo @money($Invitation_TotalQ); ?> Frw </b></td>
            <td>Sales: <b> <?php echo @money($Diver_TotalQ); ?>Frw </b></td>
          </tr>
          <tr>
            <td>Balance: <b> <?php echo @money($bal_total_invitation); ?> Frw </b></td>
            <td>Balance: <b> <?php echo @money($bal_total_Divers); ?> Frw </b></td>
          </tr>
          <tr>
            <td>Total: <b> <?php echo @money($Invitation_TotalQ + $bal_total_invitation); ?> Frw </b></td>
            <td>Total: <b> <?php echo @money($Diver_TotalQ + $bal_total_Divers); ?> Frw </b></td>
          </tr>
          <tr>
            <td colspan="2">INVITATION + DIVERS : <b> <?php echo @money($Invitation_TotalQ + $bal_total_invitation + $Diver_TotalQ + $bal_total_Divers); ?> Frw </b></td>
          </tr>
        </table>
      </div><!-- .col-xs-6 -->



      <div class="col-xs-6">
        <table class="table table-bordered" style=" margin:auto;text-align:center; width:100%;">
          <tr>
            <th>System Cash</th>
            <th>Hand Cash</th>
          </tr>
          <tr>
            <td> <b> <?php echo @money($Systm_Frw); ?> Frw </b></td>
            <td> <b> <?php echo @money(retrieve_data('in_rw','deposit','date',$date)); ?>Frw </b></td>
          </tr>
          <tr>
            <td> <b> <?php echo @money($Systm_Dol); ?> $ </b></td>
            <td> <b> <?php echo @money(retrieve_data('in_do','deposit','date',$date)); ?> $ </b></td>
          </tr>
          <tr>
            <td> <b> <?php echo @money($Systm_Fco); ?> Fco </b></td>
            <td> <b> <?php echo @money(retrieve_data('in_fc','deposit','date',$date)); ?> Fco </b></td>
          </tr>
          <tr>
            <td>Total: <b> <?php echo @money($Systm_Total); ?> Frw </b></td>
            <td>Total: <b> <?php echo @money($Toatal_rw_Hand_Cash); ?> Frw </b></td>
          </tr>
        </table>
      </div><!-- .col-xs-6 -->
    </div>













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
    <h4 style="margin: 0px;padding: 0px;font-size: 20px;margin-bottom: 9px;"> Expenses </h4>
    <div class="row noMP">
      <div class="col-xs-9 noMP">
      
          <table class="table table-bordered" style="width:99%; border:#000; margin-top: 0px;">
            <tr>
              <th style="width: 13px;">#</th>
              <th>Type</th>
              <th>Total (Frw)</th>
              <th>Reason</th>
            </tr>
          <?php
            $x = 0;
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

                $x++; // numbering
          ?>
          <tr>
            <td><?php echo @$x; ?></td>
            <td><?php echo $type; ?></td>
            <td> <b>
              <?php
              if ($cash_type == 'rw') {
                echo money($total); 
              } else {
                echo money($cash).' '.$cash_type.' --> '.money($total).'Frw'; 
              }
              ?> </b>
            </td>
            <td><?php echo $reason; ?></td>
          </tr>
          <?php
            }
          ?>
          </table>
          
      </div><!-- col-xs-9 -->
      <div class="col-xs-3 noMP">
      
              <table class="table table-bordered" style="margin-top: 0px;">
            <tr> <th>  Total Expenses </th> </tr>
            <tr>
              <td><b class="fa fa-plus-circle" style="font-size: 20px; color: #4caf50;"></b> In: <b> <?php echo @money($Spend_sumIn); ?> frw </b></td>
            </tr>
            <tr>
              <td><b class="fa fa-minus-circle" style="font-size: 20px; color: #e9311e;"></b> out: <b> <?php echo @money($Spend_sumOut); ?> frw </b></td>
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
                <b> <?php echo @$LABEL_icon; ?> <?php echo @money($LABEL_Spend_sumTotal); ?> frw </b>
              </td>
            </tr>
          </table>

      </div><!-- col-xs-3 -->
    </div>  
 
</div>

<?php
}
// <!-- //////////////////////////// -->
?>









  <?php
   # THE HAND CASH TOTAL
   $last_hand_Total = $Toatal_rw_Hand_Cash - $Spend_sumTotal;
   ?>
  <div>
  <h4 style="margin: 0px;padding: 0px;font-size: 20px;margin-bottom: 9px;"> Decission </h4>

  <table class="table table-bordered" style=" margin:auto;text-align:center;">
    <tr>
      <th> Total System </th>
      <th> Hand Cash + Expenses </th>
    </tr>
    <tr>
      <td style="font-size: 20px;"><b> <?php echo @money($Systm_Total); ?> Frw </b></td>
      <td style="font-size: 20px;"><b> <?php echo @money($last_hand_Total); ?> frw </b></td>
    </tr>
    <tr>
      <?php
         if ($Systm_Total > $last_hand_Total) {
           # the hand cash is less than system cash
           # Manqua
          $exedent = $Systm_Total - $last_hand_Total;
          $decission = "SHORTFALL";
          $decission_color = "#e9311e";

         } else if ($Systm_Total < $last_hand_Total) {
          # the hand cash is more than system cash
          # Exedent
          $exedent = $last_hand_Total - $Systm_Total;
          $decission = "SURPLUS";
          $decission_color = "#4caf50";

         } else {
           # the hand cash is more than system cash
           # Exedent
           $exedent = $Systm_Total - $last_hand_Total;
           $decission = "...";
           $decission_color = "#337ab7bf";

         }

      ?>
      <td colspan="2" style="font-size:20px;">
        <b><?php echo @$decission; ?></b>  &nbsp;&nbsp;&nbsp;
         <b><?php echo @money(foFixed($exedent)); ?> frw </b></td>
    </tr>
  </table>

  </div>





<?php }
 // end of all contents
?>

