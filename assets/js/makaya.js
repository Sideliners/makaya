$(function(){
    $('#myCarousel').carousel();
    $('#myCarousel .carousel-inner:first-child').addClass('active');

    $('.facebook').on('click', function(){
        window.open(
            'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(location.href),
            'facebook-share-dialog',
            'width=626,height=436'
        );
        return false;
    });

    $('.twitter').on('click', function(event) {
        var width  = 575,
        height = 400,
        left   = ($(window).width()  - width)  / 2,
        top    = ($(window).height() - height) / 2,
        url    = this.href,
        opts   = 'status=1' +
            ',width='  + width  +
            ',height=' + height +
            ',top='    + top    +
            ',left='   + left;
        window.open(url, 'twitter', opts);
        return false;
    });

    $('.pinterest').on('click', function(event){
        var width  = 575,
        height = 400,
        left   = ($(window).width()  - width)  / 2,
        top    = ($(window).height() - height) / 2,
        url    = this.href,
        opts   = 'status=1' +
            ',width='  + width  +
            ',height=' + height +
            ',top='    + top    +
            ',left='   + left;
        window.open(url, 'Pinterest', opts);
        return false;
    });
});
