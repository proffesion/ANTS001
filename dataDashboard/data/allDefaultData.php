<?php
  include_once '../../app_data/php/head_no_css.php'; // connection
  $date = preg_replace('#[^a-z0-9@._-]#i', '', $_GET['date']);
  // echo $date;money(

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


      // DIVERS
      $Diver_Pay_Fr  = SumValue("SELECT `Pay_Fr` FROM `divers_sales` WHERE `date` LIKE '%$date%'",'Pay_Fr');
      $Diver_Pay_Dol = SumValue("SELECT `Pay_Dol` FROM `divers_sales` WHERE `date` LIKE '%$date%'",'Pay_Dol');
      $Diver_Pay_fc  = SumValue("SELECT `Pay_fc` FROM `divers_sales` WHERE `date` LIKE '%$date%'",'Pay_fc');

      $Diver_TotalQ  = SumValue("SELECT `Total_Available_Rw` FROM `divers_sales` WHERE `date` LIKE '%$date%'",'Total_Available_Rw');


      // INVITATION
      $Invitation_Pay_Fr  = SumValue("SELECT `Pay_Fr` FROM `selling_e` WHERE `date` LIKE '%$date%'",'Pay_Fr');
      $Invitation_Pay_Dol = SumValue("SELECT `Pay_Dol` FROM `selling_e` WHERE `date` LIKE '%$date%'",'Pay_Dol');
      $Invitation_Pay_fc  = SumValue("SELECT `Pay_fc` FROM `selling_e` WHERE `date` LIKE '%$date%'",'Pay_fc');

      $Invitation_TotalQ  = SumValue("SELECT `Total_Available_Rw` FROM `selling_e` WHERE `date` LIKE '%$date%'",'Total_Available_Rw');

      // BALANCE
      $bal_Pay_Fr  = SumValue("SELECT `Pay_Fr` FROM `balance_table` WHERE `date` LIKE '%$date%'",'Pay_Fr');
      $bal_Pay_Dol = SumValue("SELECT `Pay_Dol` FROM `balance_table` WHERE `date` LIKE '%$date%'",'Pay_Dol');
      $bal_Pay_fc  = SumValue("SELECT `Pay_fc` FROM `balance_table` WHERE `date` LIKE '%$date%'",'Pay_fc');

      $bal_TotalQ  = SumValue("SELECT `Total_Available_Rw` FROM `balance_table` WHERE `date` LIKE '%$date%'",'Total_Available_Rw');

      // TOTALS
      $Systm_Frw   = $Invitation_Pay_Fr + $Diver_Pay_Fr + $bal_Pay_Fr;
      $Systm_Dol   = $Diver_Pay_Dol + $Invitation_Pay_Dol + $bal_Pay_Dol;
      $Systm_Fco   = $Invitation_Pay_fc + $Diver_Pay_fc + $bal_Pay_fc;

      $Systm_Total = $Invitation_TotalQ + $Diver_TotalQ + $bal_TotalQ;

      $invitationPie = @round(($Invitation_TotalQ / $Systm_Total) * 100);
      $diversPie     = @round(($Diver_TotalQ / $Systm_Total) * 100);
      $balancePie    = @round(($bal_TotalQ / $Systm_Total) * 100);

  echo '
  {
  "invitation":  {
            "frw": "'. money($Invitation_Pay_Fr) .'",
             "fc": "'. money($Invitation_Pay_fc) .'",
            "dol": "'. money($Invitation_Pay_Dol) .'",
          "total": "'. money($Invitation_TotalQ) .'"
      },
      "divers":  {
            "frw": "'. money($Diver_Pay_Fr) .'",
             "fc": "'. money($Diver_Pay_fc) .'",
            "dol": "'. money($Diver_Pay_Dol) .'",
          "total": "'. money($Diver_TotalQ) .'"
     },
     "balance":  {
            "frw": "'. money($bal_Pay_Fr) .'",
             "fc": "'. money($bal_Pay_fc) .'",
            "dol": "'. money($bal_Pay_Dol) .'",
          "total": "'. money($bal_TotalQ) .'"
      },
      "grand":  {
            "frw": "'. money($Systm_Frw) .'",
             "fc": "'. money($Systm_Fco) .'",
            "dol": "'. money($Systm_Dol) .'",
          "total": "'. money($Systm_Total) .'"
      },
      "pie":  {
            "invitation": "'. $invitationPie .'",
                "divers": "'. $diversPie .'",
               "balance": "'. $balancePie .'"
      }
  }
  ';
  ?>
