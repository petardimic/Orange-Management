/* global module */
module.exports = function (grunt) {
    "use strict";

    require('load-grunt-tasks')(grunt);

    var globalConfig = {
        baseSass: 'assets/sass',
        baseStyles: 'assets/css'
    };

    //<%= globalConfig.baseStyles %> - inside ' ... '

    //noinspection JSUnresolvedFunction
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        banner: '/* <%= pkg.name %>\n' +
        'Version: <%= pkg.version %>\n' +
        'License: <%= pkg.license %> */\n',
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
                separator: ''
            },
            dev: {
                src: [
                    'jsOMS/Utils/oLib.js',
                    'jsOMS/Stdlib/**/*.js',
                    'jsOMS/Config/**/*.js',
                    'jsOMS/Auth/**/*.js',
                    'jsOMS/Uri/**/*.js',
                    'jsOMS/Views/**/*.js',
                    'jsOMS/Models/**/*.js',
                    'jsOMS/Controllers/**/*.js',
                    'jsOMS/DataStorage/**/*.js',
                    'jsOMS/Module/**/*.js',
                    'jsOMS/Math/**/*.js',
                    'jsOMS/Route/**/*.js',
                    'jsOMS/Uri/**/*.js',
                    'jsOMS/Message/**/*.js',
                    'jsOMS/Localization/**/*.js',
                    'jsOMS/Event/**/*.js',
                    'jsOMS/Security/**/*.js',
                    'jsOMS/System/**/*.js',
                    'jsOMS/Asset/**/*.js',
                    'jsOMS/UI/**/*.js',
                    'jsOMS/Validation/**/*.js',
                    'Model/**/*.js'
                ],
                dest: 'jsOMS/oms.min.js'
            }
        },
        uglify: {
            options: {
                banner: '<%= banner %>'
            },
            dev: {
                files: {
                    'jsOMS/oms.min.js': [
                        'jsOMS/oms.min.js'
                    ],
                    'jsOMS/backend.min.js': [],
                    'jsOMS/website.min.js': [],
                    'jsOMS/shop.min.js': []
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
                        cwd: 'Web/Theme/backend/scss',
                        src: ['*.scss'],
                        dest: 'Web/Theme/backend/css',
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
                        src: ['jsOMS/*.js'],
                        dest: '',
                        ext: '.min.js.gz'
                    },
                    {
                        expand: true,
                        src: ['Web/Theme/backend/js/*.js'],
                        dest: '',
                        ext: '.js.gz'
                    },
                    {
                        expand: true,
                        src: ['Web/Theme/backend/css/*.css'],
                        dest: '',
                        ext: '.css.gz'
                    }
                ]
            }
        },
        phpcs: {
            dev: {
                dir: ['phpOMS/**/*.php', 'Modules/**/*.php']
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
                dir: ['phpOMS', 'Modules']
            },
            options: {}
        },
        phpdocumentor: {
            dev: {
                options: {
                    directory: 'phpOMS,Modules,Web,Console,Socket,Admin',
                    target: 'Docs/Code'
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
                    'node_modules',
                    'bower_components'
                ]
            },
            dev: {
                dir: ['./']
            }
        },
        browserify: {
            dev: {
                files: {
                    'jsOMS/built.js': ['jsOMS/source.js']
                },
                options: {}
            }
        },
        shell: {
            options: {
                stderr: false
            },
            dev: {
                command: [
                    'rm -r -f Docs/Stats',
                    'mkdir Docs/Stats',
                    'phploc phpOMS/ > Docs/Stats/phpOMS.stats',
                    'phploc Modules/ > Docs/Stats/ModulesStats.stats',
                    'phpmetrics --report-html=Docs/Stats/ReportFramework.html phpOMS/',
                    'phpmetrics --report-html=Docs/Stats/ReportModules.html Modules/',
                    'rm -r -f External/',
                    'mkdir External',
                    'mkdir External/d3',
                    'cp bower_components/d3/d3.min.js External/d3',
                    'mkdir External/fontawesome',
                    'cp -r bower_components/fontawesome/css External/fontawesome',
                    'cp -r bower_components/fontawesome/fonts External/fontawesome'
                ].join('&&')
            },
            devclean: {
                command: [
                    'rm -r -f jsOMS/oms.min.js'
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
                files: ['!**/*.min.js', 'jsOMS/**/*.js', 'Model/**/*.js'],
                tasks: ['concat:dev']
            },
            sass: {
                files: ['Web/Theme/backend/scss/*.scss'],
                tasks: ['sass:dev', 'compress:dev']
            }
        }
    });

    grunt.registerTask('build-dev', ['concat:dev', 'uglify:dev', 'compress:dev', 'sass:dev', 'compress:dev', 'phpdocumentor:dev', 'pdepend:dev', 'shell:dev']);
    grunt.registerTask('quality-code', ['phpcs:dev', 'phpmd:dev', 'phpdcd:dev', 'pdepend:dev', 'phpunit:dev', 'shell:dev']);

    grunt.registerTask('build-release', []);
    grunt.registerTask('build-js', ['shell:devclean', 'concat:dev']);
};