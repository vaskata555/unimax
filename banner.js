
var slideIndex = 0;

showSlides()
function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
}
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 4400); // Change image every 4 seconds
}
window.addEventListener('load', function() {
  adjustBannerImage();
});

window.addEventListener('resize', function() {
  adjustBannerImage();
});

function adjustBannerImage() {
  var banner = document.getElementById('banner-1');
  var screenWidth = window.innerWidth;

  if (screenWidth <= 680) {
    banner.src = "post.gif";
  } else if (screenWidth <= 1024) {
    banner.src = "test1.jpg";
  } else {
    banner.src = "test1.jpg";
  }
}