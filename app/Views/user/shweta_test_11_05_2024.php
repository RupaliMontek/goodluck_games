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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    <script>var user_id = "<?php echo session()->get('user_id'); ?>";</script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spin Wheel App</title>
    <link  href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet"/>
    <link rel="apple-touch-icon" sizes="180x180" herf="<?php echo base_url("frontend/images/apple-touch-icon.png");?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url("frontend/images/favicon-32x32.png");?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("frontend/images/favicon-16x16.png");?>">
<link rel="manifest" href="<?php echo base_url("frontend/images/site.webmanifest");?>">
  </head>
  <style>
      .disabled-button {
             visibility: visible;
             opacity: 1!important;
             cursor: not-allowed; 
        }
        
        .btn {
            background-color: #f0f0f0; 
        }
        .hidden-text-input {
            display: none;
          }
        .usernameee {
            display: flex;
            align-items: center;
            font-size: 18px;
        }
        .usernameee .fa-volume-up, .fa-volume-off {
            margin-right: 10px; 
            cursor: pointer;
        }
        .forbetttbtnnn button {
            margin-right: 5px;
        }
        #toggle-audio {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin: 0;
            outline: none;
        }
        #toggle-audio i {
            font-size: 18px; 
            color: #ffc107;
        }
        
  </style>
  <body>
<div id="contents" class="container-fluid gamebgg"> 
<audio id="loadingMusic" src="<?php echo base_url("frontend/game_audio/mario.loading.mp3"); ?>" preload="auto"></audio>
<div class="forspinner">     
    <div class="wrapper">
      <div class="container">
        <canvas id="wheel"></canvas>
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
                    <button id="counter_button" type="button" class="btn"><div id="counter"></div></button></div>
                    <input class="form-control" type="hidden" name="numberss" id="numberss">
                     <input class="form-control" type="hidden" name="modes" id="modes">
                     <div class="forbtnnn">
                        <h6>Last 10 Data</h6>
                       
                  <button style="" type="button" class="btn fornewbtnLasttenno">
                     
       <ul class="horizontal-list" id="last_10_reuslts">
        <?php
            $count = 0; 
            foreach ($last_ten_results as $result): 
                if($result["mode_set"]=='jackpot_2x')
                {
                     $jackpot_class = "jackpot2_class";
                }
                else
                {
                    $jackpot_class = "";
                }
                if ($count < 10): 
        ?>
            <li class="<?= $jackpot_class; ?>"><?php if($result["mode_set"]=='jackpot_2x')
                {
                     echo '';
                     $jackpot_class = "jackpot2_class";
                } echo htmlspecialchars($result['numbers']); ?></li>
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
<audio id="radio-sound" src="<?php echo base_url("frontend/game_audio/click558.mp3"); ?>" preload="auto"></audio>
        <div class="forCircledNumberss">
            <div class="forCirclebtnnn">
                <div class="radio-button">
                    <input type="radio" id="radio1" name="increment_number" value="1" class="btn" checked="checked">
                    <label for="radio1">1</label> 
                    <input type="radio" id="radio2" name="increment_number" value="5" class="btn">
                    <label for="radio2">5</label>
                    <input type="radio" id="radio3" name="increment_number" value="10" class="btn">
                    <label for="radio3">10</label>
                    <input type="radio" id="radio4" name="increment_number" value="50" class="btn">
                    <label for="radio4">50</label>
                </div>
            </div>
            <div class="forCirclebtnnn">
                <div class="radio-button">
                    <input type="radio" id="radio5" name="increment_number" value="100" class="btn">
                    <label for="radio5">100</label>
                    <input type="radio" id="radio6" name="increment_number" value="500" class="btn">
                    <label for="radio6">500</label>
                    <input type="radio" id="radio7" name="increment_number" value="1000" class="btn">
                    <label for="radio7">1000</label>
                    <input type="radio" id="radio8" name="increment_number" value="5000" class="btn">
                    <label for="radio8">5000</label>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('input[type="radio"]').forEach(function(radio) {
        radio.addEventListener('click', function() {
            let soundId;
            switch (this.value) {
                case '1':
                    soundId = 'radio-sound';
                    break;
                case '5':
                    soundId = 'radio-sound';
                    break;
                case '10':
                    soundId = 'radio-sound';
                    break;
                case '50':
                    soundId = 'radio-sound';
                    break;
               
                default:
                    soundId = 'radio-sound';
            }
            document.getElementById(soundId).play();
        });
    });
</script>
<div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 frusernameHedddd">
                 <h2 class="usernameee"><button id="toggle-audio" onclick="toggleAudio()">
                    <i id="audio-icon" class="fas fa-volume-up"></i>
                </button><i class="fa fa-user"></i> : <?=  ucwords($username); ?></h2>
                <div class="forbettt"> 
                    <div class="forbetttbtnnn">
                    <button type="button" id="take-btn"  class="btn glow">Take</button>
                    <button  type="button" class="btn" id="onebetcancel">Cancel Bet</button>
                    
                    <input type="hidden" id="mycurrentno" name="mycurrentno">
                    <input type="hidden" id="mycurrentno_mode" name="mycurrentno_mode">
                    <input type="hidden" id="my_spinner_no" name="my_spinner_no">
                    </div>
                     <div class="forbetttbtnnn">
                    <input type"text" id="myhidespcific" class="hidden-text-input">    
                    <button type="button" class="btn" id="betcancel">Cancel Specific Bet</button>
                    <div class="frDisplayGoodOnMobilee">
                    <button type="button" class="btn" id="betok">Bet Ok</button>
                    <button type="button" onclick="bet_previous()" class="btn" id="prevok">Prev</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 finalValueOuterDiv">
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
  
<div class="popup" id="popup" style="display: none;">
    <button class="popup-close" id="popup-close-btn">&times;</button>
    <a class="poplinkkkk" href="#" >
        <img src="<?php echo base_url("frontend/images/joker.png"); ?>" alt="" width="100%" height="auto">
        
        <audio id="successAudio">
            <source src="<?php echo base_url("frontend/game_audio/jocker558.mp3"); ?>" type="audio/mpeg">
        </audio>
        
    </a>
</div>
<audio id="button-sound" src="<?php echo base_url("frontend/game_audio/click558.mp3"); ?>" preload="auto"></audio>
<audio id="value-appeared-sound" src="<?php echo base_url("frontend/game_audio/winner.mp3"); ?>" preload="auto"></audio>
<audio id="winner-sound" src="<?php echo base_url("frontend/game_audio/whistle_3_sec.mp3"); ?>" preload="auto"></audio>
<audio id="counter-sound" src="<?php echo base_url("frontend/game_audio/clock-ticking_10_sec.mp3"); ?>" preload="auto"></audio>
<audio id="tickSound" src="<?php echo base_url('frontend/game_audio/timer.mp3'); ?>" preload="auto" loop></audio>
<script>

$(document).ready(function() {

            addSoundEffectToButtons();
        });

        function addSoundEffectToButtons() {
           var buttons = document.querySelectorAll('button');
buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var audio = document.getElementById('button-sound');
                    audio.play();
                });
            });
        }
       
var base_url = "<?php echo base_url(); ?>";
let count = 0;
const wheel = document.getElementById("wheel");
const spinBtn = document.getElementById("spin-btn");
var modalShown = false; 
const finalValue = document.getElementById("final-value");
var selectedButtonIndex = null;
var loss_amount_minus = false;
var buttons_disable = false;
var button_increment = false;
var conditionMet = false; 
var isBetOkClicked = false; 
var takebtnClicked = true;
var spinnerbet = false;
var conditinbetok = false;
var bet = false
var condition_cliked_betok = false; 
var loss_amount_collect = false;
get_counter_timer_universal();
setInterval(get_counter_timer_universal, 500);
setInterval(get_last_10_win_numbers, 20);
fetchRemainingTime();
setInterval(fetchRemainingTime, 20); 
let spinnerStates = {}; // Track spinner states for each user
const rotationValues = [
    { minDegree: 0, maxDegree: 35, value: 0 },
    { minDegree: 36, maxDegree: 71, value: 1 },
    { minDegree: 72, maxDegree: 107, value: 2 },
    { minDegree: 108, maxDegree: 143, value: 3 },
    { minDegree: 144, maxDegree: 179, value: 4 },
    { minDegree: 180, maxDegree: 215, value: 5 }, 
    { minDegree: 216, maxDegree: 251, value: 6 },
    { minDegree: 252, maxDegree: 287, value: 7 },
    { minDegree: 288, maxDegree: 323, value: 8 },
    { minDegree: 324, maxDegree: 359, value: 9 },
];
const data = [16, 16, 16, 16, 16, 16, 16, 16, 16, 16];
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

let myChart = new Chart(wheel, {
  plugins: [ChartDataLabels],
  type: "pie",
  data: {
    labels: [9, 8, 7, 6, 5, 4, 3, 2, 1, 0], 
   datasets: [
      {
        backgroundColor: pieColors,
        data: data,
      },
    ],
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
           
            $("#take-btn").removeClass("glow");
            let incrementSpeed = 200; 
            let longPressIntervalId;

            for (let i = 0; i < 10; i++) {
                let buttonHtml = `<div class="CounterrOuterrbtn">
                                    <span class="showNobtn" id="showNobtn${i}">0</span>
                                    <button id="myButton${i}" class="btn number-btn" disabled>${i}</button>
                                  </div>`;
                $('#buttons').append(buttonHtml);
            }
            
const buttonSound = document.getElementById('button-sound');

            for (let i = 0; i < 10; i++) {
                (function(i) {
                    $(`#myButton${i}`).on('mousedown', function() {
                        
                        selectedButtonIndex = i; 
                        incrementValue(i); 
                        playSound();
                        
                        longPressIntervalId = setInterval(() => {
                            incrementValue(i);
                            playSound();
                        }, incrementSpeed);
                    }).on('mouseup mouseleave', function() {
                        clearInterval(longPressIntervalId);
                    });
                })(i);
            }

function saveOrUpdateUserDetails(index, newValue, updatedMainScore) {
    var token = localStorage.getItem('authToken'); 
$.ajax({
        url: base_url + 'user/save_bet',
        type: 'POST',
        headers: {
            'Authorization': 'Bearer ' + token 
        },
        data: {
            number: index,
            newValue: newValue,
            updatedMainScore: updatedMainScore
        },
        success: function(response) {
           
        },
        error: function(xhr, status, error) {
            
        }
    });
}
function playSound() {
    buttonSound.currentTime = 0; 
    buttonSound.play();
}

function incrementValue(index) {
    $("#prevok").hide();
    $("#betok").show();
    let spanId = `#showNobtn${index}`;
    $("#myhidespcific").val(spanId);
    bet = true;
    let currentValue = parseInt($(spanId).text());
    let incrementValue = parseInt($('input[name="increment_number"]:checked').val());
    let main_scores = parseInt($("#main_score").text());
    
    if (main_scores < incrementValue) {
        alert("Insufficient score to add this value");
        clearInterval(longPressIntervalId); 
        return;
    }
    
    $('.number-btn').removeClass('active');
    $(`#myButton${index}`).addClass('active');
    currentValue += incrementValue;
    let newValue = currentValue;
    $(spanId).text(newValue);
    
    localStorage.setItem(`showNobtn${index}`, newValue); 
    
    let updatedMainScore = main_scores - incrementValue;
    $("#main_score").text(updatedMainScore);
    localStorage.setItem('main_score', updatedMainScore);
    
    saveOrUpdateUserDetails(index, newValue, updatedMainScore);
    updateTotalAmount();
    
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
			  $("#oldScore").val(scoreValue);
			   updateScore(scoreValue);
			}
	});
}    

function updateScore(score) 
{
    
    let main_score = localStorage.getItem('main_score');
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
function playSound() {
            var audio = new Audio('<?php echo base_url("frontend/game_audio/clock-ticking-2.wav"); ?>');
            audio.loop = true; 
            audio.play()
                .then(() => {
                   
                })
                .catch(error => {
                   
                });
        }
document.addEventListener('DOMContentLoaded', function() {
            playSound();
        });
function get_counter_timer_universal() 
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
    
    var tickSound = document.getElementById('tickSound');
$.ajax({
        url: base_url + 'user/get_universal_counter_timer_all',
        type: "GET",
        dataType: 'json', 
        success: function(data) {
            var displayTime = data.display_time.replace(/"/g, '');
$("#counter").html(displayTime);
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

                if (displayTime === newTimeStr && 
                    (number0 !== 0 || number1 !== 0 || number2 !== 0 || number3 !== 0 || number4 !== 0 || 
                     number5 !== 0 || number6 !== 0 || number7 !== 0 || number8 !== 0 || number9 !== 0)) 
                {
                    if (!bet && !takebtnClicked) {
                        $("#take-btn").trigger('click');
                        get_last_10_win_numbers();
                        $("#take-btn").removeClass("glow");
                        takebtnClicked = true;
                        set_all_values_after_loss_game_10_seconds();
                    }
                    $("#take-btn").removeClass("glow");

                    $('.forBottomCounterr button.active').each(function() {
                        $(this).removeClass('active');
                    });
                }
            }
          let   user_id= '<?php echo $_SESSION["user_id"];?>';
if (displayTime === '01:59' && !spinnerCalled) {
                $("#take-btn").removeClass("glow");
                $("#winnerBtn").removeClass("glow");
                
                spinner_spin();
                spinnerCalled = true;
            }
            if (displayTime === '00:59' && !spinnerCalled) {
                $("#take-btn").removeClass("glow");
                $("#winnerBtn").removeClass("glow");
                spinner_spin();
                spinnerCalled = true;
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching timer data:", error);
        }
    });
}


function triggerCancel() {
            $('#onebetcancel').click(); 
        }
 

if (!sessionStorage.getItem("spinnerCalled")) {
    sessionStorage.setItem("spinnerCalled", "false");
}
function spinner_spin() {
   
    if (spinnerCalled) {
        return;
    }
    spinnerCalled = true;

    buttons_disable = true;
    document.getElementById('change_content').innerText = 'FOR AMUSEMENT ONLY NO CASH VALUE';

    const audio = document.getElementById("myAudio");
    const buttonSound = document.getElementById('winner-sound');

    
    setTimeout(() => {
        buttonSound.pause();
        buttonSound.currentTime = 0;
    }, 3000);

    audio.play();
    setTimeout(() => {
        audio.pause();
        audio.currentTime = 0;
    }, 7000);

    spinBtn.disabled = true;
    $('#prevok').hide();
    finalValue.innerHTML = `<p>Spinning...</p>`;

   
    $.ajax({
        url: base_url + 'user/getTargetValue',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                startSpinnerAnimation(response.targetValue, response.mode);
            } else {
                console.error('Error fetching target value:', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', xhr.responseText);
        }
    });
}


function startSpinnerAnimation(targetValue, mode_set) {
    
  

    let currentRotation = myChart.options.rotation;
    let spinDuration = 4000;
    let intervalDuration = 40;
    let numberOfSegments = 10;
    
              /*  let remainingNumbers = main_values.filter(number => !savedNumbers.includes(number));

    
      if (mode_set !== 'jackpot_2x' && mode_set !== 'jackpot') {
                if (remainingNumbers.length === 0) {
                    return;
                }
                const randomIndex = Math.floor(Math.random() * remainingNumbers.length);
                targetValue = remainingNumbers[randomIndex];
            } else {
                targetValue = parseInt(valuesString);
            }
*/
    let targetAngle;
            for (let i of rotationValues) {
                if (i.value === targetValue) {
                    targetAngle = (i.minDegree + i.maxDegree) / 2;
                    break;
                }
            }
    let totalRotation = (360 * 5) + targetAngle;

    let startTime = performance.now();
    let endTime = startTime + spinDuration;

    let rotationInterval = window.setInterval(() => {
        let currentTime = performance.now();
        if (currentTime >= endTime) {
            clearInterval(rotationInterval);

            myChart.options.rotation = targetAngle;
            myChart.update();
            finalValue.innerHTML =  `<p>Value: ${targetValue}</p>`;
            spinBtn.disabled = false;
            buttons_disable = false;

            document.getElementById('winnerBtn').textContent = targetValue;
            $("#winner_number").val(targetValue);

            saveStoppedNumber(targetValue, mode_set);
            return;
        }

        let progress = (currentTime - startTime) / (endTime - startTime);
        let easedProgress = easeOut(progress);
        let currentStepRotation = currentRotation + easedProgress * (totalRotation - currentRotation);
        myChart.options.rotation = currentStepRotation % 360;
        myChart.update();
    }, intervalDuration);
}

function easeOut(t) {
    return t * (2 - t);
}


function saveStoppedNumber(targetValue, mode_set, remainingNumbers) {
    $.ajax({
        url: base_url + 'user/saveStoppedNumber',
        type: 'POST',
        data: { 
            user_id: '<?php echo $_SESSION["user_id"];?>', 
            mode_set: mode_set,
           
            target_value: targetValue
        },
        dataType: 'json',
        success: function(responseData) {
            if (responseData.success) {
                console.log('Number saved successfully: ', responseData.value);
            } else if (responseData.message === 'Duplicate entry') {
                console.warn('Entry already exists for this user in this minute.');
            } else {
                console.error('Error:', responseData.message);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error saving number:', textStatus, errorThrown, jqXHR.responseText);
        }
    });
} 



function spinner_spin2() {
    buttons_disable = true;
    if (spinnerCalled) {
        return;
    }
    spinnerCalled = true;
    document.getElementById('change_content').innerText = 'FOR AMUSEMENT ONLY NO CASH VALUE';

    const audio = document.getElementById("myAudio");
    const buttonSound = document.getElementById('winner-sound');

    setTimeout(function () {
        buttonSound.pause();
        buttonSound.currentTime = 0;
    }, 3000);

    audio.play();
    setTimeout(() => {
        audio.pause();
        audio.currentTime = 0;
    }, 7000);

    spinBtn.disabled = true;
    $('#prevok').hide();
    finalValue.innerHTML = `<p>Spinning...</p>`;

    let showNobtn1 = parseInt(document.getElementById('showNobtn1').innerText);
    $("#number1").val(showNobtn1);
    let win_val = parseInt(document.getElementById('winnerBtn').innerText);
    $("#win_val").val(win_val);

    $.ajax({
        
         url: base_url + 'user/getNumbersBasedOnMode',
        type: "GET",
        success: function (data) {
            let main_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
            let parsedObject = JSON.parse(data);
            let valuesString = parsedObject.values;
            let savedNumbers = valuesString.split(',').map(Number);
            let mode_set = parsedObject.mode;
            let targetValue = parsedObject.targetValue; 

         
            if (savedNumbers.includes(targetValue)) {
                console.error('Target value is already saved. Please refresh the numbers.');
                return;
            }

            let targetAngle;
            for (let i of rotationValues) {
                if (i.value === targetValue) {
                    targetAngle = (i.minDegree + i.maxDegree) / 2;
                    break;
                }
            }

            let currentRotation = myChart.options.rotation;
            let spinDuration = 4000; 
            let intervalDuration = 40;
            let totalRotation = (360 * 5) + targetAngle; 
            let startTime = performance.now(); 
            let endTime = startTime + spinDuration; 

            let rotationInterval = window.setInterval(() => {
                let currentTime = performance.now();
                if (currentTime >= endTime) {
                    clearInterval(rotationInterval);
                    myChart.options.rotation = targetAngle;
                    myChart.update();
                    finalValue.innerHTML = `<p>Value: ${targetValue}</p>`;
                    spinBtn.disabled = false;
                    buttons_disable = false;
                    document.getElementById('winnerBtn').textContent = targetValue;
                    $("#winner_number").val(targetValue);

                   
                    $.ajax({
                        url: base_url + 'user/saveStoppedNumber',
                        type: 'POST',
                        data: { stoppedNumber: targetValue, mode_set: mode_set },
                        success: function (response) {
                            console.log('Stopped number saved for all users: ', response.value);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error saving stopped number:', textStatus, errorThrown);
                        }
                    });

                    return;
                }

                let progress = (currentTime - startTime) / (endTime - startTime);
                let easedProgress = easeOut(progress); 
                let currentStepRotation = currentRotation + easedProgress * (totalRotation - currentRotation);
                myChart.options.rotation = currentStepRotation % 360;
                myChart.update();
            }, intervalDuration);
        }
    });

    let resultValue;
    totalamt = localStorage.getItem('totalamt');
    localStorage.setItem('main_score', 0);
}

function spinner_spin1() {
    buttons_disable = true;
    if (spinnerCalled) {
        return;
    }
    spinnerCalled = true;
    document.getElementById('change_content').innerText = 'FOR AMUSEMENT ONLY NO CASH VALUE';

    const audio = document.getElementById("myAudio");
    const buttonSound = document.getElementById('winner-sound');

    setTimeout(function () {
        buttonSound.pause();
        buttonSound.currentTime = 0;
    }, 3000);

    audio.play();
    setTimeout(() => {
        audio.pause();
        audio.currentTime = 0;
    }, 7000);

    spinBtn.disabled = true;
    $('#prevok').hide();
    finalValue.innerHTML = `<p>Spinning...</p>`;

    let showNobtn1 = parseInt(document.getElementById('showNobtn1').innerText);
    $("#number1").val(showNobtn1);
    let number1 = $("#number1").val();

    // Repeat similar logic for other number buttons...

    let win_val = parseInt(document.getElementById('winnerBtn').innerText);
    $("#win_val").val(win_val);

    // AJAX call to get available numbers
    $.ajax({
        url: base_url + 'user/getNumbersBasedOnMode',
        type: "GET",
        success: function (data) {
            let main_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
            let parsedObject = JSON.parse(data);
            let valuesString = parsedObject.values;
            let valuesArray = valuesString.split(',');
            let savedNumbers = valuesArray.map(Number);
            let mode_set = parsedObject.mode;
            let remainingNumbers = main_values.filter(number => !savedNumbers.includes(number));
            console.log(remainingNumbers); 
            let targetValue = 0;

            if (mode_set !== 'jackpot_2x' && mode_set !== 'jackpot') {
                if (remainingNumbers.length === 0) {
                    return;
                }
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

            let currentRotation = myChart.options.rotation;
            let spinDuration = 4000; // Spin duration in ms
            let intervalDuration = 40; // Interval duration in ms
            let totalSteps = spinDuration / intervalDuration;
            let rotations = 5; // Number of full rotations before target stop
            let totalRotation = (360 * rotations) + targetAngle; // Total rotation to reach target angle
            let step = 0;

            let startTime = performance.now(); // Start timer in milliseconds
            let endTime = startTime + spinDuration; // Set end time

            let rotationInterval = window.setInterval(() => {
                let currentTime = performance.now();
                if (currentTime >= endTime) {
                    clearInterval(rotationInterval);
                    myChart.options.rotation = targetAngle;
                    myChart.update();
                    finalValue.innerHTML = `<p>Value: ${targetValue}</p>`;
                    spinBtn.disabled = false;
                    buttons_disable = false;
                    document.getElementById('winnerBtn').textContent = targetValue;
                    $("#winner_number").val(targetValue);

                    // Save stopped number via AJAX
                    $.ajax({
                        url: base_url + 'user/saveStoppedNumber',
                        type: 'POST',
                        data: { stoppedNumber: targetValue, mode_set: mode_set ,remainingNumbers:remainingNumbers},
                        success: function (response) {
                            // Process response here if needed
                            console.log('Stopped number saved for all users: ', response.value);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error saving stopped number:', textStatus, errorThrown);
                        }
                    });

                    return;
                }

                let progress = (currentTime - startTime) / (endTime - startTime);
                let easedProgress = easeOut(progress); // Ease out function for smooth spinning
                let currentStepRotation = currentRotation + easedProgress * (totalRotation - currentRotation);
                myChart.options.rotation = currentStepRotation % 360;
                myChart.update();
            }, intervalDuration);
        }
    });

    let resultValue;
    totalamt = localStorage.getItem('totalamt');
    localStorage.setItem('main_score', 0);
}

function spinner_spinnot_working() {
    buttons_disable = true;
    if (spinnerCalled) {
        return;
    }
    spinnerCalled = true;
    document.getElementById('change_content').innerText = 'FOR AMUSEMENT ONLY NO CASH VALUE';
    
    const audio = document.getElementById("myAudio");
    const buttonSound = document.getElementById('winner-sound');

    setTimeout(function () {
        buttonSound.pause();
        buttonSound.currentTime = 0;
    }, 3000);

    audio.play();
    setTimeout(() => {
        audio.pause();
        audio.currentTime = 0;
    }, 7000);

    spinBtn.disabled = true;
    $('#prevok').hide();
    finalValue.innerHTML = `<p>Spinning...</p>`;

    let showNobtn1 = parseInt(document.getElementById('showNobtn1').innerText);
    $("#number1").val(showNobtn1);
    let number1 = $("#number1").val();
    
    let win_val = parseInt(document.getElementById('winnerBtn').innerText);
    $("#win_val").val(win_val);

    $.ajax({
        url: base_url + 'user/getGlobalSpinResult',
        type: "GET",
      
        success: function (data) {
            let parsedObject = JSON.parse(data);
            let targetValue = parseInt(parsedObject.targetValue);  
            let mode_set = parsedObject.mode;

            let targetAngle;
            for (let i of rotationValues) {
                if (i.value === targetValue) {
                    targetAngle = (i.minDegree + i.maxDegree) / 2;
                    break;
                }
            }

            let currentRotation = myChart.options.rotation;
            let spinDuration = 4000; 
            let intervalDuration = 40; 
            let totalSteps = spinDuration / intervalDuration;
            let rotations = 5; 
            let totalRotation = (360 * rotations) + targetAngle; 
            let step = 0;

            let startTime = performance.now(); 
            let endTime = startTime + spinDuration; 

            let rotationInterval = window.setInterval(() => {
                let currentTime = performance.now();
                if (currentTime >= endTime) {
                    clearInterval(rotationInterval);
                    myChart.options.rotation = targetAngle;
                    myChart.update();
                    finalValue.innerHTML = `<p>Value: ${targetValue}</p>`;
                    spinBtn.disabled = false;
                    buttons_disable = false;
                    document.getElementById('winnerBtn').textContent = targetValue;
                    $("#winner_number").val(targetValue);

                    
                    $.ajax({
                        url: base_url + 'user/saveStoppedNumber',
                        type: 'POST',
                        data: { stoppedNumber: targetValue, mode_set: mode_set }, 
                        success: function(response) {
                           
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                           
                        }
                    });

                    return;
                }

                let progress = (currentTime - startTime) / (endTime - startTime);
                let easedProgress = easeOut(progress); 
                let currentStepRotation = currentRotation + easedProgress * (totalRotation - currentRotation);
                myChart.options.rotation = currentStepRotation % 360;
                myChart.update();
            }, intervalDuration);
        },
        error: function() {
            console.error("Error in fetching global spin result.");
        }
    });

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
                              
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                               
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
    $('#prevok').hide();
    $("#betok").show();
    $.ajax({
        url: '<?= site_url('user/getPreviousBetData') ?>',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data) {
                var main_score = parseInt($("#main_score").text(), 10);
                var after_bet_prv = main_score - parseInt(data.total, 10);

                if (after_bet_prv < 0) {
                    alert('Insufficient balance! You cannot place this bet.');
                } else {
                    for (let i = 0; i < 10; i++) {
                        $(`#showNobtn${i}`).text(data[`showNobtn${i}`] || '0');
                    }

                    $('#totalamt').text(data.total);
                    $('#main_score').text(after_bet_prv);
                }

                $('#prevok').hide();
            } else {
                $('#prevok').show();
            }
        },
        error: function(xhr, status, error) {
            $('#prevok').show();
        }
    });
}

function bet_previous_old()
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
    loss_amount_collect = false;

    $('#totalamt,#betok,#betcancel,#onebetcancel,#prevok,#myButton1,#myButton2,#myButton3,#myButton4,#myButton5,#myButton6,#myButton7,#myButton8,#myButton9,#myButton0,#logoutBtn').prop('disabled', true).addClass('disabled-button');
    var spin_btn = document.getElementById("spin-btn");
    spin_btn.disabled = true;
    var counter_button = document.getElementById("counter_button");
    counter_button.classList.add("btn","glow");
    const buttonSound = document.getElementById('counter-sound');
     buttonSound.play();
    setTimeout(function() {
        buttonSound.pause();
        buttonSound.currentTime = 0; 
    }, 10000);
    for (let i = 0; i <= 9; i++)
    {
        $('#myButton'+i).prop('disabled', true);
    }
}


function enableButtons()
{
    // alert('hi');
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
        
        $("#prevok").show();
       
        document.getElementById('change_content').innerText = 'Congratulations!!! You Win';  
        
    }
    else if ((number1 != 0 || number2 != 0 || number3 != 0 || number4 != 0 || number5 != 0 || number6 != 0 || number7 != 0 || number8 != 0 || number9 != 0 || number0 != 0) && button_increment)
    {
       
        document.getElementById('change_content').innerText = 'You can either make Bet or Press BETOK Button'; 
         
        
    }
    else
    {  
        document.getElementById('change_content').innerText = 'Please bet to start game. Minimum Bet = 1'; 
        
    }
    
    $('#totalamt,#betcancel,#onebetcancel,#prevok,#myButton1,#myButton2,#myButton3,#myButton4,#myButton5,#myButton6, #myButton7,#myButton8,#myButton9,#myButton0,#logoutBtn').prop('disabled', false);
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
            
           
            $('.forBottomCounterr button.active').each(function() {
                $(this).removeClass('active');
            });
            
        }
        $('#betok').prop('disabled', true);
        $('#totalamt').text('0'); 
        localStorage.setItem('main_score', 0);
        get_user_balance_amount();
});

function get_last_10_win_numbers() {
    $.ajax({
        url: "<?php echo base_url('get_last_10_win_numbers'); ?>",
        type: 'POST',
        data: {},
        dataType: 'json', 
        success: function(data) {
            
            $('#last_10_reuslts').empty();
            
            for (var i = 0; i < Math.min(10, data.length); i++) {
                var item = data[i];
               
                var jackpot_class = item.mode_set === 'jackpot_2x' ? 'jackpot2_class' : '';
                
                var listItem = $('<li>').addClass(jackpot_class).text(item.numbers);
                
                $('#last_10_reuslts').append(listItem);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error fetching numbers:", textStatus, errorThrown);
        }
    }); 
}



$(document).ready(function() {
    
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

    
    loadFromLocalStorage();

   
    $("#take-btn").click(function() 
    {   
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
        takebtnClicked = true;
        var oldScore = parseInt($("#oldScore").val()) || 0;
        var newScore = oldScore + parseInt(winnerValue) || 0;
        $("#newScore").val(newScore);
        var winner_number = parseInt($("#winner_number").val()) || 0;
        var total_number_play = $("#total_number_play").val();
        var increment_number = $("#increment_number").val();
        var win_val = $("#win_val").val();
        $("#take-btn").removeClass("glow");

       
        if (number1 != 0 || number2 != 0 || number3 != 0 || number4 != 0 || number5 != 0 || number6 != 0 || number7 != 0 || number8 != 0 || number9 != 0 || number0 != 0) {
            var token = localStorage.getItem('authToken'); 
            $.ajax({
                url: base_url + 'user/save_winning_details',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token 
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
                success: function(response) 
                {
                    get_user_balance_amount();
                    $('#take-btn').prop('disabled', true);
                    $("#winnerBtn").removeClass("glow");
                    $("#winnerValue").val(0);
                    $("#winnerBtn").text(0);
                    $("#totalamt").text(0);
                    for (let i = 0; i <= 9; i++) {
                        $(`#showNobtn${i}`).text('0');
                    }
                   
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
   
   var time_parts = current_time_str.split(':');
   var minutes = parseInt(time_parts[0], 10);
   var seconds = parseInt(time_parts[1], 10);
  
  var total_seconds = minutes * 60 + seconds;
  
  total_seconds -= 10;
 
  if (total_seconds < 0) 
  {
      total_seconds = 0; 
  }
  
   var new_minutes = Math.floor(total_seconds / 60);
   var new_seconds = total_seconds % 60;

   
   const new_time_str = ('0' + new_minutes).slice(-2) + ':' + ('0' + new_seconds).slice(-2);
   var counter_time = $('#counter').text();
  
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

var conditionMet = false; 
function collect_all_loss_amount()
{ 
    
    if (!loss_amount_collect) 
    {
    loss_amount_collect = true;
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
    var oldScore = parseFloat($("#oldScore").val()) || 0; 
    var newScore = oldScore + parseFloat(winnerValue);
    $("#newScore").val(newScore);
    var winner_number = parseInt($("#winner_number").val());
    var total_number_play = $("#total_number_play").val();
    var increment_number = $("#increment_number").val();
    var newScore = $("#newScore").val();
    var win_val = $("#win_val").val();

    
        conditionMet = true; 
        var token = localStorage.getItem('authToken'); 
        $.ajax({
            url: base_url + 'user/save_winning_details',
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token 
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
            success: function(response) 
            {
                get_user_balance_amount();
                loss_amount_minuus = true;
                $('#take-btn').prop('disabled', true);
                $("#winnerValue").val(0);
                $("#number1").val(0);
                $("#number2").val(0);
                $("#number3").val(0); 
                $("#number4").val(0);
                $("#number5").val(0);
                $("#number6").val(0);
                $("#number7").val(0);
                $("#number8").val(0);
                $("#number9").val(0);
                $("#number0").val(0);
                $("oldScore").val(0);
            },
            error: function() 
            {
                conditionMet = false; 
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
        modalShown = true; 
    }
    else
    {
        $('#waitNextGameModal').modal('hide');
        modalShown = false; 
    }
}

$('#betok').on('click', function()
{
    isBetOkClicked = true;
    disableButtons(); 
});

function fetchRemainingTime() 
{   
  
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
    
    if ((remainingTime >= 0 && remainingTime <=10)) 
    {
        spinnerCalled = false;
        loss_amount_collect = false;
        bet = false;
    }
    if ((remainingTime < 0 || remainingTime > 10) && buttons_disable) 
    {   
        
       disableButtons();
      
       
    }
    else
    {
         
      if (validTimes.includes(remainingTime) || conditinbetok || buttons_disable) 
      {
         
        if ((showNobtn1!==0 || showNobtn2!==0 || showNobtn3!==0 ||  showNobtn4!==0 || showNobtn5!==0 || showNobtn6!==0 || showNobtn7!==0 ||showNobtn8!==0 || showNobtn9!==0 || showNobtn0!==0 || isBetOkClicked || takebtnClicked) && !conditinbetok)
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

$('#betcancel').click(function() {
    $('.forBottomCounterr button.active').each(function() {
        $(this).removeClass('active');
    });
    cancelBet();
});



function cancelBet() {
    let spanId = $("#myhidespcific").val().trim();
    let currentValue = parseInt($(spanId).text());
    if (isNaN(currentValue)) {
        alert("Invalid bet value.");
        return;
    }
    
    let main_scores = parseInt($("#main_score").text());
    if (isNaN(main_scores)) {
        alert("Invalid main score.");
        return;
    }
   
    let updatedMainScore = main_scores + currentValue;
    $("#main_score").text(updatedMainScore);
    localStorage.setItem('main_score', updatedMainScore);
    
    $(spanId).text(0);
    localStorage.setItem(spanId, 0);
    let element = currentValue;
    let totalAmt = localStorage.getItem('totalamt');
    
     totalAmt = Number(totalAmt);
    let new_total_amt=totalAmt-element;
     $("#totalamt").html(new_total_amt);
    selectedButtonIndex = null;
    
    updateTotalAmount();
}
$("#betok").click(function() 
{
   conditinbetok = true; 
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
}, 60000); 

document.getElementById('logoutBtn').addEventListener('click', function(event) {
    event.preventDefault();

    if (confirm("Do you want to exit the game?")) {
        
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

        $.ajax({
            url: base_url + 'user/save_temp_data',
            type: 'POST',
            data: spinnerData,
            success: function(response) {
                
                window.location.href = base_url + 'logout';
            },
            error: function(xhr, status, error) {
                console.error("Error saving data before logout:", error);
               
                window.location.href = base_url + 'logohome'; 
            }
        });
    }
});

</script>
 <script>
    document.addEventListener('DOMContentLoaded', function() {
        var tickSound = document.getElementById('tickSound');
        var soundIcon = document.getElementById('soundIcon');

        var allSounds = [
            tickSound,
            document.getElementById('button-sound'),
            document.getElementById('value-appeared-sound'),
            document.getElementById('winner-sound'),
            document.getElementById('counter-sound')
        ];

        function startSound() {
            tickSound.play().then(function() {
             
                soundIcon.classList.remove('fa-volume-off');
                soundIcon.classList.add('fa-volume-up');
                localStorage.setItem('soundState', 'playing');
            }).catch(function(error) {
                
            });
        }

        function stopAllSounds() {
            allSounds.forEach(function(sound) {
                sound.pause();
                sound.currentTime = 0; 
            });
           soundIcon.classList.remove('fa-volume-up');
            soundIcon.classList.add('fa-volume-off');
            localStorage.setItem('soundState', 'paused');
        }
var savedSoundState = localStorage.getItem('soundState');
        if (savedSoundState === 'paused') {
            stopAllSounds();
        } else {
            startSound(); 
        }
soundIcon.addEventListener('click', function() {
            if (tickSound.paused) {
                startSound();
            } else {
                stopAllSounds();
            }
        });
    });
    </script>
<script>
let isAudioPlaying = true; 
function loadAudioState() {
    const savedState = localStorage.getItem('audioState');
    if (savedState !== null) {
        isAudioPlaying = (savedState === 'true');
    }
    updateAudioState();
}
function toggleAudio() {
    const audios = document.querySelectorAll('audio');

    if (audios.length === 0) {
        console.error("No audio elements found on the page.");
        return;
    }
audios.forEach(audio => {
        if (audio) {
            audio.muted = isAudioPlaying; 
        } else {
            console.error("Audio element not found.");
        }
    });
    
    isAudioPlaying = !isAudioPlaying; 
    updateAudioIcon(); 
    localStorage.setItem('audioState', isAudioPlaying);
}

function updateAudioIcon() {
    const icon = document.getElementById('audio-icon');
    if (isAudioPlaying) {
        icon.classList.remove('fa-volume-mute');
        icon.classList.add('fa-volume-up');
    } else {
        icon.classList.remove('fa-volume-up');
        icon.classList.add('fa-volume-mute');
    }
}
updateAudioIcon();
document.addEventListener('DOMContentLoaded', loadAudioState);
function betok_new_func() {
var mybutoncliekced=isBetOkClicked;
    var betButtons = {}; 
    for (let i = 0; i < 10; i++) {
        var buttonValue = $(`#showNobtn${i}`).text() || '0';
        betButtons[`showNobtn${i}`] = buttonValue; 
    }
    var main_score = $("#main_score").text();
    var mycurrentspinvalue=$('#mycurrentno').val();
    var mycurrentspinvalue_mode=$('#mycurrentno_mode').val();
    var spinnerData1 = {
            mybutoncliekced: mybutoncliekced,
            betButtons: betButtons,
            main_score:main_score,
            mycurrentspinvalue:mycurrentspinvalue,
            mycurrentspinvalue_mode:mycurrentspinvalue_mode,
        };
    
    $.ajax({
        url: '<?= site_url('login/auto_logout_main') ?>',
        type: 'POST',
        data: spinnerData1,
        success: function(data) {
           
           
           },
        error: function(xhr, status, error) {
           
            $('#prevok').show();
        }
    });
}
</script>

</body>
</html>