<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Basic extends Member_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('information_model');
		$this->load->model('team_model');
        $this->load->library('ion_auth');
        $this->load->model('status_model');
        $this->load->model('users_model');
        $this->load->model('new_rating_model');

        $this->excel = new PHPExcel();
	}

    public function detail($id = null){
        $this->load->helper('form');
        $this->load->library('form_validation');
	    $client_id = $this->input->get('client_id');
        if(!$id || !$client_id){
            redirect('member/dashboard', 'refresh');
        }
        $this->data['extra'] = $this->information_model->fetch_extra_by_client_id('information', $client_id);
        $this->data['user'] = $this->users_model->fetch_by_id($client_id);
        if(!$this->data['extra']){
            redirect('member/dashboard', 'refresh');
        }
        $this->render('member/detail_extra_view');
    }
}