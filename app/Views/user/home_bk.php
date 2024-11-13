<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play Game</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://drawback.lucrative-esystem.com/fun_game_2024/frontend/mydesignstyle.css" rel="stylesheet">
    <!---------------  Font Aewsome  --------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!---------------  CSS  --------------------->
   <!-- <link rel="stylesheet" href="<?php echo base_url("public/css/style.css");?>">-->
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
    
<style>
   
</style>
    
</head>
<body>
<div class="container-fluid gamebgg"> 
<div class="forspinner">
     <button id="spin">Spin</button>
  <span class="arrow"></span>
<div class="container">
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
                    <button type="button" class="btn">0:34</button></div>
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
                        <button type="button" class="btn">1</button>
                        </div>
                         <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button type="button" class="btn">2</button>
                    </div>
                         <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button type="button" class="btn">3</button>
                    </div>
                         <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button type="button" class="btn">4</button>
                    </div>
                         <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button type="button" class="btn">5</button>
                    </div>
                         <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button type="button" class="btn">6</button>
                    </div>
                         <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button type="button" class="btn">7</button>
                    </div>
                         <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button type="button" class="btn">8</button>
                    </div>
                         <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button type="button" class="btn">9</button>
                    </div>
                         <div class="CounterrOuterrbtn">
                        <a class="showNobtn">2</a>
                    <button type="button" class="btn">0</button>
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
    $(document).ready(function(){
        $('#spin').on('click', function(){
            // Make an AJAX request to the spin method in the Spinner controller
            $.ajax({
                type: 'POST',
                url: '<?= base_url("user/spin") ?>',
                dataType: 'json',
                success: function(data){
                    // Display the spun number
                    $('#result').text('Spun Number: ' + data.number);
                    
                    // TODO: Check if the spun number matches the desired stop value and take appropriate action
                    if (data.number === 5) {
                        // Do something when the spinner stops at 5
                        alert('Spinner stopped at 5!');
                    }
                }
            });
        });
    });
</script>
 
 <!--script type="text/javascript">

let container = document.querySelector(".container");
let btn = document.getElementById("spin");
let number = Math.ceil(Math.random() * 1000);

btn.onclick = function () {
  container.style.transform = "rotate(" + number + "deg)";
  number += Math.ceil(Math.random() * 1000);
}

</script-->
</body>   
</html>

