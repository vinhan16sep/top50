<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .error{
        color: red;
    }
    form .form-group label{
        padding-top: 5px;
    }
    .float-right > label{
        float: right;
    }
    form > hr{
        margin:5px -15px;
        margin-bottom:10px ;
        margin-top:-5px ;
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row modified-mode">
            <div class="col-lg-10 col-lg-offset-0">
                <div class="form-group">
                    <h2 style="text-align:center;">THÔNG TIN CƠ BẢN CỦA DOANH NGHIỆP</h2>
                </div>
                <div class="form-group">
                    <h3 style="text-align:center;">Tên công ty: <span style="color:#3c8dbc;"><?php echo $user->company; ?></span></h3>
                    <h3 style="text-align:center;">Mã số thuế: <span style="color:#3c8dbc;"><?php echo $user->username; ?></span></h3>
                    <div style="margin: auto; width: 100%; text-align: center;">
                        <?php if ( $information_submitted['avatar'] && file_exists('assets/upload/avatar/' . $information_submitted['avatar']) ): ?>
                            <img src="<?php echo base_url('assets/upload/avatar/') . $information_submitted['avatar']; ?>" class="" alt="user image" width=30%>
                        <?php else: ?>
                            <img src="<?php echo site_url('assets/public/img/client.jpg'); ?>" class="" alt="user image" width=30%>
                        <?php endif ?>
                        <br>
                    </div>
                    
                </div>
                <?php
                echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'extra-form'));
                ?>
                <hr>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Logo công ty <br /><span style="color: #f0ad4e">(*.jpg, *.jpeg, *.png, *.gif, file < 1200Kb)</span>', 'avatar');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('avatar');
                            echo form_upload('avatar', set_value('avatar'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>

                

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
                                echo form_input('company', set_value('company',$user->company), 'class="form-control"');
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
                                echo form_error('ngaythanhlap', '<div class="error">', '</div>');
                                echo form_input('ngaythanhlap', set_value('ngaythanhlap'), 'class="form-control datetimepicker7" ');
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
                                echo form_error('giayphepdangky', '<div class="error">', '</div>');
                                echo form_input('giayphepdangky', set_value('giayphepdangky'), 'class="form-control" ');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                            <?php
                                echo form_label('Ngày cấp <span style="color: red">(*)</span>', 'ngaycap');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12">
                            <?php
                                echo form_error('ngaycap', '<div class="error">', '</div>');
                                echo form_input('ngaycap', set_value('ngaycap'), 'class="form-control datetimepicker7" ');
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
                                echo form_error('truso', '<div class="error">', '</div>');
                                echo form_textarea('truso', set_value('truso'), 'class="form-control" ');
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
                                echo form_error('dienthoai', '<div class="error">', '</div>');
                                echo form_input('dienthoai', set_value('dienthoai'), 'class="form-control" ');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                            <?php
                                echo form_label('Fax <span style="color: red">(*)</span>', 'fax');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12">
                            <?php
                                echo form_error('fax', '<div class="error">', '</div>');
                                echo form_input('fax', set_value('fax'), 'class="form-control" ');
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
                                echo form_error('email', '<div class="error">', '</div>');
                                echo form_input('email', set_value('email'), 'class="form-control" ');
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
                                echo form_input('website', set_value('website'), 'class="form-control" ');
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
                                echo form_error('lanhdao', '<div class="error">', '</div>');
                                echo form_input('lanhdao', set_value('lanhdao'), 'class="form-control" ');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                            <?php
                                echo form_label('Chức danh <span style="color: red">(*)</span>', 'chucdanh');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12">
                            <?php
                                echo form_error('chucdanh', '<div class="error">', '</div>');
                                echo form_input('chucdanh', set_value('chucdanh'), 'class="form-control" ');
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
                                echo form_error('email1', '<div class="error">', '</div>');
                                echo form_input('email1', set_value('email1'), 'class="form-control" ');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                            <?php
                                echo form_label('Di động <span style="color: red">(*)</span>', 'didong');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12">
                            <?php
                                echo form_error('didong', '<div class="error">', '</div>');
                                echo form_input('didong', set_value('didong'), 'class="form-control" ');
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
                                echo form_label('Lãnh đạo <span style="color: red">(*)</span>', 'lanhdao1');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12">
                            <?php
                                echo form_error('lanhdao1', '<div class="error">', '</div>');
                                echo form_input('lanhdao1', set_value('lanhdao1'), 'class="form-control" ');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                            <?php
                                echo form_label('Chức danh <span style="color: red">(*)</span>', 'chucdanh1');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12">
                            <?php
                                echo form_error('chucdanh1', '<div class="error">', '</div>');
                                echo form_input('chucdanh1', set_value('chucdanh1'), 'class="form-control" ');
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
                                echo form_error('email2', '<div class="error">', '</div>');
                                echo form_input('email2', set_value('email2'), 'class="form-control" ');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12 float-right">
                            <?php
                                echo form_label('Di động <span style="color: red">(*)</span>', 'didong2');
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-12">
                            <?php
                                echo form_error('didong2', '<div class="error">', '</div>');
                                echo form_input('didong2', set_value('didong2'), 'class="form-control" ');
                            ?>
                        </div>
                    </div>
                </div>

                


                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Tên người đại diện pháp luật <span style="color: red">(*)</span>', 'legal_representative');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('legal_representative', '<div class="error">', '</div>');
                            echo form_input('legal_representative', set_value('legal_representative', $extra['legal_representative']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Chức danh <span style="color: red">(*)</span>', 'lp_position');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('lp_position', '<div class="error">', '</div>');
                            echo form_input('lp_position', set_value('lp_position', $extra['lp_position']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Email <span style="color: red">(*)</span>', 'lp_email');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('lp_email', '<div class="error">', '</div>');
                            echo form_input('lp_email', set_value('lp_email', $extra['lp_email']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Di động <span style="color: red">(*)</span>', 'lp_phone');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('lp_phone', '<div class="error">', '</div>');
                            echo form_input('lp_phone', set_value('lp_phone', $extra['lp_phone']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Tên người liên hệ với BTC <span style="color: red">(*)</span>', 'connector');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('connector', '<div class="error">', '</div>');
                            echo form_input('connector', set_value('connector', $extra['connector']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Chức danh người liên hệ với BTC <span style="color: red">(*)</span>', 'c_position');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('c_position', '<div class="error">', '</div>');
                            echo form_input('c_position', set_value('c_position', $extra['c_position']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Email người liên hệ với BTC <span style="color: red">(*)</span>', 'c_email');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('c_email', '<div class="error">', '</div>');
                            echo form_input('c_email', set_value('c_email', $extra['c_email']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Di động người liên hệ với BTC <span style="color: red">(*)</span>', 'c_phone');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('c_phone', '<div class="error">', '</div>');
                            echo form_input('c_phone', set_value('c_phone', $extra['c_phone']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Website', 'website');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('website', '<div class="error">', '</div>');
                            echo form_input('website', set_value('website', $extra['website']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-sx-12"><strong>Lưu ý:</strong> <span style="color: red">(*)</span> là các trường cần nhập thông tin</div>
                    </div>
                </div>
                <hr>
<!--                <div class="form-group">-->
<!--                    <div class="row">-->
<!--                        <div class="col-sm-3 col-md-3 col-sx-12">-->
<!--                            --><?php
//                            echo form_label('Link download PĐK của DN', 'link');
//                            ?>
<!--                        </div>-->
<!--                        <div class="col-sm-9 col-md-9 col-sx-12">-->
<!--                            <p>Doanh nghiệp tải mẫu phiếu đăng ký ở đây, khai đầy đủ thông tin, ký, đóng dấu và gửi lại bản cứng cho ban tổ chức.</p>-->
<!--                            <a class="btn btn-warning" href="--><?php //echo site_url('PDK2018_done.docx') ?><!--" target="_blank">Tải mẫu Phiếu đăng ký</a>-->
<!--                            <br>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <br>
                <div class="form-group col-sm-12 text-right submit-extra-form">
                    <div class="col-sm-3 col-md-3 col-sx-12">
                    </div>
                    <div class="col-sm-9 col-md-9 col-sx-12">
                        <div>
                            <a style="display: inline;" href="<?php echo base_url('client/information/extra'); ?>" class="btn btn-default pull-left"><b>Quay lại</b></a>
                            <?php echo form_submit('submit', 'Hoàn thành', 'class="btn btn-primary pull-right" style="width:40%;display: inline;"'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
//    if($('input[name="is_submit"]').is(':checked') === true){
//        $('.submit-extra-form').show();
//    }else{
//        $('.submit-extra-form').hide();
//    };
//
//    function make_sure(){
//        if($('input[name="is_submit"]').is(':checked') === true){
//            $('.submit-extra-form').show();
//        }else{
//            $('.submit-extra-form').hide();
//        }
//    }

    $('#extra-form').validate({
        rules: {
            legal_representative: {
                required: true
            },
            lp_position: {
                required: true
            },
            lp_email: {
                required: true,
                email: true
            },
            lp_phone: {
                required: true,
                digits: true
            },
            link: {
                required: true
            }
        },
        messages :{
            legal_representative: {
                required: 'Cần nhập Tên người đại diện pháp luật'
            },
            lp_position: {
                required: 'Cần nhập Chức danh'
            },
            lp_email: {
                required: 'Cần nhập Email',
                email: 'Email không hợp lệ'
            },
            lp_phone: {
                required: 'Cần nhập số điện thoại di động',
                digits: 'Số điện thoại di động chỉ chứa ký tự số'
            },
            link: {
                required: 'Link download PĐK của DN'
            }
        }
    });
</script>

 <script type="text/javascript">
    $(function () {
        $('.datetimepicker7').datetimepicker({
            format: 'DD/MM/Y',
            maxDate: new Date(),
        });
    });
</script>