<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content row">
        
        <div class="row" style="padding: 10px;">
            <div class="col-md-6">
                <a type="button" href="<?php echo site_url('admin/users/create/' . $group); ?>" class="btn btn-primary">THÊM MỚI</a>
            </div>
            <div class="col-md-6">
                <form action="<?php echo base_url('admin/users/index/' . $group_id) ?>" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm Mã số thuế, Tên doanh nghiệp, Email" name="search" value="<?= $keywords ?>">
                        <span class="input-group-btn">
                            <input type="submit" class="btn btn-block btn-primary" value="Tìm kiếm">
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="container col-md-12">
            <div>
                <span><?php echo $this->session->flashdata('message'); ?></span>
            </div>
            <?php if ($users): ?>
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 10px;">
                        <table class="table table-striped table-bordered table-condensed admin">
                            <tr>
                                <td style="width: 3%"><b><a href="#">STT</a></b></td>
                                <td><b><a href="#">Mã số thuế</a></b></td>
                                <td><b><a href="#">Doanh nghiệp</a></b></td>
                                <td><b><a href="#">E-Mail</a></b></td>
                                <td style="width: 10%;"><b><a href="#">Thời gian tạo</a></b></td>
                                <?php if ($this->uri->segment(4) == 3): ?>
                                <td><b><a href="#">T/t cơ bản</a></b></td>
                                <td><b><a href="#">T/t lĩnh vực ứng cử</a></b></td>
                                <td><b><a href="#">Lĩnh vực</a></b></td>
                                <td><b><a href="#">D/K top 10</a></b></td>
                                <td><b><a href="#">Đã gửi</a></b></td>
                                <?php endif; ?>
                                <?php if ($this->uri->segment(4) == 2): ?>
                                <td><b><a href="#">DN được chỉ định</a></b></td>
                                <?php elseif($this->uri->segment(4) == 3): ?>
                                <!--<td><b><a href="#">Người quản lý</a></b></td>-->
                                <?php endif ?>
                                <td><b>Thao tác</b></td>
                            </tr>

                            <?php foreach ($users as $key => $user): ?>
                                <?php $group_join = ($user['group_join']['group'] == null) ? 3 : $user['group_join']['group']; ?>
                                <tr class="row_<?php echo $user['id']; ?>">
                                    <td><?php echo $number--; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['company']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo date('d-m-Y H:i:s',$user['created_on']); ?></td>
                                    <?php if ($this->uri->segment(4) == 3): ?>
                                    <td style="text-align:center"><?php echo ($user['status']['is_information'] == 0) ? '<i style="color:red;" class="fa fa-times-circle" aria-hidden="true"></i>' : '<i style="color:green;" class="fa fa-check-circle" aria-hidden="true"></i>'; ?></td>
                                    <td style="text-align:center"><?php echo ($user['status']['is_company'] == 0) ? '<i style="color:red;" class="fa fa-times-circle" aria-hidden="true"></i>' : '<i style="color:green;" class="fa fa-check-circle" aria-hidden="true"></i>'; ?></td>
                                    <td ><?php echo $group_selected[$group_join]; ?></td>
                                    <td style="text-align:center"><?php echo ($user['group_join']['group10'] == null) ? '<i style="color:red;" class="fa fa-times-circle" aria-hidden="true"></i>' : '<i style="color:green;" class="fa fa-check-circle" aria-hidden="true"></i>'; ?></td>
                                    <td style="text-align:center"><?php echo ($user['status']['is_final'] == 0) ? '<i style="color:red;" class="fa fa-times-circle" aria-hidden="true"></i>' : '<a id="openStatus" onclick="openStatus(' . $user['user_id'] . ');" href="javascript:void(0);"><i style="color:green;" class="fa fa-check-circle" aria-hidden="true"></i></a>'; ?></td>
                                    <?php endif; ?>
                                    <!--<td>-->
                                    <!--    <?php if ($this->uri->segment(4) == 2): ?>-->
                                    <!--    <a href="<?php echo base_url('admin/users/list_client/' . $user['id']); ?>" title="Danh sách">-->
                                    <!--        Xem danh sách-->
                                    <!--    </a>-->
                                    <!--    <?php elseif($this->uri->segment(4) == 3 && $user['member_id'] != null): ?>-->
                                    <!--    <a href="<?php echo base_url('admin/users/edit/' . $user['member_id']); ?>" title="Người quản lý">-->
                                    <!--        Xem thông tin-->
                                    <!--    </a>-->
                                    <!--    <?php endif ?>-->
                                    <!--</td>-->
                                    <td>
                                        <form class="form_ajax">
                                            <a href="<?php echo base_url('admin/users/edit/' . $user['user_id']); ?>" title="Xem">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            &nbsp&nbsp
                                            <a href="javascript:void(0);" onclick="deleteItem(<?php echo $user['user_id']; ?>, '<?php echo base_url('admin/users/delete'); ?>')" >
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                            &nbsp&nbsp
                                            <!--<?php if($user['active'] == 0): ?>-->
                                            <!--<a style="color:red;" href="javascript:void(0);" onclick="activeItem(<?php echo $user['id']; ?>, '<?php echo base_url('admin/users/active'); ?>')" >-->
                                            <!--    <i class="fa fa-times-circle" aria-hidden="true"></i>-->
                                            <!--</a>-->
                                            <!--<?php else: ?>-->
                                            <!--<a style="color:green;" href="javascript:void(0);">-->
                                            <!--    <i class="fa fa-check-circle" aria-hidden="true"></i>-->
                                            <!--</a>-->
                                            <!--<?php endif; ?>-->
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                    <div class="col-md-6 col-md-offset-5 page">
                        <?php echo $page_links ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 10px;">
                        <table class="table table-hover table-bordered table-condensed">
                            <tr>Không có kết quả phù hợp</tr>
                        </table>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </section>
</div>
<script>
    function openStatus(userId){
        if(confirm("Chắc chắn mở lại cho doanh nghiệp đã chọn nhập lại thông tin?")){
            $.ajax({
                url: "<?php echo base_url('admin/users/open_final/'); ?>" + userId,
                success: function(result){
                    if(JSON.parse(result).message == 'done'){
                        if(!alert('Doanh nghiệp cần xác nhận lại toàn bộ thông tin, nếu muốn gửi lại Ban tổ chức')){window.location.reload();}
                    }
                }
            });
        }

    }
</script>