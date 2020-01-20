(function ($) {
  //Header 5
  $('.header-main-layout-5 .menu-icon-social').on('click', function () {
    var header_5 = $('.header-main-layout-5 .kmt-navbar-collapse');
    $(this).children('.menu-icon').toggleClass('open');
    header_5.slideToggle('300');
  });

  //Header 8
  $('.header-main-layout-8 .menu-icon-social').click(function () {
    if ($(this).children('.menu-icon').hasClass('open')) {
      $('.header-main-layout-8 .main-header-bar-wrap').removeClass('side-header');
      $('.header-main-layout-8 .menu-icon-social .menu-icon').removeClass('open');
    } else {
      $('.header-main-layout-8 .main-header-bar-wrap').addClass('side-header');
      $('.header-main-layout-8 .menu-icon-social .menu-icon').addClass('open'); 
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

  //Header 7
  $('.header-main-layout-7 .menu-icon-social').click(function () {
    if ($(this).children('.menu-icon').hasClass('open')) {
      $('.header-main-layout-7 .main-header-bar').removeClass('side-header');
      $('.header-main-layout-7 .menu-icon-social .menu-icon').removeClass('open');
    } else {
      $('.header-main-layout-7 .main-header-bar').addClass('side-header');
      $('.header-main-layout-7 .menu-icon-social .menu-icon').addClass('open'); 
    }

  });

  var header7Animation = '';
  $('.header-main-layout-7 .main-header-bar').mouseleave(function () {
      if($(this).hasClass('side-header')){
        header7Animation = setTimeout(function () {
          $('.header-main-layout-7 .main-header-bar').removeClass('side-header');
          $('.header-main-layout-7 .menu-icon-social .menu-icon').removeClass('open');
        }, 2000);
    }
  });
  $('.header-main-layout-7 .main-header-bar , .header-main-layout-7 .menu-icon-social').mouseenter(function () {
    clearTimeout(header7Animation);
  });
  var logoPostion = function(){
    if($('body').hasClass('kmt-header-break-point') && $('header').hasClass('header-main-layout-7')){
      $(".main-header-container").prepend($('.site-branding'));
    }else if($('body').hasClass('kmt-header-break-point') != true && $('header').hasClass('header-main-layout-7')){
      $(".main-header-bar-wrap").prepend($('.site-branding'));
    }  
  }
  window.addEventListener("resize", function() {
    logoPostion();
  });
  logoPostion();
  
  //Header 9
  $('.header-main-layout-9 .menu-icon-social .menu-icon').click(function () {
      $('.header-main-layout-9 .main-header-container').toggleClass('side-header');
  });
})(jQuery);