<?php
namespace App\Controllers;
use CodeIgniter\Database\Database; // This is important
use CodeIgniter\Controller;
use App\Models\SuperAdmin_model;
use App\Models\Notification_model; 
use App\Models\NumbersModel;
use App\Models\CountdownModel;
use App\Models\SpinnerStoppedNumber;
use App\Models\SA_BalanceModel;
use App\Models\Login_model;
use App\Models\CountdownModelNew;
use App\Models\ScoreModel;
use App\Models\Admin_model;
use App\Models\Countdown_timer;
use CodeIgniter\I18n\Time;

class SuperAdmin extends Controller {
    protected $SuperAdminModel;
    protected $session;
public function __construct() 
{
    $this->SuperAdminModel = new \App\Models\SuperAdmin_model();
    $this->session = \Config\Services::session();
    helper(['form', 'url']); 
    $this->SuperAdmin_model = new SuperAdmin_model();
    $this->db = \Config\Database::connect();
    $this->Notification_model = new \App\Models\Notification_model();
    $this->SA_BalanceModel = new SA_BalanceModel();
    $this->Admin_model = new Admin_model();
    $this->NumbersModel = new NumbersModel();
    //date_default_timezone_set('Asia/Kolkata');
     // Check if the user is logged in by checking the user ID or any session identifier
        if (!$this->session->get('user_id')) {
            // If session ID is empty, redirect to the login page
            redirect('login');
           return;
        }

}
// public function saveSelectedTime()
//     {
//         $selectedTime = $this->request->getPost('selected_time');

//         if ($selectedTime === null || !is_numeric($selectedTime)) {
//             return $this->response->setJSON(['error' => 'Invalid time selected'])->setStatusCode(400);
//         }

//         $countdownModel = new CountdownModelNew();
//         $data = [
//             'selected_time' => $selectedTime,
//             'created_at' => date('Y-m-d H:i:s'), // Manually setting the creation timestamp
//             'updated_at' => date('Y-m-d H:i:s') // Manually setting the update timestamp
//         ];

//         $countdownModel->insert($data);

//         return $this->response->setJSON(['message' => 'Countdown saved successfully'])->setStatusCode(201);
//     }
public function balance_sheet()
{
    $model = new SuperAdmin_model();
    $models = new ScoreModel();

    $pager = \Config\Services::pager();

    $perPage = 10; 
    $page = $this->request->getVar('page') ?? 1; 
    $offset = ($page - 1) * $perPage;

    $totalPlayers = count($models->get_all_player_game_details()); 
    $playersDetails = $models->get_all_player_game_details($perPage, $offset);
    // print_r($totalPlayers); die();
    $data["current_wallet"] = $model->get_balance_amount(); 
    $data["players_list"] = $this->SuperAdminModel->get_player_users_list();
    $data["players_details"] = $playersDetails;
    $data['pager'] = $pager->makeLinks($page, $perPage, $totalPlayers);
    $data['page'] = $page; // Pass the current page to the view

    echo view('templates/header');
    echo view('templates/sidebar');
    echo view('super_admin/balance_sheet', $data);
    echo view('templates/footer');
}
public function players_score_details($player_id)
{
    $ScoreModel = new ScoreModel();
    $superAdminModel = new SuperAdmin_model();

    // Get today's date
    $today = date('Y-m-d');

    // Fetch player's history for today
    $player_history = $ScoreModel->where('player_id', $player_id)
                                 ->where('DATE(created_at)', $today)
                                 ->orderBy('created_at', 'DESC')
                                 ->findAll();

    // Fetch player's details
    $player = $superAdminModel->find($player_id);

    // Pass data to the view
    $data = [
        'player_history' => $player_history,
        'player' => $player
    ];

    echo view('templates/header');
    echo view('templates/sidebar');
    echo view('super_admin/players_score_details', $data);
    echo view('templates/footer');
}



public function superadmin_under_admin_list($admin_id)
{
    $pager = \Config\Services::pager();
    $page = $this->request->getVar('page') ?? 1;
    $perPage = 10;
    $total = $this->SuperAdminModel->count_all_admins();
    $data['admins'] = $this->SuperAdminModel->superadmin_under_admin_list($page, $perPage,$admin_id);
    $data['pager'] = $pager;
    $data['total'] = $total;
    $data['perPage'] = $perPage;
    $data['page'] = $page;
    $data["player_list"] = $this->SuperAdminModel->get_player_users_list();
    echo view("templates/new_user_header", $data);
    echo view('templates/sidebar', $data);
    echo view('super_admin/superadmin_under_admin_list', $data);
    echo view("templates/footer");
}


public function balance_sheet_details()
{
    // Get player_id from GET parameters
    $player_id = $this->request->getVar('player_id');

    // Check if player_id is provided
    if (!$player_id) {
        return redirect()->back()->with('error', 'Player ID is required.');
    }

    // Load necessary models
    $model = new SuperAdmin_model();
    $models = new ScoreModel();

    // Pagination settings
    $limit = 10; // Number of records per page
    $page = $this->request->getVar('page') ?? 1;
    $offset = ($page - 1) * $limit;

    // Fetch total records count
    $totalRecords = count($models->get_all_scores_details_by_player($player_id, null));

    // Fetch players details with pagination
    $data["players_details"] = $models->get_all_scores_details_by_player($player_id, null, $limit, $offset);

    // Calculate total pages
    $totalPages = ceil($totalRecords / $limit);
    $data["totalPages"] = $totalPages;
    $data["currentPage"] = $page;
    $data["player_id"] = $player_id; // Pass player_id to the view
    $data["limit"] = $limit;

    // Pagination range logic
    $range = 3; // Number of page links to show on either side of the current page
    $start = max(1, $page - $range);
    $end = min($totalPages, $page + $range);

    $data["start"] = $start;
    $data["end"] = $end;

    // Load views
    echo view('templates/header');
    echo view('templates/sidebar');
    echo view('super_admin/balance_sheet_details', $data);
    echo view('templates/footer');
}
public function change_theme()
{
   
    echo view('templates/header');
    echo view('templates/sidebar');
    echo view('super_admin/change_theam');
    echo view('templates/footer');
}
public function save_theme()
{
        $model = new SuperAdmin_model();

    if (isset($_POST['theme'])) {
            $selected_theme = $_POST['theme'];
            if($model->update_theme($selected_theme)){
                echo "Theme saved successfully";
            } else {
                echo "Failed to save theme";
            }
        } else {
            echo "No theme selected";
        }
}
public function profile()
{
    $admin_account_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

    if (!$admin_account_id) {
        redirect('login');
        return;
    }
    $admin_users_details = $this->SuperAdmin_model->get_admin_user_details($admin_account_id);

    if (!$admin_users_details) {
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
    
    // $model = new SA_BalanceModel();
    
    // $data["balance"] = $model->get_balance_amount(); 
    
    echo view('templates/header', $data);
    echo view('templates/sidebar', $data);
    echo view('super_admin/profile', $data);
    echo view('templates/footer', $data);
}
public function add_money()
{
    $admin_account_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

    if (!$admin_account_id) {
        redirect('login');
        return;
    }

    $extra_money = $this->request->getPost('extra_money');

    if ($extra_money && is_numeric($extra_money) && $extra_money > 0) {
        $admin_users_details = $this->SuperAdmin_model->get_admin_user_details($admin_account_id);
        $current_wallet_amount = $admin_users_details->current_wallet;

        $new_wallet_amount = $current_wallet_amount + $extra_money;
        $this->SuperAdmin_model->update_wallet($admin_account_id, $new_wallet_amount);

        return redirect()->to('superadmin/profile');
    } else {
        echo "Invalid amount. Please enter a valid number.";
    }
}



 public function run()
    {
        // Load your model
        $model = new \App\Models\NumbersModel();

        // Check the latest entry for 'jackpot_2x'
        $latest_entry = $this->NumbersModel->get_first_2x_jackpot();

     //   if (($latest_entry && $latest_entry['mode'] === 'jackpot_2x') || $latest_entry['mode'] === 'jackpot') {
     if (($latest_entry && $latest_entry['mode'] === 'jackpot_2x') ) {
            // Get the second last jackpot record
            $second_last_entry = $this->NumbersModel->get_second_last_jackpot();
//print_r($second_last_entry);exit;
            if ($second_last_entry) {
                // Prepare the data for re-insertion
                $data_insert = [
                    'low' => @$second_last_entry[0]['low'],
                    'intermediate' => @$second_last_entry[0]['intermediate'],
                    'high' => @$second_last_entry[0]['high'],
                    'jackpot' => @$second_last_entry[0]['jackpot'],
                    'jackpot_2x' => @$second_last_entry[0]['jackpot_2x'],
                    'next' => @$second_last_entry[0]['next'],
                    'mode' => @$second_last_entry[0]['mode'],
                ];

                // Insert the previous record again
                $this->NumbersModel->number_insert($data_insert);
                CLI::write('Inserted previous jackpot record successfully.');
            } else {
                CLI::write('No second last jackpot record found.');
            }
        } else {
            CLI::write('No jackpot_2x entry found.');
        }
    }
    
public function set_mode_session() 
{
    $post = $this->request->getPost();

    if (!empty($post)) {
        // Initialize playing users array
        $playing_user = [
            @$post["number_1_playing_user"],
            @$post["number_2_playing_user"],
            @$post["number_3_playing_user"],
            @$post["number_4_playing_user"],
            @$post["number_5_playing_user"],
            @$post["number_6_playing_user"],
            @$post["number_7_playing_user"],
            @$post["number_8_playing_user"],
            @$post["number_9_playing_user"],
            @$post["number_0_playing_user"]
        ];

        // Process the number data using the post values
        $number_array = $this->process_numbers($post, $playing_user);
        $mode = $post["mode"];

        if (in_array($mode, ['high', 'low', 'mediam', 'jackpot', 'jackpot_2x', 'next'])) {
            // Start a transaction for bulk insert
            $this->db->transStart();

            $data_insert = $this->prepare_data_for_insertion($number_array, $mode);
            
            // Insert the data into the database
            $this->NumbersModel->number_insert($data_insert);
            $this->session->set('mode', $mode);

            // Complete the transaction
            $this->db->transComplete();

            if ($this->db->transStatus() === FALSE) {
                // Handle the transaction failure
                return redirect()->to('superadmin')->with('error', 'Data insertion failed.');
            }
        }
    }
    return redirect()->to('superadmin');
}

private function process_numbers($post, $playing_user)
{
    $number_array = array_map(function ($number) {
        return $number !== '' ? $number : NULL;
    }, $playing_user);

    if ($post["mode"] === 'jackpot_2x' || $post["mode"] === 'jackpot') {
        // Simplify handling for jackpot and jackpot_2x
        for ($i = 0; $i <= 9; $i++) {
            $number_array[] = !empty($post["S2number" . $i]) ? $post["S2number" . $i] : NULL;
        }
    } elseif ($post["mode"] === 'next') {
        for ($i = 1; $i <= 9; $i++) {
            $number_array[] = !empty($post["S1number" . $i]) ? $post["S1number" . $i] : NULL;
        }
    } else {
        for ($i = 1; $i <= 9; $i++) {
            $number_array[] = !empty($post["number_table_val" . $i]) ? $post["number_table_val" . $i] : NULL;
        }
    }

    return $number_array;
}

private function prepare_data_for_insertion($number_array, $mode)
{
    $data_insert = [
        'low' => '',
        'intermediate' => '',
        'high' => '',
        'jackpot' => '',
        'jackpot_2x' => '',
        'next' => '',
        'mode' => $mode
    ];

    // Handle modes and filter numbers only once
$filtered_numbers = array_filter($number_array, function($num) {
    return $num !== NULL;
});

    switch ($mode) {
        case 'high':
            $data_insert['high'] = implode(",", array_slice($filtered_numbers, 0, 3));
            break;
        case 'low':
            $data_insert['low'] = implode(",", array_slice($filtered_numbers, 0, 4));
            break;
        case 'mediam':
            $data_insert['intermediate'] = implode(",", array_slice($filtered_numbers, 0, 2));
            break;
        case 'jackpot':
        case 'jackpot_2x':
            $data_insert[$mode] = implode(",", $filtered_numbers);
            break;
        case 'next':
            $data_insert['next'] = implode(",", $filtered_numbers);
            break;
    }

    return $data_insert;
}




public function remove_admin($id)
    {
      $model = new SuperAdmin_Model();

    $model->delete($id);

    return redirect()->to('superadmin/admin_user_list')->with('success', 'News deleted successfully');  
    }
public function save_section1_values()
{
    $selectedValues = $this->input->post('selectedValues');
   // print_r($selectedValues); die();
}
public function save_jackpot_mode_value()
{
    $selectedValues = $this->input->post('selectedValues');
    //print_r($selectedValues); die();
}

public function index() 
{
    if (isset($_SESSION["user_id"])) 
    {
        $scoreModel = new ScoreModel();    
        $superAdminModel = new SuperAdmin_model();
        $admin_account_id = $_SESSION["user_id"];
        $players_per_page = 10;
        $data["players_list"] = $scoreModel->get_latest_entry_for_each_user();
        // print_r($data["players_list"]); die(); 
        $superAdmins = $superAdminModel->findAll();
        $superAdminsMap = [];
        foreach ($superAdmins as $admin)
        {
            $superAdminsMap[$admin['id']] = $admin['first_name'] . ' ' . $admin['last_name'];
        }
        
        //print_r($superAdminsMap);
        
        foreach ($data["players_list"] as &$player)
        {
            $player['player_name'] = $superAdminsMap[$player['player_id']] ?? 'Unknown';
        }
        $spinnerModel = new SpinnerStoppedNumber();
        $data['last_ten_results'] = $spinnerModel->getLastTenResultss();
        // $data['last_24_hour_results'] = $spinnerModel->get_24_hour_result();
//         print_r($spinnerModel->getLastQuery()->getQuery()
// );exit;
        $all_players = $scoreModel->findAll();
        $sums = $scoreModel->calculateSums($data["players_list"]);
        $data['sums'] = $sums;
        $pager = service('pager');
        $data['pager'] = $scoreModel->pager;
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('super_admin/index', $data); 
        echo view('templates/footer');
   }else{
       return view('login/index');
   }
}


public function get_all_players_sum_and_values() 
{
    if (isset($_SESSION["user_id"])) 
    {
        // Load necessary models
        $scoreModel = new ScoreModel();    
        $superAdminModel = new SuperAdmin_model();
        $spinnerModel = new SpinnerStoppedNumber();

        // Get the logged-in admin ID
        $admin_account_id = $_SESSION["user_id"];

        // Get player data
        $data["players_list"] = $scoreModel->get_latest_entry_for_each_user();
        
        // Get super admin data
        $superAdmins = $superAdminModel->findAll();
        $superAdminsMap = [];

        // Map super admin names by ID
        foreach ($superAdmins as $admin)
        {
            $superAdminsMap[$admin['id']] = $admin['first_name'] . ' ' . $admin['last_name'];
        }

        // Assign player names based on the super admin map
        foreach ($data["players_list"] as &$player)
        {
            $player['player_name'] = $superAdminsMap[$player['player_id']] ?? 'Unknown';
        }

        // Get last 10 results from spinner model
        $data['last_ten_results'] = $spinnerModel->getLastTenResultss();

        // Get all players and calculate sums
        $all_players = $scoreModel->findAll();
        $sums = $scoreModel->calculateSums($data["players_list"]);

        // Assign sums to data
        $data['sums'] = $sums;

        // Ensure response is returned as JSON
        return $this->response->setJSON($data);
    }
    else
    {
        // Handle unauthenticated access
        return $this->response->setJSON([
            'error' => 'User not authenticated.'
        ]);
    }
}


    private function calculateSums($players_list)
    {
        $sums = array_fill(0, 10, 0); // Initialize array for sums
        
        foreach ($players_list as $player) {
            for ($i = 0; $i < 10; $i++) {
                $sums[$i] += $player["showNobtn$i"];
            }
        }
        
        return $sums;
    }
    
public function get_superadmin_wallet_balance_amount()
{
    $admin_account_id = $_SESSION["user_id"];
    $admin_users_details = $this->SuperAdmin_model->get_admin_user_details($admin_account_id);
    $data["admin_users_details"] = $admin_users_details;
    echo json_encode($data["admin_users_details"]);
}  
    
 public function saveSelectedTime()
{
    $selected_time = $this->request->getPost('selected_time');

    $countdownModel = new Countdown_timer();
    // You might want to clear previous entries before inserting a new one
    $countdownModel->truncate();
    $countdownModel->insert(['start_time' => $selected_time]);
    return $this->response->setJSON(['status' => 'success']);
}

//     public function get_universal_counter_timer_all()
//     {
//          $countdownModel = new CountdownModelNew();
//         // Check if the countdown has already started
//         $start_time = $countdownModel->select('selected_time')->first();
        
//         // if (!$start_time) {
//         //     // If countdown has not started, set the start time
//         //     $start_time = time();
//         //     $countdownModel->insert(['selected_time' => $start_time]);
//         // } else {
//         //     // If countdown has started, retrieve the start time
//         //     $start_time = $start_time['selected_time'];
//         // }
// // print_r($start_time); die(); 
//         // Calculate remaining time
//         $elapsed_time = time() - $start_time;
//         $remaining_time = 120 - $elapsed_time;

//         // If the countdown reaches 0, reset the start time
//         if ($remaining_time <= 0) {
//             $start_time = time();
//             $countdownModel->update(1, ['start_time' => $start_time]);
//             $remaining_time = 120;
//         }

//         // Format remaining time for display
//         $minutes = floor($remaining_time / 60);
//         $seconds = $remaining_time % 60;
//         $display_time = sprintf("%02d:%02d", $minutes, $seconds);
//         $data["display_time"] =$display_time;
//         echo json_encode($data["display_time"]);
//     }

public function get_universal_counter_timer_all()
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
        // Perform your action here when the countdown reaches 0
        // For example, you can call another function or execute some code
        // Example: startRotation(); // assuming startRotation() is your desired action
    }
    $is_last_10_seconds = ($remaining_time > 0 && $remaining_time <= 10);
    $minutes = floor($remaining_time / 60);
    $seconds = $remaining_time % 60;
    $display_time = sprintf("%02d:%02d", $minutes, $seconds);
    $data["display_time"] = $display_time;
    $data["is_last_10_seconds"] = $is_last_10_seconds;
    echo json_encode($data["display_time"]);
    
}


    public function request_balance_amount_admin()
    {
       $role = $_SESSION["role"];
       $user_id = $_SESSION["user_id"];

       $data["request_list_admin"] = $this->SuperAdminModel->request_balance_amount_admin();
       echo view('templates/header');
       echo view('templates/sidebar');
       echo view('super_admin/request_balance_amount_admin',$data); 
       echo view('templates/footer');  
       return redirect()->to('superadmin/admin_user_list');
    }
    public function return_balance_amount_admin()
    {
       $role = $_SESSION["role"];
       $user_id = $_SESSION["user_id"];

       $data["request_list_admin"] = $this->SuperAdminModel->request_balance_amount_admin();
       echo view('templates/header');
       echo view('templates/sidebar');
       echo view('super_admin/return_balance_amount_admin',$data); 
       echo view('templates/footer');  
       return redirect()->to('superadmin/admin_user_list');
    }

    
    public function check_list_admin_user_admin_request_superadmin()
    {

       $role = $_SESSION["role"];
       $user_id = $_SESSION["user_id"];
       $data["request_details"] = $this->Notification_model->check_list_admin_user_admin_request_superadmin($user_id);
       //echo $lastQuery = $this->db->getLastQuery(); die();
      
       if(!empty($data["request_details"]))
       {
       echo view("admin/balance_amount_extend_request_admin",$data);
        }

    }
    public function check_list_admin_user_admin_return_superadmin()
    {

       $role = $_SESSION["role"];
       $user_id = $_SESSION["user_id"];
       $data["request_details"] = $this->Notification_model->check_list_admin_user_admin_return_superadmin($user_id);
        //echo $lastQuery = $this->db->getLastQuery();
       if(!empty($data["request_details"])){
       echo view("admin/balance_amount_extend_return_admin",$data);
        }

    }

public function change_status_admin_send_request_balance_amount()
{
    $session = session();
    
    $model = new SuperAdmin_Model();
    
    $post = $this->request->getPost();

    $user_id = $_SESSION["user_id"];
    $notification_id = $post["notification_id"];
    $request_id = $post["request_id"];
    $superadmin_status = $post["superadmin_status"];
    $notification_from_id = $post["notification_from_id"];
// print_r($post);exit;
    $data = ["notification_status" => 1];
    $this->Notification_model->view_notification($notification_id, $data);

    $request_details = $this->SuperAdminModel->admin_get_request_balance_amount_by_request_id($request_id);
    $request_from_details = $this->SuperAdminModel->get_admin_user_details($notification_from_id);

    if ($superadmin_status == 1) {
        $super_admin_balance = $this->SuperAdminModel->get_balance_amount();

        $approved_amount = $request_details->balance_request_amt;
        
        if ($super_admin_balance < $approved_amount) {
            session()->setFlashdata('error_message', 'Insufficient balance. Unable to process the request.');
            return redirect()->to('superadmin/return_balance_amount_admin');
        }
        $new_super_admin_balance = $super_admin_balance - $approved_amount;
//  print_r($new_super_admin_balance); exit();
        $this->SuperAdminModel->update_balance_amount($new_super_admin_balance);

        $balance_request_amt = $request_details->balance_request_amt;
        $amout_given = $request_from_details->amout_given + $balance_request_amt;       
        $current_wallet = $request_from_details->current_wallet + $balance_request_amt;
// print_r($balance_request_amt."==============".$amout_given."========".$current_wallet);exit;

        $this->SuperAdminModel->update_current_wallet_amount($current_wallet,$notification_from_id);

        $para = [
            "amout_given_balace_amt" => $amout_given,
            "wallet_balance_amt" => $current_wallet,
            "superadmin_accept_status" => $superadmin_status,
        ];
        $results = $this->SuperAdminModel->update_request_superadmin_balance_amount_for_admin($request_id, $para);
    } else {
        $para = ["superadmin_accept_status" => $superadmin_status];
        $results = $this->SuperAdminModel->update_request_superadmin_balance_amount_for_admin($request_id, $para);
    }

    $notification_array = [
        "request_id" => $request_id,
        "notification_title" => "Superadmin Change Balance Amount Request Status",
        "notification_from_id" => $user_id,
        "notification_to_id" => $notification_from_id,
        "notification_type" => "Superadmin Change Balance Request Status",
        "created_at" => date("Y-m-d h:i:s"),
    ];//print_r($notification_array);exit;
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
    return redirect()->to('superadmin/request_balance_amount_admin');
}

public function change_status_admin_send_return_balance_amount()
{
    $model = new SuperAdmin_Model();
    
    $post = $this->request->getPost();
    $user_id = $_SESSION["user_id"];
    $notification_id = $post["notification_id"];
    $request_id = $post["request_id"];
    $superadmin_status = $post["superadmin_status"];
    $notification_from_id = $post["notification_from_id"];
//print_r($post);exit;
    $data = ["notification_status" => 1];
    $this->Notification_model->view_notification($notification_id, $data);

    $request_details = $this->SuperAdminModel->admin_get_request_balance_amount_by_request_id($request_id);
    $request_from_details = $this->SuperAdminModel->get_admin_user_details($notification_from_id);

    if ($superadmin_status == 1) {
        $super_admin_balance = $this->SuperAdminModel->get_balance_amount();

        $approved_amount = $request_details->balance_request_amt;

        $new_super_admin_balance = $super_admin_balance + $approved_amount;
// print_r($new_super_admin_balance); exit;
        $this->SuperAdminModel->update_balance_amount($new_super_admin_balance);

        $balance_request_amt = $request_details->balance_request_amt;
        $amout_given = $request_from_details->amout_given - $balance_request_amt;       
        $current_wallet = $request_from_details->current_wallet - $balance_request_amt;
//print_r($balance_request_amt."==============".$amout_given."========".$current_wallet);exit;

        $this->SuperAdminModel->update_current_wallet_amount($current_wallet,$notification_from_id);

        $para = [
            "amout_given_balace_amt" => $amout_given,
            "wallet_balance_amt" => $current_wallet,
            "superadmin_accept_status" => $superadmin_status,
        ];
        $results = $this->SuperAdminModel->update_request_superadmin_balance_amount_for_admin($request_id, $para);
    } else {
        $para = ["superadmin_accept_status" => $superadmin_status];
        $results = $this->SuperAdminModel->update_request_superadmin_balance_amount_for_admin($request_id, $para);
    }

    $notification_array = [
        "request_id" => $request_id,
        "notification_title" => "Superadmin Change Balance Amount Request Status",
        "notification_from_id" => $user_id,
        "notification_to_id" => $notification_from_id,
        "notification_type" => "Superadmin Change Balance Request Status",
        "created_at" => date("Y-m-d h:i:s"),
    ];//print_r($notification_array);exit;
    $notification_status = $this->Notification_model->notification_insert($notification_array);

    $session = session();
    if ($results) {
        session()->setFlashdata('success_message', 'Status Changed Successfully');
    } else {
        session()->setFlashdata('error_message', 'Something Went Wrong');
    }

    return redirect()->to('superadmin/return_balance_amount_admin');
}

    public function add_admin_user()
    {
        $data['admins'] = $this->SuperAdminModel->get_all_admins_details();
        echo view('templates/header', @$data);
        echo view('templates/sidebar', @$data);
        echo view('admin/add_admin', @$data); 
        echo view('templates/footer',@$data);         
    }    


    public function edit_admin_user($admin_id)
    {
        $data['admins_details'] = $this->SuperAdminModel->get_admin_user_details($admin_id);
        echo view('templates/header', @$data);
        echo view('templates/sidebar', @$data);
        echo view('admin/edit_admin', @$data); 
        echo view('templates/footer',@$data);         
    }    

    public function admin_user_list()
{
    $pager = \Config\Services::pager();
    
    $page = $this->request->getVar('page') ?? 1;
    
    $perPage = 10;
    
    $total = $this->SuperAdminModel->count_all_admins();
    
    $admins = $this->SuperAdminModel->get_all_admins($page, $perPage);
    
    $data['admins'] = $admins;
    $data['pager'] = $pager;
    $data['total'] = $total;
    $data['perPage'] = $perPage;
    $data['page'] = $page;
    
    echo view('templates/header', $data);
    echo view('templates/sidebar', $data);
    echo view('super_admin/admin_list', $data); 
    echo view('templates/footer');             
}

    public function user_dashboard() 
    {
        $data['users'] = $this->SuperAdminModel->get_all_users();

        echo view('templates/header', $data);
        
        echo view('templates/footer');        
    }

    public function list_balance($admin_account_id) 
    {
        $db = \Config\Database::connect();
        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $items_per_page = 10;
        $offset = ($page - 1) * $items_per_page;
        
        $data["list_admin_request_balance"] = $this->Admin_model->get_all_balanceamout_request_send_superadmin($admin_account_id, $items_per_page, $offset);
        $lastQuery = $db->getLastQuery();

        $total_items = $this->Admin_model->count_all_balanceamout_request_send_superadmin($admin_account_id);
        $data["total_pages"] = ceil($total_items / $items_per_page);
        $data["current_page"] = $page;
    
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('super_admin/transaction_list', $data); 
        echo view('templates/footer');        
    }   
    public function delete_records()
{
    $db = \Config\Database::connect();

    $from_date = $this->request->getPost('from_date');
    $to_date = $this->request->getPost('to_date');

    
    if ($from_date && $to_date) {
        $deleted = $this->Admin_model->delete_records_in_date_range($from_date, $to_date);

        if ($deleted) {
            session()->setFlashdata('success', 'Records deleted successfully.');
        } else {
            session()->setFlashdata('error', 'No records found for the specified date range.');
        }
    } else {
        session()->setFlashdata('error', 'Please provide a valid date range.');
    }

    return redirect()->to('superadmin/index');
    
}

    
  
public function create_account_from_dashboard()
{
    $session = session();
    $validation = \Config\Services::validation();

    // Set validation rules
    $validation->setRule('new_username', 'New Username', 'required|trim|is_unique[super_admins.username]');
    $validation->setRule('new_password', 'New Password', 'required');

    $admin_account_id = $_SESSION["user_id"];
    $admin_users_details = $this->Admin_model->get_admin_user_details($admin_account_id);

    // Determine the available balance
    $available_balance = !empty($admin_users_details->current_wallet) ? $admin_users_details->current_wallet : $admin_users_details->amout_given;

    $post = $this->request->getPost();
    $amout_given = $post["amout_given"];

    // Check if the amount given is greater than the available balance
    if ($amout_given > $available_balance) {
        session()->setFlashdata('error_message', 'Insufficient balance to create a new admin account.');
        return redirect()->back()->withInput();
    }

    // Validate input
    if ($validation->withRequest($this->request)->run() === false) {
        return $this->add_admin_user();
    } else {
        $new_username = $post["new_username"];
        $new_password = md5($post['new_password']);
        $limit_user = $post["limit_user_create"];
        $first_name = $post["first_name"];
        $contact = $post["contact"];
        $last_name = $post["last_name"];
        $amount_remaining_admin = $available_balance - $amout_given;
        $created_at = date('Y-m-d H:i:s');

        // Update the admin's current wallet amount
        $update_result = $this->Admin_model->update_superadmin_wallet($admin_account_id, $amount_remaining_admin);
// print_r($update_result); die();
        if (!$update_result) {
            session()->setFlashdata('error_message', 'Failed to update the wallet amount.');
            return redirect()->back()->withInput();
        }

        $data = [
            'username' => $new_username,
            'password' => $new_password,
            'amout_given' => $amout_given,
            'current_wallet' => $amout_given,
            'limit_user' => $limit_user,
            'first_name' => $first_name,
            'contact' => $contact,
            'last_name' => $last_name,
            'role' => 'admin',
            'added_by' => $admin_account_id,
            "created_at" => $created_at,
            "last_login" => $created_at
        ];

        $result = $this->SuperAdmin_model->create_admin_account($data);

        if ($result) {
            session()->setFlashdata('success_message', 'Data inserted successfully');
        } else {
            session()->setFlashdata('error_message', 'Data not inserted.');
        }

        return redirect()->to('superadmin/admin_user_list');
    }
}

    public function update_account_details_admin($id) 
{
    $validation = \Config\Services::validation();
    $validation->setRule('new_username', 'New Username', 'required|trim');    

    $admin_account_id = $_SESSION["user_id"];
    $admin_users_details = $this->Admin_model->get_admin_user_details($admin_account_id);

    if (empty($admin_users_details->current_wallet)) {
        $amout_givens = $admin_users_details->amout_given;
    } else {
        $amout_givens = $admin_users_details->current_wallet;
    }

    if ($validation->withRequest($this->request)->run() === false) {
        return $this->dashboard();
    } else {  
        $admin_account_id = $_SESSION["user_id"];                
        $post = $this->request->getPost();
        $new_username = $post["new_username"];
        $new_password = md5($post['new_password']);
        $limit_user   = $post["limit_user_create"];
        $first_name   = $post["first_name"];
        $contact      = $post["contact"];
        $last_name    = $post["last_name"];
        $password     = $post["password"];

        if (!empty($password)) {
            $password_set = $new_password;
        } else {
            $password_set = $password;
        }

        $data = [
            'username'     => $new_username,
            'password'     => $password_set,
            // 'current_wallet' => $amout_givens, // Update current_wallet instead of amout_given
            'limit_user'   => $limit_user,
            'first_name'   => $first_name,
            'contact'      => $contact,
            'last_name'    => $last_name,
            'role'         => 'admin',
            'added_by'     => $admin_account_id
        ];           

        $result = $this->SuperAdmin_model->update_admin_account_details($id, $data);
        $session = session();

        if ($result) {
            session()->setFlashdata('success_message', 'Admin Record Updated Successfully');
        } else {
            session()->setFlashdata('error_message', 'Admin Record Not Updated');  
        }

        return redirect()->to('superadmin/admin_user_list');
    }
}

    public function create_account() 
    {
        $validation = \Config\Services::validation();
        $validation->setRule('new_username', 'New Username', 'required|trim|is_unique[super_admins.username]');
        $validation->setRule('new_password', 'New Password', 'required');
    
        if ($validation->withRequest($this->request)->run() === FALSE) {
            return $this->dashboard();
        } else {
            $new_username = $this->request->getPost('new_username');
            $new_password = password_hash($this->request->getPost('new_password'), PASSWORD_BCRYPT);
    
            $data = [
                'username' => $new_username,
                'password' => $new_password,
                'role'     => 'user'
            ];           
    
            $this->SuperAdmin_model->create_user_account($data);
            return redirect()->to('superadmin/user_dashboard');
        }
    }

    public function login_as($admin_id)
    {
        $admin = $this->SuperAdminModel->get_admin_by_id($admin_id);
        if ($admin) {
            $this->session->set('admin', $admin);

            // Redirect to the Admin dashboard
            return redirect()->to('admin/dashboard');
        } else {
            // Handle error if the admin account is not found
            return redirect()->to('superadmin/dashboard');
        }
    }
  public function login_as_user($user_id) 
    {
        $user = $this->SuperAdminModel->get_user_by_id($user_id);

        if ($user) {
            $this->session->set('user', $user);
            return redirect()->to('user/home');
        } else {
            return redirect()->to('superadmin/dashboard');
        }
    }
    public function admin_history()
{
    $perPage = 10; // Number of records per page
    $page = $this->request->getVar('page') ?? 1; // Get the current page or default to 1
    $offset = ($page - 1) * $perPage;

    $SuperAdminModel = new SuperAdmin_model();

    // Get paginated history data
    $data['history'] = $SuperAdminModel->get_admin_history($perPage, $offset);

    // Get the total number of records for pagination
    $total = $SuperAdminModel->count_all_admin_history();

    // Create pagination links
    $pager = \Config\Services::pager();
    $pager->makeLinks($page, $perPage, $total);

    $data['pager'] = $pager;

    echo view('templates/header', $data);
    echo view('templates/sidebar', $data);
    echo view('super_admin/admin_history', $data);
    echo view('templates/footer');
}

    public function user_history()
{
    $perPage = 5;
    $page = $this->request->getVar('page') ?? 1; 
    $offset = ($page - 1) * $perPage;

    $SuperAdminModel = new SuperAdmin_model();

    $data['history'] = $SuperAdminModel->get_user_history($perPage, $offset);

    $total = $SuperAdminModel->count_all_user_history();

    $pager = \Config\Services::pager();
    $pager->makeLinks($page, $perPage, $total);

    $data['pager'] = $pager;

    echo view('templates/header', $data);
    echo view('templates/sidebar', $data);
    echo view('super_admin/user_history', $data);
    echo view('templates/footer');
}

    public function setting()
    {
        $data['setting'] = $this->SuperAdmin_model->get_user_setting();

        return view('super_admin/setting', $data);
    }
    public function change_passwordd()
    {
    $userRole = $this->session->get('role');

    if ($userRole !== 'super-admin') {
        return redirect()->to('superadmin/index')->with('error', 'You do not have the authority to change the password.');
    }
    echo view('templates/header');
    echo view('templates/sidebar');
    return view('super_admin/change_password');
    echo view('templates/footer');
    }
    public function change_password()
    {
    $userRole = $this->session->get('role');

    if ($userRole !== 'super-admin') {
        return redirect()->to('superadmin/index')->with('error', 'You do not have the authority to change the password.');
    }
    echo view('templates/header');
    echo view('templates/sidebar');
    return view('super_admin/password');
    echo view('templates/footer');
    }
public function updatePassword()
{
    // Get user ID from session
    $userId = $this->session->get('user_id');

    // Fetch user input for password update
    $currentPassword = $this->request->getPost('current_password');
    $newPassword = $this->request->getPost('new_password');
    $confirmPassword = $this->request->getPost('confirm_password');

    // Validate that the new password and confirmation match
    if ($newPassword !== $confirmPassword) {
        return redirect()->back()->with('error', 'New password and confirm password do not match.');
    }

    // Load the login model
    $loginModel = new \App\Models\Login_model();

    // Retrieve the current user data
    $user = $loginModel->getUserById($userId);

    // Ensure the user exists
    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    // Verify the current password with MD5
    if (md5($currentPassword) !== $user->password) { 
        return redirect()->back()->with('error', 'The current password is incorrect.');
    }

    // Hash the new password with MD5
    $hashedNewPassword = md5($newPassword);

    // Update the password in the database
    $isUpdated = $loginModel->updatePassword($userId, $hashedNewPassword);

    if ($isUpdated) {
        return redirect()->route('superadmin/index')->with('success', 'Password updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to update password.');
    }
}


    public function set_time()
    {
    echo view('templates/header');
    echo view('templates/sidebar');
    echo view('super_admin/set_time');
    echo view('templates/footer');
    }



//  public function saveIndices()
//     {
//         $request = $this->request;

//         // Get the posted data
//         $low = $request->getPost('low');
//         $intermediate = $request->getPost('intermediate');
//         $high = $request->getPost('high');
//         $jackpot = $request->getPost('jackpot');
//         $nextField = $request->getPost('nextField');
// // print_r($request->getPost());exit;

//         $indices = [];
//         switch ($request->getPost('scenario')) {
//             case 'low':
//                 $indices = $request->getPost('bottomFourIndices');
//                 break;
//             case 'intermediate':
//                 $indices = $request->getPost('intermediateIndices');
//                 break;
//             case 'high':
//                 $indices = $request->getPost('topThreeIndices');
//                 break;
//             case 'next':
//                 $indices = $request->getPost('nextIndices');
//                 break;
//             default:
//                 // Handle invalid scenario
//                 break;
//         }

//         // Instantiate the NumbersModel
//         $numbersModel = new NumbersModel();

//         // Fetch the existing data
//         $existingData = $numbersModel->find(1); // Assuming you have only one row

//         // Update the corresponding field with the comma-separated indices
//         $existingData[$request->getPost('scenario')] = implode(',', $indices);

//         // Update other fields
//         $existingData['low'] = $low;
//         $existingData['intermediate'] = $intermediate;
//         $existingData['jackpot'] = $jackpot;
//         $existingData['next'] = $nextField;

//         // Save the updated data
//         $numbersModel->update(1, $existingData);

//         // Return a JSON response
//         return redirect()->to('superadmin/index');

//         // return $this->response->setJSON(['success' => true]);
//     }
    
public function saveIndices()
{
      $post_request = \Config\Services::request();
   // $scenario = $this->request->getPost('scenario');
   // $indices = $this->request->getPost('indices');
   //$post = $this->request->getPost();
   //$topThreeIndices = $post["topThreeIndices"]; 
   //$ids = implode(",",$topThreeIndices);
   print_r($_REQUEST); die();
   echo '<pre>';print_r($post_request);echo '</pre>';die();
    $lowNumbers = []; // Initialize an empty array to store low numbers

    switch ($scenario) {
        case 'low':
            $lowNumbers = $indices;
            $low = implode(',', $indices);
            break;

        default:
            break;
    }

    // Print the array of low numbers
    
    die();

    return $this->response->setJSON(['success' => true]);
}

// public function show_24_hour_result($lastTenResults)
//     {
//     $perPage = 10; // Number of records per page
//     $page = $this->request->getVar('page') ?? 1; // Get the current page or default to 1
//     $offset = ($page - 1) * $perPage;
    
//     $lastTenResults = json_decode($lastTenResults, true);
//     $data['result'] = $lastTenResults;
    
//     // Get the total number of records for pagination
//     // $total = count($data['result']);
//      $spinnerModel = new SpinnerStoppedNumber();
//     $total = $spinnerModel->count_all_history();
    
//     // Create pagination links
//     $pager = \Config\Services::pager();
//     $pager->makeLinks($page, $perPage, $total);

//     $data['pager'] = $pager;

//     echo view('templates/header', @$data);
//     echo view('templates/sidebar', @$data);
//     echo view('super_admin/show_24_hour_result', $data);
//     echo view('templates/footer',@$data);         
//     }    
public function show_24_hour_result()
    {
         $spinnerModel = new SpinnerStoppedNumber();
         $Results = $spinnerModel->get_24_hour_result_ss();
        // Decode JSON string to array
        // $lastTenResults = json_decode(urldecode($lastTenResults), true);

        // Initialize data array
        $data = [];

        // Pass results to data array
       // $data['results'] = $lastTenResults;
        // print_r($data['result']); die();

        // Pagination setup
        $perPage = 50; // Number of records per page
        $page = $this->request->getVar('page') ?? 1; // Get the current page or default to 1
        $offset = ($page - 1) * $perPage;

        // Fetch sorted data from database
        $sortedData = $spinnerModel->get_24_hour_result_s($perPage, $offset);
        
        
/*$sortedData = $spinnerModel->orderBy('created_datetime', 'DESC')
                           ->findAll($perPage, $offset);
*/
// Convert 'created_datetime' to 12-hour format for display
/*foreach ($sortedData as &$record) {
    $record['created_datetime'] = date('Y-m-d h:i:s A', strtotime($record['created_datetime']));
}*/

// Print the updated data
//print_r($record);
        // Get total number of records for pagination
         $total = count($Results); // Adjust this based on your total record count logic

        // Create pagination links
        $pager = \Config\Services::pager();
        $pager->makeLinks($page, $perPage, $total);

        // Pass sorted data and pager to view
        $data['result'] = $sortedData;
        $data['pager'] = $pager;

        // Load views
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('super_admin/show_24_hour_result', $data);
        echo view('templates/footer', $data);
    }
    
    
}
