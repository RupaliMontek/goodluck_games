 <div class="col-9 col-md-10 col-lg-10">
     <section class="frProfilee">
  <div class="container mt-3 frminheightttt">
    <div class="row ">
      <div class="col">
        <!--<nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">-->
        <!--  <ol class="breadcrumb mb-0">-->
        <!--    <li class="breadcrumb-item"><a href="<?= base_url("admin")?>">Home</a></li>-->
            <!--<li class="breadcrumb-item"><a href="#">User</a></li>-->
            <!--<li class="breadcrumb-item active" aria-current="page">User Profile</li>-->
        <!--  </ol>-->
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?= $_SESSION["username"] ?></h5>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $first_name . " " . $last_name; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">User Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $_SESSION["username"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">example@example.com</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $contact; ?></p>
              </div>
            </div>
            <hr>
            <!--<div class="row">-->
            <!--  <div class="col-sm-3">-->
            <!--    <p class="mb-0">Address</p>-->
            <!--  </div>-->
            <!--  <div class="col-sm-9">-->
            <!--    <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>-->
            <!--  </div>-->
            <!--</div>-->
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                    <h6 class="balance-amount">Account Balance</h6>
                    <span>
                         <input id="current_wallet_amount" type="text" class="form-control" readonly value="<?= htmlspecialchars($admin_users_details->current_wallet); ?>">
                    </span>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div></section>
<script>
$(document).ready(function() {
    
    get_superadmin_wallet_balance_amount();
    setInterval(get_superadmin_wallet_balance_amount, 500);
    setInterval(update_score_admin,1000);
    function update_score_admin()
    {
        $.ajax({
            url: base_url + 'admin/update_score_admin',
            type: 'GET',
            data: {},
            success: function(data) {
              $('#current_wallet_amount').html(data);
           }
        });
    }
});
          
function get_superadmin_wallet_balance_amount() 
{
    $.ajax({
        url: base_url + 'get_superadmin_wallet_balance_amount', // Correctly concatenate base URL with endpoint
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            let main_balance;
            if (data.current_wallet === '' || data.current_wallet === null) { // Correct the condition
                main_balance = data.amout_given; // Correct the variable name
            } else {
                main_balance = data.current_wallet; // Use the correct property name from JSON response
            }
            // Log the specific fields
            $("#current_wallet_amount").val(main_balance);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching super admin details:', error);
        }
    });
}
</script>
