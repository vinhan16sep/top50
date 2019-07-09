<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Email extends Admin_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->model('email_model');
	}

	public function index(){
		$keywords = '';
        if($this->input->get('search')){
            $keywords = $this->input->get('search');
        }
        $this->data['keywords'] = $keywords;
        $total_rows  = $this->email_model->count_search($keywords);
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url('admin/email/index');
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $this->data['page_links'] = $this->pagination->create_links();
        $result = $this->email_model->get_all_with_pagination_search($per_page, $this->data['page'], $keywords);
        $this->data['result'] = $result;

		$this->render('admin/email/index');
	}

	public function create(){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('description', 'Mô tả', 'required');
        $this->form_validation->set_rules('content', 'Nội dung', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('admin/email/create');
        } else {
            if ($this->input->post()) {
            	$data = array(
            		'title' => $this->input->post('title'),
            		'description' => $this->input->post('description'),
            		'content' => $this->input->post('content'),
            		'created_at' => date('Y-m-d H:i:s', now()),
		            'created_by' => $this->ion_auth->user()->row()->username,
		            'updated_at' => date('Y-m-d H:i:s', now()),
		            'updated_by' => $this->ion_auth->user()->row()->username
            	);
            	$insert = $this->email_model->insert($data);
            	if ($insert) {
            		$this->session->set_flashdata('success', 'Tạo mới E-Mail thành công!');
                    redirect('admin/email', 'refresh');
            	}else{
            		$this->session->set_flashdata('error', 'Có lỗi! Tạo E-Mail không thành công');
                    redirect('admin/email', 'refresh');
            	}
            }
        }
    }

    public function edit($id){

    	$detail = $this->email_model->find($id);
    	$this->data['detail'] = $detail;
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('description', 'Mô tả', 'required');
        $this->form_validation->set_rules('content', 'Nội dung', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('admin/email/edit');
        } else {
            if ($this->input->post()) {
            	$data = array(
            		'title' => $this->input->post('title'),
            		'description' => $this->input->post('description'),
            		'content' => $this->input->post('content'),
		            'updated_at' => date('Y-m-d H:i:s', now()),
		            'updated_by' => $this->ion_auth->user()->row()->username
            	);
            	$update = $this->email_model->update($id, $data);
            	if ($update) {
            		$this->session->set_flashdata('success', 'Cập nhật E-Mail thành công!');
                    redirect('admin/email', 'refresh');
            	}else{
            		$this->session->set_flashdata('error', 'Có lỗi! Cập nhật E-Mail không thành công');
                    redirect('admin/email', 'refresh');
            	}
            }
        }
    }

    public function remove(){
        $id = $this->input->get('id');
        $data = array('is_deleted' => 1);
        $update = $this->email_model->update($id, $data);
        if($update == 1){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('status' => 200, 'isExisted' => true)));
        }
            return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(array('status' => 404)));
    }

    public function remove_all(){
        $ids = $this->input->get('ids');
        $data = array('is_deleted' => 1);
        foreach ($ids as $id) {
            $update = $this->email_model->update($id, $data);
        }
        return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('status' => 200, 'isExisted' => true)));
    }

    public function send_email_all(){
    	# code...
    }
}