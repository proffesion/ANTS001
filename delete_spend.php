<?php
include 'app_data/php/head_blank.php';
if (!empty($_POST['cid'])) {

  $id = @$_POST['cid'];

if ($mysqli->query("DELETE FROM `spent` WHERE `id`='$id'")) {
?>

<div class="alert alert-success alert-dismissible" role="alert" style="font-size: 14px;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> The spent has been deleted.
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


} else {
  ?>
  <div class="alert alert-warning alert-dismissible" role="alert" style="font-size: 14px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Ooops!</strong> Something wrong try again later!.
  </div>
  <?php
}
?>
