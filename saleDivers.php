<?php
include 'app_data/php/head_blank.php';
secured();
@$pro_id = $_GET['pro_id'];
if (!isset($_GET['pro_id']) || empty($_GET['pro_id'])) {
     echo "<script> window.open('home.php','_self'); </script>";
}


 if (isset($_POST['saleDivers'])) {

   //  defining the variables
  //  @$typ = $_POST['typ'];
   @$quantity = $_POST['quantity'];
   @$client_name = $_POST['client_name'];
   @$done_by = $_POST['done_by'];
   // @$date = $_POST[''];

  //  @$print = $_POST['print'];
  //  @$design = $_POST['design'];
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
    $date_d_form = $_POST['date_d'];
    $date_m_form = $_POST['date_m'];
    $date_y_form = $_POST['date_y'];
    $date_form_modif = "$date_d_form-$date_m_form-$date_y_form";
    


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


  $query = "INSERT INTO
  `divers_sales`(
    `date`,
    `div_id`,
    `client_name`,
    `maison_id`,
    `done_by`,
    `quantity`,
    `paym_typ`,
    `Cash_type`,
    `PU`,
    `Rate_R`,
    `Rate_Fc`,
    `Pay_Fr`,
    `Pay_Dol`,
    `Pay_fc`,
    `Price_total`,
    `Price_total_Rw`,
    `Total_Available`,
    `Total_Available_Rw`,
    `balance`,
    `static_balance`,
    `comment`
  )
VALUES(
  '$date_form_modif',
  '$pro_id',
  '$client_name',
  '$maison_id',
  '$user_id',
  '$quantity',
  '$paym_typ',
  '$Cash_type',
  '$PU',
  '$Rate_R',
  '$Rate_Fc',
  '$Pay_Fr',
  '$Pay_Dol',
  '$Pay_fc',
  '$Price_total',
  '$Price_total_Rw',
  '$Total_Available',
  '$Total_Available_Rw',
  '$BAL',
  '$BAL',
  '$comment'
)";
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




    <?php } else {
      echo "<h2>Sorrry it doesnt run</h2>";
    }
     ?>



    </div>
    <?php


  }


 // }




?>




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
        <h2 class="title-sub">Sell Done</h2>
        <p>Stock Updated</p>
      </div>
      <div class="modal-footer">
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

<form class="" action="saleDivers.php?pro_id=<?php echo $pro_id; ?>" method="post">

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

    <div class="thumbnail">
      <h1 class="fa fa-cube h1-product-icon"></h1>
        <div class="caption">
        <h3 style="font-size: 18px;"><?php echo retrieve_data('pro_name','products','pro_id',$pro_id); ?></h3>
      </div>
    </div>

<div class="stock-details">

        <!-- <p> <label> Color: </label> <b><?php echo fileData('env_color',$env_id); ?></b> </p> -->

        <!-- <p> <label> quantity: </label> <b><?php echo retrieve_data('pro_quantity','products','pro_id',$pro_id); ?></b> </p> -->
        <p style="lt-hide"> <label> Price Unit $: </label> <b><?php echo retrieve_data('price_dol','products','pro_id',$pro_id); ?> $</b> </p>
        <p> <label> Price Unit Frw: </label> <b><?php echo retrieve_data('price_frw','products','pro_id',$pro_id); ?> frw</b> </p>
        <p> <label> Place: </label> <b> <?php echo retrieve_data('place','products','pro_id',$pro_id); ?> </b> </p>


        <br>

        <label> Comment: </label>
        <!-- <br>  -->
        <div class="comment-box scroll"> <?php echo retrieve_data('pro_comment','products','pro_id',$pro_id); ?> </div>


        <br>

          <!-- sell progress view -->
          <div class="sell-progress-view" style="clear:both;">
            <i>Sell Progress</i>
            <div id="sell-progress"></div>
          </div>

        </div> <!-- /.stock-details -->

   </div> <!-- /.invitation-sub-content -->

</div> <!-- /.div-inv-info -->

<div class="col-md-10 form-containner"> <!-- =====================================================================================  -->

   <div class="section-one">
        <h1 class="title-sell">SELL FORM</h1>
   </div> <!-- /.section-one -->


   <div class="section-one" style="background: #ececec;">
        <div class="inner-dv">

        <div class="row">
          <div class="col-md-4">
            <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">Client</span>
                  <input type="text" class="form-control" name="client_name" value="" id="" placeholder=" Name" title="Text only" minlength="3" required="" <?php echo $form_text; ?>>
                </div>
                <span id="" class="sr-only">(success)</span>
              </div>
          </div>

          <div class="col-md-4">

            <div class="input-group">
              <span class="input-group-addon">Maison</span>
              <select class="form-control" name="maison_id" required="">
                <option value=""></option>
                <option value="0">None</option>
                <?php
                @$results_users = $mysqli->query("SELECT `maison_id`,`maison_name` FROM `maison` WHERE `view`='1'");
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

          <div class="col-md-4">

            <div class="input-group">
              <span class="input-group-addon">Sell Done By</span>
              <input type="text" name="done_by" class="form-control" value="<?php echo "$fnamel  $lnamel"; ?>" id="" placeholder="" readonly="">
            </div>

          </div>

        </div><!-- /.row -->

     
        <div class="row">
          <div class="col-md-4">
          <!-- date contents here -->


           <div class="form-group has-feedback">
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
              <span id="" class="sr-only">(success)</span>
            </div>




          </div>
        </div><!-- /.row -->     
     

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
                <div class="row">

                  <div class="col-xs-6">
                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Payment Type</span>
                          <select id="paymentType" name="paym_typ" class="form-control" onchange="processF()">
                              <option value="">Select Type</option>
                               <option value="frw">frw</option>
                               <option value="fc">fc</option>
                               <option value="dol">dol</option>
                           </select>
                        </div>
                      </div>

                  </div>
                  <div class="col-xs-6">

                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Quantity</span>
                          <input type="number" class="form-control" name="quantity" id="quantity" value="1" onkeyup="processF()" <?php echo $form_number; ?>>
                        </div>
                      </div>

                  </div>
                </div><!-- .row -->
              </div>

              <hr class="separator">

              <h3 class="section-title">Price Unit</h3>
              <!-- <br> -->
              <div class="row">
                <div class="col-xs-6 puRwGrpup col-md-4 frw-cont">
                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">Frw</span>
                        <input type="number" step="any" class="form-control" name="PU_Rw" id="priceUnitR" onkeyup="processF()" value="<?php echo retrieve_data('price_frw','products','pro_id',$pro_id); ?>" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>






                <div class="col-xs-6 col-md-4 dol-cont">
                  <div class="form-group puDolGrpup has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" step="any" class="form-control" id="priceUnitD" name="PU_Dol" onkeyup="processF()" value="<?php echo retrieve_data('price_dol','products','pro_id',$pro_id); ?>" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>

                <div class="col-xs-6 col-md-4 fc-cont">
                  <div class="form-group puFcGrpup has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">Fco</span>
                        <input type="number" step="any" class="form-control" id="priceUnitFc" name="PU_Fc" onkeyup="processF()" value="0" aria-describedby="" <?php echo $form_number; ?>>
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
                          <input type="number" step="any" class="form-control" id="inCashRw" name="Pay_Fr" value="0" onkeyup="processF()" data-toggle="inCashRw" aria-describedby="" <?php echo $form_number; ?>>
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
                        <input type="number" step="any" class="form-control" name="Pay_Dol" id="inCashDol" value="0" onkeyup="processF()" data-toggle="inCashDol" aria-describedby="" <?php echo $form_number; ?>>
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
                          <input type="number" step="any" class="form-control" name="Pay_fc" id="inCashFc" value="0" onkeyup="processF()" data-toggle="inCashFc" aria-describedby="" <?php echo $form_number; ?>>
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
                <div class="col-xs-6 col-md-4 frw-cont">
                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">Frw</span>
                        <input type="number" step="any" class="form-control" name="Bal_rw" id="balCashRw" value="0" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <!--  -->
                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>

                <div class="col-xs-6 col-md-4 dol-cont">
                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" step="any" class="form-control"  name="Bal_dol" id="balCashDol" value="0" aria-describedby="" <?php echo $form_number; ?>>
                      </div>

                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>

                <div class="col-xs-6 col-md-4">
                  <div class="form-group has-feedback fc-cont">
                      <div class="input-group">
                        <span class="input-group-addon">Fco</span>
                        <input type="number" step="any" class="form-control"  name="Bal_fc" id="balCashFc" value="0" aria-describedby="" <?php echo $form_number; ?>>
                      </div>

                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>
              </div>
              <hr class="separator">
               <div class="row">
               <div class="col-md-12">

                     <b>Comment</b>
                     <textarea class="form-control" rows="" name="comment" cols=""></textarea>

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
                        <input type="number" step="any" class="form-control form-hide form-small" id="rateRw" name="Rate_R" value="<?php echo retrieve_data('rec_dol_rw','taux','id','1'); ?>" onkeyup="processF()" required <?php echo $form_number; ?>>
                      </div>
                  </div>
                  <div class="col-md-6"  style="padding: 0;">
                    <div class="form-group" style="padding: 0;">
                      <label for="">Fco</label>
                      <input type="number" step="any" class="form-control form-hide form-small"  id="rateCo" name="Rate_Fc" value="<?php echo retrieve_data('rec_dol_fc','taux','id','1'); ?>" onkeyup="processF()" required <?php echo $form_number; ?>>
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
                          <input type="number" step="any" class="form-control form-hide"  name="Price_total" id="totalPrice" value="0" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any" class="form-control form-hide" name="Price_total_Rw" id="totalPriceRw" value="0" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>
                </div>



                <div class="price-total">
                     <h3>Total Available</h3>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon"><label id="cashTypDisplay1"></label></span>
                          <input type="number" step="any" class="form-control form-hide" name="Total_Available" id="totalAvailable" value="0" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any" class="form-control form-hide" name="Total_Available_Rw" id="totalAvailableRw" value="0" aria-describedby="" <?php echo $form_number; ?>>
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
                     <input type="submit" name="saleDivers" class="btn btn-primary" value="Sell Product">
                  </div>
                </div>



</form>
            </div>
          </div>



     <style media="screen">
       .h1-product-icon {
         background: #d01857;
         color: #fff;
         width: 166px;
         text-align: center;
         padding: 18px 2px;
         font-size: 133px;
         border-radius: 5px;
       }
     </style>






        </div> <!-- /.inner-dv -->
   </div> <!-- /.section-one -->
</div> <!-- /.sell-c0ntainner-div -->


</div>
<b id="cashTypDisplay2" style="opacity:0;font-size:0px;"></b>


<?php include 'app_data/php/foater.php' ?>
<script>

          var rC = document.getElementById('rateCo').value;
          var rR = document.getElementById('rateRw').value;
          var puD = document.getElementById('priceUnitD').value;
          // inetr a value in 'priceUnitFc' price unite congolee
          var puFcong = change_rate_receive(rR, rC, 'dol', 'fc', puD);
          document.getElementById('priceUnitFc').value = puFcong.toFixed(2);

</script>
