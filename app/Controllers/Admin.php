<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;
use App\Models\SuperAdmin_model;
use App\Models\Admin_model;
use App\Models\Notification_model;
use App\Models\Withdraw_model;

class Admin extends Controller
{
protected $session;
protected $db;
public function __construct() 
{
    $this->SuperAdminModel = new \App\Models\SuperAdmin_model();
    $this->session = \Config\Services::session();
    $this->Notification_model = new \App\Models\Notification_model();
    $this->db = \Config\Database::connect();
    $this->Admin_model = new \App\Models\Admin_model();
    $this->SuperAdmin_model = new SuperAdmin_model();
    $this->Withdraw_model = new Withdraw_model();
    //date_default_timezone_set('Asia/Kolkata');
     // Check if the user is logged in by checking the user ID or any session identifier
        if (!$this->session->get('user_id')) {
            // If session ID is empty, redirect to the login page
            redirect('login');
           return;
        }
}


public function index()
{   
    $role = $_SESSION["role"];
    $session = \Config\Services::session();
    $admin_account_id = $_SESSION["user_id"];
    $data["admin_users_details"] = $this->Admin_model->get_admin_user_details($admin_account_id);
    $pager = \Config\Services::pager();
    $items_per_page = 4; 
    $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
    $players_list = $this->SuperAdminModel->get_paginated_player_users_list($admin_account_id, $items_per_page, $page);
    $sr_no = ($page - 1) * $items_per_page + 1;
    $data["sr_no"] = $sr_no;
    
    $data["players_list"] = $players_list['data'];
    $data["pager"] = $players_list['pager'];
    $data["player_count"] = $players_list['total'];
    echo view("templates/admin_header",$data);
    echo view("templates/sidebar");
    echo view("admin/index", $data);
    echo view("templates/footer");
}



public function players_list()
{
    $role = $_SESSION["role"];
    $admin_account_id = $_SESSION["user_id"];
    $data["admin_users_details"] = $this->Admin_model->get_admin_user_details($admin_account_id);
    $pager = \Config\Services::pager();
    $items_per_page = 5; 
    $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
    $players_list = $this->SuperAdminModel->get_paginated_player_users_list($admin_account_id, $items_per_page, $page);
    $data["players_list"] = $players_list['data'];
    $data["pager"] = $players_list['pager'];
    $data["player_count"] = $players_list['total'];
    // Update inactive users before displaying the list
    $this->SuperAdminModel->update_inactive_users();
    // Clean up old user history
    $this->SuperAdminModel->delete_user_history_old_than_one_month();
    echo view("templates/admin_header");
    echo view("templates/sidebar");
    echo view("admin/player_list", $data);
    echo view("templates/footer");
}



public function view_notification_admin()
{        
       $post                  = $this->request->getPost();
       $user_id               = $_SESSION["user_id"];
       $notification_id       = $post["notification_id"];
       $request_id            = $post["request_id"];       
       $notification_from_id  = $post["notification_from_id"]; 
       $data = 
       array
       (
          "notification_status"  => 1
       );
       $result = $this->Notification_model->view_notification($notification_id,$data);
       $session = session();
       if ($result) 
       {
             session()->setFlashdata("success_message","Successfully View Notification.");
       } 
       else 
       {
            session()->setFlashdata("error_message","Failed View Notification.");
       }
       return redirect()->to("admin/list_balance_request_list_super_admin");    

}     
    
public function view_player_withdraw_request_notification_admin()
{        
       $post                  = $this->request->getPost();
       $user_id               = $_SESSION["user_id"];
       $notification_id       = $post["notification_id"];
       $request_id            = $post["request_id"];       
       $notification_from_id  = $post["notification_from_id"]; 
       $data = 
       array
       (
          "notification_status"  => 1
       );
       $session = session();
       $role = $_SESSION["role"];
       if($role=="user")
       {
           $redirect = "withdraw/list_balance_admin_withdraw";
       }
       else
       {
           $redirect = "admin/list_balance_return_list_super_admin";
       }
       $result = $this->Notification_model->view_notification($notification_id,$data);
       
       
       if ($result) 
       {
             session()->setFlashdata("success_message","Successfully View Notification.");
       } 
       else 
       {
            session()->setFlashdata("error_message","Failed View Notification.");
       }
       return redirect()->to($redirect);    

}

public function view_notification_admin_return()
{        
       $post                  = $this->request->getPost();
       $user_id               = $_SESSION["user_id"];
       $notification_id       = $post["notification_id"];
       $request_id            = $post["request_id"];       
       $notification_from_id  = $post["notification_from_id"]; 
       $data = 
       array
       (
          "notification_status"  => 1
       );
       $result = $this->Notification_model->view_notification($notification_id,$data);
       $session = session();
       if ($result) 
       {
            session()->setFlashdata("success_message","Successfully View Notification.");
       } 
       else 
       {
            session()->setFlashdata("error_message","Failed View Notification.");
       }
       return redirect()->to("admin/list_balance_return_list_super_admin");    

}    

public function superadmin_amount_change_request_status_change()
{
        $role = $_SESSION["role"];
        $user_id = $_SESSION["user_id"];
        $data["request_details"] = $this->Notification_model->superadmin_amount_change_request_status_change($user_id);
        // print_r($data["request_details"]); exit;
        //echo $lastQuery = $this->db->getLastQuery(); die();
        if(!empty( $data["request_details"]))
        {
            echo view("admin/superadmin_amount_extend_request_status_change",$data);
        }
}

public function superadmin_amount_change_return_status_change()
{
        $role = $_SESSION["role"];
        $user_id = $_SESSION["user_id"];
        $data["request_details"] = $this->Notification_model->superadmin_amount_change_return_status_change($user_id);
        // print_r($data["request_details"]); exit;
        if(!empty( $data["request_details"]))
        {
            echo view("admin/superadmin_amount_extend_return_status_change",$data);
        }
}

public function list_balance_request_list_super_admin()
{
    if (!isset($_SESSION["role"]) || !isset($_SESSION["user_id"])) 
    {
        throw new \Exception("Session data missing.");
    }
    $role = $_SESSION["role"];
    $admin_account_id = $_SESSION["user_id"];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 10;
    $offset = ($page - 1) * $items_per_page;
    $data = array();
    $data["admin_users_details"] = $this->Admin_model->get_admin_user_details($admin_account_id);
    $data["list_admin_request_balance"] = $this->Admin_model->get_all_balanceamout_request_send_superadmin($admin_account_id, $items_per_page, $offset);
    $data["created_date"] = $this->Admin_model->get_created_dates($admin_account_id);
    // print_r($data["list_admin_request_balance"]); die();
    // Get the total number of records
    $total_items = $this->Admin_model->count_all_balanceamout_request_send_superadmin($admin_account_id);
    $data["total_pages"] = ceil($total_items / $items_per_page);
    $data["current_page"] = $page;
    // Calculate starting serial number for the current page
    $sr_no = ($page - 1) * $items_per_page + 1;
    $data["sr_no"] = $sr_no;
    echo view("templates/admin_header", $data);
    echo view("templates/sidebar", $data);
    echo view("admin/list_balance_request_super_admin", $data);
    echo view("templates/footer");
}

public function list_balance($admin_account_id)
{
    $db = \Config\Database::connect();
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 10;
    $offset = ($page - 1) * $items_per_page;
    $data["list_admin_request_balance"] = $this->Withdraw_model->get_all_balanceamout_request_send_superadmin($admin_account_id, $items_per_page, $offset);
    $lastQuery = $db->getLastQuery();
    $total_items = $this->Admin_model->count_all_balanceamout_request_send_superadmin($admin_account_id);
    $data["total_pages"] = ceil($total_items / $items_per_page);
    $data["current_page"] = $page;
    echo view("templates/admin_header", $data);
    echo view("templates/sidebar", $data);
    echo view("admin/transaction_list", $data);
    echo view("templates/footer");
}
public function delete_records()
{
        $db = \Config\Database::connect();
        $from_date = $this->request->getPost('from_date');
        $to_date = $this->request->getPost('to_date');
        if ($from_date && $to_date) 
        {
            $deleted = $this->Admin_model->delete_records_in_date_range_user($from_date, $to_date);

        if ($deleted) 
        {
            session()->setFlashdata('success_message', 'Records deleted successfully.');
        } 
        else 
        {
            session()->setFlashdata('error_message', 'No records found for the specified date range.!');    
        }
        } 
        else 
        {   
            session()->setFlashdata('error_message', 'Please provide a valid date range.!');
        }

        return redirect()->to("admin/index");    
}

public function list_balance_request_list_admin()
{
    
    if (!isset($_SESSION["role"]) || !isset($_SESSION["user_id"]))
    {
        throw new \Exception("Session data missing.");
    }
    $role = $_SESSION["role"];
    $admin_account_id = $_SESSION["user_id"];
    $data["admin_users_details"] = $this->Admin_model->get_admin_user_details($admin_account_id);
    $data["list_admin_request_balance"] = $this->Admin_model->get_all_balanceamout_request_send_superadmin($admin_account_id);  
    $data["created_date"] = $this->Admin_model->get_created_dates($admin_account_id);
    echo view("templates/admin_header", $data);
    echo view("templates/sidebar", $data);
    echo view("admin/list_balance_request_super_admin", $data);
    echo view("templates/footer");
}

public function list_balance_return_list_super_admin()
{
    // Validate session data
    $db = Database::connect();
    if (!isset($_SESSION["role"]) || !isset($_SESSION["user_id"])) 
    {
        throw new \Exception("Session data missing.");
    }    $role = $_SESSION["role"];
    $admin_account_id = $_SESSION["user_id"];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 10;
    $offset = ($page - 1) * $items_per_page;
    $data["admin_users_details"] = $this->Admin_model->get_admin_user_details($admin_account_id);
    $builder =  $data["list_admin_request_balance"] = $this->Admin_model->get_all_withdraw_request_list_admin($admin_account_id, $items_per_page, $offset);  
    //print_r($data["list_admin_request_balance"]); die();
    $data["created_date"] = $this->Admin_model->get_created_dates($admin_account_id);
    $total_items = $this->Admin_model->count_all_balanceamout_request_send_superadmin($admin_account_id);
    $data["total_pages"] = ceil($total_items / $items_per_page);
    $data["current_page"] = $page;
    echo view("templates/list_balance_admin_withdraw_header", $data);
    echo view("templates/sendBalanceReturnSuperAdmin_sidebar", $data);
    echo view("admin/list_balance_return_super_admin", $data);
    echo view("templates/footer");
}

public function send_balance_request_superadmin()
{
       $post = $this->request->getPost();
       $admin_account_id = $_SESSION["user_id"];
       $admin_users_details = $this->Admin_model->get_admin_user_details($admin_account_id);
       $admin_superadmin_id    = $admin_users_details->added_by;
       $current_wallet_amount  = $admin_users_details->current_wallet; 
       $data = 
       array
       (
        "balance_request_amt"    => $post["balance_request_amt"],
        "admin_id"               => $_SESSION["user_id"],
        "superadmin_id"          => $admin_superadmin_id,
        "current_wallet_amount"  => $current_wallet_amount,
        "created_at"             => date("Y-m-d h:i:s"),
       );
       $result = $this->Admin_model->send_balance_request_superadmin($data);

       $para = 
       array
       (
        "request_id"            =>    $result,
        "notification_title"    =>    "Balance Amount Extends Request Send Superadmin",
        "notification_from_id"  =>    $_SESSION["user_id"],
        "notification_to_id"    =>    $admin_superadmin_id,
        "notification_type"     =>    "extend request balance amount",
        "created_at"            => date("Y-m-d h:i:s"),

       );
        $results= $this->Notification_model->notification_insert($para);      
        $session = session();
        if ($result) 
        {
             session()->setFlashdata('success_message', 'Send  Balance Request Successfully To Superamin');
        } 
        else 
        {   
            session()->setFlashdata('error_message', 'Failed Send  Balance Request Successfully To Superamin.!');
        }

        return redirect()->to("admin/list_balance_request_list_super_admin");       

}
    
public function send_balance_return_superadmin()
{
       $post = $this->request->getPost();
       $admin_account_id = $_SESSION["user_id"];
       $admin_users_details = $this->Admin_model->get_admin_user_details($admin_account_id);
       $admin_superadmin_id    = $admin_users_details->added_by;
       $current_wallet_amount  = $admin_users_details->current_wallet; 
       $data = 
       array
       (
        "balance_request_amt"    => $post["balance_request_amt"],
        "admin_id"               => $_SESSION["user_id"],
        "superadmin_id"          => $admin_superadmin_id,
        "current_wallet_amount"  => $current_wallet_amount,
        "created_at"             => date("Y-m-d h:i:s"),
        "status" => "return",
       );
       $result = $this->Admin_model->send_balance_return_superadmin($data);

       $para = 
       array
       (
        "request_id"            =>    $result,
        "notification_title"    =>    "Balance Amount Return Request Send Superadmin",
        "notification_from_id"  =>    $_SESSION["user_id"],
        "notification_to_id"    =>    $admin_superadmin_id,
        "notification_type"     =>    "extend return balance amount",
        "created_at"            => date("Y-m-d h:i:s"),

       );
        $results= $this->Notification_model->notification_insert($para);      
        $session = session();
        if ($result) 
        {
            session()->setFlashdata('success_message', 'Send  Balance Return Request Successfully To Superamin.!');
        } 
        else 
        {   
            session()->setFlashdata('error_message', 'Failed Send  Balance Return Request Successfully To Superamin.!');
        }

        return redirect()->to("admin/list_balance_return_list_super_admin"); 
}

public function send_balance_request_super_admin()
{
    $role = $_SESSION["role"];
    $admin_account_id = $_SESSION["user_id"];
    $data["admin_users_details"] = $this->Admin_model->get_admin_user_details($admin_account_id); 
    echo view("templates/admin_header");
    echo view("templates/sidebar");
    echo view("admin/send_balance_request_super_admin.php", $data);
    echo view("templates/footer");
}
public function send_balance_return_super_admin()
{
    $role = $_SESSION["role"];
    $admin_account_id = $_SESSION["user_id"];
    $data["admin_users_details"] = $this->Admin_model->get_admin_user_details($admin_account_id); 
    // $data["admin_status"] = $this->Admin_model->get_admin_user_status($admin_account_id); 
    echo view("templates/list_balance_admin_withdraw_header");
    echo view("templates/sendBalanceReturnSuperAdmin_sidebar");
    echo view("admin/send_balance_return_super_admin.php", $data);
    echo view("templates/footer");
}

public function check_player_username_exist()
{
    $post = $this->request->getPost();
    $username = $post["new_username"];
    $db = Database::connect();
    $check_user_name_exist = $this->Admin_model->check_player_username_exist($username);
    if (!empty($check_user_name_exist)) 
    {
        echo "false";
    } 
    else 
    {
        echo "true";
    }
}

public function add_player()
{
    $admin_account_id = $_SESSION["user_id"];
    $admin_users_details = $this->Admin_model->get_admin_user_details($admin_account_id);
    $data["limit_user_add"] = $admin_users_details->limit_user;
    echo view("templates/admin_header");
    echo view("templates/sidebar");
    echo view("user/user_add", $data);
}

public function edit_player_details($user_id)
{
    $data["player_details"] = $this->Admin_model->get_player_user_details($user_id);
    echo view("templates/admin_header");
    echo view("templates/sidebar");
    echo view("user/user_edit", $data);
    echo view("templates/footer");
}
    
public function edit_admin_user($admin_id)
{
    $data['admins_details'] = $this->Admin_model->get_admin_user_details($admin_id);
    echo view('templates/admin_header', @$data);
    echo view('templates/sidebar', @$data);
    echo view('admin/edit_admin', @$data); 
    echo view('templates/footer',@$data);         
}    

public function profile()
{
    $admin_account_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;
     $session = session();
    if (!$admin_account_id) 
    {
        redirect('login');
        return;
    }
    $admin_users_details = $this->Admin_model->get_admin_user_details($admin_account_id);
    if (!$admin_users_details) 
    {
        echo "Error: Admin user details not found.";
        return;
    }
    $current_wallet_amount = $admin_users_details->current_wallet;
    $contact = $admin_users_details->contact;
    $first_name = $admin_users_details->first_name;
    $last_name = $admin_users_details->last_name;
    $data = array(
        "contact" => $contact,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "current_wallet_amount" => $current_wallet_amount,
        "admin_users_details" => $admin_users_details,
    );
    // Load views with data
    echo view('templates/admin_header', $data);
    echo view('templates/sidebar', $data);
    echo view('admin/profile', $data);
    echo view('templates/footer', $data);
}

public function create_players_account()
{
        $validation = \Config\Services::validation();
        $validation->setRule(
            "new_username",
            "New Username",
            "required|trim|is_unique[super_admins.username]"
        );
        $validation->setRule("new_password", "New Password", "required");
        $admin_account_id = $_SESSION["user_id"];
        $admin_users_details = $this->Admin_model->get_admin_user_details(
            $admin_account_id
        );
        $available_balance = !empty($admin_users_details->current_wallet) ? $admin_users_details->current_wallet : $admin_users_details->amout_given;
        $post = $this->request->getPost();
        $amout_given = $post["amout_given"];
        // Check if the amount given is greater than the available balance
        if ($amout_given > $available_balance) 
        {
            session()->setFlashdata('error_message', 'Insufficient balance to create a new admin account.!');
            return redirect()->to('admin');
        }
    
        if (empty($admin_users_details->current_wallet)) 
        {
            $amout_givens = $admin_users_details->amout_given;
        } 
        else 
        {
            $amout_givens = $admin_users_details->current_wallet;
        }
        if ($validation->withRequest($this->request)->run() === false) 
        {
            return $this->dashboard();
        } 
        else 
        {
            $post = $this->request->getPost();
            $new_username = $post["new_username"];
            $new_password = md5($post["new_password"]);
            $amout_given = $post["amout_given"];
            $first_name = $post["first_name"];
            $contact = $post["contact"];
            $last_name = $post["last_name"];
            $amount_remaning_admin = $amout_givens - $amout_given;
            $login_count = 1;
            $created_at = date('Y-m-d H:i:s');
            $data = [
                "username" => $new_username,
                "password" => $new_password,
                "amout_given" => $amout_given,
                "current_wallet" => $amout_given,
                "first_name" => $first_name,
                "contact" => $contact,
                "last_name" => $last_name,
                "role" => "user",
                "added_by" => $admin_account_id,
                "created_at" => $created_at,
                "login_count" => $login_count,
                "last_login" => $created_at
            ];
            $result = $this->SuperAdmin_model->create_admin_account($data);
            $current_wallet_amount = $admin_users_details->current_wallet;
            $datab = array(
                "current_wallet_amount" => $current_wallet_amount,
                "admin_users_details" => $admin_users_details,
            );
            $new_amount = $current_wallet_amount- $amout_given;
            $update_result = $this->Admin_model->update_current_wallet_field($admin_account_id, $new_amount);
            $session = session();
            if ($result) 
            {
                session()->setFlashdata('success_message', 'Data inserted successfully!');
            } 
            else 
            {
                session()->setFlashdata("error_message", "Data not inserted.");
            }

            return redirect()->to("admin/players_list");
        }
}
    
public function update_players_account_details($id)
{
    $validation = \Config\Services::validation();
    $validation->setRule("new_username", "New Username", "required|trim");
    $admin_account_id = $_SESSION["user_id"];
    if ($validation->withRequest($this->request)->run() === false) 
    {
        return $this->dashboard();
    } 
    else 
    {
        $post = $this->request->getPost();
        $admin_users_details = $this->Admin_model->get_admin_user_details($admin_account_id);
        $available_balance = !empty($admin_users_details->current_wallet) ? $admin_users_details->current_wallet : $admin_users_details->amout_given;
        $amout_given = $post["amout_given"];
        // Check if the amount given is greater than the available balance
        if ($amout_given > $available_balance) 
        {
            $session = session();
            session()->setFlashdata('error_message', 'Insufficient balance to create a new admin account.');
            redirect()->to("admin/players_list");
        }
        $new_username = $post["new_username"];
        $new_password = md5($post["new_password"]);
        $first_name = $post["first_name"];
        $contact = $post["contact"];
        $last_name = $post["last_name"];
        $password = $post["password"];
        if (!empty($password)) 
        {
            $password_set = $new_password;
        } 
        else 
        {
            $password_set = $password;
        }

        $data = [
            "username" => $new_username,
            "password" => $password_set,
            "first_name" => $first_name,
            "contact" => $contact,
            "last_name" => $last_name,
            "role" => "user",
        ];
        $result = $this->SuperAdmin_model->update_admin_account_details($id, $data);
        $session = session();
        if ($result) 
        {
            session()->setFlashdata('success_message', 'Player User Record Updated Successfully.!');
        } 
        else 
        {
            session()->setFlashdata('error_message', 'Player User Record Not Updated.!');
        }
        return redirect()->to("admin/players_list");
    }
}


public function check_player_user_add_limit()
{
    $email = $this->input->post("candidate_email", true);
    $result = $this->M_Candidate_profile->check_if_email_exists($email);
    if ($result >= 1) 
    {
        echo "false";
    } 
    else 
    {
        echo "true";
    }
}

public function remove_player($id)
{
    $model = new Admin_model();
    $model->delete($id);
    return redirect()->to('admin/players_list')->with('success', 'News deleted successfully');  
}
public function history()
{
    $data['history'] = $this->SuperAdmin_model->get_user_history();
    echo view('templates/admin_header', $data);
    echo view('templates/sidebar', $data);
    echo view('admin/history', $data);
    echo view('templates/footer');
}

///////////////////update withdraw code sayali 20 august 2024
public function update_score_admin()
    {

       $role = $_SESSION["role"];
       $user_id = $_SESSION["user_id"];
       $data["admin_users_details"] = $this->SuperAdmin_model->get_user_details($user_id); 
       echo $data["admin_users_details"]->current_wallet;
    
    }
    // public function admin_user_list() 
    // {

    //     $data['admins'] = $this->AdminModel->get_all_admins();
    //     echo view('templates/header', $data);
    //     echo view('templates/sidebar', $data);
    //     echo view('admin/admin_list', $data); 
    //     echo view('templates/footer');             
    //     //return view('super_admin/dashboard', $data);
    // }
}
