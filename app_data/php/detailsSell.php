<?php
include 'head_no_css.php';
secured();
$sel_id = $_POST['id'];
$env_id = retrieve_data('e_id','selling_e','s_id',$sel_id);
$allow = retrieve_data('view','env_stock','e_id',$env_id);
$invitationLeft = fileData('quantity',$env_id);
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
        <b class="navbar-brand" style="color:#fff;"> #<?php echo $sel_id; ?> </b>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <!-- <li class="active"> <a href="#">Link <span class="sr-only">(current)</span></a> </li> -->
              <li> <a href="sell_envitation_add.php?sid=<?php echo $sel_id; ?>" target="_parent"> <b class="fa fa-shopping-cart"></b> &nbsp;Add Sell </a> </li>
              <!-- <li> <a href="add_balance.php?sid=<?php echo $sel_id; ?>" target="_parent"> <b class="fa fa-plus"></b> &nbsp; Balance </a> </li> -->
              <li ><a href="#" target="" data-toggle="modal" onclick="return balanceModal(<?php echo $sel_id; ?>)" data-target="#balancePop"><b class="fa fa-file-text-o"></b> &nbsp; Balance </a></li>

              <li><a href="bill_print.php?id=<?php echo $sel_id; ?>&I=1" target="_blank"><b class="fa fa-print"></b> &nbsp; Print Bill </a></li>

               <li <?php echo @$admin_style; ?>><a href="edit_sell.php?id=<?php echo $sel_id; ?>" target="_parent"> <b class="fa fa-edit"></b> &nbsp; Edit </a></li>
               <li <?php echo @$admin_style; ?>><a href="app_data/php/deleteSell.php?id=<?php echo $sel_id; ?>" target="_parent" onclick="return confirm('are You sure You want to delete this Sell?')"> <b class="fa fa-trash-o"></b> &nbsp; Delete </a></li>
               <li onclick="sendErr('<?php echo $sel_id; ?>','I')" class=" report-err-butt"> <br> <b class="fa fa-warning"></b> &nbsp; Error</li>

        </ul>



      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>








  <div class="row " style="margin:0px;">
    <div class="col-md-4 fading-item">

<?php if (fileData('e_id',$env_id) != NULL) { ?>
              <!-- <h3>Invitation Details</h3> -->

            <section class="" style="text-align: center; width: 100%; background: #00713d; padding: 9px; border-radius: 8px;">
              <img src="envit/<?php echo fileData('img',$env_id); ?>" alt="" class="img-zm img-thumbnail img-containner-sect" style="max-height: 278px; border: none; padding: 0px;" />
            </section>
            <section class="inv-details">
              <label class="label-inv"> Invitation Id: </label>     <label class="value"> <?php echo fileData('e_id',$env_id); ?> </label> <hr>
              <label class="label-inv"> Invitation color: </label>  <label class="value"> <?php echo fileData('env_color',$env_id); ?> </label> <hr>
              <label class="label-inv"> Invitation size: </label>   <label class="value"> <?php echo fileData('size_w',$env_id); ?> x <?php echo fileData('size_h',$env_id); ?> </label> <hr>
              <label class="label-inv"> Price $: </label>           <label class="value"> <?php echo money(fileData('price_d',$env_id)); ?> </label> <hr>
              <label class="label-inv"> Price Frw: </label>        <label class="value"> <?php echo money(fileData('price_r',$env_id)); ?> </label> <hr>
              <label class="label-inv"> Place: </label>             <label class="value"> <?php echo fileData('place',$env_id); ?> </label> <hr><br>

              <section style="
                  padding: 8px;
                  margin-bottom: 18px;
                  color: #00713d;
                  border-radius: 4px;
                  border: 2px solid #00713d;
              ">
               <label class="label-inv"> Invitation Left:</label>    <label class="value"> <?php echo $invitationLeft; ?> </label>
              </section>

              <label class="label-inv">Invitation Comment: </label>          <br>   <i> <?php echo fileData('comment',$env_id); ?> </i> <hr><br>


            </section>
<?php } else { ?>
<section style="text-align:center;">
   <h2 class="h2-deleted-icon fa fa-frown-o"></h2>
   <p style="color: #e91e4e;font-size: 21px">Invitation Is Deleted</p>
</section>
<?php } ?>


    </div>
    <div class="col-md-4 fading-item">

    <section class="inv-details">
        <h4>Sell Information</h4>
        <label class="label-inv"> Sell Id: </label>     <label class="value"> <?php echo retrieve_data('s_id','selling_e','s_id',$sel_id); ?> </label> <hr>
        <label class="label-inv"> Client: </label>  <label class="value"> <?php echo retrieve_data('client_name','selling_e','s_id',$sel_id); ?> </label> <hr>
        <label class="label-inv"> Type: </label>   <label class="value"> <?php echo retrieve_data('typ','selling_e','s_id',$sel_id); ?> </label> <hr>
        <label class="label-inv"> Date:</label>                <label class="value"> <?php echo retrieve_data('date','selling_e','s_id',$sel_id); ?> </label> <hr><br>
        <label class="label-inv"> Quantity: </label>           <label class="value"> <?php echo retrieve_data('quantity','selling_e','s_id',$sel_id); ?> </label> <hr>
        <label class="label-inv"> Payed In: </label>           <label class="value"> <?php echo retrieve_data('paym_typ','selling_e','s_id',$sel_id); ?> </label> <hr>
        <label class="label-inv"> Print: </label>     <label class="value"> <?php echo retrieve_data('print','selling_e','s_id',$sel_id); ?> </label> <hr>
        <br>
        <?php $done_by_id = retrieve_data('done_by','selling_e','s_id',$sel_id); ?>
        <label class="label-inv"> Done By: </label>
        <label class="value"> <?php echo retrieve_data('username','users','user_id',$done_by_id); ?> </label> <hr>

        <?php $designed_by_id = retrieve_data('design','selling_e','s_id',$sel_id); ?>
        <label class="label-inv"> Designed By: </label>
        <label class="value"> <?php echo retrieve_data('username','users','user_id',$designed_by_id); ?> </label> <hr>
        <!-- <label class="label-inv"> Place: </label>             <label class="value"> <?php echo fileData('place',$env_id); ?> </label> <hr> -->

        <br>
        <label class="label-inv"> Maison: </label>  <label class="value">
          <?php
          $maison_id = retrieve_data('maison_id','selling_e','s_id',$sel_id);
          $maison_name =  retrieve_data('maison_name','maison','maison_id',$maison_id);
          if ($maison_id == '0') {
            echo "No house";
          } else { ?>
            <b style="color:blue;" title=" double-click, for more about <?php echo $maison_name; ?>" ondblclick=" window.open('maison_details.php?id=<?php echo @$maison_id; ?>','_parent');"><?php echo $maison_name; ?> </b>
          <?php } ?>
        </label> <hr>
        <br>
      </section>


      <b style="font-size: 16px;margin: 24px;font-weight: normal;color: #6d6b6b;">Invitation left while printing</b>
      <iframe src="app_data/php/left_invitation.php?id=<?php echo retrieve_data('s_id','selling_e','s_id',$sel_id); ?>" style="width: 88%;border: 0px;border: none;border-bottom: 2px solid #c6c6c6;margin: -1px 5%;height: 42px;margin-bottom: 4px;"></iframe>
      <br>
      <center> <button type="button" data-toggle="modal" class="btn btn-default" data-target="#SellComment" name="button">Invitation Comment</button> </center>




    </div>
    <div class="col-md-4 fading-item">



    <section class="inv-details">
        <h4>Payment</h4>
        <label class="label-inv"> Rate: </label>     <label class="value"> <?php echo @money(retrieve_data('Rate_R','selling_e','s_id',$sel_id)); ?> / <?php echo @money(retrieve_data('Rate_Fc','selling_e','s_id',$sel_id)); ?> </label> <hr>

        <label class="label-inv"> Price Unit: </label>  <label class="value"> <?php echo money(retrieve_data('PU','selling_e','s_id',$sel_id)); ?> <?php echo retrieve_data('paym_typ','selling_e','s_id',$sel_id); ?>
        <?php
        $paym_typ_sell = retrieve_data('paym_typ','selling_e','s_id',$sel_id);
        $Rate_Rw_sell = retrieve_data('Rate_R','selling_e','s_id',$sel_id);
        $Rate_Fc_sell = retrieve_data('Rate_Fc','selling_e','s_id',$sel_id);
        $price_Unit_sell = retrieve_data('PU','selling_e','s_id',$sel_id);


          if ($paym_typ_sell == 'dol') {
            //
                $result = change_rate_receive_php($Rate_Rw_sell, $Rate_Fc_sell,'dol','rw', $price_Unit_sell);
                echo "<h5 class='cash-label'>";
                echo @money(foFixed($result));
                echo " Frw</h5>";
          } elseif ($paym_typ_sell == 'fc') {
            //
                $result = change_rate_receive_php($Rate_Rw_sell, $Rate_Fc_sell,'fc','rw', $price_Unit_sell);
                echo "<h5 class='cash-label'>";
                echo @money(foFixed($result));
                echo " Frw</h5>";
          }

        ?>

         </label>

         <br>

         <div class="money-d-div">
             <h3>Total:</h3>
             <!-- <br> -->
              <label class="label-inv"> Total: </label>   <label class="value"> <?php echo @money(retrieve_data('Price_total','selling_e','s_id',$sel_id)); ?>  <?php echo retrieve_data('paym_typ','selling_e','s_id',$sel_id); ?></label> <hr>
            <?php if ($paym_typ_sell != 'frw') { ?>
              <label class="label-inv"> Total Frw: </label>   <label class="value"> <?php echo @money(retrieve_data('Price_total_Rw','selling_e','s_id',$sel_id)); ?> Frw</label> <hr>
            <?php } ?>
         </div>

         <br>
         <div class="money-d-div">
         <h3>Payed in</h3>
          <label class="label-inv">  Frw: </label>   <label class="value"> <?php echo @money(retrieve_data('Pay_Fr','selling_e','s_id',$sel_id)); ?> Frw </label> <hr>
          <label class="label-inv">  Dol: </label>   <label class="value"> <?php echo @money(retrieve_data('Pay_Dol','selling_e','s_id',$sel_id)); ?> $</label> <hr>
          <label class="label-inv">  Fc: </label>   <label class="value"> <?php echo @money(retrieve_data('Pay_fc','selling_e','s_id',$sel_id)); ?> Fc</label> <hr>
          <br>
          <label class="label-inv"> Total: </label> <label class="value"> <?php echo @money(retrieve_data('Total_Available','selling_e','s_id',$sel_id)); ?> <?php echo retrieve_data('paym_typ','selling_e','s_id',$sel_id); ?></label> <hr>

          <?php if ($paym_typ_sell != 'frw') { ?>
            <label class="label-inv"> Total in Rw: </label>   <label class="value"> <?php echo @money(retrieve_data('Total_Available_Rw','selling_e','s_id',$sel_id)); ?> Frw</label> <hr>
          <?php } ?>
         <br>

          <label class="label-inv"> Balance: </label> <label class="value"> <?php echo @money(retrieve_data('balance','selling_e','s_id',$sel_id)); ?> <?php echo retrieve_data('paym_typ','selling_e','s_id',$sel_id); ?></label> <hr>
          <label class="label-inv"> Payment Type: </label> <label class="value"> <?php echo @retrieve_data('Cash_type','selling_e','s_id',$sel_id); ?> </label> <hr>


         </div>




    </div>





    </div>
  </div>








</div>










<div class="fixed-error-report" id="err_pop"></div>




<!-- ..... -->































<style media="screen">
  .smll-section-td {
      text-align:center;width:33%;background:red;
      height: 100px;

  }

  td.smll-section-td p {
      padding-top: 9px;
      color: #fff;
      padding-bottom: 5px;
      font-size: 18px;
  }

  td.smll-section-td h3 {
    font-size: 28px;
    color: #fff;
    text-shadow: 0px 0px 6px rgba(0, 0, 0, 0.81);
}

</style>
