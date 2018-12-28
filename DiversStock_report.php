<?php
include 'app_data/php/head_blank.php';
secured();
?>
<section class="hide-print">

<div class="head-tit-rep-div">
  DIVERS STOCK REPORT
  <a href="home.php" style="float: right;margin-right: 23px;text-decoration: none;color: #fff;"><b class="fa fa-home"></b></a>
</div>
<div class="report-controls">
 <section class="rowe">
   <form class="" action="stock_report.php" method="post">
   <!-- <section class="colmn big">
        <section class="">
           <div class="form-group" style="float:left;width:50%;">
               <label for="">Envitation Id</label>
               <input type="text" name="envt_id" class="form-control" value="" id="" placeholder="Envitation Id">
           </div>
           <div class="form-group"  style="float:left;width:50%;">
               <label for="">Stock</label>
               <input type="text" name="place" class="form-control" value="" id="" placeholder="Stock">
           </div>
           <section class="clear-both">x</section>
        </section>
    </section> -->

   <!-- <section class="colmn">
     <div class="form-group">
         <label for="">Select Order</label>
         <section>
         <select name="or_by" class="form-control" style="width:50%;float:left">
           <option value=""></option>
           <option value="quantity">Quantity</option>
           <option value="price_d">Price ($)</option>
           <option value="price_r">Price (Rwf)</option>
         </select>

         <select name="or_typ" class="form-control" style="width:50%;float:left">
           <option value=""></option>
           <option value="ASC">Ascending</option>
           <option value="DESC">Descending</option>
         </select>

         <section class="clear-both">x</section>
         </section>
     </div>
    </section> -->

    <!-- <section class="colmn">
      <div class="form-group">
          <label for="">Size</label>
          <section>
          <input type="text" name="sw" class="form-control" placeholder="Width" style="width:50%;float:left">
          <input type="text" name="sh" class="form-control" placeholder="Height" style="width:50%;float:left">

          <section class="clear-both">x</section>
          </section>
      </div>
     </section> -->

    <!-- <section class="colmn small"> -->
    <!-- <section class="colmn small" style="padding: 26px 0px 0px 12px;text-align: right;">
      <button type="submit" class="btn btn-primary submit-butt" name="search"><b class="fa fa-search"></b>&nbsp; Check</button>
        <a href="stock_report.php" style="background: transparent;"> <button type="button" class="btn btn-primary" name="button"><b class="fa fa-navicon"></b> &nbsp; View All</button> </a>
        <button type="button" class="btn btn-primary print-sett-show" name=""> <b class="fa fa-ellipsis-v"></b> </button>
     </section> -->
   <section class="clear-both">x</section>
  <section class="print-sett" style="display:block;">
     name This Report:
     <input type="text" onkeyup="headReport()" id="textHead" value="">
        <button type="button" class="btn btn-primary" onclick="print()"> <b class="fa fa-print"></b> Print</button>
  </section>
 </section>
</div>
</form>

</section>




<?php
// $size_q = '';
// $env_q = '';
// $place_q = '';
// $sorder_q = '';
//
// if (isset($_POST['search'])) {
//
//   if (isset($_POST['sw']) && !empty($_POST['sw']) && isset($_POST['sh']) && !empty($_POST['sh'])) { # date working
//     @$sw = $_POST['sw'];
//     @$sh = $_POST['sh'];
//     $size_q = "AND `size_w` LIKE '%$sw%' AND `size_h` LIKE '%$sh%'";
//   }
//   // ````
//
// // Sell Type
// if (isset($_POST['or_by']) && !empty($_POST['or_by']) && isset($_POST['or_typ']) && !empty($_POST['or_typ'])) { # code..
//    $or_typ = $_POST['or_typ'];
//    $or_by = $_POST['or_by'];
//    $sorder_q = " ORDER BY `$or_by` $or_typ";
// }
//
// // Envitation Id
// if (isset($_POST['envt_id']) && !empty($_POST['envt_id'])) { # code..
//    $envitation_id = $_POST['envt_id'];
//    $env_q = "AND `e_id`='$envitation_id'";
// }
//
//
// // Client Name
// if (isset($_POST['place']) && !empty($_POST['place'])) { # code..
//    $place = $_POST['place'];
//    $place_q = "AND `place` LIKE '%$place%'";
// }
//
//
// }
// ----------------------------------------------
// query condition controlls
// @$cond_query ="$env_q $place_q $size_q  $sorder_q";
// $mainQuerySearch = "SELECT * FROM `env_stock` WHERE `e_id`>'1' $cond_query";
// echo $mainQuerySearch;
?>

<?php include 'app_data/php/print_head.php'; ?>




<?php
// MySqli Select Query
$results = $mysqli->query("SELECT * FROM `products`");
// echo $results->num_rows; // number of result
$ert = 0;
if ($results->num_rows == NULL) {
?>
<div class="data-null bounceIn animated">
<h2 class="fa fa-warning"></h2>
<p>No Result Found!</p>
</div>
      <style> table { display: none; } </style>
<?php
} else {
?>
<table border="1" class="table table-bordered">
  <tbody>
    <tr>
    <th width="41px">&nbsp;</th>
    <th> Product Name </th>
    <th> Quantity </th>
    <th> Price (Frw) </th>
    <th> price ($) </th>
    <th> place </th>
    <th> Comment </th>
  </tr>
<?php
$x = 0;
    while($row = $results->fetch_array()) {
$pro_id = $row["pro_id"];
$ipro_name = $row["pro_name"];
$quantity = $row["pro_quantity"];
$comment = $row["pro_comment"];
$price_d = $row["price_dol"];
$price_r = $row["price_frw"];
$place = $row["place"];
$view = $row["view"];
?>
        <tr>
          <td> <?php echo $pro_id; ?> </td>
          <td> <b><?php echo $ipro_name; ?></b> </td>
          <td> <?php echo $quantity; ?> </td>
          <td> <?php echo $price_r; ?> </td>
          <td> <?php echo $price_d; ?> </td>
          <td> <?php echo $place; ?> </td>
          <td> <?php echo $comment; ?> </td>
          </tr>
        <?php
        // $ert += $size_w;
        $x++; // incemmenting

    }

}

?>


</tbody></table>
<br><br><br><br>

</div>


<style media="screen">
  .report-controls {
     width: 100%;
    background: #f1f1f1;
    margin: auto;
    margin: 18px 0px;
    margin: auto;
     margin-bottom: 33px;
    box-shadow: 0px 3px 8px -2px #333;
    padding: 10px 2% 11px 2%;
    border-radius: 3px;
  }
  .report-controls .rowe {
    /*display: block;*/
  }
  .report-controls .rowe .colmn {
    width: 25%;
    /*border: 1px solid #888888;*/
    /*background: green;*/
    float: left;
  }



.form-group {
  padding: 5px 10px;
  margin: 0px;
}


.table-small-report {
  /*width: 50%;*/
  min-width: 400px;
  max-width: 50%;
}


.report-controls .rowe .big { width: 30%; }
.report-controls .rowe .small { width: 20%; }
body {
  background: #fff;
}
hr {
  margin: 3px;
  border-color: #000;
}

.form-control {
      display: block;
      width: 100%;
}
label {
  margin-bottom: 1px;
}

.table {
    width: 97%;
    margin: auto;
}
.head-tit-rep-div {
  background-color: #8c103a;
  padding: 10px;
  padding-left: 65px;
  background-image: url(app_data/imgs/icns/small-logo.png);
  background-size: 41px 34px;
  background-repeat: no-repeat;
  background-position: 18px 8px;
  font-size: 23px;
  /* font-weight: bold; */
  color: #fff;
  text-shadow: 0px 0px 2px #000;
}
/*}*/
.print-sett {
      text-align: right;
      border-top: 1px solid grey;
      padding-top: 6px;
      display: none;
}
</style>

<?php include 'app_data/php/foater.php' ?>
