<?php
include 'app_data/php/head_no_css.php';
// echo date('w', strtotime('-1 week'));


// echo "<hr>";
$week_names = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

function week_days_number()
{
    global $time;
    $week_day = date('w', $time); // Important
    if ($week_day == '0') {
      //  return 7;
       return $week_day;

    } else {
       return $week_day;
    }
}

$week_days = week_days_number();


// for ($i=0; $i < 10; $i++) {
//   # code...
//   $lp = 10;
//   $ioj = $lp-$i;
//   echo "$ioj -- incrementing: $i <br>";
// }


for ($i=$week_days; $i >=0 ; $i--) {
  $weck_mod_date = date('d', strtotime("-$i day")); // generating the date
  $loop_date = "$weck_mod_date-$this_month-$this_year"; // arrage the date in a good format

  $sum_day_total_inv = sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `selling_e` WHERE `date`='$loop_date'","Total_Available_Rw");
  $sum_day_total_diver = sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `divers_sales` WHERE `date`='$loop_date'","Total_Available_Rw");

  // Total week
  @$total_week_invitation += $sum_day_total_inv; //sum ofthe invitation
  @$total_week_Diver += $sum_day_total_diver; // sum of diver
}

//
// // INVITATION & DIVER
// for ($i=$week_days; $i >=0 ; $i--) {
//   $weck_mod_date = date('d', strtotime("-$i day")); // generating the date
//   $loop_date = "$weck_mod_date-$this_month-$this_year"; // arrage the date in a good format
//
//   $sum_day_total_invt = sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `selling_e` WHERE `date`='$loop_date'","Total_Available_Rw");
//   // $sum_day_total_divers = sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `divers_sales` WHERE `date`='$loop_date'","Total_Available_Rw");
//
//   $day_perc_inv = round(($sum_day_total_invt / $total_week_invitation) * 100);
//   // $day_perc_div = round(($sum_day_total_divers / $total_week_Diver) * 100);
//   echo "Invitation percent: $day_perc_inv%<br> ";
//   // echo "Diver percent: $day_perc_div%<hr> ";
// }




echo "<br>";







// echo "<hr>";
// echo "total<br>
// Invitation: $total_week_invitation<br>
// Diver: $total_week_Diver<br>
// ";
//
// echo "<br>";
// echo 'week dates:'.date('d', $time); // Important
// echo '<br> week day modified:'.date('d', strtotime('-1 day'));
//
// echo "<hr>";
// echo $week_days;
echo "<br>";
//
// // LOOP FOR DAYS LABEL
// for ($i=0; $i <= $week_days; $i++) {
//   echo '"'.$week_names[$i].'"'; // fetch & print the dates from the array
//   if ($i != $week_days) { echo ","; } // put the commar
// }


// LOOP FOR DAYS LABEL


echo "<br>";

  // if ($week_days > 7) {
  //   echo $week_days;
  // } else {
  //   echo "1";
  // }



  for ($i=$week_days; $i >=0 ; $i--) {
    $weck_mod_date = date('d', strtotime("-$i day")); // generating the date
    $loop_date = "$weck_mod_date-$this_month-$this_year"; // arrage the date in a good format
    $sum_day_total_invt = sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `selling_e` WHERE `date`='$loop_date'","Total_Available_Rw");
    $day_perc_inv = @round(($sum_day_total_invt / $total_week_invitation) * 100); // put data in percantade
    echo @$day_perc_inv; // print the data
    if ($i != 0) { echo ","; } // put the comma
  }
 ?>
