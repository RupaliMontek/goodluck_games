<!-- app/Views/maintenance_control.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Maintenance Control</title>
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <link href="<?php echo base_url("frontend/Sadmin_backend.css");?>" rel="stylesheet">
</head>
<body>
    <h1>Maintenance Control</h1>
    <h3>Toggle maintenance mode below:</h3>

    <div id="toggleSwitch" class="toggle-switch <?= $is_maintenance_enabled ? 'active' : '' ?>">
        <div class="toggle-knob"></div>
    </div>

    <script>
    $(document).ready(function() {
        $('#toggleSwitch').on('click', function() {
            const isActive = $(this).hasClass('active');
            const newStatus = !isActive; // Toggle status

            $(this).toggleClass('active'); // Update appearance

            // Send AJAX request to update maintenance status
            $.ajax({
                url: '/toggle-maintenance',
                type: 'POST',
                data: { enabled: newStatus },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF protection
                },
                success: function(response) {
                    console.log("Maintenance status updated:", response);
                },
                error: function(error) {
                    console.error("Error updating maintenance status:", error);
                },
            });
        });
    });
    </script>

    <style>
    .toggle-switch {
        width: 60px;
        height: 30px;
        background-color: #ccc;
        border-radius: 15px;
        position: relative;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-left: -190%;
        margin-top: 10%;
    }

    .toggle-knob {
        width: 28px;
        height: 28px;
        background-color: #fff;
        border-radius: 50%;
        position: absolute;
        top: 1px;
        left: 1px;
        transition: all 0.3s;
    }

    .toggle-switch.active {
        background-color: #4CAF50;
    }

    .toggle-switch.active .toggle-knob {
        left: 31px;
    }
    </style>

</body>
</html>
