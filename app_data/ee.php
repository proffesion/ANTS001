<?php
// $mysqli->close(); // to close the connection


// MySqli Select Query
$results = $mysqli->query("SELECT * FROM `test`");
// echo $results->num_rows; // number of result

if ($results->num_rows == NULL) {
    echo "No data";
} else {

    while($row = $results->fetch_array()) {
         $name = $row["name"];
        print '<td>'.$name.'</td>';

    }

}



/// SELECT SINGLE row
$result = $mysqli->query("SELECT * FROM `test` LIMIT 1");
if($result->num_rows > 0){
    echo $result->fetch_object()->name;
}


// Frees the memory associated with a result
// $results->free();





////////// success
?>
<div class="alert alert-success alert-dismissible" style="margin-bottom: 0;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b class=" fa fa-check"></b> &nbsp; The User Has Been upadted!
</div>
<?php

////////// warning
?>
<div class="alert alert-warning alert-dismissible" style="margin-bottom: 0;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b class=" fa fa-warning"></b> &nbsp; Try again later
</div>
<?php

////////// danger
?>
<div class="alert alert-danger alert-dismissible" style="margin-bottom: 0;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b class=" fa fa-warning"></b> &nbsp; Try again later
</div>
<?php


 ?>
