<?php
include 'app_data/php/head.php';
secured();

// $item_id = "1672";
// if (!isset($_GET['id']) || empty($_GET['id'])) {
//      echo "<script> window.open('home.php','_self'); </script>";
// }

  // `balance_id`,
  // `date`,
  // `item`,
  // `item_id`,
  // `sell_id`,
  // `balance`,
  // `comment`,
  // `client_name`,
  // `payed_in`,
  // `closed`

  // $id = $_GET['id'];
    $id = $_GET['id'];
    $item_ido = retrieve_data('item_id','balance_table','balance_id',$id);
    $typ = retrieve_data('item','balance_table','balance_id',$id);
    $sell_id = retrieve_data('sell_id','balance_table','balance_id',$id);


    // $item_id = retrieve_data('item_id','balance_table','balance_id',$id);

// if (isset($_GET['t']) && !empty($_GET['t'])) {
//   @$typ = @$_GET['t'];
// } else {
//   @$typ ='x';
// }


//
// if (@$typ == 'Divers') {
//       // $item_id = retrieve_data('div_id','divers_sales','s_id',$id);
//       $client_name = @retrieve_data('client_name','divers_sales','s_id',$id);
//       $formLink = "update_balance.php?id=$id&t=Divers";
// } else {
//       // $item_id = @retrieve_data('e_id','selling_e','s_id',$id);
//       $client_name = @retrieve_data('client_name','selling_e','s_id',$id);
//       $formLink = "update_balance.php?id=$id>";
// }


?>
<div class="contents-div">
  <div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">

      <section class="header-div-sec">
        <h2>  BALLANCE FORM
          <!-- <b><?php echo $item_id; ?></b>  -->
        </h2>
      </section>

    <div class="secton-contents-containner">

<?php
  if (isset($_POST['Sell_envitation'])) {
    $client_name = $_POST['c_name'];
    $balance = $_POST['balance'];
    $payed_in = $_POST['payed_in'];
    $closed = $_POST['closed'];
    $item = $_POST['item'];
    $item_ide = $_POST['item_id'];
    $comment = $_POST['comment'];
    $comment = $_POST['comment'];

    // $don_by = $user_id;
    // $quantit = $_POST['quantit'];
    // $pr_u_d = $_POST['pr_u_d'];
    // $pr_t_d = $_POST['pr_t_d'];
    // $avance = $_POST['avance'];
    $query_balance = "UPDATE `balance_table` SET
    `item` = '$item',
    `item_id` = '$item_ide',
    `sell_id` = '$sell_id',
    `balance` = '$balance',
    `comment` = '$comment',
    `client_name` = '$client_name',
    `payed_in` = '$payed_in',
    `closed` = '$closed'
     WHERE `balance_id`='$id'";


  if ($Query_one_run = $mysqli->query($query_balance)) {
// $sell_next_Id = "";
?>
<div class="alert alert-success alert-dismissible" style="margin-bottom: 0;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b class=" fa fa-check"></b> &nbsp; The Ballance has Been Inserted in the System
</div>

<?php  }

}


?>




<form class="" action="update_balance.php?id=<?php echo $id; ?>" method="post">
<div class="forms-divs">
 <section>
   <div class="form-group">
       <label >Item</label>
       <select class="form-control" name="item" required="">
          <option value="<?php echo  retrieve_data('item','balance_table','balance_id',$id); ?>"><?php echo  retrieve_data('item','balance_table','balance_id',$id); ?></option>
          <option value=""></option>
         <option value="Invitation">Invitation</option>
         <option value="Divers">Divers</option>
       </select>
   </div>

   <div class="form-group">
   <?php
   if (@$typ == 'Divers') { ?>
     <label >Divers</label>
     <select class="form-control" name="item_id" required="">
       <?php if (retrieve_data('pro_id','products','pro_id',$item_ido) == '0') {
         echo "<option value='0'>Others</option>";
       } ?>
         <option value="<?php echo retrieve_data('pro_id','products','pro_id',$item_ido); ?>"><?php echo retrieve_data('pro_name','products','pro_id',$item_ido); ?></option>
         <option value=""></option>

         <?php
         $results_users = $mysqli->query("SELECT `pro_id`, `pro_name` FROM `products` WHERE `view`='1'");
         if ($results_users->num_rows == NULL) {
         } else {
             while($rowe = $results_users->fetch_array()) {
               $pro_id = $rowe["pro_id"];
               $pro_name = $rowe["pro_name"];
               echo "<option value='$pro_id'>$pro_name</option>";
             }
         } ?>
         <option value="0">Others</option>
     </select>
     <?php } else { ?>

     <label >Item Id</label>
     <input type="text" name="item_id" class="form-control" value="<?php echo retrieve_data('item_id','balance_table','balance_id',$id); ?>" id="" placeholder="" required="">

     <?php } ?>
   </div>

   <div class="form-group">
       <label >Sale Number</label>
       <input type="text" name="sale_id" class="form-control" value="<?php echo  retrieve_data('sell_id','balance_table','balance_id',$id); ?>" id="" placeholder="" readonly="">
   </div>

   <div class="form-group">
       <label >Client Name</label>
       <input type="text" name="c_name" class="form-control" value="<?php echo  retrieve_data('client_name','balance_table','balance_id',$id); ?>" id="" placeholder="Client Name" title="Text only" minlength="5" required="" <?php echo $form_text; ?>>
   </div>

 </section>


 <section>

   <div class="form-group">
       <label >Balance</label>
       <input type="text" name="balance" class="form-control" value="<?php echo  retrieve_data('balance','balance_table','balance_id',$id); ?>" id="" placeholder="balance" required="" <?php echo $form_number; ?>>
   </div>

   <div class="form-group">
       <label >Payed In</label>
       <select class="form-control" name="payed_in" required="">
         <option value="<?php echo  retrieve_data('payed_in','balance_table','balance_id',$id); ?>"><?php echo  retrieve_data('payed_in','balance_table','balance_id',$id); ?></option>
         <option value=""></option>
         <option value="$">$</option>
         <option value="Rfw">Rfw</option>
         <option value="Cng">Cng</option>
       </select>
   </div>

   <div class="form-group">
       <label >closed</label>
       <select class="form-control" name="closed" required="">
         <option value="<?php echo  retrieve_data('closed','balance_table','balance_id',$id); ?>"><?php echo  retrieve_data('closed','balance_table','balance_id',$id); ?></option>
         <option value=""></option>
         <option value="Yes">Yes</option>
         <option value="No">No</option>
       </select>
   </div>


   <div class="form-group">
       <label >Comment</label>
       <input type="text" name="comment" class="form-control" value="<?php echo  retrieve_data('comment','balance_table','balance_id',$id); ?>">
   </div>
<!-- ggg -->


<button type="submit" name="Sell_envitation" class="btn btn-primary click bg-green-col submit-butt" style="float: right;margin: 14px 0px;" name="button"> <b class="fa fa-save"></b> &nbsp; Save Change </button>

            </form>
 </section>
<div class="clear-both">x</div>
</div>


<div class="" style="height:100px;"></div>

    </div><!-- .secton-contents-containner -->
  </div><!-- .contents-iframe -->

<div class="">
  <div class="contents-iframe fadeIn animated search-conent-div" id="SearchResult">
      <section class="cancel-section-button">
        <button type="button" name="button" onclick="HideSearchDivContent()"> <b class="fa fa-arrow-left"></b> Back</button>
      </section>
      <div class="" id="iframeDispayDiv"></div>
  </div>
</div>

</div><!-- .contents-div -->

</div><!-- .contents-div -->


</div><!-- .containner -->
</div><!-- .main-containner -->
<?php include 'app_data/php/foater.php' ?>
<style media="screen">
  .att {
    border: 1px solid #8BC34A;
    box-shadow: 0px 0px 8px #8bc34a;
    font-weight: bold;
    font-size: 17px;
    color: #597d47;
}

.fix-sucs-box {
    position: fixed;
    top: 72px;
    right: 0px;
    left: 0px;
    margin: auto;
    box-shadow: 9px 9px 25px 99999px rgba(0, 0, 0, 0.75);
}
</style>
