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
    topDefaultHeight: 0,
    mainDefaultHeight: 0,
    bottomDefaultHeight: 0,
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
        sectionWrap = document.querySelector(
          ".kmt-" + section + "-header-wrap"
        ),
        top = 0,
        sectionDefaultHeight = kemetStickyHeader[section + "DefaultHeight"],
        staticOffSet = kemetStickyHeader[section + "OffSet"];

      if (kemetStickyHeader.enabledSections.length > 1) {
        top = kemetStickyHeader.offSetTop(section).top;
        staticOffSet = kemetStickyHeader.offSetTop(section).offSet;
      }

      if (window.scrollY > staticOffSet) {
        sectionContainer.style.top = top + "px";
        sectionWrap.style.minHeight = sectionDefaultHeight + "px";
        sectionContainer.classList.add("kmt-is-sticky");
      } else {
        sectionContainer.style.top = null;
        sectionWrap.style.minHeight = null;
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
        var mainBar = document.querySelector("." + section + "-header-bar");

        switch (section) {
          case "top":
            kemetStickyHeader.topOffSet =
              kemetStickyHeader.getOffset(mainBar).top;
            break;
          case "main":
            kemetStickyHeader.mainOffSet =
              kemetStickyHeader.getOffset(mainBar).top;
            break;
          case "bottom":
            kemetStickyHeader.bottomOffSet =
              kemetStickyHeader.getOffset(mainBar).top;
            break;
        }

        if ("on" === kemetStickyHeader.stickySections[section].enable) {
          kemetStickyHeader.enabledSections.push(section);
          kemetStickyHeader[section + "DefaultHeight"] = mainBar.offsetHeight;
        }
      });
    },
    setShrinkHeight: function () {
      var ShrinkHeight = kemet.shrinkHeight,
        mainInner = document.querySelector(
          ".site-main-header-wrap .kmt-grid-row"
        ),
        mainBar = document.querySelector(".main-header-bar"),
        mainWrap = document.querySelector(".kmt-main-header-wrap"),
        mainBarHeight = kemetStickyHeader.mainDefaultHeight;

      if (mainBar.classList.contains("kmt-is-sticky")) {
        mainInner.style.height = ShrinkHeight + "px";
        mainInner.style.minHeight = ShrinkHeight + "px";
        mainInner.style.maxHeight = ShrinkHeight + "px";
        mainWrap.style.minHeight = ShrinkHeight + "px";
      } else {
        mainInner.style.height = mainBarHeight + "px";
        mainInner.style.minHeight = mainBarHeight + "px";
        mainInner.style.maxHeight = mainBarHeight + "px";
        mainWrap.style.minHeight = mainBarHeight + "px";
      }
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
          var mainHeight =
            "on" == kemet.enableShrink
              ? parseInt(kemet.shrinkHeight)
              : document.querySelector(".kmt-main-header-wrap").offsetHeight;
          var topHeight = document.querySelector(
            ".kmt-top-header-wrap"
          ).offsetHeight;
          if (sections.includes("main") && !sections.includes("top")) {
            top = mainHeight;
            offSet = 0;
          }
          if (!sections.includes("main") && sections.includes("top")) {
            top = kemetStickyHeader.bottomOffSet - mainHeight;
            offSet = kemetStickyHeader.mainOffSet;
          }
          if (sections.includes("main") && sections.includes("top")) {
            top =
              "on" == kemet.enableShrink
                ? topHeight + mainHeight
                : kemetStickyHeader.bottomOffSet;
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

      if (kemet.stickyMain == "on" && kemet.enableShrink == "on") {
        kemetStickyHeader.setShrinkHeight();
      }
    },
  };
  if ("loading" === document.readyState) {
    // The DOM has not yet been loaded.
    document.addEventListener("DOMContentLoaded", kemetStickyHeader.init);
  } else {
    // The DOM has already been loaded.
    kemetStickyHeader.init();
  }
})(window, document);
