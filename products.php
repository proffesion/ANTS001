<?php
include 'app_data/php/head.php';
secured();

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
        <a href="add_product.php"> <button type="button" name="Sell_envitation" class="btn btn-success click" style="float: left;margin: 14px 2px;"> <b class="fa fa-plus-circle"></b> &nbsp; Add Product </button> </a>

        <!-- <b class="search-option glyphicon glyphicon-eye-open click" style="margin-top: 22px;"></b> -->
      </section>

<div class="products_container-div">
   <div class="prod_item_one">
       <iframe src="app_data/php/iframeProductInfo.php" name="product_iframe" width="" height="" style="height: auto;background: transparent; min-height: 82vh;border-right: 2px solid #ddd;    margin: 0;"></iframe>
   </div>

   <div class="prod_item_two">
<?php 
      // MySqli Select Query
      $results = $mysqli->query("SELECT * FROM `products` ORDER BY `pro_id` DESC");
?>
      <h3>Products List (<?php echo $results->num_rows; ?>)</h3>

    <div class="products_containner" style="overflow-y: auto;max-height: 85vh;">
      <?php

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
          <th> Price (Frw) </th>
          <th> price ($) </th>
          <th>
          </th>
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
      //

?>
              <tr>
                <td> <?php echo $pro_id; ?> </td>
                <td> <a href="app_data/php/iframeProductInfo.php?id=<?php echo $pro_id; ?>" target="product_iframe"> <section class="product_a_move"><?php echo $ipro_name; ?></section></a> </td>
                <td> <?php echo $price_r; ?> </td>
                <td> <?php echo $price_d; ?> </td>
                <td>  </td>
                </tr>
              <?php
              // $ert += $size_w;
              $x++; // incemmenting

          }

      }

      ?>


      </tbody></table>
      <br>
    </div>

   </div>
   <select class="clear-both" name="">x</select>
</div>

<style media="screen">

.products_container-div {
  width: 100%;
  overflow: hidden;
  /*background: red;*/
}

.products_container-div .prod_item_one {
  width: 40%;
  /*background: aqua;*/
  float: left;
}
.products_container-div .prod_item_two {
  width: 60%;
  float: left;
  /*background: bisque;*/
}
</style>








    </div><!-- .secton-contents-containner -->
<div class="riight-small-result">
<button type="button" name="button" onclick="closeShowInfo()" class="close-inf-div bounceIn animated" style="z-index:1;"><b class="glyphicon glyphicon-remove-circle"></b></button>

    <div id="itm_small_info" class="fadeIn animated"></div>

</div>




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
<!-- </body>
</html> -->

<?php include 'app_data/php/foater.php' ?>
