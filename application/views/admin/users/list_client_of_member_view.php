<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content row">
        <a type="button" href="<?php echo site_url('admin/users/create'); ?>" class="btn btn-primary">THÊM MỚI</a>
        <div class="container col-md-12">
            <div>
                <span><?php echo $this->session->flashdata('message'); ?></span>
            </div>
            <?php if ($users): ?>
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 10px;">
                        <table class="table table-hover table-bordered table-condensed admin">
                            <tr>
                                <td><b><a href="#">Username</a></b></td>
                                <td><b><a href="#">Họ tên</a></b></td>
                                <td><b><a href="#">Doanh nghiệp</a></b></td>
                                <td><b><a href="#">Điện thoại</a></b></td>
                                <td><b><a href="#">Email</a></b></td>
                                <td><b>Thao tác</b></td>
                            </tr>

                            <?php foreach ($users as $user): ?>

                                <tr class="row_<?php echo $user['id']; ?>">
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
                                    <td><a href="<?php echo base_url('admin/company/detail_by_client/' . $user['id']) ?>"><?php echo $user['company']; ?></a></td>
                                    <td><?php echo $user['phone']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td>
                                        <form class="form_ajax">
                                            <a href="<?php echo base_url('admin/users/edit/' . $user['id']); ?>" title="Chỉnh sửa">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            &nbsp&nbsp
                                            <a href="javascript:void(0);" onclick="deleteItem(<?php echo $user['id']; ?>, '<?php echo base_url('admin/users/delete'); ?>')" >
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                            &nbsp&nbsp
                                            <?php if($user['active'] == 0): ?>
                                            <a style="color:red;" href="javascript:void(0);" onclick="activeItem(<?php echo $user['id']; ?>, '<?php echo base_url('admin/users/active'); ?>')" >
                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                            </a>
                                            <?php else: ?>
                                            <a style="color:green;" href="javascript:void(0);">
                                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                            </a>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 10px;">
                        <table class="table table-hover table-bordered table-condensed">
                            <tr>Chưa có bài viết</tr>
                        </table>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </section>
</div>