(function ($) {
  $('.menu-icon').on('click', function () {
    var header_5 = $('.header-main-layout-5 .kmt-navbar-collapse');
    $(this).toggleClass('open');
    header_5.slideToggle('300');
  });
  $('.header-main-layout-8 .menu-icon-social .menu-icon').click(function () {
    if ($(this).hasClass('open') == false) {
      $('.header-main-layout-8 .main-header-bar-wrap').removeClass('side-header');
    } else {
      $('.header-main-layout-8 .main-header-bar-wrap').addClass('side-header');
    }

  });

  var animation = '';
  $('.header-main-layout-8 .main-header-bar-wrap').mouseleave(function () {
    animation = setTimeout(function () {
      $('.header-main-layout-8 .main-header-bar-wrap').removeClass('side-header');
      $('.header-main-layout-8 .menu-icon-social .menu-icon').removeClass('open');
    }, 2000);
  });
  $('.header-main-layout-8 .main-header-bar-wrap').mouseenter(function () {
    clearTimeout(animation);
  });


  $('.header-main-layout-7 .menu-icon-social .menu-icon').click(function () {
    if ($(this).hasClass('open') == false) {
      $('.header-main-layout-7 .main-header-bar-wrap').removeClass('side-header');
    } else {
      $('.header-main-layout-7 .main-header-bar-wrap').addClass('side-header');
    }

  });

  var header7Animation = '';
  $('.header-main-layout-7 .main-header-bar-wrap').mouseleave(function () {
      if($(this).hasClass('side-header')){
        header7Animation = setTimeout(function () {
          $('.header-main-layout-7 .main-header-bar-wrap').removeClass('side-header');
          $('.header-main-layout-7 .menu-icon-social .menu-icon').removeClass('open');
        }, 2000);
    }
  });
  $('.header-main-layout-7 .main-header-bar-wrap , .header-main-layout-7 .menu-icon-social').mouseenter(function () {
    clearTimeout(header7Animation);
  });
})(jQuery);