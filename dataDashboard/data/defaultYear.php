<?php
    include_once '../../app_data/php/head_no_css.php'; // connection

    $type           = ''; //
    $year           = '';
    $selected_month = '';
    $title = "";

    if (isset($_GET['type']) && !empty($_GET['type'])) {
      $type  = @$_GET['type']; //
    } else {
      $type  = 'year'; //
    }


    if (isset($_GET['year']) && !empty($_GET['year']) && $_GET['year'] != 'null') {
      $selected_year    = @$_GET['year'];
    } else {
      $selected_year    = $this_year;
    }

    if (isset($_GET['month']) && !empty($_GET['month']) && $_GET['month'] != 'null') {
      $selected_month = @$_GET['month'];
    } else {
      $selected_month = $this_month;
    }

    if (isset($_GET['day']) && !empty($_GET['day']) && $_GET['day'] != 'null') {
      $selected_day = @$_GET['day'];
    } else {
      $selected_day = $today;
    }


    $title = " $selected_day $selected_month  $selected_year";

    $total_diver_year      = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `divers_sales` WHERE `date` LIKE '%$selected_year%'",'Total_Available_Rw');
    $total_Invitation_year = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `selling_e` WHERE `date` LIKE '%$selected_year%'",'Total_Available_Rw');




// INVITATION
$inv_Jan = 0; $inv_Feb = 0; $inv_Mar = 0; $inv_Apr = 0; $inv_May = 0; $inv_Jun = 0; $inv_Jul = 0; $inv_Aug = 0;
$inv_Sep = 0; $inv_Oct = 0; $inv_Nov = 0; $inv_Dec = 0; $div_Jan = 0; $div_Feb = 0; $div_Mar = 0; $div_Apr = 0;
$div_May = 0; $div_Jun = 0; $div_Jul = 0; $div_Aug = 0; $div_Sep = 0; $div_Oct = 0; $div_Nov = 0; $div_Dec = 0;

$i1  = 0;  $i2  = 0; $i3  = 0;  $i4  = 0; $i5  = 0;  $i6  = 0; $i7  = 0;  $i8  = 0; $i9  = 0;  $i10 = 0; $i11 = 0;
$i12 = 0;  $i13 = 0; $i14 = 0;  $i15 = 0; $i16 = 0;  $i17 = 0; $i18 = 0;  $i19 = 0; $i20 = 0;  $i21 = 0; $i22 = 0;
$i23 = 0;  $i24 = 0; $i25 = 0;  $i26 = 0; $i27 = 0;  $i28 = 0; $i29 = 0;  $i30 = 0; $i31 = 0;

$d1  = 0;  $d2  = 0; $d3  = 0;  $d4  = 0; $d5  = 0;  $d6  = 0; $d7  = 0;  $d8  = 0; $d9  = 0;  $d10 = 0; $d11 = 0;
$d12 = 0;  $d13 = 0; $d14 = 0;  $d15 = 0; $d16 = 0;  $d17 = 0; $d18 = 0;  $d19 = 0; $d20 = 0;  $d21 = 0; $d22 = 0;
$d23 = 0;  $d24 = 0; $d25 = 0;  $d26 = 0; $d27 = 0;  $d28 = 0; $d29 = 0;  $d30 = 0; $d31 = 0;





if ($type == 'month') {
    // SELECT MONTHS
    $monthTotalInvitation = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `selling_e` WHERE `date` LIKE '%$selected_month-$selected_year%'",'Total_Available_Rw');
    $i1  = setSelsTotal("1-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i2  = setSelsTotal("2-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i3  = setSelsTotal("3-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i4  = setSelsTotal("4-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i5  = setSelsTotal("5-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i6  = setSelsTotal("6-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i7  = setSelsTotal("7-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i8  = setSelsTotal("8-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i9  = setSelsTotal("9-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');

    $i10 = setSelsTotal("10-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i11 = setSelsTotal("11-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i12 = setSelsTotal("12-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i13 = setSelsTotal("13-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i14 = setSelsTotal("14-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i15 = setSelsTotal("15-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i16 = setSelsTotal("16-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i17 = setSelsTotal("17-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i18 = setSelsTotal("18-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i19 = setSelsTotal("19-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');

    $i20 = setSelsTotal("20-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i21 = setSelsTotal("21-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i22 = setSelsTotal("22-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i23 = setSelsTotal("23-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i24 = setSelsTotal("24-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i25 = setSelsTotal("25-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i26 = setSelsTotal("26-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i27 = setSelsTotal("27-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i28 = setSelsTotal("28-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i29 = setSelsTotal("29-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');

    $i30 = setSelsTotal("30-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');
    $i31 = setSelsTotal("31-$selected_month-$year", $monthTotalInvitation, 'selling_e', 'Total_Available_Rw');


    // DIVERS
    $monthTotalDivers = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `divers_sales` WHERE `date` LIKE '%$selected_month-$selected_year%'",'Total_Available_Rw');
    $d1  = setSelsTotal("1-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d2  = setSelsTotal("2-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d3  = setSelsTotal("3-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d4  = setSelsTotal("4-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d5  = setSelsTotal("5-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d6  = setSelsTotal("6-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d7  = setSelsTotal("7-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d8  = setSelsTotal("8-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d9  = setSelsTotal("9-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');

    $d10 = setSelsTotal("10-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d11 = setSelsTotal("11-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d12 = setSelsTotal("12-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d13 = setSelsTotal("13-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d14 = setSelsTotal("14-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d15 = setSelsTotal("15-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d16 = setSelsTotal("16-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d17 = setSelsTotal("17-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d18 = setSelsTotal("18-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d19 = setSelsTotal("19-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');

    $d20 = setSelsTotal("20-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d21 = setSelsTotal("21-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d22 = setSelsTotal("22-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d23 = setSelsTotal("23-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d24 = setSelsTotal("24-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d25 = setSelsTotal("25-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d26 = setSelsTotal("26-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d27 = setSelsTotal("27-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d28 = setSelsTotal("28-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d29 = setSelsTotal("29-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');

    $d30 = setSelsTotal("30-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');
    $d31 = setSelsTotal("31-$selected_month-$year", $monthTotalDivers, 'divers_sales', 'Total_Available_Rw');

} else {
    // YEAR DATA
    $inv_Jan = setSelsTotal('Jan-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');
    $inv_Feb = setSelsTotal('Feb-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');
    $inv_Mar = setSelsTotal('Mar-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');
    $inv_Apr = setSelsTotal('Apr-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');
    $inv_May = setSelsTotal('May-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');
    $inv_Jun = setSelsTotal('Jun-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');
    $inv_Jul = setSelsTotal('Jul-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');
    $inv_Aug = setSelsTotal('Aug-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');
    $inv_Sep = setSelsTotal('Sep-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');
    $inv_Oct = setSelsTotal('Oct-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');
    $inv_Nov = setSelsTotal('Nov-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');
    $inv_Dec = setSelsTotal('Dec-'.$year, $total_Invitation_year, 'selling_e', 'Total_Available_Rw');

    // DIVERS
    $div_Jan = setSelsTotal('Jan-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
    $div_Feb = setSelsTotal('Feb-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
    $div_Mar = setSelsTotal('Mar-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
    $div_Apr = setSelsTotal('Apr-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
    $div_May = setSelsTotal('May-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
    $div_Jun = setSelsTotal('Jun-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
    $div_Jul = setSelsTotal('Jul-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
    $div_Aug = setSelsTotal('Aug-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
    $div_Sep = setSelsTotal('Sep-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
    $div_Oct = setSelsTotal('Oct-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
    $div_Nov = setSelsTotal('Nov-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
    $div_Dec = setSelsTotal('Dec-'.$year, $total_diver_year, 'divers_sales', 'Total_Available_Rw');
}


echo '
{
    "invitation": {
              "year": {
                  "Jan" : "'. $inv_Jan .'",
                  "Feb" : "'. $inv_Feb .'",
                  "Mar" : "'. $inv_Mar .'",
                  "Apr" : "'. $inv_Apr .'",
                  "May" : "'. $inv_May .'",
                  "Jun" : "'. $inv_Jun .'",
                  "Jul" : "'. $inv_Jul .'",
                  "Aug" : "'. $inv_Aug .'",
                  "Sep" : "'. $inv_Sep .'",
                  "Oct" : "'. $inv_Oct .'",
                  "Nov" : "'. $inv_Nov .'",
                  "Dec" : "'. $inv_Dec .'"
                },
              "day": {
                "i1" : "'. $i1 .'",
                "i2" : "'. $i2 .'",
                "i3" : "'. $i3 .'",
                "i4" : "'. $i4 .'",
                "i5" : "'. $i5 .'",
                "i6" : "'. $i6 .'",
                "i7" : "'. $i7 .'",
                "i8" : "'. $i8 .'",
                "i9" : "'. $i9 .'",
                "i10" : "'. $i10 .'",
                "i11" : "'. $i11 .'",
                "i12" : "'. $i12 .'",
                "i13" : "'. $i13 .'",
                "i14" : "'. $i14 .'",
                "i15" : "'. $i15 .'",
                "i16" : "'. $i16 .'",
                "i17" : "'. $i17 .'",
                "i18" : "'. $i18 .'",
                "i19" : "'. $i19 .'",
                "i20" : "'. $i20 .'",
                "i21" : "'. $i21 .'",
                "i22" : "'. $i22 .'",
                "i23" : "'. $i23 .'",
                "i24" : "'. $i24 .'",
                "i25" : "'. $i25 .'",
                "i26" : "'. $i26 .'",
                "i27" : "'. $i27 .'",
                "i28" : "'. $i28 .'",
                "i29" : "'. $i29 .'",
                "i30" : "'. $i30 .'",
                "i31" : "'. $i31 .'"
              }
    },
    "divers": {
              "year": {
                  "Jan" : "'. $div_Jan .'",
                  "Feb" : "'. $div_Feb .'",
                  "Mar" : "'. $div_Mar .'",
                  "Apr" : "'. $div_Apr .'",
                  "May" : "'. $div_May .'",
                  "Jun" : "'. $div_Jun .'",
                  "Jul" : "'. $div_Jul .'",
                  "Aug" : "'. $div_Aug .'",
                  "Sep" : "'. $div_Sep .'",
                  "Oct" : "'. $div_Oct .'",
                  "Nov" : "'. $div_Nov .'",
                  "Dec" : "'. $div_Dec .'"
                },
              "day": {
                "d1" : "'. $d1 .'",
                "d2" : "'. $d2 .'",
                "d3" : "'. $d3 .'",
                "d4" : "'. $d4 .'",
                "d5" : "'. $d5 .'",
                "d6" : "'. $d6 .'",
                "d7" : "'. $d7 .'",
                "d8" : "'. $d8 .'",
                "d9" : "'. $d9 .'",
                "d10" : "'. $d10 .'",
                "d11" : "'. $d11 .'",
                "d12" : "'. $d12 .'",
                "d13" : "'. $d13 .'",
                "d14" : "'. $d14 .'",
                "d15" : "'. $d15 .'",
                "d16" : "'. $d16 .'",
                "d17" : "'. $d17 .'",
                "d18" : "'. $d18 .'",
                "d19" : "'. $d19 .'",
                "d20" : "'. $d20 .'",
                "d21" : "'. $d21 .'",
                "d22" : "'. $d22 .'",
                "d23" : "'. $d23 .'",
                "d24" : "'. $d24 .'",
                "d25" : "'. $d25 .'",
                "d26" : "'. $d26 .'",
                "d27" : "'. $d27 .'",
                "d28" : "'. $d28 .'",
                "d29" : "'. $d29 .'",
                "d30" : "'. $d30 .'",
                "d31" : "'. $d31 .'"
              }
      },
      "type": "'.$type.'",
      "title": "'.$title.'"


}';
?>
