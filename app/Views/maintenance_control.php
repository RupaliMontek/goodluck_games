<!-- app/Views/maintenance_control.php -->
     <div class="col-9 col-md-10 col-lg-10">
         <div class="row">
      <div class="col-lg-12 mt-3 frminheightttt">
          <h1>Maintenance Control</h1>
    <h3>Toggle maintenance mode below:</h3>

    <div id="toggleSwitch" class="toggle-switch <?= $is_maintenance_enabled ? 'active' : '' ?>">
        <div class="toggle-knob"></div>
    </div>
</div></div>
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
   <!-- <script>
       document.getElementById('toggleMaintenanceBtn').addEventListener('click', function() {
            fetch('<?= base_url('login/toggleMaintenance'); ?>', {  // Fix the concatenation of PHP in the URL
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Maintenance mode toggled successfully.');
                    // Reload the page to reflect the changes
                    location.reload();
                } else {
                    alert('Failed to toggle maintenance mode.');
                }
            })
            .catch(error => {
                console.error('Error toggling maintenance mode:', error);
                alert('An error occurred while toggling maintenance mode.');
            });
        });
</script>-->
