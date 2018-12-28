<?php include 'app_data/php/head_no_css.php'; ?>



<table border="0" width="100%" height="100%" class="main-table-home"><tr><td>
<center>

<div class="home-docs-contain">
  <div class="rw_1">
    <!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. -->
    <div class="f-cont-section-sellInfo">
<table border="0" width="100%" height="100%" class="table-sell-activity table-transprent">
  <tr><td valign="top" style="width: 67%;">
      <div class="sell-div-sec">
        <section class="titl"> <h2 class="title-h"><b class="fa fa-calendar" style="font-size: 23px;color: #f39c12;"></b> Today Activity </h2> </section>
        <section class="cont" name="">
            <section class="box-tit bg-yellow">
              <label ><b class="fa fa-file-text"></b> <?php echo Summ_data("SELECT SUM(`quantity`) FROM `selling_e` WHERE `date`='$time_now'",'quantity'); ?> </label>
              <p class="text-lab-p"> <u style="text-decoration:none;">Envitation</u></p>
            </section>

            <section class="box-tit bg-green">
              <label><b class="fa fa-cart-arrow-down"></b> <?php echo number_ret("SELECT * FROM `selling_e` WHERE `date`='$time_now'"); ?> </label>
              <p class="text-lab-p"> <u style="text-decoration:none;">Total Sells</u></p>
            </section>

            <section class="clear-both">x</section>
        </section>

        <section>
          <h3 class="money-title-h2"> <b class="fa fa-money"></b> Money</h3>
          <section class="money-cont-sec">
            <hr>
            <label class="label"> <b class="fa fa-money"></b> Rwandan </label> <label class="vale">
              <?php echo Summ_data("SELECT SUM(`price_tot_rw`) FROM `selling_e` WHERE `date`='$time_now' AND `paym_typ`='Rfw'",'price_tot_rw'); ?> Frw
           </label><hr>
            <label class="label"> <b class="fa fa-money"></b> Dolars </label> <label class="vale">
              <?php echo Summ_data("SELECT SUM(`price_tot_d`) FROM `selling_e` WHERE `date`='$time_now' AND `paym_typ`='$'",'price_tot_d'); ?> $
            </label><hr>
            <!-- <label class="label"> <b class="fa fa-money"></b> Congo </label> <label class="vale">3434</label> -->
            <!-- <hr> -->
          </section>
        </section>
        <section class="clear-both">x</section>
      </div>

  </td><td valign="top">
<div class="">
<section class="list-head">
  <h4><b class="fa fa-cart-arrow-down"></b>Last sell</h4>
</section>

  <ul class="sell-home-list-ul">

      <?php
      $results = $mysqli->query("SELECT `s_id`, `e_id`, `quantity`, `client_name` FROM `selling_e` ORDER BY `s_id` DESC LIMIT 5");
      if ($results->num_rows == NULL) {
        echo "string";
      } else {

          while($row = $results->fetch_array()) {
            @$s_id = $row["s_id"];
            @$e_id = $row["e_id"];
            @$quantity = $row["quantity"];
            @$client_name = $row["client_name"];
      ?>

      <li onclick="sellDetails(<?php echo $s_id; ?>)">
     <h4><b class="fa fa-user"></b> <?php echo @$client_name; ?></h4>
     <b><?php echo @$e_id; ?></b>
     <label>Quantity: <b><?php echo @$quantity; ?></b></label>
      </li>


      <?php
          }

      }

       ?>
    </ul>
</div>

    </td>
  </tr>
</table>
    </div>

    <div class="s-cont-section-controlls">
        <section class="contan one">
          <section class="clas-buttons-contains">


          <a href="stock_list.php" title="Stock">
           <section class="itm click" style="background:#f39c12;" title="View Stock">
              <h2 class="fa fa-cube"></h2>
           </section>
           </a>

            <a href="sell_view.php" title="Sales">
            <section class="itm click" style="background:#01a65a;" title="View Sales">
            <h2 class="fa fa-shopping-cart"></h2>
            </section>
            </a>

            <a href="balance_view.php">
               <section class="itm main-search-button click" style="background:#5090ee;" title="View Balance">
                  <h2 class="fa fa-tag"></h2>
               </section>
            </a>


            <a href="users.php" class="admin" title="Users">
            <section class="itm click" style="background:#9C27B0;" title="Users">
            <h2 class="fa fa-group"></h2>
            </section>
            </a>

            <a href="sell_report.php" title="Sales Report" title="Sale's Report">
             <section class="itm" style="background:#00a65a;">
                <h2 class="fa fa-file-text"></h2>
             </section>
           </a>

           <a href="stock_report.php" title="Stock Report">
            <section class="itm" style="background:#f39c12;">
               <h2 class="fa fa-file-text"></h2>
            </section>
           </a>


            <a href="logout.php">
            <section class="itm" style="background:#ef2557;">
            <h2 class="fa fa-lock"></h2>
            </section>
            </a>


            <!-- <a href="#"> -->
            <section class="itm click" type="button" data-toggle="modal" data-target="#MyModal" style="background:#5056ee;">
            <h2 class="fa fa-question-circle"></h2>
            </section>
            <!-- </a> -->




     <section class="clear-both">x</section>
</section>

<section style="color:#ddd;">
  <b>ANTARES company LTD</b> <br>
  system

</section>

     </section><!-- end of section one -->



        <section class="contan two">
          <h2><b class="fa fa-calendar"></b><?php echo @$time_now; ?></h2>
          <!-- <h3>Welcome!</h3> -->
           <hr>

          <div class="user-vier-hm-dv" style="text-align:center;">
            <p class="">
               <?php if (isAdmin()) {
                     if (number_ret("SELECT `id` FROM `error_table`") > 0) {  ?>
                       <section class=" pulse animated infinite">
                       <h2 style="color#fff; margin:0px;font-size: 111px; margin-top: 15px; color: #dd4b39;" class="fa fa-warning"></h2> <br>
                       <h3 style="margin: 0; margin-left: -21px;"> <span class="badge bg-red"> <?php echo number_ret("SELECT `id` FROM `error_table`"); ?> </span> Error </h3>
                       </section>
                    <?php } else {
                      echo '<section> <img src="app_data/imgs/icns/medium-logo.png" alt="" /> </section>';
                     } ?>

               <?php } else {
                 echo '<section> <img src="app_data/imgs/icns/medium-logo.png" alt="" /> </section>';
               } ?>

            </p>
          </div>

        </section>

        <section class="clear-both">x</section>
    </div>



  </div>
  <div class="rw_2">
   <!-- <h2></h2> -->
   <div class="stock-cont-div">
       <h4><b class="fa fa-cube"></b> Stock info </h4>
   </div>

   <div class="stock-graph">
     <section class="progress-div-cont">
       <!-- <label>hahahaha</label><br> -->
      <?php
      $stock_number = number_ret("SELECT `e_id` FROM `env_stock`");
      $stock_empty_number = number_ret("SELECT `e_id` FROM `env_stock` WHERE `quantity`='0';");
      ?>

       <div class="progress-label-div-top">
          <label> <?php echo @$stock_number; ?> </label> <u>Types</u>
         <section class="arrow">x</section>
       </div><!-- progress-label-div-top -->
       <section class="clear-both">x</section>
      <div class="progress progress-xs">
      <div class="progress-bar progress-bar-success" style="width: 100%"></div>
      </div>

      <div class="progress progress-xs  progress-striped active">
      <?php $stock_empty_number_percent = round(($stock_empty_number / $stock_number) * 100); ?>
      <div class="progress-bar progress-bar-danger" style="width: <?php echo $stock_empty_number_percent; ?>%"></div>
      </div>
      <!-- <label>hahahaha</label><br> -->
      <div class="progress-label-div-bot">
        <section class="arrow">x</section>

         <label> <?php echo @$stock_empty_number; ?> </label> <u>Emty Categorie(s) </u>
      </div><!-- progress-label-div-top -->
      <section class="clear-both">x</section>
     </section>
   </div>


<section style="color:#fff;">
  <h3 class="money-title-h2" style="text-align: left;margin-top: 12px;"> <b class="fa fa-money"></b> Low Invitations </h3>
  <ul class="sell-home-list-ul">
<?php

// MySqli Select Query
$results = $mysqli->query("SELECT `e_id`,`quantity`,`env_color` FROM `env_stock` WHERE `quantity`!='0' AND `view`='1' ORDER BY `quantity` ASC LIMIT 6;");

if ($results->num_rows == NULL) {
    echo "No data";
} else {

    while($row = $results->fetch_array()) {
      $e_id = $row["e_id"];
      $quantity = $row["quantity"];
      $env_color = $row["env_color"];
?>


  <li style="text-align:left;" onclick="stockDetails(<?php echo $e_id; ?>)">
  <h4 style="font-size: 18px;color: #fff;margin-bottom: -5px;margin-top: 5px;"><b  class="fa fa-file-text"></b> <?php echo @$e_id; ?></h4>
  <b style="font-weight:normal;"><?php echo @$env_color; ?></b>
  <label>Quantity: <b><?php echo @$quantity; ?></b></label>
  </li>

<?php
    }

}


 ?>

            </ul>



</section>






  </div>
</div>

</center>
</td></tr></table>
