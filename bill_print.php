<?php
include 'app_data/php/head_blank.php';
secured();

if (isset($_GET['id']) || !empty($_GET['id'])) {
  @$selected_id = $_GET['id'];
} else {
  $selected_id = '';
?>
<div class="error-dv bounceIn animated"> Please selact a sale </div>
<?php
}



  $date_Query = "SELECT * FROM `selling_e` WHERE `s_id`='$selected_id' LIMIT 1";
  $results = $mysqli->query("$date_Query");
  if ($results->num_rows == NULL) { echo '<div class="error-dv bounceIn animated"> Invalid Command </div>'; }
   else {
        while($row = $results->fetch_array()) {

        @$s_id = $row["s_id"];
        @$e_id = $row["e_id"];
        @$typ = $row["typ"];
        @$date = $row["date"];
        @$quantity = $row["quantity"];
        @$client_name = $row["client_name"];
        @$closed = $row["closed"];
        @$paym_typ = $row["paym_typ"];
        @$done_by = $row["done_by"];
        @$price_unit_rw = $row["price_unit_rw"];
        @$price_tot_rw = $row["price_tot_rw"];
        @$price_unit_d = $row["price_unit_d"];
        @$price_tot_d = $row["price_tot_d"];
        @$avance = $row["avance"];
        @$balance = $row["balance"];
?>
<!-- <br> -->
<div class="print-button hide-print" onclick="print()"><b class="fa fa-print"></b></div>



<div class="bill-container">
<section>
<img src="app_data\imgs\icns\antares_black.png" alt="" style="height: 41px;" /> <hr style="    border-bottom: 4px solid #000;margin: 0px; margin-top: 7px;opacity: 0.7;">
<h2 style="width: 100%;text-align: center;margin-top: 12px;font-weight: 600;"> BILL </h2>
<br>

<section class="val-section">
<label class="label-v">Client Name:</label> <label class="value"><?php echo @$client_name; ?></label> <hr>
<label class="label-v">Bill Id:</label> <label class="value">#<?php echo @$s_id; ?></label> <hr>
<label class="label-v">Product:</label> <label class="value">Invitation</label> <hr>
<!-- <label class="label-v">Product:</label> <label class="value">Invitation</label> <hr> -->

<label class="label-v">Sell Type:</label> <label class="value"><?php echo @$typ; ?></label> <hr>
<label class="label-v">Product Id:</label> <label class="value">#<?php echo @$e_id; ?></label> <hr>
<label class="label-v">Quantity:</label> <label class="value"><?php echo @$quantity; ?></label> <hr>
<label class="label-v">Payed In:</label> <label class="value"><?php echo @$paym_typ; ?></label> <hr>
<?php  if ($paym_typ == 'Rfw') { ?>
  <label class="label-v">Price Unity:</label> <label class="value"><?php echo @$price_unit_rw; ?> Frw</label> <hr>
  <label class="label-v">Price Total:</label> <label class="value"><?php echo @$price_tot_rw; ?> Frw</label> <hr>
<?php } else { ?>
  <label class="label-v">Price Unity:</label> <label class="value"><?php echo @$price_unit_d; ?> $</label> <hr>
  <label class="label-v">Price Total:</label> <label class="value"><?php echo @$price_tot_d; ?> $</label> <hr>
<?php }  ?>
<label class="label-v">Closed:</label> <label class="value"><?php echo @$closed; ?></label> <hr>

<label class="label-v">Date:</label> <label class="value"><?php echo @$date; ?></label> <hr>
<label class="label-v">Done By:</label> <label class="value">#<?php echo @$done_by; ?></label>
</section>

<p>
<b style="font-size: 20px;">ANTARES Ltd</b> <br>
Address: <b>Rusenyi-Rubavu</b><br>
Phone: <b>+250 788 800 848 </b> <br>
Email: <b>magrwanda@gmail.Com</b><br>
TIN: <b>106799653</b><br>
printed on: <b><?php echo @$time_now; ?></b>
</p>

</section>
<hr>
</div>


<?php      }

  }
?>

<style media="screen">
body {
  background: #000;
}
.error-dv {
      background: #E91E63;
      width: 500px;
      text-align: center;
      margin: auto;
      margin-top: 111px;
      padding: 28px;
      font-size: 23px;
      color: #fff;
      border-radius: 7px;
}

.print-button {
  position: fixed;
  font-size: 32px;
  color: #fff;
  background: #2196F3;
  padding: 9px;
  width: 61px;
  height: 63px;
  text-align: center;
  border-radius: 7px;
  right: 3px;
  top: 4px;
  text-shadow: 0px 0px 6px #333;
}





.val-section hr {
  border-bottom: 1px dashed #333;
  margin: 3px 0px;
  opacity: 0.5;
}
.val-section .label-v {
  font-size: 16px;
  /*width: 130px;*/
  width: 28%;
}
.val-section .value {
  font-size: 16px;
  font-weight: normal;
  width: 69%;
  text-align: right;
}

.bill-container {
  background: #fff;
  width: 444px;
  margin: auto;
  margin-top: 30px;
  padding: 22px;
}

.bill-container img {
  height: 41px;
}

.bill-container section {
  /*border-bottom: 2px solid #000;*/
  padding-bottom: 7px;
}
.bill-container p { margin-top: 40px; }
/*.bill-container p b { margin-top: 40px; }*/


</style>

<?php // include 'app_data/php/foater.php' ?>
