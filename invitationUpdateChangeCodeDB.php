<?php
include 'app_data/php/head_blank.php';
secured();

if (isset($_POST['change']) && isset($_POST['sell_id']) && isset($_POST['current']) &&  isset($_POST['selected'])) {
  $sell_id = $_POST['sell_id'];
  $current = $_POST['current'];
  $selected = $_POST['selected'];

// stock
 $sell_quantity =  retrieve_data('quantity','selling_e','s_id',$sell_id);
 $stock_curent = fileData('quantity',$current);
 $stock_selected = fileData('quantity',$selected);

 // New curent
 $new_stock_curent = $stock_curent + $sell_quantity;

 // New Selected
 if ($sell_quantity > $stock_selected) {
     $new_stock_selected = 0;
 } else {
     $new_stock_selected = $stock_selected - $sell_quantity;
 }


?>
<div class="fading-containner" style="margin-top: 49px;">
<?php

  $query_Code = "UPDATE `selling_e` SET `e_id` = '$selected' WHERE `s_id`='$sell_id'";
  if ($results = $mysqli->query($query_Code)) {
    ?>
      <div class="alert alert-success alert-dismissible fading-item" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong class="fa fa-check-circle-o"></strong> Invitation Code Changed!
      </div>
    <?php
  } else {
    ?>
    <div class="alert alert-danger alert-dismissible fading-item " role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong class="fa fa-exclamation-triangle"></strong> Failed to change the Code! </b>
    </div>
    <?php
  }

 // 2. update stock curent
 $query_Current = "UPDATE `env_stock` SET `quantity` = '$new_stock_curent' WHERE `e_id`='$current'";
 if ($results = $mysqli->query($query_Current)) {
   ?>
     <div class="alert alert-success alert-dismissible fading-item" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <strong class="fa fa-check-circle-o"></strong> <b><?php echo $current; ?> Stock's Updated!</b>
     </div>
   <?php
 } else {
   ?>
   <div class="alert alert-danger alert-dismissible fading-item " role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <strong class="fa fa-exclamation-triangle"></strong> <b><?php echo $current; ?> Stock's Update <b>(Failed!)</b>
   </div>
   <?php
 }

 // 2. update stock selected
 $query_Selected = "UPDATE `env_stock` SET `quantity` = '$new_stock_selected' WHERE `e_id`='$selected'";
 if ($results = $mysqli->query($query_Selected)) {
   ?>
     <div class="alert alert-success alert-dismissible fading-item" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <strong class="fa fa-check-circle-o"></strong> <b><?php echo $selected; ?> Stock's Updated!
     </div>
   <?php
 } else {
   ?>
   <div class="alert alert-danger alert-dismissible fading-item " role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <strong class="fa fa-exclamation-triangle"></strong> <b><?php echo $selected; ?> Stock's Update <b>(Failed!)</b>
   </div>
   <?php
 }
  // if ($results = $mysqli->query($query))
  // {
  //    echo "Process done";
  //    echo "
  //    <a href='edit_sell.php?id=$sell_id'> Edit Sell </a>
  //    <a href='sell_view.php?details_id=$sell_id'> View Sell </a>
  //
  //    ";
  // } else {
  //   echo "there was some error please try again later";
  // }

 ?>
</div>

<div class="update-inv-Fdv" style=" padding: 10px; margin-top: 3px; box-shadow: 0px 4px 11px #616161;">

<a href="home.php" style="background:transparent;">
  <button type="button" class="btn btn-primary">Home</button>
</a>

<a href="sell_view.php?details_id=<?php echo @$sell_id; ?>" style="background:transparent;">
  <button type="button" class="btn btn-primary">View Sell</button>
</a>

</div>






<section class="fixed-butt">
   <a href="home.php" title="Home">
     <button type="button" name="button" class="click"><b class="fa fa-home"></b></button>
   </a>

</section>

<?php
} else {
   ?>
   <head>
   <meta http-equiv="refresh" content="0; url=home.php"/>
   </head>
   <?php
}
?>

 <style media="screen">


     .fixed-butt {
       position: fixed;
       top: 6px;
       left: 7px;
     }

     .fixed-butt a { background: transparent; }

     .fixed-butt button {
         background: #2196F3;
         border: 2px solid #fff;
         font-size: 21px;
         width: 40px;
         height: 40px;
         border-radius: 100%;
         box-shadow: 0px 0px 1px #000;
         color: #fff;
     }

   .update-inv-Fdv {
     margin: auto;
     width: 400px;
     /*height: 300px;*/
     background: #fff;
     box-shadow: 0px 0px 11px #616161;
     margin-top: 34px;
     border-radius: 5px;

   }


   .update-inv-Fdv p {
     text-align: center;
     font-size: 16px;
     padding: 10px;
   }
   .alert {
     width: 400px;
     margin: auto;
   }

   .update-inv-Fdv .btn {
     width: 49%;
     padding: 8px;
     font-size: 18px;
   }
 </style>
 <script src="app_data/java/functions.js"></script>
