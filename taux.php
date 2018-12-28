<?php
include 'app_data/php/head.php';
secured();
admin_page();
?>
<!-- contents start here -->


<div class="contents-div">
<div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">
<!-- contents goes here -->


<section class="header-div-sec">
    <h2> Rate </h2>
    <!-- <a href="home.php" style="float: right;margin-right: 23px;text-decoration: none;color: #fff;"></a> -->
    <!-- <b class="search-option glyphicon glyphicon-eye-open click"></b> -->
</section>

<form class="" action="taux.php" method="post">

<?php

 if (isset($_POST['taux_upd'])) {
   $Gfco = $_POST['Gfco'];
   $Gfrw = $_POST['Gfrw'];

   $Rfco = $_POST['Rfco'];
   $Rfrw = $_POST['Rfrw'];



  if ($results = $mysqli->query("UPDATE `taux` SET `rec_dol_rw` = '$Rfrw', `rec_dol_fc` = '$Rfco', `giv_dol_rw` = '$Gfrw', `giv_dol_fc` = '$Gfco' WHERE `id` = '1'")) {

    // echo " give: $Gfco , $Gfrw , <br> receive: $Rfco , $Rfrw ";
    echo "<div class='alert alert-success' role='alert'> Change Saved! </div>";

  } else {
    echo '<div class="alert alert-danger" role="alert"><b>Fail to Update! </b> Please Try again later</div>';
  }

 }

 ?>
<br><br>
<div class="" style="    padding: 5px 63px;">

<h3 style=" color: #039954; font-size: 30px; margin-bottom: 9px; "> <b class="fa fa-arrow-circle-down"></b> Receive:</h3>
<p>
<label class="taux-lab">Frw:</label><input type="text" class="taux-text" name="Rfrw" value="<?php echo retrieve_data('rec_dol_rw','taux','id','1'); ?>">
</p>

<p>
<label class="taux-lab">Fco:</label><input type="text" class="taux-text" name="Rfco" value="<?php echo retrieve_data('rec_dol_fc','taux','id','1'); ?>">
</p>

<hr style="border-top: 1px solid #00713d;">


<h3  style=" color: #c21952; font-size: 30px; margin-bottom: 9px; "> <b class="fa fa-arrow-circle-up"></b> Give:</h3>
<p>
<label class="taux-lab">Frw:</label><input type="text" class="taux-text" name="Gfrw" value="<?php echo retrieve_data('giv_dol_rw','taux','id','1'); ?>">
</p>

<p>
<label class="taux-lab"> Fco:</label>  <input type="text" class="taux-text" name="Gfco" value="<?php echo retrieve_data('giv_dol_fc','taux','id','1'); ?>">
</p>



<hr style="border-top: 1px solid #00713d;">

<section>
  <button type="submit" name="taux_upd" class="btn btn-primary click bg-green-col" style="float: right;margin: 14px 0px;">  Apply Change </button>
</section>

</div>


</form>

<style media="screen">
  .taux-text {
    background: transparent;
    border: none;
    font-size: 17px;
    width: 100px;
    border-bottom: 1px dashed #848080;
    padding-left: 9px;
  }

  .taux-lab {
    font-size: 17px;
    font-weight: normal;
    width: 41px;
    margin-left: 37px;
  }
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
