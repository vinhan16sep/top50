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

<section class="main_content">
    <div class="home-page">
        <div class="header-area">
            <img class='img-header' src="assets/public/img/logo-top10-2020-white.png">
            <div class='tilte-header'>CỔNG ĐĂNG KÝ CHƯƠNG TRÌNH TOP 10 DOANH NGHIỆP CNTT VIỆT NAM 2020</div>
        </div>
        
        <div class="register-area">
            <a class="btn-register register-for-council-of-examiners" href="<?php echo base_url('member/user/login') ?>"></a>
            <a class="btn-register register-for-bussiness" href="<?php echo base_url('client/user/login') ?>"></a>
        </div>
        
        <div class="footer-area">
            <img class='img-footer' src="assets/public/img/footer-top-10.png">
        </div>
    </div>
<!--<div class="something">-->
<!--<img src="w3css.gif" width="100" height="140">-->
<!--</div>-->

<!--<p>-->
<!--HIỆP HỘI PHẦN MỀM VÀ DỊCH VỤ CNTT VIỆT NAM (VINASA)-->
<!--T.024.3577.2336|Contect@vinasa.org.vn|www.vinasa.org.vn-->
<!--<br>-->
<!--<br>-->
<!--©Copyright VINASA|All Right Reserved.VINASA-->

<!--</p>-->

<!--<div class="megatron">-->
<!--        <div class="container" style="width: 100%;">-->
<!--            <div class="logo"><img src="<?php echo site_url('assets/public/img/Logo Top50+10.jpg') ?>"></div>-->
<!--            <div class="banner">-->
<!--                <img src="<?php echo site_url('assets/public/img/Banner50+10.png') ?>" style="width: 100%;">-->
<!--            </div>-->
            
            
<!--            <h1>Cổng đăng ký danh hiệu Sao Khuê</h1>-->
<!--            <p></p>-->
<!--            <ul class="nav nav-pills nav-justified">-->
<!--                <li style="border-right:1px solid orange;">-->
<!--                    <a href="--><?php //echo base_url('admin/user/login') ?><!--"><h4>Admin</h4></a>-->
<!--                </li>-->
                <!-- <li>
                    <a href="<?php // echo base_url('member/user/login') ?>"><h4>Hội đồng đánh giá</h4></a>
<!--                </li> -->-->
<!--                <li class="company-border">-->
<!--                    <a class="btn-register-for-bussiness" href="<?php echo base_url('client/user/login') ?>">Dành cho doanh nghiệp</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <br>-->
<!--            <br>-->
<!--            <br>-->
<!--            <br>-->
<!--            <br>-->
<!--            <br>-->
<!--            <br>-->
<!--            <br>-->
<!--            <img src="<?php echo site_url('assets/public/img/footer_sk.jpg') ?>" style="width: 100%;">-->
<!--        </div>-->
<!--    </div>-->
<style>
    .mobile-hotline-fixed {
    display: block;
    position: fixed;
    top: initial;
    bottom: 5px;
    left: 10px;
    z-index: 999999;
    min-width: 300px;
}
.mobile-hotline-fixed>a {
    display: block;
    position: relative;
    padding: 10px 25px 10px 55px;
    background: #ec1b24;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    -ms-border-radius: 20px;
    -o-border-radius: 20px;
    border-radius: 20px;
    font-size: 16px;
    line-height: 20px;
    font-weight: bold;
    color: #fff;
}
.mobile-hotline-fixed>a:before {
    content: "";
    display: block;
    position: absolute;
    width: 36px;
    height: 36px;
    top: 2px;
    left: 2px;
    background: #fff url(../assets/admin/images/icon_hotline_mobile.png) center no-repeat;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    z-index: 5;
    animation-name: tada;
    animation-duration: 0.1s;
    animation-iteration-count: infinite;
    animation-direction: alternate;
}
@keyframes tada {
    from {
        transform: rotate(-25deg);
    }
    to {
        transform: rotate(25deg);
    }
}
.mobile-hotline-fixed.one{
    bottom: 55px;
}
</style>
<div class="mobile-hotline-fixed one">
    <a href="tel:0936136696" title="Hỗ trợ kỹ thuật">
        <span class="value">Hỗ trợ kỹ thuật: 0936136696</span>
    </a>
</div>
<div class="mobile-hotline-fixed">
    <a href="tel:0913196699" title="Tư vấn hồ sơ">
        <span class="value">Tư vấn hồ sơ: 0913196699</span>
    </a>
</div>
</section>