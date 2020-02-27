(function ($) {
    kemet_css('kemet-settings[blog-posts-border-color]', 'border-color', '.blog-layout-2 .blog-post-layout-2 , .blog-layout-4 .blog-post-layout-4 .post-content');
    kemet_css('kemet-settings[blog-title-meta-border-color]', 'border-color', '.blog-layout-4 .blog-post-layout-4 .entry-content');
    wp.customize('kemet-settings[blog-posts-border-size]', function (setting) {
		setting.bind(function (border) {

			var dynamicStyle = '.blog-layout-2 .blog-post-layout-2 , .blog-layout-4 .blog-post-layout-4 .post-content { border-width: ' + border + 'px }';

			kemet_add_dynamic_css('blog-posts-border-size', dynamicStyle);
		});
    });
    wp.customize('kemet-settings[blog-title-meta-border-size]', function (setting) {
		setting.bind(function (border) {

			var dynamicStyle = '.blog-layout-4 .blog-post-layout-4 .entry-content { border-width: ' + border + 'px }';

			kemet_add_dynamic_css('blog-title-meta-border-size', dynamicStyle);
		});
	});
	
	kemet_responsive_spacing('kemet-settings[blog-container-inner-spacing]', '.blog .blog-posts-container:not(.blog-layout-2) .kmt-article-post , .blog-layout-2 .kmt-article-post > div', 'padding', ['top', 'right', 'bottom', 'left']);
	kemet_responsive_slider('kemet-settings[post-image-height]', '.blog-layout-5 .blog-post-layout-5 .entry-header .post-thumb', 'height');
	kemet_css('kemet-settings[overlay-icon-color]', 'background-color', '.overlay-image .post-details a:before , .overlay-image .post-details a:after');
	kemet_css('kemet-settings[overlay-image-bg-color]', 'background-color', '.squares .overlay-image .overlay-color .section-1:before ,.squares .overlay-image .overlay-color .section-1:after ,.squares .overlay-image .overlay-color .section-2:before ,.squares .overlay-image .overlay-color .section-2:after , .bordered .overlay-color ,.framed .overlay-color');

	function resizeGridContiner(){
		var conatiner = $('.blog-posts-container.blog-layout-2');

		if('undefined' != typeof conatiner){
			conatiner.isotope( 'layout');
		}
	}
	var options = ['kemet-settings[container-inner-spacing]','kemet-settings[blog-container-inner-spacing]','kemet-settings[read-more-border-size]','kemet-settings[readmore-padding]'];

	$.each(options , function(index , id){
		wp.customize(id, function (value) {
			value.bind(function () {
				resizeGridContiner();
			});
		});
	});
})(jQuery);
