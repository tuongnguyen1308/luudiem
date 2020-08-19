'use strict';

var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();
var sass = require('gulp-sass');
var pkg = require('./package');
var scripts = {
      name: 'jquery.contextMenu.js',
      min: 'jquery.contextMenu.min.js',
      all: [
        'gulpfile.js',
        'src/jquery.contextMenu.js',
        'dist/jquery.contextMenu.js'
      ],
      main: 'dist/jquery.contextMenu.js',
      src: [
          'src/jquery.contextMenu.js'
      ],
      dest: 'dist',
      libs: [
      ]
    };
var styles = {
      name: 'jquery.contextMenu.css',
      min: 'jquery.contextMenu.min.css',
      all: [
        'src/sass/**/*.scss'
      ],
      main: 'dist/jquery.contextMenu.css',
      src: 'src/sass/jquery.contextMenu.scss',
      dest: 'dist'
    };
var icons = {
    src: 'src/icons/*.svg',
    templateFileFont: 'src/sass/icons/_variables.scss.tpl',
    templateFileIconClasses: 'src/sass/icons/_icon_classes.scss.tpl',
    fontOutputPath: 'dist/font',
    scssOutputPath: 'src/sass/icons/'
};
var replacement = {
      regexp: /@\w+/g,
      filter: function (placeholder) {
        switch (placeholder) {
          case '@VERSION':
            placeholder = pkg.version;
            break;

          case '@YEAR':
            placeholder = (new Date()).getFullYear();
            break;

          case '@DATE':
            placeholder = (new Date()).toISOString();
            break;
        }

        return placeholder;
      }
    };

gulp.task('jshint', function () {
  return gulp.src(scripts.src).
    pipe(plugins.jshint('src/.jshintrc')).
    pipe(plugins.jshint.reporter('default'));
});

gulp.task('jscs', function () {
  return gulp.src(scripts.src).
    pipe(plugins.jscs());
});

gulp.task('js', ['jshint', 'jscs', 'jslibs'], function () {
  return gulp.src(scripts.src).
    pipe(plugins.sourcemaps.init()).
    pipe(plugins.replace(replacement.regexp, replacement.filter)).
    pipe(gulp.dest(scripts.dest)).
    pipe(plugins.rename(scripts.min)).
    pipe(plugins.uglify({
      preserveComments: 'some'
    })).
    pipe(plugins.sourcemaps.write('.')).
    pipe(gulp.dest(scripts.dest));
});

gulp.task('jslibs', function (){
    return gulp.src(scripts.libs).
        pipe(plugins.rename({prefix: 'jquery.ui.'})).
        pipe(gulp.dest('src')).
        pipe(gulp.dest('dist')).
        pipe(plugins.rename({extname: '.min.js'})).
        pipe(gulp.dest('dist')).
        pipe(plugins.uglify({
            preserveComments: 'some'
        })).
        pipe(plugins.sourcemaps.write('.')).
        pipe(gulp.dest(scripts.dest));
});

gulp.task('css', function () {
  return gulp.src(styles.src).
    pipe(sass()).
    pipe(plugins.csslint('src/.csslintrc')).
    pipe(plugins.csslint.reporter()).
    pipe(plugins.sourcemaps.init()).
    pipe(plugins.replace(replacement.regexp, replacement.filter)).
    pipe(plugins.autoprefixer({
      browsers: [
        'Android 2.3',
        'Android >= 4',
        'Chrome >= 20',
        'Firefox >= 24',
        'Explorer >= 8',
        'iOS >= 6',
        'Opera >= 12',
        'Safari >= 6'
      ]
    })).
    pipe(plugins.csscomb('src/.csscomb.json')).
    pipe(plugins.rename(styles.name)).
    pipe(gulp.dest(styles.dest)).
    pipe(plugins.rename(styles.min)).
    pipe(plugins.minifyCss()).
    pipe(plugins.sourcemaps.write('.')).
    pipe(gulp.dest(styles.dest));
});

gulp.task('build-icons', function () {
    var iconfont = require('gulp-iconfont');
    var consolidate = require('gulp-consolidate');

    gulp.src(icons.src)
        .pipe(iconfont({
            fontName: 'context-menu-icons',
            fontHeight: 1024,
            descent: 64,
            normalize: true,
            appendCodepoints: false,
            startCodepoint: 0xE001,
			formats: ['ttf', 'eot', 'woff', 'woff2']
        }))
        .on('glyphs', function (glyphs) {
            var options = {
                glyphs: glyphs,
                className: 'context-menu-icon',
                mixinName: 'context-menu-item-icon'
            };

            gulp.src(icons.templateFileFont)
                .pipe(consolidate('lodash',  options))
                .pipe(plugins.rename({basename: '_variables', extname: '.scss'}))
                .pipe(gulp.dest(icons.scssOutputPath));

            gulp.src(icons.templateFileIconClasses)
                .pipe(consolidate('lodash', options))
                .pipe(plugins.rename('_icons.scss'))
                .pipe(gulp.dest('src/sass')); // set path to export your sample HTML
        })
        .pipe(gulp.dest(icons.fontOutputPath));
});

gulp.task('watch', ['js', 'css'], function () {
  gulp.watch(scripts.src, ['js']);
  gulp.watch(styles.all, ['css']);
});

gulp.task('build', ['build-icons', 'css', 'js']);

gulp.task('default', ['watch']);
