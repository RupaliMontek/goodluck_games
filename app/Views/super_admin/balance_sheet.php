<div class="col-9 col-md-10 col-lg-10">

<div class="container mt-3">
    <div class="row">
      <div class="col frminheightttt frmobpaddingzeroo">

<div class="frbalancesheetHead"> 
    <h1>Transactions</h1>
    <p>Welcome to your transactions</p>
</div> 
<div class="row frBackBtnLeftSide">
<a href="javascript:history.go(-1);" class="frlinkbuttonn">Back</a>
</div>

<div class="row mt-2 pt-2 FrbalancesheetTop"> 
    <div class="col-md-6 FrbalancesheetTopInn" id="income"> 
        
            <i class="fa fa-long-arrow-down"></i> 
            <p class="text mx-3">Loss</p> 

    </div>
<div class="col-md-6 FrbalancesheetTopInn2"> 
    
        <i class="fa fa-long-arrow-up"></i>

        <div class="text mx-3">Win</div> 
    </div> 
    </div> 
<div class="d-flex justify-content-between align-items-center mt-3"> 
</div> 
<div class="table-responsive mt-3"> 
<table class="balancesheetTablee"> 
<thead> 
<tr> 
<th scope="col">Sr.No</th> 
<th scope="col">User Name</th> 
<th scope="col">Date</th> 
<th scope="col" class="text-right">Win Amount</th> 
<th scope="col" class="text-right">Loss Amount</th>
<th scope="col" class="text-right"></th> 
</tr> 
</thead> 
<tbody> 
<?php
if(!empty($players_details))
{ 
$this->ScoreModel = new \App\Models\ScoreModel();
    $sr_no =1;//print_r($players_details);
    foreach($players_details as $row): 
        $players = $this->ScoreModel->get_all_player_game_details_by_player($row['player_id']);
        $player_id=$row['player_id'];
?>
<tr>
     <td><?= $sr_no; ?></td>
     <td><?php echo $row["first_name"]." ".$row["last_name"] ; ?></td>
     <td><?php echo $row["created_at"] ?></td>
     <td><i class="fa fa-long-arrow-up"></i><?php echo $players["total_winner_amount"]; ?></td>
     <td><i class="fa fa-long-arrow-down"></i><?php echo $players["total_loss_amount"] ?></td>
      <td><a href="balance_sheet_details?player_id=<?php echo $player_id;?>" >Balance Sheet</a></td>
</tr>

<?php  $sr_no++;  endforeach; 
} ?> 
</tbody> 
</table> 

</div> 
<div class="d-flex justify-content-between align-items-center results"> 
        <div class="pt-3"> 
            <?php echo $pager; ?>
        </div> 
    </div>
</div>