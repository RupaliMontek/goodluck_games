<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;
use App\Models\SuperAdmin_model;
use App\Models\Admin_model;
use App\Models\Notification_model;
use App\Models\Withdraw_model;
class Request extends Controller
{
    protected $session;
    protected $db;
    public function __construct() {
        
        $this->SuperAdminModel = new \App\Models\SuperAdmin_model();
        $this->session = \Config\Services::session();
        $this->Notification_model = new \App\Models\Notification_model();
        $this->db = \Config\Database::connect();
        $this->Admin_model = new \App\Models\Admin_model();
        $this->SuperAdmin_model = new SuperAdmin_model();
        $this->Withdraw_model = new Withdraw_model();
       // date_default_timezone_set('Asia/Kolkata');
}
    
public function list_balance_admin_request()
{
    // Validate session data
    if (!isset($_SESSION["role"]) || !isset($_SESSION["user_id"])) {
        throw new \Exception("Session data missing.");
    }

    $role = $_SESSION["role"];
    $Withdraw_model = new Withdraw_model();
    $admin_account_id = $_SESSION["user_id"];
    
    // Pagination parameters
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 10;
    $offset = ($page - 1) * $items_per_page;
    
    $data["admin_users_details"] = $this->Withdraw_model->get_admin_user_details($admin_account_id);
    $data["list_admin_request_balance"] = $this->Withdraw_model->get_all_balanceamout_request_send_superadmin($admin_account_id, $items_per_page, $offset);
    // print_r($data["list_admin_request_balance"]);die();
    $lastQuery = $Withdraw_model->getLastQuery();
    // $data["created_date"] = $this->Admin_model->get_created_dates($admin_account_id);

    // Get the total number of records
    $total_items = $this->Admin_model->count_all_balanceamout_request_send_superadmin($admin_account_id);
    $data["total_pages"] = ceil($total_items / $items_per_page);
    $data["current_page"] = $page;

    echo view("templates/admin_header", $data);
    // echo view("templates/sidebar", $data);
    echo view("request/list_balance_admin_request", $data);
    echo view("templates/footer");
}


public function check_player_user_withdraw_request_admin()
{
        $role = $_SESSION["role"];
        $user_id = $_SESSION["user_id"];
        $notificationModel = new Notification_model();
        $data["request_details"] = $this->Notification_model->check_player_user_withdraw_request_admin($user_id);
        //$lastQuery = $notificationModel->getLastQuery();
        //echo $lastQuery; die();
        //echo $lastQuery = $this->db->getLastQuery(); die();
        if(!empty($data["request_details"]))
        {
          echo view("request/balance_withdraw_request_player",$data);
        }
} 

public function check_admin_return_request_status()
{
        $role = $_SESSION["role"];
        $user_id = $_SESSION["user_id"];
        $notificationModel = new Notification_model();
        $data["request_details"] = $this->Notification_model->check_admin_return_request_status($user_id);
        // print_r($data["request_details"]); die();
        $lastQuery = $notificationModel->getLastQuery();
        // echo $lastQuery = $this->db->getLastQuery(); die();
        if(!empty($data["request_details"]))
        {
          echo view("withdraw/check_player_user_withdraw_request_admin",$data);
        }
}

public function check_admin_request_status()
{
        $role = $_SESSION["role"];
        $user_id = $_SESSION["user_id"];
        $notificationModel = new Notification_model();
        $data["request_details"] = $this->Notification_model->check_admin_money_request_status($user_id);
        // print_r($data["request_details"]); die();
        $lastQuery = $notificationModel->getLastQuery();
        if(!empty($data["request_details"]))
        {
          echo view("request/balance_withdraw_request_player",$data);
        }
}
    public function send_balance_request_admin_request()
    {
        $role = $_SESSION["role"];
        $admin_account_id = $_SESSION["user_id"];
        $data["admin_users_details"] = $this->Withdraw_model->get_admin_user_details($admin_account_id); 
        // $data["admin_status"] = $this->Admin_model->get_admin_user_status($admin_account_id); 
        echo view("templates/admin_header");
        // echo view("templates/sidebar");
        echo view("request/send_balance_admin_request", $data);
        echo view("templates/footer");
    }
     public function request_admin_balance_request()
    {
       $post = $this->request->getPost();
       $player_id = $_SESSION["user_id"];
       $admin_users_details = $this->Withdraw_model->get_admin_user_details($player_id);
       $admin_id    = $admin_users_details->added_by;
       $current_wallet_amount  = $admin_users_details->current_wallet; 
       $data = 
       array
       (
        "balance_request_amt"    => $post["balance_request_amt"],
        "added_by"               => $_SESSION["user_id"],
        "admin_id"               => $admin_id,
        "current_wallet_amount"  => $current_wallet_amount,
        "created_at"             => date("Y-m-d h:i:s"),
        "status"                 => "Request", 
       );
       //   print_r($data); die();
       $result = $this->Withdraw_model->send_balance_request_admin($data);
       $para = 
       array
       (
        "request_id"            =>    $result,
        "notification_title"    =>    "balance money request send to admin",
        "notification_from_id"  =>    $_SESSION["user_id"],
        "notification_to_id"    =>    $admin_id,
        "notification_type"     =>    "balance money request",
        "created_at"            =>    date("Y-m-d h:i:s"),

       );
        $results= $this->Notification_model->notification_insert($para);      
        $session = session();
        if ($result) 
        {
             session()->setFlashdata("success_message","Send  Balance Withdraw Request Successfully To Admin");
        } 
        else 
        {
            session()->setFlashdata("error_message","Failed Send  Balance Withdraw Request Successfully To Admin");
        }

        return redirect()->to("request/list_balance_admin_request");       

    }
    
public function change_status_player_request_amount()
{
    $session = session();
    $model = new SuperAdmin_Model();
    $post = $this->request->getPost();
    $user_id = $_SESSION["user_id"];
    $notification_id = $post["notification_id"];
    $request_id = $post["request_id"];
    $superadmin_status = $post["superadmin_status"];
    $notification_from_id = $post["notification_from_id"];
    $data = ["notification_status" => 1];
    $this->Notification_model->view_notification($notification_id, $data);
    $request_details = $this->Withdraw_model->admin_get_request_balance_amount_by_request_id($request_id);
    $request_from_details = $this->SuperAdminModel->get_admin_user_details($notification_from_id);
    if(empty($request_from_details->current_wallet))
    {
        $player_user_balance = $request_from_details->amout_given;
    }
    else
    {
        $player_user_balance = $request_from_details->current_wallet;
    }
    if ($superadmin_status == 1) 
    {
        $admin_details = $this->SuperAdminModel->get_admin_user_details($request_details->admin_id);
        $admin_balance = $admin_details->current_wallet;
        if(empty($admin_balance))
        {
            $admin_balance  =  $admin_details->amout_given;
        }
        else
        {
            $admin_balance  =  $admin_details->current_wallet;
        }
        $approved_amount = $request_details->balance_request_amt;
       
        if ($approved_amount > $admin_balance) 
        {
            $para = 
            [
              "admin_accept_status" => 3,
            ];
           $results = $this->Withdraw_model->update_withdraw_request_player_user($request_id, $para);
            session()->setFlashdata('error_message', 'Insufficient balance. Unable to process the request.!');
            return redirect()->to('admin');
        }
        $new_admin_balance = $admin_balance - $approved_amount;
        $balance_request_amt = $request_details->balance_request_amt;
        $wallet_balance_amt = $player_user_balance + $balance_request_amt;
        $this->SuperAdminModel->update_current_wallet_amount($new_admin_balance,$request_details->admin_id);
        $this->SuperAdminModel->update_current_wallet_amount($wallet_balance_amt,$notification_from_id);
        $para = 
        [
            "wallet_balance_amt" => $wallet_balance_amt,
            "admin_accept_status" => $superadmin_status,
        ];
        $results = $this->Withdraw_model->update_withdraw_request_player_user($request_id, $para);
    } 
    else
    {
        $para = ["admin_accept_status" => $superadmin_status,"admin_approve_date_time"=>date("Y-m-d h:i:s")];
        $results = $this->Withdraw_model->update_withdraw_request_player_user($request_id, $para);
    }
    $notification_array = [
        "request_id" => $request_id,
        "notification_title" => "Admin Change Money Amount Request Status",
        "notification_from_id" => $user_id,
        "notification_to_id" => $notification_from_id,
        "notification_type" => "Admin Change Player Request Money",
        "created_at" => date("Y-m-d h:i:s"),
    ];
    $notification_status = $this->Notification_model->notification_insert($notification_array);
    $session = session();
    if ($results) 
    {
        session()->setFlashdata('success_message', 'Status Changed Successfully');
    } 
    else 
    {
        session()->setFlashdata('error_message', 'Something Went Wrong');
    }
    return redirect()->to('admin');
}

///////////////////update withdraw code sayali 19 august 2024
public function update_score_request()
    {

       $role = $_SESSION["role"];
       $user_id = $_SESSION["user_id"];
       $data["admin_users_details"] = $this->Withdraw_model->get_user_details1($user_id); 
       //echo $data["admin_users_details"]['current_wallet'];
      //print_r($data["admin_users_details"]->current_wallet);exit;
       echo $data["admin_users_details"]->current_wallet;
      
       

    }

}