<html>
<body>
	<strong>Kính gửi Quý công ty!</strong>
	<p>Cảm ơn Quý Công ty đã đăng ký tham gia Chương trình 50+10 Doanh nghiệp CNTT hàng đầu Việt Nam 2019. Quý Công ty đã sử dụng email: <?php echo $identity ?> để đăng ký tài khoản tham gia chương trình.</p>
	<p><?php echo sprintf(lang('email_activate_subheading'), anchor('client/user/activate/'. $id .'/'. $activation, 'đây'));?> để kích hoạt tài khoản và khai hồ sơ.</p>
	<p>Trường hợp cần hỗ trợ đăng nhập được vui lòng liên hệ: <strong>Anh Mạc Công Minh</strong>, mobile: 0936 136 696/024 3577 2336, email: minhmc@vinasa.org.vn để được hỗ trợ</p>
	<br>
	<br>
	<br>
	<p>Trân trọng cảm ơn!</p>
</body>
</html>