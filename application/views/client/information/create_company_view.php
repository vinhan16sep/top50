<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
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
    .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{
        border:1px solid #ccc;
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <?php if ($this->session->flashdata('need_input_company_second')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Thông báo!</strong> <?php echo $this->session->flashdata('need_input_company_second'); ?>
            </div>
        <?php endif ?>
        <div class="row modified-mode">
            <div class="col-lg-10 col-lg-offset-0">
                <div class="form-group">
                    <h2 style="text-align:center;">THÔNG TIN CHI TIẾT DOANH NGHIỆP</h2>
                    <h3 style="text-align:center;">TOP50 NĂM <span style="color:#3c8dbc;"><?php echo $year; ?></span></h3>
                </div>
                <hr>
                <?php
                echo form_open_multipart('client/information/create_company?year=' . $eventYear, array('class' => 'form-horizontal', 'id' => 'company-form'));
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
                                <label><input type="radio" name="group" value="0">Lĩnh vực 1: BPO, ITO và KPO</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="group" value="1">Lĩnh vực 2: Phần mềm, giải pháp và dịch vụ CNTT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="group" value="2">Lĩnh vực 3: Nội dung số, ứng dụng và giải pháp cho mobile</label>
                            </div>
                            <hr style="border-bottom: 1px solid grey">
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox('group10', '1', false); ?> 10 Doanh nghiệp có năng lực công nghệ 4.0 tiêu biểu
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <h3>I. GIỚI THIỆU CHUNG VỀ DOANH NGHIỆP</h3>
                </div>
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
                                echo form_textarea('overview', set_value('overview'), 'class="form-control tinymce-area"');
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
                                echo form_textarea('active_area', set_value('active_area'), 'class="form-control tinymce-area"');
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
                                echo form_textarea('product', set_value('product'), 'class="form-control tinymce-area"');
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
                            echo form_label('SP dịch vụ chính của doanh nghiệp', 'main_service');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
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
                                echo '<label id="main_service[]-error" class="error" for="main_service[]"></label><br />';
                                echo form_error('main_service[]', '<div class="error"  style="margin-left: -15px">', '</div>');
                                foreach ($options as $key => $value) {
                                    echo form_checkbox('main_service[]', $value, false, 'class="btn-checkbox"');
                                    echo $key.'<br>';
                                }
                                echo form_checkbox('main_service[]', '', false, 'class="btn-checkbox" id="anonymous-service"');
                                echo 'Khác (nêu rõ)<br>';
                                // echo form_dropdown('main_service', $options, '', 'class="form-control"');
                                ?>
                                <input type="text" name="anonymous-service" class="input-anonymous-service form-control" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
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
                                        echo form_checkbox('main_market[]', $value, false, 'class="btn-checkbox"');
                                        echo $key.'<br>';
                                    }
                                    ?>
                                </div>
                                <br>
                                <strong style="margin-left: -15px">Quốc tế</strong>
                                <div class="row" style="margin-left: 20px">
                                    <?php
                                    echo form_checkbox('main_market[]', 'Gia công xuất khẩu', false, 'class="btn-checkbox"');
                                    echo 'Gia công xuất khẩu';
                                    ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php
                                    echo form_checkbox('main_market[]', 'Xuất khẩu SP/Giải pháp', false, 'class="btn-checkbox"');
                                    echo 'Xuất khẩu SP/Giải pháp';
                                    ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php
                                    echo form_checkbox('main_market[]', 'Xuất khẩu nhân lực CNTT', false, 'class="btn-checkbox"');
                                    echo 'Xuất khẩu nhân lực CNTT';
                                    ?>
                                </div>
                                <div class="row" style="margin-left: 20px">
                                    <strong>Xuất khẩu mục tiêu</strong><br>
                                    <?php
                                    foreach ($target as $key => $value) {
                                        echo form_checkbox('main_market[]', $value, false, 'class="btn-checkbox"');
                                        echo $key.'<br>';
                                    }
                                    echo form_checkbox('main_market[]', '', false, 'class="btn-checkbox" id="anonymous"');
                                    echo 'Xuất khẩu mục tiêu - Khác (nêu rõ)<br>';
                                    ?>
                                    <input type="text" name="anonymous" class="input-anonymous form-control" style="display: none;">
                                </div>
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
                <!-- div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            // echo form_label('Vốn điều lệ', 'equity_1');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <p><?php // echo 'Năm' . $rule2Year[0] ?></p>
                                <?php
                                // echo form_label('Số tuyệt đối (triệu đồng)', 'equity_1');
                                // echo form_error('equity_1', '<div class="error">', '</div>');
                                // echo form_input('equity_1', set_value('equity_1'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                // echo form_label('So với năm trước (%)', 'equity_percent_1');
                                // echo form_error('equity_percent_1', '<div class="error">', '</div>');
                                // echo form_input('equity_percent_1', set_value('equity_percent_1'), 'class="form-control"');
                                ?>
                            </div>
                            <hr>
                            <div class="row">
                                <p><?php // echo 'Năm' . $rule2Year[1] ?></p>
                                <?php
                                // echo form_label('Số tuyệt đối (triệu đồng)', 'equity_2');
                                // echo form_error('equity_2', '<div class="error">', '</div>');
                                // echo form_input('equity_2', set_value('equity_2'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                // echo form_label('So với năm trước (%)', 'equity_percent_2');
                                // echo form_error('equity_percent_2', '<div class="error">', '</div>');
                               //  echo form_input('equity_percent_2', set_value('equity_percent_2'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="form-group">
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
                                    <?php echo form_input('equity_1', set_value('equity_1'), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('equity_percent_1', set_value('equity_percent_1'), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('equity_2', set_value('equity_2'), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('equity_percent_2', set_value('equity_percent_2'), 'class="form-control"'); 
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
                                    <?php echo form_input('owner_equity_1', set_value('owner_equity_1'), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('owner_equity_percent_1', set_value('owner_equity_percent_1'), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('owner_equity_2', set_value('owner_equity_2'), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('owner_equity_percent_2', set_value('owner_equity_percent_2'), 'class="form-control"'); 
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
                                    <?php echo form_input('total_equity_1', set_value('total_equity _1'), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_equity_percent_1', set_value('total_equity _percent_1'), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_equity_2', set_value('total_equity _2'), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td colspan="2">
                                    <?php echo form_input('total_equity_percent_2', set_value('total_equity _percent_2'), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <!-- <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            //  echo form_label('Vốn chủ sở hữu', 'owner_equity');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <p><?php //     echo 'Năm' . $rule2Year[0] ?></p>
                                <?php
                                //  echo form_label('Số tuyệt đối (triệu đồng)', 'owner_equity_1');
                                //  echo form_error('owner_equity_1', '<div class="error">', '</div>');
                                //  echo form_input('owner_equity_1', set_value('owner_equity_1'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                //  echo form_label('So với năm trước (%)', 'owner_equity_percent_1');
                                //  echo form_error('owner_equity_percent_1', '<div class="error">', '</div>');
                                //  echo form_input('owner_equity_percent_1', set_value('owner_equity_percent_1'), 'class="form-control"');
                                ?>
                            </div>
                            <hr>
                            <div class="row">
                                <p><?php //     echo 'Năm' . $rule2Year[1] ?></p>
                                <?php
                                //  echo form_label('Số tuyệt đối (triệu đồng)', 'owner_equity_2');
                                //  echo form_error('owner_equity_2', '<div class="error">', '</div>');
                                //  echo form_input('owner_equity_2', set_value('owner_equity_2'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                //  echo form_label('So với năm trước (%)', 'owner_equity_percent_2');
                                //  echo form_error('owner_equity_percent_2', '<div class="error">', '</div>');
                                //  echo form_input('owner_equity_percent_2', set_value('owner_equity_percent_2'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div> -->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Tổng doanh thu doanh nghiệp', 'total_income');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <p><?php echo 'Năm' . $rule2Year[0] ?></p>
                                <?php
                                echo form_label('Số tuyệt đối (triệu đồng)', 'total_income_1');
                                echo form_error('total_income_1', '<div class="error">', '</div>');
                                echo form_input('total_income_1', set_value('total_income_1'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('So với năm trước (%)', 'total_income_percent_1');
                                echo form_error('total_income_percent_1', '<div class="error">', '</div>');
                                echo form_input('total_income_percent_1', set_value('total_income_percent_1'), 'class="form-control"');
                                ?>
                            </div>
                            <hr>
                            <div class="row">
                                <p><?php echo 'Năm' . $rule2Year[1] ?></p>
                                <?php
                                echo form_label('Số tuyệt đối (triệu đồng)', 'total_income_2');
                                echo form_error('total_income_2', '<div class="error">', '</div>');
                                echo form_input('total_income_2', set_value('total_income_2'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('So với năm trước (%)', 'total_income_percent_2');
                                echo form_error('total_income_percent_2', '<div class="error">', '</div>');
                                echo form_input('total_income_percent_2', set_value('total_income_percent_2'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <h4>2. KẾT QUẢ KINH DOANH</h4>
                </div>
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
                                echo form_input('software_income_1', set_value('software_income_1'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'software_income_2');
                                echo form_error('software_income_2', '<div class="error">', '</div>');
                                echo form_input('software_income_2', set_value('software_income_2'), 'class="form-control"');
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
                                echo form_input('it_income_1', set_value('it_income_1'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'it_income_2');
                                echo form_error('it_income_2', '<div class="error">', '</div>');
                                echo form_input('it_income_2', set_value('it_income_2'), 'class="form-control"');
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
                                echo form_input('export_income_1', set_value('export_income_1'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'export_income_2');
                                echo form_error('export_income_2', '<div class="error">', '</div>');
                                echo form_input('export_income_2', set_value('export_income_2'), 'class="form-control"');
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
                                echo form_input('total_labor_1', set_value('total_labor_1'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'total_labor_2');
                                echo form_error('total_labor_2', '<div class="error">', '</div>');
                                echo form_input('total_labor_2', set_value('total_labor_2'), 'class="form-control"');
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
                                echo form_input('total_ltv_1', set_value('total_ltv_1'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule2Year[1], 'total_ltv_2');
                                echo form_error('total_ltv_2', '<div class="error">', '</div>');
                                echo form_input('total_ltv_2', set_value('total_ltv_2'), 'class="form-control"');
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
                            echo form_label('Giới thiệu chung về doanh nghiệp (nêu thông tin về lịch sử hình thành, đội ngũ lãnh đạo doanh nghiệp, định hướng phát triển/chiến lược của doanh nghiệp, thế mạnh của doanh nghiệp...)', 'description');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('description', '<div class="error">', '</div>');
                                echo form_textarea('description', set_value('description'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12 text-right submit-extra-form">
                    <div class="col-sm-3 col-md-3 col-sx-12">
                    </div>
                    <div class="col-sm-9 col-md-9 col-sx-12">
                        <?php
                        echo form_submit('submit', 'Hoàn thành', 'id="submit" class="btn btn-primary pull-right" style="width:30%;display: inline;"');
                        echo form_submit('submit', 'Lưu tạm', 'id="tmpSubmit" class="btn btn-normal pull-right" style="width:30%;display: inline;margin-right:10px !important;"');
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

    $('#anonymous-service').click(function(){
        if($(this).prop("checked") == true){
            $('.input-anonymous-service').slideDown();
        }else{
            $('.input-anonymous-service').slideUp();
        }
    })

    $('.input-anonymous-service').change(function(){
        var anonymous = $(this).val();
        $('#anonymous-service').attr('value', anonymous);
    })

</script>