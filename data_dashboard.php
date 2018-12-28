<?php
include 'app_data/php/head_blank.php';
secured();
?>

<script src="app_data/java/charts/Chart.bundle.js"></script>
<script src="app_data/java/charts/utils.js"></script>
<style>
canvas{
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
}
</style>

<!-- ============================================================================================================== -->





<style media="screen">
  .month-item {
      background: rgba(3, 169, 244, 0.48);
      width: 8.3%;
      float: left;
      margin: 0.01%;
      border-right: 1px solid #fff;
      text-align: center;
      padding: 11px 0px;
      box-shadow: inset 0px 0px 14px 0px rgba(0, 0, 0, 0.33);
  }

  .months-containner {
      width: 90%;
      margin: auto;
      border: 1px solid green;
  }

.badge {
 text-shadow: 0px 0px 1px rgba(0, 0, 0, 0.74);padding: 5px 8px; font-size: 15px; margin-top: -2px;
}

.report-header {
    text-align: center;
    background: #a21553;
    margin: 0;
    color: #fff;
    padding: 18px;
}
</style>


<?php

$total_diver_month = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `divers_sales` WHERE `date` LIKE '%$this_year%'",'Total_Available_Rw');
$total_Invitation_month = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `selling_e` WHERE `date` LIKE '%$this_year%'",'Total_Available_Rw');

// echo $total_Invitation_month;

// $query = 'SELECT `Total_Available_Rw` FROM `selling_e` WHERE `date` LIKE '%$dt%' ORDER BY `s_id` DESC';

// echo Summ_data("SELECT SUM(`quantity`) FROM `selling_e` WHERE `date`='$time_now'",'quantity');
$dt = "Jul-$this_year";
// echo Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `selling_e` WHERE `date` LIKE '%$dt%'",'Total_Available_Rw');

// echo "<hr>";
// echo $this_year;
$month_count = date('m', strtotime('-1 month'));


// echo "<hr>";

$months_number =  date('m', $time); // Important


// echo $month_count;
// echo "<hr>";
//
// for ($i=1; $i <= $months_number; $i++) {
//   $period_date = date('M', mktime(0, 0, 0, $i, 1, $this_year));
//   echo $period_date;
//   echo ",";
// }

// echo "<br>";

// for ($i=1; $i <= $months_number; $i++) {
//   $period_date = date('M', mktime(0, 0, 0, $i, 1, $this_year));
//   $dti = "$period_date-$this_year";
//   $tot_diver_sell_month = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `divers_sales` WHERE `date` LIKE '%$dti%'",'Total_Available_Rw');
//   @$sell_percent_d = @round(($tot_diver_sell_month / $total_diver_month) * 100);
//   echo $sell_percent_d;
//   echo ",";
// }

// echo "<br>Invitation:";

// for ($i=1; $i <= $months_number; $i++) {
//   $period_date = date('M', mktime(0, 0, 0, $i, 1, $this_year));
//   $dti = "$period_date-$this_year";
//   $tot_invit_sell_month = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `selling_e` WHERE `date` LIKE '%$dti%'",'Total_Available_Rw');
//   @$sell_percent = @round(($tot_invit_sell_month / $total_Invitation_month) * 100);
//   echo $sell_percent;
//   echo ",";
// }

?>
















<!-- =================================================================================================================== -->

<div class="containner-div" style="">


<div style="text-align:center;" class="report-header">
  <h1>ANTARES</h1>
  <p>
    ANTARES ACTIVITY
  </p>
</div>



<div class="row" style="margin:0px;">
  <div class="col-xs-12 col-md-12">

    <canvas id="canvas" style="width:100%;"></canvas>

  </div>
  <div class="col-xs-6 col-md-62">
    <ul class="list-group">
    <?php

    for ($i=1; $i <= $months_number; $i++) {
      $period_date = date('M', mktime(0, 0, 0, $i, 1, $this_year));
      $dti = "$period_date-$this_year";

      $tot_invit_sell_month = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `selling_e` WHERE `date` LIKE '%$dti%'",'Total_Available_Rw');
      @$sell_percent = @round(($tot_invit_sell_month / $total_Invitation_month) * 100);

      $tot_diver_sell_month = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `divers_sales` WHERE `date` LIKE '%$dti%'",'Total_Available_Rw');
      @$sell_percent_d = @round(($tot_diver_sell_month / $total_diver_month) * 100);
    ?>

    <li class="list-group-item">
      <span class="badge" style="background: #36a2eb;" title="Diver"><?php echo @toFixed($tot_diver_sell_month); ?> Frw</span>
      <span class="badge" style="background: #ff6384;" title="Invitation"><?php echo @toFixed($tot_invit_sell_month); ?> Frw</span>
      <b><?php echo @$period_date; ?></b>
    </li>

    <?php } ?>
    </ul>

    <br>
    <ul>
      <li class="list-group-item">
        <span class="badge" style="background: #36a2eb;" title="Diver"><?php echo @$total_diver_month; ?> Frw</span>
        <span class="badge" style="background: #ff6384;" title="Invitation"><?php echo @$total_Invitation_month; ?> Frw</span>
        <b>Total</b>
      </li>
    </ul>

  </div>
</div>






<hr>
<?php
for ($i=1; $i <= $months_number; $i++) {
  $period_date = date('M', mktime(0, 0, 0, $i, 1, $this_year));
  $dti = "$period_date-$this_year";
  $tot_invit_sell_month = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `selling_e` WHERE `date` LIKE '%$dti%'",'Total_Available_Rw');
  @$sell_percent = @round(($tot_invit_sell_month / $total_Invitation_month) * 100);
  echo $sell_percent;
  echo ",";
}
 ?>
<hr>
<!-- </div> -->


<!-- <br>
<br>
<button id="randomizeData">Randomize Data</button>
<button id="addDataset">Add Dataset</button>
<button id="removeDataset">Remove Dataset</button>
<button id="addData">Add Data</button>
<button id="removeData">Remove Data</button> -->
<script>
    var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var config = {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: "Invitation",
                backgroundColor: window.chartColors.red,
                borderColor: window.chartColors.red,
                data: [
                  <?php
                  for ($i=1; $i <= $months_number; $i++) {
                    $period_date = date('M', mktime(0, 0, 0, $i, 1, $this_year));
                    $dti = "$period_date-$this_year";
                    $tot_invit_sell_month = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `selling_e` WHERE `date` LIKE '%$dti%'",'Total_Available_Rw');
                    @$sell_percent = @round(($tot_invit_sell_month / $total_Invitation_month) * 100);
                    echo $sell_percent;
                    echo ",";
                  }
                   ?>

                ],
                fill: false,
            }, {
                label: "Diver",
                fill: false,
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                data: [
                  <?php
                  for ($i=1; $i <= $months_number; $i++) {
                    $period_date = date('M', mktime(0, 0, 0, $i, 1, $this_year));
                    $dti = "$period_date-$this_year";
                    $tot_diver_sell_month = Summ_data("SELECT SUM(`Total_Available_Rw`) FROM `divers_sales` WHERE `date` LIKE '%$dti%'",'Total_Available_Rw');
                    @$sell_percent_d = @round(($tot_diver_sell_month / $total_diver_month) * 100);
                    echo $sell_percent_d;
                    echo ",";
                  }
                   ?>

                ],
            }]
        },
        options: {
            responsive: true,
            title:{
                display:true,
                text:'ANTARES'
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
                    scaleLabel: {
                        display: true,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
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
    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myLine = new Chart(ctx, config);
    };

    // document.getElementById('randomizeData').addEventListener('click', function() {
    //     config.data.datasets.forEach(function(dataset) {
    //         dataset.data = dataset.data.map(function() {
    //             return randomScalingFactor();
    //         });
    //     });
    //
    //     window.myLine.update();
    // });

    // var colorNames = Object.keys(window.chartColors);
    // document.getElementById('addDataset').addEventListener('click', function() {
    //     var colorName = colorNames[config.data.datasets.length % colorNames.length];
    //     var newColor = window.chartColors[colorName];
    //     var newDataset = {
    //         label: 'Dataset ' + config.data.datasets.length,
    //         backgroundColor: newColor,
    //         borderColor: newColor,
    //         data: [],
    //         fill: false
    //     };
    //
    //     for (var index = 0; index < config.data.labels.length; ++index) {
    //         newDataset.data.push(randomScalingFactor());
    //     }
    //
    //     config.data.datasets.push(newDataset);
    //     window.myLine.update();
    // });

    // document.getElementById('addData').addEventListener('click', function() {
    //     if (config.data.datasets.length > 0) {
    //         var month = MONTHS[config.data.labels.length % MONTHS.length];
    //         config.data.labels.push(month);
    //
    //         config.data.datasets.forEach(function(dataset) {
    //             dataset.data.push(randomScalingFactor());
    //         });
    //
    //         window.myLine.update();
    //     }
    // });

    // document.getElementById('removeDataset').addEventListener('click', function() {
    //     config.data.datasets.splice(0, 1);
    //     window.myLine.update();
    // });

    // document.getElementById('removeData').addEventListener('click', function() {
    //     config.data.labels.splice(-1, 1); // remove the label first
    //
    //     config.data.datasets.forEach(function(dataset, datasetIndex) {
    //         dataset.data.pop();
    //     });
    //
    //     window.myLine.update();
    // });

</script>

<!-- <h1>hello</h1> -->


</div> <!-- end of containner -->



<?php include 'app_data/php/foater.php' ?>
<script type="">

          // var rC = document.getElementById('rateCo').value;
          // var rR = document.getElementById('rateRw').value;
          // var puD = document.getElementById('priceUnitD').value;
          // // inetr a value in 'priceUnitFc' price unite congolee
          // var puFcong = change_rate_receive(rR, rC, 'dol', 'fc', puD);
          // document.getElementById('priceUnitFc').value = puFcong.toFixed(2);

</script>
