<link rel="stylesheet" href="<?php echo site_url('assets/public/css/homepage.css'); ?>">
<div class="content-wrapper main_content" style="min-height: 916px; margin-left: 0px !important;">
    <section class="content row">
        <div>
            <div class="col-lg-4 col-lg-offset-4">
                <?php echo $this->session->flashdata('message'); ?>
                <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                <div class="form-group">
                    <h1>Đăng nhập</h1>
                    <h5>Dành cho admin</h5>
                </div>
                <div class="form-group">
                    <?php echo form_label('Tài khoản', 'identity'); ?>
                    <?php echo form_error('identity'); ?>
                    <?php echo form_input('identity', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Mật khẩu', 'password'); ?>
                    <?php echo form_error('password'); ?>
                    <?php echo form_password('password', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_submit('submit', 'Đăng nhập', 'class="btn btn-primary btn-lg btn-block"'); ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
</div>