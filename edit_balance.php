<?php
include 'app_data/php/head_blank.php';

$Bid      = $_GET['id'];
$sell_id  = retrieve_data('sell_id', 'balance_table', 'balance_id', $Bid);

if (isset($_GET['t']) && !empty($_GET['t'])) {
    @$typ = @$_GET['t'];
} else {
    @$typ ='x';
}

      $env_id                 = @retrieve_data('item_id','balance_table','balance_id',$Bid);

      $date_DB                = @retrieve_data('date','balance_table','balance_id',$Bid);
      $balance                = @retrieve_data('balance','balance_table','balance_id',$Bid);
      $comment                = @retrieve_data('comment','balance_table','balance_id',$Bid);
      $client_name            = @retrieve_data('client_name','balance_table','balance_id',$Bid);
      $payed_in               = @retrieve_data('payed_in','balance_table','balance_id',$Bid);
      $closed                 = @retrieve_data('closed','balance_table','balance_id',$Bid);
      $paym_typ               = @retrieve_data('paym_typ','balance_table','balance_id',$Bid);
      $Rate_R                 = @retrieve_data('Rate_R','balance_table','balance_id',$Bid);
      $Rate_Fc                = @retrieve_data('Rate_Fc','balance_table','balance_id',$Bid);
      $Pay_Fr                 = @retrieve_data('Pay_Fr','balance_table','balance_id',$Bid);
      $Pay_Dol                = @retrieve_data('Pay_Dol','balance_table','balance_id',$Bid);
      $Pay_fc                 = @retrieve_data('Pay_fc','balance_table','balance_id',$Bid);
      $Total_Available        = @retrieve_data('Total_Available','balance_table','balance_id',$Bid);
      $Total_Available_Rw     = @retrieve_data('Total_Available_Rw','balance_table','balance_id',$Bid);


if (@$typ == 'D') {
      $formLink           = "edit_balance.php?id=$Bid&t=D";

      // retreaving last balance
      $last_payment_type  =  @retrieve_data('paym_typ','balance_table','balance_id',$Bid);
      $last_balance       = @retrieve_data('balance', 'balance_table', 'balance_id', $Bid);

      
      $dynamic_balance    = @retrieve_data('balance', 'divers_sales', 's_id', $sell_id);
      $static_balance     = @retrieve_data('static_balance', 'divers_sales', 's_id', $sell_id);
  
      $item_bal           = 'Divers';

} else {
      $formLink           = "edit_balance.php?id=$Bid";

      // retreaving last balance
      $last_payment_type  =  @retrieve_data('paym_typ', 'balance_table','balance_id',$Bid);
      $last_balance       = @retrieve_data('balance', 'balance_table', 'balance_id', $Bid);

      $dynamic_balance    = @retrieve_data('balance', 'selling_e', 's_id', $sell_id);
      $static_balance     = @retrieve_data('static_balance', 'selling_e', 's_id', $sell_id);

      $item_bal           = 'Invitation';

}




$new_balance_to_main_tb = '';

// // Mofify the balance variable
// if ($Total_Available > $balance_input) {
//   $new_balance_to_main_tb = 0;
// } else {
//   $new_balance_to_main_tb = $balance_input - $Total_Available;
// }





$Previous_balance = $dynamic_balance + $Total_Available; // this is the current balance to be used in the balance form

// echo "
// <h1>static:   $static_balance  <br>
// Dynamic:      $dynamic_balance <br>
// Payed:        $Total_Available <br>
// Last balance: $Previous_balance <br>

// </h1>
// ";


 if (isset($_POST['Sell_envitation'])) {

  @$balance_input = $_POST['balance'];

  @$client_name = $_POST['client_name'];

  @$paym_typ = $_POST['paym_typ'];
  @$Cash_type = $_POST['Cash_type'];

  // rate
  @$Rate_R = $_POST['Rate_R'];
  @$Rate_Fc = $_POST['Rate_Fc'];

  // pay cash
  @$Pay_Fr = $_POST['Pay_Fr'];
  @$Pay_Dol = $_POST['Pay_Dol'];
  @$Pay_fc = $_POST['Pay_fc'];
  @$Total_Available = $_POST['Total_Available'];
  @$Total_Available_Rw = $_POST['Total_Available_Rw'];
  @$comment = $_POST['comment'];

  @$balanceNew = $_POST['balanceNew'];

  
  // date
  $date_d_form = $_POST['date_date'];
  $date_m_form = $_POST['date_m'];
  $date_y_form = $_POST['date_y'];
  $date_form_modif = "$date_d_form-$date_m_form-$date_y_form";
  $curent_date_db = $date_DB;

  if (isset($_POST['date_date']) && !empty($_POST['date_date'])) {
    $date_db_save = $date_form_modif;
  } else {
    $date_db_save = $curent_date_db;
  }




// Mofify Balance Query
  if (@$typ == 'D') {
   //  invitation update
    $update_main_table_query = "UPDATE `divers_sales` SET `balance` = '$balanceNew', `Cash_type`='$Cash_type' WHERE `s_id` = '$sell_id'";
  } else {
   //  invitation update
    $update_main_table_query = "UPDATE `selling_e` SET `balance` = '$balanceNew', `Cash_type`='$Cash_type'  WHERE `s_id` = '$sell_id'";
  }





    $query_balance = "UPDATE
    `balance_table`
SET
    `date` = '$date_db_save',
    `comment` = '$comment',
    `client_name` = '$client_name',
    `Rate_R` = '$Rate_R',
    `Rate_Fc` = '$Rate_Fc',
    `Pay_Fr` = '$Pay_Fr',
    `Pay_Dol` = '$Pay_Dol',
    `Pay_fc` = '$Pay_fc',
    `Total_Available` = '$Total_Available',
    `Total_Available_Rw` = '$Total_Available_Rw',
    `done_by` = '$user_id'
WHERE
    `balance_id` = '$Bid'"; //////////////////////////


    if ($Query_one_run = $mysqli->query($query_balance)) {
      ?>
      <div class="alert alert-success alert-dismissible" style="margin-bottom: 0;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <b class=" fa fa-check"></b> &nbsp; The Ballance has Been Inserted in the System
      </div>
      <?php






 if ($Query_one_run = $mysqli->query($update_main_table_query)) {
   ?>
   <div class="alert alert-success alert-dismissible" style="margin-bottom: 0;">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <b class=" fa fa-check"></b> &nbsp; Ballance in the main sale Updated!
   </div>
   <?php
 }




}



 }

?>




<!-- contents start here -->
<div style="width: 100%; max-width: 1307px; margin: auto;">

<form class="" action="<?php echo @$formLink; ?>" method="post">

<a href="home.php"> <h2 class="fa fa-chevron-circle-left back-arrow-butt slideInLeft animated"></h2> </a>

<div>

<div class="" style="margin:0px;">

   <div class="section-one">
        <h1 class="title-sell">EDIT BALANCE</h1>
   </div> <!-- /.section-one -->



   <div class="section-one" style="background: #ececec;">
        <div class="inner-dv">

        <div class="row">
          <div class="col-md-4">
            <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">Client</span>
                  <input type="text" class="form-control" name="client_name" value="<?php echo @$client_name; ?>" id="" placeholder=" Name" title="Text only" minlength="3" required="" <?php echo $form_text; ?>>
                </div>
                <span id="" class="sr-only">(success)</span>
              </div>
          </div>
          <div class="col-md-4">
          <!-- <div class="form-group has-feedback"> -->
            <div class="input-group">
                <span class="input-group-addon">Item </span>
                <select class="form-control" name="item" required="">
                  <?php
                     if (@$typ == 'D') {
                       echo '<option value="Divers">Divers</option>';
                     } else {
                       echo '<option value="Invitation">Invitation</option>';
                     }
                   ?>
                </select>
            </div>
          <!-- </div> -->

          </div>
          <div class="col-md-4">

            <div class="input-group">
            <?php
            if (@$typ == 'D') { ?>
              <span class="input-group-addon">Product</span>
              <select class="form-control" name="item_id"  required="">
                  <option value="<?php echo $env_id; ?>"><?php echo retrieve_data('pro_name','products','pro_id',$env_id); ?></option>
                  <option value=""></option>

                  <option value="0">Others</option>
              </select>
              <?php } else { ?>

              <span class="input-group-addon">Invitation Id</span>
              <input type="number" name="item_id" class="form-control" value="<?php echo $env_id; ?>" id="" placeholder="" readonly="">

              <?php } ?>
            </div>



          </div>
        </div><!-- /.row -->


        <div class="row" style=" padding-top: 11px; ">


        <div class="col-md-4">
          <div class="row">

             <div class="col-md-6">
                 <div class="input-group">
                   <span class="input-group-addon">Sell Id</span>
                   <input type="number" name="sale_id" class="form-control" value="<?php echo $sell_id; ?>" id="" placeholder="" readonly="">
                 </div>
             </div>

             <div class="col-md-6">
               <div class="input-group">
                 <span class="input-group-addon">Payed In</span>
                 <input type="text" name="payed_in" class="form-control" value="<?php echo @$last_payment_type; ?>" id="" placeholder="" readonly="">
               </div>
             </div>

          </div>


          </div>



          <div class="col-md-4">
            <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">Done By</span>
                  <input type="text" name="done_by" class="form-control" value="<?php echo "$fnamel  $lnamel"; ?>" id="" placeholder="" readonly="">
                </div>
              </div>
          </div>



          <div class="col-md-4">
         <div class="date-edit-cont">
                <div class="date-display">

                <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">Date</span>
                  <input type="text" name="" class="form-control" value="<?php echo @retrieve_data('date', 'selling_e', 's_id', $sell_id); ?>" id="" placeholder="" readonly="">
                </div>
              </div>

                </div>
                <div class="date-edit">
                                  <div class="form-group has-feedback">
                                  <div class="input-group">
                                    <span class="input-group-addon">Date</span>

                                    <select class="form-control-date" onchange="return datechangevisible()" name="date_date">
                                        <option value=""></option>
                                        <optgroup>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                              if ($i <= 9) {
                                                $comp = "0";
                                              } else {
                                                $comp = "";
                                              }
                                              echo "<option value='$comp$i'>$comp$i </option>";
                                            }
                                            ?>
                                        </optgroup>
                                  </select>

                                  <select class="form-control-date" onchange="return datechangevisible()" name="date_m" required="">
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

                                  <select class="form-control-date" onchange="return datechangevisible()" name="date_y" required="">
                                        <option value="<?php echo @$this_year; ?>"><?php echo @$this_year; ?></option>
                                        <optgroup>
                                            <?php
                                            for ($i = 2010; $i <= $this_year; $i++) {
                                              echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                            ?>
                                        </optgroup>
                                  </select>

                                  </div>
                                  <span id="" class="sr-only">(success)</span>
                                </div>

                </div>
        
          </div>






      </div> <!-- /.row -->

        </div> <!-- /.inner-dv -->

   </div> <!-- /.section-one -->

   <div class="section-one" style="background: #fff;">
        <div class="inner-dv">


          <!-- <br> -->
          <div class="row">
            <div class="col-xs-12 col-md-8">

              <div class="">
                <div class="row">
                  <div class="col-xs-6">
                    <h3 class="section-title">Payment</h3>
                  </div>
                </div>

                <div class="row priceUnitRow">


                  <div class="col-xs-6">
                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Balance ( <b><?php echo @$last_payment_type; ?></b> )</span>
                          <input type="number" step="any"  name="balance" class="form-control" value="<?php echo @$Previous_balance; ?>" id="balance" placeholder="balance" required="" <?php echo $form_number; ?>>
                        </div>
                      </div>
                  </div>


                  <div class="col-xs-6" style="opacity:0;">
                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Payment Type</span>
                          <select id="paymentType" name="paym_typ" class="" onchange="BalanceProcess()" hidden="true">
                               <option value="<?php echo @$last_payment_type; ?>"><?php echo @$last_payment_type; ?></option>
                               <option value="frw">frw</option>
                               <option value="fc">fc</option>
                               <option value="dol">dol</option>
                           </select>
                        </div>
                      </div>
                  </div>

                </div><!-- .row -->
              </div>


              <hr class="separator">

              <h3 class="section-title">Cash</h3>

              <div class="row">
                <div class="col-xs-6 col-md-4">


                  <!-- popover div -->
                  <div class="popover top popover-cash  fadeIn animated" style="margin-top: -64px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title">Rwandans</h3>
                        <div class="popover-content">
                          <p><b><label id="inCashRwLabel">0</label></b>frw</p>
                        </div>
                  </div>
                  <!-- end of popover -->

                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any" class="form-control" id="inCashRw" name="Pay_Fr" value="<?php echo $Pay_Fr; ?>" onkeyup="BalanceProcess()" data-toggle="inCashRw" aria-describedby="" <?php echo $form_number; ?>>
                        </div>

                        <span id="" class="sr-only">(success)</span>
                      </div>

                </div>
                <div class="col-xs-6 col-md-4">

                  <!-- popover div -->
                  <div class="popover top popover-cash  fadeIn animated" style="margin-top: -64px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title">Dolars</h3>
                        <div class="popover-content">
                          <p><b><label id="inCashDolLabel">0</label></b>$</p>
                        </div>
                  </div>
                  <!-- end of popover -->

                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" step="any" class="form-control" name="Pay_Dol" id="inCashDol" value="<?php echo $Pay_Dol; ?>" onkeyup="BalanceProcess()" data-toggle="inCashDol" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <span id="" class="sr-only">(success)</span>
                  </div>


                </div>
                <div class="col-xs-6 col-md-4">

                  <!-- popover div -->
                  <div class="popover top popover-cash fadeIn animated" style="margin-top: -64px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title">Congo</h3>
                        <div class="popover-content">
                          <p><b><label id="inCashFcLabel">0</label></b>Fco</p>
                        </div>
                  </div>
                  <!-- end of popover -->

                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Fco</span>
                          <input type="number" step="any" class="form-control" name="Pay_fc" id="inCashFc" value="<?php echo $Pay_fc; ?>" onkeyup="BalanceProcess()" data-toggle="inCashFc" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                        <span id="" class="sr-only">(success)</span>
                    </div>


                </div>
              </div>



<div>
              <hr class="separator">

              <div class="row">
                <div class="col-xs-6 col-md-4">
                    <h3 class="section-title">Balance</h3>
                    </div>
              </div>

              <div class="row">
                <div class="col-xs-6 col-md-4">

                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon"><?php echo @$last_payment_type; ?></span>
                          <input type="text" step="any" class="form-control" id="TotalBalanceType" name="balanceNew" value="0" <?php echo $form_number; ?>>
                        </div>

                        <span id="" class="sr-only">(success)</span>
                      </div>

                </div>
                <div class="col-xs-6 col-md-4">


                </div>
                <div class="col-xs-6 col-md-4">


                </div>
              </div>

               <div class="row">
               <div class="col-md-12">

                     <b>Comment</b>
                     <textarea class="form-control" rows="" name="comment" cols=""><?php echo $comment; ?></textarea>

               </div>
                   <!-- hkjhkhkj -->
               </div>

</div>




            </div><!-- end of paym cont forms -->
            <div class="col-xs-6 col-md-4">
                <div class="rate-section">
                  <h3>Rate</h3>
              <section class="form-inline">

                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Rw</label>
                        <input type="number" step="any" class="form-control form-hide form-small" id="rateRw" name="Rate_R" value="<?php echo @$Rate_R; ?>" onkeyup="BalanceProcess()" required <?php echo $form_number; ?>>
                      </div>
                  </div>
                  <div class="col-md-6"  style="padding: 0;">
                    <div class="form-group" style="padding: 0;">
                      <label for="">Fco</label>
                      <input type="number" step="any" class="form-control form-hide form-small"  id="rateCo" name="Rate_Fc" value="<?php echo @$Rate_Fc; ?>" onkeyup="BalanceProcess()" required <?php echo $form_number; ?>>
                    </div>
                  </div>
                </div>


              </section>

                </div>

                <div class="price-total">
                     <h3>Total Available</h3>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon"><label id="cashTypDisplay1"></label></span>
                          <input type="number" step="any" class="form-control form-hide" name="Total_Available" id="totalAvailable" value="<?php echo @$Total_Available; ?>" onkeyup="BalanceProcess()" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any" class="form-control form-hide" name="Total_Available_Rw" id="totalAvailableRw" value="<?php echo @$Total_Available_Rw; ?>" onkeyup="BalanceProcess()" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-xs-12 col-md-8" style="padding-right: 0;">
                                <!-- Cash_type -->
                                <div class="form-group has-feedback">
                                  <div class="input-group">
                                    <span class="input-group-addon">Cah Type</span>
                                    <select id="cashTypeSelect" name="Cash_type" class="form-control" onchange="">
                                        <option value="Done">Done</option>
                                        <option value="Avance">Avance</option>
                                      </select>
                                  </div>
                                </div>
                  </div>
                  <div class="col-xs-6 col-md-4" style="padding: 0;">
                     <input type="submit" name="Sell_envitation" class="btn btn-primary" value="Add Ballance">
                  </div>
                </div>



</form>
            </div>
          </div>



        </div> <!-- /.inner-dv -->
</div> <!-- /.sell-c0ntainner-div -->


</div>

</div> <!-- containner -->


<b id="cashTypDisplay2" style="opacity:0;font-size:0px;"></b>


<?php include 'app_data/php/foater.php' ?>
<script type="">



        function BalanceProcess() {

            // rate variavles textbox
            var rateRw = document.getElementById('rateRw');
            var rateCo = document.getElementById('rateCo');
            var paymentType = document.getElementById('paymentType');

            var balance = document.getElementById('balance').value;

            var inCashDol = document.getElementById('inCashDol'); // input dollar
            var inCashRw = document.getElementById('inCashRw'); // input Rwandans
            var inCashFc = document.getElementById('inCashFc'); // input congo

            // TOTAL AVAILABLE
            var totalAvailable = document.getElementById('totalAvailable'); // sum from the input in a selected type
            var totalAvailableRw = document.getElementById('totalAvailableRw'); // the sum of the input in Rw



            // TOTAL BALANCE
            var TotalBalanceType = document.getElementById('TotalBalanceType'); // sum from the input in a selected type
            // var TotalBalanceTyp = document.getElementById('TotalBalanceTyp'); // the sum of the input in Rw
            var Custon_Type_Selected = '';


            // CASH IN HAND laber
            var inCashDolLabel = document.getElementById('inCashDolLabel'); // input dollar
            var inCashRwLabel = document.getElementById('inCashRwLabel'); // input Rwandans
            var inCashFcLabel = document.getElementById('inCashFcLabel'); // input congo

            // inCashRwLabel.innerHTML = "you are the next";
            var balanceRw;
            // --------
            var minTot; // minnimum variable of total price
            var minAva; // minnimum variable of avariable price

            // CALCULATE THE SUM INPUT IN RWANDANS
            // translate the receive cash nto Rwandans
            var inCashDolNew = change_rate_receive(rateRw.value, rateCo.value, 'dol', 'rw', inCashDol.value); // change Dol to RW
            var inCashFcNew = change_rate_receive(rateRw.value, rateCo.value, 'fc', 'rw', inCashFc.value); // change Cong to RW
            var inCashRwNew = inCashRw.value; // is a selected type
            var sumInput = Number(inCashRwNew) + Number(inCashFcNew) + Number(inCashDolNew); // this is the summ of all input


            if (paymentType.value == 'frw') { //************************************************************************************
                balanceRw = balance;
                Custon_Type_Selected = 'rw';
                // TOTAL AVAILABLE
                totalAvailable.value = sumInput.toFixed(2); // this will depend on a selected value

                // changing the total available in Rwandans
                totalAvailableRw.value = sumInput.toFixed(2); // no need of special function

                var cash2 = balanceRw - sumInput;
                // DISPLAY FOR LABEL IN CASH
                if (sumInput >= balanceRw) {
                    inCashRwLabel.innerHTML = '0';
                    inCashDolLabel.innerHTML = '0';
                    inCashFcLabel.innerHTML = '0';
                } else {
                    var cash2 = balanceRw - sumInput;
                    inCashRwLabel.innerHTML = cash2.toFixed(2);
                    inCashDolLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', cash2).toFixed(2);
                    inCashFcLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', cash2).toFixed(2);
                }

                // NEW ..... LABEL AFTER TEXT AREAaa
                cashTypDisplay1.innerHTML = "Frw"; // displaying the value
                cashTypDisplay2.innerHTML = "Frw"; // displaying the value

                $('.popover').show(); // show the popup


            } else if (paymentType.value == 'dol') { //************************************************************************************
                // SELECTED IN DOLARS
                balanceRw = change_rate_receive(rateRw.value, rateCo.value, 'dol', 'rw', balance);
                Custon_Type_Selected = 'dol';

                // TOTAL AVAILABLE
                // Finding the total available Type
                var cvg = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', sumInput);
                totalAvailable.value = cvg.toFixed(2); // this will depend on a selected value

                // display the total available in Rwandans
                totalAvailableRw.value = sumInput.toFixed(2); // no need of special function

                // DISPLAY FOR LABEL IN CASH
                if (sumInput >= balanceRw) {
                    // alert('payment done');
                    inCashRwLabel.innerHTML = '0';
                    inCashDolLabel.innerHTML = '0';
                    inCashFcLabel.innerHTML = '0';
                } else {
                    var cash2 = balanceRw - sumInput;
                    inCashRwLabel.innerHTML = cash2.toFixed(2);
                    inCashDolLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', cash2).toFixed(2);
                    inCashFcLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', cash2).toFixed(2);
                }

                // NEW ..... LABEL AFTER TEXT AREAaa
               // cashTypDisplay.innerHTML = "$"; // displaying the value
                cashTypDisplay1.innerHTML = "$"; // displaying the value
                cashTypDisplay2.innerHTML = "$"; // displaying the value

                  $('.popover').show(); // show the popup


            } else if (paymentType.value == 'fc') { //************************************************************************************
                // SELECTED IN DOLARS
                balanceRw = change_rate_receive(rateRw.value, rateCo.value, 'fc', 'rw', balance);
                Custon_Type_Selected = 'fc';

                // TOTAL AVAILABLE
                // Finding the total available Type
                var cvg = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', sumInput);
                totalAvailable.value = cvg.toFixed(2); // this will depend on a selected value

                // display the total available in Rwandans
                totalAvailableRw.value = sumInput.toFixed(2); // no need of special function

                // DISPLAY FOR LABEL IN CASH
                if (sumInput >= balanceRw) {
                    // alert('payment done');
                    inCashRwLabel.innerHTML = '0';
                    inCashDolLabel.innerHTML = '0';
                    inCashFcLabel.innerHTML = '0';
                } else {
                    var cash2 = balanceRw - sumInput;
                    inCashRwLabel.innerHTML = cash2.toFixed(2);
                    inCashDolLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', cash2).toFixed(2);
                    inCashFcLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', cash2).toFixed(2);
                }

                // NEW ..... LABEL AFTER TEXT AREAaa
                // cashTypDisplay.innerHTML = "Fc"; // displaying the value
                cashTypDisplay1.innerHTML = "Fc"; // displaying the value
                cashTypDisplay2.innerHTML = "Fc"; // displaying the value

                  $('.popover').show(); // show the popup


            }
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // if()
            // balance
                var SumCashInFrw = Number(inCashRw.value) + Number(change_rate_receive(rateRw.value, rateCo.value, 'dol', 'rw', inCashDol.value))  + Number(change_rate_receive(rateRw.value, rateCo.value, 'fc', 'rw', inCashFc.value))
                var SumCashInCash = '';
                var NewBalance = '';
                
                if (Custon_Type_Selected == 'rw') {
                    SumCashInCash = Number(SumCashInFrw);
                } else {
                    SumCashInCash = Number(change_rate_receive(rateRw.value, rateCo.value, 'rw', Custon_Type_Selected, SumCashInFrw).toFixed(2));
                }

                if(Number(balance) <= Number(SumCashInCash)) {
                  NewBalance = 0;
                } else {
                  NewBalance = Number(balance) - Number(SumCashInCash);
                }
                TotalBalanceType.value = NewBalance.toFixed(2); // dissplay the output to the balance




                // work with the balance select
                if (TotalBalanceType.value == 0) {
                    document.getElementById('cashTypeSelect').innerHTML = `
                    <option value="Done">Done</option>
                    <option value="Avance">Avance</option>
                    `;
                } else {
                    document.getElementById('cashTypeSelect').innerHTML = `
                    <option value="Avance">Avance</option>
                    <option value="Done">Done</option>
                    `;
                }

        } // end of main functions

        $(document).ready(function() {
           BalanceProcess();
        });

</script>

<style>

.form-control-date {
    padding: 7px;
    border-color: #cccccc;
    border-left: 0px;
}

.date-edit-cont {
    height: 37px;
    overflow: hidden;
}

.date-edit-cont .date-display {
    height: 37px;
    -webkit-transition: all 0.2s ease-out;
    -O-transition: all 0.2s ease-out;
    transition: all 0.2s ease-out;
}

.date-edit-cont .date-edit {
    height: 37px;
}

.date-edit-cont:hover .date-display {
    margin-top: -37px;
}

.date-changed {
    margin-top: -37px;
}
</style>
