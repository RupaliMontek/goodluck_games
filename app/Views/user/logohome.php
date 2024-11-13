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
    <!---------------  Font Aewsome  --------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 
    <!---------------  CSS  --------------------->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> 
    <!-- Stylesheet -->
  </head>
<body>
        <audio id="buttonClickSound" src="<?php echo base_url('frontend/game_audio/click558.mp3'); ?>" preload="auto"></audio>

        <audio id="notificationSound" src="<?php echo base_url('frontend/game_audio/start.mp3'); ?>" preload="auto"></audio>

    <div class="container-fluid allgamebgg">
    <div class="row">
<div class="settingsdropdown col-lg-12 col-md-12 col-sm-12">
<div class="settingsdroLeft">
<div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i> 
                        <?php if(!empty($admin_users_details->first_name)) { ?>
                            <label><?php echo   " ".$admin_users_details->first_name." ".$admin_users_details->last_name; ?></label>
                        <?php } ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a id="logoutBtn" class="dropdown-item" href="<?php echo base_url();?>login/logout">Log Out</a></li>
                    </ul>
                </div>
<h4>Points : <span id="main_score"></span></h4>
</div>
<div class="settingsdroRight">
<button class="frSettings" type="button" data-toggle="modal" data-target="#myModalSetting">
    <img width="50px" height="auto" src="<?php echo base_url("frontend/images/settingic.png");?>" />
</button>
  <!-- Modal -->
  <div class="modal fade" id="myModalSetting" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content"> 
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <ul>
		<li><a class="dropdown-item" href="<?php echo site_url("withdraw/list_balance_admin_withdraw"); ?>">Withdraw Money</a></li>
		<li><a class="dropdown-item" href="<?php echo base_url("request/list_balance_admin_request"); ?>">Request Money</a></li>
		<li><a class="dropdown-item" href="<?php echo base_url("user/user_history"); ?>">User History</a></li></ul>
		<ul>
		<li><a class="dropdown-item" href="#" id="logoutBtn22">Logout</a></li>
	  </ul>
        </div>
      </div>
      
    </div>
  </div>
	</div>
</div>
	</div>
<div class="row forGameLogoScreen">
    
    <div class="col-lg-5 col-md-6 col-sm-6"> 
        <a href="<?php echo base_url("spinner"); ?>" class="GameLogosss"> <img class="img-fluid" src="<?php echo base_url("frontend/images/game1logo.png");?>" /></a>
    </div>
</div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
<script>
var base_url = "<?php echo base_url(); ?>";

        $(document).ready(function() {
            get_user_balance_amount();
            setInterval(get_user_balance_amount, 10000);
            
             addSoundEffectToButtons();
            // Play sound when the page loads
            var audio = document.getElementById('notificationSound');
            audio.play();
        });
        
$( document ).ready(function() 
{
    get_user_balance_amount();
    setInterval(get_user_balance_amount, 10000);
});
function get_user_balance_amount()
{
    $.ajax({
			url: base_url+'user/get_user_balance_amount',
			type: "GET",
			data: {},
			success: function(data)
			{
			   var data = JSON.parse(data);
			   if(data.current_wallet==null)
			   {
			     scoreValue = data.amout_given;
			   }
			   else
			   {
			       scoreValue = data.current_wallet;
			   }
			   console.log(scoreValue);
			   $('#main_score').text(scoreValue);
			}
	});
}
 function addSoundEffectToButtons() {
            // Get all buttons
            var buttons = document.querySelectorAll('button, a');

            // Add click event listener to each button
            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var soundId = 'buttonClickSound';

                    // Special case for logout buttons
                    if (this.id === 'logoutBtn' || this.id === 'logoutBtn22') {
                        soundId = 'logoutSound';
                    }

                    var audio = document.getElementById(soundId);
                    audio.play();
                });
            });
        }
main_score
    document.getElementById('logoutBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default action

        if (confirm("Do you want to exit the game?")) {
            window.location.href = "<?php echo base_url('logout') ?>";
        } else {
        }
    });
    document.getElementById('logoutBtn22').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default action

        if (confirm("Do you want to exit the game?")) {
            window.location.href = "<?php echo base_url('logout') ?>";
        } else {
        }
    });
</script>