var slideIndex = 1;
var slideShowSpeed = 3000;
maxHeightSlide = 0;
checkLimit = 0;

showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active2", "");
  }
  slides[slideIndex-1].style.display = "block"; 
  dots[slideIndex-1].className += " active2";

  var height = slides[slideIndex-1].clientHeight-5;
  if(height >= maxHeightSlide){
    maxHeightSlide = height;
    updateSlideHeight();
  }
}



var myVar = setInterval(myTimer, slideShowSpeed);
first = 1;
function myTimer() {
  if(first == 1){
    first = 0;
    return;
  }
  showSlides(slideIndex+=1);
}










function calculateHeightOfSlides(){
  $(".slideshow-container").css({"height":""});
  $(".mySlides").css({"margin-top":""});
  maxHeightSlide = 0;
  $('.slideshow-container .mySlides').each(function() {
    $(this).css({"height":""});
    var temp = $(this).outerHeight();
    if(temp > maxHeightSlide){
      maxHeightSlide = temp;
    }
  });

  if(maxHeightSlide > 50){
    checkLimit = 0;
    // $('.mySlides').css({"height":maxHeightSlide});
    updateSlideHeight();
  }else if(checkLimit <= 10){
    checkLimit++;
    setTimeout(function(){ 
      calculateHeightOfSlides() 
    }, 500);
  }  
}
function updateSlideHeight(){
  $(".slideshow-container").css({"height":maxHeightSlide});
}

calculateHeightOfSlides();
$(window).resize(function(){
  calculateHeightOfSlides();
});

