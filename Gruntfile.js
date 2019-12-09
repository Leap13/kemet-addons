module.exports = function (grunt) {
    'use strict';
    // Project configuration

    var pkgInfo = grunt.file.readJSON('package.json');
    const sass = require('node-sass');
    grunt.initConfig({
            pkg: grunt.file.readJSON('package.json'),

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
                            'addons/top-bar-section/assets/css/unminified/style.css': 'sass/topbar.scss',
                            'addons/go-top/assets/css/unminified/style.css': 'sass/go-top.scss',
                            'addons/page-title/assets/css/unminified/style.css': 'sass/page-title.scss',
                            'addons/sticky-header/assets/css/unminified/style.css': 'sass/sticky-header.scss',
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
                        src: 'addons/top-bar-section/assets/css/unminified/style.css',
                        dest: 'addons/top-bar-section/assets/css/minified/style.min.css',
                    },
                    {
                        src: 'addons/page-title/assets/css/unminified/style.css',
                        dest: 'addons/page-title/assets/css/minified/style.min.css',
                    },
                    {
                        src: 'addons/go-top/assets/css/unminified/style.css',
                        dest: 'addons/go-top/assets/css/minified/style.min.css',
                    },
                    {
                       src: 'addons/sticky-header/assets/css/unminified/style.css',
                       dest: 'addons/sticky-header/assets/css/minified/style.min.css',
                    },
                ]
             } 
        },
        uglify: {
            dist: {
                files: {
                    'addons/extra-headers/assets/js/minified/extra-header-layouts.min.js': 'addons/extra-headers/assets/js/unminified/extra-header-layouts.js',
                    'addons/top-bar-section/assets/js/minified/customizer-preview.min.js': 'addons/top-bar-section/assets/js/unminified/customizer-preview.js',
                    'addons/page-title/assets/js/minified/customizer-preview.min.js': 'addons/page-title/assets/js/unminified/customizer-preview.js',
                    'addons/go-top/assets/js/minified/customizer-preview.min.js': 'addons/go-top/assets/js/unminified/customizer-preview.js',
                    'addons/sticky-header/assets/js/minified/customizer-preview.min.js': 'addons/sticky-header/assets/js/unminified/customizer-preview.js',
                    'addons/sticky-header/assets/js/minified/sticky-header.min.js': 'addons/sticky-header/assets/js/unminified/sticky-header.js',
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
    });

    // Load grunt tasks
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


};

