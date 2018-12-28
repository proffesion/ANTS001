<?php 
include 'app_data/php/head_no_css.php';
$date = @$_GET['date'];
$user = @$user_id;

// chech form the sign table if there is some where tou are assigned ti sign 
// - check1


$query_CheckOne = @number_ret("SELECT `date` FROM `deposit` WHERE `date`='$date' AND `checkOne`='$user' AND `checkOneSign`='0'");
$query_CheckTwo = @number_ret("SELECT `date` FROM `deposit` WHERE `date`='$date' AND `checkTwo`='$user' AND `checkTwoSign`='0'");
$query_aprovedBy = @number_ret("SELECT `date` FROM `deposit` WHERE `date`='$date' AND `aprovedBy`='$user' AND `aprovedBySign`='0'");
$type = "";

if (@$query_CheckOne == 1) {
    $type = "checkOne";
    $found = 1;

} elseif (@$query_CheckTwo == 1) {
    $type = "checkTwo";
    $found = 1;

} elseif (@$query_aprovedBy == 1) {
    $type = "aprovedBy";
    $found = 1;

} else {
    $found = 0;
    $type = "null";
}

echo '
{
    "found": ' .$found. ',    
    "type":  "'. $type .'"     
}
';
?>
