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
    <h2> BALANCE </h2>
    <b class="search-option glyphicon glyphicon-eye-open click"></b>
</section>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<section class="hide-print">
<div class="report-controls fadeIn animated">
 <section class="rowe">
   <form class="" action="balance_view.php" method="get">

  <section class="colmn">
    <div class="form-group">
        <label for="">balance Id</label>
        <input type="text" name="balance_id" class="form-control" value="" id="" placeholder="Balance Id">
    </div>
   </section>

  <section class="colmn">
    <div class="form-group">
        <label for="">Ballance Type</label>
        <select class="form-control" name="bal_type">
          <option value=""></option>
          <option value="Invitation">Invitation</option>
          <option value="Divers">Divers</option>
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


 <section class="rowe">
   <section class="colmn small">
     <div class="form-group">
         <label for=""> Closed</label>
         <select class="form-control" name="closed">
           <option value=""></option>
           <option value="No">No</option>
           <option value="Yes">Yes</option>
         </select>
     </div>
   </section>

   <section class="colmn big">
     <div class="form-group">
         <label for="">Client Name</label>
         <input type="text" name="Cname" class="form-control" value="" id="" placeholder="Client Name">
     </div>
    </section>
    <section class="colmn" style="padding: 26px 0px 0px 12px;">
      <button type="submit" class="btn btn-primary" name="search"><b class="fa fa-search"></b>&nbsp; Check</button>
        <a href="balance_view.php" style="background: transparent;"> <button type="button" class="btn btn-primary" name="button"><b class="fa fa-navicon"></b> &nbsp; View All</button> </a>
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
$bal_type_q = '';
$balance_id_q = '';
$Cname_q = '';
$closed_q = '';

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
if (isset($_GET['balance_id']) && !empty($_GET['balance_id'])) { # code..
   $balance_id = $_GET['balance_id'];
   $balance_id_q = "AND `balance_id`='$balance_id'";
}

// Envitation Id
if (isset($_GET['bal_type']) && !empty($_GET['bal_type'])) { # code..
   $bal_type = $_GET['bal_type'];
   $bal_type_q = "AND `item`='$bal_type'";
}



// Client Name
if (isset($_GET['Cname']) && !empty($_GET['Cname'])) { # code..
   $Cname = $_GET['Cname'];
   $Cname_q = "AND `client_name` LIKE '%$Cname%'";
}

// done_by
// if (isset($_GET['done_by']) && !empty($_GET['done_by'])) { # code..
//    $done_byE = $_GET['done_by'];
//    $done_q = "AND `done_by`='$done_byE'";
// }

// done_by
if (isset($_GET['closed']) && !empty($_GET['closed'])) { # code..
   $closedE = $_GET['closed'];
   $closed_q = "AND `closed`='$closedE'";
}

}
// ----------------------------------------------
// query condition controlls
@$cond_query =" $date_q $bal_type_q $Cname_q $balance_id_q $closed_q";
$mainQuerySearch = "SELECT * FROM `balance_table` WHERE `balance_id`!='0' $cond_query ORDER BY `balance_id` DESC";
?>

<?php include 'app_data/php/print_head.php'; ?>


<?php
// query condition controlls
// @$cond_query ="$sell_q $date_q $env_q $done_q $sType_q $Cname_q $closed_q";
// $mainQuerySearch = "SELECT * FROM `balance_table` ORDER BY `balance_id` DESC";
?>

<?php include 'app_data/php/print_head.php'; ?>
  <table border="1" class="table table-bordered">
    <tbody>
      <tr>
        <!-- <th width="33px;">&nbsp; </th> -->
        <th> # </th>
        <th> Date </th>
        <th> item </th>
        <th> Item Id / Item Name </th>
        <th> sell_id </th>
        <th> payed_in </th>
        <th> balance </th>
        <th> Client </th>
        <th> closed </th>
        <th> comment </th>
        <!-- <th class="admin"> &nbsp; </th> -->
        <th class="admin"> &nbsp; </th>
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
    @$date = $row["date"];
    @$item = $row["item"];
    @$item_id = $row["item_id"];
    @$sell_id = $row["sell_id"];
    @$comment = $row["comment"];
    @$client_name = $row["client_name"];
    @$closed = $row["closed"];
    @$paym_typ = $row["paym_typ"];
    @$Total_Available_Rw = $row["Total_Available_Rw"];
    // @$done_by = $row["done_by"];

  ?>
  <tr class="<?php if ($x%2 == 0) { echo "a"; } else { echo "b"; }?>">
    <td> <?php echo @$b_id; ?> </td>
    <td> <?php echo @$date; ?> </td>
    <td> <?php echo @$item; ?> </td>
    <td class="click" onclick="<?php if ($item_id == '0') { echo ' '; } elseif ($item == 'Divers') { echo "ProductDetails($item_id)";  } else { echo "stockDetails($item_id)"; } ?>"><b>
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
    <td class="click" onclick="<?php if ($item == 'Divers') { echo "sellDiversDetails($sell_id)";  } else { echo "sellDetails($sell_id)"; } ?>"> <b><?php echo @$sell_id; ?></b> </td>
    <td> <?php echo @$paym_typ; ?> </td>
    <td> <?php echo @money($Total_Available_Rw); ?> Frw </td>
    <td> <?php echo @$client_name; ?> </td>
    <td> <?php echo @$closed; ?> </td>
    <td> <?php echo @$comment; ?> </td>
    <!-- <td class="admin" style="text-align:center;"> <a href="update_balance.php?id=<?php echo $b_id; ?> "><b class="fa fa-pencil-square-o table-icon" style="color:#1e8de6;"></b></a> </td> -->
    <td class="admin" style="text-align:center;"> <a href="app_data/php/delete_balance.php?id=<?php echo $b_id; ?>" onclick="return confirm('Are you sure you want to delete this Balance??');"><b class="fa fa-trash-o table-icon" style="color:red;"></b></a> </td>
   </tr>
  <?php
  $x++; // incemmenting

      }

  }

   ?>
   <!-- <tr> <th> # </th> <th> E-id </th> <th> Type </th> <th> Date </th> <th> Quantity </th> <th> Pay in </th> <th> closed </th> <th> PU Rfw </th> <th> PT Rfw </th> <th> PU $ </th> <th> PT $ </th> <th> Avance </th> <th> Balance </th> <th> Client Name </th> <th> Done By </th> </tr> -->
  </tbody></table>




<!-- </div> -->


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
  /*background: #fff;*/
}
hr {
  /*margin: 3px;*/
  /*border-color: #000;*/
}

.form-control {
      display: block;
      width: 100%;
}
label {
  /*margin-bottom: 1px;*/
}

.table {
    /*width: 97%;*/
    /*margin: auto;*/
}
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
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->





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
