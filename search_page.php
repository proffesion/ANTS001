
<script type="text/javascript">
var sendType;
sendType = 'files'

// function findmatch();

function searchStype(val) {
  document.getElementById('files').style.background='transparent';
  document.getElementById('users').style.background='transparent';
  document.getElementById('post').style.background='transparent';
  // var hol = val;

  // document.getElementById('view_type').innerHTML = "h ";
  document.getElementById(val).style.background='#ddd';
  document.getElementById(val).style.color='#000';

  if (val == '') {
    document.getElementById('file').style.background='blue';
    sendType = 'file'
  } else {
    sendType = val;
  }

     findmatch();
}

function findmatch() {
  var vieww = document.getElementById('view_type').innerHTML = "Results";

  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
  }

xmlhttp.onreadystatechange = function() {
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    document.getElementById('results').innerHTML = xmlhttp.responseText;
  }
}

xmlhttp.open('GET', 'search.inc.php?typ='+sendType+'&search_text='+document.search.search_text.value, true);
xmlhttp.send();
}



</script>

<div class="pop-nav-search fadeInDownBig animated">
  <div class="" style="padding: 8px;background:#fff;">
   <b style="font-size: 22px; font-weight: normal;"> Search </b>
    <form id="search" name="search" action="anotherpage.php">
   <div class="input-group">
     <span class="input-group-addon"><i class="fa fa-search"></i></span>
     <input type="text" id="input_text" name="search_text" class="form-control" onkeyup="findmatch();" placeholder=" &nbsp;&nbsp; search">
   </div>
   </form>

  </div>
  <div class="buttons-div" id="buttons">

    <button type="button" onclick="return searchStype('files')" style="background:red;" id="files">files</button>
    <button type="button" onclick="return searchStype('users')" id="users">user</button>
    <button type="button" onclick="return searchStype('post')"  id="post">post</button>
  </div>

    <div id="view_type" style="background: #7b7b71; padding: 6px; text-align: center; color: #fff;"> <div>select the type and search</div> </div>
    <div id="results"> </div><!-- the result div -->

</div>
