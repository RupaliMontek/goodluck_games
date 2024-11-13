<div id="admin_balance_amount_extend_request" class="modal adminbalancePopupForm" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('request/change_status_player_request_amount'); ?>
      <div class="modal-header">
        <h5 style="display:none;" class="modal-title">Extend Balance Request From Admin <?php echo $request_details->first_name." ".$request_details->last_name; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><?php echo $request_details->first_name." ".$request_details->last_name; ?> Send Money Request. Amount is <b class="statuss"><span class="forrepiesSign">&#8377;</span><?= $request_details->balance_request_amt; ?></b></p>
        <!--<label><b>Select Status</b></label>-->
        <input class="form-control" type="hidden" name="notification_id" id="notification_id" value="<?= $request_details->notification_id; ?>">
        <input class="form-control" type="hidden" name="request_id" id="request_id" value="<?= $request_details->request_id; ?>">
        <input class="form-control" type="hidden" name="notification_from_id" id="notification_from_id" value="<?= $request_details->notification_from_id; ?>">
        <select class="form-control form-select" name="superadmin_status" id="superadmin_status">
            <!--<option value="" selected>Select Status</option>-->
            <option value="1">Approve</option>
            <option value="2">Disapprove</option>
        </select>
      </div>
      <div class="modal-footer">        
        <button type="submit">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>