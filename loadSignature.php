<?php 
include 'app_data/php/head_no_css.php';

$date = $_GET['date'];
// check if there is a signature set
// check if signate
// load signature

// check if check one is empty
$checkOneFound   = '';
$checkTwoFound   = '';
$aprrove         = '';

$signatureOne        = '';
$signatureTwo        = '';
$ApproveSignature    = '';


// for user check one
if (number_ret("SELECT `checkOneSign` FROM `deposit` WHERE `checkOneSign`='1' AND `date`='$date'") == 1) {
        // return id of checker one
        $checkerOneId = query_return_value("SELECT `checkOne` FROM `deposit` WHERE `date`='$date'", 'checkOne');
        
        // load the image path
        $signature1 = query_return_value("SELECT `signature` FROM `signature` WHERE `user_id`='$checkerOneId'", 'signature');

        $checkOneFound = 1;
        $signatureOne = $signature1;

    
} else {
    $checkOneFound = 0;
}




// for user check one
if (number_ret("SELECT `checkTwoSign` FROM `deposit` WHERE `checkTwoSign`='1' AND `date`='$date'") == 1) {
        // return id of checker one
        $checkerTwoId = query_return_value("SELECT `checkTwo` FROM `deposit` WHERE `date`='$date'", 'checkTwo');
        
        // load the image path
        $signature2 = query_return_value("SELECT `signature` FROM `signature` WHERE `user_id`='$checkerTwoId'", 'signature');

        $checkTwoFound = 1;
        $signatureTwo = $signature2;

} else {
        $checkTwoFound = 0;
}




// for user check one
if (number_ret("SELECT `aprovedBySign` FROM `deposit` WHERE `aprovedBySign`='1' AND `date`='$date'") == 1) {
        // return id of checker one
        $checkerApprove = query_return_value("SELECT `aprovedBy` FROM `deposit` WHERE `date`='$date'", 'aprovedBy');
        
        // load the image path
        $signatureApprove = query_return_value("SELECT `signature` FROM `signature` WHERE `user_id`='$checkerApprove'", 'signature');

        $aprrove = 1;
        $ApproveSignature = $signatureApprove;
} else {
        $aprrove = 0;
}



// return the json
echo '
{
    "checker1": {
        "found":' . $checkOneFound . ',
        "signature": "' . $signatureOne . '"
    },       
    "checker2": {
        "found":' . $checkTwoFound . ',
        "signature": "' . $signatureTwo . '"
    },
     "aprover": {
        "found":' . $aprrove . ',
        "signature": "' . $ApproveSignature . '"
    }
}
';

