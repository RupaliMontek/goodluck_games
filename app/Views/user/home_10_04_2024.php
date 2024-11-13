<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
     <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Chart JS Plugin for displaying text over chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    <!-- Script -->
    <script src="<?php echo base_url("frontend/js/script.js");?>"></script>
    
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
     <div class="wrapperr">
      <div class="containerr">
        <canvas id="wheel"></canvas>
        <button id="spin-btn">Spin</button>
        <img src="https://toppng.com/uploads/thumbnail/arrow-pointing-to-the-left-11550116774flduverv2o.png" alt="spinner arrow" />
      </div>
      <div id="final-value">
        <p>Click On The Spin Button To Start</p>
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
                    <button type="button" class="btn" id="betcancel">Cancel Specific Bet</button>
                    <button type="button" class="btn" id="betok">Bet Ok</button>
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


<style>

.wrapperr {
/*width: 90%;
  max-width: 34.37em;*/
  max-height: 90vh;
  position: relative;
  transform: translate(-50%, -50%);
  top: 40%;
  left: 50%;
  padding: 3em;
  border-radius: 1em;
  box-shadow: 0 4em 5em rgba(27, 8, 53, 0.2);

}
.containerr {
  position: relative;
  width: 100%;
  height: 100%;
}
#wheel {
  max-height: inherit;
  width: inherit;
  top: 0;
  padding: 0;
}
@keyframes rotate {
  100% {
    transform: rotate(360deg);
  }
}
#spin-btn {
  position: absolute;
  transform: translate(-50%, -50%);
  top: 50%;
  left: 50%;
  height: 26%;
  width: 26%;
  border-radius: 50%;
  cursor: pointer;
  border: 0;
  background: radial-gradient(#fdcf3b 50%, #d88a40 85%);
  color: #c66e16;
  text-transform: uppercase;
  font-size: 1.8em;
  letter-spacing: 0.1em;
  font-weight: 600;
}
img {
  position: absolute;
  width: 4em;
  top: 45%;
  right: -8%;
}
#final-value {
  font-size: 1.5em;
  text-align: center;
  margin-top: 1.5em;
  color: #202020;
  font-weight: 500;
}
@media screen and (max-width: 768px) {
  .wrapper {
    font-size: 12px;
  }
  img {
    right: -5%;
  }
}

</style>
  </body>
</html>
