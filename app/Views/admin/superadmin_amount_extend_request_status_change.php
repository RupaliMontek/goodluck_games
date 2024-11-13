<div id="admin_balance_amount_extend_request" class="modal adminbalancePopupForm" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('admin/view_notification_admin'); ?>
      <div class="modal-header">
        <h5 style="display:none;" class="modal-title">Request Balance Status From Superadmin-  <?php echo $request_details->first_name." ".$request_details->last_name; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><b class="statuss"><?  
        if($request_details->superadmin_accept_status==1)
            {
                echo " Approved"; 
            }
        else
            { echo " Disapproved"; 
            }?>  
            </b>Your return request for balanced <span class="forrepiesSign">&#8377;</span> <b><?= $request_details->balance_request_amt; ?> </b>By Superadmin</p>        
        <input class="form-control" type="hidden" name="notification_id" id="notification_id" value="<?= $request_details->notification_id; ?>">
        <input class="form-control" type="hidden" name="request_id" id="request_id" value="<?= $request_details->request_id; ?>">
        <input class="form-control" type="hidden" name="notification_from_id" id="notification_from_id" value="<?= $request_details->notification_from_id; ?>">
        
      </div>
      <div class="modal-footer">        
        <button type="submit" class="">Ok</button>
      </div>
    </form>
    </div>
  </div>
</div>