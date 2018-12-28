
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>add products</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="iecss.css" />
<![endif]-->
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>

<div id="main_container">  <!-- this is the header div -->
<style>
  .new_conatinner p {
  	margin: auto;
  }
</style>


      <?php
      $time = time();
      $time_now = date('Y-m-d', $time);
      echo $time_now;
      echo "<br>";

      if (isset($_POST['add_product'])) {
           $date = $_POST['date'];
           echo $date;
           echo "<hr>";
      }


?>







<div class="new_conatinner"><!-- this is the start of contents -->

<div class="form_style">

<form class="upload_fields" action="test.php" method="post" enctype="multipart/form-data">
    Product Image: <br>
    <input type="date" name="date" class="input_form" required><br><br>
    <input type="submit" name="add_product" class="subm_form" value="Add">
</form>
    <!-- </div> -->
    <!-- end of center content -->



  </div>
  <!-- end of main content -->
</div>
<!-- end of main_container -->
</body>
</html>
