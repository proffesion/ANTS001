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

  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>




      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>




<div class="error-dv-nw">
    <table class="error-table-nw">
      <tr>
        <td>
          <h2>Oooops !!</h2>
          <h3>No data Found</h3>
          <p> Lorem ipsum dolor sit amet,
          <br> consectetur adipisicing elit,
          <br> sed do eiusmod tempor incididunt ut
          </p>

          <button type="button" class="btn btn-primary">Large button</button
        </td>
        <td>
          <h1 class="fa fa-file-o"></h1>
        </td>
      </tr>
    </table>
</div>








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
