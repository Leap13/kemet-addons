(function ($) {
    var firstTab = $( ".kmt-sc-tabs ul.kmt-tabs-titles > li:first-child" );
    firstTab.addClass('active');
    $( '#' + firstTab.data('tab') ).addClass('active');
    $( ".kmt-sc-tabs ul.kmt-tabs-titles > li" ).click(function (){
        var tabID = $(this).data('tab'),
            tabs  = $( ".kmt-sc-tabs > div" );

        $(this).addClass('active').siblings().removeClass('active');
        tabs.each( function ( index ) {
            if($(this).attr('id') == tabID){
                $(this).addClass('active').siblings().removeClass('active');
            }
        } );    
    });

    //Twitter
    var tweetsContainer = $( ".tweets-container" );
    tweetsContainer.each(function(){
        var settings = $( this ).data('settings');
        $( this ).socialfeed({
            // TWITTER
            twitter:{
                accounts: settings.accounts,
                limit: settings.limit,
                consumer_key: 'wwC72W809xRKd9ySwUzXzjkmS',
                consumer_secret: 'rn54hBqxjve2CWOtZqwJigT3F5OEvrriK2XAcqoQVohzr2UA8h',
                token: "460616970-Deuil3Qx0CnNS2VX9WefxA99gD8OFx1vJ0kn0izb",
                secret: "GBdekapULnR5iCiLozWQMc9xGYhwZlVO2zKXcpBb7AFFT",
                tweet_mode: "extended"
            },
            length: settings.length,
            show_media: settings.showMedia ,
            readMore: settings.readMore ,
            template: settings.template,
        });
    });
})(jQuery);