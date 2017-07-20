$(document).ready(function () {
	if($(window).width() <= '240px'){
		var height = $('.carousel-inner .item img').height($('.il-logo').height());
		console.log(height);
	}
	else{
		$('.carousel-inner .item img').css('height', '72px');
	}
	
});

//Change password
$(document).ready(function(){
	$("#changePassword").change(function()
	{
		if($(this).is(":checked"))
		{
			$(".password").removeAttr('disabled');
		}
		else
		{
			$(".password").attr('disabled','');
		}
	});
});
