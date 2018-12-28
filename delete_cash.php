<?php
include 'app_data/php/head_blank.php';

if (isset($_GET['idu']) && isset($_GET['dt'])) {
    # code...
    $id = @$_GET['idu'];
    $date = @$_GET['dt'];

    $query = "DELETE FROM `deposit` WHERE `id`='$id' AND `date`='$date'";
    if ($mysqli->query($query)) {
      echo "deleted!";
      echo "<script> window.open('insert_cash.php?e=deleted','_self'); </script>";
    } else {
      echo "<script> window.open('insert_cash.php?e=Failed to delete','_self'); </script>";
    }

} else {
  echo "<script> window.open('insert_cash.php?e=Error!','_self'); </script>";
}


?>
