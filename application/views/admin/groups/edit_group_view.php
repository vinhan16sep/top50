<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="row">
        <div class="container col-md-12">
            <div class="modified-mode">
                <div class="col-lg-10 col-lg-offset-0" style="margin-left: 15px;">
                    <h1>CHỈNH SỬA NHÓM USER</h1>
                    <?php
                    echo form_open_multipart('', array('class' => 'form-horizontal'));
                    ?>
                    <div class="form-group picture">
                        <?php
                        echo form_label('Tên nhóm', 'group_name');
                        echo form_error('group_name');
                        echo form_input('group_name', set_value('group_name', $group->name), 'class="form-control" id="group_name"');
                        ?>
                    </div>
                    <div class="form-group picture">
                        <?php
                        echo form_label('Mô tả', 'group_description');
                        echo form_error('group_description');
                        echo form_input('group_description', set_value('group_description', $group->description), 'class="form-control" id="group_description"');
                        ?>
                    </div>
                    <?php echo form_hidden('group_id',set_value('group_id',$group->id));?>
                    <br>
                    <div class="form-group col-sm-12 text-right">
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