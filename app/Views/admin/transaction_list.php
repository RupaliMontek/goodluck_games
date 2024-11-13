<div class="col-9 col-md-10 col-lg-10">

<div class="container mt-3">
    <div class="row">
      <div class="col frminheightttt">

<div class="row frBackBtnLeftSide">
<a href="javascript:history.go(-1);" class="frlinkbuttonn">Back</a>
</div>
<form action="<?= base_url('admin/delete_records') ?>" method="post" onsubmit="return confirmDelete()">
    <div class="form-group">
        <label for="from_date">From Date:</label>
        <input type="date" class="form-control" id="from_date" name="from_date">
    </div>
    <div class="form-group">
        <label for="to_date">To Date:</label>
        <input type="date" class="form-control" id="to_date" name="to_date">
    </div>
    <button type="submit" class="btn btn-danger">Delete Records</button>
</form>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete records for the selected date range?");
    }
</script>
<div class="table-responsive mt-3"> 
<div class="col-12 col-md-12 col-lg-12">
    <div class="container mt-3">
        <div class="row">
            <div class="col frminheightttt">
                <div class="table-responsive mt-3"> 
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Sr No</th>
            <!--<th scope="col">Admin Name</th>-->
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
                <!--<td><?= $admin->first_name . " " . $admin->last_name ?></td>-->
                <td><?= $admin->created_at ?></td>
                <td><?= !empty($admin->balance_request_amt) ? $admin->balance_request_amt : '0' ?></td>
                <td>
                    <?php if (empty($admin->admin_accept_status)): ?>
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
</div> 
            </div>
        </div>
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

 

</div> 

</div>