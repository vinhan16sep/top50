<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Member_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('information_model');
        $this->load->model('team_model');
        $this->load->model('new_rating_model');
        $this->load->model('status_model');
        $this->load->model('users_model');
    }

    public function index(){
    	$user = $this->ion_auth->user()->row();
        $team = $this->team_model->get_by_user_id('team', $user->user_id);
        $product_ids = array();
        foreach ($team as $key => $value) {
            if ( !empty($value['product_id']) ) {
                $product_ids[] = explode(',', $value['product_id']);
            }
        }

    	if($user->member_role == 'member'){
            $team = $this->get_personal_products($user->id);
            foreach($team as $team_key => $team_value){
                if(isset($team_value['product_list'])){
                    foreach((array) $team_value['product_list'] as $product_key => $product_value){
                        $company_name = $this->users_model->fetch_by_id($product_value['client_id']);
                        $company_info = $this->information_model->fetch_company_by_client_id_2($product_value['client_id']);

                        (array) $team[$team_key]['product_list'][$product_key]['members_rating_total'] = 'Dành cho trưởng nhóm';

                        (array) $team[$team_key]['product_list'][$product_key]['company_name'] = $company_name['company'];
                        (array) $team[$team_key]['product_list'][$product_key]['company_id'] = $company_info['id'];

                        $new_rating = $this->new_rating_model->fetch_by_product_id_and_logged_in_user('new_rating', $product_value['id'], $user->user_id);
                        if(isset($new_rating['total'])){
                            (array) $team[$team_key]['product_list'][$product_key]['new_rating'] = $new_rating['total'];
                        }else{
                            (array) $team[$team_key]['product_list'][$product_key]['new_rating'] = 'Chưa chấm';
                        }
                    }
                }
            }

            $this->data['team'] = $team;
            $this->data['user_id'] = $user->id;

            $this->render('member/dashboard_view');
        }elseif($user->member_role == 'leader'){
            $team = $this->get_personal_products_by_leader($user->id);
            foreach((array) $team as $team_key => $team_value){
                if(isset($team_value['product_list'])){
                    foreach((array) $team_value['product_list'] as $product_key => $product_value){
                        $rated = $this->new_rating_model->fetch_by_product_id_submited('new_arting', $product_value['id']);
                        $total = 0;
                        $rated_member = 0;
                        if($rated){
                            foreach($rated as $k => $v){
                                $total += $v['total'];
                                $rated_member++;
                            }
                        }
                        (array) $team[$team_key]['product_list'][$product_key]['members_rating_total'] = ($rated_member > 0) ? round($total / $rated_member, 2) : "Chưa có";
                        
                        $company_name = $this->users_model->fetch_by_id($product_value['client_id']);
                        $company_info = $this->information_model->fetch_company_by_client_id_2($product_value['client_id']);

                        (array) $team[$team_key]['product_list'][$product_key]['company_name'] = $company_name['company'];
                        (array) $team[$team_key]['product_list'][$product_key]['company_id'] = $company_info['id'];

                        $new_rating = $this->new_rating_model->fetch_by_product_id_and_logged_in_user('new_rating', $product_value['id'], $user->user_id);
                        if(isset($new_rating['total'])){
                            (array) $team[$team_key]['product_list'][$product_key]['new_rating'] = $new_rating['total'];
                        }else{
                            (array) $team[$team_key]['product_list'][$product_key]['new_rating'] = 'Chưa chấm';
                        }
                    }
                }
            }

            $this->data['team'] = $team;
            
            $this->data['user_id'] = $user->id;

            $this->render('member/dashboard_view');
        }else{
            $this->data['team'] = array();
            $this->data['user_id'] = array();

            $this->render('member/dashboard_view');
        }
    	
    }

    public function users(){
        if ($this->ion_auth->user()->row()->member_role != 'leader') {
            redirect('member','refresh');
        }
        $user = $this->ion_auth->user()->row();
        if ($user->member_role == 'leader') {
            $this->data['team'] = $this->get_personal_members_by_leader($user->id);

            $this->data['user_id'] = $user->id;

            $this->render('member/dashboard_leader_view');
        }
    }

    public function get_personal_products($user_id){
        $list_team = $this->team_model->get_current_user_team($user_id);
        if ( !empty($list_team) ) {
            foreach($list_team as $key => $value){
                $product_ids = explode(',', $value['product_id']);
                if ( is_array($product_ids) && !empty($product_ids) ) {
                    foreach($product_ids as $k => $val){
                        if(empty($val)){
                            unset($product_ids[$k]);
                        }
                    }
                    if($product_ids){
                        $products = $this->information_model->get_personal_products($product_ids);
                        if ($products) {
                            foreach ($products as $it => $item) {
                                $check_product_is_rating = $this->new_rating_model->check_rating_exist_by_product_id('new_rating', $item['id'], $user_id);
                                if ( $check_product_is_rating ) {
                                    $products[$it]['is_rating'] = 1;
                                }else{
                                    $products[$it]['is_rating'] = 0;
                                }
                            }
                        }
                        $list_team[$key]['product_list'] = $products;
                    }

                }
            }
        }
        return $list_team;
    }

    public function get_personal_products_by_leader($user_id){
        $list_team = $this->team_model->get_current_leader($user_id);
        if ( !empty($list_team) ) {
            foreach($list_team as $key => $value){
                $product_ids = explode(',', $value['product_id']);
                if ( is_array($product_ids) && !empty($product_ids) ) {
                    foreach($product_ids as $k => $val){
                        if(empty($val)){
                            unset($product_ids[$k]);
                        }
                    }
                    if($product_ids){
                        $products = array();
                        foreach ($product_ids as $k => $val) {
                            $product_by_id = $this->information_model->fetch_by_id('product', $val);
                            $products[$k] = $product_by_id;
                        }
                        
                        // $products = $this->information_model->get_personal_products($product_ids);
                        if ($products) {
                            foreach ($products as $it => $item) {
                                $check_product_is_rating = $this->new_rating_model->check_rating_exist_by_product_id('new_rating', $item['id'], $user_id);
                                if ( $check_product_is_rating ) {
                                    $products[$it]['is_rating'] = 1;
                                }else{
                                    $products[$it]['is_rating'] = 0;
                                }
                            }
                        }
                        $list_team[$key]['product_list'] = $products;
                    }

                }
            }
        }
        return $list_team;
    }

    public function get_personal_members_by_leader($user_id){
        $list_team = $this->team_model->get_current_leader($user_id);
        if ( !empty($list_team) ) {
            foreach($list_team as $key => $value){
                $member_ids = explode(',', $value['member_id']);
                if ( is_array($member_ids) && !empty($member_ids) ) {
                    foreach($member_ids as $k => $val){
                        if(empty($val)){
                            unset($member_ids[$k]);
                        }
                    }
                    if($member_ids){
                        $members = $this->information_model->get_personal_members($member_ids);
                        $list_team[$key]['member_list'] = $members;
                    }

                }
            }
        }
        return $list_team;
    }
}