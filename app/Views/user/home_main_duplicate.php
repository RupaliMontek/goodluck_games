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
    
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!---------------  CSS  --------------------->
   
    <!---------------  Font Aewsome  --------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!---------------  Chart JS  --------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
   
    
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
    <style>
    

  </style>
  </head>
  
  <body>
      <div id="load"> 
   <div class="loadOuter">
       <h3>Loading...</h3>
       <img width="515px" height="auto" class="img-fluid" src="<?php echo base_url("frontend/images/loadingGoodluck.gif");?>" />
   </div>   
   </div>
 
     
 <div id="contents" class="container-fluid gamebgg"> 
<audio id="loadingMusic" src="<?php echo base_url("frontend/game_audio/mario.loading.mp3"); ?>" preload="auto"></audio>
<div class="forspinner">     
    <div class="wrapper">
      <div class="container">
        <canvas id="wheel"></canvas>
        <!--<button id="spin-btn">Spin</button>-->
        <!--<img src="<?php echo base_url("frontend/images/targettt.png");?>" alt="spinner-arrow">-->
        <button id="spin-btn"><img class="img-fluid" src="<?php echo base_url("frontend/images/spinball.png");?>" /></button>
         <img src="<?php echo base_url("frontend/images/targettt.png");?>" alt="spinner-arrow" />
      </div>
      
    </div>
</div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forTopFirstButtons">
                    <div class="forbtnnn">
                        <h6>SCORE</h6>
                         <button type="button" class="btn score-btn" value=""></button>
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
                    <audio id="radio-sound" src="<?php echo base_url("frontend/game_audio/coin_effect.mp3"); ?>" preload="auto"></audio>
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
            <div class="col-sm-12 col-md-12 col-lg-12">
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
              <div class="forBottomCounterr">
    <div class="CounterrOuterrbtn">
        <span class="showNobtn" id="showNobtn1">0</span>
        <button id="myButton1" type="button" class="btn number-btn" onmousedown="startLongPress('1')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">1</button>
        <audio id="myAudio">
            <source src="<?php echo base_url("frontend/game_audio/spinner-sound.mp3"); ?>" type="audio/mpeg">
        </audio>
    </div>
    <div class="CounterrOuterrbtn">
        <span class="showNobtn" id="showNobtn2">0</span>
        <button id="myButton2" type="button" class="btn number-btn" onmousedown="startLongPress('2')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">2</button>
    </div>
    <div class="CounterrOuterrbtn">
        <span class="showNobtn" id="showNobtn3">0</span>
        <input type="hidden" name="winner_number" id="winner_number">
        <button id="myButton3" type="button" class="btn number-btn" onmousedown="startLongPress('3')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">3</button>
    </div>
    <div class="CounterrOuterrbtn">
        <span class="showNobtn" id="showNobtn4">0</span>
        <button id="myButton4" type="button" class="btn number-btn" onmousedown="startLongPress('4')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">4</button>
    </div>
    <div class="CounterrOuterrbtn">
        <span class="showNobtn" id="showNobtn5">0</span>
        <button id="myButton5" type="button" class="btn number-btn" onmousedown="startLongPress('5')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">5</button>
    </div>
    <div class="CounterrOuterrbtn">
        <span class="showNobtn" id="showNobtn6">0</span>
        <button id="myButton6" type="button" class="btn number-btn" onmousedown="startLongPress('6')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">6</button>
    </div>
    <div class="CounterrOuterrbtn">
        <span class="showNobtn" id="showNobtn7">0</span>
        <button id="myButton7" type="button" class="btn number-btn" onmousedown="startLongPress('7')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">7</button>
    </div>
    <div class="CounterrOuterrbtn">
        <span class="showNobtn" id="showNobtn8">0</span>
        <button id="myButton8" type="button" class="btn number-btn" onmousedown="startLongPress('8')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">8</button>
    </div>
    <div class="CounterrOuterrbtn">
        <span class="showNobtn" id="showNobtn9">0</span>
        <button id="myButton9" type="button" class="btn number-btn" onmousedown="startLongPress('9')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">9</button>
    </div>
    <div class="CounterrOuterrbtn">
        <span class="showNobtn" id="showNobtn0">0</span>
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
        <input type="hidden" id="increment_number" /> 
        <button id="myButton0" type="button" class="btn number-btn" onmousedown="startLongPress('0')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">0</button>
    </div>
    <input type="hidden" name="showNobtnvalue" id="showNobtnvalue">
</div>
</div>
</div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forBottompartt">
                    <div class="Bottomparttbtnnn">
                    <button type="button" class="btn" id="totalamt" value="">0</button>
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
<div class="popup" id="popup">
    <button class="popup-close" id="popup-close-btn">&times;</button>
    <a class="poplinkkkk" href="" target="_blank">
 <img src="<?php echo base_url("frontend/images/joker.png");?>" alt="" width="100%" height="auto">
  <!--<p>Whatsapp me<br>for free consultation</p>-->
  </a> 
</div> 

<script>
document.addEventListener("DOMContentLoaded", function() {
  var popup = document.getElementById("popup");
  var closeButton = document.getElementById("popup-close-btn");

  function showPopup() {
    popup.style.display = "block";
    setTimeout(function() {
      popup.style.display = "none";
    }, 10000000); // Popup stays visible for 10 seconds
  }

  // Initial popup after 20 seconds
  setTimeout(showPopup, 20000);

  // Show the popup every 25 seconds
  //setInterval(showPopup, 45000); // Show every 25 seconds
  
  // Close button functionality
  closeButton.addEventListener("click", function() {
    popup.style.display = "none";
  });

});

</script>
<!--new popup automatically come end here -->

<script>

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
}

$(document).ready(function () {
            var isLast10Seconds = <?= json_encode(@$is_last_10_seconds) ?>;
            var remainingTime = <?= json_encode($remaining_time) ?>;
            
            if (isLast10Seconds) {
                $('#waitModal').modal('show');
                
                // Automatically hide the modal when the time restarts
                setTimeout(function () {
                    $('#waitModal').modal('hide');
                }, remainingTime * 900);
            }
        });
        
var spinnerCalled = false;
var button_increment = false;
 document.getElementById('betcancel').addEventListener('click', function() {
        document.querySelectorAll('.number-btn').forEach(button => {
            button.classList.add('cancel-mode');
        });
    });

 document.querySelectorAll('.number-btn').forEach(button => {
        button.addEventListener('click', function() {
            if (this.classList.contains('cancel-mode')) {
                const buttonId = this.id;
                const element = document.getElementById(this.id);
                const sampleString = element.innerText;
    
                // Separate numbers from the string
                const numbersArray = sampleString.match(/\d+(\.\d+)?/g);
    
                // Convert the array of numbers back into a single string
                const resultString = numbersArray.join('');

                // console.log("Converted string:", resultString);
                var showbtn = 'showNobtn' + resultString;
                var showbtn_val = document.getElementById(showbtn).innerText;
                console.log("Value of element with ID", showbtn, ":", showbtn_val);
                const totalAmountElement = document.getElementById('totalamt');
                if (totalAmountElement) {
                    totalAmountElement.innerText =totalAmountElement.innerText-showbtn_val ; // Display the correct total
                    const total_amount_fixed=totalAmountElement.innerText-showbtn_val ; // Display the correct total
                } 
                else
                {
                    console.error('Total amount element not found.');
                }
                const scoreButton = document.querySelector('.score-btn').innerText;
                const final_scoreButton=parseInt(scoreButton)+parseInt(showbtn_val);
                updateScore(final_scoreButton);
                // console.log(final_scoreButton);
                const spanId = 'showNobtn' + buttonId.replace('myButton', '');
                document.getElementById(spanId).innerText = '0';
                this.classList.remove('cancel-mode'); // Remove the cancel mode class
            }
        });
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
document.addEventListener("DOMContentLoaded", function() 
{
            // Get the button element by its ID
            var button = document.getElementById("winnerBtn");
            // Disable the button
            button.disabled = true;
  });
    document.getElementById('logoutBtn').addEventListener('click', function()
    {
        alert("do you want to exit the game");
        window.location.href = "<?php echo base_url("logout") ?>";
    });

   document.onreadystatechange = function ()
    {
        var state = document.readyState;
        var music = document.getElementById('loadingMusic');
     if (state == 'interactive')
      {
         document.getElementById('contents').style.visibility="hidden";
         music.play();
      } 
      else if (state == 'complete')
      {
       
        setTimeout(function()
        {
              document.getElementById('interactive');
              document.getElementById('load').style.visibility="hidden";
              document.getElementById('contents').style.visibility="visible";
              music.pause(); // Stop playing the music
              music.currentTime = 0; // Reset to the beginning
         }, 2500);
  }
}


    
 var base_url = "<?php echo base_url(); ?>";
 const wheel = document.getElementById("wheel");
 const spinBtn = document.getElementById("spin-btn");
 const betok = document.getElementById("betok");
 const finalValue = document.getElementById("final-value");

 const rotationValues = [
  { minDegree: 0, maxDegree: 18, value: 0 },
  { minDegree: 19, maxDegree: 54, value: 9 },
  { minDegree: 55, maxDegree: 90, value: 8 },
  { minDegree: 91, maxDegree: 126, value: 7 },
  { minDegree: 127, maxDegree: 162, value: 6 },
  { minDegree: 163, maxDegree: 198, value: 5 }, 
  { minDegree: 199, maxDegree: 234, value: 4 },
  { minDegree: 235, maxDegree: 270, value: 3 },
  { minDegree: 271, maxDegree: 306, value: 2 },
  { minDegree: 307, maxDegree: 342, value: 1 },
  { minDegree: 343, maxDegree: 360, value: 0 },
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
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 0],
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
const valueGenerator = (angleValue) => 
{
  for (let i of rotationValues) 
  {
    //if the angleValue is between min and max then display it
    if (angleValue >= i.minDegree && angleValue <= i.maxDegree)
    {
      finalValue.innerHTML = `<p>Value: ${i.value}</p>`;
      spinBtn.disabled = false;
      break;
    }
  }
};

//Spinner count
let count = 0;
let resultValue = 120;
//  takeButton.style.display = 'none';
// Start spinning
/*    $('#betok').click(function() 
    {*/
function spinner_spin()
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
    finalValue.innerHTML = `<p>Good Luck!</p>`;

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

            let resultValue;
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
                resultValue = 77;
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
                resultValue = 113;
            } else if (targetValue === 6) 
            {
                resultValue = 128;
            } else if (targetValue === 7) 
            {
                resultValue = 172;
            } else if (targetValue === 8) 
            {
                resultValue = 134;
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
                        get_last_10_win_numbers();
                        if(winnerValue==0)
                        {
                            $("#take-btn").trigger('click'); 
                        }
                    }
                }
            }, 10);
        }
    });
/*});*/
}


    $("#take-btn").click(function() {
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
        $('#showNobtn1').text(0);
        $('#showNobtn2').text(0);
        $('#showNobtn3').text(0);
        $('#showNobtn4').text(0);
        $('#showNobtn5').text(0);
        $('#showNobtn6').text(0);
        $('#showNobtn7').text(0);
        $('#showNobtn8').text(0);
        $('#showNobtn9').text(0);
        $('#showNobtn0').text(0);  
        $('#totalamt').text(0); 
        $('#winnerBtn').text(0);
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
                success: function(response) 
                {
                    get_user_balance_amount();
                    $('#take-btn').prop('disabled', true);
                    $("#winnerValue").val(0);
                }
            });
        }
        
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


const takeButton = document.querySelector('.glow');
// Check if there is a stored score value, and initialize it to 0 if not
if (scoreValue =='')
{
    scoreValue = 0;
}
// Function to update the score value in both the UI and local storage
function updateScore(score) 
{
    const scoreButton = document.querySelector('.score-btn');
    scoreButton.textContent = score;
    localStorage.setItem('scoreValue', score);
}

/* Comment By Jaywant 

takeButton.addEventListener('click', () => {
    // Get the winner value from the winner button
    const winnerButton = document.getElementById('winnerBtn');
    let oldScore = parseInt(localStorage.getItem('scoreValue')) || 0;
    const winnerValue = parseInt(winnerButton.textContent); // Ensure winnerValue is a number
    const newScore = oldScore + winnerValue;
    if(winnerValue!==0)
    {
        $.ajax
        ({
            url: base_url + 'user/update_wallet_amount',
            type: 'POST',
            data: { oldScore: oldScore,winnerValue:winnerValue,newScore:newScore },
            success: function(response)
            {
                console.log("Number saved successfully:", targetValue);
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                console.error("Error saving number:", textStatus, errorThrown);
            }
     });
    }
    updateScore(newScore);
    winnerButton.textContent = '0';
});
*/
// Call updateScore initially to set the score value in the UI


// old jaywqant sir code
// takeButton.addEventListener('click', () => 
// {
//     // Get the winner value from the winner button
//     const winnerButton = document.getElementById('winnerBtn'); 
//     var winnerValue = parseInt(winnerButton).innerText
//     winnerValue  = document.getElementById('winnerBtn').innerText;
//     var totalamt    = document.getElementById('totalamt').innerText;
//     var winval      = document.getElementById('winnerBtn').innerText;
//     var showNobtn1  = document.getElementById('showNobtn1').innerText;
//     var showNobtn2  = document.getElementById('showNobtn2').innerText;
//     var showNobtn3  = document.getElementById('showNobtn3').innerText;
//     var showNobtn4  = document.getElementById('showNobtn4').innerText;
//     var showNobtn5  = document.getElementById('showNobtn5').innerText;
//     var showNobtn6  = document.getElementById('showNobtn6').innerText;
//     var showNobtn7  = document.getElementById('showNobtn7').innerText;
//     var showNobtn8  = document.getElementById('showNobtn8').innerText;
//     var showNobtn9  = document.getElementById('showNobtn9').innerText;
//     var showNobtn0  = document.getElementById('showNobtn0').innerText;
//     var winner_number  = $("#winner_number").val();
//     let oldScore = parseInt(localStorage.getItem('scoreValue')) || 0
//     const newScore = oldScore + winnerValue;
    
 
//     $.ajax({
//                 url: base_url + 'user/save_winning_detaills',
//                 type: 'POST',
//                 data: {winnerValue:winnerValue,totalamt:totalamt,showNobtn1:showNobtn1,showNobtn2:showNobtn2,showNobtn3:showNobtn3,showNobtn4:showNobtn4,showNobtn5:showNobtn5,showNobtn6:showNobtn6,showNobtn7:showNobtn7,showNobtn8:showNobtn8,showNobtn9:showNobtn9,showNobtn0:showNobtn0,oldScore:oldScore,newScore:newScore,winner_number:winner_number},
//                 success: function(response)
//                 {
//                     console.log(response);
//                 }
//      });
//     // Update the score value
//     updateScore(newScore);
//     // Reset the winner button value to 0
//     winnerButton.textContent = '0';
// });

// Function to fetch remaining time from the server


// Function to disable buttons
function disableButtons()
{   spinnerCalled  = false;
    button_increment = false;
    $('#totalamt,#take-btn,#betok,#betcancel,#onebetcancel,#myButton1,#myButton2,#myButton3,#myButton4,#myButton5,#myButton6, #myButton7,myButton8,#myButton9,#myButton0,#logoutBtn').prop('disabled', true);
    var spin_btn = document.getElementById("spin-btn");
    spin_btn.disabled = true;
    var counter_button = document.getElementById("counter_button");
    counter_button.classList.add("btn","glow");
    for (let i = 0; i <= 9; i++)
    {
        var button = document.getElementById("myButton"+i);
        button.disabled = true;
    }
}

// Function to enable buttons  //by rupali 5/6/2024

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
    
    $('#totalamt,#betcancel,#onebetcancel,#myButton1,#myButton2,#myButton3,#myButton4,#myButton5,#myButton6, #myButton7,myButton8,#myButton9,#myButton0,#logoutBtn').prop('disabled', false);
    var spin_btn = document.getElementById("spin-btn");
    spin_btn.disabled = false;
    $("#counter_button").removeClass("glow");
 /*   $("#take-btn").removeClass("glow");
     $("#winnerBtn").removeClass("glow")*/;
    for (let i = 0; i <= 9; i++)
    {
        var button = document.getElementById("myButton"+i);
        button.disabled = false;
    }
}

// Call the fetchRemainingTime function to fetch and update the buttons status
fetchRemainingTime();
// Set an interval to periodically fetch the remaining time
setInterval(fetchRemainingTime, 500); // Fetch every second.
function get_counter_timer_universal()
{  
    $.ajax
    ({
		url: base_url+'user/get_universal_counter_timer_all',
		type: "GET",
		data: {},
		success: function(data)
		{ 
		    var data = data.replace(/"/g, '');
		    //var data = JSON.parse(data); data = JSON.parse(data);
		    $("#counter").html(data);
		    console.log(data);
		    			   
            //checkAndTriggerSpinButton(data);
            var timeStr = $("#current_time").val();
        if(timeStr !=='')
        {
            var parts = timeStr.split(':');
            var minutes = parseInt(parts[0]);
            var seconds = parseInt(parts[1]);
            var totalSeconds = (minutes * 60) + seconds;
            totalSeconds -= 10;
            if (totalSeconds < 0)
            {
                totalSeconds = 0;
            }
            var newMinutes = Math.floor(totalSeconds / 60);
            var newSeconds = totalSeconds % 60;
            var formattedMinutes = newMinutes.toString().padStart(2, '0');
            var formattedSeconds = newSeconds.toString().padStart(2, '0');
            const newTimeStr = formattedMinutes + ':' + formattedSeconds;
            if(data==newTimeStr)
            {
                $("#take-btn").trigger('click');
                $("#take-btn").removeClass("glow");
            }
        }
            if(data=='00:01' && !spinnerCalled)
            {
                $("#take-btn").removeClass("glow");
                $('#take-btn').prop('disabled', false);
                $("#winnerBtn").removeClass("glow")
                spinner_spin();
                spinnerCalled = true; // Set the flag to true after calling spinner_spin
                $("#current_time").val(data);
                //console.log(data);
                //console.log("aaaaa");
            }
		}
	});
        
}
function get_counter_timer_universal_new() {
    $.ajax({
        url: base_url + 'user/get_universal_counter_timer_all',
        type: "GET",
        data: {},
        success: function(response) {
            var data = JSON.parse(response);
            
            // Extract the display time in seconds from the response
            var totalSeconds = parseInt(data.display_time, 10);

            // Calculate minutes and seconds
            var minutes = Math.floor(totalSeconds / 60);
            var seconds = totalSeconds % 60;

            // Format the display time as MM:SS
            var formattedTime = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            // Update the counter display
            $("#counter").html(formattedTime);

            // Handle specific actions based on the current time
            handleCurrentTime(formattedTime);

            // Additional logging for debugging
            //console.log('Total seconds:', totalSeconds); // Check the total number of seconds
            //console.log('Formatted time:', formattedTime); // Check the formatted time
        }
    });
}

// Function to handle actions based on current time
function handleCurrentTime(currentTime) {
    var timeStr = $("#current_time").val();

    // Check if there is a specific action needed based on the current time
    switch (currentTime) {
        case '01:00':
            if (!spinnerCalled) {
                $("#take-btn").removeClass("glow");
                $('#take-btn').prop('disabled', false);
                $("#winnerBtn").removeClass("glow");
                spinner_spin();
                spinnerCalled = true; // Set the flag to true after calling spinner_spin
                enableButtons(); //by rupali 5/6/2024
            }
            break;
        default:
            // Any default actions if needed
            break;
    }

    // Update the hidden input with the current time
    $("#current_time").val(currentTime);
}



 // Function to check and trigger spinBtn click based on data value
/*function checkAndTriggerSpinButton(data) 
{ 
    
    const validValues = ['00:59']; 
    if (validValues.includes(data.trim())) 
    {
        spinner_spin();
    }
}*/
 
function get_as_per_mode_array_numbers_array()
{
    $.ajax
    ({
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
    $("#prevok").hide();
    $('#betok').prop('disabled', true);
    $('#take-btn').prop('disabled', true);
    $("#take-btn").removeClass("glow");
    var winnerBtn = document.getElementById("winnerBtn");
    winnerBtn.disabled = false;
    var button = document.getElementById("showNobtn1");
    button.disabled = true;
    get_as_per_mode_array_numbers_array();
    setInterval(get_as_per_mode_array_numbers_array, 500);
    get_counter_timer_universal();
    setInterval(get_counter_timer_universal, 300);
    get_user_balance_amount();
    get_last_10_win_numbers();
    setInterval(get_last_10_win_numbers, 300);
    //showWaitNextGameModal();
    //setInterval(showWaitNextGameModal,7000);
});

/*$(document).ready(function()
{
    $('#myButton' + number).addClass('active');
    var spanText = $('#showNobtn' + number).text();
    if (spanText === undefined)
    {
        console.log($('#showNobtn' + number)); 
        console.log(document.getElementById('showNobtn' + number))
    }
    $('#showNobtnvalue').val(spanText);
    $('#betcancel').on('click', function()
    {
        var number = $('#showNobtnvalue').val();
        var spanId = 'showNobtn' + number;
        var canceledBetValue = parseInt($('#' + spanId).text());
        var currentTotal = parseInt($('#totalamt').text());
        var newTotal = currentTotal - canceledBetValue;
        $('#totalamt').text(newTotal);
        $('#' + spanId).text('0');
        console.log("Canceled bet value subtracted from total:", canceledBetValue);
    });
});*/


$(document).ready(function()
{
    let isBetOkClicked = false; // Track if "Bet Ok" has been clicked
    const checkCountdown = () =>
    {
        $.ajax
        ({
            url: base_url+'user/get_universal_counter_timer_all', // The endpoint that returns the countdown time
            type: 'GET',
            dataType: 'json',
            success: function(data)
            {
                const remaining_time = data;
                const [minutes, seconds] = remaining_time.split(':').map(Number);
                const total_seconds = (minutes * 60) + seconds;
                if (!isBetOkClicked && total_seconds <= 10)
                {
                   
                }
            },
            error: function(xhr, status, error) 
            {
                console.error('Error fetching countdown time:', error);
            }
        });
    };

    const disableButtonsdd = () => 
    {
        $('#betok,#betcancel,#onebetcancel,#myButton1,#myButton2,#myButton3,#myButton4,#myButton5,#myButton6, #myButton7,myButton8,#myButton9,#myButton0').prop('disabled', true);
    };

    // Check the countdown timer every second
    const intervalId = setInterval(checkCountdown, 10000000);
    // Add a click event listener to the "Bet Ok" button
    $('#betok').on('click', function()
    {
        isBetOkClicked = true; // Mark that "Bet Ok" has been clicked
        disableButtons(); // Disable the buttons upon clicking "Bet Ok"
        clearInterval(intervalId); // Stop checking the timer as we don't need to disable further
    });
});



$(document).ready(function() 
{
    // Add a click event listener to the "Cancel Bet" button
    $('#onebetcancel').on('click', function()
     {
        // Iterate over each showNobtn element
        $('[id^=showNobtn]').each(function() 
        {
            // Set the text content of the current element to "0"
            $(this).text('0');
        });
        
        // Set the text content of the totalamt element to "0"
        $('#betok').prop('disabled', true);
        $('#totalamt').text('0');
    });
});

const audio = new Audio("<?php echo base_url("frontend/game_audio/coin_effect.mp3"); ?>");
const buttons = document.querySelectorAll("button");
buttons.forEach(button => 
{
    button.addEventListener("click", () =>
    {
      audio.play();
    });
});
const audio1 = new Audio("<?php echo base_url("frontend/game_audio/coin_effect.mp3"); ?>");
const buttonsradio = document.querySelectorAll("input[type='radio']");
buttonsradio.forEach(buttonr =>
{
  buttonr.addEventListener("click", () => {
    audio1.play();
  });
});


// Interval ID to manage long-press incrementing
let longPressIntervalId = null;
function startLongPress(number)
{  
    $('.active').removeClass('active');//by rupali 6/6/2024
     
    button_increment = false;
    $('#myButton' + number).addClass('active');
    // Define the increment speed in milliseconds
    if (showNobtn1!==0 || showNobtn2!==0 || showNobtn3!==0 ||  showNobtn4!==0 || showNobtn5!==0 || showNobtn6!==0 || showNobtn7!==0 ||showNobtn8!==0 || showNobtn9!==0 || showNobtn0!==0)
    {
        $("#betok").show();
        $('#betok').prop('disabled', false);
        const incrementSpeed = 100; // Adjust this to make it faster or slower    
        // Call incrementValue on an interval
        longPressIntervalId = setInterval(() => 
        {
            incrementValue(number);
        }, incrementSpeed);
        // Optional: Play audio on long press
        const audioElement = document.getElementById('radio-sound');
        if (audioElement) 
        {
            audioElement.play();
        }
    }
}

function stopLongPress()
{
    // Clear the interval to stop incrementing
    if (longPressIntervalId) 
    {
        clearInterval(longPressIntervalId);
        longPressIntervalId = null;
    }
}

function updateScoreInDatabase(userId, scoreAmount, role)
{
    $.ajax
    ({
        url: base_url+'User/store_score_amount', // Change this to your actual endpoint
        type: 'POST', // HTTP method
        data: { Id: userId, scoreAmount: scoreAmount, role: role }, // Data to send
        success: function(response) {
            //console.log("Server response:", response);
            if (response.success) {
                //console.log("Score saved successfully.");
            } else {
                console.error("Failed to save score:", response.error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX error:", textStatus, errorThrown);
        }
    });
}

// Define a function to increment the value
function incrementValue(number) 
{
    const showCounterElement = document.getElementById('showNobtn' + number);
    // Get the stored score from local storage and parse it as an integer
    let storedScore = parseInt(localStorage.getItem('scoreValue'), 10) || 0;
    // Get the selected increment value (from radio buttons)
    const increment_number = parseInt($("input[name='increment_number']:checked").val(), 10);
    // Ensure storedScore is sufficient to handle the increment
    if (storedScore < increment_number)
    {
        alert("Insufficient score to add this value");
        return;
    }
   
    if (showCounterElement) 
    {
        const currentValue = parseInt(showCounterElement.innerText, 10) || 0;
        const newValue = currentValue + increment_number;
        showCounterElement.innerText = newValue; 
        storedScore -= increment_number;
        localStorage.setItem('scoreValue', storedScore);
        // Update the score display in the UI
        const scoreBtnElement = document.querySelector('.score-btn');
        if (scoreBtnElement) 
        {
            scoreBtnElement.textContent = storedScore; // Reflect the new score
        }        
         //updateScoreInDatabase(userId, storedScore, role);         
     } 
    else 
    {
        console.error('Counter element not found.');
    }    
    // Recalculate the total amount
    const elementIds = [
        'showNobtn0', 'showNobtn1', 'showNobtn2', 'showNobtn3', 'showNobtn4',
        'showNobtn5', 'showNobtn6', 'showNobtn7', 'showNobtn8', 'showNobtn9'
    ];
    
    let totalAmt = 0; // Initialize total amount variable to zero
    elementIds.forEach(function (id) {
        const element = document.getElementById(id);
        if (element) {
            const currentValue = parseInt(element.innerText, 10);
            if (!isNaN(currentValue)) { // Ensure it's a valid number
                totalAmt += currentValue;
            }
        }
        else
        {
            console.error(`Element with ID ${id} not found.`);
        }
    });

    // Update the total amount display in the HTML
    const totalAmountElement = document.getElementById('totalamt');
    if (totalAmountElement) {
        totalAmountElement.innerText = totalAmt; // Display the correct total
    } 
    else
    {
        console.error('Total amount element not found.');
    }

 }
 var base_url = "<?php echo base_url(); ?>";

$.ajax({
    url: base_url + 'user/get_number',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
        const number = data.number;
        // Update the winner box with the retrieved number value
        // document.getElementById('winnerBtn').textContent = number;
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error fetching data:', textStatus, errorThrown);
    }
});

const soundElement = document.getElementById("radio-sound1");
const radioButtons = document.getElementsByName("increment_number");
radioButtons.forEach(radio => {
    radio.addEventListener("change", () => {
        soundElement.currentTime = 0; // Reset audio time in case it's already playing
        soundElement.play(); // Play the sound
    });
});

    function showNobtn()
    {
        //console.log(showNobtn1);
    }

   var modalShown = false; // Flag to track if modal has been shown
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
    
    
    function fetchRemainingTime() 
{
            var showNobtn1  = parseInt(document.getElementById('showNobtn1').innerText);
            var showNobtn2  = parseInt(document.getElementById('showNobtn2').innerText);
            var showNobtn3  = parseInt(document.getElementById('showNobtn3').innerText);
            var showNobtn4  = parseInt(document.getElementById('showNobtn4').innerText);
            var showNobtn5  = parseInt(document.getElementById('showNobtn5').innerText);
            var showNobtn6  = parseInt(document.getElementById('showNobtn6').innerText);
            var showNobtn7  = parseInt(document.getElementById('showNobtn7').innerText);
            var showNobtn8  = parseInt(document.getElementById('showNobtn8').innerText);
            var showNobtn9  = parseInt(document.getElementById('showNobtn9').innerText);
            var showNobtn0  = parseInt(document.getElementById('showNobtn0').innerText);
            var increment_number = parseInt($("input[name='increment_number']:checked").val(), 10);
            var increment_number = parseInt($("input[name='increment_number']:checked").val(), 10);
            var win_val = parseInt(document.getElementById('winnerBtn').innerText);
            var remainingTime = $('#counter').text();
            remainingTime = parseInt(remainingTime.split(':')[0]) * 120 + parseInt(remainingTime.split(':')[1]);
            if (remainingTime==10 || remainingTime==09 || remainingTime==08 ||  remainingTime==07 || remainingTime==06 || remainingTime==05 || remainingTime==04 ||remainingTime==03 || remainingTime==02 || remainingTime==01)
            {
                if (showNobtn1!==0 || showNobtn2!==0 || showNobtn3!==0 ||  showNobtn4!==0 || showNobtn5!==0 || showNobtn6!==0 || showNobtn7!==0 ||showNobtn8!==0 || showNobtn9!==0 || showNobtn0!==0)
                {
                  $('#betok').prop('disabled', false);
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

                if (showNobtn1!==0 || showNobtn2!==0 || showNobtn3!==0 ||  showNobtn4!==0 || showNobtn5!==0 || showNobtn6!==0 || showNobtn7!==0 ||showNobtn8!==0 || showNobtn9!==0 || showNobtn0!==0)
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
</script>
</body>
</html>