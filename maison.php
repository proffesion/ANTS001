<?php
include 'app_data/php/head.php';
secured();
admin_page();

$total_sales = number_ret("SELECT `s_id` FROM `selling_e` WHERE `maison_id` != '0'");
$total_invitatiotn = Summ_data("SELECT SUM(`quantity`) FROM `selling_e` WHERE `maison_id` != '0'",'quantity');
$total_Divers = Summ_data("SELECT SUM(`quantity`) FROM `divers_sales` WHERE `maison_id` != '0'",'quantity');
// echo "-------------------------------------------------------------------------------------------------------------------- total divers quantity: $total_Divers";
?>

<!-- contents start here -->


<div class="contents-div">
<div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">
<!-- contents goes here -->


      <section class="header-div-sec">
        <h2> Maison </h2>
        <a href="add_maison.php"> <b class="search-option fa fa-plus-square click" title="Add new"></b> </a>
      </section>

    <div class="secton-contents-containner">



<div class="chart-contain scroll">
    <div class="group">

<?php
$results = $mysqli->query("SELECT * FROM `maison` WHERE `view`='1'");
if ($results->num_rows == NULL) {
    echo "No data";
} else {
    while($row = $results->fetch_array()) {
      $maison_id = $row["maison_id"];
      $maison_name = $row["maison_name"];
      $maison_phone = $row["maison_phone"];
      $maison_address = $row["maison_address"];

      // sells
      @$salesi = number_ret("SELECT `s_id` FROM `selling_e` WHERE `maison_id`='$maison_id'");
      @$sell_percent = round(($salesi / $total_sales) * 100);

      // invitation
      @$initationi = Summ_data("SELECT SUM(`quantity`) FROM `selling_e` WHERE `maison_id`='$maison_id'",'quantity');
      @$initationi_percent = round(($initationi / $total_invitatiotn) * 100);

      // Divers
      @$diversSale = Summ_data("SELECT SUM(`quantity`) FROM `divers_sales` WHERE `maison_id` = '$maison_id'",'quantity');
      @$divers_percent = round(($diversSale / $total_Divers) * 100);
?>

      <div class="chart-set">
      <b><?php echo @$maison_name; ?></b>
      <div class="progress progress-xs sell_ch" id="" title="<?php echo $sell_percent; ?>%"> <div class="progress-bar  slideInLeft animated  progress-bar-success" style="width: <?php echo $sell_percent; ?>%"></div> </div>
       <!-- sell <br> -->
      <div class="progress progress-xs design_ch" id="" title="<?php echo @$initationi_percent; ?>%"> <div class="progress-bar  slideInLeft animated  progress-bar-warning" style="width: <?php echo @$initationi_percent; ?>%"></div> </div>
       <!-- invitations <br> -->
      <div class="progress progress-xs divers_ch" id="" title="<?php echo @$divers_percent; ?>%"> <div class="progress-bar  slideInLeft animated  " style="width: <?php echo @$divers_percent; ?>%"></div> </div>
       <!-- Divers -->
        <!-- <div class="progress progress-xs slideInLeft animated invitation_ch" id=""> <div class="progress-bar progress-bar-danger" style="width: 20%"></div> </div> -->
      </div> <!-- chart-set -->
<?php
    }
}
?>

    </div> <!-- .group -->
</div> <!-- .chart-contain scroll -->

<section style=" background: #bbffe0; border-top: 2px solid #8ca08c;">
<div class="color-mean-chart fading-containner">
  <b class="chart_all_butt fa fa-bar-chart bounceIn animated" style="float:left;font-size: 30px;color: #8c103a;"></b>
  <section style="background: #5cb85c;" class="fading-item chart_sell_butt"> <b>Sells</b> </section>
  <section style="background: #f0ad4e;" class="fading-item chart_design_butt"> <b>Invitations</b> </section>
  <section style="background: #337ab7;" class="fading-item chart_diver_butt"> <b>Divers</b> </section>
  <!-- <section style="background: #d9534f;" class="fading-item chart_inv_butt"> <b>Invitation</b> </section> -->
  <div class="clear-both">x</div>
</div>
</section>


<section style="" class="chart-table-contain">
<h2>Maison</h2>

<table border="1" class="table table-bordered fading-containner" style="text-align: center; box-shadow: none;">
    <tbody>
      <tr>



        <td> Total Sells: <b><?php echo @$total_sales; ?></b> </td>
        <td> Total Sells: <b><?php echo @$total_invitatiotn; ?></b> </td>
        <td> Total Divers: <b><?php echo @$total_Divers; ?></b> </td>
        <!-- <td>  </td> -->
        <!-- <td>  </td> -->
      </tr>
    </tbody>
</table>
<table border="1" class="table table-bordered fading-containner">
    <tbody>
      <tr>
        <!-- <th width="33px;">&nbsp; </th> -->
        <th style="text-align:center;"> # </th>
        <th> Name </th>
        <th class="th-tab-inv"> sell </th>
        <th class="th-tab-inv"> sell (%) </th>

        <th class="th-tab-inv"> Invitation </th>
        <th class="th-tab-inv"> Invitation (%) </th>

        <th class="th-tab-div"> Divers </th>
        <th class="th-tab-div"> Divers (%) </th>


        <th>  </th>
        <th>  </th>
        <th>  </th>
        <!-- <th>  </th> -->
      </tr>


      <?php
      $results = $mysqli->query("SELECT * FROM `maison`");
      if ($results->num_rows == NULL) {
          echo "No data";

      } else {
          $x = 0;
          while($row = $results->fetch_array()) {
            $maison_id = $row["maison_id"];
            $maison_name = $row["maison_name"];
            $maison_phone = $row["maison_phone"];
            $maison_address = $row["maison_address"];
            $viewo = $row["view"];

            // sells
            @$salesi = number_ret("SELECT `s_id` FROM `selling_e` WHERE `maison_id`='$maison_id'");
            @$sell_percent = round(($salesi / $total_sales) * 100);

            // invitation
            @$initationi = Summ_data("SELECT SUM(`quantity`) FROM `selling_e` WHERE `maison_id`='$maison_id'",'quantity');
            @$initationi_percent = round(($initationi / $total_invitatiotn) * 100);

            // Divers
            @$diversSale = Summ_data("SELECT SUM(`quantity`) FROM `divers_sales` WHERE `maison_id` = '$maison_id'",'quantity');
            @$divers_percent = round(($diversSale / $total_Divers) * 100);
      ?>

       <!-- <?php echo @$maison_name; ?> -->
  <tr class="<?php if ($x%2 == 0) { echo "a"; } else { echo "b"; }?>">
    <td style="text-align:center;"> <?php echo @$maison_id; ?> </td>
    <td><a href="maison_details.php?id=<?php echo @$maison_id; ?>" class="click"><?php echo @$maison_name; ?></a></td>

    <td class="td-tab-sell"> <?php echo @$salesi; ?> </td>
    <td class="td-tab-sell"> <?php echo @$sell_percent; ?>% </td>

    <td class="td-tab-inv"> <?php echo @$initationi; ?> </td>
    <td class="td-tab-inv"> <?php echo @$initationi_percent; ?>% </td>

    <td class="td-tab-div"> <?php echo @$diversSale; ?> </td>
    <td class="td-tab-div"> <?php echo @$divers_percent; ?>% </td>

    <td style="text-align:center;">
    <?php if ($viewo == '1') { ?>
        <a onclick="return confirm('are you sure you want to Hide <?php echo @$maison_name; ?>?')" href="app_data/php/hide_unhide_maison.php?id=<?php echo @$maison_id; ?>&t=hide"><b class="fa fa-toggle-on table-icon" style="color:#0eae0e;"></b></a>
    <?php } else { ?>
        <a onclick="return confirm('are you sure you want to Unhide <?php echo @$maison_name; ?>?')" href="app_data/php/hide_unhide_maison.php?id=<?php echo @$maison_id; ?>&t=show"><b class="fa fa-toggle-off table-icon" style="color:#ec0808;"></b></a>
    <?php } ?></td>
    <td style="text-align:center;"> <a href="update_maison.php?id=<?php echo @$maison_id; ?> "><b class="fa fa-pencil-square-o table-icon" style="color:#1e8de6;"></b></a> </td>
    <td style="text-align:center;"> <a href="maison_details.php?id=<?php echo @$maison_id; ?>" class="click"><b class="fa fa-ellipsis-h table-icon" style="color:#1e8de6;"></b></a></td>
    <!-- <td style="text-align:center;"> <b></b> </td> -->
   </tr>


<?php
      $x++; // incemmenting
      }
  }
?>

  </tbody></table>
</section>




    </div><!-- .secton-contents-containner -->

















<style media="screen">
  .th-tab-inv { background: #5cb85c; text-align: center; }
  .td-tab-inv { background: rgba(240, 173, 78, 0.74); text-align: center; }

  /*divers*/
  .th-tab-div { text-align: center; }
  .td-tab-div { background: rgba(51, 122, 183, 0.53); text-align: center; }
  .td-tab-sell { background: rgba(92, 184, 92, 0.57); text-align: center; }
</style>

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
