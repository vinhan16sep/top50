<?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('members')): ?>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">
            <!-- Sidebar user panel -->
            <!--            <div class="user-panel">-->
            <!--                <div class="pull-left image">-->
            <!--                    <img src="--><?php //echo site_url('assets/admin/'); ?><!--dist/img/admin.png" class="img-circle" alt="User Image">-->
            <!--                </div>-->
            <!--                <div class="pull-left info">-->
            <!--                    <p>MN Tuổi Thần Tiên</p>-->
            <!--                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            <!--                </div>-->
            <!--            </div>-->
            <!-- search form -->

            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->



            <ul class="sidebar-menu tree" data-widget="tree">

                <li class="header">MENU</li>
                <li class="<?php echo ($active == 'dashboard' && $sub_active == '')? 'active' : '' ?>">
                    <a href="<?php echo base_url('member/dashboard'); ?>">
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        <span>Tổng quan</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <?php if($this->ion_auth->user()->row()->member_role == 'leader'){ ?>
                    <li class="<?php echo ($active == 'dashboard'  && $sub_active == 'users')? 'active' : '' ?>">
                        <a href="<?php echo base_url('member/dashboard/users'); ?>">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Quản lý thành viên</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if($this->ion_auth->user()->row()->member_role == 'manager'){ ?>
                    <li class="<?php echo ($active == 'dashboard'  && $sub_active == 'product')? 'active' : '' ?>">
                        <a href="<?php echo base_url('member/product'); ?>">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Sản phẩm</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                <?php } ?>
<!--                <li class="--><?php //echo ($active == 'menu')? 'active' : '' ?><!--">-->
<!--                    <a href="--><?php //echo base_url('client/information/extra'); ?><!--">-->
<!--                        <i class="fa fa-bars" aria-hidden="true"></i>-->
<!--                        <span>TT đăng ký</span>-->
<!--                        <span class="pull-right-container"></span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="--><?php //echo ($active == 'menu')? 'active' : '' ?><!--">-->
<!--                    <a href="--><?php //echo base_url('client/information/company'); ?><!--">-->
<!--                        <i class="fa fa-bars" aria-hidden="true"></i>-->
<!--                        <span>TT doanh nghiệp</span>-->
<!--                        <span class="pull-right-container"></span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="--><?php //echo ($active == 'menu')? 'active' : '' ?><!--">-->
<!--                    <a href="--><?php //echo base_url('client/information/products'); ?><!--">-->
<!--                        <i class="fa fa-bars" aria-hidden="true"></i>-->
<!--                        <span>TT sản phẩm</span>-->
<!--                        <span class="pull-right-container"></span>-->
<!--                    </a>-->
<!--                </li>-->
                <!---->
                <!--                <li class="--><?php //echo ($active == 'subcribe')? 'active' : '' ?><!--">-->
                <!--                    <a href="--><?php //echo base_url('admin/subcribe'); ?><!--">-->
                <!--                        <i class="fa fa-bars" aria-hidden="true"></i>-->
                <!--                        <span>Đăng ký theo dõi</span>-->
                <!--                        <span class="pull-right-container"></span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li class="--><?php //echo ($active == 'register')? 'active treeview' : 'treeview' ?><!--">-->
                <!--                    <a href=""><i class="fa fa-graduation-cap" aria-hidden="true"></i> Đăng ký nhập học-->
                <!--                        <span class="pull-right-container">-->
                <!--                    <span class="label label-primary pull-right">2</span>-->
                <!--                  </span>-->
                <!--                    </a>-->
                <!---->
                <!--                    <ul class="treeview-menu">-->
                <!--                        <li class="--><?php //echo ($active == 'register' && $sub_active == 'index')? 'active' : '' ?><!--">-->
                <!--                            <a href="--><?php //echo base_url('admin/register/index'); ?><!--"><i class="fa fa-minus" aria-hidden="true"></i> Chờ xử lý</a>-->
                <!--                        </li>-->
                <!---->
                <!--                        <li class="--><?php //echo ($sub_active == 'register_finish')? 'active' : '' ?><!--">-->
                <!--                            <a href="--><?php //echo base_url('admin/register/register_finish'); ?><!--"><i class="fa fa-minus" aria-hidden="true"></i> Đã hoàn thành</a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </li>-->
                <!---->
                <!--                <li class="--><?php //echo ($active == 'placement')? 'active' : '' ?><!--">-->
                <!--                    <a href="--><?php //echo base_url('admin/placement/index'); ?><!--">-->
                <!--                        <i class="fa fa-map-marker" aria-hidden="true"></i>-->
                <!--                        <span>Cơ sở</span>-->
                <!--                        <span class="pull-right-container">-->
                <!--                </span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li class="--><?php //echo ($active == 'class')? 'active' : '' ?><!--">-->
                <!--                    <a href="--><?php //echo base_url('admin/classification/index'); ?><!--">-->
                <!--                        <i class="fa fa-home" aria-hidden="true"></i>-->
                <!--                        <span>Lớp học</span>-->
                <!--                        <span class="pull-right-container">-->
                <!--                </span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li class="--><?php //echo ($active == 'article')? 'active' : '' ?><!--">-->
                <!--                    <a href="--><?php //echo base_url('admin/article/index'); ?><!--">-->
                <!--                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>-->
                <!--                        <span>Bài viết</span>-->
                <!--                        <span class="pull-right-container">-->
                <!--                </span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li class="--><?php //echo ($active == 'introduce')? 'active treeview' : 'treeview' ?><!--">-->
                <!--                    <a href=""><i class="fa fa-list" aria-hidden="true"></i> Giới thiệu-->
                <!--                        <span class="pull-right-container">-->
                <!--                            <i class="fa fa-angle-left pull-right"></i>-->
                <!--                        </span>-->
                <!--                    </a>-->
                <!---->
                <!--                    <ul class="treeview-menu">-->
                <!--                            <li class="--><?php //echo ($active == 'introduce' && $sub_active == 'category')? 'active' : '' ?><!--">-->
                <!--                                <a href="--><?php //echo base_url('admin/introduce/category') ?><!--"><i class="fa fa-wrench" aria-hidden="true"></i>Thêm/sửa danh mục</a>-->
                <!--                            </li>-->
                <!--                        --><?php //if(!empty($introduce_menu)): ?>
                <!--                            --><?php //foreach($introduce_menu as $value): ?>
                <!--                                <li class="--><?php //echo ($active == 'introduce' && $sub_active == 'list_in_category' && $icon_active == $value['id'])? 'active' : '' ?><!--">-->
                <!--                                    <a href="--><?php //echo base_url('admin/introduce/list_in_category/' . $value['id']); ?><!--"  title="--><?php //echo (strlen($value['title']) > 30)? $value['title'] : '' ?><!--">-->
                <!--                                        <i class="fa fa-minus" aria-hidden="true"></i>-->
                <!--                                        --><?php
                //                                            $string_title = substr($value['title'], 0, 30);
                //                                            $result = substr($string_title, 0, strrpos($string_title, ' '));
                //                                            if (strlen($value['title']) > 30){
                //                                                echo $result . ' ...';
                //                                            }else{
                //                                                echo $value['title'];
                //                                            }
                //                                        ?>
                <!--                                    </a>-->
                <!--                                </li>-->
                <!--                            --><?php //endforeach; ?>
                <!---->
                <!--                        --><?php //endif; ?>
                <!--                    </ul>-->
                <!--                </li>-->
                <!---->
                <!--                <li class="--><?php //echo ($active == 'admission')? 'active treeview' : 'treeview' ?><!--">-->
                <!--                    <a href=""><i class="fa fa-list" aria-hidden="true"></i> Thông tin nhập học-->
                <!--                        <span class="pull-right-container">-->
                <!--                            <i class="fa fa-angle-left pull-right"></i>-->
                <!--                        </span>-->
                <!--                    </a>-->
                <!---->
                <!--                    <ul class="treeview-menu">-->
                <!--                        <li class="--><?php //echo ($active == 'admission' && $sub_active == 'category')? 'active' : '' ?><!--">-->
                <!--                            <a href="--><?php //echo base_url('admin/admission/category') ?><!--"><i class="fa fa-wrench" aria-hidden="true"></i> Thêm/sửa danh mục-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        --><?php //if(!empty($admission_menu)): ?>
                <!--                            --><?php //foreach($admission_menu as $value): ?>
                <!--                                <li class="--><?php //echo ($active == 'admission' && $sub_active == 'list_in_category' && $icon_active == $value['id'])? 'active' : '' ?><!--">-->
                <!--                                    <a href="--><?php //echo base_url('admin/admission/list_in_category/' . $value['id']); ?><!--"  title="--><?php //echo (strlen($value['title']) > 30)? $value['title'] : '' ?><!--">-->
                <!--                                        <i class="fa fa-minus" aria-hidden="true"></i>-->
                <!--                                        --><?php
                //                                            $string_title = substr($value['title'], 0, 30);
                //                                            $result = substr($string_title, 0, strrpos($string_title, ' '));
                //                                            if (strlen($value['title']) > 30){
                //                                                echo $result . ' ...';
                //                                            }else{
                //                                                echo $value['title'];
                //                                            }
                //                                        ?>
                <!--                                    </a>-->
                <!--                                </li>-->
                <!--                            --><?php //endforeach; ?>
                <!--                        --><?php //endif; ?>
                <!--                    </ul>-->
                <!--                </li>-->
                <!---->
                <!--                <li class="--><?php //echo ($active == 'parental')? 'active treeview' : 'treeview' ?><!--">-->
                <!--                    <a href=""><i class="fa fa-handshake-o" aria-hidden="true"></i> Phối hợp cùng phụ huynh-->
                <!--                        <span class="pull-right-container">-->
                <!--                            <i class="fa fa-angle-left pull-right"></i>-->
                <!--                        </span>-->
                <!--                    </a>-->
                <!---->
                <!--                    <ul class="treeview-menu">-->
                <!--                        <li class="--><?php //echo ($active == 'parental' && $sub_active == 'category')? 'active' : '' ?><!--">-->
                <!--                            <a href="--><?php //echo base_url('admin/parental/category') ?><!--"><i class="fa fa-wrench" aria-hidden="true"></i> Thêm/sửa danh mục-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        --><?php //if(!empty($parental_menu)): ?>
                <!--                            --><?php //foreach($parental_menu as $value): ?>
                <!--                                <li class="--><?php //echo ($active == 'parental' && $sub_active == 'list_in_category' && $icon_active == $value['id'])? 'active' : '' ?><!--">-->
                <!--                                    <a href="--><?php //echo base_url('admin/parental/list_in_category/' . $value['id']); ?><!--"  title="--><?php //echo (strlen($value['title']) > 30)? $value['title'] : '' ?><!--">-->
                <!--                                        <i class="fa fa-minus" aria-hidden="true"></i>-->
                <!--                                        --><?php
                //                                            $string_title = substr($value['title'], 0, 30);
                //                                            $result = substr($string_title, 0, strrpos($string_title, ' '));
                //                                            if (strlen($value['title']) > 30){
                //                                                echo $result . ' ...';
                //                                            }else{
                //                                                echo $value['title'];
                //                                            }
                //                                        ?>
                <!--                                    </a>-->
                <!--                                </li>-->
                <!--                            --><?php //endforeach; ?>
                <!--                        --><?php //endif; ?>
                <!--                    </ul>-->
                <!--                </li>-->
                <!---->
                <!--                <li class="--><?php //echo ($active == 'activity')? 'active treeview' : 'treeview' ?><!--">-->
                <!--                    <a href=""><i class="fa fa-laptop"></i></i> Hoạt động-->
                <!--                        <span class="pull-right-container">-->
                <!--                            <i class="fa fa-angle-left pull-right"></i>-->
                <!--                        </span>-->
                <!--                    </a>-->
                <!---->
                <!--                    <ul class="treeview-menu">-->
                <!--                        <li class="--><?php //echo ($active == 'activity' && $sub_active == 'category')? 'active' : '' ?><!--">-->
                <!--                            <a href="--><?php //echo base_url('admin/activity/category') ?><!--"><i class="fa fa-wrench" aria-hidden="true"></i> Thêm/sửa danh mục-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        --><?php //if(!empty($activity_menu)): ?>
                <!--                            --><?php //foreach($activity_menu as $value): ?>
                <!--                                <li class="--><?php //echo ($active == 'activity' && $sub_active == 'list_in_category' && $icon_active == $value['id'])? 'active' : '' ?><!--">-->
                <!--                                    <a href="--><?php //echo base_url('admin/activity/list_in_category/' . $value['id']); ?><!--"  title="--><?php //echo (strlen($value['title']) > 30)? $value['title'] : '' ?><!--">-->
                <!--                                        <i class="fa fa-minus" aria-hidden="true"></i>-->
                <!--                                        --><?php
                //                                            $string_title = substr($value['title'], 0, 30);
                //                                            $result = substr($string_title, 0, strrpos($string_title, ' '));
                //                                            if (strlen($value['title']) > 30){
                //                                                echo $result . ' ...';
                //                                            }else{
                //                                                echo $value['title'];
                //                                            }
                //                                        ?>
                <!--                                    </a>-->
                <!--                                </li>-->
                <!--                            --><?php //endforeach; ?>
                <!--                        --><?php //endif; ?>
                <!--                    </ul>-->
                <!--                </li>-->
                <!---->
                <!--                <li class="--><?php //echo ($active == 'library' || $active == 'video')? 'active treeview' : 'treeview' ?><!--">-->
                <!--                    <a href=""><i class="fa fa-address-book" aria-hidden="true"></i> Thư viện-->
                <!--                        <span class="pull-right-container">-->
                <!--                            <i class="fa fa-angle-left pull-right"></i>-->
                <!--                        </span>-->
                <!--                    </a>-->
                <!---->
                <!--                    <ul class="treeview-menu">-->
                <!--                        <li class="--><?php //echo ($active == 'library' && $sub_active == 'index')? 'active' : '' ?><!--">-->
                <!--                            <a href="--><?php //echo base_url('admin/library/index'); ?><!--"><i class="fa fa-picture-o" aria-hidden="true"></i> Thư viện ảnh</a>-->
                <!--                        </li>-->
                <!---->
                <!--                        <li class="--><?php //echo ($active == 'video' && $sub_active == 'index')? 'active' : '' ?><!--">-->
                <!--                            <a href="--><?php //echo base_url('admin/video/index'); ?><!--"><i class="fa fa-video-camera" aria-hidden="true"></i> Thư viện video</a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </li>-->

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
<?php endif; ?>