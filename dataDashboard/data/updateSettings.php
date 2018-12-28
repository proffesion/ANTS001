<?php
    include_once '../../app_data/php/head_no_css.php'; // connection
    $dashboard_lock   = 0;
    $active_dashboard = 0;
    $dashboard_period = 0;
    $dashboard_frw    = 0;
    $dashboard_fc     = 0;
    $dashboard_dol    = 0;
    $period_d         = 0;
    $period_m         = 0;
    $period_y         = 0;
// UPDATE LOCK SCREEN
if (isset($_GET['lock']) && !empty($_GET['lock'])) {
  $lock = @$_GET['lock'];

  $query = "UPDATE `settings` SET `value`='$lock' WHERE `setting`='dashboard_lock'";
  if ($mysqli->query($query)) {
      $dashboard_lock   = 1;
  } else {
      $dashboard_lock   = 0;
  }
  // echo "hahahahhahaha";
}

// UPDATE ACTIVE LOCK
if (isset($_GET['active']) && !empty($_GET['active'])) {
  $active = @$_GET['active'];

  $query = "UPDATE `settings` SET `value`='$active' WHERE `setting`='active_dashboard'";
  if ($mysqli->query($query)) {
      $active_dashboard   = 1;
  } else {
      $active_dashboard   = 0;
  }
}


// UPDATE ACTIVE PERIOD
if (isset($_GET['period']) && !empty($_GET['period'])) {
  $period = @$_GET['period'];

  $query = "UPDATE `settings` SET `value`='$period' WHERE `setting`='dashboard_period'";
  if ($mysqli->query($query)) {
      $dashboard_period   = 1;
  } else {
      $dashboard_period   = 0;
  }
}

// CASH

// UPDATE ACTIVE frw
if (isset($_GET['frw']) && !empty($_GET['frw'])) {
  $frw = @$_GET['frw'];

  $query = "UPDATE `settings` SET `value`='$frw' WHERE `setting`='dashboard_frw'";
  if ($mysqli->query($query)) {
      $dashboard_frw   = 1;
  } else {
      $dashboard_frw   = 0;
  }
}

// UPDATE ACTIVE frw
if (isset($_GET['fc']) && !empty($_GET['fc'])) {
  $fc = @$_GET['fc'];

  $query = "UPDATE `settings` SET `value`='$fc' WHERE `setting`='dashboard_fc'";
  if ($mysqli->query($query)) {
      $dashboard_fc   = 1;
  } else {
      $dashboard_fc   = 0;
  }
}


// UPDATE ACTIVE frw
if (isset($_GET['dol']) && !empty($_GET['dol'])) {
  $dol = @$_GET['dol'];

  $query = "UPDATE `settings` SET `value`='$dol' WHERE `setting`='dashboard_dol'";
  if ($mysqli->query($query)) {
      $dashboard_dol   = 1;
  } else {
      $dashboard_dol   = 0;
  }
}


// UPDATE ACTIVE frw
if (isset($_GET['dol']) && !empty($_GET['dol'])) {
  $dol = @$_GET['dol'];

  $query = "UPDATE `settings` SET `value`='$dol' WHERE `setting`='dashboard_dol'";
  if ($mysqli->query($query)) {
      $dashboard_dol   = 1;
  } else {
      $dashboard_dol   = 0;
  }
}

// UPDATE ACTIVE TOTAL SUB
if (isset($_GET['subTotal']) && !empty($_GET['subTotal'])) {
  $subTotal = @$_GET['subTotal'];

  $query = "UPDATE `settings` SET `value`='$subTotal' WHERE `setting`='subTotal'";
  if ($mysqli->query($query)) {
      $dashboard_subTotal   = 1;
  } else {
      $dashboard_subTotal   = 0;
  }
}

// UPDATE ACTIVE TOTAL GRAND
if (isset($_GET['grandTotal']) && !empty($_GET['grandTotal'])) {
  $grandTotal = @$_GET['grandTotal'];

  $query = "UPDATE `settings` SET `value`='$grandTotal' WHERE `setting`='grandTotal'";
  if ($mysqli->query($query)) {
      $dashboard_dol   = 1;
  } else {
      $dashboard_dol   = 0;
  }
}

//////////////////////////////////////////////////////////////////////////////////
// UPDATE ACTIVE frw
if (isset($_GET['d']) && !empty($_GET['d'])) {
  $d = @$_GET['d'];

  $query = "UPDATE `settings` SET `value`='$d' WHERE `setting`='period_d'";
  if ($mysqli->query($query)) {
      $period_d   = 1;
  } else {
      $period_d   = 0;
  }
}

// UPDATE ACTIVE frw
if (isset($_GET['m']) && !empty($_GET['m'])) {
  $m = @$_GET['m'];

  $query = "UPDATE `settings` SET `value`='$m' WHERE `setting`='period_m'";
  if ($mysqli->query($query)) {
      $period_m   = 1;
  } else {
      $period_m   = 0;
  }
}

// UPDATE ACTIVE frw
if (isset($_GET['y']) && !empty($_GET['y'])) {
  $y = @$_GET['y'];

  $query = "UPDATE `settings` SET `value`='$y' WHERE `setting`='period_y'";
  if ($mysqli->query($query)) {
      $period_y   = 1;
  } else {
      $period_y   = 0;
  }
}


// echo '
// {
//     "lock":    "'. $dashboard_lock .'",
//     "active":  "'. $active_dashboard .'",
//     "period":  {
//       "type": "'. $dashboard_period .'",
//          "d": "'. $period_d .'",
//          "m": "'. $period_m .'",
//          "y": "'. $period_y .'"
//     },
//     "cash": {
//         "frw": "' . $dashboard_frw . '",
//         "fc":  "' . $dashboard_fc . '",
//         "dol": "' . $dashboard_dol . '"
//     }
// }
// ';
?>
