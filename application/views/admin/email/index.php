<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách
            <small>
                E-Mail
            </small>
        </h1>
         <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?= base_url('admin/email') ?>"><i class="fa fa-dashboard"></i> Danh sách E-Mail</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif ?>
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif ?>
            </div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf" />
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            Danh sách
                        </h3>
                    </div>

                    <div class="row" style="padding: 10px;">
                        <div class="col-md-6">
                            <a href="<?php echo base_url('admin/email/create') ?>" class="btn btn-success"  >Thêm mới</a>
                            <!-- <a href="javascript:void(0)" data-url="<?php echo base_url('admin/email/send_email_all'); ?>" class="btn btn-default bg-purple btn-send-all"  >Gửi E-Mail tất cả</a> -->
                            <a href="javascript:void(0)" data-url="<?php echo base_url('admin/email/remove_all'); ?>" class="btn btn-danger btn-delete-all"  >Xóa tất cả</a>
                        </div>
                        <div class="col-md-6 hidden">
                            <form action="<?php echo base_url('admin/email/index') ?>" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm ..." name="search" value="<?php echo $keywords ?>">
                                    <span class="input-group-btn">
                                        <input type="submit" class="btn btn-block btn-primary" value="Tìm kiếm">
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive delete-checkbox">
                            <table id="table" class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i> &nbsp&nbsp All</th>
                                    <th>No.</th>
                                    <th>Tiêu đề</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $serial = 1; ?>
                                    <?php if ($result): ?>
                                        <?php foreach ($result as $key => $value): ?>
                                            <tr class="remove-<?= $value['id'] ?>">
                                                <td><input type="checkbox" name="ids[]" value="<?= $value['id'] ?>" class="ids" ></td>
                                                <td><?= $serial ?></td>
                                                <td><?php echo $value['title'] ?></td>
                                                <td>
                                                    <?php echo ($value['active'] == 1)? '<span class="label label-success">Kích hoạt</span>' : '<span class="label label-warning">Không kích hoạt</span>' ?>
                                                </td>
                                                <td>
                                                    <a data-toggle="collapse" href="#<?php echo $value['id'] ?>" aria-expanded="false" aria-controls="collapseExample" title="Xem chi tiết">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="<?= base_url('admin/email/edit/' . $value['id'] ) ?>" style="color: #f0ad4e" title="Cập nhật">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:void(0)" class="btn-delete" data-id="<?= $value['id'] ?>" data-url="<?= base_url('admin/email/remove' ) ?>" data-name="Email" style="color: #d9534f" title="Xóa">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="collapse" id="<?php echo $value['id'] ?>">
                                                        <div class="col-md-6">
                                                            <label>Mô Tả</label>
                                                            <div class="well">
                                                                <?php echo $value['description']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Nội Dung</label>
                                                            <div class="well">
                                                                <?php echo $value['content']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $serial++; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 col-md-offset-5 page">
                            <!-- <?php echo $page_links ?> -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>