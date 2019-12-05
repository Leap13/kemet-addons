(function($){
 
    "use strict";
 
    function validateValue($value, $target , $email){
        if ($email == true) {
            if ($value == '') {
                $target.addClass('visible');
            } else {
                $target.removeClass('visible');
            }
 
        } else {
            if ($value == '') {
                $target.addClass('visible');
            } else {
                $target.removeClass('visible');
            }
        }
    };
    
    $('.et-mailchimp-form').each(function(){
 
        var $this = $(this);
 
        $this.submit(function(event) {
 
            // 1. Prevent form submit default
 
            event.preventDefault();
 
            // 2. serialize form data
 
            var formData = $this.serialize();
 
            var email   = $this.find("input[name='email']");
 
            // 3. Before submit validate email
            
            validateValue(email.val(), email.next(".alert") , true);
 
            if (email.val() != ''){
                console.log('work');
                $this.find(".sending").addClass('visible');
 
                // 4. POST AJAX
 
                $.ajax({
                    type: 'POST',
                    url: $this.attr('action'),
                    data: formData
                })
                .done(function(response) {
 
                    // 5. If success show the success message to user
 
                    $this.find(".sending").removeClass('visible');
                    $this.find(".et-mailchimp-success").addClass('visible');
                    setTimeout(function(){
                        $this.find(".et-mailchimp-success").removeClass('visible');
                    },2000);
                })
                .fail(function(data) {
 
                    // 6. If fail show the error message to user
 
                    $this.find(".sending").removeClass('visible');
                    $this.find(".et-mailchimp-error").addClass('visible');
                    setTimeout(function(){
                        $this.find(".et-mailchimp-error").removeClass('visible');
                    },2000);
                })
                .always(function(){
 
                    // 7. Clear the form fields for next subscibe request
 
                    setTimeout(function(){
                        $this.find("input[name='email']").val(email.attr('data-placeholder'));
                    },2000);
                });
 
            }
        });
    });
 
})(jQuery);