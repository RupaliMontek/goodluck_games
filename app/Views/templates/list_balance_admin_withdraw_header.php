<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spinner Game Project</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link href="<?php echo base_url('frontend/styleFrAdminBckend.css'); ?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- jQuery Validation Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- Custom JS for Toast Notifications -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Function to show toast
            function showToast(type, message) {
                var toastContainer = document.getElementById('toast-container');

                if (!toastContainer) {
                    // Create toast container if it doesn't exist
                    toastContainer = document.createElement('div');
                    toastContainer.id = 'toast-container';
                    toastContainer.className = 'position-fixed top-0 end-0 p-3';
                    toastContainer.style.zIndex = '1100';
                    document.body.appendChild(toastContainer);
                }

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

            <?php
            $successMessage = session()->getFlashdata('success_message');
            $errorMessage = session()->getFlashdata('error_message');

            if ($successMessage) {
                echo 'showToast("success", "' . $successMessage . '");';
            } elseif ($errorMessage) {
                echo 'showToast("error", "' . $errorMessage . '");';
            }
            ?>
        });
    </script>
</head>

<body class="backendFont">
    <header class="superadminHeader bg-darkAdminwithdrawl text-white py-3">
        <div class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="col-lg-12 col-sm-12 col-md-12 forSuperAdminHeadInn">
                            <a class="navbar-brand" href="#">
                                <img width="200px" height="auto" class="logo" src="<?= base_url('frontend/images/logo.png'); ?>" alt="Company Logo">
                            </a>
                            <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>-->
                            <div class="" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser100000" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                            <span class="d-sm-inline mx-1"><?= $_SESSION["username"] ?></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="<?= base_url('admin/profile'); ?>">Profile</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="<?= base_url('logout'); ?>">Sign out</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="container-fluid frlistBalAdminwithdrawl">
        <div class="row flex-nowrap">

