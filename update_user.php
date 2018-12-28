<?php
include 'app_data/php/head.php';
secured();
admin_page();
@$selected_id = $_GET['id'];
if (!isset($selected_id) && empty($selected_id)) {
  echo "<script>window.open('users.php','_self')</script>";
}
?>


  <div id="changeProfile" class="modal fade" role="dialog">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header"> <b class="modal-title">Chane Profile Picture</b>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">

<form class="frm" action="update_user.php?id=<?php echo @$selected_id; ?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label for="">Image</label>
      <input type="file" name="env_img" class="form-control">
  </div>


         </div>
         <div class="modal-footer">
         <button type="submit" name="change_profile" class="btn btn-primary submit-butt">Apply</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</form>
         </div>
       </div>
    </div>
  </div>




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
                   @$db_password = user_data_id('password','users',$selected_id);
                  if (empty($_POST['password'])) {
                    @$password = $db_password;
                  } else {
                    @$pass = $_POST['password'];
                    @$password = md5($pass);
                  }



                    @$fname = $_POST['fname'];
                    @$lname = $_POST['lname'];
                    @$gender = $_POST['gender'];
                    @$adr = $_POST['adr'];
                    @$email = $_POST['email'];
                    @$phone = $_POST['phone'];
                    @$type = $_POST['type'];
                    @$perm = $_POST['perm'];
                    @$file_name_Up = '';


$query = "UPDATE
`users`
SET
`username` = '$username',
`password` = '$password',
`fname` = '$fname',
`lname` = '$lname',
`gender` = '$gender',
`adr` = '$adr',
`email` = '$email',
`phone` = '$phone',
`type` = '$type',
`perm` = '$perm'
WHERE
`user_id`='$selected_id'";
if ($results = $mysqli->query($query)) {
    ?>
    <div class="alert alert-success alert-dismissible" style="margin-bottom: 0;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <b class=" fa fa-check"></b> &nbsp; The User Has Been upadted!
    </div>
       <!-- /*<style> .frm { display:none; } </style>*/ -->
    <?php

} else {
?>
       <div class="alert alert-danger alert-dismissible" style="margin-bottom: 0;">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           <b class=" fa fa-warning"></b> &nbsp; Try again later
       </div>
<?php
  // echo "Please try again later ";
}


      }
//////////////////////////////// chanding Image ///////////


      #================== IMAGE UPLOAD =========
if (isset($_POST['change_profile'])) {
  # code...
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
?>
<div class="alert alert-warning alert-dismissible" style="margin-bottom: 0;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b class=" fa fa-warning"></b> &nbsp; The image already exist in the system
</div>
<?php
      } else {
        //check if the file has been uploaded
       if  (move_uploaded_file( $tmp_name, $location. $name)) {
      #==============================================================================
        // $file_name_Up = $file_name; bbbbb
        if ($results = $mysqli->query("UPDATE `users` SET `profile` = '$file_name' WHERE `user_id` = '$selected_id'")) {


        } else {?>
          <div class="alert alert-danger alert-dismissible" style="margin-bottom: 0;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <b class=" fa fa-warning"></b> &nbsp; Try again later
          </div>
        <?php
        }


      #==============================================================================
        }
        else {?>
          <div class="alert alert-danger alert-dismissible" style="margin-bottom: 0;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <b class=" fa fa-warning"></b> &nbsp; Try again later
          </div>
        <?php
        }
      }
             }
             else{
               ?>
               <div class="alert alert-warning alert-dismissible" style="margin-bottom: 0;">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <b class=" fa fa-warning"></b> &nbsp; Your Image is Too large
               </div>
               <?php
             }
         }
         else {
          ?>
          <div class="alert alert-warning alert-dismissible" style="margin-bottom: 0;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <b class=" fa fa-warning"></b> &nbsp; the Image must be JPEG or JPG or PNG
          </div>
          <?php
       }

      }
         else {
           ?>
           <div class="alert alert-warning alert-dismissible" style="margin-bottom: 0;">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <b class=" fa fa-warning"></b> &nbsp; Please Choose an Image.
           </div>
           <?php

         }

      }
} // file cond

?>
<div style=" background: #282e36; padding: 19px 55px; ">
<section style="float:left;"> <img src='<?php display_profile($selected_id);?>' style="width: 156px;border: 2px solid #ddd;border-radius: 99999999px;"> </section>
<section style="float: left; color: #fff; margin-left: 38px; margin-top: 13px;">
  <h3>Change Profile Picture </h3>
<!-- <h2><a href="#" class="click" type="button" data-toggle="modal" data-target="#MyModal"> <u class="fa fa-question-circle"></u> Help</a></h2> -->
<button type="button" name="add_user" class="btn btn-primary click"  data-toggle="modal" data-target="#changeProfile">Click here</button>
</section>

<section class="clear-both">x</section>
</div>


    <form class="frm" action="update_user.php?id=<?php echo @$selected_id; ?>" method="post">
     <div class="box-body">
<table border="0" width="100%">
  <tr>
    <td width="50%">
         <div class="form-group">
             <label for="">Username</label>
             <input type="text" name="username" class="form-control" id="" placeholder="Username" value="<?php echo @user_data_id('username','users',$selected_id); ?>" required="" <?php echo $form_text; ?>>
         </div>
    </td>
    <td  width="50%">
       <div class="form-group">
           <label for="">Password</label>
           <input type="text" name="password" class="form-control" id="" placeholder="Password" value="">

       </div>
    </td>
  </tr>
  <tr>
    <td>
       <div class="form-group">
           <label for="">First Name</label>
           <input type="text" name="fname" class="form-control" id="" placeholder="First Name" value="<?php echo @user_data_id('fname','users',$selected_id); ?>" required="" <?php echo $form_text; ?>>
       </div>
    </td>
    <td>
       <div class="form-group">
           <label for="">Last Name</label>
           <input type="text" name="lname" class="form-control" id="" placeholder="Last Name" value="<?php echo @user_data_id('lname','users',$selected_id); ?>" required="" <?php echo $form_text; ?>>
       </div>
    </td>
  </tr>
  </tr>
  <tr>

    <td>
       <div class="form-group">
           <label for="">Gender</label>
             <?php
              @$gnderD = @user_data_id('gender','users',$selected_id);
              //  $genderLabel = '';


              ?>
           <!-- <input type="text" name="quantity" class="form-control" id="" placeholder="Gender"> -->
           <select class="form-control" name="gender" required="">
             <option value="<?php echo $gnderD; ?>"><?php echo userGender($gnderD); ?></option>
             <option value="" class="" style="background:#ddd;"></option>

             <option value="M">Male</option>
             <option value="F">Female</option>

           </select>
       </div>
    </td>
    <td>
       <div class="form-group">
           <label for="">Address</label>
           <input type="text" name="adr" class="form-control" id="" placeholder="Address" value="<?php echo @user_data_id('adr','users',$selected_id); ?>" required="">
       </div>
    </td>
  </tr>
  <tr>
    <td>
     <div class="form-group">
         <label for="">Email</label>
         <input type="email" name="email" class="form-control" id="" placeholder="Em@il" value="<?php echo @user_data_id('email','users',$selected_id); ?>" required="">
     </div>
    </td>
    <td  style="background: rgba(40, 46, 54, 0.03)">
       <div class="form-group">
           <label for="">User Type</label>
           <select class="form-control" name="type" required="">
             <?php $usrType =  @user_data_id('type','users',$selected_id); ?>
             <option value="<?php echo $usrType; ?>" class=""><?php echo userType($usrType); ?></option>
             <option value="" class="" style="background:#ddd;"></option>
              <option value="1">Admin (all permition)</option>
              <option value="0">User (limited permition)</option>
           </select>
       </div>
    </td>
  </tr>
  <tr>
    <td>
       <div class="form-group">
           <label for="">Phone Number</label>
           <input type="text" name="phone" class="form-control" id="" placeholder="Phone Number" value="<?php echo @user_data_id('phone','users',$selected_id); ?>" required="" <?php echo $form_number; ?>>
       </div>
    </td>
    <td  style="background: rgba(40, 46, 54, 0.03)">
       <div class="form-group">
           <?php $permt = @user_data_id('perm','users',$selected_id); ?>
           <label for="">Permition</label>
           <select class="form-control" name="perm" required="">
              <option value="<?php echo @$permt; ?>" class=""><?php echo @userPerm($permt); ?></option>
              <option value="" class="" style="background:#ddd;"></option>
              <option value="0">Block</option>
              <option value="1">Allow</option>
           </select>
       </div>
    </td>
  </tr>
  <tr>
   <td>

   </td>
    <td valign="bottom" style="text-align:right;">    &nbsp;
      <button type="submit" name="add_user" class="btn btn-primary submit-butt">Apply Change</button>
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
