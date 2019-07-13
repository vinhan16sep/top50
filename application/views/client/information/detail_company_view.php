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
    .tab-content input{
        border: 1px solid #fff;
        /*background: #fff!important;*/
    }
    .tab-content input:focus{
        border: 1px solid #fff;
        /*background: #fff!important;*/
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content" style="padding-right: 40px;">
                        <div class="post">
                            <h2 style="text-align:center;">Thông tin doanh nghiệp</h2>
                            <h3 style="color:red; text-align:center;">NĂM <?php echo $company['year']; ?></h3>



                 <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo form_label('Giới thiệu doanh nghiệp (viết ngắn gọn đồng thời nêu rõ định hướng và mục tiêu phát triển doanh nghiệp – tối đa 100 từ)', 'overview');
                            ?>
                        </div>
                        <hr>
                        <div class="col-xs-12">
                                <?php
                                echo $company['overview'];
                                ?>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo form_label('Lĩnh vực hoạt động, nêu rõ điểm mạnh, sự khác biệt của doanh nghiệp so với các đối thủ cạnh tranh (tối đa 100 từ)', 'active_area');
                            ?>
                        </div>
                        <hr>
                        <div class="col-xs-12">
                                <?php
                                echo $company['active_area'];
                                ?>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo form_label('Tên các sản phẩm, dịch vụ chính của doanh nghiệp', 'product');
                            ?>
                        </div>
                        <hr>
                        <div class="col-xs-12">
                                <?php
                                echo $company['product'];
                                ?>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo form_label('Sản phẩm dịch vụ chính của doanh nghiệp', 'main_service');
                            ?>
                        </div>
                        <div class="col-xs-12">
                            <?php if(!empty($company['main_service'])): ?>
                                <?php $main_service = json_decode($company['main_service']) ?>
                                <?php if($main_service): ?>
                                    <?php foreach ($main_service as $key => $value): ?>
                                        <p class="" style="padding-left:20px;"><?php echo $value ?></p>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo form_label('Thị trường chính', 'main_service');
                            ?>
                        </div>
                        <div class="col-xs-12">
                            <?php if(!empty($company['main_market'])): ?>
                                <?php $main_market = json_decode($company['main_market']) ?>
                                <?php if($main_market): ?>
                                    <?php foreach ($main_market as $key => $value): ?>
                                        <p class="" style="padding-left:20px;"><?php echo $value ?></p>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            <?php endif; ?>
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
                            <b>(Cấu trúc nhân sự theo trình độ học vấn, theo các vị trí công việc, các cấp độ kỹ năng, các vị trí chuyên môn,...):</b>
                        </div>
                        <div class="col-xs-12">
                             <?php
                                echo $company['qualification'];
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
                                echo $company['training_process'];
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
                            <b>- Thành quả nổi bật của hoạt động R&D :</b>
                        </div>
                        <div class="col-xs-12">
                             <?php
                                echo $company['result_r_and_d'];
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
                            <b>- Các chứng chỉ bảo mật – nếu có (nêu loại chứng chỉ đạt được, tổ chức cấp chứng chỉ, thời gian được cấp chứng chỉ,…. tối đa 100 từ)</b>
                        </div>
                        <div class="col-xs-12">
                             <?php
                                echo $company['security_certificate'];
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group h5 m-l-30">
                    <div class="row">
                        <div class="col-xs-12" style="padding-bottom: 15px;">
                            <b>- Các quy trình/các biện pháp an ninh, bảo mật cơ sở dữ liệu và thông tin của công ty (tối đa 100 từ):</b>
                        </div>
                        <div class="col-xs-12">
                             <?php
                                echo $company['security_process'];
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
                                echo $company['technique_certificate'];
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <?php if($reg_status['is_final'] == 0): ?>
                            <div class="col-xs-12 col-md-2 pull-left">
                                <a href="<?php echo base_url('client/information/company'); ?>" class="btn btn-default btn-block"><b>Quay lại</b></a>
                            </div>
                            <?php if($eventYear == $company['year']){ ?>
                            <div class="col-xs-12 col-md-4 pull-left">
                                <a href="<?php echo base_url('client/information/edit_company?year=' . $eventYear); ?>" class="btn btn-primary btn-block"><b>Sửa thông tin</b></a>
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
<script type="text/javascript">
    $('.tab-content input').attr('readonly','readonly');
</script>
        