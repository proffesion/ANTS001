<?php
include 'head_no_css.php';
$env_id = $_POST['id'];
$view = fileData('view',$env_id);
secured();
?>
<div class="contents-iframe">

    <section class="header-div-sec">
      <h2 style="float:left;margin-right:26px;"> <b> <?php echo $env_id; ?></b> <?php echo fileData('env_color',$env_id); ?> </h2>

      <a href="sell_envitation.php?id=<?php echo $env_id; ?>" class="bg-green" target="_parent"><button type="buton" name="" class="btn btn-primary btn-succes click" style="float: left;margin: 14px 2px; background: #109c5c; border-color: #109c5c;"> <b class="fa fa-shopping-cart"></b> &nbsp; Sell Invitation </button></a>


<section class="admin">

      <a href="hide_unhide_inv.php?id=<?php echo $env_id; ?>&st=<?php echo $view; ?>">
        <button type="button" style=" margin-top: 7px; margin-left: 9px; border: none; border-radius: 6px; padding: 5px 15px; background: #fff;">
          <?php if ($view == '1') { ?> <b style="color: #15d015;font-size: 25px;" class="fa fa-toggle-on"></b> <?php } else { ?> <b style="font-size: 25px; color: #ff1c00;" class="fa fa-toggle-off"></b> <?php } ?>
        </button>
      </a>

      <a href="update_stock.php?id=<?php echo $env_id; ?>" target="_parent"><button type="buton" name="" class="btn btn-primary click" style="float: left;margin: 14px 2px;"> <b class="fa fa-edit"></b> Edit </button></a>
      <a onclick="return confirm('are you sure you want to delete this Invitation? \n  ------------------------------------------------------------- \n this will affect the Sell related to this Invitation.')" href="deleteStock.php?Stid=<?php echo $env_id; ?>"><button type="buton" name="" class="btn btn-primary btn-danger click" style="float: left;margin: 14px 2px;"> <b class="fa fa-trash-o"></b> Delete </button></a>
</section>


      <!-- <a href="sell_Invitation.php"><button type="buton" name="" class="btn btn-primary click" style="float: left;margin: 14px 2px;"> <b class="fa fa-shopping-cart"></b> &nbsp; Sell Invitation </button></a> -->
      <!-- <button type="buton" name="" class="btn btn-primary click" style="float: left;margin: 14px 2px;"> <b class="fa fa-shopping-cart"></b> &nbsp; Sell Invitation </button> -->
    </section>

  <div class="secton-result-containner">
    <div class="contain-section first-sec">

        <section class="image-sec">
          <img src="envit/<?php echo fileData('img',$env_id); ?>" alt="" />
        </section>

        <section class="inv-details">
          <h4>Details</h4>
          <?php
             $sizeW = fileData('size_w',$env_id);
             $sizeH = fileData('size_h',$env_id);
           ?>

          <label class="label-inv"> Invitation Id: </label>     <label class="value"> <?php echo fileData('e_id',$env_id); ?> </label> <hr>
          <label class="label-inv"> Invitation color: </label>  <label class="value"> <?php echo fileData('env_color',$env_id); ?> </label> <hr>
          <label class="label-inv"> Invitation size: </label>   <label class="value"> <?php echo $sizeW; ?> x <?php echo $sizeH; ?> </label> <hr>
          <label class="label-inv"> Invitation Left:</label>    <label class="value"> <?php echo fileData('quantity',$env_id); ?> </label> <hr>
          <label class="label-inv"> Price $: </label>           <label class="value"> <?php echo fileData('price_d',$env_id); ?> </label> <hr>
          <label class="label-inv"> Price Rfwa: </label>        <label class="value"> <?php echo fileData('price_r',$env_id); ?> </label> <hr>
          <label class="label-inv"> Place: </label>             <label class="value"> <?php echo fileData('place',$env_id); ?> </label> <hr>
        </section>

<!-- <button type="button"  name="button"></button> -->
<section style="width: 86%; margin: auto; margin-top: 33px;" class="admin">

  <!-- <section style=" background: #d1d2d4; padding: 12px 19px  1px 19px; border-radius: 5px; margin-bottom: 4px; ">
    <label style="float:left;"> Click To change </label>
    <label style="float:right;"><a href="hide_unhide_inv.php?id=<?php echo $env_id; ?>&st=<?php echo $view; ?>"> <?php if ($view == '1') { ?> <b style="color: #15d015;font-size: 25px;" class="fa fa-toggle-on"></b> <?php } else { ?> <b style="font-size: 25px; color: #ff1c00;" class="fa fa-toggle-off"></b> <?php } ?> </a> </label>
    <section class="clear-both">x</section>
  </section>

  <a href="update_stock.php?id=<?php echo $env_id; ?>" target="_parent"><button type="submit" name="" class="btn btn-primary click btn-block " style="margin-bottom:2px;"> <b class="fa fa-edit"></b> &nbsp; Edit Invitation </button></a>
  <a onclick="return confirm('are you sure you want to delete this Invitation? \n  ------------------------------------------------------------- \n this will affect the Sell related to this Invitation.')" href="deleteStock.php?Stid=<?php echo $env_id; ?>"><button type="submit" name="" class="btn btn-primary btn-danger click btn-block "> <b class="fa fa-trash-o"></b> &nbsp; Delete Invitation </button></a> -->

</section>

    </div><!-- .contain-section first-sec -->
    <div class="contain-section second-sec">
       <h5>comment</h5>
       <p><?php echo fileData('comment',$env_id); ?></p>

      <div class="similar-sec">
         <h3>Same Size</h3>

<?php
$resulto = $mysqli->query("SELECT `e_id`,`env_color` FROM `env_stock` WHERE `view`='1' AND `size_w`='$sizeW' AND `size_h`= '$sizeH' AND `e_id` !='$env_id' LIMIT 6");
// echo $results->num_rows; // number of result
if ($resulto->num_rows == NULL) {
    echo "<br><h1 style='display:block;text-align:center;color: rgba(233, 30, 99, 0.83);'><b class='fa  fa-warning'></b></h1>";
    // echo "No data";

} else {

    while($row = $resulto->fetch_array()) {
      $e_idr = $row["e_id"];
      $e_colore = $row["env_color"];
        echo "<section class='search-result-row sm-cap'> <b>$e_idr</b> $e_colore </section>";

    }

}


?>

         <!-- <section class='search-result-row sm-cap'> <b>1313</b> red </section>
         <section class='search-result-row sm-cap'> <b>1313</b> red </section> -->

      </div><!-- .similar-sec -->


    </div><!-- .contain-section second-sec -->


    <div class="contain-section third-sec scroll" style="overflow:auto;max-height: max-height: 99vh;">
      <div class="last-p-sec" style="overflow:auto;">
         <h3 style="    background: #650b29;">Last Printed</h3>

         <ul class="sell-home-list-ul" style="background: rgba(40, 46, 54, 0.75);">
          <?php
          $empty = '0';
           $results = $mysqli->query("SELECT `e_id`,`e_id`,`quantity`,`client_name`,`date` FROM `selling_e` WHERE `e_id`='$env_id' ORDER BY `s_id` DESC LIMIT 10");
           if ($results->num_rows == NULL) {
             $empty = '1';
           } else {

               while($row = $results->fetch_array()) {
                 @$s_id = $row["s_id"];
                 @$e_id = $row["e_id"];
                 @$quantitye = $row["quantity"];
                 @$datee = $row["date"];
                 @$client_name = $row["client_name"];
           ?>

           <li onclick="sellDetails(<?php echo $s_id; ?>)" style="background: rgba(165, 61, 96, 0.98);">
          <h4> <b><?php echo @$e_id; ?></b> &nbsp; <?php echo @$client_name; ?></h4>
            <b class=""><?php echo @$datee; ?></b>
          <label>Quantity: <b><?php echo @$quantitye; ?></b></label>
           </li>


           <?php
               }

           }

            ?>
         <!-- </ul> -->


</ul>

<?php

if ($empty == '1') {
  echo "<br><h1 style='display:block;text-align:center;color: rgba(233, 30, 99, 0.83);'><b class='fa  fa-warning'></b></h1>";
}
 ?>

      </div><!-- .last-p-sec -->
    </div><!-- .contain-section second-sec -->

  </div><!-- .secton-result-containner -->









</div>
  </body>
</html>
