<?php
    include ('app_data/php/head_no_css.php');
    @$date = $_POST['date'];
    // echo @$date;
    $resultsDB = number_ret("SELECT `id` FROM `deposit` WHERE `date`='$date'");
    // echo $resultsDB;
    $true = 1;

    if ($resultsDB <= 0) {
      echo '
      <button type="submit" name="add_cash" class="btn btn-success fadeInDown animated">Save</button>
      <style> .forms_containner {display:block;}
      .blurl { -webkit-filter: blurl(0px); filter: blurl(0px); }
      </style>
      ';

    } else {
    ?>

      <div class="short-spent-dateils fadeInUp animated">

          <br> <hr>
                <div class="" id="decissionDisplay">Loading</div>

      </div>

      <style>
       .blurl {
         -webkit-filter: blur(5px);
        filter: blur(5px);
       }
      .forms_containner {display:none;}
    </style>
    <script>
       // load_Descission();
       // alert("hahahhhahahkkkkkkk");
    </script>
    <?php
    }



 ?>
