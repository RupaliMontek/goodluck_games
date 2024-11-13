document.addEventListener("DOMContentLoaded", function () {
    // Get the elements
    var spinWheel = document.getElementById("spinWheel");
    var spinBtn = document.getElementById("spin_btn");

  // Set the labels for the pie chart
  var pieChartLabels = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

  // Set the colors for the pie chart slices
  var spinColors = ["red", "red", "green", "#fff", "#333", "#33FF42", "#33FFA3", "#33FFD9", "#33D9FF", "#3374FF"];


    // Set the default stop label
    var stopLabel = 1; // You can change this to the desired label

    // Calculate the rotation angle for the stop label
    var anglePerLabel = 360 / pieChartLabels.length;
    var stopAngle = 360 - (anglePerLabel * stopLabel);

    // Initialize the Chart.js pie chart
    let spinChart = new Chart(spinWheel, {
        type: "pie",
        data: {
            labels: pieChartLabels,
             
            datasets: [{
                backgroundColor: spinColors,
               data: Array.from({ length: pieChartLabels.length }, () => 2), // Default size for each slice
            }],
        },
        options: {
            responsive: true,
            animation: { duration: 0 },
            plugins: {
                tooltip: false,
                legend: {
                    display: false,
                },
            },
            onDraw: function (chart) {
                var width = chart.width,
                    height = chart.height,
                    ctx = chart.ctx;

                var centerX = width / 2,
                    centerY = height / 2,
                    radius = Math.min(width, height) / 2;

                chart.data.labels.forEach(function (label, index) {
                    var angle = -stopAngle + index * anglePerLabel;
                    var x = centerX + Math.cos(angle * Math.PI / 180) * (radius * 0.85);
                    var y = centerY + Math.sin(angle * Math.PI / 180) * (radius * 0.85);
console.log(label);
                    // Draw label on the blue slice
                    if (spinColors[index] === "rgb(255, 87, 51)") {
                        ctx.fillStyle = "#FFFFFF"; // Set text color to white
                        ctx.fillText(label, x, y);
                    }
                });
            },
        },
    });

    // Function to spin the wheel
    function spinWheelFunction() {
        var currentRotation = 0;
        var rotationInterval = 2; // Adjust the speed of the spin

        // Update the rotation of the wheel
        function updateRotation() {
            currentRotation += rotationInterval;
            spinWheel.style.transform = "rotate(" + currentRotation + "deg)";

            // Check if the wheel has reached the stop angle
            if (currentRotation >= stopAngle) {
                clearInterval(rotationIntervalId);
                alert("Spinner stopped at label: " + pieChartLabels[stopLabel]);
            }
        }

        // Start rotating the wheel
        var rotationIntervalId = setInterval(updateRotation, 10);
    }

    // Add click event listener to the spin button
    spinBtn.addEventListener("click", spinWheelFunction);
});


