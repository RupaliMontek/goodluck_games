
 <div class="col-9 col-md-10 col-lg-10">
<div class="container mt-3 frminheightttt">
<div class="">
    <div class="frHeadingAndButton"> 
    <h1>Player List</h1>
    <?php if($player_count < $admin_users_details->limit_user ){ ?>    
<a href="<?= base_url('admin/add_player'); ?>" class="frlinkbuttonn">Add Players</a>  
<?php } ?>
    </div>

           <table  class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Amount Given</th>
                    <th scope="col">Current Wallet</th>
                    <th scope="col">Change Status</th>
                    <th scope="col">Transaction</th>
                    <th scope="col">Share</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sr_no = ($pager->getCurrentPage() - 1) * $pager->getPerPage() + 1; 
                foreach ($players_list as $admin): ?>
                <tr>
                   <!-- <th scope="row"><?php echo $sr_no ; ?></th>-->
                   <th scope="row"><?php echo $sr_no ?></th>
                    <td><?php echo $admin->first_name." ".$admin->last_name ; ?></td> 
                    <td><?php echo $admin->username ; ?></td>
                    <td><?php echo $admin->contact ; ?></td>
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
                            <td><a type="button" href="<?= base_url('admin/list_balance/'.$admin->id); ?>">Transaction</a></td>
                            <td>
                                <a href="https://api.whatsapp.com/send/?phone=919975048884&text&type=phone_number&app_absent=0" class="whatsapp-button">
                                    <i class="fab fa-whatsapp" aria-hidden="true"></i> Share Details via WhatsApp
                                    </a>
                            </td>
                    <!--<td>-->
                    <td>
                        
                        <div class="dropdown">
    <button class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i></button>
    <div class="dropdown-content">
        <a class="dropdown-item" href="<?= base_url('admin/edit_player_details/'.$admin->id); ?>">Edit</a>
        <a class="dropdown-item" id="remove" href="<?= base_url('admin/remove_player/'.$admin->id); ?>">Remove</a>
    </div>
</div>

                   <!-- <li class="list-inline-item">
                    
                    <a class="frdropdownuserrr" href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser<?php echo $sr_no; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-angle-down"></i>
                        
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser<?php echo $sr_no; ?>">
                        <li><a class="dropdown-item" href="<?= base_url('admin/edit_player_details/'.$admin->id); ?>">Edit</a></li>
                        <li><a class="dropdown-item" id="remove" href="<?= base_url('admin/remove_player/'.$admin->id); ?>">Remove</a></li>
                        
                       
                        
                    </ul>
                
                </li>-->
                    </td>
                </tr>    
                 <?php $sr_no++; endforeach; ?>            
            </tbody>
        </table>
<div class="d-flex justify-content-center">
    <?= $pager->links() ?>
    </div>
</div>
 </div>
<script>
        // Get all 'Remove' links
document.querySelectorAll('#remove').forEach(item => {
    item.addEventListener('click', function(event) {
        // Get the row of the admin to be removed
        const row = event.target.closest('tr');
        
        // Retrieve the 'current_wallet' value from the row
        const currentWalletCell = row.querySelector('td:nth-child(6)'); // Adjust index as needed
        const currentWalletValue = parseFloat(currentWalletCell.innerText);

        if (currentWalletValue !== 0) {
            // If the wallet is not zero, show an alert and prevent deletion
            alert("Cannot remove this admin. The current wallet amount is not zero.");
            event.preventDefault(); // Prevent the default action of the link
        } else {
            // If the wallet is zero, proceed with a confirmation dialog
            const confirmed = confirm("Are you sure you want to remove this admin? This action cannot be undone.");

            if (!confirmed) {
                // If the user clicks 'Cancel', prevent the default behavior
                event.preventDefault();
            }
        }
    });
});

    </script>