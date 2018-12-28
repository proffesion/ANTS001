<?php
include_once 'app_data/php/head_no_css.php';

 @$search_text = $_GET['search_text'];
 @$TP = $_GET['TP']; // invitation , divers
 @$type = $_GET['typ']; // stock , sell


 //CHECK IF IS NOT NULL AND SUBMITTED
if (isset($_GET['search_text']) && !empty($_GET['search_text']) && isset($_GET['typ']) && !empty($_GET['typ']) && $_GET['typ'] != 'undefined' && strlen($search_text) > 2) {

if ($TP == 'Invitation') { // CHECK IF IS THE INVITATION ////////////////////////////////////////////
    if ($type == 'sell') { # SELL INVITATION ////////////////////////////////////////////////////////
      
      // echo 'INVITATION SELL';




    # searching for the users
      $results = $mysqli->query("SELECT * FROM `selling_e` WHERE `e_id` LIKE '%$search_text%' OR `s_id` LIKE '%$search_text%' OR `client_name` LIKE '%$search_text%' OR `date` LIKE '%$search_text%'  ORDER BY `s_id` DESC");

    // echo $results->num_rows; // number of result
      if ($results->num_rows == null) {
        ?>
      <div class="search-null-result" >
        <h1 class='shake animated fa fa-frown-o'></h1> <br>
        <h3> No data Found! </h3>
         <p> Try to search using <br>the keyword like: </p>
       <ul >
         <li> Sell Id </li>
         <li> Client Name </li>
       </ul> <br> <p> if nothing change </p>
             <a href="sell_report.php">
             <button type="button" class="btn bg-olive btn-flat margin click"> <b class="fa fa-shopping-cart"></b> go to Sale's Report</button>
             </a>
        </div>
      <?php

    } else {
        // searching
      while ($row = $results->fetch_array()) {
        $s_id = $row["s_id"];
        $e_id = $row["e_id"];
        $client_name = $row["client_name"];
        $cdate = $row["date"];
        echo "<section class='search-result-row click' onclick='sellDetails($s_id)'> <b>$e_id</b> $client_name  <br><u> $cdate </u></section>";
      }

    }
   # end of users







    } else if ($type == 'stock') { # DIVERS ///////////////////////////////////////////////////////

      // echo 'INVITATION STOCK';




      $results = $mysqli->query("SELECT * FROM `env_stock` WHERE `e_id` LIKE '%$search_text%' AND `view`='1' ORDER BY `e_id` DESC");
      echo 'Results: <b>'.$results->num_rows.'</b> <br>'; // number of result
      if ($results->num_rows == null) {
        //  echo "<div style=' width: 100%; padding: 19px; text-align: center; color: #ff8383;' ><h3 style='margin: 0;font-size: 78px;' class='fa fa-user-times'></h3> <br> <b> No user  found! </b></div>";
        ?>
        <div class="search-null-result" >
          <h1 class='shake animated fa fa-frown-o'></h1> <br>
          <h3> No data Found! </h3>
           <p> Try to search using </p>
         <ul >
           <li> Invitation Id </li>
           <!-- <li> Client Name </li> -->
         </ul> <br> <p> if nothing change </p>
               <a href="stock_report.php">
               <button type="button" class="btn bg-olive btn-flat margin click"> <b class="fa fa-shopping-cart"></b> go to Stock's Report</button>
               </a>
          </div>
        <?php

      } else {
         // searching
        while ($row = $results->fetch_array()) {
          @$e_id = $row["e_id"];
          @$e_color = $row["env_color"];
          echo "<section class='search-result-row click' onclick='stockDetails($e_id)'> <b>$e_id</b> $e_color  </section>";
        }
      }
    # end of users





    }  // INVITATION -->  SELL || DIVERS
    



//////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////  DIVERS  /////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

} else if ($TP == 'Divers') { // CHECK IF IS THE DIVERS ///////////////////////////////////////////////
    if ($type == 'sell') { # SELL INVITATION ////////////////////////////////////////////////////////

      // echo 'DIVERS SELL';


# searching for the divers
      $results = $mysqli->query("SELECT * FROM `divers_sales` WHERE `s_id` LIKE '%$search_text%' OR `client_name` LIKE '%$search_text%' OR `date` LIKE '%$search_text%'  ORDER BY `s_id` DESC");

    // echo $results->num_rows; // number of result
      if ($results->num_rows == null) {
        ?>
      <div class="search-null-result" >
        <h1 class='shake animated fa fa-frown-o'></h1> <br>
        <h3> No data Found! </h3>
         <p> Try to search using <br>the keyword like: </p>
       <ul >
         <li> Sell Id </li>
         <li> Client Name </li>
       </ul> <br> <p> if nothing change </p>
             <a href="sellDivers_report.php">
             <button type="button" class="btn bg-olive btn-flat margin click"> <b class="fa fa-shopping-cart"></b> go to Sale's Report</button>
             </a>
        </div>
      <?php

    } else {
        // searching
      while ($row = $results->fetch_array()) {
        $s_id = $row["s_id"];
        // $e_id = $row["e_id"];
        $client_name = $row["client_name"];
        $cdate = $row["date"];
        echo "<section class='search-result-row click' onclick='sellDiversDetails($s_id)'> $client_name  <br><u> $cdate </u></section>";
      }
    } # end of ...




    } else if ($type == 'stock') { # DIVERS ///////////////////////////////////////////////////////

      // echo 'DIVERS STOCK';














    $results = $mysqli->query("SELECT `pro_id`,`pro_name` FROM `products` WHERE `pro_name` LIKE '%$search_text%' AND `view`='1' ORDER BY `pro_id` DESC");
    echo 'Results: <b>' . $results->num_rows . '</b> <br>'; // number of result
    if ($results->num_rows == null) {
        //  echo "<div style=' width: 100%; padding: 19px; text-align: center; color: #ff8383;' ><h3 style='margin: 0;font-size: 78px;' class='fa fa-user-times'></h3> <br> <b> No user  found! </b></div>";
      ?>
        <div class="search-null-result" >
          <h1 class='shake animated fa fa-frown-o'></h1> <br>
          <h3> No data Found! </h3>
           <p> Try to search using </p>
         <ul >
           <li> Product Name </li>
           <!-- <li> Client Name </li> -->
         </ul> <br> <p> if nothing change </p>
               <a href="DiversStock_report.php">
               <button type="button" class="btn bg-olive btn-flat margin click"> <b class="fa fa-shopping-cart"></b> go to Stock's Report</button>
               </a>
          </div>
        <?php

      } else {
         // searching
        while ($row = $results->fetch_array()) {
          @$pro_id = $row["pro_id"];
          @$pro_name = $row["pro_name"];
          echo "<section class='search-result-row click' onclick='ProductDetails($pro_id)'>  $pro_name  </section>";
        }
      }
    # end of users














    }  // INVITATION -->  SELL || DIVERS
} // INVITATION || DIVERS

}

