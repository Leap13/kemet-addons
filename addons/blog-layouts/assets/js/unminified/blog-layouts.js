(function ($) {
        var Mode = 'masonry';
        if($('.blog-posts-container').hasClass('fit-rows')){
          Mode = 'fitRows';
        }
      $('.blog-posts-container').isotope({
        itemSelector: '.kmt-article-post',
        layoutMode: Mode,
      });
})(jQuery);