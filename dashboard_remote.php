<?php
include 'app_data/php/head.php';
secured();
admin_page();
special_page();
?>
<!-- contents start here -->


<div class="contents-div">
<div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">
<!-- contents goes here -->

<section class="header-div-sec">
    <h2> Settings </h2>
    <section class="clear-both">x</section>
</section>






  <div class="row" style="margin:0px;">
      <div class="col-xs-7" style="max-height: 87vh;overflow: auto;">

<!-- http://localhost/dashboard_remote.php -->

        <div class="containned_dashboard_contents">
          <h2 class="fa fa-desktop"></h2>
          <p>
            Lauanch the data dashboard  <br>
            bt Clicking on the button below
           </p>

           <a href="http://192.168.1.2/dataDashboard/default.php" onclick="NewWindow(this.href,'name','1265','1005','yes');return false;">
                     <button type="button" class="btn btn-lg btn success">Launch Dashboard</button>
           </a>
        </div>

        <div class="containned_dashboard_contents" style="padding-top: 5px;">

          <h2 class="fa fa-mobile"></h2>
          <h3>Control The dashboard with your smart phone</h3>
          <p>
            <ul style=" text-align: left; padding-top: 4px; display: block; margin: auto; width: fit-content;">
              <li>Connect your <b>Smart Phone</b> on the Network (WIFI) </li>
              <li> Open your <b>Browser</b> <i>(<u>Opera</u> is recomended)</i> </li>
              <li> Scan the <b>Qr Code</b> using your Browser, and Enjoy </li>
            </ul>
          <br>
            <img src="app_data/imgs/dashboard_link.png" alt="192.168.1.2/dataDashboard/remote.php" style="width: 236px; margin:auto" class="responsive thumbnail">
          </p>
        </div>





<br>



      </div>
      <div class="col-xs-5" style="text-align: center;">
<br>
        <iframe src="dataDashboard\remote.php" width="414px" height="84" class="iframeRemote"></iframe>

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

<style media="screen">
  body {
    background: #333333 !important;
  }
</style>
<?php include 'app_data/php/foater.php' ?>
