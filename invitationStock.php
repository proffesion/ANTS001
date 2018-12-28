<?php
include 'app_data/php/head.php';


$total_invitation_in_stock = number_ret("SELECT `e_id` FROM `env_stock`");
$invitation_in_stock_with_zero = number_ret("SELECT `e_id` FROM `env_stock` WHERE `quantity` != '0'");
$invitation_in_stock = $total_invitation_in_stock - $invitation_in_stock_with_zero;


if (isset($_GET['deleted'])) { ?>
    <div class="alert alert-success alert-dismissible alert-fixed bounceInDown animated" style="margin-bottom: 0;z-index: 1;width: 290px;opacity: 0.9;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <b class=" fa fa-check"></b> &nbsp; Invitation Deleted!
    </div>
<?php } ?>


<style media="screen">
.contents-div_riight-small-result {
   margin-right: 0px;
}
.report-controls {
    display: none;
}
</style>
<div class="contents-div">
  <div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">

      <section class="header-div-sec">
        <h2 style="float: left;margin-right: 26px;"> STOCK </h2>
        <a href="add_stock.php"> <button type="button" name="Sell_envitation" class="btn btn-success click" style="float: left;margin: 14px 2px;"> <b class="fa fa-plus-circle"></b> &nbsp; Add Invitation </button> </a>

        <b class="search-option glyphicon glyphicon-eye-open click" style="margin-top: 22px;"></b>
      </section>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<section class="hide-print">
<div class="report-controls fadeIn animated">
  <!-- <div class="report-controls"> -->
   <section class="rowe">
     <form class="" action="invitationStock.php" method="get">
     <section class="colmn big">
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
      </section>

     <section class="colmn">
       <div class="form-group">
           <label for="">Select Order</label>
           <section>
           <!-- <select name="day" class="form-control" style="width:20%;float:left"> <option value=""></option> <?php for ($i=1; $i <=9 ; $i++) { echo "<option value='0$i'>0$i</option>"; } for ($i=10; $i <30 ; $i++) { echo "<option value='$i'>$i</option>"; } ?> </select> -->
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
      </section>

      <section class="colmn">
        <div class="form-group">
            <label for="">Size</label>
            <section>
            <!-- <select name="day" class="form-control" style="width:20%;float:left"> <option value=""></option> <?php for ($i=1; $i <=9 ; $i++) { echo "<option value='0$i'>0$i</option>"; } for ($i=10; $i <30 ; $i++) { echo "<option value='$i'>$i</option>"; } ?> </select> -->
            <input type="text" name="sw" class="form-control" placeholder="Width" style="width:50%;float:left">
            <input type="text" name="sh" class="form-control" placeholder="Height" style="width:50%;float:left">

            <section class="clear-both">x</section>
            </section>
        </div>
       </section>

      <!-- <section class="colmn small"> -->
      <section class="colmn small" style="padding: 26px 0px 0px 12px;text-align: right;">
        <button type="submit" class="btn btn-primary" name="search"><b class="fa fa-search"></b>&nbsp; Check</button>
          <a href="stock_list.php" style="background: transparent;"> <button type="button" class="btn btn-primary" name="button"><b class="fa fa-navicon"></b> &nbsp; View All</button> </a>
          <!-- <button type="button" class="btn btn-primary print-sett-show" name=""> <b class="fa fa-ellipsis-v"></b> </button> -->
       </section>
     <section class="clear-both">x</section>
   </section>
  <!-- </div> -->
  </form>
</div>
<!-- </div> -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="secton-contents-containner">


      <?php
      $size_q = '';
      $env_q = '';
      $place_q = '';
      $sorder_q = '';


      if (isset($_GET['or_by']) && !empty($_GET['or_by']) && isset($_GET['or_typ']) && !empty($_GET['or_typ'])) { # code..
        $or_typ = $_GET['or_typ'];
        $or_by = $_GET['or_by'];
        $sorder_q = " ORDER BY `$or_by` $or_typ";
     } else {
         $sorder_q = " ORDER BY `e_id` DESC";
     }

      if (isset($_GET['search'])) {

        if (isset($_GET['sw']) && !empty($_GET['sw']) && isset($_GET['sh']) && !empty($_GET['sh'])) { # date working
          @$sw = $_GET['sw'];
          @$sh = $_GET['sh'];
          $size_q = "AND `size_w` LIKE '%$sw%' AND `size_h` LIKE '%$sh%'";
        }
        // ````

      // Sell Type


      // Envitation Id
      if (isset($_GET['envt_id']) && !empty($_GET['envt_id'])) { # code..
         $envitation_id = $_GET['envt_id'];
         $env_q = "AND `e_id`='$envitation_id'";
      }


      // Client Name
      if (isset($_GET['place']) && !empty($_GET['place'])) { # code..
         $place = $_GET['place'];
         $place_q = "AND `place` LIKE '%$place%'";
      }


      }
      // ----------------------------------------------
      // query condition controlls
      @$cond_query ="$env_q $place_q $size_q  $sorder_q";
      $mainQuerySearch = "SELECT * FROM `env_stock` WHERE `e_id`>'1' $cond_query";
      // echo $mainQuerySearch;
      ?>


<?php
// MySqli Select Query
$results = $mysqli->query("$mainQuerySearch");
// echo $results->num_rows; // number of result

?>

<div class="stock-info" style="background: #00713d;color: #fff;padding: 18px;">
      <?php if (!isset($_GET['search'])) { ?>

<div class="row">
  <div class="col-md-4">
      <h3>Stock: <b><?php echo $invitation_in_stock; ?></b></h3>
  </div>
  <div class="col-md-4">
      <h3>Null: <b><?php echo $invitation_in_stock_with_zero; ?></b></h3>
  </div>
  <div class="col-md-4">
      <h3>Total: <b><?php echo $total_invitation_in_stock; ?></b></h3>
  </div>
</div>


      <?php } else { ?>
             <p>Results <?php echo @$results->num_rows; ?></p>
      <?php } ?>
      </div>



<?php
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
  <tbody><tr>
    <th width="41px">&nbsp;</th><th> Env Id </th><th> Color </th><th> price Frw </th><th> price $ </th><th> size_W </th><th> size_H </th><th> Place </th><th> Left </th>
  </tr>
<?php
$x = 0;
    while($row = $results->fetch_array()) {
$e_id = $row["e_id"];
$img = $row["img"];
$quantity = $row["quantity"];
$comment = $row["comment"];
$size_w = $row["size_w"];
$size_h = $row["size_h"];
$price_d = $row["price_d"];
$price_r = $row["price_r"];
$place = $row["place"];
$env_color = $row["env_color"];
$view = $row["view"];
//



        $check_query_oe = "SELECT `e_id` FROM `env_stock` WHERE `view`='0' AND `e_id`='$e_id'";

        ?>
        <tr class="a <?php if ($x%2 == 0) { echo "a"; } else { echo "b"; } ?> <?php if (number_ret($check_query_oe) > 0) { echo "mhiden-row"; } ?>" onclick="stockDetails(<?php echo $e_id; ?>)">
          <td>
            <?php if (number_ret($check_query_oe) > 0)  {
              echo '<b class="fa fa-eye-slash" style="color: #f50909;font-weight: normal;margin: 0px 1px 0px 4px;transform: scale(1.4);"></b>'; } else {
              echo '<b class="fa fa-eye" style="color: #65a0f9;font-weight: normal;margin: 0px 1px 0px 4px;transform: scale(1.4);"></b>';
            } ?>

          </td>
          <td> <?php echo $e_id; ?> </td>
          <td> <?php echo $env_color; ?> </td>
          <td> <?php echo $price_r; ?> </td>
          <td> <?php echo $price_d; ?> </td>
          <td> <?php echo $size_w; ?> </td>
          <td> <?php echo $size_h; ?> </td>
          <td> <?php echo $place; ?> </td>
          <td <?php if ($quantity == '0' && $view == '1') {echo "class='fadeIn animated infinite bg-red'"; } ?> >
             <?php echo $quantity; ?> </td>
          </tr>
        <?php
        $ert += $size_w;
        $x++; // incemmenting

    }


?>

  <tr>
    <th>&nbsp;</th><th> Env Id </th><th> Color </th><th> price Frw </th><th> price $ </th><th> size_W </th><th> size_H </th><th> Place </th><th> Left </th>
  </tr>
</tbody></table>
<br>

<?php
}
 ?>









    </div><!-- .secton-contents-containner -->
<div class="riight-small-result">
<button type="button" name="button" onclick="closeShowInfo()" class="close-inf-div bounceIn animated" style="z-index:1;"><b class="glyphicon glyphicon-remove-circle"></b></button>

    <div id="itm_small_info" class="fadeIn animated"></div>

</div>


  </div><!-- .contents-iframe -->


<div class="">
  <div class="contents-iframe fadeIn animated search-conent-div" id="SearchResult">
      <section class="cancel-section-button">
        <button type="button" name="button" onclick="HideSearchDivContent()"> <b class="fa fa-arrow-left"></b> Back</button>
      </section>
      <div class="" id="iframeDispayDiv"></div>
  </div>
</div>

</div><!-- .contents-div -->


</div><!-- .containner -->
</div><!-- .main-containner -->
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
  padding: 5px 5px;
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
  /*background: #fff;*/
}
hr {
  /*margin: 3px;*/
  /*border-color: #000;*/
}

.form-control {
      display: block;
      width: 100%;
}
label {
  /*margin-bottom: 1px;*/
}

.table {
    /*width: 97%;*/
    /*margin: auto;*/
}
.head-tit-rep-div {
  background: #9E9E9E;
  background: #282e36;
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
