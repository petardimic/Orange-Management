/* global module */
module.exports = function (grunt) {
    "use strict";

    grunt.loadNpmTasks("grunt-contrib-uglify");
    grunt.loadNpmTasks("grunt-contrib-cssmin");
    grunt.loadNpmTasks("grunt-contrib-concat");
    grunt.loadNpmTasks("grunt-contrib-imagemin");
    grunt.loadNpmTasks("grunt-contrib-htmlmin");
    grunt.loadNpmTasks("grunt-contrib-sass");
    grunt.loadNpmTasks("grunt-contrib-compass");
    grunt.loadNpmTasks("grunt-contrib-clean");
    grunt.loadNpmTasks("grunt-contrib-jshint");
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks("grunt-contrib-compress");
    grunt.loadNpmTasks('grunt-newer');

    //noinspection JSUnresolvedFunction
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        banner: '/* <%= pkg.name %>\n' +
            'Version: <%= pkg.version %>\n */',
        uglify: {
            options: {
                banner: '<%= banner %>'
            },
            dist: {
                files: {
                    'Internal/js/oms.min.js': [
                        'core/Core.js',
                        'Internal/js/ui/*.js'
                    ],
                    'Internal/js/backend.min.js': [],
                    'Internal/js/website.min.js': [],
                    'Internal/js/shop.min.js': []
                }
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: [
                    {
                        expand: true,
                        cwd: 'Content/themes/oms-slim/scss',
                        src: ['*.scss'],
                        dest: 'Content/themes/oms-slim/css',
                        ext: '.css'
                    }
                ]
            }
        },
        compress: {
            dist: {
                options: {
                    mode: 'gzip'
                },
                files: [
                    {
                        expand: true,
                        src: ['Internal/js/*.js'],
                        dest: '',
                        ext: '.min.js.gz'
                    },
                    {
                        expand: true,
                        src: ['External/jquery/*.js'],
                        dest: '',
                        ext: '.min.js.gz'
                    },
                    {
                        expand: true,
                        src: ['Content/themes/oms-slim/js/*.js'],
                        dest: '',
                        ext: '.js.gz'
                    },
                    {
                        expand: true,
                        src: ['Content/themes/oms-slim/css/*.css'],
                        dest: '',
                        ext: '.css.gz'
                    },
                    {
                        expand: true,
                        src: ['External/fonts/fonts-awesome/css/*.css'],
                        dest: '',
                        ext: '.min.css.gz'
                    }
                ]
            }
        },
        watch: {
            js: {
                files: ['Internal/js/ui/*.js', 'core/*.js'],
                tasks: ['uglify:dist', 'compress:dist']
            },
            sass: {
                files: ['Content/themes/oms-slim/scss/*.scss'],
                tasks: ['sass:dist', 'compress:dist']
            },
            img: {
                files: [],
                tasks: []
            },
            general: {
                files: [],
                tasks: []
            }
        }
    });

    grunt.registerTask("default", ['uglify:dist', 'sass:dist', 'compress:dist']);
    grunt.registerTask('dist', ['uglify:dist', 'sass:dist']);
    grunt.registerTask('push', ['uglify:dist', 'sass:dist']);
};