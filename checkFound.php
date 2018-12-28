<?php 
include 'app_data/php/head_no_css.php';
$date = @$_GET['date'];


// DEFINE VARIABLES
$invitationSell = '';
$invitationBalance = '';
$diversSell = '';
$diversBalance = '';
$deposit = '';

$handCashDate = 'No date Found';
  

// - deposit
if (number_ret("SELECT `id` FROM `deposit` WHERE `date`='$date'") >= 1) {
    $deposit = 1;
    $handCashDate = @retrieve_data('dateTime', 'deposit', 'date', $date);
} else {
    $deposit = 0;
}

// - Invitation sales
if (number_ret("SELECT `s_id` FROM `selling_e` WHERE `date`='$date'") >= 1) {
    $invitationSell = 1;
} else {
    $invitationSell = 0;
}

// - Invitation Balance
if (number_ret("SELECT `balance_id` FROM `balance_table` WHERE `item`='Invitation' AND `date`='$date'") >= 1) {
    $invitationBalance = 1;
} else {
    $invitationBalance = 0;
}

// - Divers  Sell
if (number_ret("SELECT `s_id` FROM `divers_sales` WHERE `date`='$date'") >= 1) {
    $diversSell = 1;
} else {
    $diversSell = 0;
}


// - Divers Balance
if (number_ret("SELECT `balance_id` FROM `balance_table` WHERE `item`='Divers' AND `date`='$date'") >= 1) {
    $diversBalance = 1;
} else {
    $diversBalance = 0;
}






echo '
{
    "invitation": {
        "sell": '. $invitationSell . ',
        "balance": ' . $invitationBalance . '
    },    
    "divers": {
        "sell": ' . $diversSell . ',
        "balance": ' . $diversBalance . '
    },
    "deposit": ' . $deposit . ' ,
    "handCashDate": "'. $handCashDate .'"  
}
';
?>
