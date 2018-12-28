<?php
include 'app_data/php/head_blank.php';
secured();
?>
<section class="hide-print">

<div class="head-tit-rep-div">
  BALANCE REPORT
  <a href="home.php" style="float: right;margin-right: 23px;text-decoration: none;color: #fff;"><b class="fa fa-home"></b></a>
</div>
<div class="report-controls">


  <section class="rowe">
    <form class="" action="balance_report.php" method="post">

   <section class="colmn small" style="width: 12%;">
     <div class="form-group">
         <label for="">balance Id</label>
         <input type="text" name="balance_id" class="form-control" value="" id="" placeholder="Balance Id">
     </div>
    </section>

   <section class="colmn small" style="width: 12%;">
     <div class="form-group">
         <label for="">Ballance Type</label>
         <select class="form-control" name="bal_type">
           <option value=""></option>
           <option value="Invitation">Invitation</option>
           <option value="Divers">Divers</option>
         </select>
     </div>
    </section>

     <section class="colmn big" style="width: 28%;">
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



     <!-- <section class="colmn">
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
  </section> -->

  <section class="rowe">
    <section class="colmn small"  style="width: 9%;">
      <div class="form-group">
          <label for=""> Closed</label>
          <select class="form-control" name="closed">
            <option value=""></option>
            <option value="No">No</option>
            <option value="Yes">Yes</option>
          </select>
      </div>
    </section>

    <section class="colmn small">
      <div class="form-group">
          <label for="">Client Name</label>
          <input type="text" name="Cname" class="form-control" value="" id="" placeholder="Client Name">
      </div>
     </section>
     <section class="colmn small" style="padding: 21px 0px 0px 0px;width: 18%;">
       <button type="submit" class="btn btn-primary submit-butt" name="search"><b class="fa fa-search"></b>&nbsp; Check</button>
         <a href="balance_report.php" style="background: transparent;"> <button type="button" class="btn btn-primary" name="button"><b class="fa fa-navicon"></b> &nbsp; View All</button> </a>
        <button type="button" class="btn btn-primary print-sett-show" name=""> <b class="fa fa-ellipsis-v"></b> </button>
      </section>





   <section class="clear-both">x</section>
  <section class="print-sett">
     name This Report:
     <input type="text" onkeyup="headReport()" id="textHead" value="">
        <button type="button" class="btn btn-primary" onclick="print()"> <b class="fa fa-print"></b> Print</button>
  </section>
 </section>
</div>
</form>

</section>




<?php
$date_q = '';
$env_q = '';
$done_q = '';
$bal_type_q = '';
$balance_id_q = '';
$Cname_q = '';
$closed_q = '';

if (isset($_POST['search'])) {

  // Date
  if (isset($_POST['day']) && !empty($_POST['day'])) { @$day = @$_POST['day'].'-'; } else { @$day = ''; }
  if (isset($_POST['year']) && !empty($_POST['year'])) { @$yearo = '-'.$_POST['year']; } else { @$yearo = ''; }
  @$month = @$_POST['month'];
  @$sel_date = "$day$month$yearo";
  if (isset($day) && !empty($day) || isset($yearo) && !empty($yearo) || isset($month) && !empty($month)) { # date working
    $date_q = "AND `date` LIKE '%$sel_date%'";
  }

// Sell Type
if (isset($_POST['balance_id']) && !empty($_POST['balance_id'])) { # code..
   $balance_id = $_POST['balance_id'];
   $balance_id_q = "AND `balance_id`='$balance_id'";
}

// Envitation Id
if (isset($_POST['bal_type']) && !empty($_POST['bal_type'])) { # code..
   $bal_type = $_POST['bal_type'];
   $bal_type_q = "AND `item`='$bal_type'";
}

// Client Name
if (isset($_POST['Cname']) && !empty($_POST['Cname'])) { # code..
   $Cname = $_POST['Cname'];
   $Cname_q = "AND `client_name` LIKE '%$Cname%'";
}

// done_by
// if (isset($_POST['done_by']) && !empty($_POST['done_by'])) { # code..
//    $done_byE = $_POST['done_by'];
//    $done_q = "AND `done_by`='$done_byE'";
// }

// done_by
if (isset($_POST['closed']) && !empty($_POST['closed'])) { # code..
   $closedE = $_POST['closed'];
   $closed_q = "AND `closed`='$closedE'";
}

}
// ----------------------------------------------
// query condition controlls
@$cond_query =" $date_q $bal_type_q $Cname_q $balance_id_q $closed_q";
$mainQuerySearch = "SELECT * FROM `balance_table` WHERE `balance_id`!='0' $cond_query ORDER BY `balance_id` DESC";
?>

<?php include 'app_data/php/print_head.php'; ?>

<table border="1" class="table table-bordered">
  <tbody>
    <tr>
      <!-- <th width="33px;">&nbsp; </th> -->
      <th style="text-align:center;"> # </th>
      <th> Date </th>
      <th> item </th>
      <th> Item Id / Item Name </th>
      <th> sell_id </th>
      <th> balance </th>
      <th> payed_in </th>
      <th> client_name </th>
      <th> closed </th>
      <th> comment </th>
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

    while($row = $results->fetch_array()) {
      @$b_id = $row["balance_id"];
      @$item = $row["item"];
      @$item_id = $row["item_id"];
      @$date = $row["date"];
      @$sell_id = $row["sell_id"];
      @$balance = $row["balance"];
      @$payed_in = $row["payed_in"];
      @$client_name = $row["client_name"];
      @$closed = $row["closed"];
      @$comment = $row["comment"];
?>

<tr class="<?php if ($x%2 == 0) { echo "a"; } else { echo "b"; }?>">
  <td style="text-align:center;"> <?php echo @$b_id; ?> </td>
  <td> <?php echo @$date; ?> </td>
  <td> <?php echo @$item; ?> </td>
  <td><b>
    <?php
    if ($item == 'Divers') {
      if ($item_id == '0') {
        echo "Others";
      } else {
        $pro_name = @retrieve_data('pro_name','products','pro_id',$item_id);
        if (strlen($pro_name) > 18) { $pro_name_t = substr($pro_name, 0, 18).".."; } else { $pro_name_t = $pro_name; } echo @$pro_name_t;

      }
    } else {
        echo @$item_id;
    }
   ?></b> </td>
  <td> <b><?php echo @$sell_id; ?></b> </td>
  <td> <?php echo @$balance; ?> </td>
  <td> <?php echo @$payed_in; ?> </td>
  <td> <?php echo @$client_name; ?> </td>
  <td> <?php echo @$closed; ?> </td>
  <td> <?php echo @$comment; ?> </td>
 </tr>
<?php
$x++; // incemmenting

    }

}

 ?>
 <!-- <tr> <th> # </th> <th> E-id </th> <th> Type </th> <th> Date </th> <th> Quantity </th> <th> Pay in </th> <th> closed </th> <th> PU Rfw </th> <th> PT Rfw </th> <th> PU $ </th> <th> PT $ </th> <th> Avance </th> <th> Balance </th> <th> Client Name </th> <th> Done By </th> </tr> -->
</tbody></table>







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
