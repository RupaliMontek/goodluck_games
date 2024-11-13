<div class="col-9 col-md-10 col-lg-10">
        <div class="container mt-3 frminheightttt">
            <div class="row">
        <div class="frHeadingAndButton">
        <h2>Admin Under Player List</h2>
        </div>
        <table  class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Contact No.</th>
                    <th scope="col">Amount Given</th>
                    <th scope="col">Current Wallet</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php  $sr_no = ($page - 1) * $perPage + 1; foreach ($admins as $admin): ?>
                <tr>
                    <th scope="row"><?= $sr_no ?></th>
                    <td><?php echo $admin->first_name." ".$admin->last_name ; ?></td>
                    <td><?php echo $admin->contact ; ?></td>
                    <td><?php if(!empty($admin->amout_given)){echo $admin->amout_given;} else{ echo "0"; } ?></td>
                    <td><?php if(!empty($admin->current_wallet)){echo $admin->current_wallet;} else{ echo $admin->amout_given; } ?></td>
                    <td>
                    <?php 
                    if($admin->status==1)
                    {?>
                        <label class="btn btn-danger">In-Active</label>
                    <?php 
                    }

                    elseif ($admin->status==0 || empty($admin->status)) 
                    { ?>
                        <label class="btn btn-danger">Active</label>
                                
                    <?php } ?>
                    </td>
                </tr>    
                 <?php $sr_no++; endforeach; ?>            
            </tbody>
        </table>
         <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            <?= $pager->makeLinks($page, $perPage, $total); ?>
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