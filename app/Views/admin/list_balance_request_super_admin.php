<div class="col-9 col-md-10 col-lg-10">
<div class="container mt-3 frminheightttt">
<div class="frHeadingAndButton">
    <h1>Send Balance Request Super Admin</h1>
    <a href="<?= base_url('admin/send_balance_request_super_admin'); ?>" class="frlinkbuttonn">Send Money Request Superadmin</a>  
</div>

           <table  class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Superadmin Name</th>  
                    <th scope="col">Transaction Date</th>  
                    <th scope="col">Balance Request Amount</th>                  
                    <th scope="col">Superadmin Approve Status</th>
                    <th scope="col">After Approve/Disapprove Amount Given</th>
                    <th scope="col">Wallet Amount Balance</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($list_admin_request_balance as $admin): ?>
        <tr>
            <th scope="row"><?= $sr_no ?></th>
            <td><?= $admin->first_name . " " . $admin->last_name ?></td>
            <td><?= $admin->created_at ?></td>
            <td><?= !empty($admin->balance_request_amt) ? $admin->balance_request_amt : '0' ?></td>
            <td>
                <?php if (empty($admin->superadmin_accept_status)): ?>
                    <label style="color:orange;">Pending</label>
                <?php elseif ($admin->superadmin_accept_status == 1): ?>
                    <label style="color:green;">Approved</label>
                <?php elseif ($admin->superadmin_accept_status == 2): ?>
                    <label style="color:red;">Disapproved</label>
                <?php endif; ?>
            </td>
            <td><?= $admin->current_wallet_amount ?></td>
            <td><?= $admin->wallet_balance_amt ?></td>
            <td>
                <?php if (empty($admin->wallet_balance_amt)): ?>
                <?php elseif ($admin->wallet_balance_amt < $admin->current_wallet_amount): ?>
                    Return
                <?php else: ?>
                    Request
                <?php endif; ?>
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
