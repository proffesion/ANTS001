<?php
include 'app_data/php/head.php';
?>
<div class="contents-div">
  <div class="contents-iframe">

      <section class="header-div-sec">
        <h2> Chart Test </h2>
      </section>

    <div class="secton-contents-containner">



<div class="chart-contain scroll">
    <div class="group">

<?php  for ($i=0; $i < 8; $i++) {  ?>
        <!-- b -->

      <div class="chart-set">
      <b>hello</b>
        <div class="progress progress-xs slideInLeft animated">
        <div class="progress-bar progress-bar-success" style="width: 90%"></div>
        </div>

        <div class="progress progress-xs slideInLeft animated">
        <div class="progress-bar progress-bar-warning" style="width: 40%"></div>
        </div>

        <div class="progress progress-xs slideInLeft animated">
        <div class="progress-bar progress-bar-danger" style="width: 20%"></div>
        </div>
      </div> <!-- chart-set -->
<?php } ?>

    </div> <!-- .group -->
</div> <!-- .chart-contain scroll -->

<section style=" background: #bbffe0; border-top: 2px solid #8ca08c;">
<div class="color-mean-chart fading-containner">
  <section style="background: #5cb85c;" class="fading-item"> <b>Sells</b> </section>
  <section style="background: #f0ad4e;" class="fading-item"> <b>Design</b> </section>
  <section style="background: #d9534f;" class="fading-item"> <b>Invitation</b> </section>
  <div class="clear-both">x</div>
</div>
</section>


<section style="" class="chart-table-contain">
<h2>Table Data</h2>

<table border="1" class="table table-bordered">
    <tbody>
      <tr>
        <!-- <th width="33px;">&nbsp; </th> -->
        <th> # </th>
        <th> Date </th>
        <th> item </th>
        <th> item_id </th>
        <th> sell_id </th>
        <th> balance </th>
        <th> payed_in </th>
        <th> client_name </th>
        <th> closed </th>
      </tr>

  <!-- onclick="sellDetails()" -->

<!-- `balance_id`, `date`, `item`, `item_id`, `sell_id`, `balance`, `comment`, `client_name`, `payed_in`, `closed` -->
  <tr class="a">
    <td> 2 </td>
    <td> 19-Mar-2017 </td>
    <td> Invitation </td>
    <td> 1672 </td>
    <td> 29 </td>
    <td> 1200 </td>
    <td> Rfw </td>
    <td> kamariza </td>
    <td> No </td>
   </tr>
  <!-- onclick="sellDetails()" -->

<!-- `balance_id`, `date`, `item`, `item_id`, `sell_id`, `balance`, `comment`, `client_name`, `payed_in`, `closed` -->
  <tr class="b">
    <td> 1 </td>
    <td> 16-Mar-2017 </td>
    <td> Invitation </td>
    <td> 1672 </td>
    <td> 29 </td>
    <td> 1000 </td>
    <td> Rfw </td>
    <td> 0 </td>
    <td> Yes </td>
   </tr>
     <!-- <tr> <th> # </th> <th> E-id </th> <th> Type </th> <th> Date </th> <th> Quantity </th> <th> Pay in </th> <th> closed </th> <th> PU Rfw </th> <th> PT Rfw </th> <th> PU $ </th> <th> PT $ </th> <th> Avance </th> <th> Balance </th> <th> Client Name </th> <th> Done By </th> </tr> -->
  </tbody></table>
</section>




    </div><!-- .secton-contents-containner -->

  </div><!-- .contents-iframe -->
</div><!-- .contents-div -->


</div><!-- .containner -->
</div><!-- .main-containner -->
<?php include 'app_data/php/foater.php' ?>
