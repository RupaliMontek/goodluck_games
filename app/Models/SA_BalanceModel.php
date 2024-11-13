<?php
namespace App\Models;

use CodeIgniter\Model;

class SA_BalanceModel extends Model
{
    public $table = 'superadmin_balance_sheet';

    public $primaryKey = 'id';

    public $allowedFields = ['account_balance'];
    
    public function get_balance_amount()
{
    $latestRecord = $this->orderBy('id', 'DESC')->first(); 
    
    if ($latestRecord) {
        return $latestRecord['account_balance']; 
    } else {
        return null;
    }
}

public function update_balance_amount($newBalance)
    {
        $data = ['account_balance' => $newBalance];
        return $this->update(1, $data);
    }
    
}