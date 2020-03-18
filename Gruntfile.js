module.exports = function (grunt) {
    'use strict';
    // Project configuration

    var pkgInfo = grunt.file.readJSON('package.json');
    const sass = require('node-sass');
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        rtlcss: {
            options: {
                // rtlcss options
                config: {
                    preserveComments: true,
                    greedy: true
                },
                // generate source maps
                map: false
            },
            dist: {
                files: [
                     {
                        expand: true,
                        cwd: 'addons/extra-headers/assets/css/unminified/',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/extra-headers/assets/css/unminified',
                        ext: '-rtl.css'

                    },
                    {
                        expand: true,
                        cwd: 'addons/extra-widgets/assets/css/unminified/',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/extra-widgets/assets/css/unminified',
                        ext: '-rtl.css'

                    },
                    {
                        expand: true,
                        cwd: 'addons/go-top/assets/css/unminified/',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/go-top/assets/css/unminified',
                        ext: '-rtl.css'

                    },
                    {
                        expand: true,
                        cwd: 'addons/page-title/assets/css/unminified/',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/page-title/assets/css/unminified',
                        ext: '-rtl.css'

                    },
                    {
                        expand: true,
                        cwd: 'addons/single-post/assets/css/unminified/',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/single-post/assets/css/unminified',
                        ext: '-rtl.css'

                    },
                    {
                        expand: true,
                        cwd: 'addons/sticky-header/assets/css/unminified/',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/sticky-header/assets/css/unminified',
                        ext: '-rtl.css'

                    },
                    {
                        expand: true,
                        cwd: 'addons/top-bar-section/assets/css/unminified/',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/top-bar-section/assets/css/unminified',
                        ext: '-rtl.css'

                    },
                ]
              }
        },
        sass: {
            options: {
                //implementation: sass,
                sourcemap: 'none',
                outputStyle: 'expanded',
                linefeed: 'lf',
                implementation: sass,
                sourceMap: false
            },
            dist: {
                files: [

                    // {
                    // 'style.css': 'sass/style.scss'
                    // },

                    /* Editor Style */
                    {
                        'addons/extra-headers/assets/css/unminified/extra-header-layouts.css': 'sass/extraheaders.scss',
                        'addons/extra-widgets/assets/css/unminified/style.css': 'sass/extra-widgets.scss',
                        'addons/top-bar-section/assets/css/unminified/style.css': 'sass/topbar.scss',
                        'addons/go-top/assets/css/unminified/style.css': 'sass/go-top.scss',
                        'addons/page-title/assets/css/unminified/style.css': 'sass/page-title.scss',
                        'addons/sticky-header/assets/css/unminified/style.css': 'sass/sticky-header.scss',
                        'addons/single-post/assets/css/unminified/style.css': 'sass/single-post.scss',
                        'addons/woocommerce/assets/css/unminified/style.css': 'sass/woocommerce.scss',
                    },

                    {

                        expand: true,
                        cwd: 'styles',
                        src: ['**.scss'],
                        dest: 'styles',
                        ext: '.css'
                    },
                ]
            }
        },
        cssmin: {
            css: {
                files: [
                    {
                        src: 'addons/extra-headers/assets/css/unminified/extra-header-layouts.css',
                        dest: 'addons/extra-headers/assets/css/minified/extra-header-layouts.min.css',
                    },
                    {
                        src: 'addons/extra-headers/assets/css/unminified/extra-header-layouts-rtl.css',
                        dest: 'addons/extra-headers/assets/css/minified/extra-header-layouts-rtl.min.css',
                    },

                    {
                        src: 'addons/extra-widgets/assets/css/unminified/style.css',
                        dest: 'addons/extra-widgets/assets/css/minified/style.min.css',
                    },
                    {
                        src: 'addons/extra-widgets/assets/css/unminified/style-rtl.css',
                        dest: 'addons/extra-widgets/assets/css/minified/style-rtl.min.css',
                    },

                    {
                        src: 'addons/top-bar-section/assets/css/unminified/style.css',
                        dest: 'addons/top-bar-section/assets/css/minified/style.min.css',
                    },
                    {
                        src: 'addons/top-bar-section/assets/css/unminified/style-rtl.css',
                        dest: 'addons/top-bar-section/assets/css/minified/style-rtl.min.css',
                    },

                    {
                        src: 'addons/page-title/assets/css/unminified/style.css',
                        dest: 'addons/page-title/assets/css/minified/style.min.css',
                    },
                    {
                        src: 'addons/page-title/assets/css/unminified/style-rtl.css',
                        dest: 'addons/page-title/assets/css/minified/style-rtl.min.css',
                    },

                    {
                        src: 'addons/go-top/assets/css/unminified/style.css',
                        dest: 'addons/go-top/assets/css/minified/style.min.css',
                    },
                    {
                        src: 'addons/go-top/assets/css/unminified/style-rtl.css',
                        dest: 'addons/go-top/assets/css/minified/style.min-rtl.css',
                    },
                    
                    {
                        src: 'addons/sticky-header/assets/css/unminified/style.css',
                        dest: 'addons/sticky-header/assets/css/minified/style.min.css',
                    },
                    {
                        src: 'addons/sticky-header/assets/css/unminified/style-rtl.css',
                        dest: 'addons/sticky-header/assets/css/minified/style-rtl.min.css',
                    },

                    {
                        src: 'addons/single-post/assets/css/unminified/style.css',
                        dest: 'addons/single-post/assets/css/minified/style.min.css',
                    },
                    {
                        src: 'addons/single-post/assets/css/unminified/style-rtl.css',
                        dest: 'addons/single-post/assets/css/minified/style-rtl.min.css',
                    },
                    {
                        src: 'addons/woocommerce/assets/css/unminified/style.css',
                        dest: 'addons/woocommerce/assets/css/minified/style.min.css',
                    },
                    {
                        src: 'addons/woocommerce/assets/css/unminified/style-rtl.css',
                        dest: 'addons/woocommerce/assets/css/minified/style-rtl.min.css',
                    },
                    {
                        src: 'inc/k-framework/assets/css/kfw.css',
                        dest: 'inc/k-framework/assets/css/kfw.min.css',
                    },
                ]
            }
        },
        uglify: {
            dist: {
                files: {
                    'addons/extra-headers/assets/js/minified/extra-header-layouts.min.js': 'addons/extra-headers/assets/js/unminified/extra-header-layouts.js',
                    'addons/extra-headers/assets/js/minified/customizer-preview.min.js': 'addons/extra-headers/assets/js/unminified/customizer-preview.js',
                    'addons/extra-widgets/assets/js/minified/customizer-preview.min.js': 'addons/extra-widgets/assets/js/unminified/customizer-preview.js',
                    'addons/top-bar-section/assets/js/minified/customizer-preview.min.js': 'addons/top-bar-section/assets/js/unminified/customizer-preview.js',
                    'addons/page-title/assets/js/minified/customizer-preview.min.js': 'addons/page-title/assets/js/unminified/customizer-preview.js',
                    'addons/go-top/assets/js/minified/customizer-preview.min.js': 'addons/go-top/assets/js/unminified/customizer-preview.js',
                    'addons/sticky-header/assets/js/minified/customizer-preview.min.js': 'addons/sticky-header/assets/js/unminified/customizer-preview.js',
                    'addons/single-post/assets/js/minified/customizer-preview.min.js': 'addons/single-post/assets/js/unminified/customizer-preview.js',
                    'addons/extra-widgets/assets/js/minified/mailchimp.min.js': 'addons/extra-widgets/assets/js/unminified/mailchimp.js',
                    'addons/woocommerce/assets/js/minified/customizer-preview.min.js': 'addons/woocommerce/assets/js/unminified/customizer-preview.js',
                    'addons/woocommerce/assets/js/minified/quick-view.min.js': 'addons/woocommerce/assets/js/unminified/quick-view.js',
                    'addons/woocommerce/assets/js/minified/single-product-ajax-cart.min.js': 'addons/woocommerce/assets/js/unminified/single-product-ajax-cart.js',
                    'addons/woocommerce/assets/js/minified/woocommerce.min.js': 'addons/woocommerce/assets/js/unminified/woocommerce.js',
                    'inc/k-framework/assets/js/kfw-plugins-field.min.js': 'inc/k-framework/assets/js/kfw-plugins-field.js',
                    'inc/k-framework/assets/js/kfw.min.js': 'inc/k-framework/assets/js/kfw.js',

                }
            }
        },
        makepot: {
            target: {
                options: {
                    domainPath: '/',
                    potFilename: 'languages/kemet-addons.pot',
                    potHeaders: {
                        poedit: true,
                        'x-poedit-keywordslist': true
                    },
                    type: 'wp-theme',
                    updateTimestamp: true
                }
            }
        },
        rtlcss: {
            options: {
                // rtlcss options
                config: {
                    preserveComments: true,
                    greedy: true
                },
                // generate source maps
                map: false
            },
            dist: {
                files: [
                    {
                        expand: true,
                        cwd: 'addons/extra-headers/assets/css/unminified',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/extra-headers/assets/css/unminified',
                        ext: '-rtl.css'
                    },
                    {
                        expand: true,
                        cwd: 'addons/extra-widgets/assets/css/unminified',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/extra-widgets/assets/css/unminified',
                        ext: '-rtl.css'
                    },
                    {
                        expand: true,
                        cwd: 'addons/top-bar-section/assets/css/unminified',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/top-bar-section/assets/css/unminified',
                        ext: '-rtl.css'
                    },
                    {
                        expand: true,
                        cwd: 'addons/page-title/assets/css/unminified',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/page-title/assets/css/unminified',
                        ext: '-rtl.css'
                    },
                    {
                        expand: true,
                        cwd: 'addons/go-top/assets/css/unminified',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/go-top/assets/css/unminified',
                        ext: '-rtl.css'
                    },
                    {
                        expand: true,
                        cwd: 'addons/sticky-header/assets/css/unminified',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/sticky-header/assets/css/unminified',
                        ext: '-rtl.css'
                    },
                    {
                        expand: true,
                        cwd: 'addons/single-post/assets/css/unminified',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/single-post/assets/css/unminified',
                        ext: '-rtl.css'
                    },
                    {
                        expand: true,
                        cwd: 'addons/woocommerce/assets/css/unminified',
                        src: [
                                '*.css',
                                '!*-rtl.css',
                            ],
                        dest: 'addons/woocommerce/assets/css/unminified',
                        ext: '-rtl.css'
                    },
                ]
              }
        },
    });

    // Load grunt tasks
    grunt.loadNpmTasks('grunt-rtlcss');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    // grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-wp-i18n');

    // SASS compile
    grunt.registerTask('default', ['sass', 'cssmin:css']);
    //grunt.registerTask('minify', ['cssmin']); 
    grunt.registerTask('default', ['uglify']);
    // min all
    grunt.registerTask('minify', ['cssmin:css']);
    
    // rtlcss, you will still need to install ruby and sass on your system manually to run this
    grunt.registerTask('rtl', ['rtlcss']);

};

