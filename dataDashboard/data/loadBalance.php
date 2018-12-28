<?php
include_once '../../app_data/php/head_no_css.php'; // connection


$sType_q = '';
$Cash_type_q = '';

$Grand_total = 0;
$total_balance = 0;

$periodType = $_GET['period'];

// Date
if ($periodType == 'day') {
    @$day   = @$_GET['day'].'-'; // day
    @$month = $_GET['month']; // month
    @$yearo = '-'.$_GET['year'];

} else if ($periodType == 'month') {
    @$day   = ''; // day
    @$month = $_GET['month']; // month
    @$yearo = '-'.$_GET['year'];

} elseif ($periodType == 'year') {
    @$day   = ''; // day
    @$month = ''; // month
    @$yearo = '-'.$_GET['year'];
}

@$main_date_search = "$day$month$yearo"; // GENERATE THE DATE

$invitation_mainQuerySearch = "SELECT `date`, `paym_typ`, `Rate_Fc`, `Rate_R`, `static_balance`, `balance` FROM `selling_e` WHERE `e_id`>'1' AND `date` LIKE '%$main_date_search%' ORDER BY `s_id` DESC";




$grand_total_payed      = 0;
$divers_payed_total     = 0;
$invitation_payed_total = 0;

$resulte = $mysqli->query("SELECT `Total_Available_Rw` FROM `balance_table` WHERE `item`='Invitation' AND `date` LIKE '%$main_date_search%'");
while($row = $resulte->fetch_array()) {

  @$invitation_payed        = $row["Total_Available_Rw"];
  @$invitation_payed_total  += $invitation_payed;
}

$resultos = $mysqli->query("SELECT `Total_Available_Rw` FROM `balance_table` WHERE `item`='Divers' AND `date` LIKE '%$main_date_search%'");
while($row = $resultos->fetch_array()) {

  @$divers_payed = $row["Total_Available_Rw"];
  @$divers_payed_total  += $divers_payed;
}

$grand_total_payed = $divers_payed_total + $invitation_payed_total;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

@$invitation_grand_balance_static_Frw = 0;
@$invitation_grand_balance_Frw = 0;

@$results = $mysqli->query("$invitation_mainQuerySearch");

if ($results->num_rows == NULL) {
  // notin found
} else {

    while($row = $results->fetch_array()) {
      @$date     = $row["date"];
      @$paym_typ = $row["paym_typ"];
      @$Rate_Fc  = $row["Rate_Fc"];
      @$Rate_R   = $row["Rate_R"];
      // pay in

      @$static_balance    = $row["static_balance"];
      @$static_balanceFrw = CashToFrw($Rate_R, $Rate_Fc, $paym_typ, $static_balance);

      // balance
      @$balance    = $row["balance"];
      @$balanceFrw = CashToFrw($Rate_R, $Rate_Fc, $paym_typ, $balance);

      @$invitation_grand_balance_static_Frw += $static_balance;
      @$invitation_grand_balance_Frw        += $balance;

    }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$divers_mainQuerySearch = "SELECT `date`, `paym_typ`, `Rate_Fc`, `Rate_R`, `static_balance`, `balance` FROM `divers_sales` WHERE `div_id`!='0' AND `date` LIKE '%$main_date_search%' ORDER BY `div_id` DESC";

$divers_grand_balance_static_Frw = 0;
$divers_grand_balance_Frw = 0;

$data_result = $mysqli->query("$divers_mainQuerySearch");

if ($data_result->num_rows == NULL) {
  // notin found
} else {


    while($row = $data_result->fetch_array()) {
      @$date = $row["date"];

      @$paym_typ = $row["paym_typ"];

      @$Rate_Fc = $row["Rate_Fc"];
      @$Rate_R = $row["Rate_R"];
      // pay in

      @$static_balance = $row["static_balance"];
      $static_balanceFrw = CashToFrw($Rate_R, $Rate_Fc, $paym_typ, $static_balance);

      // balance
      @$balance = $row["balance"];
      $balanceFrw = CashToFrw($Rate_R, $Rate_Fc, $paym_typ, $balance);

      $divers_grand_balance_static_Frw += $static_balance;
      $divers_grand_balance_Frw        += $balance;

    }
}
  $balance_static_grand = $divers_grand_balance_static_Frw + $invitation_grand_balance_static_Frw;
  $balance_Grand        = $divers_grand_balance_Frw + $invitation_grand_balance_Frw;

  $invitation_perc = @round(($invitation_grand_balance_Frw / $balance_Grand) * 100);
  $divers_perc     = @round(($divers_grand_balance_Frw / $balance_Grand) * 100);



  // $grand_total_payed = $divers_payed_total + $invitation_payed_total;

echo '
{
        "total": "' . money($balance_static_grand) .'",
        "payed": "' . money($grand_total_payed) . '",
      "unpayed": "' . money($balance_Grand) . '",
          "date": "' . $main_date_search . '",
"invitation": {
        "total": "' . money($invitation_grand_balance_static_Frw) . '",
      "payed": "' . money($invitation_payed_total) . '",
      "unpayed": "' . money($invitation_grand_balance_Frw) . '"
     },
     "divers": {
         "total": "' . money($divers_grand_balance_static_Frw) . '",
         "payed": "' . money($divers_payed_total) . '",
       "unpayed": "' . money($divers_grand_balance_Frw) . '"
     },
     "pie": {
         "invitation": "' . $invitation_perc . '",
            "divers": "' . $divers_perc . '"
      }
}
';
?>
