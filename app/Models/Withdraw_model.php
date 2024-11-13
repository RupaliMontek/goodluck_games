<?php

namespace App\Models;
use CodeIgniter\Model;
class Withdraw_model extends Model 
{
  protected $table = 'super_admins'; 
  protected $useTimestamps = false;
  protected $allowedFields = [
        'id',
        'created_at',
        'first_name',
        'last_name',
        'limit_user',
        'amout_given', // Assuming it's a typo, should be 'amount_given'
        'current_wallet',
        'username',
        'password',
        'status',
        'added_by',
        'role',
        'contact',
        'last_login',
        'login_count',
        'score_amount'
    ];
    
  public function get_admin_user_details($id)
{
    // Ensure $id is valid and sanitized
    if (!is_numeric($id)) {
        throw new InvalidArgumentException("The 'id' parameter must be a numeric value.");
    }

    // Query the database to get the admin user details
    $query = $this->db->table('super_admins')->getWhere(['id' => (int) $id]);

    // Check if a result was returned
    if ($query->getNumRows() > 0) {
        // Return the first row of the query result
        return $query->getRow();
    } else {
        // Handle the case where no user was found with the given id
        return null; // or throw a custom exception
    }
}

public function get_user_details($id)
{
    $query = $this->db->table('super_admins')
    ->select('current_wallet')
    ->where('id', $id)        
    ->get();
    $result = $query->getRow();
}

public function send_balance_request_admin($data)
{
    $this->db->table('tbl_player_user_withdraw_request_history')->insert($data);
    $lastInsertId = $this->db->insertID();
    echo $this->db->getLastQuery();
    return $lastInsertId;
}


public function admin_get_request_balance_amount_by_request_id($request_id)
{
    $query = $this->db->table('tbl_player_user_withdraw_request_history')
    ->getWhere(['request_id' => $request_id]);
    return $query->getRow();
}

public function update_balance_amount($admin_id,$newBalance)
{
    $superAdmin = $this->where('role', 'admin')->first();
    if ($superAdmin)
    {
        $data = ['current_wallet' => $newBalance];
        return $this->update($superAdmin['id'], $data);
    } 
    else 
    {
        return false;
    }
}

public function update_withdraw_request_player_user($request_id,$para)
{
    $builder = $this->db->table("tbl_player_user_withdraw_request_history");
    $builder->where('request_id',$request_id);
    return $builder->update($para);
}

public function get_all_balanceamout_request_send_superadmin($admin_id, $limit, $offset)
{
    $builder = $this->db->table("tbl_player_user_withdraw_request_history");
    $builder->select('tbl_player_user_withdraw_request_history.status as status_user,tbl_player_user_withdraw_request_history.*, super_admins.first_name, super_admins.last_name, tbl_player_user_withdraw_request_history.created_at');
    $builder->join('super_admins', 'super_admins.id = tbl_player_user_withdraw_request_history.admin_id');
    $builder->where('tbl_player_user_withdraw_request_history.added_by', $admin_id);
    $builder->orderBy('tbl_player_user_withdraw_request_history.request_id', 'DESC');
    $builder->limit($limit, $offset);
    $query = $builder->get();

    return $query->getResult(); // or $query->getResultArray()
}

public function get_user_details1($id)
{
    $query = $this->db->table('super_admins')
    ->select('current_wallet')
    ->where('id', $id)        
    ->get();
  return  $result = $query->getRow();
}

}
?>