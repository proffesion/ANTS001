
<!DOCTYPE html>
<html lang="en"><html>
 <?php
include_once 'connect.php';
include_once 'core_data.php';
include_once 'functions.php';
include_once 'local_data.php';
?>
  <head>
    <meta charset="utf-8">

    <!-- <head> -->
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="shortcut icon" href="app_data/imgs/icns/web_logo.png">
    <title> Antares </title>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0"> -->
    <link rel="stylesheet" type="text/css" href="app_data/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="app_data/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="app_data/css/animate.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="app_data/css/screen_style.css">
    <link rel="stylesheet" href="app_data/css/print.css" media="print" title="printing" charset="utf-8">


    <!-- // <script type="text/javascript" src="app_data/java/bootstrap.js"></script> -->
    <!-- <script type="text/javascript" src="app_data/java/jquery-2.1.3.min.js"></script> -->

    <!---------------- this tags help the internet explofer to read html5 -------------->
    <!--[if lt IE 9]>
       <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <?php
  include_once 'app_data/php/head_elements.php';
  // this contain a html element of
  // - popup Conveter
  // - popup overlay
  ?>

<body>
  <!--
  ////////////////////////////////////////////////////////////////////
  ////////////////////////// REPORT POPUP ////////////////////////////
  ////////////////////////////////////////////////////////////////////
  -->
  <div id="Reports" class="modal fade" role="dialog">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header"> <b class="modal-title">Balance</b>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body" style="padding:0px;">
     <section class="headPopReportnav">
       <b class="fa fa-file-text" style="font-size: 49px;"></b>
     </section>
       <div class="headPopReportContent">
         <section>
            <h3>Invitation</h3>
            <a href="sell_report.php" class="a click"> <u class="fa fa-circle"></u> Sale's Report Inv</a>
            <a href="stock_report.php" class="a click"> <u class="fa fa-circle"></u> Stock Report Inv</a>
         </section>

         <section>
            <h3>Divers</h3>
            <a href="sellDivers_report.php" class="a click"> <u class="fa fa-circle"></u> Sell Divers Report </a>
            <a href="DiversStock_report.php" class="a click"> <u class="fa fa-circle"></u> Divers Stock Report </a>
         </section>
         <div class="clear-both">x</div>
       </div>
       <hr>
       <div class="headPopReportContent">
         <section>
            <h3>Balance</h3>
              <a href="balance_report.php" class="a click"> <u class="fa fa-circle"></u> Balance Report </a>
            <br>
         </section>
         <section> &nbsp; </section>
         <div class="clear-both">x</div>
       </div>


         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
       </div>
    </div>
  </div>








<div class="main-containner">
<div class="containner">

<head>
  <div class="main-nav">
     <section class="logo-main-small"></section>

     <section class="buttons-main-link-contain">

          <button type="button" class="a-link-main main-search-button click" name="button"><b class="fa fa-search"></b></button>
          <!-- <button type="button" class="a-link-main user-b click user-view-pop-but" name="button"><b class="fa fa-user"></b></button> -->

          <!-- DESIGN CHECK  -->
          <a href="designcheck_pop.php" onclick="NewWindow(this.href,'name','400','600','yes');return false;">
            <button type="button" class="a-link-main user-b click" name="button"><b class="fa fa-check-square-o"></b></button>
          </a>

          <?php if(isAdmin()) {?>

          <a href="settings.php"><button type="button" class="a-link-main setting-b click" name="button"><b class="fa fa-cog"></b></button> </a>
          <a href="users.php" style="background:transparent;"> <button type="button" class="a-link-main user-b click" name="button"><b class="fa fa-group"></b></button> </a>
          <button type="button" class="a-link-main show-errors user-b click" title="Errors" name="button"><b class="fa fa-warning"></b></button>

          <?php } ?>

          <button type="button" class="a-link-main click" title="Conveter" name="button"  data-toggle="modal" data-target="#Conveter" onclick="return check()"><b class="fa fa-calculator"></b></button>

          <button type="button" class="a-link-main click" title="Expenses" name="button"  data-toggle="modal" data-target=".bs-example-modal-lg" onclick="return check()"><b class="fa fa-plus-circle"></b> </button>



          <a href="logout.php" style="background:transparent;"> <button type="button" class="a-link-main click" name="button"><b class="fa fa-lock"></b></button> </a>

     </section>

  </div><!-- .main-nav  -->
    <div class="sec-div-nav scroll">
    <h4>ANTARES LTD</h4>

    <section class="user-inf-hom">
      <img class="img-capt-home" style="max-width:110px;" src="<?php display_profile($user_id) ?>" alt="" />
      <!-- <section class="cont"> -->
        <h4 style="margin: 0px; color:rgb(236, 234, 234);"><?php echo @$username; ?></h4>
        <u class="u-type-label"><?php echo  @userType($user_type); ?></u>
    </section>

     <section class="sub-a">

      <button type="button" class="a actl main-search-button click"> <u class="fa fa-search"></u> Search </button>
      <a href="home.php" class="a actl click"> <u class="fa fa-tachometer"></u> Home </a>
      <a href="invitations.php" class="a actl click"> <u class="fa fa-shopping-cart"></u> Invitations </a>
      <a href="divers.php" class="a actl click"> <u class="fa fa-shopping-cart"></u> Divers </a>

      <a href="deposit.php" class="click"  type="button" class="btn btn-danger"> <u class="fa fa-file-text"></u> Deposit </a>

      <?php if(isAdmin()) { ?>
        <a href="maison.php" class="a click"> <u class="fa fa-home"></u> Maison  </a>
      <?php } ?>

       <a href="balance_view.php" class="a actl click"> <u class="fa fa-tag"></u> Balance </a>
       <a href="#" class="click"  type="button" class="btn btn-danger" data-toggle="modal" data-target="#Reports"> <u class="fa fa-file-text"></u> Reports</a>

     </section>

     <?php if (loggedin() && isSpecial()) { ?>
       <div class="dashboard_btn">
            <h2 class="fa fa-desktop"></h2>
            <a href="dashboard_remote.php">
            <button type="button" class="btn btn-success">Open Dashboard</button>
            </a>
       </div>
     <?php } ?>



    </div><!-- .sec-div-nav -->

    <div class="search-div">
    <section style="margin:auto;">
        <section class="btn" style="width: 48%; color: #fff;background:#5ca483;" onclick="return selectType('Invitation');" style="background:#5ca483;" id="Invitation">Invitation</section>
        <section class="btn" style="width: 48%; color: #fff;" onclick="return selectType('Divers');"  id="Divers">Divers</section>
    </section>

      <div class="input-group">
         <span class="input-group-addon"><i class="fa fa-search"></i></span>
         <form id="search" name="search" action="anotherpage.php">
         <input type="text" id="input_text" name="search_text" class="form-control" onkeyup="findmatch();" placeholder=" &nbsp;&nbsp; search">
      </div>
      <div class="buttons-div" id="buttons">
        </form>

        <section onclick="return searchStype('stock')" style="background:#5ca483;" id="stock">Stock</section>
        <section onclick="return searchStype('sell')"  id="sell">Sell</section>
        <div class="clear-both">x</div>
      </div>

     <div class="result-div-m">
       <div id="results"> </div><!-- the result div -->
     </div>

    </div>
</head>
