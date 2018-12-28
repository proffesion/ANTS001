<?php
include 'app_data/php/head_blank.php';

$sell_id = $_GET['sid'];

if (isset($_GET['t']) && !empty($_GET['t'])) {
    @$typ = @$_GET['t'];
} else {
    @$typ ='x';
}

$error1 = 0;
$error2 = 0;
           

if (@$typ == 'D') {
      $env_id              = retrieve_data('div_id','divers_sales','s_id',$sell_id);
      $client_name         = @retrieve_data('client_name','divers_sales','s_id',$sell_id);
      $formLink            = "add_balance.php?sid=$sell_id&t=D";

      // retreaving last balance
      $last_payment_type   =  @retrieve_data('paym_typ','divers_sales','s_id',$sell_id);
      $last_balance_static = @retrieve_data('static_balance', 'divers_sales', 's_id', $sell_id);
      $last_balance        = @retrieve_data('balance','divers_sales','s_id',$sell_id);

      // Rate
      $RateRw              = retrieve_data('Rate_R','divers_sales','s_id',$sell_id);
      $RateFc              = retrieve_data('Rate_Fc', 'divers_sales', 's_id', $sell_id);
      $Cash_type_D         = retrieve_data('Cash_type','divers_sales','s_id',$sell_id);
  
      $item_bal            = 'Divers';

} else {
      $env_id              = @retrieve_data('e_id','selling_e','s_id',$sell_id);
      $client_name         = @retrieve_data('client_name','selling_e','s_id',$sell_id);
      $formLink            = "add_balance.php?sid=$sell_id";

      // retreaving last balance
      $last_payment_type   =  @retrieve_data('paym_typ','selling_e','s_id',$sell_id);
      $last_balance_static = @retrieve_data('static_balance', 'selling_e', 's_id', $sell_id);
      $last_balance        = @retrieve_data('balance','selling_e','s_id',$sell_id);

      // Rate
      $RateRw              = retrieve_data('Rate_R','selling_e','s_id',$sell_id);
      $RateFc              = retrieve_data('Rate_Fc', 'selling_e', 's_id', $sell_id);
      $Cash_type_D         = retrieve_data('Cash_type','selling_e','s_id',$sell_id);

      $item_bal            = 'Invitation';

}

if ($Cash_type_D == 'Done') { ?>
<script> alert('This Sell seem to be closed!'); </script>
<?php }


 if (isset($_POST['Sell_envitation'])) {
  @$balance_input       = $_POST['balance'];

  @$client_nameO        = $_POST['client_name'];
  @$done_by             = $_POST['done_by'];

  $item                 = $_POST['item'];
  @$paym_typ            = $_POST['paym_typ'];
  @$Cash_type           = $_POST['Cash_type'];

  // rate
  @$Rate_R              = $_POST['Rate_R'];
  @$Rate_Fc             = $_POST['Rate_Fc'];

  // pay cash
  @$Pay_Fr              = $_POST['Pay_Fr'];
  @$Pay_Dol             = $_POST['Pay_Dol'];
  @$Pay_fc              = $_POST['Pay_fc'];
  @$Total_Available     = $_POST['Total_Available'];
  @$Total_Available_Rw  = $_POST['Total_Available_Rw'];
  @$comment             = $_POST['comment'];

  // date
  $date_d_form          = $_POST['date_d'];
  $date_m_form          = $_POST['date_m'];
  $date_y_form          = $_POST['date_y'];
  $date_form_modif      = "$date_d_form-$date_m_form-$date_y_form";




    $query_balance = "INSERT INTO `balance_table`(
      `date`,
      `item`,
      `item_id`,
      `sell_id`,
      `comment`,
      `client_name`,
      `closed`,
      `paym_typ`,
      `Rate_R`,
      `Rate_Fc`,
      `Pay_Fr`,
      `Pay_Dol`,
      `Pay_fc`,
      `Total_Available`,
      `Total_Available_Rw`,
      `done_by`
    )
  VALUES(
    '$date_form_modif',
    '$item',
    '$env_id',
    '$sell_id',
    '$comment',
    '$client_nameO',
    '$Cash_type',
    '$paym_typ',
    '$Rate_R',
    '$Rate_Fc',
    '$Pay_Fr',
    '$Pay_Dol',
    '$Pay_fc',
    '$Total_Available',
    '$Total_Available_Rw',
    '$user_id')";


    if ($Query_one_run = $mysqli->query($query_balance)) {
    $error1 = 1;


// UPDATE THE MAIN BALANCE
// $last_balance

// $Total_Available // total in different types
// $sell_id // sell id
// $balance_input // balance from input

// Mofify the balance variable
if ($Total_Available > $balance_input) {
  $new_balance_to_main_tb = 0;
} else {
  $new_balance_to_main_tb =  $balance_input - $Total_Available;
}

// Mofify Balance Query
 if (@$typ == 'D') {
   # diver
   //  invitation update
   $update_main_table_query = "UPDATE `divers_sales` SET `balance` = '$new_balance_to_main_tb', `Cash_type` = '$Cash_type' WHERE `s_id` = '$sell_id'";
 } else {
   # Invitation
   //  invitation update
   $update_main_table_query = "UPDATE `selling_e` SET `balance` = '$new_balance_to_main_tb', `Cash_type` = '$Cash_type'  WHERE `s_id` = '$sell_id'";
 }


 if ($Query_one_run = $mysqli->query($update_main_table_query)) {
        $error2 = 1;
 }




}



 }

?>



<!-- modal for selling more than what we have -->
<div class="modal fade" id="myModal23" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-styled-danger">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <!-- <img src="app_data/imgs/01_no_more_in_stock.png" class="img-icon-shw" alt="" /> -->
        <h1 class="icon-sub-font fa fa-meh-o"></h1>
        <h2 class="title-sub"> You are Selling more tha what you have </h2>
        <p>
        There is no more invitation in stock
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="home.php">
          <button type="button" class="btn btn-primary">Back</button>
        </a>
      </div>
    </div>
  </div>
</div>


<style>
.popover { display: none; }
</style>


<!-- contents start here -->
<div style="width: 100%; max-width: 1307px; margin: auto;">

<form class="" action="<?php echo @$formLink; ?>" method="post">

<a href="home.php"> <h2 class="fa fa-chevron-circle-left back-arrow-butt slideInLeft animated"></h2> </a>

<div>

<div class="" style="margin:0px;">

   <div class="section-one">
        <h1 class="title-sell">BALANCE FORM</h1>
   </div> <!-- /.section-one -->


<div class="">


<!-- <h2>Balance</h2> -->
<?php @$BalanceQuerySearch = "SELECT * FROM `balance_table` WHERE `item`='$item_bal' AND `sell_id`='$sell_id'"; ?>

<table class="table balance-table-result" border="0" style="width: 90%; margin:10px auto;">
  <tbody>
    <tr>
      <!-- <th> # </th> -->
      <th> Date </th>
      <!-- <th> E-id </th> -->
      <th> <b class="fa fa-money" style="font-size: 21px;" title="Payment Type"></b> </th>
      <th> Pay Frw </th>
      <th> Pay $ </th>
      <th> Pay Fco </th>
      <th> Total (type)</th>
      <th> Total (Frw)</th>
    </tr>

<?php
$results = $mysqli->query("$BalanceQuerySearch");

if ($results->num_rows == NULL) {
?>
<style>
 .balance-table-result { display: none; }
</style>

<?php
} else {
  $x = 0;

    while($row = $results->fetch_array()) {
      // @$Bal_b_id = $row["balance_id"];
      @$Bal_date = $row["date"];
      // @$Bal_item = $row["item"];
      @$Bal_item_id = $row["item_id"];
      @$Bal_sell_id = $row["sell_id"];
      // @$Bal_comment = $row["comment"];
      @$Bal_client_name = $row["client_name"];
      // @$Bal_closed = $row["closed"];
      @$Bal_paym_typ = $row["paym_typ"];
      // @$Bal_Rate_R = $row["Rate_R"];
      // @$Bal_Rate_Fc = $row["Rate_Fc"];
      @$Bal_Pay_Fr = $row["Pay_Fr"];
      @$Bal_Pay_Dol = $row["Pay_Dol"];
      @$Bal_Pay_fc = $row["Pay_fc"];
      @$Bal_Total_Available = $row["Total_Available"];
      @$Bal_Total_Available_Rw = $row["Total_Available_Rw"];
?>
  <tr>
  <td> <?php echo @$Bal_date; ?> </td>
  <!-- <td> <?php echo @$Bal_item_id; ?> </td> -->
  <td> <?php echo @$Bal_paym_typ; ?> </td>

  <td> <?php echo @$Bal_Pay_Fr; ?> Frw</td>
  <td> <?php echo @$Bal_Pay_Dol; ?> $</td>
  <td> <?php echo @$Bal_Pay_fc; ?> Fc</td>

  <td> <?php echo @$Bal_Total_Available; ?> <?php echo @$paym_typ; ?></td>
  <td> <?php echo @$Bal_Total_Available_Rw; ?> Frw</td>
 </tr>

<?php
@$total_Bal_Pay_Fr += $Bal_Pay_Fr;
@$total_Bal_Pay_Dol += $Bal_Pay_Dol;
@$total_Bal_Rate_Fc += $Bal_Pay_fc;

@$total_Bal_Total_Available += $Bal_Total_Available;
@$total_Bal_Total_Available_Rw += $Bal_Total_Available_Rw;

}
}
?>

<tr>
<!-- <td> &nbsp;</td> -->
<td> &nbsp; </td>
<!-- <td> &nbsp; </td> -->
<td> &nbsp; </td>
<td> <?php echo @$total_Bal_Pay_Fr; ?> Frw</td>
<td> <?php echo @$total_Bal_Pay_Dol; ?> $</td>
<td> <?php echo @$total_Bal_Rate_Fc; ?> Fc</td>

<td> &nbsp; </td>
<td bgcolor="lightblue"><b> <?php echo @$total_Bal_Total_Available_Rw; ?> Frw</b></td>
</tr>
</tbody></table>

<?php
$balance_payment_type = retrieve_data('paym_typ','selling_e','s_id',$sell_id);

// $balance_is = $balance_was -

$balance_was = @retrieve_data('balance','selling_e','s_id',$sell_id);
// find the balance wich depend on the payment-type
if ($balance_payment_type == 'frw') { // in Rwandans
$balance_was_total = $balance_was;
} elseif ($balance_payment_type == 'dol') { // dolar
$balance_was_total = @retrieve_data('balance','selling_e','s_id',$sell_id);
} elseif ($balance_payment_type == 'fc') {
$balance_was_total = @retrieve_data('balance','selling_e','s_id',$sell_id);
}


?>
<!--
<table class="table" border="0">
<tbody>
<tr>
<td class="smll-section-td" style="background:#E91E63;">
<p> Balance Was </p>
<h3><?php echo @$balance_was; ?> <?php echo retrieve_data('paym_typ','selling_e','s_id',$sell_id); ?></h3>
</td>
<td class="smll-section-td" style="background:#4CAF50;">
<p> Payed </p>
<h3><?php echo @$total_Bal_Total_Available_Rw; ?></h3>
</td>
<td class="smll-section-td" style="background:#03A9F4;">
<p> Left </p>
<h3><?php echo 12; ?></h3>
</td>
</tr>
</tbody>
</table>
-->

</div>

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
                   <option value=""></option>
                  <option value="Invitation">Invitation</option>
                  <option value="Divers">Divers</option>
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

                  <?php
                  $results_users = $mysqli->query("SELECT `pro_id`, `pro_name` FROM `products` WHERE `view`='1'");
                  if ($results_users->num_rows == NULL) {
                  } else {
                      while($rowe = $results_users->fetch_array()) {
                        $pro_id = $rowe["pro_id"];
                        $pro_name = $rowe["pro_name"];
                        echo "<option value='$pro_id'>$pro_name</option>";
                      }
                  } ?>
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
            <div class="input-group">
              <span class="input-group-addon">Date</span>

              <select class="form-control-date" name="date_d" required="">
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

             <select class="form-control-date" name="date_m" required="">
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

             <select class="form-control-date" name="date_y" required="">
                  <option value="<?php echo @$this_year; ?>"><?php echo @$this_year; ?></option>
                  <optgroup>
                      <?php
                        for ($i= 2010; $i <= $this_year; $i++) {
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                      ?>
                  </optgroup>
             </select>

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
                          <input type="number" step="any"  name="balance" class="form-control" value="<?php echo @$last_balance; ?>" id="balance" placeholder="balance" required="" <?php echo $form_number; ?>>
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
                        <h3 class="popover-title">Popover top</h3>
                        <div class="popover-content">
                          <p><b><label id="inCashRwLabel">0</label></b>frw</p>
                        </div>
                  </div>
                  <!-- end of popover -->

                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any" class="form-control" id="inCashRw" name="Pay_Fr" value="0" onkeyup="BalanceProcess()" data-toggle="inCashRw" aria-describedby="" <?php echo $form_number; ?>>
                        </div>

                        <span id="" class="sr-only">(success)</span>
                      </div>

                </div>
                <div class="col-xs-6 col-md-4">

                  <!-- popover div -->
                  <div class="popover top popover-cash  fadeIn animated" style="margin-top: -64px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title">Popover top</h3>
                        <div class="popover-content">
                          <p><b><label id="inCashDolLabel">0</label></b>$</p>
                        </div>
                  </div>
                  <!-- end of popover -->

                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" step="any" class="form-control" name="Pay_Dol" id="inCashDol" value="0" onkeyup="BalanceProcess()" data-toggle="inCashDol" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <span id="" class="sr-only">(success)</span>
                  </div>


                </div>
                <div class="col-xs-6 col-md-4">

                  <!-- popover div -->
                  <div class="popover top popover-cash fadeIn animated" style="margin-top: -64px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title">Popover top</h3>
                        <div class="popover-content">
                          <p><b><label id="inCashFcLabel">0</label></b>frw</p>
                        </div>
                  </div>
                  <!-- end of popover -->

                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Fco</span>
                          <input type="number" step="any" class="form-control" name="Pay_fc" id="inCashFc" value="0" onkeyup="BalanceProcess()" data-toggle="inCashFc" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                        <span id="" class="sr-only">(success)</span>
                    </div>


                </div>
              </div>



<div>
              <hr class="separator">
               <div class="row">
               <div class="col-md-12">

                     <b>Comment</b>
                     <textarea class="form-control" rows="" name="comment" cols="">Good</textarea>

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
                        <input type="number" step="any" class="form-control form-hide form-small" id="rateRw" name="Rate_R" value="<?php echo @$RateRw; ?>" onkeyup="BalanceProcess()" required <?php echo $form_number; ?>>
                      </div>
                  </div>
                  <div class="col-md-6"  style="padding: 0;">
                    <div class="form-group" style="padding: 0;">
                      <label for="">Fco</label>
                      <input type="number" step="any" class="form-control form-hide form-small"  id="rateCo" name="Rate_Fc" value="<?php echo @$RateFc; ?>" onkeyup="BalanceProcess()" required <?php echo $form_number; ?>>
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
                          <input type="number" step="any" class="form-control form-hide" name="Total_Available" id="totalAvailable" value="0" onkeyup="BalanceProcess()" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any" class="form-control form-hide" name="Total_Available_Rw" id="totalAvailableRw" value="0" onkeyup="BalanceProcess()" aria-describedby="" <?php echo $form_number; ?>>
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

            if (Number(document.getElementById('balance').value) <= Number(document.getElementById('totalAvailable').value)) {
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
           <?php
           if ($error1 == 1) { echo "errorShow('The Ballance has Been Inserted in the System',1);"; }
           if ($error2 == 1) { echo "errorShow('Main sale updated!',1);"; } ?>
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
