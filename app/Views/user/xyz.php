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
    <?php } else { ?>
        <link href="<?php echo base_url("frontend/DarkTheme.css");?>" rel="stylesheet">
    <?php }?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url("frontend/images/apple-touch-icon.png");?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url("frontend/images/favicon-32x32.png");?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("frontend/images/favicon-16x16.png");?>">
    <link rel="manifest" href="<?php echo base_url("frontend/images/site.webmanifest");?>">
</head>
<style>
    .disabled-button {
        visibility: visible;
        opacity: 1!important;
        cursor: not-allowed;
        color: #fff!important;
    }
    .btn {
        background-color: #f0f0f0;
    }
</style>
<body>
<div id="contents" class="container-fluid gamebgg">
    <audio id="loadingMusic" src="<?php echo base_url("frontend/game_audio/mario.loading.mp3"); ?>" preload="auto"></audio>
    <div class="forspinner">
        <div class="wrapper">
            <div class="container">
                <canvas id="wheel"></canvas>
                <button id="spin-btn"><img class="img-fluid" src="<?php echo base_url("frontend/images/spinball.png");?>" /></button>
                <img class="spinarrowww" src="<?php echo base_url("frontend/images/targettt.png");?>" alt="spinner-arrow" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div id="final-value">
                <p>value</p>
            </div>
        </div>
    </div>
    <script>
        const wheel = document.getElementById("wheel");
        const spinBtn = document.getElementById("spin-btn");
        const finalValue = document.getElementById("final-value");

        const rotationValues = [
            { minDegree: 0, maxDegree: 35, value: 0 },
            { minDegree: 36, maxDegree: 71, value: 9 },
            { minDegree: 72, maxDegree: 107, value: 8 },
            { minDegree: 108, maxDegree: 143, value: 7 },
            { minDegree: 144, maxDegree: 179, value: 6 },
            { minDegree: 180, maxDegree: 215, value: 5 },
            { minDegree: 216, maxDegree: 251, value: 4 },
            { minDegree: 252, maxDegree: 287, value: 3 },
            { minDegree: 288, maxDegree: 323, value: 2 },
            { minDegree: 324, maxDegree: 359, value: 1 },
        ];

        const data = [16, 16, 16, 16, 16, 16, 16, 16, 16, 16];
        const pieColors = [
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

        let myChart = new Chart(wheel, {
            plugins: [ChartDataLabels],
            type: "pie",
            data: {
                labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 0],
                datasets: [
                    {
                        backgroundColor: pieColors,
                        data: data,
                    },
                ],
            },
            options: {
                responsive: true,
                animation: { duration: 0 },
                plugins: {
                    tooltip: false,
                    legend: { display: false },
                    datalabels: {
                        color: "#ffffff",
                        formatter: (_, context) => context.chart.data.labels[context.dataIndex],
                        font: { size: 30 },
                    },
                },
                rotation: 0,
            },
        });

        function easeOut(t) {
            return t * (2 - t);
        }

        spinBtn.addEventListener("click", () => {
            spinBtn.disabled = true;
            finalValue.innerHTML = `<p>Spinning...</p>`;
            
            let targetValue = 8;
            let targetAngle;
            for (let i of rotationValues) {
                if (i.value === targetValue) {
                    targetAngle = (i.minDegree + i.maxDegree) / 2;
                    break;
                }
            }

            let currentRotation = myChart.options.rotation;
            let spinDuration = 3000; // Spin duration in milliseconds (3 seconds)
            let intervalDuration = 10; // Interval duration in milliseconds
            let totalSteps = spinDuration / intervalDuration;

            let rotations = 5; // Number of full rotations (reduce for slower spin)
            let totalRotation = currentRotation + (360 * rotations) + targetAngle - (currentRotation % 360);
            
            let step = 0;

            let rotationInterval = window.setInterval(() => {
                step++;
                let progress = step / totalSteps;
                let easedProgress = easeOut(progress);
                let currentStepRotation = currentRotation + easedProgress * (totalRotation - currentRotation);
                myChart.options.rotation = currentStepRotation % 360;
                myChart.update();

                if (step >= totalSteps) {
                    clearInterval(rotationInterval);
                    myChart.options.rotation = targetAngle;
                    myChart.update();
                    finalValue.innerHTML = `<p>Value: ${targetValue}</p>`;
                    spinBtn.disabled = false;
                }
            }, intervalDuration);
        });
    </script>
</div>
</body>
</html>
