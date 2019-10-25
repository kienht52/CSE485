$( document ).ready(function() {
    $('#showCollapse').click(function(){
        $(".collapse-handmade").slideToggle("slow");
    });
    $('#showCollapse2').click(function(){
        $(".collapse-handmade").slideToggle("slow");
    });

         $('.content-responsive').hide();
        $('#showMenuRes').click(function(){
            $('.content-responsive').slideToggle();
        });
        $(".center").slick({
            dots: true,
            infinite: true,
            centerMode: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            dots:false,

            responsive: [{
                breakpoint: 900,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }]
                    
        });
});