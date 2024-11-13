<?php

namespace App\Models;

use CodeIgniter\Model;

class CountdownModel extends Model
{
    protected $table = 'countdown_timer_start';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['start_time'];
}
