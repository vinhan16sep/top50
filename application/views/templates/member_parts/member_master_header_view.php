<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title; ?></title>
  <link rel="shortcut icon" type="image/png" href="<?php echo site_url('assets/public/img/favicon.png'); ?>"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo site_url('assets/admin/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo site_url('assets/admin/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo site_url('assets/admin/'); ?>dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo site_url('assets/admin/'); ?>dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo site_url('assets/admin/'); ?>dist/css/skins/_all-skins.min.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo site_url('assets/admin/'); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Color picker -->
  <link rel="stylesheet" href="<?php echo site_url('assets/admin/'); ?>bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo site_url('assets/admin/'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/admin/'); ?>js/admin/lightbox/dist/css/lightbox.min.css">
  
  <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/admin/'); ?>js/admin/colorbox/example1/colorbox.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  <!-- jQuery 3 -->
  <script src="<?php echo site_url('assets/admin/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo site_url('assets/admin/'); ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Jquery validate -->
  <script src="<?php echo site_url('assets/admin/'); ?>bower_components/jquery/src/jquery.validate.js"></script>
  <script src="<?php echo site_url('assets/admin/'); ?>bower_components/jquery/src/additional-methods.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo site_url('assets/admin/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo site_url('assets/admin/'); ?>js/admin/index.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo site_url('assets/admin/'); ?>dist/js/adminlte.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo site_url('assets/admin/'); ?>dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo site_url('assets/admin/'); ?>dist/js/demo.js"></script>

  <script src="<?php echo site_url('assets/admin/'); ?>js/admin/colorbox/jquery.colorbox-min.js"></script>

  <script type="text/javascript" src="<?php echo site_url('tinymce/tinymce.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo site_url('tinymce/tinymce.min.js'); ?>"></script>

    <style>
        @font-face{
            font-family: webFont_N;
            src: url("<?php echo site_url('assets/public/fonts/OpenSans-Regular.ttf'); ?>");
        }

        body, a{
            font-family: webFont_N;
        }

        .skin-blue .sidebar-menu>li>.treeview-menu{
            overflow: hidden;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('members')): ?>
  <header class="main-header">
    <!-- logo -->
    <a href="<?php echo base_url('admin/dashboard') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
<!--      <span class="logo-mini"><b>MATO</b></span>-->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ADMINISTRATOR</b> PAGE</span>
    </a>
    <!-- header navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

<!--            <li class="dropdown messages-menu">-->
<!--                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">-->
<!--                    <i class="fa fa-envelope-o"></i>-->
<!--                    <span class="label label-success">--><?php //echo $total ?><!--</span>-->
<!--                </a>-->
<!--                <ul class="dropdown-menu">-->
<!--                    <li class="header">Bạn có --><?php //echo $total ?><!-- bình luận chưa xem</li>-->
<!--                    <li>-->
<!--                        <!-- inner menu: contains the actual data -->
<!--                        <ul class="menu">-->
<!--                            --><?php //if($news_comment): ?>
<!--                                --><?php //foreach ($news_comment as $value):?>
<!--                                    <li><!-- start message -->
<!--                                        <a href="#">-->
<!--                                            <h4>-->
<!--                                                Support Team-->
<!--                                                <small>-->
<!--                                                </small>-->
<!--                                            </h4>-->
<!--                                            <p style="padding-right: 15px;">--><?php //echo substr($value['content'], 0, 50) ?><!--...</p>-->
<!--                                        </a>-->
<!--                                    </li>-->
<!--                                --><?php //endforeach; ?>
<!--                            --><?php //else: ?>
<!--                                <li></li>-->
<!--                            --><?php //endif; ?>
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li class="footer"><a href="--><?php //echo base_url('admin/comment/delete_all') ?><!--" id="seen_comment">Đã xem</a>  <a href="--><?php //echo base_url('admin/comment/index/new-comment') ?><!--">Xem tất bình luận</a></li>-->
<!--                </ul>-->
<!--            </li>-->

          <!-- user account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo site_url('assets/public/img/client.jpg'); ?>" class="user-image" alt="user image">
              <span class="hidden-xs"><?php echo (isset($user_email))? $user_email : '' ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- user image -->
              <li class="user-header">
                <img src="<?php echo site_url('assets/public/img/logo.png'); ?>" class="img-circle" alt="user image">

                <p>
                  Thời Gian Hiện Tại
                  <small><?php echo date('d/m/Y') ?></small>
                </p>
              </li>
              <!-- menu body -->

              <!-- menu footer-->
              <li class="user-footer">
              <div class="pull-left">
                  <a href="<?php echo site_url('member/user/change_password'); ?>" class="btn btn-default btn-flat">Đổi mật khẩu</a>
              </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('member/user/logout'); ?>" class="btn btn-default btn-flat">Thoát</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- control sidebar toggle button -->
          <li>
            <!--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
          </li>
        </ul>
      </div>
    </nav>
  </header>
<?php endif; ?>
