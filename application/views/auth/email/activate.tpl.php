<html>
<body>
	<strong>Kính gửi Công ty <?php echo $company ?>!</strong>
	<p>Cảm ơn Quý Công ty đã đăng ký tham gia Chương trình 50+10 Doanh nghiệp CNTT hàng đầu Việt Nam <?php echo date('Y'); ?>. Quý Công ty đã sử dụng email: <?php echo $email ?> để đăng ký tài khoản tham gia chương trình.</p>
	<p>Vui lòng bấm vào đường link <?php echo sprintf(lang('email_activate_subheading'), anchor('client/user/activate/'. $id .'/'. $activation, 'tại đây'));?> để kích hoạt tài khoản và tiến hành khai hồ sơ.</p>
	<p>Hỗ trợ kỹ thuật: Mr. Mạc Công Minh 0936 136 696, minhmc@vinnasa.org.vn   </p>
	<p>Tư vấn hồ sơ: Mr. Nguyễn Thế Anh, 091 319 66 99/02435772336; anhnt@vinasa.org.vn</p>
	<p>Trân trọng cảm ơn!</p>
</body>
</html>