<?php
include_once 'app_data/php/head_no_css.php';
@$search_text = $_GET['search_text'];

//CHECK IF IS NOT NULL AND SUBMITTED
if (isset($_GET['search_text']) && !empty($_GET['search_text']) && strlen($search_text) > 2)
{


        $results = $mysqli->query("SELECT * FROM `env_stock` WHERE `e_id` LIKE '%$search_text%' AND `view`='1' ORDER BY `e_id` DESC");
        if ($results->num_rows == null) {
          //  echo "<div style=' width: 100%; padding: 19px; text-align: center; color: #ff8383;' ><h3 style='margin: 0;font-size: 78px;' class='fa fa-user-times'></h3> <br> <b> No user  found! </b></div>";
          ?>
          <br>
          <br>
          <br>
          <div class="">
            <div class="search-null-result">
              <h1 class="zoomIn animated fa fa-qrcode" style="color:#ababab"></h1> <br>
              <br>
              <h3 style="color:#ababab"> Try again </h3>
               <p style="color:#ababab">
                 <br>
                 Try to scan the <b>Qr</b> code clear <br>
                Or the <b>Qr</b> must contain errors
          </p>
            </div>
          </div>
          <style>
            #serchresult, .search-Div {
              background: #f8f9fa;
              height: 98vh;
            }
          </style>
          <?php

        } else {
           // searching
          while ($row = $results->fetch_array()) {
            @$e_id = $row["e_id"];
            @$e_color = $row["env_color"];
            ?>
            <a href="qr.php?code=<?php echo @$e_id; ?>">
              <section class='search-result-row click'> <b><?php echo @$e_id; ?></b> <?php echo @$e_color; ?> </section>
            </a>

            <?php
          }
        }
      # end of users


}
