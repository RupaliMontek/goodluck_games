const wheel = document.getElementById("wheel");
const spinBtn = document.getElementById("spin-btn");
const finalValue = document.getElementById("final-value");
//Object that stores values of minimum and maximum angle for a value
const rotationValues = [
  { minDegree: 0, maxDegree: 18, value: 2 },
  { minDegree: 19, maxDegree: 54, value: 1 },
  { minDegree: 55, maxDegree: 90, value: 10 },
  { minDegree: 91, maxDegree: 126, value: 9 },
  { minDegree: 127, maxDegree: 162, value: 8 },
  { minDegree: 163, maxDegree: 198, value: 7 }, 
  { minDegree: 199, maxDegree: 234, value: 6 },
  { minDegree: 235, maxDegree: 270, value: 5 },
  { minDegree: 271, maxDegree: 306, value: 4 },
  { minDegree: 307, maxDegree: 342, value: 3 },
  { minDegree: 343, maxDegree: 360, value: 2 },
];
//Size of each piece
const data = [16, 16, 16, 16, 16, 16, 16, 16, 16, 16];
//background color for each piece
var pieColors = [
  "#8b35bc",
  "#b163da",
  "#8b35bc",
  "#b163da",
  "#8b35bc",
  "#b163da",
  "#8b35bc",
  "#b163da",
  "#8b35bc",
  "#b163da",
];
//Create chart
let myChart = new Chart(wheel, {
  //Plugin for displaying text on pie chart
  plugins: [ChartDataLabels],
  //Chart Type Pie
  type: "pie",
  data: {
    //Labels(values which are to be displayed on chart)
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
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
        font: { size: 24 },
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
let resultValue = 120; // Default value

// Start spinning
spinBtn.addEventListener("click", () => {
  spinBtn.disabled = true;
  finalValue.innerHTML = `<p>Good Luck!</p>`;

  // Set the target value to 1
  let targetValue = 2;

  let targetAngle;

  // Find the angle range for the target value
  for (let i of rotationValues) {
    if (i.value === targetValue) {
      targetAngle = (i.minDegree + i.maxDegree) / 2;
      break;
    }
  }

  if (targetValue % 2 !== 0) {
    resultValue = 120; // Set resultValue to 120 if targetValue is odd
  } else {
    resultValue = 96; // Set resultValue to 96 if targetValue is even
  }

  let rotationInterval = window.setInterval(() => {
    myChart.options.rotation = myChart.options.rotation + resultValue;
    myChart.update();

    if (myChart.options.rotation >= 360) {
      count += 1;
      resultValue -= 3;
      myChart.options.rotation = 0;
    } else if (count > 15) {
      // Stop spinner at the target angle
      if (myChart.options.rotation >= targetAngle) {
        clearInterval(rotationInterval);
        count = 0;
        finalValue.innerHTML = `<p>Value: ${targetValue}</p>`;
        spinBtn.disabled = false;
      }
    }
  }, 10);
});