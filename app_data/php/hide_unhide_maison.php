<?php
  include 'head_iframe_cl.php';
  admin_page();
  $id = $_GET['id'];
  $t = $_GET['t'];
  // $env_id = retrieve_data('e_id','selling_e','s_id',$id);
  if ($t == 'hide') {
    $stU = '0';
  } else if ($t == 'show') {
    $stU = '1';
  } else {

  }


    if ($results = $mysqli->query("UPDATE `maison` SET  `view` = '$stU' WHERE `maison_id`='$id'")) { echo "<script> window.open('../../maison.php?id=$id','_self'); </script>"; }


 ?>

 </body>
 </html>
