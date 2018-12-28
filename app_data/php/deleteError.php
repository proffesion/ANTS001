<?php
  include 'head_iframe_cl.php';
  admin_page();
  $id = $_GET['erid'];
  // $env_id = retrieve_data('e_id','selling_e','s_id',$id);
  // echo $id;


    if ($results = $mysqli->query("DELETE FROM `error_table` WHERE `id`='$id'")) {
     echo "<script> window.open('../../home.php?erD','_self'); </script>";
    } else {
     echo "<script> window.open('../../home.php','_self'); </script>";
    }



 ?>

 <img src="../imgs/icns/loading29.gif" class="loading-img-view  animated" alt="" />

 </body>
 </html>
