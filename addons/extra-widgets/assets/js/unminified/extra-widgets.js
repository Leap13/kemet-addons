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
})(jQuery);