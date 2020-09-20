<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <div class="box-body pad table-responsive">
        <h3>Chức danh: <span style="color:red;"><?php echo $member_role;  ?></span></h3>
    </div>
    <section class="content">
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
                        <?php foreach ($team as $key => $val): ?>
                            <?php 
                                $team_id = $val['id'];
                            ?>
                            <div class="panel panel-info">
                                <div class="panel-heading"><h4>Nhóm: <span style="color: red"><?php echo $val['name']; ?></span></h4></div>
                                <div class="panel-body">
                                    <!--main content start-->
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                                <div class="tab-content">
                                                    <?php if ( isset($val['list_companies'])): ?>
                                                    <div class="post box-body">
                                                        <table class="table table-striped table-bordered table-condensed">
                                                            <tr>
                                                                <td style="font-weight:bold;color: #31708f;; width: 5%">STT</td>
                                                                <td style="font-weight:bold;color: #31708f;">Doanh nghiệp</td>
                                                                <td style="font-weight:bold;color: #31708f;">Mã số thuế</td>
                                                                <td style="text-align: center;font-weight:bold;color: #31708f; width: 8%">Thao Tác</td>
                                                            </tr>
                                                            <?php foreach ($val['list_companies'] as $key => $value): ?>
                                                                <?php  
                                                                    $group = json_decode($value['group'], true);
                                                                    $value['main_service'] = 1;
                                                                    if (in_array(4, $group)) {
                                                                        $value['main_service'] = 2;
                                                                    }
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $key + 1 ?></td>
                                                                    <td><?php echo $value['companyName']; ?></td>
                                                                    <td><?php echo $value['companyUsername']; ?></td>
                                                                    <td style="text-align: center;">
                                                                        <a href="<?php echo base_url('member/basic/detail/' . $value['id'] . '?client_id=' . $value['client_id']) ?>" data-toggle="tooltip" data-placement="top" title="Thông tin cơ bản">
                                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                                        </a>
                                                                        <a href="<?php echo base_url('member/company/detail?client_id=' . $value['client_id'] . '&year=' . $eventYear) ?>" data-toggle="tooltip" data-placement="top" title="Thông tin lĩnh vực ứng cử">
                                                                            <i class="fa fa-building" aria-hidden="true"></i>
                                                                        </a>
                                                                        <a href="<?php echo base_url('member/new_rating/index/?id=' . $value['id'] . '&main_service=' . $value['main_service']); ?>" data-toggle="tooltip" data-placement="top" title="Chấm điểm">
                                                                            <i class="fa fa-paint-brush" aria-hidden="true"></i>
                                                                        </a>
                                                                        <?php if ($this->ion_auth->user()->row()->member_role == 'leader'): ?>
                                                                            <a href="<?php echo base_url('member/list_user/index/' . $team_id . '/' . $value['id']) ?>" data-toggle="tooltip" data-placement="top" title="Thông tin chấm điểm của cả nhóm hội đồng">
                                                                                <i class="fa fa-users" aria-hidden="true"></i>
                                                                            </a>
                                                                        <?php endif ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>

                                                        </table>
                                                    </div>
                                                    <?php else: ?>
                                                        <div class="post">Không có sản phẩm được chỉ định!</div>
                                                    <?php endif ?>
                                                </div>
                                                <!-- /.tab-content -->
                                            <!-- /.nav-tabs-custom -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>

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

