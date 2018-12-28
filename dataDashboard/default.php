<?php include_once 'header_dashbard.php'; ?>
<!-- page id -->
<input type="hidden" id="pageId" readonly value="default">

<div class="main_screen">
    <div class="titleHead">
    <div class="row ">
        <div class="col-md-6">
            <img src="../app_data/imgs/icns/small-lolo-text.png" style="height:32px;" alt="ANTARES">
        </div>
        <div class="col-md-6" style="text-align:right;">
            PERIOD: <label id="periodLabel"></label>
        </div>
    </div>
    </div>

    <div class="row mainRowDefault" >
        <div class="col-md-8">
            <canvas id="canvas"></canvas>
            <div class="" id="canvasInfo"></div>
        </div>
        <div class="col-md-4">
            <br>
            <canvas id="canvasPie"></canvas>
        </div>
    </div>

    <div class="row dataSecondMainDashboard">
        <div class="col-md-6">
            <div class="contents">
                <h2 class="title">INVITATION &nbsp;&nbsp;  (<label id="invitationPerc">0</label>%)</h2>

                <div class="row">
                    <div class="col-md-4 subCash frwLabel">
                        <label>FRW</label>
                        <h3 id="I_frw">0</h3>
                    </div>
                    <div class="col-md-4 subCash subCenter dolLabel">
                        <label>$</label>
                        <h3 id="I_dol">0</h3>
                    </div>
                    <div class="col-md-4 subCash fcLabel">
                        <label>FCO</label>
                        <h3 id="I_fc">0</h3>
                    </div>
                </div>

                <div class="subTotalCash">
                    <label>FRW</label>
                    <h3 id="I_grand" style="colr: #bb114a;">0 Frw</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="contents">
                <h2 class="title" style="background:#04b11b;">DIVERS &nbsp;&nbsp; (<label id="diversPerc">0</label>%)</h2>

                <div class="row">
                    <div class="col-md-4 subCash frwLabel">
                        <label>FRW</label>
                        <h3 id="D_frw">0</h3>
                    </div>
                    <div class="col-md-4 subCash subCenter dolLabel">
                        <label>$</label>
                        <h3 id="D_dol">0</h3>
                    </div>
                    <div class="col-md-4 subCash fcLabel">
                        <label>FCO</label>
                        <h3 id="D_fc">0</h3>
                    </div>
                </div>

                <div class="subTotalCash">
                    <label>FRW</label>
                    <h3 id="D_grand" style="color: #017311;">0 Frw</h3>
                </div>
            </div>
        </div>
    </div>



    <div class="row dataSecondMainDashboard">
        <div class="col-md-5">
            <div class="contents">
                    <h2 class="title" style="background:#6326d0;">BALANCE &nbsp;&nbsp; (<label id="balancePerc">0</label>%)</h2>

                    <div class="row">
                        <div class="col-md-4 subCash frwLabel">
                            <label>FRW</label>
                            <h3 id="B_frw">0</h3>
                        </div>
                        <div class="col-md-4 subCash subCenter dolLabel">
                            <label>$</label>
                            <h3 id="B_dol">0</h3>
                        </div>
                        <div class="col-md-4 subCash fcLabel">
                            <label>FCO</label>
                            <h3 id="B_fc">0</h3>
                        </div>
                    </div>

                    <div class="subTotalCash">
                        <label>FRW</label>
                        <h3 id="B_grand" style="color: #6326d0;">10</h3>
                    </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="contents grandTotalLabel">
                <h2 class="title" style="background: #2196F3;">GRAND TOTAL</h2>

                <div class="row">
                    <div class="col-md-4 subCash frwLabel">
                        <label>FRW</label>
                        <h3 id="G_frw">0</h3>
                    </div>
                    <div class="col-md-4 subCash subCenter dolLabel">
                        <label>$</label>
                        <h3 id="G_dol">0</h3>
                    </div>
                    <div class="col-md-4 subCash fcLabel">
                        <label>FCO</label>
                        <h3 id="G_fc">0</h3>
                    </div>
                </div>

                <div class="subTotalCash">
                    <label>FRW</label>
                    <h3 id="G_grand" style="font-weight: 800;color: #1769ab;">0 Frw</h3>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- <input type="text" id="mainChartData" style="height:100px;"> -->

<input type="hidden" id="PieInvitation" value="0">
<input type="hidden" id="PieDivers" value="0">
<input type="hidden" id="PieBalance" value="0">


    <script src="../app_data/java/charts/Chart.bundle.js"></script>
    <script src="../app_data/java/charts/utils.js"></script>

    <script type="text/javascript" src="../app_data/java/jquery.min.js"></script>
    <script type="text/javascript" src="../app_data/java/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/dashboard.js"></script>
    <script>


// var invitationsData;
function mainChartDefault() {
    var type  =  document.getElementById('typeD').value;
    var year  =  document.getElementById('yearD').value;
    var month =  document.getElementById('monthD').value;

    document.getElementById('canvas').style.display     = 'block'; // make a canvas visible
    document.getElementById('canvasInfo').style.display = 'none'; // hide canvas info

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'data/defaultYear.php?type='+type+'&year='+year+'&month='+month, true);
    xhr.onload = function() {
        if(this.status == 200){
             var result = this.responseText;
             result = JSON.parse(result);
              // console.log(result);
              var labels;
              var invitationData;
              var DiversData;

if (result.type == 'month') {
    labels = [1,2,3,4,5,6,7,8,9,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
    invitationData = [
      result.invitation.day.i1,
      result.invitation.day.i2,
      result.invitation.day.i3,
      result.invitation.day.i4,
      result.invitation.day.i5,
      result.invitation.day.i6,
      result.invitation.day.i7,
      result.invitation.day.i8,
      result.invitation.day.i9,
      result.invitation.day.i10,
      result.invitation.day.i11,
      result.invitation.day.i12,
      result.invitation.day.i13,
      result.invitation.day.i14,
      result.invitation.day.i15,
      result.invitation.day.i16,
      result.invitation.day.i17,
      result.invitation.day.i18,
      result.invitation.day.i19,
      result.invitation.day.i20,
      result.invitation.day.i21,
      result.invitation.day.i22,
      result.invitation.day.i23,
      result.invitation.day.i24,
      result.invitation.day.i25,
      result.invitation.day.i26,
      result.invitation.day.i27,
      result.invitation.day.i28,
      result.invitation.day.i29,
      result.invitation.day.i30,
      result.invitation.day.i31
    ];
    DiversData = [
      result.divers.day.d1,
      result.divers.day.d2,
      result.divers.day.d3,
      result.divers.day.d4,
      result.divers.day.d5,
      result.divers.day.d6,
      result.divers.day.d7,
      result.divers.day.d8,
      result.divers.day.d9,
      result.divers.day.d10,
      result.divers.day.d11,
      result.divers.day.d12,
      result.divers.day.d13,
      result.divers.day.d14,
      result.divers.day.d15,
      result.divers.day.d16,
      result.divers.day.d17,
      result.divers.day.d18,
      result.divers.day.d19,
      result.divers.day.d20,
      result.divers.day.d21,
      result.divers.day.d22,
      result.divers.day.d23,
      result.divers.day.d24,
      result.divers.day.d25,
      result.divers.day.d26,
      result.divers.day.d27,
      result.divers.day.d28,
      result.divers.day.d29,
      result.divers.day.d30,
      result.divers.day.d31
    ];
} else {
   labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
   invitationData = [
     result.invitation.year.Jan,
     result.invitation.year.Feb,
     result.invitation.year.Mar,
     result.invitation.year.Apr,
     result.invitation.year.May,
     result.invitation.year.Jun,
     result.invitation.year.Jul,
     result.invitation.year.Aug,
     result.invitation.year.Sep,
     result.invitation.year.Oct,
     result.invitation.year.Nov,
     result.invitation.year.Dec
   ];
   DiversData     = [
     result.divers.year.Jan,
     result.divers.year.Feb,
     result.divers.year.Mar,
     result.divers.year.Apr,
     result.divers.year.May,
     result.divers.year.Jun,
     result.divers.year.Jul,
     result.divers.year.Aug,
     result.divers.year.Sep,
     result.divers.year.Oct,
     result.divers.year.Nov,
     result.divers.year.Dec
   ];
}

        // START A CHART
    var config = {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: "Invitation",
                backgroundColor: 'rgba(244,64,54,1)',
                borderColor: 'rgba(244,64,54,1)',
                data: invitationData,
                fill: false,
                borderWidth: 8
            }, {
                label: "Diver",
                backgroundColor: 'rgba(5,146,10,1)',
                borderColor: '#00a516',
                data: DiversData,
                borderWidth: 0,
                fill: false
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: result.title,
                fontSise: 12
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
                xAxes: [{
                    display: true,
                    barPercentage: 1,
                    categorySpacing:0,
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: false,
                        labelString: 'Value'
                    },
                    ticks: {
                        min: 0,
                        max: 100,

                        // forces step size to be 5 units
                        stepSize: 20
                    }
                }]
            }
        }
    };
    //
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx, config);

  } // eee
    }
    xhr.send();
}


    function allDefaultData() {
          var xhr = new XMLHttpRequest();
          var date = document.getElementById('allDefaultData_agr').value; // retrieve the date from the input hidden
          document.getElementById('periodLabel').innerText = date; // assign the date to the laber

          xhr.open('GET', 'data/allDefaultData.php?date='+date, true);
          xhr.onload = function() {
              if(this.status == 200) {
                  var result = this.responseText;
                  result = JSON.parse(result);
                  // console.log(result);

                  // INVITATION
                  document.getElementById('I_frw').innerHTML   = result.invitation.frw;
                  document.getElementById('I_fc').innerHTML    = result.invitation.fc;
                  document.getElementById('I_dol').innerHTML   = result.invitation.dol;
                  document.getElementById('I_grand').innerHTML = result.invitation.total;

                  // DIVERS
                  document.getElementById('D_frw').innerHTML   = result.divers.frw;
                  document.getElementById('D_fc').innerHTML    = result.divers.fc;
                  document.getElementById('D_dol').innerHTML   = result.divers.dol;
                  document.getElementById('D_grand').innerHTML = result.divers.total;

                  // BALANCE
                  document.getElementById('B_frw').innerHTML   = result.balance.frw;
                  document.getElementById('B_fc').innerHTML    = result.balance.fc;
                  document.getElementById('B_dol').innerHTML   = result.balance.dol;
                  document.getElementById('B_grand').innerHTML = result.balance.total;

                  // GRAND
                  document.getElementById('G_frw').innerHTML   = result.grand.frw;
                  document.getElementById('G_fc').innerHTML    = result.grand.fc;
                  document.getElementById('G_dol').innerHTML   = result.grand.dol;
                  document.getElementById('G_grand').innerHTML = result.grand.total;

                  document.getElementById('PieInvitation').value = result.pie.invitation;
                  document.getElementById('PieDivers').value     = result.pie.divers;
                  document.getElementById('PieBalance').value    = result.pie.balance;

                  document.getElementById('invitationPerc').innerText    = result.pie.invitation;
                  document.getElementById('diversPerc').innerText        = result.pie.divers;
                  document.getElementById('balancePerc').innerText       = result.pie.balance;


                  defaultPieChhart(); // pie chart

              }
          }
          xhr.send();
    }

    //////////////////////////////////////////////////////////////////////////////////



function defaultPieChhart() {
  var invitation = document.getElementById('PieInvitation').value;
  var divers     = document.getElementById('PieDivers').value;
  var balance    = document.getElementById('PieBalance').value;

  var type    = document.getElementById('typeD').value;
  var animDuration;
  if (type == 'day') {
    animDuration = 0;
  } else {
    animDuration = 1000;
  }


                var config = {
                type: 'pie',
                data: {
                    labels: ["Invitation", "Divers","Balance"],
                    datasets: [{
                        label: "Invitation",
                        backgroundColor:['#ff216c','#09de25','#782ffb'],
                        data: [invitation, divers, balance],
                        fill: false,
                        borderWidth:0
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                      duration: animDuration
                    },
                    title:{
                        display:false,
                        text:'ANTARES',
                        fontSise: 29
                    },
                    legend: {
                        display: false,
                        position: 'top'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: false,
                            scaleLabel: {
                                display: false,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: false,
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
            var ctx = document.getElementById("canvasPie").getContext("2d");
            window.myLine = new Chart(ctx, config);


  }


    /////////////////////////////////////////////////////////////////////////////////
    window.onload = function() {
    };
    </script>
    <?php include_once 'assets/redirect.php'; ?>
</body>
</html>
