<div class="col-auto col-md-12 col-lg-12">
<div class="container-fluid mt-3 frminheightttt">
<div class="frHeadingAndButton">
<h1>Send Money Request to Admin</h1>
<a href="<?= base_url('request/send_balance_request_admin_request'); ?>" class="frlinkbuttonn">Send Money Request Admin</a>
<a href="<?= base_url('user/logohome'); ?>" class="frlinkbuttonn">Back</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Sr No</th>
            <th scope="col">Admin Name</th>
            <th scope="col">Withdraw Req Date</th>
            <th scope="col">Withdraw Balance Request Amount</th>
            <th scope="col">Admin Approve Status</th>
            <th scope="col">Before Withdraw Request Amount</th>
            <th scope="col">Wallet Amount Balance</th>
            <th>Status</th>
            
            
        </tr>
    </thead>
    <tbody>
        <?php $sr_no = 1; ?>
        <?php foreach ($list_admin_request_balance as $admin): ?>
            <tr>
                <th scope="row"><?= $sr_no ?></th>
                <td><?= $admin->first_name . " " . $admin->last_name ?></td>
                <td><?= $admin->created_at ?></td>
                <td><?= !empty($admin->balance_request_amt) ? $admin->balance_request_amt : '0' ?></td>
                <td>
                    <?php if (empty($admin->admin_accept_status)): ?>
                        <label style="color:orange;">Pending</label>
                    <?php elseif ($admin->admin_accept_status == 1): ?>
                        <label style="color:green;">Approved</label>
                    <?php elseif ($admin->admin_accept_status == 2): ?>
                        <label style="color:red;">Disapproved</label>
                    <?php  elseif ($admin->admin_accept_status == 3):  ?>
                        <label style="color:red;">Not Accepted</label>
                    <?php endif; ?>
                </td>
                <td><?= $admin->current_wallet_amount ?></td>
                <td><?= $admin->wallet_balance_amt ?></td>
                 <td>
               <?= $admin->status_user; ?>
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