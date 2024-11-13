<script src="<?= base_url('public/javascript/validation.js') ?>"></script>
<link rel="stylesheet" type="" href="<?= base_url('public/css/style.css') ?>">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<div id="balance_amount_extend_request_admin"></div>
<div id="balance_amount_extend_request_admins"></div>
<div id="superadmin_amount_extend_request_status_change"></div>
<div id="balance_amount_extend_return_admin"></div>
<div id="balance_amount_return_admin"></div>
<div id="player_withdraw_req_admin"></div>
<div id="admin_withdraw_re"></div>
<div class="container-fluid g-0 forfooter">
        <div class="container footerInn">
            <footer class="footer">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Licensed by <a
                        href="javascript:void(0)">FUNTARGET</a>.</span>
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                    2023-2024. All rights reserved.</span>
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block txt-rgt">Developed &amp; maintain by <a href="https://www.montekservices.com/" target="_blank">MONTEK TECH SERVICES PVT
                        LTD</a>.</span>
            </footer>
        </div>
</div>
</div>
</div>
<!-- Bootstrap JS (optional) -->
</body>
</html>

<script>
$(document).ready(function() {
 ////auto logout
  let isNavigating = false;

            // Function to handle the logout
            function autoLogout() {
                console.log('User has been logged out.');
                $.ajax({
                    url: '/login/auto_logout',
                    method: 'POST',
                    xhrFields: {
                        withCredentials: true // Include cookies if needed
                    },
                    success: function() {
                        window.location.href = '/login'; // Redirect after logout
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Logout failed:', textStatus, errorThrown);
                    }
                });
            }

            // Mark navigation when a link is clicked
            $('a').on('click', function() {
                isNavigating = true;
            });

            // Handle AJAX requests (e.g., for modals)
            $(document).on('ajaxStart', function() {
                isNavigating = true; // Prevent logout during AJAX requests
            }).on('ajaxStop', function() {
                isNavigating = false; // Reset after AJAX requests complete
            });

            // Handle the beforeunload event
            $(window).on('beforeunload', function(event) {
                if (!isNavigating) {
                    // Display confirmation dialog (optional)
                    event.preventDefault();
                    event.returnValue = ''; // Show dialog for some browsers
                    autoLogout(); // Trigger auto logout
                }
            });

            // Reset navigation state on page load
            $(window).on('load', function() {
                isNavigating = false;
            });
    
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
});
var base_url = '<?php echo base_url(); ?>';

function users_status_change(status, user_id) {
    $.ajax({
        url: base_url + 'login/users_status_change',
        type: 'POST',
        data: { status: status, user_id: user_id },
        success: function(data) {
            location.reload();
        }
    });
}

function check_list_admin_user_admin_request_superadmin() {
    $.ajax({
        url: base_url + 'superadmin/check_list_admin_user_admin_request_superadmin',
        type: 'GET',
        data: {},
        success: function(data) {
            $('#balance_amount_extend_request_admins').html(data);
            $('#admin_balance_amount_extend_request').modal('show');
        }
    });
}

// Function to get counter timerch
    // function getCounterTimerUniversal() {
    //     $.ajax({
           
    //         url: base_url + 'user/get_universal_counter_timer_all',
    //         type: "GET",
    //         // timeout: 10000, // 10 seconds
    //         data: {},
    //         success: function (data) {
    //             var data = JSON.parse(data);
    //             console.log(data.display_time);
    //             $(".mysuperadmincounter").html(data.display_time);
    //             console.log(data);
               
    //         }
    //     });
    // }
    
function check_player_user_withdraw_request_admin() {
    $.ajax({
        url: base_url + 'check_player_user_withdraw_request_admin',
        type: 'GET',
        data: {},
        success: function(data) {
            $('#player_withdraw_req_admin').html(data);
            $('#admin_balance_amount_extend_request').modal('show');
        }
    });
}

function check_admin_withdraw_request_status() {
    $.ajax({
        url: base_url + 'check_admin_withdraw_request_status',
        type: 'GET',
        data: {},
        success: function(data) {
            $('#admin_withdraw_re').html(data);
            $('#admin_balance_amount_extend_request').modal('show');
        }
    });
}


function check_admin_return_request_status() {
    $.ajax({
        url: base_url + 'check_admin_return_request_status',
        type: 'GET',
        data: {},
        success: function(data) {
            $('#balance_amount_return_admin').html(data);
            $('#admin_balance_amount_extend_request').modal('show');
        }
    });
}
function check_admin_request_status() {
    $.ajax({
        url: base_url + 'request/check_admin_request_status',
        type: 'GET',
        data: {},
        success: function(data) {
            $('#balance_amount_extend_request_admin').html(data);
            $('#admin_balance_amount_extend_request').modal('show');
        }
    });
}

function superadmin_amount_change_request_status_change() {
    $.ajax({
        url: base_url + 'admin/superadmin_amount_change_request_status_change',
        type: 'GET',
        data: {},
        success: function(data) {
            $('#superadmin_amount_extend_request_status_change').html(data);
            $('#admin_balance_amount_extend_request').modal('show');
        }
    });
}

function check_list_admin_user_admin_return_superadmin() {
    $.ajax({
        url: base_url + 'superadmin/check_list_admin_user_admin_return_superadmin',
        type: 'GET',
        data: {},
        success: function(data) {
            $('#balance_amount_extend_return_admin').html(data);
            $('#admin_balance_amount_return_request').modal('show');
        }
    });
}

function superadmin_amount_change_return_status_change() {
    $.ajax({
        url: base_url + 'admin/superadmin_amount_change_return_status_change',
        type: 'GET',
        data: {},
        success: function(data) {
            $('#superadmin_amount_extend_return_status_change').html(data);
            $('#admin_balance_amount_return_request').modal('show');
        }
    });
}

$("#player_account_add_form").validate({
    rules: {
        first_name: {
            required: true,
        },
        limit_user_add: {
            required: true,
        },
        last_name: {
            required: true,
        },
        amout_given: {
            required: true,
        },
        new_username: {
            required: true,
            remote: {
                url: base_url + "admin/check_player_username_exist",
                type: "POST",
                data: {
                    email: function() {
                        return $("#new_username").val();
                    }
                }
            }
        },
    },
    messages: {
        first_name: {
            required: "Required First Name",
        },
        limit_user_add: {
            required: "Required Email Address",
        },
        last_name: {
            required: "Required Last Name"
        },
        amout_given: {
            required: "Required Amount Given"
        },
        new_username: {
            required: "Required Username",
            remote: "This Player Name Is Already Exist Please Use Another.!"
        },
    }
});

$(document).ready(function() {
    check_list_admin_user_admin_request_superadmin();
   // getCounterTimerUniversal();
    // setInterval(check_list_admin_user_admin_request_superadmin, 500);
    superadmin_amount_change_request_status_change();
    setInterval(superadmin_amount_change_request_status_change, 60000);
    check_list_admin_user_admin_return_superadmin();
    setInterval(check_list_admin_user_admin_return_superadmin, 60000);
    superadmin_amount_change_return_status_change();
    setInterval(superadmin_amount_change_return_status_change, 60000);
    check_player_user_withdraw_request_admin()
    setInterval(check_player_user_withdraw_request_admin, 60000);
    check_admin_withdraw_request_status();
    setInterval(check_admin_withdraw_request_status, 60000);
    check_admin_return_request_status();
    setInterval(check_admin_return_request_status, 60000);
    check_admin_request_status();
    setInterval(check_admin_request_status, 60000);
});
</script>
<script>

</script>

<script>
/*window.addEventListener('beforeunload', function (e) {
    logout();
});

function logout() {
    $.ajax({
        url: base_url +"logout",
        type: "GET", 
        success: function(response) {
            window.location.href = "<?php echo base_url('login') ?>";
        },
        error: function(error) {
            console.error("Logout failed:", error);
        }
    });
}*/
</script>


