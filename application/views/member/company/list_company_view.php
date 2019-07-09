<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <div class="box-body pad table-responsive">
        <h3>Danh sách doanh nghiệp được chỉ định</h3><a type="button" href="<?php echo site_url('member/company/export'); ?>" class="btn btn-success">EXPORT DATA</a>
    </div>

    <section class="content">

        <div class="row">
            <form action="<?php echo base_url('member/company/index/'.$user_id) ?>" class="form-horizontal col-md-12 col-sm-12 col-xs-12" method="get" style="margin-bottom: 30px;">
                <input type="text" name="search" value="<?php echo ($keywords != '')? $keywords : '' ?>" placeholder="Tìm Kiếm Danh Mục..." class="form-control" style=" width: 40%; float: left;margin-right: 5px;">
                <input type="submit" name="btn-search" value="Tìm Kiếm" class="btn btn-primary" style="float: left">
            </form>
            <!-- /.col -->
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <?php if ($companies): ?>
                        <?php $stt = 1; ?>
                        <div class="post">
                            <table class="table">
                                <th>STT</th>
                                <th>Tên Doanh Nghiệp</th>
                                <th style="text-align: center;">Thao Tác</th>
                                <?php foreach ($companies as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $stt++ ?></td>
                                        <td><?php echo $value['company'] ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo base_url('member/company/detail/' . $value['id']) ?>" class="btn btn-info">Xem chi tiết</a>
                                            <a href="<?php echo base_url('member/product/index/' . $value['client_id']) ?>" class="btn btn-info">Sản phẩm</a>
                                            
                                            
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
                </div>
                <div class="col-md-6 col-md-offset-5 page">
                    <!-- <?php echo $page_links ?> -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
</div>
<script type="text/javascript">
    var url = location.protocol + "//" + location.host + (location.port ? ':' + location.port : '');
    $('.change-member').change(function(){
        var member_id = $(this).val();
        var company_id = $(this).parent('td').data('company');
        if(confirm('Chắc chắn đổi viên hội đồng?')){
            jQuery.ajax({
                method: "get",
                url: url + '/working/admin/company/change_member',
                // url: location.protocol + "//" + location.host + (location.port ? ':' + location.port : '') + "/tuoithantien/comment/create_comment",
                data: {member_id : member_id, company_id : company_id},
                success: function(result){
                    // if(JSON.parse(result).isExists == false){
                    //     alert('Vui lòng xóa bài viết trong danh mục này trước');
                    // }else{
                    //     $(check).parents('tr').fadeOut();
                    // }
                }
            });
        };
    });
</script>

