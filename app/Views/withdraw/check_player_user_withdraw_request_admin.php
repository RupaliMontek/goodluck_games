<div id="admin_balance_amount_extend_request" class="modal adminbalancePopupForm" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('admin/view_player_withdraw_request_notification_admin'); ?>
      <div class="modal-header">
        <h5 style="display:none;" class="modal-title">Withdraw Amount Request From Admin <?php echo $request_details->first_name." ".$request_details->last_name; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <b class="statuss"><label><?php if($request_details->admin_accept_status==1){ echo "Approved"; } else { echo "Disapproved"; } ?></label></b>
        <p>request of amount <b><span class="forrepiesSign">&#8377;</span><?= $request_details->balance_request_amt; ?></b> sent by you.</p>
        <input class="form-control" type="hidden" name="notification_id" id="notification_id" value="<?= $request_details->notification_id; ?>">
        <input class="form-control" type="hidden" name="request_id" id="request_id" value="<?= $request_details->request_id; ?>">
        <input class="form-control" type="hidden" name="notification_from_id" id="notification_from_id" value="<?= $request_details->notification_from_id; ?>">
      </div>
      <div class="modal-footer">        
        <button class="submitPopup" type="submit">OK</button>
      </div>
    </form>
    </div>
  </div>
</div>