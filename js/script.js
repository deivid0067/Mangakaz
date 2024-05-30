var slides = $(".carrosselslide")

slides.owlCarousel({
    autoplay: true,
    autoplayHoverPause: true,
    loop:true,
    dots:false,
    autoplayTimeout:2000,
    items: 1,
});

var carrossel = $(".prods")

carrossel.owlCarousel({
    autoplay: true,
    autoplayHoverPause: true,
    loop:false,
    nav:true,
    autoplayTimeout:2200,
    responsive: {
        0: {
            items:1,
            dots:false,
        },

        520: {
            items:1,
            dots:false
        },
        550: {
            items:2,
            dots:false
        },
        750: {
            items:3,
            dots:false
        },
        1000: {
            items:4,
            dots: true
        }
    },
    
    navText: [
        "<img class='seta-esquerda'>",
        "<img class='seta-direita'>"
    ],
    
})
