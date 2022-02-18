$(document).ready(function(){
    // This for the owl corousel
    $(".owl-carousel").owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:2500,
        autoplayHoverPause:true,
        margin:16,
        nav:true,
        smartSpeed: 450,
        responsive:{
    0:{
        items:2,
        nav:true
    },
    600:{
        items:2,
        nav:false
    },
    1000:{
        items:3,
        nav:true,
        loop:true
    }
}
    });

  
    // hover
    $('.ListItemLogin').mouseover(function(){
        $('.LoginRegisterLinks').removeClass('ToggleLinks2')
        $('.LoginRegisterLinks').addClass('ToggleLinks1')
    });

    $('.ListItemLogin').mouseout(function(){
        $('.LoginRegisterLinks').removeClass('ToggleLinks1')
        $('.LoginRegisterLinks').addClass('ToggleLinks2')
    })
});