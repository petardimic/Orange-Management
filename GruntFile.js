/* global module */
module.exports = function (grunt) {
    "use strict";

    grunt.loadNpmTasks('grunt-composer');
    grunt.loadNpmTasks('grunt-vagrant');
    grunt.loadNpmTasks('grunt-vagrantup');
    grunt.loadNpmTasks("grunt-jscs");
    grunt.loadNpmTasks('grunt-phpcs');
    grunt.loadNpmTasks('grunt-phpmd');
    grunt.loadNpmTasks('grunt-phpdcd');
    grunt.loadNpmTasks('grunt-pdepend');
    grunt.loadNpmTasks('load-grunt-tasks');
    grunt.loadNpmTasks("grunt-phplint");
    grunt.loadNpmTasks('grunt-hashres');
    grunt.loadNpmTasks('grunt-html-validation');
    grunt.loadNpmTasks('grunt-phpdocumentor');
    grunt.loadNpmTasks("grunt-contrib-uglify");
    grunt.loadNpmTasks("grunt-contrib-cssmin");
    grunt.loadNpmTasks("grunt-contrib-concat");
    grunt.loadNpmTasks("grunt-contrib-imagemin");
    grunt.loadNpmTasks("grunt-contrib-htmlmin");
    grunt.loadNpmTasks("grunt-contrib-sass");
    grunt.loadNpmTasks("grunt-contrib-compass");
    grunt.loadNpmTasks("grunt-contrib-clean");
    grunt.loadNpmTasks("grunt-contrib-jshint");
    grunt.loadNpmTasks('grunt-jslint');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks("grunt-contrib-compress");
    grunt.loadNpmTasks('grunt-include-source');
    grunt.loadNpmTasks('grunt-phpunit');
    grunt.loadNpmTasks('grunt-newer');

    //noinspection JSUnresolvedFunction
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        banner: '/* <%= pkg.name %>\n' +
            'Version: <%= pkg.version %>\n */',
        includeSource: {
            options: {
              // Task-specific options go here.
            },
            your_target: {
              // Target-specific file lists and/or options go here.
            }
        },
        concat: {
            options: {
                separator: ';'
            },
            dev: {
                src: [
                    'Framework/JavaScript/Framework/a.js',
                    'Framework/JavaScript/Framework/UI/*.js',
                    'Framework/JavaScript/Framework/z.js'
                ],
                dest: 'Framework/JavaScript/oms.min.js'
            }
        },
        uglify: {
            options: {
                banner: '<%= banner %>'
            },
            dev: {
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
            dev: {
                options: {
                    style: 'compressed'
                },
                files: [
                    {
                        expand: true,
                        cwd: 'Web/themes/oms-slim/backend/scss',
                        src: ['*.scss'],
                        dest: 'Web/themes/oms-slim/backend/css',
                        ext: '.css'
                    }
                ]
            }
        },
        compress: {
            dev: {
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
                        src: ['Web/themes/oms-slim/backend/js/*.js'],
                        dest: '',
                        ext: '.js.gz'
                    },
                    {
                        expand: true,
                        src: ['Web/themes/oms-slim/backend/css/*.css'],
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
        phpcs: {
            dev: {
                dir: ['Framework/**/*.php', 'Modules/**/*.php']
            },
            options: {
                bin: 'vendor/bin/phpcs',
                standard: 'Zend'
            }
        },
        phpmd: {
            dev: {
                dir: 'Modules'
            },
            options: {
                rulesets: 'codesize,unusedcode,naming'
            }
        },
        phpdcd: {
            dev: {
                dir: ['Framework', 'Modules']
            },
            options: {
            }
        },
        phpdocumentor: {
            dev: {
                options: {
                    directory : 'Framework,Modules',
                    target : 'Docs/Code'
                }
            }
        },
        pdepend: {
            options: {
                jdependChart: 'Docs/Dependencies/jdependChart.svg',
                jdependXml: 'Docs/Dependencies/jdependXml.xml',
                overviewPyramid: 'Docs/Dependencies/overviewPyramid.svg',
                summaryXml: 'Docs/Dependencies/summaryXml.xml',
                ignoreDirectories: [
                    'vendor',
                    'node_modules'
                ]
            },
            dev: {
                dir: ['./']
            }
        },
        shell: {
            options: {
                stderr: false
            },
            dev: {
                command: [
                    'phploc Framework/ > Docs/Stats/FrameworkStats.stats',
                    'phploc Modules/ > Docs/Stats/ModulesStats.stats'
                ].join('&&')
            }
        },
        phpunit: {
            dev: {
                dir: 'Tests/PHPUnit/'
            },
            options: {
                bin: 'vendor/bin/phpunit',
                bootstrap: 'Tests/PHPUnit/Bootstrap.php',
                colors: true
            }
        },
        watch: {
            js: {
                files: ['Framework/JavaScript/Framework/UI/*.js', 'Framework/JavaScript/Framework/Utils/*.js'],
                tasks: ['concat:dev', 'uglify:dev', 'compress:dev']
            },
            sass: {
                files: ['Content/themes/oms-slim/backend/scss/*.scss'],
                tasks: ['sass:dev', 'compress:dev']
            }
        }
    });

    grunt.registerTask('build-dev', ['concat:dev', 'uglify:dev', 'compress:dev', 'sass:dev', 'compress:dev', 'phpdocumentor:dev', 'shell:dev']);
    grunt.registerTask('quality-code', ['phpcs:dev', 'phpmd:dev', 'phpdcd:dev', 'pdepend:dev', 'phpunit:dev', 'shell:dev']);
};