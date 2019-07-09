<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content row">

        <div class="row" style="padding: 10px;">
            <div class="col-md-6">
                <span type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Thêm mới nhóm hội đồng</span>
            </div>
        </div>

        <?php
            $main_services = array(
                1 => 'Các sản phẩm, giải pháp phần mềm tiêu biểu, được bình xét theo 24 lĩnh vực ứng dụng chuyên ngành',
                2 => 'Các sản phẩm, giải pháp ứng dụng công nghệ 4.0',
                3 => 'Các sản phẩm, giải pháp phần mềm mới',
                4 => 'Các sản phẩm, giải pháp của doanh nghiệp khởi nghiệp',
                5 => 'Các dịch vụ CNTT'
            );
        ?>

        <div class="container col-md-12">
            <div>
                <span><?php echo $this->session->flashdata('message'); ?></span>
            </div>
            <?php if ($teams): ?>
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 10px;">
                        <table class="table table-striped table-bordered table-condensed admin">
                            <tr>
                                <td style="width: 5%"><b><a href="#">STT</a></b></td>
                                <td style="width: 10%; text-align: center;"><b><a href="#">Tên nhóm</a></b></td>
                                <td style="width: 10%; text-align: center;"><b><a href="#">Trưởng nhóm</a></b></td>
                                <td style="width: 15%; text-align: center;"><b><a href="#">Thành viên</a></b></td>
                                <td style="text-align: center;"><b><a href="#">Sản phẩm / Doanh nghiệp / Nhóm lĩnh vực chính</a></b></td>
                                <td style="width: 10%; text-align: center;"><b>Thao tác</b></td>
                            </tr>

                            <?php foreach ($teams as $key => $team): ?>

                                <tr class="row_<?php echo $team['id']; ?>">
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $team['name']; ?></td>
                                    <td style="text-align: center;">
                                        <?php
                                        foreach($leaders as $key => $leader){
                                            if($team['leader_id'] == $leader['user_id']){
//                                                    echo $leader['username'] . ' (' . $leader['email'] . ')';
                                                echo $leader['username'];
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <ul>
                                            <?php
                                            $array_member_id = explode(',', $team['member_id']);
                                            foreach($members as $key => $member){
                                                if(in_array($member['user_id'], $array_member_id)){
                                                    echo '<li>' . $member['username'] . '  ' . '<a href="javascript:void(0);" onclick="removeMember(' . $team['id'] . ',' . $member['user_id'] . ');"><i style="color:red;" class="fa fa-remove" aria-hidden="true"></i></a>';
//                                                echo '<li>' . $member['username'] . ' (' . $member['email'] . ')' . '  ' . '<a href="javascript:void(0);" onclick="removeMember(' . $team['id'] . ',' . $member['user_id'] . ');"><i style="color:red;" class="fa fa-remove" aria-hidden="true"></i></a>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <table class="table table-bordered">
                                            <?php
                                                $array_product_id = explode(',', $team['product_id']);
                                                $stt = 1;
                                                $newProducts = [];
                                            ?>
                                            <?php if ($products): ?>
                                                <?php foreach ($products as $key => $product){
                                                    $newProducts[$product['id']] = $product;
                                                } ?>
                                            <?php endif ?>
                                            <?php if ($array_product_id): ?>
                                                <?php foreach ($array_product_id as $key => $value): ?>
                                                    <?php if (!empty($value)): ?>
                                                        <?php $stt++ ?>
                                                        <tr style="<?php echo ($stt % 2 == 0) ? 'background-color: #b7d7f3' : '' ; ?> ">
                                                            <td style="width: 27%"><strong>Sản phẩm</strong></td>
                                                            <td><?php echo $newProducts[$value]['name'] ?></td>
                                                            <td rowspan="3" style="vertical-align : middle;text-align:center;">
                                                                <?php echo '<a href="javascript:void(0);" onclick="removeProduct(' . $team['id'] . ',' . $newProducts[$value]['id'] . ');"><i style="color:red;" class="fa fa-remove" aria-hidden="true"></i></a>' ?>
                                                            </td>
                                                        </tr>
                                                        <tr style="<?php echo ($stt % 2 == 0) ? 'background-color: #b7d7f3' : '' ; ?> ">
                                                            <td><strong>Doanh nghiệp</strong></td>
                                                            <td><?php echo $newProducts[$value]['company'] ?></td>
                                                        </tr>
                                                        <tr style="<?php echo ($stt % 2 == 0) ? 'background-color: #b7d7f3' : '' ; ?> ">
                                                            <td><strong>Nhóm lĩnh vực chính</strong></td>
                                                            <td>
                                                                <?php
                                                                    if (array_key_exists($newProducts[$value]['main_service'], $main_services)) {
                                                                        echo $main_services[$newProducts[$value]['main_service']];
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            
                                        </table>
                                    </td>
                                    <td>
                                        <div>
                                            <!--                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addLeader" id="btnAddLeader">-->
                                            <!--                                                <i class="fa fa-star" aria-hidden="true"></i>-->
                                            <!--                                            </a>-->
                                            <a href="javascript:void(0);" data-team="<?php echo $team['id']; ?>" onclick="openAddLeaderModal(this);" id="btnAddLeader">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </a>
                                            &nbsp
                                            <a href="javascript:void(0);" data-team="<?php echo $team['id']; ?>" onclick="openAddMemberModal(this);" id="btnAddMember">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                            </a>
                                            &nbsp
                                            <a href="javascript:void(0);" data-team="<?php echo $team['id']; ?>" onclick="openAddProductModal(this);" id="btnAddProduct">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                            &nbsp
                                            <a href="javascript:void(0);" data-team="<?php echo $team['id']; ?>" data-name="<?php echo $team['name']; ?>" onclick="openChangeTeamNameModal(this);" id="btnChangeName">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            &nbsp
                                            <a href="javascript:void(0);" onclick="deleteTeam(<?php echo $team['id']; ?>);" id="btnDeleteTeam">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </div>
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
                            <tr>Không có kết quả phù hợp</tr>
                        </table>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </section>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tên nhóm</h4>
            </div>
            <div class="modal-body" id="modal-form">
                <input type="text" name="team-name" id="teamName" class="form-control"/>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="createTeam">Đồng ý</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<div id="changeTeamName" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tên nhóm</h4>
            </div>
            <div class="modal-body" id="modal-form">
                <input type="hidden" value="" id="changeNameTeamId"/>
                <input type="text" name="team-name" id="teamCurrentName" class="form-control"/>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="btnChangeTeamName">Đồng ý</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<div id="addLeader" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chọn trưởng nhóm</h4>
            </div>
            <div class="modal-body" id="modal-form">
                <input type="hidden" value="" id="hiddenTeamId"/>
                <select id="selectLeader" class="form-control">
                    <option value="">-- Chọn trưởng nhóm --</option>
                    <?php if($leaders){ ?>
                        <?php foreach($leaders as $key => $leader){ ?>
                            <option value="<?php echo $leader['user_id'] ?>"><?php echo $leader['username'] . ' (' . $leader['email'] . ')'; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="confirmAddLeader">Đồng ý</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<div id="addMember" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chọn thành viên</h4>
            </div>
            <div class="modal-body" id="modal-form">
                <input type="hidden" value="" id="hiddenTeamId"/>
                <select id="selectMember" class="form-control">
                    <option value="">-- Chọn thành viên --</option>
                    <?php if($members){ ?>
                        <?php foreach($members as $key => $member){ ?>
                            <option value="<?php echo $member['user_id'] ?>"><?php echo $member['username'] . ' (' . $member['email'] . ')'; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="confirmAddMember">Đồng ý</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<div id="addProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chọn Sản Phẩm</h4>
            </div>
            <div class="modal-body" id="modal-form">
                <input type="hidden" value="" id="hiddenTeamId"/>
                <select id="selectCompanys" class="form-control" style="margin-bottom: 20px;" >
                    <option value="">-- Chọn công ty --</option>
                    <?php if($companys){ ?>
                        <?php foreach($companys as $key => $company){ ?>
                            <option value="<?php echo $company['client_id'] ?>"><?php echo $company['company']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <select id="selectProducts" class="form-control" disabled>
                    <option value="">-- Chọn sản phẩm --</option>
                </select>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="confirmAddProducts">Đồng ý</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#createTeam').click(function(){
        if($('#teamName').val() == ''){
            alert('Cần nhập tên nhóm hội đồng');
        }else{
            $.ajax({
                method: "GET",
                url: "<?php echo base_url('admin/team/create/'); ?>",
                data: {
                    name: $('#teamName').val()
                },
                success: function(result){
                    let data = JSON.parse(result);
                    if(data.name != undefined){
                        alert('Tạo nhóm ' + data.name + ' thành công')
                        window.location.reload();
                    }else{
                        alert(data.message)
                        window.location.reload();
                    }
                }
            });
        }
    });

    function openAddLeaderModal(event){
        $('#hiddenTeamId').val($(event).data("team"));
        $('#addLeader').modal('show');
    }

    $('#confirmAddLeader').click(function(){
        if($('#selectLeader').val() == ''){
            alert('Cần chọn trưởng nhóm');
        }else{
            if(confirm("Nếu thay đổi trưởng nhóm, điểm đã chấm của user này với các sản phẩm trong nhóm sẽ bị xoá. Chắc chắn thay đổi?")){
                $.ajax({
                    method: "GET",
                    url: "<?php echo base_url('admin/team/add_team_leader'); ?>",
                    data: {
                        team_id: $('#hiddenTeamId').val(),
                        leader_id: $('#selectLeader').val()
                    },
                    success: function(result){
                        console.log(result);
                        let data = JSON.parse(result);
                        if(data.name != undefined){
                            alert('Chọn trưởng nhóm ' + data.name + ' thành công')
                            window.location.reload();
                        }else{
                            alert(data.message)
                            window.location.reload();
                        }
                    }
                });
            }

        }
    });

    function openAddMemberModal(event){
        $('#hiddenTeamId').val($(event).data("team"));
        $('#addMember').modal('show');
    }

    function openAddProductModal(event){
        $('#hiddenTeamId').val($(event).data("team"));
        $('#addProduct').modal('show');
    }

    $('#confirmAddMember').click(function(){
        if($('#selectMember').val() == ''){
            alert('Cần chọn thành viên');
        }else{
            $.ajax({
                method: "GET",
                url: "<?php echo base_url('admin/team/add_team_member'); ?>",
                data: {
                    team_id: $('#hiddenTeamId').val(),
                    member_id: $('#selectMember').val()
                },
                success: function(result){
                    let data = JSON.parse(result);
                    if(data.name != undefined){
                        alert('Chọn thành viên cho nhóm ' + data.name + ' thành công')
                        window.location.reload();
                    }else{
                        alert(data.message)
                        window.location.reload();
                    }
                }
            });
        }
    });

    function removeMember(teamId, memberId){
        if(confirm('Nếu xoá thành viên ra khỏi nhóm, điểm đã chấm của user này cho các sản phẩm trong nhóm sẽ bị xoá. Chắc chắn xoá?')){
            $.ajax({
                method: "GET",
                url: "<?php echo base_url('admin/team/remove_team_member'); ?>",
                data: {
                    team_id: teamId,
                    member_id: memberId
                },
                success: function(result){
                    let data = JSON.parse(result);
                    if(data.name != undefined){
                        alert('Xoá thành viên cho nhóm ' + data.name + ' thành công')
                        window.location.reload();
                    }else{
                        alert(data.message)
                        window.location.reload();
                    }
                }
            });
        }
    }

    function openChangeTeamNameModal(event){
        $('#changeNameTeamId').val($(event).data("team"));
        $('#teamCurrentName').val($(event).data("name"));
        $('#changeTeamName').modal('show');
    }

    $('#btnChangeTeamName').click(function(){
        if($('#teamCurrentName').val() == ''){
            alert('Cần nhập tên nhóm hội đồng');
        }else{
            $.ajax({
                method: "GET",
                url: "<?php echo base_url('admin/team/change_name/'); ?>",
                data: {
                    id: $('#changeNameTeamId').val(),
                    name: $('#teamCurrentName').val()
                },
                success: function(result){
                    let data = JSON.parse(result);
                    if(data.name != undefined){
                        alert('Đổi tên nhóm thành công')
                        window.location.reload();
                    }else{
                        alert(data.message)
                        window.location.reload();
                    }
                }
            });
        }
    });


    $('#selectCompanys').change(function(){
        $.ajax({
            method: "GET",
            url: "<?php echo base_url('admin/team/get_products'); ?>",
            data: {
                client_id: $(this).val()
            },
            success: function(result){
                let data = JSON.parse(result);
                html = '';
                if (JSON.stringify(data.products).length > 0) {
                    $("#selectProducts").prop('disabled', false);
                    html += '<option value="">-- Chọn sản phẩm --</option>';
                    $.each(data.products, function(index, item){
                        html += '<option value="' + item.id + '">' + item.name + '</option>';
                    })
                }else{
                    $("#selectProducts").prop('disabled', true);
                    html += '<option value="">Không có sản phẩm hoặc sản phẩm đã được chỉ định hết</option>';
                }
                $('#selectProducts').html(html);
            }
        });
    });

    $('#confirmAddProducts').click(function(){
        if($('#selectProducts').val() == ''){
            alert('Cần chọn sản phẩm');
        }else{
            $.ajax({
                method: "GET",
                url: "<?php echo base_url('admin/team/add_product'); ?>",
                data: {
                    team_id: $('#hiddenTeamId').val(),
                    product_id: $('#selectProducts').val()
                },
                success: function(result){
                    let data = JSON.parse(result);
                    if(data.name != undefined){
                        alert('Chọn chọn sản phẩm cho ' + data.name + ' thành công')
                        window.location.reload();
                    }else{
                        alert(data.message)
                        window.location.reload();
                    }
                }
            });
        }
    });

    function removeProduct(teamId, productId){
        if(confirm('Chắc chắn xoá?')){
            $.ajax({
                method: "GET",
                url: "<?php echo base_url('admin/team/remove_team_product'); ?>",
                data: {
                    team_id: teamId,
                    product_id: productId
                },
                success: function(result){
                    let data = JSON.parse(result);
                    if(data.name != undefined){
                        alert('Xoá sản phẩm cho nhóm ' + data.name + ' thành công')
                        window.location.reload();
                    }else{
                        alert(data.message)
                        window.location.reload();
                    }
                }
            });
        }
    }

    function deleteTeam(id){
        if(confirm('Chắc chắn xoá?')){
            $.ajax({
                method: "GET",
                url: "<?php echo base_url('admin/team/delete_team'); ?>",
                data: {
                    id: id,
                },
                success: function(result){
                    let data = JSON.parse(result);
                    if(data.name != undefined){
                        alert('Xoá nhóm ' + data.name);
                        window.location.reload();
                    }else{
                        alert(data.message);
                        window.location.reload();
                    }
                }
            });
        }
    }

</script>