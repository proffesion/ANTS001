<?php include_once 'header_dashbard.php'; ?>
<!-- page id -->
<input type="hidden" id="pageId" readonly value="balance">


<div class="main_screen">
    <div class="titleHead">
        <div class="row ">
            <div class="col-md-6">
                <img src="../app_data/imgs/icns/small-lolo-text.png" style="height:32px;" alt="ANTARES">
            </div>
            <div class="col-md-6" style="text-align:right;">
                YEAR: <b>2018</b>
            </div>
        </div>
    </div>




    <div class="row mainRowDefault">
    <div class="col-xs-7 col-md-7">
        <div class="contents bal" style="padding: 21px 0px 0px 18px;">
            <h1 class="title-head">BALANCE</h1>
            <div class="balance_Cash">
              <section style="background: #2196F3;">
                <label>TOTAL BALANCE</label>
                <h2>1234 Frw</h2>
              </section>

              <section style="background: #04b11b;">
                <label>TOTAL BALANCE</label>
                <h2>123,254,235.22 <i>Frw</i></h2>
              </section>

              <section style="background: #f44036;">
                <label>TOTAL BALANCE</label>
                <h2>1234 Frw</h2>
              </section>
            </div>
        </div>
    </div>
    <div class="col-xs-5 col-md-5">
        <div class="contents">
            <canvas id="canvasPie"></canvas>
        </div>
    </div>
    </div>



    <div class="row dataSecondMainDashboard">

        <div class="col-md-9">
            <div class="contents">
              <h2 class="title" style=" font-size: 59px; padding: 11px 34px; background:red;">Invitation</h2>
              <section class="contentPadding">

                <p>
                  <label>TOTAL BALANCE</label> <b>125,461,256.00 fRW</b>
                </p> <hr>
                <p>
                  <label>TOTAL PAYED</label> <b>125,461,256.00 fRW</b>
                </p> <hr>
                <p>
                  <label>TOTAL UNPAYED</label> <b>125,461,256.00 fRW</b>
                </p>
              </section>
            </div>
        </div>


        <div class="col-md-3">
            <div class="contents">
              <p class="statrArrow">
                <i class="fa fa-caret-up" style="color: #37c337;"></i>
              </p>
              <h2 class="arrowTitle">Increasing</h2>
              <hr>
              <h4 class="DifferenceTitle">Difference</h4>
              <h3 class="differenceNumber">123,125,133.22 Frw</h3>
            </div>
        </div>

    </div>



</div>



<style>
.contentPadding {
  padding: 23px 21px;

}
.contentPadding h2 {
    color: #2b2b2b;
    font-size: 46px;
    text-transform: uppercase;
    margin-bottom: 16px;
    margin-top: 10px;
}
.contentPadding p {
  font-size: 38px;
  margin: 7px 7px;
}
.contentPadding hr {
  margin: 0;
}
.contentPadding p label {
      width: 350px;
}
.contentPadding p b {
    font-size: 49px;
}

.differenceNumber {
    text-align: center;
    font-size: 34px;
    margin-top: 20px;
    font-weight: bold;
    color: #2b942b;
}
.DifferenceTitle {
    text-align: center;
    font-size: 33px;
    text-transform: uppercase;
    color: #2196f3;
}
.statrArrow {
    text-align: center;
}
.statrArrow i {
     color: #37c337;
     font-size: 281px;
     margin-top: -82px;
 }

.dataSecondMainDashboard .contents {
      width: 100%;
      height: 394px !important;
}

.arrowTitle {
    text-transform: uppercase;
    font-weight: bold;
    text-align: center;
    margin-top: -55px;
    font-size: 34px;
    color: #04b11b;
}

.balance_Cash {
    border: 3px solid #000;
    border-radius: 13px;
    overflow: hidden;
}
.balance_Cash section {
    background: #ddd;
    border-bottom: 3px solid;
    padding: 13px 0px 8px 12px;
    text-shadow: 0px 2px 7px #000;
}
.balance_Cash section label {
    font-size: 24px;
    font-weight: bold;
    text-transform: uppercase;
    color: #fff;
}
.balance_Cash section h2 {
  margin: 0px;
  padding: 0px;
  font-size: 57px;
  color: #fff;
}

.balance_Cash section label i {
    font-size: 42px;
    display: inline;
}
/* .balance_Cash {} */
h1.title-head {
    font-size: 63px;
    font-weight: bold;
    color: #f44036;
    margin-bottom: 9px;
}

.contents {
    height: auto !important;
}

.row.mainRowDefault {
    height: auto !important;
    padding: 11px 0px 24px 0px;
}
</style>

    <script src="../app_data/java/charts/Chart.bundle.js"></script>
    <script src="../app_data/java/charts/utils.js"></script>

    <script type="text/javascript" src="../app_data/java/jquery.min.js"></script>
    <script type="text/javascript" src="../app_data/java/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/dashboard.js"></script>
    <script>


    window.onload = function() {
    // var ctx = document.getElementById("canvas").getContext("2d");
    // window.myLine = new Chart(ctx, config);
    // monthSells("canvas");
    // monthSellsPie("canvasPie");
    balancePie("canvasPie");
    // BalanceBarChart("BalanceBarChart");

    };
    </script>
    <?php include_once 'assets/redirect.php'; ?>

</body>
</html>
