<!--main content start-->
<link rel="stylesheet" href="<?php echo site_url('assets/admin/css/jquery.dataTables.min.css'); ?>" >
<script src="<?php echo site_url('assets/admin/js/admin/jquery.dataTables.min.js'); ?>"></script>
<style>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
    }
    #dtBasicExample{
        margin:0px;
        min-width: 100%;
    }
    #dtBasicExample_length select, #dtBasicExample_filter input{
        display: inline-block;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
    }
        
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <div class="box-body pad table-responsive">
        <h3>Thông tin tổng hợp</h3><a type="button" href="<?php echo site_url('admin/company/export'); ?>" class="btn btn-success">EXPORT DATA THÔNG TIN CƠ BẢN</a>
        <a type="button" href="<?php echo site_url('admin/company/export_product'); ?>" class="btn btn-success">EXPORT DATA LĨNH VỰC ỨNG CỬ</a>
    </div>

    <section class="content">

        <div class="row">
            <form action="<?php echo base_url('admin/company/index/' . $year) ?>" class="form-horizontal col-md-12 col-sm-12 col-xs-12" method="get" style="display: none;margin-bottom: 30px;">
                <input type="text" name="company_name" value="<?php echo ($criteria['company_name'] != '')? $criteria['company_name'] : '' ?>" placeholder="Tìm Kiếm Doanh Nghiệp..." class="form-control" style=" width: 40%; float: left;margin-right: 5px;">
                <select name="order_name" class="form-control">
                    <?php foreach($order_names as $key => $value){ ?>

                    <?php } ?>
                </select>
                <input type="submit" name="btn-search" value="Tìm Kiếm" class="btn btn-primary" style="float: left">
            </form>
            <!-- /.col -->
            <div class="col-md-12">
                    <div class="tab-content" style="margin-bottom: 40px;">
                        <?php if ($companies): ?>
                        <div class="post box-body">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-condensed">
                                <thead>  
                                    <tr>
                                        <td>STT</td>
                                        <td>Tên Doanh Nghiệp</td>
                                        <td>Tổng số nhân viên toàn thời gian</td>
                                        <td>Số lượng nhân viên bộ phận R&D</td>
                                        <td>Tổng doanh thu doanh nghiệp năm <?php echo $rule2Year[0] ?></td>
                                        <td>Tổng doanh thu doanh nghiệp năm <?php echo $rule2Year[1] ?></td>
                                        <td>Người quản lý</td>
                                        <td>Trạng thái</td>
                                        <td style="text-align: center;">Thao Tác</td>
                                    </tr>
                                </thead>
                                <?php foreach ($companies as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $number-- ?></td>
                                        <td><?php echo $value['company'] ?></td>
                                        <td><?php echo $value['full_time_employee'] ?></td>
                                        <td><?php echo $value['staff_r_and_d'] ?></td>
                                        <td><?php echo $value['total_income_1'] ?></td>
                                        <td><?php echo $value['total_income_2'] ?></td>
                                        <td data-client="<?php echo $value['client_id'] ?>" data-company="<?php echo $value['id'] ?>">
                                            <ul class="select2-selection__rendered ">
                                                <?php if (!empty($value['member_name'])): ?>
                                                    <?php foreach ($value['member_name'] as $k => $val): ?>
                                                        <li style="list-style: none;">
                                                                <span class="change-member" data-memberid="<?php echo $k ?>">
                                                                    <i style="color:red;" class="fa fa-close" aria-hidden="true"></i> 
                                                                </span>
                                                                <?php echo $val ?>
                                                        </li>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                                <?php if (empty($value['member_name'])): ?>
                                                    <li style="list-style: none;">Chưa có quản lý</li>
                                                <?php endif ?>
                                                
                                            </ul>
                                        </td>
                                        <?php if($this->ion_auth->user()->row()->email == 'admin@admin.com'){ ?>
                                            <td><?php echo ($value['final'] == 0) ? '<i style="color:red;" class="fa fa-times-circle" aria-hidden="true"></i>' : '<a id="openStatus" onclick="openStatus(' . $value['client_id'] . ');" href="javascript:void(0);"><i style="color:green;" class="fa fa-check-circle" aria-hidden="true"></i></a>'; ?></td>
                                        <?php }else{ ?>
                                            <td><?php echo ($value['final'] == 0) ? '<i style="color:red;" class="fa fa-times-circle" aria-hidden="true"></i>' : '<i style="color:green;" class="fa fa-check-circle" aria-hidden="true"></i>'; ?></td>
                                        <?php } ?>
                                        <td style="text-align: center;">
                                            <a href="<?php echo base_url('admin/company/detail/' . $value['id']) ?>" class="btn btn-info">Thông tin cơ bản</a>
                                            <a href="<?php echo base_url('admin/product/index/' . $value['client_id']) ?>" class="btn btn-info">Thông tin lĩnh vực ứng cử</a>
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
                <div class="col-md-6 col-md-offset-5 page" style="display: none;">
                    <?php echo $page_links ?>
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
</div>
<script src="<?php echo site_url('assets/admin/'); ?>bower_components/select2/dist/js/select2.full.js"></script>
<script type="text/javascript">
    var url = location.protocol + "//" + location.host + (location.port ? ':' + location.port : '');
    $('.change-member').click(function(){
        var change_member = $(this);
        var member_id = $(this).data('memberid');
        var client_id = $(this).parents('td').data('client');
        var company_id = $(this).parents('td').data('company');
        if(confirm('Chắc chắn xoá thành viên hội đồng?')){
            jQuery.ajax({
                method: "get",
                url: url + '/admin/company/change_member',
                data: {member_id : member_id, client_id : client_id, company_id : company_id},
                success: function(result){
                    if(JSON.parse(result).isExitsts == true){
                        $(change_member).parents('li').fadeOut();
                    }
                }
            });
        };
    });
</script>
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
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable({
            "columnDefs": [{
                 "targets": [0,6,7,8],
                 "orderable": false,
             }],
             "order": [[1, "asc"]]
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
