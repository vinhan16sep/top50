<!--
<div class="content-wrapper">
    <section class="content row">
        <a href="<?php echo base_url('admin/dashboard') ?>">Admin page</a>
        <a href="<?php echo base_url('client/dashboard') ?>">Client page</a>
        <a href="<?php echo base_url('client/user/login') ?>">Login as client</a>
    </section>
</div>
-->

<link rel="stylesheet" href="<?php echo site_url('assets/public/css/homepage.css'); ?>">

<section class="main_content container-fluid">
    <div class="megatron">
        <div class="container" style="width: 100%;">
            <img src="<?php echo site_url('assets/public/img/48baa-banner-top50.jpg') ?>" style="width: 100%;">
<!--            <h1>Cổng đăng ký danh hiệu Sao Khuê</h1>-->
            <p></p>
            <ul class="nav nav-pills nav-justified">
<!--                <li style="border-right:1px solid orange;">-->
<!--                    <a href="--><?php //echo base_url('admin/user/login') ?><!--"><h4>Admin</h4></a>-->
<!--                </li>-->
                <li>
                    <a href="<?php echo base_url('member/user/login') ?>"><h4>Hội đồng đánh giá</h4></a>
                </li>
                <li class="company-border" style="border-left:1px solid orange;">
                    <a href="<?php echo base_url('client/user/login') ?>"><h4>Doanh nghiệp</h4></a>
                </li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <img src="<?php echo site_url('assets/public/img/footer_sk.jpg') ?>" style="width: 100%;">
        </div>
    </div>
</section>