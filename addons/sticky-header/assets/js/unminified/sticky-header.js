var Header = document.querySelector('.kmt-sticky-header');

if (Header != null) {
    window.onscroll = function () {
        if (window.pageYOffset > 0) {
            Header.classList.add("kmt-is-sticky")
        } else {
            Header.classList.remove("kmt-is-sticky", 'swing' );
        }
    }
}