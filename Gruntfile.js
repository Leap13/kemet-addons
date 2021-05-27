module.exports = function (grunt) {
  "use strict";
  // Project configuration
  var autoprefixer = require("autoprefixer");
  var flexibility = require("postcss-flexibility");

  var pkgInfo = grunt.file.readJSON("package.json");
  const sass = require("node-sass");
  grunt.initConfig({
    pkg: grunt.file.readJSON("package.json"),

    rtlcss: {
      options: {
        // rtlcss options
        config: {
          preserveComments: true,
          greedy: true,
        },
        // generate source maps
        map: false,
      },
      dist: {
        files: [
          {
            expand: true,
            cwd: "addons/blog-layouts/assets/css/unminified/",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/blog-layouts/assets/css/unminified/",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/extra-headers/assets/css/unminified/",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/extra-headers/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/extra-widgets/assets/css/unminified/",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/extra-widgets/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/go-top/assets/css/unminified/",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/go-top/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/page-title/assets/css/unminified/",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/page-title/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/single-post/assets/css/unminified/",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/single-post/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/sticky-header/assets/css/unminified/",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/sticky-header/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/top-bar-section/assets/css/unminified/",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/top-bar-section/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/top-bar-section/assets/css/unminified/",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/top-bar-section/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/mega-menu/assets/css/unminified/",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/mega-menu/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "inc/kemet-panel/assets/css/unminified",
            src: ["*.css", "!*-rtl.css"],
            dest: "inc/kemet-panel/assets/css/unminified",
            ext: "-rtl.css",
          },
        ],
      },
    },
    sass: {
      options: {
        //implementation: sass,
        sourcemap: "none",
        outputStyle: "expanded",
        linefeed: "lf",
        implementation: sass,
        sourceMap: false,
      },
      dist: {
        files: [
          // {
          // 'style.css': 'sass/style.scss'
          // },

          /* Editor Style */
          {
            "addons/blog-layouts/assets/css/unminified/blog-layouts.css":
              "sass/blog-layouts.scss",
            "addons/extra-headers/assets/css/unminified/extra-header-layouts.css":
              "sass/extraheaders.scss",
            "addons/extra-widgets/assets/css/unminified/style.css":
              "sass/extra-widgets.scss",
            "addons/top-bar-section/assets/css/unminified/style.css":
              "sass/topbar.scss",
            "addons/go-top/assets/css/unminified/style.css": "sass/go-top.scss",
            "addons/page-title/assets/css/unminified/style.css":
              "sass/page-title.scss",
            "addons/sticky-header/assets/css/unminified/style.css":
              "sass/sticky-header.scss",
            "addons/single-post/assets/css/unminified/style.css":
              "sass/single-post.scss",
            "addons/woocommerce/assets/css/unminified/style.css":
              "sass/woocommerce.scss",
            "addons/custom-layout/assets/css/unminified/style.css":
              "sass/custom-layout.scss",
            "addons/mega-menu/assets/css/unminified/style.css":
              "sass/mega-menu.scss",
            "inc/kemet-panel/assets/css/unminified/kemet-panel.css":
              "sass/kemet-panel.scss",
          },

          {
            expand: true,
            cwd: "styles",
            src: ["**.scss"],
            dest: "styles",
            ext: ".css",
          },
        ],
      },
    },
    cssmin: {
      css: {
        files: [
          {
            src: "addons/blog-layouts/assets/css/unminified/blog-layouts.css",
            dest:
              "addons/blog-layouts/assets/css/minified/blog-layouts.min.css",
          },
          {
            src:
              "addons/blog-layouts/assets/css/unminified/blog-layouts-rtl.css",
            dest:
              "addons/blog-layouts/assets/css/minified/blog-layouts-rtl.min.css",
          },
          {
            src:
              "addons/extra-headers/assets/css/unminified/extra-header-layouts.css",
            dest:
              "addons/extra-headers/assets/css/minified/extra-header-layouts.min.css",
          },
          {
            src:
              "addons/extra-headers/assets/css/unminified/extra-header-layouts-rtl.css",
            dest:
              "addons/extra-headers/assets/css/minified/extra-header-layouts-rtl.min.css",
          },

          {
            src: "addons/extra-widgets/assets/css/unminified/style.css",
            dest: "addons/extra-widgets/assets/css/minified/style.min.css",
          },
          {
            src: "addons/extra-widgets/assets/css/unminified/style-rtl.css",
            dest: "addons/extra-widgets/assets/css/minified/style-rtl.min.css",
          },

          {
            src: "addons/top-bar-section/assets/css/unminified/style.css",
            dest: "addons/top-bar-section/assets/css/minified/style.min.css",
          },
          {
            src: "addons/top-bar-section/assets/css/unminified/style-rtl.css",
            dest:
              "addons/top-bar-section/assets/css/minified/style-rtl.min.css",
          },

          {
            src: "addons/page-title/assets/css/unminified/style.css",
            dest: "addons/page-title/assets/css/minified/style.min.css",
          },
          {
            src: "addons/page-title/assets/css/unminified/style-rtl.css",
            dest: "addons/page-title/assets/css/minified/style-rtl.min.css",
          },

          {
            src: "addons/go-top/assets/css/unminified/style.css",
            dest: "addons/go-top/assets/css/minified/style.min.css",
          },
          {
            src: "addons/go-top/assets/css/unminified/style-rtl.css",
            dest: "addons/go-top/assets/css/minified/style.min-rtl.css",
          },

          {
            src: "addons/sticky-header/assets/css/unminified/style.css",
            dest: "addons/sticky-header/assets/css/minified/style.min.css",
          },
          {
            src: "addons/sticky-header/assets/css/unminified/style-rtl.css",
            dest: "addons/sticky-header/assets/css/minified/style-rtl.min.css",
          },

          {
            src: "addons/single-post/assets/css/unminified/style.css",
            dest: "addons/single-post/assets/css/minified/style.min.css",
          },
          {
            src: "addons/single-post/assets/css/unminified/style-rtl.css",
            dest: "addons/single-post/assets/css/minified/style-rtl.min.css",
          },
          {
            src: "addons/woocommerce/assets/css/unminified/style.css",
            dest: "addons/woocommerce/assets/css/minified/style.min.css",
          },
          {
            src: "addons/woocommerce/assets/css/unminified/style-rtl.css",
            dest: "addons/woocommerce/assets/css/minified/style-rtl.min.css",
          },
          {
            src: "inc/k-framework/assets/css/kfw.css",
            dest: "inc/k-framework/assets/css/kfw.min.css",
          },
          {
            src: "inc/k-framework/assets/css/kfw-rtl.css",
            dest: "inc/k-framework/assets/css/kfw-rtl.min.css",
          },
          {
            src: "addons/custom-layout/assets/css/unminified/style.css",
            dest: "addons/custom-layout/assets/css/minified/style.min.css",
          },
          {
            src: "addons/mega-menu/assets/css/unminified/mega-menu.css",
            dest: "addons/mega-menu/assets/css/minified/mega-menu.min.css",
          },
          {
            src: "addons/mega-menu/assets/css/unminified/mega-menu-rtl.css",
            dest: "addons/mega-menu/assets/css/minified/mega-menu-rtl.min.css",
          },
          {
            src: "addons/mega-menu/assets/css/unminified/style.css",
            dest: "addons/mega-menu/assets/css/minified/style.min.css",
          },
          {
            src: "addons/mega-menu/assets/css/unminified/style-rtl.css",
            dest: "addons/mega-menu/assets/css/minified/style-rtl.min.css",
          },
          {
            src: "inc/kemet-panel/assets/css/unminified/kemet-panel.css",
            dest: "inc/kemet-panel/assets/css/minified/kemet-panel.min.css",
          },
          {
            src: "inc/kemet-panel/assets/css/unminified/kemet-panel-rtl.css",
            dest: "inc/kemet-panel/assets/css/minified/kemet-panel-rtl.min.css",
          },
        ],
      },
    },
    uglify: {
      dist: {
        files: {
          "addons/blog-layouts/assets/js/minified/blog-layouts.min.js":
            "addons/blog-layouts/assets/js/unminified/blog-layouts.js",
          "addons/blog-layouts/assets/js/minified/customizer-preview.min.js":
            "addons/blog-layouts/assets/js/unminified/customizer-preview.js",
          "addons/extra-headers/assets/js/minified/extra-header-layouts.min.js":
            "addons/extra-headers/assets/js/unminified/extra-header-layouts.js",
          "addons/extra-headers/assets/js/minified/customizer-preview.min.js":
            "addons/extra-headers/assets/js/unminified/customizer-preview.js",
          "addons/extra-widgets/assets/js/minified/customizer-preview.min.js":
            "addons/extra-widgets/assets/js/unminified/customizer-preview.js",
          "addons/top-bar-section/assets/js/minified/customizer-preview.min.js":
            "addons/top-bar-section/assets/js/unminified/customizer-preview.js",
          "addons/page-title/assets/js/minified/customizer-preview.min.js":
            "addons/page-title/assets/js/unminified/customizer-preview.js",
          "addons/go-top/assets/js/minified/customizer-preview.min.js":
            "addons/go-top/assets/js/unminified/customizer-preview.js",
          "addons/sticky-header/assets/js/minified/customizer-preview.min.js":
            "addons/sticky-header/assets/js/unminified/customizer-preview.js",
          "addons/sticky-header/assets/js/minified/sticky-header.min.js":
            "addons/sticky-header/assets/js/unminified/sticky-header.js",
          "addons/single-post/assets/js/minified/customizer-preview.min.js":
            "addons/single-post/assets/js/unminified/customizer-preview.js",
          "addons/extra-widgets/assets/js/minified/extre-widgets.min.js":
            "addons/extra-widgets/assets/js/unminified/extre-widgets.js",
          "addons/extra-widgets/assets/js/minified/extra-widgets-admin.min.js":
            "addons/extra-widgets/assets/js/unminified/extra-widgets-admin.js",
          "addons/woocommerce/assets/js/minified/customizer-preview.min.js":
            "addons/woocommerce/assets/js/unminified/customizer-preview.js",
          "addons/woocommerce/assets/js/minified/quick-view.min.js":
            "addons/woocommerce/assets/js/unminified/quick-view.js",
          "addons/woocommerce/assets/js/minified/single-product-ajax-cart.min.js":
            "addons/woocommerce/assets/js/unminified/single-product-ajax-cart.js",
          "addons/woocommerce/assets/js/minified/woocommerce.min.js":
            "addons/woocommerce/assets/js/unminified/woocommerce.js",
          "addons/custom-layout/assets/js/minified/custom-layout.min.js":
            "addons/custom-layout/assets/js/unminified/custom-layout.js",
          "addons/mega-menu/assets/js/minified/mega-menu.min.js":
            "addons/mega-menu/assets/js/unminified/mega-menu.js",
          "addons/mega-menu/assets/js/minified/mega-menu-backend.min.js":
            "addons/mega-menu/assets/js/unminified/mega-menu-backend.js",
          "inc/k-framework/assets/js/kfw.min.js":
            "inc/k-framework/assets/js/kfw.js",
          "inc/kemet-panel/assets/js/minified/kemet-panel.min.js":
            "inc/kemet-panel/assets/js/unminified/kemet-panel.js",
        },
      },
    },
    makepot: {
      target: {
        options: {
          domainPath: "/",
          potFilename: "languages/kemet-addons.pot",
          potHeaders: {
            poedit: true,
            "x-poedit-keywordslist": true,
          },
          type: "wp-plugin",
          updateTimestamp: true,
        },
      },
    },
    rtlcss: {
      options: {
        // rtlcss options
        config: {
          preserveComments: true,
          greedy: true,
        },
        // generate source maps
        map: false,
      },
      dist: {
        files: [
          // {
          //   expand: true,
          //   cwd: "addons/extra-headers/assets/css/unminified",
          //   src: ["*.css", "!*-rtl.css"],
          //   dest: "addons/extra-headers/assets/css/unminified",
          //   ext: "-rtl.css",
          // },
          {
            expand: true,
            cwd: "addons/extra-widgets/assets/css/unminified",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/extra-widgets/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/top-bar-section/assets/css/unminified",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/top-bar-section/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/page-title/assets/css/unminified",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/page-title/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/go-top/assets/css/unminified",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/go-top/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/sticky-header/assets/css/unminified",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/sticky-header/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/single-post/assets/css/unminified",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/single-post/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/woocommerce/assets/css/unminified",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/woocommerce/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "addons/mega-menu/assets/css/unminified",
            src: ["*.css", "!*-rtl.css"],
            dest: "addons/mega-menu/assets/css/unminified",
            ext: "-rtl.css",
          },
          {
            expand: true,
            cwd: "inc/kemet-panel/assets/css/unminified",
            src: ["*.css", "!*-rtl.css"],
            dest: "inc/kemet-panel/assets/css/unminified",
            ext: "-rtl.css",
          },
        ],
      },
    },
    copy: {
      main: {
        options: {
          mode: true,
        },
        src: [
          "**",
          "!node_modules/**",
          "!nbproject/**",
          "!.git/**",
          "!*.ds_store",
          "!Gruntfile.js",
          "!package.json",
          "!.gitignore",
          "!sass/**",
          "!composer.json",
          "!composer.lock",
          "!package-lock.json",
          "!phpcs.xml.dist",
          "!phpcs.xml",
        ],
        dest: "kemet-addons/",
      },
    },

    compress: {
      main: {
        options: {
          archive: "kemet-addons-" + pkgInfo.version + ".zip",
          mode: "zip",
        },
        files: [
          {
            src: ["./kemet-addons/**"],
          },
        ],
      },
    },

    clean: {
      main: ["kemet-addons"],
      zip: ["*.zip"],
    },

    makepot: {
      target: {
        options: {
          domainPath: "/",
          potFilename: "languages/kemet-addons.pot",
          potHeaders: {
            poedit: true,
            "x-poedit-keywordslist": true,
          },
          type: "wp-plugin",
          updateTimestamp: true,
        },
      },
    },

    addtextdomain: {
      options: {
        textdomain: "kemet-addons",
      },
      target: {
        files: {
          src: [
            "*.php", 
            "**/*.php", 
            "!node_modules/**",
            "!inc/k-framework/**"],
        },
      },
    },

    bumpup: {
      options: {
        updateProps: {
          pkg: "package.json",
        },
      },
      file: "package.json",
    },

    replace: {
      plugin_readme: {
        src: ['readme.txt'],
        overwrite: true,
        replacements: [
          {
            from: /Stable tag: \bv?(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)(?:-[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?(?:\+[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?\b/g,
            to: "Stable tag: <%= pkg.version %>",
          },
        ],
      },

      plugin_main: {
        src: ['kemet-addons.php'],
        overwrite: true,
        replacements: [
          {
            from: /Version: \bv?(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)(?:-[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?(?:\+[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?\b/g,
            to: "Version: <%= pkg.version %>",
          },
        ],
      },

      plugin_const: {
        src: ["kemet-addons.php"],
        overwrite: true,
        replacements: [
          {
            from: /KEMET_ADDONS_VERSION', '.*?'/g,
            to: "KEMET_ADDONS_VERSION', '<%= pkg.version %>'",
          },
        ],
      },
    },
  });

  // Load grunt tasks
  grunt.loadNpmTasks("grunt-rtlcss");
  grunt.loadNpmTasks("grunt-sass");
  grunt.loadNpmTasks("grunt-contrib-cssmin");
  grunt.loadNpmTasks("grunt-contrib-uglify");
  // grunt.loadNpmTasks('grunt-contrib-cssmin');

  grunt.loadNpmTasks("grunt-wp-i18n");
  grunt.loadNpmTasks("grunt-bumpup");
  grunt.loadNpmTasks("grunt-text-replace");
  grunt.loadNpmTasks("grunt-contrib-concat");
  grunt.loadNpmTasks("grunt-contrib-copy");
  grunt.loadNpmTasks("grunt-contrib-compress");
  grunt.loadNpmTasks("grunt-contrib-clean");

  // SASS compile
  grunt.registerTask("default", ["sass", "cssmin:css"]);
  //grunt.registerTask('minify', ['cssmin']);
  grunt.registerTask("default", ["uglify"]);
  // min all
  grunt.registerTask("minify", ["cssmin:css"]);

  // rtlcss, you will still need to install ruby and sass on your system manually to run this
  grunt.registerTask("rtl", ["rtlcss"]);

  grunt.registerTask("style", ["sass", "rtl", "minify"]);
  // Grunt release - Create installable package of the local files
  grunt.registerTask("release", [
    "clean:zip",
    "copy:main",
    "compress:main",
    "clean:main",
  ]);
  // Bump Version - `grunt version-bump --ver=<version-number>`
  grunt.registerTask("version-bump", function (ver) {
    var newVersion = grunt.option("ver");

    if (newVersion) {
      newVersion = newVersion ? newVersion : "patch";

      grunt.task.run("bumpup:" + newVersion);
      grunt.task.run("replace");
    }
  });
  // i18n
  //grunt.registerTask("i18n", ["addtextdomain", "makepot"]);

};