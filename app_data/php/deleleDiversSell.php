<?php
  include 'head_iframe_cl.php';
  $sell_id = $_GET['id'];

  // sell data
  $div_id = retrieve_data('div_id','divers_sales','s_id',$sell_id);
  $sell_quantity = retrieve_data('quantity','divers_sales','s_id',$sell_id);

  // stock data
  $stock_quantity = retrieve_data('pro_quantity','products','pro_id',$div_id);
  $update_tock_Quantity = $stock_quantity + $sell_quantity;


if (isset($_POST['delete_op'])) {

if (@$_POST['stock'] == 'ok') {
  // echo "it is checked <br>";
      if ($results = $mysqli->query("UPDATE `products` SET `pro_quantity` = '$update_tock_Quantity' WHERE `pro_id`='$div_id'")) {
          if ($results = $mysqli->query("DELETE FROM `divers_sales` WHERE `s_id`='$sell_id'")) {
            // echo "the stock table is updated and the sell is deleted";
            echo "<script> window.open('../../divers.php?2','_self'); </script>";

          }
      }
} else {
  // echo "it is not checked";
    if ($results = $mysqli->query("DELETE FROM `divers_sales` WHERE `s_id`='$sell_id'")) {
      // echo "the sell is deleted";
         echo "<script> window.open('../../divers.php?1','_self'); </script>";

    }

}

}

?>

<div class="delete-sell-contain bounceIn animated">
<h2 class="fa fa-trash-o"></h2> <br>
<b> Are you sure you want to detete this sell?? </b>
<p style="text-align: left;">
<br>
<?php echo "Sell id:<b> $sell_id </b><br>"; ?>
            Product:<b> <?php echo retrieve_data('pro_name','products','pro_id',$div_id); ?> </b><br>
<?php echo "Sell Quantity:<b> $sell_quantity </b><br>";
// echo "Stock Quantity: $stock_quantity <br>";
// echo "Update Quantity: $update_tock_Quantity <br>";
 ?>
</p>



<form class="" action="deleleDiversSell.php?id=<?php echo $sell_id; ?>" method="post">
<!-- <hr> -->
<p class="p-check">
 &nbsp;  <input type="checkbox" class="check-b" name="stock" value="ok" checked=""> &nbsp; Update Stock
</p>
<hr>
  <!-- <input type="submit"  name="delete_op" value="Delete"> -->
  <button type="submit" class="btn btn-primary btn-block bg-red" name="delete_op"> <b class="fa fa-trash-o"></b> &nbsp; Delete  </button>
<!-- </p> -->
<br>
</form>

</div>



<style media="screen">
  .delete-sell-contain {
    background: #fff;
    margin: auto;
    width: 372px;
    padding: 12px 37px;
    border-radius: 8px;
    margin-top: 54px;
    box-shadow: 0px 0px 17px -1px #F44336;
    text-align: center;
  }

  .delete-sell-contain h2 {
    margin: 0;
    color: #E91E63;
    font-size: 75px;
    margin-top: 16px;
  }

  .check-b {
    transform: scale(1.9);
    margin-right: 9px;
    margin-left: 7px;
}
.p-check {
  text-align: left;
      border-top: 1px solid rgba(0, 0, 0, 0.28);
      margin-top: 4px;
      padding-top: 10px;
}
</style>


 </body>
 </html>
