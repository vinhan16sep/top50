<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH."/third_party/PHPExcel.php";
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Company extends Admin_Controller{
    private $excel = null;

	function __construct(){
		parent::__construct();
		$this->load->model('information_model');
        $this->load->model('users_model');
        $this->load->model('status_model');

        $this->excel = new Spreadsheet();
        $this->data['groups'] = $this->config->item('development/config_information')['groups'];
	}

	public function index($year){
	    if(!isset($year) || empty($year)){
            redirect('admin/dashboard', 'refresh');
        }
        $this->load->helper('form');
        $this->load->library('form_validation');

//        $selected_year = $this->input->get('year');

		$this->load->model('users_model');
		$members = $this->users_model->fetch_all_member();
		$this->data['members'] = $members;
		$criteria = array(
            'year' => $year,
            'company_name' => $this->input->get('company_name'),
            'sort_name' => $this->input->get('sort_name'),
            'sort_order' => $this->input->get('sort_order'),
        );
        $this->data['criteria'] = $criteria;
        $total_rows  = $this->information_model->count_companys($criteria);
		$this->load->library('pagination');
		$config = array();
		$base_url = base_url('admin/company/index/' . $year);
		$per_page = $total_rows;
		$uri_segment = 5;

		foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) - 1 : 0;
        $result = $this->information_model->fetch_all_company_pagination($per_page, $per_page*$this->data['page'], $criteria);
        foreach ($result as $key => $value) {
            $member_id = json_decode($value['member_id']);
            if($member_id){
                foreach ($member_id as $k => $val) {
                    $member = $this->users_model->fetch_by_id($val);
                    $result[$key]['member_name'][$val] = $member['first_name'].''.$member['last_name'].' ('.$member['username'].')';
                }
            }
        }
        if($this->data['page'] == 0){
             $number = $total_rows;
         }elseif($total_rows < ($this->data['page'] + 1) * $per_page){
             $number = $total_rows - ($this->data['page'] * $per_page);
         }elseif($this->data['page'] > 0 && $total_rows > ($this->data['page'] + 1) * $per_page){
             $number = $total_rows - ($this->data['page'] * $per_page);
         };


        $this->data['year'] = $year;
        $this->data['number'] = $number;
        $this->data['companies'] = $result;
		$this->render('admin/company/list_company_view');
	}

	public function detail($id){
        $this->load->model('users_model');
        $company = $this->information_model->fetch_company_by_id($id);
        $member_id = json_decode($company['member_id']);
        $members = $this->users_model->fetch_all_member_with_where($member_id);
        $this->data['members'] = $members;
		$this->data['company'] = $company;
		$this->render('admin/company/detail_company_view');
	}

	public function basic($identity){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $extra = $this->information_model->fetch_extra_by_identity('information', $identity);
        $extra['basic_company'] = $this->users_model->fetchByIdentity($identity);
        $this->data['extra'] = $extra;
        $this->data['identity'] = $identity;
        $this->render('admin/company/basic_view');
    }

    public function info($identity, $year){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->data['year'] = $year;
        $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('company', $identity, $year);
        $this->data['groups'] = $this->config->item('development/config_information')['groups'];

        $extra = $this->information_model->fetch_extra_by_identity('information', $identity);
        $extra['basic_company'] = $this->users_model->fetchByIdentity($identity);
        $this->data['extra'] = $extra;

        $user = $this->users_model->fetchByIdentity($identity);
        $this->data['reg_status'] = $this->status_model->fetch_by_client_id($user['id']);

        $this->render('admin/company/info_view');
    }

    public function detail_by_client($client_id){
        $company = $this->information_model->fetch_company_by_client_id($client_id);
        $this->data['company'] = $company;
        $this->render('admin/company/detail_company_view');
    }

    public function change_member(){
    	$member_id = $this->input->get('member_id');
    	$client_id = $this->input->get('client_id');
        $company_id = $this->input->get('company_id');

        $member = $this->users_model->fetch_by_id($member_id);
        $array_company_id = array();
        $array_company_id = json_decode($member['company_id']);
        unset($array_company_id[array_search($company_id, $array_company_id)]);
        $new_company_id = [];
        foreach ($array_company_id as $key => $value) {
            $new_company_id[] = $value;
        }
        $new_company_id_json = json_encode($new_company_id);
        $user_data = array('company_id' => $new_company_id_json);

        $client = $this->information_model->fetch_by_user_id('company', $client_id);
        $upload = array();
        $upload = json_decode($client['member_id']);
        $key = array_search($member_id, $upload);
        unset($upload[$key]);
        $newUpload = [];
        foreach ($upload as $key => $value) {
            $newUpload[] = $value;
        }
        $member_id_json = json_encode($newUpload);
    	$where = array('member_id' => $member_id_json);
        $success = false;
        if($this->information_model->update('company', $client_id, $where) == true && $this->users_model->update_company($member_id, $user_data)){
            $success = true;
        }
    	$this->output->set_status_header(200)->set_output(json_encode(array('isExitsts' => $success)));
    }

    public function add_member()
    {
        $member_id = $this->input->get('member_id');
        $client_id = $this->input->get('client_id');
        $company_id = $this->input->get('company_id');

        $member = $this->users_model->fetch_by_id($member_id);
        $array_company_id = array();
        $array_company_id = json_decode($member['company_id']);
        if(isset($array_company_id)){
            array_push($array_company_id, $company_id);
        }else{
            $array_company_id[] = $company_id;
        }
        $array_company_id = json_encode($array_company_id);
        $user_data = array('company_id' => $array_company_id);

        $client = $this->information_model->fetch_by_user_id('company', $client_id);
        $upload = array();
        $upload = json_decode($client['member_id']);
        if(!empty($upload)){
            array_push($upload, $member_id);
        }else{
            $upload[] = $member_id;
        }

        $upload = json_encode($upload);
        $where = array('member_id' => $upload);
        $success = false;
        if($this->information_model->update('company', $client_id, $where) == true && $this->users_model->update_company($member_id, $user_data)){
            $success = true;
        }
        $this->output->set_status_header(200)->set_output(json_encode(array('isExitsts' => $success)));
    }

    public function export(){
        ob_start();
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Danh sach doanh nghiep');

        // load database
        $this->load->database();

        // get all users in array formate
        $data = $this->information_model->get_all_for_export('company');
        
        $data_export = array(
            '0' => array(
                'company' => 'Doanh nghiệp',
                'certificate_date' => 'Ngày thành lập',
                'phone' => 'Điện thoại',
                'address' => 'Địa chỉ',
                'website' => 'Website',
                'legal_representative' => 'Tên người đại diện pháp luật',
                'lp_position' => 'Chức danh',
                'lp_email' => 'Email',
                'lp_phone' => 'Di động',
                'connector' => 'Tên người liên hệ với BTC',
                'c_position' => 'Chức danh',
                'c_email' => 'Email',
                'c_phone' => 'Di động',
                'link' => 'Link download PĐK của DN'
            )
        );

        foreach($data as $key => $company){
            $extra_info = $this->information_model->fetch_company_by_id($company['id']);
            $data_export[$key + 1] = array(
                'company' => $extra_info['company'],
                'certificate_date' => $extra_info['certificate_date'],
                'phone' => $extra_info['phone'],
                'address' => $extra_info['headquarters'],
                'website' => $extra_info['website'],
                'legal_representative' => $extra_info['legal_representative'],
                'lp_position' => $extra_info['lp_position'],
                'lp_email' => $extra_info['lp_email'],
                'lp_phone' => $extra_info['lp_phone'],
                'connector' => $extra_info['connector'],
                'c_position' => $extra_info['c_position'],
                'c_email' => $extra_info['c_email'],
                'c_phone' => $extra_info['c_phone'],
                'link' => $extra_info['link']
            );
        }
        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($data_export, NULL, 'A1');

        $filename='Thong_tin_co_ban_doanh_nghiep_' . date("d-m-Y") . '.xlsx'; //save our workbook as this file name
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer = IOFactory::createWriter($this->excel, 'Xlsx');
        $writer->save('php://output');
    }

    public function export_company(){
        ob_start();
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Danh sach doanh nghiep');

        // load database
        $this->load->database();

        // get all users in array formate
        $data = $this->information_model->get_all_for_export('company');
        
        $wizard = new \PhpOffice\PhpSpreadsheet\Helper\Html();
        $data_export = array(
            '0' => array(
                'company' => 'Doanh nghiệp',
                'equity_2018_1' => 'Vốn điều lệ ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VND)',
                'equity_2018_2' => 'Vốn điều lệ ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VND)',
                'equity_2019_1' => 'Vốn điều lệ ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VND)',
                'equity_2019_2' => 'Vốn điều lệ ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VND)',
                'total_assets_2018_1' => 'Tổng tài sản ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VNĐ)',
                'total_assets_2018_2' => 'Tổng tài sản ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VNĐ)',
                'total_assets_2019_1' => 'Tổng tài sản ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VNĐ)',
                'total_assets_2019_2' => 'Tổng tài sản ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VNĐ)',
                'per_capita_income_2018_1' => 'Bình quân doanh thu/đầu người ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VNĐ)',
                'per_capita_income_2018_2' => 'Bình quân doanh thu/đầu người ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VNĐ)',
                'per_capita_income_2019_1' => 'Bình quân doanh thu/đầu người ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VNĐ)',
                'per_capita_income_2019_2' => 'Bình quân doanh thu/đầu người ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VNĐ)',
                'total_income_2018_1' => 'Tổng doanh thu doanh nghiệp ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VNĐ)',
                'total_income_2018_2' => 'Tổng doanh thu doanh nghiệp ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VNĐ)',
                'total_income_2019_1' => 'Tổng doanh thu doanh nghiệp ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VNĐ)',
                'total_income_2019_2' => 'Tổng doanh thu doanh nghiệp ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VNĐ)',
                'software_income_2018_1' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VNĐ)',
                'software_income_2018_2' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VNĐ)',
                'software_income_2019_1' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VNĐ)',
                'software_income_2019_2' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VNĐ)',
                'it_income_2018_1' => 'Tổng doanh thu dịch vụ CNTT ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VNĐ)',
                'it_income_2018_2' => 'Tổng doanh thu dịch vụ CNTT ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VNĐ)',
                'it_income_2019_1' => 'Tổng doanh thu dịch vụ CNTT ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VNĐ)',
                'it_income_2019_2' => 'Tổng doanh thu dịch vụ CNTT ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VNĐ)',
                'export_income_2018_1' => 'Tổng doanh thu xuất khẩu ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (USD)',
                'export_income_2018_2' => 'Tổng doanh thu xuất khẩu ' . ($this->data['eventYear'] - 2) . ' so với năm trước (USD)',
                'export_income_2019_1' => 'Tổng doanh thu xuất khẩu ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (USD)',
                'export_income_2019_2' => 'Tổng doanh thu xuất khẩu ' . ($this->data['eventYear'] - 1) . ' so với năm trước (USD)',
                'owner_equity_2018_1' => 'Tổng doanh thu lĩnh vực đề cử 1 ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối',
                'owner_equity_2018_2' => 'Tổng doanh thu lĩnh vực đề cử 1 ' . ($this->data['eventYear'] - 2) . ' so với năm trước',
                'owner_equity_2019_1' => 'Tổng doanh thu lĩnh vực đề cử 1 ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối',
                'owner_equity_2019_2' => 'Tổng doanh thu lĩnh vực đề cử 1 ' . ($this->data['eventYear'] - 1) . ' so với năm trước',
                'international_income_2018_1' => 'Tổng doanh thu lĩnh vực đề cử 2 ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối',
                'international_income_2018_2' => 'Tổng doanh thu lĩnh vực đề cử 2 ' . ($this->data['eventYear'] - 2) . ' so với năm trước',
                'international_income_2019_1' => 'Tổng doanh thu lĩnh vực đề cử 2 ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối',
                'international_income_2019_2' => 'Tổng doanh thu lĩnh vực đề cử 2 ' . ($this->data['eventYear'] - 1) . ' so với năm trước',
                'nomination_income_2018_1' => 'Tổng doanh thu lĩnh vực đề cử 3 ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối',
                'nomination_income_2018_2' => 'Tổng doanh thu lĩnh vực đề cử 3 ' . ($this->data['eventYear'] - 2) . ' so với năm trước',
                'nomination_income_2019_1' => 'Tổng doanh thu lĩnh vực đề cử 3 ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối',
                'nomination_income_2019_2' => 'Tổng doanh thu lĩnh vực đề cử 3 ' . ($this->data['eventYear'] - 1) . ' so với năm trước',
                'domestic_income_2018_1' => 'Tổng số lao động của doanh nghiệp ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối',
                'domestic_income_2018_2' => 'Tổng số lao động của doanh nghiệp ' . ($this->data['eventYear'] - 2) . ' so với năm trước',
                'domestic_income_2019_1' => 'Tổng số lao động của doanh nghiệp ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối',
                'domestic_income_2019_2' => 'Tổng số lao động của doanh nghiệp ' . ($this->data['eventYear'] - 1) . ' so với năm trước',
                'before_tax_profit_2018_1' => 'Tổng số lập trình viên ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối',
                'before_tax_profit_2018_2' => 'Tổng số lập trình viên ' . ($this->data['eventYear'] - 2) . ' so với năm trước',
                'before_tax_profit_2019_1' => 'Tổng số lập trình viên ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối',
                'before_tax_profit_2019_2' => 'Tổng số lập trình viên ' . ($this->data['eventYear'] - 1) . ' so với năm trước',
                'number_personnel_nominated_1' => 'Số lượng nhân sự trong lĩnh vực đề cử 1',
                'number_personnel_nominated_2' => 'Số lượng nhân sự trong lĩnh vực đề cử 2',
                'number_personnel_nominated_3' => 'Số lượng nhân sự trong lĩnh vực đề cử 3',
                'description' => 'Giới thiệu chung',
                'main_service' => 'Lĩnh vực ứng cử',
                'main_market' => 'Thị trường chính'
            )
        );

        foreach($data as $key => $company){
            $extra_info = $this->information_model->fetch_company_by_id($company['id']);
            $group = (array)json_decode($company['group']);
            $groups = '';
            if(!empty($group)){
                foreach($group as $value){
                    $groups .= (!empty($this->data['groups'][$value]) ? $this->data['groups'][$value] : '').',';
                }
            }
            $data_export[$key + 1] = array(
                'company' => $extra_info['company'],
                'equity_2018_1' => $company['equity_1'],
                'equity_2018_2' => $company['equity_percent_1'],
                'equity_2019_1' => $company['equity_2'],
                'equity_2019_2' => $company['equity_percent_2'],
                'total_assets_2018_1' => $company['total_assets_1'],
                'total_assets_2018_2' => $company['total_assets_percent_1'],
                'total_assets_2019_1' => $company['total_assets_2'],
                'total_assets_2019_2' => $company['total_assets_percent_2'],
                'per_capita_income_2018_1' => $company['per_capita_income_1'],
                'per_capita_income_2018_2' => $company['per_capita_income_percent_1'],
                'per_capita_income_2019_1' => $company['per_capita_income_2'],
                'per_capita_income_2019_2' => $company['per_capita_income_percent_2'],
                'total_income_2018_1' => $company['total_income_1'],
                'total_income_2018_2' => $company['total_income_percent_1'],
                'total_income_2019_1' => $company['total_income_2'],
                'total_income_2019_2' => $company['total_income_percent_2'],
                'software_income_2018_1' => $company['software_income_1'],
                'software_income_2018_2' => $company['software_income_percent_1'],
                'software_income_2019_1' => $company['software_income_2'],
                'software_income_2019_2' => $company['software_income_percent_2'],
                'it_income_2018_1' => $company['it_income_1'],
                'it_income_2018_2' => $company['it_income_percent_1'],
                'it_income_2019_1' => $company['it_income_2'],
                'it_income_2019_2' => $company['it_income_percent_2'],
                'export_income_2018_1' => $company['export_income_1'],
                'export_income_2018_2' => $company['export_income_percent_1'],
                'export_income_2019_1' => $company['export_income_2'],
                'export_income_2019_2' => $company['export_income_percent_2'],
                'owner_equity_2018_1' => $company['owner_equity_1'],
                'owner_equity_2018_2' => $company['owner_equity_percent_1'],
                'owner_equity_2019_1' => $company['owner_equity_2'],
                'owner_equity_2019_2' => $company['owner_equity_percent_2'],
                'international_income_2018_1' => $company['international_income_1'],
                'international_income_2018_2' => $company['international_income_percent_1'],
                'international_income_2019_1' => $company['international_income_2'],
                'international_income_2019_2' => $company['international_income_percent_2'],
                'nomination_income_2018_1' => $company['nomination_income_1'],
                'nomination_income_2018_2' => $company['nomination_income_percent_1'],
                'nomination_income_2019_1' => $company['nomination_income_2'],
                'nomination_income_2019_2' => $company['nomination_income_percent_2'],
                'domestic_income_2018_1' => $company['domestic_income_1'],
                'domestic_income_2018_2' => $company['domestic_income_percent_1'],
                'domestic_income_2019_1' => $company['domestic_income_2'],
                'domestic_income_2019_2' => $company['domestic_income_percent_2'],
                'before_tax_profit_2018_1' => $company['before_tax_profit_1'],
                'before_tax_profit_2018_2' => $company['before_tax_profit_percent_1'],
                'before_tax_profit_2019_1' => $company['before_tax_profit_2'],
                'before_tax_profit_2019_2' => $company['before_tax_profit_percent_2'],
                'number_personnel_nominated_1' => $company['number_personnel_nominated_1'],
                'number_personnel_nominated_2' => $company['number_personnel_nominated_2'],
                'number_personnel_nominated_3' => $company['number_personnel_nominated_3'],
                'description' => $wizard->toRichTextObject($company['overview']),
                'main_service' => trim($groups,','),
                'main_market' => implode(", ", (array)json_decode($company['main_market']))
            );
        }
        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($data_export, NULL, 'A1');
        $this->excel->getActiveSheet()->getStyle('A1:BC1')->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->getStyle('A1:BC1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        
        
        $filename='Thong_tin_doanh_nghiep_' . date("d-m-Y") . '.xlsx'; //save our workbook as this file name
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer = IOFactory::createWriter($this->excel, 'Xlsx');
        $writer->save('php://output');
    }
    
    public function export_detail($identity, $year){
        $company = $this->information_model->fetch_company_by_identity_and_year('company', $identity, $year);
        
        ob_start();
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Danh sach doanh nghiep');

        // load database
        $this->load->database();

        // get all users in array formate
        $data = $this->information_model->get_all_for_export('company');
        
        $wizard = new \PhpOffice\PhpSpreadsheet\Helper\Html();
        $data_export = array(
            '0' => array(
                'company' => 'Doanh nghiệp',
                'phone' => 'Điện thoại',
                'address' => 'Địa chỉ',
                'website' => 'Website',
                'legal_representative' => 'Tên người đại diện pháp luật',
                'lp_position' => 'Chức danh',
                'lp_email' => 'Email',
                'lp_phone' => 'Di động',
                'connector' => 'Tên người liên hệ với BTC',
                'c_position' => 'Chức danh',
                'c_email' => 'Email',
                'c_phone' => 'Di động',
                'link' => 'Link download PĐK của DN',
                'equity_2018_1' => 'Vốn điều lệ ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VND)',
                'equity_2018_2' => 'Vốn điều lệ ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VND)',
                'equity_2019_1' => 'Vốn điều lệ ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VND)',
                'equity_2019_2' => 'Vốn điều lệ ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VND)',
                'total_assets_2018_1' => 'Tổng tài sản ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VNĐ)',
                'total_assets_2018_2' => 'Tổng tài sản ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VNĐ)',
                'total_assets_2019_1' => 'Tổng tài sản ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VNĐ)',
                'total_assets_2019_2' => 'Tổng tài sản ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VNĐ)',
                'per_capita_income_2018_1' => 'Bình quân doanh thu/đầu người ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VNĐ)',
                'per_capita_income_2018_2' => 'Bình quân doanh thu/đầu người ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VNĐ)',
                'per_capita_income_2019_1' => 'Bình quân doanh thu/đầu người ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VNĐ)',
                'per_capita_income_2019_2' => 'Bình quân doanh thu/đầu người ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VNĐ)',
                'total_income_2018_1' => 'Tổng doanh thu doanh nghiệp ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VNĐ)',
                'total_income_2018_2' => 'Tổng doanh thu doanh nghiệp ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VNĐ)',
                'total_income_2019_1' => 'Tổng doanh thu doanh nghiệp ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VNĐ)',
                'total_income_2019_2' => 'Tổng doanh thu doanh nghiệp ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VNĐ)',
                'software_income_2018_1' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VNĐ)',
                'software_income_2018_2' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VNĐ)',
                'software_income_2019_1' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VNĐ)',
                'software_income_2019_2' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VNĐ)',
                'it_income_2018_1' => 'Tổng doanh thu dịch vụ CNTT ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (triệu VNĐ)',
                'it_income_2018_2' => 'Tổng doanh thu dịch vụ CNTT ' . ($this->data['eventYear'] - 2) . ' so với năm trước (triệu VNĐ)',
                'it_income_2019_1' => 'Tổng doanh thu dịch vụ CNTT ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (triệu VNĐ)',
                'it_income_2019_2' => 'Tổng doanh thu dịch vụ CNTT ' . ($this->data['eventYear'] - 1) . ' so với năm trước (triệu VNĐ)',
                'export_income_2018_1' => 'Tổng doanh thu xuất khẩu ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối (USD)',
                'export_income_2018_2' => 'Tổng doanh thu xuất khẩu ' . ($this->data['eventYear'] - 2) . ' so với năm trước (USD)',
                'export_income_2019_1' => 'Tổng doanh thu xuất khẩu ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối (USD)',
                'export_income_2019_2' => 'Tổng doanh thu xuất khẩu ' . ($this->data['eventYear'] - 1) . ' so với năm trước (USD)',
                'owner_equity_2018_1' => 'Tổng doanh thu lĩnh vực đề cử 1 ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối',
                'owner_equity_2018_2' => 'Tổng doanh thu lĩnh vực đề cử 1 ' . ($this->data['eventYear'] - 2) . ' so với năm trước',
                'owner_equity_2019_1' => 'Tổng doanh thu lĩnh vực đề cử 1 ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối',
                'owner_equity_2019_2' => 'Tổng doanh thu lĩnh vực đề cử 1 ' . ($this->data['eventYear'] - 1) . ' so với năm trước',
                'international_income_2018_1' => 'Tổng doanh thu lĩnh vực đề cử 2 ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối',
                'international_income_2018_2' => 'Tổng doanh thu lĩnh vực đề cử 2 ' . ($this->data['eventYear'] - 2) . ' so với năm trước',
                'international_income_2019_1' => 'Tổng doanh thu lĩnh vực đề cử 2 ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối',
                'international_income_2019_2' => 'Tổng doanh thu lĩnh vực đề cử 2 ' . ($this->data['eventYear'] - 1) . ' so với năm trước',
                'nomination_income_2018_1' => 'Tổng doanh thu lĩnh vực đề cử 3 ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối',
                'nomination_income_2018_2' => 'Tổng doanh thu lĩnh vực đề cử 3 ' . ($this->data['eventYear'] - 2) . ' so với năm trước',
                'nomination_income_2019_1' => 'Tổng doanh thu lĩnh vực đề cử 3 ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối',
                'nomination_income_2019_2' => 'Tổng doanh thu lĩnh vực đề cử 3 ' . ($this->data['eventYear'] - 1) . ' so với năm trước',
                'domestic_income_2018_1' => 'Tổng số lao động của doanh nghiệp ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối',
                'domestic_income_2018_2' => 'Tổng số lao động của doanh nghiệp ' . ($this->data['eventYear'] - 2) . ' so với năm trước',
                'domestic_income_2019_1' => 'Tổng số lao động của doanh nghiệp ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối',
                'domestic_income_2019_2' => 'Tổng số lao động của doanh nghiệp ' . ($this->data['eventYear'] - 1) . ' so với năm trước',
                'before_tax_profit_2018_1' => 'Tổng số lập trình viên ' . ($this->data['eventYear'] - 2) . ' số tuyệt đối',
                'before_tax_profit_2018_2' => 'Tổng số lập trình viên ' . ($this->data['eventYear'] - 2) . ' so với năm trước',
                'before_tax_profit_2019_1' => 'Tổng số lập trình viên ' . ($this->data['eventYear'] - 1) . ' số tuyệt đối',
                'before_tax_profit_2019_2' => 'Tổng số lập trình viên ' . ($this->data['eventYear'] - 1) . ' so với năm trước',
                'number_personnel_nominated_1' => 'Số lượng nhân sự trong lĩnh vực đề cử 1',
                'number_personnel_nominated_2' => 'Số lượng nhân sự trong lĩnh vực đề cử 2',
                'number_personnel_nominated_3' => 'Số lượng nhân sự trong lĩnh vực đề cử 3',
                'description' => 'Giới thiệu chung',
                'main_service' => 'Lĩnh vực ứng cử',
                'main_market' => 'Thị trường chính'
            )
        );
        
        $extra_info = $this->information_model->fetch_company_by_id($company['id']);
        $group = (array)json_decode($company['group']);
        $groups = '';
        if(!empty($group)){
            foreach($group as $value){
                $groups .= (!empty($this->data['groups'][$value]) ? $this->data['groups'][$value] : '').',';
            }
        }
        $data_export[1] = array(
            'company' => $extra_info['company'],
            'phone' => $extra_info['phone'],
            'address' => $extra_info['headquarters'],
            'website' => $extra_info['website'],
            'legal_representative' => $extra_info['legal_representative'],
            'lp_position' => $extra_info['lp_position'],
            'lp_email' => $extra_info['lp_email'],
            'lp_phone' => $extra_info['lp_phone'],
            'connector' => $extra_info['connector'],
            'c_position' => $extra_info['c_position'],
            'c_email' => $extra_info['c_email'],
            'c_phone' => $extra_info['c_phone'],
            'link' => $extra_info['link'],
            'equity_2018_1' => $company['equity_1'],
            'equity_2018_2' => $company['equity_percent_1'],
            'equity_2019_1' => $company['equity_2'],
            'equity_2019_2' => $company['equity_percent_2'],
            'total_assets_2018_1' => $company['total_assets_1'],
            'total_assets_2018_2' => $company['total_assets_percent_1'],
            'total_assets_2019_1' => $company['total_assets_2'],
            'total_assets_2019_2' => $company['total_assets_percent_2'],
            'per_capita_income_2018_1' => $company['per_capita_income_1'],
            'per_capita_income_2018_2' => $company['per_capita_income_percent_1'],
            'per_capita_income_2019_1' => $company['per_capita_income_2'],
            'per_capita_income_2019_2' => $company['per_capita_income_percent_2'],
            'total_income_2018_1' => $company['total_income_1'],
            'total_income_2018_2' => $company['total_income_percent_1'],
            'total_income_2019_1' => $company['total_income_2'],
            'total_income_2019_2' => $company['total_income_percent_2'],
            'software_income_2018_1' => $company['software_income_1'],
            'software_income_2018_2' => $company['software_income_percent_1'],
            'software_income_2019_1' => $company['software_income_2'],
            'software_income_2019_2' => $company['software_income_percent_2'],
            'it_income_2018_1' => $company['it_income_1'],
            'it_income_2018_2' => $company['it_income_percent_1'],
            'it_income_2019_1' => $company['it_income_2'],
            'it_income_2019_2' => $company['it_income_percent_2'],
            'export_income_2018_1' => $company['export_income_1'],
            'export_income_2018_2' => $company['export_income_percent_1'],
            'export_income_2019_1' => $company['export_income_2'],
            'export_income_2019_2' => $company['export_income_percent_2'],
            'owner_equity_2018_1' => $company['owner_equity_1'],
            'owner_equity_2018_2' => $company['owner_equity_percent_1'],
            'owner_equity_2019_1' => $company['owner_equity_2'],
            'owner_equity_2019_2' => $company['owner_equity_percent_2'],
            'international_income_2018_1' => $company['international_income_1'],
            'international_income_2018_2' => $company['international_income_percent_1'],
            'international_income_2019_1' => $company['international_income_2'],
            'international_income_2019_2' => $company['international_income_percent_2'],
            'nomination_income_2018_1' => $company['nomination_income_1'],
            'nomination_income_2018_2' => $company['nomination_income_percent_1'],
            'nomination_income_2019_1' => $company['nomination_income_2'],
            'nomination_income_2019_2' => $company['nomination_income_percent_2'],
            'domestic_income_2018_1' => $company['domestic_income_1'],
            'domestic_income_2018_2' => $company['domestic_income_percent_1'],
            'domestic_income_2019_1' => $company['domestic_income_2'],
            'domestic_income_2019_2' => $company['domestic_income_percent_2'],
            'before_tax_profit_2018_1' => $company['before_tax_profit_1'],
            'before_tax_profit_2018_2' => $company['before_tax_profit_percent_1'],
            'before_tax_profit_2019_1' => $company['before_tax_profit_2'],
            'before_tax_profit_2019_2' => $company['before_tax_profit_percent_2'],
            'number_personnel_nominated_1' => $company['number_personnel_nominated_1'],
            'number_personnel_nominated_2' => $company['number_personnel_nominated_2'],
            'number_personnel_nominated_3' => $company['number_personnel_nominated_3'],
            'description' => $wizard->toRichTextObject($company['overview']),
            'main_service' => trim($groups,','),
            'main_market' => implode(", ", (array)json_decode($company['main_market']))
        );
        
        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($data_export, NULL, 'A1');
        $this->excel->getActiveSheet()->getStyle('A1:BO1')->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->getStyle('A1:BO1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        
        
        $filename= $extra_info['company'] . '_' . date("d-m-Y") . '.xlsx'; //save our workbook as this file name
        
        header('Content-Type: appl . ication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer = IOFactory::createWriter($this->excel, 'Xlsx');
        $writer->save('php://output');
    }
    
    
    public function export_company_detail($id){
        //activate worksheet number 1


        // $sheet_basic = $this->excel->createSheet(0);
        // $sheet_basic->setTitle('Thong Tin Co Ban');
        $sheet = $this->excel->createSheet(1);
        $sheet->setTitle('Thong Tin Doanh Nghiep');

        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Thong Tin Co Ban');

        // load database
        $this->load->database();

        // get all users in array formate
        $select_basic = 'website, legal_representative, lp_position, lp_email, lp_phone, connector, c_position, c_email, c_phone';
        $data_basic = $this->information_model->get_detail_information_with_select_by_id($id);

        $data = $this->information_model->fetch_company_by_id($id);

        // Get user info
        $target_user = $this->users_model->fetch_by_id($data['client_id']);

        $data_basic_export = array(
            '0' => array(
                'website' => 'Website',
                'legal_representative' => 'Tên người đại diện pháp luật',
                'lp_position' => 'Chức danh người đại diện pháp luật',
                'lp_email' => 'Email người đại diện pháp luật',
                'lp_phone' => 'Di động người đại diện pháp luật',
                'connector' => 'Tên người liên hệ với BTC',
                'c_position' => 'Chức danh người liên hệ với BTC',
                'c_email' => 'Email người liên hệ với BTC',
                'c_phone' => 'Di động người liên hệ với BTC',
            )
        );

        $data_basic_export[] = array(
            'website' => $data_basic['website'],
            'legal_representative' => $data_basic['legal_representative'],
            'lp_position' => $data_basic['lp_position'],
            'lp_email' => $data_basic['lp_email'],
            'lp_phone' => $data_basic['lp_phone'],
            'connector' => $data_basic['connector'],
            'c_position' => $data_basic['c_position'],
            'c_email' => $data_basic['c_email'],
            'c_phone' => $data_basic['c_phone']
        );
        $this->excel->getActiveSheet()->fromArray($data_basic_export);

        $data_export = array(
            '0' => array(
                'equity_1' => 'Vốn điều lệ năm '. $this->data['rule3Year'][0] .' (triệu VND)',
                'equity_2' => 'Vốn điều lệ năm '. $this->data['rule3Year'][1] .' (triệu VND)',
                'equity_3' => 'Vốn điều lệ năm '. $this->data['rule3Year'][2] .' (triệu VND)',
                'owner_equity_1' => 'Vốn chủ sở hữu '. $this->data['rule3Year'][0] .' (triệu VND)',
                'owner_equity_2' => 'Vốn chủ sở hữu '. $this->data['rule3Year'][1] .' (triệu VND)',
                'owner_equity_3' => 'Vốn chủ sở hữu '. $this->data['rule3Year'][2] .' (triệu VND)',
                'total_income_1' => 'Tổng doanh thu DN '. $this->data['rule3Year'][0],
                'total_income_2' => 'Tổng doanh thu DN '. $this->data['rule3Year'][1],
                'total_income_3' => 'Tổng doanh thu DN '. $this->data['rule3Year'][2],
                'software_income_1' => 'Tổng DT lĩnh vực sx phần mềm '. $this->data['rule3Year'][0] .' (Triệu VND)',
                'software_income_2' => 'Tổng DT lĩnh vực sx phần mềm '. $this->data['rule3Year'][1] .' (Triệu VND)',
                'software_income_3' => 'Tổng DT lĩnh vực sx phần mềm '. $this->data['rule3Year'][2] .' (Triệu VND)',
                'it_income_1' => 'Tổng doanh thu dịch vụ CNTT '. $this->data['rule3Year'][0] .' (triệu VND)',
                'it_income_2' => 'Tổng doanh thu dịch vụ CNTT '. $this->data['rule3Year'][1] .' (triệu VND)',
                'it_income_3' => 'Tổng doanh thu dịch vụ CNTT '. $this->data['rule3Year'][2] .' (triệu VND)',
                'export_income_1' => 'Tổng DT xuất khẩu (USD) '. $this->data['rule3Year'][0],
                'export_income_2' => 'Tổng DT xuất khẩu (USD) '. $this->data['rule3Year'][1],
                'export_income_3' => 'Tổng DT xuất khẩu (USD) '. $this->data['rule3Year'][2],
                'total_labor_1' => 'Tổng số lao động của DN '. $this->data['rule3Year'][0],
                'total_labor_2' => 'Tổng số lao động của DN '. $this->data['rule3Year'][1],
                'total_labor_3' => 'Tổng số lao động của DN '. $this->data['rule3Year'][2],
                'total_ltv_1' => 'Tổng số LTV '. $this->data['rule3Year'][0],
                'total_ltv_2' => 'Tổng số LTV '. $this->data['rule3Year'][1],
                'total_ltv_3' => 'Tổng số LTV '. $this->data['rule3Year'][2],
                'main_service' => 'SP dịch vụ chính của DN',
                'main_market' => 'Thị trường chính',
            )
        );
        $str_main_service = '';
        if (( !empty($data['main_service']) && $data['main_service'] != 'null' && $data['main_service'] != null )) {
            $main_service = json_decode($data['main_service']);
            foreach ($main_service as $key => $value) {
                $str_main_service .= $value . ' ,';
            }
        }

        $str_main_market = '';
        if (( !empty($data['main_market']) && $data['main_market'] != 'null' && $data['main_market'] != null )) {
            $main_market = json_decode($data['main_market']);
            foreach ($main_market as $key => $value) {
                $str_main_market .= $value . ' ,';
            }
        }


        $data_export[] = array(
            'equity_1' => $data['equity_1'],
            'equity_2' => $data['equity_2'],
            'equity_3' => $data['equity_3'],
            'owner_equity_1' => $data['owner_equity_1'],
            'owner_equity_2' => $data['owner_equity_2'],
            'owner_equity_3' => $data['owner_equity_3'],
            'total_income_1' => $data['total_income_1'],
            'total_income_2' => $data['total_income_2'],
            'total_income_3' => $data['total_income_3'],
            'software_income_1' => $data['software_income_1'],
            'software_income_2' => $data['software_income_2'],
            'software_income_3' => $data['software_income_3'],
            'it_income_1' => $data['it_income_1'],
            'it_income_2' => $data['it_income_2'],
            'it_income_3' => $data['it_income_3'],
            'export_income_1' => $data['export_income_1'],
            'export_income_2' => $data['export_income_2'],
            'export_income_3' => $data['export_income_3'],
            'total_labor_1' => $data['total_labor_1'],
            'total_labor_2' => $data['total_labor_2'],
            'total_labor_3' => $data['total_labor_3'],
            'total_ltv_1' => $data['total_ltv_1'],
            'total_ltv_2' => $data['total_ltv_2'],
            'total_ltv_3' => $data['total_ltv_3'],
            'main_service' => $str_main_service,
            'main_market' => $str_main_market,
        );
        $sheet->fromArray($data_export);

        // read data to active sheet

        $filename='Chi_tiet_doanh_nghiep_' . str_replace(' ', '-', $target_user['company']) . '_' . date("d-m-Y") . '.xls'; //save our workbook as this file name
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer = IOFactory::createWriter($this->excel, 'Xlsx');
        $writer->save('php://output');
        
        // header('Content-Type: application/vnd.ms-excel'); //mime type

        // header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

        // header('Cache-Control: max-age=0'); //no cache

        // //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        // //if you want to save it as .XLSX Excel 2007 format

        // $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        // //force user to download the Excel file without writing it to server's HD
        // $objWriter->save('php://output');
    }

    // BACKUP
    // $data_export = array(
    //     '0' => array(
    //         'company' => 'Doanh nghiệp',
    //         'phone' => 'Điện thoại',
    //         'address' => 'Địa chỉ',
    //         'website' => 'Website',
    //         'legal_representative' => 'Tên người đại diện pháp luật',
    //         'lp_position' => 'Chức danh',
    //         'lp_email' => 'Email',
    //         'lp_phone' => 'Di động',
    //         'connector' => 'Tên người liên hệ với BTC',
    //         'c_position' => 'Chức danh',
    //         'c_email' => 'Email',
    //         'c_phone' => 'Di động',
    //         'link' => 'Link download PĐK của DN',
    //         'equity_2018_1' => 'Vốn điều lệ năm 2018 số tuyệt đối (triệu VND)',
    //         'equity_2018_2' => 'Vốn điều lệ năm 2018 so với năm trước (triệu VND)',
    //         'equity_2019_1' => 'Vốn điều lệ năm 2019 số tuyệt đối (triệu VND)',
    //         'equity_2019_2' => 'Vốn điều lệ năm 2019 so với năm trước (triệu VND)',
    //         'total_assets_2018_1' => 'Tổng tài sản 2018 số tuyệt đối (triệu VNĐ)',
    //         'total_assets_2018_2' => 'Tổng tài sản 2018 so với năm trước (triệu VNĐ)',
    //         'total_assets_2019_1' => 'Tổng tài sản 2019 số tuyệt đối (triệu VNĐ)',
    //         'total_assets_2019_2' => 'Tổng tài sản 2019 so với năm trước (triệu VNĐ)',
    //         'per_capita_income_2018_1' => 'Bình quân doanh thu/đầu người 2018 số tuyệt đối (triệu VNĐ)',
    //         'per_capita_income_2018_2' => 'Bình quân doanh thu/đầu người 2018 so với năm trước (triệu VNĐ)',
    //         'per_capita_income_2019_1' => 'Bình quân doanh thu/đầu người 2019 số tuyệt đối (triệu VNĐ)',
    //         'per_capita_income_2019_2' => 'Bình quân doanh thu/đầu người 2019 so với năm trước (triệu VNĐ)',
    //         'total_income_2018_1' => 'Tổng doanh thu doanh nghiệp 2018 số tuyệt đối (triệu VNĐ)',
    //         'total_income_2018_2' => 'Tổng doanh thu doanh nghiệp 2018 so với năm trước (triệu VNĐ)',
    //         'total_income_2019_1' => 'Tổng doanh thu doanh nghiệp 2019 số tuyệt đối (triệu VNĐ)',
    //         'total_income_2019_2' => 'Tổng doanh thu doanh nghiệp 2019 so với năm trước (triệu VNĐ)',
    //         'software_income_2018_1' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp 2018 số tuyệt đối (triệu VNĐ)',
    //         'software_income_2018_2' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp 2018 so với năm trước (triệu VNĐ)',
    //         'software_income_2019_1' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp 2019 số tuyệt đối (triệu VNĐ)',
    //         'software_income_2019_2' => 'Tổng doanh thu lĩnh vực phần mềm, giải pháp 2019 so với năm trước (triệu VNĐ)',
    //         'it_income_2018_1' => 'Tổng doanh thu dịch vụ CNTT 2018 số tuyệt đối (triệu VNĐ)',
    //         'it_income_2018_2' => 'Tổng doanh thu dịch vụ CNTT 2018 so với năm trước (triệu VNĐ)',
    //         'it_income_2019_1' => 'Tổng doanh thu dịch vụ CNTT 2019 số tuyệt đối (triệu VNĐ)',
    //         'it_income_2019_2' => 'Tổng doanh thu dịch vụ CNTT 2019 so với năm trước (triệu VNĐ)',
    //         'export_income_2018_1' => 'Tổng doanh thu xuất khẩu 2018 số tuyệt đối (USD)',
    //         'export_income_2018_2' => 'Tổng doanh thu xuất khẩu 2018 so với năm trước (USD)',
    //         'export_income_2019_1' => 'Tổng doanh thu xuất khẩu 2019 số tuyệt đối (USD)',
    //         'export_income_2019_2' => 'Tổng doanh thu xuất khẩu 2019 so với năm trước (USD)',
    //         'owner_equity_2018_1' => 'Tổng doanh thu lĩnh vực đề cử 1 2018 số tuyệt đối',
    //         'owner_equity_2018_2' => 'Tổng doanh thu lĩnh vực đề cử 1 2018 so với năm trước',
    //         'owner_equity_2019_1' => 'Tổng doanh thu lĩnh vực đề cử 1 2019 số tuyệt đối',
    //         'owner_equity_2019_2' => 'Tổng doanh thu lĩnh vực đề cử 1 2019 so với năm trước',
    //         'international_income_2018_1' => 'Tổng doanh thu lĩnh vực đề cử 2 2018 số tuyệt đối',
    //         'international_income_2018_2' => 'Tổng doanh thu lĩnh vực đề cử 2 2018 so với năm trước',
    //         'international_income_2019_1' => 'Tổng doanh thu lĩnh vực đề cử 2 2019 số tuyệt đối',
    //         'international_income_2019_2' => 'Tổng doanh thu lĩnh vực đề cử 2 2019 so với năm trước',
    //         'nomination_income_2018_1' => 'Tổng doanh thu lĩnh vực đề cử 3 2018 số tuyệt đối',
    //         'nomination_income_2018_2' => 'Tổng doanh thu lĩnh vực đề cử 3 2018 so với năm trước',
    //         'nomination_income_2019_1' => 'Tổng doanh thu lĩnh vực đề cử 3 2019 số tuyệt đối',
    //         'nomination_income_2019_2' => 'Tổng doanh thu lĩnh vực đề cử 3 2019 so với năm trước',
    //         'domestic_income_2018_1' => 'Tổng số lao động của doanh nghiệp 2018 số tuyệt đối',
    //         'domestic_income_2018_2' => 'Tổng số lao động của doanh nghiệp 2018 so với năm trước',
    //         'domestic_income_2019_1' => 'Tổng số lao động của doanh nghiệp 2019 số tuyệt đối',
    //         'domestic_income_2019_2' => 'Tổng số lao động của doanh nghiệp 2019 so với năm trước',
    //         'before_tax_profit_2018_1' => 'Tổng số lập trình viên 2018 số tuyệt đối',
    //         'before_tax_profit_2018_2' => 'Tổng số lập trình viên 2018 so với năm trước',
    //         'before_tax_profit_2019_1' => 'Tổng số lập trình viên 2019 số tuyệt đối',
    //         'before_tax_profit_2019_2' => 'Tổng số lập trình viên 2019 so với năm trước',
    //         'number_personnel_nominated_1' => 'Số lượng nhân sự trong lĩnh vực đề cử 1',
    //         'number_personnel_nominated_2' => 'Số lượng nhân sự trong lĩnh vực đề cử 2',
    //         'number_personnel_nominated_3' => 'Số lượng nhân sự trong lĩnh vực đề cử 3',
    //         'description' => 'Giới thiệu chung',
    //         'main_service' => 'Lĩnh vực ứng cử',
    //         'main_market' => 'Thị trường chính'
    //     )
    // );
}
