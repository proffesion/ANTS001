<?php
include 'app_data/php/head.php';
secured();

if (isset($_GET['erD'])) { ?>
    <div class="alert alert-success alert-dismissible alert-fixed bounceInDown animated" style="margin-bottom: 0;z-index: 1;width: 240px;opacity: 0.9;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <b class=" fa fa-check"></b> &nbsp; Error Deleted!
    </div>
<?php } ?>

  <script src="app_data/java/jquery-1.9.0.min.js"></script>
  <script>

  $(document).ready(function(e) {
           $.ajaxSetup({chache:false});
           $('#hm_content_view').load('hm_content.php');
          //  setInterval(function() {$('#hm_content_view').load('hm_content.php');}, 2000);
  });
  </script>
<!-- contents start here -->

<div class="contents-div">
  <section style="background: #4f5263;background-image: url(app_data/imgs/0.jpg);background-size: cover;">

<div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">

  <div class="" id="hm_content_view"></div>

</div><!-- .contents-div -->

  </section>

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
