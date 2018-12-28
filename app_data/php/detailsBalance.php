<?php
include 'head_no_css.php';

$Bid      = $_POST['id'];
$Btype    = $_POST['type'];
$sellId   = @retrieve_data('sell_id', 'balance_table', 'balance_id', $Bid);
?>



    
<style media="screen">
ul.nav.navbar-nav li {
  padding: 0px 5px;
  border-right: 1px solid #76a992;
  border-left: 1px solid #76a992;
}
.navbar-default {
    background-color: #00713d !important;
    border-color: #00713d !important;
    border-radius: 0px !important;
    color: #fff !important;
}
.navbar-default .navbar-brand {
    color: #fff !important;
}
.navbar-default .navbar-nav>li>a {
    color: #ddd !important;
}
.navbar-default .navbar-nav>li>a:hover {
    color: #fff !important;
}
</style>
<div class="">

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <b class="navbar-brand" style="color:#fff;"> BALANCE #<?php echo $Bid; ?> </b>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <?php if ($Btype == 'Invitation') { ?>
                  <li <?php echo @$admin_style; ?>><a href="edit_balance.php?id=<?php echo $Bid; ?>" target="_parent"> <b class="fa fa-edit"></b> &nbsp; Edit </a></li>
                  <li <?php echo @$admin_style; ?>><a onclick="return confirm('Are you sure you want to delete this balance?');" href="delete_balance.php?Bid=<?php echo $Bid; ?>" target="_parent"> <b class="fa fa-trash"></b> &nbsp; Delete </a></li>
            <?php } else { ?>
                  <li <?php echo @$admin_style; ?>><a href="edit_balance.php?id=<?php echo $Bid; ?>&t=D" target="_parent"> <b class="fa fa-edit"></b> &nbsp; Edit </a></li>    
                  <li <?php echo @$admin_style; ?>><a onclick="return confirm('Are you sure you want to delete this balance?');" href="delete_balance.php?Bid=<?php echo $Bid; ?>&type=Divers" target="_parent"> <b class="fa fa-trash"></b> &nbsp; Delete </a></li>    
            <?php } ?>   

        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>




  <div class="row " style="margin:0px;">
    <div class="col-md-4 fading-item">
<!-- ///////////////////////////////////////////////////////// -->
<?php 
if ($Btype == 'Invitation') { 
  $table = 'selling_e';
} else if ($Btype == 'Divers') {
  $table = 'divers_sales';
}
  # INVITATION ############################################################
  $sellPaymentType = retrieve_data('paym_typ', $table, 's_id', $sellId);

  $sellPriceTotal = @retrieve_data('Price_total', $table, 's_id', $sellId);
  $sellPriceTotalFrw = @retrieve_data('Price_total_Rw', $table, 's_id', $sellId);

  $sellTotalCashAvailable = @retrieve_data('Total_Available', $table, 's_id', $sellId);
  $sellTotalCashAvailableFrw = @retrieve_data('Total_Available_Rw', $table, 's_id', $sellId);

  $balanceWas = $sellPriceTotal - $sellTotalCashAvailable;
  $balanceWasFrw = $sellPriceTotalFrw - $sellTotalCashAvailableFrw;
  
?>


    <section class="inv-details">
        <h4>SELL INFO #<?php echo $sellId ?> </h4>
        <br>
        <label class="label-inv"> Client: </label>      <label class="value"> <?php echo @retrieve_data('client_name', $table, 's_id', $sellId); ?> </label> <hr>
        <label class="label-inv"> Date: </label>        <label class="value"> <?php echo @retrieve_data('date', $table, 's_id', $sellId); ?> </label> <hr>
        <br>
        <label class="label-inv"> Payed In: </label>    <label class="value"> <?php echo @$sellPaymentType; ?> </label> <hr>


        <label class="label-inv"> Price Total: </label>        <label class="value"> <?php echo @money($sellPriceTotal); ?>  <?php echo @$sellPaymentType; ?> </label> <hr>
          <?php if ($sellPaymentType != 'frw') { ?>
              <label class="label-inv"> Price Total: </label>        <label class="value"> <?php echo @money($sellPriceTotalFrw); ?> Frw </label> <hr>
          <?php } ?>

        <table class="table" border="1" style="box-shadow: none;border-color: #d8d8d8;">
          <tr>
            <th colspan="3">Cash Payed</th>
          </tr>
          <tr>
            <th>Frw</th>
            <th>$</th>
            <th>Fs</th>
          </tr>
          <tr>
            <td> <?php echo @money(retrieve_data('Pay_Fr', $table, 's_id', $sellId)); ?> Frw </td>
            <td> <?php echo @money(retrieve_data('Pay_Dol', $table, 's_id', $sellId)); ?> $ </td>
            <td> <?php echo @money(retrieve_data('Pay_fc', $table, 's_id', $sellId)); ?> Fc </td>
          </tr>
        </table>


        <label class="label-inv"> Total Payed: </label>        <label class="value"> <?php echo @money($sellTotalCashAvailable); ?>  <?php echo @$sellPaymentType; ?> </label> <hr>
          <?php if ($sellPaymentType != 'frw') { ?>        
            <label class="label-inv"> Total in Frw Payed: </label>     <label class="value"> <?php echo @money($sellTotalCashAvailableFrw); ?> Frw </label> <hr>
          <?php } ?>

        <br>
        <label class="label-inv"> <small>Balance was </small> </label>     <label class="value"> <small><?php echo @money($balanceWas); ?> <?php echo @$sellPaymentType; ?> </small></label> <hr>
          <?php if ($sellPaymentType != 'frw') { ?>
              <label class="label-inv"> <small>Balance was Frw</small> </label>     <label class="value"> <small><?php echo @money($balanceWasFrw); ?> Frw </small></label> <hr>
          <?php } ?>
      

              <section style="padding: 2px 10px; margin-bottom: 7px; color: #00713d; border-radius: 4px; border: 2px solid #00713d;">
               <label class="label-inv" style="color: #00713d;"> Balance:</label>    <label class="value"> <?php echo @money(retrieve_data('balance', $table, 's_id', $sellId)); ?>   <?php echo @$sellPaymentType; ?> </label>
              </section>

              <button class="btn btn-primary btn-sm" onclick="sellDetails(<?php echo @$sellId ?>);"> View sell details</button>
      </section>


<?php
// } else if ($Btype == 'Divers') {
  # DIVERS ################################################################
?>



<?php
// } // end of divers
?>
<!-- /////////////////////////////////////////////////////////////////// -->

    </div>
    <div class="col-md-4 fading-item">

    <section class="inv-details">
        <h4>BALANCE INFO</h4>
        <br>
        <label class="label-inv"> Date: </label>        <label class="value"> <?php echo @retrieve_data('date', 'balance_table', 'balance_id', $Bid); ?> </label> <hr>
        <label class="label-inv"> Actual Date: </label> <label class="value"> <?php echo @retrieve_data('dateTime', 'balance_table', 'balance_id', $Bid); ?> </label> <hr>
        <br>

        <label class="label-inv"> Type: </label>        <label class="value"> <?php echo @retrieve_data('item', 'balance_table', 'balance_id', $Bid); ?> </label> <hr>
        <label class="label-inv"> Item: </label>        <label class="value"> <?php echo @retrieve_data('item_id', 'balance_table', 'balance_id', $Bid); ?> </label> <hr>
        <label class="label-inv"> Sell Id: </label>     <label class="value"> <?php echo @retrieve_data('sell_id', 'balance_table', 'balance_id', $Bid); ?> </label> <hr>
        <br>

        <label class="label-inv"> Client: </label>      <label class="value"> <?php echo @retrieve_data('client_name', 'balance_table', 'balance_id', $Bid); ?> </label> <hr>
        <label class="label-inv"> Payed In: </label>    <label class="value"> <?php echo @retrieve_data('paym_typ', 'balance_table', 'balance_id', $Bid); ?> </label> <hr>
        <br>
        <?php $done_by_id = @retrieve_data('done_by', 'balance_table', 'balance_id', $Bid); ?>
        <label class="label-inv"> Done By: </label>     <label class="value"> <?php echo @retrieve_data('username', 'users', 'user_id', $done_by_id); ?> </label> <hr>

      </section>



    </div>
    <div class="col-md-4 fading-item">



    <section class="inv-details">
        <h4>PAYMENT</h4> <br>
        <label class="label-inv"> Rate: </label>     <label class="value"> <?php echo @money(retrieve_data('Rate_R', 'balance_table', 'balance_id', $Bid)); ?> / <?php echo @money(retrieve_data('Rate_Fc', 'balance_table', 'balance_id', $Bid)); ?> </label> <hr>
        <?php
        $paym_typ_sell     = @retrieve_data('paym_typ', 'balance_table', 'balance_id', $Bid);
        $Rate_Rw_sell      = @retrieve_data('Rate_R', 'balance_table', 'balance_id', $Bid);
        $Rate_Fc_sell      = @retrieve_data('Rate_Fc', 'balance_table', 'balance_id', $Bid);
        $price_Unit_sell   = @retrieve_data('PU', 'balance_table', 'balance_id', $Bid);


        ?>

         </label>

         <br>

         <div class="money-d-div">
         <h3>Payed in</h3>
          <label class="label-inv">  Frw: </label>   <label class="value"> <?php echo @money(retrieve_data('Pay_Fr', 'balance_table', 'balance_id', $Bid)); ?> Frw </label> <hr>
          <label class="label-inv">  Dol: </label>   <label class="value"> <?php echo @money(retrieve_data('Pay_Dol', 'balance_table', 'balance_id', $Bid)); ?> $</label> <hr>
          <label class="label-inv">  Fco: </label>   <label class="value"> <?php echo @money(retrieve_data('Pay_fc', 'balance_table', 'balance_id', $Bid)); ?> Fc</label> <hr>
          <br>
          <label class="label-inv">  Total: </label> <label class="value <?php if ($paym_typ_sell == 'frw') { echo 'popGrandTotal'; } ?>"> <?php echo @money(retrieve_data('Total_Available', 'balance_table', 'balance_id', $Bid)); ?> <?php echo @retrieve_data('paym_typ', 'balance_table', 'balance_id', $Bid); ?></label> <hr>

          <?php if ($paym_typ_sell != 'frw') { ?>
            <label class="label-inv"> Grand Total in Rw: </label> 
            <label class="value popGrandTotal"> <?php echo @money(retrieve_data('Total_Available_Rw', 'balance_table', 'balance_id', $Bid)); ?> Frw</label> <hr>
          <?php 
        } ?>
         <br>

         </div>

    </div>
    </div>
  </div>
</div>










<div class="fixed-error-report" id="err_pop"></div>




<!-- ..... -->
