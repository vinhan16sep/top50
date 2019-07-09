<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="row">
        <div class="container col-md-12">
            <div class="modified-mode">
                <div class="col-lg-10 col-lg-offset-0" style="margin-left: 15px;">
                    <h1>TẠO MỚI TÀI KHOẢN HỘI ĐỒNG</h1>
                    <?php
                    echo form_open_multipart('', array('class' => 'form-horizontal'));
                    ?>
                    <br>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-sx-12">
                                <?php
                                echo form_label('Chọn chức vụ', 'member_role');
                                ?>
                            </div>
                            <div class="col-sm-9 col-md-9 col-sx-12">
                                <?php
                                $options = array(
                                    '' => '-- Chọn chức vụ --',
                                    'member' => 'Thành viên',
                                    'leader' => 'Trưởng nhóm',
                                    'manager' => 'Chủ tịch'
                                );
                                echo form_error('member_role');
                                echo form_dropdown('member_role', $options, '', 'class="form-control"');

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_label('Tên','first_name');
                        echo form_error('first_name');
                        echo form_input('first_name',set_value('first_name'),'class="form-control"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_label('Họ','last_name');
                        echo form_error('last_name');
                        echo form_input('last_name',set_value('last_name'),'class="form-control"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_label('Công ty / Nơi làm việc','company');
                        echo form_error('company');
                        echo form_input('company',set_value('company'),'class="form-control"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_label('Chức danh','position');
                        echo form_error('position');
                        echo form_input('position',set_value('position'),'class="form-control"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_label('Số điện thoại','phone');
                        echo form_error('phone');
                        echo form_input('phone',set_value('phone'),'class="form-control"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_label('Username','username');
                        echo form_error('username');
                        echo form_input('username',set_value('username'),'class="form-control"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_label('Email','email');
                        echo form_error('email');
                        echo form_input('email','','class="form-control"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_label('Password','password');
                        echo form_error('password');
                        echo form_password('password','','class="form-control"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_label('Xác nhận password','password_confirm');
                        echo form_error('password_confirm');
                        echo form_password('password_confirm','','class="form-control"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        // if(isset($groups)) {
                        //     echo form_label('Nhóm','groups[]');
                        //     foreach($groups as $group) {
                        //         echo '<div class="checkbox">';
                        //         echo '<label>';
                        //         echo form_checkbox('groups[]', $group->id, set_checkbox('groups[]', $group->id));
                        //         echo ' '.$group->name;
                        //         echo '</label>';
                        //         echo '</div>';
                        //     }
                        // }
                        ?>
                    </div>
                    <br>
                    <div class="form-group col-sm-12 text-right">
                        <input type="hidden" name="url" value="<?php echo $this->uri->segment(4); ?>">
                        <?php
                        echo form_submit('submit', 'Hoàn thành', 'class="btn btn-primary"');
                        echo form_close();
                        ?>
                        <a class="btn btn-default cancel" href="javascript:window.history.go(-1);">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>