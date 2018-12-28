<?php
include 'app_data/php/head.php';
secured();
@$id = $_GET['id'];

if (!userExists($id)) {
  die('<div class="notExist"> The user with the id: <b>'.$id.'</b> <br> Does\'nt exist in the system.   </div>');
}
?>
<!-- contents start here -->


<div class="contents-div">
<div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">
<!-- contents goes here -->

    <section class="header-div-sec">
    <h2> SIGNATURE </h2>
    </section>

    <div class="secton-contents-containner">







            <?php
            if (isset($_POST['add_signature'])) {
              @$active        = $_POST['active'];
              @$sign_code     = $_POST['sign_code'];
              
            #================== IMAGE UPLOAD =========

              @$name          = $_FILES['sign_img']['name'];
              @$size          = $_FILES['sign_img']['size'];
              @$type          = $_FILES['sign_img']['type'];
              @$tmp_name      = $_FILES['sign_img']['tmp_name'];
              @$max_size      = 2097152;
              @$location      = 'app_data/imgs/sgnc/';
              @$location_name = 'app_data/imgs/sgnc/';

                # first method to get the extenstion
                // $fNm =
              @$file_name      = $time . '-' . $id;
              @$imageFileType  = pathinfo(basename($name), PATHINFO_EXTENSION);
              @$extension      = strtolower($imageFileType);


            if (!isset($name)) {
                echo '<div class="alert alert-info" role="alert">  Please Choose an Image.  </div>';
            } else {
              if (!empty($name)) {

               // check if the file is jpg or gpeg
                if ($extension != 'png') {
                  echo '<div class="alert alert-info" role="alert"> The signature file must be a PNG and transparent </div>';
                } else {
            		   // check for the size
                  if ($size > $max_size) {
                      echo '<div class="alert alert-info" role="alert">  your Image is too largre.  </div>';
                  } else {
                      $file_name = "$file_name.$extension";
                        //check if the file has been uploaded
                        if (move_uploaded_file($tmp_name, $location . $file_name)) {
                        #==============================================================================
                          $query = "INSERT INTO `signature`(
                              `signature`,
                              `user_id`,
                              `allowed`,
                              `sign_code`
                          )
                          VALUES(
                              '$file_name',
                              '$id',
                              '$active',
                              '$sign_code'
                          )";

                        if ($results = $mysqli->query($query)) {
                          echo '<div class="alert alert-success" role="alert"> The Signature has been inserted! </div>';
                        } else {
                          echo '<div class="alert alert-info" role="alert"> try again later </div>';
                        }
                        #==============================================================================
                        } else {
                          echo '<div class="alert alert-info" role="alert"> try again later </div>';
                        }
                } // file size
              } // extention
            } // name

          } // chose image

        } // form
  

    ?>





    <form action="" method="post" enctype="multipart/form-data">
      <div class="row signator-containner">
        
        <?php  if (number_ret("SELECT `id` FROM `signature` WHERE `user_id`='$id'") == 0) { ?>

        <div class="col-md-6">
        <section>
          <h3><?php echo user_data_id('fname', 'users', $id) .' '. user_data_id('lname', 'users', $id); ?></h3>
          <P><?php echo userType(user_data_id('type', 'users', $id)); ?></P>
          <br>
        </section>
        
        <section>
            <h2>Conditions</h2>
            <p>Thesignatore image mus have a ddddd</p>
        </section>
        
        </div>
        <div class="col-md-6">
        

  <fieldset>
    <div class="form-group">
      <label for="">Disabled input</label>
      <input type="file" name="sign_img" class="form-control" id=""  placeholder="eeee " required>
    </div>

    <div class="form-group">
      <label for="">Disabled input</label>
      <input type="text" name="sign_code" class="form-control" id=""  placeholder="Secret Signature " required>
    </div>    

    <div class="form-group">
      <label for="">Disabled select menu</label>
      <select name="active" class="form-control" required>
        <option value=""> select ..</option>
        <option value="1">Active</option>
        <option value="0">Deactivate</option>
      </select>
    </div>

    <button type="submit" name="add_signature" class="btn btn-primary">Add Signature</button>
  </fieldset>


        </div>
</form>
<?php } else { ?>


  <div class="col-md-4">
    <section>
      <label for="">Names</label>
      <h4> <?php echo user_data_id('fname', 'users', $id) . ' ' . user_data_id('lname', 'users', $id); ?> </h4>
    </section>
    <br>
    <section>
      <label for="">Function</label>
      <h4> <?php echo userType(user_data_id('type', 'users', $id)); ?> </h4>
    </section>
    <br>
    <section>
      <label for="">State</label>
      <h4> <?php echo userPerm(user_data_id('perm', 'users', $id)); ?> </h4>
    </section>

  </div>
  <div class="col-md-5">
    <section>
      <label for=""> Signature </label>
      <img src="<?php echo display_signature($id); ?>" alt="Signature" class="img-thumbnail img-responsive">
    </section>
  </div>
  <div class="col-md-3">
  <?php
  $state = retrieve_data('allowed', 'signature', 'id', $id);
  if ($state) { ?>
  
  <section class="state-active"> Activated </section>
  <a href="app_data/php/signSwitchState.php?id=<?php echo $id; ?>&state=deactive"><button type="button" class="btn btn-danger btn-lg">Deactivate</button></a>

  <?php } else { ?>
  
  <section class="state-deactive"> Deactivated </section>

  <a href="app_data/php/signSwitchState.php?id=<?php echo $id; ?>&state=active"><button type="button" class="btn btn-success btn-lg">Activate</button></a>
  
  
  <?php }
  
  ?>

  </div>


<?php } ?>
        </div>



























    </div><!-- .secton-contents-containner -->

</div><!-- .contents-div -->

<div class="">
  <div class="contents-iframe fadeIn animated search-conent-div" id="SearchResult">
      <section class="cancel-section-button">
        <button type="button" name="button" onclick="HideSearchDivContent()"> <b class="fa fa-arrow-left"></b> Back</button>
      </section>
      <div class="" id="iframeDispayDiv"></div>
  </div>
</div>


<style>
.user-inf-hom {
      opacity: 0.2 !important;
}

.signator-containner {
    width: 80%;
    padding: 61px 46px;
    background: #fff;
    margin-top: 29px;
    margin: auto !important;
}

.alert {
    width: 80%;
    margin: 16px auto;  
}

.state-active {
    font-size: 20px;
    border: 2px solid #4CAF50;
    text-align: center;
    color: #4CAF50;
    padding: 5px 0px;
    /* border-radius: 5px; */
    margin: 18px 0px;  
}

.state-deactive {
    font-size: 20px;
    border: 2px solid red;
    text-align: center;
    color: red;
    padding: 5px 0px;
    /* border-radius: 5px; */
    margin: 18px 0px;  
}
</style>

</div><!-- .containner -->
</div><!-- .main-containner -->
<?php include 'app_data/php/foater.php' ?>
