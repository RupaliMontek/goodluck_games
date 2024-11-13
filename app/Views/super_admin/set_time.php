<div class="col-9 col-md-10 col-lg-10">
    <div class="container mt-3 frminheightttt frmobpaddingzeroo">
  <div class="row">
    <div class="col-md-12">
      <div id="counter">0:00</div>
      <select name="Set Time" id="setTimeDropdown">
        <option value="set_time">Set Time</option>
        <option value="1">1 Minute</option>
        <option value="2">2 Minutes</option>
        <!--<option value="3">3 Minutes</option>-->
        <!--<option value="4">4 Minutes</option>-->
        <!--<option value="5">5 Minutes</option>-->
      </select>
      <!--<input type="button" name="Submit" class="btn btn-primary" value="Submit" id="submitBtn">-->
      <button id="submitBtn">Submit</button>
    </div>
  </div>
</div>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->

<script>
var base_url = "<?php echo base_url(); ?>";
$(document).ready(function() {
     get_counter_timer_universal();
     setInterval(get_counter_timer_universal, 300);    
  $("#submitBtn").on("click", function() {
    var selectedTime = $("#setTimeDropdown").val();

    if (selectedTime !== "set_time") {
      var timeInSeconds = parseInt(selectedTime) * 60;
      $.ajax({
        type: 'POST',
        url: '<?php echo site_url('superadmin/saveSelectedTime'); ?>',
        data: { 'selected_time': timeInSeconds },
        success: function(response) {
          console.log(response);
          startTimer(timeInSeconds);
        },
        error: function(xhr, status, error) {
          alert('Error saving countdown: ' + error);
        }
      });
    } else {
      alert("Please select a valid time.");
    }
  });
  
function get_counter_timer_universal()
{  
    $.ajax
    ({
		 url: base_url + 'user/get_universal_counter_timer_all',
            type: "GET",
            // timeout: 10000, // 10 seconds
            
            dataType: 'json', // Expect a JSON response
		success: function(data)
		{ 
		    var data = data.display_time;
		    $("#counter").html(data);
        }
		
	});
}

  function startTimer(seconds) {
    var counterElement = document.getElementById("counter");

    function tick() {
      seconds--;
      counterElement.textContent = formatTime(seconds);

      if (seconds > 0) {
        setTimeout(tick, 1000);
      } else {
        resetCountdown();
      }
    }

    tick();
  }

  function formatTime(seconds) {
    var minutes = Math.floor(seconds / 60);
    var remainingSeconds = seconds % 60;
    return `${minutes}:${remainingSeconds < 10 ? "0" : ""}${remainingSeconds}`;
  }

  function resetCountdown() {
    document.getElementById("counter").textContent = "0:00";
  }
});
</script>
