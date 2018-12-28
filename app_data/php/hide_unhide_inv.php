<?php
  include 'head_iframe_cl.php';
  admin_page();
  $id = $_GET['id'];
  $sty = $_GET['st'];
  // $env_id = retrieve_data('e_id','selling_e','s_id',$id);
  if ($sty == '1') {
    $stU = '0';
  } else {
    $stU = '1';
  }

    # code...
    # code...
echo "now is: $sty <br> update is: $stU";


    if ($results = $mysqli->query("UPDATE `env_stock` SET `view` = '$stU' WHERE `e_id`='$id'")) {
     echo "<script> window.open('detailsStock.php?id=$id','_self'); </script>";
    } else {
     echo "<script> window.open('detailsStock.php?id=$id','_self'); </script>";
    }



 ?>

 </body>
 </html>
