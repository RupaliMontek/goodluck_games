<?php
namespace App\Models;
use CodeIgniter\Model;
class Login_model extends Model 
{
    protected $table = 'super_admins'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name','last_name','limit_user','amout_given','current_wallet','username','username','password','status','added_by','role','contact','login_count','last_login','created_at','current_session_id','ip_address']; // Corrected field name


   public function generate_token($primaryKey) {
        $token = bin2hex(random_bytes(16)); // Generates a 32 character hex token
        $data = [
            'user_id' => $primaryKey,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->table('user_tokens')->insert($data); // Correct method to insert data
        
        return $token;
    }
    public function validate_token($token) {
         $db = \Config\Database::connect();
        $this->db->where('token', $token);
        $query = $this->db->get('user_tokens');
        
        if ($query->num_rows() == 1) {
            return $query->row()->user_id;
        }
        
        return FALSE;
    }
public function verify_login($username, $password)
{
     $db = \Config\Database::connect();
    $query = $this->db->table('super_admins')
        ->where('username', $username)
        ->where('password', md5($password))
        ->where('status', 1)
        ->get();
    $result = $query->getResult();
    if (count($result) == 1)
    {
        return $result[0];
    } 
    else
    {
        return null;
    }
}
public function getUserById($userId)
{
    return $this->db->table('super_admins')
        ->where('id', $userId)
        ->get()
        ->getFirstRow();
}

    public function updatePassword($userId, $hashedNewPassword)
    {
        $table = 'super_admins';
        return $this->db->table($this->table)
            ->where('id', $userId)
            ->update(['password' => $hashedNewPassword]); // Update the password
    }
public function updateLoginCount($userId)
{
    $this->db->table('super_admins')
             ->where('id', $userId)
             ->update(['login_count' => 'login_count + 1']);
}

public function update_user_login_info($user_id, $data)
{
    $builder = $this->db->table("super_admins"); // Set the table name here
    $builder->where('id', $user_id);
    return $builder->update($data);
} 
public function update_user_login_info1($userId, $data)
    {
        $table = 'super_admins';
        return $this->db->table($this->table)
            ->where('id', $userId)
            ->update(['current_session_id' => '','ip_address' =>'' ]); // Update the password
    }

public function update_user_status($id, $data)
{
    $builder = $this->db->table("super_admins");
    $builder->where('id', $id);
    return $builder->update($data);
}

public function insertLoginDetails($userId)
{
    $data = [
        'user_id' => $userId,
        'login_date' => date('Y-m-d H:i:s')
    ];
    $this->db->insert('super_admins', $data);
}

// public function update_user_status($id,$data)
// {
//     $builder = $this->db->table("super_admins");
//     $builder->where('id',$id);
//     return $builder->update($data);
// }
public function inactivate_inactive_users()
{
    $one_week_ago = date('Y-m-d H:i:s', strtotime('-1 week'));

    $users_to_inactivate = $this->db->table('super_admins')
        ->where('last_login <', $one_week_ago)
        ->get()
        ->getResult();

    foreach ($users_to_inactivate as $user) {
        $data = ['status' => 0];
        $this->update_user_status($user->id, $data);
    }
}

 public function get_ip_address($user_id,$ip_address)
    {
       $query =$this->select('ip_address') // Select all columns or specify if needed
                    ->where('id', $user_id) // Add the first where clause
                    ->where('ip_address', $ip_address)
                    ->findAll(); // Get all matching rows
                    
                     // Get the last executed query
        $db = \Config\Database::connect();
        $lastQuery = $db->getLastQuery();

        // Output the last query for debugging
       // log_message('debug', 'Last Query: ' . $lastQuery);

        return $query;
    }
    
    public function get_current_session_address($user_id)
    {
       $query =$this->select('current_session_id') // Select all columns or specify if needed
                    ->where('id', $user_id) // Add the first where clause
                    ->findAll(); // Get all matching rows
                    
                     // Get the last executed query
        $db = \Config\Database::connect();
        $lastQuery = $db->getLastQuery();

        // Output the last query for debugging
        //log_message('debug', 'Last Query: ' . $lastQuery);

        return $query;
    }
}


?>