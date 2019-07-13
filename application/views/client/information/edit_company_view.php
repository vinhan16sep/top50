<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .error{
        color: red;
    }
</style><style>
    .error{
        color: red;
    }
    .table tr:nth-child(2) td, .table tr:nth-child(1) th{
        text-align: center;
    }
    .table tr:nth-child(2) td{
        font-weight: bold;
    }
    .table tr:nth-child(2) td i{
        font-weight: 500;
    }
    .table tr:nth-child(1) th:nth-child(1){
        line-height: 70px;
    }
    #kd .table tr:nth-child(1) th:nth-child(2){
        line-height: 70px;
    }
    #kd .table tr:nth-child(1) th:nth-child(5){
        padding-top:30px;
    }
    .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{
        border:1px solid #ccc;
    }
    .text_input{
        line-height: 36px;
    }
    .text_input input{
        width: 100px;
        float: left;
        margin-left: 5px;
        margin-right: 5px;
    }
    .text_input div{
        float: left;
    }
    .form-group h5, div.h5{
        padding-left: 20px;
    }

    div.h5 .table th{
        line-height: 30px!important;
    }
    div.h5  .table td{
        font-weight: normal!important;
        text-align: left!important;

    }
    .form-check{
        padding-left: 5px;
    }
    .m-l-30{
        margin-right: -30px!important;
    }
    .message__{
        color: blue;
    }
    h5{
        font-size: 14px;
        font-family: webFont_N;
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row modified-mode">
            <div class="col-lg-10 col-lg-offset-0">
                <div class="form-group">
                    <h1 style="text-align:center;">THÔNG TIN DOANH NGHIỆP</h1>
                    <h3 style="color:red; text-align:center;">NĂM <?php echo $company['year']; ?></h3>
                </div>
                <?php
                echo form_open_multipart(base_url('client/information/edit_company?year=' . $eventYear), array('class' => 'form-horizontal', 'id' => 'company-form'));
                ?>
                <div class="form-group">
                    <h3>I. GIỚI THIỆU CHUNG VỀ DOANH NGHIỆP</h3>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Lĩnh vực đăng ký', 'group');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="radio">
                                <label><input type="radio" name="group" <?php echo ($company['group'] == 0) ? 'checked="checked"' : ''; ?> value="0">Lĩnh vực 1: BPO, ITO và KPO</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="group" <?php echo ($company['group'] == 1) ? 'checked="checked"' : ''; ?> value="1">Lĩnh vực 2: Phần mềm, giải pháp và dịch vụ CNTT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="group" <?php echo ($company['group'] == 2) ? 'checked="checked"' : ''; ?> value="2">Lĩnh vực 3: Nội dung số, ứng dụng và giải pháp cho mobile</label>
                            </div>
                            <hr style="border-bottom: 1px solid grey">
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox('group10', '1', ($company['group10'] == 1) ? true : false); ?> 10 Doanh nghiệp có năng lực công nghệ 4.0 tiêu biểu
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Giới thiệu doanh nghiệp (viết ngắn gọn đồng thời nêu rõ định hướng và mục tiêu phát triển doanh nghiệp – tối đa 100 từ)', 'overview');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('overview', '<div class="error">', '</div>');
                                echo form_textarea('overview', set_value('overview', $company['overview']), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Lĩnh vực hoạt động, nêu rõ điểm mạnh, sự khác biệt của doanh nghiệp so với các đối thủ cạnh tranh (tối đa 100 từ)', 'active_area');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('active_area', '<div class="error">', '</div>');
                                echo form_textarea('active_area', set_value('active_area', $company['active_area']), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Tên các sản phẩm, dịch vụ chính của doanh nghiệp', 'product');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('product', '<div class="error">', '</div>');
                                echo form_textarea('product', set_value('product', $company['product']), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Sản phẩm dịch vụ chính của doanh nghiệp', 'main_service');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                $new_check_main_service = array();
                                $main_service = json_decode($company['main_service']);
                                $options = array(
                                    'Chính phủ điện tử' => 'Chính phủ điện tử',
                                    'Y tế' => 'Y tế',
                                    'Giáo dục' => 'Giáo dục',
                                    'Giao thông' => 'Giao thông',
                                    'Xây dựng' => 'Xây dựng',
                                    'Sản xuất/dịch vụ cho DN' => 'Sản xuất/dịch vụ cho DN',
                                    'Nội dung số và giải trí điện tử' => 'Nội dung số và giải trí điện tử',
                                    'Viễn thông' => 'Viễn thông',
                                    'Bảo mật an toàn thông tin' => 'Bảo mật an toàn thông tin',
                                    'Tư vấn' => 'Tư vấn'
                                );

                                $check_main_service = false;
                                if(!is_null($main_service) && $main_service != null){

                                    $check_main_service = array_diff($main_service, $options);
                                    if($check_main_service){
                                        foreach ($check_main_service as $key => $value) {
                                            $new_check_main_service[] = $value;
                                        }
                                    }
                                }
                                echo '<label id="main_service[]-error" class="error" for="main_service[]"></label><br />';
                                echo form_error('main_service[]', '<div class="error"  style="margin-left: -15px">', '</div>');
                                foreach ($options as $key => $value) {
                                    if(!is_null($main_service) && $main_service != null){
                                        echo form_checkbox('main_service[]', $value, (in_array($value, $main_service, '')? true : false), 'class="btn-checkbox"');
                                        echo $key.'<br>';
                                    }else{
                                        echo form_checkbox('main_service[]', $value, false, 'class="btn-checkbox"');
                                        echo $key.'<br>';
                                    }

                                }

                                // echo form_dropdown('main_service', $options, '', 'class="form-control"');
                                if($check_main_service){
                                    if($new_check_main_service[0] != ''){
                                        echo form_checkbox('main_service[]', '', true, 'class="btn-checkbox" id="anonymous-service"');
                                        echo 'Sản phẩm - Khác (nêu rõ)<br>';
                                    }else{
                                        echo form_checkbox('main_service[]', '', false, 'class="btn-checkbox" id="anonymous-service"');
                                        echo 'Sản phẩm - Khác (nêu rõ)<br>';
                                    }
                                }else{
                                    echo form_checkbox('main_service[]', '', false, 'class="btn-checkbox" id="anonymous-service"');
                                    echo 'Sản phẩm - Khác (nêu rõ)<br>';
                                }

                                ?>
                                <?php if($check_main_service): ?>
                                    <?php if ($new_check_main_service[0] != ''): ?>
                                        <input type="text" name="anonymous-service" class="input-anonymous-service form-control" style="display: block;" value="<?php echo $new_check_main_service[0] ?>">
                                    <?php else: ?>
                                        <input type="text" name="anonymous-service" class="input-anonymous-service form-control" style="display: none;">
                                    <?php endif ?>
                                <?php else: ?>
                                    <input type="text" name="anonymous-service" class="input-anonymous-service form-control" style="display: none;">
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            $new_check = array();
                            $main_market = json_decode($company['main_market']);
                            echo form_label('Thị trường chính', 'main_market');
                            $domestic = array(
                                'Thị trường Chính phủ' => 'Thị trường Chính phủ',
                                'Thị trường doanh nghiệp' => 'Thị trường doanh nghiệp',
                                'Thị trường người tiêu dùng' => 'Thị trường người tiêu dùng'
                            );
                            $target = array(
                                'Mỹ và các nước Bắc Mỹ' => 'Mỹ và các nước Bắc Mỹ',
                                'Châu Âu' => 'Châu Âu',
                                'Nhật Bản' => 'Nhật Bản',
                                'Các nước trong khu vực' => 'Các nước trong khu vực'
                            );
                            $root = array(
                                'Thị trường Chính phủ' => 'Thị trường Chính phủ',
                                'Thị trường doanh nghiệp' => 'Thị trường doanh nghiệp',
                                'Thị trường người tiêu dùng' => 'Thị trường người tiêu dùng',
                                'Mỹ và các nước Bắc Mỹ' => 'Mỹ và các nước Bắc Mỹ',
                                'Châu Âu' => 'Châu Âu',
                                'Nhật Bản' => 'Nhật Bản',
                                'Các nước trong khu vực' => 'Các nước trong khu vực',
                                'Gia công xuất khẩu' => 'Gia công xuất khẩu',
                                'Xuất khẩu SP/Giải pháp' => 'Xuất khẩu SP/Giải pháp',
                                'Xuất khẩu nhân lực CNTT' => 'Xuất khẩu nhân lực CNTT'
                            );
                            $check = false;
                            if(!is_null($main_market) && $main_market != null){

                                $check = array_diff($main_market, $root);
                                if($check){
                                    foreach ($check as $key => $value) {
                                        $new_check[] = $value;
                                    }
                                }
                            }
                            // print_r($main_market);die;

                            ?>
                        </div>

                        <div class="col-sm-9 col-md-9 col-sx-12" style="padding-left: 30px;">
                            <div class="row">
                                <label style="margin-left: -15px" id="main_market[]-error" class="error" for="main_market[]"></label><br />
                                <?php echo form_error('main_market[]', '<div class="error"  style="margin-left: -15px">', '</div>'); ?>
                                <strong style="margin-left: -15px">Trong nước</strong>
                                <div class="row" style="margin-left: 20px">
                                    <?php
                                    foreach ($domestic as $key => $value) {
                                        if(!is_null($main_market) && $main_market != null){
                                            echo form_checkbox('main_market[]', $value, (in_array($value, $main_market, '')? true : false), 'class="btn-checkbox"');
                                            echo $key.'<br>';
                                        }else{
                                            echo form_checkbox('main_market[]', $value, false, 'class="btn-checkbox"');
                                            echo $key.'<br>';
                                        }
                                    }
                                    ?>
                                </div>
                                <br>
                                <strong style="margin-left: -15px">Quốc tế</strong>
                                <div class="row" style="margin-left: 20px">
                                    <?php
                                    if(!is_null($main_market) && $main_market != null){
                                        echo form_checkbox('main_market[]', 'Gia công xuất khẩu', (in_array('Gia công xuất khẩu', $main_market, '')? true : false), 'class="btn-checkbox"');
                                        echo 'Gia công xuất khẩu';
                                    }else{
                                        echo form_checkbox('main_market[]', 'Gia công xuất khẩu', false, 'class="btn-checkbox"');
                                        echo 'Gia công xuất khẩu';
                                    }
                                    ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php
                                    if(!is_null($main_market) && $main_market != null){
                                        echo form_checkbox('main_market[]', 'Xuất khẩu SP/Giải pháp', (in_array('Xuất khẩu SP/Giải pháp', $main_market, '')? true : false), 'class="btn-checkbox"');
                                        echo 'Xuất khẩu SP/Giải pháp';
                                    }else{
                                        echo form_checkbox('main_market[]', 'Xuất khẩu SP/Giải pháp', false, 'class="btn-checkbox"');
                                        echo 'Xuất khẩu SP/Giải pháp';
                                    }
                                    ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php
                                    if(!is_null($main_market) && $main_market != null){
                                        echo form_checkbox('main_market[]', 'Xuất khẩu nhân lực CNTT', (in_array('Xuất khẩu nhân lực CNTT', $main_market, '')? true : false), 'class="btn-checkbox"');
                                        echo 'Xuất khẩu nhân lực CNTT';
                                    }else{
                                        echo form_checkbox('main_market[]', 'Xuất khẩu nhân lực CNTT', false, 'class="btn-checkbox"');
                                        echo 'Xuất khẩu nhân lực CNTT';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 20px">
                                <strong>Xuất khẩu mục tiêu</strong><br>
                                <?php
                                foreach ($target as $key => $value) {
                                    if(!is_null($main_market) && $main_market != null){
                                        echo form_checkbox('main_market[]', $value, (in_array($value, $main_market, '')? true : false), 'class="btn-checkbox"');
                                        echo $key.'<br>';
                                    }else{
                                        echo form_checkbox('main_market[]', $value, false, 'class="btn-checkbox"');
                                        echo $key.'<br>';
                                    }
                                }
                                if($check){
                                    if($new_check[0] != ''){
                                        echo form_checkbox('main_market[]', '', true, 'class="btn-checkbox" id="anonymous"');
                                        echo 'Xuất khẩu mục tiêu - Khác (nêu rõ)<br>';
                                    }else{
                                        echo form_checkbox('main_market[]', '', false, 'class="btn-checkbox" id="anonymous"');
                                        echo 'Xuất khẩu mục tiêu - Khác (nêu rõ)<br>';
                                    }
                                }else{
                                    echo form_checkbox('main_market[]', '', false, 'class="btn-checkbox" id="anonymous"');
                                    echo 'Xuất khẩu mục tiêu - Khác (nêu rõ)<br>';
                                }
                                ?>
                                <?php if($check): ?>
                                    <?php if ($new_check[0] != ''): ?>
                                        <input type="text" name="anonymous" class="input-anonymous form-control" style="display: block;" value="<?php echo $new_check[0] ?>">
                                    <?php else: ?>
                                        <input type="text" name="anonymous" class="input-anonymous form-control" style="display: none;">
                                    <?php endif ?>
                                <?php else: ?>
                                    <input type="text" name="anonymous" class="input-anonymous form-control" style="display: none;">
                                <?php endif ?>

                            </div>
                        </div>
                    </div>
                </div>

                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <h3>II. NĂNG LỰC TÀI CHÍNH, KẾT QUẢ KINH DOANH, THỊ TRƯỜNG VÀ KHÁCH HÀNG</h3>
                </div>
                <div class="form-group">
                    <h4>1. NĂNG LỰC TÀI CHÍNH</h4>
                </div>
                <div class="form-group m-l-30">
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-bordered" >
                              <tr>
                                <th colspan="2" rowspan="2">Chỉ số</th>
                                <th colspan="4"><?php echo 'Năm ' . $rule2Year[0] ?></th>
                                <th colspan="4"><?php echo 'Năm ' . $rule2Year[1] ?></th>
                              </tr>
                              <tr>
                                <td colspan="2">Số tuyệt đối <i>(Triệu đồng)</i></td>
                                <td colspan="2">So với năm trước <i>(%)</i></td>
                                <td colspan="2">Số tuyệt đối <i>(Triệu đồng)</i></td>
                                <td colspan="2">So với năm trước <i>(%)</i></td>
                              </tr>
                              <tr>
                                <td colspan="2" style="width: 200px;">
                                    <?php
                                        echo form_label('1. Vốn điều lệ', 'equity_1');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('equity_1', set_value('equity_1',$company['equity_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('equity_percent_1', set_value('equity_percent_1',$company['equity_percent_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('equity_2', set_value('equity_2',$company['equity_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('equity_percent_2', set_value('equity_percent_2',$company['equity_percent_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                    <?php
                                        echo form_label('2. Vốn chủ sở hữu', 'owner_equity');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('owner_equity_1', set_value('owner_equity_1',$company['owner_equity_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('owner_equity_percent_1', set_value('owner_equity_percent_1',$company['owner_equity_percent_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('owner_equity_2', set_value('owner_equity_2',$company['owner_equity_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('owner_equity_percent_2', set_value('owner_equity_percent_2',$company['owner_equity_percent_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                    <?php
                                        echo form_label('3. Tổng tài sản', 'total_equity');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_assets_1', set_value('total_assets_1',$company['total_assets_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_assets_percent_1', set_value('total_assets_percent_1',$company['total_assets_percent_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_assets_2', set_value('total_assets_2',$company['total_assets_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_assets_percent_2', set_value('total_assets_percent_2',$company['total_assets_percent_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <h4>2. KẾT QUẢ KINH DOANH</h4>
                </div>



                
                <div class="form-group m-l-30" id="kd">
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-bordered" >
                              <tr>
                                <th colspan="1" rowspan="2">STT</th>
                                <th colspan="2" rowspan="2">Chỉ số</th>
                                <th colspan="4"><?php echo 'Năm ' . $rule2Year[0] ?></th>
                                <th colspan="4"><?php echo 'Năm ' . $rule2Year[1] ?></th>
                                <th colspan="1" rowspan="2">6 tháng đầu năm 2019 Số tuyệt đối (triệu đồng)</th>
                              </tr>
                              <tr>
                                <td colspan="2">Số tuyệt đối <i>(Triệu đồng)</i></td>
                                <td colspan="2">So với năm trước <i>(%)</i></td>
                                <td colspan="2">Số tuyệt đối <i>(Triệu đồng)</i></td>
                                <td colspan="2">So với năm trước <i>(%)</i></td>
                              </tr>


                              <!-- 1 Tổng doanh thu doanh nghiệp -->
                              <!-- name = name_a  -->
                              <tr>
                                <td colspan="1" style="width:30px;">
                                    1
                                </td>
                                <td colspan="2" style="width: 200px;">
                                    <?php
                                        echo form_label('Tổng doanh thu doanh nghiệp', 'name_a_label');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_income_1', set_value('total_income_1',$company['total_income_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_income_percent_1', set_value('total_income_percent_1',$company['total_income_percent_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_income_2', set_value('total_income_2',$company['total_income_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_income_percent_2', set_value('total_income_percent_2',$company['total_income_percent_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_income_6_months', set_value('total_income_6_months',$company['total_income_6_months']), 'class="form-control"');
                                    ?>
                                </td>
                              </tr>



                              <!-- 2 Bình quân doanh thu/đầu người -->
                              <!-- name = name_b  -->
                              <tr>
                                <td colspan="1"  style="width:30px;">
                                    2
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Bình quân doanh thu/đầu người', 'name_b_label');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('per_capita_income_1', set_value('per_capita_income_1',$company['per_capita_income_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('per_capita_income_percent_1', set_value('per_capita_income_percent_1',$company['per_capita_income_percent_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('per_capita_income_2', set_value('per_capita_income_2',$company['per_capita_income_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('per_capita_income_percent_2', set_value('per_capita_income_percent_2',$company['per_capita_income_percent_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="1">
                                    <?php echo form_input('per_capita_income_6_months', set_value('per_capita_income_6_months',$company['per_capita_income_6_months']), 'class="form-control"');
                                    ?>
                                </td>
                              </tr>

                              <!-- 3 Tổng doanh thu lĩnh vực sản xuất phần mềm -->
                              <!-- name = name_c  -->
                              <tr>
                                <td colspan="1"  style="width:30px;">
                                    3
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Tổng doanh thu lĩnh vực sản xuất phần mềm', 'name_c_label');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('software_income_1', set_value('software_income_1',$company['software_income_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('software_income_percent_1', set_value('software_income_percent_1',$company['software_income_percent_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('software_income_2', set_value('software_income_2',$company['software_income_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('software_income_percent_2', set_value('software_income_percent_2',$company['software_income_percent_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="1">
                                    <?php echo form_input('software_income_6_months', set_value('software_income_6_months',$company['software_income_6_months']), 'class="form-control"');
                                    ?>
                                </td>
                              </tr>

                              <!-- 4 Tổng doanh thu dịch vụ CNTT -->
                              <!-- name = name_d  -->
                              <tr>
                                <td colspan="1"  style="width:30px;">
                                    4
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Tổng doanh thu dịch vụ CNTT', 'name_d_label');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('it_income_1', set_value('it_income_1',$company['it_income_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('it_income_percent_1', set_value('it_income_percent_1',$company['it_income_percent_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('it_income_2', set_value('it_income_2',$company['it_income_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('it_income_percent_2', set_value('it_income_percent_2',$company['it_income_percent_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="1">
                                    <?php echo form_input('it_income_6_months', set_value('it_income_6_months',$company['it_income_6_months']), 'class="form-control"');
                                    ?>
                                </td>
                              </tr>


                              <!-- 5 Tổng doanh thu xuất khẩu -->
                              <!-- name = name_e  -->
                              <tr>
                                <td colspan="1"  style="width:30px;">
                                    5
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Tổng doanh thu xuất khẩu', 'name_e_label');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('export_income_1', set_value('export_income_1',$company['export_income_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('export_income_percent_1', set_value('export_income_percent_1',$company['export_income_percent_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('export_income_2', set_value('export_income_2',$company['export_income_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('export_income_percent_2', set_value('export_income_percent_2',$company['export_income_percent_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="1">
                                    <?php echo form_input('export_income_6_months', set_value('export_income_6_months',$company['export_income_6_months']), 'class="form-control"');
                                    ?>
                                </td>
                              </tr>


                              <!-- 6.1 Tổng doanh thu của lĩnh vực ứng cử -->
                              <!-- name = name_f  -->
                              <tr>
                                <td colspan="1" rowspan="3"  style="width:30px;">
                                    6
                                </td>
                                <td colspan="11">
                                    <?php
                                        echo form_label('Tổng doanh thu của lĩnh vực ứng cử:', 'name_f_label');
                                    ?>
                                </td>

                               <!--  <td colspan="2">
                                    <?php // echo form_input('international_income_1', set_value('international_income_1',$company['international_income_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php // echo form_input('international_income_percent_1', set_value('international_income_percent_1',$company['international_income_percent_1']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php // echo form_input('international_income_2', set_value('international_income_2',$company['international_income_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php // echo form_input('international_income_percent_2', set_value('international_income_percent_2',$company['international_income_percent_2']), 'class="form-control"');
                                    ?>
                                </td>
                                <td colspan="1">
                                    <?php // echo form_input('international_income_6_months', set_value('international_income_6_months',$company['international_income_6_months']), 'class="form-control"');
                                    ?>
                                </td> -->
                              </tr>

                              <!-- 6.2 Thị trường quốc tế -->
                              <!-- name = name_g  -->
                              <tr>
                                <td colspan="2">
                                    <?php
                                        echo form_label('- Thị trường quốc tế', 'name_g_label');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('international_income_1', set_value('international_income_1',$company['international_income_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('international_income_percent_1', set_value('international_income_percent_1',$company['international_income_percent_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('international_income_2', set_value('international_income_2',$company['international_income_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('international_income_percent_2', set_value('international_income_percent_2',$company['international_income_percent_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="1">
                                    <?php echo form_input('international_income_6_months', set_value('international_income_6_months',$company['international_income_6_months']), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>

                              <!-- 6.3 Thị trường nội địa -->
                              <!-- name = name_h  -->
                              <tr>
                                <td colspan="2">
                                    <?php
                                        echo form_label('- Thị trường nội địa', 'name_h_label');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('domestic_income_1', set_value('domestic_income_1',$company['domestic_income_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('domestic_income_percent_1', set_value('domestic_income_percent_1',$company['domestic_income_percent_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('domestic_income_2', set_value('domestic_income_2',$company['domestic_income_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('domestic_income_percent_2', set_value('domestic_income_percent_2',$company['domestic_income_percent_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="1">
                                    <?php echo form_input('domestic_income_6_months', set_value('domestic_income_6_months',$company['domestic_income_6_months']), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>

                              <!-- 7 Tổng lợi nhuận trước thuế của DN -->
                              <!-- name = name_i  -->
                              <tr>
                                <td colspan="1" style="width:30px;">
                                    7
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Tổng lợi nhuận trước thuế của DN', 'name_i_label');
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('before_tax_profit_1', set_value('before_tax_profit_1',$company['before_tax_profit_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('before_tax_profit_percent_1', set_value('before_tax_profit_percent_1',$company['before_tax_profit_percent_1']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('before_tax_profit_2', set_value('before_tax_profit_2',$company['before_tax_profit_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('before_tax_profit_percent_2', set_value('before_tax_profit_percent_2',$company['before_tax_profit_percent_2']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="1">
                                    <?php echo form_input('before_tax_profit_6_months', set_value('before_tax_profit_6_months',$company['before_tax_profit_6_months']), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h3>III. THÔNG TIN NHÂN LỰC</h3>
                </div>
                <div class="form-group">
                    <h4>1. QUY MÔ NHÂN SỰ</h4>
                </div>

                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 text_input">
                            <div>
                                - Tổng số nhân viên toàn thời gian (tính đến thời điểm nộp hồ sơ):
                            </div>
                            <?php
                                echo form_error('full_time_employee', '<div class="error">', '</div>');
                                echo form_input('full_time_employee', set_value('full_time_employee',$company['full_time_employee']), 'class="form-control"');
                            ?>       
                            người.
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 text_input">
                            <div>
                               - Độ tuổi trung bình: 
                            </div>
                            <?php
                                echo form_error('average_age', '<div class="error">', '</div>');
                                echo form_input('average_age', set_value('average_age',$company['average_age']), 'class="form-control"');
                            ?>       
                            tuổi.
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 text_input">
                            <div>
                               - Tỷ lệ tăng/giảm nhân sự hàng năm trong 02 năm gần nhất: 
                            </div><br>
                            <div>
                                2018: 
                            </div>
                            <?php
                                echo form_error('employee_change_percent_1', '<div class="error">', '</div>');
                                echo form_input('employee_change_percent_1', set_value('employee_change_percent_1',$company['employee_change_percent_1']), 'class="form-control"');
                            ?> 
                            <div>      
                                %;   2019: 
                            </div>
                            <?php
                                echo form_error('employee_change_percent_2', '<div class="error">', '</div>');
                                echo form_input('employee_change_percent_2', set_value('employee_change_percent_2',$company['employee_change_percent_2']), 'class="form-control"');
                            ?>
                            % (tính đến thời điểm nộp hồ sơ)
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <h4>2. TRÌNH ĐỘ NHÂN SỰ</h4>
                </div>

                <hr style="border-bottom: 1px solid white;">
                
                <div class="form-group">
                    <h5>a. Số nhân viên có thể sử dụng ngoại ngữ trong công việc (tính đến thời điểm nộp hồ sơ):</h5>
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-bordered" >
                              <tr>
                                <th style="width: 200px;">Ngoại ngữ</th>
                                <th>Số người</th>
                                <th>% trên tổng số nhân viên</th>
                              </tr>
                              <tr>
                                <td>Tiếng Anh</td>
                                <td>
                                    <?php 
                                        echo form_error('english_employee', '<div class="error">', '</div>');
                                        echo form_input('english_employee', set_value('english_employee',$company['english_employee']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo form_error('english_employee_percent', '<div class="error">', '</div>');
                                        echo form_input('english_employee_percent', set_value('english_employee_percent',$company['english_employee_percent']), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>
                              <tr>
                                <td>Tiếng Nhật</td>
                                <td>
                                    <?php 
                                        echo form_error('japanese_employee', '<div class="error">', '</div>');
                                        echo form_input('japanese_employee', set_value('japanese_employee',$company['japanese_employee']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo form_error('japanese_employee_percent', '<div class="error">', '</div>');
                                        echo form_input('japanese_employee_percent', set_value('japanese_employee_percent',$company['japanese_employee_percent']), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>
                              <tr>
                                <td>Ngoại ngữ khác (Ghi rõ)</td>
                                <td>
                                    <?php 
                                        echo form_error('other_language_employee', '<div class="error">', '</div>');
                                        echo form_input('other_language_employee', set_value('other_language_employee',$company['other_language_employee']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo form_error('other_language_employee_percent', '<div class="error">', '</div>');
                                        echo form_input('other_language_employee_percent', set_value('other_language_employee_percent',$company['other_language_employee_percent']), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <h5>b. Trình độ chuyên môn:</h5>
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            (Cấu trúc nhân sự theo trình độ học vấn, theo các vị trí công việc, các cấp độ kỹ năng, các vị trí chuyên môn,...):
                        </div>
                        <div class="col-xs-12">
                             <?php
                                echo form_error('qualification', '<div class="error">', '</div>');
                                echo form_textarea('qualification', set_value('qualification',$company['qualification']), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <h4 class="text_input">
                        <div>3. Mức lương trung bình/năm 2018: </div>
                        <?php 
                            echo form_error('average_salary', '<div class="error">', '</div>');
                            echo form_input('average_salary', set_value('average_salary',$company['average_salary']), 'class="form-control"'); 
                        ?>
                        triệu đồng/tháng/người.
                    </h4>
                </div>

                <div class="form-group ">
                    <h4 class="text_input">
                        <div>4. Số nhân viên thuộc bộ phận chăm sóc khách hàng (nếu có): </div>
                        <?php 
                            echo form_error('customer_supporter', '<div class="error">', '</div>');
                            echo form_input('customer_supporter', set_value('customer_supporter',$company['customer_supporter']), 'class="form-control"'); 
                        ?>
                        người.
                    </h4>
                </div>

                <div class="form-group ">
                    <h4>5. Công tác đào tạo, bồi dưỡng nhân lực: </h4>
                </div>
                <div class="form-group m-l-30">
                    <div class="row">
                        <div class="col-xs-12">
                             <?php
                                echo form_error('training_process', '<div class="error">', '</div>');
                                echo form_textarea('training_process', set_value('training_process',$company['training_process']), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group ">
                    <h4>6. Hoạt động tuyển dụng nhân sự: </h4>
                </div>
                <div class="form-group h5">
                    <h5 class="text_input">
                        <div>- Số nhân viên thuộc bộ phận tuyển dụng nhân sự: </div>
                        <?php 
                            echo form_error('recruitment_staff', '<div class="error">', '</div>');
                            echo form_input('recruitment_staff', set_value('recruitment_staff',$company['recruitment_staff']), 'class="form-control"'); 
                        ?>
                        người.
                    </h5>
                    <h5 class="text_input">
                        <div>- Chi phí cho hoạt động tuyển dụng nhân sự năm 2018: </div>
                        <?php 
                            echo form_error('recruitment_budget', '<div class="error">', '</div>');
                            echo form_input('recruitment_budget', set_value('recruitment_budget',$company['recruitment_budget']), 'class="form-control"'); 
                        ?>
                        triệu đồng
                    </h5>
                </div>
                <div class="form-group">
                    <h3>VI. HOẠT ĐỘNG KHOA HỌC VÀ CÔNG NGHỆ</h3>
                </div>
                <div class="form-group">
                    <h4>1. Chi phí đầu tư cho hoạt động R&D năm 2018:</h4>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-bordered" >
                              <tr>
                                <th style="width: 200px;">Năm</th>
                                <th>Tổng chi phí <i style="font-weight: 500;">(Triệu đồng)</i></th>
                                <th>% trên tổng doanh thu</th>
                              </tr>
                              <tr>
                                <td>2018</td>
                                <td>
                                    <?php 
                                        echo form_error('investment_fund_r_and_d', '<div class="error">', '</div>');
                                        echo form_input('investment_fund_r_and_d', set_value('investment_fund_r_and_d',$company['investment_fund_r_and_d']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo form_error('investment_fund_r_and_d_percent', '<div class="error">', '</div>');
                                        echo form_input('investment_fund_r_and_d_percent', set_value('investment_fund_r_and_d_percent',$company['investment_fund_r_and_d_percent']), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>
                            </table>
                        </div>
                    </div>
                    <h5 class="text_input">
                        <div>- Số lượng nhân viên bộ phận R&D năm 2018: </div>
                        <?php 
                            echo form_error('staff_r_and_d', '<div class="error">', '</div>');
                            echo form_input('staff_r_and_d', set_value('staff_r_and_d',$company['staff_r_and_d']), 'class="form-control"'); 
                        ?>
                        người.
                    </h5>
                </div>
                
                <div class="form-group h5 m-l-30 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            - Thành quả nổi bật của hoạt động R&D :
                        </div>
                        <div class="col-xs-12">
                             <?php
                                echo form_error('result_r_and_d', '<div class="error">', '</div>');
                                echo form_textarea('result_r_and_d', set_value('result_r_and_d',$company['result_r_and_d']), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>

                
                <div class="form-group">
                    <h4>2. Chế độ bảo mật của công ty và bảo mật cho khách hàng:</h4>
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            - Các chứng chỉ bảo mật – nếu có (nêu loại chứng chỉ đạt được, tổ chức cấp chứng chỉ, thời gian được cấp chứng chỉ,…. tối đa 100 từ)
                        </div>
                        <div class="col-xs-12">
                             <?php
                                echo form_error('security_certificate', '<div class="error">', '</div>');
                                echo form_textarea('security_certificate', set_value('security_certificate',$company['security_certificate']), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            - Các quy trình/các biện pháp an ninh, bảo mật cơ sở dữ liệu và thông tin của công ty (tối đa 100 từ):
                        </div>
                        <div class="col-xs-12">
                             <?php
                                echo form_error('security_process', '<div class="error">', '</div>');
                                echo form_textarea('security_process', set_value('security_process',$company['security_process']), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h4>3. Quản lý công nghệ, chất lượng: (các chứng chỉ công nghệ và quy trình chất lượng...)</h4>
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12">
                             <?php
                                echo form_error('technique_certificate', '<div class="error">', '</div>');
                                echo form_textarea('technique_certificate', set_value('technique_certificate',$company['technique_certificate']), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group col-sm-12 text-right submit-extra-form">
                    <div class="col-sm-3 col-md-3 col-sx-12">

                    </div>
                    <div class="col-sm-9 col-md-9 col-sx-12">
                        <div>
                            <a style="display: inline;" href="<?php echo base_url('client/information/company'); ?>" class="btn btn-default pull-left"><b>Quay lại</b></a>
                            <?php
                                if($status['is_company'] == 0){
                                    echo form_submit('submit', 'Lưu tạm', 'id="tmpSubmit" class="btn btn-normal pull-right" style="width:30%;display:inline;margin-right:10px !important;"');
                                }
                            ?>
                            <?php echo form_submit('submit', 'Hoàn thành', 'id="submit" class="btn btn-primary pull-right" style="width:30%;display: inline;"'); ?>
                        </div>
                        <?php
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    var base_url = location.protocol + "//" + location.host + (location.port ? ':' + location.port : '')+'/working';
    $('#anonymous').click(function(){
        if($(this).prop("checked") == true){
            $('.input-anonymous').slideDown();
        }else{
            $('.input-anonymous').slideUp();
        }
    })

    $('.input-anonymous').change(function(){
        var anonymous = $(this).val();
        $('#anonymous').attr('value', anonymous);
    })

    $('.input-anonymous').each(function(){
        var anonymous = $(this).val();
        $('#anonymous').attr('value', anonymous);
    });



    $('#anonymous-service').click(function(){
        if($(this).prop("checked") == true){
            $('.input-anonymous-service').slideDown();
        }else{
            $('.input-anonymous-service').slideUp();
        }
    })

    $('.input-anonymous-service').each(function(){
        var anonymous_service = $(this).val();
        $('#anonymous-service').attr('value', anonymous_service);
    });

    $('.input-anonymous-service').change(function(){
        var anonymous_service = $(this).val();
        $('#anonymous-service').attr('value', anonymous_service);
    })

</script>