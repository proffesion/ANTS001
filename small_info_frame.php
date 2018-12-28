<?php
  include 'app_data/php/head_iframe.php';
 // echo "the selected id id:";
  $env_id = $_GET['id'];
  $view = fileData('view',$env_id);
  //  echo $app_name;

 ?>


 <h2><b><?php echo fileData('e_id',$env_id); ?></b>  <u><?php echo fileData('env_color',$env_id); ?></u></h2>
 <div class="">
    <div class="img">
      <img src="envit/<?php echo fileData('img',$env_id); ?>" alt="" />
    </div>


    <section class="contents-itm" >
      <label class="label"> Envitation Id: </label>     <label class="value"> <?php echo fileData('e_id',$env_id); ?> </label> <hr>
      <label class="label"> Envitation color: </label>  <label class="value"> <?php echo fileData('env_color',$env_id); ?> </label> <hr>
      <label class="label"> Envitation size: </label>   <label class="value"> <?php echo fileData('size_w',$env_id); ?> x <?php echo fileData('size_h',$env_id); ?> </label> <hr>
      <label class="label"> Envitation Left:</label>    <label class="value"> <?php echo fileData('quantity',$env_id); ?> </label> <hr>
      <label class="label"> Price $: </label>           <label class="value"> <?php echo fileData('price_d',$env_id); ?> </label> <hr>
      <label class="label"> Price Rfwa: </label>        <label class="value"> <?php echo fileData('price_r',$env_id); ?> </label> <hr>
      <label class="label"> Place: </label>             <label class="value"> <?php echo fileData('place',$env_id); ?> </label> <hr>
      <label class="label"> Hidden: </label>             <label class="value"> <?php echo $view; ?> </label> <hr>


      <section>
        <label style="float:left;"> Click To change </label>
        <label style="float:right;"><a href="app_data/php/hide_unhide_inv.php?id=<?php echo $env_id; ?>&st=<?php echo $view; ?>"> <?php if ($view == '1') { ?> <b style="color: #15d015;font-size: 25px;" class="fa fa-toggle-on"></b> <?php } else { ?> <b style="font-size: 25px; color: #ff1c00;" class="fa fa-toggle-off"></b> <?php } ?> </a> </label>

        <section class="clear-both">x</section>
      </section>
      <hr>
      <label class="label"> comment: </label> <br>
       <p> <?php echo fileData('comment',$env_id); ?> </p> <hr>

       <!-- <button type="button" class="btn btn-primary" name="button"> <b class="fa fa-folder-o"></b> &nbsp; Open  </button> -->
       <a href="update_stock.php?id=<?php echo $env_id; ?>" target="_parent"> <button type="button" class="btn btn-primary btn-success  btn-block" name="button"> <b class="fa fa-edit"></b> &nbsp; Update  </button> </a>
       <a onclick="return confirm('are you sure you want to delete this envitation? ------------------------------------------------------------------------------------ this will affect the Sell related to this Invitation, you can hide insted of delete')" href="app_data/php/deleteStock.php?Stid=<?php echo $env_id; ?>"> <button type="button" class="btn btn-primary btn-block bg-red" name="button"> <b class="fa fa-trash-o"></b> &nbsp; Delete  </button> </a>
      <!-- <button type="button" class="btn btn-primary btn-block" name="button"> <b class="fa fa-folder-o"></b> &nbsp; Update  </button> -->

    </section>



 </div>



</body>
<style media="screen">
  body {
    background: #fff;
  }
  .img {
    background: #282e36;
    max-height: 195px;
    padding: 10px;
    text-align: center;
   }
   .img img {
     max-width: 100%;
     max-height: 195px;
   }
   h2 {
     font-size: 26px;
     padding: 9px 10px;
     border-top: 1px solid #b9b9b9;
     margin: 0px;
     color: #282e36;
   }
   h2 u {
    color: #9E9E9E;
    font-size: 22px;
    text-decoration: none;
   }
   .contents-itm {
     padding: 23px;
   }
   .contents-itm .label {
     font-size: 13px;
     font-weight: normal;
     color: #808080;
     margin: 0px;
   }
   .contents-itm .value {
     font-size: 14px;
     /*float: right;*/
   }

   .contents-itm hr {
     margin: 0px 0px 2px 0px;
     border-color: #a2a2a2;
   }
   p {
      background: grey;
      padding: 9px;
      margin: 0px;
      color: #fff;
      font-size: 14px;
      min-height: 20px;
      min-height: 75px;
      margin-bottom: 7px;
   }

</style>
