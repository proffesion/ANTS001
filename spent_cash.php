
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Expenses</h4>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-md-6 insert-details">
                <!-- <h4>Add Spent</h4> -->
                <section>
                  <div class="" id="display_section">
                  </div>

                    <p>
                      <b>Date</b> <br>

                      <section class="date-section">
                      <select class="form-control-date color_black" onchange="return loadDoc('a');" name="date_d" id="date_doo">
                          <option value="<?php echo @$today; ?>"><?php echo @$today; ?></option>

                          <optgroup>
                              <?php
                                for ($i= 1; $i <= 31; $i++) {
                                  if ($i <= 9) { $comp = "0"; } else { $comp = ""; }
                                  echo "<option value='$comp$i'>$comp$i </option>";
                                }
                              ?>
                          </optgroup>
                    </select>

                    <select class="form-control-date color_black" onchange="return loadDoc('a');" name="date_m" id="date_moo" required="">
                          <option value="<?php echo @$this_month; ?>"><?php echo @$this_month; ?></option>
                          <optgroup>
                              <option value="Jan">January</option>
                              <option value="Feb">Febuary</option>
                              <option value="Mar">March</option>
                              <option value="Apr">April</option>
                              <option value="May">May</option>
                              <option value="Jun">June</option>
                              <option value="Jul">July</option>
                              <option value="Aug">August</option>
                              <option value="Sep">September</option>
                              <option value="Oct">October</option>
                              <option value="Nov">November</option>
                              <option value="Dec">December</option>
                          </optgroup>
                    </select>

                    <select class="form-control-date color_black" onchange="return loadDoc('a');" name="date_y" id="date_yoo" required="">
                          <option value="<?php echo @$this_year; ?>"><?php echo @$this_year; ?></option>
                          <optgroup>
                              <?php
                                for ($i= 2010; $i <= $this_year; $i++) {
                                  echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                              ?>
                          </optgroup>
                    </select>
                  </section>
                    </p>
                    <p>
                      <b>Rate</b> <br>

                          <div class="input-group" style="width:49%; float:left;">
                          <span class="input-group-addon">Frw</span>
                          <input type="number" step="any" min="0" class="form-control" id="rateRws" value="<?php echo @$rate_rw_g; ?>"  onkeyup="return convertSpend();" >
                          </div>

                          <div class="input-group" style="width:49%; float:right;">
                          <span class="input-group-addon">Fc</span>
                          <input type="number" step="any" min="0" class="form-control" id="rateCos" value="<?php echo @$rate_fc_g; ?>" onkeyup="return convertSpend();" >
                          </div>
                          <section style="clear:both;font-size:0px;color:transparent;">x</section>

                    </p>
                    <p>
                      <b>Cash</b><br>
                      <select class="sel-type insCash-typ" id="type">
                        <option value="out">Remove</option>
                        <option value="in">Add</option>
                      </select>
                      <input type="number" step="any" min="0" class="cash" id="cashIn" value="0" onkeyup="return convertSpend();" >
                      <select class="sel-cash-type" id="cashTypos" name="" onchange="return convertSpend();" >
                        <option value="rw">Frw</option>
                        <option value="fc">Fc</option>
                        <option value="dol">$</option>
                      </select>
                    </p>

                    <p id="totalContainnerP">
                      <b>Total in Frw</b> <br>
                      <input type="number" step="any" class="total_Rwa" min="0" id="Total" name="" value="0" style="width:70%;"> <b style="font-size: 21px;">Frw</b>
                    </p>

                    <p>
                      <b>Comment</b> <br>
                      <textarea name="" rows="8" cols="40" id="comment"></textarea>
                    </p>



                  <!-- </form> -->
                </section>
                <button type="button" class="btn btn-primary" onclick="return AddSpend();">Save changes</button>

              </div>
              <div class="col-md-6">
                <div class="" id="deleteStateView"></div>
               <button type="button" class="btn btn-info" onclick="return loadDoc('a');">All</button>
               <button type="button" class="btn btn-danger" onclick="return loadDoc('out');"> <b class="fa fa-minus-circle" style="font-size: 20px;"></b> Cash-Out</button>
               <button type="button" class="btn btn-success" onclick="return loadDoc('in');"> <b class="fa fa-plus-circle" style="font-size: 20px;"></b> Cash-In </button>
               <br>
               <br>
               <div class="" id="spent_view"></div>
              </div>
            </div>




          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
  </div>
</div>

<script>

function convertSpend() {
  var rateRwso   = document.getElementById('rateRws'); // input dollar
  var rateCoso   = document.getElementById('rateCos'); // input dollar
  // var type    = document.getElementById('type').value; // input dollar
  var cashIn     = document.getElementById('cashIn'); // input dollar
  var cashTypos  = document.getElementById('cashTypos'); // input dollar
  var Total      = document.getElementById('Total'); // input dollar

  if (cashTypos.value == "rw") {
    document.getElementById('Total').value = cashIn.value;
  
    // document.getElementById('totalContainnerP').style.height = 0;
    // document.getElementById('totalContainnerP').style.opacity = 0;
  } else {
    document.getElementById('Total').value = change_rate_receive(rateRwso.value, rateCoso.value, cashTypos.value, 'rw', cashIn.value).toFixed(2);
   
    document.getElementById('totalContainnerP').style.height = 'auto';
    document.getElementById('totalContainnerP').style.opacity = 1;
  }

}

function loadDoc(val) {
  var date_doo = document.getElementById('date_doo').value;
  var date_moo = document.getElementById('date_moo').value;
  var date_yoo = document.getElementById('date_yoo').value;
  var date = date_doo+'-'+date_moo+'-'+date_yoo; // date variable


  if (val == "") { val = 'a'; }
  if (date == "") { date = 'today'; }
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("spent_view").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "spent_view.php?type="+val+"&date="+date, true);
  xhttp.send();
}

loadDoc('a'); // Call the function by default



function deleteSpent(id){
      if (confirm("Are you sure you want to delete this Spend??")) {

        var request = new XMLHttpRequest();
        var url = "delete_spend.php";
        var vars = "cid="+id;
        request.open("POST", url, true);

        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function() {
    	    if(request.readyState == 4 && request.status == 200) {
    		    var return_data = request.responseText;
              document.getElementById('deleteStateView').innerHTML = return_data;
              loadDoc('a'); // Call the function by default
    	    }
        }
        // Send the data to PHP now... and wait for response to update the status div
        request.send(vars); // Actually execute the request
      }
      load_Descission(); // reflesh the decission after you delete the sell
} // END OF DELETE COMMENT



function AddSpend(){
        var date_doo = document.getElementById('date_doo').value;
        var date_moo = document.getElementById('date_moo').value;
        var date_yoo = document.getElementById('date_yoo').value;
        var dateo    = date_doo+'-'+date_moo+'-'+date_yoo; // date variable

        // rateRws rateCos type cashIn cashTypos Total
        var rateRws    = document.getElementById('rateRws').value; // input dollar
        var rateCos    = document.getElementById('rateCos').value; // input dollar
        var type       = document.getElementById('type').value; // input dollar
        var cashIn     = document.getElementById('cashIn').value; // input dollar
        var cashTypos  = document.getElementById('cashTypos').value; // input dollar
        var Total      = document.getElementById('Total').value; // input dollar
        var comment    = document.getElementById('comment').value; // input dollar
        // alert(cashTypos);
        // alert(Total);
        if (rateRws == "" || rateCos == "" || type == "" || cashIn == "" || cashTypos == "" || Total == ""|| comment == "") {
           alert("All field are required");
        } else {


            var request = new XMLHttpRequest();
            var url = "add_spend.php";
            var vars = "rateRw="+rateRws+"&rateCo="+rateCos+"&type="+type+"&cashIn="+cashIn+"&cashType="+cashTypos+"&Total="+Total+"&comment="+comment+"&date="+dateo;
            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.onreadystatechange = function() {
        	    if(request.readyState == 4 && request.status == 200) {
        		    var return_data = request.responseText;
                      document.getElementById('display_section').innerHTML = return_data;
                      loadDoc('a'); // Call the function
                      // rateRws rateCos type cashTypos
                      document.getElementById('comment').value = ""; // input dollar
                      document.getElementById('Total').value   = ""; // input dollar
                      document.getElementById('cashIn').value  = ""; // input dollar



        	    }
            }

            request.send(vars); // Actually execute the request
        }
        // Send the data to PHP now... and wait for response to update the status div
        load_Descission(); // reflesh the decission when you add new
} // END OF DELETE COMMENT





</script>

