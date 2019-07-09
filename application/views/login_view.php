

<link rel="stylesheet" href="<?php echo site_url('assets/public/css/login.css'); ?>">

<section class="main_content container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="inner">
                    <h1>Client Login</h1>
<!--                    --><?php //echo $this->session->flashdata('message'); ?>
<!--                    --><?php //echo form_open('', array('class' => 'form-horizontal')); ?>
<!--                    <div class="form-group">-->
<!--                        --><?php //echo form_label('Username', 'identity'); ?>
<!--                        --><?php //echo form_error('identity'); ?>
<!--                        --><?php //echo form_input('identity', '', 'class="form-control"'); ?>
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        --><?php //echo form_label('Password', 'password'); ?>
<!--                        --><?php //echo form_error('password'); ?>
<!--                        --><?php //echo form_password('password', '', 'class="form-control"'); ?>
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label>-->
<!--                            --><?php //echo form_checkbox('remember', '1', FALSE); ?><!-- Remember me-->
<!--                        </label>-->
<!--                    </div>-->
<!--                    --><?php //echo form_submit('submit', 'Log in', 'class="btn btn-primary btn-lg btn-block"'); ?>
<!--                    --><?php //echo form_close(); ?>
                    <div class="form-group">
                        <label for="inputEmail">Email address</label>
                        <input type="email" class="form-control" id="inputEmail1" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>


                    <button class="btn btn-primary" type="submit">Login</button>
                    <button class="btn btn-default" type="submit">Forgot password?</button>


                </div>
            </div>

            <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="inner">
                    <h1>Client Register</h1>
                    <div class="form-group">
                        <label for="inputFirstName">First name</label>
                        <input type="text" class="form-control" id="inputFirstName" placeholder="First name">
                    </div>
                    <div class="form-group">
                        <label for="inputLastName">Last name</label>
                        <input type="text" class="form-control" id="inputLastName" placeholder="Last name">
                    </div>
                    <div class="form-group">
                        <label for="inputGrade">Grade</label>
                        <input type="text" class="form-control" id="inputGrade" placeholder="Grade">
                    </div>
                    <div class="form-group">
                        <label for="inputWorkplace">Workplace</label>
                        <input type="text" class="form-control" id="inputWorkplace" placeholder="Workplace">
                    </div>
                    <div class="form-group">
                        <label for="inputUsername">Username</label>
                        <input type="text" class="form-control" id="inputUsername" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="inputEmailR">Email address</label>
                        <input type="email" class="form-control" id="inputEmail1R" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label for="inputPhoneNo">Phone number</label>
                        <input type="password" class="form-control" id="inputPhoneNo" placeholder="Phone number">
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordR">Password</label>
                        <input type="password" class="form-control" id="inputPasswordR" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="inputConfirmPasswordR">Confirm Password</label>
                        <input type="password" class="form-control" id="inputConfirmPasswordR" placeholder="Confirm Password">
                    </div>

                    <button class="btn btn-primary" type="submit">Register</button>
                </div>
            </div>
        </div>
    </div>
</section>