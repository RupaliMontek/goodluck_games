<?php namespace App\Models;

use CodeIgniter\Model;

class BetModel extends Model
{
    protected $table = 'bets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'number0', 'number1', 'number2', 'number3', 'number4', 'number5', 'number6', 'number7', 'number8', 'number9', 'value', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
