<?php
include 'app_data/php/head.php';
secured();
// $env_id = "1672";
if (!isset($_GET['id']) || empty($_GET['id'])) {
     echo "<script> window.open('home.php','_self'); </script>";
}
$env_id = $_GET['id'];

?>
<div class="contents-div">
  <div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">

      <section class="header-div-sec">
        <h2>  SELL ENVITATION <b><?php echo $env_id; ?></b> </h2>
      </section>

    <div class="secton-contents-containner">

<?php
  if (isset($_POST['Sell_envitation'])) {
    $don_by = $user_id;
    $client_name = $_POST['c_name'];
    $quantit = $_POST['quantit'];
    $typ = $_POST['typ'];
    $payed_in = $_POST['payed_in'];
    $closed = $_POST['closed'];
    $pr_u_r = $_POST['pr_u_r'];
    $pr_t_r = $_POST['pr_t_r'];
    $pr_u_d = $_POST['pr_u_d'];
    $pr_t_d = $_POST['pr_t_d'];
    $avance = $_POST['avance'];
    $balance = $_POST['balance'];
    $designed_by = $_POST['designed_by'];
    $comment = $_POST['comment'];
    $maison = $_POST['maison_id'];
    $printe = $_POST['print'];



$stock_n = fileData('quantity',$env_id);
if ($quantit > $stock_n) {
?>
<div class="alert alert-warning alert-dismissible" style="margin-bottom: 0;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b class=" fa fa-warning"></b> &nbsp; The available Quantity is <?php echo fileData('quantity',$env_id); ?>, Plase don't go above <?php echo fileData('quantity',$env_id); ?> Invitations
</div>
<?php
} else {
$query = "INSERT INTO
  `selling_e`(
    `e_id`,
    `typ`,
    `date`,
    `quantity`,
    `client_name`,
    `done_by`,
    `price_unit_rw`,
    `price_tot_rw`,
    `price_unit_d`,
    `price_tot_d`,
    `avance`,
    `balance`,
    `closed`,
    `paym_typ`,
    `design`,
    `comment`,
    `maison_id`,
    `print`
  )
VALUES(
  '$env_id',
  '$typ',
  '$time_now',
  '$quantit',
  '$client_name',
  '$user_id',
  '$pr_u_r',
  '$pr_t_r',
  '$pr_u_d',
  '$pr_t_d',
  '$avance',
  '$balance',
  '$closed',
  '$payed_in',
  '$designed_by',
  '$comment',
  '$maison',
  '$printe'
)";




$stock_size = fileData('quantity',$env_id);
$left_in_stock = $stock_size - $quantit;

$update_stock_Query = "UPDATE `env_stock` SET `quantity`='$left_in_stock' WHERE `e_id`='$env_id'";

if ($Query_one_run = $mysqli->query($query)) {
  if ($Query_one_run = $mysqli->query($update_stock_Query)) {
// $sell_next_Id = "";
?>

<!-- <div class=""> -->
  <div class='allert_div-sucss bg-green fix-sucs-box zoomIn animated'>
          <h2 class='fa fa-check-circle'></h2>
          <p>The Sell has Been Inserted <br> in the System</p>
          <hr>
          <!-- <a href="bill_print.php?id=4"><button type="button" name="button" class="pull-left click"><b class="fa fa-print"></b> Print Bill </button></a> -->
          <a href="sell_view.php"><button type="button" name="button" class="pull-right click"><b class="fa fa fa-reorder"></b> check In Sells </button></a>
          <div class="clear-both">x</div>
        </div>
     <style> .frm { display:none; } </style>
<!-- </div> -->

<?php  } else {
    echo "<h2>fail to update the stock</h2>";
  }
} else {
  echo "<h2>Sorrry it doesnt run</h2>";
}

}

  }



?>



        <div class="top-div-detail scroll">
            <section class="img">
              <img src="envit/<?php echo fileData('img',$env_id); ?>" alt="Envitation Img" />
            </section>
            <form class="" action="sell_envitation.php?id=<?php echo $env_id; ?>" method="post">

            <section class="contents">
                  <label class="label">  Id: </label>     <label class="value"> <?php echo fileData('e_id',$env_id); ?> </label> <hr>
                  <label class="label">  color: </label>  <label class="value"> <?php echo fileData('env_color',$env_id); ?> </label> <hr>
                  <label class="label">  size: </label>   <label class="value"> <?php echo fileData('size_w',$env_id); ?> x <?php echo fileData('size_h',$env_id); ?> </label> <hr>
                  <label class="label">  Left:</label>    <label class="value"> <?php echo fileData('quantity',$env_id); ?> </label> <hr>
                  <label class="label"> Place: </label>   <label class="value"> <?php echo fileData('place',$env_id); ?> </label>
            </section>

            <section class="contents">
              <label class="label"> Price $: </label>           <label class="value"> <?php echo fileData('price_d',$env_id); ?> </label> <hr>
              <label class="label"> Price Rfwa: </label>        <label class="value"> <?php echo fileData('price_r',$env_id); ?> </label> <hr>
              <label class="label"> comment: </label> <br>
               <p> <?php echo fileData('comment',$env_id); ?> </p>
               <!-- <hr> -->
            </section>
            <section class="clear-both">x</section>
        </div><!-- .top-div-detail -->



<div class="forms-divs">
 <section>
   <div class="form-group">
       <label >Sell Done By</label>
       <input type="text" name="don_by" class="form-control" value="<?php echo "$fnamel  $lnamel"; ?>" id="" placeholder="" readonly="">
   </div>
   <div class="form-group">
       <label >Designed By</label>
       <!-- <input type="text" name="don_by" class="form-control" value="<?php echo "$fnamel  $lnamel"; ?>" id="" placeholder="" readonly=""> -->
       <select class="form-control" name="designed_by" required="">
           <option value=""></option>
           <option value="None">None</option>
           <?php
           $results_users = $mysqli->query("SELECT `user_id`,`username` FROM `users` WHERE `perm`='1'");
           if ($results_users->num_rows == NULL) {
           } else {
               while($rowe = $results_users->fetch_array()) {
                 $user_id = $rowe["user_id"];
                 $username = $rowe["username"];
                 echo "<option value='$user_id'>$username</option>";
               }
           } ?>
       </select>
   </div>

   <div class="form-group">
       <label >Print</label>
       <!-- <input type="text" name="c_name" class="form-control" value="" id="" placeholder="Client Name" title="Text only" minlength="5" required="" <?php echo $form_text; ?>> -->
       <select class="form-control" name="print" required="">
           <option value=""></option>
           <option value="Yes">Yes</option>
           <option value="No">No</option>
      </select>
   </div>

   <div class="form-group">
       <label >Client Name</label>
       <input type="text" name="c_name" class="form-control" value="" id="" placeholder="Client Name" title="Text only" minlength="5" required="" <?php echo $form_text; ?>>
   </div>

   <div class="form-group">
       <label >Maison</label>
       <select class="form-control" name="maison_id" required="">
         <option value=""></option>
         <option value="0">None</option>
         <?php
         $results_users = $mysqli->query("SELECT `maison_id`,`maison_name` FROM `maison` WHERE `view`='1'");
         if ($results_users->num_rows == NULL) {
         } else {
             while($rowe = $results_users->fetch_array()) {
               $maison_id = $rowe["maison_id"];
               $maison_name = $rowe["maison_name"];
               echo "<option value='$maison_id'>$maison_name</option>";
             }
         } ?>
       </select>
   </div>

   <div class="form-group">
       <label >Quantity</label>
       <input type="number" name="quantit" class="form-control" onkeyup="QuantitF()" value="" id="QuantityTkn" placeholder="Quantity" required="">
   </div>
   <div class="form-group">
       <label >Type</label>
       <select class="form-control" name="typ" required="">
         <option value=""></option>
         <option value="New">New</option>
         <option value="Addition">Addition</option>
       </select>
   </div>
   <div class="form-group">
       <label >Payed In</label>
       <select class="form-control" name="payed_in" required="">
         <option value=""></option>
         <option value="$">$</option>
         <option value="Rfw">Rfw</option>
         <option value="Cng">Cng</option>
       </select>
   </div>



 </section>

 <section>
   <div class="form-group">
       <label >closed</label>
       <select class="form-control" onchange="CheckClosed(this.value)" name="closed" required="">
         <option value=""></option>
         <option value="Yes">Yes</option>
         <option value="No">No</option>
       </select>
   </div>
   <div class="form-group">
       <label >Price Unit (frw)</label>
       <input type="text" name="pr_u_r" onkeyup="CalcPricrF()" class="form-control" value="<?php echo fileData('price_r',$env_id); ?>" title="Use Numbers only" id="Pr_U_R" placeholder="Price Unit (frw)" required="" <?php echo $form_number; ?>>
   </div>
   <div class="form-group">
       <label >Price Total (frw)</label>
       <input type="text" name="pr_t_r" class="form-control att" value="" id="Pr_T_R" placeholder="Price Total (frw)" title="Use Text only" required=""  <?php echo $form_number; ?>>
   </div>
   <div class="form-group">
       <label >Price Unit ($)</label>
       <input type="text" name="pr_u_d" class="form-control"  onkeyup="CalcPricrD()" value="<?php echo fileData('price_d',$env_id); ?>" id="Pr_U_D" placeholder="Price Unit ($)" title="Use Numbers only" required=""  <?php echo $form_number; ?>>
   </div>
   <div class="form-group">
       <label >Price Total ($)</label>
       <input type="text" name="pr_t_d" class="form-control att" value="" id="Pr_T_D" placeholder="Price Total ($)" title="Use numbers only" required="" <?php echo $form_number; ?>>
   </div>


<div class="" id="avanc">
   <div class="form-group">
       <label >Avance</label>
       <!-- onkeyup="CalcBalanc()"  -->
       <input type="text" name="avance" class="form-control" value="0" id="avance" placeholder="Avance">
   </div>
   <div class="form-group">
       <label >Balance</label>
       <!--  -->
       <input type="text" name="balance" class="form-control" id="balance" value="0" placeholder="Balance">
   </div>
</div>

   <div class="form-group">
       <label >Comment</label>
       <input type="text" name="comment" class="form-control" style="height: 96px;text-align: center;" placeholder="Comment" title="Use Characters only" <?php echo $form_text; ?>>
   </div>

  <button type="submit" name="Sell_envitation" class="btn btn-primary click bg-green-col submit-butt" style="float: right;margin: 14px 0px;" name="button"> <b class="fa fa-shopping-cart"></b> &nbsp; Sell Envitation </button>

        </form>
 </section>
<div class="clear-both">x</div>
</div>





<div class="" style="height:500px;">

</div>

<input type="number" name="name" id="quantityEnv" value="<?php echo fileData('quantity',$env_id); ?>" hidden="">


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
  #avanc {
    display: none;
  }
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

<script type="text/javascript">


 // check if is closed
  function CheckClosed(val) {
    if (val == 'No') {
      var quant = document.getElementById("avanc").style.display='block';
    } else if (val == 'Yes') {
      var quant = document.getElementById("avanc").style.display='none';
      document.getElementById("avance").value=0;
      document.getElementById("balance").value='0';


    }
  }

  function CalcPricrF() {
    var quant = document.getElementById("QuantityTkn").value;
    var val = document.getElementById("Pr_U_R").value;

    if (quant == "") {
      document.getElementById("QuantityTkn").style.border='2px solid red';
      alert("Please Insert The Quantity!")
    } else {
      document.getElementById("Pr_T_R").value=quant*val;
    }
  }

    function CalcPricrD() {
      var quant = document.getElementById("QuantityTkn").value;
      var val = document.getElementById("Pr_U_D").value;

      if (quant == "") {
        document.getElementById("QuantityTkn").style.border='2px solid red';
        alert("Please Insert The Quantity!")
      } else {
        document.getElementById("Pr_T_D").value=quant*val;
      }
    }

function CalcBalanc() {
  var avance = document.getElementById("avance").value;
  var ptr = document.getElementById("Pr_T_R").value;
  var balance = document.getElementById("balance").value=ptr-avance;
  alert(val);
}

    function QuantitF() {
      CalcPricrF();
      CalcPricrD();
      CheckQuantity();
      // alert('ggg');
    }
</script>
