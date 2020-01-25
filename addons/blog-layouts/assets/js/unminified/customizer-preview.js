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
})(jQuery);
