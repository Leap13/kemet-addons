(function () {
  var kemetStickyHeader = {
    topOffSet: 0,
    mainOffSet: 0,
    bottomOffSet: 0,
    activeHeader: "desktop",
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
      window.addEventListener(
        "scroll",
        kemetStickyHeader.setShrinkHeight,
        false
      );
      window.addEventListener("load", kemetStickyHeader.sticky, false);
      window.addEventListener("load", kemetStickyHeader.setHeight, false);
      window.addEventListener("load", kemetStickyHeader.setShrinkHeight, false);
      window.addEventListener("resize", kemetStickyHeader.setHeight, false);
      if (kemet.stickyMain == "on" && kemet.enableShrink == "on") {
        window.addEventListener(
          "scroll",
          kemetStickyHeader.setShrinkHeight,
          false
        );
      }
    },
    stickySection: function (section) {
      var header = document.querySelector(
          "#kmt-" + kemetStickyHeader.activeHeader + "-header"
        ),
        sectionContainer = header.querySelector("." + section + "-header-bar"),
        sectionWrap = header.querySelector(".kmt-" + section + "-header-wrap"),
        top = 0,
        sectionDefaultHeight = sectionContainer.getAttribute("data-height"),
        staticOffSet = sectionContainer.getAttribute("data-offset");

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
        var sectionBar = document.querySelectorAll(
            "." + section + "-header-bar"
          ),
          sectionWrap = document.querySelectorAll(
            ".kmt-" + section + "-header-wrap"
          );
        for (var i = 0; i < sectionBar.length; i++) {
          sectionBar[i].setAttribute(
            "data-offset",
            kemetStickyHeader.getOffset(sectionWrap[i]).top
          );
          sectionBar[i].setAttribute("data-height", sectionBar[i].offsetHeight);
        }

        if ("on" === kemetStickyHeader.stickySections[section].enable) {
          kemetStickyHeader.enabledSections.push(section);
        }
      });
    },
    setShrinkHeight: function () {
      var header = document.querySelector(
          "#kmt-" + kemetStickyHeader.activeHeader + "-header"
        ),
        ShrinkHeight = kemet.shrinkHeight,
        mainInner = header.querySelector(
          ".site-main-header-wrap .kmt-grid-row"
        ),
        mainBar = header.querySelector(".main-header-bar"),
        mainWrap = header.querySelector(".kmt-main-header-wrap"),
        mainBarHeight = mainBar.getAttribute("data-height");

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
      var header = document.querySelector(
          "#kmt-" + kemetStickyHeader.activeHeader + "-header"
        ),
        topOffSet = header
          .querySelector(".top-header-bar")
          .getAttribute("data-offset"),
        mainOffSet = header
          .querySelector(".main-header-bar")
          .getAttribute("data-offset"),
        bottomOffSet = header
          .querySelector(".bottom-header-bar")
          .getAttribute("data-offset"),
        offSet = 0,
        top = 0,
        sections = kemetStickyHeader.enabledSections;

      switch (section) {
        case "main":
          offSet = mainOffSet;
          if (sections.includes("top")) {
            top = mainOffSet;
            offSet = topOffSet;
          }
          break;
        case "bottom":
          offSet = bottomOffSet;
          var mainHeight =
            "on" == kemet.enableShrink
              ? parseInt(kemet.shrinkHeight)
              : header.querySelector(".kmt-main-header-wrap").offsetHeight;
          var topHeight = header.querySelector(
            ".kmt-top-header-wrap"
          ).offsetHeight;
          if (sections.includes("main") && !sections.includes("top")) {
            top = mainHeight;
            offSet = mainOffSet;
          }
          if (!sections.includes("main") && sections.includes("top")) {
            top = topHeight;
            offSet = bottomOffSet - topHeight;
          }
          if (sections.includes("main") && sections.includes("top")) {
            top =
              "on" == kemet.enableShrink
                ? topHeight + mainHeight
                : bottomOffSet;
            offSet = topOffSet;
          }
          break;
      }

      return { offSet: offSet, top: top };
    },
    sticky: function () {
      if (kemet.break_point <= window.innerWidth) {
        kemetStickyHeader.activeHeader = "desktop";
      } else {
        kemetStickyHeader.activeHeader = "mobile";
      }
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
  if ("loading" === document.readyState) {
    // The DOM has not yet been loaded.
    document.addEventListener("DOMContentLoaded", kemetStickyHeader.init);
  } else {
    // The DOM has already been loaded.
    kemetStickyHeader.init();
  }
})(window, document);
