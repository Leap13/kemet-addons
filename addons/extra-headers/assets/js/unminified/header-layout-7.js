var header = document.querySelector("#sitehead.header-main-layout-7");
let headerwidth = header.offsetWidth;
header.style.width = '55px';
class DOMHeaderAnimations {
    static slideHide(element, duration = 500) {
        return new Promise(function (resolve, reject) {
            element.style.width = element.offsetWidth + 'px'
            element.style.transitionProperty = 'opacity'
            element.style.transitionDuration = duration + 'ms'
            element.offsetWidth
            element.style.overflow = 'hidden'
            header.style.width = '55px'
            element.style.opacity = 0
            window.setTimeout(function () {
                element.style.display = 'none'
                element.style.removeProperty('opacity')
                element.style.removeProperty('overflow')
                element.style.removeProperty('transition-duration')
                element.style.removeProperty('transition-property')
                resolve(false)
            }, duration)
        })
    }

    static slideShow(element, duration = 500) {

        return new Promise(function (resolve, reject) {
            element.style.removeProperty('display')
            let display = window.getComputedStyle(element).display
            if (display === 'none') display = 'block'
            element.style.display = display
            // let width = element.offsetWidth
            element.style.overflow = 'hidden'
            // element.style.width = 0
            header.style.width = headerwidth + 'px'
            element.offsetWidth
            element.style.transitionProperty = 'opacity'
            element.style.transitionDuration = duration + 'ms'
            element.style.opacity = 1
            window.setTimeout(function () {
                element.style.removeProperty('opacity')
                element.style.removeProperty('overflow')
                element.style.removeProperty('transition-duration')
                element.style.removeProperty('transition-property')
            }, duration)
        })
    }

    static slideToggle(element, duration = 500) {
        if (window.getComputedStyle(element).display === 'none') {
            return this.slideShow(element, duration)
        } else {
            return this.slideHide(element, duration)
        }
    }
}
if (document.getElementById("kmt-animated-icon") != null) {
    document.getElementById("kmt-animated-icon").addEventListener("click", function () {
        document.getElementById("kmt-animated-icon").classList.toggle("open");
        DOMHeaderAnimations.slideToggle(document.querySelector(".kmt-navbar7-collapse"));
    });
    document.addEventListener("scroll", function () {
        if (window.getComputedStyle(document.querySelector(".kmt-navbar7-collapse")).display != 'none') {
            document.getElementById("kmt-animated-icon").classList.remove("open");
            DOMHeaderAnimations.slideHide(document.querySelector(".kmt-navbar7-collapse"));
        }
    });
}