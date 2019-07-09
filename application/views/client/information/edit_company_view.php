<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .error{
        color: red;
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
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Vốn điều lệ (triệu VNĐ)', 'equity_1');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[0], 'equity_1');
                                echo form_error('equity_1', '<div class="error">', '</div>');
                                echo form_input('equity_1', set_value('equity_1', $company['equity_1']), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'equity_2');
                                echo form_error('equity_2', '<div class="error">', '</div>');
                                echo form_input('equity_2', set_value('equity_2', $company['equity_2']), 'class="form-control"');
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
                            echo form_label('Tổng tài sản (triệu VNĐ)', 'owner_equity');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[0], 'owner_equity_1');
                                echo form_error('owner_equity_1', '<div class="error">', '</div>');
                                echo form_input('owner_equity_1', set_value('owner_equity_1', $company['owner_equity_1']), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'owner_equity_2');
                                echo form_error('owner_equity_2', '<div class="error">', '</div>');
                                echo form_input('owner_equity_2', set_value('owner_equity_2', $company['owner_equity_2']), 'class="form-control"');
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
                            echo form_label('Tổng doanh thu doanh nghiệp (triệu VNĐ)', 'total_income');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[0], 'total_income_1');
                                echo form_error('total_income_1', '<div class="error">', '</div>');
                                echo form_input('total_income_1', set_value('total_income_1', $company['total_income_1']), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'total_income_2');
                                echo form_error('total_income_2', '<div class="error">', '</div>');
                                echo form_input('total_income_2', set_value('total_income_2', $company['total_income_2']), 'class="form-control"');
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
                            echo form_label('Tổng doanh thu lĩnh vực sản xuất phần mềm (triệu VNĐ)', 'software_income');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[0], 'software_income_1');
                                echo form_error('software_income_1', '<div class="error">', '</div>');
                                echo form_input('software_income_1', set_value('software_income_1', $company['software_income_1']), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'software_income_2');
                                echo form_error('software_income_2', '<div class="error">', '</div>');
                                echo form_input('software_income_2', set_value('software_income_2', $company['software_income_2']), 'class="form-control"');
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
                            echo form_label('Tổng doanh thu dịch vụ CNTT (triệu VNĐ)', 'it_income');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[0], 'it_income_1');
                                echo form_error('it_income_1', '<div class="error">', '</div>');
                                echo form_input('it_income_1', set_value('it_income_1', $company['it_income_1']), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'it_income_2');
                                echo form_error('it_income_2', '<div class="error">', '</div>');
                                echo form_input('it_income_2', set_value('it_income_2', $company['it_income_2']), 'class="form-control"');
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
                            echo form_label('Tổng doanh thu xuất khẩu (USD)', 'export_income');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[0], 'export_income_1');
                                echo form_error('export_income_1', '<div class="error">', '</div>');
                                echo form_input('export_income_1', set_value('export_income_1', $company['export_income_1']), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'export_income_2');
                                echo form_error('export_income_2', '<div class="error">', '</div>');
                                echo form_input('export_income_2', set_value('export_income_2', $company['export_income_2']), 'class="form-control"');
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
                            echo form_label('Tổng số lao động của doanh nghiệp', 'total_labor');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[0], 'total_labor_1');
                                echo form_error('total_labor_1', '<div class="error">', '</div>');
                                echo form_input('total_labor_1', set_value('total_labor_1', $company['total_labor_1']), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'total_labor_2');
                                echo form_error('total_labor_2', '<div class="error">', '</div>');
                                echo form_input('total_labor_2', set_value('total_labor_2', $company['total_labor_2']), 'class="form-control"');
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
                            echo form_label('Tổng số lập trình viên', 'total_ltv');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[0], 'total_ltv_1');
                                echo form_error('total_ltv_1', '<div class="error">', '</div>');
                                echo form_input('total_ltv_1', set_value('total_ltv_1', $company['total_ltv_1']), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'total_ltv_2');
                                echo form_error('total_ltv_2', '<div class="error">', '</div>');
                                echo form_input('total_ltv_2', set_value('total_ltv_2', $company['total_ltv_2']), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Giới thiệu chung về doanh nghiệp (nêu thông tin về lịch sử hình thành, đội ngũ lãnh đạo doanh nghiệp, định hướng phát triển/chiến lược của doanh nghiệp, thế mạnh của doanh nghiệp...)', 'description');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('description', '<div class="error">', '</div>');
                                echo form_textarea('description', set_value('description', $company['description']), 'class="form-control tinymce-area"');
                                ?>
                            </div>
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