;(function ( $, window, undefined ) {
    var site_layout = kemetAddons.site_content_layout || '';
    console.log(site_layout);
}(jQuery, window));

var Header = document.querySelector('.kmt-sticky-header');

if (Header != null) {
    var sticky = Header.offsetHeight;
    window.onscroll = function () {
        if (window.pageYOffset > sticky) {
            Header.classList.add("kmt-is-sticky")
        } else {
            Header.classList.remove("kmt-is-sticky", 'swing' );
        }
    }
}