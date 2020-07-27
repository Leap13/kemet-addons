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
})(jQuery);