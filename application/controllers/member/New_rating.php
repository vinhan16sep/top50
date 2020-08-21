<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class New_rating extends Member_Controller{

    protected $options_1 = array(
        'Chính phủ điện tử' => 'Chính phủ điện tử',
        'Quản lý doanh nghiệp' => 'Quản lý doanh nghiệp',
        'Kế toán, tài chính, ngân hàng' => 'Kế toán, tài chính, ngân hàng',
        'Quản lý bán hàng, phân phối, bán lẻ và chuỗi cung ứng' => 'Quản lý bán hàng, phân phối, bán lẻ và chuỗi cung ứng',
        'Bất động sản' => 'Bất động sản',
        'Quảng cáo, tiếp thị và truyền thông số' => 'Quảng cáo, tiếp thị và truyền thông số',
        'Y tế, chăm sóc sức khỏe và làm đẹp' => 'Y tế, chăm sóc sức khỏe và làm đẹp',
        'Giáo dục, đào tạo' => 'Giáo dục, đào tạo',
        'Giao thông vận tải' => 'Giao thông vận tải',
        'Công nghiệp và sản xuất' => 'Công nghiệp và sản xuất',
        'Nông nghiệp và chế biến thực phẩm' => 'Nông nghiệp và chế biến thực phẩm',
        'Du lịch, quản lý nhà hàng/khách sạn' => 'Du lịch, quản lý nhà hàng/khách sạn',
        'Công tác nhân sự, văn phòng' => 'Công tác nhân sự, văn phòng',
        'Viễn thông' => 'Viễn thông',
        'Tài nguyên, Năng lượng và Tiện ích' => 'Tài nguyên, Năng lượng và Tiện ích',
        'Cơ khí và xây dựng' => 'Cơ khí và xây dựng',
        'Nền tảng và Công cụ ứng dụng' => 'Nền tảng và Công cụ ứng dụng',
        'Thanh toán điện tử' => 'Thanh toán điện tử ',
        'Thương mại điện tử' => 'Thương mại điện tử',
        'Truyền thông và Giải trí điện tử' => 'Truyền thông và Giải trí điện tử',
        'Bảo mật và an toàn thông tin' => 'Bảo mật và an toàn thông tin',
        'Bảo vệ môi trường và phát triển bền vững' => 'Bảo vệ môi trường và phát triển bền vững',
        'Nghiên cứu và phát triển' => 'Nghiên cứu và phát triển',
        'Các lĩnh vực khác' => 'Các lĩnh vực khác'
    );
    protected $options_4 = array(
        'Gia công xuất khẩu phần mềm' => 'Gia công xuất khẩu phần mềm',
        'BPO' => 'BPO',
        'Data Center' => 'Data Center',
        'Đào tạo CNTT' => 'Đào tạo CNTT',
        'Nội dung số' => 'Nội dung số',
        'Điện toán đám mây và Big Data' => 'Điện toán đám mây và Big Data',
        'An toàn thông tin' => 'An toàn thông tin',
        'Các lĩnh vực khác' => 'Các lĩnh vực khác'
    );

    function __construct(){
        parent::__construct();
        $this->load->helper('form');

        $this->load->model('information_model');
        $this->load->model('new_rating_model');
        $this->load->model('team_model');
    }

    public function index($product_id=''){
        $id = $this->input->get('id');
        $main_service = $this->input->get('main_service');
        if(empty($main_service)){
            $this->session->set_flashdata('main_service_message', 'Sản phẩm bạn vừa chọn chưa được đặt lĩnh vực chính');
            redirect('member/');
        }
        $detail = $this->information_model->fetch_by_id('product', $id);
        $company = $this->information_model->fetch_by_id('users', $detail['client_id']);
        $this->data['detail'] = $detail;
        $this->data['company'] = $company;
        $this->data['main_service'] = $main_service;
        
        $this->load->model('users_model');
        $user = $this->ion_auth->user()->row();
        if ($user->member_role == 'manager') {
            $this->data['rating'] = $this->new_rating_model->check_rating_exist('new_rating', $detail['id'], $this->input->get('member_id'));
        }else{
            $this->load->model('users_model');
            $user_id = $user->id;
            
            //check member
            if ($user->member_role == 'member') {
                $team = $this->team_model->get_by_user_id('team', $user_id);
            }

            //check leader
            if ($user->member_role == 'leader') {
                $team = $this->team_model->get_by_leader_id('team', $user_id);
            }
            $list_product = array();
            if ($team) {
                foreach ($team as $key => $value) {
                    $product_ids = explode(',', $value['product_id']);
                    foreach ($product_ids as $k => $val) {
                        if ( !empty($val) ) {
                            $list_product[] = $val;
                        }
                    }
                }
            }
            $list_product = array_unique($list_product);
            if (!in_array($id, $list_product)) {
                $this->session->set_flashdata('main_service_message', 'Sản phẩm không tồn tại hoặc không thuộc nhóm của bạn');
                redirect('member','refresh');
            }
            

            $this->data['rating'] = $this->new_rating_model->check_rating_exist_for_list('new_rating', $detail['id'], $this->ion_auth->user()->row()->id);
        }

        $this->render('member/rating_view_' . $main_service);
    }

    public function rating(){
        $request = $this->input->get();
        $member_id = $request['member_id'];
        $product_id = $request['product_id'];
        $total = $request['total'];
        $comment = $request['comment'];
        unset($request['comment']);
        unset($request['member_id']);
        unset($request['product_id']);
        unset($request['csrf_sitecom_token']);
        unset($request['total']);

        if ($this->ion_auth->user()->row()->member_role == 'manager') {
            $data = array(
                'rating' => json_encode($request),
                'comment' => $comment,
            );
            $update = $this->new_rating_model->update_by_member_id_and_product_id($member_id, $product_id, $data);
            if($update){
                return $this->output->set_status_header(200)
                    ->set_output(json_encode(array('name' => $product_id)));
            }
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Có lỗi khi lưu điểm')));
        }else{
            $data = array(
                'member_id' => $member_id,
                'product_id' => $product_id,
                'comment' => $comment,
                'rating' => json_encode($request),
                'total' => $total,
                'is_submit' => 1
            );
            $insert = $this->new_rating_model->insert('new_rating', $data);
            if($insert){
                return $this->output->set_status_header(200)
                    ->set_output(json_encode(array('name' => $insert)));
            }
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Có lỗi khi lưu điểm')));
        }
        
    }
    public function rating_temp(){
        $request = $this->input->get();
        $member_id = $request['member_id'];
        $product_id = $request['product_id'];
        $total = $request['total'];
        $comment = $request['comment'];
        unset($request['comment']);
        unset($request['member_id']);
        unset($request['product_id']);
        unset($request['csrf_sitecom_token']);
        unset($request['total']);

        if ($this->ion_auth->user()->row()->member_role == 'manager') {
            $data = array(
                'rating' => json_encode($request)
            );
            $update = $this->new_rating_model->update_by_member_id_and_product_id($member_id, $product_id, $data);
            if($update){
                return $this->output->set_status_header(200)
                    ->set_output(json_encode(array('name' => $product_id)));
            }
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Có lỗi khi lưu điểm')));
        }else{
            $check_rating_temp = $this->new_rating_model->fetch_by_product_id_and_member_id($product_id, $member_id);
            
            if ( $check_rating_temp ) {
                $data = array(
                    'rating' => json_encode($request),
                    'total' => $total,
                    'comment' => $comment,
                    'is_submit' => 0
                );
                $update = $this->new_rating_model->update_by_member_id_and_product_id($member_id, $product_id, $data);
                if($update){
                    return $this->output->set_status_header(200)
                        ->set_output(json_encode(array('name' => $update)));
                }
                return $this->output->set_status_header(200)
                    ->set_output(json_encode(array('message' => 'Có lỗi khi lưu điểm')));
            }else{
                $data = array(
                    'member_id' => $member_id,
                    'product_id' => $product_id,
                    'comment' => $comment,
                    'rating' => json_encode($request),
                    'total' => $total,
                    'is_submit' => 0
                );
                $insert = $this->new_rating_model->insert('new_rating', $data);
                if($insert){
                    return $this->output->set_status_header(200)
                        ->set_output(json_encode(array('name' => $insert)));
                }
                return $this->output->set_status_header(200)
                    ->set_output(json_encode(array('message' => 'Có lỗi khi lưu điểm')));
            }
            
        }
        
    }

    public function update_rating($id){
        $request = $this->input->get();
        $member_id = $request['member_id'];
        $product_id = $request['product_id'];
        $total = $request['total'];
        $comment = $request['comment'];
        unset($request['comment']);
        unset($request['member_id']);
        unset($request['product_id']);
        unset($request['csrf_sitecom_token']);
        unset($request['total']);

        if ($this->ion_auth->user()->row()->member_role == 'manager') {
            $data = array(
                'rating' => json_encode($request),
                'comment' => $comment,
            );
            $update = $this->new_rating_model->update_by_member_id_and_product_id($member_id, $product_id, $data);
            if($update){
                return $this->output->set_status_header(200)
                    ->set_output(json_encode(array('name' => $product_id)));
            }
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Có lỗi khi lưu điểm')));
        }else{
            $data = array(
                'member_id' => $member_id,
                'product_id' => $product_id,
                'comment' => $comment,
                'rating' => json_encode($request),
                'total' => $total,
                'is_submit' => 1
            );
            // Member and Leader update rating
            $update = $this->new_rating_model->update('new_rating', $id, $data);
            if($update){
                return $this->output->set_status_header(200)
                    ->set_output(json_encode(array('name' => $update)));
            }
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Có lỗi khi lưu điểm')));
        }

    }

    public function open_rating(){
        $request = $this->input->get();
        $product_id = $request['product'];
        $member_id = $request['member'];

        if ($this->ion_auth->user()->row()->member_role == 'manager' || $this->ion_auth->user()->row()->member_role == 'leader') {
            $data = array(
                'is_submit' => 0
            );
            $update = $this->new_rating_model->update_by_member_id_and_product_id($member_id, $product_id, $data);
            if($update){
                return $this->output->set_status_header(200)
                    ->set_output(json_encode(array('name' => $product_id)));
            }
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Có lỗi khi lưu điểm')));
        }
    }

    public function rating_by_member(){
        if ($this->ion_auth->user()->row()->member_role != 'leader') {
            redirect('member/','refresh');
        }
        $request = $this->input->get();
        $member_id = $request['member_id'];
        $product_id = $request['product_id'];
        $main_service = $request['main_service'];
        if(empty($main_service)){
            $this->session->set_flashdata('main_service_message', 'Sản phẩm bạn vừa chọn chưa được đặt lĩnh vực chính');
            redirect('member/');
        }
        $detail = $this->information_model->fetch_by_id('product', $product_id);
        $company = $this->information_model->fetch_by_id('users', $detail['client_id']);
        $this->data['detail'] = $detail;
        $this->data['company'] = $company;
        $this->data['main_service'] = $main_service;
        $this->data['rating'] = $this->new_rating_model->check_rating_exist('new_rating', $product_id, $member_id);
        $this->render('member/rating_by_member_view_' . $main_service);
    }

    public function reset_rating($member_id, $product_id, $main_service){
        if ($this->ion_auth->user()->row()->username != 'chutich') {
            redirect('member/');
        }
        $detail = $this->information_model->fetch_by_id('product', $product_id);
        $company = $this->information_model->fetch_by_id('users', $detail['client_id']);
        $rating = $this->new_rating_model->fetch_by_product_id_and_member_id($product_id, $member_id);
        
        $this->data['detail'] = $detail;
        $this->data['company'] = $company;
        $this->data['rating'] = $rating;
        $this->data['main_service'] = $main_service;
        $this->render('member/reset/view_' . $main_service);
    }

    public function update_reset_rating($id){
        if ($this->ion_auth->user()->row()->username != 'chutich') {
            redirect('member/');
        }
        $request = $this->input->get();
        $member_id = $request['member_id'];
        $product_id = $request['product_id'];
        $total = $request['total'];
        unset($request['member_id']);
        unset($request['product_id']);
        unset($request['csrf_sitecom_token']);
        unset($request['total']);
        
        $data = array(
            'rating' => json_encode($request),
            'total' => $total
        );
        $update = $this->new_rating_model->update_by_member_id_and_product_id_for_reset($member_id, $product_id, $data);
        if($update){
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('name' => $product_id)));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 'Có lỗi khi lưu điểm')));
    }
}