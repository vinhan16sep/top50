<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('ion_auth_model');
    }

    public function index() {
        
    }

    public function login() {
        // if ($this->ion_auth->logged_in()){
        //     redirect('member/dashboard', 'refresh');
        //     if($this->ion_auth->in_group('members')){
        //         redirect('member/dashboard', 'refresh');
        //     }else{
        //         $this->ion_auth->logout();
        //         redirect('member/user/login', 'refresh');
        //     }
        // }
        $this->data['page_title'] = 'Login';
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('identity', 'Tài khoản', 'required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');
            if ($this->form_validation->run() === TRUE) {
                $remember = (bool) $this->input->post('remember');
                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    redirect('member', 'refresh');
                } else {
                    $this->session->set_flashdata('login_message_error', $this->ion_auth->errors());
                    redirect('member/user/login', 'refresh');
                }
            }
        }
        $this->load->helper('form');

        // $this->render('member/login_view', 'member_master');
        $this->load->view('member/login_view');
    }

    public function logout() {
        $this->ion_auth->logout();
        redirect('member/user/login', 'refresh');
    }

    // change password
    public function change_password(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in()){
            redirect('member/user/login', 'refresh');
        }
        if (!$this->ion_auth->in_group('members')) {
            $this->ion_auth->logout();
            $this->session->set_flashdata('login_message_error', 'Tài khoản không có quyền truy cập');
            redirect('member/user/login');
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
            $this->load->view('member/change_password_view', $this->data);
            // $this->render('member/change_password_view');
        } else {
            if ($this->input->post()) {
                $identity = $this->session->userdata('identity');
                $change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('new_password'));
                if ($change){
                //if the password was successfully changed
                    $this->logout();
                    $this->session->set_flashdata('auth_message', 'Đổi mật khẩu thành công. Vui lòng đăng nhập lại!');
                    redirect('member/user/login');
                }else{
                    $this->session->set_flashdata('auth_message_error', 'Mật khẩu không đúng vui lòng kiểm tra lại');
                    redirect('member/user/change_password', 'refresh');
                }
            }
        }  
    }

    public function forgot_password(){
        if ($this->ion_auth->logged_in()) {
            redirect('member/dashboard', 'refresh');
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
            $this->load->view('member/forgot_password_view');
        } else {
            if($this->input->post()){
                $email = $this->input->post('email');
                if (!$this->ion_auth->email_check($email)){
                    $this->session->set_flashdata('auth_message','Email không đúng. Vui lòng kiểm tra lại');
                    return redirect('member/user/forgot_password');
                }
                $forgotten = $this->ion_auth->forgotten_password($email, 'member');
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
                    $this->session->set_flashdata('auth_message','Đã gửi Email thành công. Vui lòng kiểm tra Email!');
                    return redirect('member/user/login');
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
                $this->load->view("member/reset_password_view", $this->data);
            } else {
                if($this->input->post()){
                    if ($user){
                        $reset = $this->ion_auth->forgotten_password_complete($code);
                        if ($reset) {  //if the reset worked then send them to the login page
                            $data = array('password' => $this->input->post('password'));
                            if($this->ion_auth->update($user->id, $data)){
                                $this->ion_auth->clear_forgotten_password_code($code);
                                $this->session->set_flashdata('auth_message', $this->ion_auth->messages());
                                redirect("member/user/login", 'refresh');
                            }else{
                                redirect('member/user/reset_password/' . $code, 'refresh');
                            }
                            
                        }
                        else { //if the reset didnt work then send them back to the forgot password page
                            $this->session->set_flashdata('auth_message', $this->ion_auth->errors());
                            redirect("member/user/forgot_password", 'refresh');
                        }
                    }
                }
            }
        }
    }

//    public function register(){
//        $this->data['page_title'] = 'Register';
//        $this->load->library('form_validation');
//        $this->load->helper('form');
//        $this->form_validation->set_rules('first_name', 'Frist Name', 'required');
//        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
//        $this->form_validation->set_rules('companyname', 'Company Name', 'required');
//        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_user');
//        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
//        $this->form_validation->set_rules('phone', 'Phone', 'required');
//        $this->form_validation->set_rules('password', 'Password', 'required');
//        $this->form_validation->set_rules('cf_password', 'Confirm Password', 'required|matches[password]');
//        if($this->input->post()){
//            if($this->form_validation->run() === TRUE){
//                $data = array(
//                    'username' => $this->input->post('username'),
//                    'password' => $this->input->post('password'),
//                    'email' => $this->input->post('email'),
//                    'first_name' => $this->input->post('first_name'),
//                    'last_name' => $this->input->post('last_name'),
//                    'company' => $this->input->post('companyname'),
//                    'phone' => $this->input->post('phone')
//                );
//                $this->ion_auth_model->insert($data);
//            }
//        }
//
//        $this->render('admin/register_view', 'admin_master');
//    }
//    public function check_email(){
//        $email = $this->input->post('email');
//        $where = array('email' => $email);
//        $result = $this->ion_auth_model->check_where($where);
//        if($result >=1){
//            $this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại');
//            return FALSE;
//        }
//        return true;
//    }
//
//    public function check_user(){
//        $username = $this->input->post('username');
//        $where = array('username' => $username);
//        $result = $this->ion_auth_model->check_where($where);
//        if($result >=1 ){
//            $this->form_validation->set_message(__FUNCTION__, 'Username đã tồn tại');
//            return FALSE;
//        }
//        return true;
//    }
}
