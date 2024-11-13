<!-- resources/views/toggle_maintenance.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Maintenance Toggle</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery for AJAX -->
</head>
<body>
    <div id="toggleSwitch" class="toggle-switch">
        <div class="toggle-knob"></div>
    </div>

    <script>
    $(document).ready(function() {
        $('#toggleSwitch').on('click', function() {
            const isActive = $(this).hasClass('active');
            const newStatus = !isActive; // Toggle status

            // Update the toggle appearance
            $(this).toggleClass('active');

            // Send AJAX request to update the maintenance status
            $.ajax({
                url: '/toggle-maintenance', // Route for toggling maintenance
                type: 'POST',
                data: { enabled: newStatus },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF protection
                },
                success: function(response) {
                    console.log("Maintenance status updated:", response);
                    if (newStatus) {
                        window.location.href = '/maintenance'; // Redirect if maintenance is enabled
                    }
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
