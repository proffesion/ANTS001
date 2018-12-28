<?php include 'app_data/php/head_no_css.php'; ?>


<div class="errors-containner">
<?php
  // MySqli Select Query
  $results = $mysqli->query("SELECT * FROM `error_table`");
  // echo $results->num_rows; // number of result

  if ($results->num_rows == NULL) {
      echo "No Error Found";
  } else {

      while($row = $results->fetch_array()) {
          $errSell_id = $row["sell_id"];
          $errUser_id = $row["user_id"];
          $errDate = $row["date"];
          $description= $row["description"];
          $err_id = $row['id'];
       ?>

<section class="error-section">
  <section class="fsect">
     <section>
        <b class="fa fa-user"></b> <u><?php echo retrieve_data('username','users','user_id',$errUser_id); ?></u> <br>
        <b class="fa fa-calendar"></b> <u><?php echo $errDate; ?></u> <br>
     </section>
     <section>
        <b class="fa fa-cart-arrow-down"></b> <u> #<?php echo $errSell_id; ?></u> <br>
        <!-- <b class="fa fa-user"></b> <u>janvier</u> <br> -->
     </section>
     <div class="clear-both"></div>
   </section>
  <section class="ssect  animated">
<p>
  <?php echo $description; ?>
</p>
<b class="fa fa-eye show-errors" style="font-size: 25px; color: #0b621d;"  onclick="sellDetails(<?php echo @$errSell_id; ?>)" ></b>
<a href="app_data/php/deleteError.php?erid=<?php echo $err_id; ?>"> <b class="fa fa-trash" style="font-size: 25px;margin: 0px 7px;color: red;"></b></a>

  </section>
</section>

       <?php
      }

  }
 ?>


<?php for ($i=0; $i < 4; $i++) { ?>
<!-- <br> -->
<?php } ?>

</div>
