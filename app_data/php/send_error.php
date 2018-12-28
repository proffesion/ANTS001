<?php
include 'head_iframe_cl.php';
@$errId = $_GET['er'];
@$typ = $_GET['typ'];


if (isset($_POST['report_error'])) {
 $err_descr =$_POST['err_descr'];
$qul = "INSERT
INTO
  `error_table`(
    `sell_id`,
    `user_id`,
    `date`,
    `description`,
    `typ`
  )
VALUES(
  '$errId',
  '$user_id',
  '$time_now',
  '$err_descr',
  '$typ'
)";

if ($results = $mysqli->query($qul)) {
?>
<style media="screen">
  form { display: none; }
  body { background: rgb(78, 161, 78); }
</style>
<section style="width:100%;text-align:center;">
  <h2 class="fa fa-check bounceIn animated" style="font-size: 107px;color: #fff;margin-top: 54px;"></h2><br>
  <b style="color: #fff;font-size: 16px;">The Error Has been sent to the Admin</b>
</section>
  <?php
} else {
  ?>
  <style media="screen">
    form { display: none; }
    body { background: red; }
  </style>
  <section style="width:100%;text-align:center;">
    <h2 class="fa fa-check bounceIn animated" style="font-size: 107px;color: #fff;margin-top: 54px;"></h2><br>
    <b style="color: #fff;font-size: 16px;">Please Try again Later</b>
  </section>
    <?php
}

}

?>

<form class="" action="send_error.php?er=<?php echo $errId; ?>&typ=<?php echo $typ; ?>" method="post">

<section class="send_err">
<h2> <b class="fa fa-bell"></b> Report Error </h2>
<p style="margin: 9px 3px;">
<label>sell id:</label><b><?php echo $errId; ?></b> <br>
  <label>reported by:</label><b><?php echo retrieve_data('username','users','user_id',$user_id); ?></b> <br>
<label>Type:</label><b> <?php echo ErrorDisplayTaype($typ); ?> </b>
</p>
<textarea name="err_descr" rows="8" cols="40" class="scroll" required=""></textarea>
<button type="submit" name="report_error" class="btn btn-success click" style="    margin: -6px 0px;border-radius: 0px;width: 100%;"> <b class="fa fa-send "></b> &nbsp; Send Error </button>
</section>

</form>


<style media="screen">
  b { color: #fff;}
  body {     background: #9d1442; }
</style>
