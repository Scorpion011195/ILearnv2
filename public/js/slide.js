$(document).ready(function () {
	if($(window).width() <= '240px'){
		var height = $('.carousel-inner .item img').height($('.il-logo').height());
		console.log(height);
	}
	else{
		$('.carousel-inner .item img').css('height', '72px');
	}
	
});

//datepicker
$(document).ready(function () {
                
    $('#datepicker').datepicker({
        format: "yyyy/mm/dd"
    });  

});


