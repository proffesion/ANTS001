<?php
include 'app_data/php/head_blank.php';
secured();
?>
<section class="hide-print">

<div class="head-tit-rep-div">
  DIVERS SELL REPORT
  <a href="home.php" style="float: right;margin-right: 23px;text-decoration: none;color: #fff;"><b class="fa fa-home"></b></a>
</div>


<div class="report-controls">
  <section class="rowe">
    <form class="" action="sellDivers_report.php" method="get">
    <section class="colmn small">
      <div class="form-group">
          <label for="">Sell Id</label>
          <input type="text" name="sell_id" class="form-control" value="" id="" placeholder="Sell Id">
      </div>
     </section>

    <section class="colmn">
      <div class="form-group">
          <label for="">Product</label>
          <select class="form-control" name="product_id">

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
      </div>
     </section>

     <section class="colmn big">
       <div class="form-group">
           <label for="">date</label>
           <section>
           <select name="day" class="form-control" style="width:20%;float:left"> <option value=""></option> <?php for ($i=1; $i <=9 ; $i++) { echo "<option value='0$i'>0$i</option>"; } for ($i=10; $i <30 ; $i++) { echo "<option value='$i'>$i</option>"; } ?> </select>
           <select name="month" class="form-control" style="width:50%;float:left">
             <option value=""></option>
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
           </select>
           <select name="year" class="form-control" style="width:30%;float:left">
             <option value=""></option>
             <?php for ($i=2017; $i < 2030 ; $i++) { echo "<option value='$i'> $i </option>"; } ?>
           </select>
           <section class="clear-both">x</section>
           </section>
       </div>
     </section>



     <section class="colmn">
       <div class="form-group">
       <label for=""> Done By</label>
       <select class="form-control" name="done_by">
           <option value=""></option>
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
      </section>
    <section class="clear-both">x</section>
  </section>

  <section class="rowe">
    <section class="colmn small">
      <div class="form-group">
          <label for=""> Closed</label>
          <select class="form-control" name="Cash_type">
            <option value=""></option>
            <option value="Done">Done</option>
            <option value="Avance">Avance</option>
          </select>
      </div>
    </section>
    <section class="colmn">
      <div class="form-group">
          <label for="">Maison</label>
          <select class="form-control" name="maison_id">
            <?php
               // $maison = retrieve_data('maison_id','selling_e','s_id',$sell_id);
               // $maison_name =  retrieve_data('maison_name','maison','maison_id',$maison);
               // if ($maison == '0') {
               //   echo '<option value="0">None</option>';
               // } else {
               //   echo "<option value='$maison'>$maison_name</option>";
               // }
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
     </section>
    <section class="colmn big">
      <div class="form-group">
          <label for="">Client Name</label>
          <input type="text" name="Cname" class="form-control" value="" id="" placeholder="Client Name">
      </div>
     </section>
     <section class="colmn" style="padding: 26px 0px 0px 12px;text-align: right;">
       <button type="submit" class="btn btn-primary" name="search"><b class="fa fa-search"></b>&nbsp; Check</button>
         <a href="sellDivers_report.php?all_record" style="background: transparent;"> <button type="button" class="btn btn-primary" name="button"><b class="fa fa-navicon"></b> &nbsp; View All</button> </a>
      </section>
    <section class="clear-both">x</section>
  </section>
 </div>
 </form>

 </section>




 <?php
 $date_q = '';
 $env_q = '';
 $done_q = '';
 $sell_q = '';
 $sType_q = '';
 $Cname_q = '';
 $Cash_type_q = '';

$total_quantity = 0;
$total_pay_frw = 0;
$total_pay_dol = 0;
$total_pay_fco = 0;
$Grand_total = 0;
$total_balance = 0; 

 if (isset($_GET['search'])) {

   # Date
   if (isset($_GET['day']) && !empty($_GET['day'])) { @$day = @$_GET['day'].'-'; } else { @$day = ''; }
   if (isset($_GET['year']) && !empty($_GET['year'])) { @$yearo = '-'.$_GET['year']; } else { @$yearo = ''; }
   @$month = @$_GET['month'];
   @$sel_date = "$day$month$yearo";
   if (isset($day) && !empty($day) || isset($yearo) && !empty($yearo) || isset($month) && !empty($month)) { # date working
     $date_q = "AND `date` LIKE '%$sel_date%'";
   }

 # Envitation Id
 if (isset($_GET['product_id']) && !empty($_GET['product_id'])) { # code..
    $product_id = $_GET['product_id'];
    $product_id_q = "AND `div_id`='$product_id'";
    $env_q_B = "AND `item_id`='$product_id'";
 }

 # Sell Id
 if (isset($_GET['sell_id']) && !empty($_GET['sell_id'])) { # code..
    $sell_id = $_GET['sell_id'];
    $sell_q = "AND `s_id`='$sell_id'";
    $sell_q_B = "AND `sell_id`='$sell_id'";

 }

 # Client Name
 if (isset($_GET['Cname']) && !empty($_GET['Cname'])) { # code..
    $Cname = $_GET['Cname'];
    $Cname_q = "AND `client_name` LIKE '%$Cname%'";
 }

 # done_by
 if (isset($_GET['done_by']) && !empty($_GET['done_by'])) { # code..
    $done_byE = $_GET['done_by'];
    $done_q = "AND `done_by`='$done_byE'";
 }

 # done_by
 if (isset($_GET['Cash_type']) && !empty($_GET['Cash_type'])) { # code..
    $Cash_typeE = $_GET['Cash_type'];
    $Cash_type_q = "AND `Cash_type`='$Cash_typeE'";
 }

 # done_by
 if (isset($_GET['maison_id']) && !empty($_GET['maison_id'])) { # code..
    $maison_id = $_GET['maison_id'];
    $maison_id_q = "AND `maison_id`='$maison_id'";
 }



 }
 # ----------------------------------------------
 # query condition controlls
 @$cond_query ="$sell_q $date_q $product_id_q $done_q  $Cname_q $Cash_type_q $maison_id_q";
@$cond_query_BALANCE = "$env_q_B $sell_q_B $Cname_q $done_q $date_q"; // balance query bilder



 if (isset($_GET['all_record'])) { // this will display all the record
     $mainQuerySearch = "SELECT * FROM `divers_sales`";
     $mainQuerySearch_BALANCE = "SELECT `Total_Available_Rw` FROM `balance_table` WHERE item = 'Divers'";

 } elseif (isset($_GET['search'])) { // this will run when the user click the search button
      $mainQuerySearch = "SELECT * FROM `divers_sales` WHERE `div_id`!='0' $cond_query ORDER BY `s_id` DESC";
      $mainQuerySearch_BALANCE = "SELECT `Total_Available_Rw` FROM `balance_table` WHERE item = 'Divers' $cond_query";

  } else {
      $mainQuerySearch = "SELECT * FROM `divers_sales` WHERE `date` LIKE '%$this_month%' ORDER BY `s_id` ASC";
      $mainQuerySearch_BALANCE = "SELECT `Total_Available_Rw` FROM `balance_table` WHERE `date` LIKE '%$this_month%' AND item = 'Divers'";
 
  }
 ?>

<?php include 'app_data/php/print_head.php'; ?>

<table border="1" class="table table-bordered table-report">
  <tbody>
    <tr>
      <th> # </th>
      <th> Date </th>
      <th> E-id </th>
      <th> quantity </th>
      <th> <b class="fa fa-money" style="font-size: 21px;" title="Payment Type"></b> </th>
      <th> PU </th>

      <th> Pay Frw </th>
      <th> Pay $ </th>
      <th> Pay Fco </th>
      <th> Balance </th>

      <th> Total (type)</th>
      <th> Total (Frw)</th>

      <th> Closed </th>
      <th> Client Name </th> <th> Done By </th> </tr>
    </tr>

<?php
$results = $mysqli->query("$mainQuerySearch");

if ($results->num_rows == NULL) {
?>
<div class="data-null bounceIn animated">
<h2 class="fa fa-warning"></h2>
<p>No Result Found!</p>
</div>
    <style> table { display: none; } </style>
    <?php
} else {
  $x = 0;
  $quantity = 0;

    while($row = $results->fetch_array()) {
      @$s_id = $row["s_id"];
      @$date = $row["date"];
      @$dv_id = $row["div_id"];
      @$client_name = $row["client_name"];
      @$done_by = $row["done_by"];
      @$Cash_type = $row["Cash_type"];
      @$avance = $row["avance"];
      @$payed_in = $row["payed_in"];
      @$quantity = $row["quantity"];
      @$price_unit_rw = $row["pu_r"];
      @$price_tot_rw = $row["pt_r"];
      @$price_unit_d = $row["pu_d"];
      @$price_tot_d = $row["pt_d"];
      @$comment = $row["comment"];
      @$maison_id = $row["maison_id"];
      
      
      @$Cash_type = $row["Cash_type"];
      @$paym_typ = $row["paym_typ"];
      
      @$PU = $row["PU"];
      @$Rate_Fc = $row["Rate_Fc"];
      @$Rate_R = $row["Rate_R"];
      // pay in
      @$Pay_Fr = $row["Pay_Fr"];
      @$Pay_Dol = $row["Pay_Dol"];
      @$Pay_fc = $row["Pay_fc"];
      
      // balance
      @$balance = $row["balance"];
      $balanceFrw = CashToFrw($Rate_R, $Rate_Fc, $paym_typ, $balance);
      
      
      @$Price_total = $row["Price_total"];
      @$Price_total_Rw = $row["Price_total_Rw"];

      @$Total_Available = $row["Total_Available"];
      @$Total_Available_Rw = $row["Total_Available_Rw"];

      // `maison_id`,

      $check_query_o = "SELECT `sell_id` FROM `error_table` WHERE `sell_id`='$s_id' AND typ='D'";


?>
<tr class="">
  <td> <?php echo @$s_id; ?> </td>
  <td> <?php echo @$date; ?> </td>
  <td> <?php echo @retrieve_data('pro_name','products','pro_id',$dv_id); ?>  </td>
  <!-- <td> <?php echo @$typ; ?> </td> -->
  <td> <?php echo @$quantity; ?> </td>
  <td> <?php echo @$paym_typ; ?> </td>
  <td> <?php echo @money($PU); ?> <?php echo @$paym_typ; ?> </td>

  <td class="pay-class"> <?php echo @money($Pay_Fr); ?> Frw</td>
  <td class="pay-class"> <?php echo @money($Pay_Dol); ?> $</td>
  <td class="pay-class"> <?php echo @money($Pay_fc); ?> Fc</td>
  <td> 
  <?php 
  if ($paym_typ != 'frw') {
  echo @money($balance) . ' ' . $paym_typ . ' <br>(<small>' . @money($balanceFrw) . ' frw </small>)';
  } else {
  echo @money($balance) . ' ' . $paym_typ;
  }
  ?></td>
  <td class="total-class"> <?php echo @money($Total_Available); ?> <?php echo @$paym_typ; ?></td>
  <td class="total-class"> <?php echo @money($Total_Available_Rw); ?> Frw</td>

  <td> <?php echo @$Cash_type; ?> </td>
  <td> <?php echo @$client_name; ?> </td>
  <td> <?php echo retrieve_data('username','users','user_id',$done_by); ?></td>

 </tr>
<?php
    @$total_pay_frw += $Pay_Fr;
    @$total_pay_dol += $Pay_Dol;
    @$total_pay_fco += $Pay_fc;
    @$Grand_total += $Total_Available_Rw;
    @$total_balance += $balanceFrw;
    @$total_quantity += $quantity;
    }
}
 ?>
</tbody></table>





<br><br>
<!-- <hr> -->

<?php
     // echo number_ret($mainQuerySearch_BALANCE);  
$Total_Available_Rw_o_total = 0;

$resultos = $mysqli->query("$mainQuerySearch_BALANCE");
while ($row = $resultos->fetch_array()) {

  @$Total_Available_Rw_o = $row["Total_Available_Rw"];
  @$Total_Available_Rw_o_total += $Total_Available_Rw_o;
}
// echo $Total_Available_Rw_o_total;
?>

  <br>

<div class="row" style="    width: 90%;margin: auto;">
  <div class="col-md-8">
  
  <table border="1" class="table table-bordered table-report reportSummary">
    <tr class="BTitle">
      <th colspan="3">Total payed</th>
      <th colspan="2">Balance</th>
    </tr>
    <tr class="MTitle">
      <td> <b> Frw </b> </td>
      <td> <b> dol ($) </b> </td>
      <td> <b> Fco </b> </td>

      <td> <b> Payed </b> </td>
      <td> <b> Unpayed </b> </td>
    </tr>
    <tr class="CashTR">
      <td><?php echo @money($total_pay_frw); ?> Frw</td>
      <td><?php echo @money($total_pay_dol); ?> dol</td>
      <td><?php echo @money($total_pay_fco); ?> Fco</td>

      <td style="color:green;"><?php echo @money($Total_Available_Rw_o_total); ?> Frw</td>
      <td style="color:red;"><?php echo @money($total_balance); ?> Frw</td>
    </tr>
    <tr><td colspan="5"> Grand Total: <b><?php echo @money($Grand_total); ?> Frw</b></td></tr>
    <tr><th colspan="5"> Grand Total + Payed Balance</th></tr>
        <tr class="GandTotal">  <td colspan="5"><?php echo @money($Grand_total + $Total_Available_Rw_o_total); ?> Frw</td> </tr>
  </table>
  
  </div>
  <div class="col-md-4">
  <table border="1" class="table table-bordered table-report reportSummary">
  <tr><th> Total sells </th></tr>
  <tr class="Count"><td> <?php echo @$results->num_rows; ?> </td></tr>
  <tr><th> Total Invitations </th></tr>
  <tr class="Count"><td> <?php echo @$total_quantity; ?> </td></tr>
  </table>
  </div>
</div>
<br>


</div>


<style media="screen">
.pay-class {
    background: rgba(81, 192, 86, 0.05);
}
.total-class {
  background: rgba(233, 30, 99, 0.11);
}

  .report-controls {
    width: 100%;
    background: #f1f1f1;
    margin: auto;
    margin: 18px 0px;
    margin: auto;
    margin-bottom: 33px;
    box-shadow: 0px 3px 8px -2px #333;
    padding: 10px 2% 11px 2%;
    border-radius: 3px;
  }
  .report-controls .rowe {
    /*display: block;*/
  }
  .report-controls .rowe .colmn {
    width: 25%;
    /*border: 1px solid #888888;*/
    /*background: green;*/
    float: left;
  }



.form-group {
  padding: 5px 10px;
  margin: 0px;
}


.table-small-report {
  /*width: 50%;*/
  min-width: 400px;
  max-width: 50%;
}


.report-controls .rowe .big { width: 30%; }
.report-controls .rowe .small { width: 20%; }
body {
  background: #fff;
}
hr {
  margin: 3px;
  border-color: #000;
}

.form-control {
      display: block;
      width: 100%;
}
label {
  margin-bottom: 1px;
}

.table {
    width: 97%;
    margin: auto;
}
.head-tit-rep-div {
  background-color: #8c103a;
  padding: 10px;
  padding-left: 65px;
  background-image: url(app_data/imgs/icns/small-logo.png);
  background-size: 41px 34px;
  background-repeat: no-repeat;
  background-position: 18px 8px;
  font-size: 23px;
  /* font-weight: bold; */
  color: #fff;
  text-shadow: 0px 0px 2px #000;
}
/*}*/

.print-sett {
      text-align: right;
      border-top: 1px solid grey;
      padding-top: 6px;
      display: none;
}

</style>

<?php include 'app_data/php/foater.php' ?>
