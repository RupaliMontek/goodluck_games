<div class="col-9 col-md-10 col-lg-10">
<div class="container mt-3 frminheightttt">
<h2>Update Player Details</h2>
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
    <?php echo form_open('admin/update_players_account_details/'.$player_details->id); ?>
    <div class="row formtopmargin">
        <div class="mb-3 col-lg-6">
        <label  class="form-label" for="new_username">First Name:</label>
        <input autocomplete="off" class="form-control" type="text" name="first_name"id="first_name" value="<?= $player_details->first_name; ?>" required>
        </div>
        <div class="mb-3 col-lg-6">
        <label  class="form-label" for="new_username">Contact No:</label>
        <input autocomplete="off" class="form-control" type="text" name="contact"id="contact" value="<?= $player_details->contact; ?>" required>
        </div>
        <div class="mb-3 col-lg-6">
        <label class="form-label"  for="new_username">Last Name:</label>
        <input autocomplete="off" class="form-control" type="text" name="last_name" id="last_name" value="<?= $player_details->last_name; ?>" required >
        </div> 
        <div class="mb-3 col-lg-6">
         <label class="form-label"  for="new_username">Amout Given:</label>
        <input autocomplete="off" class="form-control" type="number" name="amout_given" id="amout_given" value="<?= $player_details->amout_given; ?>" readonly>
        </div>        
       <div class="mb-3 col-lg-6">
        <label class="form-label"  for="new_username">Username:</label>
        <input autocomplete="off" class="form-control" type="text" name="new_username" id="new_username" required  value="<?= $player_details->username; ?>">
      </div> 
      <div class="mb-3 col-lg-6">
        <label class="form-label"  for="new_password">Password:</label>

        <input  class="form-control" type="hidden" name="password" id="password" required value="<?= $player_details->password; ?>" >

         <input autocomplete="off" class="form-control" type="password" name="new_password" id="new_password"  >


        </div> 
        </div>
        <button class="" type="submit">Update</button>
        <a href="https://api.whatsapp.com/send/?phone=919975048884&text&type=phone_number&app_absent=0" class="whatsapp-button frMobWhatsuppp">
    <i class="fab fa-whatsapp" aria-hidden="true"></i> Share Details via WhatsApp</a>
        
    </form>       


 </div>
             