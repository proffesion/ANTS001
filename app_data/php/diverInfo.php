<?php
  include 'head_iframe_cl.php';
  $id = $_GET['id'];

  // echo "<h1>$id</h1>";
?>
<div class="conta">
  <h2><?php echo retrieve_data('pro_name','products','pro_id',$id); ?></h2>
  <div class="">
     <section>
<u>Pice fRw:</u> <b> <?php echo retrieve_data('price_frw','products','pro_id',$id); ?> fRw </b><hr>
<u>Price $:</u> <b> <?php echo retrieve_data('price_dol','products','pro_id',$id); ?> $ </b><hr>
<u>Quantity:</u> <b>  <?php echo retrieve_data('pro_quantity','products','pro_id',$id); ?> </b><hr>
<u>Place:</u> <b>  <?php echo retrieve_data('place','products','pro_id',$id); ?>  </b><hr>

     </section>
     <section>

<u> Comment:</u>
<p>
<?php echo retrieve_data('pro_comment','products','pro_id',$id); ?>
</p>
     </section>
  </div>

</div>
<style media="screen">
body { background: transparent;}
hr {
  margin: 3px;
  border-color: #9a9a9a;
}
h2 { color: #fff; }

   .conta {
     width: 90%;
     margin-left: 8%;
   }
   .conta section {
     width: 40%;
     float: left;
     margin-right: 4px;
   }

   u {
      font-size: 17px;
      color: #b3b3b3;
      text-decoration: none;
      margin-left: 8px;
    }
    b {
      font-size: 18px;
      color: #fff;
      float: right;
      margin-right: 11px;
    }
    p {
      color: #fff;
      margin: 3px 12px;
      font-size: 16px;
    }
</style>
