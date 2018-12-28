<?php
    include_once '../../app_data/php/head_no_css.php'; // connection
// id - setting           value
// 2 - dashboard_lock
// 3 - active_dashboard
// 4 - dashboard_period
// 5 - dashboard_frw
// 6 - dashboard_fc
// 7 - dashboard_dol

$dashboard_lock       = retrieve_data('value','settings','setting','dashboard_lock');
$active_dashboard     = retrieve_data('value','settings','setting','active_dashboard');
$dashboard_frw        = retrieve_data('value','settings','setting','dashboard_frw');
$dashboard_fc         = retrieve_data('value','settings','setting','dashboard_fc');
$dashboard_dol        = retrieve_data('value','settings','setting','dashboard_dol');

$dashboard_subTotal        = retrieve_data('value','settings','setting','subTotal');
$dashboard_grandTotal      = retrieve_data('value','settings','setting','grandTotal');

$dashboard_period     = retrieve_data('value','settings','setting','dashboard_period');
$period_d             = retrieve_data('value','settings','setting','period_d');
$period_m             = retrieve_data('value','settings','setting','period_m');
$period_y             = retrieve_data('value','settings','setting','period_y');

echo '
{
    "lock":    "'. $dashboard_lock .'",
    "active":  "'. $active_dashboard .'",
    "period":  {
      "type": "'. $dashboard_period .'",
         "d": "'. $period_d .'",
         "m": "'. $period_m .'",
         "y": "'. $period_y .'"
    },
    "cash": {
        "frw":        "' . $dashboard_frw . '",
        "fc":         "' . $dashboard_fc . '",
        "dol":        "' . $dashboard_dol . '",
        "subTotal":   "' . $dashboard_subTotal . '",
        "grandTotal": "' . $dashboard_grandTotal . '"
    }
}
';
?>
