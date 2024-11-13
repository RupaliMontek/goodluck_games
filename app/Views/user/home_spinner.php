<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play Game</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="<?php echo base_url("frontend/mydesignstyle.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("frontend/responsiveStyle.css");?>" rel="stylesheet">
     <?php if($theme == 'light_theme'){ ?>
        <link href="<?php echo base_url("frontend/LightTheme.css"); ?>" rel="stylesheet">
    <?php }
    else
    { ?>
         <link href="<?php echo base_url("frontend/DarkTheme.css");?>" rel="stylesheet">
    <?php }?>
    <!---------------  Font Aewsome  --------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!---------------  CSS  --------------------->
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
    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Chart JS Plugin for displaying text over chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spin Wheel App</title>
    <!-- Google Font -->
    <link  href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet"/>
    <!-- Stylesheet -->
    <link rel="apple-touch-icon" sizes="180x180" herf="<?php echo base_url("frontend/images/apple-touch-icon.png");?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url("frontend/images/favicon-32x32.png");?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("frontend/images/favicon-16x16.png");?>">
<link rel="manifest" href="<?php echo base_url("frontend/images/site.webmanifest");?>">
  </head>
  <style>
     /* CSS for disabled buttons */
        .disabled-button {
             visibility: visible;
             opacity: 1!important;
             cursor: not-allowed; /* Changes cursor to indicate disabled state */
             color:#fff!important;
        }
        
        .btn {
            background-color: #f0f0f0; /* Default background color */
        }
        
        
  </style>
  <body>
<!--      <div id="load"> 
   <div class="loadOuter">
       <h3>Loading...</h3>
       <img width="515px" height="auto" class="img-fluid" src="<?php echo base_url("frontend/images/loadingGoodluck.gif");?>" />
   </div>   
   </div>-->
   
 <div id="contents" class="container-fluid gamebgg"> 
<audio id="loadingMusic" src="<?php echo base_url("frontend/game_audio/mario.loading.mp3"); ?>" preload="auto"></audio>
<div class="forspinner">     
    <div class="wrapper">
      <div class="container">
        <canvas id="wheel"></canvas>
        <!--<button id="spin-btn">Spin</button>-->
        <!--<img src="<?php echo base_url("frontend/images/targettt.png");?>" alt="spinner-arrow">-->
        <button id="spin-btn"><img class="img-fluid" src="<?php echo base_url("frontend/images/spinball.png");?>" /></button>
         <img class="spinarrowww" src="<?php echo base_url("frontend/images/targettt.png");?>" alt="spinner-arrow" />
      </div>
      
    </div>
</div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forTopFirstButtons">
                    <div class="forbtnnn">
                        <h6>SCORE</h6>
                         <button type="button" id="main_score" name="main_score" class="btn score-btn" value=""><?= $wallet_amount; ?></button>
                    <!--<?php foreach ($user_current_amounts as $user): ?>-->
                    <!--    <button type="button" class="btn score-btn" value=""><?= esc($user->current_wallet) ?></button>-->
                    <!--<?php endforeach; ?>-->
                    
                </div>
                     <div class="forbtnnn">
                        <h6>Winner</h6>
                    <button type="button" id="winnerBtn" class="btn">0</button>
                    </div>
                </div>
            </div>
        </div>
        
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forTopFirstButtons">
                    <div class="forbtnnn">
                        <h6>Time</h6>
                    <button  id ="counter_button" type="button" class="btn"><div id="counter"></div></button></div>
                    <input class="form-control" type="hidden" name="numberss" id="numberss">
                     <input class="form-control" type="hidden" name="modes" id="modes">
                     <div class="forbtnnn">
                        <h6>Last 10 Data</h6>
                    <button type="button" class="btn">
                       <!-- Horizontal Layout -->
       <ul class="horizontal-list" id="last_10_reuslts">
        <?php
            $count = 0; 
            foreach ($last_ten_results as $result): 
                
                if ($count < 10): 
        ?>
            <li><?php echo htmlspecialchars($result['numbers']); ?></li>
            <?php 
                $count++; 
                endif; 
            endforeach; 
        ?>
    </ul></button>
                    </div>
                </div>
            </div>
        </div>
        
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
            <audio id="radio-sound1" src="<?php echo base_url("frontend/game_audio/Collecting-Money-Coin.mp3"); ?>" preload="auto"></audio>
                <div class="forCircledNumberss">
                    <div class="forCirclebtnnn">
                    <div class="radio-button">
                    <audio id="radio-sound" src="<?php echo base_url("frontend/game_audio/My Audio.mp3"); ?>" preload="auto"></audio>
                    <input type="radio" id="radio1" name="increment_number"  value="1" class="btn" checked="checked">
                    <label class="" for="radio1">1</label> 
                    <input type="radio" id="radio2" name="increment_number"  value="5" class="btn">
                    <label class="" for="radio2">5</label>
                    <input type="radio" id="radio3" name="increment_number"  value="10" class="btn">
                    <label class="" for="radio3">10</label>
                    <input type="radio" id="radio4" name="increment_number"  value="50" class="btn">
                    <label class="" for="radio4">50</label>
                    </div>
                    </div>
                    <div class="forCirclebtnnn">
                    <div class="radio-button">
                    <input type="radio" id="radio5" name="increment_number" value="100" class="btn">
                    <label class="" for="radio5">100</label>
                    <input type="radio" id="radio6" name="increment_number"  value="500" class="btn">
                    <label class="" for="radio6">500</label>
                    <input type="radio" id="radio7" name="increment_number"  value="1000" class="btn">
                    <label class="" for="radio7">1000</label>
                    <input type="radio" id="radio8" name="increment_number"  value="5000" class="btn">
                    <label class="" for="radio8">5000</label>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 frusernameHedddd">
                <h2 class="usernameee"><i class="fa fa-user"></i> : <?=  ucwords($username); ?></h2>
                <div class="forbettt"> 
                    <div class="forbetttbtnnn">
                    <button type="button" id="take-btn"  class="btn glow">Take</button>
                    <button  type="button" class="btn" id="onebetcancel">Cancel Bet</button>
                    </div>
                     <div class="forbetttbtnnn">
                    <button type="button" class="btn" id="betcancel">Cancel Specific Bet</button>
                    <button type="button" class="btn" id="betok">Bet Ok</button>
                    <button type="button" onclick="bet_previous()" class="btn" id="prevok">Prev</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div id="final-value">
                <p>value</p>

      </div>
<div id="buttons" class="forBottomCounterr">
    <audio id="myAudio">
            <source src="<?php echo base_url("frontend/game_audio/spinner-sound.mp3"); ?>" type="audio/mpeg">
    </audio>
     <input type="hidden"  id="number0"/>
        <input type="hidden"  id="number1"/>
        <input type="hidden"  id="number2"/>
        <input type="hidden"  id="number3"/>
        <input type="hidden"  id="number4"/>
        <input type="hidden"  id="number5"/>
        <input type="hidden"  id="number6"/>
        <input type="hidden"  id="number7"/>
        <input type="hidden"  id="number8"/>
        <input type="hidden"  id="number9"/>
        <input type="hidden"  id="total_number_play">
        <input type="hidden"  id="win_val">
        <input type="hidden" id="winnerValue" value="0"/>
        <input type="hidden" id="newScore" />
        <input type="hidden" id="oldScore" />
        <input type="hidden" id="current_time"/>
        <input type="hidden" id="current_times"/>
        <input type="hidden" id="increment_number" /> 
        <input type="hidden" name="winner_number" id="winner_number">
</div>
</div>
</div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forBottompartt">
                    <div class="Bottomparttbtnnn">
                    <button type="button" class="btn" id="totalamt">0</button>  
                    </div>
                    <h6 id="change_content">Please bet to start game. Minimum Bet = 1</h6>
                    <div class="Bottomparttbtnnn">
                        <button type="button" class="btn" id="logoutBtn">EXIT</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="forGifGoldCoinss"> <img class="img-fluid" src="<?php echo base_url("frontend/images/pockergame.gif");?>" />
        </div>
    </div>  
    
    
<div class="modal fade" id="waitModal" tabindex="-1" role="dialog" aria-labelledby="waitModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="waitModalLabel">Wait for the Next Game</h5>
                </div>
                <div class="modal-body">
                    Please wait for the next game to start.
                </div>
            </div>
        </div> 
    </div>
    <!--new popup automatically come start here -->
<div class="popup" id="popup" style="display: none;">
    <button class="popup-close" id="popup-close-btn">&times;</button>
    <a class="poplinkkkk" href="" target="_blank">
        <img src="<?php echo base_url("frontend/images/joker.png"); ?>" alt="" width="100%" height="auto">
        <audio id="successAudio">
            <source src="<?php echo base_url("frontend/game_audio/success.mp3"); ?>" type="audio/mpeg">
        </audio>
    </a>
</div>
<script>
var base_url = "<?php echo base_url(); ?>";
let count = 0;
const wheel = document.getElementById("wheel");
const spinBtn = document.getElementById("spin-btn");
var modalShown = false; // Flag to track if modal has been shown
const finalValue = document.getElementById("final-value");
var spinnerCalled = false;
var selectedButtonIndex = null;
var loss_amount_minus = false;
var button_increment = false;
var conditionMet = false; // Declare a flag outside the function
var isBetOkClicked = false; // Track if "Bet Ok" has been clicked
var conditinbetok = false;
var condition_cliked_betok = false; // Declare a flag outside the function
get_counter_timer_universal();
setInterval(get_counter_timer_universal, 500);
fetchRemainingTime();
// Set an interval to periodically fetch the remaining time
setInterval(fetchRemainingTime, 20); // Fetch every second.

var spinnerCalled = false; // Flag to track if spinner has been called
const rotationValues = [
    { minDegree: 0, maxDegree: 35, value: 0 },
    { minDegree: 36, maxDegree: 71, value: 9 },
    { minDegree: 72, maxDegree: 107, value: 8 },
    { minDegree: 108, maxDegree: 143, value: 7 },
    { minDegree: 144, maxDegree: 179, value: 6 },
    { minDegree: 180, maxDegree: 215, value: 5 }, 
    { minDegree: 216, maxDegree: 251, value: 4 },
    { minDegree: 252, maxDegree: 287, value: 3 },
    { minDegree: 288, maxDegree: 323, value: 2 },
    { minDegree: 324, maxDegree: 359, value: 1 },
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
// Create chart
let myChart = new Chart(wheel, {
  // Plugin for displaying text on pie chart
  plugins: [ChartDataLabels],
  // Chart Type Pie
  type: "pie",
  data: {
    // Labels (values which are to be displayed on chart)
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 0], // Labels from 0 to 9
    // Settings for dataset/pie
    datasets: [
      {
        backgroundColor: pieColors,
        data: data,
      },
    ],
  },
  options: {
    // Responsive chart
    responsive: true,
    animation: { duration: 0 },
    plugins: {
      // Hide tooltip and legend
      tooltip: false,
      legend: {
        display: false,
      },
      // Display labels inside pie chart
      datalabels: {
        color: "#ffffff",
        formatter: (_, context) => context.chart.data.labels[context.dataIndex],
        font: { size: 30 },
      },
    },
    rotation: 0,
  },
});


        $(document).ready(function() {
            let incrementSpeed = 200; // Speed of the increment in milliseconds
            let longPressIntervalId;

            for (let i = 0; i < 10; i++) {
                let buttonHtml = `<div class="CounterrOuterrbtn">
                                    <span class="showNobtn" id="showNobtn${i}">0</span>
                                    <button id="myButton${i}" class="btn number-btn" disabled>${i}</button>
                                  </div>`;
                $('#buttons').append(buttonHtml);
            }

            for (let i = 0; i < 10; i++) {
                (function(i) {
                    $(`#myButton${i}`).on('mousedown', function() {
                        selectedButtonIndex = i; // Set the selected button index
                        incrementValue(i); // Increment once immediately on mousedown
                        longPressIntervalId = setInterval(() => {
                            incrementValue(i);
                        }, incrementSpeed);
                    }).on('mouseup mouseleave', function() {
                        clearInterval(longPressIntervalId);
                    });
                })(i);
            }

           function incrementValue(index) 
           {
                let spanId = `#showNobtn${index}`;
                let currentValue = parseInt($(spanId).text());
                let incrementValue = parseInt($('input[name="increment_number"]:checked').val());

                let main_scores = parseInt($("#main_score").text());
                if (main_scores < incrementValue) {
                    alert("Insufficient score to add this value");
                    clearInterval(longPressIntervalId); // Stop incrementing if insufficient score
                    return;
                }

                $('.number-btn').removeClass('active');
                $(`#myButton${index}`).addClass('active');

                currentValue += incrementValue;
                let newValue = currentValue;

                $(spanId).text(newValue);
                localStorage.setItem(spanId, newValue);

                let updatedMainScore = main_scores - incrementValue;
                $("#main_score").text(updatedMainScore);
                localStorage.setItem('main_score', updatedMainScore);

                updateTotalAmount();

                // Play sound
                const audioElement = document.getElementById('radio-sound');
                if (audioElement) {
                    audioElement.play();
                }
            }

        function updateTotalAmount() 
        {
           const audioElement = document.getElementById('radio-sound');
            if (audioElement) 
            {
                audioElement.play();
            }    
           let total = 0;
           for (let i = 0; i <= 9; i++) {
            let spanId = `#showNobtn${i}`;
            let value = parseInt($(spanId).text());
            total += value;
        }
        localStorage.setItem('totalamt', total);
        let totalamt = localStorage.getItem('totalamt');
        $("#totalamt").text(totalamt);
    }
    
            
    });
    
    var scoreValue = 0;
function get_user_balance_amount()
{
    $.ajax({
			url: base_url+'user/get_user_balance_amount',
			type: "GET",
			data: {},
			success: function(data)
			{
			   var data = JSON.parse(data);
			   if(data.current_wallet==null)
			   {
			     scoreValue = data.amout_given;
			   }
			   else
			   {
			       scoreValue = data.current_wallet;
			   }
			  
			   updateScore(scoreValue);
			}
	});
}    

function updateScore(score) 
{
    
    let main_score = localStorage.getItem('main_score');
    console.log("Score Value Store In Localstorage "+main_score);
    if(main_score==null || main_score==0 )
    {
       const scoreButton = document.querySelector('.score-btn');
       $("#main_score").text(score);
       scoreButton.textContent = score;
       localStorage.setItem('scoreValue', score);
    }
    else
    {
        const scoreButton = document.querySelector('.score-btn');
        scoreButton.textContent = main_score;
        
        localStorage.setItem('scoreValue', main_score);
    }
    
}

function get_counter_timer_universal() {
    $.ajax({
        url: base_url + 'user/get_universal_counter_timer_all',
        type: "GET",
        data: {},
        success: function(data) {
            var data = data.replace(/"/g, '');
            $("#counter").html(data);

            var timeStr = $("#current_time").val();
            if (timeStr !== '') {
                var parts = timeStr.split(':');
                var minutes = parseInt(parts[0]);
                var seconds = parseInt(parts[1]);
                var totalSeconds = (minutes * 60) + seconds;
                totalSeconds -= 10;
                if (totalSeconds < 0) {
                    totalSeconds = 0;
                }
                var newMinutes = Math.floor(totalSeconds / 60);
                var newSeconds = totalSeconds % 60;
                if (timeStr === '00:00') {
                    newMinutes = 0;
                    newSeconds = 50;           
                }
                var formattedMinutes = newMinutes.toString().padStart(2, '0');
                var formattedSeconds = newSeconds.toString().padStart(2, '0');
                const newTimeStr = formattedMinutes + ':' + formattedSeconds;
                if (data == newTimeStr) {
                    set_all_values_after_loss_game_10_seconds();
                    $("#take-btn").removeClass("glow");
                }
            }
            console.log("Time is "+data);
            if (data == '00:00') {
                $("#take-btn").removeClass("glow");
                $('#take-btn').prop('disabled', false);
                $("#winnerBtn").removeClass("glow");
                spinner_spin();
                spinnerCalled = true; // Set the flag to true after calling spinner_spin
            }
        }
    });
}

function spinner_spin() {
    document.getElementById('change_content').innerText = 'FOR AMUSEMENT ONLY NO CASH VALUE';
    const audio = document.getElementById("myAudio");
    audio.play();
    // Stop the audio after 2 seconds
    setTimeout(() => {
        audio.pause();
        audio.currentTime = 0; // Reset audio to the beginning
    }, 2000);

    spinBtn.disabled = true;
    finalValue.innerHTML = `<p>Spinning...</p>`;

    $.ajax({
        url: base_url + 'user/getNumbersBasedOnMode', // Adjust the URL to match your endpoint
        type: "GET",
        success: function(data) {
            const main_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
            let targetValue = 0;
            const parsedObject = JSON.parse(data);
            const valuesString = parsedObject.values;
            const valuesArray = valuesString.split(',');
            const savedNumbers = valuesArray.map(Number);
            const mode_set = parsedObject.mode;
            const remainingNumbers = main_values.filter(number => !savedNumbers.includes(number));

            if (mode_set !== 'jackpot_2x' && mode_set !== 'jackpot') {
                if (remainingNumbers.length === 0) {
                    //console.log("All numbers are saved. No numbers to spin.");
                    return;
                }
                //console.log("Remaining numbers to spin:", remainingNumbers);
                const randomIndex = Math.floor(Math.random() * remainingNumbers.length);
                targetValue = remainingNumbers[randomIndex];
            } else {
                //console.log(remainingNumbers);
                targetValue = parseInt(valuesString);
            }

            // Find target angle
            let targetAngle;
            for (let i of rotationValues) {
                if (i.value === targetValue) {
                    targetAngle = (i.minDegree + i.maxDegree) / 2;
                    break;
                }
            }

            // Prepare data for the chart
            let currentRotation = myChart.options.rotation;
            let spinDuration = 2000; // Spin duration in milliseconds (2 seconds)
            let intervalDuration = 10; // Interval duration in milliseconds
            let totalSteps = spinDuration / intervalDuration;
            let totalRotation = currentRotation + (360 * 15) + targetAngle - (currentRotation % 360);
            let stepRotation = (totalRotation - currentRotation) / totalSteps;

            let rotationInterval = window.setInterval(() => {
                currentRotation += stepRotation;
                myChart.options.rotation = currentRotation;
                myChart.update();

                if (--totalSteps <= 0) {
                    clearInterval(rotationInterval);
                    finalValue.innerHTML = `<p>Value: ${targetValue}</p>`;
                    spinBtn.disabled = false;

                    // Update winner button and other elements
                    document.getElementById('winnerBtn').textContent = targetValue;
                    $("#winner_number").val(targetValue);
                    const winnerButton = document.getElementById('winnerBtn');
                    var winnerValue = parseInt(winnerButton.textContent); // Ensure winnerValue is a number
                    let oldScore = parseInt(localStorage.getItem('scoreValue')) || 0;
                    $("#oldScore").val(oldScore);
                    var totalamt    = parseInt(document.getElementById('totalamt').innerText);
                    var winval      = parseInt(document.getElementById('winnerBtn').innerText);
                    var winner_number  = parseInt($("#winner_number").val());
                    const newScore = oldScore + winnerValue;
                    alert(winnerValue);
                    if(winnerValue!==0)
                    {
                        var spin_btn = document.getElementById("spin-btn");
                        spin_btn.disabled = false;
                
                    }
                    else
                    {
                        var spin_btn = document.getElementById("spin-btn");
                        spin_btn.disabled = true;
                    }
                    var showNobtn1  = parseInt(document.getElementById('showNobtn1').innerText);
                    $("#number1").val(showNobtn1);
                    var showNobtn2  = parseInt(document.getElementById('showNobtn2').innerText);
                    $("#number2").val(showNobtn2);
                    var showNobtn3  = parseInt(document.getElementById('showNobtn3').innerText);
                    $("#number3").val(showNobtn3);
                    var showNobtn4  = parseInt(document.getElementById('showNobtn4').innerText);
                    $("#number4").val(showNobtn4);
                    var showNobtn5  = parseInt(document.getElementById('showNobtn5').innerText);
                    $("#number5").val(showNobtn5);
                    var showNobtn6  = parseInt(document.getElementById('showNobtn6').innerText);
                    $("#number6").val(showNobtn6);
                    var showNobtn7  = parseInt(document.getElementById('showNobtn7').innerText);
                    $("#number7").val(showNobtn7);
                    var showNobtn8  = parseInt(document.getElementById('showNobtn8').innerText);
                    $("#number8").val(showNobtn8);
                    var showNobtn9  = parseInt(document.getElementById('showNobtn9').innerText);
                    $("#number9").val(showNobtn9);
                    var showNobtn0  = parseInt(document.getElementById('showNobtn0').innerText);
                    $("#number0").val(showNobtn0);
                    var increment_number = parseInt($("input[name='increment_number']:checked").val(), 10);
                    $("#increment_number").val(increment_number);
                    var win_val = parseInt(document.getElementById('winnerBtn').innerText);
                    $("#win_val").val(win_val);
                    var totalamt  = document.getElementById('totalamt').innerText;    
                    $("#total_number_play").val(totalamt);
                    var showNobtnId = 'number' + targetValue;
                    var showNobtnElement = $("#" + showNobtnId).val();
                    if (showNobtnElement) {
                        const showNobtnValue = parseInt(showNobtnElement.trim());
                        if (!isNaN(showNobtnValue)) {
                            if (mode_set !== 'jackpot_2x' && mode_set !== 'jackpot') {
                                winnerValue = showNobtnValue * 9;
                            } else {
                                winnerValue = showNobtnValue * 18;
                            }
                            document.getElementById('winnerBtn').textContent = winnerValue;
                        } else {
                            document.getElementById('winnerBtn').textContent = "0";
                        }
                        $("#winnerValue").val(winnerValue);
                        if (winnerValue !== 0) {
                            var winnerBtn = document.getElementById("winnerBtn");
                            winnerBtn.classList.add("btn", "glow");

                            var take_btn = document.getElementById("take-btn");
                            take_btn.classList.add("btn", "glow");
                            $('#take-btn').prop('disabled', false);
                        }
                    } else {
                        document.getElementById('winnerBtn').textContent = "0";
                    }

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

                    var innerDiv = document.getElementById("counter");
                    var counter = innerDiv.innerHTML;
                    $("#current_time").val(counter);
                    $("#current_times").val(counter);

                    get_last_10_win_numbers();
                    conditinbetok = false;
                    condition_cliked_betok = false;

                    if (winnerValue == 0) {
                        collect_all_loss_amount();
                    }

                    if ((mode_set === 'jackpot_2x' || mode_set === 'jackpot') && winnerValue !== 0) {
                        const popup = document.getElementById('popup');
                        const successAudio = document.getElementById('successAudio');
                        popup.style.display = 'block';
                        successAudio.play(); // Play the success audio

                        setTimeout(() => {
                            popup.style.display = 'none';
                        }, 4000);

                        document.getElementById('popup-close-btn').addEventListener('click', () => {
                            document.getElementById('popup').style.display = 'none';
                        });
                    }
                }
            }, intervalDuration);
        }
    });
}



function spinner_spin_old()
{    document.getElementById('change_content').innerText = 'FOR AMUSEMENT ONLY NO CASH VALUE';
        const audio = document.getElementById("myAudio");
        audio.play();
        // Stop the audio after 2 seconds
        setTimeout(() => {
        audio.pause();
        audio.currentTime = 0; // Reset audio to the beginning
        }, 1400);
        spinBtn.disabled = true;
        finalValue.innerHTML = `<p>Luck! <i class="fa fa-thumbs-up"></i></p>`;
        $.ajax({
            url: base_url+'user/getNumbersBasedOnMode', // Adjust the URL to match your endpoint
            type: "GET",
            success: function(data) {  
            const main_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
            var targetValue =0;
            const parsedObject = JSON.parse(data);
            const valuesString = parsedObject.values;
            const valuesArray = valuesString.split(',');
            const savedNumbers = valuesArray.map(Number);
            var mode_set = parsedObject.mode;
            const remainingNumbers = main_values.filter(number => !savedNumbers.includes(number));
            if (mode_set !== 'jackpot_2x' && mode_set !== 'jackpot')
           {
               
            if (remainingNumbers.length === 0)
            {
                //console.log("All numbers are saved. No numbers to spin.");
                return;
            }
            //console.log("Remaining numbers to spin:", remainingNumbers);
            const randomIndex = Math.floor(Math.random() * remainingNumbers.length);
            targetValue = remainingNumbers[randomIndex];
           }
           else
          {
               //console.log(remainingNumbers);
                targetValue = parseInt(valuesString);
          }
            //console.log("Target value:", targetValue);
            let targetAngle;
            for (let i of rotationValues)
            {
                if (i.value === targetValue) 
                {
                    targetAngle = (i.minDegree + i.maxDegree) / 2;
                    break;
                }
            }
            $("#winner_number").val(targetValue);
            const winnerButton = document.getElementById('winnerBtn');
            const winnerValue = parseInt(winnerButton.textContent); // Ensure winnerValue is a number
            let oldScore = parseInt(localStorage.getItem('scoreValue')) || 0;
            $("#oldScore").val(oldScore);
            var totalamt    = parseInt(document.getElementById('totalamt').innerText);
            var winval      = parseInt(document.getElementById('winnerBtn').innerText);
            var winner_number  = parseInt($("#winner_number").val());
            const newScore = oldScore + winnerValue;
            if(winnerValue!==0)
            {
                var spin_btn = document.getElementById("spin-btn");
                spin_btn.disabled = false;
                
            }
            else
            {
                var spin_btn = document.getElementById("spin-btn");
                spin_btn.disabled = true;
            }
            var showNobtn1  = parseInt(document.getElementById('showNobtn1').innerText);
            $("#number1").val(showNobtn1);
            var showNobtn2  = parseInt(document.getElementById('showNobtn2').innerText);
            $("#number2").val(showNobtn2);
            var showNobtn3  = parseInt(document.getElementById('showNobtn3').innerText);
            $("#number3").val(showNobtn3);
            var showNobtn4  = parseInt(document.getElementById('showNobtn4').innerText);
            $("#number4").val(showNobtn4);
            var showNobtn5  = parseInt(document.getElementById('showNobtn5').innerText);
            $("#number5").val(showNobtn5);
            var showNobtn6  = parseInt(document.getElementById('showNobtn6').innerText);
            $("#number6").val(showNobtn6);
            var showNobtn7  = parseInt(document.getElementById('showNobtn7').innerText);
            $("#number7").val(showNobtn7);
            var showNobtn8  = parseInt(document.getElementById('showNobtn8').innerText);
            $("#number8").val(showNobtn8);
            var showNobtn9  = parseInt(document.getElementById('showNobtn9').innerText);
            $("#number9").val(showNobtn9);
            var showNobtn0  = parseInt(document.getElementById('showNobtn0').innerText);
            $("#number0").val(showNobtn0);
            var increment_number = parseInt($("input[name='increment_number']:checked").val(), 10);
            $("#increment_number").val(increment_number);
            var win_val = parseInt(document.getElementById('winnerBtn').innerText);
            $("#win_val").val(win_val);
            
            var totalamt  = document.getElementById('totalamt').innerText;    
            $("#total_number_play").val(totalamt);
            if (targetValue === 0)
            {
                resultValue = 65;
            } else if (targetValue === 1) 
            {
                resultValue = 76.5;
            } else if (targetValue === 2) 
            {
                resultValue = 92;
            } else if (targetValue === 3) 
            {
                resultValue = 102;
            } else if (targetValue === 4) 
            {
                resultValue = 107;
            } else if (targetValue === 5) 
            {
                resultValue = 114;
            } else if (targetValue === 6) 
            {
                resultValue = 128;
            } else if (targetValue === 7) 
            {
                resultValue = 172;
            } else if (targetValue === 8) 
            {
                resultValue = 135.9;
            } else if (targetValue === 9) 
            {
                resultValue = 103;
            }
            let rotationInterval = window.setInterval(() =>
            {
                myChart.options.rotation = myChart.options.rotation + resultValue;
                myChart.update();
                if (myChart.options.rotation >= 360)
                {
                    count += 1;
                    resultValue -= 3;
                    myChart.options.rotation = 0;
                } 
                else if (count > 15)
                {
                    if (myChart.options.rotation >= targetAngle) 
                    {
                        clearInterval(rotationInterval);
                        count = 0;
                        finalValue.innerHTML = `<p>Value: ${targetValue}</p>`;
                        spinBtn.disabled = false;
                        // Update the winner button with the targetValue
                        document.getElementById('winnerBtn').textContent = targetValue;
                        // Get the value from the corresponding showNobtn element, multiply it by 9, and add it to the winner box
                        var showNobtnId = 'number' + targetValue;
                        var showNobtnElement =  $("#"+showNobtnId).val(); 
                        if (showNobtnElement)  
                        {
                            var winnerValue = 0 ;
                            const showNobtnValue = parseInt(showNobtnElement.trim());
                            if (!isNaN(showNobtnValue)) 
                            {   if (mode_set !== 'jackpot_2x' && mode_set !== 'jackpot')
                                {
                                 winnerValue = showNobtnValue * 9;
                                }
                                else
                                {
                                    winnerValue = showNobtnValue * 18;
                                }
                                 document.getElementById('winnerBtn').textContent = winnerValue;
                            } 
                            else
                            {
                                document.getElementById('winnerBtn').textContent = "0";
                            }
                            $("#winnerValue").val(winnerValue);
                            if(winnerValue!==0)
                            {
                              var winnerBtn = document.getElementById("winnerBtn");
                              winnerBtn.classList.add("btn","glow"); 
                              
                              var take_btn = document.getElementById("take-btn");
                              take_btn.classList.add("btn","glow"); 
                              $('#take-btn').prop('disabled', false);
                            }
                        } 
                        else
                        {
                            // If no number is set, show "0" in the winner box
                            document.getElementById('winnerBtn').textContent = "0";
                        }
                        $.ajax({
                            url: base_url + 'user/saveStoppedNumber',
                            type: 'POST',
                            data: { stoppedNumber: targetValue },
                            success: function(response)
                            {
                                console.log("Number saved successfully:", targetValue);
                            },
                            error: function(jqXHR, textStatus, errorThrown) 
                            {
                                console.error("Error saving number:", textStatus, errorThrown);
                            }
                        });
                        var innerDiv = document.getElementById("counter");
                        var counter = innerDiv.innerHTML;
                        $("#current_time").val(counter);
                        $("#current_times").val(counter);
                        //alert("current Time Changed");
                        get_last_10_win_numbers();
                        conditinbetok = false;
                        condition_cliked_betok = false;
                        if(winnerValue==0)
                        {
                             collect_all_loss_amount();
                            //$("#take-btn").trigger('click'); 
                        }
                        if ((mode_set === 'jackpot_2x' || mode_set === 'jackpot') && winnerValue !== 0) {
                            const popup = document.getElementById('popup');
                            const successAudio = document.getElementById('successAudio');
                        
                            popup.style.display = 'block';
                            successAudio.play(); // Play the success audio

                            setTimeout(() => {
                                popup.style.display = 'none';
                            }, 4000);
                        }

                            document.getElementById('popup-close-btn').addEventListener('click', () => {
                            document.getElementById('popup').style.display = 'none';
                        });

                    }
                }
            }, 10);
        }
    });
    let resultValue;
    let totalamt = localStorage.getItem('totalamt');
    localStorage.setItem('main_score', 0);
}


function bet_previous()
{
        var number0 =  $("#number0").val();
        $('#showNobtn0').text(number0);
        var number1 =  $("#number1").val();
        $('#showNobtn1').text(number1);
        var number2 =  $("#number2").val();
        $('#showNobtn2').text(number2);
        var number3 =  $("#number3").val();
        $('#showNobtn3').text(number3);
        var number4 =  $("#number4").val();
        $('#showNobtn4').text(number4);
        var number5 =  $("#number5").val();
        $('#showNobtn5').text(number5);
        var number6 =  $("#number6").val();
        $('#showNobtn6').text(number6);
        var number7 =  $("#number7").val();
        $('#showNobtn7').text(number7);
        var number8 =  $("#number8").val(); 
        $('#showNobtn8').text(number8);
        var number9 =  $("#number9").val();
        $('#showNobtn9').text(number9);
        var total_number_play  = $("#total_number_play").val();
        $('#totalamt').text(total_number_play);
        var main_score = $("#main_score").text();
        var after_bet_prv = main_score-total_number_play;
        $('#main_score').text(after_bet_prv);
}


function disableButtons()
{   
    button_increment = false;
    loss_amount_minus = false;
    $('#totalamt,#take-btn,#betok,#betcancel,#onebetcancel,#myButton1,#myButton2,#myButton3,#myButton4,#myButton5,#myButton6,#myButton7,#myButton8,#myButton9,#myButton0,#logoutBtn').prop('disabled', true).addClass('disabled-button');
    var spin_btn = document.getElementById("spin-btn");
    spin_btn.disabled = true;
    var counter_button = document.getElementById("counter_button");
    counter_button.classList.add("btn","glow");
    for (let i = 0; i <= 9; i++)
    {
        $('#myButton'+i).prop('disabled', true);
    }
}


function enableButtons()
{
    var number1 = $("#number1").val();
    var number2 = $("#number2").val();
    var number3 = $("#number3").val();
    var number4 = $("#number4").val();
    var number5 = $("#number5").val();
    var number6 = $("#number6").val();
    var number7 = $("#number7").val();
    var number8 = $("#number8").val();
    var number9 = $("#number9").val();
    var number0 = $("#number0").val();
    var winnerValue = parseInt($("#winnerValue").val());
    if(winnerValue !== 0)
    {
        button_increment = true;
        conditionMet = false;
        condition_cliked_betok = false;
        //conditinbetok = false;
        //console.log(winnerValue+ "This Value");
        //console.log("IF");
        $("#prevok").show();
        $("#betok").hide();
        document.getElementById('change_content').innerText = 'Congratulations!!! You Win';  
    }
    else if ((number1 != 0 || number2 != 0 || number3 != 0 || number4 != 0 || number5 != 0 || number6 != 0 || number7 != 0 || number8 != 0 || number9 != 0 || number0 != 0) && button_increment)
    {
        //console.log(button_increment+'Button Increment Flag');
        //console.log("ELSE IF");
        $("#prevok").show();
        $("#betok").hide();  
        document.getElementById('change_content').innerText = 'You can either make Bet or Press BETOK Button'; 
    }
    else
    {   //console.log(button_increment+'Button Increment Flag');
        //console.log("ELSE");
        $("#prevok").hide();
        $("#betok").show();  
        document.getElementById('change_content').innerText = 'Please bet to start game. Minimum Bet = 1'; 
    }
    
    $('#totalamt,#betcancel,#onebetcancel,#myButton1,#myButton2,#myButton3,#myButton4,#myButton5,#myButton6, #myButton7,#myButton8,#myButton9,#myButton0,#logoutBtn').prop('disabled', false);
    var spin_btn = document.getElementById("spin-btn");
    spin_btn.disabled = false;
    $("#counter_button").removeClass("glow");
}

    
$('#onebetcancel').on('click', function()
{
        for (let i = 0; i <= 9; i++)
        {
            let spanId = `#showNobtn${i}`;
            let numbers = `#number${i}`;
            $(numbers).text(0);
            $(spanId).text(0);
            localStorage.setItem(spanId, 0);
        }
        $('#betok').prop('disabled', true);
        $('#totalamt').text('0'); 
        localStorage.setItem('main_score', 0);
        get_user_balance_amount();
});



function get_last_10_win_numbers()
{
   $.ajax
   ({
        url: base_url + 'get_last_10_win_numbers',
        type: 'POST',
        data: { },
        success: function(response)
        {
            var data = JSON.parse(response);
            $('#last_10_reuslts').empty();
            // Loop through the first 10 items or the length of the data array, whichever is smaller
            for (var i = 0; i < Math.min(10, data.length); i++)
            {
                var item = data[i];
                var listItem = $('<li>' + item.numbers + '</li>');
                $('#last_10_reuslts').append(listItem);
                                                           
            }
        },
    }); 
}


$("#take-btn").click(function() 
{
    var number1 = $("#number1").val();
    var number2 = $("#number2").val();
    var number3 = $("#number3").val(); 
    var number4 = $("#number4").val();
    var number5 = $("#number5").val();
    var number6 = $("#number6").val();
    var number7 = $("#number7").val();
    var number8 = $("#number8").val();
    var number9 = $("#number9").val();
    var number0 = $("#number0").val();
    var winnerValue = $("#winnerValue").val();
    var oldScore = $("#oldScore").val();
    var newScore = (oldScore+winnerValue);
    $("newScore").val(newScore);
    var winner_number = parseInt($("#winner_number").val());
    var total_number_play = $("#total_number_play").val();
    var increment_number = $("#increment_number").val();
    var newScore = $("#newScore").val();
    var win_val = $("#win_val").val();
    // Ensure `oldScore` is defined
    if (number1 != 0 || number2 != 0 || number3 != 0 || number4 != 0 || number5 != 0 || number6 != 0 || number7 != 0 || number8 != 0 || number9 != 0 || number0 != 0)
    {
           
        var token = localStorage.getItem('authToken'); // Get the token from localStorage
        $.ajax({
            url: base_url + 'user/save_winning_details',
            type: 'POST',
            headers: {
                    'Authorization': 'Bearer ' + token // Include the token in the request header
            },
            data:{
                    win_val: win_val,
                    increment_number: increment_number,
                    winnerValue: winnerValue,
                    totalamt: total_number_play,
                    showNobtn1: number1,
                    showNobtn2: number2,
                    showNobtn3: number3,
                    showNobtn4: number4,
                    showNobtn5: number5,
                    showNobtn6: number6,
                    showNobtn7: number7,
                    showNobtn8: number8,
                    showNobtn9: number9,
                    showNobtn0: number0,
                    oldScore: oldScore,
                    newScore: newScore,
                    winner_number: winner_number
            },
            success: function(response) 
            {
                alert("Success");
                get_user_balance_amount();
                $('#take-btn').prop('disabled', true);
                $("#winnerBtn").removeClass("glow");
                $("#winnerValue").val(0);
                $("#winnerBtn").text(0);
                $("#totalamt").text(0);
                for (let i = 0; i <= 9; i++) 
                {
                    $(`#showNobtn${i}`).text('0');
                }
            }
        });
    }
        
});


function set_all_values_after_loss_game_10_seconds()
{
   var current_time_str = $("#current_time").val();
   // Split the time string into minutes and seconds
   var time_parts = current_time_str.split(':');
   var minutes = parseInt(time_parts[0], 10);
   var seconds = parseInt(time_parts[1], 10);
  // Convert total seconds to seconds only
  var total_seconds = minutes * 60 + seconds;
  // Subtract 10 seconds
  total_seconds -= 10;
  // Ensure the result is within the valid range (0 to 59 seconds)
  if (total_seconds < 0) 
  {
      total_seconds = 0; // Set to 0 if it goes negative
  }
   // Calculate new minutes and seconds
   var new_minutes = Math.floor(total_seconds / 60);
   var new_seconds = total_seconds % 60;

   // Format the new time to MM:SS format
   const new_time_str = ('0' + new_minutes).slice(-2) + ':' + ('0' + new_seconds).slice(-2);
   var counter_time = $('#counter').text();
   //console.log("Current Time is "+counter_time);
   //console.log("Previos Time is "+new_time_str);
   //console.log(counter_time+" Loss Current Times Is");
   if(counter_time==new_time_str && !loss_amount_minus )
   {
       for (let i = 0; i <= 9; i++)
        {
            let spanId = `#showNobtn${i}`;
            let numbers = `#number${i}`;
            $(numbers).text(0);
            $(spanId).text(0);
            localStorage.setItem(spanId, 0);
        }
        $('#betok').prop('disabled', true);
        $('#totalamt').text('0'); 
        $('#winnerBtn').text(0);
        get_user_balance_amount();
        loss_amount_minus = true;
   }
   
}

var conditionMet = false; // Declare a flag outside the function
function collect_all_loss_amount()
{
    var number1 = $("#number1").val();
    var number2 = $("#number2").val();
    var number3 = $("#number3").val(); 
    var number4 = $("#number4").val();
    var number5 = $("#number5").val();
    var number6 = $("#number6").val();
    var number7 = $("#number7").val();
    var number8 = $("#number8").val();
    var number9 = $("#number9").val();
    var number0 = $("#number0").val();
    var winnerValue = $("#winnerValue").val();
    var oldScore = parseFloat($("#oldScore").val()) || 0; // Ensure `oldScore` is defined and is a number
    var newScore = oldScore + parseFloat(winnerValue);
    $("#newScore").val(newScore);
    var winner_number = parseInt($("#winner_number").val());
    var total_number_play = $("#total_number_play").val();
    var increment_number = $("#increment_number").val();
    var newScore = $("#newScore").val();
    var win_val = $("#win_val").val();

    // Check if the condition is met and the flag is not set
    if ((number1 != 0 || number2 != 0 || number3 != 0 || number4 != 0 || number5 != 0 || number6 != 0 || number7 != 0 || number8 != 0 || number9 != 0 || number0 != 0) && !conditionMet) {
        conditionMet = true; // Set the flag to prevent further executions
        var token = localStorage.getItem('authToken'); // Get the token from localStorage
        $.ajax({
            url: base_url + 'user/save_winning_details',
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token // Include the token in the request header
            },
            data: {
                win_val: win_val,
                increment_number: increment_number,
                winnerValue: winnerValue,
                totalamt: total_number_play,
                showNobtn1: number1,
                showNobtn2: number2,
                showNobtn3: number3,
                showNobtn4: number4,
                showNobtn5: number5,
                showNobtn6: number6,
                showNobtn7: number7,
                showNobtn8: number8,
                showNobtn9: number9,
                showNobtn0: number0,
                oldScore: oldScore,
                newScore: newScore,
                winner_number: winner_number
            },
            success: function(response) {
                get_user_balance_amount();
                loss_amount_minuus = true;
                $('#take-btn').prop('disabled', true);
                $("#winnerValue").val(0);
                conditionMet = false; // Reset the flag to allow future executions
            },
            error: function() {
                conditionMet = false; // Reset the flag in case of error as well
            }
        });
    }
}


function showWaitNextGameModal()
{
    var remainingTime = $('#counter').text();
    remainingTime = parseInt(remainingTime.split(':')[0]) * 120 + parseInt(remainingTime.split(':')[1]);
    if (!modalShown && remainingTime >=1 && remainingTime <= 10)
    {
            $('#waitNextGameModal').modal('show');
            modalShown = true; // Set modalShown flag to true
    }
    else
    {
               $('#waitNextGameModal').modal('hide');
               modalShown = false; // Set modalShown flag to true
    }
}

$('#betok').on('click', function()
    {
        isBetOkClicked = true; // Mark that "Bet Ok" has been clicked
        disableButtons(); // Disable the buttons upon clicking "Bet Ok"
    });

function fetchRemainingTime() 
{   
    
    console.log("Buttons "+conditinbetok);
    function getValueById(id)
    {
        let $element = $('#' + id);
        return $element.length ? parseInt($element.text()) || 0 : 0;
    }
    var showNobtn1  =  getValueById('showNobtn1');
    var showNobtn1  = getValueById('showNobtn1');
    var showNobtn2  = getValueById('showNobtn2');
    var showNobtn3  = getValueById('showNobtn3');
    var showNobtn4  = getValueById('showNobtn4');
    var showNobtn5  = getValueById('showNobtn5');
    var showNobtn6  = getValueById('showNobtn6');
    var showNobtn7  = getValueById('showNobtn7');
    var showNobtn8  = getValueById('showNobtn8');
    var showNobtn9  = getValueById('showNobtn9');
    var showNobtn0  = getValueById('showNobtn0');
    var increment_number = parseInt($("input[name='increment_number']:checked").val(), 10);
    var increment_number = parseInt($("input[name='increment_number']:checked").val(), 10);
    var win_val = parseInt(document.getElementById('winnerBtn').innerText);
    var remainingTime = $('#counter').text();
    remainingTime = parseInt(remainingTime.split(':')[0]) * 120 + parseInt(remainingTime.split(':')[1]);
    if (remainingTime==10 || remainingTime==09 || remainingTime==08 ||  remainingTime==07 || remainingTime==06 || remainingTime==05 || remainingTime==04 ||remainingTime==03 || remainingTime==02 || remainingTime==01 || conditinbetok)
    {
        console.log("Disable Codition");
        if ((showNobtn1!==0 || showNobtn2!==0 || showNobtn3!==0 ||  showNobtn4!==0 || showNobtn5!==0 || showNobtn6!==0 || showNobtn7!==0 ||showNobtn8!==0 || showNobtn9!==0 || showNobtn0!==0 ) && !conditinbetok)
        { 
        
            if (!condition_cliked_betok) 
            {
                save_playing_no_details();
            }
            condition_cliked_betok = true;
            $('#betok').prop('disabled', true);
        }
        else
        {
             $('#betok').prop('disabled', true);
        }
        document.getElementById('change_content').innerText = 'Bet Time Over';
        document.getElementById('change_content').innerText = 'Your Bet Has Been Accepted';
        disableButtons();
    } 
    else
    {
         
        if (showNobtn1!==0 || showNobtn2!==0 || showNobtn3!==0 ||  showNobtn4!==0 || showNobtn5!==0 || showNobtn6!==0 || showNobtn7!==0 ||showNobtn8!==0 || showNobtn9!==0 || showNobtn0!==0  || !conditinbetok)
        {console.log("Enable Codition");
          $('#betok').prop('disabled', false);
        }
        else
        {
                     $('#betok').prop('disabled', true);
        }
        enableButtons();
                
    }
}


function save_playing_no_details()
{
    var number_0 = $("#showNobtn0").text();
    var number_1 = $("#showNobtn1").text();
    var number_2 = $("#showNobtn2").text();
    var number_3 = $("#showNobtn3").text(); 
    var number_4 = $("#showNobtn4").text();
    var number_5 = $("#showNobtn5").text();
    var number_6 = $("#showNobtn6").text();
    var number_7 = $("#showNobtn7").text();
    var number_8 = $("#showNobtn8").text();
    var number_9 = $("#showNobtn9").text();    
    if(number_0 !=='' || number_1  !=='' || !number_2 !=='' || number_3  !=='' || number_4  !=='' || number_5  !=='' || number_6  !=='' || number_7  !=='' || number_8  !=='' || number_8  !=='')
    {
    $.ajax({
            url: base_url + 'save_playing_no_details',
            type: 'POST',
            data: { number_0: number_0,number_1:number_1,number_2:number_2,number_3:number_3,number_4:number_4,number_5:number_5,number_6:number_6,number_7:number_7,number_8:number_8,number_9:number_9},
            success: function(response)
            {
                
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                console.error("Error saving number:", textStatus, errorThrown);
            }
        });
    }
}

$('#betcancel').click(function() 
{
    cancelBet();
});
function cancelBet()
{
    if (selectedButtonIndex === null)
    {
        alert("No bet selected to cancel.");
        return;
    }
    let spanId = `#showNobtn${selectedButtonIndex}`;
    let currentValue = parseInt($(spanId).text());
    let main_scores = parseInt($("#main_score").text());
    // Update the main score
    let updatedMainScore = main_scores + currentValue;
    $("#main_score").text(updatedMainScore);
    localStorage.setItem('main_score', updatedMainScore);
    // Reset the button value
    $(spanId).text(0);
    localStorage.setItem(spanId, 0);
    selectedButtonIndex = null; // Clear the selected button index
    updateTotalAmount();
}

$("#betok").click(function() 
{
   conditinbetok = true; // Declare a flag outside the function
   for (let i = 0; i <= 9; i++)
    {
        $("#myButton"+i).prop("disabled", true);
    }
    save_playing_no_details();
    $("#betok"+i).prop("disabled", true);
});
    
</script>

</body>
</html>