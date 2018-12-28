<?php
include_once 'app_data/php/head_blank.php';
secured();

if (isset($_GET['date']) && !empty($_GET['date'])) {
  $date = @$_GET['date'];
}
?>

<div class="containnerCov">


  <div class="row covRow">
    <div class="col-xs-2 controller" >
        <div class="containn">
          <img src="app_data\imgs\icns\antares_black.png" style="width: 160px;" alt="">

          <br>
          <br>
          <a href="home.php" style="font-size: 18px;"> <b class="fa fa-chevron-circle-left"></b> Back Home</a>

          <section class="colmn big">
              <div class="form-group">
                  <label for="">date</label>

                  <section id="getDateContainner" style="margin-bottom: -59px;">
                    <input type="text" class="form-control" value="<?php echo @$date; ?>" id="dateGet" readonly>
                    <a href="deposit.php">
                       <button type="button" class="btn btn-primary btn-sm">Choose date</button>
                    </a>
                  </section>

                  <section id="selectDateContainner">
                  <select name="day" class="form-control" onchange="return check_exist();" id="date_d"  style="width:24%;float:left">
                    <option value="<?php echo @$today; ?>"><?php echo @$today; ?></option>
                    <optgroup>
                        <?php
                          for ($i= 1; $i <= 31; $i++) {
                            if ($i <= 9) { $comp = "0"; } else { $comp = ""; }
                            echo "<option value='$comp$i'>$comp$i </option>";
                          }
                        ?>
                    </optgroup>
                </select>
                  <select name="month" class="form-control" onchange="return check_exist();" id="date_m" style="width:40%;float:left">
                      <option value="<?php echo @$this_month; ?>"><?php echo @$this_month; ?></option>
                      <optgroup>
                          <option value="Jan">January</option>
                          <option value="Feb">Febuary</option>
                          <option value="Mar">March</option>
                          <option value="Apr">April</option>
                          <option value="May">May</option>
                          <option value="Jun">June</option>
                          <option value="Jul">July</option>
                          <option value="Aug">August</option>
                          <option value="Sep">September</option>
                          <option value="Oct">October</option>
                          <option value="Nov">November</option>
                          <option value="Dec">December</option>
                      </optgroup>
                  </select>
                  <select name="year" class="form-control" onchange="return check_exist();" id="date_y" style="width:35%;float:left">
                    <option value="<?php echo @$this_year; ?>"><?php echo @$this_year; ?></option>
                      <optgroup>
                          <?php
                            for ($i= 2010; $i <= $this_year; $i++) {
                              echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          ?>
                      </optgroup>
                  </select>
                  </section>
              </div>
            </section>

            <section class="colmn big">
                <div class="form-group" style="padding-top: 29px; font-size: 18px;">
                </div>
            </section>

<style>
  .noInvitation, .noInvitationBallance, .noDiversSell, .noDiversBallance { display:none; }
</style>

            <section class="">
                  <div class="list-group header">

                    <label for="">Invitation</label>
                      <section class="noInvitation errorNot"> No Sale’s Found!</section>
                      <a href="#invitationSell" class="list-group-item scroll invitationSellMainButton">Invitation Sells      <b onclick="return printDoc('invitationSell');" title="Print this Document" id="invitationSellButton" class="print-button "><i class="fa fa-print"></i></b> </a>

                      <section class="noInvitationBallance errorNot"> No Ballance Found! </section>
                      <a href="#invitationBalance" class="list-group-item scroll invitationBallanceMainButton">Invitation Balance <b onclick="return printDoc('invitationBalance');" title="Print this Document" id="invitationBalanceButton" class="print-button "><i class="fa fa-print"></i></b> </a>

                      <label for="">Divers</label>

                      <section class="noDiversSell errorNot"> No Sale’s Found! </section>
                      <a href="#diversSell" class="list-group-item scroll diversSellMainButton">Divers Sells              <b onclick="return printDoc('diversSell');" title="Print this Document" id="diversSellButton" class="print-button "><i class="fa fa-print"></i></b> </a>

                      <section class="noDiversBallance errorNot"> No Ballance Found! </section>
                      <a href="#diversBalance" class="list-group-item scroll diversBalanceMainButton">Divers Balance         <b onclick="return printDoc('diversBalance');" title="Print this Document" id="diversBalanceButton" class="print-button "><i class="fa fa-print"></i></b> </a>
                      <br>
                      <a href="#decitionPrint" class="list-group-item scroll decitionPrintBtn">Decission              <b onclick="return printDoc('decitionPrint');" title="Print this Document" id="decitionPrintButton" class="print-button "><i class="fa fa-print"></i></b> </a>

                    <br>
                    <button type="button" class="btn btn-info showAllButton">Show all</button>
                  </div>
            </section>


        </div>

    </div>


    <div class="col-xs-10 contentsPrint">

      <!-- THIS WILL BE USEED BY JS TO DISPLAY THE INVITATION DATA -->
        <div id="invitationSell" class="paper"> </div>
        <div id="invitationBalance" class="paper"> </div>



      <!-- THIS WILL BE USEED BY JS TO DISPLAY THE DIVERS DATA -->
        <div id="diversSell" class="paper"> </div>
        <div id="diversBalance" class="paper"> </div>





      <!-- THIS WILL BE USEED BY JS TO DISPLAY THE DECISSION DATA -->
      <section>
            <div id="decitionPrint" class="paper fadeIn animated">
              <div class="head_div" style="padding: 4px 7px 12px 0px; border-bottom: 2px solid #333; margin-bottom: 18px;">

                <div class="row">
                    <div class="col-xs-8" style="text-align:left;"> <img src="app_data\imgs\icns\antares_black.png" alt="ANTARES" style="width: 200px;"> </div>
                    <div class="col-xs-4" style="text-align:right;">
                        <h4 style="margin: 0px; padding: 0px;">Date: <b id="depositDate"></b></h4>
                        <small>Printed on:  <?php echo $today_date; ?></small> </div>
                    </div>
                </div>


          <div class="row">
            <div class="col-xs-9" id="decissionData">

            </div><!-- .col-xs-8 -->







                <div class="col-xs-3 identificationArea">

              <table class="table table-bordered" style="margin-top: 0px;">
                          <tbody>
                            <!-- <tr> <th>  Total Expenses </th> </tr> -->
                          <tr>
                            <td> Rate: <b>
                            <?php echo @money(retrieve_data('rec_dol_rw', 'taux', 'id', '1')); ?>Frw
                              *
                            <?php echo @money(retrieve_data('rec_dol_fc', 'taux', 'id', '1')); ?>Fco
                          </b></td>
                          </tr>
                          <tr>
                            <td> <small>Hand cash recorded on:</small> <br>
                            <b id="handCashDate"></b>
                          </td>
                          </tr>
                        </tbody></table>

                      <section class="checkedBy">
                              <label for="">Printed by</label>
                              <select name="" id="">
                                <?php
                                $printedBy = @retrieve_data('fname', 'users', 'user_id', $user_id) . ' ' . retrieve_data('lname', 'users', 'user_id', $user_id);;
                                ?>
                                <option value=""><?php echo $printedBy; ?></option>
                              </select>
                      </section>

                  <div class="checkedByContainer">
                    <h4 style=" margin-bottom: 13px; font-weight: 100; opacity: 0.4;">CHECKEED BY</h4>
                      <section class="checkedBy">
                              <select name="" onchange="return setUserToSign(this.value, 'check1');" id="checkedBySelectOne"></select>
                              <div id="checkedBySignatureOne" class="signature">Signature</div>
                      </section>

                      <!-- CHECKED BY 2 -->
                      <section  id="" class="checkedBy checkedBy2Section">
                              <select name="" id="checkedBySelectTwo" onchange="return  setUserToSign(this.value, 'check2');"></select>
                              <div id="checkedBySignatureTwo" class="signature">Signature</div>
                      </section>
                      </div>
                      <section class="approved by">
                            <label for="">Aproved By:</label>
                            <select id="approvedBySelect" onchange="return  setUserToSign(this.value, 'aprovedBy');" ></select>
                            <div id="AprovedBySignature" class="signature">Signature</div>
                      </section>

                </div>
              </div>





    </div>
      </section>






      <div id="stateDecision"></div>


     <!-- //////////////////////////////////// DATA SUGNATE //////////////////////////////// -->
  <div id="SignateDataContent" class="hide-print">
<div class="row signator-containner">
    <div id="alertDisplayDiv"></div>
<br><br>
</div>
<div class="row signator-containner">


        <div class="col-md-6">
        <section>
          <p>User</p>
          <h3><?php echo $fnamel.'  '. $lnamel; ?></h3>
          <br>
        </section>

        <section>
            <p>Sign as</p>
            <h2 id="signAs"></h2>
        </section>

        </div>
        <div class="col-md-6">


          <fieldset>
            <div class="form-group">
              <label for="">Enter Password</label>
              <input type="password" id="SignPassword" class="form-control" placeholder=" Password ">
            </div>

            <div class="form-group">
              <label for="">Signator Code</label>
              <input type="password" id="SignCode"  class="form-control" placeholder=" Signature Code ">
              <input type="hidden" id="sign_type_Box">
            </div>


            <button type="button" onclick="return Signate();" class="btn btn-primary">Add Signature</button>
          </fieldset>
        </div>
  </div>
</div>
     <!-- /////////////////////////////////////////////////////////////////////////////////                        -->


<!-- // THIS WILL BE SHOWN IF THERE IS NO RESULTS -->
<div class="jumbotron nothingFoundDiv hide-print" style="text-align:center;border-radius: 10px;box-shadow: 0px 45px 47px -44px #333333bf; display:none;">
        <h1 class="shake animated fa fa-frown-o" style="font-size: 237px; margin-bottom: 9px; font-weight: normal; text-shadow: none; color: #14141442;"></h1>
        <p class="lead" style=" margin-bottom: 0px;"> No <span class="label label-default">Hand Cash</span> found for <b id="dateLabel"></b> </p>
        <p class=""> Decission Can't be made. </p>
        <p><a class="btn btn-lg btn-success" href="insert_cash.php" role="button">Add hand Cash</a></p>
</div>


  </div><!-- end of main contents -->
    </div>
  </div>


</div>


<div id="errorPopContainner" class="fixedAlert hide-print"></div><!-- this will be used to display error -->




<link rel="stylesheet" href="app_data/css/depositStyle.css">

<script type="text/javascript" src="app_data/java/jquery.min.js"></script>
<script type="text/javascript" src="app_data/java/bootstrap.min.js"></script>
<script type="text/javascript" src="app_data/java/functions.js"></script>
<script>
var dateG = '';
    $(document).ready(function() {
        var scrollLink = $('.scroll');

        // Smoth scrolling
        scrollLink.click(function(e) {
            e.preventDefault();
            $('body,html').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);

            $('.site-nav').removeClass('site--nav--open');
            $('.menu-toggle').toggleClass('open');
        });

        // active link switching
        $(window).scroll(function() {
            var scrollbarLocation = $(this).scrollTop();
            scrollLink.each(function() {
                var sectionOffset = $(this.hash).offset().top;
                if (sectionOffset <= (scrollbarLocation + 2)) {
                    $(this).addClass('active');
                    $(this).siblings().removeClass('active');
                }
            });

            if ($(window).scrollTop()) {
                $('.header').addClass('scroll-header');
            } else {
                $('.header').removeClass('scroll-header');
            }
        })

    });


    $('.showAllButton').on('click', function search_div() {
      // display all papers
      $('#decitionPrint').show();
      $('#diversSell').show();
      $('#diversBalance').show();
      $('#invitationBalance').show();
      $('#invitationSell').show();

      $('.showAllButton').hide();
    });



    /////////////////////////////////////////////////////////////////////////////////////
    // define variables to be used in checking:
    // if there is a sign place found
    var UserHaveSignature = 0;

    // chec the type of  the  signature
    var UserSignatureType = 0;
    var allSigned         = 0;
    var NothingFound      = 0;






function check_exist() {
  $('.date-display').addClass('date-changed');

  var date_d       = document.getElementById('date_d').value;
  var date_m       = document.getElementById('date_m').value;
  var date_y       = document.getElementById('date_y').value;

  // form a date in its format
  var dateSelected = date_d+'-'+date_m+'-'+date_y; // date variable
  var dateGet      = document.getElementById('dateGet').value;

  if (dateGet != '') { // get the date is from the link
    date = dateGet; // get date from the link
    document.getElementById('selectDateContainner').style.display = 'none'; // style - hide the form to select
  } else {
    date = dateSelected; // set the date from the select <>
    document.getElementById('getDateContainner').style.display = 'none'; // hide the form for the link
  }

  /////////////////////////////////////////////////////////
  if (date != "") {
      dateG = date;

      // displa date on the labels
      document.getElementById('dateLabel').innerHTML = dateG;
      document.getElementById('depositDate').innerHTML = dateG;

      // CHECK FOUND
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'checkFound.php?date='+date, true);

      xhr.onload = function() {
          if(this.status == 200){
              var found = this.responseText;
              found = JSON.parse(found);

              // INVITATION SELL
              if (found.invitation.sell) {
                  invitationDataSell(date); // if found load them

                  $('#invitationSell').show(); // show the containner
                  $('.invitationSellMainButton').addClass('show'); // show the button

                } else {
                  $('#invitationSell').hide(); // hide the containner
                  $('.invitationSellMainButton').removeClass('show'); //
                  $('.invitationSellMainButton').hide(); // hide the button
              }


              // INVITATION BALANCE
              if (found.invitation.balance) {
                  invitationDataBalance(date); // if found load them

                  $('#invitationBalance').show(); // show the containner
                  $('.invitationBallanceMainButton').addClass('show'); // show the button
                } else {
                  $('#invitationBalance').hide(); // hide the containner
                  $('.invitationBallanceMainButton').removeClass('show'); // show the button
                  $('.invitationBallanceMainButton').hide(); // hide the button
              }


              // DIVERS SELL
              if (found.divers.sell) {
                  diversDataSell(date); // if found load them

                  $('#diversSell').show(); // show the containner
                  $('.diversSellMainButton').addClass('show'); // show the button
              } else {
                  $('#diversSell').hide(); // hide the containner
                  $('.diversSellMainButton').removeClass('show'); // show the button
                  $('.diversSellMainButton').hide(); // hide the button
              }



              // DIVERS SELL
              if (found.divers.balance) {
                  diversDataBalance(date); // if found load them

                  $('#diversBalance').show(); // show the containner
                  $('.diversBalanceMainButton').addClass('show'); // show the button
              } else {
                  $('#diversBalance').hide(); // hide the containner
                  $('.diversBalanceMainButton').removeClass('show'); // remove the show class
                  $('.diversBalanceMainButton').hide(); // hide the button

              }


              // DEPOSIT DECISSION
              if (found.deposit) {
                  decissionData(date); // if found load them
                  load_selected();     // load the user who must sign
                  checkToSign(); // check if there is some signature to sign

                  $('#decitionPrint').show(); // show the containner
                  $('.decitionPrintBtn').addClass('show'); // show the button
                  // load the printed date hand cash
                  document.getElementById('handCashDate').innerHTML = found.handCashDate;
              } else {
                  $('#decitionPrint').hide(); // hide the containner
                  $('.decitionPrintBtn').removeClass('show'); // remove the show class
                  $('.decitionPrintBtn').hide(); // hide the button

              }

              // IF THERE IS NO DATA FOUD AT ALL
              if (found.deposit == 0 && found.divers.balance == 0 && found.divers.sell == 0 && found.invitation.balance == 0 && found.invitation.sell == 0) {
                  $('.nothingFoundDiv').show(); // hide the containner
                  NothingFound = 1; // if nothing found
              } else {
                  $('.nothingFoundDiv').hide(); // hide the containner
                  NothingFound = 0; // if something found
              }



// console.log(found);


          }
      }
      xhr.send();

      // load_selected();

  } else {
        errorShow('please Select a date');
  }

}

////////////////////////////////////////////////////////////////////////////////
function printDoc(val) {
  // hide all papers
  $('#decitionPrint').hide();
  $('#diversSell').hide();
  $('#diversBalance').hide();
  $('#invitationBalance').hide();
  $('#invitationSell').hide();

  // display only the selected
  $('#'+val).show();
  document.getElementById(val+'Button').style.opacity = 0.6; // reduce the opacity of a clicked button

  // display the show all button
  $('.showAllButton').show();
  var DocTitle;
  //  -  -  -  -
  // alert(date);

  if (val == 'decitionPrint') {
        DocTitle = date+'   DEPOSIT';
  } else if (val == 'invitationSell') {
        DocTitle = date+'   INVITATION SELL';
  } else if (val == 'invitationBalance') {
        DocTitle = date+'   INVITATION BALANCE';
  } else if (val == 'diversSell') {
        DocTitle = date+'   DIVERS SELL';
  } else if (val == 'diversBalance') {
        DocTitle = date+'   DIVERS BALANCE';
  }
  document.title = DocTitle;
  return print(); // Print document
}
////////////////////////////////////////////////////////////////////////////////

check_exist();

// LOAD INVITATION SELL
function invitationDataSell(date) {
    var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "depositInvitationSellAJX.php";  // the file to look for the data
      var vars = "date="+date;
      request.open("POST", url, true);

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("invitationSell").innerHTML = return_data;

        }
      }
      // Send the data to PHP now... and wait for response to update the invitationData div
      request.send(vars); // Actually execute the request
      document.getElementById("invitationSell").innerHTML = loaderDisplay();

}

// INVITATION BALANCE
function invitationDataBalance(date) {
    var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "depositInvitationBalanceAJX.php";  // the file to look for the data
      var vars = "date="+date;
      request.open("POST", url, true);

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("invitationBalance").innerHTML = return_data;

        }
      }
      // Send the data to PHP now... and wait for response to update the invitationData div
      request.send(vars); // Actually execute the request
      document.getElementById("invitationBalance").innerHTML = loaderDisplay();

}




// DIVERS SELL
function diversDataSell(date) {
    var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "depositDiversSellAJX.php";  // the file to look for the data

      var vars = "date="+date;
      request.open("POST", url, true);

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("diversSell").innerHTML = return_data;

        }
      }
      // Send the data to PHP now... and wait for response to update the invitationData div
      request.send(vars); // Actually execute the request
      document.getElementById("diversSell").innerHTML = loaderDisplay();

}



// DIVERS BALANCE
function diversDataBalance(date) {
    var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "depositDiversBalanceAJX.php";  // the file to look for the data

      var vars = "date="+date;
      request.open("POST", url, true);

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("diversBalance").innerHTML = return_data;

        }
      }
      // Send the data to PHP now... and wait for response to update the invitationData div
      request.send(vars); // Actually execute the request
      document.getElementById("diversBalance").innerHTML = loaderDisplay();

}


// LOAD THE DEPOSIT
function decissionData(date) {
    var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "depositDecision.php";  // the file to look for the data

      var vars = "date="+date;
      request.open("POST", url, true);

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("decissionData").innerHTML = return_data;

        }
      }
      // Send the data to PHP now... and wait for response to update the invitationData div
      request.send(vars); // Actually execute the request
      document.getElementById("decissionData").innerHTML = loaderDisplay();

}












function Signate() {
    SignPassword  = document.getElementById("SignPassword").value;
    SignCode      = document.getElementById("SignCode").value;
    SignType      = document.getElementById("sign_type_Box").value;

   if (SignPassword == '' || SignCode == '') {
      document.getElementById('alertDisplayDiv').innerHTML = `
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Warning!</strong> all field are required.
        </div>
      `;

   } else {



    var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "signateP.php";  // the file to look for the data
      var vars = "pass="+SignPassword+"&SCode="+SignCode+"&Stype="+SignType+"&date="+dateG;
      request.open("POST", url, true);

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var Signreturn = request.responseText;
          // convert to a JSON
          Signreturn = JSON.parse(Signreturn);
          if (Signreturn.allow == 0) {

            document.getElementById('alertDisplayDiv').innerHTML = `
              <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong> ${Signreturn.message}.
              </div>
            `;

          } else {
            // console.log(Signreturn);
            checkToSign();
            loadSignature();
            errorShow(Signreturn.message,1);
            document.getElementById('SignateDataContent').style.display = "none"; //  hide the signature area
          }

        }
      }
      request.send(vars); // Actually execute the request

   }
}






// check if the user have a permision to sign
function checkToSign() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'checkToSign.php?date='+dateG, true);

        xhr.onload = function() {
            if(this.status == 200){
                var result = this.responseText;
                result = JSON.parse(result);

                UserHaveSignature = result.found;
                UserSignatureType = result.type;

                if (result.found == '1') {
                  setSignature(result.type);
                  loadSignature();
                } else {
                  document.getElementById('SignateDataContent').style.display = "none"; //  hide the signature area
                }
            }
        }
        xhr.send();
}

// set up the signature for and fill some value to a text boxes
// set and display the signature div.content
function setSignature(val = null) {
    if (val != null) {

      document.getElementById('sign_type_Box').value= val; // set the text box to the set as text:box
      document.getElementById('signAs').innerText = val; // set the text box to the set as text:box

      document.getElementById('SignateDataContent').style.display = "block"; //  this display the signature area
    } else {
      document.getElementById('SignateDataContent').style.display = "none";//  this hide the signature area

    }
}










// load the values to the select boxe with the others users list
function load_selected() {

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'load_selected_deposit.php?date='+dateG, true);

        xhr.onload = function() {
            if(this.status == 200){
                var result = this.responseText;
                result = JSON.parse(result);
                // var output = '';
                  var users = `<?php
                              $results_users = $mysqli->query("SELECT `user_id`,`fname`,`lname` FROM `users` WHERE `perm`='1'");
                              if ($results_users->num_rows == null) {
                              } else {
                                while ($rowe = $results_users->fetch_array()) {
                                  $user_id = $rowe["user_id"];
                                  $fname   = $rowe["fname"];
                                  $lname   = $rowe["lname"];
                                  echo "<option value='$user_id'>$fname $lname</option>";
                                }
                              } ?>`;

                // define values to the forms
                var checkedBySelectOne     = document.getElementById('checkedBySelectOne');
                var checkedBySelectTwo     = document.getElementById('checkedBySelectTwo');
                var approvedBySelect       = document.getElementById('approvedBySelect');

                // for the checker one
                checkedBySelectOne.innerHTML = `
                      <option value="${result.check1.id}"> ${result.check1.names} </option>
                      <optgroup> ${users} </optgroup>`;

                // for checker two
                checkedBySelectTwo.innerHTML = `
                      <option value="${result.check2.id}"> ${result.check2.names} </option>
                      <optgroup> ${users} </optgroup>`;

                // for checker two
                approvedBySelect.innerHTML = `
                      <option value="${result.approve.id}"> ${result.approve.names} </option>
                      <optgroup> ${users} </optgroup>`;

                loadSignature();
            }
        }

        xhr.send();
}



// THIS LOAD SIGNATURE
function loadSignature() {

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'loadSignature.php?date='+dateG, true);

        xhr.onload = function() {
            if(this.status == 200){
                var result = this.responseText;
                result = JSON.parse(result);
                console.log(result);

                // SIGNATURE ONE
                if (result.checker1.found) {
                    document.getElementById('checkedBySignatureOne').innerHTML = '<image class="responsive" src="app_data/imgs/sgnc/'+result.checker1.signature+'">';
                } else {
                  document.getElementById('checkedBySignatureOne').innerHTML = "Signature";
                }

                // SIGNATURE TWO
                if (result.checker2.found) {
                    document.getElementById('checkedBySignatureTwo').innerHTML = '<image class="responsive" src="app_data/imgs/sgnc/'+result.checker2.signature+'">';
                } else {
                  document.getElementById('checkedBySignatureTwo').innerHTML = "Signature";
                }

                // SIGNATURE APPROVAL
                if (result.aprover.found) {
                    document.getElementById('AprovedBySignature').innerHTML = '<image class="responsive" src="app_data/imgs/sgnc/'+result.aprover.signature+'">';
                } else {
                  document.getElementById('AprovedBySignature').innerHTML = "Signature";
                }

                // CHECK IF ALL PEOPLE ARE SIGNED
                if (result.aprover.found == 1 && result.checker2.found == 1 && result.checker1.found) {
                    allSigned = 1;
                }

            }
        }
        xhr.send();

}




// signature functions
// alow the user to be selected to be able to sign
function setUserToSign(id,type) {
  var ido = document.getElementById('checkedBySelectOne').value;

      var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "sigante.php";  // the file to look for the data

      var vars = "date="+dateG+"&u_id="+id+"&type="+type;
      request.open("POST", url, true);

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          // document.getElementById("stateDecision").innerHTML = return_data;
          return_data = JSON.parse(return_data);

                console.log(return_data);
            if (return_data.done) {
              errorShow(return_data.message, 1);

              load_selected(); // for user check boxes
              checkToSign(); // check if a user have the signature to sign
              setSignature(); // prepare for the signature
              loadSignature(); // reflesh the signature
            } else {
              errorShow(return_data.message);
            }
            checkToSign();
        }
      }
      // Send the data to PHP now... and wait for response to update the invitationData div
      request.send(vars); // Actually execute the request
      // document.getElementById("stateDecision").innerHTML = loaderDisplay();

}


// run function by default
document.addEventListener("DOMContentLoaded", function(){
    // check_exist(); // check if date exist

    // checkToSign();
    // setSignature();
    loadSignature();
});


var auto_loadSignature;
var auto_load_selected;
var auto_checkToSign;

if (allSigned == 0 && NothingFound == 0) {

  $(document).ready(function(e) {
    $.ajaxSetup({chache:false});
      auto_loadSignature = setInterval(loadSignature, 3000);
      auto_load_selected = setInterval(load_selected, 3000);
      auto_checkToSign   = setInterval(checkToSign, 3000);
  });
} else {
      clearTimeout(auto_loadSignature);
      clearTimeout(auto_load_selected);
      clearTimeout(auto_checkToSign);
}

</script>

<?php // include 'app_data/php/foater.php' ?>
</body>
</html>
