<?php
include "class.phpmailer.php";
include "class.smtp.php";

defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends Client_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('clients')) {
            //redirect them to the login page
            redirect('client/user/login', 'refresh');
        }

        $this->load->helper('url');
        $this->load->model('information_model');
        $this->load->model('status_model');
        $this->load->model('users_model');
        $this->load->library('session');

        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['reg_status'] = $this->status_model->fetch_by_client_id($this->data['user']->id);
        $this->data['groups'] = $this->config->item('development/config_information')['groups'];

    }

    public function index() {
        $this->data['submitted'] = $this->information_model->fetch_by_user_id('information', $this->data['user']->id);
        $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCompany($this->data['user']->username, $this->data['eventYear']);

        $this->render('client/information/detail_extra_view');
    }

    public function extra() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->data['extra'] = $this->information_model->fetch_extra_by_identity('information', $this->data['user']->username);
        $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCompany($this->data['user']->username, $this->data['eventYear']);
        $this->data['founding_date'] = $this->data['user']->founding_date;
        $this->render('client/information/detail_extra_view');
    }

    public function create_extra() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('legal_representative', 'Tên người đại diện pháp luật', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('lp_position', 'Chức danh', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('connector', 'Tên người liên hệ với BTC', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('c_position', 'Chức danh người liên hệ với BTC', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('lp_email', 'Email', 'trim|required|valid_email', array(
            'required' => '%s không được trống.',
            'valid_email' => 'Định dạng email không đúng.',
        ));
        $this->form_validation->set_rules('lp_phone', 'Di động', 'trim|required|integer|min_length[10]|max_length[12]', array(
            'required' => '%s không được trống.',
            'integer' => '%s phải là số nguyên.',
            'min_length' => '%s tối thiểu %s ký tự.',
            'max_length' => '%s tối đa %s ký tự.',
        ));

        $this->form_validation->set_rules('c_email', 'Email người liên hệ với BTC', 'trim|required|valid_email', array(
            'required' => '%s không được trống.',
            'valid_email' => 'Định dạng email không đúng.',
        ));
        $this->form_validation->set_rules('c_phone', 'Di động người liên hệ với BTC', 'trim|required|integer|min_length[10]|max_length[12]', array(
            'required' => '%s không được trống.',
            'integer' => '%s phải là số nguyên.',
            'min_length' => '%s tối thiểu %s ký tự.',
            'max_length' => '%s tối đa %s ký tự.',
        ));
        $this->form_validation->set_rules('link', 'Link phiếu đăng ký', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('founding_date', 'Ngày thành lập', 'trim|date_formats', array(
            'date_formats' => '%s không đúng định dạng.',
        ));
        $this->form_validation->set_rules('certificate_date', 'Ngày cấp', 'trim|date_formats', array(
            'date_formats' => '%s không đúng định dạng.',
        ));
//        $this->form_validation->set_rules('link', 'Link download PĐK của DN', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            if($this->data['reg_status'] == 1){
                redirect('client/information', 'refresh');
            }
            $this->data['identity'] = $this->input->get('identity');
            $exist = $this->information_model->check_exist_information($this->input->get('identity'));
            if(!empty($exist)){
                $this->data['exist'] = $exist;
            }
            $this->data['founding_date'] = $this->data['user']->founding_date;
            $this->render('client/information/create_extra_view');
        } else {
            if ($this->input->post()) {
                if(!empty($_FILES['avatar']['name'])){
                    $this->check_img($_FILES['avatar']['name'], $_FILES['avatar']['size']);
                    $avatar = $this->upload_avatar('avatar', 'assets/upload/avatar', $_FILES['avatar']['name']);
                }
                $data = array(
                    'client_id' => $this->data['user']->id,
                    // New
                    'founding_date' => date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $this->input->post('founding_date')))),
                    'certificate' => $this->input->post('certificate'),
                    'link' => $this->input->post('link'),
                    'certificate_date' => date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $this->input->post('certificate_date')))),
                    'headquarters' => $this->input->post('headquarters'),
                    'h_phone' => $this->input->post('h_phone'),
                    'h_fax' => $this->input->post('h_fax'),
                    'h_email' => $this->input->post('h_email'),
                    // End New

                    'website' => $this->input->post('website'),

                    'legal_representative' => $this->input->post('legal_representative'),
                    'lp_position' => $this->input->post('lp_position'),
                    'lp_email' => $this->input->post('lp_email'),
                    'lp_phone' => $this->input->post('lp_phone'),

                    'connector' => $this->input->post('connector'),
                    'c_position' => $this->input->post('c_position'),
                    'c_email' => $this->input->post('c_email'),
                    'c_phone' => $this->input->post('c_phone'),

                    'identity' => $this->data['user']->username,
                    'created_at' => $this->author_info['created_at'],
                    'created_by' => $this->author_info['created_by'],
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );
                if (!empty($avatar)) {
                    $data['avatar'] = $avatar;
                }
                $exist = $this->information_model->check_exist_information($this->data['user']->username);
                if(!empty($exist)){
                    unset($data['created_at']);
                    unset($data['created_by']);
                    $update = $this->information_model->update_by_identity('information', $this->data['user']->username, $data);
                    $this->status_model->update('status', $this->data['user']->id, array('is_information' => 1, 'year' => $this->data['eventYear']));
                    $this->users_model->update('users', $this->data['user']->id, array('information_id' => $exist['id'], 'company' => $this->input->post('company')));
                }else{
                    $insert = $this->information_model->insert('information', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_information' => 1));
                    $this->users_model->update('users', $this->data['user']->id, array('information_id' => $insert, 'company' => $this->input->post('company')));
                    $this->session->set_flashdata('message', 'Item added successfully');
                }
                redirect('client/information/extra', 'refresh');
            }
        }
    }

    public function edit_extra($request_id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('legal_representative', 'Tên người đại diện pháp luật', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('lp_position', 'Chức danh', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('connector', 'Tên người liên hệ với BTC', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('c_position', 'Chức danh người liên hệ với BTC', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('lp_email', 'Email', 'trim|required|valid_email', array(
            'required' => '%s không được trống.',
            'valid_email' => 'Định dạng email không đúng.',
        ));
        $this->form_validation->set_rules('lp_phone', 'Di động', 'trim|required|integer|min_length[10]|max_length[12]', array(
            'required' => '%s không được trống.',
            'integer' => '%s phải là số nguyên.',
            'min_length' => '%s tối thiểu %s ký tự.',
            'max_length' => '%s tối đa %s ký tự.',
        ));

        $this->form_validation->set_rules('c_email', 'Email người liên hệ với BTC', 'trim|required|valid_email', array(
            'required' => '%s không được trống.',
            'valid_email' => 'Định dạng email không đúng.',
        ));
        $this->form_validation->set_rules('c_phone', 'Di động người liên hệ với BTC', 'trim|required|integer|min_length[10]|max_length[12]', array(
            'required' => '%s không được trống.',
            'integer' => '%s phải là số nguyên.',
            'min_length' => '%s tối thiểu %s ký tự.',
            'max_length' => '%s tối đa %s ký tự.',
        ));
        $this->form_validation->set_rules('founding_date', 'Ngày thành lập', 'trim|date_formats', array(
            'date_formats' => '%s không đúng định dạng.',
        ));
        $this->form_validation->set_rules('link', 'Link phiếu đăng ký', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('certificate_date', 'Ngày cấp', 'trim|date_formats', array(
            'date_formats' => '%s không đúng định dạng.',
        ));
//        $this->form_validation->set_rules('link', 'Link download PĐK của DN', 'trim|required');

        $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
        $this->data['extra'] = $this->information_model->fetch_by_user_identity('information', $this->data['user']->username);
        $this->data['founding_date'] = $this->data['user']->founding_date;
        if ($this->form_validation->run() == FALSE) {
            if (!$this->data['extra']) {
                redirect('client/information', 'refresh');
            }

            if($this->data['reg_status'] == 1){
                redirect('client/information', 'refresh');
            }

            $this->render('client/information/edit_extra_view');
        } else {
            if ($this->input->post()) {
                $avatar = '';
                if(!empty($_FILES['avatar']['name'])){
                    $this->check_img($_FILES['avatar']['name'], $_FILES['avatar']['size']);
                    $avatar = $this->upload_avatar('avatar', 'assets/upload/avatar', $_FILES['avatar']['name']);
                }

                $data = array(
                    'founding_date' => date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $this->input->post('founding_date')))),
                    'certificate' => $this->input->post('certificate'),
                    'link' => $this->input->post('link'),
                    'certificate_date' => date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $this->input->post('certificate_date')))),
                    'headquarters' => $this->input->post('headquarters'),
                    'h_phone' => $this->input->post('h_phone'),
                    'h_fax' => $this->input->post('h_fax'),
                    'h_email' => $this->input->post('h_email'),

                    'legal_representative' => $this->input->post('legal_representative'),
                    'lp_position' => $this->input->post('lp_position'),
                    'lp_email' => $this->input->post('lp_email'),
                    'lp_phone' => $this->input->post('lp_phone'),
                    'connector' => $this->input->post('connector'),
                    'c_position' => $this->input->post('c_position'),
                    'c_email' => $this->input->post('c_email'),
                    'c_phone' => $this->input->post('c_phone'),
                    'website' => $this->input->post('website'),
//                    'link' => $this->input->post('link'),
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                if ($avatar) {
                    $data = array('avatar' => $avatar);
                }

                try {
                    $this->information_model->update_by_identity('information', $this->data['user']->username, $data);
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_information' => 1));
                    if ( file_exists('assets/upload/avatar/' . $this->data['extra']['avatar']) && $avatar !='' ) {
                        unlink('assets/upload/avatar/' . $this->data['extra']['avatar']);
                    }
                    $this->session->set_flashdata('message', 'Item updated successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                }

                redirect('client/information/extra', 'refresh');
            }
        }
    }

    public function company(){

        $this->load->helper('form');
        if($this->input->get('year')){
            $this->data['year'] = $this->input->get('year');
            $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('company', $this->data['user']->username, $this->input->get('year'));
            if (!$this->data['company']) {
                redirect('client/information/company', 'refresh');
            }
            $this->render('client/information/detail_company_view');
        }else{
            $this->load->library('pagination');
            $config = array();
            $base_url = base_url() . 'client/information/company';
            $total_rows = $this->information_model->count_companies($this->data['user']->username);
            $per_page = 10;
            $uri_segment = 4;
            foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
                $config[$key] = $value;
            }
            $this->pagination->initialize($config);

            $this->data['page_links'] = $this->pagination->create_links();
            $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $this->data['companies'] =  $this->information_model->fetch_list_company_by_identity($this->data['user']->username);
            $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCompany($this->data['user']->username, $this->data['eventYear']);
            $this->render('client/information/list_company_view');
        }
    }

    public function create_company() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $client_id = $this->data['user_info']->id;
        $data_where = array(
            'client_id' => $client_id,
            'year' => $this->data['eventYear']
        );
        $check_db_company_for_user = $this->information_model->check_db_company_for_user('company', $data_where);
        if($check_db_company_for_user > 0){
            $this->session->set_flashdata('message_error', 'Bạn đã tạo thông tin doanh nghiệp của bạn ở năm hiện tại vui lòng cập nhật nếu bạn muốn sửa lại!');
            redirect('client/dashboard', 'refresh');
        }
        if($this->input->post('submit') == 'Hoàn thành') {

            // add field 25/08/2020
            $this->form_validation->set_rules('proportion_market_local', 'Thị trường nội địa', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_europe', 'Thị trường Châu Âu', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_america', 'Thị trường Mỹ', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_japan', 'Thị trường Nhật', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_other_international', 'Thị trường quốc tế khác', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));


            $this->form_validation->set_rules('equity_1', 'Vốn điều lệ ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_percent_1', 'Vốn điều lệ ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_2', 'Vốn điều lệ ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_percent_2', 'Vốn điều lệ ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('total_assets_1', 'Tổng tài sản ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_percent_1', 'Tổng tài sản ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_2', 'Tổng tài sản ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_percent_2', 'Tổng tài sản ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('total_income_1', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_percent_1', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_2', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_percent_2', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('per_capita_income_1', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_percent_1', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_2', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_percent_2', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('software_income_1', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_percent_1', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_2', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_percent_2', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('it_income_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_percent_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_percent_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('domestic_income_1', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_percent_1', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_2', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_percent_2', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('owner_equity_1', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_percent_1', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_2', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_percent_2', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|required|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));

            /** =================================================== */
            $this->form_validation->set_rules('number_personnel_nominated_1', 'Số lượng nhân sự trong lĩnh vực đề cử 1', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('before_tax_profit_1', 'Tổng số lập trình viên ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_percent_1', 'Tổng số lập trình viên ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_2', 'Tổng số lập trình viên ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_percent_2', 'Tổng số lập trình viên ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('number_personnel_nominated_1', 'Tổng số nhân viên toàn thời gian', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('average_age', 'Độ tuổi trung bình', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('employee_change_percent_1', 'Tỷ lệ tăng/giảm nhân sự năm ' . $this->data['rule2Year'][0], 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('employee_change_percent_2', 'Tỷ lệ tăng/giảm nhân sự năm ' . $this->data['rule2Year'][1], 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('employee_change_percent_3', 'Tỷ lệ tăng/giảm nhân sự đến tháng 6.2020', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            // da update
            /** =================================================== */
            $this->form_validation->set_rules('average_salary', 'Mức lương trung bình/năm 2019 ', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('recruitment_budget', 'Chi phí cho hoạt động tuyển dụng nhân sự năm 2019 ', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('investment_fund_r_and_d', ' Chi phí đầu tư cho hoạt động R&D năm 2019 (Tổng chi phí) ', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('investment_fund_r_and_d_percent', 'Chi phí đầu tư cho hoạt động R&D năm 2019 (% trên tổng doanh thu)', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('staff_r_and_d', 'Số lượng nhân viên bộ phận R&D năm 2019', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            // $this->form_validation->set_rules('training_process', 'Công tác đào tạo, bồi dưỡng nhân lực ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('training_process', 'Công tác đào tạo, bồi dưỡng nhân lực ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('top5_customers', 'Giới thiệu tóm tắt 05 khách hàng/dự án tiêu biểu doanh nghiệp đã thực hiện ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('top5_customers', 'Giới thiệu tóm tắt 05 khách hàng/dự án tiêu biểu doanh nghiệp đã thực hiện ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('technology_certificate', 'Các chứng chỉ về công nghệ/ các công nghệ doanh nghiệp đang sử dụng/các công nghệ là thế mạnh của doanh nghiệp (đặc biệt là các công nghệ mới của CMCN 4.0) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('technology_certificate', 'Các chứng chỉ về công nghệ/ các công nghệ doanh nghiệp đang sử dụng/các công nghệ là thế mạnh của doanh nghiệp (đặc biệt là các công nghệ mới của CMCN 4.0) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('result_r_and_d', 'Thành quả nổi bật của hoạt động R&D năm 2019 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('result_r_and_d', 'Thành quả nổi bật của hoạt động R&D năm 2019 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('technique_certificate', 'Năng lực quản lý, chất lượng: (Các chứng chỉ về quản lý, quy trình, chất lượng) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('technique_certificate', 'Năng lực quản lý, chất lượng: (Các chứng chỉ về quản lý, quy trình, chất lượng) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('specific_certificate', 'Các chứng chỉ năng lực đặc thù của lĩnh vực hoạt động (nếu có) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('specific_certificate', 'Các chứng chỉ năng lực đặc thù của lĩnh vực hoạt động (nếu có) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('reward', '(Ghi rõ tên, thời gian nhận Giải thưởng, Danh hiệu và thành tích được công nhận trong các hoạt động thể hiện trách nhiệm với xã hội của doanh nghiệp (CSR)) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('reward', '(Ghi rõ tên, thời gian nhận Giải thưởng, Danh hiệu và thành tích được công nhận trong các hoạt động thể hiện trách nhiệm với xã hội của doanh nghiệp (CSR)) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('startup_plan_capital_future', 'Kế hoạch gọi vốn trong tương lai ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('startup_plan_capital_future', 'Kế hoạch gọi vốn trong tương lai ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('startup_plan_ipo', 'Kế hoạch IPO ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('startup_plan_ipo', 'Kế hoạch IPO ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_1', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 1 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_1', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 1 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_2', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 2 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_2', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 2 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_3', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 3 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_3', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 3 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('product', 'Tên các sản phẩm, dịch vụ chính của doanh nghiệp ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('product', 'Tên các sản phẩm, dịch vụ chính của doanh nghiệp ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('security_certificate', 'Các chứng chỉ bảo mật ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('security_certificate', 'security_certificate ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('security_process', 'Các quy trình/các biện pháp an ninh ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('security_process', 'Các quy trình/các biện pháp an ninh ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('overview', 'Giới thiệu doanh nghiệp ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('overview', 'Giới thiệu doanh nghiệp ', 'callback_check_word_length');
            /** =================================================== */

            $this->form_validation->set_rules('main_service[]', 'Sản phẩm dịch vụ chính của doanh nghiệp', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            $this->form_validation->set_rules('main_market[]', 'Thị trường chính', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            if ($this->form_validation->run() === FALSE) {
                if($this->data['reg_status']['is_information'] == 0){
                    $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
                    redirect('client/information/create_extra', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/information/company', 'refresh');
                }
                $this->data['year'] = $this->input->get('year');
                $this->render('client/information/create_company_view');
            } else {
                if ($this->input->post()) {
                    $main_service = json_encode($this->input->post('main_service'));
                    $main_market = json_encode($this->input->post('main_market'));
                    $group_data = (array)$this->input->post('group');
                    if (count($group_data) > 3) {
                        array_splice($group_data, 3);
                    }

                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'group' => json_encode($group_data),
                        'group10' => $this->input->post('group10'),
                        'overview' => $this->input->post('overview'),
                        'active_area' => $this->input->post('active_area'),
                        'product' => $this->input->post('product'),
                        'top5_customers' => $this->input->post('top5_customers'),

                        // add field 25/08/2020
                        'proportion_market_local' => strstr($this->input->post('proportion_market_local'),',') ? str_replace(',', '.', $this->input->post('proportion_market_local')) : $this->input->post('proportion_market_local'),
                        'proportion_market_europe' => strstr($this->input->post('proportion_market_europe'),',') ? str_replace(',', '.', $this->input->post('proportion_market_europe')) : $this->input->post('proportion_market_europe'),
                        'proportion_market_america' => strstr($this->input->post('proportion_market_america'),',') ? str_replace(',', '.', $this->input->post('proportion_market_america')) : $this->input->post('proportion_market_america'),
                        'proportion_market_japan' => strstr($this->input->post('proportion_market_japan'),',') ? str_replace(',', '.', $this->input->post('proportion_market_japan')) : $this->input->post('proportion_market_japan'),
                        'proportion_market_other_international' => strstr($this->input->post('proportion_market_other_international'),',') ? str_replace(',', '.', $this->input->post('proportion_market_other_international')) : $this->input->post('proportion_market_other_international'),
                        'technology_certificate' => $this->input->post('technology_certificate'),
                        'specific_certificate' => $this->input->post('specific_certificate'),
                        // Năng lực gọi vốn (dành riêng cho các DN Startup)
                        'startup_amount_capital' => $this->input->post('startup_amount_capital'),
                        'startup_number_investors' => $this->input->post('startup_number_investors'),
                        'startup_plan_capital_future' => $this->input->post('startup_plan_capital_future'),
                        'startup_plan_ipo' => $this->input->post('startup_plan_ipo'),
                        'employee_change_percent_3' => $this->input->post('employee_change_percent_3'),

                        // add field 28/08/2020
                        'nomination_income_1' => strstr($this->input->post('nomination_income_1'),',') ? str_replace(',', '.', $this->input->post('nomination_income_1')) : $this->input->post('nomination_income_1'),
                        'nomination_income_percent_1' => strstr($this->input->post('nomination_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('nomination_income_percent_1')) : $this->input->post('nomination_income_percent_1'),
                        'nomination_income_2' => strstr($this->input->post('nomination_income_2'),',') ? str_replace(',', '.', $this->input->post('nomination_income_2')) : $this->input->post('nomination_income_2'),
                        'nomination_income_percent_2' => strstr($this->input->post('nomination_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('nomination_income_percent_2')) : $this->input->post('nomination_income_percent_2'),
                        'number_personnel_nominated_1' => strstr($this->input->post('number_personnel_nominated_1'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_1')) : $this->input->post('number_personnel_nominated_1'),
                        'number_personnel_nominated_2' => strstr($this->input->post('number_personnel_nominated_2'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_2')) : $this->input->post('number_personnel_nominated_2'),
                        'number_personnel_nominated_3' => strstr($this->input->post('number_personnel_nominated_3'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_3')) : $this->input->post('number_personnel_nominated_3'),
                        'products_solutions_nominated_1' => $this->input->post('products_solutions_nominated_1'),
                        'products_solutions_nominated_2' => $this->input->post('products_solutions_nominated_2'),
                        'products_solutions_nominated_3' => $this->input->post('products_solutions_nominated_3'),
                        // end


                        // Vốn điều lệ
                        'equity_1' => strstr($this->input->post('equity_1'),',') ? str_replace(',', '.', $this->input->post('equity_1')) : $this->input->post('equity_1'),
                        'equity_percent_1' => strstr($this->input->post('equity_percent_1'),',') ? str_replace(',', '.', $this->input->post('equity_percent_1')) : $this->input->post('equity_percent_1'),
                        'equity_2' => strstr($this->input->post('equity_2'),',') ? str_replace(',', '.', $this->input->post('equity_2')) : $this->input->post('equity_2'),
                        'equity_percent_2' => strstr($this->input->post('equity_percent_2'),',') ? str_replace(',', '.', $this->input->post('equity_percent_2')) : $this->input->post('equity_percent_2'),

                        // Vốn chủ sở hữu
                        'owner_equity_1' => strstr($this->input->post('owner_equity_1'),',') ? str_replace(',', '.', $this->input->post('owner_equity_1')) : $this->input->post('owner_equity_1'),
                        'owner_equity_percent_1' => strstr($this->input->post('owner_equity_percent_1'),',') ? str_replace(',', '.', $this->input->post('owner_equity_percent_1')) : $this->input->post('owner_equity_percent_1'),
                        'owner_equity_2' => strstr($this->input->post('owner_equity_2'),',') ? str_replace(',', '.', $this->input->post('owner_equity_2')) : $this->input->post('owner_equity_2'),
                        'owner_equity_percent_2' => strstr($this->input->post('owner_equity_percent_2'),',') ? str_replace(',', '.', $this->input->post('owner_equity_percent_2')) : $this->input->post('owner_equity_percent_2'),

                        // Tổng tài sản
                        // New
                        'total_assets_1' => strstr($this->input->post('total_assets_1'),',') ? str_replace(',', '.', $this->input->post('total_assets_1')) : $this->input->post('total_assets_1'),
                        'total_assets_percent_1' => strstr($this->input->post('total_assets_percent_1'),',') ? str_replace(',', '.', $this->input->post('total_assets_percent_1')) : $this->input->post('total_assets_percent_1'),
                        'total_assets_2' => strstr($this->input->post('total_assets_2'),',') ? str_replace(',', '.', $this->input->post('total_assets_2')) : $this->input->post('total_assets_2'),
                        'total_assets_percent_2' => strstr($this->input->post('total_assets_percent_2'),',') ? str_replace(',', '.', $this->input->post('total_assets_percent_2')) : $this->input->post('total_assets_percent_2'),
                        // End New

                        // Tổng doanh thu doanh nghiệp
                        'total_income_1' => strstr($this->input->post('total_income_1'),',') ? str_replace(',', '.', $this->input->post('total_income_1')) : $this->input->post('total_income_1'),
                        'total_income_percent_1' => strstr($this->input->post('total_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('total_income_percent_1')) : $this->input->post('total_income_percent_1'),
                        'total_income_2' => strstr($this->input->post('total_income_2'),',') ? str_replace(',', '.', $this->input->post('total_income_2')) : $this->input->post('total_income_2'),
                        'total_income_percent_2' => strstr($this->input->post('total_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('total_income_percent_2')) : $this->input->post('total_income_percent_2'),
                        'total_income_6_months' => strstr($this->input->post('total_income_6_months'),',') ? str_replace(',', '.', $this->input->post('total_income_6_months')) : $this->input->post('total_income_6_months'),
                        // End New

                        // Bình quân doanh thu/đầu người
                        // New
                        'per_capita_income_1' => strstr($this->input->post('per_capita_income_1'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_1')) : $this->input->post('per_capita_income_1'),
                        'per_capita_income_percent_1' => strstr($this->input->post('per_capita_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_percent_1')) : $this->input->post('per_capita_income_percent_1'),
                        'per_capita_income_2' => strstr($this->input->post('per_capita_income_2'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_2')) : $this->input->post('per_capita_income_2'),
                        'per_capita_income_percent_2' => strstr($this->input->post('per_capita_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_percent_2')) : $this->input->post('per_capita_income_percent_2'),
                        'per_capita_income_6_months' => strstr($this->input->post('per_capita_income_6_months'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_6_months')) : $this->input->post('per_capita_income_6_months'),
                        // End New

                        // Tổng doanh thu lĩnh vực phần mềm, giải pháp
                        'software_income_1' => strstr($this->input->post('software_income_1'),',') ? str_replace(',', '.', $this->input->post('software_income_1')) : $this->input->post('software_income_1'),
                        'software_income_percent_1' => strstr($this->input->post('software_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('software_income_percent_1')) : $this->input->post('software_income_percent_1'),
                        'software_income_2' => strstr($this->input->post('software_income_2'),',') ? str_replace(',', '.', $this->input->post('software_income_2')) : $this->input->post('software_income_2'),
                        'software_income_percent_2' => strstr($this->input->post('software_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('software_income_percent_2')) : $this->input->post('software_income_percent_2'),
                        'software_income_6_months' => strstr($this->input->post('software_income_6_months'),',') ? str_replace(',', '.', $this->input->post('software_income_6_months')) : $this->input->post('software_income_6_months'),
                        // End New

                        // Tổng doanh thu dịch vụ CNTT
                        'it_income_1' => strstr($this->input->post('it_income_1'),',') ? str_replace(',', '.', $this->input->post('it_income_1')) : $this->input->post('it_income_1'),
                        'it_income_percent_1' => strstr($this->input->post('it_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('it_income_percent_1')) : $this->input->post('it_income_percent_1'),
                        'it_income_2' => strstr($this->input->post('it_income_2'),',') ? str_replace(',', '.', $this->input->post('it_income_2')) : $this->input->post('it_income_2'),
                        'it_income_percent_2' => strstr($this->input->post('it_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('it_income_percent_2')) : $this->input->post('it_income_percent_2'),
                        'it_income_6_months' => strstr($this->input->post('it_income_6_months'),',') ? str_replace(',', '.', $this->input->post('it_income_6_months')) : $this->input->post('it_income_6_months'),
                        // End New

                        // Tổng doanh thu xuất khẩu
                        'export_income_1' => strstr($this->input->post('export_income_1'),',') ? str_replace(',', '.', $this->input->post('export_income_1')) : $this->input->post('export_income_1'),
                        'export_income_percent_1' => strstr($this->input->post('export_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('export_income_percent_1')) : $this->input->post('export_income_percent_1'),
                        'export_income_2' => strstr($this->input->post('export_income_2'),',') ? str_replace(',', '.', $this->input->post('export_income_2')) : $this->input->post('export_income_2'),
                        'export_income_percent_2' => strstr($this->input->post('export_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('export_income_percent_2')) : $this->input->post('export_income_percent_2'),
                        'export_income_6_months' => strstr($this->input->post('export_income_6_months'),',') ? str_replace(',', '.', $this->input->post('export_income_6_months')) : $this->input->post('export_income_6_months'),
                        // End New

                        // Tổng doanh thu của lĩnh vực ứng cử:
                        // Thị trường quốc tế
                        // New
                        'international_income_1' => strstr($this->input->post('international_income_1'),',') ? str_replace(',', '.', $this->input->post('international_income_1')) : $this->input->post('international_income_1'),
                        'international_income_percent_1' => strstr($this->input->post('international_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('international_income_percent_1')) : $this->input->post('international_income_percent_1'),
                        'international_income_2' => strstr($this->input->post('international_income_2'),',') ? str_replace(',', '.', $this->input->post('international_income_2')) : $this->input->post('international_income_2'),
                        'international_income_percent_2' => strstr($this->input->post('international_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('international_income_percent_2')) : $this->input->post('international_income_percent_2'),
                        'international_income_6_months' => strstr($this->input->post('international_income_6_months'),',') ? str_replace(',', '.', $this->input->post('international_income_6_months')) : $this->input->post('international_income_6_months'),
                        // End New

                        // Tổng doanh thu của lĩnh vực ứng cử:
                        // Thị trường nội địa
                        // New
                        'domestic_income_1' => strstr($this->input->post('domestic_income_1'),',') ? str_replace(',', '.', $this->input->post('domestic_income_1')) : $this->input->post('domestic_income_1'),
                        'domestic_income_percent_1' => strstr($this->input->post('domestic_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('domestic_income_percent_1')) : $this->input->post('domestic_income_percent_1'),
                        'domestic_income_2' => strstr($this->input->post('domestic_income_2'),',') ? str_replace(',', '.', $this->input->post('domestic_income_2')) : $this->input->post('domestic_income_2'),
                        'domestic_income_percent_2' => strstr($this->input->post('domestic_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('domestic_income_percent_2')) : $this->input->post('domestic_income_percent_2'),
                        'domestic_income_6_months' => strstr($this->input->post('domestic_income_6_months'),',') ? str_replace(',', '.', $this->input->post('domestic_income_6_months')) : $this->input->post('domestic_income_6_months'),
                        // End New

                        // Tổng số lập trình viên
                        // New
                        'before_tax_profit_1' => strstr($this->input->post('before_tax_profit_1'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_1')) : $this->input->post('before_tax_profit_1'),
                        'before_tax_profit_percent_1' => strstr($this->input->post('before_tax_profit_percent_1'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_percent_1')) : $this->input->post('before_tax_profit_percent_1'),
                        'before_tax_profit_2' => strstr($this->input->post('before_tax_profit_2'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_2')) : $this->input->post('before_tax_profit_2'),
                        'before_tax_profit_percent_2' => strstr($this->input->post('before_tax_profit_percent_2'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_percent_2')) : $this->input->post('before_tax_profit_percent_2'),
                        'before_tax_profit_6_months' => strstr($this->input->post('before_tax_profit_6_months'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_6_months')) : $this->input->post('before_tax_profit_6_months'),
                        // End New

                        // New
                        // Tổng số nhân viên toàn thời gian
                        'full_time_employee' => strstr($this->input->post('full_time_employee'),',') ? str_replace(',', '.', $this->input->post('full_time_employee')) : $this->input->post('full_time_employee'),
                        // Độ tuổi trung bình
                        'average_age' => strstr($this->input->post('average_age'),',') ? str_replace(',', '.', $this->input->post('average_age')) : $this->input->post('average_age'),
                        // Tỷ lệ tăng/giảm nhân sự hàng năm trong 02 năm gần nhất:
                        'employee_change_percent_1' => strstr($this->input->post('employee_change_percent_1'),',') ? str_replace(',', '.', $this->input->post('employee_change_percent_1')) : $this->input->post('employee_change_percent_1'),
                        'employee_change_percent_2' => strstr($this->input->post('employee_change_percent_2'),',') ? str_replace(',', '.', $this->input->post('employee_change_percent_2')) : $this->input->post('employee_change_percent_2'),

                        // Số nhân viên có thể sử dụng ngoại ngữ trong công việc
                        'english_employee' => strstr($this->input->post('english_employee'),',') ? str_replace(',', '.', $this->input->post('english_employee')) : $this->input->post('english_employee'),
                        'english_employee_percent' => strstr($this->input->post('english_employee_percent'),',') ? str_replace(',', '.', $this->input->post('english_employee_percent')) : $this->input->post('english_employee_percent'),
                        'japanese_employee' => strstr($this->input->post('japanese_employee'),',') ? str_replace(',', '.', $this->input->post('japanese_employee')) : $this->input->post('japanese_employee'),
                        'japanese_employee_percent' => strstr($this->input->post('japanese_employee_percent'),',') ? str_replace(',', '.', $this->input->post('japanese_employee_percent')) : $this->input->post('japanese_employee_percent'),
                        'other_language_employee' => strstr($this->input->post('other_language_employee'),',') ? str_replace(',', '.', $this->input->post('other_language_employee')) : $this->input->post('other_language_employee'),
                        'other_language_employee_percent' => strstr($this->input->post('other_language_employee_percent'),',') ? str_replace(',', '.', $this->input->post('other_language_employee_percent')) : $this->input->post('other_language_employee_percent'),
                        'other_language' => $this->input->post('other_language'),
                        // Trình độ chuyên môn
                        'qualification' => $this->input->post('qualification'),
                        // Mức lương trung bình/năm
                        'average_salary' => strstr($this->input->post('average_salary'),',') ? str_replace(',', '.', $this->input->post('average_salary')) : $this->input->post('average_salary'),
                        // Số nhân viên thuộc bộ phận chăm sóc khách hàng
                        'customer_supporter' => strstr($this->input->post('customer_supporter'),',') ? str_replace(',', '.', $this->input->post('customer_supporter')) : $this->input->post('customer_supporter'),
                        // Công tác đào tạo, bồi dưỡng nhân lực
                        'training_process' => $this->input->post('training_process'),
                        // Hoạt động tuyển dụng nhân sự
                        'recruitment_staff' => strstr($this->input->post('recruitment_staff'),',') ? str_replace(',', '.', $this->input->post('recruitment_staff')) : $this->input->post('recruitment_staff'),
                        'recruitment_budget' => strstr($this->input->post('recruitment_budget'),',') ? str_replace(',', '.', $this->input->post('recruitment_budget')) : $this->input->post('recruitment_budget'),
                        // Chi phí đầu tư cho hoạt động R&D
                        'investment_fund_r_and_d' => strstr($this->input->post('investment_fund_r_and_d'),',') ? str_replace(',', '.', $this->input->post('investment_fund_r_and_d')) : $this->input->post('investment_fund_r_and_d'),
                        'investment_fund_r_and_d_percent' => strstr($this->input->post('investment_fund_r_and_d_percent'),',') ? str_replace(',', '.', $this->input->post('investment_fund_r_and_d_percent')) : $this->input->post('investment_fund_r_and_d_percent'),
                        'staff_r_and_d' => strstr($this->input->post('staff_r_and_d'),',') ? str_replace(',', '.', $this->input->post('staff_r_and_d')) : $this->input->post('staff_r_and_d'),
                        'result_r_and_d' => $this->input->post('result_r_and_d'),
                        // Chế độ bảo mật của công ty và bảo mật cho khách hàng
                        'security_certificate' => $this->input->post('security_certificate'),
                        'security_process' => $this->input->post('security_process'),
                        // Quản lý công nghệ, chất lượng
                        'technique_certificate' => $this->input->post('technique_certificate'),
                        // HOẠT ĐỘNG CỘNG ĐỒNG, CÁC GIẢI THƯỞNG, DANH HIỆU VÀ CÁC THÀNH TÍCH ĐẶC BIỆT DOANH NGHIỆP ĐÃ ĐẠT ĐƯỢC
                        'reward' => $this->input->post('reward'),
                        // End New

                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'main_service' => $main_service,
                        'main_market' => $main_market,
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']


                    );

                    $insert = $this->information_model->insert_company('company', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_company' => 1));
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/information/company?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }else{

            // add field 25/08/2020
            $this->form_validation->set_rules('proportion_market_local', 'Thị trường nội địa', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_europe', 'Thị trường Châu Âu', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_america', 'Thị trường Mỹ', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_japan', 'Thị trường Nhật', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_other_international', 'Thị trường quốc tế khác', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));


            $this->form_validation->set_rules('equity_1', 'Vốn điều lệ ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_percent_1', 'Vốn điều lệ ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_2', 'Vốn điều lệ ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_percent_2', 'Vốn điều lệ ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('total_assets_1', 'Tổng tài sản ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_percent_1', 'Tổng tài sản ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_2', 'Tổng tài sản ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_percent_2', 'Tổng tài sản ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('total_income_1', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_percent_1', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_2', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_percent_2', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('per_capita_income_1', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_percent_1', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_2', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_percent_2', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('software_income_1', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_percent_1', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_2', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_percent_2', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('it_income_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_percent_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_percent_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('domestic_income_1', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_percent_1', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_2', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_percent_2', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('owner_equity_1', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_percent_1', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_2', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_percent_2', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));

            /** =================================================== */
            $this->form_validation->set_rules('number_personnel_nominated_1', 'Số lượng nhân sự trong lĩnh vực đề cử 1', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('before_tax_profit_1', 'Tổng số lập trình viên ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_percent_1', 'Tổng số lập trình viên ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_2', 'Tổng số lập trình viên ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_percent_2', 'Tổng số lập trình viên ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('full_time_employee', 'Tổng số nhân viên toàn thời gian', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('average_age', 'Độ tuổi trung bình', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('employee_change_percent_1', 'Tỷ lệ tăng/giảm nhân sự năm ' . $this->data['rule2Year'][0], 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('employee_change_percent_2', 'Tỷ lệ tăng/giảm nhân sự năm ' . $this->data['rule2Year'][1], 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('employee_change_percent_3', 'Tỷ lệ tăng/giảm nhân sự đến tháng 6.2020', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            // da update
            /** =================================================== */
            $this->form_validation->set_rules('average_salary', 'Mức lương trung bình/năm 2019 ', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('recruitment_budget', 'Chi phí cho hoạt động tuyển dụng nhân sự năm 2019 ', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('investment_fund_r_and_d', ' Chi phí đầu tư cho hoạt động R&D năm 2019 (Tổng chi phí) ', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('investment_fund_r_and_d_percent', 'Chi phí đầu tư cho hoạt động R&D năm 2019 (% trên tổng doanh thu)', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('staff_r_and_d', 'Số lượng nhân viên bộ phận R&D năm 2019', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            // $this->form_validation->set_rules('training_process', 'Công tác đào tạo, bồi dưỡng nhân lực ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('training_process', 'Công tác đào tạo, bồi dưỡng nhân lực ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('top5_customers', 'Giới thiệu tóm tắt 05 khách hàng/dự án tiêu biểu doanh nghiệp đã thực hiện ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('top5_customers', 'Giới thiệu tóm tắt 05 khách hàng/dự án tiêu biểu doanh nghiệp đã thực hiện ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('technology_certificate', 'Các chứng chỉ về công nghệ/ các công nghệ doanh nghiệp đang sử dụng/các công nghệ là thế mạnh của doanh nghiệp (đặc biệt là các công nghệ mới của CMCN 4.0) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('technology_certificate', 'Các chứng chỉ về công nghệ/ các công nghệ doanh nghiệp đang sử dụng/các công nghệ là thế mạnh của doanh nghiệp (đặc biệt là các công nghệ mới của CMCN 4.0) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('result_r_and_d', 'Thành quả nổi bật của hoạt động R&D năm 2019 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('result_r_and_d', 'Thành quả nổi bật của hoạt động R&D năm 2019 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('technique_certificate', 'Năng lực quản lý, chất lượng: (Các chứng chỉ về quản lý, quy trình, chất lượng) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('technique_certificate', 'Năng lực quản lý, chất lượng: (Các chứng chỉ về quản lý, quy trình, chất lượng) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('specific_certificate', 'Các chứng chỉ năng lực đặc thù của lĩnh vực hoạt động (nếu có) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('specific_certificate', 'Các chứng chỉ năng lực đặc thù của lĩnh vực hoạt động (nếu có) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('reward', '(Ghi rõ tên, thời gian nhận Giải thưởng, Danh hiệu và thành tích được công nhận trong các hoạt động thể hiện trách nhiệm với xã hội của doanh nghiệp (CSR)) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('reward', '(Ghi rõ tên, thời gian nhận Giải thưởng, Danh hiệu và thành tích được công nhận trong các hoạt động thể hiện trách nhiệm với xã hội của doanh nghiệp (CSR)) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('startup_plan_capital_future', 'Kế hoạch gọi vốn trong tương lai ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('startup_plan_capital_future', 'Kế hoạch gọi vốn trong tương lai ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('startup_plan_ipo', 'Kế hoạch IPO ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('startup_plan_ipo', 'Kế hoạch IPO ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_1', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 1 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_1', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 1 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_2', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 2 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_2', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 2 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_3', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 3 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_3', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 3 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('product', 'Tên các sản phẩm, dịch vụ chính của doanh nghiệp ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('product', 'Tên các sản phẩm, dịch vụ chính của doanh nghiệp ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('security_certificate', 'Các chứng chỉ bảo mật ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('security_certificate', 'security_certificate ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('security_process', 'Các quy trình/các biện pháp an ninh ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('security_process', 'Các quy trình/các biện pháp an ninh ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('overview', 'Giới thiệu doanh nghiệp ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('overview', 'Giới thiệu doanh nghiệp ', 'callback_check_word_length');
            /** =================================================== */


            if ($this->form_validation->run() === FALSE) {
                if($this->data['reg_status']['is_information'] == 0){
                    $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
                    redirect('client/information/create_extra', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/information/company', 'refresh');
                }
                $this->data['year'] = $this->input->get('year');
                $this->render('client/information/create_company_view');
            }else{
                if ($this->input->post()) {
                    $main_service = json_encode($this->input->post('main_service'));
                    $main_market = json_encode($this->input->post('main_market'));
                    $group_data = (array)$this->input->post('group');
                    if (count($group_data) > 3) {
                        array_splice($group_data, 3);
                    }
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'group' => json_encode($group_data),
                        'group10' => $this->input->post('group10'),
                        'overview' => $this->input->post('overview'),
                        'active_area' => $this->input->post('active_area'),
                        'product' => $this->input->post('product'),
                        'top5_customers' => $this->input->post('top5_customers'),

                        // add field 25/08/2020
                        'proportion_market_local' => strstr($this->input->post('proportion_market_local'),',') ? str_replace(',', '.', $this->input->post('proportion_market_local')) : $this->input->post('proportion_market_local'),
                        'proportion_market_europe' => strstr($this->input->post('proportion_market_europe'),',') ? str_replace(',', '.', $this->input->post('proportion_market_europe')) : $this->input->post('proportion_market_europe'),
                        'proportion_market_america' => strstr($this->input->post('proportion_market_america'),',') ? str_replace(',', '.', $this->input->post('proportion_market_america')) : $this->input->post('proportion_market_america'),
                        'proportion_market_japan' => strstr($this->input->post('proportion_market_japan'),',') ? str_replace(',', '.', $this->input->post('proportion_market_japan')) : $this->input->post('proportion_market_japan'),
                        'proportion_market_other_international' => strstr($this->input->post('proportion_market_other_international'),',') ? str_replace(',', '.', $this->input->post('proportion_market_other_international')) : $this->input->post('proportion_market_other_international'),
                        'technology_certificate' => $this->input->post('technology_certificate'),
                        'specific_certificate' => $this->input->post('specific_certificate'),
                        // Năng lực gọi vốn (dành riêng cho các DN Startup)
                        'startup_amount_capital' => $this->input->post('startup_amount_capital'),
                        'startup_number_investors' => $this->input->post('startup_number_investors'),
                        'startup_plan_capital_future' => $this->input->post('startup_plan_capital_future'),
                        'startup_plan_ipo' => $this->input->post('startup_plan_ipo'),
                        'employee_change_percent_3' => $this->input->post('employee_change_percent_3'),

                        // add field 28/08/2020
                        'nomination_income_1' => strstr($this->input->post('nomination_income_1'),',') ? str_replace(',', '.', $this->input->post('nomination_income_1')) : $this->input->post('nomination_income_1'),
                        'nomination_income_percent_1' => strstr($this->input->post('nomination_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('nomination_income_percent_1')) : $this->input->post('nomination_income_percent_1'),
                        'nomination_income_2' => strstr($this->input->post('nomination_income_2'),',') ? str_replace(',', '.', $this->input->post('nomination_income_2')) : $this->input->post('nomination_income_2'),
                        'nomination_income_percent_2' => strstr($this->input->post('nomination_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('nomination_income_percent_2')) : $this->input->post('nomination_income_percent_2'),
                        'number_personnel_nominated_1' => strstr($this->input->post('number_personnel_nominated_1'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_1')) : $this->input->post('number_personnel_nominated_1'),
                        'number_personnel_nominated_2' => strstr($this->input->post('number_personnel_nominated_2'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_2')) : $this->input->post('number_personnel_nominated_2'),
                        'number_personnel_nominated_3' => strstr($this->input->post('number_personnel_nominated_3'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_3')) : $this->input->post('number_personnel_nominated_3'),
                        'products_solutions_nominated_1' => $this->input->post('products_solutions_nominated_1'),
                        'products_solutions_nominated_2' => $this->input->post('products_solutions_nominated_2'),
                        'products_solutions_nominated_3' => $this->input->post('products_solutions_nominated_3'),
                        // end


                        // Vốn điều lệ
                        'equity_1' => strstr($this->input->post('equity_1'),',') ? str_replace(',', '.', $this->input->post('equity_1')) : $this->input->post('equity_1'),
                        'equity_percent_1' => strstr($this->input->post('equity_percent_1'),',') ? str_replace(',', '.', $this->input->post('equity_percent_1')) : $this->input->post('equity_percent_1'),
                        'equity_2' => strstr($this->input->post('equity_2'),',') ? str_replace(',', '.', $this->input->post('equity_2')) : $this->input->post('equity_2'),
                        'equity_percent_2' => strstr($this->input->post('equity_percent_2'),',') ? str_replace(',', '.', $this->input->post('equity_percent_2')) : $this->input->post('equity_percent_2'),

                        // Vốn chủ sở hữu
                        'owner_equity_1' => strstr($this->input->post('owner_equity_1'),',') ? str_replace(',', '.', $this->input->post('owner_equity_1')) : $this->input->post('owner_equity_1'),
                        'owner_equity_percent_1' => strstr($this->input->post('owner_equity_percent_1'),',') ? str_replace(',', '.', $this->input->post('owner_equity_percent_1')) : $this->input->post('owner_equity_percent_1'),
                        'owner_equity_2' => strstr($this->input->post('owner_equity_2'),',') ? str_replace(',', '.', $this->input->post('owner_equity_2')) : $this->input->post('owner_equity_2'),
                        'owner_equity_percent_2' => strstr($this->input->post('owner_equity_percent_2'),',') ? str_replace(',', '.', $this->input->post('owner_equity_percent_2')) : $this->input->post('owner_equity_percent_2'),

                        // Tổng tài sản
                        // New
                        'total_assets_1' => strstr($this->input->post('total_assets_1'),',') ? str_replace(',', '.', $this->input->post('total_assets_1')) : $this->input->post('total_assets_1'),
                        'total_assets_percent_1' => strstr($this->input->post('total_assets_percent_1'),',') ? str_replace(',', '.', $this->input->post('total_assets_percent_1')) : $this->input->post('total_assets_percent_1'),
                        'total_assets_2' => strstr($this->input->post('total_assets_2'),',') ? str_replace(',', '.', $this->input->post('total_assets_2')) : $this->input->post('total_assets_2'),
                        'total_assets_percent_2' => strstr($this->input->post('total_assets_percent_2'),',') ? str_replace(',', '.', $this->input->post('total_assets_percent_2')) : $this->input->post('total_assets_percent_2'),
                        // End New

                        // Tổng doanh thu doanh nghiệp
                        'total_income_1' => strstr($this->input->post('total_income_1'),',') ? str_replace(',', '.', $this->input->post('total_income_1')) : $this->input->post('total_income_1'),
                        'total_income_percent_1' => strstr($this->input->post('total_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('total_income_percent_1')) : $this->input->post('total_income_percent_1'),
                        'total_income_2' => strstr($this->input->post('total_income_2'),',') ? str_replace(',', '.', $this->input->post('total_income_2')) : $this->input->post('total_income_2'),
                        'total_income_percent_2' => strstr($this->input->post('total_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('total_income_percent_2')) : $this->input->post('total_income_percent_2'),
                        'total_income_6_months' => strstr($this->input->post('total_income_6_months'),',') ? str_replace(',', '.', $this->input->post('total_income_6_months')) : $this->input->post('total_income_6_months'),
                        // End New

                        // Bình quân doanh thu/đầu người
                        // New
                        'per_capita_income_1' => strstr($this->input->post('per_capita_income_1'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_1')) : $this->input->post('per_capita_income_1'),
                        'per_capita_income_percent_1' => strstr($this->input->post('per_capita_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_percent_1')) : $this->input->post('per_capita_income_percent_1'),
                        'per_capita_income_2' => strstr($this->input->post('per_capita_income_2'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_2')) : $this->input->post('per_capita_income_2'),
                        'per_capita_income_percent_2' => strstr($this->input->post('per_capita_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_percent_2')) : $this->input->post('per_capita_income_percent_2'),
                        'per_capita_income_6_months' => strstr($this->input->post('per_capita_income_6_months'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_6_months')) : $this->input->post('per_capita_income_6_months'),
                        // End New

                        // Tổng doanh thu lĩnh vực phần mềm, giải pháp
                        'software_income_1' => strstr($this->input->post('software_income_1'),',') ? str_replace(',', '.', $this->input->post('software_income_1')) : $this->input->post('software_income_1'),
                        'software_income_percent_1' => strstr($this->input->post('software_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('software_income_percent_1')) : $this->input->post('software_income_percent_1'),
                        'software_income_2' => strstr($this->input->post('software_income_2'),',') ? str_replace(',', '.', $this->input->post('software_income_2')) : $this->input->post('software_income_2'),
                        'software_income_percent_2' => strstr($this->input->post('software_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('software_income_percent_2')) : $this->input->post('software_income_percent_2'),
                        'software_income_6_months' => strstr($this->input->post('software_income_6_months'),',') ? str_replace(',', '.', $this->input->post('software_income_6_months')) : $this->input->post('software_income_6_months'),
                        // End New

                        // Tổng doanh thu dịch vụ CNTT
                        'it_income_1' => strstr($this->input->post('it_income_1'),',') ? str_replace(',', '.', $this->input->post('it_income_1')) : $this->input->post('it_income_1'),
                        'it_income_percent_1' => strstr($this->input->post('it_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('it_income_percent_1')) : $this->input->post('it_income_percent_1'),
                        'it_income_2' => strstr($this->input->post('it_income_2'),',') ? str_replace(',', '.', $this->input->post('it_income_2')) : $this->input->post('it_income_2'),
                        'it_income_percent_2' => strstr($this->input->post('it_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('it_income_percent_2')) : $this->input->post('it_income_percent_2'),
                        'it_income_6_months' => strstr($this->input->post('it_income_6_months'),',') ? str_replace(',', '.', $this->input->post('it_income_6_months')) : $this->input->post('it_income_6_months'),
                        // End New

                        // Tổng doanh thu xuất khẩu
                        'export_income_1' => strstr($this->input->post('export_income_1'),',') ? str_replace(',', '.', $this->input->post('export_income_1')) : $this->input->post('export_income_1'),
                        'export_income_percent_1' => strstr($this->input->post('export_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('export_income_percent_1')) : $this->input->post('export_income_percent_1'),
                        'export_income_2' => strstr($this->input->post('export_income_2'),',') ? str_replace(',', '.', $this->input->post('export_income_2')) : $this->input->post('export_income_2'),
                        'export_income_percent_2' => strstr($this->input->post('export_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('export_income_percent_2')) : $this->input->post('export_income_percent_2'),
                        'export_income_6_months' => strstr($this->input->post('export_income_6_months'),',') ? str_replace(',', '.', $this->input->post('export_income_6_months')) : $this->input->post('export_income_6_months'),
                        // End New

                        // Tổng doanh thu của lĩnh vực ứng cử:
                        // Thị trường quốc tế
                        // New
                        'international_income_1' => strstr($this->input->post('international_income_1'),',') ? str_replace(',', '.', $this->input->post('international_income_1')) : $this->input->post('international_income_1'),
                        'international_income_percent_1' => strstr($this->input->post('international_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('international_income_percent_1')) : $this->input->post('international_income_percent_1'),
                        'international_income_2' => strstr($this->input->post('international_income_2'),',') ? str_replace(',', '.', $this->input->post('international_income_2')) : $this->input->post('international_income_2'),
                        'international_income_percent_2' => strstr($this->input->post('international_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('international_income_percent_2')) : $this->input->post('international_income_percent_2'),
                        'international_income_6_months' => strstr($this->input->post('international_income_6_months'),',') ? str_replace(',', '.', $this->input->post('international_income_6_months')) : $this->input->post('international_income_6_months'),
                        // End New

                        // Tổng doanh thu của lĩnh vực ứng cử:
                        // Thị trường nội địa
                        // New
                        'domestic_income_1' => strstr($this->input->post('domestic_income_1'),',') ? str_replace(',', '.', $this->input->post('domestic_income_1')) : $this->input->post('domestic_income_1'),
                        'domestic_income_percent_1' => strstr($this->input->post('domestic_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('domestic_income_percent_1')) : $this->input->post('domestic_income_percent_1'),
                        'domestic_income_2' => strstr($this->input->post('domestic_income_2'),',') ? str_replace(',', '.', $this->input->post('domestic_income_2')) : $this->input->post('domestic_income_2'),
                        'domestic_income_percent_2' => strstr($this->input->post('domestic_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('domestic_income_percent_2')) : $this->input->post('domestic_income_percent_2'),
                        'domestic_income_6_months' => strstr($this->input->post('domestic_income_6_months'),',') ? str_replace(',', '.', $this->input->post('domestic_income_6_months')) : $this->input->post('domestic_income_6_months'),
                        // End New

                        // Tổng số lập trình viên
                        // New
                        'before_tax_profit_1' => strstr($this->input->post('before_tax_profit_1'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_1')) : $this->input->post('before_tax_profit_1'),
                        'before_tax_profit_percent_1' => strstr($this->input->post('before_tax_profit_percent_1'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_percent_1')) : $this->input->post('before_tax_profit_percent_1'),
                        'before_tax_profit_2' => strstr($this->input->post('before_tax_profit_2'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_2')) : $this->input->post('before_tax_profit_2'),
                        'before_tax_profit_percent_2' => strstr($this->input->post('before_tax_profit_percent_2'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_percent_2')) : $this->input->post('before_tax_profit_percent_2'),
                        'before_tax_profit_6_months' => strstr($this->input->post('before_tax_profit_6_months'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_6_months')) : $this->input->post('before_tax_profit_6_months'),
                        // End New



                        // New
                        // Tổng số nhân viên toàn thời gian
                        'full_time_employee' => strstr($this->input->post('full_time_employee'),',') ? str_replace(',', '.', $this->input->post('full_time_employee')) : $this->input->post('full_time_employee'),
                        // Độ tuổi trung bình
                        'average_age' => strstr($this->input->post('average_age'),',') ? str_replace(',', '.', $this->input->post('average_age')) : $this->input->post('average_age'),
                        // Tỷ lệ tăng/giảm nhân sự hàng năm trong 02 năm gần nhất:
                        'employee_change_percent_1' => strstr($this->input->post('employee_change_percent_1'),',') ? str_replace(',', '.', $this->input->post('employee_change_percent_1')) : $this->input->post('employee_change_percent_1'),
                        'employee_change_percent_2' => strstr($this->input->post('employee_change_percent_2'),',') ? str_replace(',', '.', $this->input->post('employee_change_percent_2')) : $this->input->post('employee_change_percent_2'),

                        // Số nhân viên có thể sử dụng ngoại ngữ trong công việc
                        'english_employee' => strstr($this->input->post('english_employee'),',') ? str_replace(',', '.', $this->input->post('english_employee')) : $this->input->post('english_employee'),
                        'english_employee_percent' => strstr($this->input->post('english_employee_percent'),',') ? str_replace(',', '.', $this->input->post('english_employee_percent')) : $this->input->post('english_employee_percent'),
                        'japanese_employee' => strstr($this->input->post('japanese_employee'),',') ? str_replace(',', '.', $this->input->post('japanese_employee')) : $this->input->post('japanese_employee'),
                        'japanese_employee_percent' => strstr($this->input->post('japanese_employee_percent'),',') ? str_replace(',', '.', $this->input->post('japanese_employee_percent')) : $this->input->post('japanese_employee_percent'),
                        'other_language_employee' => strstr($this->input->post('other_language_employee'),',') ? str_replace(',', '.', $this->input->post('other_language_employee')) : $this->input->post('other_language_employee'),
                        'other_language_employee_percent' => strstr($this->input->post('other_language_employee_percent'),',') ? str_replace(',', '.', $this->input->post('other_language_employee_percent')) : $this->input->post('other_language_employee_percent'),
                        'other_language' => $this->input->post('other_language'),
                        // Trình độ chuyên môn
                        'qualification' => $this->input->post('qualification'),
                        // Mức lương trung bình/năm
                        'average_salary' => strstr($this->input->post('average_salary'),',') ? str_replace(',', '.', $this->input->post('average_salary')) : $this->input->post('average_salary'),
                        // Số nhân viên thuộc bộ phận chăm sóc khách hàng
                        'customer_supporter' => strstr($this->input->post('customer_supporter'),',') ? str_replace(',', '.', $this->input->post('customer_supporter')) : $this->input->post('customer_supporter'),
                        // Công tác đào tạo, bồi dưỡng nhân lực
                        'training_process' => $this->input->post('training_process'),
                        // Hoạt động tuyển dụng nhân sự
                        'recruitment_staff' => strstr($this->input->post('recruitment_staff'),',') ? str_replace(',', '.', $this->input->post('recruitment_staff')) : $this->input->post('recruitment_staff'),
                        'recruitment_budget' => strstr($this->input->post('recruitment_budget'),',') ? str_replace(',', '.', $this->input->post('recruitment_budget')) : $this->input->post('recruitment_budget'),
                        // Chi phí đầu tư cho hoạt động R&D
                        'investment_fund_r_and_d' => strstr($this->input->post('investment_fund_r_and_d'),',') ? str_replace(',', '.', $this->input->post('investment_fund_r_and_d')) : $this->input->post('investment_fund_r_and_d'),
                        'investment_fund_r_and_d_percent' => strstr($this->input->post('investment_fund_r_and_d_percent'),',') ? str_replace(',', '.', $this->input->post('investment_fund_r_and_d_percent')) : $this->input->post('investment_fund_r_and_d_percent'),
                        'staff_r_and_d' => strstr($this->input->post('staff_r_and_d'),',') ? str_replace(',', '.', $this->input->post('staff_r_and_d')) : $this->input->post('staff_r_and_d'),
                        'result_r_and_d' => $this->input->post('result_r_and_d'),
                        // Chế độ bảo mật của công ty và bảo mật cho khách hàng
                        'security_certificate' => $this->input->post('security_certificate'),
                        'security_process' => $this->input->post('security_process'),
                        // Quản lý công nghệ, chất lượng
                        'technique_certificate' => $this->input->post('technique_certificate'),
                        // HOẠT ĐỘNG CỘNG ĐỒNG, CÁC GIẢI THƯỞNG, DANH HIỆU VÀ CÁC THÀNH TÍCH ĐẶC BIỆT DOANH NGHIỆP ĐÃ ĐẠT ĐƯỢC
                        'reward' => $this->input->post('reward'),

                        // End New

                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'main_service' => $main_service,
                        'main_market' => $main_market,
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );

                    $insert = $this->information_model->insert_company('company', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/information/company?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }
    }

    public function edit_company($request_id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if($this->input->post('submit') == 'Hoàn thành') {

            // add field 25/08/2020
            $this->form_validation->set_rules('proportion_market_local', 'Thị trường nội địa', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_europe', 'Thị trường Châu Âu', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_america', 'Thị trường Mỹ', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_japan', 'Thị trường Nhật', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_other_international', 'Thị trường quốc tế khác', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));

            $this->form_validation->set_rules('equity_1', 'Vốn điều lệ ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_percent_1', 'Vốn điều lệ ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_2', 'Vốn điều lệ ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_percent_2', 'Vốn điều lệ ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('total_assets_1', 'Tổng tài sản ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_percent_1', 'Tổng tài sản ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_2', 'Tổng tài sản ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_percent_2', 'Tổng tài sản ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('total_income_1', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_percent_1', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_2', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_percent_2', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('per_capita_income_1', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_percent_1', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_2', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_percent_2', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('software_income_1', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_percent_1', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_2', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_percent_2', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('it_income_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_percent_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_percent_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('domestic_income_1', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_percent_1', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_2', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_percent_2', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('owner_equity_1', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_percent_1', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_2', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_percent_2', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|required|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));

            /** =================================================== */
            $this->form_validation->set_rules('number_personnel_nominated_1', 'Số lượng nhân sự trong lĩnh vực đề cử 1', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('before_tax_profit_1', 'Tổng số lập trình viên ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_percent_1', 'Tổng số lập trình viên ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_2', 'Tổng số lập trình viên ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_percent_2', 'Tổng số lập trình viên ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('full_time_employee', 'Tổng số nhân viên toàn thời gian', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('average_age', 'Độ tuổi trung bình', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('employee_change_percent_1', 'Tỷ lệ tăng/giảm nhân sự năm ' . $this->data['rule2Year'][0], 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('employee_change_percent_2', 'Tỷ lệ tăng/giảm nhân sự năm ' . $this->data['rule2Year'][1], 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('employee_change_percent_3', 'Tỷ lệ tăng/giảm nhân sự đến tháng 6.2020', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            // da update 1
            /** =================================================== */
            $this->form_validation->set_rules('average_salary', 'Mức lương trung bình/năm 2019 ', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('recruitment_budget', 'Chi phí cho hoạt động tuyển dụng nhân sự năm 2019 ', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('investment_fund_r_and_d', ' Chi phí đầu tư cho hoạt động R&D năm 2019 (Tổng chi phí) ', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('investment_fund_r_and_d_percent', 'Chi phí đầu tư cho hoạt động R&D năm 2019 (% trên tổng doanh thu)', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('staff_r_and_d', 'Số lượng nhân viên bộ phận R&D năm 2019', 'trim|required|numeric_dots_and_comma|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            // $this->form_validation->set_rules('training_process', 'Công tác đào tạo, bồi dưỡng nhân lực ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('training_process', 'Công tác đào tạo, bồi dưỡng nhân lực ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('top5_customers', 'Giới thiệu tóm tắt 05 khách hàng/dự án tiêu biểu doanh nghiệp đã thực hiện ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('top5_customers', 'Giới thiệu tóm tắt 05 khách hàng/dự án tiêu biểu doanh nghiệp đã thực hiện ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('technology_certificate', 'Các chứng chỉ về công nghệ/ các công nghệ doanh nghiệp đang sử dụng/các công nghệ là thế mạnh của doanh nghiệp (đặc biệt là các công nghệ mới của CMCN 4.0) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('technology_certificate', 'Các chứng chỉ về công nghệ/ các công nghệ doanh nghiệp đang sử dụng/các công nghệ là thế mạnh của doanh nghiệp (đặc biệt là các công nghệ mới của CMCN 4.0) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('result_r_and_d', 'Thành quả nổi bật của hoạt động R&D năm 2019 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('result_r_and_d', 'Thành quả nổi bật của hoạt động R&D năm 2019 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('technique_certificate', 'Năng lực quản lý, chất lượng: (Các chứng chỉ về quản lý, quy trình, chất lượng) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('technique_certificate', 'Năng lực quản lý, chất lượng: (Các chứng chỉ về quản lý, quy trình, chất lượng) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('specific_certificate', 'Các chứng chỉ năng lực đặc thù của lĩnh vực hoạt động (nếu có) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('specific_certificate', 'Các chứng chỉ năng lực đặc thù của lĩnh vực hoạt động (nếu có) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('reward', '(Ghi rõ tên, thời gian nhận Giải thưởng, Danh hiệu và thành tích được công nhận trong các hoạt động thể hiện trách nhiệm với xã hội của doanh nghiệp (CSR)) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('reward', '(Ghi rõ tên, thời gian nhận Giải thưởng, Danh hiệu và thành tích được công nhận trong các hoạt động thể hiện trách nhiệm với xã hội của doanh nghiệp (CSR)) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('startup_plan_capital_future', 'Kế hoạch gọi vốn trong tương lai ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('startup_plan_capital_future', 'Kế hoạch gọi vốn trong tương lai ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('startup_plan_ipo', 'Kế hoạch IPO ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('startup_plan_ipo', 'Kế hoạch IPO ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_1', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 1 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_1', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 1 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_2', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 2 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_2', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 2 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_3', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 3 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_3', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 3 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('product', 'Tên các sản phẩm, dịch vụ chính của doanh nghiệp ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('product', 'Tên các sản phẩm, dịch vụ chính của doanh nghiệp ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('security_certificate', 'Các chứng chỉ bảo mật ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('security_certificate', 'security_certificate ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('security_process', 'Các quy trình/các biện pháp an ninh ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('security_process', 'Các quy trình/các biện pháp an ninh ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('overview', 'Giới thiệu doanh nghiệp ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('overview', 'Giới thiệu doanh nghiệp ', 'callback_check_word_length');
            /** =================================================== */

            $this->form_validation->set_rules('main_service[]', 'Sản phẩm dịch vụ chính của doanh nghiệp', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            $this->form_validation->set_rules('main_market[]', 'Thị trường chính', 'trim|required', array(
                'required' => '%s không được trống.'
            ));

            $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
            if ($this->form_validation->run() == FALSE) {
                $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('company', $this->data['user']->username, $this->input->get('year'));

                if (!$this->data['company']) {
                    redirect('client/information/company', 'refresh');
                }
                if($this->data['reg_status'] == 1){
                    redirect('client/information', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/information/company', 'refresh');
                }
                $this->render('client/information/edit_company_view');
            } else {
                if ($this->input->post()) {
                    $main_service = json_encode($this->input->post('main_service'));
                    $main_market = json_encode($this->input->post('main_market'));
                    $group_data = (array)$this->input->post('group');
                    if (count($group_data) > 3) {
                        array_splice($group_data, 3);
                    }

                    $data = array(
                        'group' => json_encode($group_data),
                        'group10' => $this->input->post('group10'),
                        'overview' => $this->input->post('overview'),
                        'active_area' => $this->input->post('active_area'),
                        'product' => $this->input->post('product'),
                        'top5_customers' => $this->input->post('top5_customers'),

                        // add field 25/08/2020
                        'proportion_market_local' => strstr($this->input->post('proportion_market_local'),',') ? str_replace(',', '.', $this->input->post('proportion_market_local')) : $this->input->post('proportion_market_local'),
                        'proportion_market_europe' => strstr($this->input->post('proportion_market_europe'),',') ? str_replace(',', '.', $this->input->post('proportion_market_europe')) : $this->input->post('proportion_market_europe'),
                        'proportion_market_america' => strstr($this->input->post('proportion_market_america'),',') ? str_replace(',', '.', $this->input->post('proportion_market_america')) : $this->input->post('proportion_market_america'),
                        'proportion_market_japan' => strstr($this->input->post('proportion_market_japan'),',') ? str_replace(',', '.', $this->input->post('proportion_market_japan')) : $this->input->post('proportion_market_japan'),
                        'proportion_market_other_international' => strstr($this->input->post('proportion_market_other_international'),',') ? str_replace(',', '.', $this->input->post('proportion_market_other_international')) : $this->input->post('proportion_market_other_international'),
                        'technology_certificate' => $this->input->post('technology_certificate'),
                        'specific_certificate' => $this->input->post('specific_certificate'),
                        // Năng lực gọi vốn (dành riêng cho các DN Startup)
                        'startup_amount_capital' => $this->input->post('startup_amount_capital'),
                        'startup_number_investors' => $this->input->post('startup_number_investors'),
                        'startup_plan_capital_future' => $this->input->post('startup_plan_capital_future'),
                        'startup_plan_ipo' => $this->input->post('startup_plan_ipo'),
                        'employee_change_percent_3' => $this->input->post('employee_change_percent_3'),

                        // add field 28/08/2020
                        'nomination_income_1' => strstr($this->input->post('nomination_income_1'),',') ? str_replace(',', '.', $this->input->post('nomination_income_1')) : $this->input->post('nomination_income_1'),
                        'nomination_income_percent_1' => strstr($this->input->post('nomination_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('nomination_income_percent_1')) : $this->input->post('nomination_income_percent_1'),
                        'nomination_income_2' => strstr($this->input->post('nomination_income_2'),',') ? str_replace(',', '.', $this->input->post('nomination_income_2')) : $this->input->post('nomination_income_2'),
                        'nomination_income_percent_2' => strstr($this->input->post('nomination_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('nomination_income_percent_2')) : $this->input->post('nomination_income_percent_2'),
                        'number_personnel_nominated_1' => strstr($this->input->post('number_personnel_nominated_1'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_1')) : $this->input->post('number_personnel_nominated_1'),
                        'number_personnel_nominated_2' => strstr($this->input->post('number_personnel_nominated_2'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_2')) : $this->input->post('number_personnel_nominated_2'),
                        'number_personnel_nominated_3' => strstr($this->input->post('number_personnel_nominated_3'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_3')) : $this->input->post('number_personnel_nominated_3'),
                        'products_solutions_nominated_1' => $this->input->post('products_solutions_nominated_1'),
                        'products_solutions_nominated_2' => $this->input->post('products_solutions_nominated_2'),
                        'products_solutions_nominated_3' => $this->input->post('products_solutions_nominated_3'),
                        // end


                        /// Vốn điều lệ
                        'equity_1' => strstr($this->input->post('equity_1'),',') ? str_replace(',', '.', $this->input->post('equity_1')) : $this->input->post('equity_1'),
                        'equity_percent_1' => strstr($this->input->post('equity_percent_1'),',') ? str_replace(',', '.', $this->input->post('equity_percent_1')) : $this->input->post('equity_percent_1'),
                        'equity_2' => strstr($this->input->post('equity_2'),',') ? str_replace(',', '.', $this->input->post('equity_2')) : $this->input->post('equity_2'),
                        'equity_percent_2' => strstr($this->input->post('equity_percent_2'),',') ? str_replace(',', '.', $this->input->post('equity_percent_2')) : $this->input->post('equity_percent_2'),

                        // Vốn chủ sở hữu
                        'owner_equity_1' => strstr($this->input->post('owner_equity_1'),',') ? str_replace(',', '.', $this->input->post('owner_equity_1')) : $this->input->post('owner_equity_1'),
                        'owner_equity_percent_1' => strstr($this->input->post('owner_equity_percent_1'),',') ? str_replace(',', '.', $this->input->post('owner_equity_percent_1')) : $this->input->post('owner_equity_percent_1'),
                        'owner_equity_2' => strstr($this->input->post('owner_equity_2'),',') ? str_replace(',', '.', $this->input->post('owner_equity_2')) : $this->input->post('owner_equity_2'),
                        'owner_equity_percent_2' => strstr($this->input->post('owner_equity_percent_2'),',') ? str_replace(',', '.', $this->input->post('owner_equity_percent_2')) : $this->input->post('owner_equity_percent_2'),

                        // Tổng tài sản
                        // New
                        'total_assets_1' => strstr($this->input->post('total_assets_1'),',') ? str_replace(',', '.', $this->input->post('total_assets_1')) : $this->input->post('total_assets_1'),
                        'total_assets_percent_1' => strstr($this->input->post('total_assets_percent_1'),',') ? str_replace(',', '.', $this->input->post('total_assets_percent_1')) : $this->input->post('total_assets_percent_1'),
                        'total_assets_2' => strstr($this->input->post('total_assets_2'),',') ? str_replace(',', '.', $this->input->post('total_assets_2')) : $this->input->post('total_assets_2'),
                        'total_assets_percent_2' => strstr($this->input->post('total_assets_percent_2'),',') ? str_replace(',', '.', $this->input->post('total_assets_percent_2')) : $this->input->post('total_assets_percent_2'),
                        // End New

                        // Tổng doanh thu doanh nghiệp
                        'total_income_1' => strstr($this->input->post('total_income_1'),',') ? str_replace(',', '.', $this->input->post('total_income_1')) : $this->input->post('total_income_1'),
                        'total_income_percent_1' => strstr($this->input->post('total_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('total_income_percent_1')) : $this->input->post('total_income_percent_1'),
                        'total_income_2' => strstr($this->input->post('total_income_2'),',') ? str_replace(',', '.', $this->input->post('total_income_2')) : $this->input->post('total_income_2'),
                        'total_income_percent_2' => strstr($this->input->post('total_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('total_income_percent_2')) : $this->input->post('total_income_percent_2'),
                        'total_income_6_months' => strstr($this->input->post('total_income_6_months'),',') ? str_replace(',', '.', $this->input->post('total_income_6_months')) : $this->input->post('total_income_6_months'),
                        // End New

                        // Bình quân doanh thu/đầu người
                        // New
                        'per_capita_income_1' => strstr($this->input->post('per_capita_income_1'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_1')) : $this->input->post('per_capita_income_1'),
                        'per_capita_income_percent_1' => strstr($this->input->post('per_capita_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_percent_1')) : $this->input->post('per_capita_income_percent_1'),
                        'per_capita_income_2' => strstr($this->input->post('per_capita_income_2'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_2')) : $this->input->post('per_capita_income_2'),
                        'per_capita_income_percent_2' => strstr($this->input->post('per_capita_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_percent_2')) : $this->input->post('per_capita_income_percent_2'),
                        'per_capita_income_6_months' => strstr($this->input->post('per_capita_income_6_months'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_6_months')) : $this->input->post('per_capita_income_6_months'),
                        // End New

                        // Tổng doanh thu lĩnh vực phần mềm, giải pháp
                        'software_income_1' => strstr($this->input->post('software_income_1'),',') ? str_replace(',', '.', $this->input->post('software_income_1')) : $this->input->post('software_income_1'),
                        'software_income_percent_1' => strstr($this->input->post('software_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('software_income_percent_1')) : $this->input->post('software_income_percent_1'),
                        'software_income_2' => strstr($this->input->post('software_income_2'),',') ? str_replace(',', '.', $this->input->post('software_income_2')) : $this->input->post('software_income_2'),
                        'software_income_percent_2' => strstr($this->input->post('software_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('software_income_percent_2')) : $this->input->post('software_income_percent_2'),
                        'software_income_6_months' => strstr($this->input->post('software_income_6_months'),',') ? str_replace(',', '.', $this->input->post('software_income_6_months')) : $this->input->post('software_income_6_months'),
                        // End New

                        // Tổng doanh thu dịch vụ CNTT
                        'it_income_1' => strstr($this->input->post('it_income_1'),',') ? str_replace(',', '.', $this->input->post('it_income_1')) : $this->input->post('it_income_1'),
                        'it_income_percent_1' => strstr($this->input->post('it_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('it_income_percent_1')) : $this->input->post('it_income_percent_1'),
                        'it_income_2' => strstr($this->input->post('it_income_2'),',') ? str_replace(',', '.', $this->input->post('it_income_2')) : $this->input->post('it_income_2'),
                        'it_income_percent_2' => strstr($this->input->post('it_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('it_income_percent_2')) : $this->input->post('it_income_percent_2'),
                        'it_income_6_months' => strstr($this->input->post('it_income_6_months'),',') ? str_replace(',', '.', $this->input->post('it_income_6_months')) : $this->input->post('it_income_6_months'),
                        // End New

                        // Tổng doanh thu xuất khẩu
                        'export_income_1' => strstr($this->input->post('export_income_1'),',') ? str_replace(',', '.', $this->input->post('export_income_1')) : $this->input->post('export_income_1'),
                        'export_income_percent_1' => strstr($this->input->post('export_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('export_income_percent_1')) : $this->input->post('export_income_percent_1'),
                        'export_income_2' => strstr($this->input->post('export_income_2'),',') ? str_replace(',', '.', $this->input->post('export_income_2')) : $this->input->post('export_income_2'),
                        'export_income_percent_2' => strstr($this->input->post('export_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('export_income_percent_2')) : $this->input->post('export_income_percent_2'),
                        'export_income_6_months' => strstr($this->input->post('export_income_6_months'),',') ? str_replace(',', '.', $this->input->post('export_income_6_months')) : $this->input->post('export_income_6_months'),
                        // End New

                        // Tổng doanh thu của lĩnh vực ứng cử:
                        // Thị trường quốc tế
                        // New
                        'international_income_1' => strstr($this->input->post('international_income_1'),',') ? str_replace(',', '.', $this->input->post('international_income_1')) : $this->input->post('international_income_1'),
                        'international_income_percent_1' => strstr($this->input->post('international_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('international_income_percent_1')) : $this->input->post('international_income_percent_1'),
                        'international_income_2' => strstr($this->input->post('international_income_2'),',') ? str_replace(',', '.', $this->input->post('international_income_2')) : $this->input->post('international_income_2'),
                        'international_income_percent_2' => strstr($this->input->post('international_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('international_income_percent_2')) : $this->input->post('international_income_percent_2'),
                        'international_income_6_months' => strstr($this->input->post('international_income_6_months'),',') ? str_replace(',', '.', $this->input->post('international_income_6_months')) : $this->input->post('international_income_6_months'),
                        // End New

                        // Tổng doanh thu của lĩnh vực ứng cử:
                        // Thị trường nội địa
                        // New
                        'domestic_income_1' => strstr($this->input->post('domestic_income_1'),',') ? str_replace(',', '.', $this->input->post('domestic_income_1')) : $this->input->post('domestic_income_1'),
                        'domestic_income_percent_1' => strstr($this->input->post('domestic_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('domestic_income_percent_1')) : $this->input->post('domestic_income_percent_1'),
                        'domestic_income_2' => strstr($this->input->post('domestic_income_2'),',') ? str_replace(',', '.', $this->input->post('domestic_income_2')) : $this->input->post('domestic_income_2'),
                        'domestic_income_percent_2' => strstr($this->input->post('domestic_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('domestic_income_percent_2')) : $this->input->post('domestic_income_percent_2'),
                        'domestic_income_6_months' => strstr($this->input->post('domestic_income_6_months'),',') ? str_replace(',', '.', $this->input->post('domestic_income_6_months')) : $this->input->post('domestic_income_6_months'),
                        // End New

                        // Tổng số lập trình viên
                        // New
                        'before_tax_profit_1' => strstr($this->input->post('before_tax_profit_1'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_1')) : $this->input->post('before_tax_profit_1'),
                        'before_tax_profit_percent_1' => strstr($this->input->post('before_tax_profit_percent_1'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_percent_1')) : $this->input->post('before_tax_profit_percent_1'),
                        'before_tax_profit_2' => strstr($this->input->post('before_tax_profit_2'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_2')) : $this->input->post('before_tax_profit_2'),
                        'before_tax_profit_percent_2' => strstr($this->input->post('before_tax_profit_percent_2'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_percent_2')) : $this->input->post('before_tax_profit_percent_2'),
                        'before_tax_profit_6_months' => strstr($this->input->post('before_tax_profit_6_months'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_6_months')) : $this->input->post('before_tax_profit_6_months'),
                        // End New

                        // New
                        // Tổng số nhân viên toàn thời gian
                        'full_time_employee' => strstr($this->input->post('full_time_employee'),',') ? str_replace(',', '.', $this->input->post('full_time_employee')) : $this->input->post('full_time_employee'),
                        // Độ tuổi trung bình
                        'average_age' => strstr($this->input->post('average_age'),',') ? str_replace(',', '.', $this->input->post('average_age')) : $this->input->post('average_age'),
                        // Tỷ lệ tăng/giảm nhân sự hàng năm trong 02 năm gần nhất:
                        'employee_change_percent_1' => strstr($this->input->post('employee_change_percent_1'),',') ? str_replace(',', '.', $this->input->post('employee_change_percent_1')) : $this->input->post('employee_change_percent_1'),
                        'employee_change_percent_2' => strstr($this->input->post('employee_change_percent_2'),',') ? str_replace(',', '.', $this->input->post('employee_change_percent_2')) : $this->input->post('employee_change_percent_2'),

                        // Số nhân viên có thể sử dụng ngoại ngữ trong công việc
                        'english_employee' => strstr($this->input->post('english_employee'),',') ? str_replace(',', '.', $this->input->post('english_employee')) : $this->input->post('english_employee'),
                        'english_employee_percent' => strstr($this->input->post('english_employee_percent'),',') ? str_replace(',', '.', $this->input->post('english_employee_percent')) : $this->input->post('english_employee_percent'),
                        'japanese_employee' => strstr($this->input->post('japanese_employee'),',') ? str_replace(',', '.', $this->input->post('japanese_employee')) : $this->input->post('japanese_employee'),
                        'japanese_employee_percent' => strstr($this->input->post('japanese_employee_percent'),',') ? str_replace(',', '.', $this->input->post('japanese_employee_percent')) : $this->input->post('japanese_employee_percent'),
                        'other_language_employee' => strstr($this->input->post('other_language_employee'),',') ? str_replace(',', '.', $this->input->post('other_language_employee')) : $this->input->post('other_language_employee'),
                        'other_language_employee_percent' => strstr($this->input->post('other_language_employee_percent'),',') ? str_replace(',', '.', $this->input->post('other_language_employee_percent')) : $this->input->post('other_language_employee_percent'),
                        'other_language' => $this->input->post('other_language'),
                        // Trình độ chuyên môn
                        'qualification' => $this->input->post('qualification'),
                        // Mức lương trung bình/năm
                        'average_salary' => strstr($this->input->post('average_salary'),',') ? str_replace(',', '.', $this->input->post('average_salary')) : $this->input->post('average_salary'),
                        // Số nhân viên thuộc bộ phận chăm sóc khách hàng
                        'customer_supporter' => strstr($this->input->post('customer_supporter'),',') ? str_replace(',', '.', $this->input->post('customer_supporter')) : $this->input->post('customer_supporter'),
                        // Công tác đào tạo, bồi dưỡng nhân lực
                        'training_process' => $this->input->post('training_process'),
                        // Hoạt động tuyển dụng nhân sự
                        'recruitment_staff' => strstr($this->input->post('recruitment_staff'),',') ? str_replace(',', '.', $this->input->post('recruitment_staff')) : $this->input->post('recruitment_staff'),
                        'recruitment_budget' => strstr($this->input->post('recruitment_budget'),',') ? str_replace(',', '.', $this->input->post('recruitment_budget')) : $this->input->post('recruitment_budget'),
                        // Chi phí đầu tư cho hoạt động R&D
                        'investment_fund_r_and_d' => strstr($this->input->post('investment_fund_r_and_d'),',') ? str_replace(',', '.', $this->input->post('investment_fund_r_and_d')) : $this->input->post('investment_fund_r_and_d'),
                        'investment_fund_r_and_d_percent' => strstr($this->input->post('investment_fund_r_and_d_percent'),',') ? str_replace(',', '.', $this->input->post('investment_fund_r_and_d_percent')) : $this->input->post('investment_fund_r_and_d_percent'),
                        'staff_r_and_d' => strstr($this->input->post('staff_r_and_d'),',') ? str_replace(',', '.', $this->input->post('staff_r_and_d')) : $this->input->post('staff_r_and_d'),
                        'result_r_and_d' => $this->input->post('result_r_and_d'),
                        // Chế độ bảo mật của công ty và bảo mật cho khách hàng
                        'security_certificate' => $this->input->post('security_certificate'),
                        'security_process' => $this->input->post('security_process'),
                        // Quản lý công nghệ, chất lượng
                        'technique_certificate' => $this->input->post('technique_certificate'),
                        // HOẠT ĐỘNG CỘNG ĐỒNG, CÁC GIẢI THƯỞNG, DANH HIỆU VÀ CÁC THÀNH TÍCH ĐẶC BIỆT DOANH NGHIỆP ĐÃ ĐẠT ĐƯỢC
                        'reward' => $this->input->post('reward'),
                        // End New
                        'main_service' => $main_service,
                        'main_market' => $main_market,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );

                    try {
                        $this->information_model->update_by_information_and_year('company', $this->data['user']->username, $this->data['eventYear'], $data);
                        $this->load->model('status_model');
                        $this->status_model->update('status', $this->data['user']->id, array('is_company' => 1));
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }

                    redirect('client/information/company?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }else{

            // add field 25/08/2020
            $this->form_validation->set_rules('proportion_market_local', 'Thị trường nội địa', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_europe', 'Thị trường Châu Âu', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_america', 'Thị trường Mỹ', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_japan', 'Thị trường Nhật', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('proportion_market_other_international', 'Thị trường quốc tế khác', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));


            $this->form_validation->set_rules('equity_1', 'Vốn điều lệ ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_percent_1', 'Vốn điều lệ ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_2', 'Vốn điều lệ ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_percent_2', 'Vốn điều lệ ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('total_assets_1', 'Tổng tài sản ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_percent_1', 'Tổng tài sản ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_2', 'Tổng tài sản ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_assets_percent_2', 'Tổng tài sản ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('total_income_1', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_percent_1', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_2', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_percent_2', 'Tổng doanh thu doanh nghiệp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('per_capita_income_1', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_percent_1', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_2', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('per_capita_income_percent_2', 'Bình quân doanh thu/đầu người ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('software_income_1', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_percent_1', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_2', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_percent_2', 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('it_income_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_percent_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_percent_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('domestic_income_1', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_percent_1', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_2', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('domestic_income_percent_2', 'Tổng số lao động của doanh nghiệp ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('owner_equity_1', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_percent_1', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_2', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_percent_2', 'Tổng doanh thu lĩnh vực đề cử 1 ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));

            /** =================================================== */
            $this->form_validation->set_rules('number_personnel_nominated_1', 'Số lượng nhân sự trong lĩnh vực đề cử 1', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('before_tax_profit_1', 'Tổng số lập trình viên ' . $this->data['rule2Year'][0] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_percent_1', 'Tổng số lập trình viên ' . $this->data['rule2Year'][0] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_2', 'Tổng số lập trình viên ' . $this->data['rule2Year'][1] . ' số tuyệt đối', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('before_tax_profit_percent_2', 'Tổng số lập trình viên ' . $this->data['rule2Year'][1] . ' so với năm trước', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('full_time_employee', 'Tổng số nhân viên toàn thời gian', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('average_age', 'Độ tuổi trung bình', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('employee_change_percent_1', 'Tỷ lệ tăng/giảm nhân sự năm ' . $this->data['rule2Year'][0], 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('employee_change_percent_2', 'Tỷ lệ tăng/giảm nhân sự năm ' . $this->data['rule2Year'][1], 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('employee_change_percent_3', 'Tỷ lệ tăng/giảm nhân sự đến tháng 6.2020', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            // dat update
            /** =================================================== */
            $this->form_validation->set_rules('average_salary', 'Mức lương trung bình/năm 2019 ', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('recruitment_budget', 'Chi phí cho hoạt động tuyển dụng nhân sự năm 2019 ', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('investment_fund_r_and_d', ' Chi phí đầu tư cho hoạt động R&D năm 2019 (Tổng chi phí) ', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('investment_fund_r_and_d_percent', 'Chi phí đầu tư cho hoạt động R&D năm 2019 (% trên tổng doanh thu)', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            $this->form_validation->set_rules('staff_r_and_d', 'Số lượng nhân viên bộ phận R&D năm 2019', 'trim|numeric_dots_and_comma|max_length[10]', array(
                'numeric_dots_and_comma' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            /** =================================================== */
            // $this->form_validation->set_rules('training_process', 'Công tác đào tạo, bồi dưỡng nhân lực ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('training_process', 'Công tác đào tạo, bồi dưỡng nhân lực ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('top5_customers', 'Giới thiệu tóm tắt 05 khách hàng/dự án tiêu biểu doanh nghiệp đã thực hiện ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('top5_customers', 'Giới thiệu tóm tắt 05 khách hàng/dự án tiêu biểu doanh nghiệp đã thực hiện ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('technology_certificate', 'Các chứng chỉ về công nghệ/ các công nghệ doanh nghiệp đang sử dụng/các công nghệ là thế mạnh của doanh nghiệp (đặc biệt là các công nghệ mới của CMCN 4.0) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('technology_certificate', 'Các chứng chỉ về công nghệ/ các công nghệ doanh nghiệp đang sử dụng/các công nghệ là thế mạnh của doanh nghiệp (đặc biệt là các công nghệ mới của CMCN 4.0) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('result_r_and_d', 'Thành quả nổi bật của hoạt động R&D năm 2019 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('result_r_and_d', 'Thành quả nổi bật của hoạt động R&D năm 2019 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('technique_certificate', 'Năng lực quản lý, chất lượng: (Các chứng chỉ về quản lý, quy trình, chất lượng) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('technique_certificate', 'Năng lực quản lý, chất lượng: (Các chứng chỉ về quản lý, quy trình, chất lượng) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('specific_certificate', 'Các chứng chỉ năng lực đặc thù của lĩnh vực hoạt động (nếu có) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('specific_certificate', 'Các chứng chỉ năng lực đặc thù của lĩnh vực hoạt động (nếu có) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('reward', '(Ghi rõ tên, thời gian nhận Giải thưởng, Danh hiệu và thành tích được công nhận trong các hoạt động thể hiện trách nhiệm với xã hội của doanh nghiệp (CSR)) ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('reward', '(Ghi rõ tên, thời gian nhận Giải thưởng, Danh hiệu và thành tích được công nhận trong các hoạt động thể hiện trách nhiệm với xã hội của doanh nghiệp (CSR)) ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('startup_plan_capital_future', 'Kế hoạch gọi vốn trong tương lai ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('startup_plan_capital_future', 'Kế hoạch gọi vốn trong tương lai ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('startup_plan_ipo', 'Kế hoạch IPO ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('startup_plan_ipo', 'Kế hoạch IPO ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_1', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 1 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_1', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 1 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_2', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 2 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_2', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 2 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('products_solutions_nominated_3', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 3 ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('products_solutions_nominated_3', 'Các sản phẩm/giải pháp chính trong lĩnh vực đề cử 3 ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('product', 'Tên các sản phẩm, dịch vụ chính của doanh nghiệp ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('product', 'Tên các sản phẩm, dịch vụ chính của doanh nghiệp ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('security_certificate', 'Các chứng chỉ bảo mật ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('security_certificate', 'security_certificate ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('security_process', 'Các quy trình/các biện pháp an ninh ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('security_process', 'Các quy trình/các biện pháp an ninh ', 'callback_check_word_length');
            /** =================================================== */
            // $this->form_validation->set_rules('overview', 'Giới thiệu doanh nghiệp ', 'trim|max_word[1000]', array(
            //     'max_word' => '%s Tối đa 1000 từ'
            // ));
            $this->form_validation->set_rules('overview', 'Giới thiệu doanh nghiệp ', 'callback_check_word_length');
            /** =================================================== */

            if ($this->form_validation->run() == FALSE) {
                $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('company', $this->data['user']->username, $this->input->get('year'));
                if (!$this->data['company']) {
                    redirect('client/information/company', 'refresh');
                }
                if($this->data['reg_status'] == 1){
                    redirect('client/information', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/information/company', 'refresh');
                }
                $this->render('client/information/edit_company_view');
            } else {
                if ($this->input->post()) {
                    $main_service = json_encode($this->input->post('main_service'));
                    $main_market = json_encode($this->input->post('main_market'));

                    $group_data = (array)$this->input->post('group');
                    if (count($group_data) > 3) {
                        array_splice($group_data, 3);
                    }

                    $data = array(
                        'group' => json_encode($group_data),
                        'group10' => $this->input->post('group10'),
                        'overview' => $this->input->post('overview'),
                        'active_area' => $this->input->post('active_area'),
                        'product' => $this->input->post('product'),
                        'top5_customers' => $this->input->post('top5_customers'),

                        // add field 25/08/2020
                        'proportion_market_local' => strstr($this->input->post('proportion_market_local'),',') ? str_replace(',', '.', $this->input->post('proportion_market_local')) : $this->input->post('proportion_market_local'),
                        'proportion_market_europe' => strstr($this->input->post('proportion_market_europe'),',') ? str_replace(',', '.', $this->input->post('proportion_market_europe')) : $this->input->post('proportion_market_europe'),
                        'proportion_market_america' => strstr($this->input->post('proportion_market_america'),',') ? str_replace(',', '.', $this->input->post('proportion_market_america')) : $this->input->post('proportion_market_america'),
                        'proportion_market_japan' => strstr($this->input->post('proportion_market_japan'),',') ? str_replace(',', '.', $this->input->post('proportion_market_japan')) : $this->input->post('proportion_market_japan'),
                        'proportion_market_other_international' => strstr($this->input->post('proportion_market_other_international'),',') ? str_replace(',', '.', $this->input->post('proportion_market_other_international')) : $this->input->post('proportion_market_other_international'),
                        'technology_certificate' => $this->input->post('technology_certificate'),
                        'specific_certificate' => $this->input->post('specific_certificate'),
                        // Năng lực gọi vốn (dành riêng cho các DN Startup)
                        'startup_amount_capital' => $this->input->post('startup_amount_capital'),
                        'startup_number_investors' => $this->input->post('startup_number_investors'),
                        'startup_plan_capital_future' => $this->input->post('startup_plan_capital_future'),
                        'startup_plan_ipo' => $this->input->post('startup_plan_ipo'),
                        'employee_change_percent_3' => $this->input->post('employee_change_percent_3'),

                        // add field 28/08/2020
                        'nomination_income_1' => strstr($this->input->post('nomination_income_1'),',') ? str_replace(',', '.', $this->input->post('nomination_income_1')) : $this->input->post('nomination_income_1'),
                        'nomination_income_percent_1' => strstr($this->input->post('nomination_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('nomination_income_percent_1')) : $this->input->post('nomination_income_percent_1'),
                        'nomination_income_2' => strstr($this->input->post('nomination_income_2'),',') ? str_replace(',', '.', $this->input->post('nomination_income_2')) : $this->input->post('nomination_income_2'),
                        'nomination_income_percent_2' => strstr($this->input->post('nomination_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('nomination_income_percent_2')) : $this->input->post('nomination_income_percent_2'),
                        'number_personnel_nominated_1' => strstr($this->input->post('number_personnel_nominated_1'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_1')) : $this->input->post('number_personnel_nominated_1'),
                        'number_personnel_nominated_2' => strstr($this->input->post('number_personnel_nominated_2'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_2')) : $this->input->post('number_personnel_nominated_2'),
                        'number_personnel_nominated_3' => strstr($this->input->post('number_personnel_nominated_3'),',') ? str_replace(',', '.', $this->input->post('number_personnel_nominated_3')) : $this->input->post('number_personnel_nominated_3'),
                        'products_solutions_nominated_1' => $this->input->post('products_solutions_nominated_1'),
                        'products_solutions_nominated_2' => $this->input->post('products_solutions_nominated_2'),
                        'products_solutions_nominated_3' => $this->input->post('products_solutions_nominated_3'),
                        // end


                        // Vốn điều lệ
                        'equity_1' => strstr($this->input->post('equity_1'),',') ? str_replace(',', '.', $this->input->post('equity_1')) : $this->input->post('equity_1'),
                        'equity_percent_1' => strstr($this->input->post('equity_percent_1'),',') ? str_replace(',', '.', $this->input->post('equity_percent_1')) : $this->input->post('equity_percent_1'),
                        'equity_2' => strstr($this->input->post('equity_2'),',') ? str_replace(',', '.', $this->input->post('equity_2')) : $this->input->post('equity_2'),
                        'equity_percent_2' => strstr($this->input->post('equity_percent_2'),',') ? str_replace(',', '.', $this->input->post('equity_percent_2')) : $this->input->post('equity_percent_2'),

                        // Vốn chủ sở hữu
                        'owner_equity_1' => strstr($this->input->post('owner_equity_1'),',') ? str_replace(',', '.', $this->input->post('owner_equity_1')) : $this->input->post('owner_equity_1'),
                        'owner_equity_percent_1' => strstr($this->input->post('owner_equity_percent_1'),',') ? str_replace(',', '.', $this->input->post('owner_equity_percent_1')) : $this->input->post('owner_equity_percent_1'),
                        'owner_equity_2' => strstr($this->input->post('owner_equity_2'),',') ? str_replace(',', '.', $this->input->post('owner_equity_2')) : $this->input->post('owner_equity_2'),
                        'owner_equity_percent_2' => strstr($this->input->post('owner_equity_percent_2'),',') ? str_replace(',', '.', $this->input->post('owner_equity_percent_2')) : $this->input->post('owner_equity_percent_2'),

                        // Tổng tài sản
                        // New
                        'total_assets_1' => strstr($this->input->post('total_assets_1'),',') ? str_replace(',', '.', $this->input->post('total_assets_1')) : $this->input->post('total_assets_1'),
                        'total_assets_percent_1' => strstr($this->input->post('total_assets_percent_1'),',') ? str_replace(',', '.', $this->input->post('total_assets_percent_1')) : $this->input->post('total_assets_percent_1'),
                        'total_assets_2' => strstr($this->input->post('total_assets_2'),',') ? str_replace(',', '.', $this->input->post('total_assets_2')) : $this->input->post('total_assets_2'),
                        'total_assets_percent_2' => strstr($this->input->post('total_assets_percent_2'),',') ? str_replace(',', '.', $this->input->post('total_assets_percent_2')) : $this->input->post('total_assets_percent_2'),
                        // End New

                        // Tổng doanh thu doanh nghiệp
                        'total_income_1' => strstr($this->input->post('total_income_1'),',') ? str_replace(',', '.', $this->input->post('total_income_1')) : $this->input->post('total_income_1'),
                        'total_income_percent_1' => strstr($this->input->post('total_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('total_income_percent_1')) : $this->input->post('total_income_percent_1'),
                        'total_income_2' => strstr($this->input->post('total_income_2'),',') ? str_replace(',', '.', $this->input->post('total_income_2')) : $this->input->post('total_income_2'),
                        'total_income_percent_2' => strstr($this->input->post('total_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('total_income_percent_2')) : $this->input->post('total_income_percent_2'),
                        'total_income_6_months' => strstr($this->input->post('total_income_6_months'),',') ? str_replace(',', '.', $this->input->post('total_income_6_months')) : $this->input->post('total_income_6_months'),
                        // End New

                        // Bình quân doanh thu/đầu người
                        // New
                        'per_capita_income_1' => strstr($this->input->post('per_capita_income_1'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_1')) : $this->input->post('per_capita_income_1'),
                        'per_capita_income_percent_1' => strstr($this->input->post('per_capita_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_percent_1')) : $this->input->post('per_capita_income_percent_1'),
                        'per_capita_income_2' => strstr($this->input->post('per_capita_income_2'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_2')) : $this->input->post('per_capita_income_2'),
                        'per_capita_income_percent_2' => strstr($this->input->post('per_capita_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_percent_2')) : $this->input->post('per_capita_income_percent_2'),
                        'per_capita_income_6_months' => strstr($this->input->post('per_capita_income_6_months'),',') ? str_replace(',', '.', $this->input->post('per_capita_income_6_months')) : $this->input->post('per_capita_income_6_months'),
                        // End New

                        // Tổng doanh thu lĩnh vực phần mềm, giải pháp
                        'software_income_1' => strstr($this->input->post('software_income_1'),',') ? str_replace(',', '.', $this->input->post('software_income_1')) : $this->input->post('software_income_1'),
                        'software_income_percent_1' => strstr($this->input->post('software_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('software_income_percent_1')) : $this->input->post('software_income_percent_1'),
                        'software_income_2' => strstr($this->input->post('software_income_2'),',') ? str_replace(',', '.', $this->input->post('software_income_2')) : $this->input->post('software_income_2'),
                        'software_income_percent_2' => strstr($this->input->post('software_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('software_income_percent_2')) : $this->input->post('software_income_percent_2'),
                        'software_income_6_months' => strstr($this->input->post('software_income_6_months'),',') ? str_replace(',', '.', $this->input->post('software_income_6_months')) : $this->input->post('software_income_6_months'),
                        // End New

                        // Tổng doanh thu dịch vụ CNTT
                        'it_income_1' => strstr($this->input->post('it_income_1'),',') ? str_replace(',', '.', $this->input->post('it_income_1')) : $this->input->post('it_income_1'),
                        'it_income_percent_1' => strstr($this->input->post('it_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('it_income_percent_1')) : $this->input->post('it_income_percent_1'),
                        'it_income_2' => strstr($this->input->post('it_income_2'),',') ? str_replace(',', '.', $this->input->post('it_income_2')) : $this->input->post('it_income_2'),
                        'it_income_percent_2' => strstr($this->input->post('it_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('it_income_percent_2')) : $this->input->post('it_income_percent_2'),
                        'it_income_6_months' => strstr($this->input->post('it_income_6_months'),',') ? str_replace(',', '.', $this->input->post('it_income_6_months')) : $this->input->post('it_income_6_months'),
                        // End New

                        // Tổng doanh thu xuất khẩu
                        'export_income_1' => strstr($this->input->post('export_income_1'),',') ? str_replace(',', '.', $this->input->post('export_income_1')) : $this->input->post('export_income_1'),
                        'export_income_percent_1' => strstr($this->input->post('export_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('export_income_percent_1')) : $this->input->post('export_income_percent_1'),
                        'export_income_2' => strstr($this->input->post('export_income_2'),',') ? str_replace(',', '.', $this->input->post('export_income_2')) : $this->input->post('export_income_2'),
                        'export_income_percent_2' => strstr($this->input->post('export_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('export_income_percent_2')) : $this->input->post('export_income_percent_2'),
                        'export_income_6_months' => strstr($this->input->post('export_income_6_months'),',') ? str_replace(',', '.', $this->input->post('export_income_6_months')) : $this->input->post('export_income_6_months'),
                        // End New

                        // Tổng doanh thu của lĩnh vực ứng cử:
                        // Thị trường quốc tế
                        // New
                        'international_income_1' => strstr($this->input->post('international_income_1'),',') ? str_replace(',', '.', $this->input->post('international_income_1')) : $this->input->post('international_income_1'),
                        'international_income_percent_1' => strstr($this->input->post('international_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('international_income_percent_1')) : $this->input->post('international_income_percent_1'),
                        'international_income_2' => strstr($this->input->post('international_income_2'),',') ? str_replace(',', '.', $this->input->post('international_income_2')) : $this->input->post('international_income_2'),
                        'international_income_percent_2' => strstr($this->input->post('international_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('international_income_percent_2')) : $this->input->post('international_income_percent_2'),
                        'international_income_6_months' => strstr($this->input->post('international_income_6_months'),',') ? str_replace(',', '.', $this->input->post('international_income_6_months')) : $this->input->post('international_income_6_months'),
                        // End New

                        // Tổng doanh thu của lĩnh vực ứng cử:
                        // Thị trường nội địa
                        // New
                        'domestic_income_1' => strstr($this->input->post('domestic_income_1'),',') ? str_replace(',', '.', $this->input->post('domestic_income_1')) : $this->input->post('domestic_income_1'),
                        'domestic_income_percent_1' => strstr($this->input->post('domestic_income_percent_1'),',') ? str_replace(',', '.', $this->input->post('domestic_income_percent_1')) : $this->input->post('domestic_income_percent_1'),
                        'domestic_income_2' => strstr($this->input->post('domestic_income_2'),',') ? str_replace(',', '.', $this->input->post('domestic_income_2')) : $this->input->post('domestic_income_2'),
                        'domestic_income_percent_2' => strstr($this->input->post('domestic_income_percent_2'),',') ? str_replace(',', '.', $this->input->post('domestic_income_percent_2')) : $this->input->post('domestic_income_percent_2'),
                        'domestic_income_6_months' => strstr($this->input->post('domestic_income_6_months'),',') ? str_replace(',', '.', $this->input->post('domestic_income_6_months')) : $this->input->post('domestic_income_6_months'),
                        // End New

                        // Tổng số lập trình viên
                        // New
                        'before_tax_profit_1' => strstr($this->input->post('before_tax_profit_1'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_1')) : $this->input->post('before_tax_profit_1'),
                        'before_tax_profit_percent_1' => strstr($this->input->post('before_tax_profit_percent_1'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_percent_1')) : $this->input->post('before_tax_profit_percent_1'),
                        'before_tax_profit_2' => strstr($this->input->post('before_tax_profit_2'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_2')) : $this->input->post('before_tax_profit_2'),
                        'before_tax_profit_percent_2' => strstr($this->input->post('before_tax_profit_percent_2'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_percent_2')) : $this->input->post('before_tax_profit_percent_2'),
                        'before_tax_profit_6_months' => strstr($this->input->post('before_tax_profit_6_months'),',') ? str_replace(',', '.', $this->input->post('before_tax_profit_6_months')) : $this->input->post('before_tax_profit_6_months'),
                        // End New

                        // New
                        // Tổng số nhân viên toàn thời gian
                        'full_time_employee' => strstr($this->input->post('full_time_employee'),',') ? str_replace(',', '.', $this->input->post('full_time_employee')) : $this->input->post('full_time_employee'),
                        // Độ tuổi trung bình
                        'average_age' => strstr($this->input->post('average_age'),',') ? str_replace(',', '.', $this->input->post('average_age')) : $this->input->post('average_age'),
                        // Tỷ lệ tăng/giảm nhân sự hàng năm trong 02 năm gần nhất:
                        'employee_change_percent_1' => strstr($this->input->post('employee_change_percent_1'),',') ? str_replace(',', '.', $this->input->post('employee_change_percent_1')) : $this->input->post('employee_change_percent_1'),
                        'employee_change_percent_2' => strstr($this->input->post('employee_change_percent_2'),',') ? str_replace(',', '.', $this->input->post('employee_change_percent_2')) : $this->input->post('employee_change_percent_2'),

                        // Số nhân viên có thể sử dụng ngoại ngữ trong công việc
                        'english_employee' => strstr($this->input->post('english_employee'),',') ? str_replace(',', '.', $this->input->post('english_employee')) : $this->input->post('english_employee'),
                        'english_employee_percent' => strstr($this->input->post('english_employee_percent'),',') ? str_replace(',', '.', $this->input->post('english_employee_percent')) : $this->input->post('english_employee_percent'),
                        'japanese_employee' => strstr($this->input->post('japanese_employee'),',') ? str_replace(',', '.', $this->input->post('japanese_employee')) : $this->input->post('japanese_employee'),
                        'japanese_employee_percent' => strstr($this->input->post('japanese_employee_percent'),',') ? str_replace(',', '.', $this->input->post('japanese_employee_percent')) : $this->input->post('japanese_employee_percent'),
                        'other_language_employee' => strstr($this->input->post('other_language_employee'),',') ? str_replace(',', '.', $this->input->post('other_language_employee')) : $this->input->post('other_language_employee'),
                        'other_language_employee_percent' => strstr($this->input->post('other_language_employee_percent'),',') ? str_replace(',', '.', $this->input->post('other_language_employee_percent')) : $this->input->post('other_language_employee_percent'),
                        'other_language' => $this->input->post('other_language'),
                        // Trình độ chuyên môn
                        'qualification' => $this->input->post('qualification'),
                        // Mức lương trung bình/năm
                        'average_salary' => strstr($this->input->post('average_salary'),',') ? str_replace(',', '.', $this->input->post('average_salary')) : $this->input->post('average_salary'),
                        // Số nhân viên thuộc bộ phận chăm sóc khách hàng
                        'customer_supporter' => strstr($this->input->post('customer_supporter'),',') ? str_replace(',', '.', $this->input->post('customer_supporter')) : $this->input->post('customer_supporter'),
                        // Công tác đào tạo, bồi dưỡng nhân lực
                        'training_process' => $this->input->post('training_process'),
                        // Hoạt động tuyển dụng nhân sự
                        'recruitment_staff' => strstr($this->input->post('recruitment_staff'),',') ? str_replace(',', '.', $this->input->post('recruitment_staff')) : $this->input->post('recruitment_staff'),
                        'recruitment_budget' => strstr($this->input->post('recruitment_budget'),',') ? str_replace(',', '.', $this->input->post('recruitment_budget')) : $this->input->post('recruitment_budget'),
                        // Chi phí đầu tư cho hoạt động R&D
                        'investment_fund_r_and_d' => strstr($this->input->post('investment_fund_r_and_d'),',') ? str_replace(',', '.', $this->input->post('investment_fund_r_and_d')) : $this->input->post('investment_fund_r_and_d'),
                        'investment_fund_r_and_d_percent' => strstr($this->input->post('investment_fund_r_and_d_percent'),',') ? str_replace(',', '.', $this->input->post('investment_fund_r_and_d_percent')) : $this->input->post('investment_fund_r_and_d_percent'),
                        'staff_r_and_d' => strstr($this->input->post('staff_r_and_d'),',') ? str_replace(',', '.', $this->input->post('staff_r_and_d')) : $this->input->post('staff_r_and_d'),
                        'result_r_and_d' => $this->input->post('result_r_and_d'),
                        // Chế độ bảo mật của công ty và bảo mật cho khách hàng
                        'security_certificate' => $this->input->post('security_certificate'),
                        'security_process' => $this->input->post('security_process'),
                        // Quản lý công nghệ, chất lượng
                        'technique_certificate' => $this->input->post('technique_certificate'),
                        // HOẠT ĐỘNG CỘNG ĐỒNG, CÁC GIẢI THƯỞNG, DANH HIỆU VÀ CÁC THÀNH TÍCH ĐẶC BIỆT DOANH NGHIỆP ĐÃ ĐẠT ĐƯỢC
                        'reward' => $this->input->post('reward'),

                        // End New
                        'main_service' => $main_service,
                        'main_market' => $main_market,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );

                    try {
                        $this->information_model->update_by_information_and_year('company', $this->data['user']->username, $this->data['eventYear'], $data);
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }

                    redirect('client/information/company?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }

    }

    public function products(){
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'client/information/products';
        $total_rows = $this->information_model->count_product($this->data['user']->id);
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['products'] = $this->information_model->get_all_product($this->data['user']->id, $per_page, $this->data['page']);

        $this->render('client/information/list_product_view');
    }

    public function detail_product($id = NULL){
        $this->data['product'] = $this->information_model->fetch_product_by_user_and_id('product', $this->data['user']->id, $id);

        $this->render('client/information/detail_product_view');
    }

    public function remove_product($id = null){
        $deleted = $this->information_model->delete('product', $id);
        if ($deleted) {
            $this->session->set_flashdata('message', 'Xóa sản phẩm thành công');
            redirect('client/information/products', 'refresh');
        }else{
            $this->session->set_flashdata('message_error', 'Có lỗi trong quá trình xóa sản phẩm');
            redirect('client/information/products', 'refresh');
        }
    }

    public function create_product(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        if($this->input->post('submit') == 'Hoàn thành') {
            $this->form_validation->set_rules('name', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            // $this->form_validation->set_rules('service', 'Data', 'trim|required');
            $this->form_validation->set_rules('copyright_certificate', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('functional', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('process', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('security', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('positive', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('compare', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('income_2016', 'Data', 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('income_2017', 'Data', 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('area', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('open_date', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('price', 'Data', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            $this->form_validation->set_rules('customer', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('after_sale', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('team', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('award', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('service[]', 'Lĩnh vực', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            // $this->form_validation->set_rules('file', 'Data', 'callback_check_file_selected');

            if ($this->form_validation->run() == FALSE) {
                // if($this->data['reg_status']['is_information'] == 0){
                //     $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
                //     redirect('client/information/create_extra', 'refresh');
                // }
                $this->render('client/information/create_product_view');
            } else {
                if ($this->input->post()) {
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }

                    $service = json_encode($this->input->post('service'));
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        'compare' => $this->input->post('compare'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'information_id' => $this->data['user']->information_id,
                        'identity' => $this->data['user']->username,
                        // 'certificate' => $image,
                        // 'is_submit' => 1,
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    $insert = $this->information_model->insert_product('product', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_product' => 1));
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/information/products', 'refresh');
                }
            }
        }else{
            $this->form_validation->set_rules('name', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('income_2016', 'Data', 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('income_2017', 'Data', 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));

            if ($this->form_validation->run() == FALSE) {
                // if($this->data['reg_status']['is_information'] == 0){
                //     $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
                //     redirect('client/information/create_extra', 'refresh');
                // }
                $this->render('client/information/create_product_view');
            } else {
                if ($this->input->post()) {
                    $service = json_encode($this->input->post('service'));
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }
                    // $image = $this->upload_image('certificate', $_FILES['certificate']['name'], 'assets/upload/product', 'assets/upload/product/thumbs');
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        'compare' => $this->input->post('compare'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'information_id' => $this->data['user']->information_id,
                        'identity' => $this->data['user']->username,
                        // 'certificate' => $image,
                        // 'is_submit' => 1,
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    $insert = $this->information_model->insert_product('product', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
//                    $this->load->model('status_model');
//                    $this->status_model->update('status', $this->data['user']->id, array('is_product' => 1));
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/information/products', 'refresh');
                }
            }
        }

    }

    public function edit_product($request_id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if($this->input->post('submit') == 'Hoàn thành') {
            $this->form_validation->set_rules('name', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            // $this->form_validation->set_rules('service', 'Data', 'trim|required');
            $this->form_validation->set_rules('copyright_certificate', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('functional', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('process', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('security', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('positive', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('compare', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('income_2016', 'Data', 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('income_2017', 'Data', 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('area', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('open_date', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('price', 'Data', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            $this->form_validation->set_rules('customer', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('after_sale', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('team', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('award', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('service[]', 'Lĩnh vực', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            // $this->form_validation->set_rules('file', 'Data', 'callback_check_file_selected');

            $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
            if ($this->form_validation->run() == FALSE) {
                $this->data['product'] = $this->information_model->fetch_product_by_user_id('product', $this->data['user']->id, $id);
                if (!$this->data['product']) {
                    redirect('client/information/product', 'refresh');
                }
                $this->render('client/information/edit_product_view');
            } else {
                if ($this->input->post()) {
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }
                    $service = json_encode($this->input->post('service'));
                    $data = array(
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        'compare' => $this->input->post('compare'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'is_submit' => 1,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by'],
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    try {
                        $this->information_model->update_product('product', $this->data['user']->id, $id, $data);
                        $this->load->model('status_model');
                        $this->status_model->update('status', $this->data['user']->id, array('is_product' => 1));
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }
                    redirect('client/information/products', 'refresh');
                }
            }
        }else{
            $this->form_validation->set_rules('name', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('income_2016', 'Data', 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('income_2017', 'Data', 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => '%s Tối đa 10 chữ số'
            ));
            $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
            if ($this->form_validation->run() == FALSE) {
                $this->data['product'] = $this->information_model->fetch_product_by_user_id('product', $this->data['user']->id, $id);
                if (!$this->data['product']) {
                    redirect('client/information/product', 'refresh');
                }
                $this->render('client/information/edit_product_view');
            } else {
                if ($this->input->post()) {
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }
                    $service = json_encode($this->input->post('service'));
                    $data = array(
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        'compare' => $this->input->post('compare'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'is_submit' => 1,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    try {
                        $this->information_model->update_product('product', $this->data['user']->id, $id, $data);
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }
                    redirect('client/information/products', 'refresh');
                }
            }
        }

    }

    function check_file_selected(){


        if (empty($_FILES['file']['name'])) {
            $this->form_validation->set_message(__FUNCTION__, 'Data không được trống');
            return false;
        }else{
            return true;
        }
    }

    public function set_final(){
        $company = $this->information_model->fetch_by_user_id('company', $this->data['user']->id);
        $groups = (array)json_decode($company['group'], true);
        $data_insert = array();
        if (!empty($groups)) {
            foreach ($groups as $key => $value) {
                $data_insert[] = array(
                    'client_id' => $this->data['user']->id,
                    'name' => $value,
                    'information_id' => $this->data['user']->information_id,
                    'identity' => $this->data['user']->username,
                    'created_at' => $this->author_info['created_at'],
                    'created_by' => $this->author_info['created_by'],
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );
            }
            $insert = $this->information_model->insert_batch_product('product', $data_insert);
        }
                
        $this->status_model->update_status_final('status', $this->data['user']->id, $this->data['eventYear'], array('is_final' => 1));
        $this->send_mail($this->data['user']->email);
        redirect('client/dashboard', 'refresh');
    }

    function send_mail($email){
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "smtp.gmail.com"; // specify main and backup server
        $mail->Port = 465; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = 'ssl';
        $mail->Username = "support@vinasa.org.vn"; // your SMTP username or your gmail username
        $mail->Password = "kcirpkmdlgbcobcv"; // your SMTP password or your gmail password
        $from = "support@vinasa.org.vn"; // Reply to this email
        $to = $email; // Recipients email ID
        $name = 'dangky.top10ict.com'; // Recipient's name
        $mail->From = $from;
        $mail->FromName = $name; // Name to indicate where the email came from when the recepient received
        $mail->AddAddress($to, $name);
        $mail->CharSet = 'UTF-8';
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = "Mail từ dangky.top10ict.com";
        $mail->Body = $this->email_template_final_register();

        // $mail->SMTPDebug = 2;

        if(!$mail->Send()){
            return false;
        } else {
            return true;
        }
    }

    function email_template_final_register(){
        $CI =& get_instance();
        return $CI->load->view('auth/email_client/final_register.tpl.php',false,true);
    }

    protected function check_img($filename, $filesize){
        $map = strripos($filename, '.')+1;
        $fileextension = substr($filename, $map,(strlen($filename)-$map));
        $array_image = array('jpg', 'jpeg', 'png', 'gif');
        if( !in_array($fileextension, $array_image) || $filesize > 1228800){
            $this->session->set_flashdata('message_error', 'Định dạng file không đúng hoặc dung lượng ảnh vượt quá 1200Kb');
            redirect('client/information/extra');
        }
        return true;
    }
    protected function check_file($filename){
        $map = strripos($filename, '.')+1;
        $fileextension = substr($filename, $map,(strlen($filename)-$map));
        $array_image = array('docx', 'doc', 'xlsx', 'xlsm', 'xlsb', 'xltx', 'xltm', 'xls', 'pdf');
        if( !in_array($fileextension, $array_image)){
            $this->session->set_flashdata('message_error', 'Định dạng file không đúng');
            redirect('client/information/products');
        }
    }

    function vn_to_str ($str){

        $unicode = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd'=>'đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i'=>'í|ì|ỉ|ĩ|ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D'=>'Đ',

            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach($unicode as $nonUnicode=>$uni){

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);

        }
        $str = str_replace(' ','_',$str);

        return $str;

    }

    function check_word_length($unicode_string){
        // First remove all the punctuation marks & digits
        $unicode_string = preg_replace('/[[:punct:][:digit:]]/', '', $unicode_string);

        // Now replace all the whitespaces (tabs, new lines, multiple spaces) by single space
        $unicode_string = preg_replace('/[[:space:]]/', ' ', $unicode_string);

        // The words are now separated by single spaces and can be splitted to an array
        // I have included \n\r\t here as well, but only space will also suffice
        $words_array = preg_split( "/[\n\r\t ]+/", $unicode_string, 0, PREG_SPLIT_NO_EMPTY );

        // Now we can get the word count by counting array elments
        $this->form_validation->set_message('check_word_length', 'Tối đa khoảng 1000 từ.');
        if (count($words_array) > 1500) {
            return false;
        }else{
            return true;
        }
    }
}
