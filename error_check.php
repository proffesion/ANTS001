
<?php include 'app_data/php/head_no_css.php'; ?>


<!-- <div class="errors-containner"> -->
  <div class="list-group">
<?php
  // MySqli Select Query
  $results = $mysqli->query("SELECT * FROM `error_table`");
  // echo $results->num_rows; // number of result

  if ($results->num_rows == NULL) {
      // echo "No Error Found";
      echo "<style> .error-fixed-popup { display:none; } </style>";

  } else {

      while($row = $results->fetch_array()) {
          $errSell_id = $row["sell_id"];
          $errUser_id = $row["user_id"];
          $errDate = $row["date"];
          $description= $row["description"];
          $err_id = $row['id'];
       ?>

         <section href="#" class="list-group-item" style="width:100%;background-color:#d00549; color:#fff; margin-bottom:2px;z-index:111111111111111111111111111;">
           <h4 class="list-group-item-heading">Warning!!</h4>
           <p class="list-group-item-text">
              <b><?php echo retrieve_data('username','users','user_id',$errUser_id); ?></b> - <u><?php echo $errDate; ?></u><br>
              sell:  #<?php echo $errSell_id; ?> <br>
              <?php echo $description; ?>
            </p>

           <hr style="margin:4px 0px 0px 0px;">

           <span class="label label-warning" onclick="sellDetails(<?php echo @$errSell_id; ?>)">Check</span>
           <a href="app_data/php/deleteError.php?erid=<?php echo $err_id; ?>">
             <span class="label label-danger">Delete</span>
           </a>

         </section>

       <?php
      }

  }
 ?>


<!-- </div> -->

</div>
