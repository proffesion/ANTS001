<?php 
include 'app_data/php/head_no_css.php';

$password    = md5($_POST['pass']);
$SCode       = $_POST['SCode'];
$Stype       = $_POST['Stype'];
$date        = $_POST['date'];
$user        = $user_id;

$msg   = "";
$allow = "";
$sign = "";

// set the corespnding type to the signture
// `checkOne` --> `checkOneSign` 
// `checkTwo` --> `checkTwoSign` 
// `aprovedBy` --> `aprovedBySign`
if ($Stype == 'checkOne') {
    $sign = "checkOneSign";
} else if ($Stype == 'checkTwo') {
    $sign = "checkTwoSign";
} else if ($Stype == 'aprovedBy') {
    $sign = "aprovedBySign";
}


///// DB DATA /////////////////////////////////////////
$DBpassword      = retrieve_data('password', 'users', 'user_id', $user);
$DBSCode         = retrieve_data('sign_code', 'signature', 'user_id', $user);


// check the password
if ($DBpassword === $password) {
        // check the signCode
        if ($DBSCode === $SCode) {
            // make sure the user is already selected in the database
            if (number_ret("SELECT `id` FROM `deposit` WHERE `$Stype`='$user' AND `date`='$date'") == 1) {
               
                // SET TO SIGN
                $queryUpdate = "UPDATE `deposit` SET `$sign`='1' WHERE `$Stype`='$user' AND `date`='$date'";
                if($mysqli->query($queryUpdate)) {
                    $msg = "Thank you for your signature!";
                    $allow = 1;
                } else {
                    $msg = "Opps, Something went wrong, please try again later";
                    $allow = 0;
                }

            } else {
                $msg = "Incorect Signature type";
                $allow = 0;
            }

        } else {
            $msg =  "incorect Signature Code!";
            $allow = 0;
        }

} else {
    $msg = "Password incorect";
    $allow = 0;
}




// return the json
echo '
{
    "allow": ' . $allow . ',    
    "message":  "' . $msg . '"     
}
';