<div class="col-12 col-md-12 col-lg-12">
<div class="container-fluid mt-3 frminheightttt">
    
    <h2>Send Withdraw Balance Request Admin</h2>
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
 $(document).ready(function() {
setInterval(update_score_withdraw, 2000);
function update_score_withdraw()
{
    $.ajax({
        url: base_url + 'withdraw/update_score_withdraw',
        type: 'GET',
        data: {},
        success: function(data) {
          //  alert(data);
            $('#wallet_balance').html(data);
           //console.log(data);
        }
    });
}
});
</script>
