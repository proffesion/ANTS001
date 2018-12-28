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
            <b id="datePeriod" >Loading...</b>
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
                <h2 id="labTotal">0 Frw</h2>
              </section>

              <section style="background: #04b11b;">
                <label>TOTAL PAYED</label>
                <h2 id="labPayed">0 <i>Frw</i></h2>
              </section>

              <section style="background: #f44036;">
                <label>TOTAL BALANCE</label>
                <h2 id="labUnpayed">0 Frw</h2>
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

        <div class="col-md-6">
            <div class="contents">
              <h2 class="title" style="background:#4caf50;">Invitation</h2>
              <section class="contentPadding">

                  <label class="labp">TOTAL BALANCE</label>
                  <b class="labB" id="I_total">0 fRW</b>
                <hr class="hrB">
                <br>
                  <label class="labp">TOTAL PAYED</label>
                  <b class="labB" id="I_payed">0 fRW</b>
                <hr class="hrB">
                <br>
                  <label class="labp">TOTAL UNPAYED</label>
                  <b class="labB" id="I_Unpayed" style="color:red;">0 fRW</b>

              </section>
            </div>
        </div>




        <div class="col-md-6">
            <div class="contents">
              <h2 class="title" style="background:#03988a;">Divers</h2>
              <section class="contentPadding">

                  <label class="labp">TOTAL BALANCE</label>
                  <b class="labB" id="D_total">125,461,256.00 fRW</b>
                <hr class="hrB">
                <br>
                  <label class="labp">TOTAL PAYED</label>
                  <b class="labB" id="D_payed">125,461,256.00 fRW</b>
                <hr class="hrB">
                <br>
                  <label class="labp">TOTAL UNPAYED</label>
                  <b class="labB" id="D_Unpayed" style="color:red;">125,461,256.00 fRW</b>

              </section>
            </div>
        </div>
        <!-- <div class="col-md-3">
            <div class="contents">
              <p class="statrArrow">
                <i class="fa fa-caret-up" style="color: #37c337;"></i>
              </p>
              <h2 class="arrowTitle">Increasing</h2>
              <hr>
              <h4 class="DifferenceTitle">Difference</h4>
              <h3 class="differenceNumber">123,125,133.22 Frw</h3>
            </div>
        </div> -->

    </div>



</div>



<style>
.hrB {
  margin: 2px;
}

.labp {
  font-size: 20px;
      display: block;
}
.labB {
  font-size: 36px;
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


    //// this will cahnge the canvas to the dairly sell
    function BalanceDataLoad() {
        var type  =  document.getElementById('typeD').value;
        var day   =  document.getElementById('dateD').value;
        var year  =  document.getElementById('yearD').value;
        var month =  document.getElementById('monthD').value;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'data/loadBalance.php?period='+type+'&day='+day+'&month='+month+'&year='+year, true);
            xhr.onload = function() {
              if(this.status == 200){
                var data = this.responseText;
                data = JSON.parse(data);

                document.getElementById('datePeriod').innerText = data.date;

                document.getElementById('labTotal').innerText   = data.total +' Frw';
                document.getElementById('labPayed').innerText   = data.payed +' Frw';
                document.getElementById('labUnpayed').innerText   = data.unpayed +' Frw';

                document.getElementById('I_Unpayed').innerText  = data.invitation.unpayed +' Frw';
                document.getElementById('I_payed').innerText    = data.invitation.payed +' Frw';
                document.getElementById('I_total').innerText    = data.invitation.total +' Frw';

                document.getElementById('D_Unpayed').innerText  = data.divers.unpayed +' Frw';
                document.getElementById('D_payed').innerText    = data.divers.payed +' Frw';
                document.getElementById('D_total').innerText    = data.divers.total +' Frw';

                // chart Pie


                    var config = {
                        type: 'doughnut',
                        data: {
                            labels: ['INVITATION ('+data.pie.invitation+'%)', 'DIVERS ('+data.pie.divers+'%)'],
                            datasets:  [{
                                label: "Invitation",
                                backgroundColor: ['#4caf50','#03988a'],
                                data: [data.pie.invitation,data.pie.divers],
                                fill: false
                            }]
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'ANTARES',
                                fontSise: 49
                            },
                            tooltips: {
                                mode: 'index',
                                intersect: false,
                            },
                            hover: {
                                mode: 'nearest',
                                intersect: true
                            },
                            scales: {
                                xAxes: [{ display: false}],
                                yAxes: [{ display: false,
                                    scaleLabel: {
                                        display: false,
                                        labelString: 'Value'
                                    },
                                    ticks: {
                                        min: 0,
                                        max: 100,
                                        // forces step size to be 5 units
                                        stepSize: 5
                                    }
                                }]
                            }
                        }
                    };
                    //
                    var ctx = document.getElementById('canvasPie').getContext("2d");
                    window.myLine = new Chart(ctx, config);


                ///////////
              }
            }
            xhr.send();
    }



    window.onload = function() {
    // var ctx = document.getElementById("canvas").getContext("2d");
    // window.myLine = new Chart(ctx, config);
    // monthSells("canvas");
    // monthSellsPie("canvasPie");
    BalanceDataLoad();
    // balancePie("canvasPie");
    // BalanceBarChart("BalanceBarChart");

    };
    </script>
    <?php include_once 'assets/redirect.php'; ?>

</body>
</html>
