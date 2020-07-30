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

	//Selected Options
	var specific_old_v = kemetAddons.test != '' ? kemetAddons.test : '';

	if(typeof specific_old_v == 'object'){
		
		$.each(specific_old_v,function(index, post_id) {

			var specificSelect =  $('.kmt-specifics-location-select').find('select');
				postID = post_id.toString();
			if(	postID.includes(',')){

				var idsObj = postID.split(",");
				
				$.each(idsObj,function(x, id) {
					
					$.post( kemetAddons.ajax_url, {post_id:id, action: 'kemet_get_post_title', nonce: kemetAddons.ajax_title_nonce })
					.done(function( data ) {
						specificSelect[index].append(new Option(data, id , false, true));
					});
				});

			}else{
				$.post( kemetAddons.ajax_url, {post_id:postID, action: 'kemet_get_post_title', nonce: kemetAddons.ajax_title_nonce })
				.done(function( data ) {
					specificSelect[index].append(new Option(data, postID , false, true));
				});
			}
				
		});
	}
	
	//Specific Select With Search Using Select2
	var convertToSelect2 = function(selector){
		$( selector ).select2({

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
			language: kemetAddons.lang,
			width: '100%',
		});
	};

	var specificSelect = $('.kmt-specifics-location-select').find('select');
	specificSelect.each(function(index, selector) {
		convertToSelect2( selector );
	});

	//convertToSelect2();
	
	// var addRow = $('.all-display-on-rules').find('.kfw-repeater-add');

	// addRow.click(function(){
	// 	var specificSelect = $('.kmt-specifics-location-select').find('select');
		
	// 	specificSelect.each(function(index, selector) {
	// 		convertToSelect2( selector );
	// 	});
	// });

})(jQuery);