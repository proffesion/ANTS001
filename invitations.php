<?php
include 'app_data/php/head.php';
secured();


if (isset($_GET['1'])) { ?>
    <div class="alert alert-success alert-dismissible alert-fixed bounceInDown animated" style="margin-bottom: 0;z-index: 1;width: 240px;opacity: 0.9;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <b class=" fa fa-check"></b> &nbsp; Sell Deleted!
    </div>
<?php } elseif (isset($_GET['2'])) { ?>
  <div class="alert alert-success alert-dismissible alert-fixed bounceInDown animated" style="margin-bottom: 0;z-index: 1;width: 240px;opacity: 0.9;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <b class=" fa fa-check"></b> &nbsp; Sell Deleted!
  </div>

  <div class="alert alert-warning alert-dismissible alert-fixed bounceInDown animated" style="margin-bottom: 0;z-index: 1;width: 240px;opacity: 0.9;top: 79px;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <b class=" fa fa-check"></b> &nbsp; Stock Updated!
  </div>
<?php } ?>

<!-- contents start here -->
<style media="screen">
.contents-div_riight-small-result {
   margin-right: 0px;
}
.report-controls {
    display: none;
}
</style>

<div class="contents-div">
<div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">
<!-- contents goes here -->

<section class="header-div-sec">
    <h2> INVITATION </h2>
    <b class="search-option fa fa-ellipsis-v click" style="padding: 1px 12px;"></b>
</section>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<section class="hide-print">
<div class="report-controls fadeIn animated report-control-quick">
 <section class="rowe">
   <form class="" action="invitations.php" method="get">
   <section class="colmn small">
     <div class="form-group">
         <label for="">Sell Id</label>
         <input type="text" name="sell_id" class="form-control" value="" id="" placeholder="Sell Id">
     </div>
    </section>

   <section class="colmn">
     <div class="form-group">
         <label for="">Envitation Id</label>
         <input type="text" name="envt_id" class="form-control" value="" id="" placeholder="Envitation Id">
     </div>
    </section>

    <section class="colmn big">
      <div class="form-group">
          <label for="">date</label>
          <section>
          <select name="day" class="form-control" style="width:20%;float:left"> 
          <option value=""></option>

          <option value="<?php echo @$today; ?>"><?php echo @$today; ?></option>
          <?php 
              for ($i=1; $i <=9 ; $i++) { echo "<option value='0$i'>0$i</option>"; }
              for ($i=10; $i <=31 ; $i++) { echo "<option value='$i'>$i</option>"; } 
          ?>

          </select>
          
          <select name="month" class="form-control" style="width:50%;float:left">
            <option value=""></option>
            <option value="<?php echo @$this_month; ?>"><?php echo @$this_month; ?></option>
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
            <option value="<?php echo @$this_year; ?>"><?php echo @$this_year; ?></option>
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
         <label for=""> Closed </label>
         <select class="form-control" name="Cash_type">
           <option value=""></option>
           <option value="Done">Done</option>
           <option value="Avance">Avance</option>
         </select>
     </div>
   </section>
   <section class="colmn">
     <div class="form-group">
         <label for="">Sell Type</label>
         <select class="form-control" name="s_type">
           <option value=""></option>
           <option value="New">new</option>
           <option value="Addition">Addition</option>
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
      <button type="submit" class="btn btn-primary" name="search"><b class="fa fa-search"></b>&nbsp; Search</button>
        <a onclick="confirm('This process may take time, \n make sure you wait until it done loading all data.')" href="invitations.php?all_record" style="background: transparent;"> 
          <button type="button" class="btn btn-primary" name="button"><b class="fa fa-navicon"></b> &nbsp; View All</button> 
        </a>
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
$closed_q = ''; // closed for the divers

$check_query_o ="";

@$total_Bal_Pay_Fr = 0;
@$total_Bal_Pay_Dol = 0;
@$total_Bal_Pay_Fc = 0;

if (isset($_GET['search'])) {

      // Date
      if (isset($_GET['day']) && !empty($_GET['day'])) { @$day = @$_GET['day'].'-'; } else { @$day = ''; }
      if (isset($_GET['year']) && !empty($_GET['year'])) { @$yearo = '-'.$_GET['year']; } else { @$yearo = ''; }
      @$month = @$_GET['month'];
      @$sel_date = "$day$month$yearo";
      if (isset($day) && !empty($day) || isset($yearo) && !empty($yearo) || isset($month) && !empty($month)) { # date working
        $date_q = "AND `date` LIKE '%$sel_date%'";
      }

    // Sell Type
    if (isset($_GET['s_type']) && !empty($_GET['s_type'])) { # code..
      $s_type = $_GET['s_type'];
      $sType_q = "AND `typ`='$s_type'";
    }

    // Envitation Id
    if (isset($_GET['envt_id']) && !empty($_GET['envt_id'])) { # code..
      $envitation_id = $_GET['envt_id'];
      $env_q = "AND `e_id`='$envitation_id'";
    }

    // Sell Id
    if (isset($_GET['sell_id']) && !empty($_GET['sell_id'])) { # code..
      $envitation_id = $_GET['sell_id'];
      $sell_q = "AND `s_id`='$envitation_id'";
      $sell_q_B = "AND `sell_id`='$envitation_id'"; // for the balance
    }

    // Client Name
    if (isset($_GET['Cname']) && !empty($_GET['Cname'])) { # code..
      $Cname = $_GET['Cname'];
      $Cname_q = "AND `client_name` LIKE '%$Cname%'";
    }

    // done_by
    if (isset($_GET['done_by']) && !empty($_GET['done_by'])) { # code..
      $done_byE = $_GET['done_by'];
      $done_q = "AND `done_by`='$done_byE'";
    }

    // done_by
    if (isset($_GET['Cash_type']) && !empty($_GET['Cash_type'])) { # code..
      $Cash_typeE = $_GET['Cash_type'];
      $Cash_type_q = "AND `Cash_type`='$Cash_typeE'";
    }

    // CHACK IF THE BALANCE IS FOUND IN CASH TYPE
    if (isset($_GET['Cash_type']) && !empty($_GET['Cash_type'])) { # code..
      $closedE = $_GET['Cash_type'];
      $closed_q = "AND `closed`='$closedE'";
    }
}


// ----------------------------------------------
// INVITATION QUERY BUILDER
// query condition controlls
@$cond_query ="$sell_q $date_q $env_q $done_q $sType_q $Cname_q $Cash_type_q";


// ----------------------------------------------
// BALANCE QUERY BUILDER
// query condition controlls
@$cond_query_balance =" $date_q $Cname_q $sell_q_B $closed_q";




if (isset($_GET['all_record'])) { // this will display all the record
    $mainQuerySearch = "SELECT * FROM `selling_e`";

} elseif (isset($_GET['search'])) { // this will run when the user click the search button
  // INVITATION
  $mainQuerySearch = "SELECT * FROM `selling_e` WHERE `e_id`>'1' $cond_query ORDER BY `s_id` DESC";
  // BALANCE 
  $mainQuerySearchBalance = "SELECT * FROM `balance_table` WHERE `item`='Invitation' $cond_query_balance ORDER BY `balance_id` DESC";


} elseif(isset($_GET['day'])) {
    // this work with today
    if ($_GET['day'] == 'yesterday') {
      # yesterday
      // invitation
      $mainQuerySearch = "SELECT * FROM `selling_e` WHERE `date` LIKE '%$yesterday_date%' ORDER BY `s_id` DESC";
      // balance
      $mainQuerySearchBalance = "SELECT * FROM `balance_table` WHERE `item`='Invitation' AND `date` LIKE '%$yesterday_date%' ORDER BY `balance_id` DESC";
    } else {
      # today
      // invitation
      $mainQuerySearch = "SELECT * FROM `selling_e` WHERE `date` LIKE '%$today_date%' ORDER BY `s_id` DESC";
      // balance
      $mainQuerySearchBalance = "SELECT * FROM `balance_table` WHERE `item`='Invitation' AND `date` LIKE '%$today_date%' ORDER BY `balance_id` DESC";
    }
    

} elseif(isset($_GET['month'])) {
    // this works with the moth
    if ($_GET['month'] == 'previus') {
      # yesterday
      $dt = "$last_month-$this_year";
      // invitation
      $mainQuerySearch = "SELECT * FROM `selling_e` WHERE `date` LIKE '%$dt%' ORDER BY `s_id` DESC";
      // balance
      $mainQuerySearchBalance = "SELECT * FROM `balance_table` WHERE `item`='Invitation' AND `date` LIKE '%$dt%' ORDER BY `balance_id` DESC";

    } else {
      # this moth
      $dt = "$this_month-$this_year";
      // invitation
      $mainQuerySearch = "SELECT * FROM `selling_e` WHERE `date` LIKE '%$dt%' ORDER BY `s_id` DESC";
      // balance
      $mainQuerySearchBalance = "SELECT * FROM `balance_table` WHERE `item`='Invitation' AND `date` LIKE '%$dt%' ORDER BY `balance_id` DESC";

    }
    

} elseif(isset($_GET['year'])) {
     // this will return for the year
     $dt = "-$this_year";
     // invitation
     $mainQuerySearch = "SELECT * FROM `selling_e` WHERE `date` LIKE '%$dt%' ORDER BY `s_id` DESC";
     // balance
     $mainQuerySearchBalance = "SELECT * FROM `balance_table` WHERE `item`='Invitation' AND `date` LIKE '%$dt%' ORDER BY `balance_id` DESC";

} else {
  // invitation
  $mainQuerySearch = "SELECT * FROM `selling_e` WHERE `date` LIKE '%$today_date%' ORDER BY `s_id` DESC";
  // balance
  $mainQuerySearchBalance = "SELECT * FROM `balance_table` WHERE `item`='Invitation' AND `date` LIKE '%$today_date%' ORDER BY `balance_id` DESC";

}




// INVITATION QUERY PREPARE
$results = $mysqli->query("$mainQuerySearch");

// BALANCE QUERY PREPARE
$results_Balance = $mysqli->query($mainQuerySearchBalance);
 
?>

<?php include 'app_data/php/print_head.php'; ?>
  


<div class="quick-links-bar">

<div class="row" style=" margin-right: 0px; margin-left: 0px; ">
  <div class="col-xs-5">
  
  <div class="row">
  <div class="col-xs-4">
  <b>Day</b>
  <a href="invitations.php"><button type="button" class="btn btn-success btn-block">Today</button> </a>
  <a href="invitations.php?day=yesterday"><button type="button" class="btn btn-default btn-block">Yesterday</button>  </a>  
  </div>
  <div class="col-xs-4">
  <b>Month</b>
    <a href="invitations.php?month"><button type="button" class="btn btn-success btn-block"><?php echo $this_month; ?></button> </a>
    <a href="invitations.php?month=previus"><button type="button" class="btn btn-default btn-block"><?php echo $last_month; ?></button> </a> 
  </div>
  <div class="col-xs-4">
    <b>Year</b>
  <a href="invitations.php?year"><button type="button" class="btn btn-success btn-block"><?php echo $this_year; ?></button></a>
</div>
  </div>  
  
  </div>
  <div class="col-xs-5">

  <div class="row">
    <div class="col-xs-4">
      <div class="counter">
        <label>Sells</label>
          <h3><?php echo @$results->num_rows; ?></h3>
      </div>
    </div>
    <div class="col-xs-4">
      <div class="counter" style="border-color: #357bb7;">
        <label style="color: #367bb7;">Balance</label>
          <h3 style="color: #367bb7;"><?php echo @$results_Balance->num_rows; ?></h3>
      </div>
    </div>
    <div class="col-xs-4">
      <a href="#Balance">
        <button type="button" class="btn btn-default btn-block btn-lg" style="margin-top: 18px;"> Balance </button>
      </a>
      
    
    </div>
  </div>

</div>
  <div class="col-xs-2">
    <?php if(isAdmin()){ ?>
    <a href="invitationStock.php">
      <button type="button" class="btn btn-success btn-block btn-lg" style="margin-top: 18px;"> <small>Invitation</small> <br> Stock </button>
    </a>
    <?php } ?>
  
  </div>
</div>






</div>

  
  <div class="container_table_div">


    <?php
      if ($results->num_rows == NULL) {
    ?>

  <div class="fadeIn animated noDatafound" >
      <h1 class="fa fa-frown-o shake animated"></h1>
      <h3 class="fadeIn animated">No dada Found!</h3>
    </div>




    <?php
      } else { // DISPLAY DATA
    ?>

    <h3>Invitations - Sell</h3>
    
    <table class="table table-striped table-bordered">
      <tbody>
          <tr>
          <th>  </th>
          <th> # </th>
          <th> Date </th>
          <th> Inv-id </th>
          <th> Quantity </th>
          <th> <b class="fa fa-money" style="font-size: 21px;" title="Payment Type"></b> </th>
          <th> PU </th>

          <th> Pay Frw </th>
          <th> Pay $ </th>
          <th> Pay Fco </th>

          <th> Total (type)</th>
          <th> Total (Frw)</th>

          <th> Closed </th>
          <th> Client name </th>
        </tr>


    <?php
          while($row = $results->fetch_array()) {
            @$s_id = $row["s_id"];
            @$e_id = $row["e_id"];
            @$typ = $row["typ"];
            @$date = $row["date"];
            @$dateTime = $row["dateTime"];
    
    
            @$quantity = $row["quantity"];
            @$client_name = $row["client_name"];
            @$done_by = retrieve_data('lname','users','user_id',$row["done_by"]);
              
            @$closed = $row["closed"];
            @$paym_typ = $row["paym_typ"];
    
            @$Cash_type = $row["Cash_type"];
            @$PU = $row["PU"];
            @$Rate_R = $row["Rate_R"];
            @$Rate_Fc = $row["Rate_Fc"];
            @$Rate_R = $row["Rate_R"];
    
            // pay in
            @$Pay_Fr = $row["Pay_Fr"];
            @$Pay_Dol = $row["Pay_Dol"];
            @$Pay_fc = $row["Pay_fc"];
    
            @$Price_total = $row["Price_total"];
            @$Price_total_Rw = $row["Price_total_Rw"];
    
            @$Total_Available = $row["Total_Available"];
            @$Total_Available_Rw = $row["Total_Available_Rw"];
    
            $check_query_o = "SELECT `sell_id` FROM `error_table` WHERE `sell_id`='$s_id' AND typ='I'";

            @$balance_sell = $row["balance"];

      ?>
      <tr onclick="sellDetails(<?php echo @$s_id; ?>)">
        <td>
          <?php 
          if ($balance_sell != 0)  {
            echo '<b class="fa fa-exclamation-triangle fadeIn animated infinite" style="color: #ff9800;font-weight: normal;margin: 0px 1px 0px 4px;"></b>'; 
          } else {
            echo '<b class="fa fa-check-circle" style="color: #00ca00;font-weight: normal;margin: 0px 1px 0px 4px;"></b>';
          } ?>
        </td>


        <td> <?php echo @$s_id; ?> </td>
        <td> <b> <?php echo @$date; ?> </b> <section class="date"><?php echo @$dateTime; ?></section> </td>
        <td> <?php echo @$e_id; ?> </td>
        <td> <?php echo @$quantity; ?> </td>
        <td> <?php echo @$paym_typ; ?> </td>
        <td> <?php echo @money($PU); ?> <?php echo @$paym_typ; ?></td>

        <td> <?php echo @money($Pay_Fr); ?> Frw</td>
        <td> <?php echo @money($Pay_Dol); ?> $</td>
        <td> <?php echo @money($Pay_fc); ?> Fc</td>

        <td> <?php echo @money($Total_Available); ?> <?php echo @$paym_typ; ?></td>
        <td> <?php echo @money($Total_Available_Rw); ?> Frw</td>

        <td> <?php echo @$Cash_type; ?> </td>
        <td> <?php echo @$client_name; ?> </td>
      </tr>

      <?php
        // payed in cash
        @$total_Pay_Fr_incr += $Pay_Fr;
        @$total_Pay_Fc_incr += $Pay_fc;
        @$total_Pay_dol_incr += $Pay_Dol;

        @$Price_total_Rw_incr += $Total_Available_Rw;      

      }

      ?>

      <tbody>
          <tr>
          <th>  </th>
          <th> # </th>
          <th> Date </th>
          <th> Inv-id </th>
          <th> Quantity </th>
          <th> <b class="fa fa-money" style="font-size: 21px;" title="Payment Type"></b> </th>
          <th> PU </th>

          <th> Pay Frw </th>
          <th> Pay $ </th>
          <th> Pay Fco </th>

          <th> Total (type)</th>
          <th> Total (Frw)</th>

          <th> Closed </th>
          <th> Client name </th>
        </tr>

         <tr>
          <td colspan="7"> Total </td>

          <td bgcolor="lightblue">  <?php echo @money($total_Pay_Fr_incr); ?> Frw </td>
          <td bgcolor="lightblue">  <?php echo @money($total_Pay_dol_incr); ?>  $ </td>
          <td bgcolor="lightblue">  <?php echo @money($total_Pay_Fc_incr); ?>  Fco </td>

          <td> &nbsp; </td>
          <td bgcolor="lightblue"> <b> <?php echo @money($Price_total_Rw_incr); ?> Frw</b></td>

          <td colspan="2">  &nbsp; </td>
        </tr>
      </tbody>
    </table>

    <?php } ?>
  </div>

<!-- <hr> -->


<div class="container_table_div" id="Balance">




<?php

///////////////////////////////////////////////////////////////
///////////////////////  BALANCE PREPARE QUERY ////////////////
///////////////////////////////////////////////////////////////

  if ($results_Balance->num_rows <= 0) {
?>

   <div class="fadeIn animated noDatafound" >
      <h3 class="fadeIn animated">No Balance Found!</h3>
    </div>

<?php
  } else {
?>

<h3 style="margin-top: 37px;">Invitations - Balance</h3>

 <table border="1" class="table  table-striped table-bordered">
    <tbody>
      <tr>
          <th> # </th>
          <th> Date </th>
          <th> Sell-Id </th>
          <th> Inv-id </th>
          <th> <b class="fa fa-money" style="font-size: 21px;" title="Payment Type"></b> </th>
          <th> Pay Frw </th>
          <th> Pay $ </th>
          <th> Pay Fco </th>

          <th> Total (type)</th>
          <th> Total (Frw)</th>

          <th> Closed </th>
          <th> Client name </th>
      </tr>
<?php

  @$total_Bal_Total_Available+= 0;
  @$total_Bal_Total_Available_Rw = 0;

  while($row = $results_Balance->fetch_array()) {
    @$Bal_id = $row["balance_id"];
    @$Bal_date = $row["date"];
    @$dateTime = $row["dateTime"];
    @$Bal_item_id = $row["item_id"];
    @$Bal_sell_id = $row["sell_id"];
    @$Bal_client_name = $row["client_name"];
    @$done_by = retrieve_data('lname','users','user_id',$row["done_by"]);
    @$Bal_closed = $row["closed"];
    @$item = $row["item"];
  
    @$Bal_paym_typ = $row["paym_typ"];
    @$Bal_Pay_Fr = $row["Pay_Fr"];
    @$Bal_Pay_Dol = $row["Pay_Dol"];
    @$Bal_Pay_fc = $row["Pay_fc"];
    @$Bal_Total_Available = $row["Total_Available"];
    @$Bal_Total_Available_Rw = $row["Total_Available_Rw"];

  ?>
  <tr class="" onclick="return balanceDetails(<?php echo @$Bal_id; ?>,'<?php echo @$item; ?>');">
      <td> <?php echo @$Bal_id; ?> </td>
      <td> <b> <?php echo @$date; ?> </b> <section class="date"><?php echo @$dateTime; ?></section> </td>
      <td> <?php echo @$Bal_sell_id; ?> </td>
      <td> <?php echo @$Bal_item_id; ?> </td>
      <td> <?php echo @$Bal_paym_typ; ?> </td>

      <td> <?php echo @money($Bal_Pay_Fr); ?> Frw</td>
      <td> <?php echo @money($Bal_Pay_Dol); ?> $</td>
      <td> <?php echo @money($Bal_Pay_fc); ?> Fc</td>

      <td> <?php echo @money($Bal_Total_Available); ?> <?php echo @$Bal_paym_typ; ?></td>
      <td> <?php echo @money($Bal_Total_Available_Rw); ?> Frw</td>

      <td> <?php echo @$Bal_closed; ?> </td>
      <td> <?php echo @$Bal_client_name; ?> </td>
   </tr>
  <?php
      @$total_Bal_Pay_Fr += $Bal_Pay_Fr;
      @$total_Bal_Pay_Dol += $Bal_Pay_Dol;
      @$total_Bal_Pay_Fc += $Bal_Pay_fc;
      
      // @$total_Bal_Total_Available += $Bal_Total_Available;
      @$total_Bal_Total_Available_Rw += $Bal_Total_Available_Rw;
      
      
 
      }

   ?>
<tr>
    <th> # </th>
    <th> Date </th>
    <th> Sell-Id </th>
    <th> Inv-id </th>
    <th> <b class="fa fa-money" style="font-size: 21px;" title="Payment Type"></b> </th>
    <th> Pay Frw </th>
    <th> Pay $ </th>
    <th> Pay Fco </th>

    <th> Total (type)</th>
    <th> Total (Frw)</th>

    <th> Closed </th>
    <th> Client name </th>
</tr>
<tr class="no-border">
  <td colspan="5"> &nbsp;</td>
  <td bgcolor="lightblue"> <?php echo @money($total_Bal_Pay_Fr); ?> Frw</td>
  <td bgcolor="lightblue"> <?php echo @money($total_Bal_Pay_Dol); ?> $</td>
  <td bgcolor="lightblue"> <?php echo @money($total_Bal_Pay_Fc); ?> Fc</td>

  <td> &nbsp; </td>
  <td bgcolor="lightblue"><b> <?php echo @money($total_Bal_Total_Available_Rw); ?> Frw</b></td>
  
  <td colspan="2"> &nbsp;</td>
</tr>
  </tbody></table>

<?php } ?>
</div>




<style media="screen">
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

.report-controls .rowe .colmn { width: 25%; float: left; }
.form-group { padding: 5px 10px; margin: 0px; }
.report-controls .rowe .big { width: 30%; }
.report-controls .rowe .small { width: 20%; }
.form-control { display: block; width: 100%; }
.table-small-report { min-width: 400px; max-width: 50%; }

.head-tit-rep-div {
  background: #9E9E9E;
  background: #282e36;
  padding: 10px;
  padding-left: 65px;
  background-image: url(app_data/imgs/icns/small-logo.png);
  background-size: 41px 34px;
  background-repeat: no-repeat;
  background-position: 18px 8px;
  font-size: 23px;
  color: #fff;
  text-shadow: 0px 0px 2px #000;
}

.print-sett {
      text-align: right;
      border-top: 1px solid grey;
      padding-top: 6px;
      display: none;
}

.report-control-quick {
    width: 100%;
    background: #f1f1f1;
    margin: auto;
    padding: 10px 2% 11px 2%;
    border-bottom: 1px solid #5db85d;
}

</style>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

















<?php
if (isset($_GET['details_id'])) {
  $details_id = $_GET['details_id'];
?>
    <script type="text/javascript">
    $(document).ready(function() {
       sellDetails(<?php echo $details_id; ?>);
    });
    </script>
<?php
}
?>


<!-- </div> -->
</div><!-- .contents-div -->

<div class="">
  <div class="contents-iframe fadeIn animated search-conent-div" id="SearchResult">
      <section class="cancel-section-button">
        <button type="button" name="button" onclick="HideSearchDivContent()"> <b class="fa fa-arrow-left"></b> Back</button>
      </section>
      <div class="" id="iframeDispayDiv"></div>
  </div>
</div>



</div><!-- .containner -->
</div><!-- .main-containner -->
<?php include 'app_data/php/foater.php' ?>
