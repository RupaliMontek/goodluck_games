<!DOCTYPE html>
<html lang="en">
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


    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spin Wheel App</title>
    <!-- Google Font -->
    <link  href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet"/>
    <!-- Stylesheet -->
  </head>
  <body>
 <div class="container-fluid gamebgg"> 

<div class="forspinner">     
    <div class="wrapper">
      <div class="forspinnerInn">
        <canvas id="wheel"></canvas>
        <button id="spin-btn">Spin</button>
        <img src="<?php echo base_url("frontend/images/spinner-arrow-.svg");?>" alt="spinner-arrow" />
      </div>
      
    </div>
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
                    <button type="button" class="btn orange">5</button>
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
                    <button type="button" class="btn glow">Take</button>
                    <button type="button" class="btn">Cancel Bet</button>
                    </div>
                     <div class="forbetttbtnnn">
                    <button type="button" class="btn" id="betcancel">Cancel Specific Bet</button>
                    <button type="button" class="btn" id="betok">Bet Ok</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div id="final-value">
                <p>value</p>

      </div>
                <div class="forBottomCounterr">
                    <div class="CounterrOuterrbtn">
                        <span class="showNobtn">2</span>
                        <button onclick="playSound()" id="myButton" type="button" class="btn">1</button>                       
                           <audio id="myAudio">
                               <source src="<?php echo base_url("frontend/game_audio/mixkit-bike-wheel-spinning-1613.wav"); ?>" type="audio/mpeg">
                           </audio>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span class="showNobtn">2</span>
                    <button onclick="playSound()" id="myButton1" type="button" class="btn">2</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span class="showNobtn">2</span>
                    <button  onclick="playSound()" id="myButton2" type="button" class="btn">3</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span class="showNobtn">2</span>
                    <button onclick="playSound()" id="myButton3" type="button" class="btn">4</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span class="showNobtn">2</span>
                    <button onclick="playSound()" id="myButton4" type="button" class="btn">5</button>
                    </div>
                         <div class="CounterrOuterrbtn">
                        <span class="showNobtn">2</span>
                    <button onclick="playSound()" id="myButton5" type="button" class="btn">6</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span class="showNobtn">2</span>
                    <button onclick="playSound()" id="myButton6" type="button" class="btn">7</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span class="showNobtn">2</span>
                    <button onclick="playSound()" id="myButton7" type="button" class="btn">8</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                      <span class="showNobtn">2</span>
                    <button onclick="playSound()" id="myButton8" type="button" class="btn">9</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                    <span class="showNobtn">2</span>
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
                    <h6>Please bet to start game. Minimum Bet = 1</h6>
                    <div class="Bottomparttbtnnn">
                        <button type="button" class="btn" id="logoutBtn">EXIT</button>
                    </div>
                    <script>
                        document.getElementById('logoutBtn').addEventListener('click', function() {
                            alert("do you want to exit the game");
                        window.location.href = "<?php echo base_url("logout") ?>";
    });
</script>
                </div>
                
                
            </div>
        </div>
         <div class="forGifGoldCoinss"> <img class="img-fluid" src="<?php echo base_url("frontend/images/pockergame.png");?>" /></div>
</div>    
    
    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Chart JS Plugin for displaying text over chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    <!-- Script -->
<script> var base_url = "<?php echo base_url(); ?>";
const wheel = document.getElementById("wheel");
const spinBtn = document.getElementById("spin-btn");
const finalValue = document.getElementById("final-value");
//Object that stores values of minimum and maximum angle for a value
const rotationValues = [
  { minDegree: 0, maxDegree: 18, value: 2 },
  { minDegree: 19, maxDegree: 54, value: 1 },
  { minDegree: 55, maxDegree: 90, value: 10 },
  { minDegree: 91, maxDegree: 126, value: 9 },
  { minDegree: 127, maxDegree: 162, value: 8 },
  { minDegree: 163, maxDegree: 198, value: 7 }, 
  { minDegree: 199, maxDegree: 234, value: 6 },
  { minDegree: 235, maxDegree: 270, value: 5 },
  { minDegree: 271, maxDegree: 306, value: 4 },
  { minDegree: 307, maxDegree: 342, value: 3 },
  { minDegree: 343, maxDegree: 360, value: 2 },
];
//Size of each piece
const data = [16, 16, 16, 16, 16, 16, 16, 16, 16, 16];
//background color for each piece
var pieColors = [
  "#e74428",
  "#ebaa20",
  "#c94212",
  "#a94714",
  "#450c28",
  "#e5362c",
  "#0f0730",
  "#cb3722",
  "#580e0f",
  "#e38524",
];
//Create chart
let myChart = new Chart(wheel, {
  //Plugin for displaying text on pie chart
  plugins: [ChartDataLabels],
  //Chart Type Pie
  type: "pie",
  data: {
    //Labels(values which are to be displayed on chart)
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    //Settings for dataset/pie
    datasets: [
      {
        backgroundColor: pieColors,
        data: data,
      },
    ],
  },
  options: {
    //Responsive chart
    responsive: true,
    animation: { duration: 0 },
    plugins: {
      //hide tooltip and legend
      tooltip: false,
      legend: {
        display: false,
      },
      //display labels inside pie chart
      datalabels: {
        color: "#ffffff",
        formatter: (_, context) => context.chart.data.labels[context.dataIndex],
        font: { size:30},
        
      },
    },
  },
});
//display value based on the randomAngle
const valueGenerator = (angleValue) => {
  for (let i of rotationValues) {
    //if the angleValue is between min and max then display it
    if (angleValue >= i.minDegree && angleValue <= i.maxDegree) {
      finalValue.innerHTML = `<p>Value: ${i.value}</p>`;
      spinBtn.disabled = false;
      break;
    }
  }
};

//Spinner count
let count = 0;
let resultValue = 120;

// Start spinning
spinBtn.addEventListener("click", () => {
    const audio = document.getElementById("myAudio");
    audio.play();

    // Stop the audio after 2 seconds
    setTimeout(() => {
        audio.pause();
        audio.currentTime = 0; // Reset audio to the beginning
    }, 1000);
  spinBtn.disabled = true;
  finalValue.innerHTML = `<p>Good Luck!</p>`;

//   // Set possible target values (3, 5, 6)
//  const possibleValues = [1, 2, 3, 4, 5, 6, 7, 9, 10];
  
  // Select a random target value from possible values
  //const randomIndex = Math.floor(Math.random() * possibleValues.length);
//  const targetValue = possibleValues[randomIndex];

$.ajax({
    url: base_url + 'user/getNumbersBasedOnMode',
    type: "GET",
    success: function(data) {
        const main_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        const parsedObject = JSON.parse(data);
        const valuesString = parsedObject.values;
        const valuesArray = valuesString.split(',');
        
        // Convert saved numbers to numbers
        const savedNumbers = valuesArray.map(Number);
        
        // Filter out saved numbers from main_values
        const remainingNumbers = main_values.filter(number => !savedNumbers.includes(number));

        // If there are no remaining numbers, handle this case
        if (remainingNumbers.length === 0) {
            console.log("All numbers are saved. No numbers to spin.");
            return;
        }

        console.log("Remaining numbers to spin:", remainingNumbers);

        const randomIndex = Math.floor(Math.random() * remainingNumbers.length);
        const targetValue = remainingNumbers[randomIndex];

        console.log("Target value:", targetValue);
  let targetAngle;

  // Find the angle range for the target value
  for (let i of rotationValues) {
    if (i.value === targetValue) {
      targetAngle = (i.minDegree + i.maxDegree) / 2;
      break;
    }
  }

  if (targetValue % 2 !== 0) {
    resultValue = 119; // Set resultValue to 120 if targetValue is odd
  } else {
    resultValue = 96; // Set resultValue to 96 if targetValue is even
  }

  let rotationInterval = window.setInterval(() => {
    myChart.options.rotation = myChart.options.rotation + resultValue;
    myChart.update();

    if (myChart.options.rotation >= 360) {
      count += 1;
      resultValue -= 3;
      myChart.options.rotation = 0;
    } else if (count > 15) {
      // Stop spinner at the target angle
      if (myChart.options.rotation >= targetAngle) {
        clearInterval(rotationInterval);
        count = 0;
        finalValue.innerHTML = `<p>Value: ${targetValue}</p>`;
        spinBtn.disabled = false;
        $.ajax({
                url: base_url + 'user/saveStoppedNumber',
                type: 'POST',
                data: { stoppedNumber: targetValue },
                success: function(response) {
                    console.log("Number saved successfully:", targetValue);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error saving number:", textStatus, errorThrown);
                }
            });
      }
    }
    
  }, 10);
         }
});
});
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
    
  
$( document ).ready(function() 
{
    get_as_per_mode_array_numbers_array();
    setInterval(get_as_per_mode_array_numbers_array, 1000);
    get_counter_timer_universal();
   setInterval(get_counter_timer_universal, 500);
});
</script>

  </body>
</html>
