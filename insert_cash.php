<?php
include 'app_data/php/head_blank.php';
secured();


if (isset($_POST['add_cash'])) {
  $total_in_frw = $_POST['total_in_frw'];
  $in_rw = $_POST['in_rw'];
  $in_fc = $_POST['in_fc'];
  $in_dol = $_POST['in_dol'];
  $rate_rw = $_POST['rate_rw'];
  $rate_fc = $_POST['rate_fc'];

  // date
  $date_d_form = $_POST['date_d'];
  $date_m_form = $_POST['date_m'];
  $date_y_form = $_POST['date_y'];
  $date_form_modif = "$date_d_form-$date_m_form-$date_y_form";


  $query = "INSERT INTO `deposit`( `date`, `in_fc`, `in_do`, `in_rw`, `rate_frw`, `rate_co`, `total_rw` ) VALUES( '$date_form_modif', '$in_fc', '$in_dol', '$in_rw', '$rate_rw', '$rate_fc', '$total_in_frw' )";
  if ($mysqli->query($query)) {
    echo "data inserted";
  } else {
    echo "data failed";
  }


}


////////////// DELETE MESSAGE
if (isset($_GET['e'])) {
?>
<div class="alert alert-warning alert-dismissible alert-fixed bounceInDown animated" style="margin-bottom: 0;z-index: 1;width: 240px;opacity: 0.9;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <b class=" fa fa-circle"></b> &nbsp; <?php echo $_GET['e']; ?>
</div>
<?php
}



?>
<!-- contents start here -->
<a href="home.php"> <h2 class="fa fa-chevron-circle-left back-arrow-butt slideInLeft animated"></h2> </a>

<form class="" action="insert_cash.php" method="post">

<div class="containner_cash">
    <div class="headSection">
          <div class="cash_containner">
            <h1 class="title blurl">Insert The Cash</h1>
            <br>
            <div class="date-edit-cont">
                  <div class="date-display">

                  <div class="form-group has-feedback">
                  <div class="input-group date_cont_trasp">
                    <span class="input-group-addon">Date</span>
                    <input type="text" name=""  class="form-control date_view_stat" value="<?php  echo  @$today_date; ?>" id="" placeholder="" readonly="">
                  </div>
                </div>

                  </div>
                  <div class="date-edit">
                                    <div class="form-group has-feedback">
                                    <div class="input-group">
                                      <span class="input-group-addon">Date</span>

                                      <select class="form-control-date color_black" onchange="return check_exist();" name="date_d" id="date_d">
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

                                    <select class="form-control-date color_black" onchange="return check_exist();" name="date_m" id="date_m" required="">
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

                                    <select class="form-control-date color_black" onchange="return check_exist();" name="date_y" id="date_y" required="">
                                          <option value="<?php echo @$this_year; ?>"><?php echo @$this_year; ?></option>
                                          <optgroup>
                                              <?php
                                                for ($i= 2010; $i <= $this_year; $i++) {
                                                  echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                              ?>
                                          </optgroup>
                                    </select>

                                    <input type="button" name="" value="X">

                                    </div>
                                    <span id="" class="sr-only">(success)</span>
                                  </div>
                  </div>
            </div>

            <p class="blurl">Insert the cash you have in hands</p>

          <section class="blurl">
            <label> Total (Frw) </label>
            <input type="number" class="input_total" name="total_in_frw" id="totalAvailableRw" value="0" readonly required>
            <!-- <label> Frw </label>  -->
          </section>

          <section class="rate_section blurl">
            <h3> Rate </h3>
            <p>

              <section class="blurl">
                <b>Frw</b> <input type="number" class="input_rate" id="rateRw" name="rate_rw" min="0" step="any" value="<?php echo @$rate_rw_r; ?>" onkeyup="ChangeCash()" required> &nbsp;&nbsp;
                <b>Fco</b> <input type="number" class="input_rate" id="rateCo" name="rate_fc" min="0" step="any" value="<?php echo @$rate_fc_r; ?>" onkeyup="ChangeCash()" required>
              </section>

            </p>

          </section>


          </div>

    </div>
    <div class="cash_containner">
<div class="cent-width-700">
     <section class="forms_containner">

     <h3 class="blurl">Insert Cash</h3>
     <br>

     <div class="row">
                     <div class="col-xs-6 col-md-4">

                       <!-- end of popover -->

                         <div class="form-group has-feedback">
                             <div class="input-group">
                               <span class="input-group-addon">Frw</span>
                               <input type="number" step="any" class="form-control" id="inCashRw" name="in_rw" value="0" onkeyup="ChangeCash()" data-toggle="inCashRw" aria-describedby="" pattern="[0,1,2,3,4,5,6,7,8,9,.,+]*" required>
                             </div>

                             <span id="" class="sr-only">(success)</span>
                           </div>

                     </div>
                     <div class="col-xs-6 col-md-4">

                       <!-- popover div -->
                       <div class="popover top popover-cash  fadeIn animated" style="margin-top: -64px;">
                             <div class="arrow"></div>
                             <h3 class="popover-title">Dolars ($)</h3>
                             <div class="popover-content">
                               <p><b><label id="inCashDolLabel">0</label></b>$</p>
                             </div>
                       </div>
                       <!-- end of popover -->

                       <div class="form-group has-feedback">
                           <div class="input-group">
                             <span class="input-group-addon">$</span>
                             <input type="number" step="any" class="form-control" name="in_dol" id="inCashDol" value="0" onkeyup="ChangeCash()" data-toggle="inCashDol" aria-describedby="" pattern="[0,1,2,3,4,5,6,7,8,9,.,+]*" required>
                           </div>
                           <span id="" class="sr-only">(success)</span>
                       </div>


                     </div>
                     <div class="col-xs-6 col-md-4">

                       <!-- popover div -->
                       <div class="popover top popover-cash fadeIn animated" style="margin-top: -64px;">
                             <div class="arrow"></div>
                             <h3 class="popover-title">Frc (Congo)</h3>
                             <div class="popover-content">
                               <p><b><label id="inCashFcLabel">0</label></b>frw</p>
                             </div>
                       </div>
                       <!-- end of popover -->

                         <div class="form-group has-feedback">
                             <div class="input-group">
                               <span class="input-group-addon">Fco</span>
                               <input type="number" step="any" class="form-control" name="in_fc" id="inCashFc" value="0" onkeyup="ChangeCash()" data-toggle="inCashFc" aria-describedby="" pattern="[0,1,2,3,4,5,6,7,8,9,.,+]*" required>
                             </div>
                             <span id="" class="sr-only">(success)</span>
                         </div>


                     </div>
             </div>
             <br>
           </section>

             <div class="" id="status"></div>

     </form>

    </div>

    </div>
</div>

<section data-toggle="modal" data-target=".bs-example-modal-lg" style="position: fixed; bottom: 19px; right: 24px; ">
    <button type="button" class="btn btn-success button-spend-pop fadeInUp animated" data-toggle="tooltip" title="View, Add Spending"> <b class="fa fa-plus"></b>  </button>
</section>


<script>
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>

<style media="screen">

</style>

















<?php include 'app_data/php/foater.php' ?>
<script>


function load_Descission() {
  var date_d = document.getElementById('date_d').value;
  var date_m = document.getElementById('date_m').value;
  var date_y = document.getElementById('date_y').value;
  var date = date_d+'-'+date_m+'-'+date_y; // date variable

  /////////////////////////////////////////////////////////
  if (date_d != "") {

      var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "load_decission.php";

      var vars = "date="+date;
      request.open("POST", url, true);

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("decissionDisplay").innerHTML = return_data;
          // loadDoc(); // load comment
        }
      }
      // Send the data to PHP now... and wait for response to update the status div
      request.send(vars); // Actually execute the request
      document.getElementById("decissionDisplay").innerHTML = "processing...";
  } else {
        document.getElementById("decissionDisplay").innerHTML = "please Select a date";
  }

}

                  function ChangeCash() {

                      // rate variavles textbox
                      var rateRw = document.getElementById('rateRw');
                      var rateCo = document.getElementById('rateCo');
                      var totalAvailableRw = document.getElementById('totalAvailableRw'); // the sum of the input in Rw

                      // Cash in hands
                      var inCashDol = document.getElementById('inCashDol'); // input dollar
                      var inCashRw = document.getElementById('inCashRw'); // input Rwandans
                      var inCashFc = document.getElementById('inCashFc'); // input congo

                      // CASH IN HAND LABEL Popover
                      var inCashDolLabel = document.getElementById('inCashDolLabel'); // input dollar
                      var inCashFcLabel = document.getElementById('inCashFcLabel'); // input congo


                      var inCashDolNew = change_rate_receive(rateRw.value, rateCo.value, 'dol', 'rw', inCashDol.value); // change Dol to RW
                      var inCashFcNew = change_rate_receive(rateRw.value, rateCo.value, 'fc', 'rw', inCashFc.value); // change Cong to RW
                      var inCashRwNew = inCashRw.value; // is a selected type
                      var sumInput = Number(inCashRwNew) + Number(inCashFcNew) + Number(inCashDolNew); // this is the summ of all input

                      totalAvailableRw.value = sumInput.toFixed(2);
                      $('.popover').show(); // show the popup

                      // Displa in the label
                      inCashDolLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'dol', 'rw', inCashDol.value).toFixed(2);
                      inCashFcLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'fc', 'rw', inCashFc.value).toFixed(2);

                      // inCashFcLabel
                  } // end of main functions


function check_exist() {
  $('.date-display').addClass('date-changed');

  var date_d = document.getElementById('date_d').value;
  var date_m = document.getElementById('date_m').value;
  var date_y = document.getElementById('date_y').value;
  var date = date_d+'-'+date_m+'-'+date_y; // date variable

  /////////////////////////////////////////////////////////
  if (date_d != "") {

      var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "check_dep_exist.php";

      var vars = "date="+date;
      request.open("POST", url, true);

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("status").innerHTML = return_data;
          load_Descission();
        }
      }
      // Send the data to PHP now... and wait for response to update the status div
      request.send(vars); // Actually execute the request
      document.getElementById("status").innerHTML = "processing...";

  } else {
        document.getElementById("status").innerHTML = "please Select a date";
  }

}

document.addEventListener("DOMContentLoaded", function(){
    check_exist(); // check if date exist
});

/////////////////////////////////////////////////////////
























</script>
