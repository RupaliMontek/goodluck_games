<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player History</title>
    <style>
        .table {
    margin-top: 70px;
    margin-left: -1315px;
        }
    </style>
</head>
<body>
    <h1>Player History: <?php echo htmlspecialchars($player['first_name'] . ' ' . $player['last_name']); ?></h1>

    <?php if (!empty($player_history)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <!--<th>Time</th>-->
                    <th>Show No 1</th>
                    <th>Show No 2</th>
                    <th>Show No 3</th>
                    <th>Show No 4</th>
                    <th>Show No 5</th>
                    <th>Show No 6</th>
                    <th>Show No 7</th>
                    <th>Show No 8</th>
                    <th>Show No 9</th>
                    <th>Show No 0</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($player_history as $entry): ?>
                    <tr>
                        <!--<td><?php echo htmlspecialchars($entry['created_at']); ?></td>-->
                        <td><?php echo htmlspecialchars($entry['showNobtn1']); ?></td>
                        <td><?php echo htmlspecialchars($entry['showNobtn2']); ?></td>
                        <td><?php echo htmlspecialchars($entry['showNobtn3']); ?></td>
                        <td><?php echo htmlspecialchars($entry['showNobtn4']); ?></td>
                        <td><?php echo htmlspecialchars($entry['showNobtn5']); ?></td>
                        <td><?php echo htmlspecialchars($entry['showNobtn6']); ?></td>
                        <td><?php echo htmlspecialchars($entry['showNobtn7']); ?></td>
                        <td><?php echo htmlspecialchars($entry['showNobtn8']); ?></td>
                        <td><?php echo htmlspecialchars($entry['showNobtn9']); ?></td>
                        <td><?php echo htmlspecialchars($entry['showNobtn0']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No history available for this player.</p>
    <?php endif; ?>
    
</body>
</html>
