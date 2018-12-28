
<?php
include 'app_data/php/head_no_css.php';
secured();

// MySqli Select Query
$results = $mysqli->query("SELECT `s_id`,`e_id`,`quantity`,`client_name` FROM `selling_e` WHERE `date`='$today_date' AND `design`='$user_id'");
// echo $results->num_rows; // number of result

if ($results->num_rows == NULL) {
    ?>
    <section href="#" class="list-group-item" style="background:transparent;padding:40px 0px 40px 0px;">
      <h4 class="fa fa-frown-o" style="
    font-size: 97px;
    text-align: center;
    margin: auto;
    width: 100%;
    padding-bottom: 7px;
    color: #777;"></h4>
      <p class="list-group-item-text" style="text-align:center;">
            <b>Ooops!</b><br>
            No Sell Funnd!
      </p>
    </section>
    <?php
  } else {

    while($row = $results->fetch_array()) {
      $s_id = $row["s_id"];
      $e_id = $row["e_id"];
      $quantity = $row["quantity"];
      $client_name = $row["client_name"];
    ?>
    <section href="#" class="list-group-item ">
      <h4 class="list-group-item-heading"> <?php echo "$e_id &nbsp; $client_name"; ?> </h4>
      <p class="list-group-item-text">
        Sell:<b>#<?php echo @$s_id; ?></b>
        &nbsp;&nbsp;&nbsp;
        quantity: <b><?php echo @$quantity; ?></b> </p>
    </section>
    <?php

    }

}
 ?>
