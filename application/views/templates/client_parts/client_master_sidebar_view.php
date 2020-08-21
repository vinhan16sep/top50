<?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('clients')): ?>
    <style>
        .skin-blue .sidebar-menu>li.active>a{
            border-left-color:#fba966 !important;
        }
    </style>
    <aside class="main-sidebar" style="background-color: #2a2b41 !important;">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">
            <!-- Sidebar user panel -->
<!--            <div class="user-panel">-->
<!--                <div class="pull-left image">-->
<!--                    <img src="--><?php //echo site_url('assets/admin/'); ?><!--dist/img/admin.png" class="img-circle" alt="User Image">-->
<!--                </div>-->
<!--                <div class="pull-left info">-->
<!--                    <p>MN Tuổi Thần Tiên</p>-->
<!--                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
<!--                </div>-->
<!--            </div>-->
            <!-- search form -->

            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->



            <ul class="sidebar-menu tree" data-widget="tree">

                <li class="<?php echo ($active == 'dashboard')? 'active' : '' ?>">
                    <a href="<?php echo base_url('client/dashboard'); ?>">
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        <span>Tổng quan</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <li class="<?php echo ($active == 'extra')? 'active' : '' ?>">
                    <a href="<?php echo base_url('client/information/extra'); ?>">
                        <i class="fa fa-address-card" aria-hidden="true"></i>
                        <span>Thông tin cơ bản của DN</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <li class="<?php echo ($active == 'company')? 'active' : '' ?>">
                    <a href="<?php echo base_url('client/information/company'); ?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        <span>Thông tin Lĩnh vực ứng cử</span>
                        <span class="pull-right-container"></span>
                    </a>
<!--                    <ul class="">-->
<!--                        --><?php //if($company_submitted): ?>
<!--                            --><?php //foreach ($company_submitted as $value){ ?>
<!--                                <li class="--><?php //echo ($active == 'menu')? 'active' : '' ?><!--">-->
<!--                                    <a href="--><?php //echo base_url('client/information/company?year=' . $value['year']) ?><!--"> <i class="fa fa-minus" aria-hidden="true"></i> Năm --><?php //echo $value['year']; ?><!--</a>-->
<!--                                    --><?php //if(date('Y') <= $value['year']){ ?>
<!--                                        <a style="display: inline;" href="--><?php //echo base_url('client/information/edit_company?year=' . $value['year']); ?><!--"><b style="color: orange">- sửa -</b></a>-->
<!--                                    --><?php //} ?>
<!--                                    <br>-->
<!--                                </li>-->
<!--                            --><?php //} ?>
<!--                        --><?php //else: ?>
<!--                            <p style="color: white">Chưa có thông tin</p>-->
<!--                        --><?php //endif; ?>
<!--                    </ul>-->
                </li>
<!--                <li class="--><?php //echo ($active == 'products')? 'active' : '' ?><!--">-->
<!--                    <a href="--><?php //echo base_url('client/information/products'); ?><!--">-->
<!--                        <i class="fa fa-briefcase" aria-hidden="true"></i>-->
<!--                        <span>Thông tin Sản phẩm/Dịch vụ <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;đề cử</span>-->
<!--                        <span class="pull-right-container"></span>-->
<!--                    </a>-->
<!--                </li>-->
                <li>
                    <a onclick="return openModal();" href="#"><b></b>
                        <i class="fa fa-exclamation" aria-hidden="true"></i>
                        <span>Hướng dẫn hoàn tất hồ sơ</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <div id="myModalSidebar" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 630px !important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #2a2b41">
                    <!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <h4 style="color:white;">Cảm ơn Quý Công ty đã đăng ký tham gia Chương trình Top 10 Doanh nghiệp CNTT Việt Nam <?php echo !empty($eventYear) ? $eventYear : ''; ?>.</h4>
                </div>
                <div class="modal-body">
                    <h4 style="font-weight:bold !important;">Để hoàn tất hồ sơ, vui lòng upload những tài liệu sau lên hệ thống:</h4>
                    <h4> 1. Tải Phiếu đăng ký theo mẫu tại trang "Thông tin cơ bản"</h4>
                    <h4> 2. Upload lại phiếu đăng ký (đã tải + chữ ký điện tử) lên hệ thống</h4>
                    <h4> 3. Giấy đăng ký kinh doanh Chứng nhận; Bằng khen, chứng chỉ (nếu có)</h4>
                    <h4 style="text-decoration: underline !important;">Hoặc gửi bản cứng về địa chỉ: </h4>
                    <h4 style="font-weight:bold !important;"> Mr. Nguyễn Thế Anh</h4>
                    <h4 style="font-weight:bold !important;">Hiệp hội Phần mềm và Dịch vụ CNTT Việt Nam</h4>
                    <h4 style="font-weight:bold !important;">Tầng 11, tòa nhà Cung Trí thức thành phố, Số 1 Tôn Thất Thuyết, Cầu Giấy, Hà Nội</h4>
                    <h4 style="font-weight:bold !important;">Email: anhnt@vinasa.org.vn</h4>
                    <h4 style="font-weight:bold !important;">Mobile: 091 319 66 99/02435772336</h4>
                </div>
                <div class="modal-footer">
                    <a data-dismiss="modal" class="btn btn-warning btn-block"><b>Đóng</b></a>
                </div>
            </div>

        </div>
    </div>
    <script>
        function openModal(){
            $('#myModalSidebar').modal('show');
        }
    </script>
<?php endif; ?>