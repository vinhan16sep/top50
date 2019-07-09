<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    table td{
        vertical-align: middle !important;
    }
    table.table-bordered{
        border:1px solid black;
        margin-top:20px;
    }
    table.table-bordered > thead > tr > th{
        border:1px solid black;
    }
    table.table-bordered > tbody > tr > td{
        border:1px solid black;
    }
</style>
<?php
$rate = (array) json_decode($rating['rating']);
$enable = ($rate) ? 0 : 1;
$arrRate = [];
    foreach($rate as $key => $val){
        $arrRate[$key] = $val;
    }
$total = ($arrRate) ? $arrRate['1'] + $arrRate['2'] + $arrRate['3'] + $arrRate['4'] + $arrRate['5'] + $arrRate['6'] + $arrRate['7'] : 0;

$is_readonly = ($rating['is_submit'] == 1) ? "readonly" : "";
$is_submit = ($rating['is_submit'] == 1) ? 1 : 0;
$form_action = ($rating && $is_submit == 0) ? 'member/new_rating/update_rating/' . $rating['id'] : 'member/new_rating/rating';
?>
<div class="content-wrapper" style="min-height: 916px;padding-bottom: 200px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="post">
                            <table class="table table-bordered" style="width: 100%">
                                <tr>
                                    <td  style="width: 20%"><h3>Sản phẩm: </h3></td>
                                    <td><h3><?php echo $detail['name']; ?></h3></td>
                                </tr>
                                <tr>
                                    <td><h4>Doanh nghiệp: </h4></td>
                                    <td><h4><?php echo $company['company']; ?></h4></td>
                                </tr>
                                <tr>
                                    <?php
                                    $main_services = array(
                                        1 => 'Các sản phẩm, giải pháp phần mềm tiêu biểu, được bình xét theo 24 lĩnh vực ứng dụng chuyên ngành',
                                        2 => 'Các sản phẩm, giải pháp ứng dụng công nghệ 4.0',
                                        3 => 'Các sản phẩm, giải pháp phần mềm mới',
                                        4 => 'Các sản phẩm, giải pháp của doanh nghiệp khởi nghiệp',
                                        5 => 'Các dịch vụ CNTT'
                                    );
                                    ?>
                                    <td><h4>Nhóm sản phẩm </h4></td>
                                    <td><h4><?php echo $main_services[$main_service]; ?></h4></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <?php
                        echo form_open_multipart($form_action, array('class' => 'form-horizontal', 'id' => 'rating1Form'));
                        echo form_hidden('member_id', $this->ion_auth->user()->row()->id);
                        echo form_hidden('product_id', $detail['id']);

                        echo form_hidden('total', set_value('total', $total), 'id="inputTotal" class="form-control" readonly');
                        ?>
                        <h3>TỔNG ĐIỂM: <span id="totalRating" style="color: red;"><?php echo ($rating) ? $total : 0; ?></span></h3>
                        <table class="table table-bordered rating-table" style="border: 1px solid black;">
                            <thead>
                            <tr>
                                <th class="col-sm-1">STT</th>
                                <th class="col-sm-2">Tiêu chí</th>
                                <th class="col-sm-1">Trọng số (%)</th>
                                <th class="col-sm-1">Điểm chính</th>
                                <th class="col-sm-2">Tiêu chí chi tiết</th>
                                <th class="col-sm-1">Trọng số (%)</th>
                                <th class="col-sm-1">Điểm phụ</th>
                            </tr>
                            </thead>

                            <!------------------------------------------ 1 ------------------------------------------>
                            <tbody>
                            <tr>
                                <td rowspan="2">1</td>
                                <td rowspan="2">Tính độc đáo / sáng tạo</td>
                                <td rowspan="2">15</td>
                                <td rowspan="2">
                                    <?php echo $arrRate['1'] ?>
                                </td>
                                <td>Công nghệ sáng tạo / độc đáo</td>
                                <td>60</td>
                                <td>
                                    <?php echo ($arrRate['1_1'] != 0) ? ltrim($arrRate['1_1'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Định hình/phù hợp xu hướng</td>
                                <td>40</td>
                                <td>
                                    <?php echo ($arrRate['1_2'] != 0) ? ltrim($arrRate['1_2'], '0') : 0 ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 2 ------------------------------------------>

                            <tr>
                                <td rowspan="3">2</td>
                                <td rowspan="3">Tính hiệu quả</td>
                                <td rowspan="3">15</td>
                                <td rowspan="3">
                                    <?php echo $arrRate['2'] ?>
                                </td>
                                <td>Tối ưu quy trình, quản lý</td>
                                <td>40</td>
                                <td>
                                    <?php echo ($arrRate['2_1'] != 0) ? ltrim($arrRate['2_1'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tăng năng suất</td>
                                <td>30</td>
                                <td>
                                    <?php echo ($arrRate['2_2'] != 0) ? ltrim($arrRate['2_2'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiết kiệm chi phí sản xuất</td>
                                <td>30</td>
                                <td>
                                    <?php echo ($arrRate['2_3'] != 0) ? ltrim($arrRate['2_3'], '0') : 0 ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 3 ------------------------------------------>

                            <tr>
                                <td rowspan="2">3</td>
                                <td rowspan="2">Tiềm năng thị trường</td>
                                <td rowspan="2">15</td>
                                <td rowspan="2">
                                    <?php echo $arrRate['3'] ?>
                                </td>
                                <td>Thị phần và tiềm năng thị trường</td>
                                <td>60</td>
                                <td>
                                    <?php echo ($arrRate['3_1'] != 0) ? ltrim($arrRate['3_1'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Mô hình, chiến lược kinh doanh</td>
                                <td>40</td>
                                <td>
                                    <?php echo ($arrRate['3_2'] != 0) ? ltrim($arrRate['3_2'], '0') : 0 ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 4 ------------------------------------------>

                            <tr>
                                <td rowspan="3">4</td>
                                <td rowspan="3">Tính năng</td>
                                <td rowspan="3">15</td> 
                                <td rowspan="3">
                                    <?php echo $arrRate['4'] ?>
                                </td>
                                <td>Đáp ứng nhu cầu người dùng</td>
                                <td>50</td>
                                <td>
                                    <?php echo ($arrRate['4_1'] != 0) ? ltrim($arrRate['4_1'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Khả năng tương thích và phát triển tùy biến</td>
                                <td>25</td>
                                <td>
                                    <?php echo ($arrRate['4_2'] != 0) ? ltrim($arrRate['4_2'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tính năng bảo mật</td>
                                <td>25</td>
                                <td>
                                    <?php echo ($arrRate['4_3'] != 0) ? ltrim($arrRate['4_3'], '0') : 0 ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 5 ------------------------------------------>

                            <tr>
                                <td rowspan="3">5</td>
                                <td rowspan="3">Chất lượng dịch vụ</td>
                                <td rowspan="3">15</td>
                                <td rowspan="3">
                                    <?php echo $arrRate['5'] ?>
                                </td>
                                <td>Công nghệ tiên tiến/tỉ lệ lỗi/sự hài lòng của khách hàng</td>
                                <td>40</td>
                                <td>
                                    <?php echo ($arrRate['5_1'] != 0) ? ltrim($arrRate['5_1'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Các tiêu chuẩn áp dụng</td>
                                <td>30</td>
                                <td>
                                    <?php echo ($arrRate['5_2'] != 0) ? ltrim($arrRate['5_2'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Chăm sóc khách hàng và hậu mãi</td>
                                <td>30</td>
                                <td>
                                    <?php echo ($arrRate['5_3'] != 0) ? ltrim($arrRate['5_3'], '0') : 0 ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 6 ------------------------------------------>

                            <tr>
                                <td rowspan="3">6</td>
                                <td rowspan="3">Tài chính/doanh thu/ tác động kinh tế, xã hội/số lượng người sử dụng</td>
                                <td rowspan="3">20</td>
                                <td rowspan="3">
                                    <?php echo $arrRate['6'] ?>
                                </td>
                                <td>Doanh thu dịch vụ</td>
                                <td>50</td>
                                <td>
                                    <?php echo ($arrRate['6_1'] != 0) ? ltrim($arrRate['6_1'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Số lượng người/DN/tổ chức sử dụng</td>
                                <td>25</td>
                                <td>
                                    <?php echo ($arrRate['6_2'] != 0) ? ltrim($arrRate['6_2'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tác động kinh tế, xã hội</td>
                                <td>25</td>
                                <td>
                                    <?php echo ($arrRate['6_3'] != 0) ? ltrim($arrRate['6_3'], '0') : 0 ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 7 ------------------------------------------>

                            <tr>
                                <td rowspan="3">7</td>
                                <td rowspan="3">Chất lượng hồ sơ, năng lực trình bày</td>
                                <td rowspan="3">10</td>
                                <td rowspan="3">
                                    <?php echo $arrRate['7'] ?>
                                </td>
                                <td>Chuẩn bị hồ sơ hoàn chỉnh</td>
                                <td>30</td>
                                <td>
                                    <?php echo ($arrRate['7_1'] != 0) ? ltrim($arrRate['7_1'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Trình bày rõ ràng, thông tin chính xác</td>
                                <td>40</td>
                                <td>
                                    <?php echo ($arrRate['7_2'] != 0) ? ltrim($arrRate['7_2'], '0') : 0 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Trả lời tốt các câu hỏi</td>
                                <td>30</td>
                                <td>
                                    <?php echo ($arrRate['7_3'] != 0) ? ltrim($arrRate['7_3'], '0') : 0 ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <div class="right">
                    <?php
                    if(!$rating || ($rating && $is_submit == 0)){
                        echo form_submit('submit', 'Gửi điểm', 'class="btn btn-primary pull-right" style="width:40%;"');
                    }
                    echo form_close();
                    ?>
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
<script>
    $('.sub').change(function(){
        let main1 = (parseInt($('#1_1').val()) * 0.6 + parseInt($('#1_2').val()) * 0.4) * 0.15;
        $('#1').val(Number(main1.toFixed(2)));

        let main2 = (parseInt($('#2_1').val()) * 0.4 + parseInt($('#2_2').val()) * 0.3 + parseInt($('#2_3').val()) * 0.3) * 0.15;
        $('#2').val(Number(main2.toFixed(2)));

        let main3 = (parseInt($('#3_1').val()) * 0.6 + parseInt($('#3_2').val()) * 0.4) * 0.15;
        $('#3').val(Number(main3.toFixed(2)));

        let main4 = (parseInt($('#4_1').val()) * 0.5 + parseInt($('#4_2').val()) * 0.25 + parseInt($('#4_3').val()) * 0.25) * 0.15;
        $('#4').val(Number(main4.toFixed(2)));

        let main5 = (parseInt($('#5_1').val()) * 0.4 + parseInt($('#5_2').val()) * 0.3 + parseInt($('#5_3').val()) * 0.3) * 0.15;
        $('#5').val(Number(main5.toFixed(2)));

        let main6 = (parseInt($('#6_1').val()) * 0.5 + parseInt($('#6_2').val()) * 0.25 + parseInt($('#6_3').val()) * 0.25) * 0.2;
        $('#6').val(Number(main6.toFixed(2)));

        let main7 = (parseInt($('#7_1').val()) * 0.3 + parseInt($('#7_2').val()) * 0.4 + parseInt($('#7_3').val()) * 0.3) * 0.1;
        $('#7').val(Number(main7.toFixed(2)));

        $('#totalRating').html(Number((main1 + main2 + main3 + main4 + main5 + main6 + main7).toFixed(2)));
        $('input[name="total"]').val(Number((main1 + main2 + main3 + main4 + main5 + main6 + main7).toFixed(2)));
    });

    $('#rating1Form').validate({
        submitHandler: function(e){
            var form = $('#rating1Form');
            var url = form.attr('action');

            for(let i = 1; i <= 7; i++){
                if($('#' + i).val() == ''){
                    alert('Chưa chấm hết tất cả các mục');
                    return false;
                }
            }

            $.ajax({
                type: "GET",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(result){
                    let data = JSON.parse(result);
                    if(data.name != undefined){
                        alert('Đã gửi điểm thành công');
                        window.location.reload();
                    }else{
                        alert(data.message)
                    }
                }
            });
            // $('rating1Form').unbind('submit').submit();
            e.preventDefault();
        }
    });
    $('.sub').each(function() {
        $(this).rules('add', {
            required: true,
            digits: true,
            max: 10,
            messages: {
                required: 'Không được trống',
                digits: 'Điểm chỉ chứa ký tự số',
                max: 'Số phải nhỏ hơn hoặc bằng 10',
            }
        });
    });

    // $('#rating1Form').submit(function(e){
    //     var form = $(this);
    //     var url = form.attr('action');

    //     for(let i = 1; i <= 7; i++){
    //         if($('#' + i).val() == ''){
    //             alert('Chưa chấm hết tất cả các mục');
    //             return false;
    //         }
    //     }

    //     $.ajax({
    //         type: "GET",
    //         url: url,
    //         data: form.serialize(), // serializes the form's elements.
    //         success: function(result){
    //             let data = JSON.parse(result);
    //             if(data.name != undefined){
    //                 alert('Đã gửi điểm thành công');
    //                 window.location.reload();
    //             }else{
    //                 alert(data.message)
    //             }
    //         }
    //     });
    //     // $('rating1Form').unbind('submit').submit();
    //     e.preventDefault();
    // });
</script>

