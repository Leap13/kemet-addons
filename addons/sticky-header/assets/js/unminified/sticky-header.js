(function () {
  var kemetStickyHeader = {
    topOffSet: 0,
    mainOffSet: 0,
    bottomOffSet: 0,
    activeHeader: "desktop",
    stickySections: {
      top: {
        enable: kemet.stickyTop,
        mobileEnable: kemet.stickyMobileTop,
      },
      main: {
        enable: kemet.stickyMain,
        mobileEnable: kemet.stickyMobileMain,
      },
      bottom: {
        enable: kemet.stickyBottom,
        mobileEnable: kemet.stickyMobileBottom,
      },
    },
    isMobile: false,
    activeShrink: kemet.enableShrink,
    activeMain: kemet.stickyMain,
    hasAdminBar: false,
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
      window.addEventListener("load", kemetStickyHeader.setShrinkHeight, false);
      window.addEventListener("load", kemetStickyHeader.setHeight, false);
      window.addEventListener("resize", kemetStickyHeader.setHeight, false);
      kemetStickyHeader.setHeight();
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
      if (kemetStickyHeader.hasAdminBar) {
        top = 32;
        staticOffSet = staticOffSet - 32;
      }

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
      var header = document.querySelector(
        "#kmt-" + kemetStickyHeader.activeHeader + "-header"
      );
      kemetStickyHeader.enabledSections = [];
      Object.keys(kemetStickyHeader.stickySections).map(function (
        section,
        index
      ) {
        var sectionBar = header.querySelector("." + section + "-header-bar"),
          sectionWrap = header.querySelector(
            ".kmt-" + section + "-header-wrap"
          );
        sectionBar.setAttribute(
          "data-offset",
          kemetStickyHeader.getOffset(sectionWrap).top
        );
        sectionBar.setAttribute("data-height", sectionBar.offsetHeight);
        var enable = kemetStickyHeader.isMobile
          ? kemetStickyHeader.stickySections[section].mobileEnable
          : kemetStickyHeader.stickySections[section].enable;
        if ("on" === enable) {
          kemetStickyHeader.enabledSections.push(section);
        }
      });

      if (
        kemetStickyHeader.activeMain == "on" &&
        kemetStickyHeader.activeShrink == "on"
      ) {
        var mainBar = header.querySelector(".main-header-bar"),
          mainInner = header.querySelector(".main-header-bar .kmt-grid-row");

        mainBar.setAttribute("data-start-height", mainInner.offsetHeight);
      }
    },
    setShrinkHeight: function () {
      if (
        kemetStickyHeader.activeMain == "on" &&
        kemetStickyHeader.activeShrink == "on"
      ) {
        var header = document.querySelector(
            "#kmt-" + kemetStickyHeader.activeHeader + "-header"
          ),
          shrinkHeight = kemetStickyHeader.isMobile
            ? kemet.shrinkMobileHeight
            : kemet.shrinkHeight,
          mainInner = header.querySelector(
            ".site-main-header-wrap .kmt-grid-row"
          ),
          mainBar = header.querySelector(".main-header-bar"),
          mainWrap = header.querySelector(".kmt-main-header-wrap"),
          startHeight = mainBar.getAttribute("data-start-height");

        if (mainBar.classList.contains("kmt-is-sticky")) {
          mainInner.style.height = shrinkHeight + "px";
          mainInner.style.minHeight = shrinkHeight + "px";
          mainInner.style.maxHeight = shrinkHeight + "px";
        } else {
          mainInner.style.height = startHeight + "px";
          mainInner.style.minHeight = startHeight + "px";
          mainInner.style.maxHeight = startHeight + "px";
          mainWrap.style.height = mainBar.getAttribute("data-height") + "px";
        }
      }
    },
    offSetTop: function (section) {
      var header = document.querySelector(
          "#kmt-" + kemetStickyHeader.activeHeader + "-header"
        ),
        topOffSet = parseInt(
          header.querySelector(".top-header-bar").getAttribute("data-offset")
        ),
        mainBar = header.querySelector(".main-header-bar"),
        mainOffSet = parseInt(mainBar.getAttribute("data-offset")),
        bottomOffSet = parseInt(
          header.querySelector(".bottom-header-bar").getAttribute("data-offset")
        ),
        offSet = 0,
        top = 0,
        shrinkHeight = kemetStickyHeader.isMobile
          ? kemet.shrinkMobileHeight
          : kemet.shrinkHeight,
        sections = kemetStickyHeader.enabledSections;
      var mainHeight =
        "on" == kemetStickyHeader.activeShrink
          ? parseInt(shrinkHeight)
          : parseInt(
              header
                .querySelector(".main-header-bar")
                .getAttribute("data-height")
            );
      var topHeight = parseInt(
        header.querySelector(".top-header-bar").getAttribute("data-height")
      );
      if (kemetStickyHeader.hasAdminBar) {
        topHeight = topHeight + 32;
        if ("top" == section) {
          top = 32;
          offSet = topOffSet - 32;
        }
      }
      switch (section) {
        case "main":
          top = kemetStickyHeader.hasAdminBar ? 32 : 0;
          offSet = mainOffSet;
          if (sections.includes("top")) {
            top = topHeight;
            offSet = topOffSet;
          }

          break;
        case "bottom":
          offSet = bottomOffSet;
          var startHeight = parseInt(mainBar.getAttribute("data-start-height"));
          shrinkHeight = Math.abs(startHeight - shrinkHeight);
          shrinkHeight =
            startHeight > shrinkHeight
              ? parseInt(mainBar.getAttribute("data-height")) - shrinkHeight
              : parseInt(mainBar.getAttribute("data-height")) + shrinkHeight;
          if (sections.includes("main") && !sections.includes("top")) {
            top = kemetStickyHeader.hasAdminBar ? mainHeight + 32 : mainHeight;
            offSet = mainOffSet;
          }
          if (!sections.includes("main") && sections.includes("top")) {
            top = topHeight;
            topHeight = kemetStickyHeader.hasAdminBar
              ? topHeight + 32
              : topHeight;
            offSet = bottomOffSet - topHeight;
          }
          if (sections.includes("main") && sections.includes("top")) {
            top = mainHeight + topHeight;
            offSet = kemetStickyHeader.hasAdminBar ? topOffSet - 32 : topOffSet;
          }
          break;
      }
      offSet = kemetStickyHeader.hasAdminBar ? offSet - 32 : offSet;
      return { offSet: offSet, top: top };
    },
    sticky: function () {
      if (kemet.break_point <= window.innerWidth) {
        kemetStickyHeader.activeHeader = "desktop";
        kemetStickyHeader.isMobile = false;
      } else {
        kemetStickyHeader.activeHeader = "mobile";
        kemetStickyHeader.isMobile = true;
      }
      kemetStickyHeader.activeMain = kemetStickyHeader.isMobile
        ? kemet.stickyMobileMain
        : kemet.stickyMain;
      kemetStickyHeader.activeShrink = kemetStickyHeader.isMobile
        ? kemet.enableMobileShrink
        : kemet.enableShrink;
      kemetStickyHeader.hasAdminBar =
        document.body.classList.contains("admin-bar") &&
        "desktop" == kemetStickyHeader.activeHeader;
      Object.keys(kemetStickyHeader.stickySections).map(function (
        section,
        index
      ) {
        var enable = kemetStickyHeader.isMobile
          ? kemetStickyHeader.stickySections[section].mobileEnable
          : kemetStickyHeader.stickySections[section].enable;
        if ("on" === enable) {
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

  document.addEventListener(
    "kmtPartialContentRendered",
    kemetStickyHeader.init
  );
})(window, document);
