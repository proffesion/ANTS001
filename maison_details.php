<?php
include 'app_data/php/head.php';
secured();
admin_page();

$id = $_GET['id'];
if (empty($id) || !isset($id)) {
  echo "<script>window.open('maison.php','_self')</script>";
}
$viewo = retrieve_data('view','maison','maison_id',$id);
?>
<!-- contents start here -->


<div class="contents-div">
<div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">
<!-- contents goes here -->
<section class="header-div-sec">
  <h2>  House Details </h2>

  <!-- <a href="add_maison.php"> -->
    <?php if ($viewo == '1') { ?>
          <a onclick="return confirm('are you sure you want to Hide <?php echo @$maison_name; ?>?')" href="app_data/php/hide_unhide_maison.php?id=<?php echo @$id; ?>&t=hide"><b class="fa fa-toggle-on search-option-border" style="color:#0eae0e;"></b></a>
      <?php } else { ?>
          <a onclick="return confirm('are you sure you want to Unhide <?php echo @$maison_name; ?>?')" href="app_data/php/hide_unhide_maison.php?id=<?php echo @$id; ?>&t=show"><b class="fa fa-toggle-off search-option-border" style="color:#ec0808;"></b></a>
      <?php } ?>
  <!-- <a href="add_maison.php"> <b class="search-option fa fa-plus-square click" title="Add new"></b> </a> -->
  <a href="update_maison.php?id=<?php echo @$id; ?> "><b class="fa fa-pencil-square-o search-option" style="color:#fff;"></b></a>
    <!-- </a> -->
</section>

<div class="head_maison_div">
<h1><?php echo retrieve_data('maison_name','maison','maison_id',$id); ?></h1>

<div class="section_div_contain">
  <div class="section_div">
    <section> <u>Adress:</u> <b><?php echo retrieve_data('maison_address','maison','maison_id',$id); ?></b> </section>
    <section> <u>Phones:</u> <b><?php echo retrieve_data('maison_phone','maison','maison_id',$id); ?></b> </section>
  </div>

  <div class="section_div">
    <section style=" border-bottom: 0px; margin-bottom: 0px; padding-bottom: 0px; color: #929292;"> <u>Comment:</u></section>
    <section style="color: #fff;font-size: 16px;"><?php echo retrieve_data('maison_comment','maison','maison_id',$id); ?></section>
  </div>
  <div class="clear-both">x</div>
</div>

<h2>  House Details </h2>
<div class="section_div_contain">
  <div class="section_div">
    <h3>Invitations</h3>
    <section> <u>Sales:</u> <b><?php echo number_ret("SELECT `s_id` FROM `selling_e` WHERE `maison_id`='$id'"); ?></b> </section>
    <section> <u>Total Invitation(s):</u> <b><?php echo Summ_data("SELECT SUM(`quantity`) FROM `selling_e` WHERE `maison_id`='$id'",'quantity'); ?></b> </section>
  </div>

  <div class="section_div">
    <h3>Divers</h3>
    <section> <u>Sales:</u> <b><?php echo number_ret("SELECT `s_id` FROM `divers_sales` WHERE `maison_id`='$id'"); ?></b> </section>
    <section> <u>Total Invitation(s):</u> <b><?php echo Summ_data("SELECT SUM(`quantity`) FROM `divers_sales` WHERE `maison_id`='$id'",'quantity'); ?></b> </section>
  </div>
  <div class="clear-both">x</div>
</div>
<br>
<br>
</div>







<div class="tables-contain-maison">


  <div class="table-item-cont">
<h2>Invitations</h2>

    <table border="1" class="table table-bordered invitationo-table-hide">
      <tbody><tr>
      <th> Inv Id </th><th> Date </th><th> Quantity </th>
      </tr>
      <?php
           // MySqli Select Query
           $results = $mysqli->query("SELECT `s_id`,`e_id`,`date`,`quantity` FROM `selling_e` WHERE `maison_id`='$id'");
           // echo $results->num_rows; // number of result
           if ($results->num_rows == NULL) { ?>
            <style> .invitationo-table-hide { display: none;} </style>

            <div class="alert alert-danger alert-dismissible" style="margin-bottom: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b class=" fa fa-warning"></b> &nbsp; No Invitation Sell Found!
            </div>

            <?php
           } else {
             $x = 0;

               while($row = $results->fetch_array()) {
                 $s_id = $row["s_id"];
                 $e_id = $row["e_id"];
                 $date = $row["date"];
                 $quantity = $row["quantity"];
            ?>

            <tr class="<?php if ($x%2 == 0) { echo "a"; } else { echo "b"; }?>"  onclick="sellDetails(<?php echo $s_id; ?>)">
              <td> <?php echo @$e_id; ?> </td>
              <td> <?php echo @$date; ?> </td>
              <td> <?php echo @$quantity; ?> </td>
              </tr>
           <?php
           $x++; // incemmenting
       }
   }
   ?>
    </tbody></table>
  </div>





    <div class="table-item-cont">
  <h2>Divers</h2>

      <table border="1" class="table table-bordered diverso-table-hide">
        <tbody><tr>
          <!-- <th width="41px">&nbsp;</th> -->
          <th> Product Name </th><th> Date </th><th> Quantity </th>
        </tr>
        <?php
             // MySqli Select Query
             $results = $mysqli->query("SELECT `s_id`,`div_id`,`date`,`quantity` FROM `divers_sales` WHERE `maison_id`='$id'");
             // echo $results->num_rows; // number of result

             if ($results->num_rows == NULL) { ?>
               <style> .diverso-table-hide { display: none;} </style>

               <div class="alert alert-danger alert-dismissible" style="margin-bottom: 0;">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <b class=" fa fa-warning"></b> &nbsp; No Divers Sell Found!
               </div>
            <?php
             } else {
               $x = 0;

                 while($row = $results->fetch_array()) {
                   $se_id =  $row["s_id"];
                   $div_id = $row["div_id"];
                   $date = $row["date"];
                   $quantity = $row["quantity"];
                  //  $quantity = $row["quantity"];
                     ?>

              <tr class="<?php if ($x%2 == 0) { echo "a"; } else { echo "b"; }?>"  onclick="sellDiversDetails(<?php echo $se_id; ?>)">
                <td> <?php echo @retrieve_data('pro_name','products','pro_id',$div_id);; ?> </td>
                <td> <?php echo @$date; ?> </td>
                <td> <?php echo @$quantity; ?> </td>
                </tr>
             <?php
             $x++; // incemmenting
         }
     }
     ?>
      </tbody></table>
    </div>


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
