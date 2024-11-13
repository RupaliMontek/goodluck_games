<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Countdown Timer</title>
    <link href="<?php echo base_url("frontend/Sadmin_backend.css");?>" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">  
        <div id="counter">0:00</div>
        <select name="SetTime" id="setTime">
            <option value="0">Set Time</option>
            <option value="60">1 Minute</option>
            <option value="120">2 Minutes</option>
            <option value="180">3 Minutes</option>
            <option value="240">4 Minutes</option>
            <option value="300">5 Minutes</option>
        </select>
        <button id="startBtn" class="btn btn-primary">Start</button>
    </div>

    <script>
        document.getElementById("startBtn").addEventListener("click", function () {
            var selectedTime = document.getElementById("setTime").value;

            // Validate if a time is selected
            if (selectedTime !== "0") {
                // Send AJAX request to update time in controller
                updateTimer(selectedTime);
                startTimer(selectedTime);
            } else {
                alert("Please select a valid time.");
            }
        });

        // Function to update timer in controller
        function updateTimer(seconds) {
            fetch('<?php echo base_url("superadmin/get_universal_counter_timer_all"); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ seconds: seconds }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Timer updated:', data);
            })
            .catch(error => {
                console.error('Error updating timer:', error);
            });
        }

        // Function to start the timer
        function startTimer(seconds) {
            var counterElement = document.getElementById("counter");
            localStorage.setItem("remainingTime", seconds);

            function tick() {
                var remainingTime = localStorage.getItem("remainingTime") || 0;
                remainingTime--;

                counterElement.textContent = formatTime(remainingTime);

                if (remainingTime > 0) {
                    localStorage.setItem("remainingTime", remainingTime);
                    setTimeout(tick, 1000);
                } else {
                    resetCountdown();
                }
            }

            tick();
        }

        // Function to reset the countdown
        function resetCountdown() {
            localStorage.removeItem("remainingTime");
            document.getElementById("counter").textContent = "0:00";
        }

        // Function to format time as "mm:ss"
        function formatTime(seconds) {
            var minutes = Math.floor(seconds / 60);
            var remainingSeconds = seconds % 60;
            return minutes + ":" + (remainingSeconds < 10 ? "0" : "") + remainingSeconds;
        }
    </script>
</body>
</html>
