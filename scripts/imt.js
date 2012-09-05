google.load("jquery", "1.6.4");

var SLIDESHOW_SPEED_MS = 5000;

var currentIndex = 0;
var images = new Array();

var startSlideshow = function() {
    var image1 = new Image();
    image1.src ="images/splash_01.jpg";
    images.push(image1);

    var image2 = new Image();
    image2.src ="images/splash_02.jpg";
    images.push(image2);

    var image3 = new Image();
    image3.src ="images/splash_03.jpg";
    images.push(image3);

    var image4 = new Image();
    image4.src ="images/splash_04.jpg";
    images.push(image4);

    var image5 = new Image();
    image5.src ="images/splash_05.jpg";
    images.push(image5); 

    setInterval(nextImage, SLIDESHOW_SPEED_MS);
};

var nextImage = function() {
    $("#image").animate({opacity: 0}, 1000,
            function() {
                this.src = images[++currentIndex % images.length].src;
            }).animate({opacity: 1}, 1000);
};
