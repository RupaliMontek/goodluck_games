<?php
namespace App\Models;
use CodeIgniter\Model;
class SpinnerModel extends \CodeIgniter\Model
{
    protected $table = 'spinnerStoppedNumber';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'numbers', 'mode_set', 'created_datetime'];

 public function checkAndInsertMissingRecords($user_id, $mode_set, $startTime, $endTime)
{
    $spinnerModel = new \App\Models\SpinnerModel();
    $db = \Config\Database::connect();
    // Initialize the NumbersModel
    $model = new NumbersModel();
    
    // Get the mode and corresponding values
    $mode = $model->getMode();
    $values = $model->getValuesBasedOnMode($mode);
    
    // Decode the JSON string to a PHP object
    $parsedObject = $values;

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

    $existingTimes = array_column($existingRecords, 'created_datetime');

    // Set the timezone (adjust according to your region)
    $timezone = new \DateTimeZone('Asia/Kolkata');

    // Loop through each minute of the range and check for missing entries
    $interval = new \DateInterval('PT1M');
    $period = new \DatePeriod(new \DateTime($startTime), $interval, new \DateTime($endTime));

    foreach ($period as $minute) {
        // Use the timezone when formatting the datetime
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
        $formattedMinute = $minute->setTimezone($timezone)->format('Y-m-d H:i:s');
        if (!in_array($formattedMinute, $existingTimes)) {
            // Insert missing record
            $data = [
                'user_id' => $user_id,
                'numbers' => $targetValue,  // default or calculated value
                'mode_set' => $mode_set,
                'created_datetime' => $formattedMinute,
            ];
            $this->insert($data);
        }
    }
}


 /* 
 public function checkAndInsertMissingRecords($user_id, $mode_set, $startTime, $endTime)
{
    
    $db = \Config\Database::connect();
$db->query("SET time_zone = 'Asia/Kolkata'");
    $spinnerModel = new \App\Models\SpinnerModel();
    $db = \Config\Database::connect();
    $model = new NumbersModel();
    $mode = $model->getMode(); 
    $values = $model->getValuesBasedOnMode($mode);
    
    // Main values array
    $main_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];

    // Convert values to an array of integers
    $savedNumbers = array_map('intval', explode(',', $values));
    
    // Get the remaining numbers that are not saved
    $remainingNumbers = array_diff($main_values, $savedNumbers);

    // Initialize the target value
    $targetValue = 0;

    // Set target value based on mode
    if ($mode !== 'jackpot_2x' && $mode !== 'jackpot') {
        if (empty($remainingNumbers)) {
            return; // Early return if no remaining numbers
        }
        $randomIndex = array_rand($remainingNumbers);
        $targetValue = $remainingNumbers[$randomIndex];
    } else {
        $targetValue = intval($values); // Set targetValue as the saved number for 'jackpot' modes
    }

    // Get existing records within the time range
    $existingRecords = $db->where('user_id', $user_id)
                            ->where('mode_set', $mode_set)
                            ->where('created_datetime >=', $startTime)
                            ->where('created_datetime <=', $endTime)
                            ->findAll();

    $existingTimes = array_column($existingRecords, 'created_datetime');

    // Set the timezone (adjust according to your region)
    $timezone = new \DateTimeZone('Asia/Kolkata');  // Set to your desired timezone

    // Loop through each minute of the range and check for missing entries
    $interval = new \DateInterval('PT1M');
    $period = new \DatePeriod(new \DateTime($startTime), $interval, new \DateTime($endTime));

    foreach ($period as $minute) {
        $minute->setTimezone($timezone); // Set the timezone before inserting
        $formattedMinute = $minute->format('Y-m-d H:i:s');

        if (!in_array($formattedMinute, $existingTimes)) {
            // Insert missing record
            $data = [
                'user_id' => $user_id,
                'numbers' => $targetValue,
                'mode_set' => $mode_set,
                'created_datetime' => $formattedMinute,
            ];
            $db->insert($data);
        }
    }
}*/


    // Fetch the spin result if it exists for the current minute and mode_set
    public function getSpinResultByTimeAndMode($currentMinute, $mode_set) {
        $query = $this->db->where('created_datetime >=', $currentMinute . ':00')
                          ->where('created_datetime <=', $currentMinute . ':59')
                          ->where('mode_set', $mode_set)
                          ->get('spinnerStoppedNumber');
        return $query->row();
    }

    // Save the new spin result into the database
    public function saveSpinResult($targetValue, $currentMinute, $mode_set) {
        $data = [
            'user_id' => 0,  // Assuming the value is shared for all users, otherwise set the current user ID
            'numbers' => $targetValue,
            'mode_set' => $mode_set,  // Dynamic mode_set
            'created_datetime' => date('Y-m-d H:i:s', strtotime($currentMinute . ':00'))
        ];
        $this->db->insert('spinnerStoppedNumber', $data);
    }

    // Get remaining unused numbers for a specific mode_set
    public function getRemainingNumbers($mode_set) {
        $main_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        $savedNumbers = $this->db->select('numbers')
                                ->where('mode_set', $mode_set)
                                ->get('spinnerStoppedNumber')
                                ->result_array();

        $savedNumbersFlat = array_column($savedNumbers, 'numbers');
        return array_diff($main_values, $savedNumbersFlat);
    }




}
?>