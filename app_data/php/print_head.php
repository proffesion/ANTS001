<style media="screen">
  .head-print-report {
    background: #9f244e;
    padding: 12px;
  }
  .head-print-report img {
    width: 179px;
    height: 34px;
  }
  .head-print-report table { width: 100%; background-color: transparent; border: 0px; box-shadow: none; }
    .head-print-report table label {
          color: #fff;
          padding: 0px 10px;
          font-size: 18px;
    }
   .print-report-contain {
     min-width: 100%;
   }
</style>
<div class="print-report-contain">

<div class="head-print-report">
  <table border="0" style="border:0px;" width="100%">
    <tr>
      <td>
   <img src="app_data/imgs/icns/antares_black.png" alt="" style="width: 179px;height: 34px;" />

      </td>
      <td align="right">
   <label for="" > <b class="fa fa-calendar"></b> <?php echo $time_now; ?> </label>

      </td>
    </tr>
  </table>
</div>
  <hr>

<p id="dispHead" style="font-size: 35px; margin: auto; width: 100%; text-align: center;/* margin-top: 17px;*/ margin-bottom: 5px; border: 0px; font-weight: bold;margin: 0px;"> REPORT </p>


<br>
<br>
</div>
<style media="screen">
  .print-report-contain {
    display: none;
    width: 100%;
  }
</style>
