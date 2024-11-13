<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;
class SpinnerStoppedNumber extends Model
{
    protected $table = 'spinnerStoppedNumber'; // Corrected table name

    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'numbers','mode_set','created_datetime']; // Corrected field name

    public function saveStoppedNumber($numbers)
    {
        $this->insert(['numbers' => $numbers]);
    }
// Model function to check for existing number
public function existingnumber($current_time) {
    return $this->like('created_datetime', $current_time . '%', 'after') // Match any second within the minute
                ->orderBy('created_datetime', 'DESC') // Sort by latest datetime
                ->first(); // Retrieve the first result
}

 public function saveStoppedNumber_new($user_id, $target_value, $mode_set, $created_datetime) {
        // Prepare data for insertion
        $data = [
            'user_id' => $user_id,
            'numbers' => $target_value,
            'mode_set' => $mode_set,
            'created_datetime' => $created_datetime
        ];

        // Insert the new value into the database
        return $this->insert($data);
    }


 public function getTargetValueForCurrentMinute($currentDateTime)
    {
        // Assuming your created_datetime column is in 'Y-m-d H:i:s' format
        $date = date('Y-m-d', strtotime($currentDateTime));
        $time = date('H:i', strtotime($currentDateTime));
        
        // Fetch the target value for the current minute
        $result =  $this->where('DATE(created_datetime)', $date)
                    ->where('DATE_FORMAT(created_datetime, "%H:%i")', $time)
                    ->first();
                    
                    return $result ? $result['numbers'] : null; 
    }
  // In your SpinnerStoppedNumber model:
public function saveTargetValue($user_id, $numbers, $mode, $created_datetime) {
    $data = [
        'user_id' => $user_id,
        'numbers' => $numbers, // Make sure this is a single value
        'mode_set' => $mode,
        'created_datetime' => $created_datetime
    ];

    // Insert data into the database
    return $this->insert($data);
}
// Check if there's already a number saved for this exact minute (ignoring seconds)


      
   public function getSavedNumbers() {
    // Get the user ID from session or authentication context
    $user_id = session()->get('user_id'); // Adjust as per your session setup

    // Fetch the saved numbers from the database
    $query = $this->select('numbers')
             //   ->where('user_id', $user_id)
                  ->get();

    // Fetch the row (CodeIgniter 4 doesn't use num_rows())
    $result = $query->getRow(); 

    // Check if a result is found
    if ($result) {
        // Convert the saved numbers to an array, assuming numbers are stored as comma-separated values
        return explode(',', $result->numbers);
    }

    // Return an empty array if no saved numbers are found
    return [];
}


/*    
   public function saveStoppedNumber_new($user_id,$numbers,$mode_set,$now)
    {
        $this->insert([
        'user_id' => $user_id,    
        'numbers' => $numbers,
        'mode_set'=> $mode_set,      
        'created_datetime' => $now
        ]);
    }*/
    // public function saveStoppedNumber_new($user_id,$numbers,$mode_set,$now)
    // {
    //     $this->insert([
    //     'user_id' => $user_id,    
    //     'numbers' => $numbers,
    //     'mode_set'=> $mode_set,      
    //     'created_datetime' => date("Y-m-d h:i:s")
    //     ]);
    // }
    // public function getLastTenResults()
    // {
    //     return $this->select('*')
    //                 ->orderBy('id', 'DESC')
    //                 ->limit(10)
    //                 ->findAll();
    // }
    public function getLastTenResultss()
    {
      return $this->select(['numbers', 'mode_set'])
                ->orderBy('id', 'DESC')
                ->limit(10)
                ->get()
                ->getResultArray();
    }
    public function getLastTenResults($user_id)
{
    return $this->select(['numbers', 'mode_set'])
                ->where('user_id', $user_id) // Filter by user ID
                ->orderBy('id', 'DESC')
                ->limit(10)
                ->get()
                ->getResultArray();
}
public function get_24_hour_result()
{
    $time24HoursAgo = Time::now()->subHours(24)->toDateTimeString();

    return $this->select('spinnerStoppedNumber.numbers, spinnerStoppedNumber.created_datetime, super_admins.first_name, super_admins.last_name')
                ->join('super_admins', 'super_admins.id = spinnerStoppedNumber.user_id') // Joining tables
                ->where('spinnerStoppedNumber.created_datetime >=', $time24HoursAgo)
                ->orderBy('spinnerStoppedNumber.id', 'DESC')
                ->limit(100)
                ->get()
                ->getResultArray();
}

     public function get_24_hour_result_s($perPage, $offset)
     {
         $time24HoursAgo = Time::now()->subHours(24)->toDateTimeString();

    return $this->select('numbers, created_datetime')
                ->where('created_datetime >=', $time24HoursAgo)
                ->orderBy('id', 'DESC')
                ->limit($perPage, $offset) // Apply perPage and offset
                ->get()
                ->getResultArray();
     }
      public function get_24_hour_result_ss()
     {
         $time24HoursAgo = Time::now()->subHours(24)->toDateTimeString();

    return $this->select('numbers, created_datetime,mode_set')
                ->where('created_datetime >=', $time24HoursAgo)
                ->orderBy('id', 'DESC')
                ->get()
                ->getResultArray();
     }
    public function getLastResults()
    {
        return $this->orderBy('id', 'DESC')
                    ->limit(1)
                    ->findAll();
    }
    public function count_all_history()
{
    return $this->db->table('spinnerStoppedNumber')->countAllResults();
}
}
