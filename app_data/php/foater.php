
<div id="errorPopContainner" class="fixedAlert hide-print"></div><!-- this will be used to display error -->
<div id="checkSignate" class="fadeInUp animated"></div><!-- displa the alert for the signature -->


<script type="text/javascript" src="app_data/java/jquery.min.js"></script>
<script type="text/javascript" src="app_data/java/bootstrap.min.js"></script>


<script>
$(document).ready(function(e) {
         $.ajaxSetup({chache:false});
         $('#checkSignate').load('checkSigante.php');
         setInterval(function() {$('#checkSignate').load('checkSigante.php');}, 2000);
});
</script>



<?php

include_once 'spent_cash.php';
?>




<?php if (loggedin() && isAdmin()) { ?>

<div class="error-fixed-popup" id="error_check"></div> <!-- popup error -->

<?php } ?>


<script type="text/javascript" src="app_data/java/functions.js"></script>

    <script>

    var sendType;
    var TPtype;
    TPtype = 'Invitation'
    sendType = 'stock'

    // works with the (STOCK) , (SELL) buttons
    function searchStype(val) {
      // ste buttons to transparent
      document.getElementById('stock').style.background='transparent';
      document.getElementById('sell').style.background='transparent';
      var hol = val;

      document.getElementById(val).style.background='#5ca483'; // activated butoon

      if (val == '') {
        document.getElementById('stock').style.background='#5ca483';
        sendType = 'file';
      } else {
        sendType = val;
      }
       findmatch();
    }


    // works with the (STOCK) , (SELL) buttons
    function selectType(val) {
      // ste buttons to transparent
      document.getElementById('Invitation').style.background='transparent';
      document.getElementById('Divers').style.background='transparent';
      var hol = val;

      document.getElementById(val).style.background='#5ca483'; // activated butoon

      if (val == '') {
        document.getElementById('Invitation').style.background='#5ca483';
        TPtype = 'Invitation';
      } else {
        TPtype = val;
      }
       findmatch();
    }


    function findmatch() { // ajax for search
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
      }

    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById('results').innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.open('GET', 'search.inc.php?typ='+sendType+'&TP='+TPtype+'&search_text='+document.search.search_text.value, true);
    xmlhttp.send();
    }




   /////////////////////////////////////////////////////////////////////////////////////
   ///////////////////////////    CONVETER CALCULATOR    ///////////////////////////////
   /////////////////////////////////////////////////////////////////////////////////////
  function check() {

      var chang_typ = document.getElementById('chang_typ');
      var r_dol_r = <?php echo retrieve_data('rec_dol_rw','taux','id','1'); ?>;
      var r_dol_c = <?php echo retrieve_data('rec_dol_fc','taux','id','1'); ?>;

      // for giving
      var g_dol_r = <?php echo retrieve_data('giv_dol_rw','taux','id','1'); ?>;
      var g_dol_c = <?php echo retrieve_data('giv_dol_fc','taux','id','1'); ?>;

      var inRateFc = document.getElementById('inRateFc');
      var inRateRw = document.getElementById('inRateRw');

      var dol_r;
      var dol_c;

      var displayer = document.getElementById('div_displayer');

      var from_sel = document.getElementById('from_sel').value;
      var to_sel = document.getElementById('to_sel').value;

      // text box
      var from_sel_t = document.getElementById('from_t').value;
      var to_sel_t = document.getElementById('to_t').value;
      // ===================================


        if (chang_typ.value == 'r')
        {
          inRateRw.value = r_dol_r;
          inRateFc.value = r_dol_c;
        }
        else if (chang_typ.value == 'g')
        {
          inRateRw.value = g_dol_r;
          inRateFc.value = g_dol_c;
        }

      // assigning rate values to the main variables
      dol_r = inRateRw.value;
      dol_c = inRateFc.value;



      if (document.getElementById('from_t').value != "") // check if the change from is not empty
      {

          if (document.getElementById('from_sel').value == document.getElementById('to_sel').value)
          {
            alert('please chose the different values');
          }
          else if (from_sel == 'dol' && to_sel == 'fc')
          { // (1)
              document.getElementById('to_t').value = from_sel_t * dol_c;
          }
          else if (from_sel == 'dol' && to_sel == 'rw')
          { // (2)
              document.getElementById('to_t').value = from_sel_t * dol_r;
          }
          else if (from_sel == 'fc' && to_sel == 'dol')
          { // (3)
              document.getElementById('to_t').value = from_sel_t / dol_c;
          }
          else if (from_sel == 'fc' && to_sel == 'rw')
          { // (4)
              document.getElementById('to_t').value = (from_sel_t / dol_c) * dol_r;
          }
          else if (from_sel == 'rw' && to_sel == 'dol')
          { // (5)
            document.getElementById('to_t').value = from_sel_t / dol_r;
          }
          else if (from_sel == 'rw' && to_sel == 'fc')
          { // (6)
            document.getElementById('to_t').value = (from_sel_t / dol_r) * dol_c;
          }

      }


    }

    </script>




<!--
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// ADMIN HOMEPAGE //////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
 -->



<?php if($adminHomePage == 1) { ?>
  <script>

$(document).ready(function(e) {
         $.ajaxSetup({chache:false});
         $('#dashboard_money_total').load('dashboard_money_total.php');
         setInterval(function() {$('#dashboard_money_total').load('dashboard_money_total.php');}, 2000);
});

$(document).ready(function(e) {
         $.ajaxSetup({chache:false});
         $('#dashboard_rate_sales_section').load('dashboard_rate_sales_section.php');
         setInterval(function() {$('#dashboard_rate_sales_section').load('dashboard_rate_sales_section.php');}, 2000);
});

$(document).ready(function(e) {
         $.ajaxSetup({chache:false});
         $('#dashboard_invit_div_perc').load('dashboard_invit_div_perc.php');
         setInterval(function() {$('#dashboard_invit_div_perc').load('dashboard_invit_div_perc.php');}, 2000);
});


</script>
<script>
var MONTHS = [<?php for ($i=0; $i <= $week_days; $i++) { echo '"'.$week_names[$i].'"';  if ($i != $week_days) { echo ","; } } ?>];

var randomScalingFactor = function() {
    return Math.round(Math.random() * 100);
};

var config = {
    type: 'line',
    data: {
        labels: [<?php for ($i=0; $i <= $week_days; $i++) { echo '"'.$week_names[$i].'"';  if ($i != $week_days) { echo ","; } } ?>],
        datasets: [{
            label: "Invitation",
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [
            <?php
            // INVITATION
            for ($i=$week_days; $i >=0 ; $i--) {
              $weck_mod_date = date('d', strtotime("-$i day")); // generating the date
              $loop_date = "$weck_mod_date-$this_month-$this_year"; // arrage the date in a good format
              $sum_day_total_invt = sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `selling_e` WHERE `date`='$loop_date'","Total_Available_Rw");
              $day_perc_inv = @round(($sum_day_total_invt / $total_week_invitation) * 100); // put data in percantade
              if ($total_week_Diver > 0) {
              echo @$day_perc_inv; // print the data
            } else {
              echo 0;
            }
              if ($i != 0) { echo ","; } // put the comma
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
              // DIVER
              for ($i=$week_days; $i >=0 ; $i--) {
                $weck_mod_date = date('d', strtotime("-$i day")); // generating the date
                $loop_date = "$weck_mod_date-$this_month-$this_year"; // arrage the date in a good format
                $sum_day_total_divers = sum_Of_OneVal ("SELECT `Total_Available_Rw` FROM `divers_sales` WHERE `date`='$loop_date'","Total_Available_Rw"); // the value from the db
                $day_perc_div = @round(($sum_day_total_divers / $total_week_Diver) * 100); // Change the value in percentage
                 if ($total_week_Diver > 0) {
                   echo @$day_perc_div; // print the data
                 } else {
                   echo 0;
                 }
                if ($i != 0) { echo ","; } // put the comma
              }
              ?>
            ],
        }]
    },
    options: {
        responsive: true,
        title:{
            display:true,
            text:'Invitation & Divers'
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
                    labelString: 'Week'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Sales level'
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

window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx, config);
};
////////////////////////////////////////

</script>
<?php } ?>


<!-- Modal -->
<div id="balancePop" class="modal fade" role="dialog" style="z-index: 1111111111;">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header"> <b class="modal-title">BALANCE</b>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>

       <div class="modal-body modal-body-curent" id="modalBalanceContainner">
            <p>Loading...</p>
       </div>
       <div class="modal-footer">

       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
     </div>
  </div>
</div>
</div>



</body>
</html>
