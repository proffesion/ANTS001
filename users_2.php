<?php
include 'app_data/php/head.php';
secured();
?>
<!-- contents start here -->


<div class="contents-div">
<div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">
<!-- contents goes here -->

<section class="header-div-sec">
    <h2> Users </h2>
    <a href="add_user.php">
    <button type="button" name="button" class="add_more_users_button click"><b class="fa fa-user-plus"></b></button>
    </a>
    <section class="clear-both">x</section>
</section>

<?php if (isset($_GET['deleted'])) { ?>
  <div class="alert alert-success alert-dismissible" style="margin-bottom: 0;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <b class=" fa fa-check"></b> &nbsp; The User Has Been Deleted!
  </div>
  <?php } elseif (isset($_GET['failed'])) { ?>
    <div class="alert alert-danger alert-dismissible" style="margin-bottom: 0;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <b class=" fa fa-warning"></b> &nbsp; Try again later
    </div>
  <?php
}  elseif (isset($_GET['you'])) { ?>
    <div class="alert alert-warning alert-dismissible" style="margin-bottom: 0;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <b class=" fa fa-warning"></b> &nbsp; You cant Delete Your self
    </div>
  <?php
  }




// MySqli Select Query
$results = $mysqli->query("SELECT * FROM `users`");
// echo $results->num_rows; // number of result

if ($results->num_rows == NULL) {
    echo "No data";
} else {

?>

<?php
    // $x = 0; // declaring the row change data
    while($row = $results->fetch_array()) {
      @$user_ido = $row["user_id"];
      @$username = $row["username"];
      @$fname = $row["fname"];
      @$lname = $row["lname"];
      @$email = $row["email"];
      @$profile = $row["profile"];
      @$last_log = $row["last_log"];
      @$type = $row["type"];
      @$perm = $row["perm"];
      // $x++; // incemmenting
?>


<section class="fading-item">

<div class="user-list-div-itm click" onclick="return window.open('profile_view.php?id=<?php echo @$user_ido; ?>','_self')">
  <section class="img">
     <img src='<?php display_profile($user_ido);?>'>
  </section>
  <section class="content">
    <div class="inr" style="width:90%;">

      <h4><?php echo $username; ?></h4>
      <label> Firstname </label> <b> <?php echo $fname; ?></b> <hr>
      <label> Lastname </label> <b> <?php echo $lname; ?> </b> <hr>
      <label> Email </label> <b> <?php echo $email; ?> </b> <hr>

    </div>
  </section>
  <section class="content2">
    <div class="inr">
      <label> type </label> <b><?php echo userType($type); ?></b> <hr>
      <label> is </label> <b> <?php if ($perm == "1") { echo "<b style='color:green;'> Active </b>"; } else { echo "<b style='color:red;'> Deactive </b>"; }  ?> </b> <hr>
      <!-- <a href="update_user.php?id=<?php echo @$user_ido; ?>"> <button type="button" class="click" name="button"><b class="fa fa-edit"></b></button> </a> -->
      <!-- <a onclick="return confirm('Are you sure you want to delete <?php echo $username; ?> ?')" href="app_data/php/deleteUser.php?id=<?php echo @$user_ido; ?>"> <button type="button" name="button"><b class="fa fa-trash-o"></b></button> </a> -->
      <!-- <button type="button" onclick="return window.open('profile_view.php?id=<?php echo @$user_ido; ?>','_self')" name="button">view</button> -->
</div>
  </section>
<div class="clear-both">x</div>
</div>
</section>

<?php
    }

}


?>



<div class="user-list-containner">
   <section class="user-item-list">

   </section>
</div>

















</div><!-- .contents-div -->

<div class="">
  <div class="contents-iframe fadeIn animated search-conent-div" id="SearchResult">
      <section class="cancel-section-button">
        <button type="button" name="button" onclick="HideSearchDivContent()"> <b class="fa fa-arrow-left"></b> Back</button>
      </section>
      <div class="" id="iframeDispayDiv"></div>
  </div>
</div>



</div><!-- .containner -->
</div><!-- .main-containner -->
<?php include 'app_data/php/foater.php' ?>
