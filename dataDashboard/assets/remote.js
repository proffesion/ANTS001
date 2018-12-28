
    var settings = '';

    function loadSettings() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'data/loadSettings.php', true);
        xhr.onload = function() {
            if(this.status == 200){
                var result = this.responseText;
                settings = JSON.parse(result);
                // console.log(result);
                if (document.getElementById('SettingsRemote').value != result) {
                      document.getElementById('SettingsRemote').value = result;

                      document.getElementById('datePeriod').innerText = settings.period.d+'-'+settings.period.m+'-'+settings.period.y+'    ('+settings.period.type+')';
                      console.log(settings);

                      // reset dashboard buttons
                      $('.dashboard-stock').removeClass('active');
                      $('.dashboard-balance').removeClass('active');
                      $('.dashboard-default').removeClass('active');

                      // reset dashboard buttons
                      $('.btnPeriodDay').removeClass('active');
                      $('.btnPeriodMonth').removeClass('active');
                      $('.btnPeriodYear').removeClass('active');

                      if (settings.period.type == "day") {
                            $('.btnPeriodDay').addClass('active');
                            $('.btnPeriodMonth').addClass('active');
                            $('.btnPeriodYear').addClass('active');

                      } else if (settings.period.type == "month") {
                            $('.btnPeriodMonth').addClass('active');
                            $('.btnPeriodYear').addClass('active');

                      } else if (settings.period.type == "year") {
                            $('.btnPeriodYear').addClass('active');
                      }

                      // WORK WITH THE DASHBOARD
                      if (settings.active == "default") {
                          $('.dashboard-default').addClass('active');
                      } else if (settings.active == "stock") {
                          $('.dashboard-stock').addClass('active');
                      } else if (settings.active == "balance") {
                          $('.dashboard-balance').addClass('active');
                      }

                      // POWER BUTTON
                      if (settings.lock != "on") {
                          $('.powerBtn').addClass('active');
                      } else {
                          $('.powerBtn').removeClass('active');
                      }


                      // LABEL FRW
                      if (settings.cash.frw == "on") {
                          $('.btnLabel_Frw').addClass('active');
                      } else {
                          $('.btnLabel_Frw').removeClass('active');
                      }

                      // LABEL FC
                      if (settings.cash.fc == "on") {
                          $('.btnLabel_Fc').addClass('active');
                      } else {
                          $('.btnLabel_Fc').removeClass('active');
                      }

                      // LABEL DOL
                      if (settings.cash.dol == "on") {
                          $('.btnLabel_Dol').addClass('active');
                      } else {
                          $('.btnLabel_Dol').removeClass('active');
                      }

                      // LABEL FC
                      if (settings.cash.subTotal == "on") {
                          $('.btnLabel_SubTotal').addClass('active');
                      } else {
                          $('.btnLabel_SubTotal').removeClass('active');
                      }

                      // LABEL FC
                      if (settings.cash.grandTotal == "on") {
                          $('.btnLabel_GrandTotal').addClass('active');
                      } else {
                          $('.btnLabel_GrandTotal').removeClass('active');
                      }
                      // powerBtn dateLabel
                      // console.log('something changed');
                }


            }
        }
        xhr.send();
    }


function update(type, value = 0) {

    var options = JSON.parse(document.getElementById('SettingsRemote').value);

    if (type == 'lock') { // powerBtn
        // check the data
        if (options.lock == "on") {
          DBupdate('lock','off');
        } else {
          DBupdate('lock','on');
        }

    } else if(type == 'active') { // fot the monitors
       DBupdate(type, value);

    } else if(type == 'period') { // for the period
      DBupdate(type, value);
 // ###########################################################################
 // #############################  CASH LABELS ################################
 // ###########################################################################
    // Fc
    } else if (type == 'fc') {
        if (options.cash.fc == "on") {
          DBupdate('fc','off');
        } else {
          DBupdate('fc','on');
        }
    // dolars
    } else if (type == 'dol') {
        if (options.cash.dol == "on") {
          DBupdate('dol','off');
        } else {
          DBupdate('dol','on');
        }
    // Frw
    } else if (type == 'frw') {
        if (options.cash.frw == "on") {
          DBupdate('frw','off');
        } else {
          DBupdate('frw','on');
        }

    // sub total
    } else if (type == 'subTotal') {
        if (options.cash.subTotal == "on") {
          DBupdate('subTotal','off');
        } else {
          DBupdate('subTotal','on');
        }

    // sub total
    } else if (type == 'grandTotal') {
        if (options.cash.grandTotal == "on") {
          DBupdate('grandTotal','off');
          console.log('grand onn');
        } else {
          DBupdate('grandTotal','on');
          console.log('grand off');

        }
    }

  }


const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]

function setDate(val) {
  var date = new Date(val);
  // console.log('/'+date);
  // console.log('Month: '+monthNames[date.getMonth()]);
  // console.log('Year: '+date.getFullYear());
  // console.log('Date: '+date.getDate());

  DBupdate('d',date.getDate());
  DBupdate('m',monthNames[date.getMonth()]);
  DBupdate('y',date.getFullYear());

}






function DBupdate(type, value = 0) {

      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'data/updateSettings.php?'+type+'='+value, true);
      xhr.onload = function() {
          if(this.status == 200){
              var result = this.responseText;
              // settings = JSON.parse(result);
              // console.log(settings);
              // console.log(result);
              loadSettings();
          }
      }
      xhr.send();
}
