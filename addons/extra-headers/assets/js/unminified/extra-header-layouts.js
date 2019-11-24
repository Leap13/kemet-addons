(function ($) {
  $('.menu-icon').on('click', function () {
    var header_5 = $('.header-main-layout-5 .kmt-navbar-collapse');
    $(this).toggleClass('open');
    header_5.slideToggle('300');
  });
  $('.header-main-layout-8 .menu-icon-social .menu-icon').click(function (){
    $('.header-main-layout-8 .main-header-container').toggleClass('d-block');
    $('.header-main-layout-8 .main-header-bar-wrap').toggleClass('w-300');
    $(this).toggleClass('d-none');
});

$('.header-main-layout-8 .main-header-bar-wrap').mouseleave(function(){
  setTimeout(function(){
    $('.header-main-layout-8 .main-header-container').removeClass('d-block');
    $('.header-main-layout-8 .main-header-bar-wrap').removeClass('w-300');
    $('.header-main-layout-8 .menu-icon-social .menu-icon').removeClass('d-none open');
  },2000);
});
})(jQuery);