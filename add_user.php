<?php
include 'app_data/php/head.php';
secured();
admin_page();
?>
<div class="contents-div">
  <div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">

      <section class="header-div-sec">
        <h2> <b class="fa fa-user-plus"></b> Add User </h2>
      </section>

    <div class="secton-contents-containner">

      <?php
      if (isset($_POST['add_user'])) {

                    @$username = $_POST['username'];

                    // changing password
                    @$pass = $_POST['password'];
                    @$password = md5($pass);

                    @$fname = $_POST['fname'];
                    @$lname = $_POST['lname'];
                    @$gender = $_POST['gender'];
                    @$adr = $_POST['adr'];
                    @$email = $_POST['email'];
                    @$phone = $_POST['phone'];
                    @$type = $_POST['type'];
                    @$perm = $_POST['perm'];

      #================== IMAGE UPLOAD =========

          @$name = $_FILES['env_img']['name'];
          @$size = $_FILES['env_img']['size'];
          @$type = $_FILES['env_img']['type'];
          @$tmp_name = $_FILES['env_img']['tmp_name'];
          @$max_size =2097152;
          @$location = 'app_data/imgs/profile/';
          @$location_name = 'app_data/imgs/profile/';

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
      if (file_exists("envit/$file_name")) {
          echo '
          <div class="allert_div">  Sorry, Image already exists. chage the name  </div>
          ';
      } else {
        //check if the file has been uploaded
       if  (move_uploaded_file( $tmp_name, $location. $name)) {
      #==============================================================================
            $query = "INSERT INTO
  `users`(
    `user_id`,
    `username`,
    `password`,
    `fname`,
    `lname`,
    `gender`,
    `adr`,
    `email`,
    `phone`,
    `profile`,
    `last_log`,
    `type`,
    `perm`
  )
VALUES(
  '',
  '$username',
  '$password',
  '$fname',
  '$lname',
  '$gender',
  '$adr',
  '$email',
  '$phone',
  '$file_name',
  '',
  '$type',
  '$perm'
)";
            if ($results = $mysqli->query($query)) {
                ?>
                <div class='allert_div-sucss bg-green zoomIn animated'>
                        <h2 class='fa fa-check-circle'></h2>
                        <p>a New user <b><?php echo $username; ?></b> has Been Registered <br> in the System</p>
                        <hr>
                        <a href="add_user.php?r"><button type="button" name="button" class="pull-left click"><b class="fa fa-plus-square"></b> Add New </button></a>
                        <a href="users.php"><button type="button" name="button" class="pull-right click"><b class="fa fa-reorder"></b> View List </button></a>
                        <div class="clear-both">x</div>
                      </div>
                   <style> .frm { display:none; } </style>

                <?php

            } else {
              echo "Nooo is nor eunning ";
            }

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

    <form class="frm" action="add_user.php" method="post" enctype="multipart/form-data">
     <div class="box-body">
<table border="0" width="100%">
  <tr>
    <td width="50%">
         <div class="form-group">
             <label for="">Username</label>
             <input type="text" name="username" class="form-control" id="" placeholder="Username" required="" <?php echo $form_text; ?>>
         </div>
    </td>
    <td  width="50%">
       <div class="form-group">
           <label for="">Password</label>
           <input type="text" name="password" class="form-control" id="" placeholder="Password" required="">

       </div>
    </td>
  </tr>
  <tr>
    <td>
       <div class="form-group">
           <label for="">First Name</label>
           <input type="text" name="fname" class="form-control" id="" placeholder="First Name" required="" <?php echo $form_text; ?>>
       </div>
    </td>
    <td>
       <div class="form-group">
           <label for="">Last Name</label>
           <input type="text" name="lname" class="form-control" id="" placeholder="Last Name" required="" <?php echo $form_text; ?>>
       </div>
    </td>
  </tr>
  </tr>
  <tr>
    <td>
       <div class="form-group">
           <label for="">Image</label>
           <input type="file" name="env_img" class="form-control" required="">
       </div>
    </td>
    <td>
       <div class="form-group">
           <label for="">Gender</label>
           <select class="form-control" name="gender" required="">
             <option value=""></option>
             <option value="M">Male</option>
             <option value="F">Female</option>
           </select>
       </div>
    </td>
  </tr>
  <tr>
    <td>
       <div class="form-group">
           <label for="">Address</label>
           <input type="text" name="adr" class="form-control" id="" placeholder="Address" required="">
       </div>
    </td>
    <td>
     <div class="form-group">
         <label for="">Email</label>
         <input type="email" name="email" class="form-control" id="" placeholder="Em@il" required="">
     </div>
    </td>
  </tr>
  <tr>
    <td  style="background: rgba(40, 46, 54, 0.03)">
       <div class="form-group">
           <label for="">User Type</label>
           <select class="form-control" name="type" required="">
              <option value="" class=""></option>
              <option value="1">Admin (all permition)</option>
              <option value="0">User (limited permition)</option>
           </select>
       </div>
    </td>
    <td>
       <div class="form-group">
           <label for="">Phone Number</label>
           <input type="text" name="phone" class="form-control" id="" placeholder="Phone Number" required="" <?php echo $form_number; ?>>
       </div>
    </td>
  </tr>
  <tr>
    <td  style="background: rgba(40, 46, 54, 0.03)">
       <div class="form-group">
           <label for="">Permition</label>
           <select class="form-control" name="perm" required="">
              <option value="" class=""></option>
              <option value="0">Block</option>
              <option value="1">Allow</option>
           </select>
       </div>
    </td>

    <td valign="bottom" style="text-align:right;">    &nbsp;
      <button type="submit" name="add_user" class="btn btn-primary submit-butt">Add User</button>
    </td>

  </tr>
</table>
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
