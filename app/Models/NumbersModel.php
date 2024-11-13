<?php
namespace App\Models;

use CodeIgniter\Model;

class NumbersModel extends Model
{
    public $table = 'numbers';

    public $primaryKey = 'id';

    protected $allowedFields = ['low', 'intermediate', 'high', 'jackpot', 'jackpot_2x', 'next', 'mode', 'previous_mode', 'previous_mode_set_at', 'previous_mode_set_value', 'numbers', 'created_at'];
    
    
    public function getExcludedNumbers()
{
    $result = $this->findAll();

    $excludedNumbers = [];
    foreach ($result as $row) {
        $numbers = [$row['low'], $row['intermediate'], $row['high'], $row['jackpot'], $row['jackpot_2x'], $row['next']];
        $excludedNumbers = array_merge($excludedNumbers, $numbers);
    }

    return $excludedNumbers;
}
public function number_insert($data)
{
$this->db->table('numbers')->insert($data);
    //$this->db->insert_batch('numbers', $data);
}

private function scheduleDelayedInsert($data, $delay)
{
     // Get the current time
    $now = time();

    // Check if 60 seconds have passed
    if (($now - $delay) >= 2) {
        // Insert the record
        $this->db->table('numbers')->insert($data);
    }
}
// public function number_insert($data)
//     {
//         $db = \Config\Database::connect();
//         $builder = $db->table($this->table);

//         // Check if the new mode is 'jackpot_2x'
//         if (isset($data['mode']) && $data['mode'] === 'jackpot_2x') {
//             // Fetch the latest record
//             $latestRecord = $this->orderBy('id', 'DESC')->first();

//             if ($latestRecord) {
//                 // Update the latest record with previous mode details
//                 $builder->set([
//                     'previous_mode' => $latestRecord['mode'],
//                     'previous_mode_set_at' => date('Y-m-d H:i:s'),
//                     'previous_mode_set_value' => $this->getModeValue($latestRecord['mode'], $latestRecord),
//                     'mode' => 'jackpot_2x',
//                     'jackpot_2x' => $data['jackpot_2x']
//                 ])
//                 ->where('id', $latestRecord['id'])
//                 ->update();

//                 // Wait for 1 minute (for demonstration purposes; use a cron job or other methods in production)
//                 sleep(60);

//                 // Insert a new record with the previous mode after 1 minute
//                 $builder->query("
//                     INSERT INTO numbers (low, intermediate, high, jackpot, jackpot_2x, next, mode, previous_mode, previous_mode_set_at, previous_mode_set_value, numbers, created_at)
//                     SELECT 
//                         low, 
//                         intermediate, 
//                         high, 
//                         jackpot, 
//                         NULL, 
//                         previous_mode_set_value, 
//                         previous_mode, 
//                         '', 
//                         '', 
//                         previous_mode_set_value, 
//                         numbers, 
//                         NOW()
//                     FROM numbers
//                     WHERE mode = 'jackpot_2x'
//                       AND previous_mode_set_at <= NOW() - INTERVAL 1 MINUTE
//                     ORDER BY id DESC
//                     LIMIT 1
//                 ");
//             }
//         }

//         // Insert the new data into the 'numbers' table
//         $builder->insert($data);
//     }

    // Helper function to get the value based on the mode
    private function getModeValue($mode, $record)
    {
        switch ($mode) {
            case 'low':
                return $record['low'];
            case 'intermediate':
                return $record['intermediate'];
            case 'high':
                return $record['high'];
            case 'jackpot':
                return $record['jackpot'];
            case 'next':
                return $record['next'];
            default:
                return '';
        }
    }
public function getMode()
    {
        // Fetch the mode from the database
        $latestRecord = $this->orderBy('id', 'DESC')->first();
        if ($latestRecord) {
            return $latestRecord['mode'];
        } else {
            return null;
        }
    }


     public function getValuesBasedOnMode($mode)
    {
        // Fetch values based on the mode
        $latestRecord = $this->orderBy('id', 'DESC')->first();
        if ($latestRecord) {
            switch ($mode) {
                case 'low':
                    return $latestRecord['low'];
                    break;
                case 'intermediate':
                    return $latestRecord['intermediate'];
                    break;
                case 'mediam':
                    return $latestRecord['intermediate'];
                    break;
                case 'high':
                    return $latestRecord['high'];
                    break;
                case 'jackpot':
                    return $latestRecord['jackpot'];
                    break;
                case 'jackpot_2x':
                    return $latestRecord['jackpot_2x'];
                    break;
                case 'next':
                    return $latestRecord['next'];
                    break;
                default:
                    return null;
                    break;
            }
        } else {
            return null;
        }
    }
    
    
    public function get_first_2x_jackpot()
    {
        // Fetch the mode from the database
        $latestRecord = $this->orderBy('id', 'DESC')->first();
        if ($latestRecord) {
            return $latestRecord;
        } else {
            return null;
        }
    }
    
    public function get_first_2x_jackpot1()
{
    // Fetch the most recent record where the status column equals the given status
    $latestRecord = $this->where('mode', 'jackpot_2x')
                         ->orderBy('id', 'DESC')
                         ->first();
    
    if ($latestRecord) {
        return $latestRecord;
    } else {
        return null;
    }
}
    
    public function get_second_last_jackpot()
{
    // Fetch the second last record from the database
    $record = $this->orderBy('id', 'DESC')
                     ->whereNotIn('mode', ['jackpot_2x', 'jackpot'])
                   ->findAll(1); // Get the two most recent records
    //print_r($record);exit;

  
  //  if (count($record) >= 2) {
        return $record; // Return the second last record
   // } else {
    //    return null; // Not enough records
   // }
}

}
?>