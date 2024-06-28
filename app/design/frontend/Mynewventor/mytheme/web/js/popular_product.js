function decreaseQty(button) 
{
    var qtyInput = button.nextElementSibling;
    var currentQty = parseInt(qtyInput.value);
    if (currentQty > 1)
    {
        qtyInput.value = currentQty - 1;
    }
}

function increaseQty(button) {
    var qtyInput = button.previousElementSibling;
    var currentQty = parseInt(qtyInput.value);
    qtyInput.value = currentQty + 1;
}

require(['jquery', 'slick'], function($) {
    $(document).ready(function(){
        $('.products-slider .products-grid').slick({
            slidesToShow: 4, // Show 5 products per row
            slidesToScroll: 1, // Scroll 1 product at a time
            dots: false,
            arrows: false, // Enable arrows for navigation
            infinite: true, // Enable infinite looping
            speed: 500, // Set the sliding speed
            autoplay: true, // Automatically start sliding
            autoplaySpeed: 1000 // Set the autoplay speed in milliseconds
        });
    });
});