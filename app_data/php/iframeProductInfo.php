<?php
 include 'head_iframe_cl.php';
 secured();
 $id = @$_GET['id'];

  // echo @$id;
if (!empty($id) || isset($id)) { ?>


<div class="bounceInRight animated" style=" text-align: center; ">
<h2 style=" margin: 0; padding: 20px 0px 2px 0px;color: #861038;"><?php echo retrieve_data('pro_name','products','pro_id',$id); ?></h2>
<h2 class="fa fa-cube" style=" margin: 0; font-size: 133px; text-align: center; color: rgba(157, 20, 66, 0.7);"></h2>


<br>
<section class="inv-details" style="text-align: left;">
  <!-- <h4>Invitation Details</h4> -->
  <hr>
  <label class="label-inv"> Pice fRw: </label>     <label class="value"> <?php echo retrieve_data('price_frw','products','pro_id',$id); ?> fRw </label> <hr>
  <label class="label-inv"> Price $: </label>  <label class="value"> <?php echo retrieve_data('price_dol','products','pro_id',$id); ?> $</label> <hr>
  <label class="label-inv"> Quantity: </label>   <label class="value"> <?php echo retrieve_data('pro_quantity','products','pro_id',$id); ?> </label> <hr>
  <label class="label-inv"> Place: </label>           <label class="value"> <?php echo retrieve_data('place','products','pro_id',$id); ?> </label> <hr>
  <label class="label-inv"> <u>Comment:</u> </label>        <p class=""> <?php echo retrieve_data('pro_comment','products','pro_id',$id); ?> </p> <hr>

<br>
<a href="../../saleDivers.php?pro_id=<?php echo $id; ?>" target="_parent"> <button type="button" class="btn btn-success btn-lg btn-block click" style="margin-bottom: 3px;"> <b class="fa fa-shopping-cart"></b> Sales</button> </a>
<a href="../../updateProduct.php?id=<?php echo $id; ?>" target="_parent" <?php echo @$admin_style; ?>> <button type="button" class="btn btn-primary btn-lg btn-block click" style="margin-bottom: 3px;"> <b class="fa fa-pencil-square-o"></b> Update</button> </a>
<a onclick="return confirm('Are you sure you want to delete this product? \n \n this will affect the sales related to this product ')" href="deleteProduct.php?id=<?php echo $id; ?>" <?php echo @$admin_style; ?>>
  <button type="button" class="btn btn-danger btn-lg btn-block" style="margin-bottom: 3px;"> <b class="fa fa-trash-o"></b> Delete</button>
</a>
</section>

</div>
<?php } else {
  echo '<h2 class="fa fa-cube pulse animated" style="margin: 0;font-size: 218px;text-align: center;display: block;margin-top: 20%;opacity: 0.4;color: #9d1442;"></h2>';
} ?>



<style media="screen">
  body {
    /*overflow: hidden;*/
    overflow-x: hidden;
        background-color: rgb(248, 249, 250);
  }
</style>
<script type="text/javascript">
  // alert('hh');
</script>
