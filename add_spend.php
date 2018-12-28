<?php
include 'app_data/php/head_blank.php';

$rateRw = $_POST['rateRw'];
$rateCo = $_POST['rateCo'];
$type = $_POST['type'];
$cashIn = $_POST['cashIn'];
$cashType = $_POST['cashType'];
$Total = $_POST['Total'];
$comment = $_POST['comment'];
$date = $_POST['date'];

if ($rateRw == "" || $rateCo == "" || $type == "" || $cashIn == "" || $cashType == "" || $Total == ""|| $comment == "") {
?>
<div class="alert alert-danger alert-dismissible" role="alert" style="font-size: 14px;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning!</strong> All field are required!.
</div>
<?php
} else {
  $query = "INSERT
INTO
  `spent`(
    `date`,
    `type`,
    `cash`,
    `cash_type`,
    `rate_rw`,
    `rate_fc`,
    `total`,
    `reason`
  )
VALUES(
  '$date',
  '$type',
  '$cashIn',
  '$cashType',
  '$rateRw',
  '$rateCo',
  '$Total',
  '$comment'
)";
  if($mysqli->query($query)) {
  ?>
  <div class="alert alert-success alert-dismissible" role="alert" style="font-size: 14px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Success!</strong> The spent has been Inserted.
  </div>
  <?php
  } else {
    ?>
    <div class="alert alert-warning alert-dismissible" role="alert" style="font-size: 14px;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Warning!</strong> Something wrong try again later!.
    </div>
    <?php
  }


}
?>
