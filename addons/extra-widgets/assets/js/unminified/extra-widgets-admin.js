
function openFbPopup(url, width, height, callBack) {
    var top = top || screen.height / 2 - height / 2,
        left = left || screen.width / 2 - width / 2,
        win = window.open(
            url,
            "",
            "location=1,status=1,resizable=yes,width=" +
                width +
                ",height=" +
                height +
                ",top=" +
                top +
                ",left=" +
                left
        );

    function check() {
        if (!win || win.closed != false) {
            callBack();
        } else {
            setTimeout(check, 100);
        }
    }

    setTimeout(check, 100);
}
(function ($) {
    jQuery(window).on('load', function() {
        var fbLogin = jQuery('.fb-login');
        
        fbLogin.click(function(){
            var url         = "https://appfb.premiumaddons.com/auth/fbreviews?scope=manage_pages,pages_show_list",
                thisBtn = $(this),
                btnParent = thisBtn.parent().parent(),
                accessTokenI = btnParent.find('.fb-access-token textarea'),
                pageIDI = btnParent.find('.fb-page-id input'),
                nameI   =  btnParent.find('.fb-page-name input'); 
               
            url = url + "&key=" + '22e97db8bcfb20b4d35ad9c9727a9050';
            openFbPopup(
                url, 670, 520,
                function() {
                    $.ajax({
                        type: "GET",
                        url: kfw_vars.ajax_url,
                        dataType: "json",
                        data: {
                            action: "get_page_token",
                        },
                        success: function( res ) {                        
                            if (res.success) {
                                
                                var accessToken = res.data.access_token,
                                name = res.data.name,
                                id = res.data.id;
                                
                                accessTokenI.val(accessToken).trigger('input');
                                pageIDI.val(id).trigger('input');
                                nameI.val(name).trigger('input');
                                
                            }
                        },
                        error: function(err){
                            console.log( err );
                        }
                    });
                }
            );
        
            return false;
        });

    });
})(jQuery);
