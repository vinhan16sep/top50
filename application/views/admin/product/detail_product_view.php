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
                                    <a><i class="fa fa-file margin-r-5"></i> File mô tả</a> <br><p class="" style="padding-left:20px;"></p>
                                    <?php if($product['file'] && $product['file'] != ''){ ?>
                                        <a class="btn btn-success" href="<?php echo base_url('assets/upload/file/'. $product['file']); ?>" target="_blank">Tải file mô tả</a>
                                    <?php }else{ ?>
                                        <p class="" style="color:red;padding-left:20px;">Chưa có file</p>
                                    <?php } ?>
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
                                    <a><i class="fa fa-money margin-r-5"></i> Doanh thu của SP/GP/DV năm 2017 (triệu đồng)</a> <p class="pull-right"><?php echo $product['income_2016']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Doanh thu của SP/GP/DV năm 2018 (triệu đồng)</a> <p class="pull-right"><?php echo $product['income_2017']; ?></p>
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
                            <h4>Kết quả đánh giá</h4>
                            <?php foreach($ratings as $rating): ?>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <a><i class="fa fa-star margin-r-5"></i> Tính chính xác của hồ sơ khai: Doanh thu, nhân lực, giá thành, ngày ra thị trường...</a> <br><p class="" style="padding-left:20px;"><?php echo $rating['precision']; ?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-star margin-r-5"></i> Điểm nổi trội</a> <br><p class="" style="padding-left:20px;"><?php echo $rating['strong']; ?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-user-secret margin-r-5"></i> Điểm yếu</a> <br><p class="" style="padding-left:20px;"><?php echo $rating['weak']; ?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-thumbs-o-up margin-r-5"></i> Nhận xét chung về DN và định hướng hoạt động, sự phát triển bền vững....</a> <br><p class="" style="padding-left:20px;"><?php echo $rating['rating']; ?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-star margin-r-5"></i> Kết quả thẩm định</a> <br><p class="" style="padding-left:20px;">
                                            <?php if($rating['result'] == 1): ?>
                                        <td style="text-align: center;"><a href="javascript:void(0);" class="btn btn-success">Đồng ý</a></td>
                                        <?php elseif($rating['result'] == 2): ?>
                                            <td style="text-align: center;"><a href="javascript:void(0);" class="btn btn-warning">Đề nghị xem xét</a></td>
                                        <?php elseif($rating['result'] == 3): ?>
                                            <td style="text-align: center;"><a href="javascript:void(0);" class="btn btn-danger">Không đồng ý</a></td>
                                        <?php endif; ?>
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-user margin-r-5"></i> Người đánh giá</a><p class="pull-right" style="padding-left:20px;"><?php echo $rating['last_name'] . ' ' . $rating['first_name']; ?></p>
                                    </li>
                                </ul>
                                <hr style="border: solid 1px red;">
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>

