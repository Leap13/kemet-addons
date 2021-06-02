var Header = document.querySelector(".kmt-sticky-header");

if (Header != null) {
  var sticky = Header.offsetHeight;
  window.onscroll = function () {
    if (window.pageYOffset > sticky) {
      Header.classList.add("kmt-is-sticky");
    } else {
      Header.classList.remove("kmt-is-sticky", "swing");
    }
  };
}
(function () {
  var kemetStickyHeader = {
    topOffSet: 0,
    mainOffSet: 0,
    bottomOffSet: 0,
    stickySections: {
      top: {
        enable: kemet.stickyTop,
      },
      main: {
        enable: kemet.stickyMain,
      },
      bottom: {
        enable: kemet.stickyBottom,
      },
    },
    enabledSections: [],
    init: function () {
      window.addEventListener("resize", kemetStickyHeader.sticky, false);
      window.addEventListener("scroll", kemetStickyHeader.sticky, false);
      window.addEventListener("load", kemetStickyHeader.sticky, false);
      kemetStickyHeader.setHeight();
    },
    stickySection: function (section) {
      var sectionContainer = document.querySelector(
          "." + section + "-header-bar"
        ),
        top = 0,
        staticOffSet = kemetStickyHeader[section + "OffSet"];

      if (kemetStickyHeader.enabledSections.length > 1) {
        top = kemetStickyHeader.offSetTop(section).top;
        staticOffSet = kemetStickyHeader.offSetTop(section).offSet;
      }

      if (window.scrollY > staticOffSet) {
        sectionContainer.style.top = top + "px";
        sectionContainer.classList.add("kmt-is-sticky");
      } else {
        sectionContainer.style.top = null;
        sectionContainer.classList.remove("kmt-is-sticky", "swing");
      }
    },
    /**
     * Get element's offset.
     */
    getOffset: function (el) {
      if (el instanceof HTMLElement) {
        var rect = el.getBoundingClientRect();

        return {
          top: rect.top + window.pageYOffset,
          left: rect.left + window.pageXOffset,
        };
      }

      return {
        top: null,
        left: null,
      };
    },
    setHeight: function () {
      Object.keys(kemetStickyHeader.stickySections).map(function (
        section,
        index
      ) {
        var sectionWrap = document.querySelector(
          ".kmt-" + section + "-header-wrap"
        );

        switch (section) {
          case "top":
            kemetStickyHeader.topOffSet =
              kemetStickyHeader.getOffset(sectionWrap).top;
            break;
          case "main":
            kemetStickyHeader.mainOffSet =
              kemetStickyHeader.getOffset(sectionWrap).top;
            break;
          case "bottom":
            kemetStickyHeader.bottomOffSet =
              kemetStickyHeader.getOffset(sectionWrap).top;
            break;
        }

        if ("on" === kemetStickyHeader.stickySections[section].enable) {
          kemetStickyHeader.enabledSections.push(section);

          sectionWrap.setAttribute("data-height", sectionWrap.offsetHeight);
        }
      });
    },
    offSetTop: function (section) {
      var offSet = 0,
        top = 0,
        sections = kemetStickyHeader.enabledSections;

      switch (section) {
        case "main":
          if (sections.includes("top")) {
            top = kemetStickyHeader.mainOffSet;
            offSet = kemetStickyHeader.topOffSet;
          }
          break;
        case "bottom":
          if (sections.includes("main") && !sections.includes("top")) {
            var topHeight = document.querySelector(
              ".kmt-top-header-wrap"
            ).offsetHeight;
            top = kemetStickyHeader.bottomOffSet - topHeight;
            offSet = 0;
          }
          if (!sections.includes("main") && sections.includes("top")) {
            var mainHeight = document.querySelector(
              ".kmt-main-header-wrap"
            ).offsetHeight;
            var topHeight = document.querySelector(
              ".kmt-top-header-wrap"
            ).offsetHeight;
            top = kemetStickyHeader.bottomOffSet - mainHeight;
            offSet = kemetStickyHeader.mainOffSet;
          }
          if (sections.includes("main") && sections.includes("top")) {
            top = kemetStickyHeader.bottomOffSet;
            offSet = kemetStickyHeader.topOffSet;
          }
          break;
      }

      return { offSet: offSet, top: top };
    },
    sticky: function () {
      Object.keys(kemetStickyHeader.stickySections).map(function (
        section,
        index
      ) {
        if ("on" === kemetStickyHeader.stickySections[section].enable) {
          kemetStickyHeader.stickySection(section);
        }
      });
    },
  };
  Array.prototype.remove = function () {
    var what,
      a = arguments,
      L = a.length,
      ax;
    while (L && this.length) {
      what = a[--L];
      while ((ax = this.indexOf(what)) !== -1) {
        this.splice(ax, 1);
      }
    }
    return this;
  };
  if ("loading" === document.readyState) {
    // The DOM has not yet been loaded.
    document.addEventListener("DOMContentLoaded", kemetStickyHeader.init);
  } else {
    // The DOM has already been loaded.
    kemetStickyHeader.init();
  }
})(window, document);
