<?php
include 'app_data/php/head.php';
secured();
admin_page();

?>
<div class="contents-div">
  <div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">

      <section class="header-div-sec">
        <h2>  ADD MAISON </h2>
      </section>

    <div class="secton-contents-containner">


<!-- `maison_id`,
 `maison_name`, `maison_address`, `maison_phone`, `maison_comment`, `view` -->
<?php
  if (isset($_POST['add_maison'])) {
    $maison_name = $_POST['maison_name'];
    $maison_address = $_POST['maison_address'];
    $maison_phone = $_POST['maison_phone'];
    $maison_comment = $_POST['maison_comment'];
    $view = $_POST['view'];

$query_maison ="INSERT INTO
  `maison`(
    `maison_name`,
    `maison_address`,
    `maison_phone`,
    `maison_comment`,
    `view`
  )
VALUES(
  '$maison_name',
  '$maison_address',
  '$maison_phone',
  '$maison_comment',
  '$view'
)";
  if ($Query_one_run = $mysqli->query($query_maison)) {
// $sell_next_Id = "";
?>
<div class="alert alert-success alert-dismissible" style="margin-bottom: 0;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b class=" fa fa-check"></b> &nbsp; The <b><?php echo @$maison_name; ?></b> has Been Inserted in the System
</div>

<?php  } else { ?>

  <div class="alert alert-warning alert-dismissible" style="margin-bottom: 0;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <b class=" fa fa-warning"></b> &nbsp; Try again later
  </div>

<?php }

}


?>


<form class="" action="add_maison.php" method="post">
<div class="forms-divs">
 <section>
   <div class="form-group">
     <label >Name</label>
     <input type="text" name="maison_name" class="form-control" value="" id="" placeholder="">
   </div>

   <div class="form-group">
       <label >Address</label>
       <input type="text" name="maison_address" class="form-control" value="" id="" placeholder="">
   </div>

   <div class="form-group">
       <label >Phone Numbers</label>
       <input type="text" name="maison_phone" class="form-control" value="" id="" placeholder="">
   </div>



 </section>

 <section>


   <div class="form-group">
       <label >view</label>
       <select class="form-control" name="view" required="">
         <option value=""></option>
         <option value="1">Yes</option>
         <option value="0">No</option>
       </select>
   </div>


   <div class="form-group">
       <label >Comment</label>
       <input type="text" name="maison_comment" style="height:109px" class="form-control" value="">
   </div>
<!-- ggg -->


<button type="submit" name="add_maison" class="btn btn-primary click bg-green-col submit-butt" style="float: right;margin: 14px 0px;" name="button"> <b class="fa fa fa-plus-square"></b> &nbsp; Add Maison </button>

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
