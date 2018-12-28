<?php
  include_once '../connect.php';
  include_once '../core_data.php';
  include_once '../functions.php';
  include_once '../local_data.php';




  if (isset($_POST['login']) && !empty($_POST['username'])  && !empty($_POST['password']) ) {
    @$user = $_POST['username'];
    @$pass = $_POST['password'];
    @$pass_h = md5($pass);

    $query = "SELECT `user_id`, `username`, `password`, `perm` FROM `users` WHERE `username` = '$user' AND `password` = '$pass_h' LIMIT 1";
    /// SELECT SINGLE row

    $results = $mysqli->query($query);
    if ($results->num_rows == NULL) {
         echo "<script> window.open('../../../login.php?wrong','_self'); </script>";
    } else {
        while($row = $results->fetch_array()) {
          @$username = $row["username"];
          @$password = $row["password"];
          @$perm = $row["perm"];
          @$user_id = $row["user_id"];
        }
    }

    // check user
    if ($user == $username && $pass_h == $password) {
         // check if is active
         if ($perm == '1') {
            // time
            @$time = time();
            @$date_now = date('d/m/Y', $time);
            @$time_now = date('H:m: s', $time);

            $tim = $time_now.' -- '.$date_now;
            $mysqli->query("UPDATE `users` SET `last_log` = '$tim' WHERE `user_id`='$user_id'");
           echo '<head> <meta http-equiv="refresh" content="1; url=../../../home.php"/> </head>';

          //  start a session
          $_SESSION['user_id']=$user_id;

          //  echo '
          //  <style media="screen"> body { /* background-color: #444550; */ } .loading { width: 42px; height: 42px; position: fixed; top: 0px; right: 0px; left: 0px; bottom: 0px; margin: auto; } </style>
          //  <div class="loading"> <img src="../../imgs/icns/loading29.gif"> </div>
          //  ';

         } else {
           echo "<script> window.open('../../../login.php?block','_self'); </script>";
         }

    } else {
        echo "<script> window.open('../../../login.php?wrong','_self'); </script>";
    }



  } else {
       echo "<script> window.open('../../../login.php?set','_self'); </script>";
  }


  echo '
  <div class="loading"> <img src="../../imgs/icns/loading29.gif"> </div>
  ';


?>

<!-- <img src="../../imgs/icns/loading29.gif" class="loading-img-view  animated" alt="" /> -->
  <style media="screen">
   body {
    background-color: #8c103a;
 }

  .loading {
    width: 61px;
    height: 61px;
    position: fixed;
    top: 0px;
    right: 0px;
    left: 0px;
    bottom: 0px;
    margin: auto;
  }

  .loading img {
      width: 100%;
      height: 100%;
  }


   </style>
