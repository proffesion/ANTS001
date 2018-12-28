<?php
include 'app_data/php/head.php';
secured();

$adminHomePage = 1; // enneble the javascript code for this page
?>
<head><link rel="stylesheet" href="app_data/css/chart_circle.css"></head>
<script src="app_data/java/charts/Chart.bundle.js"></script>
<script src="app_data/java/charts/utils.js"></script>
<style>
canvas{
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
}

.nav-pills>li>a {
    border-radius: 0px;
    color:#fff;
}
.nav-pills>li>a:hover {
    color:#333;
}

body {
  background-color: #e2e2e2;
}

table {
  box-shadow: none;
}
</style>





<div class="contents-div">
  <div class="contents-iframe" id="mainContentsDiv">

      <section class="header-div-sec">
        <h2> Dashboard </h2>
      </section>

    <div class="secton-contents-containner">

        <div class="dashboard_containner">

           <div class="admin_chart_containner">
               <div class="chart_contents">
                <div class="row" style="margin:0px;">
                    <div class="col-xs-12 col-md-8">

                        <div style="width:100%; padding-bottom: 15px;">
                        <canvas id="canvas" style=""></canvas>
                        </div>

                    </div><!-- .col-xs-12 col-md-8 -->

                    <div class="col-xs-6 col-md-4" style=" background: #f1f1f159; ">

                      <div id="dashboard_invit_div_perc"></div> <!-- dashboard_rate_sales_section -->

                    </div>
                </div>

               </div>
               <div class="sub_nav"><!-- the navigation div -->

               <ul class="nav nav-pills">


               <li role="presentation" class="dropdown">
                   <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                     <b class="fa fa-shopping-cart"></b> Sales <span class="caret"></span>
                   </a>
                   <ul class="dropdown-menu">
                     <li><a href="sell_view.php"> <b class="fa fa-circle"></b> Inviation </a></li>
                     <li><a href="sell_divers_view.php"> <b class="fa fa-circle"></b> Diver </a></li>
                   </ul>
               </li>


               <li role="presentation" class="dropdown">
                   <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                     <b class="fa fa-shopping-cart"></b> Stock <span class="caret"></span>
                   </a>
                   <ul class="dropdown-menu">
                     <li><a href="stock_list.php"> <b class="fa fa-circle"></b> Invitation </a></li>
                     <li><a href="products.php"> <b class="fa fa-circle"></b> Diver </a></li>
                   </ul>
               </li>



               <li role="presentation" class="dropdown">
                   <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                     Report <span class="caret"></span>
                   </a>
                   <ul class="dropdown-menu">
                     <li><a href="sell_report.php"> <b class="fa fa-circle"></b> Inviation Report </a></li>
                     <li><a href="stock_report.php"> <b class="fa fa-circle"></b> Invitation's Stock Report</a></li>
                     <li role="separator" class="divider"></li>
                     <li><a href="sellDivers_report.php"> <b class="fa fa-circle"></b> Divers Report </a></li>
                     <li><a href="DiversStock_report.php"> <b class="fa fa-circle"></b> Divers Stock's Report </a></li>
                   </ul>
               </li>


               <li role="presentation" class="dropdown">
                   <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                     Deposit Form <span class="caret"></span>
                   </a>
                   <ul class="dropdown-menu">
                     <li><a href="invitation_deposit_form.php"> <b class="fa fa-circle"></b> Inviation </a></li>
                     <li><a href="diver_deposit_form.php"> <b class="fa fa-circle"></b> Diver </a></li>
                   </ul>
               </li>

               <li role="presentation" >
                 <a href="balance_view.php"> <b class="fa fa-tag"></b> Balance </a>
               </li>

              <li role="presentation" >
                <a href="data_dashboard.php" target="_blank">
                  <b class="fa fa-line-chart"></b> Data Dashboard
                </a>
              </li>


              <li role="presentation" >
                <a href="insert_cash.php"> <b class="fa fa-tag"></b> Insert Cash </a>
              </li>

             </ul>

               </div><!-- the navigation div -->
           </div>

        </div><!-- .dashboard_containner -->



        <div class="row" style="margin:12px 0px 0px 0px;">
        <div class="col-xs-12 col-md-8">



           <div id="dashboard_money_total"></div> <!-- data data dashboard total -->


        </div><!-- .col-xs-12 .col-sm-6 .col-md-8 -->

        <div class="col-xs-6 col-md-4">

          <div id="dashboard_rate_sales_section"></div>

        </div><!-- .col-xs-6 .col-md-4 -->
      </div>






    </div><!-- .secton-contents-containner -->

  </div><!-- .contents-iframe -->

  <div class="">
    <div class="contents-iframe fadeIn animated search-conent-div" id="SearchResult">
      <section class="cancel-section-button">
        <button type="button" name="button" onclick="HideSearchDivContent()"> <b class="fa fa-arrow-left"></b> Back</button>
      </section>
      <div class="" id="iframeDispayDiv"></div>
    </div>
  </div>

</div><!-- .contents-div -->







</div><!-- .containner -->
</div><!-- .main-containner -->

<?php

$week_names = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

function week_days_number()
{
    global $time;
    $week_day = date('w', $time); // Important
    if ($week_day == '0') {
      //  return 7;
       return $week_day;

    } else {
       return $week_day;
    }
}

$week_days = week_days_number();

for ($i=$week_days; $i >=0 ; $i--) {
  $weck_mod_date = date('d', strtotime("-$i day")); // generating the date
  $loop_date = "$weck_mod_date-$this_month-$this_year"; // arrage the date in a good format

  $sum_day_total_inv = sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `selling_e` WHERE `date`='$loop_date'","Total_Available_Rw");
  $sum_day_total_diver = sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `divers_sales` WHERE `date`='$loop_date'","Total_Available_Rw");

  // Total week
  @$total_week_invitation += $sum_day_total_inv; //sum ofthe invitation
  @$total_week_Diver += @$sum_day_total_diver; // sum of diver
}

?>



<!-- second chart -->



<?php include 'app_data/php/foater.php' ?>

