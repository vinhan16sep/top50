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
    .form-group.h5 div,.form-group.h5 b{
        font-size: 14px!important;
        font-family: webFont_N!important;
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
    .tab-content input{
        border: 1px solid #fff;
        /*background: #fff!important;*/
    }
    .tab-content input:focus{
        border: 1px solid #fff;
        /*background: #fff!important;*/
    }
    .main_service p:before{
        content:"- ";
    }
    .main_market p:before{
        content:"- ";
    }
    textarea{
        white-space: initial;
    }
    .tables-css{
        margin-top: 15px;
    }
    .tables-css td{
        line-height: 30px!important;
        font-weight: initial!important;
        text-align: left!important;
    }
    input[type="checkbox"]:checked[disabled] + label{
        color:blue;
        display: contents;
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content" style="padding-right: 40px;">
                        <div class="post">
                            <h2 style="text-align:center;">THÔNG TIN LĨNH VỰC ỨNG CỬ</h2>



                 <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo form_label('Lĩnh vực doanh nghiệp đã chọn', 'overview');
                            ?>
                        </div>
                        <hr>
                        <div class="col-xs-12 textarea-h">
                            <?php 
                                $company['group'] = (array)json_decode($company['group'], true);
                            ?>
                            <div>
                                <div class="row">
                                    <?php foreach ($groups as $key => $value): ?>
                                        <div class="col-md-6">
                                            <label>
                                                <?php echo form_checkbox('group[]', $key, in_array($key, $company['group']) ? true: false, 'disabled'); ?> <label for=""><?php echo $value ?></label>
                                            </label>
                                        </div>
                                    <?php endforeach ?>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <h3>I. GIỚI THIỆU</h3>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo form_label('Giới thiệu doanh nghiệp', 'overview');
                            ?>
                        </div>
                        <hr>
                        <div class="col-xs-12 textarea-h">
                            <div>
                                <textarea name="" id="" rows="10" style="width: 100%;border:none" class="form-control">
                                    <?php echo strip_tags(htmlspecialchars_decode($company['overview'])); ?>
                                </textarea>
                                    
                            </div>
                                
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <h3>II. SỐ LIỆU TÀI CHÍNH</h3>
                </div>
                <div class="form-group m-l-30">
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-bordered" >
                              <tr>
                                <th colspan="1" rowspan="2">STT</th>
                                <th colspan="2" rowspan="2">Chỉ số</th>
                                <th colspan="4"><?php echo 'Năm ' . $rule2Year[0] ?></th>
                                <th colspan="4"><?php echo 'Năm ' . $rule2Year[1] ?><br><em>(6 tháng đầu năm)</em></th>
                              </tr>
                              <tr>
                                <td colspan="2">Số tuyệt đối </td>
                                <td colspan="2">So với năm trước <i>(%)</i></td>
                                <td colspan="2">Số tuyệt đối </td>
                                <td colspan="2">So với năm trước <i>(%)</i></td>
                              </tr>
                              <tr>
                                <td colspan="1" style="width: 30px;">
                                    1
                                </td>
                                <td colspan="2" style="width: 200px;">
                                    <?php
                                        echo form_label('Vốn điều lệ (triệu VNĐ)', 'equity_1');
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
                                <td colspan="1" style="width: 30px;">
                                    2
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Tổng tài sản (triệu VNĐ)', 'total_equity');
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

                              <!-- 2 Bình quân doanh thu/đầu người -->
                              <!-- name = name_b  -->
                              <tr>
                                <td colspan="1"  style="width:30px;">
                                    3
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Bình quân doanh thu/đầu người (triệu VNĐ)', 'name_b_label');
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
                              </tr>



                              <tr>
                                <td colspan="1" style="width:30px;">
                                    4
                                </td>
                                <td colspan="2" style="width: 200px;">
                                    <?php
                                        echo form_label('Tổng doanh thu doanh nghiệp (triệu VNĐ)', 'name_a_label');
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
                              </tr>



                              <!-- 5 Tổng doanh thu lĩnh vực phần mềm, giải pháp (triệu VNĐ) -->
                              <!-- name = name_c  -->
                              <tr>
                                <td colspan="1"  style="width:30px;">
                                    5
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Tổng doanh thu lĩnh vực phần mềm, giải pháp (triệu VNĐ)', 'name_c_label');
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
                              </tr>

                              <!-- 6 Tổng doanh thu dịch vụ CNTT (triệu VNĐ) -->
                              <!-- name = name_d  -->
                              <tr>
                                <td colspan="1"  style="width:30px;">
                                    6
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Tổng doanh thu dịch vụ CNTT (triệu VNĐ)', 'name_d_label');
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
                              </tr>


                              <!-- 7 Tổng doanh thu xuất khẩu (USD) -->
                              <!-- name = name_e  -->
                              <tr>
                                <td colspan="1"  style="width:30px;">
                                    7
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Tổng doanh thu xuất khẩu (USD)', 'name_e_label');
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
                              </tr>

                              <!-- 8 Tổng số lao động của doanh nghiệp -->
                              <!-- name = name_h  -->
                              <tr>
                                <td colspan="1"  style="width:30px;">
                                    8
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Tổng số lao động của doanh nghiệp', 'name_h_label');
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
                              </tr>

                              <!-- 9 Tổng số lập trình viên -->
                              <!-- name = name_i  -->
                              <tr>
                                <td colspan="1" style="width:30px;">
                                    9
                                </td>
                                <td colspan="2">
                                    <?php
                                        echo form_label('Tổng số lập trình viên', 'name_i_label');
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
                              </tr>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <h3>III. THÔNG TIN NHÂN LỰC</h3>
                </div>

                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 text_input">
                            <div>
                                <strong>1.</strong> Tổng số nhân viên toàn thời gian (tính đến thời điểm nộp hồ sơ):
                            </div>
                            <?php
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
                               <strong>2.</strong> Độ tuổi trung bình: 
                            </div>
                            <?php
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
                               <strong>3.</strong> Tỷ lệ tăng/giảm nhân sự hàng năm trong 02 năm gần nhất: 
                            </div><br>
                            <div style="padding-left: 15px;font-weight: bold;">
                                <div>
                                    - 2018: 
                                </div>
                                <?php
                                    echo form_input('employee_change_percent_1', set_value('employee_change_percent_1',$company['employee_change_percent_1']), 'class="form-control"');
                                ?> 
                                <div>      
                                    %;&nbsp;&nbsp;&nbsp;2019: 
                                </div>
                                <?php
                                    echo form_input('employee_change_percent_2', set_value('employee_change_percent_2',$company['employee_change_percent_2']), 'class="form-control"');
                                ?>
                                <div>
                                    %;&nbsp;&nbsp;&nbsp;đến tháng 10.2020
                                </div>
                                <?php
                                    echo form_input('employee_change_percent_3', set_value('employee_change_percent_3',$company['employee_change_percent_3']), 'class="form-control"');
                                ?>
                                %
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="form-group ">
                    <div class="text_input">
                        <div>
                           <strong>4.</strong> Mức lương trung bình/năm 2019: 
                        </div>
                        <?php 
                            echo form_input('average_salary', set_value('average_salary',$company['average_salary']), 'class="form-control"'); 
                        ?>
                        triệu VNĐ/tháng/người.
                    </div>
                </div>

                <div class="form-group ">
                    <div>
                       <strong>5.</strong> Công tác đào tạo, bồi dưỡng nhân lực:
                    </div>
                </div>
                <div class="form-group m-l-30">
                    <div class="row">

                        <div class="col-xs-12 textarea-h">
                            <div>
                                <?php
                                echo htmlspecialchars_decode($company['training_process']);
                                ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group ">
                    <div>
                       <strong>6.</strong> Hoạt động tuyển dụng nhân sự:
                    </div>
                </div>
                <div class="form-group h5">
                    <h5 class="text_input" style="padding-left: 25px;">
                        <div>- Chi phí cho hoạt động tuyển dụng nhân sự năm 2019: </div>
                        <?php 
                            echo form_input('recruitment_budget', set_value('recruitment_budget',$company['recruitment_budget']), 'class="form-control"'); 
                        ?>
                        triệu VNĐ
                    </h5>
                </div>

                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <h3 style="text-transform: uppercase;">IV. Sản phẩm, dịch vụ, giải pháp, thị trường và khách hàng</h3>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <strong>1.</strong> Tên các sản phẩm, dịch vụ chính của doanh nghiệp
                        </div>
                        <hr>
                        <div class="col-xs-12 textarea-h">
                            <div>
                                <?php
                                echo htmlspecialchars_decode($company['product']);
                                ?></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <strong>2.</strong> Sản phẩm dịch vụ chính của doanh nghiệp
                        </div>
                        <div class="col-sm-12 col-md-12 col-sx-12">
                            <?php
                            $new_check_main_service = array();
                            $main_service = json_decode($company['main_service']);
                            $options = array(
                                'Chính phủ điện tử' => 'Chính phủ điện tử',
                                'Y tế' => 'Y tế',
                                'Giáo dục' => 'Giáo dục',
                                'Giao thông' => 'Giao thông',
                                'Thương mại điện tử' => 'Thương mại điện tử',
                                'Fintech' => 'Fintech',
                                'Chuyển đổi số' => 'Chuyển đổi số',
                                'Sản xuất/dịch vụ cho DN' => 'Sản xuất/dịch vụ cho DN',
                                'Nội dung số và giải trí điện tử' => 'Nội dung số và giải trí điện tử',
                                'Viễn thông, hạ tầng dữ liệu' => 'Viễn thông, hạ tầng dữ liệu',
                                'Bảo mật an toàn thông tin' => 'Bảo mật an toàn thông tin',
                                'Phát triển ứng dụng cho mobile ' => 'Phát triển ứng dụng cho mobile ',
                                'Digital Marketing' => 'Digital Marketing',
                                'Đào tạo' => 'Đào tạo',
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
                            echo '<div class="row">';
                                foreach ($options as $key => $value) {
                                    echo '<div class="col-md-6">';
                                        if(!is_null($main_service) && $main_service != null){
                                            echo form_checkbox('main_service[]', $value, (in_array($value, $main_service, '')? true : false), 'class="btn-checkbox" disabled');
                                            echo '<label for="">'.$key.'</label><br>';
                                        }else{
                                            echo form_checkbox('main_service[]', $value, false, 'class="btn-checkbox" disabled');
                                            echo '<label for="">'.$key.'</label><br>';
                                        }
                                    echo '</div>';
                                }
                            echo '</div>';

                            // echo form_dropdown('main_service', $options, '', 'class="form-control"');
                            if($check_main_service){
                                if($new_check_main_service[0] != ''){
                                    echo form_checkbox('main_service[]', $new_check_main_service[0], true, 'class="btn-checkbox" id="anonymous-service" disabled');
                                    echo '<label for="">Khác (nêu rõ)</label><br>';
                                }else{
                                    echo form_checkbox('main_service[]', '', false, 'class="btn-checkbox" id="anonymous-service" disabled');
                                    echo '<label for="">Khác (nêu rõ)</label><br>';
                                }
                            }else{
                                echo form_checkbox('main_service[]', '', false, 'class="btn-checkbox" id="anonymous-service" disabled');
                                echo '<label for="">Khác (nêu rõ)</label><br>';
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
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-sx-12">
                                <strong>3.</strong> Tỷ trọng thị trường theo khu vực địa lý năm 2019
                            </div>
                            <div class="col-sm-12 col-md-12 col-sx-12">
                                <div class="text_input">
                                    <table class="tables-css table table-bordered" >
                                        <tr>
                                            <td>Thị trường nội địa: </td>
                                            <td >
                                                <?php
                                                    echo form_input('proportion_market_local', set_value('proportion_market_local',$company['proportion_market_local']), 'class="form-control"');
                                                ?>
                                                %
                                            </td>
                                            <td>Thị trường Châu Âu: </td>
                                            <td >
                                                <?php
                                                    echo form_input('proportion_market_europe', set_value('proportion_market_europe',$company['proportion_market_europe']), 'class="form-control"');
                                                ?>
                                                %
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Thị trường Mỹ: </td>
                                            <td >
                                                <?php
                                                    echo form_input('proportion_market_america', set_value('proportion_market_america',$company['proportion_market_america']), 'class="form-control"');
                                                ?>
                                                %
                                            </td>
                                            <td style='width: 190px;'>Thị trường Nhật: </td>
                                            <td >
                                                <?php
                                                    echo form_input('proportion_market_japan', set_value('proportion_market_japan',$company['proportion_market_japan']), 'class="form-control"');
                                                ?>
                                                %
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style='width: 190px;'>Thị trường quốc tế khác: </td>
                                            <td >
                                                <?php
                                                    echo form_input('proportion_market_other_international', set_value('proportion_market_other_international',$company['proportion_market_other_international']), 'class="form-control"');
                                                ?>
                                                %
                                            </td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-sx-12">
                            <strong>4.</strong> Thị trường chính
                            <?php
                            $new_check = array();
                            $main_market = json_decode($company['main_market'], true);
                            $domestic = array(
                                'Thị trường Chính phủ' => 'Thị trường Chính phủ',
                                'Thị trường doanh nghiệp' => 'Thị trường doanh nghiệp',
                                'Thị trường người tiêu dùng' => 'Thị trường người tiêu dùng',
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
                                'Thị trường người tiêu dùng' => 'Thị trường người tiêu dùng',
                                'Mỹ và các nước Bắc Mỹ' => 'Mỹ và các nước Bắc Mỹ',
                                'Châu Âu' => 'Châu Âu',
                                'Nhật Bản' => 'Nhật Bản',
                                'Các nước trong khu vực' => 'Các nước trong khu vực',
                                'Gia công xuất khẩu' => 'Gia công xuất khẩu',
                                'Xuất khẩu SP/Giải pháp/Dịch vụ' => 'Xuất khẩu SP/Giải pháp/Dịch vụ',
                                'Xuất khẩu nhân lực CNTT' => 'Xuất khẩu nhân lực CNTT'
                            );
                            $check = false;
                            if(!is_null($main_market) && $main_market != null){

                                if (!empty($main_market['khac'])) {
                                    $root['khac'] = $main_market['khac'];
                                }

                                $check = array_diff($main_market, $root);
                                if($check){
                                    foreach ($check as $key => $value) {
                                        $new_check[] = $value;
                                    }
                                }
                            }

                            ?>
                        </div>

                        <div class="col-sm-12 col-md-12 col-sx-12" style="padding-left: 30px;">
                            <label style="margin-left: -15px" id="main_market[]-error" class="error" for="main_market[]"></label><br />
                            <?php // echo form_error('main_market[]', '<div class="error"  style="margin-left: -15px">', '</div>'); ?>
                            <strong style="margin-left: -15px">Trong nước</strong>
                            <div class="row domestic-checkbox" style="margin-left: 20px">
                                <?php
                                foreach ($domestic as $key => $value) {
                                    if(!is_null($main_market) && $main_market != null){
                                        echo form_checkbox('main_market[]', $value, (in_array($value, $main_market, '')? true : false), 'class="btn-checkbox" disabled');
                                        echo '<label for="">'.$key.'</label><br>';
                                    }else{
                                        echo form_checkbox('main_market[]', $value, false, 'class="btn-checkbox" disabled');
                                        echo '<label for="">'.$key.'</label><br>';
                                    }
                                }
                                echo form_checkbox('main_market[khac]', (!empty($main_market['khac']) ? $main_market['khac'] : ''), (!empty($main_market['khac'])? true : false), 'class="btn-checkbox" disabled id="checkbox_anonymous_domestic"');
                                    echo '<label for="">Khác (nêu rõ)</label><br>';
                                ?>

                                <input type="text" id="anonymous_domestic" name="anonymous_domestic" value="<?php echo !empty($main_market['khac']) ? $main_market['khac'] : ''; ?>" class="input-anonymous_domestic form-control" style="display: none;">
                            </div>
                            <br>
                            <strong style="margin-left: -15px">Quốc tế</strong>
                            <div class="row" style="margin-left: 20px">
                                <?php
                                if(!is_null($main_market) && $main_market != null){
                                    echo form_checkbox('main_market[]', 'Gia công xuất khẩu', (in_array('Gia công xuất khẩu', $main_market, '')? true : false), 'class="btn-checkbox" disabled');
                                    echo '<label for="">Gia công xuất khẩu</label><br>';
                                }else{
                                    echo form_checkbox('main_market[]', 'Gia công xuất khẩu', false, 'class="btn-checkbox" disabled');
                                    echo '<label for="">Gia công xuất khẩu</label><br>';
                                }
                                ?>
                                <?php
                                if(!is_null($main_market) && $main_market != null){
                                    echo form_checkbox('main_market[]', 'Xuất khẩu SP/Giải pháp/Dịch vụ', (in_array('Xuất khẩu SP/Giải pháp/Dịch vụ', $main_market, '')? true : false), 'class="btn-checkbox" disabled');
                                    echo '<label for="">Xuất khẩu SP/Giải pháp/Dịch vụ</label><br>';
                                }else{
                                    echo form_checkbox('main_market[]', 'Xuất khẩu SP/Giải pháp/Dịch vụ', false, 'class="btn-checkbox" disabled');
                                    echo '<label for="">Xuất khẩu SP/Giải pháp/Dịch vụ</label><br>';
                                }
                                ?>
                                <?php
                                if(!is_null($main_market) && $main_market != null){
                                    echo form_checkbox('main_market[]', 'Xuất khẩu nhân lực CNTT', (in_array('Xuất khẩu nhân lực CNTT', $main_market, '')? true : false), 'class="btn-checkbox" disabled');
                                    echo '<label for="">Xuất khẩu nhân lực CNTT</label><br>';
                                }else{
                                    echo form_checkbox('main_market[]', 'Xuất khẩu nhân lực CNTT', false, 'class="btn-checkbox" disabled');
                                    echo '<label for="">Xuất khẩu nhân lực CNTT</label><br>';
                                }
                                ?>
                            </div>
                            <div style="margin-left: 20px;margin-top: 5px;margin-bottom: 5px;">
                                <strong>Thị trường xuất khẩu mục tiêu</strong><br>
                                <div style="padding-left: 35px;">
                                    <?php
                                    foreach ($target as $key => $value) {
                                        if(!is_null($main_market) && $main_market != null){
                                            echo form_checkbox('main_market[]', $value, (in_array($value, $main_market, '')? true : false), 'class="btn-checkbox" disabled');
                                            echo '<label for="">'.$key.'</label><br>';
                                        }else{
                                            echo form_checkbox('main_market[]', $value, false, 'class="btn-checkbox" disabled');
                                            echo '<label for="">'.$key.'</label><br>';
                                        }
                                    }
                                    if($check){
                                        if($new_check[0] != ''){
                                            echo form_checkbox('main_market[]', $new_check[0], true, 'class="btn-checkbox" disabled id="anonymous"');
                                            echo '<label for="">Khác (nêu rõ)</label><br>';
                                        }else{
                                            echo form_checkbox('main_market[]', '', false, 'class="btn-checkbox" id="anonymous" disabled');
                                            echo '<label for="">Khác (nêu rõ)</label><br>';
                                        }
                                    }else{
                                        echo form_checkbox('main_market[]', '', false, 'class="btn-checkbox" id="anonymous" disabled');
                                        echo '<label for="">Khác (nêu rõ)</label><br>';
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
                    <div class="form-group">
                        <strong>5.</strong> Giới thiệu tóm tắt 05 khách hàng/dự án tiêu biểu doanh nghiệp đã thực hiện: 
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 textarea-h">
                                <div>
                                    <?php
                                    echo htmlspecialchars_decode($company['top5_customers']);
                                    ?></div>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="form-group">
                    <h3 style="text-transform: uppercase;">V. Năng lực công nghệ, R&D và quản lý</h3>
                </div>
                <div class="form-group">
                    <strong>1.</strong> Các chứng chỉ về công nghệ/ các công nghệ doanh nghiệp đang sử dụng/các công nghệ là thế mạnh của doanh nghiệp (đặc biệt là các công nghệ mới của CMCN 4.0)
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12 textarea-h">
                            <div>
                                <?php
                                echo htmlspecialchars_decode($company['technology_certificate']);
                                ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <strong>2.</strong> Chi phí đầu tư cho hoạt động R&D năm 2019:
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-bordered" >
                              <tr>
                                <th style="width: 200px;">Năm</th>
                                <th>Tổng chi phí <i style="font-weight: 500;">(Triệu VNĐ)</i></th>
                                <th>% trên tổng doanh thu</th>
                              </tr>
                              <tr>
                                <td>2019</td>
                                <td>
                                    <?php 
                                        echo form_input('investment_fund_r_and_d', set_value('investment_fund_r_and_d',$company['investment_fund_r_and_d']), 'class="form-control"'); 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo form_input('investment_fund_r_and_d_percent', set_value('investment_fund_r_and_d_percent',$company['investment_fund_r_and_d_percent']), 'class="form-control"'); 
                                    ?>
                                </td>
                              </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group h5 m-l-30 m-l-30 text_input">
                    <div><strong>3.</strong> Số lượng nhân viên bộ phận R&D năm 2019: </div>
                    <div>
                        
                        <?php 
                            echo form_input('staff_r_and_d', set_value('staff_r_and_d',$company['staff_r_and_d']), 'class="form-control"'); 
                        ?>
                        người.
                    </div>
                </div>

                
                <div class="form-group h5 m-l-30 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;padding-top:10px;">
                            <strong>4.</strong> Thành quả nổi bật của hoạt động R&D năm 2019:
                        </div>
                        <div class="col-xs-12 textarea-h">
                            <div>
                                <?php
                                echo htmlspecialchars_decode($company['result_r_and_d']);
                                ?></div>
                        </div>
                    </div>
                </div>

                
                <div class="form-group">
                    <strong>5.</strong> Chế độ bảo mật của công ty và bảo mật cho khách hàng:
                </div>
                <div style="padding-left: 25px;">
                    <div class="form-group h5 m-l-30">
                        <div class="row">
                            <div class="col-xs-12" style="padding-bottom: 15px;padding-top:10px;">
                                <strong>a.</strong> Các chứng chỉ bảo mật – nếu có (nêu loại chứng chỉ đạt được, tổ chức cấp chứng chỉ, thời gian được cấp chứng chỉ,…. tối đa 100 từ)
                            </div>
                            <div class="col-xs-12 textarea-h">
                                <div>
                                    <?php
                                        echo htmlspecialchars_decode($company['security_certificate']);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group h5 m-l-30">
                        <div class="row">
                            <div class="col-xs-12" style="padding-bottom: 15px;padding-top:10px;">
                                <strong>b.</strong> Các quy trình/các biện pháp an ninh, bảo mật cơ sở dữ liệu và thông tin của công ty (tối đa 100 từ):
                            </div>

                            <div class="col-xs-12 textarea-h">
                                <div>
                                    <?php
                                        echo htmlspecialchars_decode($company['security_process']);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="form-group">
                    <strong>6.</strong> Năng lực quản lý, chất lượng: (Các chứng chỉ về quản lý, quy trình, chất lượng)
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12 textarea-h">
                            <div>
                                <?php
                                    echo htmlspecialchars_decode($company['technique_certificate']);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <strong>7.</strong> Các chứng chỉ năng lực đặc thù của lĩnh vực hoạt động (nếu có):
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12 textarea-h">
                            <div>
                                <?php
                                    echo htmlspecialchars_decode($company['specific_certificate']);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <h3 style="text-transform: uppercase;">VI. Các giải thưởng, danh hiệu, hoạt động CSR</h3>
                </div>

                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;padding-top:10px;">
                            (Ghi rõ tên, thời gian nhận Giải thưởng, Danh hiệu và thành tích được công nhận trong các hoạt động thể hiện trách nhiệm với xã hội của doanh nghiệp (CSR))
                        </div>
                        <div class="col-xs-12 textarea-h">
                            <div>
                                <?php
                                    echo htmlspecialchars_decode($company['reward']);
                                ?>
                            </div>
                        </div>

                    </div>
                </div>

                <br>
                <div class="form-group">
                    <h3 style="text-transform: uppercase;">VII. Năng lực gọi vốn (dành riêng cho các DN Startup):</h3>
                </div>
                
                <div class="form-group h5 m-l-30 m-l-30 text_input" style='display: block!important;clear: both;'>
                    <div><strong>1.</strong> Số lượng vốn gọi được </div>
                    <div>
                        <?php 
                            echo form_input('startup_amount_capital', set_value('startup_amount_capital',$company['startup_amount_capital']), 'class="form-control"'); 
                        ?>
                    </div>
                </div>
                <div class="form-group h5 m-l-30 m-l-30 text_input" style='display: block!important;clear: both;'>
                    <div><strong>2.</strong> Số nhà đầu tư </div>
                    <div>
                        <?php 
                            echo form_input('startup_number_investors', set_value('startup_number_investors',$company['startup_number_investors']), 'class="form-control"'); 
                        ?>
                    </div>
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;padding-top:10px;">
                            <strong>3.</strong>  Kế hoạch gọi vốn trong tương lai:
                        </div>
                        <div class="col-xs-12 textarea-h">
                            <div>
                                <?php
                                    echo htmlspecialchars_decode($company['startup_plan_capital_future']);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;padding-top:10px;">
                            <strong>4.</strong>  Kế hoạch IPO:
                        </div>

                        <div class="col-xs-12 textarea-h">
                            <div>
                                <?php
                                echo htmlspecialchars_decode($company['startup_plan_ipo']);
                                ?></div>
                        </div>
                    </div>
                </div>



                
                <div class="row">
                    <?php if($reg_status['is_final'] == 0): ?>
                            <div class="col-xs-12 col-md-2 pull-left">
                                <a href="<?php echo base_url('client/information/company'); ?>" class="btn btn-default btn-block"><b>Quay lại</b></a>
                            </div>
                            <div class="col-xs-12 col-md-2 pull-left">
                                <a style="width:132px;" href="<?php echo base_url('client/information/edit_company?year=' . $year); ?>" class="btn btn-primary btn-block">Sửa thông tin</a>
                            </div>
                            <?php if($eventYear == $company['year']){ ?>
                            <div class="col-xs-12 col-md-6 pull-left">
                                <a class="btn btn-primary" onclick="return openModals();" href="#">
                        
                                    <b>HOÀN THÀNH/ LƯU THÔNG TIN</b>
                                </a>
                            </div>
                            <?php } ?>
                    <?php else: ?>
                    <h4 style="color:red">Thông tin đã được gửi</h4>
                    <?php endif; ?>
                </div>


                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>

    <div id="myModalSidebars" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 630px !important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc">
                    <!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <h4 style="color:white;">Cảm ơn Quý Công ty đã đăng ký tham gia Chương trình Top 10 Doanh nghiệp CNTT Việt Nam <?php echo !empty($eventYear) ? $eventYear : ''; ?>.</h4>
                </div>
                <div class="modal-body">
                    <h4 style="font-weight:bold !important;">Mời quay lại trang Tổng quan để xem lại hồ sơ/ nộp cho Ban tổ chức</h4>
                </div>
                <div class="modal-footer">
                    <a data-dismiss="modal" class="btn btn-warning pull-left"><b>Đóng</b></a>
                    <a href="<?php echo base_url() ?>client/dashboard?complete=1" class="btn btn-primary pull-right"><b>Đến trang tổng quan</b></a>
                </div>
            </div>

        </div>
    </div>
    <script>
        function openModals(){
            $('#myModalSidebars').modal('show');
        }
    </script>
<script type="text/javascript">
    $('.domestic-checkbox #checkbox_anonymous_domestic').click(function(){
        if ($(this).prop("checked") == true) {
            $('.domestic-checkbox #anonymous_domestic').slideDown();
        }else{
            $('.domestic-checkbox #anonymous_domestic').slideUp();
        }
    });
    if ($('.domestic-checkbox #checkbox_anonymous_domestic').prop("checked") == true) {
        $('.domestic-checkbox #anonymous_domestic').slideDown();
    }else{
        $('.domestic-checkbox #anonymous_domestic').slideUp();
    }
    $('.domestic-checkbox #anonymous_domestic').change(function(){
        let anonymous_domestic = $(this).val();
        $('#checkbox_anonymous_domestic').val(anonymous_domestic);
    });

    $('.tab-content input').attr('readonly','readonly');
    $('.tab-content textarea').attr('readonly','readonly');
    textarea_h = $('.textarea-h');
    for (var i = 0; i < textarea_h.length; i++) {
        console.log($(textarea_h[i]).html().trim().length);
        if ($(textarea_h[i]).find('>div').html().trim().length > 0) {
            $(textarea_h[i]).find('>div').css({'background':'#eee','color':'#555!important','padding':'10px'});
        }else{
            $(textarea_h[i]).find('>div').html('<div style="text-align:center">--------------------------------------------------------------------------------------------------------</div>');
        }
    }
</script>

<script>
    input = $('input');
    for (var i = 0; i < input.length; i++) {
        $(input[i]).val($(input[i]).val().replace(/&amp;/g,'&'));
    }
</script>
        