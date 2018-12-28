<?php

$mysqli = new mysqli("localhost", "root", "", "antares_db");
if (@mysqli_connect_error()) {
  // echo mysqli_connect_error(); exit;
?>
<style media="screen">
  .err_cont { position: fixed; top: 0px; bottom: 0px; right: 0px; left: 0px; background: #be1951;}
  .err_cont .messg_err { width: 483px; background: #fff; margin: auto; padding: 22px 27px 39px 36px; height: 293px; margin-top: 12vh; font-size: 20px;}
  .main-containner { display: none; }
</style>

   <div class="err_cont">

     <div class="messg_err">
         <h2 style="font-size:42px;color:#be1951;">Oooppss!</h2>
         The <b>System</b> is not <br>
         <u>Connected to the database!</u> <br>
     </div>

   </div>

<?php
 die();
}

?>
