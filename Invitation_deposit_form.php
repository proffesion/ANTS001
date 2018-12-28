<?php
include 'app_data/php/head_blank.php';
secured();
$check_query_o ="";

@$total_Bal_Pay_Fr = 0;
@$total_Bal_Pay_Dol = 0;
@$total_Bal_Pay_Fc = 0;

?>
<style media="screen">
body { background: #bbb; }
</style>



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
      <a class="navbar-brand" href="home.php">ANTARES</a>
    </div>





<?php
   if (isset($_GET['search'])) {
        $day = $_GET['day'];
        $month = $_GET['month'];
        $year = $_GET['year'];

        $date_Q = "$day-$month-$year";
   } else if (isset($_GET['date'])) {
         $date = $_GET['date'];

         $date_Q = $date;
   } else {
     $date_Q = $today_date;
   }
?>



    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="invitation_deposit_form.php?date=<?php echo $yesterday_date; ?>">Yesterday</a></li>
        <li><a href="invitation_deposit_form.php">Today</a></li>
      </ul>
        <form class="navbar-form navbar-left" action="invitation_deposit_form.php" method="get">

        <!-- </form> -->
        <div class="form-group">
          <select name="day" class="form-control" required=""> <option value="">Day</option> <?php for ($i=1; $i <=9 ; $i++) { echo "<option value='0$i'>0$i</option>"; } for ($i=10; $i <30 ; $i++) { echo "<option value='$i'>$i</option>"; } ?> </select>
        </div>

        <div class="form-group">
          <select name="month" class="form-control" required="">
            <option value="">Month</option>
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
        </div>

        <div class="form-group">
          <select name="year" class="form-control" required="">
            <option value="">Year</option>
            <?php for ($i=2017; $i < 2030 ; $i++) { echo "<option value='$i'> $i </option>"; } ?>
          </select>
        </div>

        <button type="submit" name="search" class="btn btn-success"><b class="fa fa-search"></b></button>
      </form>

        <section class="navbar-form navbar-left">
        <div class="form-group">
        <select name="" class="form-control" id="printTypeSel" onchange="printDeposit()">
          <option value="all">All</option>
          <option value="invitation">Invitation</option>
          <option value="balance">Balance</option>
          <option value="IB">Invi & Bal </option>
          <!-- <option value="deposit">Deposit</option> -->
        </select>
        </div>

        <button type="button" class="btn btn-primary" onclick="print()"><b class="fa fa-print"></b></button>
        </section>





      <ul class="nav navbar-nav navbar-right">
        <li><h2 class="h2-date-disp"><?php echo @$date_Q; ?></h2></li>
      </ul>



    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php
@$mainQuerySearch = "SELECT * FROM `selling_e` WHERE `date`='$date_Q'";


if (number_ret($mainQuerySearch) == 0) {
  # code...
 ?>
  <style>
  table { display: none; }
  .null-hide {display: none;}
  </style>



    <div class="modal-dialog zoomIn animated" role="document" style="display:block;">
      <div class="modal-content modal-styled-danger" style="display:block">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <!-- <img src="app_data/imgs/01_no_more_in_stock.png" class="img-icon-shw" alt="" /> -->
          <h1 class="icon-sub-font shake animated fa fa-shopping-cart"></h1>
          <h2 class="title-sub"> No result found for: <?php echo @$date_Q; ?> </h2>
          <p>
          Try to search and use different date
          </p>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
          <a href="home.php">
            <button type="button" class="btn btn-primary">Back</button>
          </a>
        </div>
      </div>
    </div>




<?php } ?>

<br>

<div class="deposit-div-containner invitation-deposit null-hide">
  <h2>Invitation</h2>


  <table class="table" border="1">
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

        <th> Total (type)</th>
        <th> Total (Frw)</th>

        <th> Closed </th>
        <th> client_name </th>
        <!-- <th> / </th> -->
      </tr>

  <?php
  $results = $mysqli->query("$mainQuerySearch");

  if ($results->num_rows == NULL) {
?>
    <div class=" bounceIn animated">
    <h2 class="fa fa-warning"></h2>
    <p>No Result Found!</p>
    </div>
<?php
  } else {
    $x = 0;

      while($row = $results->fetch_array()) {
        @$s_id = $row["s_id"];
        @$e_id = $row["e_id"];
        @$typ = $row["typ"];
        @$date = $row["date"];
        @$quantity = $row["quantity"];
        @$client_name = $row["client_name"];
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

        @$check_query_o = "SELECT `sell_id` FROM `error_table` WHERE `sell_id`='$s_id' AND typ='I'";

  ?>
    <tr <?php if (number_ret($check_query_o) > 0)  { echo 'style="background:red;color:#fff;"'; } ?>>

    <td> <?php echo @$s_id; ?> </td>
    <td> <?php echo @$date; ?> </td>
    <td> <?php echo @$e_id; ?> </td>
    <td> <?php echo @$quantity; ?> </td>
    <td> <?php echo @$paym_typ; ?> </td>
    <td> <?php echo @$PU; ?> <?php echo @$paym_typ; ?></td>

    <td> <?php echo @$Pay_Fr; ?> Frw</td>
    <td> <?php echo @$Pay_Dol; ?> $</td>
    <td> <?php echo @$Pay_fc; ?> Fc</td>

    <td> <?php echo @$Total_Available; ?> <?php echo @$paym_typ; ?></td>
    <td> <?php echo @$Total_Available_Rw; ?> Frw</td>

    <td> <?php echo @$Cash_type; ?> </td>
    <td> <?php echo @$client_name; ?> </td>
    <!-- <td> -->
     <?php
        if ($paym_typ == 'frw') {
          # his is the sum to total in dolar
          @$total_Rw_Rw_Sum = @$Total_Available_Rw;
          @$total_Rw_fc_Sum = 0;
          @$total_Rw_dol_Sum = 0;

        } elseif ($paym_typ == 'fc') {
          # his is the sum to total in dolar
          @$total_Rw_Rw_Sum = 0;
          @$total_Rw_fc_Sum = @$Total_Available_Rw;
          @$total_Rw_dol_Sum = 0;

        } elseif ($paym_typ == 'dol') {
          # his is the sum to total in dolar
          @$total_Rw_Rw_Sum = 0;
          @$total_Rw_fc_Sum = 0;
          @$total_Rw_dol_Sum = @$Total_Available_Rw;

        }
        // echo " $total_Rw_Rw_Sum / $total_Rw_fc_Sum / $total_Rw_dol_Sum  ";

         if ($Total_Available_Rw > $Price_total_Rw) {
            //  exedent
            $exedent = $Total_Available_Rw - $Price_total_Rw;
            $manq = 0;

         } elseif ($Total_Available_Rw < $Price_total_Rw) {
           # manquea
            $exedent = 0;
            $manq = $Price_total_Rw - $Total_Available_Rw;
         } else {

           $exedent = 0;
           $manq = 0;
         }

     ?>

   </tr>

  <?php
    // payed in cash
    @$total_Pay_Fr_incr += $Pay_Fr;
    @$total_Pay_Fc_incr += $Pay_fc;
    @$total_Pay_dol_incr += $Pay_Dol;

    @$Price_total_Rw_incr += $Total_Available_Rw;

    @$exedentSum += $exedent;
    @$manqSum += $manq;

      }
  }
   ?>

   <tr>
     <td> &nbsp; </td>
     <td> &nbsp; </td>
     <td> &nbsp; </td>
     <td> &nbsp; </td>
     <td> &nbsp; </td>
     <td> &nbsp; </th>

     <td bgcolor="lightblue"> <?php echo @$total_Pay_Fr_incr; ?> Frw </td>
     <td bgcolor="lightblue">  <?php echo @$total_Pay_dol_incr; ?>  $ </td>
     <td bgcolor="lightblue">  <?php echo @$total_Pay_Fc_incr; ?>  Fco </td>

     <td> &nbsp; </td>
     <td bgcolor="lightblue"> <b> <?php echo @$Price_total_Rw_incr; ?> Frw</b></td>

     <td> &nbsp; </td>
     <td> &nbsp; </td>
   </tr>


  </tbody></table>
</div>





<!-- ========================================================================================================================= -->
<?php @$BalanceQuerySearch = "SELECT * FROM `balance_table` WHERE `item`='Invitation' AND `date`='$date_Q'";
  if (number_ret($BalanceQuerySearch) >= 1) {
    # code...
?>

<div class="deposit-div-containner balance-deposit">
  <h2>Balance</h2>

  <table class="table" border="1">
    <tbody>
      <tr>
        <th> # </th>
        <th> Date </th>
        <th> E-id </th>
        <th> <b class="fa fa-money" style="font-size: 21px;" title="Payment Type"></b> </th>
        <th> Pay Frw </th>
        <th> Pay $ </th>
        <th> Pay Fco </th>

        <th> Total (type)</th>
        <th> Total (Frw)</th>

        <th> Closed </th>
        <th> client_name </th>
      </tr>

  <?php
  $results = $mysqli->query("$BalanceQuerySearch");

  if ($results->num_rows == NULL) {
?>
 <style>
   .balance-deposit { display: none; }
 </style>

<?php



@$total_Bal_Total_Available+= 0;
@$total_Bal_Total_Available_Rw = 0;

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
    <tr <?php if (number_ret($check_query_o) > 0)  { echo 'style="background:red;color:#fff;"'; } ?>>

    <td> <?php echo @$Bal_sell_id; ?> </td>
    <td> <?php echo @$Bal_date; ?> </td>
    <td> <?php echo @$Bal_item_id; ?> </td>
    <td> <?php echo @$Bal_paym_typ; ?> </td>

    <td> <?php echo @$Bal_Pay_Fr; ?> Frw</td>
    <td> <?php echo @$Bal_Pay_Dol; ?> $</td>
    <td> <?php echo @$Bal_Pay_fc; ?> Fc</td>

    <td> <?php echo @$Bal_Total_Available; ?> <?php echo @$paym_typ; ?></td>
    <td> <?php echo @$Bal_Total_Available_Rw; ?> Frw</td>

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
}
?>

<tr class="no-border">
  <td> &nbsp;</td>
  <td> &nbsp; </td>
  <td> &nbsp; </td>
  <td> &nbsp; </td>
  <td bgcolor="lightblue"> <?php echo @$total_Bal_Pay_Fr; ?> Frw</td>
  <td bgcolor="lightblue"> <?php echo @$total_Bal_Pay_Dol; ?> $</td>
  <td bgcolor="lightblue"> <?php echo @$total_Bal_Pay_Fc; ?> Fc</td>

  <td> &nbsp; </td>
  <td bgcolor="lightblue"><b> <?php echo @$total_Bal_Total_Available_Rw; ?> Frw</b></td>

  <td> &nbsp; </td>
  <td> &nbsp; </td>
</tr>
</tbody></table>
</div>

<?php
}
 ?>


<!-- ============================================================================================================================== -->









<!--

<div class="paper-containner null-hide deposit-form-table" style="">

   <h1 class="head-txt" style="color:red;">Deposit form/Invitation</h1>
   <table border="1" class="deposit-table deposit-part-one" width="100%" height="306px">
     <tr>
       <td style="width: 25%;"> &nbsp; </td>
       <td style="text-align:center;width: 25%;"> <b class="title"> CASH </b> </td>
       <td style="text-align:center;width: 25%;"> <b class="title"> RATE </b> </td>
       <td style="text-align:center;width: 25%;"> <b class="title"> RWF VALUE </b> </td>
     </tr>
     <tr>
       <td><b class="title"> &nbsp; AMOUNT USD (Rate 1) </b></td>
       <td style="text-align:center;"> <label>
         <?php
          @$total_Pay_dol_incr_bal = @$total_Pay_dol_incr + $total_Bal_Pay_Dol;
          echo @$total_Pay_dol_incr_bal;
         ?>
      $ </label> </td>
        <td style="text-align:center;">
          <input type="text" value="<?php echo @$rate_rw_r; ?>" class="form-control invisible-form" style="text-align: right;"> <label>$</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
       <td style="text-align:center;"> <label><?php  echo foFixed(change_rate_receive_php($rate_rw_r, $rate_fc_r, 'dol', 'rw', $total_Pay_dol_incr_bal)); ?> Frw</label> </td>
     </tr>

     <tr>
       <td><b class="title"> &nbsp; AMOUNT USD (Rate 2) </b></td>
       <td style="text-align:center;"> &nbsp; </td>
       <td style="text-align:center;"> &nbsp; </td>
       <td style="text-align:center;"> &nbsp; </td>
     </tr>

     <tr>
       <td><b class="title"> &nbsp; AMOUNT USD (Rate 3) </b></td>
       <td style="text-align:center;"> &nbsp; </td>
       <td style="text-align:center;"> &nbsp; </td>
       <td style="text-align:center;"> &nbsp; </td>
     </tr>
       <tr>
         <td><b class="title"> &nbsp; AMOUNT RWF </b></td>
         <td style="text-align:center;"> <label><?php echo @$total_Pay_Fr_incr + $total_Bal_Pay_Fr; ?> Frw</label> </td>
         <td style="text-align:center;"> - </td>
         <td style="text-align:center;"> <label><?php echo @$total_Pay_Fr_incr + $total_Bal_Pay_Fr; ?> Frw</label>  </td>
       </tr>

       <tr>
         <td><b class="title"> &nbsp; AMOUNT Franc Congolais </b></td>
         <td style="text-align:center;"> <label>
           <?php
           @$total_Pay_Fc_incr_bal = @$total_Pay_Fc_incr + @$total_Bal_Pay_Fc;
           echo @$total_Pay_Fc_incr_bal;
           ?> Fco</label>  </td>
         <td style="text-align:center;">
           <input type="text" value="<?php echo @$rate_fc_r; ?>" class="form-control invisible-form"  style="text-align: right;"> <label>Fc</label>  &nbsp;&nbsp;&nbsp;&nbsp;
          </td>
         <td style="text-align:center;"> <label><?php  echo foFixed(change_rate_receive_php($rate_rw_r, $rate_fc_r, 'fc', 'rw', $total_Pay_Fc_incr_bal)); ?> Frw</label>  </td>
       </tr>
       <tr>
         <td><b class="title"> &nbsp; TOTAL </b></td>
         <td style="text-align:center;"> - </td>
         <td style="text-align:center;"> - </td>
         <?php
        //  calculate the total
        $total_display =  @$Price_total_Rw_incr + @$total_Bal_Total_Available_Rw;
        $total_without_exedent = @$total_display - @$exedentSum;
         ?>
         <td style="text-align:center;"> <label><?php echo @$total_without_exedent; ?> Frw</label> </td>
       </tr>

   </table>

<br><br>


<table border="1" class="deposit-table" width="75%" height="206px">
  <tr>
    <td style="width: 1.6%;"> <b class="title"> &nbsp; SURPLUS/SHORTFALL(Rw) </b> </td>
    <td> &nbsp; &nbsp; &nbsp; <label><?php echo @$exedentSum; ?> Frw</label> </label> </td>
  </tr>
  <tr>
    <td> <b class="title"> &nbsp; ACTIVITY PERIOD </b> </td>
    <td style="width: 12.6%;"> &nbsp; &nbsp; &nbsp;  <label><?php echo @$date_Q; ?></label> </td>
  </tr>
  <tr>
    <td height="105px"> <b class="title"> &nbsp; CHECKED BY </b> <br><br><br> </td>
    <td style="width: 12.6%;">


        <table border="1" style="width:100%;height: 105px;box-shadow: none;">
          <tr>
            <td valign="top" style="padding-top: 8px;">
              <label style="padding: 0px 7px;">1.</label><label><?php echo "$fnamel  $lnamel"; ?></label>
            </td>
            <td valign="top" style="padding-top: 5px;">

&nbsp;        <label>2.</label>
        <select class="form-control invisible-form" style="width:90%;">
              <option value=""></option>
              <option value="None">None</option>
              <?php
              $results_users = $mysqli->query("SELECT `fname`,`lname` FROM `users` WHERE `perm`='1'");
              if ($results_users->num_rows == NULL) {
              } else {
                  while($rowe = $results_users->fetch_array()) {
                    $fname = $rowe["fname"];
                    $lname = $rowe["lname"];
                    echo "<option value=''>$fname $lname </option>";
                  }
              } ?>
          </select>


            </td>
          </tr>
        </table>
     </td>
  </tr>

</table>

<br><br>
<h4>DEPOSITOR:
  <select class="form-control invisible-form">
        <option value=""></option>
        <option value="None">None</option>
        <?php
        $results_users = $mysqli->query("SELECT `fname`,`lname` FROM `users` WHERE `perm`='1'");
        if ($results_users->num_rows == NULL) {
        } else {
            while($rowe = $results_users->fetch_array()) {
              $fname = $rowe["fname"];
              $lname = $rowe["lname"];
              echo "<option value=''>$fname $lname </option>";
            }
        } ?>
    </select>
</h4> <br>
<h4>APPROVED BY:  <label>Timothée Niyitegeka</label></h4>

</div>
-->




<style media="screen">

.deposit-part-one {
  height: 306px;
}

.h2-date-disp {
    padding-top: 13px;
    font-size: 23px;
}

</style>

<style media="screen">
  .paper-containner {
        background: white;
        padding: 44px 26px;
        margin: 26px;
  }

  .head-txt {
    font-weight: bold;
    color: red;
    padding-bottom: 8px;
  }

  b.title {
    padding: 10px 10px;
    font-size: 19px;
    color: blue;
  }

.center {
  text-align: center;
}
.deposit-table label {
    font-size: 19px;
    margin: 0px;
 }

a.current {
  color: #000;
  background: transparent;
  /* border-bottom: 5px solid #E91E63; */
  padding-bottom: 0px;
  margin-bottom: -5px;
  border: 2px solid #41e147;
  font-size: 18px;
}


.invisible-form {
  margin: 0px;
  background: transparent;
  border: none;
  color: #000;
  font-size: 19px;
  padding: 0;
  width: 26%;
  display: inline;
  box-shadow: none;
}

/*
class="invisible-form"
class="invisible-form"*/
</style>

<?php include 'app_data/php/foater.php' ?>
