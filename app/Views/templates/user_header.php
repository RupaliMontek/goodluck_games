<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Spinner Game Project</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> 
</head>
<body>

    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h1>Logo</h1>
                </div>
                <div class="col-6 text-end">
                    <nav>
                        <ul class="list-inline">
                            <!--<li class="list-inline-item"><a href="#">Home</a></li>-->
                            <!--<li class="list-inline-item"><a href="#">About</a></li>-->
                            <!--<li class="list-inline-item"><a href="#">Services</a></li>-->
                            <!--<li class="list-inline-item"><a href="#">Contact</a></li>-->
                            <!--<li class="list-inline-item">-->
                    
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1"><?= $_SESSION["username"] ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                       <!--  <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
 -->                        <li><a class="dropdown-item" href="<?= base_url('superadmin/profile'); ?>">Profile</a></li>
                        
                         <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><button class="dropdown-item" id="toggleMaintenanceBtn">Toggle Maintenance Mode</button></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url('login/change_password'); ?>">Change Password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url('logout'); ?>">Sign out</a></li>
                    </ul>
                
                </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <script>
    document.getElementById('toggleMaintenanceBtn').addEventListener('click', function() {
        fetch(<?= base_url('login/toggleMaintenance'); ?>', {
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
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php
            // Check if a flash message exists
            $successMessage = session()->getFlashdata('success_message');
            $errorMessage = session()->getFlashdata('error_message');

            if ($successMessage) {
                echo 'showToast("success", "' . $successMessage . '");';
            } elseif ($errorMessage) {
                echo 'showToast("error", "' . $errorMessage . '");';
            }
            ?>

            function showToast(type, message) {
                var toastContainer = document.getElementById('toast-container');

                var toastHTML = '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">' +
                    '<div class="toast-header bg-' + (type === "success" ? 'success' : 'danger') + '">' +
                    '<strong class="me-auto text-white">Notification</strong>' +
                    '<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>' +
                    '</div>' +
                    '<div class="toast-body">' +
                    message +
                    '</div>' +
                    '</div>';

                // Create a new toast element
                var toastElement = document.createElement('div');
                toastElement.innerHTML = toastHTML;

                // Append the toast element to the container
                toastContainer.appendChild(toastElement);

                // Create a Bootstrap Toast instance and show it
                var toast = new bootstrap.Toast(toastElement.querySelector('.toast'));
                toast.show();

                // Remove the toast element after it is closed
                toastElement.addEventListener('hidden.bs.toast', function () {
                    toastElement.remove();
                });
            }
        });
    </script>
    <div class="container-fluid">
    <div class="row flex-nowrap">

    