<?php
  include 'app_data/php/head_blank.php';

if (loggedin()) {
  echo "<script>window.open('home.php','_self')</script>";
}

echo "<div>j</div>";

if (isset($_GET['set'])) {
   echo '
   <div class="alert alert-fixed bg-blue ">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
   <h4> <i class="icon fa fa-warning"></i> &nbsp;Please insert Your Username and Password!</h4>
   insert your username and password and try again.
   </div>
   ';
} else if (isset($_GET['wrong'])) {
   echo '
   <div class="alert alert-fixed bg-yellow ">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
   <h4> <i class="icon fa fa-warning"></i>&nbsp; Invalid username and password!</h4>
   if you don\'t have an Account, Please call the Admin.
   </div>
   ';
} elseif (isset($_GET['block'])) {
   echo '
   <div class="alert alert-fixed bg-red ">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
   <h4> <i class="icon fa fa-warning"></i>&nbsp; Your Account is Blocked!</h4>
   Please call the Admin for more info.
   </div>
   ';
}


?>




<div class="log-contain">






<div class="login-box  animated">
  <div class="login-logo">
    <a href="index.php">
      <img src="app_data/imgs/icns/small-lolo-text.png" class="logo-im" alt="" />
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

<form class="" action="app_data/php/actions/login_db.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username" required="">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" style="background: #E91E63;border-color: #E91E63;" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
</form>

    <!-- <a href="#" style="opacity:0;">I forgot my password</a><br> -->
  </div>
  <!-- /.login-box-body -->
</div>



<style media="screen">
 body {
   /*background-color: #444550; */
   background-color: #96113e !important;
   background-image: none;
 }
.logo-im {
  margin-bottom: 9px;
  /*opacity: 0.8;*/
  width: 284px;
}


.form-control {
    border-color: rgba(161, 26, 71, 0.3);
}


.head, .min-header { display: none; }
.containner {
    margin-left: 0;
    width: 100%;
    background: transparent;
    height: 90%;
}

.log-contain {
  position: relative;
max-width: 100%;
min-width: 27em;
padding: 4.5em 3em 3em 3em;
/*background: #ffffff;*/
/*background: #444550;*/
}




/*///////////////////*/

.login-box, .register-box {
    width: 360px;
    margin: 7% auto;
}
.login-logo, .register-logo {
    font-size: 35px;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 300;
}
.login-logo a { color: rgba(255, 255, 255, 0.75); text-decoration: none; }
.login-logo a:hover { color: #fff; text-decoration: none;}

.login-box-body, .register-box-body {
    background: #fff;
    padding: 20px;
    border-top: 0;
    color: #666;
}

.login-box-msg, .register-box-msg {
    margin: 0;
    text-align: center;
    padding: 0 20px 20px 20px;
}
.has-feedback {
    position: relative;
}
.form-control:not(select) {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.form-control {
    border-radius: 0;
    box-shadow: none;
    border-color: #d2d6de;
}
.btn.btn-flat {
    border-radius: 0;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    border-width: 1px;
}

.login-box-body a {
  align:right;
}

body {
  /*background: #121731;*/
}
</style>



<?php include 'app_data\php\foater.php'; ?>
