<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    div.error{
        background: #FE2E2E;
        color: #fff;
        padding: 5px 10px;
        padding-right:0px;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: table;
        border-left: 5px solid #ccc;
        margin-top:5px;
        cursor: pointer;
    }
    div.error .fa.fa-times{
        padding: 5px;
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
    .show-error-all{
        margin-bottom:10px;
    }
    .tables-css{
        margin-top: 15px;
    }
    .tables-css td{
        line-height: 30px!important;
        font-weight: initial!important;
        text-align: left!important;
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row modified-mode">
            <div class="col-lg-10 col-lg-offset-0">
                <div class="form-group">
                    <h1 style="text-align:center;">THÔNG TIN LĨNH VỰC ỨNG CỬ</h1>
                </div>
                <?php
                echo form_open_multipart(base_url('client/information/edit_company?year=' . $eventYear), array('class' => 'form-horizontal', 'id' => 'company-form'));
                ?>

                <!-- ERROR -->
                <div class="show-error-all">
                    <?php  
                        // add field 25/08/2020
                        echo form_error('proportion_market_local', '<div class="error" data-name="proportion_market_local">', '</div>');
                        echo form_error('proportion_market_europe', '<div class="error" data-name="proportion_market_europe">', '</div>');
                        echo form_error('proportion_market_america', '<div class="error" data-name="proportion_market_america">', '</div>');
                        echo form_error('proportion_market_japan', '<div class="error" data-name="proportion_market_japan">', '</div>');
                        echo form_error('proportion_market_other_international', '<div class="error" data-name="proportion_market_other_international">', '</div>');


                        echo form_error('overview', '<div class="error" data-name="overview">', '</div>');
                        echo form_error('product', '<div class="error" data-name="product">', '</div>');
                        echo form_error('main_service[]', '<div class="error" data-name="main_service[]">', '</div>');
                        echo form_error('anonymous-service', '<div class="error" data-name="service">', '</div>');
                        echo form_error('main_market[]', '<div class="error" data-name="main_market[]">', '</div>');
                        echo form_error('anonymous', '<div class="error" data-name="anonymous">', '</div>');

                        echo form_error('equity_1', '<div class="error" data-name="equity_1">', '</div>');
                        echo form_error('equity_percent_1', '<div class="error" data-name="equity_percent_1">', '</div>');
                        echo form_error('equity_2', '<div class="error" data-name="equity_2">', '</div>');
                        echo form_error('equity_percent_2', '<div class="error" data-name="equity_percent_2">', '</div>');
                        echo form_error('owner_equity_1', '<div class="error" data-name="owner_equity_1">', '</div>');
                        echo form_error('owner_equity_percent_1', '<div class="error" data-name="owner_equity_percent_1">', '</div>');
                        echo form_error('owner_equity_2', '<div class="error" data-name="owner_equity_2">', '</div>');
                        echo form_error('owner_equity_percent_2', '<div class="error" data-name="owner_equity_percent_2">', '</div>');
                        echo form_error('total_assets_1', '<div class="error" data-name="total_assets_1">', '</div>');
                        echo form_error('total_assets_percent_1', '<div class="error" data-name="total_assets_percent_1">', '</div>');
                        echo form_error('total_assets_2', '<div class="error" data-name="total_assets_2">', '</div>');
                        echo form_error('total_assets_percent_2', '<div class="error" data-name="total_assets_percent_2">', '</div>');

                        echo form_error('total_income_1', '<div class="error" data-name="total_income_1">', '</div>');
                        echo form_error('total_income_percent_1', '<div class="error" data-name="total_income_percent_1">', '</div>');
                        echo form_error('total_income_2', '<div class="error" data-name="total_income_2">', '</div>');
                        echo form_error('total_income_percent_2', '<div class="error" data-name="total_income_percent_2">', '</div>');
                        echo form_error('total_income_6_months', '<div class="error" data-name="total_income_6_months">', '</div>');
                        echo form_error('per_capita_income_1', '<div class="error" data-name="per_capita_income_1">', '</div>');
                        echo form_error('per_capita_income_percent_1', '<div class="error" data-name="per_capita_income_percent_1">', '</div>');
                        echo form_error('per_capita_income_2', '<div class="error" data-name="per_capita_income_2">', '</div>');
                        echo form_error('per_capita_income_percent_2', '<div class="error" data-name="per_capita_income_percent_2">', '</div>');
                        echo form_error('per_capita_income_6_months', '<div class="error" data-name="per_capita_income_6_months">', '</div>');
                        echo form_error('software_income_1', '<div class="error" data-name="software_income_1">', '</div>');
                        echo form_error('software_income_percent_1', '<div class="error" data-name="software_income_percent_1">', '</div>');
                        echo form_error('software_income_2', '<div class="error" data-name="software_income_2">', '</div>');
                        echo form_error('software_income_percent_2', '<div class="error" data-name="software_income_percent_2">', '</div>');
                        echo form_error('software_income_6_months', '<div class="error" data-name="software_income_6_months">', '</div>');
                        echo form_error('it_income_1', '<div class="error" data-name="it_income_1">', '</div>');
                        echo form_error('it_income_percent_1', '<div class="error" data-name="it_income_percent_1">', '</div>');
                        echo form_error('it_income_2', '<div class="error" data-name="it_income_2">', '</div>');
                        echo form_error('it_income_percent_2', '<div class="error" data-name="it_income_percent_2">', '</div>');
                        echo form_error('it_income_6_months', '<div class="error" data-name="it_income_6_months">', '</div>');
                        echo form_error('export_income_1', '<div class="error" data-name="export_income_1">', '</div>');
                        echo form_error('export_income_percent_1', '<div class="error" data-name="export_income_percent_1">', '</div>');
                        echo form_error('export_income_2', '<div class="error" data-name="export_income_2">', '</div>');
                        echo form_error('export_income_percent_2', '<div class="error" data-name="export_income_percent_2">', '</div>');
                        echo form_error('export_income_6_months', '<div class="error" data-name="export_income_6_months">', '</div>');
                        echo form_error('international_income_1', '<div class="error" data-name="international_income_1">', '</div>');
                        echo form_error('international_income_percent_2', '<div class="error" data-name="international_income_percent_2">', '</div>');
                        echo form_error('international_income_1', '<div class="error" data-name="international_income_1">', '</div>');
                        echo form_error('international_income_percent_2', '<div class="error" data-name="international_income_percent_2">', '</div>');
                        echo form_error('international_income_6_months', '<div class="error" data-name="international_income_6_months">', '</div>');
                        echo form_error('domestic_income_1', '<div class="error" data-name="domestic_income_1">', '</div>');
                        echo form_error('domestic_income_percent_1', '<div class="error" data-name="domestic_income_percent_1">', '</div>');
                        echo form_error('domestic_income_2', '<div class="error" data-name="domestic_income_2">', '</div>');
                        echo form_error('domestic_income_percent_2', '<div class="error" data-name="domestic_income_percent_2">', '</div>');
                        echo form_error('domestic_income_6_months', '<div class="error" data-name="domestic_income_6_months">', '</div>');
                        echo form_error('before_tax_profit_1', '<div class="error" data-name="before_tax_profit_1">', '</div>');
                        echo form_error('before_tax_profit_percent_1', '<div class="error" data-name="before_tax_profit_percent_1">', '</div>');
                        echo form_error('before_tax_profit_2', '<div class="error" data-name="before_tax_profit_2">', '</div>');
                        echo form_error('before_tax_profit_percent_2', '<div class="error" data-name="before_tax_profit_percent_2">', '</div>');
                        echo form_error('before_tax_profit_6_months', '<div class="error" data-name="before_tax_profit_6_months">', '</div>');

                        echo form_error('full_time_employee', '<div class="error" data-name="full_time_employee">', '</div>');
                        echo form_error('average_age', '<div class="error" data-name="average_age">', '</div>');
                        echo form_error('employee_change_percent_1', '<div class="error" data-name="employee_change_percent_1">', '</div>');
                        echo form_error('employee_change_percent_2', '<div class="error" data-name="employee_change_percent_2">', '</div>');
                        echo form_error('employee_change_percent_3', '<div class="error" data-name="employee_change_percent_3">', '</div>');
                        echo form_error('english_employee', '<div class="error" data-name="english_employee">', '</div>');
                        echo form_error('english_employee_percent', '<div class="error" data-name="english_employee_percent">', '</div>');
                        echo form_error('japanese_employee', '<div class="error" data-name="japanese_employee">', '</div>');
                        echo form_error('japanese_employee_percent', '<div class="error" data-name="japanese_employee_percent">', '</div>');
                        echo form_error('other_language_employee', '<div class="error" data-name="other_language_employee">', '</div>');
                        echo form_error('other_language_employee_percent', '<div class="error" data-name="other_language_employee_percent">', '</div>');
                        echo form_error('other_language', '<div class="error" data-name="other_language">', '</div>');


                        echo form_error('qualification', '<div class="error" data-name="qualification">', '</div>');
                        echo form_error('average_salary', '<div class="error" data-name="average_salary">', '</div>');
                        echo form_error('customer_supporter', '<div class="error" data-name="customer_supporter">', '</div>');
                        echo form_error('training_process', '<div class="error" data-name="training_process">', '</div>');
                        echo form_error('recruitment_staff', '<div class="error" data-name="recruitment_staff">', '</div>');
                        echo form_error('recruitment_budget', '<div class="error" data-name="recruitment_budget">', '</div>');
                        echo form_error('investment_fund_r_and_d', '<div class="error" data-name="investment_fund_r_and_d">', '</div>');
                        echo form_error('investment_fund_r_and_d_percent', '<div class="error" data-name="investment_fund_r_and_d_percent">', '</div>');
                        echo form_error('staff_r_and_d', '<div class="error" data-name="staff_r_and_d">', '</div>');
                        echo form_error('result_r_and_d', '<div class="error" data-name="result_r_and_d">', '</div>');
                        echo form_error('security_certificate', '<div class="error" data-name="security_certificate">', '</div>');
                        echo form_error('security_process', '<div class="error" data-name="security_process">', '</div>');
                        echo form_error('technique_certificate', '<div class="error" data-name="technique_certificate">', '</div>');
                        echo form_error('top5_customers', '<div class="error" data-name="top5_customers">', '</div>');


                    ?>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-sx-12">
                            <strong style="font-size: 16px;">Lĩnh vực bình chọn: Doanh nghiệp lựa chọn các lĩnh vực là thế mạnh của công ty trong 15 lĩnh vực sau đây để làm hồ sơ đăng ký tham gia. Mỗi doanh nghiệp được đăng ký tối đa 03 lĩnh vực.</strong>
                        </div>
                        <div class="col-sm-12 col-md-12 col-sx-12" id="max-3-chechbox">
                            <div class="show-message"></div>
                            <?php  
                                $company['group'] = (array)json_decode($company['group'], true);
                            ?>
                            <div class="row">
                                <?php foreach ($groups as $key => $value): ?>
                                    <div class="col-md-6 checkbox">
                                        <label>
                                            <?php echo form_checkbox('group[]', $key, in_array($key, $company['group']) ? true: false); ?> <?php echo $value ?>
                                        </label>
                                    </div>
                                <?php endforeach ?>  
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <h3>I. GIỚI THIỆU CHUNG VỀ DOANH NGHIỆP</h3>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Giới thiệu doanh nghiệp (viết ngắn gọn, giới thiệu doanh nghiệp, ngành nghề kinh doanh chính, thế mạnh của DN, sự khác biệt so với đối thủ cạnh tranh, đồng thời nêu rõ định hướng và mục tiêu phát triển doanh nghiệp, tối đa 250 từ)', 'overview');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_textarea('overview', strip_tags(htmlspecialchars_decode(set_value('overview', $company['overview']))), 'class="form-control"');
                                ?>
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
                        <div class="col-xs-12">
                             <?php
                                echo form_textarea('training_process', htmlspecialchars_decode(set_value('training_process',$company['training_process'])), 'class="form-control tinymce-area"');
                            ?>
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


                <div class="form-group">
                    <h3 style="text-transform: uppercase;">IV. Sản phẩm, dịch vụ, giải pháp, thị trường và khách hàng</h3>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <strong>1.</strong> Tên các sản phẩm, dịch vụ chính của doanh nghiệp
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-sx-12">
                            <?php
                            echo form_textarea('product', htmlspecialchars_decode(set_value('product', $company['product'])), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-sx-12">
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
                                            echo form_checkbox('main_service[]', $value, (in_array($value, $main_service, '')? true : false), 'class="btn-checkbox"');
                                            echo $key.'<br>';
                                        }else{
                                            echo form_checkbox('main_service[]', $value, false, 'class="btn-checkbox"');
                                            echo $key.'<br>';
                                        }
                                    echo '</div>';
                                }
                            echo '</div>';

                            // echo form_dropdown('main_service', $options, '', 'class="form-control"');
                            if($check_main_service){
                                if($new_check_main_service[0] != ''){
                                    echo form_checkbox('main_service[]', $new_check_main_service[0], true, 'class="btn-checkbox" id="anonymous-service"');
                                    echo 'Khác (nêu rõ)<br>';
                                }else{
                                    echo form_checkbox('main_service[]', '', false, 'class="btn-checkbox" id="anonymous-service"');
                                    echo 'Khác (nêu rõ)<br>';
                                }
                            }else{
                                echo form_checkbox('main_service[]', '', false, 'class="btn-checkbox" id="anonymous-service"');
                                echo 'Khác (nêu rõ)<br>';
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
                <div class="form-group">
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
                                        echo form_checkbox('main_market[]', $value, (in_array($value, $main_market, '')? true : false), 'class="btn-checkbox"');
                                        echo $key.'<br>';
                                    }else{
                                        echo form_checkbox('main_market[]', $value, false, 'class="btn-checkbox"');
                                        echo $key.'<br>';
                                    }
                                }
                                echo form_checkbox('main_market[khac]', (!empty($main_market['khac']) ? $main_market['khac'] : ''), (!empty($main_market['khac'])? true : false), 'class="btn-checkbox" id="checkbox_anonymous_domestic"');
                                        echo 'Khác (nêu rõ)<br>';
                                ?>

                                <input type="text" id="anonymous_domestic" name="anonymous_domestic" value="<?php echo !empty($main_market['khac']) ? $main_market['khac'] : ''; ?>" class="input-anonymous_domestic form-control" style="display: none;">
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
                                <br>
                                <?php
                                if(!is_null($main_market) && $main_market != null){
                                    echo form_checkbox('main_market[]', 'Xuất khẩu SP/Giải pháp/Dịch vụ', (in_array('Xuất khẩu SP/Giải pháp/Dịch vụ', $main_market, '')? true : false), 'class="btn-checkbox"');
                                    echo 'Xuất khẩu SP/Giải pháp/Dịch vụ';
                                }else{
                                    echo form_checkbox('main_market[]', 'Xuất khẩu SP/Giải pháp/Dịch vụ', false, 'class="btn-checkbox"');
                                    echo 'Xuất khẩu SP/Giải pháp/Dịch vụ';
                                }
                                ?>
                                <br>
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
                            <div style="margin-left: 20px;margin-top: 5px;margin-bottom: 5px;">
                                <strong>Thị trường xuất khẩu mục tiêu</strong><br>
                                <div style="padding-left: 35px;">
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
                                            echo form_checkbox('main_market[]', $new_check[0], true, 'class="btn-checkbox" id="anonymous"');
                                            echo 'Khác (nêu rõ)<br>';
                                        }else{
                                            echo form_checkbox('main_market[]', '', false, 'class="btn-checkbox" id="anonymous"');
                                            echo 'Khác (nêu rõ)<br>';
                                        }
                                    }else{
                                        echo form_checkbox('main_market[]', '', false, 'class="btn-checkbox" id="anonymous"');
                                        echo 'Khác (nêu rõ)<br>';
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
                </div>

                <div class="form-group">
                    <strong>5.</strong> Giới thiệu tóm tắt 05 khách hàng/dự án tiêu biểu doanh nghiệp đã thực hiện: 
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-sx-12">
                            <?php
                            echo form_textarea('top5_customers', htmlspecialchars_decode(set_value('top5_customers', $company['top5_customers'])), 'class="form-control tinymce-area"');
                            ?>
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
                        <div class="col-xs-12">
                            <?php
                                echo form_textarea('technology_certificate', htmlspecialchars_decode(set_value('technology_certificate', $company['technology_certificate'])), 'class="form-control"');
                            ?>
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
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            <strong>4.</strong> Thành quả nổi bật của hoạt động R&D năm 2019:
                        </div>
                        <div class="col-xs-12">
                             <?php
                                echo form_textarea('result_r_and_d', htmlspecialchars_decode(set_value('result_r_and_d',$company['result_r_and_d'])), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>

                
                <div class="form-group">
                    <strong>5.</strong> Chế độ bảo mật của công ty và bảo mật cho khách hàng:
                </div>
                <div style="padding-left: 25px;">
                    <div class="form-group h5 m-l-30">
                        <div class="row">
                            <div class="col-xs-12" style="padding-bottom: 15px;">
                                <strong>a.</strong> Các chứng chỉ bảo mật – nếu có (nêu loại chứng chỉ đạt được, tổ chức cấp chứng chỉ, thời gian được cấp chứng chỉ,…. tối đa 100 từ)
                            </div>
                            <div class="col-xs-12">
                                 <?php
                                    echo form_textarea('security_certificate', strip_tags(htmlspecialchars_decode(set_value('security_certificate',$company['security_certificate']))), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group h5 m-l-30">
                        <div class="row">
                            <div class="col-xs-12" style="padding-bottom: 15px;">
                                <strong>b.</strong> Các quy trình/các biện pháp an ninh, bảo mật cơ sở dữ liệu và thông tin của công ty (tối đa 100 từ):
                            </div>
                            <div class="col-xs-12">
                                 <?php
                                    echo form_textarea('security_process', strip_tags(htmlspecialchars_decode(set_value('security_process',$company['security_process']))), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="form-group">
                    <strong>6.</strong> Năng lực quản lý, chất lượng: (Các chứng chỉ về quản lý, quy trình, chất lượng)
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12">
                             <?php
                                echo form_textarea('technique_certificate', htmlspecialchars_decode(set_value('technique_certificate', $company['technique_certificate'])), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <strong>7.</strong> Các chứng chỉ năng lực đặc thù của lĩnh vực hoạt động (nếu có):
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12">
                             <?php
                                echo form_textarea('specific_certificate', htmlspecialchars_decode(set_value('specific_certificate', $company['specific_certificate'])), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <h3 style="text-transform: uppercase;">VI. Các giải thưởng, danh hiệu, hoạt động CSR</h3>
                </div>

                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            <?php
                            echo form_label('(Ghi rõ tên, thời gian nhận Giải thưởng, Danh hiệu và thành tích được công nhận trong các hoạt động thể hiện trách nhiệm với xã hội của doanh nghiệp (CSR))', 'reward');
                            ?>
                        </div>
                        <div class="col-xs-12">
                            <?php
                            echo form_textarea('reward', htmlspecialchars_decode(set_value('reward', $company['reward'])), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>

                <br>
                <div class="form-group">
                    <h3 style="text-transform: uppercase;">VII. Năng lực gọi vốn (dành riêng cho các DN Startup):</h3>
                </div>
                
                <div class="form-group h5 m-l-30 m-l-30 text_input">
                    <div><strong>1.</strong> Số lượng vốn gọi được </div>
                    <div>
                        <?php 
                            echo form_input('startup_amount_capital', set_value('startup_amount_capital',$company['startup_amount_capital']), 'class="form-control"'); 
                        ?>
                    </div>
                </div>
                <div class="form-group h5 m-l-30 m-l-30 text_input">
                    <div><strong>2.</strong> Số nhà đầu tư </div>
                    <div>
                        <?php 
                            echo form_input('startup_number_investors', set_value('startup_number_investors',$company['startup_number_investors']), 'class="form-control"'); 
                        ?>
                    </div>
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            <strong>3.</strong>  Kế hoạch gọi vốn trong tương lai:
                        </div>
                        <div class="col-xs-12">
                            <?php
                            echo form_textarea('startup_plan_capital_future', htmlspecialchars_decode(set_value('startup_plan_capital_future', $company['startup_plan_capital_future'])), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            <strong>4.</strong>  Kế hoạch IPO:
                        </div>
                        <div class="col-xs-12">
                            <?php
                            echo form_textarea('startup_plan_ipo', htmlspecialchars_decode(set_value('startup_plan_ipo', $company['startup_plan_ipo'])), 'class="form-control tinymce-area"');
                            ?>
                        </div>
                    </div>
                </div>

                <br>
                <div class="form-check confirm" style="padding-left:100px;">
                    <h4 class="">CHÚNG TÔI ĐÃ NGHIÊN CỨU KỸ</h4>
                    <?php echo form_checkbox('checkone', '1', FALSE,'data-href="http://top10ict.com/the-le-chuong-trinh/" id="checkone"'); ?>
                    <?php echo form_label('Thể lệ của chương trình', 'checkone','class="form-check-label"'); ?>
                </div>
                <div class="form-check confirm" style="padding-left:100px;">
                    <?php echo form_checkbox('checktwo', '1', FALSE,'data-href="http://top10ict.com/kinh-phi/" id="checktwo"'); ?>
                    <?php echo form_label('Quyết định kinh phí biên tập, in ấn và phát hành Ấn phẩm', 'checktwo','class="form-check-label"'); ?>
                </div>
                <div class="message__" style="padding-left:100px;">
                    <em>Chúng tôi hiểu rõ các quyền lợi, trách nhiệm của mình khi tham gia Chương trình và cam kết tuân thủ Quy chế Chương trình cũng như các qui định của Ban Tổ chức, chịu trách nhiệm về tính trung thực của các thông tin đã khai trong hồ sơ đăng ký tham gia chương trình.</em>
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
    });

    // 12/07/2019
    $('.submit-extra-form').css({'display':'none'});
    $('.confirm input[type="checkbox"]').change(function(){
        if($(this).is(':checked')){
            window.open($(this).attr('data-href'),'_blank');
        }
        if ($('#checkone').is(':checked') && $('#checktwo').is(':checked')) {
            $('.submit-extra-form').css({'display':'block'});
        }else{
            $('.submit-extra-form').css({'display':'none'});
        }
    });

    // quyen
    $('div.error').append('<i class="fa fa-times" aria-hidden="true" title="Xóa thông báo lỗi"></i>');
    $('div.error').attr('title','Click để sửa Field');
    var close = false;
    $('div.error .fa.fa-times').click(function(){
        close = true;
        $(this).parent().fadeOut( "slow");
    });
    $('div.error').click(function(){
        if (close) {
            close = false;
        }else{
            $('[name="'+$(this).attr('data-name')+'"]').focus();
            if (tinyMCE.get($(this).attr('data-name')) != null) {
                tinyMCE.get($(this).attr('data-name')).focus();
            }
            
        }
        
    })
</script>
<script>
    input = $('input');
    for (var i = 0; i < input.length; i++) {
        $(input[i]).val($(input[i]).val().replace(/&amp;/g,'&'));
    }
    

    function check_checkbox($this_click = null){
        let checkbox = $('#max-3-chechbox input[type="checkbox"]:checked');
        if ($this_click) {
            if (checkbox.length > 3) {
                alert('Mỗi doanh nghiệp được đăng ký tối đa 03 lĩnh vực.');
                $($this_click).prop('checked', false);
            }
        }else{
            if (checkbox.length > 3) {
                for(i = 3; i < checkbox.length; i++){
                    $(checkbox[i]).prop('checked', false);
                }
            }
        }
    }
    check_checkbox();
    $('#max-3-chechbox input[type="checkbox"]').change(function(){
        check_checkbox($(this))
    })
</script>