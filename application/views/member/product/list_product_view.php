<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <div class="box-body pad table-responsive">
        <h3>Danh sách sản phẩm <span style="color:red;"><?php echo $client->company; ?></span></h3><a type="button" href="<?php echo site_url('member/product/export/' . $client->id); ?>" class="btn btn-success">EXPORT DATA</a>
    </div>
    <section class="content">

        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <?php if ($products): ?>
                        <?php $stt = 1; ?>
                        <div class="post">
                            <table class="table">
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Lĩnh vực</th>
                                <th style="text-align: center;">Đánh giá</th>
                                <th style="text-align: center;">Thao Tác</th>
                                <?php foreach ($products as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $stt++ ?></td>
                                        <td><?php echo $value['name'] ?></td>
                                        <td>
                                            <?php $service = json_decode($value['service']); ?>
                                            <?php foreach ($service as $k => $v): ?>
                                                <p class="" style="padding-left:20px;"><?php echo $v; ?></p>
                                            <?php endforeach ?>
                                        
                                        </td>
                                        <?php if(!$value['rating_result']): ?>
                                            <td style="text-align: center;"><a href="<?php echo base_url('member/product/create/' . $value['id']) ?>" class="btn btn-default">Chưa đánh giá</a></td>
                                        <?php else: ?>
                                            <?php if($value['rating_result'] == 1): ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url('member/product/rating/' . $value['id']) ?>" class="btn btn-success">Xem đánh giá</a></td>
                                            <?php elseif($value['rating_result'] == 2): ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url('member/product/rating/' . $value['id']) ?>" class="btn btn-warning">Xem đánh giá</a></td>
                                            <?php elseif($value['rating_result'] == 3): ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url('member/product/rating/' . $value['id']) ?>" class="btn btn-danger">Xem đánh giá</a></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <td style="text-align: center;"><a href="<?php echo base_url('member/product/detail/' . $value['id']) ?>" class="btn btn-info">Xem chi tiết</a></td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
                        </div>
                        <?php else: ?>
                            <div class="post">Doanh nghiệp chưa đăng ký sản phẩm nào!</div>
                        <?php endif ?>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <div class="col-md-6 col-md-offset-5 page">
                    <?php echo $page_links ?>
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
</div>

