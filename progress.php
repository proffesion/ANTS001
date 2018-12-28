<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>hh</title>
  </head>
  <body>

<canvas id="my_canvas" width="70" height="70" style="    border: 1px solid #09f;border-radius: 100%;"></canvas>
<script>
  var ctx = document.getElementById('my_canvas').getContext('2d');
  var al = 0;
  var start = 2.72;
  var cw = ctx.canvas.width;
  var ch = ctx.canvas.height;
  var diff;
function progressSim(){
  diff = ((al / 100) * Math.PI*2*10).toFixed(2);
  ctx.clearRect(0, 0, cw, ch);
  ctx.lineWidth = 10;
  ctx.fillStyle = '#09F';
  ctx.strokeStyle = '#09F';
  ctx.textAlign = 'center';
  ctx.fillText(al+'%', cw*.5,ch*5+2, cw);
  ctx.beginPath();
  ctx.arc(35, 35, 30, start, diff/10+start, false);
  ctx.stroke();
  // al = 90;
  if (al >= 100) {
    clearTimeout(sim);
  }
  al++;
}
  var sim = setInterval(progressSim, 50);
</script>
  </body>
</html>
