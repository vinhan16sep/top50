<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('information_model');
    }

    public function index(){
		$this->load->model('users_model');
		
		// $this->update_batch();

    	/* Total companies */
    	$total_companies = $this->information_model->count_companies();
    	
    	/* total products */
    	$total_products = $this->information_model->count_all_product();

    	$this->data['total_companies'] = $total_companies;
    	$this->data['total_products'] = $total_products;
        $this->render('admin/dashboard_view');
	}
	
	function update_batch(){
        $this->load->model('status_model');
        $this->load->model('information_model');
		$status_final = $this->status_model->get_all_final();

		$products = $this->information_model->get_all_product_update_batch();
		
		$product_client_ids = [];
		foreach($products as $val){
			$product_client_ids[] = $val['client_id'];
		}

		$client_ids = [];
		foreach($status_final as $val){
			$client_ids[] = $val['client_id'];
		}

		$client_id_not_product = [];
		foreach($client_ids as $id){
			if(!in_array($id, $product_client_ids)){
				$client_id_not_product[] = $id;
			}
		}
		if(empty($client_id_not_product)){
			redirect('admin/dashboard', 'refresh');
		}

		$company_not_product = $this->information_model->get_company_not_product($client_id_not_product);
		
		foreach($company_not_product as $val){
			$products = json_decode($val['group']);
			$infomation = $this->information_model->get_information_with_select_by_id($val['client_id']);
			foreach($products as $prod){
				$data = [
					'client_id' => $val['client_id'],
					'name' => $prod,
					'created_at' => $val['created_at'],
					'created_by' => $val['created_by'],
					'modified_at' => $val['created_at'],
					'modified_by' => $val['created_by'],
					'information_id' => $infomation['id'],
					'year' => '2020', // CHANGE ???
					'identity' => $val['identity'],
				];
				$this->information_model->insert('product', $data);
			}

		}

		redirect('admin/team/index', 'refresh');

	}
}