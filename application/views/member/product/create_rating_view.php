<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row modified-mode">
            <div class="col-lg-10 col-lg-offset-0">
                <div class="form-group">
                    <h1 style="text-align:center;">ĐÁNH GIÁ SẢN PHẨM</h1>
                </div>
                <?php
                echo form_open_multipart('', array('class' => 'form-horizontal'));
                ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Tên SP/dịch vụ/giải pháp/ứng dụng');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_label($product['name']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Đăng ký tham gia lĩnh vực', 'service');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                                $service = json_decode($product['service']);
                                foreach ($service as $key => $value) {
                                    echo form_label($value) . '<br>';
                                }
                            
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Tính chính xác của hồ sơ khai: Doanh thu, nhân lực, giá thành, ngày ra thị trường...', 'precision');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('precision');
                            echo form_textarea(array(
                                'name' => 'precision',
                                'id' => 'precision',
                                'value' => set_value('precision'),
                                'rows' => '5',
                                'class' => "form-control"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Điểm nổi trội', 'strong');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('strong');
                            echo form_textarea(array(
                                'name' => 'strong',
                                'id' => 'strong',
                                'value' => set_value('strong'),
                                'rows' => '3',
                                'class' => "form-control"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Điểm yếu', 'weak');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('weak');
                            echo form_textarea(array(
                                'name' => 'weak',
                                'id' => 'weak',
                                'value' => set_value('weak'),
                                'rows' => '3',
                                'class' => "form-control"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Nhận xét chung về DN và định hướng hoạt động, sự phát triển bền vững....', 'rating');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('rating');
                            echo form_textarea(array(
                                'name' => 'rating',
                                'id' => 'rating',
                                'value' => set_value('rating'),
                                'rows' => '3',
                                'class' => "form-control"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Kết quả thẩm định (chọn 1)', 'result');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            $options = array(
                                '' => '-- Kết quả --',
                                '1' => 'Đồng ý',
                                '2' => 'Đề nghị xem xét',
                                '3' => 'Không đồng ý'
                            );
                            echo form_error('result');
                            echo form_dropdown('result', $options, '', 'class="form-control"');

                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group make-sure">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <p style="color:red;">Chú ý: thông tin đã nhập ở trên sẽ không thể thay đổi sau khi gửi đi.
                                <a class="btn btn-default cancel pull-right" href="javascript:window.history.go(-1);">Quay lại</a></p>
                            <?php
                            echo form_error('link');
                            $js = 'onClick="make_sure()"';
                            echo form_label(form_checkbox('is_submit', '', FALSE, $js) . ' Tôi đã chắc chắn về thông tin bên trên.');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12 text-right submit-extra-form" style="display:none;">
                    <div class="col-sm-3 col-md-3 col-sx-12">
                    </div>
                    <div class="col-sm-9 col-md-9 col-sx-12">
                        <?php
                        echo form_submit('submit', 'Hoàn thành', 'class="btn btn-primary pull-left" style="width:40%"');
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    if($('input[name="is_submit"]').is(':checked') === true){
        $('.submit-extra-form').show();
    }else{
        $('.submit-extra-form').hide();
    };

    function make_sure(){
        if($('input[name="is_submit"]').is(':checked') === true){
            $('.submit-extra-form').show();
        }else{
            $('.submit-extra-form').hide();
        }
    }
</script>