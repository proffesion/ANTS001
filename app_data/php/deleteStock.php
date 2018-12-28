<?php
  include 'head_iframe_cl.php';
  admin_page();
  $id = $_GET['Stid'];
  // $env_id = retrieve_data('e_id','selling_e','s_id',$id);
  echo $id;


    if ($results = $mysqli->query("DELETE FROM `env_stock` WHERE `e_id`='$id'")) {
     echo "<script> window.open('../../stock_list.php?deleted','_parent'); </script>";
    } else {
     echo "<script> window.open('../../stock_list.php?failed','_parent'); </script>";
    }



 ?>

 </body>
 </html>
