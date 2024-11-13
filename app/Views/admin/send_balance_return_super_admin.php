<div class="col-9 col-md-10 col-lg-10">
<div class="container-fluid mt-3 frminheightttt">
    <div class="frHeadingAndButton">
    <h2>Send Withdrawal Request To Super Admin</h2>
    <a class="frlinkbuttonn" href="<?php echo base_url("admin/list_balance_return_list_super_admin"); ?>">Back</a>
    </div>
    <?php if(isset($errors)) echo implode('<br>', $errors); ?>
    <?php echo form_open('request_admin_balance_withdraw'); ?>
    <div class="row formtopmargin">
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="new_username">Current Wallet Balance</label>
            <input autocomplete="off" class="form-control" type="text" name="wallet_balance" id="wallet_balance" value="<?= $admin_users_details->current_wallet; ?>" readonly>
        </div>  
        <?php if($admin_users_details->current_wallet != 0): ?>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="new_username">Return Amount</label>
            <input autocomplete="off" class="form-control" type="text" name="balance_request_amt" id="balance_request_amt" placeholder="Enter Balance Withdraw Request Amount" oninput="checkBalance()">
        </div> 
    </div>
        <button class="" type="submit">Submit</button>
    <?php endif; ?>
    </form>       
</div>

<script>
function checkBalance() {
    var walletBalance = parseFloat(document.getElementById('wallet_balance').value);
    var balanceRequestAmt = parseFloat(document.getElementById('balance_request_amt').value);

    if (balanceRequestAmt > walletBalance) {
        alert('Return Amount cannot be more than Current Wallet Balance');
        document.getElementById('balance_request_amt').value = '';
    }
}
</script>
