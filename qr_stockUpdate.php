<?php
include 'app_data/php/head_no_css.php';

$id    = $_GET['id'];
$value = $_GET['value'];

$message = "";
$success = 0;
$newValue = "";

if (empty($id)) {
    $message = "No Invitation id found <small>Please re-scan the invitation, and try again.</small>";
    $success = 0;
} else if (empty($value)) {
    $message = "The Location must not be empty!";
    $success = 0;
} else {
    # run the query
    if ($results = $mysqli->query("UPDATE `env_stock` SET `place`='$value' WHERE `e_id`='$id'")) {
        $message = "The Location has been updated!";
        $success = 1;
        $newValue = $value;
    } else {
        $message = "Some thing went wrong try again later!";
        $success = 0;
    }
}


echo '
{
    "message": "' . $message . '",
    "success": "' . $success . '",
    "data": "' . $newValue . '"
}
';
