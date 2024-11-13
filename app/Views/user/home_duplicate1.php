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
  </head>
  <style>
    
  </style>
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
                    <button type="button" class="btn"><div id="counter"></div></button></div>
                    <input class="form-control" type="hidden" name="numberss" id="numberss">
                     <input class="form-control" type="hidden" name="modes" id="modes">
                     <div class="forbtnnn">
                        <h6>Last 10 Data</h6>
                    <button type="button" class="btn">
                       <!-- Horizontal Layout -->
       <ul class="horizontal-list">
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
                    <button type="button" class="btn glow">Take</button>
                    <button type="button" class="btn" id="onebetcancel">Cancel Bet</button>
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
                        <span  class="showNobtn" id="showNobtn1">0</span>
                        <button id="myButton1" type="button" class="btn" onmousedown="startLongPress('1')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()" >1</button>                       
                           <audio id="myAudio">
                               <source src="<?php echo base_url("frontend/game_audio/spinner-sound.mp3"); ?>" type="audio/mpeg">
                           </audio>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span  class="showNobtn" id="showNobtn2">0</span>
                    <button id="myButton2" type="button" class="btn" onmousedown="startLongPress('2')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">2</button>     
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span  class="showNobtn" id="showNobtn3">0</span>
                        <input type="text"  name="winner_number" id="winner_number">
                    <button id="myButton3" type="button" class="btn" onmousedown="startLongPress('3')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">3</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span  class="showNobtn" id="showNobtn4">0</span>
                    <button id="myButton4" type="button" class="btn" onmousedown="startLongPress('4')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">4</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span  class="showNobtn" id="showNobtn5">0</span>
                    <button id="myButton5" type="button" class="btn" onmousedown="startLongPress('5')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">5</button>
                    </div>
                         <div class="CounterrOuterrbtn">
                        <span  class="showNobtn" id="showNobtn6">0</span>
                    <button id="myButton6" type="button" class="btn" onmousedown="startLongPress('6')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">6</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span  class="showNobtn" id="showNobtn7">0</span>
                    <button id="myButton7" type="button" class="btn" onmousedown="startLongPress('7')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">7</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                        <span  class="showNobtn" id="showNobtn8">0</span>
                    <button id="myButton8" type="button" class="btn" onmousedown="startLongPress('8')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">8</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                      <span  class="showNobtn" id="showNobtn9">0</span>
                    <button id="myButton9" type="button" class="btn" onmousedown="startLongPress('9')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">9</button>
                    </div>
                    <div class="CounterrOuterrbtn">
                    <span  class="showNobtn" id="showNobtn0">0</span>
                    <button id="myButton0" type="button" class="btn" onmousedown="startLongPress('0')" onmouseup="stopLongPress()" onmouseleave="stopLongPress()">0</button>
                    </div>
                     <input type="hidden" name="showNobtnvalue"  id="showNobtnvalue" >    
            </div>
        </div>
        
        
</div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="forBottompartt">
                    <div class="Bottomparttbtnnn">
                    <button type="button" class="btn" id="totalamt" value="">0</button>
                    </div>
                    <h6>Please bet to start game. Minimum Bet = 1</h6>
                    <div class="Bottomparttbtnnn">
                        <button type="button" class="btn" id="logoutBtn">EXIT</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="forGifGoldCoinss"> <img class="img-fluid" src="<?php echo base_url("frontend/images/pockergame.gif");?>" />
        </div>
    </div>  

<script>
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

//  takeButton.style.display = 'none';
// Start spinning
spinBtn.addEventListener("click", () => {
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
                console.log("All numbers are saved. No numbers to spin.");
                return;
            }
            console.log("Remaining numbers to spin:", remainingNumbers);
            const randomIndex = Math.floor(Math.random() * remainingNumbers.length);
            targetValue = remainingNumbers[randomIndex];
           }
           else
          {
               console.log(remainingNumbers);
                targetValue = parseInt(valuesString);
          }
            console.log("Target value:", targetValue);
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
            // Calculate resultValue based on targetValue
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
                        const showNobtnId = 'showNobtn' + targetValue;
                        const showNobtnElement = document.getElementById(showNobtnId);
                        if (showNobtnElement)
                        {
                            var winnerValue = 0 ;
                            const showNobtnValue = parseInt(showNobtnElement.textContent.trim());
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
                    }
                }
            }, 10);
        }
    });
});

const takeButton = document.querySelector('.glow');
// Check if there is a stored score value, and initialize it to 0 if not
let scoreValue = localStorage.getItem('scoreValue');
if (scoreValue === null)
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
takeButton.addEventListener('click', () => {
    // Get the winner value from the winner button
    const winnerButton = document.getElementById('winnerBtn');
    const winnerValue = parseInt(winnerButton.textContent); // Ensure winnerValue is a number

    // Get the old score value from local storage
    let oldScore = parseInt(localStorage.getItem('scoreValue')) || 0;

    // Add the winner value to the old score
    const newScore = oldScore + winnerValue;

    // Update the score value
    updateScore(newScore);

    // Reset the winner button value to 0
    winnerButton.textContent = '0';
});
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

// Call updateScore initially to set the score value in the UI
updateScore(scoreValue);


// Function to fetch remaining time from the server
function fetchRemainingTime() 
{
    // Make an AJAX request to your PHP endpoint
    $.ajax({
        url: base_url+'user/get_universal_counter_timer_all',
        type: 'GET',
        dataType: 'json',
        success: function(response)
        {
            const remainingTime = parseInt(response.split(':')[0]) * 120 + parseInt(response.split(':')[1]);
            // Check if 10 seconds remain and disable buttons
            if (remainingTime <= 10)
            {
                disableButtons();
            } 
            else
            {
                enableButtons();
            }
        },
        error: function(xhr, status, error)
         {
            console.error('Error fetching remaining time:', error);
        }
    });
}

// Function to disable buttons
function disableButtons() 
{
    for (let i = 1; i <= 9; i++)
    {
        const button = document.getElementById(`showNobtn${i}`);
        if (button) 
        {
            button.disabled = true;
        }
    }
}

// Function to enable buttons
function enableButtons()
{
    for (let i = 1; i <= 9; i++)     {
        const button = document.getElementById(`showNobtn${i}`);
        if (button)
        {
            button.disabled = false;
        }
    }
}

// Call the fetchRemainingTime function to fetch and update the buttons status
fetchRemainingTime();
// Set an interval to periodically fetch the remaining time
setInterval(fetchRemainingTime, 1000); // Fetch every second
function get_counter_timer_universal()
{
        $.ajax({
			url: base_url+'user/get_universal_counter_timer_all',
			type: "GET",
			data: {},
			success: function(data)
			{
			    var data = JSON.parse(data);			   
                console.log(data);
                // Check if the data is '00.00'
                checkAndTriggerSpinButton(data);
                 $("#counter").html(data);
			}
	    });
        
}

 // Function to check and trigger spinBtn click based on data value
function checkAndTriggerSpinButton(data) 
{
    console.log('Data value:', data);
    // Check for specific time values
    const validValues = ['00:59'];
    // Check if data matches any of the validValues
    if (validValues.includes(data.trim())) 
    {
        // Verify spinBtn element
        console.log('Spin Button Element:', spinBtn);
        // Create a new 'click' event
        const clickEvent = new Event('click');
        // Dispatch the 'click' event on spinBtn
        if (spinBtn)
        {
            spinBtn.dispatchEvent(clickEvent);
        } 
        else
        {
            console.error('spinBtn is not defined or null.');
        }
    }
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
    setInterval(get_counter_timer_universal, 300);
});

$(document).ready(function() {
    // Add a click event listener to the "Cancel Bet" button
    $('#betcancel').on('click', function()
    {
        // Get the number from the input field
        var number = $('#showNobtnvalue').val();
        // Construct the ID of the span element based on the number
        var spanId = 'showNobtn' + number;
        // Get the current value of the specific bet
        var canceledBetValue = parseInt($('#' + spanId).text());
        // Subtract the canceled bet value from the total amount
        var currentTotal = parseInt($('#totalamt').text());
        var newTotal = currentTotal - canceledBetValue;
        // Update the total amount displayed in the totalamt element
        $('#totalamt').text(newTotal);
        // Update the value of the span element to '0'
        $('#' + spanId).text('0');
        // Log a message indicating the value update
        console.log("Canceled bet value subtracted from total:", canceledBetValue);
    });
});


$(document).ready(function()
{
    let isBetOkClicked = false; // Track if "Bet Ok" has been clicked

    const checkCountdown = () =>
    {
        $.ajax({
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
            error: function(xhr, status, error) {
                console.error('Error fetching countdown time:', error);
            }
        });
    };

    const disableButtons = () => 
    {
        $('#betok,#betcancel,#onebetcancel,#myButton1,#myButton2,#myButton3,#myButton4,#myButton5,#myButton6, #myButton7,myButton8,#myButton9,#myButton0').prop('disabled', true);
    };

    // Check the countdown timer every second
    const intervalId = setInterval(checkCountdown, 1000);
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
        $('#totalamt').text('0');
    });
});

const audio = new Audio("<?php echo base_url("frontend/game_audio/coin_effect.mp3"); ?>");
const buttons = document.querySelectorAll("button");
buttons.forEach(button => 
{
    button.addEventListener("click", () => {
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
    // Define the increment speed in milliseconds
    const incrementSpeed = 80; // Adjust this to make it faster or slower    
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
    $.ajax({
        url: base_url+'User/store_score_amount', // Change this to your actual endpoint
        type: 'POST', // HTTP method
        data: { Id: userId, scoreAmount: scoreAmount, role: role }, // Data to send
        success: function(response) {
            console.log("Server response:", response);
            if (response.success) {
                console.log("Score saved successfully.");
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
    // Get the stored score from local storage and parse it as an integer
    let storedScore = parseInt(localStorage.getItem('scoreValue'), 10) || 0;
    // Get the selected increment value (from radio buttons)
    const increment_number = parseInt($("input[name='increment_number']:checked").val(), 10);
    // Ensure storedScore is sufficient to handle the increment
    /*if (storedScore < increment_number)
    {
        alert("Insufficient score to add this value");
        return;
    }*/

        const showCounterElement = document.getElementById('showNobtn' + number);
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
        } else {
            console.error(`Element with ID ${id} not found.`);
        }
    });

    // Update the total amount display in the HTML
    const totalAmountElement = document.getElementById('totalamt');
    if (totalAmountElement) {
        totalAmountElement.innerText = totalAmt; // Display the correct total
    } else {
        console.error('Total amount element not found.');
    }

 }
     fetch(base_url+'user/get-number')
    .then(response => response.json())
    .then(data => 
    {
        const number = data.number;
        // Update the winner box with the retrieved number value
        //document.getElementById('winnerBtn').textContent = number;
    })
    .catch(error => console.error(error)); 
    const soundElement = document.getElementById("radio-sound1");
    const radioButtons = document.getElementsByName("increment_number");
    radioButtons.forEach(radio =>
    {
            radio.addEventListener("change", () => 
            {
                soundElement.currentTime = 0; // Reset audio time in case it's already playing
                soundElement.play(); // Play the sound
            });
    });

</script>

  </body>
</html>
