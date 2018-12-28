<?php
  include 'head_iframe_cl.php';
  admin_page();
  $id = $_GET['id'];
  // $env_id = retrieve_data('e_id','selling_e','s_id',$id);
  echo $id;


  if ($id != $user_id) {
    if ($results = $mysqli->query("DELETE FROM `users` WHERE `user_id`='$id'")) {
     echo "<script> window.open('../../users.php?deleted','_self'); </script>";
    } else {
     echo "<script> window.open('../../users.php?failed','_self'); </script>";
    }

  } else {
    echo "<script> window.open('../../users.php?you','_self'); </script>";
  }


 ?>

 </body>
 </html>
