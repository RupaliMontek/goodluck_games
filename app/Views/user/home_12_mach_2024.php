<!DOCTYPE html>
<html lang="en">
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
  .roulette_wheel {
    transform-origin: center center;
    transition: transform 0.5s ease;
    touch-action:auto;pointer-events:painted
}

  .roulette_wheel{
    touch-action:auto;pointer-events:painted
  }
 /* #indicator {
    position: absolute;
    top: 50px;
    left: 650px;
    background-color: red;
    width: 10px;
    height: 60px;
}*/
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play Game</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fun.lucrative-esystem.com/frontend/mydesignstyle.css" rel="stylesheet">
    <!---------------  Font Aewsome  --------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!---------------  CSS  --------------------->
   <link rel="stylesheet" href="<?php echo base_url("public/css/style.css");?>">
    <!---------------  Font Aewsome  --------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!---------------  Chart JS  --------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!---------------  Chart JS Plugin  --------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> 

</head>
<body>
<div class="container-fluid gamebgg"> 
<!--div class="forspinner">
     <button id="spin"  class="roulette_center">Spin</button>
  <span class="arrow" id="myarrow"></span>
<div class="container  roulette_wheel">
  <div class="zero">0</div>
  <div class="one">1</div>
  <div class="two">2</div>
  <div class="three">3</div>
  <div class="four">4</div>
  <div class="five">5</div>
  <div class="six">6</div>
  <div class="seven">7</div>
  <div class="eight">8</div>
  <div class="nine">9</div>
</div>
  </div-->
  <div style="z-index: 0;" class="forspinner">
  <span  style="position: relative; top:60px; left: 50px; font-weight:700;font-size:24px;" id="score">&nbsp;</span>
 <div class="container  roulette_wheel">
  <div class="zero">0</div>
  <div class="one">1</div>
  <div class="two">2</div>
  <div class="three">3</div>
  <div class="four">4</div>
  <div class="five">5</div>
  <div class="six">6</div>
  <div class="seven">7</div>
  <div class="eight">8</div>
  <div class="nine">9</div>
</div>

   <!--button id="spin"  class="roulette_center"  onclick="roulette_spin(this)" onfocus="transform()">Spin</button-->
  <img class="roulette_center" id="spin" src="https://www.dropbox.com/s/52x8iyb1nvkjm0w/wheelCenter.png?raw=1" onclick="roulette_spin(this)" onfocus="transform()">
  <div style="position: absolute; top: 30px; left: 255px; background-color: red; width: 1px; height: 60px;"></div>
<div id="indicator"></div>
</div>
  
  
  
  
  
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forTopFirstButtons">
                    <div class="forbtnnn">
                        <h6>SCORE</h6>
                    <button type="button" class="btn">0.46</button></div>
                     <div class="forbtnnn">
                        <h6>Winner</h6>
                    <button type="button" class="btn">0</button>
                    </div>
                </div>
            </div>
        </div>
        
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forTopFirstButtons">
                    <div class="forbtnnn">
                        <h6>Time</h6>
                    <button type="button" class="btn"><div id="counter"></div></button></div>
                    <input class="form-control" type="hidden" name="numberss" id="numberss">
                     <input class="form-control" type="hidden" name="modes" id="modes">
                     <div class="forbtnnn">
                        <h6>Last 10 Data</h6>
                    <button type="button" class="btn">6 8 9 1 0 0 7 2 7 2</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forCircledNumberss">
                    <div class="forCirclebtnnn">
                    <button type="button" class="btn green">1</button>
                    <button type="button" class="btn yellow">5</button>
                    <button type="button" class="btn violet">10</button>
                    <button type="button" class="btn red">50</button>
                    </div>
                     <div class="forCirclebtnnn">
                    <button type="button" class="btn skyblue">100</button>
                    <button type="button" class="btn purple">500</button>
                    <button type="button" class="btn orange">1000</button>
                    <button type="button" class="btn parrot">5000</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forbettt">
                    <div class="forbetttbtnnn">
                    <button type="button" class="btn">Take</button>
                    <button type="button" class="btn">Cancel Bet</button>
                    </div>
                     <div class="forbetttbtnnn">
                    <button type="button" class="btn">Cancel Specific Bet</button>
                    <button type="button" class="btn">Bet Ok</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forBottomCounterr">
                    <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                        <button onclick="playSound()" id="myButton" type="button" class="btn">1</button>                       
                           <audio id="myAudio">
                               <source src="<?php echo base_url("frontend/game_audio/click-21156.mp3"); ?>" type="audio/mpeg">
                           </audio>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button onclick="playSound()" id="myButton1" type="button" class="btn">2</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button  onclick="playSound()" id="myButton2" type="button" class="btn">3</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button onclick="playSound()" id="myButton3" type="button" class="btn">4</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button onclick="playSound()" id="myButton4" type="button" class="btn">5</button>
                    </div>
                         <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button onclick="playSound()" id="myButton5" type="button" class="btn">6</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button onclick="playSound()" id="myButton6" type="button" class="btn">7</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button onclick="playSound()" id="myButton7" type="button" class="btn">8</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                      <a class="showNobtn">2</a>
                    <button onclick="playSound()" id="myButton8" type="button" class="btn">9</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                    <a class="showNobtn">2</a>
                    <button onclick="playSound()" id="myButton9" type="button" class="btn">0</button>
                    </div>
                         
            </div>
        </div>
        
        
</div>

<div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forBottompartt">
                    <div class="Bottomparttbtnnn">
                    <button type="button" class="btn">0</button>
                    </div>
                    <h6>Please bet to start game. Mininmum Bet = 1</h6>
                     <div class="Bottomparttbtnnn">
                    <button type="button" class="btn">EXIT</button>
                    </div>
                    
                </div>
                
                
            </div>
        </div>
</div>
    
  
  
  <!---------------  SCRIPT  --------------------->
 <!-- <script src="<?php echo base_url("/public/javascript/script.js");?>"></script>  -->
 
 
 <script>
  var force = 0;
  var angle = 0;
  var rotations = 0; 
  var maxRotations = 2; 
  var rota = 1;
  var inertia = 0.985;
  var minForce = 15;
  var randForce = 15;
  var rouletteElem = document.getElementsByClassName('roulette_wheel')[0];
  var scoreElem = document.getElementById('score');

  var values = [
    "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"
  ].reverse();

  function roulette_spin(btn) {
    rotations = 0;
    force = Math.floor(Math.random() * randForce) + minForce;
    requestAnimationFrame(doAnimation);
  }

  function doAnimation() {
    // new angle is previous angle + force modulo 360 (so that it stays between 0 and 360)
    angle = (angle + force) % 360;
    // decay force according to inertia parameter
    force *= inertia;
    rouletteElem.style.transform = 'rotate(' + angle + 'deg)';
    // Check if one full rotation is completed
    if (angle <= 0) {
      rotations++;
    }
    // Stop animation after two rotations
    if (rotations >= maxRotations) {
      // score roughly estimated
      scoreElem.innerHTML = values[Math.floor(((angle / 360) * values.length) - 0.5)];
      return;
    }
    requestAnimationFrame(doAnimation);
  }

//   var force = 0;
//   var angle = 0;
//   var rota = 1;
//   var inertia = 0.985;
//   var minForce = 15;
//   var randForce = 15;
//   var rouletteElem = document.getElementsByClassName('roulette_wheel')[0];
//   var scoreElem = document.getElementById('score');

//   var values = [
//     "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"
//   ].reverse();

//   function roulette_spin(btn) {
//     // set initial force randomly
//     force = Math.floor(Math.random() * randForce) + minForce;
//     requestAnimationFrame(doAnimation);
//   }

//   function doAnimation() {
//     // new angle is previous angle + force modulo 360 (so that it stays between 0 and 360)
//     angle = (angle + force) % 360;
//     // decay force according to inertia parameter
//     force *= inertia;
//     rouletteElem.style.transform = 'rotate(' + angle + 'deg)';
//     // stop animation if force is too low
//     if (force < 0.05) {
//       // score roughly estimated
//       scoreElem.innerHTML = values[Math.floor(((angle / 360) * values.length) - 0.5)];
//       return;
//     }
//     requestAnimationFrame(doAnimation);
//   }
  
  function get_numbers_spinner()
{
    $.ajax
    ({
    url: base_url+'admin/superadmin_amount_change_request_status_change',      
    type: 'GET',
    data: {},
    success:function(data)
    {
       $('#superadmin_amount_extend_request_status_change').html(data);
       $('#admin_balance_amount_extend_request').modal('show');    
    }
    });
}

 function get_counter_timer_universal()
    {
        $.ajax({
			url: base_url+'user/get_universal_counter_timer_all',
			type: "GET",
			data: {},
			success: function(data)
			{
			    var data = JSON.parse(data);
			    $("#counter").html(data);
			}
	    });
        
    }
    
       function get_as_per_mode_array_numbers_array()
    {
       $.ajax({
			url: base_url+'user/get_as_per_mode_array_numbers_array',
			type: "GET",
			data: {},
			success: function(data)
			{
			   var data = JSON.parse(data);
			    $("#numberss").val(data.numbers);
			    $("#modes").val(data.mode);
			}
	    }); 
    }    
    
   var base_url = "<?=  base_url(); ?>";
$( document ).ready(function() 
{
    get_as_per_mode_array_numbers_array();
    setInterval(get_as_per_mode_array_numbers_array, 1000);
    get_counter_timer_universal();
   setInterval(get_counter_timer_universal, 500);
}); 
</script>
 <!--script type="text/javascript">
 var base_url = "<?=  base_url(); ?>";
$( document ).ready(function() 
{
    get_as_per_mode_array_numbers_array();
    setInterval(get_as_per_mode_array_numbers_array, 1000);
    get_counter_timer_universal();
   setInterval(get_counter_timer_universal, 500);
});       
 
let spinWheel = document.querySelector(".container");
let audio = new Audio("<?php echo base_url("frontend/game_audio/mixkit-bike-wheel-spinning-1613.wav"); ?>"); //
let spinBtn = document.getElementById("spin");
var pieChartLabels = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
var static_arrays = $("#numberss").val();

// Split the string by commas to get an array
var static_array = static_arrays.split(',');

// Now static_array contains the array of numbers
var randomIndex = Math.floor(Math.random() * static_array.length);
var stopLabel = static_array[randomIndex];
var anglePerLabel = 360 / pieChartLabels.length;
var stopAngle = 360 - (anglePerLabel * stopLabel);
  
  
//   if(stopAngle==324)
//   {
//      spinBtn.addEventListener("click", spinWheelFunction);
//   }
//   else
//   {
//       var stopAngle = 360 - (anglePerLabel * stopLabel);
//   }
  console.log(stopAngle);
// Initialize the Chart.js pie chart
  let spinChart = new Chart(spinWheel, {
      type: "pie",
      data: {
          labels: pieChartLabels,
          datasets: [{
             // backgroundColor: #FFFFFF,
              data: Array.from({ length: pieChartLabels.length }, () => 2), // Default size for each slice
          }],
      },
      options: {
          responsive: true,
          animation: { duration: 0 },
          plugins: {
              tooltip: false,
              legend: {
                  display: false,
              },
              datalabels: {
                  rotation: 90,
                  color: "#ffffff",
                  formatter: (_, context) => context.chart.data.labels[context.dataIndex],
                  font: { size: 24 },
              },
          },
      },
  });
  function spinWheelFunction() {
      audio.play();
      var currentRotation = 0;
      var rotationInterval = 2; // Adjust the speed of the spin

      // Update the rotation of the wheel
      function updateRotation() {
          currentRotation += rotationInterval;
          spinWheel.style.transform = "rotate(" + currentRotation + "deg)";

          // Check if the wheel has reached the stop angle
          
          if (currentRotation >= stopAngle) {
              if(stopAngle==0 || stopAngle==1 || stopAngle==2)
              {
                  console.log('ok');
                  stopAngle=3;
              }
              else
              {
                  clearInterval(rotationIntervalId);
                  
              }
              
              //alert("Spinner stopped at label: "+pieChartLabels[stopLabel]);
          }
      }

      // Start rotating the wheel
      var rotationIntervalId = setInterval(updateRotation, 10);
  }

  // Add click event listener to the spin button
  spinBtn.addEventListener("click", spinWheelFunction);

// let number = Math.ceil(Math.random() * 1000);

// btn.onclick = function () {
//   container.style.transform = "rotate(" + number + "deg)";
// console.log(container.style.transform);
//   //number += Math.ceil(Math.random() * 1000);



function playSound()
{
    var audio = document.getElementById("myAudio"); // Change "spin_sound.mp3" to the path of your audio file
    audio.play();
}

function get_numbers_spinner()
{
    $.ajax
    ({
    url: base_url+'admin/superadmin_amount_change_request_status_change',      
    type: 'GET',
    data: {},
    success:function(data)
    {
       $('#superadmin_amount_extend_request_status_change').html(data);
       $('#admin_balance_amount_extend_request').modal('show');    
    }
    });
}

 function get_counter_timer_universal()
    {
        $.ajax({
			url: base_url+'user/get_universal_counter_timer_all',
			type: "GET",
			data: {},
			success: function(data)
			{
			    var data = JSON.parse(data);
			    $("#counter").html(data);
			}
	    });
        
    }
document.addEventListener('DOMContentLoaded', function()
{
   playSound_ticktack();
}); 

 function playSound_ticktack() {
            var audio = new Audio('<?php echo base_url("frontend/game_audio/clock-ticking-2.wav"); ?>');
            audio.loop = true; // Set the loop attribute to true
            audio.play()
                .then(() => {
                    console.log("Audio playback started successfully");
                })
                .catch(error => {
                    console.error("Audio playback failed:", error);
                });
        }
    function get_as_per_mode_array_numbers_array()
    {
       $.ajax({
			url: base_url+'user/get_as_per_mode_array_numbers_array',
			type: "GET",
			data: {},
			success: function(data)
			{
			   var data = JSON.parse(data);
			    $("#numberss").val(data.mode);
			    $("#modes").val(data.numbers);
			}
	    }); 
    }    
    
</script-->
</body>   
</html>

