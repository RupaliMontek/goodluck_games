 <div class="col-9 col-md-10 col-lg-10">
    <div class="container mt-3 frminheightttt">
        <h2>Create a New Admin Account</h2>

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

        <?php echo form_open('superadmin/create_account_from_dashboard'); ?>
        <div class="row formtopmargin">
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="first_name">First Name:</label>
            <input autocomplete="off" class="form-control" type="text" name="first_name" id="first_name" required>
        </div>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="contact">Contact No:</label>
            <input autocomplete="off" class="form-control" type="number" name="contact" id="contact" required>
        </div>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="last_name">Last Name:</label>
            <input autocomplete="off" class="form-control" type="text" name="last_name" id="last_name" required>
        </div> 
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="amout_given">Amount Given:</label>
            <input autocomplete="off" class="form-control" type="number" name="amout_given" id="amout_given" required>
        </div> 
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="limit_user_create">User Account Create Limit:</label>
            <input autocomplete="off" class="form-control" type="number" name="limit_user_create" id="limit_user_create" required>
        </div>  
<div class="mb-3 col-lg-6">
            <label class="form-label" for="new_username">Username:</label>
            <input autocomplete="off" class="form-control" type="text" name="new_username" id="new_username" required>
        </div> 
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="new_password">Password:</label>
            <input autocomplete="off" class="form-control" type="text" name="new_password" id="new_password" required>
        </div> 
        </div>
        <button type="submit">Create Account</button>
    
        </form>
    </div>
