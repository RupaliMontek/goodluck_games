<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NumbersModel;
use App\Models\CountdownModel;
use App\Models\CountdownModelNew;
use App\Models\Admin_model;
use App\Models\SuperAdmin_model;
use App\Models\UserModel;
use App\Models\BetModel;
use App\Models\SpinnerStoppedNumber;
use App\Models\ScoreModel;
use App\Models\NumberModel;
use App\Models\SA_BalanceModel;
use App\Models\ThemeModel;
use App\Models\Countdown_timer;
use App\Models\Notification_model;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use CodeIgniter\I18n\Time;
use Config\Services;
class User extends Controller 
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
        $this->SA_BalanceModel = new SA_BalanceModel();
        $db = \Config\Database::connect();
           // Initialize the request service
        $this->request = \Config\Services::request();
        date_default_timezone_set('Asia/Kolkata');
         // Check if the user is logged in by checking the user ID or any session identifier
        if (!$this->session->get('user_id')) {
            // If session ID is empty, redirect to the login page
            redirect('login');
           return;
        }

    }
    
    public function login() {
    return redirect()->to('login');
}
public function save_bet_23_july_2024()
{
    $request = \Config\Services::request();

    // Log received POST data
    log_message('info', 'POST data: ' . json_encode($request->getPost()));

    $user_id = $_SESSION['user_id'];
    $numberIndex = $request->getPost('number');
    $newValue = $request->getPost('newValue');
    $updatedMainScore = $request->getPost('updatedMainScore');

    $betModel = new \App\Models\BetModel();

    // Current timestamp truncated to minute
    $currentTime = date('Y-m-d H:i:00');

    // Prepare data for saving/updating
    $data = [
        'user_id' => $user_id,
        "number$numberIndex" => $newValue,
        'value' => $newValue,
        'created_at' => $currentTime,
        'updated_at' => date('Y-m-d H:i:s')
    ];

    try {
        // Check if a bet already exists for the user within the same minute
        $existingBet = $betModel->where('user_id', $user_id)->where('created_at', $currentTime)->first();

        if ($existingBet) {
            // Update existing bet
            log_message('info', 'Updating bet for user_id: ' . $user_id . ' with data: ' . json_encode($data));
            $betModel->update($existingBet['id'], $data);
        } else {
            // Insert new bet
            log_message('info', 'Inserting new bet for user_id: ' . $user_id . ' with data: ' . json_encode($data));
            $betModel->insert($data);
        }

        // Optionally update the user's main score
        if ($updatedMainScore !== null) {
            $userModel = new \App\Models\UserModel();
            $userModel->update($user_id, ['main_score' => $updatedMainScore]);
        }

        return $this->response->setJSON(['status' => 'success']);
    } catch (\Exception $e) {
        // Log the exception
        log_message('error', 'Error saving/updating bet: ' . $e->getMessage());
        return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
public function getGlobalSpinResult() {
    $currentMinute = date('Y-m-d H:i'); // Current minute
   // $mode_set = $this->input->get('mode_set'); // Get mode_set from the request
$SpinnerModel= new \App\Models\SpinnerModel();
    // Start a database transaction to prevent race conditions
    $this->db->trans_start();
    $db = \Config\Database::connect();
    $model = new NumbersModel();
    $mode = $model->getMode();//print_r($mode);exit;
    $values = $model->getValuesBasedOnMode($mode);
      // Get the last executed query
    $lastQuery = $db->getLastQuery();
   // echo json_encode(array('values' => $values,'mode'=>$mode));
    // Check if a spin result exists for the current minute and mode_set
    $spinResult = $SpinnerModel->getSpinResultByTimeAndMode($currentMinute, $mode);

    if (!$spinResult) {
        // Generate a new number if no spin result exists for this time window
        $main_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        $remainingNumbers = $SpinnerModel->getRemainingNumbers($mode); // Get unused numbers for the specific mode_set

        if (!empty($remainingNumbers)) {
            $randomIndex = array_rand($remainingNumbers);
            $targetValue = $remainingNumbers[$randomIndex];
        } else {
            $targetValue = 0; // Default fallback
        }

        // Save the new result into the `spinnerStoppedNumber` table
       $SpinnerModel->saveSpinResult($targetValue, $currentMinute, $mode);

        // Ensure this new value is committed and not overwritten by other requests
        $this->db->trans_complete();
    } else {
        // Reuse the existing spin result
        $targetValue = $spinResult->numbers;
    }

    // Send the same result to all users for the current minute and mode_set
    echo json_encode(['targetValue' => $targetValue, 'time' => $currentMinute,'values' => $values,'mode'=>$mode]);
}


public function save_bet()
{
    $request = \Config\Services::request();

    $user_id = $_SESSION['user_id'];
    $numberIndex = $request->getPost('number');
    $newValue = $request->getPost('newValue');
    $updatedMainScore = $request->getPost('updatedMainScore');

    $betModel = new \App\Models\BetModel();

    // Prepare data for saving/updating
    $data = [
        'user_id' => $user_id,
        "number$numberIndex" => $newValue,
        'value' => $newValue,
        'updated_at' => date('Y-m-d H:i:s')
    ];

    // Get the current time to check within the same minute
    $currentMinute = date('Y-m-d H:i:00');

    try {
        // Check if there's an existing bet in the same minute
        $existingBet = $betModel->where('user_id', $user_id)
                                ->where('created_at >=', $currentMinute)
                                ->first();

        if ($existingBet) {
            // Update existing bet
            $betModel->update($existingBet['id'], $data);
        } else {
            // Insert new bet
            $data['created_at'] = date('Y-m-d H:i:s');
            $betModel->insert($data);
        }

        // Track the pending bet in the session
        if (!isset($_SESSION['pending_bets'])) {
            $_SESSION['pending_bets'] = [];
        }
        $_SESSION['pending_bets'][] = [
            'user_id' => $user_id,
            'numberIndex' => $numberIndex,
            'newValue' => $newValue,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        // Optionally update the user's main score
        if ($updatedMainScore !== null) {
            $userModel = new \App\Models\UserModel();
            $userModel->update($user_id, ['main_score' => $updatedMainScore]);
        }

        return $this->response->setJSON(['status' => 'success']);
    } catch (\Exception $e) {
        // Log the exception
        log_message('error', 'Error saving/updating bet: ' . $e->getMessage());
        return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

/*public function save_bet()
    {
        $request = \Config\Services::request();

        $number = $request->getPost('number');
        $newValue = $request->getPost('newValue');
        $updatedMainScore = $request->getPost('updatedMainScore');
        $user_id = $_SESSION['user_id'];

        $betModel = new BetModel();
        $existingBet = $betModel->where('user_id', $user_id)->where('number', $number)->first();

        if ($existingBet) {
            // Update existing bet
            $betModel->update($existingBet['id'], ['value' => $newValue]);
        } else {
            // Save new bet
            $betModel->save([
                'user_id' => $user_id,
                'number' => $number,
                'value' => $newValue
            ]);
        }

        // Optionally update the user's main score in the users table
        $userModel = new \App\Models\UserModel();
        $userModel->update($user_id, ['main_score' => $updatedMainScore]);

        return $this->response->setJSON(['status' => 'success']);
    }*/

public function user_history() 
{
    $player_id  = $_SESSION["user_id"];
    $model = new SuperAdmin_model();
    $models = new ScoreModel();
    // Pagination configuration
    $perPage = 10; // Number of records per page
    $page = $this->request->getVar('page') ?: 1;
    $data["current_wallet"] = $model->get_balance_amount(); 
    $data["players_list"] = $this->SuperAdminModel->get_player_users_list();
    $total = $models->count_all_scores_by_player($player_id);
    $offset = ($page - 1) * $perPage;
    $data["players_details"] = $models->get_all_scores_details_by_playerss($player_id, $perPage, $offset);
    $lastQuery = $models->getLastQuery(); 
    $pager = \Config\Services::pager();
    $data["pager_links"] = $pager->makeLinks($page, $perPage, $total);
    echo view("templates/new_user_header", $data);
    echo view('user/user_history', $data);
    echo view("templates/footer");
}
public function save_temp_data()
{
    $request = \Config\Services::request();
    $user_id = $_SESSION['user_id'];

    $data = [
        'number1' => $request->getPost('number1'),
        'number2' => $request->getPost('number2'),
        'number3' => $request->getPost('number3'),
        'number4' => $request->getPost('number4'),
        'number5' => $request->getPost('number5'),
        'number6' => $request->getPost('number6'),
        'number7' => $request->getPost('number7'),
        'number8' => $request->getPost('number8'),
        'number9' => $request->getPost('number9'),
        'number0' => $request->getPost('number0'),
        'winnerValue' => $request->getPost('winnerValue'),
        'win_before_score' => $request->getPost('oldScore'),
        'win_before_after_score' => $request->getPost('newScore'),
        'win_val' => $request->getPost('win_val'),
        'increment_number' => $request->getPost('increment_number'),
        'total_number_play' => $request->getPost('total_number_play'),
        'winner_number' => $request->getPost('winner_number')
    ];

    // Adjust the user's balance based on the data
    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($user_id);
    $main_score = $user['win_before_score'];

    // Add logic here to update the user's balance based on the bet data
    // Example: Deduct or add the `win_before_after_score` to/from the `main_score`
    $main_score += $data['win_before_after_score']; // Adjust based on your logic

    // Update the user's main score in the database
    $userModel->update($user_id, ['win_before_score' => $main_score]);

    // Optionally, you can save the bet details to a temporary table or log them

    return $this->response->setJSON(['status' => 'success']);
}
public function getPreviousBetData()
    {
        $user_id  = $_SESSION["user_id"];
        $model = new ScoreModel();
        $data = $model->getPreviousBet($user_id);
// print_r($data); die();
        return $this->response->setJSON($data);
    }

public function save_playing_no_details()
{
    $player_id  = $_SESSION["user_id"];
    $post = $this->request->getPost();
    $number_0  = $post["number_0"];
    $number_1  = $post["number_1"];
    $number_2  = $post["number_2"];
    $number_3  = $post["number_3"];
    $number_4  = $post["number_4"];
    $number_5  = $post["number_5"];
    $number_6  = $post["number_6"];
    $number_7  = $post["number_7"];
    $number_8  = $post["number_8"];
    $number_9  = $post["number_9"];
    
    $data = array
    (
        "player_id"         =>   @$player_id,
        "button_0_value"    =>   @$number_0,
        "button_1_value"    =>   @$number_1,
        "button_2_value"    =>   @$number_2,
        "button_3_value"    =>   @$number_3,
        "button_4_value"    =>   @$number_4,
        "button_5_value"    =>   @$number_5,
        "button_6_value"    =>   @$number_6,
        "button_7_value"    =>   @$number_7,
        "button_8_value"    =>   @$number_8,
        "button_9_value"    =>   @$number_9,
        "created_at"        =>   date("Y-m-d h:i:s"),
        "total"             =>   (@$number_0+@$number_1+@$number_2+@$number_3+@$number_4+@$number_5+@$number_6+@$number_7+@$number_8+@$number_9)
    );
    $result = $this->SuperAdminModel->save_playing_no_details($data);
    // print_r($result); exit;
}

public function home_duplicate_theme()
{ 
    $user_id = @$_SESSION["user_id"];
    $countdownModel = new CountdownModel();
    // Check if the countdown has already started
    $start_time_row = $countdownModel->select('start_time')->first();
    $start_time = isset($start_time_row['start_time']) ? $start_time_row['start_time'] : 0;
    $elapsed_time = time() - $start_time;
    $remaining_time = 60 - $elapsed_time;
    $model = new Admin_model();
    $user_current_amounts = $model->get_user_current_amounts();
    $is_last_10_seconds = ($remaining_time > 0 && $remaining_time <= 10);
    // Prepare data for the view
    $data = ['user_current_amounts' => $user_current_amounts,'remaining_time' => $remaining_time, 'is_last_10_seconds' => $is_last_10_seconds
    ];
    $model = new SpinnerStoppedNumber();
    $data['last_ten_results'] = $model->getLastTenResults($user_id);
    $data['last_results'] = $model->getLastResults();
    // Load the view with the data
    return view('user/home_duplicate_theme', $data);
}
    public function home() 
    {
        $user_id = @$_SESSION["user_id"];
       $countdownModel = new CountdownModel();
       // Check if the countdown has already started
       $start_time_row = $countdownModel->select('start_time')->first();
       $start_time = isset($start_time_row['start_time']) ? $start_time_row['start_time'] : 0;
       $elapsed_time = time() - $start_time;
       $remaining_time = 120 - $elapsed_time;
       $model = new Admin_model();
       $user_current_amounts = $model->get_user_current_amounts();
       // Prepare data for the view
       $data = ['user_current_amounts' => $user_current_amounts,'remaining_time' => $remaining_time];
       $model = new SpinnerStoppedNumber();
       $data['last_ten_results'] = $model->getLastTenResults($user_id);
       $data['last_results'] = $model->getLastResults();
       /*$model = new SpinnerStoppedNumber();
       $data['last_ten_results'] = $model->getLastTenResults();
       $data['last_results'] = $model->getLastResults();*/
       return view('user/home',$data);
    }
    
    public function update_wallet_amount()
    {
        $post         = $this->input->post();
        $oldScore     = $post["oldScore"];
        $winnerValue  = $post["winnerValue"];
        $newScore     = $post["newScore"];
        
        
    }
    
    public function save()
    {  
            $db = \Config\Database::connect();
            $user_id  = $_SESSION["user_id"];
            // Instantiate the model to interact with the database
            $model = new ScoreModel();
            $SuperAdmin_model = new SuperAdmin_model();
            $datas = $this->SuperAdmin_model->get_admin_by_id_super_admin($user_id);
            $request = service('request');
            $post = $this->request->getPost();
            $increment_number = $post["increment_number"];
            $play_on_no = $increment_number;
            $oldScore  = $post["oldScore"];
            $loss_amount = $increment_number * $request->getPost('totalamt');
            $win_val = $post["winnerValue"];
            $winner_number = $request->getPost('winner_number');
            $showNobtn_win = $request->getPost("showNobtn$winner_number");
            $loss_amount =  $request->getPost('totalamt');
            if($win_val==0)
            {
                if(!empty($datas->current_wallet))
                {
                    $win_before_score = $datas->current_wallet;
                }
                else
                {
                    $win_before_score = $datas->amout_given; 
                }
                    
                    $new_score = ($request->getPost('oldScore')+$win_val-$loss_amount);
            }
            else
            {
               
                $new_score = ($request->getPost('oldScore')+$win_val);
                $win_before_score = $request->getPost('oldScore');
            }
            $data = [
            'player_id'              => $user_id,
            'showNobtn0'             => $request->getPost('showNobtn0'),
            'showNobtn1'             => $request->getPost('showNobtn1'),
            'showNobtn2'             => $request->getPost('showNobtn2'),
            'showNobtn3'             => $request->getPost('showNobtn3'),
            'showNobtn4'             => $request->getPost('showNobtn4'),
            'showNobtn5'             => $request->getPost('showNobtn5'),
            'showNobtn6'             => $request->getPost('showNobtn6'),
            'showNobtn7'             => $request->getPost('showNobtn7'),
            'showNobtn8'             => $request->getPost('showNobtn8'),
            'showNobtn9'             => $request->getPost('showNobtn9'),
            'win_before_after_score' => $new_score,
            'win_before_score'       => $win_before_score,
            'total'                  => $request->getPost('totalamt'),
            'play_on_no'             => $play_on_no,
            'winner_number'          => $winner_number,
            'winner_amount'          => $win_val,
            'loss_amount'            => ($loss_amount),
            'created_at'             => date('Y-m-d H:i:s') // Optionally store the timestamp
            ];
             
            
            
            if(!empty($datas->current_wallet))
            {
                $current_wallet = $datas->current_wallet;
                $current_wallet = ($current_wallet + $win_val)-$loss_amount;
                $para = ['current_wallet' => $current_wallet];
                $result =  $this->SuperAdmin_model->update_admin_account_details($user_id, $para);
                //echo $lastQuery = $db->getLastQuery();
            }
            else
            {
                
                $current_wallet = $datas->amout_given;
                $current_wallet = ($current_wallet + $win_val)- $loss_amount;
                $para = ['current_wallet' => $current_wallet];
                $result =  $this->SuperAdmin_model->update_admin_account_details($user_id, $para);
            }
            
            $user_details = $SuperAdmin_model->get_admin_account_details(1);
            $update_value_superadmin = ($user_details["current_wallet"]+(@$loss_amount)-(@$win_val));
            $paras =   array
            (
                "current_wallet" =>  $update_value_superadmin
            );
            $result = $this->SuperAdmin_model->update_admin_account_details(1, $paras);
            $model->insert($data);
            echo 1;
        
    }
       public function save_new() 
    {
        $authHeader = $this->request->getHeader('Authorization');
        if (!$authHeader) {
            return $this->response->setStatusCode(401)->setBody('Unauthorized');
        }

        $token = str_replace('Bearer ', '', $authHeader->getValue());

        try {
            $decoded = JWT::decode($token, new Key('your-secret-key', 'HS256'));
            $user_id = $decoded->userId;

            $db = \Config\Database::connect();
            $model = new ScoreModel();
            $SuperAdmin_model = new SuperAdmin_model();
            $datas = $SuperAdmin_model->get_admin_by_id_super_admin($user_id);
            $request = service('request');
            $post = $this->request->getPost();
            $increment_number = $post["increment_number"];
            $oldScore = $post["oldScore"];
            $loss_amount = $increment_number * $request->getPost('totalamt');
            $win_val = $post["winnerValue"];

            if ($win_val == 0) {
                if (!empty($datas->current_wallet)) {
                    $win_before_score = $datas->current_wallet;
                } else {
                    $win_before_score = $datas->amout_given;
                }
                $new_score = ($oldScore + $win_val);
            } else {
                $new_score = ($oldScore + $win_val);
                $win_before_score = $oldScore;
            }

            $loss_amount = $increment_number * $request->getPost('totalamt');
            $data = [
                'player_id'              => $user_id,
                'showNobtn0'             => $request->getPost('showNobtn0'),
                'showNobtn1'             => $request->getPost('showNobtn1'),
                'showNobtn2'             => $request->getPost('showNobtn2'),
                'showNobtn3'             => $request->getPost('showNobtn3'),
                'showNobtn4'             => $request->getPost('showNobtn4'),
                'showNobtn5'             => $request->getPost('showNobtn5'),
                'showNobtn6'             => $request->getPost('showNobtn6'),
                'showNobtn7'             => $request->getPost('showNobtn7'),
                'showNobtn8'             => $request->getPost('showNobtn8'),
                'showNobtn9'             => $request->getPost('showNobtn9'),
                'win_before_after_score' => $new_score,
                'win_before_score'       => $win_before_score,
                'total'                  => $request->getPost('totalamt'),
                'winner_number'          => $request->getPost('winner_number'),
                'winner_amount'          => $win_val,
                'loss_amount'            => $loss_amount,
                'created_at'             => date('Y-m-d H:i:s')
            ];

            if (!empty($datas->current_wallet)) {
                $current_wallet = $datas->current_wallet;
                $current_wallet = ($current_wallet + $win_val) - $loss_amount;
                $para = ['current_wallet' => $current_wallet];
                $result = $SuperAdmin_model->update_admin_account_details($user_id, $para);
                $lastQuery = $db->getLastQuery();
            } else {
                $current_wallet = $datas->amout_given;
                $current_wallet = ($current_wallet + $win_val) - $loss_amount;
                $para = ['current_wallet' => $current_wallet];
                $result = $SuperAdmin_model->update_admin_account_details($user_id, $para);
            }

            $user_details = $SuperAdmin_model->get_admin_account_details(1);
            $update_value_superadmin = ($user_details["current_wallet"] + $loss_amount - $win_val);
            $paras = ["current_wallet" => $update_value_superadmin];
            $result = $SuperAdmin_model->update_admin_account_details(1, $paras);
            $model->insert($data);

            return $this->response->setJSON(['success' => true]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(401)->setBody('Unauthorized');
        }
    }
 public function my_old() 
 {
     $user_id = @$_SESSION["user_id"];
    $countdownModel = new CountdownModel();
    // Check if the countdown has already started
    $start_time_row = $countdownModel->select('start_time')->first();
    $start_time = isset($start_time_row['start_time']) ? $start_time_row['start_time'] : 0;
    $elapsed_time = time() - $start_time;
    $remaining_time = 60 - $elapsed_time;
    $model = new Admin_model();
    $user_current_amounts = $model->get_user_current_amounts();
    $is_last_10_seconds = ($remaining_time > 0 && $remaining_time <= 10);
    // Prepare data for the view
    $data = ['user_current_amounts' => $user_current_amounts,'remaining_time' => $remaining_time, 'is_last_10_seconds' => $is_last_10_seconds
    ];
    $model = new SpinnerStoppedNumber();
    $data['last_ten_results'] = $model->getLastTenResults($user_id);
    $data['last_results'] = $model->getLastResults();
    // Load the view with the data
    $themeModel = new ThemeModel();
    $theme = $themeModel->getTheme(); // Example session usage
    $data['theme']=$theme['name'];
    //    print_r($data);exit;
    return view('user/home_duplicate', $data); 
}

public function my()
{
    $user_id = @$_SESSION["user_id"];
    
    $countdownModel = new CountdownModelNew();
    $model = new Admin_model();
    $spinnerModel = new SpinnerStoppedNumber();
    $themeModel = new ThemeModel();

    // Fetch the start time from the database
    $start_time_row = $countdownModel->select('selected_time')->first();
    $start_time = isset($start_time_row['selected_time']) ? $start_time_row['selected_time'] : 0;

    // Calculate elapsed and remaining time
    $current_time = time();
    $elapsed_time = $current_time - $start_time;
    $remaining_time = $start_time - $elapsed_time;

    // Check if the countdown has reached 0 and reset if necessary
   /* if ($remaining_time <= 0) {
        $start_time = $current_time;
        $countdownModel->update(1, ['selected_time' => $start_time]);
        $remaining_time = $start_time;
    }
*/
    // Determine if it's the last 10 seconds
    $is_last_10_seconds = ($remaining_time > 0 && $remaining_time <= 10);

    // Fetch user current amounts
    $user_current_amounts = $model->get_user_current_amounts();

    // Fetch the last ten results and the last result
    $last_ten_results = $spinnerModel->getLastTenResults($user_id);
    $last_results = $spinnerModel->getLastResults();

    // Fetch the current theme
    $theme = $themeModel->getTheme();
    $theme_name = $theme['name'];

    // Prepare data for the view
    $data = [
        'user_current_amounts' => $user_current_amounts,
        'remaining_time' => $remaining_time,
        'is_last_10_seconds' => $is_last_10_seconds,
        'last_ten_results' => $last_ten_results,
        'last_results' => $last_results,
        'theme' => $theme_name,
    ];

    return view('user/home_main_duplicate', $data);
}

public function mys() 
{
    $user_id = @$_SESSION["user_id"];
    
    $countdownModel = new CountdownModel();
    // Check if the countdown has already started
    $start_time_row = $countdownModel->select('start_time')->first();
    $start_time = isset($start_time_row['start_time']) ? $start_time_row['start_time'] : 0;
    $elapsed_time = time() - $start_time;
    $remaining_time = 60 - $elapsed_time;
    $model = new Admin_model();
    $user_current_amounts = $model->get_user_current_amounts();
    // Prepare data for the view
    $data = [
        'user_current_amounts' => $user_current_amounts,
        'remaining_time' => $remaining_time, // Pass remaining time to the view
    ];
    $model = new SpinnerStoppedNumber();
    $data['last_ten_results'] = $model->getLastTenResults($user_id);
    $data['last_results'] = $model->getLastResults();
    // Load the view with the data
     $themeModel = new ThemeModel();
        $theme = $themeModel->getTheme(); // Example session usage
 $data['theme']=$theme['name'];
    return view('user/home_duplicate_jaywant', $data);
}
public function myR() 
{
    $user_id = @$_SESSION["user_id"];
    $countdownModel = new CountdownModel();
    // Check if the countdown has already started
    $start_time_row = $countdownModel->select('start_time')->first();
    $start_time = isset($start_time_row['start_time']) ? $start_time_row['start_time'] : 0;
    $elapsed_time = time() - $start_time;
    $remaining_time = 60 - $elapsed_time;
    $model = new Admin_model();
    $user_current_amounts = $model->get_user_current_amounts();
    // Prepare data for the view
    $data = [
        'user_current_amounts' => $user_current_amounts,
        'remaining_time' => $remaining_time, // Pass remaining time to the view
    ];
    $model = new SpinnerStoppedNumber();
    $data['last_ten_results'] = $model->getLastTenResults($user_id);
    $data['last_results'] = $model->getLastResults();
    // Load the view with the data
      // Load the view with the data
     $themeModel = new ThemeModel();
        $theme = $themeModel->getTheme(); // Example session usage
 $data['theme']=$theme['name'];
    return view('user/home_duplicate_rupali', $data);
}
// public function get_last_10_result_win_numbers()
// {
//   $model = new SpinnerStoppedNumber();
//   $data = $model->getLastTenResults(); 
//   $json_data = json_encode($data);
//   return $json_data;
// }
public function get_last_10_result_win_numbers()
{
    $model = new SpinnerStoppedNumber();
    $data = $model->getLastTenResults(session()->get('user_id')); // Ensure user_id is fetched
   //$data = $model->getLastTenResults();  // Ensure user_id is fetched
    return $this->response->setJSON($data); // Correct way to return JSON
}


public function get_user_balance_amount()
{
    $user_id  = $_SESSION["user_id"];
    $data = $this->SuperAdmin_model->get_admin_by_id_super_admin($user_id);
    $json_data = json_encode($data);
    return $json_data;
}

    public function home_spinner()
    {
        return view('user/home_spinner');
    }
    
    public function start_spinner() {
    echo json_encode(['success' => true]);
}

public function spinner_jaywant()
{
      $user_id = @$_SESSION["user_id"];
    $model = new Admin_model();
    if(!empty($user_id))
    {
        $user_details = $this->Admin_model->get_admin_user_details($user_id);
        $player_name  = $user_details->first_name." ".$user_details->last_name;
    }
    $Countdown_timer = new CountdownModelNew();
    $spinnerModel = new SpinnerStoppedNumber();
    $themeModel = new ThemeModel();
    // Fetch the start time from the database
    $start_time_row = $Countdown_timer->select('selected_time')->first();
    $start_time = isset($start_time_row['selected_time']) ? $start_time_row['selected_time'] : 0;
    // Calculate elapsed and remaining time
    $current_time = time();
    $elapsed_time = $current_time - $start_time;
    $remaining_time = $start_time - $elapsed_time;
    // Check if the countdown has reached 0 and reset if necessary
   /* if ($remaining_time <= 0) {
        $start_time = $current_time;
        $countdownModel->update(1, ['selected_time' => $start_time]);
        $remaining_time = $start_time;
    }
*/
    // Determine if it's the last 10 seconds
    $is_last_10_seconds = ($remaining_time > 0 && $remaining_time <= 10);
    // Fetch user current amounts
    $user_current_amounts = $model->get_user_current_amounts();
    
    if(!empty($user_details->current_wallet))
    {
        $wallet_amount = $user_details->current_wallet;
    }
    else
    {
        $wallet_amount =  $user_details->amout_given;
    }
    
    // Fetch the last ten results and the last result
    $last_ten_results = $spinnerModel->getLastTenResults($user_id);
    $last_results = $spinnerModel->getLastResults();
    // Fetch the current theme
    $theme = $themeModel->getTheme();
    $theme_name = $theme['name'];
    // Prepare data for the view
    $data = [
        'username'             => $player_name,
        'user_current_amounts' => $user_current_amounts,
        'remaining_time'       => $remaining_time,
        'is_last_10_seconds'   => $is_last_10_seconds,
        'last_ten_results'     => $last_ten_results,
        'last_results'         => $last_results,
        'theme'                => $theme_name,
        'wallet_amount'        => $wallet_amount,
    ];
    //return view('user/xyz', $data);
     return view('user/spinner_jay', $data);
}
    

public function score_amount()
{
    $data['users'] = $this->SuperAdmin_model->get_all_users();
}

public function spin()
    {
        // Generate a random number (1 to 10 in this example)
        $randomNumber = rand(1, 10);

        // Return the random number as JSON
        echo json_encode(array('number' => $randomNumber));
    }

public function getNumberFromDatabase()
    {
        $numberModel = new NumbersModel();
        $number = $numberModel->first(); 
        if ($number) 
        {
            $mode = $number["mode"];
            if($mode)
            {
              $numbers =  $number[$mode];
            }
            return $this->response->setJSON(['number' => $number]);
        } 
        else
        {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Number not found']);
        }
    }
/*public function getNumbersBasedOnMode()
{
     $db = \Config\Database::connect();
    $model = new NumbersModel();
    $mode = $model->getMode();//print_r($mode);exit;
    $values = $model->getValuesBasedOnMode($mode);
      // Get the last executed query
    $lastQuery = $db->getLastQuery();
    echo json_encode(array('values' => $values,'mode'=>$mode));

}*/
// public function spinnerStoppedNumber()
// {
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $stoppedNumber = $_POST['stoppedNumber'];

//         $model = new NumbersModel();
//         $model->spinnerStoppedNumber($stoppedNumber);

//         echo json_encode(['success' => true]);
//     } else {
//         echo json_encode(['error' => 'Invalid request method']);
//     }
// }

/*public function saveStoppedNumber()
    {
        $user_id  = $_SESSION["user_id"];
        $numbers = $this->request->getPost('stoppedNumber');
        // print_r($numbers);exit;
        //$user_id = $this->request->getPost('user_id');
        $spinnerStoppedNumberModel = new SpinnerStoppedNumber();
        $mode_set = $this->request->getPost('mode_set');
        $now = Time::now();
        $result = $spinnerStoppedNumberModel->saveStoppedNumber_new($user_id,$numbers,$mode_set,$now);
        echo 1; 
    } */
  public function getNumbersBasedOnMode() {
        
          $db = \Config\Database::connect();
    $model = new NumbersModel();
    $mode = $model->getMode();//print_r($mode);exit;
    $values = $model->getValuesBasedOnMode($mode);
         $spinnerStoppedNumberModel = new SpinnerStoppedNumber();
    // Fetch the current mode and saved numbers from the database
     $mode_set =$mode; // Example: could be passed as a parameterecho
    $savedNumbers = $spinnerStoppedNumberModel->getSavedNumbers(); // Fetch saved numbers
      $user_id  = $_SESSION["user_id"];
       // $numbers = $this->request->getPost('stoppedNumber');
    // Define main values and calculate target value
    $main_values = range(0, 9);
    $remainingNumbers = array_diff($main_values, $savedNumbers);

    // Logic to determine targetValue
    if ($mode_set !== 'jackpot_2x' && $mode_set !== 'jackpot') {
        if (empty($remainingNumbers)) {
            // Handle case where no remaining numbers are available
            echo json_encode(['status' => 'error', 'message' => 'No remaining numbers available']);
            return;
        }
        $targetValue = $remainingNumbers[array_rand($remainingNumbers)]; // Random from remaining
    } else {
        // Logic for jackpot mode or similar
        $targetValue = 7; // Example fixed value for demonstration
    }

    // Return the response
    echo json_encode([
        'values' => implode(',', $savedNumbers),
        'mode' => $mode_set,
        'targetValue' => $targetValue
    ]);
}
/*public function saveStoppedNumber() {
    $stoppedNumber = $this->input->post('stoppedNumber');
    $mode_set = $this->input->post('mode_set');

    // Your logic to save the stopped number in the database
    $result = $this->your_model->saveNumber($stoppedNumber, $mode_set);

    if ($result) {
        echo json_encode(['success' => true, 'value' => $stoppedNumber]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save number']);
    }
}
*/
public function saveStoppedNumber() {
    $user_id = $this->request->getPost('user_id');
    $mode_set = $this->request->getPost('mode_set');
    $remainingNumbers = $this->request->getPost('remainingNumbers');
    $target_value = $this->request->getPost('target_value');

    // Log received data
    log_message('info', "User ID: $user_id, Mode Set: $mode_set, Remaining Numbers: $remainingNumbers, Target Value: $target_value");

    // Prepare data for insert/update
    $data = [
        'user_id' => $user_id,
        'mode_set' => $mode_set,
        'numbers' => $target_value,
        'created_datetime' => date('Y-m-d H:i:s') // Current timestamp
    ];

    // Initialize model
    $spinnerStoppedNumberModel = new SpinnerStoppedNumber();

    // Format to nearest minute for duplicate check
    $currentMinute = date('Y-m-d H:i:00');
    $existingEntry = $spinnerStoppedNumberModel
        ->where('user_id', $user_id)
        ->where('DATE_FORMAT(created_datetime, "%Y-%m-%d %H:%i")', $currentMinute)
        ->first();

    if ($existingEntry) {
        // Update existing entry
        $result = $spinnerStoppedNumberModel->update($existingEntry['id'], $data);
        $message = 'Entry updated for existing minute';
    } else {
        // Insert new entry
        $result = $spinnerStoppedNumberModel->insert($data);
        $message = 'New entry inserted';
    }

    if ($result) {
        return $this->response->setJSON(['success' => true, 'value' => $target_value, 'message' => $message]);
    } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Database insert/update failed']);
    }
}


private function generateRandomNumber($remainingNumbers) {
    if (empty($remainingNumbers)) {
        return null; // or handle it as you wish
    }
    return $remainingNumbers[array_rand($remainingNumbers)]; // Get a random number
}
/*public function getTargetValue() {
    $current_time = date('Y-m-d H:i:s');
    $user_id = $_SESSION["user_id"]; // Get the user ID from the session

    // Connect to the database and load the models
    $db = \Config\Database::connect();
    $model = new NumbersModel();
    $spinnerStoppedNumberModel = new SpinnerStoppedNumber();

    // Get the mode dynamically
    $mode = $model->getMode(); // Fetch the mode

    // Check for an existing target value for the current minute
    $target_value = $spinnerStoppedNumberModel->getTargetValueForCurrentMinute($current_time);
// print_r($target_value);
    if ($target_value === null) {
        // If no target value exists for the current minute, generate a random one
        $target_value = rand(0, 9); // Adjust the range as needed
    }

    // Prepare the numbers value. Ensure that it is a single value.
    // Assuming you want to save the target_value as numbers
    $numbers = $target_value; // Use the generated or fetched target value

    // Save the target value to the database, including the dynamic mode and user ID
    $spinnerStoppedNumberModel->saveTargetValue($user_id, $numbers, $mode, $current_time);

    // Create the response array
    $response = [
        'success' => true,
        'targetValue' => $target_value,
        'mode' => $mode // Return the dynamic mode
    ];

    // Return the JSON response
    return $this->response->setJSON($response);
}
*/
public function getTargetValue() {
    $current_time = date('Y-m-d H:i:00'); // Round down to the current minute
    $user_id = $_SESSION["user_id"]; // Get the user ID from the session

    // Connect to the database and load the models
    $db = \Config\Database::connect();
    $model = new NumbersModel();
    $spinnerStoppedNumberModel = new SpinnerStoppedNumber();

    // Get the mode dynamically
    $mode = $model->getMode(); // Fetch the mode

    // Check if a target value already exists for this minute
    $target_value = $spinnerStoppedNumberModel->getTargetValueForCurrentMinute($current_time);

    if ($target_value === null) {
        // If no target value exists, generate a random one within your desired range
        $target_value = rand(0, 9);

        // Save the target value to the database for the current minute
        $spinnerStoppedNumberModel->saveTargetValue($user_id, $target_value, $mode, $current_time);
    }

    // Create the response array
    $response = [
        'success' => true,
        'targetValue' => $target_value,
        'mode' => $mode // Return the dynamic mode
    ];

    // Return the JSON response
    return $this->response->setJSON($response);
}




/*public function saveStoppedNumber()
{
    try {
        $user_id = $_SESSION["user_id"];
        $numbers = $this->request->getPost('stoppedNumber');
        $mode_set = $this->request->getPost('mode_set');
        $now = Time::now();

        // Validate input
        if (empty($user_id) || empty($numbers) || empty($mode_set)) {
            throw new Exception('Invalid input data.');
        }

        $spinnerStoppedNumberModel = new SpinnerStoppedNumber();
        $result = $spinnerStoppedNumberModel->saveStoppedNumber_new($user_id, $numbers, $mode_set, $now);
        
     
        echo json_encode(['status' => 'success', 'message' => 'Number saved successfully.']);
    } catch (Exception $e) {
        log_message('error', 'Failed to save stopped number: ' . $e->getMessage());
        return $this->response->setStatusCode(500, 'Internal Server Error');
    }
}*/

public function getLastStoppedNumber()
{
    return $this->where(['user_id' => $_SESSION["user_id"]])
                ->orderBy('created_datetime', 'DESC')
                ->first();
}

public function get_numbers_spinner()
{
    $numbers = $this->SuperAdmin_model->get_player_mode_wise_numbers();
        $mode = $numbers->mode;
        if($mode=="next")
        {
            $data["numbers"] = $numbers->next; 
        }
        elseif($mode=="mediam")
        {
            $data["numbers"] = $numbers->intermediate; 
        }
        elseif($mode=="high")
        {
            $data["numbers"] = $numbers->high; 
        }
        elseif($mode=="low")
        {
            $data["numbers"] = $numbers->low; 
        }
        $data["mode"] = $mode;
        $json_data = json_encode($data);
        return $json_data;
}

public function get_as_per_mode_array_numbers_array()
{
    $numbers='';
    
    $NumbersModel = new NumbersModel();
    $lastRecord = $NumbersModel->orderBy('id', 'DESC')->first();
    if($lastRecord["mode"]=="next")
    {
      $numbers = $lastRecord["next"];
    }
    elseif($lastRecord["mode"]=="mediam")
    {
      $numbers = $lastRecord["intermediate"];
    }
    elseif($lastRecord["mode"]=="low ")
    {
      $numbers = $lastRecord["low"];
    }
    elseif($lastRecord["mode"]=="high")
    {
      $numbers = $lastRecord["high"];
    }
    elseif($lastRecord["mode"]=="jackpot")
    {
      $numbers = $lastRecord["jackpot"];
    }
    elseif($lastRecord["mode"]=="jackpot_2x")
    {
      $numbers = $lastRecord["jackpot_2x"];
    }
    
     $mode = $lastRecord["mode"];
     
     $data = array
     (
         "mode"       =>   $mode,
         "numbers"    =>   $numbers
     );
     
     $json_data = json_encode($data);
     return $json_data;
    
}
public function store_score_amount()
{   $ScoreModel = new user_model();
    $userId = $_POST['Id'];
    $scoreAmount = $_POST['scoreAmount'];
    $role = $_POST['role'];
$token = $this->input->post('token');

        // Validate the token
        $user_id = $this->user_model->validate_token($token);
    if ($role === 'user') {
        $ScoreModel = new ScoreModel();
        $scoreModel->insert(['id' => $userId, 'score_amount' => $scoreAmount]);

        $response = ['success' => true];
        echo json_encode($response);
    } else {
        $response = ['error' => 'Role is not user'];
        echo json_encode($response);
    }
}
// public function store_score_amount()
// {
//     $userId = $_POST['userId'];
//     $scoreAmount = $_POST['scoreAmount'];

//     $superAdminModel = new SuperAdminModel(); 
//     $scoreModel->insert(['user_id' => $userId, 'score_amount' => $scoreAmount]);

//     $response = ['success' => true];
//     echo json_encode($response);
// }

public function get_universal_counter_timer_all_olddd()
{
    $countdown_timer_start = new Countdown_timer();
    $start_time = $countdown_timer_start->select('start_time')->first();

    // Check if start_time is retrieved correctly
    if (!$start_time) {
        // Handle the case where start_time is not found
        // For example, default to a predefined countdown duration in seconds (e.g., 2 minutes)
        $select_start_time = 120; // Default to 2 minutes (120 seconds)
    } else {
        $select_start_time = $start_time["start_time"];
    }

    $countdownModel = new CountdownModelNew();
    $countdownDuration = $select_start_time;

    // Fetch the selected_time from CountdownModelNew
    $start_time_record = $countdownModel->select('id, selected_time')->first();
    if (!$start_time_record) {
        // If countdown has not started, set the start time
        $start_time = time();
        $countdownModel->insert(['selected_time' => $start_time]);
    } else {
        // If countdown has started, retrieve the start time
        $start_time = $start_time_record['selected_time'];
    }

    // Calculate remaining time
    $elapsed_time = time() - $start_time;
    $remaining_time = $countdownDuration - $elapsed_time;

    // If the countdown reaches 0, reset the start time
    if ($remaining_time <= 0) {
        $start_time = time();
        if (isset($start_time_record['id'])) {
            $countdownModel->update($start_time_record['id'], ['selected_time' => $start_time]);
        } else {
            $countdownModel->insert(['selected_time' => $start_time]);
        }
        $remaining_time = 0; // Set remaining time to 0 to reset display_time to 00:00

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

public function get_universal_counter_timer_all()
{
    $countdown_timer_start = new Countdown_timer();
    
    $original_time=$countdown_timer_start->get_details();
    $original_time=$original_time->start_time;
    // print_r($original_time->start_time);exit;
    $start_time = $countdown_timer_start->select('start_time')->first();
// print_r($start_time);exit;
    // Check if start_time is retrieved correctly
    if (!$start_time) {
        // Handle the case where start_time is not found
        // For example, default to a predefined countdown duration in seconds (e.g., 2 minutes)
        $select_start_time = 120; // Default to 2 minutes (120 seconds)
    } else {
        $select_start_time = $start_time["start_time"];
    }

    $countdownModel = new CountdownModelNew();
    $countdownDuration = $select_start_time;

    // Fetch the selected_time from CountdownModelNew
    $start_time_record = $countdownModel->select('id, selected_time')->first();
    if (!$start_time_record) {
        // If countdown has not started, set the start time
        $start_time = time();
        $countdownModel->insert(['selected_time' => $start_time]);
    } else {
        // If countdown has started, retrieve the start time
        $start_time = $start_time_record['selected_time'];
    }

    // Calculate remaining time
    $elapsed_time = time() - $start_time;
    $remaining_time = $countdownDuration - $elapsed_time;

    // If the countdown reaches 0, reset the start time and set remaining_time to 0
    if ($remaining_time <= 0) {
        $start_time = time();
        if (isset($start_time_record['id'])) {
            $countdownModel->update($start_time_record['id'], ['selected_time' => $start_time]);
        } else {
            $countdownModel->insert(['selected_time' => $start_time]);
        }
        $remaining_time = 0; // Set remaining time to 0 to reset display_time to 00:00

        // Perform your action here when the countdown reaches 0
        // For example, you can call another function or execute some code
        // Example: startRotation(); // assuming startRotation() is your desired action
    }

    $is_last_10_seconds = ($remaining_time > 0 && $remaining_time <= 10);
    
    // If remaining time is 0, display "00:00"
    if ($remaining_time <= 0) {
        $display_time = "00:00";
    } else {
        $minutes = floor($remaining_time / 60);
        $seconds = $remaining_time % 60;
        $display_time = sprintf("%02d:%02d", $minutes, $seconds);
    }

    $data["display_time"] = $display_time;
    $data["is_last_10_seconds"] = $is_last_10_seconds;
    $data_to_encode = [
    'display_time' => $data["display_time"], // Existing data
    'start_time' => $original_time // Extra variable
];

// Encode the array to JSON
 echo json_encode($data_to_encode);
    // json_encode($data["display_time"]);
}

public function get_universal_counter_timer_all_cron()
{
    $countdown_timer_start = new Countdown_timer();
    
    $original_time=$countdown_timer_start->get_details();
    $original_time=$original_time->start_time;
    // print_r($original_time->start_time);exit;
    $start_time = $countdown_timer_start->select('start_time')->first();
// print_r($start_time);exit;
    // Check if start_time is retrieved correctly
    if (!$start_time) {
        // Handle the case where start_time is not found
        // For example, default to a predefined countdown duration in seconds (e.g., 2 minutes)
        $select_start_time = 120; // Default to 2 minutes (120 seconds)
    } else {
        $select_start_time = $start_time["start_time"];
    }

    $countdownModel = new CountdownModelNew();
    $countdownDuration = $select_start_time;

    // Fetch the selected_time from CountdownModelNew
    $start_time_record = $countdownModel->select('id, selected_time')->first();
    if (!$start_time_record) {
        // If countdown has not started, set the start time
        $start_time = time();
        $countdownModel->insert(['selected_time' => $start_time]);
    } else {
        // If countdown has started, retrieve the start time
        $start_time = $start_time_record['selected_time'];
    }

    // Calculate remaining time
    $elapsed_time = time() - $start_time;
    $remaining_time = $countdownDuration - $elapsed_time;

    // If the countdown reaches 0, reset the start time and set remaining_time to 0
    if ($remaining_time <= 0) {
        $start_time = time();
        if (isset($start_time_record['id'])) {
            $countdownModel->update($start_time_record['id'], ['selected_time' => $start_time]);
        } else {
            $countdownModel->insert(['selected_time' => $start_time]);
        }
        $remaining_time = 0; // Set remaining time to 0 to reset display_time to 00:00

        // Perform your action here when the countdown reaches 0
        // For example, you can call another function or execute some code
        // Example: startRotation(); // assuming startRotation() is your desired action
    }

    $is_last_10_seconds = ($remaining_time > 0 && $remaining_time <= 10);
    
    // If remaining time is 0, display "00:00"
    if ($remaining_time <= 0) {
        $display_time = "00:00";
    } else {
        $minutes = floor($remaining_time / 60);
        $seconds = $remaining_time % 60;
        $display_time = sprintf("%02d:%02d", $minutes, $seconds);
    }

    $data["display_time"] = $display_time;
    $data["is_last_10_seconds"] = $is_last_10_seconds;
    $data_to_encode = [
    'display_time' => $data["display_time"], // Existing data
    'start_time' => $original_time // Extra variable
];

// Encode the array to JSON
 echo json_encode($data_to_encode);
    // json_encode($data["display_time"]);
}


public function get_universal_counter_timer_all_old_jaywant()
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
public function get_universal_counter_timer_all_new()
{
    $countdownModel = new CountdownModelNew();
    // Check if the countdown has already started
    $selected_time_record = $countdownModel->select('selected_time')->first();
   // print_r($selected_time_record);exit;
      // Define the countdown duration in seconds (e.g., 120 seconds for 2 minutes)
    $countdown_duration = $selected_time_record['selected_time'];
   /* if (!$selected_time_record) {
        // If countdown has not started, set the start time
        $selected_time = time();
        $countdownModel->insert(['selected_time' => $countdown_duration]);
    } else {
        // If countdown has started, retrieve the start time
        $selected_time = $selected_time_record['selected_time'];
    }*/
  $selected_time = $selected_time_record['selected_time'];
    // Calculate elapsed and remaining time
    $current_time = time();
    $elapsed_time = $current_time - $selected_time;
    $remaining_time = $countdown_duration - $elapsed_time;

    // If the countdown reaches 0, reset the start time
    if ($remaining_time <= 0) {
        $selected_time = $current_time;
        $countdownModel->update(1, ['selected_time' => $selected_time]);
        $remaining_time = $countdown_duration;
    }

    // Calculate minutes and seconds for the display
    $minutes = floor($remaining_time / 60);
    $seconds = $remaining_time % 60;
    $display_time = sprintf("%02d:%02d", $minutes, $seconds);

    $data = [
        "display_time" => $display_time,
        "is_last_10_seconds" => $remaining_time > 0 && $remaining_time <= 10
    ];

    echo json_encode($data);
}


public function get_universal_counter_timer_last_10_seconds()
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
    // If remaining time is greater than 10 seconds, adjust to show only the last 10 seconds
    if ($remaining_time > 10) 
    {
        $remaining_time -= 50; // Subtract the first 110 seconds to get the last 10 seconds
    }
    // Format remaining time as MM:SS
    $minutes = floor($remaining_time / 60);
    $seconds = $remaining_time % 60;
    $display_time = sprintf("%02d:%02d", $minutes, $seconds);
    // Prepare response data
    $data["display_time"] = $display_time;
    // Return JSON response
    echo json_encode(array('display_time' => $display_time));
}
    
// Controller method to stop spinner
public function stop_spinner() 
{
    // Perform any necessary actions to stop the spinner
    // Return a response indicating success
    echo json_encode(['success' => true]);
}

public function final_spinner()
{
     return view('user/final_sppiner');
}
public function logohome()
{
    $admin_account_id = $_SESSION["user_id"];
    $data["admin_users_details"] = $this->Admin_model->get_admin_user_details($admin_account_id);
    return view('user/logohome',$data);
}
    public function getExcludedNumbers()
    {
        $model = new NumbersModel();
        $excludedNumbers = $model->fetchExcludedNumbers();
        return $this->response->setJSON(['excludedNumbers' => $excludedNumbers]);
    }
    
}
