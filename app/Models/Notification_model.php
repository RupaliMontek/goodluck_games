<?php

namespace App\Models;
use CodeIgniter\Model;
class Notification_model extends Model 
{  
 protected $table = 'notification';
 public function notification_insert($data)
  {
    $this->db->table('notification')->insert($data);
    $lastInsertId = $this->db->insertID();
    return $lastInsertId;
  } 
  public function check_list_admin_user_admin_request_superadmin($admin_id)
  {
  	$builder = $this->db->table("notification");
    $builder->join('super_admins', 'super_admins.id = notification.notification_from_id');
    $builder->join('tbl_admin_request_balace_super_admin', 'tbl_admin_request_balace_super_admin.request_id = notification.request_id');
    $builder->where('notification_title', "Balance Amount Extends Request Send Superadmin");
    $builder->where('notification_type', "extend request balance amount");
    $builder->where('notification.notification_status','0');
    $query = $builder->where('notification_to_id', $admin_id)->get();    
    return $query->getRow(); // or $query->getResultArray()
  }
  public function check_list_admin_user_admin_return_superadmin($admin_id)
  {
  	$builder = $this->db->table("notification");
    $builder->join('super_admins', 'super_admins.id = notification.notification_from_id');
    $builder->join('tbl_admin_request_balace_super_admin', 'tbl_admin_request_balace_super_admin.request_id = notification.request_id');
    $builder->where('notification_title', "Balance Amount Return Request Send Superadmin");
    $builder->where('notification_type', "extend return balance amount");
    $builder->where('notification.notification_status','0');
    $query = $builder->where('notification_to_id', $admin_id)->get();    
    return $query->getRow(); // or $query->getResultArray()
  }

  public function superadmin_amount_change_request_status_change($admin_id)
  {
    $builder = $this->db->table("notification");
    $builder->join('super_admins', 'super_admins.id = notification.notification_from_id');
    $builder->join('tbl_admin_request_balace_super_admin', 'tbl_admin_request_balace_super_admin.request_id = notification.request_id');
    $builder->where('notification_title', "Superadmin Change Balance Amount Request Status");
    $builder->where('notification_type', "Superadmin Change Balance Request Status");
    $builder->where('notification.notification_status','0');
    $query = $builder->where('notification_to_id', $admin_id)->get();    
    return $query->getRow(); // or $query->getResultArray()
  }
  
  public function superadmin_amount_change_return_status_change($admin_id)
  {
    $builder = $this->db->table("notification");
    $builder->join('super_admins', 'super_admins.id = notification.notification_from_id');
    $builder->join('tbl_admin_request_balace_super_admin', 'tbl_admin_request_balace_super_admin.request_id = notification.request_id');
    $builder->where('notification_title', "Superadmin Change Balance Amount Return Status");
    $builder->where('notification_type', "Superadmin Change Balance Return Status");
    $builder->where('notification.notification_status','0');
    $query = $builder->where('notification_to_id', $admin_id)->get();    
    return $query->getRow(); // or $query->getResultArray()
  }

  public function view_notification($notificaton_id,$data)
  {
  	    $builder = $this->db->table("notification");
        $builder->where('notification_id',$notificaton_id);
        return $builder->update($data);	
  }

  public function check_player_user_withdraw_request_admin($admin_id)
  {
  	    $builder = $this->db->table("notification");
        $builder->join('super_admins', 'super_admins.id = notification.notification_from_id');
        $builder->join('tbl_player_user_withdraw_request_history', 'tbl_player_user_withdraw_request_history.request_id = notification.request_id');
        $builder->where('notification_title', "balance withdraw request send to admin");
        $builder->where('notification_type', "balance withdraw request");
        $builder->where('notification.notification_status','0');
        $query = $builder->where('notification_to_id', $admin_id)->get();    
        return $query->getRow(); // or $query->getResultArray()
  }
  
  
   public function check_admin_withdraw_request_status($admin_id)
  {
  	    $builder = $this->db->table("notification");
        $builder->join('super_admins', 'super_admins.id = notification.notification_from_id');
        $builder->join('tbl_player_user_withdraw_request_history', 'tbl_player_user_withdraw_request_history.request_id = notification.request_id');
        $builder->where('notification_title', "Admin Change Withdraw Amount Request Status");
        $builder->where('notification_type', "Admin Change Player Request Withdraw");
        $builder->where('notification.notification_status','0');
        $query = $builder->where('notification_to_id', $admin_id)->get();    
        return $query->getRow();
  }
  public function check_admin_return_request_status($admin_id)
  {
  	    $builder = $this->db->table("notification");
        $builder->join('super_admins', 'super_admins.id = notification.notification_from_id');
        $builder->join('tbl_player_user_withdraw_request_history', 'tbl_player_user_withdraw_request_history.request_id = notification.request_id');
        $builder->where('notification_title', "Admin Change Money Amount Request Status");
        $builder->where('notification_type', "Admin Change Player Request Money");
        $builder->where('notification.notification_status','0');
        $query = $builder->where('notification_to_id', $admin_id)->get();    
        return $query->getRow();
  }
  
   
   public function check_admin_money_request_status($admin_id)
  {
  	    $builder = $this->db->table("notification");
        $builder->join('super_admins', 'super_admins.id = notification.notification_from_id');
        $builder->join('tbl_player_user_withdraw_request_history', 'tbl_player_user_withdraw_request_history.request_id = notification.request_id');
        $builder->where('notification_title', "balance money request send to admin");
        $builder->where('notification_type', "balance money request");
        $builder->where('notification.notification_status','0');
        $query = $builder->where('notification_to_id', $admin_id)->get();    
        return $query->getRow();
  }



}
?>