(function ($) {

    var descriptions = kemetAddons.hooks_descriptions,
        hooksSelect = $('.kmt-hooks-select .kfw-fieldset select'),
        descriptionDiv = $('.kmt-hooks-select .kfw-text-desc');

    hooksSelect.change(function(){
        var $this = $(this),
            value = $this.val(),
            desc = descriptions[value];

            if(descriptions[value] != '' && typeof descriptions[value] != 'undefined'){
                descriptionDiv.html('Action to add your content or snippet ' + desc + '.');
            }else{
                descriptionDiv.html('');
            }
            
    });

    //specific position select
    var specificSelect = $('.kmt-specifics-location-select').find('select');
    specificSelect.each(function(index, selector) {
        $( selector ).kmtselect2({

			placeholder: kemetAddons.search,

			ajax: {
			    url: kemetAddons.ajax_url,
			    dataType: 'json',
			    method: 'post',
			    delay: 250,
			    data: function (params) {
			      	return {
			        	query: params.term, // search term
				        page: params.page,
						action: 'kemet_ajax_get_posts',
						'nonce': kemetAddons.ajax_nonce,
			    	};
				},
				processResults: function (data) {
		            return {
		                results: data
		            };
		        },
			    cache: true
			},
			minimumInputLength: 2,
			language: kemetAddons.lang
		});
    });
})(jQuery);