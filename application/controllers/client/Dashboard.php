<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Client_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('clients')) {
            //redirect them to the login page
            redirect('client/user/login', 'refresh');
        }
        $this->load->model('status_model');
        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['reg_status'] = $this->status_model->fetch_by_client_id($this->data['user']->id, $this->data['eventYear']);
        if(empty($this->data['reg_status'])){
            $status = array(
                'client_id' => $this->data['user']->id,
                'is_information' => 1,
                'is_company' => 0,
                'is_product' => 0,
                'is_final' => 0,
                'year' => $this->data['eventYear'],
            );
            $this->status_model->insert('status', $status);
        }
    }

    public function index(){
        if($this->input->get('complete') == 1){
            $this->status_model->update_company_complete_by_client_and_year($this->data['user']->id, $this->data['eventYear']);
            redirect('client/dashboard', 'refresh');
        }
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->load->model('information_model');
        $this->data['information_submitted'] = $this->information_model->fetch_extra_by_identity('information', $this->data['user']->username);
        $this->data['company_submitted'] = $this->information_model->fetch_list_company_by_identity_and_year($this->data['user']->username, $this->data['eventYear']);
        $this->data['count_product'] = $this->information_model->count_product($this->data['user']->id);

        $checkInformation = $this->information_model->checkExist('information', $this->data['user']->username);
        $checkCompany = $this->information_model->checkExist('company', $this->data['user']->username);
        $checkProduct = $this->information_model->checkExist('product', $this->data['user']->username);
        $this->data['complete'] = 0;
        if($checkInformation > 0 && $checkCompany > 0){
            $this->data['complete'] = 1;
        }

        $this->data['noMoreTemporaryData'] = 0;
        if($this->data['reg_status']['is_information'] == 1 && $this->data['reg_status']['is_company'] == 1){
            $this->data['noMoreTemporaryData'] = 1;
        }
        $this->render('client/dashboard_view');
    }
}