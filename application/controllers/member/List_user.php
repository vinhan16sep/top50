<?php defined('BASEPATH') OR exit('No direct script access allowed');

class List_user extends Member_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('information_model');
        $this->load->model('team_model');
        $this->load->model('new_rating_model');
    }

    public function index($team_id='', $product_id=''){
    	if ($this->ion_auth->user()->row()->member_role != 'leader') {
    		redirect('member/','refresh');
    	}

        $this->load->model('users_model');
        $user = $this->ion_auth->user()->row();
        $user_id = $user->id;
        $team_by_leader = $this->team_model->get_by_leader_id('team', $user_id);
        $list_product = array();
        $list_team_by_leader = array();
        if ($team_by_leader) {
            foreach ($team_by_leader as $key => $value) {
                $product_ids = explode(',', $value['product_id']);
                foreach ($product_ids as $k => $val) {
                    if ( !empty($val) ) {
                        $list_product[] = $val;
                    }
                }
                $list_team_by_leader[] = $value['id'];
            }

            
        }

        $list_product = array_unique($list_product);
        $list_team_by_leader = array_unique($list_team_by_leader);
        
        if (!in_array($product_id, $list_product)) {
            $this->session->set_flashdata('main_service_message', 'Sản phẩm không tồn tại hoặc không thuộc nhóm của bạn');
            redirect('member','refresh');
        }
        if (!in_array($team_id, $list_team_by_leader)) {
            $this->session->set_flashdata('main_service_message', 'Nhóm không tồn tại hoặc không phải nhóm do bạn quản lý bạn');
            redirect('member','refresh');
        }


    	$team = $this->team_model->fetch_by_id('team', $team_id);

    	$list_team = array();
        $members = array();
        $team_rating_total = 0;
        $rated_members = 0;

    	if ($team && $team['member_id']) {
    		$member_ids = explode(',', $team['member_id']);
            if ( is_array($member_ids) && !empty($member_ids) ) {
                foreach($member_ids as $k => $val){
                    if(empty($val)){
                        unset($member_ids[$k]);
                    }
                }
                $member_ids[] = $team['leader_id'];
                if($member_ids){
                    $members = $this->information_model->get_personal_members($member_ids);
                    if ($members) {
                    	foreach ($members as $key => $value) {
                    		$is_rating = $this->new_rating_model->get_rating_exist_by_product_id('new_rating', $product_id, $value['id']);
                    		if ( $is_rating) {
                    			$members[$key]['is_rating'] = 1;
                    			$members[$key]['total'] = $is_rating['total'];
                                $team_rating_total += $is_rating['total'];
                                $rated_members++;
                    		}else{
                    			$members[$key]['is_rating'] = 0;
                    			$members[$key]['total'] = "Chưa chấm";
                    		}
                    	}
                    	$list_team = $members;
                    }
                }

            }
    	}
    	$product = $this->information_model->fetch_by_id('product', $product_id);
        $company_name = $this->users_model->fetch_by_id($product['client_id']);

        $this->data['team'] = $team;
        $this->data['team_rating_total'] = ($rated_members > 0) ? $team_rating_total / $rated_members : 0;
        $this->data['company_name'] = $company_name;
        $this->data['product'] = $product;
    	$this->data['list_team'] = $list_team;
    	$this->data['product_id'] = $product_id;
    	$this->data['main_service'] = $product ? $product['main_service'] : '';
    	$this->render('member/list_team/index');
    }

}