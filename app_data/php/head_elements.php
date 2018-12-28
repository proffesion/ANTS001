


<!-- 
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////     COMVERTER POP UP    ////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  this contain a html element of 
     - popup Conveter
     - popup overlay
 
 -->

<div id="Conveter" class="modal fade" role="dialog">
  <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header"> <b class="modal-title">Balance</b>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
       <div class="modal-body" style="padding:0px;">
   <!-- <section class="headPopReportnav">
     <b class="fa fa-file-text" style="font-size: 49px;"></b>
   </section> -->

   <div class="" style="padding:10px;">
       <form>

     <div class="row">
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <div class="input-group">
              <span class="input-group-addon">Rate Frw</span>
               <input type="text" id="inRateRw" class="form-control">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group has-feedback">
            <div class="input-group">
              <span class="input-group-addon">Rate Fco</span>
               <input type="text" class="form-control" id="inRateFc">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
      </div>

    <div class="form-group">
      <label>Type</label><br>
        <select class="form-control" id="chang_typ" onchange="return checkSet()" name="">
          <option value="r">Receive</option>
           <option value="g">Give</option>
        </select>
    </div>

     <div class="form-group">
          <label>From</label><br>
             <select class="form-control" id="from_sel" style="float:left;width:30%;">
               <option value="dol">Dolar</option>
               <option value="rw">Rwanda</option>
               <option value="fc">Congo</option>
             </select>
          <input type="text" id="from_t" class="form-control"  style="float:left;width:70%;">
          <section class="clear-both">xx</section>
      </div>


      <div class="form-group">
           <label>To</label><br>
              <select class="form-control" id="to_sel" onchange="return check()" style="float:left;width:30%;">
                <option value="dol">Dolar</option>
                <option value="rw">Rwanda</option>
                <option value="fc">Congo</option>
              </select>
           <input type="text" name="" id="to_t" class="form-control"  style="float:left;width:70%;font-weight: bold;font-size: 16px;color: #009b54;">
           <section class="clear-both">xx</section>
       </div>
   </div>

       </div>
       <div class="modal-footer">
         <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
       <button type="button" onclick="check()" class="btn btn-default btn-primary">Convert</button>

       </form>
       </div>
     </div>
  </div>
</div>



<!-- <img src="app_data/imgs/icns/loading29.gif" class="loading-img fadeIn animated" alt="" /> -->

<div class="Overlay-Close-Pop fadeIn animated">  <!-- pop-it --></div> 
