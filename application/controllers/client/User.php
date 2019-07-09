<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('ion_auth_model');
        $this->load->model('users_model');
    }

    public function index() {
        
    }

    public function login() {
        // if ($this->ion_auth->logged_in() || $this->ion_auth->in_group('clients'))
        // {
        //     redirect('client/dashboard', 'refresh');
        // }
        $this->data['page_title'] = 'Login';
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('identity', 'Identity', 'required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('password', 'Password', 'required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');
            if ($this->form_validation->run() === TRUE) {
                $remember = (bool) $this->input->post('remember');
                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    redirect('client', 'refresh');
                } else {
                    $this->session->set_flashdata('login_message_error', $this->ion_auth->errors());
                    redirect('client/user/login', 'refresh');
                }
            }
        }
        $this->load->helper('form');

        $this->load->view('client/login_view');
    }

    public function logout() {
        $this->ion_auth->logout();
        redirect('client/user/login', 'refresh');
    }

    public function register(){
        $this->data['page_title'] = 'Tạo mới user';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('companyname','Company','trim');
        $this->form_validation->set_rules('username','Mã số thuế','trim|required|is_unique[users.username]', array(
                'required' => '%s không được trống.',
            ));
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]', array(
                'required' => '%s không được trống.',
            ));
        $this->form_validation->set_rules('phone','Số điện thoại','trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
        $this->form_validation->set_rules('register_password','Mật khẩu','required', array(
                'required' => '%s không được trống.',
            ));
        $this->form_validation->set_rules('password_confirm','Xác nhận mật khẩu','required|matches[register_password]', array(
                'required' => '%s không được trống.',
                'matches' => 'Xác nhận mật khẩu không đúng.',
            ));

        if($this->form_validation->run()===FALSE) {
            $this->load->helper('form');
            $this->load->view('client/login_view');
            // $this->render('client/login_view', 'client_master');
        } else {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('register_password');
            $group_ids = array(3);

            $additional_data = array(
                'company' => $this->input->post('companyname'),
                'phone' => $this->input->post('phone'),
            );
            $result = $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
            if($result){
                $this->load->model('status_model');
                $status = array(
                    'client_id' => $result,
                    'is_information' => 0,
                    'is_company' => 0,
                    'is_product' => 0,
                    'is_final' => 0
                );
                $this->status_model->insert('status', $status);
            }
            $detail = $this->users_model->fetch_by_id($result);
            if($result){
                $this->session->set_flashdata('register_success', 'Cảm ơn Qúy Công ty đã đăng ký tham gia Chương trình Danh hiệu Sao Khuê 2019.
                                                Vui lòng truy cập email để kích hoạt tài khoản và khai hồ sơ.');
                redirect('client/user/login', 'refresh');
                $this->ion_auth->login($username, $password, false);
                redirect('client', 'refresh');
            }
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('client/dashboard', 'refresh');
        }
    }

    // change password
    public function change_password(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in()){
            redirect('client/user/login', 'refresh');
        }
        if (!$this->ion_auth->in_group('clients')) {
            $this->ion_auth->logout();
            $this->session->set_flashdata('login_message_error', 'Tài khoản không có quyền truy cập');
            redirect('client/user/login');
        }
        $user = $this->ion_auth->user()->row();
        $this->data['user_id'] = $user->id;

        $this->form_validation->set_rules('old_password','Mật khẩu cũ','trim|required',
            array(
                'required' => '%s không được trống.'
            )
        );

        $this->form_validation->set_rules('new_password','Mật khẩu mới','trim|min_length[8]|max_length[20]|required',
            array(
                'required' => '%s không được trống.',
                'min_length' => '%s phải nhiều hơn %s ký tự',
                'max_length' => '%s phải ít hơn %s ký tự',
            )
        );
        $this->form_validation->set_rules('new_confirm','Xác nhận mật khẩu mới','trim|matches[new_password]|required',
            array(
                'required' => '%s không được trống.',
                'matches' => '%s không giống với %s',
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('client/change_password_view', $this->data);
            // $this->render('client/change_password_view');
        } else {
            if ($this->input->post()) {
                $identity = $this->session->userdata('identity');
                $change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('new_password'));
                if ($change){
                //if the password was successfully changed
                    $this->logout();
                    $this->session->set_flashdata('auth_message', 'Đổi mật khẩu thành công. Vui lòng đăng nhập lại!');
                    redirect('client/user/login', 'refresh');
                }else{
                    $this->session->set_flashdata('auth_message', 'Mật khẩu không đúng vui lòng kiểm tra lại');
                    redirect('client/user/change_password', 'refresh');
                }
            }
        }  
    }

    public function forgot_password(){
        if ($this->ion_auth->logged_in()) {
            redirect('client/dashboard', 'refresh');
        }
        $this->load->library('ion_auth');
        $this->load->library('email');
        $user = $this->ion_auth->user()->row();
        // print_r($user);die;
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email','Email','trim|valid_email|required',
            array(
                'required' => '%s không được trống.',
                'valid_email' => 'Định dạng %s không đúng'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('client/forgot_password_view');
        } else {
            if($this->input->post()){
                $email = $this->input->post('email');
                if (!$this->ion_auth->email_check($email)){
                    $this->session->set_flashdata('auth_message','Email không đúng. Vui lòng kiểm tra lại');
                    return redirect('client/user/forgot_password');
                }
                $forgotten = $this->ion_auth->forgotten_password($email);
                // $config = [
                //     'protocol' => 'smtp',
                //     'smtp_host' => 'ssl://smtp.googlemail.com',
                //     'smtp_port' => 465,
                //     'smtp_user' => 'nghemalao@gmail.com',
                //     'smtp_pass' => 'Huongdan1',
                //     'smtp_port' => '465',
                //     'mailtype' => 'html'
                // ];
                // $data = array(
                //     'identity'=>$forgotten['identity'],
                //     'forgotten_password_code' => $forgotten['forgotten_password_code'],
                // );
                // $this->load->library('email');
                // $this->email->initialize($config);
                // $this->load->helpers('url');
                // $this->email->set_newline("\r\n");

                // // $this->email->from('nghemalao@gmail.com');
                // // $this->email->to($email);
                // // $this->email->subject("forgot password");
                // $body = $this->load->view('auth/email/forgot_password.tpl.php',$data,TRUE);
                // $this->email->message($body);

                if ($forgotten) {
                    $this->session->set_flashdata('register_success','Đã gửi Email thành công. Vui lòng kiểm tra Email!');
                    return redirect('client/user/login');
                }
            }
        }
        
    }
    public function reset_password($code){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->library('email');

        $this->form_validation->set_rules('password','Mật Khẩu','trim|min_length[8]|max_length[20]|required',
            array(
                'required' => '%s không được trống.',
                'min_length' => '%s phải nhiều hơn %s ký tự',
                'max_length' => '%s phải ít hơn %s ký tự',
            )
        );
        $this->form_validation->set_rules('confirm_password','Xác Nhận Mật Khẩu','trim|matches[password]|required',
            array(
                'required' => '%s không được trống.',
                'matches' => '%s không giống với %s',
            )
        );

        $user = $this->ion_auth->forgotten_password_check($code);
        if(!$user){
            $this->load->view('404');
        }
        else{
            if ($this->form_validation->run() == FALSE) {
                $this->data['csrf'] = $this->security->get_csrf_hash();
                $this->data['code'] = $code;
                $this->load->view("client/reset_password_view", $this->data);
            } else {
                if($this->input->post()){
                    if ($user){
                        $reset = $this->ion_auth->forgotten_password_complete($code);
                        if ($reset) {  //if the reset worked then send them to the login page
                            $data = array('password' => $this->input->post('password'));
                            if($this->ion_auth->update($user->id, $data)){
                                $this->ion_auth->clear_forgotten_password_code($code);
                                $this->session->set_flashdata('register_success', $this->ion_auth->messages());
                                redirect("client/user/login", 'refresh');
                            }else{
                                redirect('client/user/reset_password/' . $code, 'refresh');
                            }
                            
                        }
                        else { //if the reset didnt work then send them back to the forgot password page
                            $this->session->set_flashdata('auth_message', $this->ion_auth->errors());
                            redirect("client/user/forgot_password", 'refresh');
                        }
                    }
                }
            }
        }
    }

    public function activate($id, $code = FALSE)
    {
        if ($code !== FALSE)
        {
            $activation = $this->ion_auth->activate($id, $code);
        }
        else if ($this->ion_auth->is_admin())
        {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation)
        {
            // redirect them to the auth page
            $this->session->set_flashdata('register_success', $this->ion_auth->messages());
            redirect("client/user/login", 'refresh');
        }
        else
        {
            // redirect them to the forgot password page
            $this->session->set_flashdata('auth_message', $this->ion_auth->errors());
            redirect("client/user/forgot_password", 'refresh');
        }
    }

    public function check_email(){
        $email = $this->input->post('email');
        $where = array('email' => $email);
        $result = $this->ion_auth_model->check_where($where);
        if($result >=1){
            $this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại');
            return FALSE;
        }
        return true;
    }

    public function check_user(){
        $username = $this->input->post('username');
        $where = array('username' => $username);
        $result = $this->ion_auth_model->check_where($where);
        if($result >=1 ){
            $this->form_validation->set_message(__FUNCTION__, 'Username đã tồn tại');
            return FALSE;
        }
        return true;
    }
}
