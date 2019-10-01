module.exports = function (grunt) {
    'use strict';
    // Project configuration

    var pkgInfo = grunt.file.readJSON('package.json');

    grunt.initConfig({
            pkg: grunt.file.readJSON('package.json'),

            sass: {
                options: {
                    //implementation: sass,
                    sourcemap: 'none',
                    outputStyle: 'expanded',
                    linefeed: 'lf',
                },
                dist: {
                    files: [

                        // {
                        // 'style.css': 'sass/style.scss'
                        // },

                        /* Editor Style */
                        {
                            'addons/extra-headers/assets/css/unminified/extra-header-layouts.css': 'sass/extraheaders.scss',

                        },

                        // {
                        //     expand: true,
                        //     cwd: 'styles',
                        //     src: ['**.scss'],
                        //     dest: 'styles',
                        //     ext: '.css'
                        // },
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
                ]
             }, 
        },
    });

    // Load grunt tasks
    grunt.loadNpmTasks('grunt-sass');
   // grunt.loadNpmTasks('grunt-contrib-cssmin');

    // SASS compile
    grunt.registerTask('default', ['sass']);
    grunt.registerTask('minify', ['cssmin']); 


};

