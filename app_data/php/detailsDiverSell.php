<?php
include 'head_no_css.php';
secured();
$s_id = $_POST['id'];
// $s_id = $_GET['id'];

$divS_id = retrieve_data('div_id','divers_sales','s_id',$s_id);
// $allow = retrieve_data('view','env_stock','e_id',$divS_id);
// $invitationLeft = fileData('quantity',$divS_id);
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
<div class=""> <!-- big holder -->

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
        <b class="navbar-brand" style="color:#fff;"> #<?php echo $s_id; ?> </b>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
              <li> <a href="saleDivers.php?pro_id=<?php echo $divS_id; ?>" target="_parent"> <b class="fa fa-shopping-cart"></b> &nbsp;Add Sell </a> </li>

              <li >

                <a onclick="return balanceModal(<?php echo $s_id; ?>, 'Divers')" href="#" target="" data-toggle="modal" data-target="#balancePop"><b class="fa fa-file-text-o"></b> &nbsp; Balance </a>

              <li> <a href="bill_print_divers.php?id=<?php echo $s_id; ?>" target="_blank"> <b class="fa fa-print"></b> &nbsp; Print Bill </a></li>


              <!-- <section class="adm-optn"> -->
               <li <?php echo @$admin_style; ?>><a href="saleDivers_update.php?id=<?php echo $s_id; ?>" target="_parent"> <b class="fa fa-edit"></b> &nbsp; Edit </a></li>
               <li <?php echo @$admin_style; ?>><a href="app_data/php/deleleDiversSell.php?id=<?php echo $s_id; ?>" target="_parent" onclick="return confirm('are You sure You want to delete this Sell?')"> <b class="fa fa-trash-o"></b> &nbsp; Delete </a></li>
              <!-- </section> -->
              <li onclick="sendErr('<?php echo $s_id; ?>','D')" class=" report-err-butt"> <br> <b class="fa fa-warning"></b> &nbsp; Error</li>

        </ul>



      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>








  <div class="row" style="margin:0px;">
    <div class="col-md-4 fading-item">


<?php if ($divS_id != NULL) { ?>
              <!-- <h3>Product Details </h3> -->

            <section class="" style="text-align: center; width: 100%; background: #00713d; padding: 9px; border-radius: 8px;">
               <h2 class="fa fa-cube pulse animated" style="margin: 0;font-size: 190px;text-align: center;display: block;color: #ffffff;padding: 17px;"></h2>
            </section>
            <br>

            <section class="inv-details">
               <label class=""> <b style="font-size: 21px; color: #01904e;"><?php echo @retrieve_data('pro_name', 'products', 'pro_id', $divS_id); ?> </label> </b><br><hr>
              <label class="label-inv"> Product Id: </label>     <label class="value"> #<?php echo @retrieve_data('pro_id','products','pro_id',$divS_id); ?> </label> <hr>
              <!-- <label class="label-inv"> Product color: </label>  <label class="value">  <?php echo @retrieve_data('pro_quantity','products','pro_id',$divS_id); ?> </label> <hr> -->
              <label class="label-inv"> Price $: </label>           <label class="value">  <?php echo @money(retrieve_data('price_dol','products','pro_id',$divS_id)); ?> $</label> <hr>
              <label class="label-inv"> Price Rfwa: </label>        <label class="value">  <?php echo @money(retrieve_data('price_frw','products','pro_id',$divS_id)); ?> Frw</label> <hr>
              <label class="label-inv"> Place: </label>             <label class="value">  <?php echo @retrieve_data('place','products','pro_id',$divS_id); ?></label> <hr><br>
              <label class="label-inv"> Product Left:</label>    <label class="value">  <?php echo @retrieve_data('pro_quantity','products','pro_id',$divS_id); ?> </label> <hr> <br>

              <!-- <center> <button style="" type="button" data-toggle="modal" data-target="#Invcomment" class="btn btn-default">Product Comment</button> </center> -->

              <label class="label-inv"> Comments:</label> <br>
              <p><b> <?php echo @retrieve_data('pro_comment','products','pro_id',$divS_id); ?> </b></p>

            </section>
<?php } else { ?>
<section style="text-align:center;">
   <h2 class="h2-deleted-icon fa fa-frown-o"></h2>
   <p style="color: #e91e4e;font-size: 21px">Product Is Deleted</p>
</section>
<?php } ?>


    </div>
    <div class="col-md-4 fading-item">

    <section class="inv-details">
        <h4>Sell Information</h4>
        <label class="label-inv"> Sell Id: </label>     <label class="value"> #<?php echo retrieve_data('s_id','divers_sales','s_id',$s_id); ?> </label> <hr>
        <label class="label-inv"> Client: </label>  <label class="value"> <?php echo retrieve_data('client_name','divers_sales','s_id',$s_id); ?> </label> <hr>
        <!-- <label class="label-inv"> Type: </label>   <label class="value"> <?php echo retrieve_data('typ','divers_sales','s_id',$s_id); ?> </label> <hr> -->
        <label class="label-inv"> Date:</label>                <label class="value"> <?php echo retrieve_data('date','divers_sales','s_id',$s_id); ?> </label> <hr><br>
        <label class="label-inv"> Quantity: </label>           <label class="value"> <?php echo retrieve_data('quantity','divers_sales','s_id',$s_id); ?> </label> <hr>
        <label class="label-inv"> Payed In: </label>           <label class="value"> <?php echo retrieve_data('paym_typ','divers_sales','s_id',$s_id); ?> </label> <hr>
        <!-- <label class="label-inv"> Print: </label>     <label class="value"> <?php echo retrieve_data('print','divers_sales','s_id',$s_id); ?> </label> <hr> -->
        <br>
        <?php $done_by_id = retrieve_data('done_by','divers_sales','s_id',$s_id); ?>
        <label class="label-inv"> Done By: </label>
        <label class="value"> <?php echo retrieve_data('username','users','user_id',$done_by_id); ?> </label> <hr>

        <br>
        <label class="label-inv"> Maison: </label>  <label class="value">
          <?php
          $maison_id = retrieve_data('maison_id','divers_sales','s_id',$s_id);
          $maison_name =  retrieve_data('maison_name','maison','maison_id',$maison_id);
          if ($maison_id == '0') {
            echo "No house";
          } else { ?>
            <b style="color:blue;" title=" double-click, for more about <?php echo $maison_name; ?>" ondblclick=" window.open('maison_details.php?id=<?php echo @$maison_id; ?>','_parent');"><?php echo $maison_name; ?> </b>
          <?php } ?>
        </label> <hr>
        <br>


<br>
<label class="label-inv"> Comment: </label>
<br>
  <p> <b> <?php echo retrieve_data('comment','divers_sales','s_id',$s_id); ?> </b></p>
      </section>



    </div>
    <div class="col-md-4 fading-item">



    <section class="inv-details">
        <h4>Payment</h4>
        <label class="label-inv"> Rate: </label>     <label class="value"> <?php echo @money(retrieve_data('Rate_R','divers_sales','s_id',$s_id)); ?> / <?php echo @money(retrieve_data('Rate_Fc','divers_sales','s_id',$s_id)); ?> </label> <hr>

        <label class="label-inv"> Price Unit: </label>  <label class="value"> <?php echo money(retrieve_data('PU','divers_sales','s_id',$s_id)); ?> <?php echo retrieve_data('paym_typ','divers_sales','s_id',$s_id); ?>
        <?php
        $paym_typ_sell = retrieve_data('paym_typ','divers_sales','s_id',$s_id);
        $Rate_Rw_sell = money(retrieve_data('Rate_R','divers_sales','s_id',$s_id));
        $Rate_Fc_sell = money(retrieve_data('Rate_Fc','divers_sales','s_id',$s_id));
        $price_Unit_sell = money(retrieve_data('PU','divers_sales','s_id',$s_id));


          if ($paym_typ_sell == 'dol') {
            //
                $result = change_rate_receive_php($Rate_Rw_sell, $Rate_Fc_sell,'dol','rw', $price_Unit_sell);
                echo "<h5 class='cash-label'>";
                echo @money($result);
                echo " Frw</h5>";
          } elseif ($paym_typ_sell == 'fc') {
            //
                $result = change_rate_receive_php($Rate_Rw_sell, $Rate_Fc_sell,'fc','rw', $price_Unit_sell);
                echo "<h5 class='cash-label'>";
                echo @money($result);
                echo " Frw</h5>";
          }

        ?>

         </label>

         <br>

         <div class="money-d-div">
             <h3>Total:</h3>
             <!-- <br> -->
              <label class="label-inv"> Total: </label>   <label class="value"> <?php echo @money(retrieve_data('Price_total','divers_sales','s_id',$s_id)); ?>  <?php echo retrieve_data('paym_typ','divers_sales','s_id',$s_id); ?></label> <hr>
            <?php if ($paym_typ_sell != 'frw') { ?>
              <label class="label-inv"> Total Rw: </label>   <label class="value"> <?php echo @money(retrieve_data('Price_total_Rw','divers_sales','s_id',$s_id)); ?> Frw</label> <hr>
            <?php } ?>
         </div>

         <br>
         <div class="money-d-div">
         <h3>Payed in</h3>
          <label class="label-inv"> In Frw: </label>   <label class="value"> <?php echo @money(retrieve_data('Pay_Fr','divers_sales','s_id',$s_id)); ?> Frw </label> <hr>
          <label class="label-inv"> In Dol: </label>   <label class="value"> <?php echo @money(retrieve_data('Pay_Dol','divers_sales','s_id',$s_id)); ?> $</label> <hr>
          <label class="label-inv"> In Fco: </label>   <label class="value"> <?php echo @money(retrieve_data('Pay_fc','divers_sales','s_id',$s_id)); ?> Fc</label> <hr>
          <br>
          <label class="label-inv"> Total Payed: </label> <label class="value"> <?php echo @money(retrieve_data('Total_Available_Rw','divers_sales','s_id',$s_id)); ?> <?php echo retrieve_data('paym_typ','divers_sales','s_id',$s_id); ?></label> <hr>

          <?php if ($paym_typ_sell != 'frw') { ?>
            <label class="label-inv"> Total Payed in Rw: </label>   <label class="value"> <?php echo @money(retrieve_data('Total_Available_Rw','divers_sales','s_id',$s_id)); ?> Frw</label> <hr>
          <?php } ?>
         <br>
          <label class="label-inv"> Balance: </label> <label class="value"> <?php echo @money(retrieve_data('balance','divers_sales','s_id',$s_id)); ?> <?php echo retrieve_data('paym_typ','divers_sales','s_id',$s_id); ?></label> <hr>
          <label class="label-inv"> Payment Type: </label> <label class="value"> <?php echo @retrieve_data('Cash_type','divers_sales','s_id',$s_id); ?> </label> <hr>

         </div> <!-- end of money d div -->

    </div> <!-- end of colom 3 -->

</div> <!-- row -->
</div> <!-- end of big holder -->



<div class="fixed-error-report" id="err_pop"></div>
