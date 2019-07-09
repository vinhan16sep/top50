<!-- MAiN JS -->
<script src="<?php echo site_url('assets/admin/'); ?>js/admin/main.js"></script>
<script src="<?php echo site_url('assets/admin/bower_components/iCheck/js/icheck.min.js'); ?>"></script>
<script type="text/javascript">
	$('.delete-checkbox input[type="checkbox"]').iCheck({
	    checkboxClass: 'icheckbox_square-blue',
	    radioClass: 'iradio_square-blue'
	});

	//Enable check and uncheck all functionality
	$(".checkbox-toggle").click(function () {
	    var clicks = $(this).data('clicks');
	    if (clicks) {
	        //Uncheck all checkboxes
	        $(".delete-checkbox input[type='checkbox']").iCheck("uncheck");
	        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
	    } else {
	        //Check all checkboxes
	        $(".delete-checkbox input[type='checkbox']").iCheck("check");
	        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
	    }
	    $(this).data("clicks", !clicks);
	});
</script>

</body>
</html>

