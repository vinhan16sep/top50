<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <?php if ($this->session->flashdata('message_error')): ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Thông báo!</strong> <?php echo $this->session->flashdata('message_error'); ?>
                                </div>
                            <?php endif ?>
                            <div class="form-group">
                                <h2 style="text-align:center;">THÔNG TIN CƠ BẢN CỦA DOANH NGHIỆP</h2>
                                <h3 style="text-align:center;">Mã số thuế: <span style="color:#3c8dbc"><?php echo $user->username; ?></span></h3>
                                <div style="margin: auto; width: 100%; text-align: center;">
                                    <?php if ( $submitted['avatar'] && file_exists('assets/upload/avatar/' . $submitted['avatar']) ): ?>
                                        <img src="<?php echo base_url('assets/upload/avatar/') . $submitted['avatar']; ?>" class="" alt="user image" width=30%>
                                    <?php else: ?>
                                        <img src="<?php echo site_url('assets/public/img/client.jpg'); ?>" class="" alt="user image" width=30%>
                                    <?php endif ?>
                                    <br>
                                </div>
                            </div>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <a><i class="fa fa-globe margin-r-5"></i> Tên đơn vị</a> <p class="pull-right"><?php echo $user->company; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-user margin-r-5"></i> Tên người đại diện pháp luật</a> <p class="pull-right"><?php echo $submitted['legal_representative']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-star margin-r-5"></i> Chức danh</a> <p class="pull-right"><?php echo $submitted['lp_position']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-envelope margin-r-5"></i> Email</a> <p class="pull-right"><?php echo $submitted['lp_email']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-mobile margin-r-5"></i> Di động</a> <p class="pull-right"><?php echo $submitted['lp_phone']; ?></p>
                                </li>

                                <li class="list-group-item">
                                    <a><i class="fa fa-user margin-r-5"></i> Tên người liên hệ với BTC</a> <p class="pull-right"><?php echo $submitted['connector']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-star margin-r-5"></i> Chức danh người liên hệ với BTC</a> <p class="pull-right"><?php echo $submitted['c_position']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-envelope margin-r-5"></i> Email người liên hệ với BTC</a> <p class="pull-right"><?php echo $submitted['c_email']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-mobile margin-r-5"></i> Di động người liên hệ với BTC</a> <p class="pull-right"><?php echo $submitted['c_phone']; ?></p>
                                </li>
<!--                                <li class="list-group-item">-->
<!--                                    <a><i class="fa fa-link margin-r-5"></i> Link download PĐK của DN</a> <p class="pull-right">--><?php //echo $submitted['link']; ?><!--</p>-->
<!--                                </li>-->
                            </ul>
                            <?php if($reg_status['is_final'] == 0): ?>
                                <?php if(!$submitted): ?>
                                <a href="<?php echo base_url('client/information/create_extra'); ?>" class="btn btn-primary btn-block"><b>Nhập thông tin</b></a>
                                <?php else: ?>
                                <div class="row">
                                    <div class="col-xs-12 col-md-3">
                                        <a href="<?php echo base_url('client/information/edit_extra'); ?>" style="width:100%" class="btn btn-primary btn-block"><b>Sửa thông tin</b></a>
                                    </div>
                                    <?php if($hasCurrentYearCompanyData == 0){ ?>
                                        <div class="col-xs-12 col-md-6 pull-right">
                                            <a href="<?php echo base_url('client/information/create_company?year=' . $eventYear); ?>" style="width:100%" class="btn btn-warning btn-block"><b>Tiếp tục nhập thông tin chi tiết <i style="margin-left: 5px" class="fa fa-arrow-circle-right" aria-hidden="true"></i></b></a>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="col-xs-12 col-md-6 pull-right">
                                            <a href="<?php echo base_url('client/information/company'); ?>" style="width:100%" class="btn btn-warning btn-block"><b>Xem thông tin doanh nghiệp đã đăng ký <i style="margin-left: 5px" class="fa fa-arrow-circle-right" aria-hidden="true"></i></b></a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php endif; ?>
                            <?php else: ?>
                            <h4 style="color:red">Thông tin đã được gửi</h4>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>

