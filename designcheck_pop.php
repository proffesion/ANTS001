<?php
include 'app_data/php/head_blank.php';
secured();
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <u class="navbar-brand" href="#">
        <img alt="" src="app_data/imgs/icns/web_logo.png" style="width: 21px;transform: scale(1.2);">
      </u>

      <b class="navbar-brand"><?php echo @$username; ?></b>

    </div>
  </div>
</nav>

<div class="cont-itm">



  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Invitation</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Divers</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
      <div class="list-group" id="designcheck_pop_invitation"></div>
    </div>

    <div role="tabpanel" class="tab-pane" id="profile">
      <div class="list-group" id="designcheck_pop_diver"></div>
    </div>
  </div>








</div>
<style media="screen">
body {
  background: #fff;
}
.list-group section:nth-child(odd) {
  background: #4caf500a;
}

  .list-group-item-text {
    color: #444444;
  }

  .list-group-item:hover {
    background: #dfffe1;
  }

  .cont-itm {
    margin: 8px;
  }

  .list-group {
    margin: 10px;
  }

  .list-group-item-heading {
    font-size: 16px;
    font-weight: bold;
    color: #9c9c9c;
  }
</style>



<div>



</div>


<script>

$(document).ready(function(e) {
         $.ajaxSetup({chache:false});
         $('#designcheck_pop_invitation').load('designcheck_pop_invitation.php');
         setInterval(function() {$('#designcheck_pop_invitation').load('designcheck_pop_invitation.php');}, 2000);
});

$(document).ready(function(e) {
         $.ajaxSetup({chache:false});
         $('#designcheck_pop_diver').load('designcheck_pop_diver.php');
         setInterval(function() {$('#designcheck_pop_diver').load('designcheck_pop_diver.php');}, 2000);
});




</script>
