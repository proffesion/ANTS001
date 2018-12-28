<?php
  include 'head_iframe_cl.php';
  admin_page();
  $id = $_GET['id'];

  if (empty($id)) { echo "<script> window.open('../../products.php?deleted','_parent'); </script>"; }  else {

     if ($results = $mysqli->query("DELETE FROM `products` WHERE `pro_id`='$id'")) { echo "<script> window.open('../../products.php?1','_parent'); </script>"; } else {
       echo "<script> window.open('../../products.php?2','_parent'); </script>";
     }
  }

?>
</body>
</html>
