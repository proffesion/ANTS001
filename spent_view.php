<?php
include 'app_data/php/head_blank.php';
$type = $_GET['type'];
$date_spento = $_GET['date'];


$sumIn = 0;
$sumOut = 0;

$result = $mysqli->query("SELECT `total`,`type` FROM `spent` WHERE `date` LIKE '$date_spento'");
if ($result->num_rows == NULL) {
  $sumIn = 0;
  $sumOut = 0;
} else {
    while($row = $result->fetch_array()) {
      $total = $row["total"];
      $typo = $row["type"];
        if ($typo == 'in') {
            $sumIn += $total;
        } else {
            $sumOut += $total;
        }
    }
}
$sumTotal = $sumOut - $sumIn;

if ($type == 'a') {
  $query = "SELECT * FROM `spent` WHERE `date` LIKE '$date_spento'";
} else {
  $query = "SELECT * FROM `spent` WHERE `date` LIKE '$date_spento' AND `type` LIKE '$type'";
}

// MySqli Select Query
$results = $mysqli->query($query);
if ($results->num_rows == NULL) {
    // echo "
    ?>
    <center>
       <h2 class="fa fa-folder-open-o no_result_h2_ico"></h2>
       <h2>No Result Found!</h2>
       <p>There is no result for this date <b><?php echo $date_spento; ?></b></p>
    </center>
     <?php //";
} else {




function display_lab($val) {
  if ($val == 'in') {
    return ' <b class="fa fa-plus-circle" style="font-size: 20px; color: #4caf50;"></b>';
  } else {
    return ' <b class="fa fa-minus-circle" style="font-size: 20px; color: #e9311e;"></b>';

  }
}

?>


  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne" style="background:transparent;">
        <h4 class="panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <a >
            <?php echo "<i> $date_spento </i>"; ?>
          </a>
        </h4>
      </div>

      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
          Total <b class="fa fa-plus-circle" style="font-size: 20px; color: #4caf50;"></b>: <b> <?php echo @$sumIn; ?> frw</b> <hr style="margin:2px;">
          Total <b class="fa fa-minus-circle" style="font-size: 20px; color: #e9311e;"></b>: <b> <?php echo @$sumOut; ?> frw</b> <hr style="margin:2px;">
          Total: <b><?php echo @$sumTotal; ?> frw</b> <hr style="margin:2px;">
        </div>
      </div>
    </div>

<?php

    while($row = $results->fetch_array()) {
         // `id`, `date`, `type`, `cash`, `cash_type`, `rate_rw`, `rate_fc`, `total`, `reason`
         $id = $row["id"];
         $date_spent = $row["date"];
         $type = $row["type"];
         $cash = $row["cash"];
         $cash_type = $row["cash_type"];
         $rate_rw = $row["rate_rw"];
         $rate_fc = $row["rate_fc"];
         $total = $row["total"];
         $reason = $row["reason"];

         ?>
         <div class="panel panel-default" id="spentN<?php echo $id; ?>">
           <div class="panel-heading" role="tab" id="heading<?php echo $id; ?>">
             <h4 class="panel-title">
               <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id; ?>" aria-expanded="false" aria-controls="collapse<?php echo $id; ?>">
                 <label> <b><?php echo display_lab($type).' '.$cash; ?></b> <?php echo $cash_type; ?> </label> - <b> <?php echo $reason; ?> </b>
               </a>
             </h4>
           </div>
           <div id="collapse<?php echo $id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $id; ?>">
             <div class="panel-body">
               <table class="table table-striped no_border">
                 <tr >
                   <td colspan="2"><b>Cause:</b> <br> <?php echo $reason; ?> </td>
                 </tr>
                 <tr>
                   <tr>
                     <th>Payed</th>
                     <td><b><?php echo $cash.' '.$cash_type; ?></b></td>
                   </tr>

                   <th>Type</th>
                   <td><?php echo display_lab($type); ?></td>
                 </tr>
                 <tr>
                   <th>Tota (Rw)</th>
                   <td><b><?php echo @$total; ?></b> </td>
                 </tr>
                 <tr>
                   <th>Rate</th>
                   <td><b><?php echo $rate_rw.'Frw/'.$rate_fc.'Fc'; ?></b> </td>
                 </tr>
                 <tr>
                   <th>Date</th>
                   <td><b><?php echo $date_spent; ?></b> </td>
                 </tr>

               </table>

               <button type="button" class="btn btn-danger" onclick="return deleteSpent(<?php echo @$id; ?>);"> <b class="fa fa-trash"></b> Delete</button>

             </div>
           </div>
         </div>
         <?php

    }

?>
<!-- </table> -->
</div>

<?php
}
 ?>

<?php

 ?>
