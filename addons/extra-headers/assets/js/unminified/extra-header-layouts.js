(function ($) {
  $('.menu-icon').on('click', function () {
    var header_5 = $('.header-main-layout-5 .kmt-navbar-collapse');
    $(this).toggleClass('open');
    header_5.slideToggle('300');
  });
})(jQuery);