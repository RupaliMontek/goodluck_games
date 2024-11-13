<style>
    .btn-align-superadmin-dashboard {
    align-items: right;
    align-content: right;
    margin-left: 620px;
}
.h3{
    font-size: 1.75rem;
    margin-left: 550px;
}
.number-buttons{
    font-size: 1.75rem;
    margin-top: 50px;
}
</style> 
<body>
  
 <?php echo form_open(base_url('superadmin/saveIndices')  ,
 array('class' => 'form-horizontal form-groups-bordered validate',
 'enctype' => 'multipart/form-data', 'method' => 'post', 'id'=>'dynamic_no_gen' ));?>
<div class="col-auto col-md-9">
        <div class="container mt-5">  
           <div id="counter"></div>
           <div id="verifiBtn"></div>
        <h1>Dashboard Super Admin</h1>
        <h3>Last Ten Result - 1,5,0,0,8,6,3,2,4</h3>
        
        <div class="number-line">
    <div class="number-buttons">
        <input class="form_control" type="text" id="mode_set" name="mode_set">
        <input type="checkbox" id="number0" name="number[]"  onchange="handleCheckboxChange(this)"><label for="number0">0</label>
        <input type="checkbox" id="number1" name="number[]"  onchange="handleCheckboxChange(this)"><label for="number1">1</label>
        <input type="checkbox" id="number2" name="number[]"  onchange="handleCheckboxChange(this)"><label for="number2">2</label>
        <input type="checkbox" id="number3" name="number[]"  onchange="handleCheckboxChange(this)"><label for="number3">3</label>
        <input type="checkbox" id="number4" name="number[]"  onchange="handleCheckboxChange(this)"><label for="number4">4</label>
        <input type="checkbox" id="number5" name="number[]"  onchange="handleCheckboxChange(this)"><label for="number5">5</label>
        <input type="checkbox" id="number6" name="number[]"  onchange="handleCheckboxChange(this)"><label for="number6">6</label>
        <input type="checkbox" id="number7" name="number[]"  onchange="handleCheckboxChange(this)"><label for="number7">7</label>
        <input type="checkbox" id="number8" name="number[]"  onchange="handleCheckboxChange(this)"><label for="number8">8</label>
        <input type="checkbox" id="number9" name="number[]"  onchange="handleCheckboxChange(this)"><label for="number9">9</label>
        </div>
        </div>
        <h4>Next Result: <span id="chosenNumbers"></span></h4> 
        <button type="button"value="high" onclick="set_mode_session_value('high')" id="high" >High</button>
        <button type="button"value="low" onclick="set_mode_session_value('low')" id="low" >Low</button>
        <button type="button"value="mediam" onclick="set_mode_session_value('mediam')" id="mediam">Mediam</button>
        <button type="button"value="2x_jackpot" onclick="set_mode_session_value('2x_jackpot')" id="2x_jackpot" >2x Jackpot</button>
        <button type="button"onclick="set_mode_session_value('next')" id="next" >Next</button>
        <table  class="table table-striped">
            <thead>
                 <tr id="players_playing">
                    <td></td>
                    <td>590</td>
                    <td>225</td>
                    <td>150</td>
                    <td>645</td>
                    <td>510</td>
                    <td>360</td>
                    <td>190</td>
                    <td>240</td>
                    <td>310</td>
                    <td>170</td>
                </tr>    
                <tr id="numbers">
                    <th scope="col"></th>
                    <th scope="col"><input type="text" name="number_table_val1" value="1" >1</th>
                    <th scope="col"><input type="text" name="number_table_val2" value="2" >2</th>
                    <th scope="col"><input type="text" name="number_table_val3" value="3" >3</th>
                    <th scope="col"><input type="text" name="number_table_val4" value="4" >4</th>
                    <th scope="col"><input type="text" name="number_table_val5" value="5" >5</th>
                    <th scope="col"><input type="text" name="number_table_val6" value="6" >6</th>
                    <th scope="col"><input type="text" name="number_table_val7" value="7" >7</th>
                    <th scope="col"><input type="text" name="number_table_val8" value="8" >8</th>
                    <th scope="col"><input type="text" name="number_table_val9" value="9" >9</th>
                    <th scope="col"><input type="text" name="number_table_val0" value="0" >0</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($players_list as $row): ?>
                <tr>
                   <td><?php echo $row->first_name." ".$row->last_name ; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> 
            <?php  endforeach; ?> 
                 
            </tbody>
        </table>
    </div>
    </div>
    </form>
    
<script>
var base_url = '<?php echo base_url(); ?>'; 
var mode     = '<?php echo @$_SESSION["mode"] ?>';  
function set_next_number_by_mode()
{
    var mode     = '<?php echo @$_SESSION["mode"] ?>';  
    var lucky_draw_no = '';
    $('.btn').removeClass('btn-warning'); // Remove the class from all buttons
    $('#' + mode).addClass('btn-warning'); 
    if(mode=='high')
    {
        
       lucky_draw_no = getRandomNumber_high_Index();
       $("#mode_set").val("high");
    }
    else if (mode=='low') 
    {   
        
        lucky_draw_no=  getRandomNumber_low_Index();
        $("#mode_set").val("low");
    }
     else if (mode=='mediam') 
    {    
        lucky_draw_no=  getRandomNumber_intermediate_Index();
        $("#mode_set").val("mediam");
    }
    
    else if (mode=='2x_jackpot') 
    {   
    }
    else if (mode=='next') 
    {    
        lucky_draw_no=  getRandomNumber_next_Index();
        $("#mode_set").val("next");
    }
    var mode = sessionStorage.getItem('selectedMode');
    if(mode=='high')
    {
        
       lucky_draw_no = getRandomNumber_high_Index();
       $("#mode_set").val("high");
    }
    else if (mode=='low') 
    {   
        
        lucky_draw_no=  getRandomNumber_low_Index();
        $("#mode_set").val("low");
    }
     else if (mode=='mediam') 
    {    
        lucky_draw_no=  getRandomNumber_intermediate_Index();
        $("#mode_set").val("mediam");
    }
    
    else if (mode=='2x_jackpot') 
    {   
    }
    else if (mode=='next') 
    {    
        lucky_draw_no=  getRandomNumber_next_Index();
        $("#mode_set").val("next");
    }
    
   }



 $(document).ready(function () {
  set_next_number_by_mode();
  var selectedMode = sessionStorage.getItem('selectedMode');
    if (selectedMode) 
    {
        $('.btn').removeClass('btn-warning');
        $('#' + selectedMode).addClass('btn-warning');
    }
    function countdown()
    {
        function tick() 
            {
                var counter = document.getElementById("counter");
                console.log(counter); 
                var seconds = localStorage.getItem("remainingTime") || 120;
                seconds--;
                counter.innerHTML = "0:" + (seconds < 10 ? "0" : "") + String(seconds);
                if (seconds > 0) 
                {
                    localStorage.setItem("remainingTime", seconds);
                    setTimeout(tick, 1000);
                } 
                else 
                {
                    resetCountdown(); 
                }
            }

            tick();
    }

        function resetCountdown() 
        {
            localStorage.removeItem("remainingTime");
            countdown();
        }
        countdown();
        setInterval(spinner_game_function, 1000);  
     
  });
  
  
  function spinner_game_function()
    {
        var counterElement = document.getElementById("counter");
        if (counterElement) 
        {
           var counterValue = counterElement.innerHTML;
           console.log("Counter Value:", counterValue);
           if (counterValue <= "0:10") 
           {
                disableButtons();
           }
           else
           {
                enableButtons();       
           }
        } 
        else 
        {
            console.log("Counter element not found.");
         }
    }
    
   function disableButtons() 
   {
       $("#high, #low, #mediam, #2x_jackpot", "#next").prop("disabled", true);
   }
   
   $('#high, #low, #mediam, #2x_jackpot, #next').on('click', function() {
        clearAppendedValues();
    });
   
   function enableButtons() 
   {
      $("#high, #low, #mediam, #2x_jackpot", "#next").prop("disabled", false);
    }
    
    
 function set_mode_session_value(mode)
 {
     alert(mode);
        $.ajax({
        url: base_url+'superadmin/set_mode_session',
        type: 'POST',
        data: { mode: mode, },
        success: function(response) 
        {
            alert('Session value set successfully!');
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error setting session value:', error);
        }
    });
  }
  var $tr = $('#players_playing');
  function selectNumber(number) 
  {
    document.getElementById("chosenNumber").textContent = number;
  }
   var selectedNumbers = [];
   function selectNumber(number)
   {
        var index = selectedNumbers.indexOf(number);

        if (index === -1) 
        {
            selectedNumbers.push(number);
        } 
        else 
        {
            selectedNumbers.splice(index, 1);
        }
        updateDisplay();
    }
    
     function updateDisplay() 
     {
        var chosenNumbersSpan = document.getElementById('chosenNumbers');
        chosenNumbersSpan.textContent = selectedNumbers.join(', ');
     }
     
   function getRandomNumber_next_Index() 
    {
        var $tr = $('#players_playing');
        var $tds = $tr.find('td');
        var $ths = $tr.siblings('#numbers').find('th');
        var chosenNumbers = $('#chosenNumbers').text();
        var numbers = [];
        var nextIndices = [];
        $.ajax({
        url: base_url+'superadmin/saveIndices',
        type: 'POST',
        data: { nextIndices: chosenNumbers, },
        success: function(response) 
        {
          
        },
    });
}

function getRandomNumber_high_Index() 
{
    var $tr = $('#players_playing');
    var $tds = $tr.find('td');
    var $ths = $tr.siblings('#numbers').find('th');
    var numbers = [];
    var topThreeIndices = [];
    $tds.each(function(index) {
    var num = parseInt($(this).text(), 10); 
    if (!isNaN(num)) 
    { 
        numbers.push({ index: index, value: num });
    }
    });
    numbers.sort(function(a, b) 
    {
    return b.value - a.value;
    });
    var topThree = numbers.slice(0, 3);
    $.each(topThree, function(index, element)
    {
    var currentIndex = element.index;
    var $input = $('<input>', 
    {
        type: 'text',
        value: currentIndex,
        name: 'dynamicInput' + currentIndex // Set a unique name for each input
    });
    $('#dynamic_no_gen').append($input);
    topThreeIndices.push(currentIndex);
    console.log(topThreeIndices); 
    $ths.eq(currentIndex).css
    ({
            
        'background-color': 'red',
        'color': 'white', 
        'border': '1px solid black'
    });    
        
      });
    $.ajax({
        url: base_url+'superadmin/saveIndices',
        type: 'POST',
        data: { topThreeIndices: topThreeIndices, },
        success: function(response) 
        {
           
        },
    });
}


function getRandomNumber_intermediate_Index() 
 {
        var $tr = $('#players_playing');
        var $tds = $tr.find('td');
        var $ths = $tr.siblings('#numbers').find('th');
        var numbers = [];
        var intermediateIndices = [];
        $tds.each(function(index) {
        var num = parseInt($(this).text(), 10); 
        if (!isNaN(num)) 
        { 
            numbers.push({ index: index, value: num });
        }
        });
        numbers.sort(function(a, b) 
        {
            return a.value - b.value;
        });

        var mediumThree = numbers.slice(0, 3);
        $.each(mediumThree, function(index, element) {
        var currentIndex = element.index;
        var $input = $('<input>', 
        {
        type: 'text',
        value: currentIndex,
        name: 'dynamicInput' + currentIndex // Set a unique name for each input
        });
        $('#dynamic_no_gen').append($input);
        intermediateIndices.push(currentIndex);
        $ths.eq(currentIndex).css
        ({
            // 'text-decoration': 'line-through',
            'background-color': 'blue',
            'color': 'white', 
            'border': '1px solid black'
        });      
        
    });
    $.ajax({
        url: base_url+'superadmin/saveIndices',
        type: 'POST',
        data: { topThreeIndices: intermediateIndices, },
        success: function(response) 
        {
           
        },
    });
}



function getRandomNumber_low_Index()
 {
        var $tr = $('#players_playing');
        var $tds = $tr.find('td');
        var $ths = $tr.siblings('#numbers').find('th');
        var numbers = [];
        var bottomFourIndices = [];
        $tds.each(function(index) 
        {
        var num = parseInt($(this).text(), 10); 
        if (!isNaN(num)) 
        { 
            numbers.push({ index: index, value: num });
        }
        });
        numbers.sort(function(a, b) 
        {
            return a.value - b.value;
        });
        var bottomFour = numbers.slice(0, 4);
        $.each(bottomFour, function(index, element) {
        var currentIndex = element.index;
        var $input = 
        $('<input>', 
        {
        type: 'text',
        value: currentIndex,
        name: 'dynamicInput' + currentIndex // Set a unique name for each input
        });
        $('#dynamic_no_gen').append($input);
        bottomFourIndices.push(currentIndex);
        $ths.eq(currentIndex).css
        ({
            // 'text-decoration': 'line-through',
            'background-color': 'green',
            'color': 'white', // Optionally set text color to white for better visibility
            'border': '1px solid black'
        });
    });

    $.ajax({
        url: base_url+'superadmin/saveIndices',
        type: 'POST',
        data: { topThreeIndices: bottomFourIndices, },
        success: function(response) 
        {
        },
    });
}


function clearAppendedValues() 
{
    $('#dynamic_no_gen').empty();
}

function handleCheckboxChange(checkbox) {
    if (checkbox.checked) 
    {
        console.log(checkbox.value + ' is checked');
    } 
    else 
    {
        console.log(checkbox.value + ' is unchecked');
    }
}

</script>
</body>