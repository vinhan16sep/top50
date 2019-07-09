<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <div class="box-body pad table-responsive">
        <h3>Thông tin doanh nghiệp: <span style="color:red;"><?php echo $company['company']; ?></span></h3>
    </div>
    <section class="content">
        <input type="hidden" name="company_id" value="<?php echo $this->uri->segment(4) ?>" id="company_id">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-6">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="post">
                            <h4>Thông tin khác</h4>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <a><i class="fa fa-globe margin-r-5"></i> Website</a> <p class="pull-right"><?php echo $company['website'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-user margin-r-5"></i> Tên người đại diện pháp luật</a> <p class="pull-right"><?php echo $company['legal_representative'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-star margin-r-5"></i> Chức danh</a> <p class="pull-right"><?php echo $company['lp_position'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-envelope margin-r-5"></i> Email</a> <p class="pull-right"><?php echo $company['lp_email'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-mobile margin-r-5"></i> Di động</a> <p class="pull-right"><?php echo $company['lp_phone'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-user margin-r-5"></i> Tên người liên hệ với BTC</a> <p class="pull-right"><?php echo $company['connector'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-star margin-r-5"></i> Chức danh</a> <p class="pull-right"><?php echo $company['c_position'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-envelope margin-r-5"></i> Email</a> <p class="pull-right"><?php echo $company['c_email'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-mobile margin-r-5"></i> Di động</a> <p class="pull-right"><?php echo $company['c_phone'] ?></p>
                                </li>
                                <p class="" style="padding-top:10px;">
                                    <a><i class="fa fa-download margin-r-5"></i> Link download PĐK của DN</a>
                                </p>
                                <p class="">
                                    <a style="text-decoration: underline;" href="<?php echo $company['link'] ?>" target="_blank"><i class="margin-r-5"></i> <?php echo $company['link'] ?></a>
                                </p>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <a type="button" href="http://dangky.danhhieusaokhue.vn/admin/company/export_company_detail/<?php echo $company['company_id'] ?>" class="btn btn-success" style="margin-bottom: 20px">EXPORT DATA DOANH NGHIỆP</a>
                    </div>
                    <!-- /.tab-content -->
                </div>
                
                <!-- /.nav-tabs-custom -->
            </div>
            <div class="col-md-6">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="post">
                            <h4>Thông tin doanh nghiệp</h4>
                            <ul class="list-group list-group-unbordered">




                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Vốn điều lệ năm <?php echo $rule3Year[0] ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['equity_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Vốn điều lệ năm <?php echo $rule3Year[1] ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['equity_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Vốn điều lệ năm <?php echo $rule3Year[2] ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['equity_3'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Vốn chủ sở hữu <?php echo $rule3Year[0] ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['owner_equity_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Vốn chủ sở hữu <?php echo $rule3Year[1] ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['owner_equity_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Vốn chủ sở hữu <?php echo $rule3Year[2] ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['owner_equity_3'] ?></p>
                                </li>

                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu DN <?php echo $rule3Year[0] ?></a> <p class="pull-right"><?php echo $company['total_income_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu DN <?php echo $rule3Year[1] ?></a> <p class="pull-right"><?php echo $company['total_income_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu DN <?php echo $rule3Year[2] ?></a> <p class="pull-right"><?php echo $company['total_income_3'] ?></p>
                                </li>

                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng DT lĩnh vực sx phần mềm <?php echo $rule3Year[0] ?> (Triệu VND)</a> <p class="pull-right"><?php echo $company['software_income_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng DT lĩnh vực sx phần mềm <?php echo $rule3Year[1] ?> (Triệu VND)</a> <p class="pull-right"><?php echo $company['software_income_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng DT lĩnh vực sx phần mềm <?php echo $rule3Year[2] ?> (Triệu VND)</a> <p class="pull-right"><?php echo $company['software_income_3'] ?></p>
                                </li>

                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu dịch vụ CNTT <?php echo $rule3Year[0] ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['it_income_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu dịch vụ CNTT <?php echo $rule3Year[1] ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['it_income_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu dịch vụ CNTT <?php echo $rule3Year[2] ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['it_income_3'] ?></p>
                                </li>

                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng DT xuất khẩu (USD) <?php echo $rule3Year[0] ?></a> <p class="pull-right"><?php echo $company['export_income_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng DT xuất khẩu (USD) <?php echo $rule3Year[1] ?></a> <p class="pull-right"><?php echo $company['export_income_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng DT xuất khẩu (USD) <?php echo $rule3Year[2] ?></a> <p class="pull-right"><?php echo $company['export_income_3'] ?></p>
                                </li>

                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Tổng số lao động của DN <?php echo $rule3Year[0] ?></a> <p class="pull-right"><?php echo $company['total_labor_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Tổng số lao động của DN <?php echo $rule3Year[1] ?></a> <p class="pull-right"><?php echo $company['total_labor_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Tổng số lao động của DN <?php echo $rule3Year[2] ?></a> <p class="pull-right"><?php echo $company['total_labor_3'] ?></p>
                                </li>

                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Tổng số LTV <?php echo $rule3Year[0] ?></a> <p class="pull-right"><?php echo $company['total_ltv_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Tổng số LTV <?php echo $rule3Year[1] ?></a> <p class="pull-right"><?php echo $company['total_ltv_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Tổng số LTV <?php echo $rule3Year[2] ?></a> <p class="pull-right"><?php echo $company['total_ltv_3'] ?></p>
                                </li>

                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Giới thiệu chung</a> <p class="" style="padding-left:20px;"><?php echo $company['description'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> SP dịch vụ chính của DN</a>
                                    <?php if( !empty($company['main_service']) && $company['main_service'] != 'null' && $company['main_service'] != null ): ?>
                                    <?php $main_service = json_decode($company['main_service']) ?>
                                    <?php foreach ($main_service as $key => $value): ?>
                                        <p class="" style="padding-left:20px;"><?php echo $value ?></p>
                                    <?php endforeach ?>
                                    <?php endif; ?>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-globe margin-r-5"></i> Thị trường chính</a>
                                    <?php if( !empty($company['main_market']) && $company['main_market'] != 'null' && $company['main_market'] != null ): ?>
                                        <?php $main_market = json_decode($company['main_market']) ?>
                                        <?php foreach ($main_market as $key => $value): ?>
                                            <p class="" style="padding-left:20px;"><?php echo $value ?></p>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
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
<script type="text/javascript">
    var url = location.protocol + "//" + location.host + (location.port ? ':' + location.port : '');
    $('.change-member').change(function(){
        var member_id = $(this).val();
        var client_id = $(this).parents('li').data('company');
        var company_id = $('#company_id').val();
        if(confirm('Thêm người quản lý cho doanh nghiệp này?')){
            jQuery.ajax({
                method: "get",
                url: url + '/admin/company/add_member',
                data: {member_id : member_id, client_id : client_id, company_id : company_id},
                success: function(result){
                    if(JSON.parse(result).isExitsts == true){
                        alert('Thêm thành công');
                        window.location.href = "http://dangky.danhhieusaokhue.vn/admin/company";
                        // window.location.href = "http://localhost/dhsk/admin/company";
                    }
                }
            });
        };
    });
</script>

