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

	$(".btnSearch").click(function()
	{
		var val = $(this).text();
		$("#txtSearch").val(val);
		$("#frmSearch").submit();
	});
	
                
    $('#datepicker').datepicker({
        format: "yyyy/mm/dd"
    }); 

});

///// 
$(document).ready(function(){
	$('#lagPair').change(function(){
		var lagPair = $(this).val();
		$.get('/test/' + lagPair, function(data){
			$('#typeWord').html(data);
		});
	});
});




