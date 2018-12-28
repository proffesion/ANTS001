<?php
// include 'app_data/php/head.php';
include 'app_data/php/head_blank.php';
secured();
admin_page();

// check if the id is set
if (!isset($_GET['id']) || empty($_GET['id'])) {
     echo "<script> window.open('home.php','_self'); </script>";
}
$sell_id = $_GET['id']; // the sell id

$env_id = retrieve_data('e_id','selling_e','s_id',$sell_id);
$allow = retrieve_data('view','env_stock','e_id',$env_id);
$invitationLeft = fileData('quantity',$env_id);


$sll_id = retrieve_data('e_id','env_stock','e_id',$env_id);

// FIND THE BALANCE
$Paymnt_type = retrieve_data('paym_typ','selling_e','s_id',$sell_id);
$Db_balance = retrieve_data('balance','selling_e','s_id',$sell_id);
// definning the variables
@$balance_db_frw = 0;
@$balance_db_dol = 0;
@$balance_db_fc = 0;
// condition
if ($Paymnt_type == 'frw') {
     @$balance_db_frw = $Db_balance;
} elseif ($Paymnt_type == 'fc') {
     @$balance_db_dol = $Db_balance;
} elseif ($Paymnt_type == 'dol') {
     @$balance_db_fc = $Db_balance;
}
// END OF FIND BALANCE


// FIND THE PRICE UNIT
$PU_ch = retrieve_data('PU','selling_e','s_id',$sell_id);
// defining the variables
@$mod_Pu_frw = 0;
@$mod_Pu_dol =  0;
@$mod_Pu_fc = 0;
// condition
if ($Paymnt_type == 'frw') {
     @$mod_Pu_frw = $PU_ch;
} else if ($Paymnt_type == 'dol') {
     @$mod_Pu_dol = $PU_ch;
} else if ($Paymnt_type == 'fc') {
     @$mod_Pu_fc = $PU_ch;
}
// END OF PRICE UNIT


?>

   <!-- <div class="alert alert-success bounceIn animated" role="alert">
       <b>Your changes has been updated!!</b> <br>
       if you did some change about the quantity, <a href="update_stock.php?id=<?php echo @$env_id; ?>">Click here to update the stock </a>
   </div> -->


<!-- modal for selling more than what we have -->
<div class="modal fade in" id="myModaSELLDONE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-styled-success">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <!-- <img src="app_data/imgs/01_no_more_in_stock.png" class="img-icon-shw" alt="" /> -->
        <h1 class="icon-sub-font fa fa-check"></h1>
        <h2 class="title-sub">Your changes has been updated!!</h2>
        <p>if you did some change on quantity, <a href="update_stock.php?id=<?php echo @$env_id; ?>">Click here to update the stock </a></p>
      </div>
      <div class="modal-footer">
      <a href="update_stock.php?id=<?php echo @$env_id; ?>">
          <button type="button" class="btn btn-info">Update Stock</button>
      </a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="home.php"> <button type="button" class="btn btn-primary">Back</button> </a>
      </div>
    </div>
  </div>
</div>


<style>
.popover { display: none; }
</style>




<!-- contents start here -->

<form class="" action="edit_sell.php?id=<?php echo $sell_id; ?>" method="post">

<a href="home.php"> <h2 class="fa fa-chevron-circle-left back-arrow-butt slideInLeft animated"></h2> </a>

<div>

<div class="row" style="margin:0px;">
<div class="col-md-2 div-inv-info" style="">

<div class="company-name">
   ANTARES
</div>

  <div class="title"> <!-- invitation title -->
     <h2 style="font-size: 23px;">Stock Details:</h2>
  </div><!-- /.title -->

   <div class="invitation-sub-content">

    <div class="thumbnail pop-butt-upd-cont">
      <img src="envit/<?php echo fileData('img',$env_id); ?>" alt="...">
      <section class="pop-butt-upd">
        <a href="invitationUpdateChangeCode.php?sid=<?php echo $sell_id; ?>">
          <button type="button" class="btn btn-success" style="box-shadow: 0px 0px 36px 74px #0000006b; margin-top: 18px;"> <b class="fa fa-edit"></b> Change </button>
        </a>
      </section>

        <div class="caption">
        <h3 style="font-size: 18px;"><?php echo @$env_id; ?></h3>
      </div>
    </div>



<div class="stock-details">
        <p> <label> Color: </label> <b><?php echo fileData('env_color',$env_id); ?></b> </p>
        <p> <label> quantity: </label> <b><?php echo fileData('quantity',$env_id); ?></b> </p>
        <p class="lt-hide"> <label> Price Unit $: </label> <b><?php echo fileData('price_d',$env_id); ?> $</b> </p>
        <p> <label> Price Unit Frw: </label> <b><?php echo fileData('price_r',$env_id); ?> frw</b> </p>
        <p> <label> Place: </label> <b> <?php echo fileData('place',$env_id); ?> </b> </p>
        <br>
        <label> Comment: </label>
        <div class="comment-box scroll"> <?php echo fileData('comment',$env_id); ?> </div>
        <br>
  </div> <!-- /.stock-details -->

   </div> <!-- /.invitation-sub-content -->

</div> <!-- /.div-inv-info -->

<div class="col-md-10 form-containner"> <!-- =====================================================================================  -->

   <div class="section-one">
        <h1 class="title-sell" style="background-color:#d01857;">SELL UPDATE &nbsp; <b> #<?php echo @$sell_id; ?> </b> </h1>
   </div> <!-- /.section-one -->

<!-- ALERT DIV -->
<div class="" style="background: rgb(176, 148, 148); padding: 13px 19px; border-top: 1px solid #fff;color: #fff;">
  <div class="row">
    <div class="col-xs-6 col-md-2" style="text-align:center;">
       <h2 class="fa fa-warning bounceIn animated infinite" style="font-size: 65px; margin: auto; padding-top: 8px;"></h2>
    </div>
    <div class="col-xs-12 col-md-10">
            <h3 style="padding-left: 23px;">WARNING!!</h3>
                <ul>
                  <li>The change you will make here, will not be updated in others tables (Stock)<br></li>
                  <li>if you are working with the <b>Sell Quantity</b>,
                    Please update the <b>Quantity</b> in Stock by clicking  <a href="update_stock.php?id=<?php echo @$env_id; ?>">here</a> <br>
                    <i>( this will help you to have a claer report )</i>
                  </li>
                </ul>
           </div>
  </div>
</div>



<?php

if (isset($_POST['Sell_envitation'])) {
 //  defining the variables
 // @$s_id = $_POST['s_id'];
 // @$e_id = $_POST['e_id'];
 @$typ = $_POST['typ'];
 @$quantity = $_POST['quantity'];
 @$client_name = $_POST['client_name'];
 // @$date = $_POST[''];

 @$print = $_POST['print'];
 @$design = $_POST['design'];
 @$maison_id = $_POST['maison_id'];
 @$paym_typ = $_POST['paym_typ'];
 @$Cash_type = $_POST['Cash_type'];

 // rate
 @$Rate_R = $_POST['Rate_R'];
 @$Rate_Fc = $_POST['Rate_Fc'];

 // pay cash
 @$Pay_Fr = $_POST['Pay_Fr'];
 @$Pay_Dol = $_POST['Pay_Dol'];
 @$Pay_fc = $_POST['Pay_fc'];

 // price total
 @$Price_total = $_POST['Price_total'];
 @$Price_total_Rw = $_POST['Price_total_Rw'];

 @$Total_Available = $_POST['Total_Available'];
 @$Total_Available_Rw = $_POST['Total_Available_Rw'];

 @$comment = $_POST['comment'];

 // price unit
 @$PU_Rw = $_POST['PU_Rw'];
 @$PU_Dol = $_POST['PU_Dol'];
 @$PU_Fc = $_POST['PU_Fc'];

 @$Bal_rw = $_POST['Bal_rw'];
 @$Bal_dol = $_POST['Bal_dol'];
 @$Bal_fc = $_POST['Bal_fc'];


  // date
  $date_d_form = $_POST['date_date'];
  $date_m_form = $_POST['date_m'];
  $date_y_form = $_POST['date_y'];
  $date_form_modif = "$date_d_form-$date_m_form-$date_y_form";
  $curent_date_db = retrieve_data('date','selling_e','s_id',$sell_id);

  if (isset($_POST['date_date']) && !empty($_POST['date_date'])) {
    $date_db_save = $date_form_modif;
  } else {
    $date_db_save = $curent_date_db;

  }

  // echo '<h1> '. $date_db_save .'</h1>';


 // find the balance and the price unit
 if ($paym_typ == 'frw') {
     $PU = $PU_Rw; // PU
     $BAL = $Bal_rw; // the balance
 } elseif ($paym_typ == 'fc') {
     $PU = $PU_Fc; // PU
     $BAL = $Bal_fc; // the balance
 } elseif ($paym_typ == 'dol') {
     $PU = $PU_Dol; // PU
     $BAL = $Bal_dol; // the balance
 }

 $query = "UPDATE `selling_e` SET
  `typ` = '$typ',
  `quantity` = '$quantity',
  `client_name` = '$client_name',
  `print` = '$print',
  `design` = '$design',
  `maison_id` = '$maison_id',
  `paym_typ` = '$paym_typ',
  `Cash_type` = '$Cash_type',
  `PU` = '$PU',
  `Rate_R` = '$Rate_R',
  `Rate_Fc` = '$Rate_Fc',
  `Pay_Fr` = '$Pay_Fr',
  `Pay_Dol` = '$Pay_Dol',
  `Pay_fc` = '$Pay_fc',
  `Price_total` = '$Price_total',
  `Price_total_Rw` = '$Price_total_Rw',
  `Total_Available` = '$Total_Available',
  `Total_Available_Rw` = '$Total_Available_Rw',
  `balance` = '$BAL',
  `date` = '$date_db_save',
  `comment` = '$comment'
WHERE
  `s_id`='$sell_id'";
 if ($Query_one_run = $mysqli->query($query)) {

   ?>
        <script type="text/javascript">
            $(function(){
              $('#myModaSELLDONE').modal('show');
            });
        </script>

   <div class="top-fixed">

   <div class="alert alert-success alert-dismissible  fadeInDown animated" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <strong>Well done!</strong> Process Done.
   </div>
   </div>




 <?php
 } else {
   echo '<div class="alert alert-danger" role="alert"> <b>Ooops!! some thing wrong, Please try again later.</b> </div>';
 }


}
?>






   <div class="section-one" style="background: #ececec;">
        <div class="inner-dv">

        <div class="row">
          <div class="col-md-4">
            <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">Client</span>
                  <input type="text" class="form-control" name="client_name" value="<?php echo retrieve_data('client_name','selling_e','s_id',$sell_id); ?>" id="" placeholder=" Name" title="Text only" minlength="3" required="" <?php echo $form_text; ?>>
                </div>
                <span id="" class="sr-only">(success)</span>
              </div>
          </div>
          <div class="col-md-2">

            <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">Type</span>
                  <select class="form-control" name="typ" required="">
                    <option value="Addition">Addition</option>
                    <option value=""></option>
                    <option value="New">New</option>
                  </select>
                </div>
                <span id="" class="sr-only">(success)</span>
              </div>

          </div>

          <div class="col-md-2">

          <div class="form-group has-feedback">
              <div class="input-group">
                <span class="input-group-addon">Print</span>
                <select class="form-control" name="print" required="">
                  <option value="<?php echo retrieve_data('print','selling_e','s_id',$sell_id); ?>"><?php echo retrieve_data('print','selling_e','s_id',$sell_id); ?></option>
                    <option value=""></option>

                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
               </select>
              </div>
              <span id="" class="sr-only">(success)</span>
            </div>

        </div>


          <div class="col-md-4">

            <div class="input-group">
              <span class="input-group-addon">Maison</span>
              <select class="form-control" name="maison_id" required="">
                  <?php
                     $maison = retrieve_data('maison_id','selling_e','s_id',$sell_id);
                     $maison_name =  retrieve_data('maison_name','maison','maison_id',$maison);
                     if ($maison == '0') {
                       echo '<option value="0">None</option>';
                     } else {
                       echo "<option value='$maison'>$maison_name</option>";
                     }
                   ?>
                  <option value=""></option>
                  <option value="0">None</option>
                  <?php
                  $results_users = $mysqli->query("SELECT `maison_id`,`maison_name` FROM `maison` WHERE `view`='1'");
                  if ($results_users->num_rows == NULL) {
                  } else {
                      while($rowe = $results_users->fetch_array()) {
                        $maison_id = $rowe["maison_id"];
                        $maison_name = $rowe["maison_name"];
                        echo "<option value='$maison_id'>$maison_name</option>";
                      }
                  } ?>
              </select>
            </div>

          </div>
        </div><!-- /.row -->


        <div class="row" style=" padding-top: 11px; ">
          <div class="col-md-4">


            <div class="input-group">
              <span class="input-group-addon">Designed By</span>
              <select class="form-control" name="design" required="">
                <?php
                   $designer = retrieve_data('design','selling_e','s_id',$sell_id);
                   $designer_name =  retrieve_data('username','users','user_id',$designer);
                   if ($designer == '0') {
                     echo '<option value="0">None</option>';
                   } else {
                     echo "<option value='$designer'>$designer_name</option>";
                   }
                 ?>
                  <option value=""></option>
                  <option value="0">None</option>
                  <?php
                  $results_users = $mysqli->query("SELECT `user_id`,`username` FROM `users` WHERE `perm`='1'");
                  if ($results_users->num_rows == NULL) {
                  } else {
                      while($rowe = $results_users->fetch_array()) {
                        $user_id = $rowe["user_id"];
                        $username = $rowe["username"];
                        echo "<option value='$user_id'>$username</option>";
                      }
                  } ?>
              </select>
            </div>


          </div>
          <div class="col-md-4">

            <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">Sell Done By</span>
                  <input type="text" name="done_by" class="form-control" value="<?php $sell_done_by = retrieve_data('done_by','selling_e','s_id',$sell_id); echo retrieve_data('lname','users','user_id',$sell_done_by); ?>" id="" placeholder="" readonly="">
                </div>
              </div>


          </div>
          <div class="col-md-4">
          <div class="date-edit-cont">
                <div class="date-display">

                <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">Date</span>
                  <input type="text" name="" class="form-control" value="<?php  echo  @retrieve_data('date','selling_e','s_id',$sell_id); ?>" id="" placeholder="" readonly="">
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
                                              for ($i= 1; $i <= 31; $i++) {
                                                if ($i <= 9) { $comp = "0"; } else { $comp = ""; }
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
                                              for ($i= 2010; $i <= $this_year; $i++) {
                                                echo '<option value="'.$i.'">'.$i.'</option>';
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


   <div class="row" style="margin: 0px; padding-top: 15px; ">
     <div class="col-md-4">&nbsp;</div>
     <div class="col-md-4">&nbsp;</div>
     <div class="col-md-4">

               <div class="form-group has-feedback" style="max-width: 225px;float: right;">
                 <div class="input-group">
                   <span class="input-group-addon" style="background: green; color: #fff;"><b class="fa fa-calculator fadeIn animated infinite"></b> Auto Calculation </span>
                    <select  name="" id="activ" class="form-control" >
                        <option value="1">On</option>
                         <option value="0">Off</option>
                    </select>
                 </div>
               </div>


               <section class="clear-both">x</section>
     </div>
   </div>
   <!-- ================================== -->












   <!-- ======================================== -->


   <div class="section-one" style="background: #fff;">
        <div class="inner-dv">



          <div class="row">
            <div class="col-xs-12 col-md-8">

              <div class="">
                <div class="row">
                  <div class="col-xs-6">
                    <h3 class="section-title">Payment</h3>
                  </div>
                </div>
                <div class="row">

                  <div class="col-xs-6">
                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Payment Type</span>
                          <select id="paymentType" name="paym_typ" class="form-control" onchange="sellUpdateProcessF()">
                            <option value="<?php echo retrieve_data('paym_typ','selling_e','s_id',$sell_id); ?>"><?php echo retrieve_data('paym_typ','selling_e','s_id',$sell_id); ?></option>

                            <optgroup label="---">
                               <option value="">Select Type</option>
                               <option value="frw">frw</option>
                               <option value="fc">fc</option>
                               <option value="dol">dol</option>
                              </optgroup>
                           </select>
                        </div>
                      </div>

                  </div>
                  <div class="col-xs-6">

                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Quantity</span>
                          <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo retrieve_data('quantity','selling_e','s_id',$sell_id); ?>" onkeyup="sellUpdateProcessF()" <?php echo $form_number; ?>>
                        </div>
                      </div>

                  </div>
                </div><!-- .row -->
              </div>

              <hr class="separator">

              <h3 class="section-title">Price Unit</h3>
              <!-- <br> -->




              <div class="row priceUnitRow">
                <div class="col-xs-6 puRwGrpup col-md-4">
                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">Frw</span>
                        <input type="number" step="any" class="form-control" name="PU_Rw" id="priceUnitR" onkeyup="sellUpdateProcessF()" value="<?php echo @$mod_Pu_frw; ?>" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>


                <div class="col-xs-6 col-md-4">
                  <div class="form-group puDolGrpup has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" step="any" class="form-control" id="priceUnitD" name="PU_Dol" onkeyup="sellUpdateProcessF()" value="<?php echo @$mod_Pu_dol; ?>" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>

                <div class="col-xs-6 col-md-4">
                  <div class="form-group puFcGrpup has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">Fco</span>
                        <input type="number" step="any" class="form-control" id="priceUnitFc" name="PU_Fc" onkeyup="sellUpdateProcessF()" value="<?php echo @$mod_Pu_fc; ?>" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <span id="" class="sr-only">(success)</span>
                  </div>


                </div>
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
                          <input type="number" step="any" class="form-control" id="inCashRw" name="Pay_Fr" value="<?php echo retrieve_data('Pay_Fr','selling_e','s_id',$sell_id); ?>" onkeyup="sellUpdateProcessF()" data-toggle="inCashRw" aria-describedby="" <?php echo $form_number; ?>>
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
                        <input type="number" step="any" class="form-control" name="Pay_Dol" id="inCashDol" value="<?php echo retrieve_data('Pay_Dol','selling_e','s_id',$sell_id); ?>" onkeyup="sellUpdateProcessF()" data-toggle="inCashDol" aria-describedby="" <?php echo $form_number; ?>>
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
                          <input type="number" step="any" class="form-control" name="Pay_fc" id="inCashFc" value="<?php echo retrieve_data('Pay_fc','selling_e','s_id',$sell_id); ?>" onkeyup="sellUpdateProcessF()" data-toggle="inCashFc" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                        <span id="" class="sr-only">(success)</span>
                    </div>


                </div>
              </div>



<div>
              <hr class="separator">

              <h3 class="section-title">Balance</h3>
              <!-- <br> -->
              <div class="row">
                <div class="col-xs-6 col-md-4">
                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">Frw</span>
                        <input type="number" step="any" class="form-control" name="Bal_rw" id="balCashRw" value="<?php echo @$balance_db_frw; ?>" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <!--  -->
                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>


                <div class="col-xs-6 col-md-4">
                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" step="any" class="form-control"  name="Bal_dol" id="balCashDol" value="<?php echo @$balance_db_dol; ?>" aria-describedby="" <?php echo $form_number; ?>>
                      </div>

                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>

                <div class="col-xs-6 col-md-4">
                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">Fco</span>
                        <input type="number" step="any" class="form-control"  name="Bal_fc" id="balCashFc" value="<?php echo @$balance_db_fc; ?>" aria-describedby="" <?php echo $form_number; ?>>
                      </div>

                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>
              </div>
              <hr class="separator">
               <div class="row">
               <div class="col-md-12">

                     <b>Comment</b>
                     <textarea class="form-control" rows="" name="comment" cols=""><?php echo retrieve_data('comment','selling_e','s_id',$sell_id); ?></textarea>

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
                        <input type="number" step="any" class="form-control form-hide form-small" id="rateRw" name="Rate_R" value="<?php echo retrieve_data('Rate_R','selling_e','s_id',$sell_id); ?>" onkeyup="sellUpdateProcessF()" required <?php echo $form_number; ?>>
                      </div>
                  </div>
                  <div class="col-md-6"  style="padding: 0;">
                    <div class="form-group" style="padding: 0;">
                      <label for="">Fco</label>
                      <input type="number" step="any" class="form-control form-hide form-small"  id="rateCo" name="Rate_Fc" value="<?php echo retrieve_data('Rate_Fc','selling_e','s_id',$sell_id); ?>" onkeyup="sellUpdateProcessF()" required <?php echo $form_number; ?>>
                    </div>
                  </div>
                </div>


              </section>

                </div>


                <div class="price-total">
                     <h3>Price Total</h3>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon"><label id="cashTypDisplay"></label></span>
                          <input type="number" step="any" class="form-control form-hide"  name="Price_total" id="totalPrice" value="<?php echo retrieve_data('Price_total','selling_e','s_id',$sell_id); ?>" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any" class="form-control form-hide" name="Price_total_Rw" id="totalPriceRw" value="<?php echo retrieve_data('Price_total_Rw','selling_e','s_id',$sell_id); ?>" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>
                </div>



                <div class="price-total">
                     <h3>Total Available</h3>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon"><label id="cashTypDisplay1"></label></span>
                          <input type="number" step="any" class="form-control form-hide" name="Total_Available" id="totalAvailable" value="<?php echo retrieve_data('Total_Available','selling_e','s_id',$sell_id); ?>"  aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any" class="form-control form-hide" name="Total_Available_Rw" id="totalAvailableRw" value="<?php echo retrieve_data('Total_Available_Rw','selling_e','s_id',$sell_id); ?>"  aria-describedby="" <?php echo $form_number; ?>>
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
                     <input type="submit" name="Sell_envitation" class="btn btn-primary" value="Update Info">
                  </div>
                </div>



</form>
            </div>
          </div>



        </div> <!-- /.inner-dv -->
   </div> <!-- /.section-one -->
</div> <!-- /.sell-c0ntainner-div -->


</div>
<b id="cashTypDisplay2" style="opacity:0;font-size:0px;"></b>


<?php include 'app_data/php/foater.php' ?>
<script type="">

          // var rC = document.getElementById('rateCo').value;
          // var rR = document.getElementById('rateRw').value;
          // var puD = document.getElementById('priceUnitD').value;
          // // inetr a value in 'priceUnitFc' price unite congolee
          // var puFcong = change_rate_receive(rR, rC, 'dol', 'fc', puD);
          // document.getElementById('priceUnitFc').value = puFcong.toFixed(2);


                  function sellUpdateProcessF() {
                      var active = document.getElementById('activ').value;

                      if (active == '1') { // active function

                      // rate variavles textbox
                      var rateRw = document.getElementById('rateRw');
                      var rateCo = document.getElementById('rateCo');
                      var paymentType = document.getElementById('paymentType');

                      var priceUnitD = document.getElementById('priceUnitD'); // Price Units
                      var priceUnitR = document.getElementById('priceUnitR'); // Price Units
                      var priceUnitFc = document.getElementById('priceUnitFc'); // Price Units


                      var quantity = document.getElementById('quantity'); // quantity

                      var inCashDol = document.getElementById('inCashDol'); // input dollar
                      var inCashRw = document.getElementById('inCashRw'); // input Rwandans
                      var inCashFc = document.getElementById('inCashFc'); // input congo

                      var balCashDol = document.getElementById('balCashDol'); // input balance dolar
                      var balCashRw = document.getElementById('balCashRw'); // input balance rw
                      var balCashFc = document.getElementById('balCashFc'); // input balance Fc

                      // TOTAL PRICE
                      var totalPrice = document.getElementById('totalPrice'); // sum from the input in a selected type
                      var totalPriceRw = document.getElementById('totalPriceRw'); // the sum of the input in Rw

                      // TOTAL AVAILABLE
                      var totalAvailable = document.getElementById('totalAvailable'); // sum from the input in a selected type
                      var totalAvailableRw = document.getElementById('totalAvailableRw'); // the sum of the input in Rw




                      var totalBalRw = document.getElementById('totalBalRw'); // sum from the input

                      // CASH IN HAND laber
                      var inCashDolLabel = document.getElementById('inCashDolLabel'); // input dollar
                      var inCashRwLabel = document.getElementById('inCashRwLabel'); // input Rwandans
                      var inCashFcLabel = document.getElementById('inCashFcLabel'); // input congo

                      var totalBalanceType = document.getElementById('totalBalanceType'); // this will store the balance in a given type
                      var cashTypDisplay = document.getElementById('cashTypDisplay');
                      var balTypDisplay = document.getElementById('balTypDisplay');

                      // inCashRwLabel.innerHTML = "you are the next";

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
                          // TOTAL PRICE

                          // resset the balance to Zero
                          balCashFc.value = 0;
                          balCashDol.value = 0;
                          balCashRw.value = 0;


                          // Finding the Price total Type
                          totalPrice.value = quantity.value * priceUnitR.value; // this will depend on a selected value

                          // changing the total price in Rwandans
                          tpRw = quantity.value * priceUnitR.value; // no need of special function
                          totalPriceRw.value = tpRw.toFixed(2)

                          // TOTAL AVAILABLE
                          // Finding the total available Type
                          totalAvailable.value = sumInput.toFixed(2); // this will depend on a selected value

                          // changing the total available in Rwandans
                          totalAvailableRw.value = sumInput.toFixed(2); // no need of special function

                          // DISPLAY FOR LABEL IN CASH
                          if (sumInput >= Number(totalPriceRw.value)) {
                              // alert('payment done');
                              inCashRwLabel.innerHTML = '0';
                              inCashDolLabel.innerHTML = '0';
                              inCashFcLabel.innerHTML = '0';
                          } else {
                              var cash2 = Number(totalPriceRw.value) - sumInput;
                              inCashRwLabel.innerHTML = cash2.toFixed(2);
                              inCashDolLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', cash2).toFixed(2);
                              inCashFcLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', cash2).toFixed(2);
                          }

                          // CALCULATE THE BALANCE RW
                          if (sumInput >= Number(totalPriceRw.value)) {
                              balCashRw.value = '0';
                          } else {
                              var cashx1 = Number(totalPriceRw.value) - sumInput;
                              balCashRw.value = cashx1.toFixed(2);
                          }

                          // NEW ..... LABEL AFTER TEXT AREAaa
                          cashTypDisplay.innerHTML = "Frw"; // displaying the value
                          cashTypDisplay1.innerHTML = "Frw"; // displaying the value
                          cashTypDisplay2.innerHTML = "Frw"; // displaying the value

                          // removing the class on the PU
                            $('.puRwGrpup').addClass('has-success');
                            $('.puDolGrpup').removeClass('has-success');
                            $('.puFcGrpup').removeClass('has-success');

                            $('.popover').show(); // show the popup


                      } else if (paymentType.value == 'dol') { //************************************************************************************
                          // SELECTED IN DOLARS

                          // resset the balance to Zero
                          balCashFc.value = 0;
                          balCashDol.value = 0;
                          balCashRw.value = 0;

                          // TOTAL PRICE
                          // Finding the Price total Type
                          totalPrice.value = (quantity.value * priceUnitD.value).toFixed(2); // this will depend on a selected value

                          // changing the total price in Rwandans
                          totalPriceRw.value = change_rate_receive(rateRw.value, rateCo.value, 'dol', 'rw', totalPrice.value).toFixed(2);

                          // TOTAL AVAILABLE
                          // Finding the total available Type
                          var cvg = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', sumInput);
                          totalAvailable.value = cvg.toFixed(2); // this will depend on a selected value

                          // display the total available in Rwandans
                          totalAvailableRw.value = sumInput.toFixed(2); // no need of special function

                          // DISPLAY FOR LABEL IN CASH
                          if (sumInput >= Number(totalPriceRw.value)) {
                              // alert('payment done');
                              inCashRwLabel.innerHTML = '0';
                              inCashDolLabel.innerHTML = '0';
                              inCashFcLabel.innerHTML = '0';
                          } else {
                              var cash2 = Number(totalPriceRw.value) - sumInput;
                              inCashRwLabel.innerHTML = cash2.toFixed(2);
                              inCashDolLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', cash2).toFixed(2);
                              inCashFcLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', cash2).toFixed(2);
                          }

                          // CALCULATE THE BALANCE RW
                          if (sumInput >= Number(totalPriceRw.value)) {
                              balCashDol.value = '0';
                          } else {
                              var cash2 = Number(totalPriceRw.value) - sumInput;
                              balCashDol.value = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', cash2).toFixed(2);
                          }

                          // NEW ..... LABEL AFTER TEXT AREAaa
                          cashTypDisplay.innerHTML = "$"; // displaying the value
                          cashTypDisplay1.innerHTML = "$"; // displaying the value
                          cashTypDisplay2.innerHTML = "$"; // displaying the value

                          // removing the class on the PU
                            $('.puRwGrpup').removeClass('has-success');
                            $('.puDolGrpup').addClass('has-success');
                            $('.puFcGrpup').removeClass('has-success');

                            $('.popover').show(); // show the popup


                      } else if (paymentType.value == 'fc') { //************************************************************************************
                          // SELECTED IN DOLARS


                          // resset the balance to Zero
                          balCashFc.value = 0;
                          balCashDol.value = 0;
                          balCashRw.value = 0;

                          // TOTAL PRICE
                          // Finding the Price total Type
                          totalPrice.value = (quantity.value * priceUnitFc.value).toFixed(2); // this will depend on a selected value

                          // changing the total price in Rwandans
                          totalPriceRw.value = change_rate_receive(rateRw.value, rateCo.value, 'fc', 'rw', totalPrice.value).toFixed(2);

                          // TOTAL AVAILABLE
                          // Finding the total available Type
                          var cvg = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', sumInput);
                          totalAvailable.value = cvg.toFixed(2); // this will depend on a selected value

                          // display the total available in Rwandans
                          totalAvailableRw.value = sumInput.toFixed(2); // no need of special function

                          // DISPLAY FOR LABEL IN CASH
                          if (sumInput >= Number(totalPriceRw.value)) {
                              // alert('payment done');
                              inCashRwLabel.innerHTML = '0';
                              inCashDolLabel.innerHTML = '0';
                              inCashFcLabel.innerHTML = '0';
                          } else {
                              var cash2 = Number(totalPriceRw.value) - sumInput;
                              inCashRwLabel.innerHTML = cash2.toFixed(2);
                              inCashDolLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', cash2).toFixed(2);
                              inCashFcLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', cash2).toFixed(2);
                          }

                          // CALCULATE THE BALANCE RW
                          if (sumInput >= Number(totalPriceRw.value)) {
                              balCashFc.value = '0';
                          } else {
                              var cash2 = Number(totalPriceRw.value) - sumInput;
                              balCashFc.value = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', cash2).toFixed(2);
                          }

                          // NEW ..... LABEL AFTER TEXT AREAaa
                          cashTypDisplay.innerHTML = "Fc"; // displaying the value
                          cashTypDisplay1.innerHTML = "Fc"; // displaying the value
                          cashTypDisplay2.innerHTML = "Fc"; // displaying the value

                          // removing the class on the PU
                            $('.puRwGrpup').removeClass('has-success');
                            $('.puDolGrpup').removeClass('has-success');
                            $('.puFcGrpup').addClass('has-success');

                            $('.popover').show(); // show the popup

                      }

                      // work with the balance select
                      if (balCashDol.value == 0 && balCashRw.value == 0 && balCashFc.value == 0) {
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


                    } // end of active
                  } // end of main functions



sellUpdateProcessF();

</script>
