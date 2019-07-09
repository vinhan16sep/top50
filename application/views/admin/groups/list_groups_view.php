<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content row">
            <a type="button" href="<?php echo site_url('admin/groups/create'); ?>" class="btn btn-primary">THÊM MỚI</a>
        <div class="container col-md-12">
            <div>
                <span><?php echo $this->session->flashdata('message'); ?></span>
            </div>
            <?php if ($groups): ?>
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 10px;">
                        <table class="table table-hover table-bordered table-condensed admin">
                            <tr>
                                <td><b><a href="#">Nhóm</a></b></td>
                                <td><b>Quản lý</b></td>
                            </tr>

                            <?php foreach ($groups as $group): ?>

                                <tr class="row_<?php echo $group->id; ?>">
                                    <td><a href="<?php echo base_url('admin/users/index/' . $group->id); ?>"><?php echo $group->name; ?></a></td>
                                    <td>
                                        <form class="form_ajax">
                                            <a href="<?php echo base_url('admin/groups/edit/' . $group->id); ?>" title="Chỉnh sửa">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            &nbsp&nbsp
                                            <a href="javascript:void(0);" onclick="deleteItem(<?php echo $group->id; ?>, '<?php echo base_url('admin/groups/delete'); ?>')" >
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
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