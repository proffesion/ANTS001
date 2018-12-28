<?php
include 'app_data/php/head.php';
secured();
admin_page();

$id = $_GET['id'];
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

                  $query = "UPDATE `products` SET
                            `pro_name` = '$p_name',
                            `pro_quantity` = '$quantity',
                            `price_frw` = '$pr_frw',
                            `price_dol` = '$pr_dol',
                            `place` = '$e_place',
                            `pro_comment` = '$comnt',
                            `view` = '$view_p'
                          WHERE
                            `pro_id`='$id'";

                  if ($results = $mysqli->query($query)) {
              ?>
              ?>
              <div class="alert alert-success alert-dismissible" style="margin-bottom: 0;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <b class=" fa fa-check"></b> &nbsp; The Product Has Been upadted!
              </div>
                      <?php
                  } else {
                    echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b class="icn-alrt fa fa-warning"></b>  Ooops There was An Error Please Try again! </div>';
                  }

            #==============================================================================
              }
            }

      ?>




    <form class="frm" action="updateProduct.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
     <div class="box-body">
<table border="0" width="100%">
  <tr>
    <td  width="50%">
      <div class="form-group">
          <label for="">Product Name</label>
          <input type="text" name="p_name" class="form-control" id="" value="<?php echo retrieve_data('pro_name','products','pro_id',$id); ?>" placeholder="Product Name" required="">
      </div>
    </td>
    <td>
      <div class="form-group">
          <label for="">Quantity</label>
          <input type="number" name="quantity" class="form-control" id="" value="<?php echo retrieve_data('pro_quantity','products','pro_id',$id); ?>" placeholder="Quantity" required="">
      </div>

    </td>
  </tr>
  <tr>
    <td>
       <div class="form-group">
           <label for="">Price Frw</label>
           <input type="text" name="pr_frw" class="form-control" id="" value="<?php echo retrieve_data('price_frw','products','pro_id',$id); ?>" placeholder="Price Frw" required="" <?php echo $form_number; ?>>
       </div>
    </td>
    <td>
     <div class="form-group">
         <label for="">Price $</label>
         <input type="text" name="pr_dol" class="form-control" id="" placeholder="Price $" value="<?php echo retrieve_data('price_dol','products','pro_id',$id); ?>" required="" <?php echo $form_number; ?>>
     </div>
    </td>
  </tr>
  <tr>
    <td>
      <div class="form-group">
          <label for="">place</label>
          <input type="text" name="place" class="form-control" id="" placeholder="place" value="<?php echo retrieve_data('place','products','pro_id',$id); ?>" required="" <?php echo $form_text; ?>>
      </div>
    </td>
    <td>

      <select class="form-control" name="view">
        <?php
        $kkk = retrieve_data('view','products','pro_id',$id);
         if ($kkk == '1') {
           echo '<option value="1">Show</option>';
         } else {
           echo '<option value="0">hide</option>';
         }
         ?>
          <option value=""></option>
          <option value="1">Show</option>
          <option value="0">hide</option>
      </select>
    </td>
  </tr>
</table>














     <div class="form-group" style="padding: 0 1%;">
         <label for="">Comment</label>
         <input type="text" class="form-control" style="height:100px;" name="comnt" value="<?php echo retrieve_data('pro_comment','products','pro_id',$id); ?>"  title="please dont use any symbol" required="" <?php echo $form_text; ?>>
     </div>


</div>
<div class="box-footer" style="padding: 0 1%;text-align: right;">
   <button type="submit" name="add_product" class="btn btn-primary submit-butt">Add Product</button>
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
