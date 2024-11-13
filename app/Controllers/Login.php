<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;
use App\Models\Login_model;
use App\Models\SuperAdmin_model;
use App\Models\CountdownModel;
use App\Models\Admin_model;
use App\Models\Notification_model;
use App\Models\UserModel;
use App\Controllers\User;
use Config\Services;



class Login extends Controller
{
protected $cookies;
    protected $SuperAdminModel;
    protected $session;
        protected $User;


    public function __construct() 
    {
      // $this->cookies = service('cookies');
      $this->userController = new User(); // Assuming UserController is the correct class name
      $db = Database::connect();
      $this->cookie = \Config\Services::cookie();
      $this->session = \Config\Services::session();
      // Initialize the request service
      $this->request = \Config\Services::request();
      $this->Login_model = new Login_model();
     // date_default_timezone_set('Asia/Kolkata');
      
// Check if the user is logged in by checking the user ID or any session identifier
        if (!$this->session->get('user_id')) {
            // If session ID is empty, redirect to the login page
            redirect('login');
           return;
        }
    }

    public function index() 
    {
        return view('login/index');
    }

public function maintenance_page()
{
    return view('super_admin/maintenance'); 
}
public function maintenance(Request $request)
    {
        $status = $request->input('status'); // Get the status from the AJAX request

        if ($status === 'enabled') {
            // Perform actions to enable maintenance mode
        } else {
            // Perform actions to disable maintenance mode
        }

        return response()->json(['message' => 'Maintenance mode ' . $status]);
    }
public function change_password()
{
    // Check if the user is logged in and is a super admin
    if (!$this->session->has('user_id') || $this->session->get('role') !== 'super-admin') {
        return redirect()->to('login')->with('error', 'You are not authorized to access this page.');
    }

    // Load the view to display the password change form
    echo view('templates/header');
    echo view('templates/sidebar');
    echo view('super_admin/password');
    echo view('templates/footer');
   
}

public function update_password()
{
    $this->db->getLastQuery();

    if (!$this->session->has('user_id') || $this->session->get('role') !== 'super-admin') {
        return redirect()->to('login')->with('error', 'You are not authorized to access this page.');
    }

    $currentPassword = $this->request->getPost('current_password');
    $newPassword = $this->request->getPost('new_password');
    $confirmPassword = $this->request->getPost('confirm_password');

    if ($newPassword !== $confirmPassword) {
        return redirect()->to('login/change_password')->with('error', 'New password and confirm password do not match.');
    }

    $superAdminId = $this->session->get('user_id');

    $superAdmin = $this->SuperAdmin_model->get_admin_by_id_super_admin($superAdminId);
    if (!$superAdmin || !password_verify($currentPassword, $superAdmin->password)) {
        return redirect()->to('login/change_password')->with('error', 'Current password is incorrect.');
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $this->SuperAdmin_model->update_password($superAdminId, $hashedPassword);

    return redirect()->to('login/change_password')->with('success', 'Password updated successfully.');
}

    public function users_status_change()
    {
        $post = $this->request->getPost();
        $status = $post["status"];
        $user_id =$post["user_id"];
        $current_date = date("Y-m-d h:i:s");
        $data = array("status"=>$status,"last_login" => $current_date);
        $result = $this->Login_model->update_user_status($user_id,$data);
         if($result)
        {
            echo "1";
            session()->setFlashdata("success_message","User Status Change Successfully.!.");
        }
        else
        {
             echo "0";  
             session()->setFlashdata("error_message","Failed User Status Change
             !..");
        }
}

public function check_login() 
{ 
    $db = \Config\Database::connect();
    $maintenanceModel = new \App\Models\MaintenanceModel();
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $request = \Config\Services::request();
    $user = $this->Login_model->verify_login($username, $password);
    $lastQuery = $db->getLastQuery();
    //echo($lastQuery); die();
    if ($user)
    {
        if ($maintenanceModel->isMaintenanceEnabled() && in_array($user->role, ['admin', 'user']))
        {
            return redirect()->to('MaintenanceController/'); 
        }

        $login_count = $user->login_count + 1;
        $last_login = date('Y-m-d H:i:s');
        $data = ['login_count' => $login_count, 'last_login' => $last_login];
        $this->Login_model->update_user_login_info($user->id, $data);
        
        $last_login_timestamp = strtotime($user->last_login);
        $one_week_ago = strtotime('-1 week');
        if ($last_login_timestamp < $one_week_ago)
        {
            $data = ['status' => 0];
            $this->Login_model->update_user_status($user->id, $data);
            return redirect()->route('login')->with('warning', 'Your account has been inactive for more than a week. Please contact the administrator.');
        }
        
        $this->session->set('user_id', $user->id);
        $this->session->set('role', $user->role);
        $this->session->set('username', $user->first_name . " " . $user->last_name);
        // Generate token
        $token = $this->Login_model->generate_token($user->id); // Ensure you have a method to generate tokens

        if ($user->role == 'user')
        {
            $countdownModel = new \App\Models\CountdownModel();
            
            // Check if the countdown has already started
            $start_time = $countdownModel->select('start_time')->first();
            if (!$start_time)
            {
                // If countdown has not started, set the start time
                $start_time = time();
                $countdownModel->insert(['start_time' => $start_time]);
            } 
            else
            {
                // If countdown has started, retrieve the start time
                $start_time = $start_time['start_time'];
            }
            
            // Calculate remaining time
            $elapsed_time = time() - $start_time;
            $remaining_time = 60 - $elapsed_time;
            
            // If the countdown reaches 0, reset the start time
            if ($remaining_time <= 0)
            {
                $start_time = time();
                $countdownModel->update(1, ['start_time' => $start_time]);
                $remaining_time = 60;
            }
            
            $is_last_10_seconds = ($remaining_time > 0 && $remaining_time <= 10);
            $minutes = floor($remaining_time / 60);
            $seconds = $remaining_time % 60;
            $display_time = sprintf("%02d:%02d", $minutes, $seconds);

            // Set the cookie if it's the last 10 seconds
            if ($is_last_10_seconds)
            {
                $response = \Config\Services::response();
                $response->setCookie('time_remaining_cookie', $display_time, $remaining_time); // Set the cookie with the remaining time
            }
            
           
           
        }
        
        // Redirect based on user role
        if ($user->role == 'super-admin')
        {
            return redirect()->route('superadmin'); // Super-admin allowed during maintenance
        }
        elseif ($user->role == 'admin')
        {
            return redirect()->route('admin'); // Admin redirect
        }
        elseif ($user->role == 'user')
        {
            return redirect()->route('home_duplicate_theme'); // User redirect
        }
    } 
    else 
    {
        return redirect()->route('login')->with('error', 'Invalid username or password.');
    }
}

public function check_login_new() 
{
    $db = Database::connect();  // Load the database connection
    $maintenanceModel = new \App\Models\MaintenanceModel();
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $user = $this->Login_model->verify_login($username, $password);
    // Retrieve and print the last query executed using the $db instance
    $lastQuery = $db->getLastQuery();
    $request = service('request');
    $ipAddress = $request->getIPAddress();
    
    //echo $lastQuery;die();
    if ($user) 
    {
        if (empty($user->current_session_id)) 
        {
            
            if ($maintenanceModel->isMaintenanceEnabled() && in_array($user->role, ['admin', 'user'])) 
            {
                return $this->response->setJSON(['redirect' => site_url('MaintenanceController/')]);
            }
            $session_id = bin2hex(random_bytes(32));
           
            $login_count = $user->login_count + 1;
            $last_login = date('Y-m-d H:i:s');
            $data= ['login_count' => $login_count, 'last_login' => $last_login,"current_session_id"=>$session_id,'ip_address' => @$ipAddress];
           // print_r($data);exit;
            $this->Login_model->update_user_login_info($user->id, $data);
            $last_login_timestamp = strtotime($user->last_login);
            $one_week_ago = strtotime('-1 week');
            if ($last_login_timestamp < $one_week_ago) 
            {
                $data = ['status' => 0];
                $this->Login_model->update_user_status($user->id, $data);
                return $this->response->setJSON(['redirect' => site_url('login'), 'message' => 'Your account has been inactive for more than a week. Please contact the administrator.']);
            }

            $this->session->set('user_id', $user->id);
            $this->session->set('role', $user->role);
            $this->session->set('username', $user->first_name . " " . $user->last_name);

            $token = $this->Login_model->generate_token($user->id);

            $redirect_url = '';
            if ($user->role == 'super-admin') 
            {
                $redirect_url = site_url('superadmin');
            } 
            elseif ($user->role == 'admin') 
            {
                $redirect_url = site_url('admin');
            } 
            elseif ($user->role == 'user') 
            {
                $redirect_url = site_url('logohome');
            }

            session()->setFlashdata("success_message", "Logged In Successfully!");
            return $this->response->setJSON(['token' => $token, 'redirect' => $redirect_url]);
        } 
        else 
        {
            return $this->response->setJSON(['error' => 'You are already logged in on another device. Log out from that device and try again.']);
        }
    } 
    else 
    {
        return $this->response->setJSON(['error' => 'Invalid username or password.']);
    }
}


public function check_login_sss() 
{
    helper('cookie');
    $maintenanceModel = new \App\Models\MaintenanceModel();
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $request = \Config\Services::request();
    $cookieValue = $request->getCookie();
    $user = $this->Login_model->verify_login($username, $password);
    if ($user)
    {
        if ($maintenanceModel->isMaintenanceEnabled() && in_array($user->role, ['admin', 'user']))
        {
            return redirect()->to('MaintenanceController/'); 
        }
        $login_count = $user->login_count + 1;
        $last_login = date('Y-m-d H:i:s');
        $data = ['login_count' => $login_count,'last_login' => $last_login];
        $this->Login_model->update_user_login_info($user->id, $data);
        $last_login_timestamp = strtotime($user->last_login);
        $one_week_ago = strtotime('-1 week');
        if ($last_login_timestamp < $one_week_ago)
        {
            $data = ['status' => 0];
            $this->Login_model->update_user_status($user->id, $data);
            return redirect()->route('login')->with('warning', 'Your account has been inactive for more than a week. Please contact the administrator.');
        }
        $this->session->set('user_id', $user->id);
        $this->session->set('role', $user->role);
        $this->session->set('username', $user->first_name . " " . $user->last_name);
       if ($user->role) 
        {
            if($user->role=='user')
            {
                $countdownModel = new CountdownModel();
                // Check if the countdown has already started
                $start_time = $countdownModel->select('start_time')->first();
                if (!$start_time)
                {
                    // If countdown has not started, set the start time
                    $start_time = time();
                    $countdownModel->insert(['start_time' => $start_time]);
                } 
                else
                {
                    // If countdown has started, retrieve the start time
                    $start_time = $start_time['start_time'];
                }
                // Calculate remaining time
                $elapsed_time = time() - $start_time;
                $remaining_time = 60 - $elapsed_time;
                // If the countdown reaches 0, reset the start time
                if ($remaining_time <= 0)
                {
                    $start_time = time();
                    $countdownModel->update(1, ['start_time' => $start_time]);
                    $remaining_time = 60;
                }
                $is_last_10_seconds = ($remaining_time > 0 && $remaining_time <= 10);
                
               
                $minutes = floor($remaining_time / 60);
                $seconds = $remaining_time % 60;
                $display_time = sprintf("%02d:%02d", $minutes, $seconds);
                if($is_last_10_seconds==1)
                { 
                    $response = \Config\Services::response();
                    $response->setCookie('time_remaning_cookie', $is_last_10_seconds, 10); // 1 hour expiration
                }
                
                $response = \Config\Services::response();
                $response->setCookie('time_remaning_cookie', $is_last_10_seconds, 10); // 1 hour expiration
                 // Set the cookie with a dummy value and expiration time
                $response = \Config\Services::response();
                $response->setCookie(
                    'dummy_cookie',   // Cookie name
                    'dummy_value',    // Cookie value
                    3600              // Expiration time in seconds (1 hour)
                );
        
        
        
                print_r($_COOKIE);
                print_r($remaining_time); die();
                $data["display_time"] = $display_time;
                
            } 
            if($user->role=='super-admin')
            {
                return redirect()->route('superadmin'); // Super-admin allowed during maintenance
            }
            elseif($user->role=='admin')
            {
                return redirect()->route('admin'); // Admin redirect
            }
            elseif($user->role=='user')
            {
                return redirect()->route('home_duplicate'); // User redirect
            }
        }
   } 
    else 
    {
        return redirect()->route('login')->with('error', 'Invalid username or password.');
    }
}

public function logout()
{
    $user_id = $_SESSION['user_id'];
    $userModel = new \App\Models\UserModel();
    $db = \Config\Database::connect();
    $builder = $db->table('scores');
    $data = ["current_session_id"=>'','ip_address' =>''];
    $this->Login_model->update_user_login_info($user_id, $data);
    // Fetch the user's current score from the 'scores' table
    $builder->where('player_id', $user_id);
    $scoreRecord = $builder->get()->getRow();

    if ($scoreRecord) {
        $main_score = $scoreRecord->win_before_score;
        error_log("Main Score: " . $main_score); // Debugging line

        // Example: Adjust balance if there are any pending bets
        if (isset($_SESSION['pending_bets'])) {
            error_log("Pending Bets: " . print_r($_SESSION['pending_bets'], true)); // Log pending bets for debugging

            foreach ($_SESSION['pending_bets'] as $bet) {
                if ($bet['user_id'] == $user_id) {
                    // Check if 'win_before_after_score' exists in the bet array
                    if (isset($bet['win_before_after_score'])) {
                        $main_score += $bet['win_before_after_score']; // Adjust based on your logic
                        error_log("Adjusted Main Score: " . $main_score); // Debugging line
                    } else {
                        error_log("win_before_after_score not found in bet array"); // Log missing key
                    }
                }
            }

            // Update the user's main score in the database
            $builder->where('player_id', $user_id);
            $builder->update(['win_before_score' => $main_score]);
            error_log("Score Updated for User ID: " . $user_id); // Debugging line

            // Clear pending bets from the session
            unset($_SESSION['pending_bets']);
        }
    }

    // Clear session and log the user out
    session_destroy();
    return redirect()->to(base_url());
}

public function auto_logout_main()
{
    $user_id = $_SESSION['user_id'];
    $userModel = new \App\Models\UserModel();
    $db = \Config\Database::connect();
    //$user_id  = $_SESSION["user_id"];
    $builder = $db->table('scores');
    $builder_superadmin = $db->table('super_admins');
    $mybutoncliekced = $this->request->getPost('mybutoncliekced');
    $betButtons = $this->request->getPost('betButtons');
    $main_score = $this->request->getPost('main_score');
    $mycurrentspinvalue = $this->request->getPost('mycurrentspinvalue');
    $mycurrentspinvalue_mode = $this->request->getPost('mycurrentspinvalue_mode');
    
   if($mybutoncliekced=='true'){
   $cleanedBetButtons = [];

// Loop through the original array
foreach ($betButtons as $key => $value) {
    // Remove the 'showNobtn' prefix from the key
    $cleanedKey = str_replace('showNobtn', '', $key);
    
    // Add the cleaned key and value to the new array
    $cleanedBetButtons[$cleanedKey] = $value;
}

// Output the cleaned key-value pair array
//  print_r($mycurrentspinvalue)."-";
//  print_r($cleanedBetButtons);
//  exit;
if (array_key_exists($mycurrentspinvalue, $cleanedBetButtons) && $cleanedBetButtons[$mycurrentspinvalue] !== 0) {
  //  echo 
    echo "Key {$mycurrentspinvalue} exists and its value is not zero: " . $cleanedBetButtons[$mycurrentspinvalue];
    ////
   
    if($mycurrentspinvalue_mode=='jackpot_2x')
    {
       $score_value= $cleanedBetButtons[$mycurrentspinvalue]*18;
    }
    elseif($mycurrentspinvalue_mode=='jackpot')
    {
         $score_value= $cleanedBetButtons[$mycurrentspinvalue]*9;
    }
    elseif($mycurrentspinvalue_mode=='next' || $mycurrentspinvalue_mode=='high' || $mycurrentspinvalue_mode=='low' ||$mycurrentspinvalue_mode=='intermediate' )
    {
        $score_value= $cleanedBetButtons[$mycurrentspinvalue]*9;
    }
    $main_score1 =$main_score+$score_value;
    $main_score2 =$main_score+$score_value;
    //print_r($score_value);exit;
   // $data = ['current_session_id'=>'','ip_address' =>'' ];
    ////update the last score
    // $builder->where('player_id', $user_id);
    // $builder->update(['win_before_after_score'=>$score_value,'win_before_score' =>$main_score,'winner_number' =>$mycurrentspinvalue ]);
    $lastEntry = $builder->where('player_id', $user_id)
                     ->orderBy('id', 'DESC') // Make sure to use the correct timestamp column
                     ->limit(1) // Limit to the last entry
                     ->get() // Execute the query
                     ->getRow(); // Get the result as a single row
     $particularEntry = $builder_superadmin->where('id', $user_id)
                            ->get() // Execute the query
                            ->getRow(); // Get the result as a single row                
                     
                     
 $builder_superadmin->where('id', $user_id) // Assuming you have an 'id' column to identify the record
            ->update([
                'current_wallet' => $main_score2,
                
            ]);
if ($lastEntry) {
    // Update the last entry
    $builder->where('id', $lastEntry->id) // Assuming you have an 'id' column to identify the record
            ->update([
                'win_before_after_score' => $main_score1,
                'win_before_score' => $main_score,
                'winner_number' => $mycurrentspinvalue
            ]);
            
           
}
    
} else {
    echo "Key {$mycurrentspinvalue} either does not exist or its value is zero.";
}
    //   print_r($main_score);  
        
}/////if closed
        // Return a response
        
}
///////////////////////sayali for tab close point
public function auto_logout()
{
    $user_id = $_SESSION['user_id'];
    $userModel = new \App\Models\UserModel();
    $db = \Config\Database::connect();
    $builder = $db->table('scores');
  //  $user_id = 151;
    $request = service('request');
    $ipAddress = $request->getIPAddress();
    $user_id = $_SESSION['user_id']; 
    $ip=$this->Login_model->get_ip_address($user_id, $ipAddress);
    if($ipAddress==$ip[0]['ip_address'])
    {
    $data = ['current_session_id'=>'',
              'ip_address' =>'' ];
    $this->Login_model->update_user_login_info1($user_id, $data);
    
    // Fetch the user's current score from the 'scores' table
    
    $session = session();
    $session->destroy();
    $res=1;
    }
    else
    {
    $session_id=$this->Login_model->get_current_session_address($user_id);
    $data_update = ['current_session_id'=>$session_id[0]['current_session_id']];
    $this->Login_model->update_user_login_info1($user_id, $data_update);
    $res=2;
    }
    if($res==1)
    {
        return $this->response->setJSON(['status' => 'success']);
    }
    else
    {
        return $this->response->setJSON(['status' => 'Failure']);
    }
    
        // Return a response
        
}


    /*public function logout()
    {
          // Call the save method of UserController
      //  $this->userController->save();
        
        $this->session->destroy();
        return redirect()->to('login');
    }*/
}