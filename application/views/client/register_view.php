<div class="content-wrapper" style="min-height: 916px;">
    <section class="content row">
        <div>
            <div class="col-lg-4 col-lg-offset-4">
                <h1>Login</h1>
                <?php echo $this->session->flashdata('message'); ?>
                <?php echo form_open('admin/user/register', array('class' => 'form-horizontal')); ?>
                <div class="form-group">
                    <?php echo form_label('Frist Name: ', 'first_name'); ?>
                    <?php echo form_error('first_name'); ?>
                    <?php echo form_input('first_name', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Last Name: ', 'last_name'); ?>
                    <?php echo form_error('last_name'); ?>
                    <?php echo form_input('last_name', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Company Name: ', 'companyname'); ?>
                    <?php echo form_error('companyname'); ?>
                    <?php echo form_input('companyname', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Username: ', 'username'); ?>
                    <?php echo form_error('username'); ?>
                    <?php echo form_input('username', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Email: ', 'email'); ?>
                    <?php echo form_error('email'); ?>
                    <?php echo form_input('email', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Phone: ', 'phone'); ?>
                    <?php echo form_error('phone'); ?>
                    <?php echo form_input('phone', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Password: ', 'password'); ?>
                    <?php echo form_error('password'); ?>
                    <?php echo form_password('password', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Confirm Password: ', 'cf_password'); ?>
                    <?php echo form_error('cf_password'); ?>
                    <?php echo form_password('cf_password', '', 'class="form-control"'); ?>
                </div>
                <?php echo form_submit('submit', 'Log in', 'class="btn btn-primary btn-lg btn-block"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
</div>