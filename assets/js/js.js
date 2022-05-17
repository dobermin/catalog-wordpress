$(window).on("load", function () {
    $('body').addClass('loaded');
});

jQuery(document).ready(function ($) {
    $('.page-numbers').addClass('tm-paging-link');
    $('.page-numbers.current').addClass('active');
    $('.prev.page-numbers').removeClass().addClass('btn btn-primary tm-btn-prev mb-2');
    $('.next.page-numbers').removeClass().addClass('btn btn-primary tm-btn-next');


    $('.video').parent().click(function () {
        if ($(this).children(".video").get(0).paused) {
            $(this).children(".video").get(0).play();
            $(this).children(".playpause").fadeOut();
        } else {
            $(this).children(".video").get(0).pause();
            $(this).children(".playpause").fadeIn();
        }
    });
});