<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Analyze extends Admin_Controller{

    private $excel = null;

	function __construct(){
		parent::__construct();
		$this->load->model('information_model');
        $this->load->model('users_model');
        $this->load->model('status_model');
		$this->load->model('company_model');

        $this->excel = new PHPExcel();
	}

	public function index($identity = null, $selected_year = null){
    	if ($identity == null) {
    		redirect('admin', 'refresh');
    	}
    	if ($selected_year == null) {
    		redirect('admin', 'refresh');
		}
		$groups = $this->config->item('development/config_information')['groups'];
		$chart_data = [];
		$selected_year_company = $this->company_model->fetch_company_by_identity_and_year($identity, $selected_year);
		
		///////////////////////// INCOME PER AREA /////////////////////////
		// First Area === owner_equity_2
		if ($selected_year_company['owner_equity_2'] != null && !empty($selected_year_company['owner_equity_2'])) {
			$area_1 = str_replace('.', '', $selected_year_company['owner_equity_2']);
			$area_1 = str_replace(',', '', $area_1);
			// $area_1 = number_format($area_1, 0, '.', ',');
		} else {
			$area_1 = 0;
		}
		// Second Area === international_income_2
		if ($selected_year_company['international_income_2'] != null && !empty($selected_year_company['international_income_2'])) {
			$area_2 = str_replace('.', '', $selected_year_company['international_income_2']);
			$area_2 = str_replace(',', '', $area_2);
			// $area_2 = number_format($area_2, 0, '.', ',');
		} else {
			$area_2 = 0;
		}
		// Third Area === nomination_income_2
		if ($selected_year_company['nomination_income_2'] != null && !empty($selected_year_company['nomination_income_2'])) {
			$area_3 = str_replace('.', '', $selected_year_company['nomination_income_2']);
			$area_3 = str_replace(',', '', $area_3);
			// $area_3 = number_format($area_3, 0, '.', ',');
		} else {
			$area_3 = 0;
		}
		///////////////////////// INCOME PER AREA /////////////////////////

		///////////////////////// LABOR PER AREA /////////////////////////
		// First Area === number_personnel_nominated_1
		if ($selected_year_company['number_personnel_nominated_1'] != null && !empty($selected_year_company['number_personnel_nominated_1'])) {
			$labor_area_1 = str_replace('.', '', $selected_year_company['number_personnel_nominated_1']);
			$labor_area_1 = str_replace(',', '', $labor_area_1);
		} else {
			$labor_area_1 = 0;
		}
		// Second Area === number_personnel_nominated_2
		if ($selected_year_company['number_personnel_nominated_2'] != null && !empty($selected_year_company['number_personnel_nominated_2'])) {
			$labor_area_2 = str_replace('.', '', $selected_year_company['number_personnel_nominated_2']);
			$labor_area_2 = str_replace(',', '', $labor_area_2);
		} else {
			$labor_area_2 = 0;
		}
		// Third Area === number_personnel_nominated_3
		if ($selected_year_company['number_personnel_nominated_3'] != null && !empty($selected_year_company['number_personnel_nominated_3'])) {
			$labor_area_3 = str_replace('.', '', $selected_year_company['number_personnel_nominated_3']);
			$labor_area_3 = str_replace(',', '', $labor_area_3);
		} else {
			$labor_area_3 = 0;
		}
		///////////////////////// LABOR PER AREA /////////////////////////

		$selected_year_product = $this->information_model->get_product_by_identity_and_year($identity, $selected_year);
		if (!empty($selected_year_product)) {
			foreach ($selected_year_product as $key => $val) {
				if ($key == 0) {
					$chart_data['area'][$groups[$val['name']]] = $area_1;
					$chart_data['labor_area'][$groups[$val['name']]] = $labor_area_1;
				} elseif ($key == 1) {
					$chart_data['area'][$groups[$val['name']]] = $area_2;
					$chart_data['labor_area'][$groups[$val['name']]] = $labor_area_2;
				} elseif ($key == 2) {
					$chart_data['area'][$groups[$val['name']]] = $area_3;
					$chart_data['labor_area'][$groups[$val['name']]] = $labor_area_3;
				}
			}
		}

		$all_year_company = $this->company_model->fetch_company_by_identity($identity);
		foreach ($all_year_company as $key => $val) {
			if ($val['total_income_2'] != null && !empty($val['total_income_2'])) {
				$total_income_2 = str_replace('.', '', $val['total_income_2']);
				$total_income_2 = str_replace(',', '', $total_income_2);
			} else {
				$total_income_2 = 0;
			}
			$chart_data['all_year_income'][((int) $val['year'] - 1)] = $total_income_2;

			// Labor stored in domestic_income_2
			if ($val['domestic_income_2'] != null && !empty($val['domestic_income_2'])) {
				$labor = str_replace('.', '', $val['domestic_income_2']);
				$labor = str_replace(',', '', $labor);
			} else {
				$labor = 0;
			}
			$chart_data['all_year_labor'][((int) $val['year'] - 1)] = $labor;
		}
		
		$this->data['chart_data'] = $chart_data;
		$this->data['selected_year'] = $selected_year;

		$this->render('admin/analyze/index');
	}
	
    public function index2($year = null){
    	$this->load->helper('form');
        $this->load->library('form_validation');
        $this->data['total_2019'] = false;
        $this->data['service'] = '';
        $this->data['year'] = $year;
        if($this->input->post('submit') == 'Xác nhận') {
            $this->form_validation->set_rules('service[]', 'Lĩnh vực', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            if ($this->form_validation->run() == TRUE) {
            	$service_check = $this->input->post('service');
	        	$products = $this->information_model->get_all_product_by_year($year);
		        $this->data['total_2019'] = 0;
		        $this->data['service'] = $service_check[0];
		        foreach ($products as $key => $value) {
		        	// check box
		            $is_company_submitted = $this->status_model->check_company_submitted($value['client_id'], $year);
		            $service = (array)json_decode($value['service'], true);
		            if ( in_array($service_check[0], $service) && $is_company_submitted ) {
		                $this->data['total_2019'] += (int) $value['income_2017'];
		            }
		        }
		    }
        }
	        
        $this->render('admin/analyze/index');
    }
}
