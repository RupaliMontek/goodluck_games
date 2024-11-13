<head>
<link href="<?php echo base_url("frontend/admin_backend.css");?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8i7uF1E1lXN7Ix/CpXFAAUGLC7geF6GgkAYdLlA+q8R9c5uE73RXPmY+r" crossorigin="anonymous">
 <style>
        .whatsapp-button {
    display: inline-block;
    padding: 10px 15px;
    background-color: #25D366; /* WhatsApp green color */
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.whatsapp-button:hover {
    background-color: ##45a569; /* Change color on hover if desired */
}
        .whatsapp-icon {
            margin-left: 10px; /* Adjust margin as needed */
            display: inline-block;
            font-size: 24px; /* Adjust font size as needed */
            color: #25D366; /* WhatsApp green color */
        }

        .whatsapp-icon:hover {
            color: #128C7E; /* Change color on hover if desired */
        }
    </style>
</head>
<div class="col-auto col-md-9">
        <div class="container mt-5">
        <a href="<?= base_url('admin/add_admin_user'); ?>" class="btn btn-primary">Add Admin</a>   
        <h2>Manage Admin</h2>
        <table  class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Contact</th>
                    <th scope="col">No Of Accounts</th>
                    <th scope="col">Amount Given</th>
                    <th scope="col">Current Wallet</th>
                    <th scope="col">User Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  $sr_no= 1; foreach ($admins as $admin): ?>
                <tr>
                    <th scope="row"><?= $sr_no ?></th>
                    <td><?php echo $admin->first_name." ".$admin->last_name ; ?></td>
                    <td><?php echo $admin->contact ; ?></td>
                    <td><?php if(!empty($admin->limit_user)){ echo $admin->limit_user."/"."10";  } else{ echo "0"; } ?></td>
                    <td><?php if(!empty($admin->amout_given)){echo $admin->amout_given;} else{ echo "0"; } ?></td>
                    <td><?php if(!empty($admin->current_wallet)){echo $admin->current_wallet;} else{ echo $admin->amout_given; } ?></td>
                    <td>
                        <?php 

                        if($admin->status==1)
                            {?>
                             <button type="button" onclick="users_status_change('0','<?php echo $admin->id; ?>')" class="btn btn-danger">In-Active</button>

                            <?php }

                            elseif ($admin->status==0 || empty($admin->status)) 
                            { ?>
                                <button type="button" onclick="users_status_change('1','<?php echo $admin->id; ?>')" class="btn btn-success">Active</button>
                            <?php } ?></td>
                            <td>
                       <li class="list-inline-item">
                    
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                             <span class="d-none d-sm-inline mx-1"></span>
                            </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="<?= base_url('superadmin/edit_admin_user/'.$admin->id); ?>">Edit</a>
                             </li>
                        </ul>
                        <td>
                                <a href="https://api.whatsapp.com/send/?phone=919975048884&text&type=phone_number&app_absent=0" class="whatsapp-button">
                                    <i class="fab fa-whatsapp" aria-hidden="true"></i> Share Details via WhatsApp
                                </a>
                            </td>
                       </li>
                    </td>
                </tr>    
                 <?php $sr_no++; endforeach; ?>            
            </tbody>
        </table>
    </div>
    </div>