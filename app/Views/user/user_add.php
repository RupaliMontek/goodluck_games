 <div class="col-9 col-md-10 col-lg-10">
<div class="container mt-3 frminheightttt">

          <h2>Create a New Player Account</h2>
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
    <?php  echo form_open('admin/create_players_account', array('id' => 'player_account_add_form')); ?>
    <div class="row">
        <div class="mb-3 col-lg-6">
        <label  class="form-label" for="first_name">First Name:</label>
        <input autocomplete="off" class="form-control" type="text" name="first_name"id="first_name" required >
        <input autocomplete="off" class="form-control" type="hidden" value="<?= $limit_user_add?>" name="limit_user_add"id="limit_user_add" required >
        </div>
        <div class="mb-3 col-lg-6">
        <label  class="form-label" for="contact">Contact No:</label>
        <input autocomplete="off" class="form-control" type="number" name="contact"id="contact" required >
        </div>
        <div class="mb-3 col-lg-6">
        <label class="form-label"  for="last_name">Last Name:</label>
        <input autocomplete="off" class="form-control" type="text" name="last_name" id="last_name" required >
        </div> 
        <div class="mb-3 col-lg-6">
         <label class="form-label"  for="amout_given">Amout Given:</label>
        <input autocomplete="off" class="form-control" type="number" name="amout_given" id="amout_given" required >
        </div>         
  <div class="mb-3 col-lg-6">
            <label class="form-label" for="new_username">Username:</label>
            <input autocomplete="off" class="form-control" type="text" name="new_username" id="new_username" required>
        </div> 
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="new_password">Password:</label>
            <input autocomplete="off" class="form-control" type="text" name="new_password" id="new_password" required>
        </div> </div>
        <button class="" type="submit">Create Account</button>
        
    </form>       
 </div>