<?php
namespace App\Controllers;
use CodeIgniter\Database\Database; // This is important
use CodeIgniter\Controller;
use App\Models\SuperAdmin_model;
use App\Models\Notification_model;
use App\Models\NumbersModel;
use App\Models\CountdownModel;
use App\Models\Countdown_timer;
use App\Models\SpinnerStoppedNumber;
use App\Models\SA_BalanceModel;
use App\Models\Login_model;
use App\Models\CountdownModelNew;
use App\Models\ScoreModel;
use App\Models\Admin_model;
use App\Models\ThemeModel;
header('Cache-Control: max-age=3600');

class Spinner extends Controller
{
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
        // date_default_timezone_set('Asia/Kolkata');
    }

public function index_old()
{
    $user_id  = $_SESSION["user_id"];
    $countdownModel = new CountdownModelNew();
    $start_time_row = $countdownModel->select('selected_time')->first();
    $start_time = isset($start_time_row['selected_time']) ? $start_time_row['selected_time'] : 0;
    $elapsed_time = time() - $start_time;
    $remaining_time = 60 - $elapsed_time;
    $model = new Admin_model();
    $is_last_10_seconds = ($remaining_time > 0 && $remaining_time <= 10);
    $user_current_amounts = $model->get_user_current_amounts();
    $data = ['user_current_amounts' => $user_current_amounts,'remaining_time' => $remaining_time, 'is_last_10_seconds' => $is_last_10_seconds];
    $model = new SpinnerStoppedNumber();
    $data['last_ten_results'] = $model->getLastTenResults($user_id);
    $data['last_results'] = $model->getLastResults();
    $themeModel = new ThemeModel();
    $theme = $themeModel->getTheme();
    $data['theme']=$theme['name'];
    return view('user/home_main', $data);  
}
public function get_universal_counter_timer_all()
    {
         $countdownModel = new CountdownModelNew();
        // Check if the countdown has already started
        $start_time = $countdownModel->select('selected_time')->first();
        if (!$start_time) {
            // If countdown has not started, set the start time
            $start_time = time();
            $countdownModel->insert(['selected_time' => $start_time]);
        } else {
            // If countdown has started, retrieve the start time
            $start_time = $start_time['selected_time'];
        }
// print_r(); die();
        // Calculate remaining time
        $elapsed_time = time() - $start_time;
        $remaining_time = 120 - $elapsed_time;

        // If the countdown reaches 0, reset the start time
        if ($remaining_time <= 0) {
            $start_time = time();
            $countdownModel->update(1, ['start_time' => $start_time]);
            $remaining_time = 120;
        }

        // Format remaining time for display
        $minutes = floor($remaining_time / 60);
        $seconds = $remaining_time % 60;
        $display_time = sprintf("%02d:%02d", $minutes, $seconds);
        $data["display_time"] =$display_time;
        echo json_encode($data["display_time"]);
    }

public function index_jaywant()
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
     return view('user/spinner_jay', $data);
    //return view('user/home_main', $data);
}
    
public function index()
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
        $wallet_amount =  @$user_details->amout_given;
    }
    
    // Fetch the last ten results and the last result
    $last_ten_results = $spinnerModel->getLastTenResults($user_id);
    //$last_ten_results = $spinnerModel->get_24_hour_result_ss();
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
        'user_id'=>$user_id
    ];
    // print_r($data);exit;
    //return view('user/home_main', $data);
    return view('user/shweta_test', $data);
}

public function index_for_malati_mam()
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
        $wallet_amount =  @$user_details->amout_given;
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
        'user_id'=>$user_id
    ];
    // print_r($data);exit;
    //return view('user/home_main', $data);
    return view('user/shweta_test_for_malati_mam', $data);
}

public function spinner_shweta_latest()
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
        $wallet_amount =  @$user_details->amout_given;
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
        'user_id'=>$user_id
    ];
    // print_r($data);exit;
    //return view('user/home_main', $data);
    return view('user/shweta_test_10_4_2024', $data);
}
public function Spinner_jay_old()
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
        'user_id'=>$user_id
    ];
    // print_r($data);exit;
    //return view('user/home_main', $data);
    return view('user/spinner_jay_old', $data);
}
public function Sayali()
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
   /// return view('user/home_main_shweta', $data);//////////old code for page refresh values not 0
    return view('user/spinner_sayali', $data);
   /// return view('user/spinner_sayali1', $data);
}
public function Shweta()
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
    //return view('user/home_main', $data);
    return view('user/spinner_shweta', $data);
}
public function malati()
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
    return view('user/home_main_malati', $data);
}
public function home_spinner()
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
    return view('user/home_spinner', $data);
}

// public function shweta()
// {
//     $user_id = @$_SESSION["user_id"];
//     $model = new Admin_model();
//     if(!empty($user_id))
//     {
//         $user_details = $this->Admin_model->get_admin_user_details($user_id);
//         $player_name  = $user_details->first_name." ".$user_details->last_name;
//     }
//     $Countdown_timer = new CountdownModelNew();
//     $spinnerModel = new SpinnerStoppedNumber();
//     $themeModel = new ThemeModel();
//     // Fetch the start time from the database
//     $start_time_row = $Countdown_timer->select('selected_time')->first();
//     $start_time = isset($start_time_row['selected_time']) ? $start_time_row['selected_time'] : 0;
//     // Calculate elapsed and remaining time
//     $current_time = time();
//     $elapsed_time = $current_time - $start_time;
//     $remaining_time = $start_time - $elapsed_time;
//     // Check if the countdown has reached 0 and reset if necessary
//   /* if ($remaining_time <= 0) {
//         $start_time = $current_time;
//         $countdownModel->update(1, ['selected_time' => $start_time]);
//         $remaining_time = $start_time;
//     }
// */
//     // Determine if it's the last 10 seconds
//     $is_last_10_seconds = ($remaining_time > 0 && $remaining_time <= 10);
//     // Fetch user current amounts
//     $user_current_amounts = $model->get_user_current_amounts();
//     // Fetch the last ten results and the last result
//     $last_ten_results = $spinnerModel->getLastTenResults();
//     $last_results = $spinnerModel->getLastResults();
//     // Fetch the current theme
//     $theme = $themeModel->getTheme();
//     $theme_name = $theme['name'];
//     // Prepare data for the view
//     $data = [
//         'username'             => $player_name,
//         'user_current_amounts' => $user_current_amounts,
//         'remaining_time'       => $remaining_time,
//         'is_last_10_seconds'   => $is_last_10_seconds,
//         'last_ten_results'     => $last_ten_results,
//         'last_results'         => $last_results,
//         'theme'                => $theme_name,
//     ];

//     return view('user/home_main_shweta', $data);
// }

}
?>