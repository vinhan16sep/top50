<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <!-- <div class="box-body pad table-responsive">
        <h3>Trang thông tin: <span style="color:red;"><?php echo $user->company; ?></span></h3>
    </div> -->
    <section class="content">
        <table class="table table-bordered" style="width: 100%">
            <tr>
                <td  style="width: 20%"><h3>Sản phẩm: </h3></td>
                <td><h3><?php echo $product['name']; ?></h3></td>
            </tr>
            <tr>
                <td><h4>Doanh nghiệp: </h4></td>
                <td><h4><?php echo $company_name['company']; ?></h4></td>
            </tr>
            <tr>
                <?php
                $main_services = array(
                    1 => 'Các sản phẩm, giải pháp phần mềm tiêu biểu, được bình xét theo 24 lĩnh vực ứng dụng chuyên ngành',
                    2 => 'Các sản phẩm, giải pháp ứng dụng công nghệ 4.0',
                    3 => 'Các sản phẩm, giải pháp phần mềm mới',
                    4 => 'Các sản phẩm, giải pháp của doanh nghiệp khởi nghiệp',
                    5 => 'Các dịch vụ CNTT'
                );
                ?>
                <td><h4>Nhóm sản phẩm </h4></td>
                <td><h4><?php echo ($main_service) ? $main_services[$main_service] : "Chưa chọn"; ?></h4></td>
            </tr>
            <tr>
                <td  style="width: 20%"><h4>Nhóm: </h4></td>
                <td><h4><?php echo $team['name']; ?></h4></td>
            </tr>
            <tr>
                <td  style="width: 20%"><h3>Điểm trung bình: </h3></td>
                <td><h3 style="color: red;"><?php echo round($team_rating_total, 2); ?></h3></td>
            </tr>
        </table>
        <?php if ($this->session->flashdata('main_service_message')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Thông báo!</strong> <?php echo $this->session->flashdata('main_service_message'); ?>
            </div>
        <?php endif ?>
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        
                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <td class="col-sm-1" style="font-weight:bold;color: #31708f;">STT</td>
                                <td class="col-sm-2" style="font-weight:bold;color: #31708f;">Tên tài khoản</td>
                                <td class="col-sm-2" style="font-weight:bold;color: #31708f;">Trạng thái</td>
                                <td class="col-sm-2" style="font-weight:bold;color: #31708f;">Điểm</td>
                                <td class="col-sm-2" style="text-align: center;font-weight:bold;color: #31708f;">Thao Tác</td>
                            </tr>
                            <?php if ($list_team): ?>
                                <?php foreach ($list_team as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $value['username'] ?></td>
                                        <td>
                                            <?php echo ($value['is_rating'] == 1) ? '<span class="label label-success">Đã đánh giá</span>' : '<span class="label label-warning">Chưa đánh giá</span>' ?>
                                        </td>
                                        <td style="font-weight: bold;"><?php echo $value['total'] ?></td>
                                        <td style="text-align: center;">
                                            <?php if ($value['is_rating'] == 1): ?>
                                                <a href="<?php echo base_url('member/new_rating/rating_by_member?member_id=' . $value['id'] . '&product_id=' . $product_id . '&main_service=' . $main_service); ?>" data-toggle="tooltip" data-placement="top" title="Xem điểm của thành viên đã chấm">
                                                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                                </a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <a id="openRating" class="openRating" data-product="<?php echo $product_id; ?>" data-member="<?php echo $value['id']; ?>" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Mở chức năng sửa điểm">
                                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                                </a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </table>
                        
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

<script>
    $('.openRating').click(function(){

        $.ajax({
            type: "GET",
            url: "<?php echo base_url('member/new_rating/open_rating'); ?>",
            data: {
                product: $(this).data('product'),
                member: $(this).data('member')
            },
            success: function(result){
                let data = JSON.parse(result);
                if(data.name != undefined){
                    alert('Đã mở phần chấm điểm thành công');
                    window.location.reload();
                }else{
                    alert(data.message)
                }
            }
        });
    });
</script>