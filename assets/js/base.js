$(window).load(function() {
    $(".panel-collapse").removeClass("in");
});
$(document).ready(function() {
    $(".mobilemenu a").click(function(){
        $(".navmenu").addClass("in");
    });
    $(".keluar a").click(function(){
        $(".navmenu").removeClass("in");
    })
    $(".segmentasi-list li a").click(function() {
        var classnya = $(this).attr("rel");
        $(".segment1").hide();
        $(".class-" + classnya).show();
        //$(this).parent().parent().attr("id", classnya);
    })
    $("#owl-demo").owlCarousel({
        slideSpeed: 300,
        paginationSpeed: 400,
        items: 1,
        itemsDesktop: false,
        itemsDesktopSmall: false,
        itemsTablet: false,
        itemsMobile: false,
        autoPlay: 5000
    });
    $("#owl-demo-testi").owlCarousel({
        slideSpeed: 300,
        paginationSpeed: 400,
        items: 1,
        itemsDesktop: false,
        itemsDesktopSmall: false,
        itemsTablet: false,
        itemsMobile: false
    });
    $("#owl-demo-news").owlCarousel({
        items: 3,
        pagination: false,
        navigation: true,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [600, 2],
        itemsDesktopSmall: [500, 1],
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
    });
    $("#owl-demo-gallery").owlCarousel({
        items: 4,
        pagination: false,
        navigation: true,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [600, 2],
        itemsDesktopSmall: [500, 1],
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
    });
    $("h4.panel-title a").click(function() {
        $(".panel-default").removeClass("bg");
        $(this).parent().parent().parent().addClass("bg");
        $(".panel-collapse").removeClass("show");
        $(".panel-collapse").removeClass("in");
    })
    $("#segmentasi ul li").hover(function() {
        $("#segmentasi ul li .sub").hide();
        $(this).children(".sub").show();
    })
    $(".triger_submit").click(function() {
        $(".submit").click();
    });
    $(".btn-search img").click(function(){
        $(".formsearch").show();
    });
    $('.search').keypress(function (e) {
      if (e.which == 13) {
        $('form.searchform').submit();
        return false; 
      }
    });
    $(".justnumber").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});