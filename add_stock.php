<?php
include 'app_data/php/head.php';
secured();
?>
<div class="contents-div">
  <div class="contents-iframe animated bod-main-hide" id="mainContentsDiv">

      <section class="header-div-sec">
        <h2> Add Invitation </h2>
      </section>

    <div class="secton-contents-containner">






            <?php
            if (isset($_POST['add_Invitation'])) {


                          @$e_id = $_POST['e_id'];
                          @$e_color = $_POST['e_color'];
                          @$quantity = $_POST['quantity'];
                          @$pr_frw = $_POST['pr_frw'];
                          @$pr_dol = $_POST['pr_dol'];
                          @$size_w = $_POST['size_w'];
                          @$size_h = $_POST['size_h'];
                          @$comnt = htmlspecialchars($_POST['comnt']);
                          @$e_place = $_POST['place'];
                          @$env_code = $_POST['env_code'];




            #================== IMAGE UPLOAD =========

                @$name = $_FILES['env_img']['name'];
                @$size = $_FILES['env_img']['size'];
                @$type = $_FILES['env_img']['type'];
                @$tmp_name = $_FILES['env_img']['tmp_name'];
                @$max_size =2097152;
                @$location = 'envit/';
                @$location_name = 'envit/';

                # first method to get the extenstion
                // $fNm =
                @$file_name = $e_id.'_'.basename($name);
                @$imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);
                @$extension = strtolower($imageFileType);

            if (CheckIdExist($e_id)) { ?>
              <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b class="icn-alrt fa fa-warning"></b>  The Invitation <b><?php echo @$e_id; ?></b> is already in The System </div>
            <?php }
              else {

            if (isset($name)) {
               if (!empty($name)) {

               // check if the file is jpg or gpeg
            	   if ($extension =='jpg' || $extension =='jpeg' || $extension =='png') {

            		   // check for the size
            		   if ($size<$max_size)  {
             # check if image is exist
            if (file_exists("envit/$file_name")) { ?>
              <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b class="icn-alrt fa fa-warning"></b>  The Image already exists in The System. chage the name of your New Image and Try again! </div>
            <?php
            } else {
              //check if the file has been uploaded
              $new_name = $e_id.'_'.$name;
             if  (move_uploaded_file( $tmp_name, $location. $new_name)) {
            #==============================================================================

                  $query = "INSERT INTO `env_stock` (`e_id`,`img`,`quantity`,`comment`,`size_w`,`size_h`,`price_d`,`price_r`,`place`,`env_color`,`view`,`env_code`) VALUES ('$e_id','$file_name','$quantity','$comnt','$size_w','$size_h','$pr_dol','$pr_frw','$e_place','$e_color','1','$env_code')";
                  if ($results = $mysqli->query($query)) {
                      ?>
                      <div class='allert_div-sucss bg-green zoomIn animated'>
                              <h2 class='fa fa-check-circle'></h2>
                              <p>The Invitation <b><?php echo $e_id; ?></b> has Been Inserted <br> in the System</p>
                              <hr>
                              <a href="add_stock.php?r"><button type="button" name="button" class="pull-left click"><b class="fa fa-plus-square"></b> Add New </button></a>
                              <a href="stock_list.php"><button type="button" name="button" class="pull-right click"><b class="fa fa-reorder"></b> View List </button></a>
                              <div class="clear-both">x</div>
                            </div>
                         <style> .frm { display:none; } </style>

                      <?php

                  } else {
                    echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b class="icn-alrt fa fa-warning"></b>  Ooops There was An Error Please Try again! </div>';
                  }

            #==============================================================================
              }
              else {
                echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b class="icn-alrt fa fa-warning"></b>  there was an error. try again later  </div>
                ';
              }
            }
            		   }
            		   else{
            		echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b class="icn-alrt fa fa-warning"></b>  your Image is too largre.  </div> ';
            		   }
               }
               else {
            	   echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b class="icn-alrt fa fa-warning"></b> the Image must be JPEG or JPG or PNG  </div>';
             }

            }
               else {
               echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b class="icn-alrt fa fa-warning"></b>  Please Choose an Image.  </div>';
               }

            }
          }


            }

      ?>




    <form class="frm" action="add_stock.php" method="post" enctype="multipart/form-data">
     <div class="box-body">


       <div class="row">
         <div class="col-md-4">

           <div class="form-group">
               <label for="">Invitation Id</label>
               <input type="number" name="e_id" class="form-control" id="" placeholder="Invitation Id" required="" <?php echo $form_number; ?>>
           </div>

         </div>
         <div class="col-md-4">

           <div class="form-group">
               <label for="">Invitation Code</label>
               <input type="text" name="env_code" class="form-control" id="" placeholder="Invitation Code" <?php echo $form_both; ?>>
           </div>

         </div>
         <div class="col-md-4">

             <div class="form-group">
                 <label for="">Invitation Image</label>
                 <input type="file" name="env_img" class="form-control" required="">
             </div>

         </div>
       </div>



       <div class="row">
         <div class="col-md-4">

           <div class="form-group">
               <label for="">Quantity</label>
               <input type="number" name="quantity" class="form-control" id="" value="2000" placeholder="Quantity" required="">
           </div>

         </div>
         <div class="col-md-4">

           <div class="form-group">
               <label for="">Invitation Color</label>
               <input type="text" name="e_color" class="form-control" id="" placeholder="Invitation Color" required="" <?php echo $form_both; ?>>
           </div>

         </div>
         <div class="col-md-4">

           <div class="form-group">
               <label for="">place</label>
               <input type="text" name="place" class="form-control" id="" placeholder="place" required="">
           </div>

         </div>
       </div>


        <br><br>



        <div class="row">
          <div class="col-md-8">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="">Price Frw</label>
                    <input type="text" name="pr_frw" class="form-control" value="" id="" placeholder="Price Frw" required="" <?php echo $form_number; ?>>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="">Price $</label>
                    <input type="text" name="pr_dol" class="form-control" value="" id="" placeholder="Price $" required="" <?php echo $form_number; ?>>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-4">

            <div class="form-group">
                <label for="">Invitation Size</label>
             <div class="" style="width:100%;">
                <input type="text" name="size_w" value="1" style="width: 50%; float: left; border-radius: 0px;" class="form-control" id="" placeholder="Width" required="">
                <input type="text" name="size_h" value="1" style="width:50%; border-radius:0px;" class="form-control" id="" placeholder="Height" required="">
                <div style="clear:both;font-size:0px; "> a </div>
             </div>
            </div>

          </div>
        </div>


     <div class="form-group" style="padding-top: 0 1%;">
         <label for="">Comment</label>
         <input type="text" class="form-control" style="height:100px;" name="comnt" value="ok" title="please dont use any symbol" required="" <?php echo $form_text; ?>>
     </div>


</div>
<div class="box-footer" style="padding: 0 1%;text-align: right;">
   <button type="submit" name="add_Invitation" class="btn btn-primary">Add Invitation</button>
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
