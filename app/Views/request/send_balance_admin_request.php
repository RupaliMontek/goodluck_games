<div class="col-12 col-md-12 col-lg-12">
<div class="container-fluid mt-3 frminheightttt">
    
        <h2>Send Balance Request to Admin</h2>
        <?php if(isset($errors)) echo implode('<br>', $errors); ?>
        <?php echo form_open('request/request_admin_balance_request'); ?>
        <div class="row formtopmargin">
            <div class="mb-3 col-lg-6">
                <label class="form-label" for="new_username">Current Wallet Balance</label>
                <input autocomplete="off" class="form-control" type="text" name="wallet_balance" id="wallet_balance" value="<?= $admin_users_details->current_wallet; ?>" readonly>
            </div>  
            <?php if($admin_users_details->current_wallet != 0): ?>
            <div class="mb-3 col-lg-6">
                <label class="form-label" for="new_username">Request Amount</label>
                <input autocomplete="off" class="form-control" type="text" name="balance_request_amt" id="balance_request_amt" placeholder="Enter Balance Request Amount" value="">
            </div> 
        </div>
                <button class="" type="submit">Submit</button>
            <?php endif; ?>
        </form>       
    </div>
    <script>
$(document).ready(function() {
setInterval(update_score_request, 2000);
function update_score_request()
{
    $.ajax({
        url: base_url + 'request/update_score_request',
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