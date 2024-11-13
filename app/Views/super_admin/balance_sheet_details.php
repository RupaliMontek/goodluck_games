<?php
// Initialize total variables
$total_win = 0;
$total_loss = 0;

// Calculate totals from $players_details array
if (!empty($players_details)) {
    foreach ($players_details as $row) {
        $total_win += $row["total_winner_amount"];
        $total_loss += $row["total_loss_amount"];
    }
}
?>

<!-- HTML structure with PHP echoing calculated totals -->
<div class="col-9 col-md-10 col-lg-10">
    <div class="container mt-3 frminheightttt frmobpaddingzeroo">
        <div class="row">
            <div class="col">
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
                        <!--<p><b>$<?= number_format($total_loss, 2); ?></b></p>-->
                    </div>
                    <div class="col-md-6 FrbalancesheetTopInn2" id="loss">
                        <i class="fa fa-long-arrow-up"></i>
                        <p class="text mx-3">Win</p>
                        <!--<p><b>$<?= number_format($total_win, 2); ?></b></p>-->
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3"></div>

                <div class="table-responsive mt-3">
                    <table class="balancesheetTablee">
    <thead>
        <tr>
            <th scope="col">Sr.No</th>
            <th scope="col">User Name</th>
            <th scope="col">Date</th>
            <th scope="col" class="text-right">Win Amount</th>
            <th scope="col" class="text-right">Loss Amount</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($players_details)) {
            $sr_no = ($currentPage - 1) * $limit + 1;
            foreach ($players_details as $row) :
                ?>
                <tr>
                    <td><?= $sr_no; ?></td>
                    <td><?= $row["first_name"] . " " . $row["last_name"]; ?></td>
                    <td><?= $row["createdat"]; ?></td>
                    <td><i class="fa fa-long-arrow-up"></i><?= $row["total_winner_amount"]; ?></td>
                    <td><i class="fa fa-long-arrow-down"></i><?= $row["total_loss_amount"]; ?></td>
                </tr>
                <?php
                $sr_no++;
            endforeach;
        } else {
            echo '<tr><td colspan="5">No records found.</td></tr>';
        }
        ?>
    </tbody>
</table>
<br>
<div class="pagination">
    <!--<ul>-->
        <?php if ($currentPage > 1): ?>
            <li><a href="?player_id=<?= $player_id ?>&page=<?= $currentPage - 1 ?>">Previous</a></li>
        <?php endif; ?>

        <?php for ($i = $start; $i <= $end; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <li class="active"><a><?= $i ?></a></li>
            <?php else: ?>
                <li><a href="?player_id=<?= $player_id ?>&page=<?= $i ?>"><?= $i ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <li><a href="?player_id=<?= $player_id ?>&page=<?= $currentPage + 1 ?>">Next</a></li>
        <?php endif; ?>
    <!--</ul>-->
</div>


                </div>
            </div>
        </div>
    </div>
