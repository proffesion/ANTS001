<?php
include 'head_no_css.php';
$divS_id = $_POST['id'];
?>



<div class="contents-iframe">
    <section class="header-div-sec">
      <h2 style="float:left;margin-right:26px;">  <?php echo @retrieve_data('pro_name','products','pro_id',$divS_id); ?> </h2>

            <section class="adm-optn">
             <a href="saleDivers.php?pro_id=<?php echo $divS_id; ?>" target="_parent"><button type="button" name="" class="btn btn-success click" style="float: left;margin: 14px 2px;"> <b class="fa fa-shopping-cart"></b> &nbsp; Sell Product</button></a>
             <a href="updateProduct.php?id=<?php echo $divS_id; ?>" target="_parent"><button type="button" name="" class="btn btn-primary click" style="float: left;margin: 14px 2px;"> <b class="fa fa-edit"></b> &nbsp; Edit Product</button></a>
            </section>

     </section>

<div class="row" style="margin:0px;">
  <div class="col-md-8">
  
        <div class="" style=" text-align: center; ">
      <h2 style=" margin: 0; padding: 20px 0px 2px 0px;color: #861038;"><?php echo @retrieve_data('pro_name', 'products', 'pro_id', $divS_id); ?></h2>

      <br><br>
      <br>
      <section class="inv-details" style="text-align: left;">
        <!-- <h4>Invitation Details</h4> -->
        <hr>
        <label class="label-inv"> Pice fRw: </label>     <label class="value"> <?php echo @retrieve_data('price_frw', 'products', 'pro_id', $divS_id); ?> fRw </label> <hr>
        <label class="label-inv"> Price $: </label>  <label class="value"> <?php echo @retrieve_data('price_dol', 'products', 'pro_id', $divS_id); ?> $</label> <hr>
        <label class="label-inv"> Quantity: </label>   <label class="value"> <?php echo @retrieve_data('pro_quantity', 'products', 'pro_id', $divS_id); ?> </label> <hr>
        <label class="label-inv"> Place: </label>           <label class="value"> <?php echo @retrieve_data('place', 'products', 'pro_id', $divS_id); ?> </label> <hr>

      <br>

        <label class="label-inv"> <u>Comment:</u> </label>    
         <br>
           <p class=""> <?php echo @retrieve_data('pro_comment', 'products', 'pro_id', $divS_id); ?> </p> <hr>

      </section>

      </div>
  
  </div>
  <div class="col-md-4">
    
  <div class="last-p-sec" style="overflow:auto;">
         <h3 style="    background: #650b29;">Last Printed</h3>

         <ul class="sell-home-list-ul" style="background: rgba(40, 46, 54, 0.75);">
          
<?php
$results = $mysqli->query("SELECT `s_id`,`div_id`,`client_name`,`date`,`quantity` FROM `divers_sales` WHERE `div_id`='$divS_id'");
if ($results->num_rows == null) {
  ?>

  <?php
    } else {
         // searching
      while ($row = $results->fetch_array()) {
        @$s_id        = $row["s_id"];
        @$div_id      = $row["div_id"];
        @$client_name = $row["client_name"];
        @$date        = $row["date"];
        @$quantity    = $row["quantity"];
        ?>
         <li onclick="sellDiversDetails(<?php echo $s_id; ?>)" style="background: rgba(165, 61, 96, 0.98);">
          <h4> <?php echo $client_name; ?></h4>
            <b class=""> <?php echo $date; ?></b>
          <label>Quantity: <b> <?php echo $quantity; ?></b></label>
           </li>
<?php 
}
}
    # end of ...
?>


           


                    <!-- </ul> -->


</ul>


      </div>

  </div>
</div>





