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
        if ($this->ion_auth->logged_in()){
            if($this->ion_auth->in_group('admin')){
                redirect('admin/dashboard', 'refresh');
            }else{
                $this->ion_auth->logout();
                redirect('admin/user/login', 'refresh');
            }
        }
        $this->data['page_title'] = 'Login';
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('identity', 'Identity', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');
            if ($this->form_validation->run() === TRUE) {
                $remember = (bool) $this->input->post('remember');
                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    redirect('admin', 'refresh');
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('admin/user/login', 'refresh');
                }
            }
        }
        $this->load->helper('form');

        $this->render('admin/login_view', 'admin_master');
    }

    public function logout() {
        $this->ion_auth->logout();
        redirect('admin/user/login', 'refresh');
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
