<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo site_url('assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/public/css/homepage.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/admin/css/user.css'); ?>">
    <title>Document</title>
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
                <div class="alert alert-success alert-dismissible" role="alert">
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
                <div>
                    <div class="col-lg-4 col-lg-offset-4">
                        <?php echo $this->session->flashdata('message'); ?>
                        <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <h1>Đăng nhập</h1>
                            <h5>Dành cho thành viên hội đồng</h5>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Tài khoản', 'identity'); ?>
                            <?php echo form_error('identity', '<div class="error">', '</div>'); ?>
                            <?php echo form_input('identity', '', 'class="form-control"'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Mật khẩu', 'password'); ?>
                            <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                            <?php echo form_password('password', '', 'class="form-control"'); ?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <?php echo form_submit('login', 'Đăng nhập', 'class="btn btn-primary btn-lg" style="width:100%;"'); ?>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <a href="<?= base_url('member/user/forgot_password') ?>" class="btn btn-warning btn-lg pull-right" >Quên mật khẩu</a>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </section>
        </div>
    </section>
</section>
<script src="<?= base_url('assets/admin/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

</body>
</html>