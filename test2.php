
<h1>
<?php

// echo toMoney('300000.12'); //Note: single quotes mandatory
function money($money) {
  return number_format($money,2);
}
$money = 11111111110.12;
// echo number_format($money);
// echo  number_format($money,2);
echo money(3010000.12); 
?>


