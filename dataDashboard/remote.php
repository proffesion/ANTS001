<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../app_data/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../app_data/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="/../app_data/css/animate.min.css"> -->
    <link rel="stylesheet" type="text/css" href="../app_data/css/screen_style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/remote.css">
    <link rel="stylesheet" href="../app_data/css/print.css" media="print" title="printing" charset="utf-8">
    <meta name="theme-color" content="#676565">

    <!-- <script type="text/javascript" src="assets/Chart.min.js"></script> -->
    <title>Remote</title>
</head>
<body>






<div class="mainControl">
  <div class="row">
      <div class="col-xs-6">
          <section class="powerBtnSection">
            <button type="button" class="btn btn-default powerBtn" name="button" onclick="return update('lock',0);"> <i class="fa fa-power-off"></i> </button>
          </section>
      </div>
      <div class="col-xs-6">
        <section>
          <label class="dateLabel" id="datePeriod">Loading...</label>
        </section>
      </div>
  </div>

       <div class="sectionButton">
         <h3 class="secctionIcon"> <i class="fa fa-desktop"></i>  <label class="icon_title"> Dashboard</label> </h3>
         <section class="dashboard">
           <button class="dashboard-default" onclick="return update('active','default');">
                <label class="btn-lcd"></label>
                <b>CASH</b>
                <small>dashboard</small>
           </button>

           <button class="dashboard-stock" onclick="return update('active','stock');">
                <label class="btn-lcd"></label>
                <b>STOCK</b>
                <small>dashboard</small>
           </button>

           <button class="dashboard-balance" onclick="return update('active','balance');">
                <label class="btn-lcd"></label>
                <b>BALANCE</b>
                <small>dashboard</small>
           </button>
         </section>
      </div>



      <div class="sectionButton">
        <h3 class="secctionIcon"> <i class="fa fa-money"></i>  <label class="icon_title">Cash Label</label> </h3>
        <section class="cashLabelSection">
          <button name="button" class="btnLabel_Frw" onclick="return update('frw',0);">
               <label class="btn-lcd"></label>
               <b>Frw</b>
          </button>

          <button name="button" class="btnLabel_Dol" onclick="return update('dol',0);">
               <label class="btn-lcd"></label>
               <b>$</b>
          </button>

          <button name="button" class="btnLabel_Fc" onclick="return update('fc',0);">
               <label class="btn-lcd"></label>
               <b>Fco</b>
          </button>

          <br>
          <br>

          <button class="totalB btnLabel_SubTotal" onclick="return update('subTotal',0);">
               <label class="btn-lcd"></label>
               <b>Sub Total</b>
          </button>

          <button class="totalB btnLabel_GrandTotal" onclick="return update('grandTotal',0);">
               <label class="btn-lcd"></label>
               <b>Grand Total</b>
          </button>
        </section>
     </div>








</div>

<div class="dateContentsContainner">

  <div class="sectionButton">
    <h3 class="secctionIcon" style="background: #333333;"> <i class="fa fa-money"></i> <label class="icon_title"> Date Format</label> </h3>
    <section class="dateButtonPeriod">
      <button name="button" class="btnPeriodDay" onclick="return update('period','day');">
           <label class="btn-lcd"></label>
           <b>Day</b>
      </button>

      <button name="button" class="btnPeriodMonth" onclick="return update('period','month');">
           <label class="btn-lcd"></label>
           <b>Month</b>
      </button>

      <button name="button" class="btnPeriodYear" onclick="return update('period','year');">
           <label class="btn-lcd"></label>
           <b>Year</b>
      </button>

    </section>
 </div>


 <div class="sectionButton">
   <section>
     <label class="labelCustomDate" for="customDate">Date</label>
     <input type="date" id="customDate" onchange="return setDate(this.value);" class="dateInput" value="">
   </section>

</div>


</div>
    <input type="hidden" id="SettingsRemote">

    <script src="../app_data/java/charts/Chart.bundle.js"></script>
    <script src="../app_data/java/charts/utils.js"></script>

    <script type="text/javascript" src="../app_data/java/jquery.min.js"></script>
    <script type="text/javascript" src="../app_data/java/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/remote.js"></script>
    <script>



    window.onload = function() {
      loadSettings();

    };

    $(document).ready(function(e) {
      $.ajaxSetup({chache:false});
        setInterval(loadSettings, 2000);

    });
    </script>
</body>
</html>
