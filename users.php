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
    <!-- <button type="button" name="button" class="add_more_users_button click"><b class="fa fa-user-plus"></b></button> -->
    <b class="search-option fa fa-user-plus click" title="Add new"></b>
    </a>
    <section class="clear-both">x</section>
</section>


<div class="secton-contents-containner">



<div class="chart-contain scroll">
  <?php
    $total_sales = number_ret("SELECT `s_id` FROM `selling_e`");
    $total_designs = number_ret("SELECT `s_id` FROM `selling_e` WHERE `design` !='0'");
    $total_invitation =  Summ_data("SELECT SUM(`quantity`) FROM `selling_e`",'quantity');
  ?>

  <div class='info-charto fading-containner'>
    <div class="" style="border-right: 1px solid #333; margin-right: 15px; padding-bottom: 3px;">
    <!-- <h3 style=" margin-left: 10px; margin-bottom: -6px; "><b>Total</b> Values </h3> -->
    <section class="label-chart-tot chart_sell_butt fading-item"> <p> Sales </p> <h4><?php echo @$total_sales; ?></h4> </section>
    <section class="label-chart-tot chart_inv_butt  fading-item" style="background: #d08f33;"> <p> Invitation </p> <h4><?php echo @$total_invitation; ?></h4> </section>
    <section class="label-chart-tot chart_design_butt  fading-item" style="background: #337ab7;"> <p> Design </p> <h4><?php echo @$total_designs; ?></h4> </section>
    <!-- <section class="label-chart-tot chart_design_butt  fading-item" style="background: #337ab7;"> <p> Divers </p> <h4><?php echo @$total_designs; ?></h4> </section> -->

    <section class="label-chart-tot chart_design_butt chart_all_butt  fading-item" style="background: #9d1442;text-align: center;color: #fff;font-size: 20px;padding: 1px;"> <b class="fa fa-bar-chart"></b> </section>
    </div>
  </div>

<div class="group" style="margin-left: 250px;">

<?php
$results = $mysqli->query("SELECT `user_id`,`username` FROM `users`");
if ($results->num_rows == NULL) {
echo "No data";
} else {


while($row = $results->fetch_array()) {
  $user_ido = $row["user_id"];
  $username = $row["username"];


  // sells
  @$salesi = number_ret("SELECT `s_id` FROM `selling_e` WHERE `done_by`='$user_ido'");
  @$sell_percent = round(($salesi / $total_sales) * 100);

  // invitation
  @$initationi = Summ_data("SELECT SUM(`quantity`) FROM `selling_e` WHERE `done_by`='$user_ido'",'quantity');
  @$initationi_percent = round(($initationi / $total_invitation) * 100);

  // Design
  @$designb =  number_ret("SELECT `s_id` FROM `selling_e` WHERE `design`='$user_ido'");
  @$design_percent = round(($designb / $total_designs) * 100);


?>

  <div class="chart-set">
  <b><?php echo @$username; ?></b>
  <div class="progress progress-xs sell_ch" id="" title="<?php echo $username; ?>'s sales &#013; ------------------------------ &#013; Sales: <?php echo @$salesi; ?> &#013; Percent: <?php echo $sell_percent; ?>% "> <div class="progress-bar  slideInLeft animated  progress-bar-success" style="width: <?php echo $sell_percent; ?>%"></div> </div>

  <div class="progress progress-xs invitation_ch" id="" title="<?php echo $username; ?>'s Invitations &#013; ------------------------------ &#013; Invitati.: <?php echo @$initationi; ?>  &#013; Percent: <?php echo $initationi_percent; ?>%"> <div class="progress-bar  slideInLeft animated  progress-bar-warning" style="width: <?php echo @$initationi_percent; ?>%"></div> </div>

  <div class="progress progress-xs  design_ch" id="" title="<?php echo $username; ?>'s Designs &#013; ------------------------------ &#013; Designs: <?php echo @$designb; ?>  &#013; Percent: <?php echo $design_percent; ?>% "> <div class="progress-bar progress-bar-primary slideInLeft animated" style="width: <?php echo @$design_percent; ?>%"></div> </div>
  </div> <!-- chart-set -->
<?php

// echo "
// total sales: $total_sales <br>
// total design: $total_designs<br>
// total invitation: $total_invitation<br>
// ";

// echo "
// --------------------------------- <br>
// total sales: $salesi <br>
// total design: $designb<br>
// total invitation: $initationi<br>
// ";
}
}
?>

</div> <!-- .group -->
</div> <!-- .chart-contain scroll -->

<!-- <section style=" background: #bbffe0; border-top: 2px solid #8ca08c;">
<div class="color-mean-chart fading-containner">
<b class="chart_all_butt fa fa-bar-chart bounceIn animated" style="float:left;font-size: 30px;color: #8c103a;"></b>
<section style="background: #5cb85c;" class="fading-item chart_sell_butt"> <b>Sells</b> </section>
<section style="background: #d9534f;" class="fading-item chart_design_butt"> <b>Design</b> </section>
<section style="background: #f0ad4e;" class="fading-item chart_inv_butt"> <b>Invitation</b> </section>
<div class="clear-both">x</div>
</div>
</section> -->


<section style="" class="chart-table-contain">
<h2>Maison</h2>

<table border="1" class="table table-bordered fading-containner">
<tbody>
  <tr>
    <!-- <th width="33px;">&nbsp; </th> -->
    <th style="text-align:center;"> # </th>
    <th> Name </th>
    <th> Address </th>
    <th> phone </th>
    <th> Sales </th>
    <th> Invitation </th>

    <th>  </th>
    <th>  </th>
    <th>  </th>
    <!-- <th>  </th> -->
  </tr>


  <?php
  $results = $mysqli->query("SELECT * FROM `users`");
  if ($results->num_rows == NULL) {
      echo "No data";

  } else {
      $x = 0;
      // while($row = $results->fetch_array()) {
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

<tr class="<?php if ($x%2 == 0) { echo "a"; } else { echo "b"; }?>">
<td style="text-align:center;"> <?php echo @$user_ido; ?> </td>
<td><a href="profile_view.php?id=<?php echo @$user_ido; ?>"><?php echo @$username; ?></a></td>
<td><?php echo userType($type); ?></td>
<td><?php echo @$last_log; ?></td>
<td><?php echo @$total_sales = number_ret("SELECT `s_id` FROM `selling_e` WHERE `done_by`='$user_ido'"); ?> </td>
<td><?php echo Summ_data("SELECT SUM(`quantity`) FROM `selling_e` WHERE `done_by`='$user_ido'",'quantity'); ?> </td>

<td style="text-align:center;">
    <?php if ($perm == '1') { ?>
        <!-- <a onclick="return confirm('are you sure you want to Hide <?php echo @$maison_name; ?>?')" href="app_data/php/hide_unhide_maison.php?id=<?php echo @$maison_id; ?>&t=hide"> -->
          <b class="fa fa-unlock table-icon" style="color:#0eae0e;"></b>
        <!-- </a> -->
    <?php } else { ?>
        <!-- <a onclick="return confirm('are you sure you want to Unhide <?php echo @$maison_name; ?>?')" href="app_data/php/hide_unhide_maison.php?id=<?php echo @$maison_id; ?>&t=show"> -->
          <b class="fa fa-lock table-icon" style="color:#ec0808;"></b>
        <!-- </a> -->
    <?php } ?>
</td>
<td style="text-align:center;"> <a href="update_user.php?id=<?php echo @$user_ido; ?> "><b class="fa fa-pencil-square-o table-icon" style="color:#1e8de6;"></b></a> </td>
<td style="text-align:center;"> <a href="profile_view.php?id=<?php echo @$user_ido; ?>" class="click"><b class="fa fa-ellipsis-h table-icon" style="color:#1e8de6;"></b></a></td>
<!-- <td style="text-align:center;"> <b></b> </td> -->
</tr>


<?php
  $x++; // incemmenting
  }
}

// }
?>

</tbody></table>
</section>




</div><!-- .secton-contents-containner -->























































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
