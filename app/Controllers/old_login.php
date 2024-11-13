public function check_login() {
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    
    $user = $this->Login_model->verify_login($username, $password);
    <!--.......................................1 week..................................-->
    if ($user) {
        // Check if last login was more than a week ago
        $last_login = strtotime($user->last_login);
        $one_week_ago = strtotime('-1 week');
        
        if ($last_login < $one_week_ago) {
            // Inactivate user if last login was more than a week ago
            $data = ['status' => 0];
            $this->Login_model->update_user_status($user->id, $data);
            
            // Redirect to login page with a message
            return redirect()->route('login')->with('warning', 'Your account has been inactive for more than a week. Please contact the administrator.');
        }
     <!--................................1 day..........................................   -->
    if ($user) {
        // Increment login count and update last login date
        $login_count = $user->login_count + 1;
        $last_login = date('Y-m-d H:i:s');
        $data = [
            'login_count' => $login_count,
            'last_login' => $last_login
        ];
        $this->Login_model->update_user_login_info($user->id, $data);
        
        // Check if last login was more than a day ago
        $last_login_timestamp = strtotime($user->last_login);
        $one_day_ago = strtotime('-1 day');
        
        if ($last_login_timestamp < $one_day_ago) {
            // Inactivate user if last login was more than a day ago
            $data = ['status' => 0];
            $this->Login_model->update_user_status($user->id, $data);
            
            // Redirect to login page with a message
            return redirect()->route('login')->with('warning', 'Your account has been inactive for more than a day. Please contact the administrator.');
        }
        
        // Set session data
        $this->session->set('user_id', $user->id);
        $this->session->set('role', $user->role);
        $this->session->set('username', $user->first_name . " " . $user->last_name);
        
        // Redirect based on user role
        if ($user->role == "super-admin") {
            return redirect()->route('superadmin');
        } elseif ($user->role == "admin") {
            return redirect()->route('admin');
        } elseif ($user->role == "user") {
            return redirect()->route('user');
        }
    } else {
        // User authentication failed
        return redirect()->route('login')->with('error', 'Invalid username or password.');
    }
}
