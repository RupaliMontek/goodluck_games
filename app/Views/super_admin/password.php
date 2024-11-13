<div class="col-9 col-md-10 col-lg-10">
    <div class="container mt-3 frminheightttt">
        <div class="row">
             <h2>Change Password</h2>
            <div class="col-12 col-lg-5 col-md-7 frchangepww">
                <form id="changePasswordForm" action="<?= base_url("superadmin/updatePassword") ?>" method="post">
                    <div class="form-group pass_show">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" required>
                    </div> 
                    <div class="form-group pass_show">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                    </div> 
                    <div class="form-group pass_show">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    </div> 
                    <button type="submit">Change Password</button>
                </form>
            </div>  
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.pass_show').append('<span class="ptxt"><i class="fa fa-eye"></i></span>');  
        });

        $(document).on('click','.pass_show .ptxt', function(){ 
            $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 
            $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
        });
    </script>