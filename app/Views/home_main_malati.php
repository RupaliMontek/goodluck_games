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
var buttons_disable = false;
var button_increment = false;
var conditionMet = false; // Declare a flag outside the function
var isBetOkClicked = false; // Track if "Bet Ok" has been clicked
var conditinbetok = false;
var condition_cliked_betok = false; // Declare a flag outside the function
get_counter_timer_universal();
setInterval(get_counter_timer_universal, 500);
get_last_10_win_numbers()
setInterval(get_last_10_win_numbers, 500);
fetchRemainingTime();
// Set an interval to periodically fetch the remaining time
setInterval(fetchRemainingTime, 20); // Fetch every second.
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


 function easeOut(t) {
            return t * (2 - t);
        }

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
            let selectedButtonIndex;

function saveOrUpdateUserDetails(index, newValue, updatedMainScore) {
    var token = localStorage.getItem('authToken'); // Get the token from localStorage

    // Log data to be sent for debugging
    console.log('Sending data:', {
        number: index,
        newValue: newValue,
        updatedMainScore: updatedMainScore
    });

    $.ajax({
        url: base_url + 'user/save_bet',
        type: 'POST',
        headers: {
            'Authorization': 'Bearer ' + token // Include the token in the request header
        },
        data: {
            number: index,
            newValue: newValue,
            updatedMainScore: updatedMainScore
        },
        success: function(response) {
            console.log("Bet saved successfully!");
            console.log('Response:', response);
        },
        error: function(xhr, status, error) {
            console.error("Error saving bet:", error);
            console.log('Response:', xhr.responseText); // Log the full response
        }
    });
}

function incrementValue(index) {
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
    
    localStorage.setItem(`showNobtn${index}`, newValue); // Update key to match `spanId`
    
    let updatedMainScore = main_scores - incrementValue;
    $("#main_score").text(updatedMainScore);
    localStorage.setItem('main_score', updatedMainScore);
    
    saveOrUpdateUserDetails(index, newValue, updatedMainScore);
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
    for (let i = 0; i <= 9; i++) 
    {
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
                if (data == newTimeStr) 
                {
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


/*function spinner_spin()
{   
    document.getElementById('change_content').innerText = 'FOR AMUSEMENT ONLY NO CASH VALUE';
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
}*/

// function spinner_spin() {
//     document.getElementById('change_content').innerText = 'FOR AMUSEMENT ONLY NO CASH VALUE';

//     const audio = document.getElementById("myAudio");
//     audio.play();
//     setTimeout(() => {
//         audio.pause();
//         audio.currentTime = 0;
//     }, 1000);

//     const spinBtn = document.getElementById('spin-btn');
//     spinBtn.disabled = true;

//     finalValue.innerHTML = `<p>Spinning...</p>`;

//     // Collect numbers and values
//     const numbers = [];
//     for (let i = 0; i <= 9; i++) {
//         const value = parseInt(document.getElementById(`showNobtn${i}`).innerText, 10);
//         $(`#number${i}`).val(value);
//         numbers.push(value);
//     }

//     const increment_number = parseInt($("input[name='increment_number']:checked").val(), 10);
//     $("#increment_number").val(increment_number);

//     const win_val = parseInt(document.getElementById('winnerBtn').innerText, 10);
//     $("#win_val").val(win_val);

//     const totalamt = document.getElementById('totalamt').innerText;
//     $("#total_number_play").val(totalamt);

//     const anyNonZero = numbers.some(num => num !== 0);

//     $.ajax({
//         url: base_url + 'user/getNumbersBasedOnMode',
//         type: "GET",
//         success: function(data) {
//             const main_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
//             let targetValue = 0;
//             const parsedObject = JSON.parse(data);
//             const valuesString = parsedObject.values;
//             const valuesArray = valuesString.split(',');
//             const savedNumbers = valuesArray.map(Number);
//             const mode_set = parsedObject.mode;
//             const remainingNumbers = main_values.filter(number => !savedNumbers.includes(number));

//             if (mode_set !== 'jackpot_2x' && mode_set !== 'jackpot') {
//                 if (remainingNumbers.length === 0) {
//                     return;
//                 }
//                 const randomIndex = Math.floor(Math.random() * remainingNumbers.length);
//                 targetValue = remainingNumbers[randomIndex];
//             } else {
//                 targetValue = parseInt(valuesString, 10);
//             }

//             let targetAngle;
//             for (let i of rotationValues) {
//                 if (i.value === targetValue) {
//                     targetAngle = (i.minDegree + i.maxDegree) / 2;
//                     break;
//                 }
//             }

//             let currentRotation = myChart.options.rotation;
//             let spinDuration = 2000; // Increased spin duration
//             let intervalDuration = 10; // Interval for updating the rotation
//             let totalSteps = spinDuration / intervalDuration;
//             let rotations = 5; // Number of full rotations before stopping
//             let totalRotation = currentRotation + (360 * rotations) + targetAngle;
//             let step = 0;

//             let rotationInterval = window.setInterval(() => {
//                 step++;
//                 let progress = step / totalSteps;
//                 let easedProgress = easeOut(progress); // Ensure this function is defined and smooth
//                 let currentStepRotation = currentRotation + easedProgress * (totalRotation - currentRotation);
//                 myChart.options.rotation = currentStepRotation % 360;
//                 myChart.update();

//                 if (step >= totalSteps) {
//                     clearInterval(rotationInterval);
//                     // Ensure final rotation is set correctly
//                     myChart.options.rotation = targetAngle;
//                     myChart.update();
//                     finalValue.innerHTML = `<p>Value: ${targetValue}</p>`;
//                     spinBtn.disabled = false;

//                     // Update winner button and other elements
//                     document.getElementById('winnerBtn').textContent = targetValue;
//                     $("#winner_number").val(targetValue);

//                     const winnerValue = parseInt(document.getElementById('winnerBtn').textContent, 10);
//                     const oldScore = parseInt(localStorage.getItem('scoreValue'), 10) || 0;
//                     $("#oldScore").val(oldScore);

//                     const newScore = oldScore + winnerValue;
//                     $("#spin-btn").prop('disabled', winnerValue === 0);

//                     const showNobtnElement = $("#" + 'number' + targetValue).val();
//                     let displayValue = 0;
//                     if (showNobtnElement) {
//                         const showNobtnValue = parseInt(showNobtnElement.trim(), 10);
//                         if (!isNaN(showNobtnValue)) {
//                             displayValue = mode_set !== 'jackpot_2x' && mode_set !== 'jackpot' 
//                                 ? showNobtnValue * 9 
//                                 : showNobtnValue * 18;
//                         }
//                     }
//                     document.getElementById('winnerBtn').textContent = displayValue;
//                     $("#winnerValue").val(displayValue);

//                     if (displayValue !== 0) {
//                         $("#winnerBtn").addClass("btn glow");
//                         $("#take-btn").addClass("btn glow").prop('disabled', false);
//                     }

//                     $.ajax({
//                         url: base_url + 'user/saveStoppedNumber',
//                         type: 'POST',
//                         data: { stoppedNumber: targetValue },
//                         success: function(response) {
//                             console.log("Number saved successfully:", targetValue);
//                         },
//                         error: function(jqXHR, textStatus, errorThrown) {
//                             console.error("Error saving number:", textStatus, errorThrown);
//                         }
//                     });

//                     const counter = document.getElementById("counter").innerHTML;
//                     $("#current_time").val(counter);
//                     $("#current_times").val(counter);
//                     get_last_10_win_numbers();
//                     conditinbetok = false;
//                     condition_cliked_betok = false;
//                     collect_all_loss_amount();

//                     if ((mode_set === 'jackpot_2x' || mode_set === 'jackpot') && displayValue !== 0) {
//                         const popup = document.getElementById('popup');
//                         const successAudio = document.getElementById('successAudio');
//                         popup.style.display = 'block';
//                         successAudio.play();
//                         setTimeout(() => {
//                             popup.style.display = 'none';
//                         }, 4000);
//                         document.getElementById('popup-close-btn').addEventListener('click', () => {
//                             document.getElementById('popup').style.display = 'none';
//                         });
//                     }
//                 }
//             }, intervalDuration);
//         }
//     });

//     localStorage.setItem('main_score', 0);
// }




function spinner_spin() {
    document.getElementById('change_content').innerText = 'FOR AMUSEMENT ONLY NO CASH VALUE';

    const audio = document.getElementById("myAudio");
    audio.play();
    // Stop the audio after 1 second
    setTimeout(() => {
        audio.pause();
        audio.currentTime = 0; // Reset audio to the beginning
    }, 1000);

    const spinBtn = document.getElementById('spin-btn');
    spinBtn.disabled = true;

    finalValue.innerHTML = `<p>Spinning...</p>`;

    // Collect values
    var showNobtn1 = parseInt(document.getElementById('showNobtn1').innerText);
    $("#number1").val(showNobtn1);
    var number1 = $("#number1").val();
    var showNobtn2 = parseInt(document.getElementById('showNobtn2').innerText);
    $("#number2").val(showNobtn2);
    var number2 = $("#number2").val();
    var showNobtn3 = parseInt(document.getElementById('showNobtn3').innerText);
    $("#number3").val(showNobtn3);
    var number3 = $("#number3").val();
    var showNobtn4 = parseInt(document.getElementById('showNobtn4').innerText);
    $("#number4").val(showNobtn4);
    var number4 = $("#number4").val();
    var showNobtn5 = parseInt(document.getElementById('showNobtn5').innerText);
    $("#number5").val(showNobtn5);
    var number5 = $("#number5").val();
    var showNobtn6 = parseInt(document.getElementById('showNobtn6').innerText);
    $("#number6").val(showNobtn6);
    var number6 = $("#number6").val();
    var showNobtn7 = parseInt(document.getElementById('showNobtn7').innerText);
    $("#number7").val(showNobtn7);
    var number7 = $("#number7").val();
    var showNobtn8 = parseInt(document.getElementById('showNobtn8').innerText);
    $("#number8").val(showNobtn8);
    var number8 = $("#number8").val();
    var showNobtn9 = parseInt(document.getElementById('showNobtn9').innerText);
    $("#number9").val(showNobtn9);
    var number9 = $("#number9").val();
    var showNobtn0 = parseInt(document.getElementById('showNobtn0').innerText);
    $("#number0").val(showNobtn0);
    var number0 = $("#number0").val();
    var increment_number = parseInt($("input[name='increment_number']:checked").val(), 10);
    $("#increment_number").val(increment_number);
    var win_val = parseInt(document.getElementById('winnerBtn').innerText);
    $("#win_val").val(win_val);
    var totalamt = document.getElementById('totalamt').innerText;
    $("#total_number_play").val(totalamt);
    if (number1 != 0 || number2 != 0 || number3 != 0 || number4 != 0 || number5 != 0 || number6 != 0 || number7 != 0 || number8 != 0 || number9 != 0 || number0 != 0) {
        buttons_disable = true;
    }
    
    $.ajax({
        url: base_url + 'user/getNumbersBasedOnMode',
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
                    return;
                }
                const randomIndex = Math.floor(Math.random() * remainingNumbers.length);
                targetValue = remainingNumbers[randomIndex];
            } else {
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

            let currentRotation = myChart.options.rotation;
            let spinDuration = 1000; // Spin duration in milliseconds (1 second)
            let intervalDuration = 10; // Interval duration in milliseconds
            let totalSteps = spinDuration / intervalDuration;
            let rotations = 5; // Number of full rotations
            let totalRotation = currentRotation + (360 * rotations) + targetAngle;
            let step = 0;

            let rotationInterval = window.setInterval(() => {
                step++;
                let progress = step / totalSteps;
                let easedProgress = easeOut(progress);
                let currentStepRotation = currentRotation + easedProgress * (totalRotation - currentRotation);
                myChart.options.rotation = currentStepRotation % 360;
                myChart.update();

                if (step >= totalSteps) {
                    clearInterval(rotationInterval);
                    myChart.options.rotation = targetAngle;
                    myChart.update();
                    finalValue.innerHTML = `<p>Value: ${targetValue}</p>`;
                    spinBtn.disabled = false;

                    // Update winner button and other elements
                    document.getElementById('winnerBtn').textContent = targetValue;
                    $("#winner_number").val(targetValue);
                    const winnerButton = document.getElementById('winnerBtn');
                    var winnerValue = parseInt(winnerButton.textContent); // Ensure winnerValue is a number
                    let oldScore = parseInt(localStorage.getItem('scoreValue')) || 0;
                    $("#oldScore").val(oldScore);
                    var totalamt = parseInt(document.getElementById('totalamt').innerText);
                    var winval = parseInt(document.getElementById('winnerBtn').innerText);
                    var winner_number = parseInt($("#winner_number").val());
                    const newScore = oldScore + winnerValue;
                    if (winnerValue !== 0) {
                        var spin_btn = document.getElementById("spin-btn");
                        spin_btn.disabled = false;
                    } else {
                        var spin_btn = document.getElementById("spin-btn");
                        spin_btn.disabled = true;
                    }
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
                            get_last_10_win_numbers();
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
                    collect_all_loss_amount();

                    if ((mode_set === 'jackpot_2x' || mode_set === 'jackpot') && winnerValue !== 0) {
                        const popup = document.getElementById('popup');
                        const successAudio = document.getElementById('successAudio');
                        popup.style.display = 'block';
                        successAudio.play(); // Play the success audio
                        setTimeout(() => {
                            popup.style.display = 'none';
                            setTimeout(() => {
                                location.reload(); // Refresh the page after hiding the popup and 5-second delay
                            }, 5000); // 5 seconds delay before refreshing
                        }, 4000); // Popup display time
                        document.getElementById('popup-close-btn').addEventListener('click', () => {
                            popup.style.display = 'none';
                            setTimeout(() => {
                                location.reload(); // Refresh the page when the popup is closed manually with 5-second delay
                            }, 5000); // 5 seconds delay before refreshing
                        });
                    } else {
                        // If not jackpot, refresh the page after 5 seconds
                        setTimeout(() => {
                            location.reload();
                        }, 5000); // 5 seconds delay before refreshing
                    }
                }
            }, intervalDuration);
        }
    });

    // Additional code for resetting and clearing local storage
    let resultValue;
    totalamt = localStorage.getItem('totalamt');
    localStorage.setItem('main_score', 0);
}






function spinner_spin_old() {
    document.getElementById('change_content').innerText = 'FOR AMUSEMENT ONLY NO CASH VALUE';
    
    const audio = document.getElementById("myAudio");
    audio.play();
    setTimeout(() => {
        audio.pause();
        audio.currentTime = 0;
    }, 1400);

    spinBtn.disabled = true;
    finalValue.innerHTML = `<p>Luck! <i class="fa fa-thumbs-up"></i></p>`;

    $.ajax({
        url: base_url + 'user/getNumbersBasedOnMode', 
        type: "GET",
        success: function(data) {
            const main_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
            const parsedObject = JSON.parse(data);
            const valuesString = parsedObject.values;
            const valuesArray = valuesString.split(',');
            const savedNumbers = valuesArray.map(Number);
            const remainingNumbers = main_values.filter(number => !savedNumbers.includes(number));

            let targetValue = 0;
            const mode_set = parsedObject.mode;

            if (mode_set !== 'jackpot_2x' && mode_set !== 'jackpot') {
                if (remainingNumbers.length === 0) return;
                const randomIndex = Math.floor(Math.random() * remainingNumbers.length);
                targetValue = remainingNumbers[randomIndex];
            } else {
                targetValue = parseInt(valuesString);
            }

            let targetAngle;
            for (let i of rotationValues) {
                if (i.value === targetValue) {
                    targetAngle = (i.minDegree + i.maxDegree) / 2;
                    break;
                }
            }

            $("#winner_number").val(targetValue);

            const winnerButton = document.getElementById('winnerBtn');
            const winnerValue = parseInt(winnerButton.textContent);
            let oldScore = parseInt(localStorage.getItem('scoreValue')) || 0;
            $("#oldScore").val(oldScore);

            if (winnerValue !== 0) {
                spinBtn.disabled = false;
            } else {
                spinBtn.disabled = true;
            }

            const showNobtnIds = ['number0', 'number1', 'number2', 'number3', 'number4', 'number5', 'number6', 'number7', 'number8', 'number9'];
            showNobtnIds.forEach(id => {
                $(`#${id}`).val(parseInt(document.getElementById(id).innerText));
            });

            const increment_number = parseInt($("input[name='increment_number']:checked").val(), 10);
            $("#increment_number").val(increment_number);
            $("#win_val").val(parseInt(document.getElementById('winnerBtn').innerText));

            let resultValue;
            switch (targetValue) {
                case 0: resultValue = 65; break;
                case 1: resultValue = 76.5; break;
                case 2: resultValue = 92; break;
                case 3: resultValue = 102; break;
                case 4: resultValue = 107; break;
                case 5: resultValue = 114; break;
                case 6: resultValue = 128; break;
                case 7: resultValue = 172; break;
                case 8: resultValue = 135.9; break;
                case 9: resultValue = 103; break;
                default: resultValue = 0; break;
            }

            let count = 0;
            let rotationInterval = setInterval(() => {
                myChart.options.rotation += resultValue;
                myChart.update();

                if (myChart.options.rotation >= 360) {
                    count += 1;
                    resultValue -= 3;
                    myChart.options.rotation = 0;
                } else if (count > 15) {
                    if (myChart.options.rotation >= targetAngle) {
                        clearInterval(rotationInterval);
                        count = 0;
                        finalValue.innerHTML = `<p>Value: ${targetValue}</p>`;
                        spinBtn.disabled = false;

                        const showNobtnElement = $(`#number${targetValue}`).val();
                        if (showNobtnElement) {
                            let winnerValue = mode_set !== 'jackpot_2x' && mode_set !== 'jackpot' ? showNobtnElement * 9 : showNobtnElement * 18;
                            document.getElementById('winnerBtn').textContent = winnerValue;
                            $("#winnerValue").val(winnerValue);

                            if (winnerValue !== 0) {
                                $('#winnerBtn, #take-btn').addClass('btn glow');
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

                        $("#current_time").val(document.getElementById("counter").innerHTML);
                        $("#current_times").val(document.getElementById("counter").innerHTML);

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
                            successAudio.play();
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
    if(buttons_disable)
    {
        $('#take-btn').prop('disabled', false);
    }
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


/*$("#take-btn").click(function() 
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
        
});*/


// Event listener for spin button
spinBtn.addEventListener("click", () => {
  spinBtn.disabled = true;
  finalValue.innerHTML = `<p>Spinning...</p>`;
  
  // Target value to stop at (0-9)
  let targetValue = 8; // Change this to the desired target value
  let targetAngle;
  for (let i of rotationValues) {
    if (i.value === targetValue) {
      targetAngle = (i.minDegree + i.maxDegree) / 2;
      break;
    }
  }

  let currentRotation = myChart.options.rotation;
  let spinDuration = 2000; // Spin duration in milliseconds (5 seconds)
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
    }
  }, intervalDuration);
})

$(document).ready(function() {
    // Function to save data to local storage
    function saveToLocalStorage() {
        localStorage.setItem('number1', $("#number1").val());
        localStorage.setItem('number2', $("#number2").val());
        localStorage.setItem('number3', $("#number3").val());
        localStorage.setItem('number4', $("#number4").val());
        localStorage.setItem('number5', $("#number5").val());
        localStorage.setItem('number6', $("#number6").val());
        localStorage.setItem('number7', $("#number7").val());
        localStorage.setItem('number8', $("#number8").val());
        localStorage.setItem('number9', $("#number9").val());
        localStorage.setItem('number0', $("#number0").val());
        localStorage.setItem('winnerValue', $("#winnerValue").val());
        localStorage.setItem('oldScore', $("#oldScore").val());
        localStorage.setItem('win_val', $("#win_val").val());
        localStorage.setItem('increment_number', $("#increment_number").val());
        localStorage.setItem('total_number_play', $("#total_number_play").val());
        localStorage.setItem('winner_number', $("#winner_number").val());
    }

    // Function to retrieve data from local storage and update form fields
    function loadFromLocalStorage() {
        $("#number1").val(localStorage.getItem('number1') || 0);
        $("#number2").val(localStorage.getItem('number2') || 0);
        $("#number3").val(localStorage.getItem('number3') || 0);
        $("#number4").val(localStorage.getItem('number4') || 0);
        $("#number5").val(localStorage.getItem('number5') || 0);
        $("#number6").val(localStorage.getItem('number6') || 0);
        $("#number7").val(localStorage.getItem('number7') || 0);
        $("#number8").val(localStorage.getItem('number8') || 0);
        $("#number9").val(localStorage.getItem('number9') || 0);
        $("#number0").val(localStorage.getItem('number0') || 0);
        $("#winnerValue").val(localStorage.getItem('winnerValue') || 0);
        $("#oldScore").val(localStorage.getItem('oldScore') || 0);
        $("#win_val").val(localStorage.getItem('win_val') || 0);
        $("#increment_number").val(localStorage.getItem('increment_number') || 0);
        $("#total_number_play").val(localStorage.getItem('total_number_play') || 0);
        $("#winner_number").val(localStorage.getItem('winner_number') || 0);
    }

    // Call loadFromLocalStorage on page load
    loadFromLocalStorage();

    // Handle button click
    $("#take-btn").click(function() {
        // Save current form values to local storage
        saveToLocalStorage();

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
        var oldScore = parseInt($("#oldScore").val()) || 0;
        var newScore = oldScore + parseInt(winnerValue) || 0;
        $("#newScore").val(newScore);
        var winner_number = parseInt($("#winner_number").val()) || 0;
        var total_number_play = $("#total_number_play").val();
        var increment_number = $("#increment_number").val();
        var win_val = $("#win_val").val();

        // Ensure `oldScore` is defined
        if (number1 != 0 || number2 != 0 || number3 != 0 || number4 != 0 || number5 != 0 || number6 != 0 || number7 != 0 || number8 != 0 || number9 != 0 || number0 != 0) {
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
                    alert("Success");
                    get_user_balance_amount();
                    $('#take-btn').prop('disabled', true);
                    $("#winnerBtn").removeClass("glow");
                    $("#winnerValue").val(0);
                    $("#winnerBtn").text(0);
                    $("#totalamt").text(0);
                    for (let i = 0; i <= 9; i++) {
                        $(`#showNobtn${i}`).text('0');
                    }
                    // Clear local storage if needed
                    localStorage.removeItem('number1');
                    localStorage.removeItem('number2');
                    localStorage.removeItem('number3');
                    localStorage.removeItem('number4');
                    localStorage.removeItem('number5');
                    localStorage.removeItem('number6');
                    localStorage.removeItem('number7');
                    localStorage.removeItem('number8');
                    localStorage.removeItem('number9');
                    localStorage.removeItem('number0');
                    localStorage.removeItem('winnerValue');
                    localStorage.removeItem('oldScore');
                    localStorage.removeItem('win_val');
                    localStorage.removeItem('increment_number');
                    localStorage.removeItem('total_number_play');
                    localStorage.removeItem('winner_number');
                }
            });
        }
    });
});

function set_all_values_after_loss_game_10_seconds()
{
   buttons_disable = false;
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
    
    console.log("Flag Is "+buttons_disable);
    console.log("Buttons "+conditinbetok);
    const validTimes = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
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
    if ((remainingTime < 0 || remainingTime > 10) && buttons_disable) 
    {
       disableButtons();
    }
    else
    {
      if (validTimes.includes(remainingTime) || conditinbetok || buttons_disable) 
      {
        // console.log("Disable Codition");
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
        {
            //console.log("Enable Codition");
            $('#betok').prop('disabled', false);
        }
        else
        {
            $('#betok').prop('disabled', true);
        }
        enableButtons();
    }
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

document.getElementById('final-value').addEventListener('change', function() {
    localStorage.setItem('spinnerValue', this.value);
});

setInterval(function() {
    localStorage.setItem('spinnerValue', document.getElementById('final-value').value);
}, 60000); // Save every minute
/* document.getElementById('logoutBtn').addEventListener('click', function()
{
    alert("do you want to exit the game");
    window.location.href = "<?php echo base_url("logout") ?>";
});   
*/

document.getElementById('logoutBtn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default logout action

    // Confirm logout
    if (confirm("Do you want to exit the game?")) {
        // Save spinner values and other relevant data
        var spinnerData = {
            number1: $("#number1").val(),
            number2: $("#number2").val(),
            number3: $("#number3").val(),
            number4: $("#number4").val(),
            number5: $("#number5").val(),
            number6: $("#number6").val(),
            number7: $("#number7").val(),
            number8: $("#number8").val(),
            number9: $("#number9").val(),
            number0: $("#number0").val(),
            winnerValue: $("#winnerValue").val(),
            oldScore: $("#oldScore").val(),
            newScore: $("#newScore").val(),
            win_val: $("#win_val").val(),
            increment_number: $("#increment_number").val(),
            total_number_play: $("#total_number_play").val(),
            winner_number: $("#winner_number").val()
        };

        // Send the data to the server
        $.ajax({
            url: base_url + 'user/save_temp_data',
            type: 'POST',
            data: spinnerData,
            success: function(response) {
                // Redirect to logout page after saving data
                window.location.href = base_url + 'logout';
            },
            error: function(xhr, status, error) {
                console.error("Error saving data before logout:", error);
                // Optionally handle the error, such as notifying the user
                window.location.href = base_url + 'logout'; // Redirect even if there was an error
            }
        });
    }
});

</script>
</body>
</html>