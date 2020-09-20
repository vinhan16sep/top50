<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo site_url('assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/public/css/homepage.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/admin/css/user.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/admin/css/css.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/admin/datetimepicker/bootstrap-datetimepicker.css'); ?>">
    <title>Đăng nhập / Đăng ký</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo site_url('assets/public/img/favicon.png'); ?>"/>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="content-wrapper main_content" style="min-height: 916px; margin-left: 0px !important;">
            <?php if ($this->session->flashdata('login_message_error')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Thông báo!</strong> <?php echo $this->session->flashdata('login_message_error'); ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('register_success')): ?>
                <div class="alert alert-success alert-dismissible" role="alert" style="color:#ffffff !important;background-color: #3c763d !important;font-size: 13pt !important;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Thông báo!</strong> <?php echo $this->session->flashdata('register_success'); ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('auth_message')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Thông báo!</strong> <?php echo $this->session->flashdata('auth_message'); ?>
                </div>
            <?php endif ?>

            <section class="content row">
                <div class="col-sm-6 col-md-6 col-xs-12">
                    <div class="col-lg-8 col-lg-offset-2">

                        <?php echo form_open('client/user/login', array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <h1>Đăng nhập</h1>
                            <h5>Dành cho doanh nghiệp</h5>
                        </div>

                        <div class="form-group">
                            <?php echo form_label('Tài khoản', 'identity'); ?>
                            <p>Có thể sử dụng Email hoặc Mã số thuế</p>
                            <?php echo form_error('identity', '<div class="error">', '</div>'); ?>
                            <?php echo form_input('identity', '', 'class="form-control" placeholder="Username hoặc E-Mail" '); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Mật khẩu', 'password'); ?>
                            <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                            <?php echo form_password('password', '', 'class="form-control"'); ?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <?php echo form_submit('login', 'Đăng nhập', 'class="btn btn-warning btn-lg" style="width:100%;"'); ?>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <a href="<?= base_url('client/user/forgot_password') ?>" style="font-size:17px;" >Quên mật khẩu</a>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-xs-12">
                    <div class="col-lg-8 col-lg-offset-2 class-register">
                        <?php echo $this->session->flashdata('message'); ?>
                        <?php echo form_open('client/user/register', array('class' => 'form-horizontal', 'id' => 'login-form')); ?>
                        <div class="form-group">
                            <h4>Doanh nghiệp chưa có tài khoản?</h4>
                            <h1>Đăng ký mới</h1>
                            <p>
                                <i>Điều kiện tham gia chương trình: Doanh nghiệp phải thành lập theo pháp luật Việt Nam, Thời gian thành lập từ 03 năm trở lên.
                                Chi tiết xem tại <a href="http://top10ict.com/the-le-chuong-trinh/" target="_blank" style="font-weight: bold;">THỂ LỆ</a> chương trình </i>

                            </p>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Công ty: ', 'companyname'); ?>
                            <?php echo form_error('companyname', '<div class="error">', '</div>'); ?>
                            <?php echo form_input('companyname', set_value('companyname'), 'class="form-control" style="border: orange 1px solid;"'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Mã số thuế: ', 'username'); ?>
                            <?php echo form_error('username', '<div class="error">', '</div>'); ?>
                            <?php echo form_input('username', set_value('username'), 'class="form-control" style="border: orange 1px solid;"'); ?>
                        </div>
                        <div class="form-group">
                            <?php  
                                echo form_label('Ngày thành lập doanh nghiệp: ', 'founding_date');
                                echo form_error('founding_date', '<div class="error">', '</div>');
                            ?>
                            <div class="input-group date"  id="datetimepicker7" >
                                <?php
                                echo form_input('founding_date', set_value('founding_date'), 'class="form-control"  ');
                                ?>
                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_label('Email: ', 'email'); ?>
                            <span class="label label-primary email-note">Hệ thống sẽ gửi email kích hoạt tài khoản về địa chỉ email này</span>
                            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                            <?php echo form_input('email', set_value('email'), 'class="form-control" style="border: orange 1px solid;"'); ?>

                        </div>
                        <div class="form-group">
                            <?php echo form_label('Số điện thoại: ', 'phone'); ?>
                            <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
                            <?php echo form_input('phone', set_value('phone'), 'class="form-control" style="border: orange 1px solid;"'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Mật khẩu: ', 'register_password'); ?>
                            <?php echo form_error('register_password', '<div class="error">', '</div>'); ?>
                            <?php echo form_password('register_password', '', 'class="form-control" style="border: orange 1px solid;"'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Xác nhận mật khẩu: ', 'password_confirm'); ?>
                            <?php echo form_error('password_confirm', '<div class="error">', '</div>'); ?>
                            <?php echo form_password('password_confirm', '', 'class="form-control" style="border: orange 1px solid;"'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_submit('register', 'Đăng ký', 'class="btn btn-danger btn-lg btn-block"'); ?>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </section>
        </div>
    </section>
</section>

<div class="mobile-hotline-fixed one">
    <a href="tel:0936136696" title="Hỗ trợ kỹ thuật">
        <span class="value">Hỗ trợ kỹ thuật: 0936136696</span>
    </a>
</div>
<div class="mobile-hotline-fixed">
    <a href="tel:0913196699" title="Tư vấn hồ sơ">
        <span class="value">Tư vấn hồ sơ: 0913196699</span>
    </a>
</div>


<script src="<?= base_url('assets/admin/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo site_url('assets/admin/'); ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Jquery validate -->
<script src="<?php echo site_url('assets/admin/'); ?>bower_components/jquery/src/jquery.validate.js"></script>
<script src="<?= base_url('assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/datetimepicker/moment.js') ?>"></script>
<script src="<?= base_url('assets/admin/datetimepicker/bootstrap-datetimepicker.js') ?>"></script>
<script>
    $('#login-form').validate({
        rules: {
            companyname: {
                required: true
            },
            username: {
                required: true,
                identityFormat: true,
                minlength: 10,
                maxlength: 13
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 11
            },
            register_password: {
                required: true,
                minlength: 8,
            },
            password_confirm: {
                required: true,
                minlength: 8,
            }
        },
        messages :{
            companyname: {
                required: 'Không được để trống'
            },
            username: {
                required: 'Không được để trống',
                minlength: 'Phải lớn hơn 10 ký tự',
                maxlength: 'Phải nhỏ hơn 13 ký tự'
            },
            email: {
                required : 'Không được để trống',
                email: 'Sai định dạng email'
            },
            phone: {
                required : 'Không được để trống',
                number: 'Phải là số',
                minlength: 'Phải lớn hơn 9 ký tự',
                maxlength: 'Phải nhỏ hơn 12 ký tự'
            },
            register_password: {
                required: 'Không được để trống',
                minlength: 'Phải lớn hơn 8 ký tự',
            },
            password_confirm: {
                required: 'Không được để trống',
                minlength: 'Phải lớn hơn 8 ký tự',
            }
        }
    });

    $.validator.addMethod("identityFormat", function(value, element) {
        return this.optional(element) || /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/i.test(value);
    }, "Chỉ chứa số và dấu -");
    $('.email-note').attr('style','display:none;');
    $('.class-register [name="email"]').focus(function(){
        $('.email-note').attr('style','display:inline-block;font-size: 14px;');
    });
    $('.class-register [name="email"]').focusout(function(){
        $('.email-note').attr('style','display:none;');
    });
    $(document).ready(function(){
        $('#datetimepicker7').datetimepicker({
            format: 'DD/MM/Y',
            useCurrent: false,
            maxDate: '01/01/2018',
            defaultDate: '01/01/2018',
        });
    });
</script>

</body>
</html>
