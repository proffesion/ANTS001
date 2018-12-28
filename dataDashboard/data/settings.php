<?php
    include_once '../../app_data/php/head_no_css.php'; // connection

    $json = '';
    $results = $mysqli->query("SELECT * FROM `settings`"); // retrive all setings
    $i = 0;
    $json .= '[';

    while($row = $results->fetch_array()) {
        $i++;
        $json .='{';        
            $json .= '"id":"'.$row['id'].'",';
            $json .= '"name":"'.$row['name'].'",';
            $json .= '"value":"'.$row['value'].'"';
        $json .='}';

        if ($results->num_rows != $i) { $json .=','; }
        
    }
    $json .= ']';

    echo $json;
?>

