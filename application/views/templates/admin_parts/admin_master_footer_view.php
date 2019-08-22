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

<script>
    function showgroup(event){
        event.preventDefault();
        if($(event.target.parentElement.nextElementSibling).hasClass('show')){
        	$(event.target).attr('class','fa fa-plus');
	        $(event.target.parentElement.nextElementSibling).hide(500);
	        $(event.target.parentElement.nextElementSibling).removeClass('show');
        }else{
        	$(event.target).attr('class','fa fa-minus');
        	$(event.target.parentElement.nextElementSibling).show(500);
	        $(event.target.parentElement.nextElementSibling).addClass('show');
        }
	        
    }
</script>
</body>
</html>

