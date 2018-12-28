<?php
include_once '../../app_data/php/head_no_css.php'; // connection

$stockMinValue     = retrieve_data('value','settings','setting','stockMinValue');

$totalStock        =  number_ret("SELECT `e_id` FROM `env_stock` WHERE `view` = '1'");

$bigStock          = number_ret("SELECT `e_id` FROM `env_stock` WHERE `view`= '1' AND `quantity` >= '$stockMinValue'");

$lowStock          = number_ret("SELECT `e_id` FROM `env_stock` WHERE `view`= '1' AND `quantity` < '$stockMinValue' AND `quantity` > '0'");

$zeroStock         = number_ret("SELECT `e_id` FROM `env_stock` WHERE `view`= '1' AND `quantity` <= '0'");

$deactivated         = number_ret("SELECT `e_id` FROM `env_stock` WHERE `view`= '0'");

$bigStock_perc     = @round(($bigStock / $totalStock) * 100);
$lowStock_perc     = @round(($lowStock / $totalStock) * 100);
$zeroStock_perc    = @round(($zeroStock / $totalStock) * 100);


echo '
{
   "total":    "' . $totalStock .'",
     "big":    "' . $bigStock . '",
     "low":    "' . $lowStock . '",
    "zero":    "' . $zeroStock . '",
"deactive":    "' . $deactivated . '",
     "pie": {
         "big":        "' . $bigStock_perc . '",
         "low":         "' . $lowStock_perc . '",
        "zero":        "' . $zeroStock_perc . '"
    }
}
';
?>
