$(document).ready(function(){

    /*---------------------------------------------------
    1. Owl-carousel slider dots
    ---------------------------------------------------*/
    $("#banner-area .owl-carousel").owlCarousel({
        dots:true,
        items:1
    })

    /*---------------------------------------------------
    2. Top sale carousel slider
    ---------------------------------------------------*/
    $("#top-sale .owl-carousel").owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        autoplay:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })


    /*---------------------------------------------------
    3. New phone carousel slider
    ---------------------------------------------------*/
    $("#new-phones .owl-carousel").owlCarousel({
        loop:true,
        nav:false,
        dots:true,
        autoplay:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })

    /*---------------------------------------------------
    3. Blogs owl carousel
    ---------------------------------------------------*/
    $("#blogs .owl-carousel").owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        responsive : {
            0: {
                items: 1
            },
            600: {
                items: 3
            }
        }
    })

    /*---------------------------------------------------
    4. Isotope filter
    ---------------------------------------------------*/
    var grid = $(".grid").isotope({
        itemSelector:'.grid-item',
        layoutMode:'fitRows'
    })


    /*---------------------------------------------------
    5. Filter items on button click
    ---------------------------------------------------*/
    $(".button-group").on("click", "button", function(){
        var filterValue = $(this).attr('data-filter');
        grid.isotope({ filter: filterValue});
    })


    /*---------------------------------------------------
    6. Product qty section
    ---------------------------------------------------*/
    let qty_up = $(".qty-up");
    let qty_down = $(".qty-down");

    /*---------------------------------------------------
    7. Qty up button and down button
    ---------------------------------------------------*/
    qty_up.click(function(e){
        let input_qty = $(`.qty_input[data-id='${$(this).data("id")}']`);
        if(input_qty.val() >= 1 && input_qty.val() <= 9){
            input_qty.val(function(i,oldval){
                return ++oldval;
            })
        }
    })

    qty_down.click(function(e){
        let input_qty = $(`.qty_input[data-id='${$(this).data("id")}']`);
        if(input_qty.val() > 1 && input_qty.val() <= 10){
            input_qty.val(function(i, oldval){
                return --oldval;
            })
        }
    })


    /*---------------------------------------------------
    8. Accordion
    ---------------------------------------------------*/
    function emeAccordion(){
        $('.accordion__title')
          .siblings('.accordion__title').removeClass('active')
          .first().addClass('active');
        $('.accordion__body')
          .siblings('.accordion__body').slideUp()
          .first().slideDown();
        $('.accordion').on('click', '.accordion__title', function(){
          $(this).addClass('active').siblings('.accordion__title').removeClass('active');
          $(this).next('.accordion__body').slideDown().siblings('.accordion__body').slideUp();
        });
        };
    emeAccordion();

    














})