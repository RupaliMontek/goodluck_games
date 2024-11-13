<?php  $role = isset($_SESSION["role"]) ? $_SESSION["role"] : null; ?>
        <div class="col-3 col-md-2 col-lg-2 bg-darkBlueSidebarr">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 frmobilepadding">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <!--<span class="fs-5 d-none d-sm-inline">Menu</span>-->
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                   <?php   if($role=="super-admin"){ ?>     
                        <a href="<?= base_url("superadmin")?>" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-sm-inline">Home</span>
                        </a>
                        <?php } elseif($role=="admin"){ ?>
                          <a href="<?= base_url("admin")?>" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-sm-inline">Home</span>
                        </a>
                        <?php } ?>
                    </li>
        <?php   if($role=="super-admin"){ ?>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-sm-inline">Manage Admin</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">      
                                <a href="<?= base_url("superadmin/admin_user_list")?>" class="nav-link px-0"> <span class="d-sm-inline">Admin List</span></a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-sm-inline">Item</span> 2 </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                             <span class="ms-1 d-sm-inline">Setting</span> <i class="fa fa-angle-down"></i></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="<?php echo base_url("superadmin/change_theme")?>" class="nav-link px-0"> <span class="d-sm-inline">Change Background Theme</span></a>
                            </li>
                            <!--<li>-->
                            <!--    <a href="<?php echo base_url("superadmin/change_password")?>" class="nav-link px-0"> <span class="d-none d-sm-inline">Change Password</span></a>-->
                            <!--</li>-->
                            <li>
                                <a href="<?php echo base_url("superadmin/set_time")?>" class="nav-link px-0"> <span class="d-sm-inline">Set Time</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu5" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                             <span class="ms-1 d-sm-inline">History</span> <i class="fa fa-angle-down"></i></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu5" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="<?php echo base_url("superadmin/admin_history")?>" class="nav-link px-0"> <span class="d-sm-inline">Admin History</span></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("superadmin/user_history")?>" class="nav-link px-0"> <span class="d-sm-inline">User History</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <a href="<?php echo base_url("superadmin/balance_sheet")?>" class="nav-link px-0"> <span class="d-sm-inline">Balance Sheet</span></a>
                    </li>
                    <!--  <li>-->
                    <!--    <a data-bs-toggle="collapse" class="nav-link px-0 align-middle">-->
                    <!--            <a href="<?php echo base_url("superadmin/change_theme")?>" class="nav-link px-0"> <span class="d-none d-sm-inline">Change Theme</span></a>-->
                    <!--</li>-->
                    <?php } 
                if($role=="admin"){
                    ?>                  
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                             <span class="ms-1 d-sm-inline">Manage Players</span> <i class="fa fa-angle-down"></i></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="<?= base_url("admin/players_list"); ?>" class="nav-link px-0"> <span class="d-sm-inline">Players List</span></a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?= base_url("admin/list_balance_request_list_super_admin"); ?>" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-sm-inline">Send Balance Request to Super-Admin
                        </span> </a>
                    </li>
                    <li>
                        <a href="<?= base_url("admin/list_balance_return_list_super_admin"); ?>" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-sm-inline">Send Withdraw Request To Super-Admin
                        </span> </a>
                    </li>

                <?php } ?>    
                    <li>
                        <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                             <span class="ms-1 d-sm-inline">Products</span> <i class="fa fa-angle-down"></i></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-sm-inline">Product</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-sm-inline">Product</span> 2</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-sm-inline">Product</span> 3</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-sm-inline">Product</span> 4</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu6" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                             <span class="ms-1 d-sm-inline">Customer</span> <i class="fa fa-angle-down"></i></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu6" data-bs-parent="#menu">
                            
                        </ul>
                    </li>
                    </li>
                    
                </ul>
                <hr>                
            </div>
        </div>

       