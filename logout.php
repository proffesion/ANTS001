<?php
@session_start ();
session_destroy();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
      <meta http-equiv="refresh" content="1; url=login.php"/>
  </head>
  <body>

    <img src="app_data/imgs/icns/loading29.gif" class="img-load" alt="" />

<style media="screen">
  body { background: #96113e; }
  .img-load {
    position: fixed;
    top: 0px;
    bottom: 0px;
    right: 0px;
    left: 0px;
    margin: auto;
    width: 41px;
  }
</style>

  </body>
</html>
