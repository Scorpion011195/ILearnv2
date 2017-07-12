$(document). ready(function(){

	var slides = $(document).find('.slide');
	var currentSlide = 0;
	var timeSlide = 2000;
	var slideInterval = setInterval(nextSlide,timeSlide);

	function nextSlide(){
		slides[currentSlide].className = 'slide';
		currentSlide = (currentSlide+1)%slides.length;
		slides[currentSlide].className = 'slide showing';
	}

});