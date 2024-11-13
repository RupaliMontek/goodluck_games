<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin Login</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="<?php echo base_url("frontend/styleFrBackend.css");?>" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> 
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
</head>
<body class="backendFont container-fluid frlogin">
    <div class="container">
        <!--<h6>Log out successfully!</h6>-->
        <div class="row loginpagerowww">
            
    <div class="col-12 col-md-6 col-lg-6 col-sm-4 frgoodluckmann">
        <img src="<?php echo base_url("backend/images/goodluckman.webp");?>">
    </div>
    
    <div class="col-12 col-md-6 col-lg-6 col-sm-8">
        <div class="frLoginTopp">
        <img src="<?php echo base_url("backend/images/khajana.webp");?>">
    </div>
   <!-- <h1>Login</h1>-->
    <?php if (!empty(validation_errors())) : ?>
    <div style="color: red;">
        <?php foreach (explode(PHP_EOL, validation_errors()) as $error) : ?>
            <?= $error ?><br>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <form id="check_login" action="<?= site_url('check_login_new'); ?>" method="POST">
        <!--<label for="username">Username</label>-->
        <input class="loginicc" type="text" name="username" id="username" required>
        <!--<label for="password">Password</label>-->
        <input class="usesricc" type="password" name="password" id="password" required>
        <button type="submit">Login</button>
    </form>
    </div>
    </div></div>
    <?php if(isset($error)) echo '<p style="color: red;">' . $error . '</p>'; ?>
       <script>
    //   shweta sound start
       function playSound() {
            var audio = new Audio('<?php echo base_url("frontend/game_audio/start.mp3"); ?>');
            audio.play();
        }
    //   shweta sound end

        
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('check_login');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const formData = new FormData(form); // Create a FormData object

                // Send the form data using fetch
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Server response:", data);
                    if (data.token) {
                        console.log("Login successful. Token received.");
                        // Store the token in local storage or session storage
                        localStorage.setItem('authToken', data.token);
                        // Redirect to the provided URL
                        window.location.href = data.redirect;
                    } else if (data.error) {
                        console.error("Login failed:", data.error);
                        // Display error message to the user
                        alert(data.error);
                    }
                })
                .catch(error => {
                    console.error("AJAX error:", error);
                    // Handle network or other errors
                });
            });
        });
    </script>
</body>
</html>
