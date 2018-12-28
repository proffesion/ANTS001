<?php
include 'app_data/php/head.php';
secured();

if (!isset($_GET['id']) || empty($_GET['id'])) {
   echo "<script> window.open('stock_list.php','_self'); </script>";
}
$env_id = $_GET['id'];
$in_id = retrieve_data('e_id','env_stock','e_id',$env_id);


?>
<div class="contents-div">
  <div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">
      <section class="header-div-sec">
        <h2> EDIT INVITATION <b><?php echo fileData('e_id',$env_id); ?></b></h2>
      </section>
<?php if ($in_id == NULL) { ?>


  <div class="error-div-n">
      <h2><?php echo $env_id; ?></h2>
      <p>
        this Invitation has been deleted!
      </p>
  </div>


<?php } else { ?>
    <div class="secton-contents-containner">
            <?php
            if (isset($_POST['add_envitation'])) {
              @$e_color = $_POST['e_color'];
              @$pr_frw = $_POST['pr_frw'];
              @$pr_dol = $_POST['pr_dol'];
              @$size_w = $_POST['size_w'];
              @$size_h = $_POST['size_h'];
              @$comnt = $_POST['comnt'];
              @$e_place = $_POST['place'];
              @$env_code = $_POST['env_code'];

                  $query = "UPDATE `env_stock` SET
                        `comment` = '$comnt',
                        `size_w` = '$size_w',
                        `size_h` = '$size_h',
                        `price_d` = '$pr_dol',
                        `price_r` = '$pr_frw',
                        `place` = '$e_place',
                        `env_code` = '$env_code',
                        `env_color` = '$e_color'
                      WHERE
                        `e_id`='$env_id'";
                  if ($results = $mysqli->query($query)) {
                      ?>
                      <div class="alert alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Well done!!</strong> Invitation <b><?php echo $env_id; ?></b> has been updated!.
                      </div>
                      <?php

                  } else {
                    ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Warning!</strong> Failed to Update. please try again later.
                    </div>
                    <?php
                  }
        }


        
        if (isset($_POST['editChange'])) {
          @$curentStock = $_POST['curentStock'];
          @$newStock = $_POST['newStock'];
          @$stockType = $_POST['stockType'];
          @$newQuantity = $_POST['newQuantity'];
          @$comment = $_POST['comment'];

          $sql = "INSERT INTO `stock_track`(
            `stock_type`,
            `pro_id`,
            `process_type`,
            `value`,
            `previous_stock`,
            `new_stock`,
            `comment`,
            `done_by`
        )
        VALUES(
            'Invitation',
            '$env_id',
            '$stockType',
            '$newQuantity',
            '$curentStock',
            '$newStock',
            '$comment',
            '$user_id')";

        // UPDATE STOCK
        $stockQuary = "UPDATE `env_stock` SET `quantity`='$newStock' WHERE `e_id`='$env_id'";

          if ($results = $mysqli->query($sql)) {  // RECORD INTO TRACK TABLE
           
            if ($resulto = $mysqli->query($stockQuary)) { // UPDATE STOCK
              ?>

                <div class="alert alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Well done!!</strong> Invitation STOCK - <b><?php echo $env_id; ?></b> has been updated!.
                </div>   

              <?php
            } else {
              ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Warning!</strong> Failed to Update STOCK. please try again later.
                </div>                
              <?php
            }
            
      } else { ?>
          
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Warning!</strong> Failed to Update STOCK. please try again later!!!!!.
            </div>          

        <?php  }


        }
      ?>





      












<div class="row reset-size">
  <div class="col-xs-5">
  <div style="padding: 13px;">

<form action="update_stock.php?id=<?php echo $env_id; ?>" method="post" enctype="multipart/form-data">

          <section style="background: #afafaf;padding: 6px;border-radius: 7px;">
            <img src="envit/<?php echo fileData('img',$env_id); ?>" alt="<?php echo fileData('e_id',$env_id); ?> Image" class="image-stock-pop" style="max-height: 159px;">
          </section>

      <br>
          <div class="form-group">
              <label for="">Invitation Code</label>
              <input type="text" name="env_code" class="form-control" onchange="return InvitionData();" value="<?php echo fileData('env_code',$env_id); ?>" id="" placeholder="Invitation Code" required="" <?php echo $form_both; ?>>
          </div>


      <div class="row reset-size">
        <div class="col-md-6 reset-size">
        
          <div class="form-group">
              <label for="">Envitation Color</label>
              <input type="text" name="e_color" class="form-control" id="" onchange="return InvitionData();" value="<?php echo fileData('env_color',$env_id); ?>" placeholder="Envitation Color" required="">
          </div>

        </div><!-- .col-md-6 -->
        <div class="col-md-6 reset-size">
        
          <div class="form-group">
              <label for="">place</label>
              <input type="text" name="place" class="form-control" onchange="return InvitionData();" value="<?php echo fileData('place',$env_id); ?>" id="" placeholder="place" required="">
          </div>

        </div><!-- .col-md-6 -->
      </div>

      <div class="row reset-size">
        <div class="col-md-6 reset-size">
        
          <div class="form-group">
              <label for="">Price Frw</label>
              <input type="text" name="pr_frw" class="form-control" id="" onchange="return InvitionData();" value="<?php echo fileData('price_r',$env_id); ?>" placeholder="Price Frw"  required="">
          </div>

        </div><!-- .col-md-6 -->
        <div class="col-md-6 reset-size">
        
          <div class="form-group">
              <label for="">Price $</label>
              <input type="text" name="pr_dol" class="form-control" id="" onchange="return InvitionData();" value="<?php echo fileData('price_d',$env_id); ?>" placeholder="Price $" required="">
          </div>

        </div><!-- .col-md-6 -->
      </div>




          <div class="form-group">
              <label for="">Envitation Size</label>
            <div class="" style="width:100%;">
              <input type="text" name="size_w" onchange="return InvitionData();" value="<?php echo fileData('size_w',$env_id); ?>" style="width: 50%; float: left; border-radius: 0px;" class="form-control" id="" placeholder="Width" required="">
              <input type="text" name="size_h" onchange="return InvitionData();" value="<?php echo fileData('size_h',$env_id); ?>" style="width:50%; border-radius:0px;" class="form-control" id="" placeholder="Height" required="">
              <div style="clear:both;font-size:0px; "> a </div>
            </div>

          </div>


        <div class="form-group">
              <label for="">Comment</label>
              <textarea name="comnt" class="form-control" onchange="return InvitionData();" rows="2" cols="40" required=""><?php echo fileData('comment',$env_id); ?></textarea>
        </div>


        <div class="form-group">
        <button type="submit" name="add_envitation" id="saveInvitationDataButton" class="btn btn-lg btn-success submit-butt bounceIn animated">Update Information</button>
        </div>

      </form>
      </div>
  </div><!-- col-xs-5 -->
  <div class="col-xs-4" id="stockContainner">
  
    <div style="padding: 13px;">
      <h2>Stock</h2>
    
    <form action="update_stock.php?id=<?php echo $env_id; ?>" method="post">

      <section class="display">
          <label for="">Curent Stock</label>
          <input type="number" name="curentStock" value="<?php echo fileData('quantity',$env_id); ?>" id="curentStock" class="stock-label-small" required="" readonly>
      </section>

      <section class="display">
          <label for="newStock">New Stock</label>
          <input type="number" name="newStock" id="newStock" required="" readonly>
      </section>



      <br>

      <div class="row reset-size">
        <div class="col-md-4 reset-size">
        
          <div class="form-group">
              <label for="stockType">Change Type</label>
          <select name="stockType" class="form-control"  id="stockType" onchange="return StockCalculate();" required="">
            <option value="Add">Add</option>
            <option value="Remove">Remove</option>
            <option value="Modify">Modify</option>
          </select>
          </div>

        </div><!-- .col-md-6 -->
        <div class="col-md-8 reset-size">
        
          <div class="form-group">
              <label for="newQuantity">Quantity</label>
              <input type="number" name="newQuantity" class="form-control" id="newQuantity" onkeyup="return StockCalculate();" required="">
            </div>

        </div><!-- .col-md-6 -->
      </div>

        <div class="form-group">
              <label for="">Comment</label>
              <textarea name="comment" class="form-control" rows="2" cols="40" required=""></textarea>
        </div>


        <div class="form-group">
        <button type="submit" name="editChange" id="" class="btn btn-lg btn-success submit-butt bounceIn animated">Save Change</button>
        </div>


    </div>


      </form>

  </div><!-- col-xs-4 -->
  <div class="col-xs-3">
  <h3 style="margin: 13px 0px;">Stock History</h3>
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">


  <?php
  $resulte = $mysqli->query("SELECT * FROM `stock_track` WHERE `pro_id`='$env_id' AND `stock_type`='Invitation' ORDER BY `id` DESC");
  if ($resulte->num_rows == NULL) {
  ?>

    <div class="jumbotron" style="text-align: center;border-radius: 14px;color: #848484;">
      <p>Nothing found!</p>
    </div>

  <?php
  } else {
  while($row = $resulte->fetch_array()) {
    @$b_id = $row["balance_id"];

    @$id             = $row["id"];
    @$stock_type     = $row["stock_type"];
    @$pro_id         = $row["pro_id"];

    @$date           = $row["date"];
    @$process_type   = $row["process_type"];
    @$value          = $row["value"];
    @$previous_stock = $row["previous_stock"];
    @$new_stock      = $row["new_stock"];
    @$comment        = $row["comment"];
    @$done_by        = $row["done_by"];

  ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseTwo">
          <?php echo $date; ?>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body stockPannelBody">

          <section>
              <label> Done by </label>
                  <b> <?php echo $done_by; ?> </b>
          </section>

          <section>
              <label> Process Type </label>
                  <b> <?php echo $process_type; ?> </b>
          </section>

          <section>
              <label> Entered Value </label>
                  <b> <?php echo $value; ?> </b>
          </section>

          <section>
              <label> Previous Stock </label>
                  <b> <?php echo $previous_stock; ?> </b>
          </section>

          <section>
              <label> New Stock </label>
                  <b> <?php echo $new_stock; ?> </b>
          </section>     

          <section style="border: none; clear: both;">
              <label> Comment </label> <br>
                  <b> <?php echo $comment; ?> </b>
          </section>  
      </div>
    </div>
  </div>
<?php
      }

  }

   ?>


 


</div>



  </div><!-- col-xs-3 -->
</div>

















<?php

} // end of deleted invitation

 ?>

<style media="screen">
#saveInvitationDataButton {
  display: none;
}

</style>



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


<script>
    
function InvitionData() {
  // display the submit button
  document.getElementById('saveInvitationDataButton').style.display = 'block';

  // prevent double submission
  // 1. hide the submit fot the update stock
  document.getElementById('stockContainner').style.opacity = 0.2;

  // 2. reducr the opacity for the stock area
  // document.getElementById('saveInvitationDataButton').style.opacity = 0.2;

}


function StockCalculate() {
    // variables
    let curentStock  = document.getElementById('curentStock');
    let newStock     = document.getElementById('newStock');
    let stockType    = document.getElementById('stockType');
    let newQuantity  = document.getElementById('newQuantity');
    
    // check the type
    if (stockType.value == 'Modify') {

        newStock.value = newQuantity.value;

    } else if(stockType.value == 'Remove') {

        newStock.value = (Number(curentStock.value) - Number(newQuantity.value));

    } else if(stockType.value == 'Add') {

        newStock.value = (Number(curentStock.value) + Number(newQuantity.value));
      
    }

    
}
StockCalculate();

// $('.collapse').collapse()
</script>
<?php include 'app_data/php/foater.php' ?>
