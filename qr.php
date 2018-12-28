<?php
include 'app_data/php/head_iframe.php';
$env_id = @$_GET['code'];
$query_Found = "SELECT `e_id` FROM `env_stock` WHERE `e_id`='$env_id'";

if (isset($env_id) && !empty($env_id)) {

  if (number_ret($query_Found) != 0) { # code...

   $sizeW = fileData('size_w',$env_id);
   $sizeH = fileData('size_h',$env_id);
?>

<div class="containner">

<div class="fadeInDown animated">
    <img src="envit/<?php echo fileData('img',$env_id); ?>" class="img img-responsive productImage"alt="">
</div>
<div class="fadeInUp animated contentsTextInfo">
  <h3> <label style="color: #9E9E9E;">Code</label> <b><?php echo fileData('e_id',$env_id); ?></b> </h3>
  <section>
    <table border="0" class="table table-striped table-responsive">
      <tr>
        <td class="lab" style="width:50%;" >Color</td>
        <td class="val"> <?php echo fileData('env_color',$env_id); ?> <label class="color-label" style="background:<?php echo fileData('env_color',$env_id); ?>;">x</label> </td>
      </tr>
      <tr>
        <td class="lab">Paper size</td>
        <td class="val"> <?php echo $sizeW; ?>cm X <?php echo $sizeH; ?>cm </td>
      </tr>
      <tr>
        <td class="lab">Price Frw</td>
        <td class="val"> <?php echo fileData('price_r',$env_id); ?> frw &nbsp;&nbsp; | &nbsp;&nbsp; <?php echo fileData('price_d',$env_id); ?>$ </td>
      </tr>
      <!-- <tr>
        <td class="lab">Place</td>
        <td class="val" style="color:green;"> <?php echo fileData('place',$env_id); ?> </td>
      </tr> -->
    </table>
<hr style="margin: 7px 0px; ">

<div class="PlaceInv">
  <div class="row">
    <div class="col-xs-10" style="padding:0;">
      <input type="text" value="<?php echo fileData('place', $env_id); ?>" id="LocationText" onkeyup="return lEdit();">
      <button type="button" onclick="return cancerUpdate();"  class="btn btn-danger hide lCancer"> <i class="fa fa-close"> Cancel</i> </button>
    </div>
    <div class="col-xs-2" style="padding:0;">
      <button type="button" class="btn loading hide btnBig"> <i class="fa fa-spinner animated rotateIn infinite"></i> </button>
      <button type="button" class="btn btn-info lEdit btnBig"> <i class="fa fa-edit"></i> </button>
      <button type="button" onclick="return updateLocation();" class="btn btn-success hide lSave btnBig"> <i class="fa fa-save"></i> </button>
    </div>
  </div>
</div>
<hr>
    <div class="stock-inv">
      <label>Stock</label>
      <h2><?php echo fileData('quantity',$env_id); ?></h2>
    </div>

    <div class="comment">
      <hr>
      <b>Comment</b>
      <p><?php echo fileData('comment',$env_id); ?></p>
    </div>

  </section>
  <hr>






  <h3 style="background: #650b29;padding: 12px;font-size: 18px;color: #fff;text-transform: uppercase;text-align: center;">Last Printed</h3>

  <ul class="sell-home-list-ul" style="background: rgba(40, 46, 54, 0.75);">
   <?php
   $empty = '0';
    $results = $mysqli->query("SELECT `e_id`,`e_id`,`quantity`,`client_name`,`date` FROM `selling_e` WHERE `e_id`='$env_id' ORDER BY `s_id` DESC LIMIT 10");
    if ($results->num_rows == NULL) {
      $empty = '1';
    } else {

        while($row = $results->fetch_array()) {
          @$s_id = $row["s_id"];
          @$e_id = $row["e_id"];
          @$quantitye = $row["quantity"];
          @$datee = $row["date"];
          @$client_name = $row["client_name"];
    ?>

    <li onclick="sellDetails(<?php echo $s_id; ?>)" style="background: rgba(165, 61, 96, 0.98);">
   <h4> <b><?php echo @$e_id; ?></b> &nbsp; <?php echo @$client_name; ?></h4>
     <b class=""><?php echo @$datee; ?></b>
   <label>Quantity: <b><?php echo @$quantitye; ?></b></label>
    </li>
    <?php
        }

    }

     ?>
  <!-- </ul> -->


</ul>























</div>
</div>




<?php

} else {
  // not found in stock
?>
<div class="">
  <div class="search-null-result">
    <h1 class="shake animated fa fa-frown-o" style="color:#ababab"></h1> <br>
    <br>
    <h3 style="color:#ababab"> Not Found! </h3>
     <p style="color:#ababab"> Try to scan usin an other invitation </p>
  </div>
</div>
<?php
}

} else {
  ?>
  <div class="">
    <div class="search-null-result">
      <h1 class="zoomIn animated fa fa-qrcode" style="color:#ababab"></h1> <br>
      <br>
      <h3 style="color:#ababab"> Try again </h3>
       <p style="color:#ababab">
         <br>
         Try to scan the <b>Qr</b> code clear <br>
        Or the <b>Qr</b> must contain errors
  </p>
    </div>
  </div>
  <?php
}

?>
<!-- /////////////////////// SEARCH DIV //////////////////////// -->
<div class="headeru">
    <img src="app_data/imgs/icns/small-lolo-text.png" alt="ANTARES">
    <label class="searchButton show"><i class="fa fa-search"></i></label>
    <label class="searchButtonClose hide"><i class="fa fa-close "></i></label>
</div>
<!-- ///////////////// SEARCH CONTAINNER //////////////////// -->
<div class="search-Div hide">
  <section>
    <input type="number" class="searchInput" id="search_text" onkeyup="return findmatch();" value="">
  </section>
  <div id="serchresult"></div>
</div>






<div id="errorPopContainner"></div>

<script type="text/javascript" src="app_data/java/jquery.min.js"></script>
<script>



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// SEARCH BUTTON
$('.searchButton').on('click', function() {
  $('.search-Div').addClass('show'); // main div
  $('.search-Div').removeClass('hide'); // main div

  $('.searchButton').addClass('hide'); // hide search
  $('.searchButton').removeClass('show'); // hide search
  $('.searchButtonClose').removeClass('hide'); // show close
  $('.searchButtonClose').addClass('show'); // show close
});


// CLOSE BUTTON
$('.searchButtonClose').on('click', function() {
  $('.search-Div').addClass('hide'); // main div
  $('.search-Div').removeClass('show'); // main div
  $('.search-Div').hide(); // main div

  $('.searchButtonClose').removeClass('show'); // hide search
  $('.searchButtonClose').addClass('hide'); // hide search
  $('.searchButton').removeClass('hide'); // show close
  $('.searchButton').addClass('show'); // show close
});



function findmatch() { // ajax for search
  var search_text = document.getElementById('search_text');

  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
  }

xmlhttp.onreadystatechange = function() {
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    document.getElementById('serchresult').innerHTML = xmlhttp.responseText;
  }
}
xmlhttp.open('GET', 'qr_search.php?search_text='+search_text.value, true);
xmlhttp.send();
}


// DESIGN DATA
// CLOSE BUTTON
$('.lEdit').on('click', function() {
    lEdit();
});

$('.lCancer').on('click', function() {
  // hide - save button
  $('.lSave').addClass('hide');
  $('.lSave').removeClass('show');

  // hide - cancer button
  $('.lCancer').addClass('hide');
  $('.lCancer').removeClass('show');

  // hide - edit button
  $('.lEdit').addClass('show');
  $('.lEdit').removeClass('hide');

  $('#LocationText').removeClass('editL');
});


function lEdit() {
    // show - save button
  $('.lSave').addClass('show');
  $('.lSave').removeClass('hide');

  // show - cancer button
  $('.lCancer').addClass('show');
  $('.lCancer').removeClass('hide');

  // hide - edit button
  $('.lEdit').addClass('hide');
  $('.lEdit').removeClass('show');

  // checnge textBoxe
  $('#LocationText').addClass('editL');
}

function cancerUpdate() {
  var oldValue = '<?php echo fileData('place', $env_id); ?>';
  document.getElementById('LocationText').value = oldValue;
}


function updateLocation() {
  // data
  var id       = <?php echo @$env_id; ?>;
  var value    = document.getElementById('LocationText').value;
  var oldValue = '<?php echo fileData('place', $env_id); ?>';

  if (oldValue != value) { // check if the values are the same
      $('.lCancer').addClass('show');
      $('.loading').removeClass('hide'); $('.loading').addClass('show'); // show loading
      $('.lSave').addClass('hide'); $('.lSave').removeClass('show'); // hide - save button
      $('.lCancer').addClass('hide'); $('.lCancer').removeClass('show'); // hide - cancer button

      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'qr_stockUpdate.php?id='+id+'&value='+value, true);

      xhr.onload = function() {
        var result = JSON.parse(this.responseText);

        $('.loading').removeClass('show'); $('.loading').addClass('hide'); // hide the loading
        $('.lEdit').addClass('show'); $('.lEdit').removeClass('hide'); // hide - edit button
        $('#LocationText').removeClass('editL'); // checnge textBoxe

        message(result.message, result.success);

        if (result.success == 1) {
          document.getElementById('LocationText').value = result.data;
        }

      }
      xhr.send();

    } else {
         message('Nothing changed!');
    }
}




// message('body');




// used to display errors
function message(body, type = 0) {
    var ErrorContainner = document.getElementById('errorPopContainner');
    if (type == '1') {
        ErrorContainner.innerHTML += `
      <div class="alert alert-success alert-dismissible fadeInDown animated" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Well done!</strong> ${body}
      </div>
    `;
    } else {
        ErrorContainner.innerHTML += `
      <div class="alert alert-warning alert-dismissible fadeInDown animated" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong>  ${body}
      </div>
    `;
    }

    setInterval(function () {
        // $('#LocationText').removeClass('editL'); // checnge textBoxe
        ErrorContainner.innerHTML = '';
    }, 5000);
}


</script>

<!-- .table-bordered   -->

<style media="screen">
.btnBig {
  height: 48px;
  width: 100%;
  font-size: 24px;
  margin-left: 0px;
}
#LocationText {
  width: 100%;
  padding: 4px 7px;
  font-size: 25px;
  margin: 0;
  border: 3px solid #bd0342;
  color: #bd0342;
  font-weight: bold;
  border-radius: 5px;
  text-transform: uppercase;
}

.row {
  margin: 0px;
}

#errorPopContainner {
    position: fixed;
    top: 47px;
    right: 0px;
    left: 0px;
}

.editL {
  border: 3px solid blue !important;
  color: blue !important;
}

#serchresult {
  margin-top: 10px;
}
.search-result-row {
    font-size: 25px;
    background: #008449;
  }

  .search-result-row b { font-size: 25px; }

  .containner {
    margin-top: 45px;
  }

.headeru {
      text-align: center;
      background-color: #bd0342;
      padding: 9px;
      position: fixed;
      right: 0px;
      left: 0px;
      top: 0px;
      z-index: 1111111111111111111111111;
  }

 .headeru img {
    width: 137px;
  }

.productImage {
  width: 100%;
  margin: auto;
}

.contentsTextInfo {
  width: 95%;
  margin: auto;
  margin-top: 12px;
}

.table {
      border: none;
      box-shadow: none;
}

.color-label {
  background: white;
  width: 33px;
  margin-left: 10px;
  border-radius: 6px;
  border: 1px solid #333333a1;
  color: transparent;
  box-shadow: 0px 0px 3px black;
  margin-bottom: 0px;
}

.val {
  font-weight: bold;
}

.stock-inv {
  border: 2px solid #018001;
  border-radius: 7px;
  margin: 0px 22px;
  padding: 6px 14px;
}
.stock-inv label {
  color: green;
  text-transform: uppercase;
  font-weight: bold;
  display: block;
  margin-top: -18px;
  font-size: 16px;
  background: #f8f9fa;
  padding: 3px 7px;
  width: 74px;
}
.stock-inv h2 {
  color: green;
  font-weight: bold;
  font-size: 48px;
  margin-top: -8px;
}

.comment {
  margin: 0px 0px 22px 0px;
  padding: 7px 9px;
}
.comment b {
  font-size: 18px;
  color: #bd0342;
  font-weight: inherit;
}
.comment p {
      margin-top: 4px;
}

.searchButton, .searchButtonClose {
    display: block;
    color: #fff;
    font-size: 22px;
    position: fixed;
    top: -6px;
    right: 3px;
    padding: 14px 15px;
}

.search-Div {
  background: rgba(255, 255, 255, 0.8313725490196079);
  position: fixed;
  top: 32px;
  padding: 22px 5px 17px 5px;
  right: 0;
  left: 0;
  height: 96vh;
}

.searchInput {
  width: 100%;
  height: 39px;
  border: 3px solid #bd0342;
  font-size: 24px;
  padding: 0px 8px;
  color: #bd0342;
}
</style>
</body>
