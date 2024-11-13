<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NumbersModel;
use App\Models\CountdownModel;
use App\Models\Admin_model;
use App\Models\SuperAdmin_model;
use App\Models\SpinnerStoppedNumber;
use App\Models\ScoreModel;
use App\Models\NumberModel;
use App\Models\SA_BalanceModel;
use App\Models\ThemeModel;
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
       
    }
    
    public function login() {
    return redirect()->to('login');
}
public function user_history() 
{
    $player_id  = $_SESSION["user_id"];
    // $player_id=$_GET['user_id'];
    $model = new SuperAdmin_model();
    $models = new ScoreModel();
    $data["current_wallet"] = $model->get_balance_amount(); 
    $data["players_list"] = $this->SuperAdminModel->get_player_users_list();
    $data["players_details"] = $models->get_all_scores_details_by_player($player_id);
    return view('user/user_history', $data);
}

public function home_duplicate_theme()
{ 
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
    $data['last_ten_results'] = $model->getLastTenResults();
    $data['last_results'] = $model->getLastResults();
    // Load the view with the data
    return view('user/home_duplicate_theme', $data);
}
    public function home() 
    {
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
       $data['last_ten_results'] = $model->getLastTenResults();
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
                // Instantiate the model to interact with the database
                $model = new ScoreModel();
                $SuperAdmin_model = new SuperAdmin_model();
                $request = service('request');
                $post = $this->request->getPost();
                $increment_number = $post["increment_number"];
                $oldScore  = $post["oldScore"];
                $loss_amount = $increment_number * $request->getPost('totalamt');
                $win_val = $post["winnerValue"];
                $new_score = ($request->getPost('oldScore')+$win_val);
                $user_id  = $_SESSION["user_id"];
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
                'win_before_score'       => $request->getPost('oldScore'),
                'total'                  => $request->getPost('totalamt'),
                'winner_number'          => $request->getPost('winner_number'),
                'winner_amount'          => $win_val,
                'loss_amount'            => $loss_amount,
                'created_at'             => date('Y-m-d H:i:s') // Optionally store the timestamp
            ];
            $datas = $this->SuperAdmin_model->get_admin_by_id_super_admin($user_id);
            if(!empty($datas->current_wallet))
            {
                $current_wallet = $datas->current_wallet;
                $current_wallet = ($current_wallet + $win_val)-$loss_amount;
                $para = ['current_wallet' => $current_wallet];
                $result =  $this->SuperAdmin_model->update_admin_account_details($user_id, $para);
                $lastQuery = $db->getLastQuery();
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
        
    }
    
 public function my() 
 {
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
    $data['last_ten_results'] = $model->getLastTenResults();
    $data['last_results'] = $model->getLastResults();
   
    // Load the view with the data
    $themeModel = new ThemeModel();
        $theme = $themeModel->getTheme(); // Example session usage
 $data['theme']=$theme['name'];
    //    print_r($data);exit;
    return view('user/home_duplicate', $data);
}

public function mys() 
{
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
    $data['last_ten_results'] = $model->getLastTenResults();
    $data['last_results'] = $model->getLastResults();
    // Load the view with the data
     $themeModel = new ThemeModel();
        $theme = $themeModel->getTheme(); // Example session usage
 $data['theme']=$theme['name'];
    return view('user/home_duplicate_jaywant', $data);
}
public function myR() 
{
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
    $data['last_ten_results'] = $model->getLastTenResults();
    $data['last_results'] = $model->getLastResults();
    // Load the view with the data
    return view('user/home_duplicate_rupali', $data);
}
public function get_last_10_result_win_numbers()
{
   $model = new SpinnerStoppedNumber();
   $data = $model->getLastTenResults(); 
   $json_data = json_encode($data);
   return $json_data;
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
  public function save_winning_details_olllddd() {
    $authHeader = $this->request->getHeader('Authorization');
    if ($authHeader) {
        $request = service('request');
      //  print_r($_SESSION); die();
        $user_id  = $_SESSION["user_id"];
        $winnerValue = $request->getPost('winnerValue');
        $totalamt = $request->getPost('totalamt');
        $showNobtn1 = $request->getPost('showNobtn1');
        $showNobtn2 = $request->getPost('showNobtn2');
        $showNobtn3 = $request->getPost('showNobtn3');
        $showNobtn4 = $request->getPost('showNobtn4');
        $showNobtn5 = $request->getPost('showNobtn5');
        $showNobtn6 = $request->getPost('showNobtn6');
        $showNobtn7 = $request->getPost('showNobtn7');
        $showNobtn8 = $request->getPost('showNobtn8');
        $showNobtn9 = $request->getPost('showNobtn9');
        $showNobtn0 = $request->getPost('showNobtn0');
        $oldScore = $request->getPost('oldScore');
        $newScore = $request->getPost('newScore');
    }
}
  
public function save_winning_detaills_old()
{
        $request = service('request');
        print_r($_SESSION); die();
        $user_id  = $_SESSION["user_id"];
        $winnerValue = $request->getPost('winnerValue');
        $totalamt = $request->getPost('totalamt');
        $showNobtn1 = $request->getPost('showNobtn1');
        $showNobtn2 = $request->getPost('showNobtn2');
        $showNobtn3 = $request->getPost('showNobtn3');
        $showNobtn4 = $request->getPost('showNobtn4');
        $showNobtn5 = $request->getPost('showNobtn5');
        $showNobtn6 = $request->getPost('showNobtn6');
        $showNobtn7 = $request->getPost('showNobtn7');
        $showNobtn8 = $request->getPost('showNobtn8');
        $showNobtn9 = $request->getPost('showNobtn9');
        $showNobtn0 = $request->getPost('showNobtn0');
        $oldScore = $request->getPost('oldScore');
        $newScore = $request->getPost('newScore');
        print_r($newScore); die();
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
            return $this->response->setJSON(['number' => $numbers]);
        } 
        else
        {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Number not found']);
        }
    }
public function getNumbersBasedOnMode()
{
     $db = \Config\Database::connect();
    $model = new NumbersModel();
    $mode = $model->getMode();//print_r($mode);exit;
    $values = $model->getValuesBasedOnMode($mode);
      // Get the last executed query
    $lastQuery = $db->getLastQuery();
    echo json_encode(array('values' => $values,'mode'=>$mode));

}
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

public function saveStoppedNumber()
    {
        $numbers = $this->request->getPost('stoppedNumber');
        $spinnerStoppedNumberModel = new SpinnerStoppedNumber();
        $result = $spinnerStoppedNumberModel->saveStoppedNumber($numbers);
        echo 1; 
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

public function get_universal_counter_timer_last_10_seconds()
{
    $countdownModel = new CountdownModel();

    // Check if the countdown has already started
    $start_time = $countdownModel->select('start_time')->first();
    if (!$start_time) {
        // If countdown has not started, set the start time
        $start_time = time();
        $countdownModel->insert(['start_time' => $start_time]);
    } else {
        // If countdown has started, retrieve the start time
        $start_time = $start_time['start_time'];
    }

    // Calculate remaining time
    $elapsed_time = time() - $start_time;
    $remaining_time = 60 - $elapsed_time;

    // If the countdown reaches 0, reset the start time
    if ($remaining_time <= 0) {
        $start_time = time();
        $countdownModel->update(1, ['start_time' => $start_time]);
        $remaining_time = 60;
    }

    // If remaining time is greater than 10 seconds, adjust to show only the last 10 seconds
    if ($remaining_time > 10) {
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
    return view('user/logohome');
}
    public function getExcludedNumbers()
    {
        $model = new NumbersModel();
        $excludedNumbers = $model->fetchExcludedNumbers();
        return $this->response->setJSON(['excludedNumbers' => $excludedNumbers]);
    }
    
}
