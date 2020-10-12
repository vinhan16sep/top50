<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <div class="box-body pad table-responsive">
        <h3>Danh sách sản phẩm dịch vụ</h3>
    </div>

    <section class="content">

        <div class="row">
            <form action="<?php echo base_url('member/product') ?>" class="form-horizontal col-md-12 col-sm-12 col-xs-12" method="get" style="margin-bottom: 30px;">
                <div class="col-lg-2">
                    <select class="form-control" name="rating_search">
                        <option value="1" <?php echo ($rating_search == 1)? 'selected' : '' ?>>Không thực hiện</option>
                        <option value="2" <?php echo ($rating_search == 2)? 'selected' : '' ?>>Điểm giảm dần</option>
                        <option value="3" <?php echo ($rating_search == 3)? 'selected' : '' ?>>Điểm tăng dần</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="form-control" name="team_search">
                        <option value="">Chọn nhóm HĐ...</option>
                        <?php if ($team): ?>
                            <?php foreach ($team as $key => $value): ?>
                                <option value="<?php echo $value['id'] ?>" <?php echo ($value['id'] == $team_search)? 'selected' : '' ?>><?php echo $value['name'] ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
                
                <div class="col-lg-4">
                    <input type="submit" name="btn-search" value="Tìm Kiếm" class="btn btn-primary" style="float: left">
                </div>
                
            </form>
            <!-- /.col -->
            <div class="col-md-12">
                    <div class="tab-content" style="margin-bottom: 40px;">
                        <?php if ($result): ?>
                            <div class="post box-body">
                                <table class="table table-striped table-bordered table-condensed" style="overflow:auto;">
                                    <th>STT</th>
                                    <th>Doanh nghiệp</th>
                                    <th>Tên sản phẩm/dịch vụ</th>
                                    <th>Nhóm HĐ</th>
                                    <th>Điểm trung bình</th>
                                    <th style="text-align: center;">Thao Tác</th>
                                    <?php foreach ($result as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $number-- ?></td>
                                        <td>
                                            <a href="<?php echo base_url('member/company/detail?year=' . $eventYear . '&identity=' . $value['identity']) ?>"><?php echo $value['company'] ?></a>
                                        </td>
                                        <td style="width: 40%;"><?php echo $global_stype[$value['name']] ?></td>
                                        <td>
                                           <?php echo $value['team'] ?> 
                                        </td>
                                        <td>
                                            <?php echo $value['rating_medium'] ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo base_url('member/product/detail_rating/' .$value['team_id'] . '/' . $value['id']) ?>" class="btn btn-info">Điểm chi tiết</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="post">Chưa có doanh nghiệp đăng ký!</div>
                        <?php endif ?>
                    </div>
                    <!-- /.tab-content -->
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

