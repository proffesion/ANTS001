<script>

// receiving
var r_dol_r = 820;
var r_dol_c = 1410;

// for giving
var g_dol_r = 820;
var g_dol_c = 1300;




function check() {
var displayer = document.getElementById('div_displayer');

var from_sel = document.getElementById('from_sel').value;
var to_sel = document.getElementById('to_sel').value;

    var chang_typ = document.getElementById('chang_typ').value;
    var dol_r;
    var dol_c;

  if (chang_typ == 'r') {
     dol_r = r_dol_r;
     dol_c = r_dol_c;
  } else if (chang_typ == 'g') {
     dol_r = g_dol_r;
     dol_c = g_dol_c;
  }

// text box
var from_sel_t = document.getElementById('from_t').value;
var to_sel_t = document.getElementById('to_t').value;

if (document.getElementById('from_sel').value == document.getElementById('to_sel').value) {
  alert('please chose the different values');
  // alert(document.getElementById('from_sel').value)

} else if (from_sel == 'dol' && to_sel == 'fc') { // (1)
    document.getElementById('to_t').value = from_sel_t * dol_c;

} else if (from_sel == 'dol' && to_sel == 'rw') { // (2)
    document.getElementById('to_t').value = from_sel_t * dol_r;


} else if (from_sel == 'fc' && to_sel == 'dol') { // (3)
    document.getElementById('to_t').value = from_sel_t / dol_c;


} else if (from_sel == 'fc' && to_sel == 'rw') { // (4)
    document.getElementById('to_t').value = (from_sel_t / dol_c) * dol_r;


} else if (from_sel == 'rw' && to_sel == 'dol') { // (5)
  document.getElementById('to_t').value = from_sel_t * dol_r;


} else if (from_sel == 'rw' && to_sel == 'fc') { // (6)
  document.getElementById('to_t').value = (from_sel_t / dol_r) * dol_c;

}

}



</script>
<body>

<fieldset>
  <legend>Conveter</legend>

<fieldset>
  <div class="" id="div_displayer">
  </div>
</fieldset>
<!-- <br><br> -->
<form>
<p>
  type
  <select class="" id="chang_typ" onselect="check()" name="">
    <option value="r">Receive</option>
     <option value="g">Give</option>
  </select>
</p>



<p>
  from:<br>
  <select class="" id="from_sel" name="">
    <option value="dol">dol</option>
    <option value="rw">rw</option>
    <option value="fc">fc</option>
  </select>
  <input type="text" id="from_t" name="name" value="">
</p>

<p>
  to:<br>
  <select class="" id="to_sel" name="">
    <option value="dol">dol</option>
    <option value="rw">rw</option>
    <option value="fc">fc</option>
  </select>
  <input type="text" id="to_t" name="name" value="">
</p>



  <input type="button" onclick="check()" name="name" value="check">
</form>

</fieldset>

</body>
