<div class="col-9 col-md-10 col-lg-10">
<div class="container mt-3">
<div class="row">
<div class="frHeadingAndButton">
<h2>Send Withdrawal Request To Super Admin</h2>
<a href="<?= base_url('admin/send_balance_return_super_admin'); ?>" class="frlinkbuttonn">Send Withdraw Request to Superadmin</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Sr</th>
            <th scope="col">Superadmin Name</th>
            <th scope="col">Transaction Date</th>
            <th scope="col">Balance Return Amount</th>
            <th scope="col">Superadmin Approve Status</th>
            <th scope="col">After Approve/Disapprove Amount Given</th>
            <th scope="col">Wallet Amount Balance</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
<?php 
$items_per_page = isset($items_per_page) ? $items_per_page : 10; // Default items per page
$sr_no = ($current_page - 1) * $items_per_page + 1; 
?>
        <?php foreach ($list_admin_request_balance as $admin): ?>
            <tr>
                <th scope="row"><?= $sr_no ?></th>
                <td><?= $admin->first_name . " " . $admin->last_name ?></td>
                <td><?= $admin->created_at ?></td>
                <td><?= !empty($admin->balance_request_amt) ? $admin->balance_request_amt : '0' ?></td>
                <td>
                    <?php if (empty($admin->admin_accept_status)):  ?>
                        <label style="color:orange;">Pending</label>
                    <?php elseif ($admin->admin_accept_status == 1): ?>
                        <label style="color:green;">Approved</label>
                    <?php elseif ($admin->admin_accept_status == 2): ?>
                        <label style="color:red;">Disapproved</label>
                    <?php endif; ?>
                </td>
                <td><?= $admin->current_wallet_amount ?></td>
                <td><?= $admin->wallet_balance_amt ?></td>
                <td>
              <?php echo $admin->status_user; ?>
            
        </td>
            </tr>
            <?php $sr_no++; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="pagination">
    <?php if ($current_page > 1): ?>
        <a href="?page=<?= $current_page - 1 ?>">&laquo; Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?= $i ?>" <?= $i == $current_page ? 'class="active"' : '' ?>><?= $i ?></a>
    <?php endfor; ?>

    <?php if ($current_page < $total_pages): ?>
        <a href="?page=<?= $current_page + 1 ?>">Next &raquo;</a>
    <?php endif; ?>
</div>
 </div>
 </div>