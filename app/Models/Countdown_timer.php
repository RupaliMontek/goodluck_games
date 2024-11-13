<?php

namespace App\Models;

use CodeIgniter\Model;

class Countdown_timer extends Model
{
    protected $table = 'countdown_timer_start';
    protected $primaryKey = 'id';
    protected $allowedFields = ['start_time'];
    
    public function get_details()
{
    // Build the query
    $query = $this->db->table('countdown_timer_start')
                      ->select('start_time')
                      ->get(); // Execute the query

    // Return a single row
    return $query->getRow(); // Retrieve a single row
}
}


?>
