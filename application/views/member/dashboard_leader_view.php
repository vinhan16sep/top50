<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <!-- <div class="box-body pad table-responsive">
        <h3>Trang thông tin: <span style="color:red;"><?php echo $user->company; ?></span></h3>
    </div> -->
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
                        
                        <?php foreach ($team as $key => $value): ?>
                            <div class="panel panel-info">
                                <div class="panel-heading"><h4>Nhóm: <span style="color: red"><?php echo $value['name']; ?></span></h4></div>
                                <div class="panel-body">
                                    <!--main content start-->
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                                <div class="tab-content">
                                                    <?php if ( isset($value['member_list'])): ?>
                                                    <div class="post box-body">
                                                        <table class="table table-striped table-bordered table-condensed">
                                                            <tr>
                                                                <td class="col-sm-1" style="font-weight:bold;color: #31708f;">STT</td>
                                                                <td class="col-sm-5" style="font-weight:bold;color: #31708f;">Tên Tài Khoản</td>
                                                                <td class="col-sm-1" style="text-align: center;font-weight:bold;color: #31708f;">Thao Tác</td>
                                                            </tr>
                                                            <?php foreach ($value['member_list'] as $key => $value): ?>
                                                                <tr>
                                                                    <td><?php echo $key + 1 ?></td>
                                                                    <td><?php echo $value['username']; ?></td>
                                                                    <td style="text-align: center; width: 40%">
                                                                        <a href="">
                                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                                        </a>
                                                                        <a href="">
                                                                            <i class="fa fa-paint-brush" aria-hidden="true"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>
                                                            
                                                        </table>
                                                    </div>
                                                    <?php else: ?>
                                                        <div class="post">Không có thành viên được chỉ định!</div>
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

