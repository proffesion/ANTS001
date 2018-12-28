<?php
// include 'app_data/php/head.php';
include 'app_data/php/head_blank.php';
secured();
// $env_id = "1672";
if (!isset($_GET['sid']) || empty($_GET['sid'])) {
     echo "<script> window.open('home.php','_self'); </script>";
}
$sell_id = $_GET['sid'];
$env_id = retrieve_data('e_id','selling_e','s_id',$sell_id);

// secured();
// @$env_id = $_GET['id'];
if (!isset($env_id) || empty($env_id)) {
     echo "<script> window.open('home.php','_self'); </script>";
}


$stock_n = fileData('quantity',$env_id);
if ($stock_n <= 0) {
?>
    <script type="text/javascript">
        $(function(){
          $('#myModa_noSock').modal('show');
        });
    </script>
<?php
}


 if (isset($_POST['Sell_envitation'])) {

  //  defining the variables
  @$s_id = $_POST['s_id'];
  @$e_id = $_POST['e_id'];
  @$typ = $_POST['typ'];
  @$quantity = $_POST['quantity'];
  @$client_name = $_POST['client_name'];
  @$done_by = $_POST['done_by'];
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
  @$bonus = $_POST['bonus'];

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





  $stock_size = fileData('quantity',$env_id);
  // calculate the stock
  $left_in_stock = $stock_size - ($quantity + $bonus);


  $update_stock_Query = "UPDATE `env_stock` SET `quantity`='$left_in_stock' WHERE `e_id`='$env_id'";


  $query = "INSERT INTO
  `selling_e`(
    `e_id`,
    `typ`,
    `date`,
    `quantity`,
    `client_name`,
    `done_by`,
    `print`,
    `design`,
    `maison_id`,
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
    `comment`,
    `bonus`
  )
VALUES(
  '$env_id',
  '$typ',
  '$date_form_modif',
  '$quantity',
  '$client_name',
  '$user_id',
  '$print',
  '$design',
  '$maison_id',
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
  '$comment',
  '$bonus'
)";
  if ($Query_one_run = $mysqli->query($query)) {

    ?>
        <script type="text/javascript">
            $(function(){
              $('#myModaSELLDONE').modal('show');
            });
        </script>

    <div class="top-fixed">
    <?php
    $query_Stock = "UPDATE `env_stock` SET `quantity` = '$left_in_stock' WHERE `e_id`='$env_id'";
    if ($Query_two_run = $mysqli->query($query_Stock)) { ?>
        <!-- display the success updated messade -->
        <div class="alert alert-success alert-dismissible top-fixed fadeInDown animated" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Well done!</strong> Stock Updated.
        </div>

    <?php
    // tell the user that they did a sell mith many quaantity
    if ($quantity > $stock_size) {  ?>
        <script type="text/javascript">
            $(function(){
              $('#myModal23').modal('show');
            });
        </script>
    <?php }  ?>



    <?php } else { ?>
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong> The stock is not Updated. please send a message to the admin ...
      </div>

    <?php } ?>



    </div>
    <?php


  } else {
    echo "<h2>Sorrry it doesnt run</h2>";
  }


 }


// displaing the taux


   $paym_typ_ch = retrieve_data('paym_typ','selling_e','s_id',$sell_id);
   $PU_ch = retrieve_data('PU','selling_e','s_id',$sell_id);

   // $rateR_db = retrieve_data('Rate_R','selling_e','s_id',$sell_id);
   // $rateC_db = retrieve_data('Rate_Fc','selling_e','s_id',$sell_id);

  if ($paym_typ_ch == 'frw') {

      $mod_Pu_frw = $PU_ch;
      $mod_Pu_dol =  '0';
      $mod_Pu_fc = '0';

  } else if ($paym_typ_ch == 'dol') {
    // process for $
      $mod_Pu_frw = '0';
      $mod_Pu_dol = $PU_ch;
      $mod_Pu_fc = '0';

  } else if ($paym_typ_ch == 'fc') {
    // process for the Fc
      $mod_Pu_frw = '0';
      $mod_Pu_dol = '0';
      $mod_Pu_fc = $PU_ch;

  }


?>


<!-- modal for no more invitation in stock -->
<div class="modal fade" id="myModa_noSock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-styled-danger">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <!-- <img src="app_data/imgs/01_no_more_in_stock.png" class="img-icon-shw" alt="" /> -->
        <h1 class="icon-sub-font shake animated fa fa-frown-o"></h1>
        <h2 class="title-sub"> There is no more In Stock </h2>
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

<form class="" action="sell_envitation_add.php?sid=<?php echo $sell_id; ?>" method="post">

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
      <img src="envit/<?php echo fileData('img',$env_id); ?>" alt="...">
        <div class="caption">
        <h3 style="font-size: 18px;"><?php echo @$env_id; ?></h3>
      </div>
    </div>

<div class="stock-details">

        <p> <label> Color: </label> <b><?php echo fileData('env_color',$env_id); ?></b> </p>

        <p> <label> quantity: </label> <b><?php echo fileData('quantity',$env_id); ?></b> </p>
        <p style="lt-hide"> <label> Price Unit $: </label> <b><?php echo fileData('price_d',$env_id); ?> $</b> </p>
        <p> <label> Price Unit Frw: </label> <b><?php echo fileData('price_r',$env_id); ?> frw</b> </p>

        <p> <label> Place: </label> <b> <?php echo fileData('place',$env_id); ?> </b> </p>


        <br>

        <label> Comment: </label>
        <!-- <br>  -->
        <div class="comment-box scroll"> <?php echo fileData('comment',$env_id); ?> </div>

        <br>

        <!-- sell progress view -->
        <div class="sell-progress-view" style="clear:both;">
           <i>SELL PROGRESS</i>
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
                  <input type="text" name="done_by" class="form-control" value="<?php echo "$fnamel  $lnamel"; ?>" id="" placeholder="" readonly="">
                </div>
              </div>

          </div>
           <div class="col-md-4">

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
                <div class="row">

                  <div class="col-xs-5">
                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Payment Type</span>
                          <select id="paymentType" name="paym_typ" class="form-control" onchange="processF()">
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
                  <div class="col-xs-4">

                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Quantity</span>
                          <input type="number" class="form-control" name="quantity" id="quantity" value="1" min="1" onkeyup="processF()" <?php echo $form_number; ?>>
                        </div>
                      </div>

                  </div>
                   <div class="col-xs-3" style="opacity:0.6;">

                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Bonus</span>
                          <input type="number" step="any" class="form-control" name="bonus" value="0" min="0" <?php echo $form_number; ?>>
                        </div>
                      </div>

                  </div>
                </div><!-- .row -->
              </div>

              <hr class="separator">

              <h3 class="section-title">Price Unit</h3>
              <!-- <br> -->




              <div class="row priceUnitRow">
                <div class="col-xs-6 puRwGrpup col-md-4 frw-cont">
                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">Frw</span>
                        <input type="number" step="any"  class="form-control" name="PU_Rw" id="priceUnitR" onkeyup="processF()" min="0" value="<?php echo @$mod_Pu_frw; ?>" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>


                <div class="col-xs-6 col-md-4 dol-cont">
                  <div class="form-group puDolGrpup has-feedback ">
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" step="any"  class="form-control" id="priceUnitD" name="PU_Dol" onkeyup="processF()" min="0" value="<?php echo @$mod_Pu_dol; ?>" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>

                <div class="col-xs-6 col-md-4 fc-cont">
                  <div class="form-group puFcGrpup has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">Fco</span>
                        <input type="number" step="any"  class="form-control" id="priceUnitFc" name="PU_Fc" onkeyup="processF()" min="0" value="<?php echo @$mod_Pu_fc; ?>" aria-describedby="" <?php echo $form_number; ?>>
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
                        <h3 class="popover-title"> Frw </h3>
                        <div class="popover-content">
                          <p><b><label id="inCashRwLabel">0</label></b>Frw</p>
                        </div>
                  </div>
                  <!-- end of popover -->

                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any"  class="form-control" id="inCashRw" name="Pay_Fr" value="0" min="0" onkeyup="processF()" data-toggle="inCashRw" aria-describedby="" <?php echo $form_number; ?>>
                        </div>

                        <span id="" class="sr-only">(success)</span>
                      </div>

                </div>
                <div class="col-xs-6 col-md-4">

                  <!-- popover div -->
                  <div class="popover top popover-cash  fadeIn animated" style="margin-top: -64px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title">$</h3>
                        <div class="popover-content">
                          <p><b><label id="inCashDolLabel">0</label></b>$</p>
                        </div>
                  </div>
                  <!-- end of popover -->

                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" step="any"  class="form-control" name="Pay_Dol" id="inCashDol" value="0" min="0" onkeyup="processF()" data-toggle="inCashDol" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <span id="" class="sr-only">(success)</span>
                  </div>


                </div>
                <div class="col-xs-6 col-md-4">

                  <!-- popover div -->
                  <div class="popover top popover-cash fadeIn animated" style="margin-top: -64px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title">Fco </h3>
                        <div class="popover-content">
                          <p><b><label id="inCashFcLabel">0</label></b>Fco</p>
                        </div>
                  </div>
                  <!-- end of popover -->

                    <div class="form-group has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Fco</span>
                          <input type="number" step="any"  class="form-control" name="Pay_fc" id="inCashFc" value="0" min="0" onkeyup="processF()" data-toggle="inCashFc" aria-describedby="" <?php echo $form_number; ?>>
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
                <div class="col-xs-6 col-md-4  frw-cont">
                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">Frw</span>
                        <input type="number" step="any"  class="form-control" name="Bal_rw" id="balCashRw" value="0" min="0" aria-describedby="" <?php echo $form_number; ?>>
                      </div>
                      <!--  -->
                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>

                <div class="col-xs-6 col-md-4  dol-cont">
                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" step="any"  class="form-control"  name="Bal_dol" id="balCashDol" value="0" min="0" aria-describedby="" <?php echo $form_number; ?>>
                      </div>

                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>

                <div class="col-xs-6 col-md-4 fc-cont">
                  <div class="form-group has-feedback">
                      <div class="input-group">
                        <span class="input-group-addon">Fco</span>
                        <input type="number" step="any"  class="form-control"  name="Bal_fc" id="balCashFc" value="0" min="0" aria-describedby="" <?php echo $form_number; ?>>
                      </div>

                      <span id="" class="sr-only">(success)</span>
                    </div>
                </div>
              </div>
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
                        <input type="number" step="any"  class="form-control form-hide form-small" id="rateRw" name="Rate_R" min="0" value="<?php echo retrieve_data('Rate_R','selling_e','s_id',$sell_id); ?>" onkeyup="processF()" required <?php echo $form_number; ?>>
                      </div>
                  </div>
                  <div class="col-md-6"  style="padding: 0;">
                    <div class="form-group" style="padding: 0;">
                      <label for="">Fco</label>
                      <input type="number" step="any"  class="form-control form-hide form-small"  id="rateCo" name="Rate_Fc" min="0" value="<?php echo retrieve_data('Rate_Fc','selling_e','s_id',$sell_id); ?>" onkeyup="processF()" required <?php echo $form_number; ?>>
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
                          <input type="number" step="any"  class="form-control form-hide"  name="Price_total" id="totalPrice" value="0" min="0" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any"  class="form-control form-hide" name="Price_total_Rw" id="totalPriceRw" value="0" min="0" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>
                </div>



                <div class="price-total">
                     <h3>Total Available</h3>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon"><label id="cashTypDisplay1"></label></span>
                          <input type="number" step="any"  class="form-control form-hide" name="Total_Available" id="totalAvailable" value="0" min="0" aria-describedby="" <?php echo $form_number; ?>>
                        </div>
                    </div>

                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any"  class="form-control form-hide" name="Total_Available_Rw" id="totalAvailableRw" value="0" min="0" aria-describedby="" <?php echo $form_number; ?>>
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
                     <input type="submit" name="Sell_envitation" class="btn btn-primary" value="Sell Invitation">
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
<script>

          // var rC = document.getElementById('rateCo').value;
          // var rR = document.getElementById('rateRw').value;
          // var puD = document.getElementById('priceUnitD').value;
          // // inetr a value in 'priceUnitFc' price unite congolee
          // var puFcong = change_rate_receive(rR, rC, 'dol', 'fc', puD);
          // document.getElementById('priceUnitFc').value = puFcong.toFixed(2);

          // processF(); // call the calculate function
</script>
