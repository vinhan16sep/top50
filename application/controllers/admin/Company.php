<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Company extends Admin_Controller{

    private $excel = null;
	
	function __construct(){
		parent::__construct();
		$this->load->model('information_model');
        $this->load->model('users_model');

        $this->excel = new PHPExcel();
	}

	public function index(){
        $this->load->helper('form');
        $this->load->library('form_validation');

		$this->load->model('users_model');
		$members = $this->users_model->fetch_all_member();
		$this->data['members'] = $members;
		$keywords = '';
        if($this->input->get('search')){
            $keywords = $this->input->get('search');
        }
        $this->data['keywords'] = $keywords;
        $total_rows  = $this->information_model->count_companys();
        if($keywords != ''){
            $total_rows  = $this->information_model->count_company_search($keywords);
        }
		$this->load->library('pagination');
		$config = array();
		$base_url = base_url('admin/company/index');
		$per_page = 50;
		$uri_segment = 4;
        // echo $total_rows;die;

		foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;
        $result = $this->information_model->fetch_all_company_pagination($per_page, $per_page*$this->data['page']);
        if($keywords != ''){
            $result = $this->information_model->fetch_all_company_pagination_search($per_page, $per_page*$this->data['page'], $keywords);
        }
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
                'equity_2015' => 'Vốn điều lệ năm 2015 (triệu VND)',
                'equity_2016' => 'Vốn điều lệ năm 2016 (triệu VND)',
                'equity_2017' => 'Vốn điều lệ năm 2017 (triệu VND)',
                'owner_equity_2015' => 'Vốn chủ sở hữu (triệu VND) 2015',
                'owner_equity_2016' => 'Vốn chủ sở hữu (triệu VND) 2016',
                'owner_equity_2017' => 'Vốn chủ sở hữu (triệu VND) 2017',
                'total_income_2015' => 'Tổng doanh thu DN 2015',
                'total_income_2016' => 'Tổng doanh thu DN 2016',
                'total_income_2017' => 'Tổng doanh thu DN 2017',
                'software_income_2015' => 'Tổng DT lĩnh vực sx phần mềm (Triệu VND) 2015',
                'software_income_2016' => 'Tổng DT lĩnh vực sx phần mềm (Triệu VND) 2016',
                'software_income_2017' => 'Tổng DT lĩnh vực sx phần mềm (Triệu VND) 2017',
                'it_income_2015' => 'Tổng doanh thu dịch vụ CNTT (triệu VND) 2015',
                'it_income_2016' => 'Tổng doanh thu dịch vụ CNTT (triệu VND) 2016',
                'it_income_2017' => 'Tổng doanh thu dịch vụ CNTT (triệu VND) 2017',
                'export_income_2015' => 'Tổng DT xuất khẩu (USD) 2015',
                'export_income_2016' => 'Tổng DT xuất khẩu (USD) 2016',
                'export_income_2017' => 'Tổng DT xuất khẩu (USD) 2017',
                'total_labor_2015' => 'Tổng số lao động của DN 2015',
                'total_labor_2016' => 'Tổng số lao động của DN 2016',
                'total_labor_2017' => 'Tổng số lao động của DN 2017',
                'total_ltv_2015' => 'Tổng số LTV 2015',
                'total_ltv_2016' => 'Tổng số LTV 2016',
                'total_ltv_2017' => 'Tổng số LTV 2017',
                'description' => 'Giới thiệu chung',
                'main_service' => 'SP dịch vụ chính của DN',
                'main_market' => 'Thị trường chính'
            )
        );

        foreach($data as $key => $company){
            $extra_info = $this->information_model->fetch_company_by_id($company['id']);
            $data_export[$key + 1] = array(
                'company' => $extra_info['company'],
                'phone' => $extra_info['phone'],
                'address' => $extra_info['address'],
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
                'equity_2015' => $company['equity_1'],
                'equity_2016' => $company['equity_2'],
                'equity_2017' => $company['equity_3'],
                'owner_equity_2015' => $company['owner_equity_1'],
                'owner_equity_2016' => $company['owner_equity_2'],
                'owner_equity_2017' => $company['owner_equity_3'],
                'total_income_2015' => $company['total_income_1'],
                'total_income_2016' => $company['total_income_2'],
                'total_income_2017' => $company['total_income_3'],
                'software_income_2015' => $company['software_income_1'],
                'software_income_2016' => $company['software_income_2'],
                'software_income_2017' => $company['software_income_3'],
                'it_income_2015' => $company['it_income_1'],
                'it_income_2016' => $company['it_income_2'],
                'it_income_2017' => $company['it_income_3'],
                'export_income_2015' => $company['export_income_1'],
                'export_income_2016' => $company['export_income_2'],
                'export_income_2017' => $company['export_income_3'],
                'total_labor_2015' => $company['total_labor_1'],
                'total_labor_2016' => $company['total_labor_2'],
                'total_labor_2017' => $company['total_labor_3'],
                'total_ltv_2015' => $company['total_ltv_1'],
                'total_ltv_2016' => $company['total_ltv_2'],
                'total_ltv_2017' => $company['total_ltv_3'],
                'description' => $company['description'],
                'main_service' => implode(", ", (array)json_decode($company['main_service'])),
                'main_market' => implode(", ", (array)json_decode($company['main_market']))
            );
        }

        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($data_export);

        $filename='Danh_sach_doanh_nghiep_' . date("d-m-Y") . '.xls'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel'); //mime type

        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    
    public function export_product(){
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Danh sach san pham');

        // load database
        $this->load->database();

        // get all users in array formate
        $data = $this->information_model->get_all_product_for_export('product');
        $data_export = array(
            '0' => array(
                'company' => 'Doanh nghiệp',
                'name' => 'Tên SP/dịch vụ/giải pháp/ứng dụng',
                'service' => 'Đăng ký tham gia lĩnh vực',
                'functional' => 'Mô tả các công năng của sản phẩm',
                'process' => 'Các công nghệ và quy trình chất lượng sử dụng để phát triển sản phẩm',
                'security' => 'Bảo mật của sản phẩm',
                'positive' => 'Các ưu điểm nổi trội của SP/GP/DV',
                'compare' => 'So sánh với các SP/GP/DV khác',
                'income_2016' => 'Doanh thu của SP/GP/DV năm 2016',
                'income_2017' => 'Doanh thu của SP/GP/DV năm 2017',
                'area' => 'Thị phần của SP/giải pháp/DV',
                'open_date' => 'Ngày thương mại hoá/ra mắt dịch vụ',
                'price' => 'Giá SP/GP/DV',
                'customer' => '1 số khách hàng tiêu biểu',
                'after_sale' => 'Dịch vụ sau bán hàng',
                'team' => 'Đội ngũ phát triển sp/gp (bao nhiêu người, trình độ, trong bao lâu...)',
                'award' => 'Các giải thưởng/DH đã nhận được'
            )
        );

        foreach($data as $key => $extra_info){
            $data_export[$key + 1] = array(
                'company' => $extra_info['company'],
                'name' => $extra_info['name'],
                'service' => (is_array(json_decode($extra_info['service']))) ? implode(", ", (array)json_decode($extra_info['service'])) : '',
                'functional' => $extra_info['functional'],
                'process' => $extra_info['process'],
                'security' => $extra_info['security'],
                'positive' => $extra_info['positive'],
                'compare' => $extra_info['compare'],
                'income_2016' => $extra_info['income_2016'],
                'income_2017' => $extra_info['income_2017'],
                'area' => $extra_info['area'],
                'open_date' => $extra_info['open_date'],
                'price' => $extra_info['price'],
                'customer' => $extra_info['customer'],
                'after_sale' => $extra_info['after_sale'],
                'team' => $extra_info['team'],
                'award' => $extra_info['award']
            );
        }

        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($data_export);

        $filename='Danh_sach_san_pham_' . date("d-m-Y") . '.xls'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel'); //mime type

        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
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

        header('Content-Type: application/vnd.ms-excel'); //mime type

        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
}