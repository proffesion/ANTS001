<?php
include 'head_iframe_cl.php';
admin_page();
special_page();

$id = $_GET['id'];

if ($_GET['state'] == 'active') {
    $state = 1;
} else if($_GET['state'] == 'deactive') {
    $state = 0;
}

if (isset($id) && !empty($id)) {
    if ($results = $mysqli->query("UPDATE `signature` SET `allowed`='$state' WHERE `user_id`='$id'")) {
        echo "<script> window.open('../../electronicSignatureUser.php?id=$id','_self'); </script>";
    } else {
        echo "<script> window.open('../../electronicSignatureUser.php?id=$id','_self'); </script>";
    }

} else {
    echo "<script> 
    alert('no user selected!';)
    window.open('../../users.php','_self'); 
    </script> ";
}
?>

 </body>
 </html>
