<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
   
        <?php if (!empty($this->session->userdata('message_error'))): ?>
            <div style="padding: 10px;text-align: center;">
                <div id="message" style="padding: 10px;background: red;color: #fff;font-size: 15px;border-radius: 5px;display: inline-block;">
                    <?php echo $this->session->userdata('message_error'); ?>
                </div>
            </div>
        <?php endif ?>
    
    <div class="box-body pad table-responsive" style="box-shadow: 2px 2px 1px grey;">
        <strong style="color: #2d76b8; font-size: 18px">Quý doanh nghiệp vui lòng khai đầy đủ thông tin theo các bước sau:</strong>
        <a target="_blank" href="http://danhhieusaokhue.vn/"><img style="width: 100% !important;" src="<?php echo site_url('assets/public/img/flow3.png'); ?>" /></a>
    </div>
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary" style="box-shadow: 2px 2px 1px grey;">
                    <div class="box-body box-profile">
                        <?php if ( $information_submitted['avatar'] && file_exists('assets/upload/avatar/' . $information_submitted['avatar']) ): ?>
                            <img class="profile-user-img img-responsive" src="<?php echo base_url('assets/upload/avatar/') . $information_submitted['avatar']; ?>" alt="User profile picture">
                        <?php else: ?>
                            <img class="profile-user-img img-responsive" src="<?php echo site_url('assets/public/img/client.jpg'); ?>" alt="User profile picture">
                        <?php endif ?>

                        <h3 class="profile-username text-center"><?php echo $user->last_name . ' ' . $user->first_name; ?></h3>

                        <p class="text-muted text-center"><?php echo $user->position; ?></p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item" style="height: 80px !important;">
                                <b style="height: 80px !important;"><i class="fa fa-building-o margin-r-5"></i> Doanh nghiệp</b> <a class="pull-right"><?php echo $user->company; ?></a>
                            </li>
                            <li class="list-group-item" style="height: 80px !important;">
                                <b style="height: 80px !important;"><i class="fa fa-map-marker margin-r-5"></i> Mã số thuế</b> <a class="pull-right"><?php echo $user->username; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-envelope margin-r-5"></i> Email</b> <a class="pull-right"><?php echo $user->email; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-phone margin-r-5"></i> Điện thoại</b> <a class="pull-right"><?php echo $information_submitted['lp_phone']; ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary" style="box-shadow: 2px 2px 1px grey;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin khác</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-clock-o margin-r-5"></i> Thời gian tạo tài khoản</strong>

                        <p class="text-muted">
                            <?php
                                echo date("d-m-Y H:i", $user->created_on);
                            ?>
                        </p>

                        <hr>

                        <strong><i class="fa fa-sign-in margin-r-5"></i> Đăng nhập lần cuối</strong>

                        <p class="text-muted">
                            <?php
                            echo date("d-m-Y H:i", $user->last_login);
                            ?>
                        </p>

                        <hr>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <h4 style="font-weight: bold">Thông tin cơ bản của doanh nghiệp</h4>
                            <br>
                            <?php if($reg_status['is_final'] == 0): ?>
                                <?php if(!$information_submitted): ?>
                                    <p style="color:red;">Doanh nghiệp cần điền đầy đủ thông tin cơ bản</p>
                                    <span>
                                        <a href="<?php echo base_url('client/information/create_extra') ?>" class="btn btn-warning btn-block" onclick=""><b>Nhập thông tin</b></a>
                                    </span>
                                <?php else: ?>
                                        <a href="<?php echo base_url('client/information/extra') ?>" class="btn btn-primary btn-block"><b>Xem thông tin</b></a>
                                        <a href="<?php echo base_url('client/information/edit_extra'); ?>" class="btn btn-primary btn-block"><b>Sửa thông tin</b></a>
    <!--                                <p style="color:green;">Doanh nghiệp đã gửi thông tin đăng ký</p>-->
    <!--                                <span>-->
    <!--                                    <a href="--><?php //echo base_url('client/information/extra') ?><!--" class="btn btn-success btn-block"><b>Xem thông tin đã đăng ký</b></a>-->
    <!--                                </span>-->
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="<?php echo base_url('client/information/extra') ?>" class="btn btn-primary btn-block"><b>Xem thông tin</b></a>
                            <?php endif; ?>
                        </div>
                        <div class="post">
                            <h4 style="font-weight: bold">Thông tin lĩnh vực ứng cử</h4>
                            <?php if($identity != ''){ ?>
                                <?php if($reg_status['is_final'] == 0): ?>
                                    <?php if(!$company_submitted): ?>
                                        <p style="color:red;">Doanh nghiệp cần điền đầy đủ thông tin doanh nghiệp</p>
                                        <span>
                                            <a href="<?php echo base_url('client/information/create_company?year=' . $eventYear); ?>" style="width:100%" class="btn btn-warning btn-block"><b>Nhập thông tin chi tiết năm sự kiện hiện tại<i style="margin-left: 5px" class="fa fa-arrow-circle-right" aria-hidden="true"></i></b></a>
                                        </span>
                                    <?php else: ?>
<!--                                        <span>-->
<!--                                            <a href="--><?php //echo base_url('client/information/company'); ?><!--" style="width:100%" class="btn btn-success btn-block"><b>Xem danh sách qua các năm đã đăng ký<i style="margin-left: 5px" class="fa fa-arrow-circle-right" aria-hidden="true"></i></b></a>-->
<!--                                        </span>-->
                                        <br>
                                        <?php foreach ($company_submitted as $value){ ?>
                                            <div>
                                                <a style="display: inline;" href="<?php echo base_url('client/information/company?year=' . $value['year']) ?>" class="btn btn-primary btn-block"><b>Xem thông tin đã đăng ký <?php echo $value['year']; ?></b></a>
                                                <?php if($status['is_final'] == 0){ ?>
                                                    <?php if(date('Y') <= $value['year']){ ?>
                                                        <a style="display: inline;" href="<?php echo base_url('client/information/edit_company?year=' . $value['year']); ?>" class="btn btn-primary btn-block"><b>Sửa thông tin <?php echo $value['year']; ?></b></a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
<!--                                            <hr style="width: 70%;">-->
                                        <?php } ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <br>
                                    <?php foreach ($company_submitted as $value){ ?>
                                        <div>
                                            <a style="display: inline;" href="<?php echo base_url('client/information/company?year=' . $value['year']) ?>" class="btn btn-primary btn-block"><b>Xem thông tin đã đăng ký <?php echo $value['year']; ?></b></a>
                                        </div>
                                        <hr>
                                    <?php } ?>
                                <?php endif; ?>
                            <?php }else{
                                echo '<p style="color:red;">Doanh nghiệp cần điền đầy đủ thông tin đăng ký phía trên</p>';
                            } ?>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <?php if($complete == 1 && $noMoreTemporaryData == 1): ?>
                    <?php if($identity != ''){ ?>
                        <?php if($reg_status['is_final'] == 0): ?>
                        <br>
                        <br>
                        <div style="text-align: center;">
                            <a onclick="return confirmation();" href="#" class="btn btn-warning btn-block btnIsFinal" style="width: 50% !important; margin: 0 auto;"><b>Nộp hồ sơ</b></a>
                            <h4 style="color:red">Lưu ý: Hồ sơ gửi đi sẽ không thể chỉnh sửa. Đề nghị quý DN xem lại trước khi GỬI NỘP</h4>
                        </div>
                        <?php else: ?>
                        <h4 style="color:red">Thông tin đã được gửi</h4>
                        <?php endif; ?>
                    <?php } ?>
                <?php else: ?>
<!--                    --><?php //if($identity != ''){ ?>
<!--                        --><?php //if($reg_status['is_final'] == 0): ?>
<!--                            <br>-->
<!--                            <br>-->
<!--                            <a disabled="disabled" class="btn btn-warning btn-block"><b>Cần nhập đủ thông tin Đăng ký / Doanh nghiệp / Sản phẩm</b></a>-->
<!--                        --><?php //else: ?>
<!--                            <h4 style="color:red">Thông tin đã được gửi</h4>-->
<!--                        --><?php //endif; ?>
<!--                    --><?php //} ?>
                <?php endif; ?>
                
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 630px !important;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc">
<!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                <h4 style="color:white;">Cảm ơn Quý Công ty đã đăng ký tham gia Chương trình 50+10 Doanh nghiệp CNTT hàng đầu Việt Nam <?php echo !empty($eventYear) ? $eventYear : ''; ?>.</h4>
            </div>
            <div class="modal-body">
                <h4 style="font-weight:bold !important;">Để hoàn tất hồ sơ, vui lòng gửi lại BTC các tài liệu sau qua đường bưu điện:</h4>
                <h4> 1. File Phiếu đăng ký theo mẫu đã tải (có dấu và chữ ký của lãnh đạo công ty)</h4>
                <h4> 2. Giấy phép đăng ký kinh doanh (bản photo)</h4>
                <h4> 3. Bằng khen, chứng chỉ (nếu có)</h4>
                <h4 style="text-decoration: underline !important;">Địa chỉ gửi: </h4>
                <h4 style="font-weight:bold !important;"> Mr. Nguyễn Thế Anh</h4>
                <h4 style="font-weight:bold !important;">Hiệp hội Phần mềm và Dịch vụ CNTT Việt Nam</h4>
                <h4 style="font-weight:bold !important;">Tầng 11, tòa nhà Cung Trí thức thành phố, Số 1 Tôn Thất Thuyết, Cầu Giấy, Hà Nội</h4>
                <h4 style="font-weight:bold !important;">Email: anhnt@vinasa.org.vn</h4>
                <h4 style="font-weight:bold !important;">Mobile: 091 319 66 99/02435772336</h4>

            </div>
            <div class="modal-footer">
                <a onclick="reloadPage()" class="btn btn-warning btn-block"><b>Đóng</b></a>
            </div>
        </div>

    </div>
</div>
<!--<div id="myModal1" class="modal fade" role="dialog">-->
<!--    <div class="modal-dialog">-->
<!---->
<!--        <!-- Modal content-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--                <h4 class="modal-title">Chọn năm</h4>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <select class="form-control" id="selected_year">-->
<!--                    --><?php //for(($i = date('Y') - 3); ($i <= date('Y') + 1); $i++){ ?>
<!--                        <option value="--><?php //echo $i; ?><!--" --><?php //echo ($i == date('Y')) ? 'selected="selected"' : ''; ?><!--">--><?php //echo $i; ?><!--</option>-->
<!--                    --><?php //} ?>
<!--                </select>-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <a onclick="this.href='--><?php //echo base_url("client/information/create_company") ?>////?year='+document.getElementById('selected_year').value" class="btn btn-warning btn-block"><b>Nhập thông tin</b></a>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</div>-->
<script>
    function confirmation() {
        if(confirm('Lưu ý: Hồ sơ gửi đi sẽ không thể chỉnh sửa. Bạn có chắc chắn muốn gửi?')){
            $('.btnIsFinal').attr('disabled', 'disabled');
            $('.btnIsFinal').text('Đang gửi yêu cầu');
            $.ajax({
                url: "<?php echo base_url('client/information/set_final'); ?>",
                success: function(result){
                    $('#myModal').modal({backdrop: 'static', keyboard: false})
                    $('#myModal').modal('show');
                }
            });

        }
    }
    function reloadPage(){
        location.reload();
    }
//</script>

