<style>
    .main-sidebar{
        left: -2px;
    }
</style>
<?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('admin')): ?>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu tree" data-widget="tree">

                <li class="header">MENU</li>
                <?php if($this->ion_auth->user()->row()->email == 'admin@admin.com'){ ?>
                <li class="active">
                    <a href="<?php echo base_url('admin/dashboard'); ?>">
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        <span>Tổng quan</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <li class="active">
                    <a href=""><i class="fa fa-list" aria-hidden="true"></i> Hội đồng
                        <span class="pull-right-container">
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active">
                            <a href="<?php echo base_url('admin/users/index_member/2') ?>">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                                Tài khoản
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url('admin/team/index'); ?>">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                                Nhóm hội đồng
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <li class="active">
                    <a href=""> T/t doanh nghiệp theo năm
                        <span class="pull-right-container">
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active">
                            <?php foreach($all_years as $key => $value){ ?>

                                <a href="<?php echo base_url('admin/company/index/' . $value); ?>">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                    Năm <?php echo $value; ?>
                                    <i class="fa fa-<?php echo ($this->uri->segment(4) == $value && ($this->input->get('group_id') == 0 || $this->input->get('group_id') == 1 || $this->input->get('group_id') == 2 || $this->input->get('group_id') == 99) ) ? 'minus'  : 'plus'; ?>" aria-hidden="true" style="float: right;padding: 3px 5px;" onclick="showgroup(event)"></i>
                                </a>
                                <!-- <div class="popup <?php echo ($this->uri->segment(4) == $value && ($this->input->get('group_id') == 0 || $this->input->get('group_id') == 1 || $this->input->get('group_id') == 2 || $this->input->get('group_id') == 99) ) ? 'show'  : ''; ?>" style="<?php echo ($this->uri->segment(4) == $value && ($this->input->get('group_id') == 0 || $this->input->get('group_id') == 1 || $this->input->get('group_id') == 2 || $this->input->get('group_id') == 99) ) ? 'display: block;'  : 'display: none;'; ?>"> -->
                                    <!-- <ul>
                                        <li><a href="<?php echo base_url('admin/company/index/' . $value . '?group_id=0'); ?>">Lĩnh vực 1</a></li>
                                        <li><a href="<?php echo base_url('admin/company/index/' . $value . '?group_id=1'); ?>">Lĩnh vực 2</a></li>
                                        <li><a href="<?php echo base_url('admin/company/index/' . $value . '?group_id=2'); ?>">Lĩnh vực 3</a></li>
                                        <li><a href="<?php echo base_url('admin/company/index/' . $value . '?group_id=99'); ?>">Top 10</a></li>
                                    </ul> -->
                                <!-- </div> -->
                            <?php } ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
<?php endif; ?>
