<input type="hidden" id="dateD">
<input type="hidden" id="monthD">
<input type="hidden" id="yearD">
<input type="hidden" id="typeD">

<input type="hidden" id="allDefaultData_agr">
<script>

    function updateSettings() {

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'data/loadSettings.php', true);
        xhr.onload = function() {
            if(this.status == 200){
                var settings = this.responseText;
                settings = JSON.parse(settings);


                // CHECH THE RIGHT MONITOR
                var page = document.getElementById('pageId').value;
                if (settings.active != page) {
                    window.open(settings.active+'.php','_self');
                }


                var auto_dayData;
                // default data loader
                if (settings.active == 'default') {
                    if (document.getElementById('typeD').value != settings.period.type || document.getElementById('dateD').value != settings.period.d || document.getElementById('monthD').value != settings.period.m || document.getElementById('yearD').value != settings.period.y) {
                        // console.log('date changed!');
                        // console.log(settings);
                        // console.log(settings.period.type);
                        document.getElementById('typeD').value  = settings.period.type;
                        document.getElementById('dateD').value  = settings.period.d;
                        document.getElementById('monthD').value = settings.period.m;
                        document.getElementById('yearD').value  = settings.period.y;


                        if (document.getElementById('typeD').value == 'month') {
                              document.getElementById('allDefaultData_agr').value = document.getElementById('monthD').value+'-'+document.getElementById('yearD').value;
                              mainChartDefault();  // line and bar chart
                              allDefaultData(); // load the wole data
                              // defaultPieChhart(); // pie chart

                              // clearTimeout(auto_dayData);
                              auto_dayData = "";

                        } else if (document.getElementById('typeD').value == 'year') {
                              document.getElementById('allDefaultData_agr').value = '-'+document.getElementById('yearD').value;
                              mainChartDefault();
                              allDefaultData(); // load the wole data
                              // defaultPieChhart(); // pie chart

                        } else if (document.getElementById('typeD').value == 'day') {
                              document.getElementById('canvas').style.display     = 'none';
                              document.getElementById('canvasInfo').style.display = 'block';
                              document.getElementById('allDefaultData_agr').value = document.getElementById('dateD').value+'-'+document.getElementById('monthD').value+'-'+document.getElementById('yearD').value;

                              setInterval(function() {
                                  if (document.getElementById('typeD').value == 'day') {
                                    defaultChartChanger();
                                    allDefaultData();
                                  }
                              }, 2000);

                              // defaultPieChhart(); // pie chart

                        }



                    }
                }
















                // default data loader
                if (settings.active == 'balance') {
                    if (document.getElementById('typeD').value != settings.period.type || document.getElementById('dateD').value != settings.period.d || document.getElementById('monthD').value != settings.period.m || document.getElementById('yearD').value != settings.period.y) {
                        // console.log('date changed!');
                        // console.log(settings);
                        // console.log(settings.period.type);
                        document.getElementById('typeD').value  = settings.period.type;
                        document.getElementById('dateD').value  = settings.period.d;
                        document.getElementById('monthD').value = settings.period.m;
                        document.getElementById('yearD').value  = settings.period.y;


                        BalanceDataLoad();
                        // setInterval(function() {
                        //   if (document.getElementById('typeD').value == 'day') {
                        //     defaultChartChanger();
                        //     allDefaultData();
                        //   }
                        // }, 2000);



                    }
                }












                // CHECH THE LOCK SCREEN
                if (settings.lock == 'on') {
                  $('.lockScreen').removeClass('hide'); $('.lockScreen').addClass('show'); // show loading
                } else {
                  $('.lockScreen').addClass('hide'); $('.lockScreen').removeClass('show'); // hide - cancer button
                }
                // =================================================================================================
                // CHECH THE FRW LABEL
                if (settings.cash.frw == 'on') {
                  $('.frwLabel').removeClass('hide'); $('.frwLabel').addClass('show'); // show loading
                } else {
                  $('.frwLabel').addClass('hide'); $('.frwLabel').removeClass('show'); // hide - cancer button
                }

                // CHECH THE DOL LABEL
                if (settings.cash.dol == 'on') {
                  $('.dolLabel').removeClass('hide'); $('.dolLabel').addClass('show'); // show loading
                } else {
                  $('.dolLabel').addClass('hide'); $('.dolLabel').removeClass('show'); // hide - cancer button
                }

                // CHECH THE FC LABEL
                if (settings.cash.fc == 'on') {
                  $('.fcLabel').removeClass('hide'); $('.fcLabel').addClass('show'); // show loading
                } else {
                  $('.fcLabel').addClass('hide'); $('.fcLabel').removeClass('show'); // hide - cancer button
                }

                // CHECH THE FC LABEL
                if (settings.cash.subTotal == 'on') {
                  $('.subTotalCash').removeClass('hide'); $('.subTotalCash').addClass('show'); // show loading
                } else {
                  $('.subTotalCash').addClass('hide'); $('.subTotalCash').removeClass('show'); // hide - cancer button
                }

                // CHECH THE FC LABEL
                if (settings.cash.grandTotal == 'on') {
                  $('.grandTotalLabel').removeClass('hide'); $('.grandTotalLabel').addClass('show'); // show loading
                } else {
                  $('.grandTotalLabel').addClass('hide'); $('.grandTotalLabel').removeClass('show'); // hide - cancer button
                }
            }
        }
        xhr.send();
    }





    //// this will cahnge the canvas to the dairly sell
    function defaultChartChanger() {
        var day  =  document.getElementById('dateD').value;
        var year  =  document.getElementById('yearD').value;
        var month =  document.getElementById('monthD').value;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'data/loadDayDefault.php?day='+day+'&month='+month+'&year='+year, true);
            xhr.onload = function() {
              if(this.status == 200){
                result = this.responseText;
                document.getElementById("canvasInfo").innerHTML = result;
              }
            }
            xhr.send();
    }





    updateSettings();

    $(document).ready(function(e) {
      $.ajaxSetup({chache:false});
        setInterval(updateSettings, 1000);
    });

</script>
