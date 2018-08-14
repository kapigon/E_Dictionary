<?php

class UserController extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }
    
    public function index(){
        $this->load->view('login');
    }
    
    public function checkLogin(){
        
        $login = $this->input->post('Login');
        $signUp = $this->input->post('SignUp');
        
        if($login == 'Đăng nhập'){
            $this->form_validation->set_rules('username', 'UserName', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|callback_verifyUser');

            if($this->form_validation->run() == false){
                $this->load->view('login');
            }else{
                redirect('tra-tu');
            }
        }
        else if($signUp == 'Đăng ký'){
            redirect('dang-ky');
        }
        
    }
    
    public function verifyUser(){
        $name = $this->input->post('username');
        $pass = $this->input->post('password');
                
        // Get User
        $arrUser = $this->UserModel->getUser($name, md5($pass));
        if(count($arrUser) > 0) {
            // Start the session
            if(!isset($_SESSION)) 
            { 
                session_start();
            }
            $_SESSION["cUser"] = $arrUser[0];
            
            #$this->form_validation->set_message('verifyUser', 'current User Id: ' . $_SESSION["cUserId"]);
            return true;
        }    
        else{
            $this->form_validation->set_message('verifyUser','Tên đăng nhập và mật khẩu không đúng. Xin thử lại.');
            return false;
        }
    }
    
    // Register User mới
    public function SignUp(){
        
        $this->form_validation->set_rules('username', 'Tên truy cập', 'required|callback_checkUser');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
        $this->form_validation->set_rules('re-password', 'Mật khẩu nhắc lại', 'required|callback_checkPass');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_checkEmail');
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
        
        if($this->form_validation->run() == false){
            $this->load->view('signUp');
        }else{
            $username       = $this->input->post('username');
            $fullname       = $this->input->post('fullname');
            $email       = $this->input->post('email');
            $pass           = md5($this->input->post('password'));
            $currentUser    = '0';
            $active         = 0;
            
            if($this->input->post('active') == '1'){
                $active = 1;
            }
            if(!isset($_SESSION)) 
            { 
                session_start();
            }
            if(isset($_SESSION["cUser"])){
                $currentUser = $_SESSION["cUser"];
            }
                        
            $data = array(
                'fullname'      => $fullname,
                'username'      => $username,
                'email'         => $email,
                'password'      => $pass,
                'UserCreate'    => $currentUser,
                'RoleId'        => 3,               // Người dùng
                'Active'        => $active,
                'DateCreate'    => date("Y-m-d H:i:s")
            );
             
            if($this->UserModel->createUser($data) > 0) {
                redirect('dang-nhap');
            }
            else{
                $this->load->view('signUp');
            }
        }
    }
    
    # Check Định dạng username và kiểm tra User tồn tại không
    public function checkUser(){
        $username = $this->input->post('username');
        if (preg_match('/^[A-Za-z0-9_]+$/', $username)) 
        {
        
            # Check User có tồn tại không?
            if($this->UserModel->isExistUser($username)) {
                $this->form_validation->set_message('checkUser','Tên truy nhập "' . $username . '" đã tồn tại.');
                return false;
            }
            else{
                $this->form_validation->set_message('checkUser','Đăng ký thành công.');
                return true;
            }
        }
        else
        {
            $this->form_validation->set_message('checkUser','Tên truy nhập không được có các ký tự đặc biệt và khoảng trống.');
            return false;
        }
    }
    
    # Check Email
    public function checkEmail(){
        $email = $this->input->post('email');
        $id = 0;
        if($this->input->post('id') != ""){
            $id = $this->input->post('id');
        }
        if (preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/', $email)) 
        {
            
            if($this->UserModel->isExistEmail($id, $email)) {
                $this->form_validation->set_message('checkEmail','Email: "' . $email . '" đã được đăng ký.');
                return false;
            }
            else{
                $this->form_validation->set_message('checkEmail','Đăng ký thành công.');
                return true;
            }
        }
        else
        {
            $this->form_validation->set_message('checkEmail','Email không đúng định dạng');
            return false;
        }
    }
    
    # Check User có tồn tại không?
    public function isExitUser(){
        $username = $this->input->post('username');
        
        
        if($this->UserModel->isExistUser($username)) {
            $this->form_validation->set_message('isExitUser','Tên truy nhập "' . $username . '" đã tồn tại.');
            return false;
        }    
        else{
            #$this->form_validation->set_message('isExitUser','Tên truy nhập và Mật khẩu không đúng. Xin thử lại');
            return true;
        }
    }
    
    # Check Pass có trùng nhau khi đăng ký không
    public function checkPass(){
        $pass = $this->input->post('password');
        $repass = $this->input->post('re-password');
        
        if($pass != $repass){
            $this->form_validation->set_message('checkPass','Lỗi mật khẩu không trùng nhau.');
            return false;
        } else {
            return true;
        }
    }
    
    # Get List User not Active
    public function getUserList($page = 1){
        if(!isset($_SESSION)) 
        { 
            session_start();
        }
        if(isset($_SESSION["cUser"]) && ($_SESSION['cUser']->RoleId == 1 || $_SESSION['cUser']->RoleId == 2)){
            
            $url = base_url() .'danh-sach-user-cho-duyet/';
            $total_rows = $this->UserModel->getUserNotActive_Total();
            $per_page = 10;

            $config = $this->my_customs->pagination($url, $total_rows, $per_page);

            $total_page = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page > $total_page) ? $total_page : $page;
            $page = ($page < 0) ? 1 : $page;
            //$config['cur_page'] = $page;
            $page = $page - 1;             

            $data['userList'] = $this->UserModel->getUserList($page * $config['per_page'], $config['per_page']);
            $this->pagination->initialize($config);
            $data['list_pagination'] = $this->pagination->create_links();
            $this->load->view('userList', $data);
            
        }
        else{
            redirect('tra-tu');
        }
        
    }
    
    public function getInfoCurrentUser(){
        
        if(!isset($_SESSION)) 
        { 
            session_start();
        }
        
        if(isset($_SESSION["cUser"])){
            $id = $_SESSION['cUser']->ID;
            $data['info'] = $this->UserModel->getInfoUserById($id);
            $this->load->view('info', $data);
            
        }
    }
    
    // Update: User
    public function updateUser($id = 0){
       
        $this->form_validation->set_rules('re-password', 'Mật khẩu nhắc lại', 'callback_checkPass');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_checkEmail');
        
        $update = $this->input->post('Update');
        
        if($this->form_validation->run() == true){
            
            $fullname   = $this->input->post('fullname');
            $email      = $this->input->post('email');
            $pass       = $this->input->post('password');
            if(!isset($_SESSION)) 
            { 
                session_start();
            }
            
            if(isset($_SESSION["cUser"]) && $id == 0){
                $id = $_SESSION['cUser']->ID;
       
                $data = array(
                    'FullName'  => $fullname,
                    'Email'     => $email
                );
                if($pass != ""){
                    $data['Password'] = md5($pass);
                }
                
                // Nếu thành công
                if($this->UserModel->updateUser($data, $id) > 0){
                    $this->getInfoCurrentUser();
                     $this->form_validation->set_message('checkPass','Lỗi mật khẩu không trùng nhau.');
                }
            }
        }
    }
    
    # LogOut
    public function logOut(){
        session_start();
        // remove all session variables
        session_unset(); 

        // destroy the session 
        session_destroy(); 
        
        redirect('dang-nhap');
    }
    
    # Active User
    public function activeUser(){
        $id = $this->input->post('id');
        $active = $this->input->post('active');
        $data['Active'] = $active;
        
        if($this->UserModel->updateUser($data, $id)){
            return true;
        }else{
            return false;
        }
    }
}
?>