<?php
  include_once '../connect.php';
  include_once '../core_data.php';
  include_once '../functions.php';
  include_once '../local_data.php';




        if (isset($_POST['add_env'])) {
        // @$product_categorie = $_POST['categorie'];
        // @$product_descr = $_POST['product_description'];
        // @$product_price = $_POST['price'];
        // @$product_name = $_POST['product_name'];
        //


        #================== IMAGE UPLOAD =========

            @$name = $_FILES['env_img']['name'];
            @$size = $_FILES['env_img']['size'];
            @$type = $_FILES['env_img']['type'];
            @$tmp_name = $_FILES['env_img']['tmp_name'];
            @$max_size =2097152;
            @$location = '../../files/';
            @$location_name = '../../files/';

            # first method to get the extenstion
            @$file_name = basename($name);
            @$imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);
            @$extension = strtolower($imageFileType);

        if (isset($name)) {
           if (!empty($name)) {

           // check if the file is jpg or gpeg
        	   if ($extension =='jpg' || $extension =='jpeg' || $extension =='png') {

        		   // check for the size
        		   if ($size<$max_size)  {
         # check if image is exist
        if (file_exists($file_name)) {
            echo '
            <div class="allert_div">  Sorry, Image already exists. chage the name  </div>
            ';
        } else {
          //check if the file has been uploaded
         if  (move_uploaded_file( $tmp_name, $location. $name)) {
        #==============================================================================


        #==============================================================================
          }
          else {
            echo '
            <div class="allert_div">  there was an error. try again later  </div>
            ';
          }
        }
        		   }
        		   else{
        		echo '
            <div class="allert_div">  your Image is too largre.  </div>
                 ';
        		   }
           }
           else {
        	   echo '
             <div class="allert_div">  the Image must be JPEG or JPG or PNG  </div>
            ';
         }

        }
           else {
           echo '
           <div class="allert_div">  Please Choose a File.  </div>
           ';
           }

        }


        }

  ?>
<!-- <img src="../../files/amazikkng-beautifu.jpg" alt="" /> -->

<img src="../../imgs/icns/loading29.gif" class="loading-img-view  animated" alt="" />
