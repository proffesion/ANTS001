<?php 
include 'app_data/php/head_no_css.php';
$date = $_POST['date'];
$user = $_POST['u_id'];
$type = $_POST['type'];

if ($type == 'check1') {
            $checkType = 'checkOne';
            $signType  = 'checkOneSign';
} else if ($type == 'check2') {
            $checkType = 'checkTwo';
            $signType  = 'checkTwoSign';
} else if ($type == 'aprovedBy') {
            $checkType = 'aprovedBy';
            $signType  = 'aprovedBySign';
}

// DEFINE VARIABLES
$msg  = "";
$done = 0;

// CHECK IF THE USER HAVE THE PERMITION TO USE THIS FEATURE
if (number_ret("SELECT `id` FROM `signature` WHERE `user_id`='$user' AND `allowed`='1'") == 0) {
    $msg = '<i>'. retrieve_data('lname', 'users', 'user_id', $user) .'</i> is not allowed to sign!';
} else {
 
    // CHECK IF THE USER EXISTE IN THE DEPOSIT FORM
    if (number_ret("SELECT `id` FROM `deposit` WHERE `checkOne`='$user' AND `date`='$date' OR  `checkTwo`='$user' AND `date`='$date' OR `aprovedBy`='$user' AND `date`='$date'") != 0) {
        $msg = '<i>' . retrieve_data('lname', 'users', 'user_id', $user) . '</i> already selected';
    } else {

        // CHECK IF THE CURENT USER IS ALREADY SIGNED
        if (number_ret("SELECT `id` FROM `deposit` WHERE `date`='$date' AND `$signType`='1'") == 1) {
            $msg = '<i>' . retrieve_data('lname', 'users', 'user_id', $user) . '</i> already SIGNED';
        } else {
            // INSERT THE USER
            $query = "UPDATE `deposit` SET `$checkType`='$user' WHERE `date`='$date'";
            if ($results = $mysqli->query($query)) {
                $msg = '<br><i>' . retrieve_data('lname', 'users', 'user_id', $user) . '</i> id set to sign as <b>'. $checkType .'</b>!';
                $done = 1;
            } else {
                $msg = 'Please try again later';
            }
        }
        

    }
// CHECK IF IS THE SAME USER WHICH IS BEING SENT AGAIN

}

echo '{
    "message":"'. $msg .'",
    "done": '. $done .'
}';
?>