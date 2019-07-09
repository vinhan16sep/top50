<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <div class="box-body pad table-responsive">
        <h3>Danh sách sản phẩm <span style="color:red;"><?php echo $client->company; ?></span></h3><a type="button" href="<?php echo site_url('admin/product/export/' . $client->id); ?>" class="btn btn-success">EXPORT DATA</a>
    </div>
    <section class="content">
        <?php 
            $main_service = array(
                'Các sản phẩm, giải pháp phần mềm tiêu biểu, được bình xét theo 24 lĩnh vực ứng dụng chuyên ngành',
                'Các sản phẩm, giải pháp ứng dụng công nghệ 4.0',
                'Các sản phẩm, giải pháp phần mềm mới',
                'Các sản phẩm, giải pháp của doanh nghiệp khởi nghiệp',
                'Các dịch vụ CNTT'
            );
        ?>
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

                                <?php if($this->ion_auth->user()->row()->email == 'admin@admin.com'){ ?>
                                <th style="text-align: center;width:30%;">Nhóm lĩnh vực chính</th>
                                <?php } ?>

                                <th style="text-align: center;">Thông tin / Kết quả</th>
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
                                        
                                        <?php if ( $value['is_rating'] == 0): ?>
                                            <td style="text-align: center;">
                                                <select id="" class="form-control selectMainService" style="width:90%;" data-id="<?php echo $value['id']; ?>">
                                                    <option value="">-- Lĩnh vực chính --</option>
                                                    <option value="1" <?php echo ($value['main_service'] == 1) ? 'selected' : ''; ?>>Các sản phẩm, giải pháp phần mềm tiêu biểu, được bình xét theo 24 lĩnh vực ứng dụng chuyên ngành</option>
                                                    <option value="2" <?php echo ($value['main_service'] == 2) ? 'selected' : ''; ?>>Các sản phẩm, giải pháp ứng dụng công nghệ 4.0</option>
                                                    <option value="3" <?php echo ($value['main_service'] == 3) ? 'selected' : ''; ?>>Các sản phẩm, giải pháp phần mềm mới</option>
                                                    <option value="4" <?php echo ($value['main_service'] == 4) ? 'selected' : ''; ?>>Các sản phẩm, giải pháp của doanh nghiệp khởi nghiệp</option>
                                                    <option value="5" <?php echo ($value['main_service'] == 5) ? 'selected' : ''; ?>>Các dịch vụ CNTT</option>
                                                </select>
                                            </td>

                                            <?php if($value['rating'] == 0): ?>
                                                <td style="text-align: center;"><a style="width:132px;" href="<?php echo base_url('admin/product/detail/' . $value['id']) ?>" class="btn btn-default">Chưa đánh giá</a></td>
                                            <?php else: ?>
                                                <?php if($value['rating'] == 1): ?>
                                                    <td style="text-align: center;"><a style="width:132px;" href="<?php echo base_url('admin/product/detail/' . $value['id']) ?>" class="btn btn-success">Đồng ý</a></td>
                                                <?php elseif($value['rating'] == 2): ?>
                                                    <td style="text-align: center;"><a style="width:132px;" href="<?php echo base_url('admin/product/detail/' . $value['id']) ?>" class="btn btn-warning">Đề nghị xem xét</a></td>
                                                <?php elseif($value['rating'] == 3): ?>
                                                    <td style="text-align: center;"><a style="width:132px;" href="<?php echo base_url('admin/product/detail/' . $value['id']) ?>" class="btn btn-danger">Không đồng ý</a></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <td style="text-align: center;"><a style="width:132px;" href="<?php echo base_url('admin/product/remove_product/' . $value['client_id'] . '/' . $value['id']) ?>" class="btn btn-danger" onclick="return confirm('Chắc chắn xóa sản phẩm?')">Xóa sản phẩm</a></td>

                                        <?php else: ?>
                                            <td>
                                                <?php
                                                    if ( $value['main_service'] !=  null && $value['main_service'] != '') {
                                                        echo $main_service[$value['main_service']];
                                                    }
                                                ?>
                                            </td>
                                        <?php endif ?>
                                        

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
                    <?php echo $page_links ?>
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
</div>
<script>
    $('.selectMainService').change(function(){
        $.ajax({
            method: 'GET',
            url: '<?php echo base_url('admin/product/set_main_service') ?>',
            data: {
                id: $(this).data('id'),
                main_service: $(this).val()
            },
            success: function(result){
                let data = JSON.parse(result);
                if(data.name != undefined){
                    alert('Đặt lĩnh vực chính ' + data.name);
                    window.location.reload();
                }else{
                    alert(data.message);
                    window.location.reload();
                }
            }
        });
    });
</script>

