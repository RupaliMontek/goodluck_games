<style>
    /* Pagination styles */
ul.pagination {
    margin: 20px 0;
    padding: 0;
    list-style-type: none;
    text-align: center;
}

ul.pagination li {
    display: inline;
    margin-right: 5px;
}

ul.pagination li a,
ul.pagination li span {
    color: #333;
    padding: 8px 12px;
    text-decoration: none;
    border: 1px solid #ddd;
    background-color: #fff;
}

ul.pagination li.active a {
    background-color: #6f1512;
    color: #fff;
    border-color: #ffffff;

ul.pagination li a:hover:not(.active) {
    background-color: #f2f2f2;
}

</style>
   <?php  $mode = @$mode;  ?>
 <div class="col-9 col-md-10 col-lg-10">
        <div class="container mt-3">  
        <?php echo form_open(base_url('superadmin/set_mode_session')  ,
 array('class' => 'form-horizontal form-groups-bordered validate',
 'enctype' => 'multipart/form-data', 'method' => 'post', 'id'=>'dynamic_no_gen' ));?>
           <div id="counter" class="mysuperadmincounter"></div>
           <audio id="myAudio_ticktack">
                    <source src="<?php echo base_url("frontend/game_audio/mixkit-bike-wheel-spinning-1613.wav"); ?>" type="audio/mpeg">
            </audio>
        <h1>Dashboard Super Admin</h1>
        <div class="box">
            
            <div class="frHeadingAndButton">
               <h2>Last Ten Results</h2>
           <a href="<?php echo base_url('superadmin/show_24_hour_result');?>"> <button type="button"  id="submit" >24 hour result</button></a> 
            </div>
    <div class="number-box">
        <!-- Horizontal Layout -->
        <ul class="horizontal-list">
            <?php $count = 0; ?>
            <?php foreach ($last_ten_results as $result): ?>
                <?php if ($count < 10): ?>
                    <li><?php echo $result['numbers']; ?></li>
                    <?php $count++; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Coming Result</h3>
    </div>
    <div class="number-box">
        <ul class="horizontal-list">
            <?php foreach ($last_ten_results as $result): ?>
                <?php if ($count == 10): ?>
                    <li><?php echo $result['numbers']; ?></li>
                    <?php break; ?>
                <?php endif; ?>
                <?php $count++; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
        <div id="overlay"></div>
 <input type="radio" value="sec1" name="section" id="sec1"> Section 1-Closing Number
            <div class="number-box" id="section1">
                <div class="number-line1">
                    <div class="number-buttons1"> 
                        <!-- Section 1 Checkboxes -->
                        <div class="fornumberbtnsss"><input type="checkbox" id="S1number1" name="S1number1"  value="1"><label for="S1number1">1</label></div>
                        <div class="fornumberbtnsss"><input type="checkbox" id="S1number2" name="S1number2"  value="2"><label for="S1number2">2</label></div>
                        <div class="fornumberbtnsss"><input type="checkbox" id="S1number3" name="S1number3"  value="3"><label for="S1number3">3</label></div>
                        <div class="fornumberbtnsss"><input type="checkbox" id="S1number4" name="S1number4"  value="4"><label for="S1number4">4</label></div>
                        <div class="fornumberbtnsss"><input type="checkbox" id="S1number5" name="S1number5"  value="5"><label for="S1number5">5</label></div>
                        <div class="fornumberbtnsss"><input type="checkbox" id="S1number6" name="S1number6"  value="6"><label for="S1number6">6</label></div>
                        <div class="fornumberbtnsss"><input type="checkbox" id="S1number7" name="S1number7"  value="7"><label for="S1number7">7</label></div>
                        <div class="fornumberbtnsss"><input type="checkbox" id="S1number8" name="S1number8"  value="8"><label for="S1number8">8</label></div>
                       <div class="fornumberbtnsss"> <input type="checkbox" id="S1number9" name="S1number9"  value="9"><label for="S1number9">9</label></div>
                        <div class="fornumberbtnsss"><input type="checkbox" id="S1number0" name="S1number0"  value="0"><label for="S1number0">0</label></div>
                        <button <?php if($mode=="next"){ echo "checked"; } ?>    type="radio"  value="next" name="mode" id="next" >Next
                        <!--<input type="submit" id="submit_sec1" value="Submit Section 1">-->
        </div></div>
        </div>

        <input type="radio" value="sec2" name="section" id="sec2"> Section 2
        <div class="number-box" id="section2">
        <div class="number-line">
            <!--<h4>Next Result:</h4> -->
            <div class="number-buttons1">
                        <input type="radio" id="S2number1" name="S2number1"   value="1"><label for="S2number1">1</label>
                        <input type="radio" id="S2number2" name="S2number2"   value="2"><label for="S2number2">2</label>
                        <input type="radio" id="S2number3" name="S2number3"   value="3"><label for="S2number3">3</label>
                        <input type="radio" id="S2number4" name="S2number4"   value="4"><label for="S2number4">4</label>
                        <input type="radio" id="S2number5" name="S2number5"   value="5"><label for="S2number5">5</label>
                        <input type="radio" id="S2number6" name="S2number6"   value="6"><label for="S2number6">6</label>
                        <input type="radio" id="S2number7" name="S2number7"   value="7"><label for="S2number7">7</label>
                        <input type="radio" id="S2number8" name="S2number8"   value="8"><label for="S2number8">8</label>
                        <input type="radio" id="S2number9" name="S2number9"   value="9"><label for="S2number9">9</label>
                        <input type="radio" id="S2number0" name="S2number0"   value="0"><label for="S2number0">0</label>
                        <button <?php if($mode=="jackpot"){ echo "checked"; } ?>    type="radio"  value="jackpot" name="mode" id="jackpot" >Normal
                        <button <?php if($mode=="jackpot_2x"){ echo "checked"; } ?>   value="jackpot_2x" name="mode" id="jackpot_2x" >2x Jackpot
                        
<script>
// Get all radio buttons in the group
var radioButtons = document.querySelectorAll('[id^="S2number"]');
// Add click event listener to each radio button
radioButtons.forEach(function(button) 
{
    button.addEventListener('click', function() {
    // Uncheck all other radio buttons in the group
    radioButtons.forEach(function(btn) {
    if (btn !== button) 
    {
        btn.checked = false;
    }
});
        });
    });
</script>
</div>
</div>
</div>
        <input type="radio" value="sec3" name="section" id="sec3"> Section 3
        <div class="number-box" id="section3">
        <div class="number-line">
            <!--<h4>Next Result:</h4> -->
            <div class="number-buttons1">
        <input <?php if($mode=="high"){ echo "checked"; } ?>    type="radio" value="high" name="mode" id="high" ><label>High</label>
        <input <?php if($mode=="low"){ echo "checked"; } ?>    type="radio" value="low"  name="mode" id="low" ><label>Low</label>
        <input <?php if($mode=="mediam"){ echo "checked"; } ?>    type="radio" value="mediam"  name="mode" id="mediam"><label>Mediam</label>

        <button type="submit"  id="submit" >Submit</button>
        
         </div></div></div>
<?php
if (!empty($players_list)) {
    foreach ($players_list as $player) 
    {
        $player_name = $player['player_name'];
        $showNobtn0 = $player['button_0_value'];
    }
} else {
    echo "No players found.";
}
?>
<?php if (isset($sums) && !empty($sums) && count($sums) === 10): ?>
    <table class='table table-striped'>
        <thead id="players_sum">
            <tr id='players_playing'>
                <td>Sum</td>
                <?php
                // Define the desired order
                $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
                foreach ($order as $key) {
                    echo "<td><b>" . htmlspecialchars($sums[$key]) . "<b></td>";
                }
                ?>
            </tr>
        </thead>
    </table>
<?php else: ?>
    <p>No data available.</p>
<?php endif; ?>


    <table class="table table-striped">
    <thead>
        <tr id="players_playing">
        <tr id="numbers">
            <th scope="col">Player's Name</th>
            <th scope="col"><input type="text" name="number_table_val1" value="1"></th>
            <th scope="col"><input type="text" name="number_table_val2" value="2"></th>
            <th scope="col"><input type="text" name="number_table_val3" value="3"></th>
            <th scope="col"><input type="text" name="number_table_val4" value="4"></th>
            <th scope="col"><input type="text" name="number_table_val5" value="5"></th>
            <th scope="col"><input type="text" name="number_table_val6" value="6"></th>
            <th scope="col"><input type="text" name="number_table_val7" value="7"></th>
            <th scope="col"><input type="text" name="number_table_val8" value="8"></th>
            <th scope="col"><input type="text" name="number_table_val9" value="9"></th>
            <th scope="col"><input type="text" name="number_table_val0" value="0"></th>
        </tr>
    </thead>
    <tbody id="players_value">
        <?php
        if (!empty($players_list)):
            foreach ($players_list as $player):
                // Generate the URL for the player's profile page
                $player_url = base_url('superadmin/players_score_details/' . $player['player_id']);
                ?>
            <tr>
                <td><a href="<?php echo htmlspecialchars($player_url); ?>"><?php echo htmlspecialchars($player['player_name']); ?></td>
                <td><?php echo htmlspecialchars($player['button_1_value']); ?></td>
                <td><?php echo htmlspecialchars($player['button_2_value']); ?></td>
                <td><?php echo htmlspecialchars($player['button_3_value']); ?></td>
                <td><?php echo htmlspecialchars($player['button_4_value']); ?></td>
                <td><?php echo htmlspecialchars($player['button_5_value']); ?></td>
                <td><?php echo htmlspecialchars($player['button_6_value']); ?></td>
                <td><?php echo htmlspecialchars($player['button_7_value']); ?></td>
                <td><?php echo htmlspecialchars($player['button_8_value']); ?></td>
                <td><?php echo htmlspecialchars($player['button_9_value']); ?></td>
                <td><?php echo htmlspecialchars($player['button_0_value']); ?></td>
            </tr>
        <?php endforeach; endif; ?>
    </tbody>
</table>

<?php if (!empty($pager)) : ?>
    <?= $pager->links() ?>
<?php endif; ?>




    </form>
    
    <script>
        $(document).ready(function() {
            getCounterTimerUniversal();
setInterval(getCounterTimerUniversal, 500); 
            $('#submit_sec1').on('click', function() {
                var selectedValues = [];
                alert(selectedValues);

                $('input[type=checkbox]:checked').each(function() {
                    selectedValues.push($(this).val());
                });
            // console.log();
                $.ajax({
                    type: 'POST',
                   url: '<?php echo base_url("superadmin/save_section1_value"); ?>',
                    data: { selectedValues: selectedValues },
                    success: function(response) {
                        
                        // console.log(response);
                    },
                    error: function(error) {
                       
                        console.error(error);
                    }
                });
            });
        });
        
       setTimeout(function() {
    // Reload the page after 120 seconds
    window.location.reload();

    // Form submission using AJAX
    $('#dynamic_no_gen').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var base_url = "<?php echo base_url(); ?>";
        var formData = new FormData(this); // Create FormData object

        $.ajax({
            url: base_url + 'superadmin/set_mode_session', // Use the form's action attribute for the URL
            type: 'POST', // Form submission method
            data: formData,
            contentType: false, // Let the browser set the Content-Type header
            processData: false, // Prevent jQuery from automatically transforming the data into a query string
            success: function(response) {
                // Handle success - display a success message or redirect
                console.log('Success:', response);
                window.location.href = base_url + 'superadmin/';
            },
            error: function(xhr, status, error) {
                // Handle error - display an error message
                console.error('Error:', error);
            }
        });

        // Call getCounterTimerUniversal immediately after the timeout
        getCounterTimerUniversal();

    });

    // Call getCounterTimerUniversal immediately after the timeout
    getCounterTimerUniversal();

}, 120000); // 120000 milliseconds = 120 seconds

// Set interval to call getCounterTimerUniversal every 500 milliseconds
 
       // 120000
    </script>
    <script>
   var base_url = '<?php echo base_url(); ?>'; 
   var mode     = '<?php echo @$_SESSION["mode"] ?>';
  $(document).ready(function () 
  {
      getCounterTimerUniversal();
     setInterval(getCounterTimerUniversal, 500);
    //   get_counter_timer_universal();
    //   setInterval(get_counter_timer_universal, 500);
        $('input[type="radio"]').change(function () {
            var selectedSection = $('input[name="section"]:checked').val();
            if (selectedSection === 'sec1') {
                $('#section2').addClass('section-disabled');
                $('#section1').removeClass('section-disabled');
            } else if (selectedSection === 'sec2') {
                $('#section1').addClass('section-disabled');
                $('#section2').removeClass('section-disabled');
            }
        });

        $('input[type="checkbox"]').change(function () {
            updateChosenNumbers();
        });
    });
     
     $(document).ready(function() {
    // Disable both sections initially
    $('#section1, #section2, #section3').addClass('section-disabled');

    // Add event listeners to radio buttons for sections
    $('input[name="section"]').on('change', function() {
        var selectedSection = $(this).val();
// console.log(selectedSection);
        if (selectedSection === 'sec1') {
            $('#section3').addClass('section-disabled');
            $('#section2').addClass('section-disabled');
            $('#section1').removeClass('section-disabled');
        } else if (selectedSection === 'sec2') {
            $('#section1').addClass('section-disabled');
            $('#section2').removeClass('section-disabled');
            $('#section3').addClass('section-disabled');
        } else if (selectedSection === 'sec3') {
            $('#section1').addClass('section-disabled');
            $('#section3').removeClass('section-disabled');
            $('#section2').addClass('section-disabled');
        }

    });
});


    function updateChosenNumbers() {
        var selectedNumbers = $('input[type="checkbox"]:checked').map(function () {
            return $(this).val();
        }).get();

        $('#chosenNumbers').text(selectedNumbers.join(', '));
    }
</script>
<script>
    $(document).ready(function () {
        $('input[type="checkbox"]').change(function () {
            updateChosenNumbers();
        });
    });

    function updateChosenNumbers() {
        var selectedNumbers = $('input[type="checkbox"]:checked').map(function () {
            return $(this).val();
        }).get();

        $('#chosenNumbers').text(selectedNumbers.join(', '));
    }
   


function disableButtons() {
        $("#high, #low, #mediam, #jackpot").prop("disabled", true);
    }

    function enableButtons() {
        $("#high, #low, #mediam, #jackpot").prop("disabled", false);
    }


    function playSound() {
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

        // Call playSound() when the document is ready
       /* document.addEventListener('DOMContentLoaded', function() {
            playSound();
        });
*/
$(document).ready(function ()
{
  fetchPlayers();
   setInterval(fetchPlayers, 500);
    // Function to show the overlay
    function showOverlay() {
        $('#overlay').show();
    }

    // Function to hide the overlay
    function hideOverlay() {
        $('#overlay').hide();
    }

    
   
    // Call getCounterTimerUniversal every 500 milliseconds
    // getCounterTimerUniversal();
    //  setInterval(getCounterTimerUniversal, 500);
});

let currentPage = 1;
const playersPerPage = 10;

let isFetching = false;

function fetchPlayers(page) {
    if (isFetching) return;  // Exit if a fetch is already in progress
    isFetching = true;

    $.ajax({
        url: "<?php echo base_url('get_all_players_sum_and_values'); ?>",
        type: 'GET',
        data: { page: page, limit: playersPerPage },
        dataType: 'json',
        success: function(data) {
            console.log('Response Data:', data);

            if (data.players_list) {
                const playersList = data.players_list;
                const $tbody = $('#players_value');
                $tbody.empty(); 

                let rows = '';
                $.each(playersList, function(index, player) {
                    const player_url = 'superadmin/players_score_details/' + player.player_id;
                    rows += '<tr>' +
                        '<td><a href="' + player_url + '">' + player.player_name + '</a></td>' +
                        '<td>' + player.button_1_value + '</td>' +
                        // Continue for other buttons...
                        '</tr>';
                });
                $tbody.html(rows); // Append all at once
            }
            // Handle sums similarly
        },
        complete: function() {
            isFetching = false;  // Reset flag after request completes
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching players:', textStatus, errorThrown);
            isFetching = false;  // Reset flag even if there is an error
        }
    });
}




// Initial fetch
fetchPlayers(currentPage);


        function htmlspecialchars(str) {
            return $('<div>').text(str).html();
        }
 
</script>
<script>
    // Save the section (sec1 or sec2) and the selected values to Local Storage
    function saveSection(sectionId) {
        //sectionId='sec2';
        // Save which section is active
        localStorage.setItem('activeSection', sectionId);

        if (sectionId === 'sec1') {
            var selectedCheckboxes = [];
            document.querySelectorAll('#section1 input[type="checkbox"]').forEach(function(checkbox) {
                if (checkbox.checked) {
                    selectedCheckboxes.push(checkbox.id);
                }
            });
            // console.log(JSON.stringify(selectedCheckboxes));
            localStorage.setItem('sec1Checkboxes', JSON.stringify(selectedCheckboxes));
        } else if (sectionId === 'sec2') {
            var selectedRadio = null;
            document.querySelectorAll('#section2 input[type="radio"]').forEach(function(radio) {
                if (radio.checked) {
                    selectedRadio = radio.id;
                }
            });
            // console.log(selectedRadio);
            localStorage.setItem('sec2Radio', selectedRadio);
        } else if (sectionId === 'sec3') {
            var selectedRadio = null;
            document.querySelectorAll('#section3 input[type="radio"]').forEach(function(radio) {
                if (radio.checked) {
                    selectedRadio = radio.id;
                }
            });
            
            localStorage.setItem('sec3Radio', selectedRadio);
        }
        
    }

    // Restore the section and its selected values from Local Storage
    function restoreSection() {
        var activeSection = localStorage.getItem('activeSection');
        if (activeSection) {
            document.getElementById(activeSection).checked = true;

            if (activeSection === 'sec1') {
                var storedCheckboxes = JSON.parse(localStorage.getItem('sec1Checkboxes'));
                if (storedCheckboxes) {
                    storedCheckboxes.forEach(function(checkboxId) {
                        var checkbox = document.getElementById(checkboxId);
                        if (checkbox) {
                            checkbox.checked = true;
                        }
                    });
                }
            } else if (activeSection === 'sec2') {
                var storedRadioId = localStorage.getItem('sec2Radio');
                if (storedRadioId) {
                    var radio = document.getElementById(storedRadioId);
                    if (radio) {
                        radio.checked = true;
                    }
                }
            } else if (activeSection === 'sec3') {
                var storedRadioId = localStorage.getItem('sec3Radio');
                if (storedRadioId) {
                    var radio = document.getElementById(storedRadioId);
                    if (radio) {
                        radio.checked = true;
                    }
                }
            }
        }
    }

    // Attach event listeners to save the state when a section is selected
    document.querySelectorAll('input[name="section"]').forEach(function(section) {
        section.addEventListener('change', function() {
            saveSection(section.id);
        });
    });

    // Attach event listeners to save the selections within sections
    document.querySelectorAll('#section1 input[type="checkbox"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            saveSection('sec1');
        }); 
    }); 

    document.querySelectorAll('#section2 input[type="radio"]').forEach(function(radio) {
        radio.addEventListener('click', function() {
            saveSection('sec2');
        });
    });
    
    document.querySelectorAll('#section3 input[type="radio"]').forEach(function(radio) {
        radio.addEventListener('click', function() {
            saveSection('sec3');
        });
    });
    // Restore the state on page load
    restoreSection();
</script>
<script>
function getCounterTimerUniversal() {
        $.ajax({
           
            url: base_url + 'user/get_universal_counter_timer_all',
            type: "GET",
            // timeout: 10000, // 10 seconds
            
            dataType: 'json', // Expect a JSON response
            success: function (data) {
                var data =data.display_time;
                //console.log(data.display_time);
                 $("#counter").html(data);
                // console.log(data);
               
            }
        });
    }
    
</script>