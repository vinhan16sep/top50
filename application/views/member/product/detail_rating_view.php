<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <style>
        /***********************************************/
        /***************** Accordion ********************/
        /***********************************************/
        @import url('https://fonts.googleapis.com/css?family=Tajawal');
        @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

        section{
            padding: 0px 0;
        }

        #accordion-style-1 h1,
        #accordion-style-1 a{
            color:#007b5e;
        }
        #accordion-style-1 .btn-link {
            font-weight: 400;
            color: #007b5e;
            background-color: transparent;
            text-decoration: none !important;
            font-size: 16px;
            font-weight: bold;
            padding-left: 25px;
        }

        #accordion-style-1 .card-body {
            border-top: 2px solid #007b5e;
        }

        #accordion-style-1 .card-header .btn.collapsed .fa.main{
            display:none;
        }

        #accordion-style-1 .card-header .btn .fa.main{
            background: #007b5e;
            padding: 13px 11px;
            color: #ffffff;
            width: 35px;
            height: 41px;
            position: absolute;
            left: -1px;
            top: 10px;
            border-top-right-radius: 7px;
            border-bottom-right-radius: 7px;
            display:block;
        }
        .member-name{

        }
    </style>
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
                                    <a><i class="fa fa-money margin-r-5"></i> Doanh thu của SP/GP/DV năm 2016</a> <p class="pull-right"><?php echo $product['income_2016']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Doanh thu của SP/GP/DV năm 2017</a> <p class="pull-right"><?php echo $product['income_2017']; ?></p>
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
                            <div class="container-fluid" id="accordion-style-1">
                                    <section>
                                        <div class="row">
                                            <div class="col-12">
                                                <h1 class="text-green mb-4 text-center" style="color:black !important;">Kết quả đánh giá</h1>
                                            </div>
                                            <div class="col-10 mx-auto">
                                                <div class="accordion" id="accordionExample">
                                                    <?php if($rating): ?>
                                                    <?php foreach ($rating as $key => $value): ?>
                                                    <div class="card">
                                                        <div class="card-header" id="headingTwo">
                                                            <h5 class="mb-0">
                                                                <?php
                                                                    switch($value['result']){
                                                                        case 2:
                                                                            $color_by_rating = '#f39c12';
                                                                            break;
                                                                        case 3:
                                                                            $color_by_rating = '#dd4b39';
                                                                            break;
                                                                        default:
                                                                            $color_by_rating = '#007b5e';
                                                                            break;
                                                                    }
                                                                ?>
                                                                <button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo $value['member_id']; ?>" aria-expanded="false" aria-controls="collapseTwo">
                                                                    <span class="member-name" style="font-size:15pt; color:<?php echo $color_by_rating; ?>"><?php echo $value['last_name']; ?> <?php echo $value['first_name']; ?></span>
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapse<?php echo $value['member_id']; ?>" class="collapse fade" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                            <ul class="list-group list-group-unbordered">
                                                                <li class="list-group-item">
                                                                    <a><i class="fa fa-star margin-r-5"></i> Tính chính xác của hồ sơ khai: Doanh thu, nhân lực, giá thành, ngày ra thị trường...</a> <br><p class="" style="padding-left:20px;"><?php echo $value['precision']; ?></p>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <a><i class="fa fa-star margin-r-5"></i> Điểm nổi trội</a> <br><p class="" style="padding-left:20px;"><?php echo $value['strong']; ?></p>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <a><i class="fa fa-user-secret margin-r-5"></i> Điểm yếu</a> <br><p class="" style="padding-left:20px;"><?php echo $value['weak']; ?></p>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <a><i class="fa fa-thumbs-o-up margin-r-5"></i> Nhận xét chung về DN và định hướng hoạt động, sự phát triển bền vững....</a> <br><p class="" style="padding-left:20px;"><?php echo $value['rating']; ?></p>
                                                                </li>
                                                                <li class="list-group-item">

                                                                    <a><i class="fa fa-star margin-r-5"></i> Kết quả thẩm định</a> <br><p class="" style="padding-left:20px;">
                                                                        <?php if($value['result'] == 1): ?>
                                                                    <td style="text-align: center; color:white;"><a style="color:white;" href="javascript:void(0);" class="btn btn-success">Đồng ý</a></td>
                                                                    <?php elseif($value['result'] == 2): ?>
                                                                        <td style="text-align: center; color:white;"><a style="color:white;"  href="javascript:void(0);" class="btn btn-warning">Đề nghị xem xét</a></td>
                                                                    <?php elseif($value['result'] == 3): ?>
                                                                        <td style="text-align: center; color:white;"><a style="color:white;"  href="javascript:void(0);" class="btn btn-danger">Không đồng ý</a></td>
                                                                    <?php endif; ?>
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                            </div>

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

