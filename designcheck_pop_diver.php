
<?php
include 'app_data/php/head_no_css.php';
secured();

// MySqli Select Query
// SELECT `s_id``div_id``quantity``client_name` FROM `divers_sales` WHERE `date`='' AND `done_by`=''
$results = $mysqli->query("SELECT `s_id`,`div_id`,`quantity`,`client_name` FROM `divers_sales` WHERE `date`='$today_date'");
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
            No diver Sell Funnd!
      </p>
    </section>
    <?php
  } else {

    while($row = $results->fetch_array()) {
      $s_id = $row["s_id"];
      $div_id = $row["div_id"];
      $quantity = $row["quantity"];
      $client_name = $row["client_name"];
    ?>
    <section href="#" class="list-group-item ">
      <h4 class="list-group-item-heading"> <?php echo retrieve_data('pro_name','products','pro_id',$div_id); ?> </h4>
      <p class="list-group-item-text">
        Sell:<b>#<?php echo @$s_id; ?></b>
        &nbsp;&nbsp;&nbsp;
        quantity: <b><?php echo @$quantity; ?></b>
        &nbsp;&nbsp;&nbsp;
        <b data-toggle="tooltip" data-placement="left" title="" class="fa fa-user"></b> <?php echo "$client_name"; ?>
       </p>
    </section>
    <?php

    }

}
 ?>
