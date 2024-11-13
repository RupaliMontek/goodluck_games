<?php

namespace App\Models;
use CodeIgniter\Model;

class SuperAdmin_model extends Model {
    protected $table = 'super_admins';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'created_at',
        'player_id',
        'first_name',
        'last_name',
        'limit_user',
        'amount_given', // Correcting the typo
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
public function update_inactive_users()
{
    $one_week_ago = date('Y-m-d H:i:s', strtotime('-1 week'));
    $this->where('last_login <', $one_week_ago)
    ->whereIn('role', ['admin', 'user'])
    ->set('status', 0)
    ->update();
}

public function get_admin_account_details($id)
{
    return $this->where('id', $id)->first();
}

public function get_admin_by_id_super_admin(int $admin_id): ?object
{
    $query = $this->db->table('super_admins')->getWhere(['id' => $admin_id]);
    
    return ($query->getNumRows() > 0) ? $query->getRow() : null;
}

public function superadmin_under_admin_list($page, $perPage, $admin_id)
{
    $builder = $this->db->table("super_admins");
    $builder->where('added_by', $admin_id);
    $builder->limit($perPage, ($page - 1) * $perPage);
    $query = $builder->get(); // Execute the query and get the result set
    return $query->getResult(); // Fetch the result set as an array
}
public function get_balance_amount()
{
    // Get the latest record for the super admin
    $latestRecord = $this->where('role', 'super-admin')->first();

    if ($latestRecord) {
        return $latestRecord['current_wallet'];
    } else {
        return null;
    }
}
public function update_wallet($admin_account_id, $new_wallet_amount)
{
    $data = [
        'current_wallet' => $new_wallet_amount
    ];

    return $this->db->table('super_admins')
                    ->where('id', $admin_account_id)
                    ->update($data);
}

public function update_balance_amount($newBalance)
{
    $superAdmin = $this->where('role', 'super-admin')->first();

    if ($superAdmin) {
        $data = ['current_wallet' => $newBalance];
        return $this->update($superAdmin['id'], $data);
    } else {
        return false;
    }
}
public function update_password($superAdminId, $hashedPassword)
{
    $data = [
        'password' => $hashedPassword
    ];

    $this->db->where('id', $superAdminId);
    $this->db->update('super_admins', $data);
}
    public function update_admin_account_details($id,$data)
    {
        $builder = $this->db->table("super_admins");
        $builder->where('id',$id);
        return $builder->update($data);
    }
    
    public function get_player_mode_wise_numbers()
    {
         $query = $this->db->table('numbers')
         ->orderBy('id', 'DESC');
         $result = $query->get()->getRow();
         return $result;
    }
    public function update_theme($theme) {
        $data = [
            'name' => $theme
        ];

        $builder = $this->db->table('theme');
        $builder->where('id', 1);
        return $builder->update($data);
    }
    public function delete_user_history_old_than_one_month()
{
    $thirtyDaysAgo = date('Y-m-d H:i:s', strtotime('-30 days'));
    
    $this->db->table('super_admins')
             ->where('role', 'user')
             ->where('created_at <', $thirtyDaysAgo)
             ->delete();
}
public function get_user_paginated($limit, $offset)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->limit($limit, $offset)
                    ->get()
                    ->getResultArray();
    }

    public function get_admin_user_details($id)
    {
         $query = $this->db->table('super_admins')->getWhere(['id' => $id]);
         return $superAdmin = $query->getRow();
    }  
    public function get_admin_user_current_wallet($id) {
    $query = $this->db->table('super_admins')
                      ->select('current_wallet')
                      ->where('id', $id)        
                      ->get();
    
    $result = $query->getRow();
    
    if ($result) {
        return $result->current_wallet;
    } else {
        return null;
    }
}


    public function update_request_superadmin_balance_amount_for_admin($request_id,$para)
    {
        $builder = $this->db->table("tbl_admin_request_balace_super_admin");
        $builder->where('request_id',$request_id);
        return $builder->update($para);
    }
public function update_current_wallet_amount($current_wallet,$notification_from_id)
{
    $para = ["current_wallet" => $current_wallet];
    $builder = $this->db->table("super_admins");
    $builder->where('id', $notification_from_id);
    return $builder->update($para);
        
}
    public function admin_get_request_balance_amount_by_request_id($request_id)
    {
        $query = $this->db->table('tbl_admin_request_balace_super_admin')
        ->getWhere(['request_id' => $request_id]);
        return $query->getRow();
    }
    public function update_superadmin_wallet($admin_account_id, $amount_remaining_admin)
{
    $data = ['current_wallet' => $amount_remaining_admin];
    return $this->db->table('super_admins')
                    ->where('id', $admin_account_id)
                    ->set($data)
                    ->update();
}

public function create_admin_account($data)
{
    return $this->db->table('super_admins')->insert($data);
}

public function save_playing_no_details($data)
{
    return $this->db->table('playing_number_player')->insert($data);
}

public function usernameExists($username)
{
    $query = $this->db->table('super_admins')->where('username', $username)->get();
    return ($query->getNumRows() > 0);
}

    // public function get_admin_by_id($admin_id)
    // {
    //     $query = $this->db->table('super_admins')->where(['id' => $admin_id])->get();

    //     return $query->first();
    // }
    // public function get_admin_by_id($admin_id)
    // {
    //     return $this->where('id', $admin_id)->first();
    // }
    
   

    public function request_balance_amount_admin()
    {
      $builder = $this->db->table("tbl_admin_request_balace_super_admin");
      $query = $builder->join('super_admins', 'super_admins.id = tbl_admin_request_balace_super_admin.admin_id')->get(); 
      //$query = $builder->where('admin_id', $admin_id)->get();    
      return $query->getResult(); // or $query->getResultArray()
    }

    public function get_admin_by_id(int $admin_id): ?object
    {
        $query = $this->db->table('super_admins')->getWhere(['id' => $admin_id]);
    
        return ($query->getNumRows() > 0) ? $query->getRow() : null;
    }
public function count_all_admins()
{
    return $this->db->table("super_admins")->where('role', 'admin')->countAllResults();
}
    public function get_all_admins($page, $perPage)
{
    $builder = $this->db->table("super_admins");
    $builder->where('role', 'admin');
    $builder->limit($perPage, ($page - 1) * $perPage);
    $query = $builder->get();

    return $query->getResult();
}
public function get_all_admins_details()
{
    $builder = $this->db->table("super_admins");
    $builder->where('role', 'admin');
    $query = $builder->get();

    return $query->getResult();
}
/*public function get_all_player_users_list($user_id)
{
    return $query->getResult(); 
}*/

public function number_insert($data)
{
    $this->db->table('numbers')->insert($data);
}

public function create_user_account($data)
{
    $this->db->table('super_admins')->insert($data);
}

public function get_all_users() {
    $query = $this->db->table('super_admins')->get();
    return $query->getResult();
}

public function get_user_by_id(int $user_id): ?object
    {
    $query = $this->db->table('super_admins')->getWhere(['id' => $user_id]);
    
        // Check if the result is not empty before returning
        return ($query->getNumRows() > 0) ? $query->getRow() : null;
    }

public function get_all_player_users_list($added_by)
{
    $builder = $this->db->table("super_admins");  
    $builder->where('added_by', $added_by); 
    $query = $builder->where('role', 'user')->get();
    return $query->getResult(); // or $query->getResultArray()
}

public function get_paginated_player_users_list($added_by, $items_per_page, $page)
{
    $builder = $this->db->table("super_admins");  
    $builder->where('added_by', $added_by); 
    $builder->where('role', 'user');

    // Get total count of players
    $total = $builder->countAllResults(false);

    // Get paginated data
    $builder->limit($items_per_page, ($page - 1) * $items_per_page);
    $query = $builder->get();
    $data = $query->getResult();

    // Initialize the pager
    $pager = \Config\Services::pager();
    $pager->makeLinks($page, $items_per_page, $total);

    return [
        'data' => $data,
        'pager' => $pager,
        'total' => $total,
    ];
}


public function get_player_users_list()
{
    $builder = $this->db->table("super_admins"); 
    $query = $builder->where('role', 'user')->get();
    return $query->getResult(); // or $query->getResultArray()
}
public function get_user_history($limit, $offset)
{
    $query = $this->db->table('super_admins')
        ->select('first_name, last_name, username, role, current_wallet, amout_given, current_wallet')
        ->limit($limit, $offset)
        ->get();
    
    return $query->getResultArray();
}

public function count_all_user_history()
{
    return $this->db->table('super_admins')->countAllResults();
}
public function get_admin_history($limit, $offset)
    {
        $query = $this->db->table('super_admins')
        ->select('first_name, last_name, username, role, current_wallet, amout_given, current_wallet')
        ->limit($limit, $offset)
        ->get();
        
        return $query->getResultArray();
    }
    public function count_all_admin_history()
{
    return $this->db->table('super_admins')->countAllResults();
}
public function get_user_setting()
    {
        // Retrieve the user history from the database
        $query = $this->db->table('super_admins')->select('username, role, current_wallet, amout_given')->get();

        // Return the result as an array
        return $query->getResultArray();
    }
public function updatePassword($superAdminId, $hashedPassword)
    {
        $this->db->set('password', $hashedPassword);
        $this->db->where('id', $superAdminId);
        $this->db->update('super_admins'); // Use your actual table name 'super_admins'
    }
 public function saveIndicesToDatabase($indicesString, $scenario)
    {
        // Assuming you have a database table named 'your_table'
        // and you want to save indices as a comma-separated string in a specific column
        $data = [
            'scenario' => $scenario,
            'indices' => $indicesString,
        ];

        // Assuming $db is your database connection
        $db = \Config\Database::connect();
        $db->table('numbers')->insert($data);
    }
    
    public function get_user_details($id)
{
    $query = $this->db->table('super_admins')
    ->select('current_wallet')
    ->where('id', $id)        
    ->get();
  return  $result = $query->getRow();
}

}

