<?php
include 'app_data/php/head_blank.php';
secured();

$sell_id = $_GET['sid'];

$current = retrieve_data('e_id','selling_e','s_id',$sell_id);
$allow = retrieve_data('view','env_stock','e_id',$current);
$invitationLeft = fileData('quantity',$current);
$sll_id = retrieve_data('e_id','env_stock','e_id',$current);

?>


<section class="fixed-butt">
   <a href="home.php" title="Home">
     <button type="button" name="button" class="click"><b class="fa fa-home"></b></button>
   </a>

   <a href="invitationUpdateChangeCode.php?sid=<?php echo @$sell_id; ?>" title="Start Process">
     <button type="button" name="button" class="click"><b class="fa fa-refresh"></b></button>
   </a>
</section>
<?php


if (!isset($_POST['step_one']) && isset($_GET['sid']) && !empty($_GET['sid']) && empty($_GET['Selected'])) {
    // echo 'sell id: '.$sell_id.'<br>';
    // echo 'Inv id: '.$current.'<br>';
    // ============================================ STEP ONE ======================================
?>


<form action="invitationUpdateChangeCode.php?sid=<?php echo @$sell_id; ?>" method="post">
  <input type="number" name="sid" value="<?php echo @$sell_id; ?>" required="" hidden="">

<div class="update-inv-Fdv">
  <section class="title">
    Change Invitaion Code
  </section>
  <br>
  <p>
    This will change the <b>Invitation Code</b> <br> of the sell <b>#<?php echo $sell_id; ?></b>
  </p>
  <p>
    It may also affect the Stock of the <b><?php echo $current; ?></b>
  </p>
   <center>
  <!-- <input type="number" name="name" class="input-fdiv" value=""> -->
  <input type="number" name="Selected" value=""  class="input-fdiv" required=""> <br>

  <button type="submit" name="step_one" class="btn btn-default btn-lg click" style="width: 81%; background: #4caf50; color: #fff;">Continue</button>
</center>
  <br><br>
</div>
</form>





<?php
}
elseif (isset($_POST['step_one']) && isset($_POST['sid']) && !empty($_POST['sid']) && isset($_POST['Selected']) && !empty($_POST['Selected']))
{
  $selected = $_POST['Selected'];
  $current = retrieve_data('e_id','selling_e','s_id',$sell_id);

  // CHECK IF THE SELECTED INVITATION DOES EXIST
  if (!empty(fileData('e_id',$selected))) { // if is found in the table

 // CHECK IF THE CURRENT AND THA SELECTED ARE NOT THE SAME
 if ($selected != $current) { // if you select the different incodes

      // CHECKING IF THE PRICE ARE THE SAME
      $current_price_frw = fileData('price_r',$current);
      $current_price_dol = fileData('price_d',$current);
      // selected
      $selected_price_frw = fileData('price_r',$selected);
      $selected_price_dol = fileData('price_d',$selected);

// ========================================= SECOND STEP ===========================================
?>



<div class="second-div-cont">

<div class="update-inv-Fdv" style="    margin-bottom: -10px; border-radius: 4px 4px 0px 0px;">
  <section class="title">
    Change Invitaion Code #<?php echo @$sell_id; ?>
  </section>
  <br>


  <div class="row" style="margin:0px;">
  <div class="col-xs-6 col-md-4">
    <div class="thumbnail" >
          <img src="envit/<?php echo fileData('img',$current); ?>" alt="..." style="height: 109px;">
            <div class="caption">
            <h3 style="font-size: 18px;"><?php echo @$current; ?></h3>
          </div>
    </div>
  </div>

  <div class="col-xs-6 col-md-4" style=" font-size: 52px; text-align: center; padding-top: 34px; color: #49a24d;">
    <b class="fa fa-arrow-circle-right"></b>
  </div>

  <div class="col-xs-6 col-md-4">
    <div class="thumbnail" >
          <img src="envit/<?php echo fileData('img',$selected); ?>" alt="..." style="height: 109px;">
            <div class="caption">
            <h3 style="font-size: 18px;"><?php echo @$selected; ?></h3>
          </div>
    </div>
  </div>
</div>

</div> <!-- /update-inv-Fdv -->

<div class="fading-containner">


<?php
      // checking if the price are not the same
      if ($current_price_frw != $selected_price_frw || $current_price_dol != $selected_price_dol) {
        // we print the difference between those two invitations in a table
        ?>
            <!-- ALERT HERE -->

            <div class="alert alert-danger alert-dismissible fading-item" style="margin-top: 15px;" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Warning!</strong> <br>

                  <b> The price are not the same </b> <hr style="margin:0px;"> <br>
                  <table width="100%" style="text-align:center;background:transparent;" > <tr>
                      <th style="text-align:center;"> <?php echo $current; ?> (curent) </th>
                      <th style="text-align:center;"> <?php echo $selected; ?> (selected) </th>
                    </tr>
                    <tr>
                      <td>
                        Frw: <b><?php echo $current_price_frw; ?></b> <br>
                        $: <b><?php echo $current_price_dol; ?></b>
                      </td>
                      <td>
                        Frw: <b><?php echo $selected_price_frw; ?></b> <br>
                        $: <b><?php echo $selected_price_dol; ?></b>
                      </td>
                    </tr>
                  </table>

            </div>

        <?php
      }

  // CHECKING THE QUANTITY
  // $curent_sell_quantity = fileData('quantity',$current);
  $curent_sell_quantity = retrieve_data('quantity','selling_e','s_id',$sell_id);
  $curent_selected_stock_quantity = fileData('quantity',$selected);
  // echo "curent sell quantity: $curent_sell_quantity <br>";
  // echo "curent selected stock quantity: $curent_selected_stock_quantity <br>";

  // check if the selected invitation have enougn quantity
  if ($curent_sell_quantity > $curent_selected_stock_quantity) {
    ?>
    <div class="alert alert-warning alert-dismissible fading-item" style="" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Warning!</strong>
      There is no <b><?php echo $curent_sell_quantity; ?> </b> invitations in <b><?php echo $selected; ?> 's</b> stock
    </div>
    <?php
    // echo "<div class='alert alert-danger' role='alert'> there is no <b> $curent_sell_quantity </b> invitations in <b>$selected '</b> stock <br> </div>";
  }


?>

</div><!-- /fading-containner -->


<div class="update-inv-Fdv" style=" padding: 10px; margin-top: 3px; border-radius: 0px 0px 4px 4px; box-shadow: 0px 4px 11px #616161;">
<form action="invitationUpdateChangeCodeDB.php" method="post">

<a href="invitationUpdateChangeCode.php?sid=<?php echo @$sell_id; ?>" style="background:transparent;">
  <button type="button" class="btn btn-primary">Back</button>
</a>
  <button type="submit" name="change"  class="btn btn-success">Change</button>
</div>

  <input type="number" name="sell_id" value="<?php echo $sell_id; ?>" hidden="">
  <input type="number" name="current" value="<?php echo $current; ?>" hidden="">
  <input type="number" name="selected" value="<?php echo $selected; ?>" hidden="">
  <!-- <input type="submit" name="change" value="Change Code"> -->
</form>

</div><!-- second div containner -->





<?php

    // echo 'sell id: '.$sell_id.'<br>';
    // echo 'inv id: '.$current.'<br>';
    // echo 'inv id: '.$selected.'<br>';
    // now you can run the code





} else { # they are the same
  echo "<div class='alert alert-danger bounceIn animated' role='alert'> You must select a code which is different to <b>$current</b> </div>";
}

} else { // doest found
  echo "<div class='alert alert-danger bounceIn animated' role='alert'> the <b> $selected </b> invitation doent found in stock </div>";
}


}
?>

<style media="screen">
  .update-inv-Fdv {
    margin: auto;
    width: 400px;
    /*height: 300px;*/
    background: #fff;
    box-shadow: 0px 0px 11px #616161;
    margin-top: 34px;
    border-radius: 5px;

  }

  .update-inv-Fdv .title {
    background: #4CAF50;
    text-align: center;
    border-radius: 4px 4px 0px 0px;
    padding: 14px;
    font-size: 24px;
    color: #fff;
  }

  .update-inv-Fdv  .input-fdiv {
    margin: auto;
    width: 82%;
    padding: 6px;
    margin: 17px;
    text-align: center;
    border: 2px solid #4caf50;
    border-radius: 4px;
    font-size: 23px;
    color: #347b37
  }

  .update-inv-Fdv p {
    text-align: center;
    font-size: 16px;
    padding: 10px;
  }
  .alert {
    width: 400px;
    margin: auto;
  }

  .update-inv-Fdv .btn {
    width: 49%;
    padding: 8px;
    font-size: 18px;
  }


    .fixed-butt {
      position: fixed;
      top: 6px;
      left: 7px;
    }

    .fixed-butt a { background: transparent; }

    .fixed-butt button {
        background: #2196F3;
        border: 2px solid #fff;
        font-size: 21px;
        width: 40px;
        height: 40px;
        border-radius: 100%;
        box-shadow: 0px 0px 1px #000;
        color: #fff;
    }


  table {
    text-align: center;
    background: transparent;
    padding: 8px;
    border: 0px;
    box-shadow: none;
    /*background: #cdcdcd;*/
  }
</style>
<script src="app_data/java/functions.js"></script>
