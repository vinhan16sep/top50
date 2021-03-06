<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <?php if ($this->session->flashdata('message_error')): ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Thông báo!</strong> <?php echo $this->session->flashdata('message_error'); ?>
                                </div>
                            <?php endif ?>
                            <div class="form-group">
                                <h2 style="text-align:center;">THÔNG TIN CƠ BẢN CỦA DOANH NGHIỆP</h2>
                                <h3 style="text-align:center;">Mã số thuế: <span style="color:#3c8dbc"><?php echo $identity; ?></span></h3>
                                <h3 style="text-align:center;">Điện thoại đăng ký: <span style="color:#3c8dbc"><?php echo $extra['basic_company']['phone']; ?></span></h3>
                                <h3 style="text-align:center;">Thời gian đăng ký: <span style="color:#3c8dbc"><?php echo date('d-m-Y H:i', $extra['basic_company']['created_on']); ?></span></h3>
                                <div style="margin: auto; width: 100%; text-align: center;">
                                    <?php if ( isset($extra['avatar']) && file_exists('assets/upload/avatar/' . $extra['avatar']) ): ?>
                                        <img src="<?php echo base_url('assets/upload/avatar/') . $extra['avatar']; ?>" class="" alt="user image" width=30%>
                                    <?php else: ?>
                                        <img src="<?php echo site_url('assets/public/img/client.jpg'); ?>" class="" alt="user image" width=30%>
                                    <?php endif ?>
                                    <br>
                                </div>
                            </div>
                            <div class="row modified-mode">
                                <div class="col-lg-10 col-lg-offset-0">
                                    <?php
                                    echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'extra-form'));
                                    ?>
                                    <hr style="padding: 1px 0px; background-color: #fff;">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_label('Tên công ty <span style="color: red">(*)</span>', 'company');
                                                ?>
                                            </div>
                                            <div class="col-sm-9 col-md-9 col-xs-12">
                                                <?php
                                                echo form_error('company', '<div class="error">', '</div>');
                                                echo form_input('company', set_value('company', $extra['basic_company']['company']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="padding: 1px 0px; background-color: #fff;">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_label('Ngày thành lập <span style="color: red">(*)</span>', 'ngaythanhlap');
                                                ?>
                                            </div>
                                            <div class="col-sm-9 col-md-9 col-xs-12">
                                                <?php
                                                echo form_error('founding_date', '<div class="error">', '</div>');
                                                echo form_input('founding_date', set_value('founding_date', ($extra['basic_company']['founding_date']) ? date('d/m/Y', strtotime($extra['basic_company']['founding_date'])) : ''), 'class="form-control datetimepicker7" readonly');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="padding: 1px 0px; background-color: #fff;">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_label('Giấy phép đăng ký kinh doanh số <span style="color: red">(*)</span>', 'giayphepdangky');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('certificate', '<div class="error">', '</div>');
                                                echo form_input('certificate', set_value('certificate', $extra['certificate']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                                                <?php
                                                echo form_label('Ngày cấp <span style="color: red">(*)</span>', 'ngaycap');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('certificate_date', '<div class="error">', '</div>');
                                                echo form_input('certificate_date', set_value('certificate_date', ($extra['certificate_date']) ? date('d/m/Y', strtotime($extra['certificate_date'])) : ''), 'class="form-control datetimepicker7" readonly');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="padding: 1px 0px; background-color: #fff;">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_label('Trụ sở/ Địa chỉ giao dịch thư tín: <span style="color: red">(*)</span>', 'truso');
                                                ?>
                                            </div>
                                            <div class="col-sm-9 col-md-9 col-xs-12">
                                                <?php
                                                echo form_error('headquarters', '<div class="error">', '</div>');
                                                echo form_input('headquarters', set_value('headquarters', $extra['headquarters']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_label('Điện thoại <span style="color: red">(*)</span>', 'dienthoai');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('h_phone', '<div class="error">', '</div>');
                                                echo form_input('h_phone', set_value('h_phone', $extra['h_phone']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                                                <?php
                                                echo form_label('Fax <span style="color: red">(*)</span>', 'fax');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('h_fax', '<div class="error">', '</div>');
                                                echo form_input('h_fax', set_value('h_fax', $extra['h_fax']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_label('Email <span style="color: red">(*)</span>', 'email');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('h_email', '<div class="error">', '</div>');
                                                echo form_input('h_email', set_value('h_email', $extra['h_email']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                                                <?php
                                                echo form_label('Website <span style="color: red">(*)</span>', 'website');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('website', '<div class="error">', '</div>');
                                                echo form_input('website', set_value('website', $extra['website']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <hr style="padding: 1px 0px; background-color: #fff;">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_label('Lãnh đạo <span style="color: red">(*)</span>', 'lanhdao');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('legal_representative', '<div class="error">', '</div>');
                                                echo form_input('legal_representative', set_value('legal_representative', $extra['legal_representative']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                                                <?php
                                                echo form_label('Chức danh <span style="color: red">(*)</span>', 'chucdanh');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('lp_position', '<div class="error">', '</div>');
                                                echo form_input('lp_position', set_value('lp_position', $extra['lp_position']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_label('Email <span style="color: red">(*)</span>', 'email1');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('lp_email', '<div class="error">', '</div>');
                                                echo form_input('lp_email', set_value('lp_email', $extra['lp_email']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                                                <?php
                                                echo form_label('Di động <span style="color: red">(*)</span>', 'didong');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('lp_phone', '<div class="error">', '</div>');
                                                echo form_input('lp_phone', set_value('lp_phone', $extra['lp_phone']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <hr style="padding: 1px 0px; background-color: #fff;">
                                    <div class="form-group">
                                        <div class="row">
                                            <!-- title -->
                                            <div class="col-xs-12">
                                                <?php
                                                echo form_label('Đại diện liên hệ với Ban tổ chức', '');
                                                ?>
                                            </div>


                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_label('Họ tên <span style="color: red">(*)</span>', 'lanhdao1');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('connector', '<div class="error">', '</div>');
                                                echo form_input('connector', set_value('connector', $extra['connector']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                                                <?php
                                                echo form_label('Chức danh <span style="color: red">(*)</span>', 'chucdanh1');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('c_position', '<div class="error">', '</div>');
                                                echo form_input('c_position', set_value('c_position', $extra['c_position']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_label('Email <span style="color: red">(*)</span>', 'email2');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('c_email', '<div class="error">', '</div>');
                                                echo form_input('c_email', set_value('c_email', $extra['c_email']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                                                <?php
                                                echo form_label('Di động <span style="color: red">(*)</span>', 'didong2');
                                                ?>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_error('c_phone', '<div class="error">', '</div>');
                                                echo form_input('c_phone', set_value('c_phone', $extra['c_phone']), 'class="form-control" readonly');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-xs-12">
                                                <?php
                                                echo form_label('Link Phiếu đăng ký: ', 'link');
                                                ?>
                                            </div>
                                            <div class="col-sm-9 col-md-9 col-xs-12">
                                                <?php  echo form_error('link', '<div class="error">', '</div>'); ?>
                                                <div class="input-group link">
                                                    <a target="_blank" href="<?php echo $extra['link'] ?>">Link phiếu đăng ký tại đây</a>
                                                </div>
                    
                                                
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr style="padding: 1px 0px; background-color: #fff;">
                                    <br>
                                    <div class="form-group col-sm-12 text-right submit-extra-form">
                                        <div class="col-sm-3 col-md-3 col-xs-12">
                                        </div>
                                        <div class="col-sm-9 col-md-9 col-xs-12">
                                            <?php
                                            echo form_close();
                                            ?>
                                        </div>
                                    </div>
                                </div>
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
