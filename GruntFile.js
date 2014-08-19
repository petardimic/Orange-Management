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
        concat: {
            options: {
                separator: ';',
            },
            dist: {
                src: [
                    'Framework/JavaScript/Framework/Utils/*.js',
                    'Framework/JavaScript/Framework/a.js',
                    'Framework/JavaScript/Framework/UI/*.js',
                    'Framework/JavaScript/Framework/z.js'
                ],
                dest: 'Framework/JavaScript/oms.min.js',
            },
        },
        uglify: {
            options: {
                banner: '<%= banner %>'
            },
            dist: {
                files: {
                    'Framework/JavaScript/oms.min.js': [
                        'Framework/JavaScript/oms.min.js'
                    ],
                    'Framework/JavaScript/backend.min.js': [],
                    'Framework/JavaScript/website.min.js': [],
                    'Framework/JavaScript/shop.min.js': []
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
                        cwd: 'Content/themes/oms-slim/backend/scss',
                        src: ['*.scss'],
                        dest: 'Content/themes/oms-slim/backend/css',
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
                        src: ['Framework/JavaScript/*.js'],
                        dest: '',
                        ext: '.min.js.gz'
                    },
                    {
                        expand: true,
                        src: ['Framework/Libs/jquery/*.js'],
                        dest: '',
                        ext: '.min.js.gz'
                    },
                    {
                        expand: true,
                        src: ['Content/themes/oms-slim/backend/js/*.js'],
                        dest: '',
                        ext: '.js.gz'
                    },
                    {
                        expand: true,
                        src: ['Content/themes/oms-slim/backend/css/*.css'],
                        dest: '',
                        ext: '.css.gz'
                    },
                    {
                        expand: true,
                        src: ['Framework/Libs/fonts/fonts-awesome/css/*.css'],
                        dest: '',
                        ext: '.min.css.gz'
                    }
                ]
            }
        },
        watch: {
            js: {
                files: ['Framework/JavaScript/Framework/UI/*.js', 'Framework/JavaScript/Framework/Utils/*.js'],
                tasks: ['concat:dist', 'uglify:dist', 'compress:dist']
            },
            sass: {
                files: ['Content/themes/oms-slim/backend/scss/*.scss'],
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