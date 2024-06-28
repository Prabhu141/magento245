require(['jquery', 'slick'], function($) {
  $(document).ready(function() {
      $('.slick-slider').slick({
          autoplay: true,             // Enable autoplay
          autoplaySpeed: 1000,        // Set autoplay speed in milliseconds (3 seconds in this example)
          slidesToShow: 5,            // Show 5 images per row
          slidesToScroll: 1,         
          dots: false,
          arrows: false,
          infinite: true,
          responsive: [
              {
                  breakpoint: 1200,  
                  settings: {
                      slidesToShow: 4
                  }
              },
              {
                  breakpoint: 992,   
                  settings: {
                      slidesToShow: 3
                  }
              },
              {
                  breakpoint: 768,   // Responsive settings for smaller screens
                  settings: {
                      slidesToShow: 2
                  }
              },
              {
                  breakpoint: 576,   // Responsive settings for smaller screens
                  settings: {
                      slidesToShow: 1
                  }
              }
          ]
      });
  });
});