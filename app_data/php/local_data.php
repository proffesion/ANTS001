<?php

$app_name = "antares";

$time        = time();
$time_now    = date('d-M-Y', $time);
$this_month  = date('M', $time);
$this_year   = date('Y', $time);
$last_month  = date('M', strtotime('-1 month'));
$today       = date('d', $time);

$yesterday       = date('d', strtotime('-1 day'));
$yesterday_date  = "$yesterday-$this_month-$this_year";
$today_date      = "$today-$this_month-$this_year";



if (loggedin()) {
  $username      = user_data_session('username');
  $fnamel        = user_data_session('fname');
  $lnamel        = user_data_session('lname');
  $user_type     = user_data_session('type');
  $user_password = user_data_session('password');
  $special       = user_data_session('special');
  adm_optn($user_type); // give permition to users // .adm-optn


  $admin_style = ' ';
  $admin_tad = ' ';
if ($user_type != '1') {
  echo "<style> .admin { display:none; } </style>";
  $admin_style = 'style="display:none;"';
  $admin_tad = 'display:none;';
}


}

$form_both   = 'pattern="[q,w,e,r,t,y,u,i,o,p,a,s,d,f,g,h,j,k,l,z,x,c,v,b,n,m,Q,W,E,R,T,Y,U,I,O,P,A,S,D,F,G,H,J,K,L,Z,X,C,V,B,N,M,$,0,1,2,3,4,5,6,7,8,9,.,+, ]*"';
$form_text   = 'pattern="[q,w,e,r,t,y,u,i,o,p,a,s,d,f,g,h,j,k,l,z,x,c,v,b,n,m,Q,W,E,R,T,Y,U,I,O,P,A,S,D,F,G,H,J,K,L,Z,X,C,V,B,N,M,$, ]*"';
$form_number = 'pattern="[0,1,2,3,4,5,6,7,8,9,.,+]*"';

$rate_rw_g = retrieve_data('giv_dol_rw','taux','id','1');
$rate_fc_g = retrieve_data('giv_dol_fc','taux','id','1');

$rate_rw_r = retrieve_data('rec_dol_rw','taux','id','1');
$rate_fc_r = retrieve_data('rec_dol_fc','taux','id','1');





//////////////////////////////////////////
//////// PAGES DEFINITION ////////////////
/////////////////////////////////////////

// This allown to hide the javascript code eccept foe the admin homepage
$adminHomePage = 0;



?>
