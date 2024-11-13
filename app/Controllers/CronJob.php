<?php

namespace App\Controllers;

use App\Models\BetModel;
use App\Models\UserModel;
use App\Models\NumbersModel;

class CronJob extends BaseController
{
    public function process_bets()
    {
        $betModel = new BetModel();
        $userModel = new UserModel();
        
        $pendingBets = $betModel->where('processed', 0)->findAll();

        foreach ($pendingBets as $bet) {
            $user_id = $bet['user_id'];
            $win_val = $bet['win_val'];
            $total_number_play = $bet['total_number_play'];
            $increment_number = $bet['increment_number'];
            
            // Calculate the balance change
            $balanceChange = $win_val - ($total_number_play * $increment_number);

            // Update the user's balance
            $userModel->update_balance($user_id, $balanceChange);

            // Mark the bet as processed
            $betModel->update($bet['id'], ['processed' => 1]);
        }
    }
    
    
public function checkAndInsertMissingRecords($user_id, $mode_set, $startTime, $endTime)
{
    $spinnerModel = new \App\Models\SpinnerModel();
    $db = \Config\Database::connect();
    $model = new NumbersModel();

    // Get the mode and corresponding values
    $mode = $model->getMode();
    $values = $model->getValuesBasedOnMode($mode);

    // Main values array
    $main_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];

    // Initialize the target value
    $targetValue = 0;

    // Get existing records within the time range
    $existingRecords = $this->where('user_id', $user_id)
                            ->where('mode_set', $mode_set)
                            ->where('created_datetime >=', $startTime)
                            ->where('created_datetime <=', $endTime)
                            ->findAll();

    // Create an array of existing records rounded to the minute (ignoring seconds)
    $existingTimes = array_map(function($record) {
        return date('Y-m-d H:i', strtotime($record['created_datetime'])); // Only keep minute precision
    }, $existingRecords);

    // Set the timezone (adjust according to your region)
    $timezone = new \DateTimeZone('Asia/Kolkata');

    // Loop through each minute of the range and check for missing entries
    $interval = new \DateInterval('PT1M');
    $period = new \DatePeriod(new \DateTime($startTime), $interval, new \DateTime($endTime));

    foreach ($period as $minute) {
        // Format the current minute (ignore seconds) with timezone
        $formattedMinute = $minute->setTimezone($timezone)->format('Y-m-d H:i');

        // Convert valuesString to an array of integers
        $valuesString = $values;
        $savedNumbers = array_map('intval', explode(',', $valuesString));

        // Get the remaining numbers that are not saved
        $remainingNumbers = array_diff($main_values, $savedNumbers);

        // Check the mode and set the target value accordingly
        if ($mode !== 'jackpot_2x' && $mode !== 'jackpot') {
            if (empty($remainingNumbers)) {
                // All numbers are saved, no numbers to spin
                return; // Early return if no remaining numbers
            }

            // Select a random remaining number
            $randomIndex = array_rand($remainingNumbers);
            $targetValue = $remainingNumbers[$randomIndex];
        } else {
            // If mode is 'jackpot_2x' or 'jackpot', set targetValue as the saved number
            $targetValue = intval($valuesString);
        }

        // Check if the current minute (ignoring seconds) already exists in the existing records
        if (!in_array($formattedMinute, $existingTimes)) {
            // Insert missing record
            $data = [
                'user_id' => $user_id,
                'numbers' => $targetValue,  // default or calculated value
                'mode_set' => $mode_set,
                'created_datetime' => $minute->setTimezone($timezone)->format('Y-m-d H:i:s'), // Full datetime with seconds
            ];

            // Use transaction for safe insert
            $db->transStart();
            $this->insert($data);
            $db->transComplete();
        }
    }
}


}
