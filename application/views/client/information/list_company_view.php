<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <h4 style="text-align: center;"><?php echo empty($companies) ? 'THÔNG TIN DOANH NGHIỆP' : 'Danh sách thông tin chi tiết của doanh nghiệp qua các năm' ?></h4>
                            <?php if ( !empty($companies) ): ?>
                                <div class="row">
                                    <div class="col-lg-12" style="margin-top: 10px;">
                                        <?php
                                        echo '<table class="table table-hover table-bordered table-condensed">';
                                        echo '<tr>';
                                        echo '<td class="col-md-1"><b>STT</b></td>';
                                        echo '<td class="col-md-5"><b>Năm</b></td>';
                                        echo '<td style="text-align: center !important;width:110px;" colspan="3" class="col-md-3"><b style="text-align: center !important;">Thao tác</b></td>';
                                        echo '</tr>';
                                        if (!empty($companies)) {
                                            foreach ($companies as $key => $value):
                                                echo '<tr>';
                                                echo '<td>' . ($key + 1) . '</td>';
                                                echo '<td><a href="javascript:void(0);">' . $value['year'] . '</a></td>';
                                                if($eventYear == $value['year']){ ?>
                                                    <td style="text-align: center;width:110px;">
                                                        <a style="width:132px;" href="<?php echo base_url('client/information/company?year=' . $value['year']); ?>" class="btn btn-primary btn-block">Xem thông tin</a>
                                                    </td>
                                                    <?php if($status['is_final'] == 0){ ?>
                                                    <td style="text-align: center;width:110px;">
                                                        <a style="width:132px;" href="<?php echo base_url('client/information/edit_company?year=' . $value['year']); ?>" class="btn btn-primary btn-block">Sửa thông tin</a>
                                                    </td>
                                                    <td style="text-align: center;width:110px;">
                                                        <a id="complete" onclick="return complete();" <?php echo ($status['is_product'] == 0) ? 'disabled="disabled"' : '';?> style="display: inline;" href="#" class="btn btn-warning pull-right">Hoàn thành đăng ký</a>
                                                    </td>
                                                    <?php } else { ?>
                                                        <h4 style="color:red">Thông tin đã được gửi</h4>
                                                    <?php } ?>
                                                <?php
                                                }else{
                                                    echo '<td>Không thể sửa</td>';
                                                }
                                                echo '</tr>';
                                            endforeach;
                                        }else {
                                            echo '<tr class="odd"><td colspan="9">Chưa đăng ký thông tin nào</td></tr>';
                                        }
                                        echo '</table>';
                                        ?>
                                        <div class="col-md-6 col-md-offset-5">
                                            <?php echo $page_links; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($reg_status['is_final'] == 0): ?>
                                <?php if($hasCurrentYearCompanyData == 0){ ?>
                                <a href="<?php echo base_url('client/information/create_company?year=' . $eventYear); ?>" class="btn btn-primary btn-block"><b>Thêm thông tin</b></a>
                                <?php } ?>
                            <?php else: ?>
                                <h4 style="color:red">Thông tin đã được gửi</h4>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chọn năm</h4>
            </div>
            <div class="modal-body">
                <select class="form-control" id="selected_year">
                    <?php for(($i = date('Y') - 3); ($i <= date('Y') + 1); $i++){ ?>
                        <option value="<?php echo $i; ?>" <?php echo ($i == date('Y')) ? 'selected="selected"' : ''; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <a onclick="this.href='<?php echo base_url("client/information/create_company") ?>?year='+document.getElementById('selected_year').value" class="btn btn-warning btn-block"><b>Nhập thông tin</b></a>
            </div>
        </div>

    </div>
</div>
<script>
    function complete(){
        if(confirm('Mời quay lại trang Tổng quan để xem lại hồ sơ/nộp cho Ban tổ chức')){
            window.location.href = '<?php echo base_url('client/dashboard') ?>';
        }
    }
</script>
