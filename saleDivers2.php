<?php
include 'app_data/php/head.php';
secured();
?>
<div class="contents-div">
  <div class="contents-iframe fadeIn animated bod-main-hide" id="mainContentsDiv">

      <section class="header-div-sec">
        <h2> DIVERS FORM </h2>
      </section>

    <div class="secton-contents-containner">

<?php
  if (isset($_POST['divers_sell'])) {
    $client_name = $_POST['c_name'];
    $product_id = $_POST['product_id'];
    $maison = $_POST['maison_id'];
    $don_by = $user_id;
    $quantit = $_POST['quantit'];
    // $typ = $_POST['typ'];
    $payed_in = $_POST['payed_in'];
    $closed = $_POST['closed'];
    $pr_u_r = $_POST['pr_u_r'];
    $pr_t_r = $_POST['pr_t_r'];
    $pr_u_d = $_POST['pr_u_d'];
    $pr_t_d = $_POST['pr_t_d'];
    $avance = $_POST['avance'];
    $balance = $_POST['balance'];
    $comment = $_POST['comment'];


$query = "INSERT INTO `divers_sales`(
    `date`,
    `div_id`,
    `client_name`,
    `maison_id`,
    `done_by`,
    `quantity`,
    `payed_in`,
    `pu_r`,
    `pu_d`,
    `pt_r`,
    `pt_d`,
    `closed`,
    `avance`,
    `balance`,
    `comment`
  )
VALUES(
  '$time_now',
  '$product_id',
  '$client_name',
  '$maison',
  '$don_by',
  '$quantit',
  '$payed_in',
  '$pr_u_r',
  '$pr_u_d',
  '$pr_t_r',
  '$pr_t_d',
  '$closed',
  '$avance',
  '$balance',
  '$comment'
)";

if ($Query_one_run = $mysqli->query($query)) { ?>
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
<?php
} else {
  echo "<h2>Sorrry it doesnt run</h2>";
}



}
?>



        <div class="top-div-detail scroll">
          <div class="" id="infDv"></div>
        </div><!-- .top-div-detail -->
            <form class="" action="saleDivers.php" method="post">




<div class="forms-divs">
 <section>
   <div class="form-group">
       <label >Done By</label>
       <input type="text" name="don_by" class="form-control" value="<?php echo "$fnamel  $lnamel"; ?>" id="" placeholder="" readonly="">
   </div>

   <div class="form-group">
       <label >Product</label>
       <select class="form-control" name="product_id" id="productSelect" onchange="selectProduct(this.value)" required="">

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
   </div>



   <div class="form-group">
       <label >Client Name</label>
       <input type="text" name="c_name" class="form-control" value="" id="" placeholder="Client Name" title="Text only" minlength="5" required="" <?php echo $form_text; ?>>
   </div>

      <div class="form-group">
          <label >Maison</label>
          <select class="form-control" name="maison_id" required="">
            <?php
               $maison = retrieve_data('maison_id','selling_e','s_id',$sell_id);
               $maison_name =  retrieve_data('maison_name','maison','maison_id',$maison);
               if ($maison == '0') {
                 echo '<option value="0">None</option>';
               } else {
                 echo "<option value='$maison'>$maison_name</option>";
               }
             ?>
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
   <!-- <div class="form-group">
       <label >Type</label>
       <select class="form-control" name="typ" required="">
         <option value="Addition">Addition</option>
         <option value=""></option>
         <option value="New">New</option>
         <option value="Addition">Addition</option>
       </select>
   </div> -->
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
       <input type="text" name="pr_u_r" class="form-control" value="" onkeyup="CalcPricrF()" title="Use Numbers only" id="Pr_U_R" placeholder="Price Unit (frw)" required="" <?php echo $form_number; ?>>
   </div>
   <div class="form-group">
       <label >Price Total (frw)</label>
       <input type="text" name="pr_t_r" class="form-control att" value="" id="Pr_T_R" placeholder="Price Total (frw)" title="Use Text only" required=""  <?php echo $form_number; ?>>
   </div>
   <div class="form-group">
       <label >Price Unit ($)</label>
       <input type="text" name="pr_u_d" class="form-control"  onkeyup="CalcPricrD()" value="" id="Pr_U_D" placeholder="Price Unit ($)" title="Use Numbers only" required=""  <?php echo $form_number; ?>>
   </div>
   <div class="form-group">
       <label >Price Total ($)</label>
       <input type="text" name="pr_t_d" class="form-control att" value="" id="Pr_T_D" placeholder="Price Total ($)" title="Use numbers only" required="" <?php echo $form_number; ?>>
   </div>


<div class="" id="avanc">
   <div class="form-group">
       <label >Avance (frw)</label>
       <input type="text" name="avance" onkeyup="CalcBalanc()" class="form-control" value="0" id="avance" placeholder="Avance" <?php echo $form_number; ?>>
   </div>
   <div class="form-group">
       <label >Balance (frw)</label>
       <input type="text" name="balance" class="form-control" value="0" id="balance" placeholder="Balance" <?php echo $form_number; ?>>
   </div>
</div>

   <div class="form-group">
       <label >Comment</label>
       <input type="text" name="comment" class="form-control" style="height: 96px;text-align: center;" placeholder="Comment" title="Use Characters only" <?php echo $form_text; ?>>
   </div>

<button type="submit" name="divers_sell" class="btn btn-primary click bg-green-col submit-butt" style="float: right;margin: 14px 0px;" name="button"> <b class="fa fa-shopping-cart"></b> &nbsp; Sell Envitation </button>

            </form>
 </section>
<div class="clear-both">x</div>
</div>





<div class="" style="height:200px;">

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
function selectProduct(val) {
  var infDv = document.getElementById("infDv");
  if (val == '0') {
    infDv.innerHTML = " ";
  } else {
      infDv.innerHTML = "<iframe src='app_data/php/diverInfo.php?id="+val+"' width='100%' height='80px' style='height: 207px;background: transparent;'></iframe>";
  }
}




  function CheckQuantity() {
    var quant = document.getElementById("quantityEnv").value;
    var val = document.getElementById("QuantityTkn").value;

      if (val > quant) {
          // alert("The Quantity Must Not Be grester Than:"+quant);
      }
  }

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
