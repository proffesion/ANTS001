<?php
include 'app_data/php/head.php';
secured();
?>
<div class="contents-div">
  <div class="contents-iframe animated bod-main-hide" id="mainContentsDiv">

      <section class="header-div-sec">
        <h2> Add Products </h2>
      </section>

    <div class="secton-contents-containner">






            <?php
            if (isset($_POST['add_product'])) {

                          @$p_name = $_POST['p_name'];
                          @$quantity = $_POST['quantity'];
                          @$pr_frw = $_POST['pr_frw'];
                          @$pr_dol = $_POST['pr_dol'];
                          @$comnt = htmlspecialchars($_POST['comnt']);
                          @$e_place = $_POST['place'];
                          @$view_p = $_POST['view'];


            if (CheckproductExist($p_name)) { ?>
              <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b class="icn-alrt fa fa-warning"></b>  <b><?php echo @$p_name; ?></b> is already in The System </div>
            <?php } else {

                  $query = "INSERT INTO `products`( `pro_name`, `pro_quantity`, `price_frw`, `price_dol`, `place`, `pro_comment`,`view`) VALUES('$p_name', '$quantity', '$pr_frw', '$pr_dol', '$e_place', '$comnt','$view_p' )";
                  if ($results = $mysqli->query($query)) {
                      ?>
                      <div class='allert_div-sucss bg-green zoomIn animated'>
                              <h2 class='fa fa-check-circle'></h2>
                              <p>The <b><?php echo $p_name; ?></b> has Been Inserted <br> in the System</p>
                              <hr>
                              <a href="add_product.php?r"><button type="button" name="button" class="pull-left click"><b class="fa fa-plus-square"></b> Add New </button></a>
                              <a href="products.php"><button type="button" name="button" class="pull-right click"><b class="fa fa-reorder"></b> View List </button></a>
                              <div class="clear-both">x</div>
                            </div>
                         <style> .frm { display:none; } </style>

                      <?php
                  } else {
                    echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b class="icn-alrt fa fa-warning"></b>  Ooops There was An Error Please Try again! </div>';
                  }

            #==============================================================================
              }
            }

      ?>




    <form class="frm" action="add_product.php" method="post" enctype="multipart/form-data">
     <div class="box-body">
<table border="0" width="100%">
  <tr>
    <td  width="50%">
      <div class="form-group">
          <label for="">Product Name</label>
          <input type="text" name="p_name" class="form-control" id="" placeholder="Product Name" required="">
      </div>
    </td>
    <td>
      <div class="form-group">
          <label for="">Quantity</label>
          <input type="number" name="quantity" class="form-control" id="" placeholder="Quantity" required="">
      </div>

    </td>
  </tr>
  <tr>
    <td>
       <div class="form-group">
           <label for="">Price Frw</label>
           <input type="text" name="pr_frw" class="form-control" id="" placeholder="Price Frw" required="" <?php echo $form_number; ?>>
       </div>
    </td>
    <td>
     <div class="form-group">
         <label for="">Price $</label>
         <input type="text" name="pr_dol" class="form-control" id="" placeholder="Price $" required="" <?php echo $form_number; ?>>
     </div>
    </td>
  </tr>
  <tr>
    <td>
      <div class="form-group">
          <label for="">place</label>
          <input type="text" name="place" class="form-control" id="" placeholder="place" required="" <?php echo $form_both; ?>>
      </div>
    </td>
    <td>
      <select class="form-control" name="view">
          <option value=""></option>
          <option value="1">Show</option>
          <option value="0">hide</option>
      </select>
    </td>
  </tr>
</table>














     <div class="form-group" style="padding: 0 1%;">
         <label for="">Comment</label>
         <input type="text" class="form-control" style="height:100px;" name="comnt" value="" title="please dont use any symbol" required="" <?php echo $form_text; ?>>
     </div>


</div>
<div class="box-footer" style="padding: 0 1%;text-align: right;">
   <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
</div>

</form>








    </div><!-- .secton-contents-containner -->

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
.frm {
   width: 98%;
  background: #fff;
  padding: 13px;
  margin: 12px;
}
.frm table {
  border: none;
  box-shadow: none;
}
.frm table td {
  /*padding: 6px;*/
  padding: 2px 1%;
}
</style>
<?php include 'app_data/php/foater.php' ?>
