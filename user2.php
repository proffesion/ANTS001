<?php
include 'app_data/php/head.php';
secured();
?>
<!-- contents start here -->


<div class="contents-div">
<div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">
<!-- contents goes here -->
<div class="user-list-containner-div">
vvvvv
</div>
<div class="user-details-containner-div">
dddddd
</div>



<div class="clear-both">x</div>

</div><!-- .contents-div -->

<div class="">
  <div class="contents-iframe slideInDown animated search-conent-div" id="SearchResult">
      <section class="cancel-section-button">
        <button type="button" name="button" onclick="HideSearchDivContent()"> <b class="fa fa-arrow-left"></b> Back</button>
      </section>
      <div class="" id="iframeDispayDiv"></div>
  </div>
</div>



</div><!-- .containner -->
</div><!-- .main-containner -->

<style media="screen">

.user-list-containner-div {
  float: left;
  width: 200px;height: 200px;
  background: #333;
}
.user-details-containner-div {
  float: left;
  width: :300px; height: 300px;
  background: green;
}

</style>

<?php include 'app_data/php/foater.php' ?>
