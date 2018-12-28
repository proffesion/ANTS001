<?php

@$current_file = $_SERVER['SCRIPT_NAME'];  # it echo the page or the link of the page that we are working on

@ob_start ();  #it work with the header command
@session_start ();  # it work with thw sessein of id

$app_name = "<b>OFFICE</b>App";  // the name of the app
@$user_id = $_SESSION['user_id'];

?>
