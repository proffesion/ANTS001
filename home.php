<?php
include 'app_data/php/head.php';
secured();

if (isAdmin()) {
  echo "<script>window.open('home_admin.php','_self')</script>";
}


if (isset($_GET['erD'])) { ?>
    <div class="alert alert-success alert-dismissible alert-fixed bounceInDown animated" style="margin-bottom: 0;z-index: 1;width: 240px;opacity: 0.9;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <b class=" fa fa-check"></b> &nbsp; Error Deleted!
    </div>
<?php } ?>

  <script src="app_data/java/jquery-1.9.0.min.js"></script>
  <script>

  $(document).ready(function(e) {
          //  $.ajaxSetup({chache:false});
          //  $('#hm_content_view').load('hm_content.php');
          //  setInterval(function() {$('#hm_content_view').load('hm_content.php');}, 2000);
  });



  var win = null;
  function NewWindow(mypage,myname,w,h,scroll){
  LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
  TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
  settings =
  'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
  win = window.open(mypage,myname,settings)
  win.focus()
  }
  </script>
<!-- contents start here -->


<div class="contents-div">
<div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">

        <div style="background: #cd1b46; box-shadow: inset 0px 0px 71px 0px rgba(0, 0, 0, 0.41);overflow:hidden;">
            <nav class="navbar navbar-default fadeInDown animated" style="background: transparent; border: 0px; margin: 0px;z-index:11111111111111111;">
              <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="#">Brand</a> -->
              </div >
              <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <!-- <ul class="nav navbar-nav">
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
                  </ul> -->



                  <ul class="nav navbar-nav navbar-right">
                    <!-- <li>
                      <a href="user_checker.php" onclick="NewWindow(this.href,'name','300','600','yes');return false;"> popup (extended mode)</a>
                    </li> -->
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <b class="fa fa-file-text"></b> Report <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="sell_report.php"> <u class="fa fa-circle"></u> Inviation Report </a></li>
                        <li><a href="stock_report.php"> <u class="fa fa-circle"></u> Invitation's Stock Report</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="sellDivers_report.php"> <u class="fa fa-circle"></u> Divers Report </a></li>
                        <li><a href="DiversStock_report.php"> <u class="fa fa-circle"></u> Divers Stock's Report </a></li>
                      </ul>
                    </li>
                  </ul>
                </div ><!-- /.navbar-collapse -->
              </div ><!-- /.container-fluid -->
            </nav>




<div class="row row-main-home fadeInUp animated">
<div class="col-md-6" style="text-align:center;">
  <img src="app_data/imgs/antares-moc.png" style="max-width: 700px;width:70%;">
</div>
<div class="col-md-6 contents-home-head">
  <h1>ANTARES</h1>
  <p>Companny LTD</p>


</div>
</div >
  </div> <!-- head containner -->





<div style=" overflow: hidden; ">
<div class="buttons-containner-home fadeIn animated">
<!-- ================================================================================================================== -->

        <!-- <a href="#"> -->
             <section class="buttons-item-home click main-search-button">
               <h1 class="fa fa-search"></h1>
               <h2>Search</h2>
               <p>Invitation or Sell</p>
             </section>
        <!-- </a> -->

        <a href="sell_view.php">
             <section class="buttons-item-home click">
               <h1 class="fa fa-shopping-cart"></h1>
               <h2>Sell's</h2>
               <p>Invitation</p>
             </section>
        </a>


        <a href="stock_report.php">
             <section class="buttons-item-home click">
               <h1 class="fa fa-cube"></h1>
               <h2>Stock</h2>
               <p>Invitation</p>
             </section>
        </a>

        <a href="balance_view.php?&bal_type=Invitation&search=">
             <section class="buttons-item-home click">
               <h1 class="fa fa-tag"></h1>
               <h2>Balance</h2>
               <p>Invitation</p>
             </section>
        </a>

        <a href="invitation_deposit_form.php">
             <section class="buttons-item-home click">
               <h1 class="fa fa-server"></h1>
               <h2>Deposit Form</h2>
               <p>Invitation</p>
             </section>
        </a>

      <!-- ========================================== -->

      <a href="data_dashboard.php" class="admin" target="_blank">
           <section class="buttons-item-home click">
             <h1 class="fa fa-line-chart"></h1>
             <h2>Data dashboard</h2>
             <!-- <p>Invitation & Divers</p> -->
           </section>
      </a>


      <a href="sell_divers_view.php">
           <section class="buttons-item-home click">
             <h1 class="fa fa-shopping-cart"></h1>
             <h2>Sale's</h2>
             <p>Diver</p>
           </section>
      </a>


      <a href="DiversStock_report.php">
           <section class="buttons-item-home click">
             <h1 class="fa fa-cube"></h1>
             <h2>Stock</h2>
             <p>Diver</p>
           </section>
      </a>

      <a href="products.php">
           <section class="buttons-item-home click">
             <h1 class="fa fa-cubes"></h1>
             <h2>Products</h2>
             <p>Diver</p>
           </section>
      </a>


      <a href="diver_deposit_form.php">
           <section class="buttons-item-home click">
             <h1 class="fa fa-server"></h1>
             <h2>Deposit Form</h2>
             <p>Divers</p>
           </section>
      </a>







<div class="" style="clear:both;font-size:0px;">
cc
</div>
<!-- ================================================================================================================== -->
</div>
</div>



<style>
.row-main-home {
    margin: 0px;
    padding-top: 4%;
    padding-bottom: 15px;
}

.contents-home-head h1 {
    font-size: 54px;
    color: #fff;
    padding-top: 33px;
}

.contents-home-head p {
    font-size: 29px;
    color: #fff;
}

.buttons-containner-home {
    width: 98%;
    max-width: 900px;
    margin: auto;
    margin-top: 26px;
}

.buttons-item-home {
  background: #d2d2d2;
  margin: 0.8%;
  padding: 1.5% 2%;
  border-radius: 5px;
  width: 18%;
  float: left;
  text-align: center;
  box-shadow: inset 0px 0px 24px rgba(0, 0, 0, 0.51);
  min-width: 152px;
}

.buttons-item-home h1 {
    margin: 0px;
    font-size: 37px;
    background: #c81a44;
    padding: 13px;
    border-radius: 999999px;
    margin-bottom: 8px;
    color: #fff;
  }

.buttons-item-home h2 {
  margin: 0px;
  font-size: 20px;

}
.buttons-item-home p {
  margin: 0px;

}

.navbar-default .navbar-nav>li>a {
    color: #fff;
}

.dropdown-menu u {
  text-decoration: none;
  padding-right: 5px;
}


.buttons-containner-home a {
  color: #000;
}
</style>



<!--   <section style="background: #4f5263;background-image: url(app_data/imgs/0.jpg);background-size: cover;">
      <div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">
          <div class="" id="hm_content_view"></div>
  </section> -->

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
