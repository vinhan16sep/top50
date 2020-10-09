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
$total = ($arrRate) ? $arrRate['1'] + $arrRate['2'] + $arrRate['3'] + $arrRate['4'] + $arrRate['5'] : 0;

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
                                    <td><h4>Doanh nghiệp: </h4></td>
                                    <td><h4><?php echo $company['company']; ?></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Nhóm lĩnh vực </h4></td>
                                    <td><h4><?php echo $this->config->item('development/config_information')['groups'][$detail['name']]; ?></h4></td>
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
                                <td rowspan="3">1</td>
                                <td rowspan="3">Năng lực tổ chức</td>
                                <td rowspan="3">10</td>
                                <td rowspan="3">
                                    <?php
                                    echo form_error('1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('1', set_value('1', $arrRate['1']), 'class="form-control main" readonly id="1"');
                                    }else{
                                        echo form_input('1', set_value('1', 0), 'class="form-control main" readonly id="1"');
                                    }
                                    ?>
                                </td>
                                <td>Quy mô đào tạo CNTT</td>
                                <td>40</td>
                                <td>
                                    <?php
                                    echo form_error('1_1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('1_1', set_value('1_1', ($arrRate['1_1'] != 0) ? ltrim($arrRate['1_1'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="1_1"');
                                    }else{
                                        echo form_input('1_1', set_value('1_1', 0), 'class="form-control sub" id="1_1"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Nhân sự</td>
                                <td>30</td>
                                <td>
                                    <?php
                                    echo form_error('1_2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('1_2', set_value('1_2', ($arrRate['1_2'] != 0) ? ltrim($arrRate['1_2'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="1_2"');
                                    }else{
                                        echo form_input('1_2', set_value('1_2', 0), 'class="form-control sub" id="1_2"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tài chính</td>
                                <td>30</td>
                                <td>
                                    <?php
                                    echo form_error('1_3', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('1_3', set_value('1_3', ($arrRate['1_3'] != 0) ? ltrim($arrRate['1_3'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="1_3"');
                                    }else{
                                        echo form_input('1_3', set_value('1_3', 0), 'class="form-control sub" id="1_3"');
                                    }
                                    ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 2 ------------------------------------------>

                            <tr>
                                <td rowspan="4">2</td>
                                <td rowspan="4">Năng lực đào tạo</td>
                                <td rowspan="4">20</td>
                                <td rowspan="4">
                                    <?php
                                    echo form_error('2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('2', set_value('2', $arrRate['2']), 'class="form-control main" readonly id="2"');
                                    }else{
                                        echo form_input('2', set_value('2', 0), 'class="form-control main" readonly id="2"');
                                    }
                                    ?>
                                </td>
                                <td>Các khoá đào tạo CNTT (bao gồm cả đào tạo trực tuyến nếu có)</td>
                                <td>55</td>
                                <td>
                                    <?php
                                    echo form_error('2_1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('2_1', set_value('2_1', ($arrRate['2_1'] != 0) ? ltrim($arrRate['2_1'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="2_1"');
                                    }else{
                                        echo form_input('2_1', set_value('2_1', 0), 'class="form-control sub" id="2_1"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Các chương trình đào tạo các công nghệ mới</td>
                                <td>15</td>
                                <td>
                                    <?php
                                    echo form_error('2_2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('2_2', set_value('2_2', ($arrRate['2_2'] != 0) ? ltrim($arrRate['2_2'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="2_2"');
                                    }else{
                                        echo form_input('2_2', set_value('2_2', 0), 'class="form-control sub" id="2_2"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Các hoạt động ngoại khoá, các Câu lạc bộ chuyên môn</td>
                                <td>15</td>
                                <td>
                                    <?php
                                    echo form_error('2_3', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('2_3', set_value('2_3', ($arrRate['2_3'] != 0) ? ltrim($arrRate['2_3'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="2_3"');
                                    }else{
                                        echo form_input('2_3', set_value('2_3', 0), 'class="form-control sub" id="2_3"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Các hoạt động đào tạo liên danh, liên kết</td>
                                <td>15</td>
                                <td>
                                    <?php
                                    echo form_error('2_4', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('2_4', set_value('2_4', ($arrRate['2_4'] != 0) ? ltrim($arrRate['2_4'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="2_4"');
                                    }else{
                                        echo form_input('2_4', set_value('2_4', 0), 'class="form-control sub" id="2_4"');
                                    }
                                    ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 3 ------------------------------------------>

                            <tr>
                                <td rowspan="3">3</td>
                                <td rowspan="3">Chất lượng đào tạo</td>
                                <td rowspan="3">15</td>
                                <td rowspan="3">
                                    <?php
                                    echo form_error('3', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('3', set_value('3', $arrRate['3']), 'class="form-control main" readonly id="3"');
                                    }else{
                                        echo form_input('3', set_value('3', 0), 'class="form-control main" readonly id="3"');
                                    }
                                    ?>
                                </td>
                                <td>Tỉ lệ đỗ tốt nghiệp/tổng học viên thi tốt nghiệp</td>
                                <td>35</td>
                                <td>
                                    <?php
                                    echo form_error('3_1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('3_1', set_value('3_1', ($arrRate['3_1'] != 0) ? ltrim($arrRate['3_1'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="3_1"');
                                    }else{
                                        echo form_input('3_1', set_value('3_1', 0), 'class="form-control sub" id="3_1"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tỉ lệ giỏi, khá/ tổng học viên thi tốt nghiệp</td>
                                <td>30</td>
                                <td>
                                    <?php
                                    echo form_error('3_2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('3_2', set_value('3_2', ($arrRate['3_2'] != 0) ? ltrim($arrRate['3_2'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="3_2"');
                                    }else{
                                        echo form_input('3_2', set_value('3_2', 0), 'class="form-control sub" id="3_2"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tỉ lệ học viên có việc làm ngay khi ra trường</td>
                                <td>35</td>
                                <td>
                                    <?php
                                    echo form_error('3_3', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('3_3', set_value('3_3', ($arrRate['3_3'] != 0) ? ltrim($arrRate['3_3'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="3_3"');
                                    }else{
                                        echo form_input('3_3', set_value('3_3', 0), 'class="form-control sub" id="3_3"');
                                    }
                                    ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 4 ------------------------------------------>

                            <tr>
                                <td rowspan="2">4</td>
                                <td rowspan="2">Hoạt động nghiên cứu, liên kết, kết nối</td>
                                <td rowspan="2">50</td>
                                <td rowspan="2">
                                    <?php
                                    echo form_error('4', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('4', set_value('4', $arrRate['4']), 'class="form-control main" readonly id="4"');
                                    }else{
                                        echo form_input('4', set_value('4', 0), 'class="form-control main" readonly id="4"');
                                    }
                                    ?>
                                </td>
                                <td>Các hoạt động kết nối hợp tác, tuyển dụng, nghiên cứu, chuyển giao công nghệ</td>
                                <td>50</td>
                                <td>
                                    <?php
                                    echo form_error('4_1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('4_1', set_value('4_1', ($arrRate['4_1'] != 0) ? ltrim($arrRate['4_1'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="4_1"');
                                    }else{
                                        echo form_input('4_1', set_value('4_1', 0), 'class="form-control sub" id="4_1"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Các hoạt động vườn ươm, thúc đẩy khởi nghiệp</td>
                                <td>50</td>
                                <td>
                                    <?php
                                    echo form_error('4_2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('4_2', set_value('4_2', ($arrRate['4_2'] != 0) ? ltrim($arrRate['4_2'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="4_2"');
                                    }else{
                                        echo form_input('4_2', set_value('4_2', 0), 'class="form-control sub" id="4_2"');
                                    }
                                    ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 5 ------------------------------------------>

                            <tr>
                                <td rowspan="3">5</td>
                                <td rowspan="3">Chất lượng hồ sơ, năng lực trình bày</td>
                                <td rowspan="3">5</td>
                                <td rowspan="3">
                                    <?php
                                    echo form_error('5', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('5', set_value('5', $arrRate['5']), 'class="form-control main" readonly id="5"');
                                    }else{
                                        echo form_input('5', set_value('5', 0), 'class="form-control main" readonly id="5"');
                                    }
                                    ?>
                                </td>
                                <td>Chuẩn bị hồ sơ hoàn chỉnh</td>
                                <td>30</td>
                                <td>
                                    <?php
                                    echo form_error('5_1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('5_1', set_value('5_1', ($arrRate['5_1'] != 0) ? ltrim($arrRate['5_1'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="5_1"');
                                    }else{
                                        echo form_input('5_1', set_value('5_1', 0), 'class="form-control sub" id="5_1"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Trình bày rõ ràng, thông tin chính xác</td>
                                <td>40</td>
                                <td>
                                    <?php
                                    echo form_error('5_2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('5_2', set_value('5_2', ($arrRate['5_2'] != 0) ? ltrim($arrRate['5_2'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="5_2"');
                                    }else{
                                        echo form_input('5_2', set_value('5_2', 0), 'class="form-control sub" id="5_2"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Trả lời tốt các câu hỏi</td>
                                <td>30</td>
                                <td>
                                    <?php
                                    echo form_error('5_3', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('5_3', set_value('5_3', ($arrRate['5_3'] != 0) ? ltrim($arrRate['5_3'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="5_3"');
                                    }else{
                                        echo form_input('5_3', set_value('5_3', 0), 'class="form-control sub" id="5_3"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Bình luận</td>
                                <td colspan="6">
                                    <?php 
                                        echo form_textarea(array(
                                            'name' => 'comment',
                                            'id' => 'comment',
                                            'value' => $rating['comment'],
                                            'rows' => '3',
                                            'class' => "form-control"
                                        ));
                                    ?>
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
                        echo '<button type="button" class="btn btn-info temporarily-saved" style="width:40%;">Lưu tạm</button>';
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
        let main1 = (parseInt($('#1_1').val()) * 0.4 + parseInt($('#1_2').val()) * 0.3 + parseInt($('#1_3').val()) * 0.3) * 0.1;
        $('#1').val(Number(main1.toFixed(2)));

        let main2 = (parseInt($('#2_1').val()) * 0.55 + parseInt($('#2_2').val()) * 0.15 + parseInt($('#2_3').val()) * 0.15 + parseInt($('#2_4').val()) * 0.15) * 0.2;
        $('#2').val(Number(main2.toFixed(2)));

        let main3 = (parseInt($('#3_1').val()) * 0.35 + parseInt($('#3_2').val()) * 0.3 + parseInt($('#3_3').val()) * 0.35) * 0.15;
        $('#3').val(Number(main3.toFixed(2)));

        let main4 = (parseInt($('#4_1').val()) * 0.5 + parseInt($('#4_2').val()) * 0.5) * 0.5;
        $('#4').val(Number(main4.toFixed(2)));

        let main5 = (parseInt($('#5_1').val()) * 0.3 + parseInt($('#5_2').val()) * 0.4 + parseInt($('#5_3').val()) * 0.3) * 0.05;
        $('#5').val(Number(main5.toFixed(2)));

        $('#totalRating').html(Number((main1 + main2 + main3 + main4 + main5).toFixed(2)));
        $('input[name="total"]').val(Number((main1 + main2 + main3 + main4 + main5).toFixed(2)));
    });

    $('#rating1Form').validate();
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
    $('.sub').on('blur', function() {
        if (!$('#rating1Form').valid()) {
            $('input[type="submit"]').prop('disabled', true);
            $('.temporarily-saved').prop('disabled', true);
        }else{
            $('input[type="submit"]').prop('disabled', false);
            $('.temporarily-saved').prop('disabled', false);
        }
    });

    $('#rating1Form').submit(function(e){
        var form = $(this);
        var url = form.attr('action');

        for(let i = 1; i <= 8; i++){
            if($('#' + i).val() == ''){
                alert('Chưa chấm hết tất cả các mục');
                return false;
            }
        }

        if(confirm("Chắc chắn gửi điểm?")){
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
        }
        // $('rating1Form').unbind('submit').submit();
        e.preventDefault();
    });

    $('.temporarily-saved').click(function(e){
        url = '<?php echo base_url('member/new_rating/rating_temp') ?>';
        $.ajax({
            type: "GET",
            url: url,
            data: $('#rating1Form').serialize(), // serializes the form's elements.
            success: function(result){
                let data = JSON.parse(result);
                if(data.name != undefined){
                    alert('Lưu tạm điểm thành công');
                    window.location.reload();
                }else{
                    alert(data.message)
                }
            }
        });
        // $('rating1Form').unbind('submit').submit();
        e.preventDefault();
    })
</script>
