<?php
namespace App\Models;
use CodeIgniter\Model;
class UserModel extends Model {
    protected $table = 'super_admins'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['username', 'password']; 

    public function get_pending_bet($user_id) 
    {
        $db = \Config\Database::connect();
        $builder = $db->table('scores');
        $builder->where('player_id', $user_id);
        $builder->where('processed', 0);
        return $builder->get()->getRow();
    }

    public function save_bet_data($betData) {
        $db = \Config\Database::connect();
        $builder = $db->table('scores');
        $builder->insert($betData);
    }

    public function update_balance($betData) {
        $db = \Config\Database::connect();
        $builder = $db->table('super_admins');

        $user_id = $betData->user_id;
        $win_val = $betData->win_val;
        $loss_amount = $betData->total_number_play;

        // Retrieve the current user balance
        $builder->where('id', $user_id);
        $user = $builder->get()->getRow();

        if ($user) {
            $new_balance = $user->current_wallet + $win_val - $loss_amount;

            // Update the user balance
            $builder->where('id', $user_id);
            $builder->update(['current_wallet' => $new_balance]);

            // Mark the bet as processed
            $scoresBuilder = $db->table('scores');
            $scoresBuilder->where('id', $betData->id);
            $scoresBuilder->update(['processed' => 1]);
        }
    }
}
?>
