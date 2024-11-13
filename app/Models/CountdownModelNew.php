<?php

namespace App\Models;

use CodeIgniter\Model;

class CountdownModelNew extends Model
{
    protected $table = 'countdowns';
    protected $primaryKey = 'id';
    protected $allowedFields = ['selected_time'];
    protected $useTimestamps = true; // Enable timestamp functionality
    protected $createdField = 'created_at'; // Define which field represents creation time
    protected $updatedField = 'updated_at'; // Define which field represents update time
}
