<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="col-12 col-md-12 col-lg-12">
<div class="container-fluid mt-3">
<div class="adminWrapper">
    <nav style="padding:0; margin:0;" class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-lg-start">
        <a href="<?= base_url('user/logohome'); ?>" class="frlinkbuttonn">Back</a>
        <!-- Add navbar content here -->
    </nav>

    <div class="d-flex justify-content-between align-items-center">
        <!-- Add any additional header content here -->
    </div>
    
    <div class="table-responsive">
        <table class="mydesignUsertable">
            <thead>
                <tr>
                    <th scope="col">Sr.No</th>
                    <th scope="col">User Name</th>
                    <th scope="col" class="text-right">Loss Amount</th>
                    <th scope="col" class="text-right">Win Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($players_details)) {
                    $this->ScoreModel = new \App\Models\ScoreModel();
                    $sr_no = 1; //print_r($players_details);exit;
                    foreach ($players_details as $row) : 
                        // $players = $this->ScoreModel->get_all_player_game_details_by_player($row['player_id']);
                        //print_r($row);exit;
                        ?>
                        <tr>
                            <td><?= $sr_no; ?></td>
                            <td><?php echo $row["first_name"] . " " . $row["last_name"]; ?></td>
                            <td class="text-right"><i class="fa fa-long-arrow-down"></i><?php echo $row["total_loss_amount"]; ?></td>
                            <td class="text-right"><i class="fa fa-long-arrow-up"></i><?php echo $row["total_winner_amount"]; ?></td>
                            
                        </tr>
                        <?php $sr_no++; endforeach;
                } ?>
            </tbody>
        </table>
    </div>
 </div>   
 </div>
<div class="pagination">
        <?= $pager_links ?>
    </div>

