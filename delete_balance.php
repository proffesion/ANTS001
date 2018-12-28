<?php
include 'app_data/php/head_blank.php';

admin_page();
$Bid     = $_GET['Bid'];
$type    = @$_GET['type'];
$sell_id = retrieve_data('sell_id', 'balance_table', 'balance_id', $Bid);

$Total_Available        = @retrieve_data('Total_Available','balance_table','balance_id',$Bid);
$Total_Available_Rw     = @retrieve_data('Total_Available_Rw','balance_table','balance_id',$Bid);


if (@$type == 'Divers') {
      // $formLink           = "edit_balance.php?id=$Bid&t=D";

      // retreaving last balance
      $last_payment_type  =  @retrieve_data('paym_typ','balance_table','balance_id',$Bid);
      $last_balance       = @retrieve_data('balance', 'balance_table', 'balance_id', $Bid);

      
      $dynamic_balance    = @retrieve_data('balance', 'divers_sales', 's_id', $sell_id);
      $static_balance     = @retrieve_data('static_balance', 'divers_sales', 's_id', $sell_id);
  
      $item_bal           = 'Divers';

} else {
      // $formLink           = "edit_balance.php?id=$Bid";

      // retreaving last balance
      $last_payment_type  =  @retrieve_data('paym_typ', 'balance_table','balance_id',$Bid);
      $last_balance       = @retrieve_data('balance', 'balance_table', 'balance_id', $Bid);

      $dynamic_balance    = @retrieve_data('balance', 'selling_e', 's_id', $sell_id);
      $static_balance     = @retrieve_data('static_balance', 'selling_e', 's_id', $sell_id);

      $item_bal           = 'Invitation';

}





$Previous_balance = $dynamic_balance + $Total_Available; // this is the current balance to be used in the balance form

// find the value of the tpe cosed of avance on the sell
if ($static_balance < $Previous_balance || $Previous_balance == 0) {
      $option = 'Done';
} else {
      $option = 'Avance';
}

// Mofify Balance Query
  if (@$type == 'Divers') {
   //  invitation update
    $update_main_table_query = "UPDATE `divers_sales` SET `balance` = '$Previous_balance', `Cash_type`='$option' WHERE `s_id` = '$sell_id'";
  } else {
   //  invitation update
    $update_main_table_query = "UPDATE `selling_e` SET `balance` = '$Previous_balance', `Cash_type`='$option'  WHERE `s_id` = '$sell_id'";
  }

// Delete Balance Query
$queryDeleteBalance = "DELETE FROM `balance_table` WHERE `balance_id`='$Bid'";



if ($results = $mysqli->query($update_main_table_query)) {

      if ($results = $mysqli->query($queryDeleteBalance)) {
            ?> <script> alert('Balance Deleted!'); </script> <?php
      } else {
            ?> <script> alert('Opps! Something went wrong, try again later!'); </script> <?php
      }
}


echo "<script> window.open('balance_view.php?deleted','_self'); </script>";


 ?>
 </body>
 </html>
