<?php
include 'head_iframe_cl.php';
$id = $_GET['id'];
@$quant = $_POST['quant'];

  @$quanteo = retrieve_data('quantity','left_invitation','sell_id',$id);
if ($quanteo > 0) {
  @$quante = $quanteo;
} else {
  @$quante = '0';
}


if (isset($_POST['save'])) {
    if (number_ret("SELECT `id` FROM `left_invitation` WHERE `sell_id`='$id'") != NULL) {
    $results = $mysqli->query("UPDATE `left_invitation` SET `quantity` = '$quant' WHERE `sell_id`='$id'");
    echo "<script> window.open('left_invitation.php?id=$id','_self'); </script>";

    } else {
      $results = $mysqli->query("INSERT INTO `left_invitation`(`sell_id`, `quantity`) VALUES ('$id','$quant')");
      echo "<script> window.open('left_invitation.php?id=$id','_self'); </script>";
    }

} elseif (isset($_POST['delete'])) {
   $results = $mysqli->query("DELETE FROM `left_invitation` WHERE `sell_id`='$id'");
   echo "<script> window.open('left_invitation.php?id=$id','_self'); </script>";

}

?>

<form class="" action="left_invitation.php?id=<?php echo $id; ?>" method="post">

    <section class="main-section">
      <input type="number" name="quant" minlength="0" class="sect-input-left" value="<?php echo @$quante; ?>">
      <!-- <input type="button" name="name" value=""> -->
      <section  class="section-button">
      <button type="submit" style="color:#1639ff;" name="save"><b class="fa fa-save"></b></button>
      <button type="submit" style="color:#da4236;" name="delete"><b class="fa fa-trash"></b></button>
      <section class="clear-both">x</section>
      </section>
    </section>

</form>

</body>
</html>

<style media="screen">
.main-section {
      background: #c6c6c6;
      height: 40px;
}

.sect-input-left {
    margin-left: 6px;
    border: none;
    background: transparent;
    border-left: 1px solid #fff;
    font-size: 16px;
    height: 30px;
    margin-top: 4px;
    padding-left: 12px;
    width: 50%;
}

.section-button {
  text-align: right;
  width: 27%;
  font-size: 24px;
  float: right;
  margin-right: 5px;
  margin-top: 3px;
}

.section-button button {
  color: #191e24;
  margin: 0px;
  padding: 0px 5px;
  font-size: 21px;
  font-weight: normal;
  background: transparent;
  border: none;
}
</style>
