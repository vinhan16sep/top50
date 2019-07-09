<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo site_url('assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo site_url('assets/admin/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="<?php echo site_url('assets/lib/') ?>ionicons/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="<?php echo site_url('assets/lib/') ?>dist/css/AdminLTE.min.css"> -->
    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="<?php echo site_url('assets/lib/') ?>iCheck/square/blue.css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,700,700i" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <?php if ($this->session->flashdata('auth_message')): ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> Alert! <?php echo $this->session->flashdata('auth_message'); ?></h4>
                            </div>
                        <?php endif ?>
                        <h1 style="text-align: center;">Quên mật khẩu</h1>
                        <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <?php echo form_label('Mật khẩu mới (ít nhất 8 ký tự): ', 'password'); ?>
                            <?php echo form_error('password'); ?>
                            <?php echo form_password('password', '', 'class="form-control"'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Xác Nhận Mật Khẩu:', 'confirm_password').'<br />'; ?>
                            <?php echo form_error('confirm_password'); ?>
                            <?php echo form_password('confirm_password', '','class="form-control"').'<br /><br />'; ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_submit('submit', 'Xác Nhận', 'class="btn btn-primary btn-lg btn-block"'); ?>
                            <a href="javascript:history.back()" name="back" class="btn btn-default btn-lg btn-block">Quay lại</a>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </section>
        </div>
<!-- /.login-box -->
    </section>
</section>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo site_url('assets/admin/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo site_url('assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- iCheck -->
<!-- <script src="<?php echo site_url('assets/lib/') ?>iCheck/js/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script> -->
</body>
</html>
