<?php

namespace App\Models;
use CodeIgniter\Model;
class Admin_model extends Model 
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
    public function delete_records_in_date_range($from_date, $to_date)
{
    $db = \Config\Database::connect();

    $builder = $db->table('tbl_admin_request_balace_super_admin');
    $builder->where('created_at >=', $from_date);
    $builder->where('created_at <=', $to_date);
    
    return $builder->delete();
}
public function delete_records_in_date_range_user($from_date, $to_date)
{
    $db = \Config\Database::connect();

    $builder = $db->table('tbl_player_user_withdraw_request_history');
    $builder->where('created_at >=', $from_date);
    $builder->where('created_at <=', $to_date);
    
    return $builder->delete();
}

public function update_current_wallet_field($admin_account_id, $new_amount)
    {
        $this->set('current_wallet', $new_amount)
             ->where('id', $admin_account_id)
             ->update();
    }

public function update_wallet_amount($admin_account_id, $new_amount)
    {
        $data = [
            'current_wallet' => $new_amount
        ];

        // Update the record
        $this->where('id', $admin_account_id)
             ->set($data)
             ->update();

        if ($this->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
public function get_user_current_amounts() 
{
    $builder = $this->db->table("super_admins");
    $builder->select('current_wallet');
    $builder->where('role', 'user');
    // Execute the query and get the results
    $query = $builder->get();
    // Return the result set as an array of objects
    return $query->getResult();
}

public function get_user_amount() 
    {        
        $builder = $this->db->table("super_admins");      
        $query= $builder->where('role','user')->get();
        return $query->getResult();
    }

  public function get_admin_user_details($id)
{
    if (!is_numeric($id)) {
        throw new InvalidArgumentException("The 'id' parameter must be a numeric value.");
    }

    $query = $this->db->table('super_admins')->getWhere(['id' => (int) $id]);

    if ($query->getNumRows() > 0) {
        return $query->getRow();
    } else {
        return null;
    }
}

    // public function get_admin_user_status($id)
    // {
    //      $query = $this->db->table('tbl_admin_request_balace_super_admin')->getWhere(['id' => $id]);
    //      return $query->getResult();
    // }
    public function get_user_details($id)
    {
         $query = $this->db->table('super_admins')->getWhere(['id' => $id]);
         return $superAdmin = $query->getRow();
    }   
   
  public function send_balance_request_superadmin($data)
  {
    $this->db->table('tbl_admin_request_balace_super_admin')->insert($data);
    $lastInsertId = $this->db->insertID();
    return $lastInsertId;
  }
  public function send_balance_return_superadmin($data)
  {
    $this->db->table('tbl_admin_request_balace_super_admin')->insert($data);
    $lastInsertId = $this->db->insertID();
    return $lastInsertId;
  }
  public function update_superadmin_wallet($admin_account_id, $amount_remaining_admin)
{
    $data = ['current_wallet' => $amount_remaining_admin];
    return $this->db->table('super_admins')
                    ->where('id', $admin_account_id)
                    ->set($data)
                    ->update();
}


  public function update_admin_account_details($id,$data)
  {
        $builder = $this->db->table("super_admins");
        $builder->where('id',$id);
        return $builder->update($data);
  }
  public function get_all_balanceamout_request_send_superadmin($admin_id, $limit, $offset)
{
    $builder = $this->db->table("tbl_admin_request_balace_super_admin");
    $builder->select('tbl_admin_request_balace_super_admin.status as status_user,tbl_admin_request_balace_super_admin.*, super_admins.first_name, super_admins.last_name');
    $builder->join('super_admins', 'super_admins.id = tbl_admin_request_balace_super_admin.superadmin_id');
    $builder->limit($limit, $offset);
    $builder->orderBy('tbl_admin_request_balace_super_admin.request_id', 'DESC');
    $builder->where('admin_id', $admin_id);
    $query = $builder->get();  
    return $query->getResult(); // or $query->getResultArray()
}
public function get_all_balanceamout_request_send_superadmin_sa($admin_id)
{
    $builder = $this->db->table("tbl_admin_request_balace_super_admin");
    $builder->select('tbl_admin_request_balace_super_admin.status as status_user,tbl_admin_request_balace_super_admin.*, super_admins.first_name, super_admins.last_name');
    $builder->join('super_admins', 'super_admins.id = tbl_admin_request_balace_super_admin.superadmin_id');
    // $builder->limit($limit, $offset);
    $builder->orderBy('tbl_admin_request_balace_super_admin.request_id', 'DESC');
    $builder->where('admin_id', $admin_id);
    $query = $builder->get();    

    return $query->getResult(); // or $query->getResultArray()
}

public function get_all_withdraw_request_list_admin($admin_id,$limit,$offset)
{
    $builder = $this->db->table("tbl_player_user_withdraw_request_history");
    $builder->select('tbl_player_user_withdraw_request_history.status as status_user,tbl_player_user_withdraw_request_history.*, super_admins.first_name, super_admins.last_name');
    $builder->join('super_admins', 'super_admins.id = tbl_player_user_withdraw_request_history.admin_id');
    //$builder->limit($limit, $offset);
    $builder->orderBy('tbl_player_user_withdraw_request_history.request_id', 'DESC');
    $builder->where('tbl_player_user_withdraw_request_history.added_by', $admin_id);
    $query = $builder->get(); 
    //echo $this->db->getLastQuery(); die();
    return $query->getResult(); // or $query->getResultArray()
}
  public function count_all_balanceamout_request_send_superadmin($admin_id)
{
    $builder = $this->db->table("tbl_admin_request_balace_super_admin");
    $builder->where('admin_id', $admin_id);
    return $builder->countAllResults();
}

  public function get_all_balanceamount_request_send_superadmin($admin_id)
  {
    $builder = $this->db->table("tbl_admin_request_balace_super_admin");
    $query = $builder->where('admin_id', $admin_id)->get();    
    return $query->getResult();
  }
  public function get_created_dates($admin_id)
{
    $builder = $this->db->table("tbl_admin_request_balace_super_admin");
    $builder->select("created_at"); // Specify that you only need the 'created_at' field
    $builder->where('admin_id', $admin_id);
    
    $query = $builder->get();
    return $query->getResult();
}

//   public function get_all_balanceamout_request_send_superadmin($admin_id)
// {
//     $builder = $this->db->table("tbl_admin_request_balace_super_admin");
//     $builder->join('super_admins', 'super_admins.id = tbl_admin_request_balace_super_admin.superadmin_id');
//     $builder->where('admin_id', $admin_id);
//     $builder->orderBy('created_at', 'DESC'); // Sort by transaction_date in descending order
//     $query = $builder->get();
    
//     return $query->getResult(); // or $query->getResultArray()
// }

    public function get_admin_created_date($admin_id)
    {
    $builder = $this->db->table("tbl_admin_request_balace_super_admin");
    $builder->select("created_at");  // Assuming the created date is stored in "created_at"
    $query = $builder->where('admin_id', $admin_id)->get();
    
    $result = $query->getRow();
    if ($result) {
        return $result->created_at;
    }
    return null;
    }
    public function get_all_created_dates($admin_id)
{
    // Build the query
    $builder = $this->db->table("tbl_admin_request_balace_super_admin");

    // Select only the created_at column
    $builder->select("created_at");

    // Filter by admin_id
    $query = $builder->where('admin_id', $admin_id)->get();

    // Retrieve all rows as an array of objects
    $results = $query->getResult();

    // Return the results or an empty array if no matches are found
    return $results ?? [];
}

    public function get_player_user_details($user_id)
    {
        $query = $this->db->table('super_admins')->getWhere(['id' => $user_id]);
        return $superAdmin = $query->getRow();   
    }    

    /*public function check_player_username_exist($username)
    {
      $query = $this->db->table('super_admins')->getWhere(['username' => $username]);
      $result = $query->getResult();
      return count($result);
    }*/

    public function check_player_username_exist($username)
    {
      $query = $this->db->table('super_admins')->getWhere(['username' => $username]);
      return $result =  $query->getRow();      
    }
    public function get_all_admins() 
    {        
        $builder = $this->db->table("super_admins");      
        $query= $builder->where('role','admin')->get();
        return $query->getResult();
    }
    public function get_user() 
    {        
        $builder = $this->db->table("super_admins");      
        $query= $builder->where('role','user')->get();
        return $query->getResult();
    }
    public function get_all_user() 
    {        
        $builder = $this->db->table("super_admins");      
        $query= $builder->where('role','user')->get();
        return $query->getResult();
    }

  }
?>