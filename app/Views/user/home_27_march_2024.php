<html>
<style>
  .roulette_center {
      position: absolute;
      top: 255px;
      left: 258px;
      cursor: pointer;
    
  }
  .roulette_center:hover {
    transform: scale(1.01);
    
  }

  .roulette_wheel{
    touch-action:auto;pointer-events:painted
  }
</style>
<body>
<div style="z-index: 0; position: relative">
  <span  style="position: absolute; top: 0px; left: 360px; font-weight:700;font-size:24px;" id="score">&nbsp;</span>
  <img class="roulette_wheel" src="https://www.dropbox.com/s/6kp3fmtp72aj3vy/wellness-wheel.png?raw=1" />
  <img class="roulette_center" src="https://www.dropbox.com/s/52x8iyb1nvkjm0w/wheelCenter.png?raw=1" onclick="roulette_spin(this)" onfocus="transform()">
  <div style="position: absolute; top: 30px; left: 350px; background-color: red; width: 1px; height: 60px;"></div>

</div>

<script>
  var force = 0;
  var angle = 0;
  var rota = 1;
  var inertia = 0.985;
  var minForce = 15;
  var randForce = 15;
  var rouletteElem = document.getElementsByClassName('roulette_wheel')[0];
  var scoreElem = document.getElementById('score');

  var values = [
    "Spititual", "Emotional", "Intellectual", "Physical", "Social", "Environmental", "Financial"
  ].reverse();

  function roulette_spin(btn) {
    // set initial force randomly
    force = Math.floor(Math.random() * randForce) + minForce;
    requestAnimationFrame(doAnimation);
  }

  function doAnimation() {
    // new angle is previous angle + force modulo 360 (so that it stays between 0 and 360)
    angle = (angle + force) % 360;
    // decay force according to inertia parameter
    force *= inertia;
    rouletteElem.style.transform = 'rotate(' + angle + 'deg)';
    // stop animation if force is too low
    if (force < 0.05) {
      // score roughly estimated
      scoreElem.innerHTML = values[Math.floor(((angle / 360) * values.length) - 0.5)];
      return;
    }
    requestAnimationFrame(doAnimation);
  }
</script>
</body>
</html>