<?php
include 'app_data/php/head.php';
secured();
admin_page();
?>
<div class="contents-div">
  <div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">

      <!-- <section class="header-div-sec">
        <h2> STOCK </h2>
      </section> -->
      <div class="secton-contents-containner">
<!-- ------------------------------------------------------------------------------------- -->



<?php
$annm = ' ';
  // include 'app_data/php/head.php';
  // secured(); // security



if (isset($_GET['id']) && !empty($_GET['id'])) {
    $selected_id = $_GET['id'];
    $sql = "SELECT * FROM `users` WHERE `user_id`='$selected_id' LIMIT 1";
} else {
    $selected_id = $user_id;
    $sql = "SELECT * FROM `users` WHERE `user_id`='$user_id' LIMIT 1";
    echo "<style> .curent-butt-hid { display:none; }  </style>";
}

// MySqli Select Query
$results = $mysqli->query($sql);
if ($results->num_rows == NULL) {
    echo "<div class='over-flow'>No data</div>";
} else {

    while($row = $results->fetch_array()) {
        @$usero_id = $row["user_id"];
        @$username = $row["username"];
        @$password = $row["password"];
        @$fname = $row["fname"];
        @$lname = $row["lname"];
        @$gender = $row["gender"];
        // @$dob = $row["dob"];
        // @$country = $row["country"];
        @$adr = $row["adr"];
        @$email = $row["email"];
        @$phone = $row["phone"];
        @$profile = $row["profile"];
        @$last_log = $row["last_log"];
        @$type = $row["type"];
        @$perm = $row["perm"];


    }

}

if ($usero_id == $user_id || $perm != '1') { echo "<style> .curent-butt-hid { display:none; }  </style>"; }

?>



<div class="main-head-path-div">
  <div class="content-head-path ">
      <div class="col one fading-containner">
        <section class="fading-item"> <h1><?php echo @$username; ?></h1> </section>
        <section class="fading-item"> <img src="<?php display_profile($usero_id);?>" alt="Profile image" /> </section>

      </div>
      <div class="col two fading-containner">

        <!-- <section class="fading-item"> <label class="prof-label"> Username: </label>     <b><?php echo @$username; ?></b><hr>   </section> -->
        <section class="fading-item"> <label class="prof-label"> First name: </label>   <b><?php echo @$fname; ?></b><hr>  </section>
        <section class="fading-item"> <label class="prof-label"> Last name: </label>    <b><?php echo @$lname; ?></b><hr>  </section>
        <section class="fading-item"> <label class="prof-label"> gender: </label>       <b><?php echo @$gender; ?></b><hr>  </section>
        <!-- <section class="fading-item"> <label class="prof-label"> DOB: </label>          <b><?php echo @$dob; ?></b><hr>  </section> -->
        <section class="fading-item"> <label class="prof-label"> is: </label>        <?php if (@$perm == "1") { echo "<b style='color:#2bed2b;'> Active </b>"; } else { echo "<b style='color:red;'> Deactive </b>"; }  ?>  </section>


      </div>
      <div class="col three fading-containner">

        <section class="fading-item"> <label class="prof-label"> type: </label>         <b><?php echo @userType($type); ?></b> <hr>  </section>
        <!-- <section class="fading-item"> <label class="prof-label"> country: </label>      <b><?php echo @$country; ?></b> <hr>  </section> -->
        <section class="fading-item"> <label class="prof-label"> Address: </label>      <b><?php echo @$adr; ?></b> <hr>  </section>
        <section class="fading-item"> <label class="prof-label"> Phone Number: </label> <b><?php echo @$phone; ?></b><hr>  </section>
        <section class="fading-item"> <label class="prof-label"> email: </label>        <b><?php echo @$email; ?></b>  </section>


      </div>
      <section style="clear:both;text-align: center;" class="fadeInUp animated">
<a href="update_user.php?id=<?php echo @$selected_id; ?>">
    <button type="button" class="btn btn-primary click" name="button"> <b class="fa fa-edit"></b> &nbsp; Edit Profile </button>
</a>
<a onclick="return confirm('Are you sure you want to delete <?php echo $username; ?> ?')" href="app_data/php/deleteUser.php?id=<?php echo @$selected_id; ?>">
   <button type="button" class="btn btn-primary bg-red curent-butt-hid click" name="button"> <b class="fa fa-trash-o"></b> &nbsp; Delete User </button>
</a>

<a href="electronicSignatureUser.php?id=<?php echo @$selected_id; ?>">
    <button type="button" class="btn btn-primary click" name="button"> <b class="fa fa-edit"></b> &nbsp; Electronic signature </button>
</a>
      </section> <!-- clearing the float -->
  </div><!-- .content-head-path -->
</div><!-- .main-head-path-div -->


<div class="oth_details_user">
  <h2>Today</h2>
  <div class="">


    <section style="background:#f39c12;"> <p><u class="fa fa-file-text" style="text-decoration:none;"></u> Invitation </p> <b>
      <?php @Summ_data("SELECT SUM(`quantity`) FROM `selling_e` WHERE `date`='$time_now' AND `done_by`='$selected_id'",'quantity'); ?>
    </b> </section>


    <section style="background:#00a65a;"> <p><u class="fa fa-cart-arrow-down" style="text-decoration:none;"></u> Sell </p>
        <b><?php echo number_ret("SELECT `s_id` FROM `selling_e` WHERE `date`='$time_now' AND `done_by`='$selected_id'"); ?></b> </section>
    <div class="clear-both">x</div>
  </div>
  <h2>Total</h2>
  <div class="">

    <section style="background: rgba(233, 30, 99, 0.81);"> <p><u class="fa fa-file-text" style="text-decoration:none;"></u> Invitation </p> <b>
      <?php @Summ_data("SELECT SUM(`quantity`) FROM `selling_e` WHERE `done_by`='$selected_id'",'quantity'); ?>
    </b> </section>


    <!-- <section style="background: rgba(233, 30, 99, 0.81);"> <p><u class="fa fa-cart-arrow-down" style="text-decoration:none;"></u> Sell </p> <b>20</b> </section> -->
        <section style="background:#00a65a;"> <p><u class="fa fa-cart-arrow-down" style="text-decoration:none;"></u> Sell </p> <b><?php echo number_ret("SELECT `s_id` FROM `selling_e` WHERE `done_by`='$selected_id'"); ?></b> </section>
  <div class="clear-both">x</div>
  </div>
</div>








<style media="screen">
  .sec-main-cont-div { width: 100%;margin:auto; }


.oth_details_user {
      /*background: red;*/
      margin: auto;
      width: 80%;
      margin-top: 30px;
}

.oth_details_user h2 {
  margin: 0px;
      font-size: 27px;
      margin-bottom: 4px;
      border-bottom: 3px solid #888;
      padding-bottom: 4px;
      color: #888;
      margin-top: 19px;
}

.oth_details_user section {
  background: blue;
  float: left;
  margin: 1%;
  width: 48%;
  /* height: 34px; */
  padding: 22px 0px;
  border-radius: 8px;
  font-size: 21px;
  text-align: center;
  color: #fff;
  /*box-shadow: inset 0px 0px 43px 0px rgba(51, 51, 51, 0.79);*/
}
.oth_details_user b {font-size: 36px;}
.oth_details_user p {
    margin-bottom: -4px;
}

</style>


<!-- -------------------------------------------------------------------------------------------- -->
       </div><!-- .contents-iframe -->

<div class="">
  <div class="contents-iframe slideInDown animated search-conent-div" id="SearchResult">
      <section class="cancel-section-button">
        <button type="button" name="button" onclick="HideSearchDivContent()"> <b class="fa fa-arrow-left"></b> Back</button>
      </section>
      <div class="" id="iframeDispayDiv"></div>
  </div>
</div>

</div><!-- .contents-div -->


</div><!-- .containner -->
</div><!-- .main-containner -->
<?php include 'app_data/php/foater.php' ?>
