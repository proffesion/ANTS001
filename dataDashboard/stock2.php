<?php include_once 'header_dashbard.php'; ?>
<!-- page id -->
<input type="hidden" id="pageId" readonly value="stock">


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
    <div class="col-xs-4 col-md-4">
        <div class="contents bal" style="padding: 21px 0px 0px 18px;">
            <h1 class="title-head">STOCK</h1>
            <div class="balance_Cash">
              <section style="background: #2196F3;">
                <label> BALANCE</label>
                <h2>1234 </h2>
              </section>

              <section style="background: #04b11b;">
                <label> BALANCE</label>
                <h2>123.22</h2>
              </section>

              <section style="background: #f44036;">
                <label> BALANCE</label>
                <h2>1234 </h2>
              </section>
            </div>
        </div>
    </div>
    <div class="col-xs-5 col-md-5">
        <div class="contents">
            <canvas id="canvasPie"></canvas>
        </div>
    </div>

    <div class="col-xs-3 col-md-3">
        <div class="contents bal" style="">
          <h3 style="font-size: 36px; text-align: center; background: #ff216c; padding: 18px 10px; margin: 0; border-radius: 3px 9px 0px 0px; color: #fff;">TOP SOLD INVITATION</h3>
          <section> <b>1789</b> Beige </section>
          <section> <b>1789</b> Beige </section>
          <section> <b>1789</b> Beige </section>
        </div>
      </div>
    </div>



    <div class="row dataSecondMainDashboard">

        <div class="col-md-12">
            <div class="contents">
                <canvas id="BalanceBarChart"></canvas>
            </div>
        </div>
    </div>




</div>



<style>

#BalanceBarChart {
  height: 373px !important;
}

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
    BalanceYear("BalanceBarChart");

    };
    </script>
    <?php include_once 'assets/redirect.php'; ?>

</body>
</html>
