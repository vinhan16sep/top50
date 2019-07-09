<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="post">
                            <h4>Thông tin sản phẩm cơ bản</h4>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item" style="text-align: center;">
                                    <a>Giấy chứng nhận bản quyền/cam kết bản quyền</a>
                                    <br>
                                    <img src="<?php echo base_url('assets/upload/product/'. $product['certificate']); ?>" alt="" style="width: 200px;">
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-globe margin-r-5"></i> Tên SP/dịch vụ/giải pháp/ứng dụng</a> <br><p class="" style="padding-left:20px;"><?php echo $product['name']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <?php $service = json_decode($product['service']) ?>
                                    <a><i class="fa fa-circle margin-r-5"></i> Đăng ký tham gia lĩnh vực</a> <br>
                                    <?php foreach ($service as $key => $value): ?>
                                        <p class="" style="padding-left:20px;"><?php echo $value; ?></p>
                                    <?php endforeach ?>
                                    
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-envelope margin-r-5"></i> Ngày thương mại hoá/ra mắt dịch vụ</a> <p class="pull-right"><?php echo $product['open_date']; ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <div class="col-md-6">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="post">
                            <h4>Thông tin khác</h4>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <a><i class="fa fa-star margin-r-5"></i> Mô tả các công năng của sản phẩm</a> <br><p class="" style="padding-left:20px;"><?php echo $product['functional']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-star margin-r-5"></i> Các công nghệ và quy trình chất lượng sử dụng để phát triển sản phẩm</a> <br><p class="" style="padding-left:20px;"><?php echo $product['process']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-user-secret margin-r-5"></i> Bảo mật của sản phẩm</a> <br><p class="" style="padding-left:20px;"><?php echo $product['security']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-thumbs-o-up margin-r-5"></i> Các ưu điểm nổi trội của SP/GP/DV</a> <br><p class="" style="padding-left:20px;"><?php echo $product['positive']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-star margin-r-5"></i> So sánh với các SP/GP/DV khác</a> <br><p class="" style="padding-left:20px;"><?php echo $product['compare']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Doanh thu của SP/GP/DV năm 2016, 2017</a> <p class="pull-right"><?php echo $product['income_2016'] .' - '. $product['income_2017']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-globe margin-r-5"></i> Thị phần của SP/giải pháp/DV</a> <br><p class="" style="padding-left:20px;"><?php echo $product['area']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Giá SP/GP/DV</a> <p class="pull-right"><?php echo $product['price']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> 1 số khách hàng tiêu biểu</a> <br><p class="" style="padding-left:20px;"><?php echo $product['customer']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-child margin-r-5"></i> Dịch vụ sau bán hàng</a> <br><p class="" style="padding-left:20px;"><?php echo $product['after_sale']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Đội ngũ phát triển sp/gp</a> <br><p class="" style="padding-left:20px;"><?php echo $product['team']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-trophy margin-r-5"></i> Các giải thưởng/DH đã nhận được</a> <br><p class="" style="padding-left:20px;"><?php echo $product['award']; ?></p>
                                </li>
                            </ul>
                            <!--                            --><?php //if(!$submitted || $submitted['is_submit'] != 1): ?>
                            <!--                                <a href="--><?php //echo base_url('client/information/create_extra'); ?><!--" class="btn btn-primary btn-block"><b>Chỉnh sửa thông tin</b></a>-->
                            <!--                            --><?php //else: ?>
                            <!--                                <a href="javascript:void(0);" class="btn btn-danger btn-block" disabled><b>Thông tin đã đăng ký</b></a>-->
                            <!--                            --><?php //endif; ?>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>

