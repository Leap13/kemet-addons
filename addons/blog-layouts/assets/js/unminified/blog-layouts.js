(function ($) {
        var Mode = 'masonry';
        if($('.blog-posts-container.blog-layout-2').hasClass('fit-rows')){
          Mode = 'fitRows';
        }
      $('.blog-posts-container.blog-layout-2').isotope({
        itemSelector: '.kmt-article-post',
        layoutMode: Mode,
      });
})(jQuery);