<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <!-- <div class="box-body pad table-responsive">
        <h3>Trang thông tin: <span style="color:red;"><?php echo $user->company; ?></span></h3>
    </div> -->
    <section class="content">

        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="post">
                            <h4>Tổng số doanh nghiệp đăng ký: <span style="color: red"><?php echo $total_companys; ?></span></h4>
                                <p style="color:green;">Doanh nghiệp đã gửi thông tin đăng ký</p>
                                <span>
                                    <a href="<?php echo base_url('admin/company'); ?>" class="btn btn-success btn-block"><b>Xem danh sách các doanh nghiệp đã đăng ký</b></a>
                                </span>
                        </div>
                        <?php if($this->ion_auth->user()->row()->email == 'admin@admin.com'){ ?>
                            <div class="post">
                                <h4>Tổng số người dùng đăng ký: <span style="color: red"><?php echo $total_users; ?></span></h4>
                                <p style="color:green;">Người dùng đăng ký tài khoản</p>
                                <span>
                                    <a href="<?php echo base_url('admin/users/index/3') ?>" class="btn btn-success btn-block"><b>Xem danh sách người dùng đã đăng ký</b></a>
                                </span>
                            </div>
                            <div class="post">
                                <h4>Tổng số sản phẩm / giải pháp / dịch vụ đã đăng ký: <span style="color: red"><?php echo $total_products; ?></span></h4>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
</div>

