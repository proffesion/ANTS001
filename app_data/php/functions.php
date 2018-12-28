<?php


function number_ret($Q)
{
  global $mysqli;
  $result = $mysqli->query($Q);
  return $result->num_rows;
}


/// SELECT SINGLE row
function Sdata_db($table, $value)
{
  global $mysqli;
  $result = $mysqli->query("SELECT `$value` FROM `$table` LIMIT 1");
  if($result->num_rows > 0){
   return $result->fetch_object()->name;
 } else {
   return false;
 }
}


/// SELECT SINGLE row
function fineName($value)
{
  global $mysqli;
  $result = $mysqli->query("SELECT `file_name` FROM `files` WHERE `file_id` ='$value' LIMIT 1");
  if($result->num_rows > 0){
   return $result->fetch_object()->file_name;
 } else {
   return false;
 }
}

function fileData($value,$id)
{
  global $mysqli;
  $result = $mysqli->query("SELECT `$value` FROM `env_stock` WHERE `e_id` ='$id' LIMIT 1");
  if($result->num_rows > 0){
   return $result->fetch_object()->$value;
 } else {
   return false;
 }
}



/// SELECT SINGLE row
function user_data_session($value)
{
  global $mysqli;
  global $user_id;
  $result = $mysqli->query("SELECT `$value` FROM `users` WHERE `user_id`='$user_id'");
  if($result->num_rows > 0){
   return $result->fetch_object()->$value;
 } else {
   return false;
 }
}

/// SELECT SINGLE row with id table
function user_data_id($value,$table,$id)
{
  global $mysqli;
  // global $user_id;
  $result = $mysqli->query("SELECT `$value` FROM `$table` WHERE `user_id`='$id'");
  if($result->num_rows > 0){
   return $result->fetch_object()->$value;
 } else {
   return false;
 }
}


// retrieve_data($value,$table,$tid,'id')
function retrieve_data($value,$table,$tid,$id)
{
  global $mysqli;
  // global $user_id;
  $result = $mysqli->query("SELECT `$value` FROM `$table` WHERE `$tid`='$id'");
  if($result->num_rows > 0){
   return $result->fetch_object()->$value;
 } else {
   return false;
 }
}

// retrieve_data($value,$table,$tid,'id')
function query_return_value($query, $value)
{
  global $mysqli;
  // global $user_id;
  $result = $mysqli->query($query);
  if ($result->num_rows > 0) {
    return $result->fetch_object()->$value;
  } else {
    return false;
  }
}



// function SumValue($query,$name) {
//   global $mysqli;
//   $results = $mysqli->query($query);
//
//   if ($results->num_rows == NULL) {
//       return 0;
//   } else {
//       while($row = $results->fetch_array()) {
//            $value = $row["$name"];
//            $total += $value;
//       }
//       return $total;
//   }
// }

function Summ_data($query,$val_c) {
  global $mysqli;
  $results = $mysqli->query($query);
  if ($results->num_rows == NULL) { echo "0"; } else {
      while($row = $results->fetch_array()) {
           $name = $row["SUM(`$val_c`)"];
           if ($name == 0) {
             return '0';
           } else {
            return $name;
           }
        }
  }
}

// check for the user login
function loggedin() {
   if (isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])) {
     return true;
   } else {
     return false;
   }
}
// security function
function secured()
{
  if (!loggedin()) {
    echo "<script>window.open('login.php','_self')</script>";
  }
}

function userExists($user) {
  if (number_ret("SELECT `user_id` FROM `users` WHERE `user_id` = '$user'") == 0) {
    return false;
  } else {
    return true;
  }
}

function admin_page()
{
  global $user_type;
  if ($user_type != '1') {
    echo "<script>window.open('home.php','_self')</script>";
  }
}

function special_page()
{
  global $special;
  if ($special != '1') {
    echo "<script>window.open('home.php','_self')</script>";
  }
}

function isAdmin() {
  global $user_type;
  if ($user_type == '1') {
    return true;
  } else {
    return false;
  }
}

function isSpecial() {
  global $special;
  if ($special == '1') {
    return true;
  } else {
    return false;
  }
}


// user type function
function userType($value)
{
  if ($value == '1') {
     return 'Administrator';
  } else {
    return 'User';
  }
}

// user type function
function userPerm($value)
{
  if ($value == '1') {
     return 'Allow';
  } else {
    return 'Blocked';
  }
}

function userGender($value)
{
  if ($value == "M") {
     return "Male";
  } else if ($value == "F") {
     return "Female";
  }
}

// check if id exist in envitations
function CheckIdExist($value)
{
    global $mysqli;
    $result = $mysqli->query("SELECT `e_id` FROM `env_stock` WHERE `e_id`='$value'");
    if($result->num_rows > 0){
      return true;
    } else {
      return false;
    }
}


function CheckproductExist($value)
{
    global $mysqli;
    $result = $mysqli->query("SELECT `pro_name` FROM `products` WHERE `pro_name`='$value'");
    if($result->num_rows > 0){
      return true;
    } else {
      return false;
    }
}


// for displaying the profile
function display_profile($value)
{
  global $mysqli;
  $location = "app_data/imgs/profile";
  $result = $mysqli->query("SELECT `profile` FROM `users` WHERE `user_id`='$value'");
  if($result->num_rows > 0){
   $image = $result->fetch_object()->profile;
  //  echo $image;
   $photo = "$location/$image";
   $default = "$location/default.jpg";

   if ($image != NULL) {
       if (file_exists("$location/$image")) {
          echo $photo;
       } else {
          echo $default;
       }
   } else {
         echo $default;
   }

 } else {
    echo "$location/error.png";
 }
}



// fsignature
function display_signature($value)
{
  global $mysqli;
  $location = "app_data/imgs/sgnc";
  $result = $mysqli->query("SELECT `signature` FROM `signature` WHERE `user_id`='$value'");
  if ($result->num_rows > 0) {
    $image = $result->fetch_object()->signature;
  //  echo $image;
    $photo = "$location/$image";
    $default = "$location/not.png";

    if ($image != null) {
      if (file_exists("$location/$image")) {
        echo $photo;
      } else {
        echo $default;
      }
    } else {
      echo $default;
    }

  } else {
    echo "$location/not.png";
  }
}


// for displaying the profile
function display_profile_path($value,$path)
{
  global $mysqli;
  $locationn = "app_data/imgs/profile";

  $location = $path;
  $default_location = $path;
  $result = $mysqli->query("SELECT `profile` FROM `users` WHERE `user_id`='$value'");
  if($result->num_rows > 0){
   $image = $result->fetch_object()->profile;
  //  echo $image;
   $photo = "$location/$image";
   $default = "$path/default.jpg";

   if ($image != NULL) {
       if (file_exists("$locationn/$image")) {
          echo $photo;
       } else {
          // echo $default;
          echo $photo;
       }
   } else {
         echo $default;
        //  echo $photo;

   }

 } else {
    echo "$default_location/error.png";
 }
}



// give permitions to users
function adm_optn($value)
{
     global $edit;
     global $is_admin;
   if ($value == '1') {
     $edit = " ";
     $is_admin = "1";
   } else {
     echo "<style> .adm-optn { display:none; } </style>";
     $edit ="disabled";
     $is_admin = "0";


   }
}


function ErrorDisplayTaype($value) {
if ($value == 'I') {
   $type = 'Invitation';
} elseif ($value == 'D') {
   $type = 'Divers';
}
  return $type;
}



        // rete function
        function change_rate_receive_php($rw, $co, $from, $to, $amount) {
            // dol -> dolar
            //  fc -> congolais
            //  rw ->  rwandans
            if ($from == 'dol' && $to == 'fc') { // (1)
                return $amount * $co; // formula

            } else if ($from == 'dol' && $to == 'rw') { // (2)
                return $amount * $rw; // formula

            } else if ($from == 'fc' && $to == 'dol') { // (3)
                return $amount / $co; // formula

            } else if ($from == 'fc' && $to == 'rw') { // (4)
                return ($amount / $co) * $rw;

            } else if ($from == 'rw' && $to == 'dol') { // (5)
                return $amount / $rw; // formula


            } else if ($from == 'rw' && $to == 'fc') { // (6)
                return ($amount / $rw) * $co; // formula

            }
        }


function CashToFrw($rateFrw, $rateFco, $cashType, $amount) {
  $outCash = 0;
  if ($cashType == 'fc') { // congo
    $outCash = change_rate_receive_php($rateFrw, $rateFco, 'fc', 'rw', $amount);

  } else if ($cashType == 'dol') { // dolar
    $outCash = change_rate_receive_php($rateFrw, $rateFco, 'dol', 'rw', $amount);

  } else if ($cashType == 'frw') { // rwandans
    $outCash = $amount;

  } // ---

  return $outCash;

  // change_rate_receive_php($rw, $co, $from, $to, $amount)
}

function foFixed($value)
{
  return number_format((float)$value, 2, '.', '');
}

function toFixed($value)
{
  return number_format((float)$value, 2, '.', '');
}

function sum_Of_OneVal ($query,$val) {
  global $mysqli;
  $results = $mysqli->query($query);
  if ($results->num_rows == NULL) {
       return 0;
  } else {

      while($row = $results->fetch_array()) {
            @$quantity = $row["$val"];
            @$total_quantity += $quantity; // incrementing the value
      }
      return $total_quantity;
  }
}

// this format the money
function money($money) {
  return number_format($money,2);
}




function setSelsTotal($datePeriod,$totalPerc,$table,$value) {
    $total   = Summ_data("SELECT SUM(`$value`) FROM `$table` WHERE `date` LIKE '%$datePeriod%'",$value);
    @$result = @round(($total / $totalPerc) * 100);
    return $result;
}

?>
