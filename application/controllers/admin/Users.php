<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include "class.phpmailer.php";
include "class.smtp.php";

class Users extends Admin_Controller
{
    function __construct(){
        parent::__construct();
        if(!$this->ion_auth->in_group('admin'))
        {
            $this->session->set_flashdata('message','You are not allowed to visit the Groups page');
            redirect('admin','refresh');
        }
        $this->load->model('status_model');
    }

    public function index($group_id = null){
        $this->load->model('information_model');
        $this->load->model('status_model');
        $this->load->model('users_model');
        $this->data['page_title'] = 'Quản lý user';

        $keywords = '';
        if($this->input->get('search')){
            $keywords = trim($this->input->get('search'));
        }
        $this->data['keywords'] = $keywords;
        $total_rows  = $this->users_model->count_search($group_id, $keywords);
        $this->load->library('pagination', TRUE);
        $config = array();
        $base_url = base_url('admin/users/index/' . $group_id);
        $per_page = 50;
        $uri_segment = 5;
        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) - 1 : 0;
        $this->pagination->initialize($config);
        $this->data['page_links'] = $this->pagination->create_links();
        $users = $this->users_model->get_all_with_pagination_search($group_id, $per_page, $per_page*$this->data['page'], $keywords);
        if ($group_id == 3) {
            foreach ($users as $key => $value) {
                $company = $this->information_model->fetch_client_id($value['id']);
                $users[$key]['member_id'] = $company['member_id'];
                $users[$key]['status'] = $this->status_model->fetch_by_client_id($value['user_id']);
            }
        }
        if($this->data['page'] == 0){
             $number = $total_rows;
         }elseif($total_rows < ($this->data['page'] + 1) * $per_page){
             $number = $total_rows - ($this->data['page'] * $per_page);
         }elseif($this->data['page'] > 0 && $total_rows > ($this->data['page'] + 1) * $per_page){
             $number = $total_rows - ($this->data['page'] * $per_page);
         };

         $this->data['number'] = $number;
        $this->data['group_id'] = $group_id;
        $this->data['group'] = $group_id;
        $this->data['users'] = $users;
        $this->render('admin/users/list_users_view');
    }

    public function index_member($group_id = null){
        $this->load->model('information_model');
        $this->load->model('status_model');
        $this->load->model('users_model');
        $this->data['page_title'] = 'Quản lý user';

        $keywords = '';
        if($this->input->get('search')){
            $keywords = trim($this->input->get('search'));
        }
        $this->data['keywords'] = $keywords;
        $total_rows  = $this->users_model->count_search($group_id, $keywords);
        $this->load->library('pagination', TRUE);
        $config = array();
        $base_url = base_url('admin/users/index/' . $group_id);
        $per_page = 50;
        $uri_segment = 5;
        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) - 1 : 0;
        $this->pagination->initialize($config);
        $this->data['page_links'] = $this->pagination->create_links();
        $users = $this->users_model->get_all_with_pagination_search($group_id, $per_page, $per_page*$this->data['page'], $keywords);
        if ($group_id == 3) {
            foreach ($users as $key => $value) {
                $company = $this->information_model->fetch_client_id($value['id']);
                $users[$key]['member_id'] = $company['member_id'];
                $users[$key]['status'] = $this->status_model->fetch_by_client_id($value['user_id']);
            }
        }
        if($this->data['page'] == 0){
            $number = $total_rows;
        }elseif($total_rows < ($this->data['page'] + 1) * $per_page){
            $number = $total_rows - ($this->data['page'] * $per_page);
        }elseif($this->data['page'] > 0 && $total_rows > ($this->data['page'] + 1) * $per_page){
            $number = $total_rows - ($this->data['page'] * $per_page);
        };

        $this->data['number'] = $number;
        $this->data['group_id'] = $group_id;
        $this->data['group'] = $group_id;
        $this->data['users'] = $users;
        $this->render('admin/users/list_users_member_view');
    }

    public function create($group_id = null){
        $this->data['page_title'] = 'Tạo mới thành viên hội đồng';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('member_role','Member Role','trim|required');
        $this->form_validation->set_rules('first_name','First name','trim');
        $this->form_validation->set_rules('last_name','Last name','trim');
        $this->form_validation->set_rules('company','Company','trim');
        $this->form_validation->set_rules('position','Position','trim');
        $this->form_validation->set_rules('phone','Phone','trim');
        $this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('password_confirm','Password confirmation','required|matches[password]');
        // $this->form_validation->set_rules('groups[]','Groups','required|integer');

        if($this->form_validation->run()===FALSE) {
            $this->data['groups'] = $this->ion_auth->groups()->result();
            $this->load->helper('form');
            $this->render('admin/users/create_user_view');
        } else {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $group_ids = array($group_id);

            $additional_data = array(
                'member_role' => $this->input->post('member_role'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'position' => $this->input->post('position'),
                'phone' => $this->input->post('phone'),
                'active' => 1,
            );
            $register = $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);

            if($register){
                if($group_id == 3){
                    $this->load->model('status_model');
                    $status = array(
                        'client_id' => $register,
                        'is_information' => 0,
                        'is_company' => 0,
                        'is_product' => 0,
                        'is_final' => 0
                    );
                    $this->status_model->insert('status', $status);
                }
            }
            $this->session->set_flashdata('message',$this->ion_auth->messages());
            if($group_id == 3){
                redirect('admin/users/index/' . $group_id,'refresh');
            }else{
                redirect('admin/users/index_member/' . $group_id,'refresh');
            }
        }
    }

    public function edit($user_id = NULL){
        $user_id = $this->input->post('user_id') ? $this->input->post('user_id') : $user_id;
        $this->data['page_title'] = 'Edit user';
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name','First name','trim');
        $this->form_validation->set_rules('last_name','Last name','trim');
        $this->form_validation->set_rules('company','Company','trim');
        $this->form_validation->set_rules('position','Position','trim');
        $this->form_validation->set_rules('phone','Phone','trim');
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','min_length[6]');
        $this->form_validation->set_rules('password_confirm','Password confirmation','matches[password]');
        // $this->form_validation->set_rules('groups[]','Groups','required|integer');
        $this->form_validation->set_rules('user_id','User ID','trim|integer|required');

        if($this->form_validation->run() === FALSE) {
            if($user = $this->ion_auth->user((int) $user_id)->row()) {
                $this->data['user'] = $user;
            } else {
                $this->session->set_flashdata('message', 'The user doesn\'t exist.');
                redirect('admin/users', 'refresh');
            }
            $this->data['groups'] = $this->ion_auth->groups()->result();
            $this->data['usergroups'] = array();
            if($usergroups = $this->ion_auth->get_users_groups($user->id)->result()) {
                foreach($usergroups as $group) {
                    $this->data['usergroups'][] = $group->id;
                }
            }
            $this->load->helper('form');
            $this->render('admin/users/edit_user_view');
        } else {
            $user_id = $this->input->post('user_id');
            $new_data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'position' => $this->input->post('position'),
                'phone' => $this->input->post('phone')
            );
            if(strlen($this->input->post('password'))>=6) $new_data['password'] = $this->input->post('password');

            $this->ion_auth->update($user_id, $new_data);

            //Update the groups user belongs to
            // $groups = $this->input->post('groups');
            // if (isset($groups) && !empty($groups)) {
            //     $this->ion_auth->remove_from_group('', $user_id);
            //     foreach ($groups as $group) {
            //         $this->ion_auth->add_to_group($group, $user_id);
            //     }
            // }

            $this->session->set_flashdata('message',$this->ion_auth->messages());

            if($this->input->post('user_group') == 3){
                redirect('admin/users/index/' . $this->input->post('user_group'),'refresh');
            }else{
                redirect('admin/users/index_member/' . $this->input->post('user_group'),'refresh');
            }
        }
    }

    public function delete(){
        $id = $this->input->get('id');
        if(is_null($id)){
            $this->session->set_flashdata('message','There\'s no user to delete');
        } else {
            $result = $this->ion_auth->delete_user($id);
            $this->session->set_flashdata('message',$this->ion_auth->messages());

            if($result == false){
                $this->output->set_status_header(404)
                    ->set_output(json_encode(array('message' => 'Fail', 'data' => $id)));
            }else{
                $this->output->set_status_header(200)
                    ->set_output(json_encode(array('message' => 'Success', 'data' => $id)));
            }
        }
    }

    public function active(){
        $id = $this->input->get('id');
        if(is_null($id)){
            $this->session->set_flashdata('message','There\'s no user to active');
        } else {
            $user = $this->ion_auth->user((int) $id)->row();
            $result = $this->ion_auth->set_active($id);
            $this->session->set_flashdata('message',$this->ion_auth->messages());

            if($result == false){
                $this->output->set_status_header(404)
                    ->set_output(json_encode(array('message' => 'Fail', 'data' => $id)));
            }else{
                $this->send_mail($user->email);
                $this->output->set_status_header(200)
                    ->set_output(json_encode(array('message' => 'Success', 'data' => $id)));
            }
        }
    }

    public function send_mail($email) {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "smtp.gmail.com"; // specify main and backup server
        $mail->Port = 465; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = 'ssl';
        $mail->Username = "nghemalao@gmail.com"; // your SMTP username or your gmail username
        $mail->Password = "Huongdan1"; // your SMTP password or your gmail password
        $from = "nghemalao@gmail.com"; // Reply to this email
        $to = $email; // Recipients email ID
        $name = 'WEBMAIL'; // Recipient's name
        $mail->From = $from;
        $mail->FromName = $name; // Name to indicate where the email came from when the recepient received
        $mail->AddAddress($to, $name);
        $mail->CharSet = 'UTF-8';
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = "Mail từ " . strip_tags($email);

        $mail->Body = $this->email_template($email); //HTML Body

        if(!$mail->Send()){
            $this->output->set_status_header(200)->set_output(json_encode(array('mail_send' => 'Fail')));
        } else {
            $this->output->set_status_header(200)->set_output(json_encode(array('mail_send' => 'Success')));
        }

    }

    public function email_template($data){
        $message = 'Test body';

        return $message;
    }

    public function list_client($id){
        $this->load->model('users_model');
        $this->data['page_title'] = 'Quản lý user';
        $this->data['users'] = $this->users_model->fetch_all_client($id);
        $this->render('admin/users/list_client_of_member_view');
    }
    
    public function open_final($client_id){
        $information = array(
            'is_information' => 0,
            'is_company' => 0,
            'is_product' => 0,
            'is_final' => 0,
        );
        if($client_id){
            $update = $this->status_model->update('status', $client_id, $information);
            if($update){
                return $this->output->set_status_header(200)
                    ->set_output(json_encode(array('message' => 'done')));
            }
        }
    }
}