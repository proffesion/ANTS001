<?php
include 'app_data/php/head_no_css.php';
$date = @$_GET['date'];
$user = @$user_id;


$checker_one = @retrieve_data('checkOne', 'deposit', 'date', $date);
$checker_two = @retrieve_data('checkTwo', 'deposit', 'date', $date);
$aprove = @retrieve_data('aprovedBy', 'deposit', 'date', $date);

function getUser5($id) {
    if ($id != 0) {
        return @retrieve_data('fname', 'users', 'user_id', $id).' '.@retrieve_data('lname', 'users', 'user_id', $id);
    } else {
        return ' Select';
    }
    
}


echo '
{
    "check1": {
        "id":"'. $checker_one . '",
        "names":"'. @getUser5($checker_one) . '"
    },    
    "check2": {
        "id": "'.$checker_two . '",
        "names": "'. @getUser5($checker_two) . '"
    },    
    "approve": {
        "id": "'. $aprove . '",
        "names": "'. @getUser5($aprove) .'"
    }    
}
';
?>
