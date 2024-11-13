<div class="col-9 col-md-10 col-lg-10">
        <div class="container mt-3 frminheightttt">
                <h1>Welcome To Admin Dashboard</h1>
<div class="col-auto col-lg-12">
        <div class="container mt-2 frmobpaddingzeroo">
            <div id="counter"></div>
            <div id="verifiBtn"></div>
        <table  class="table table-striped">
                 <h2>Player List</h2>

           <table  class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Amount Given</th>
                    <th scope="col">Current Wallet</th>
                    <!--<th scope="col">Change Status</th>-->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($players_list as $admin): ?>
                <tr>
                    <th scope="row"><?= $sr_no ?></th>
                    <td><?php echo $admin->first_name." ".$admin->last_name ; ?></td> 
                    <td><?php echo $admin->username ; ?></td>
                    <td><?php echo $admin->contact ; ?></td>
                    <td><?php if(!empty($admin->amout_given)){echo $admin->amout_given;} else{ echo "0"; } ?></td>
                    <td><?php if(!empty($admin->current_wallet)){echo $admin->current_wallet;} else{ echo $admin->amout_given; } ?></td>
                    
                </tr> 
                <?php $sr_no++; ?>
                 <?php endforeach; ?>           
            </tbody>
        </table>
        </table>
    </div>
    <?= $pager->links() ?>

    </div>
        </div>

<script>
        // Function to get counter timerch
    function getCounterTimerUniversal() {
        $.ajax({
            url: '<?php echo base_url("user/get_universal_counter_timer_all"); ?>',
            type: "GET",
            data: {},
            success: function (data) {
                var data = JSON.parse(data);
                //console.log(data.display_time);
                $("#counter").html(data.display_time);
               
            }
        });
    }

    // Call getCounterTimerUniversal every 500 milliseconds
    getCounterTimerUniversal();
    setInterval(getCounterTimerUniversal, 500);
</script>