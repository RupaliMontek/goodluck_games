<div class="col-9 col-md-10 col-lg-10">
    <div class="container mt-3 frupdateAdminAccDetailss frminheightttt frmobpaddingzeroo">
        <h2>Update Admin Account Details</h2>

        <?php if (session()->getFlashdata('error_message')): ?>
            <div class="alert alert-danger">
                <?php echo session()->getFlashdata('error_message'); ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('success_message')): ?>
            <div class="alert alert-success">
                <?php echo session()->getFlashdata('success_message'); ?>
            </div>
        <?php endif; ?>
          
    <?php if(isset($errors)) echo implode('<br>', $errors); ?>
    <?php echo form_open('superadmin/update_account_details_admin/'.$admins_details->id); ?>
    <div class="row">
        <div class="mb-3 col-lg-6">
        <label  class="form-label" for="new_username">First Name:</label>
        <input autocomplete="off" class="form-control" type="text" name="first_name"id="first_name" value="<?= $admins_details->first_name; ?>" required>
        </div> 
        <div class="mb-3 col-lg-6">
        <label class="form-label"  for="new_username">Last Name:</label>
        <input autocomplete="off" class="form-control" type="text" name="last_name" id="last_name" value="<?= $admins_details->last_name; ?>" required >
        </div> 
        
        </div>
        
        <div class="row">
        <div class="mb-3 col-lg-6">
        <label class="form-label"  for="new_username">Contact:</label>
        <input autocomplete="off" class="form-control" type="number" name="contact" id="contact" value="<?= $admins_details->contact; ?>" required >
        </div>
        <div class="mb-3 col-lg-6">
         <label class="form-label"  for="new_username">Amout Given:</label>
        <input autocomplete="off" class="form-control" type="number" name="amout_given" id="amout_given" value="<?= $admins_details->amout_given; ?>" readonly>
        </div> 
        </div>
        
         <div class="row">
      <div class="mb-3 col-lg-6">
        <label class="form-label"  for="new_username">User Account Create Limit:</label>
        <input autocomplete="off" class="form-control" type="number" name="limit_user_create" id="limit_user_create"  value="<?= $admins_details->limit_user; ?>" required>
       </div>  
       <div class="mb-3 col-lg-6">
        <label class="form-label"  for="new_username">Username:</label>
        <input autocomplete="off" class="form-control" type="text" name="new_username" id="new_username" required  value="<?= $admins_details->username; ?>">
      </div> 
      </div>
      <div class="row">
      <div class="mb-3 col-lg-6">
        <label class="form-label"  for="new_password">Password:</label>

        <input  class="form-control" type="hidden" name="password" id="password" required value="<?= $admins_details->password; ?>" >
         <input autocomplete="off" class="form-control" type="password" name="new_password" id="new_password"  >

</div>
        </div>
         <div class="row">
      <div class="mb-3 col-lg-12">
        <button type="submit">Update</button>
        </div></div>
    </form>       


 </div>
               