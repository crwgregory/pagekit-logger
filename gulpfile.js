
'use strict';

var path = require('path');
var gulp = require('gulp');
var gulpLoadPlugins = require('gulp-load-plugins');
var webpack = require('webpack');
var webpackConfig = require('./webpack.config');
var gutil = require('gulp-util');

const $ = gulpLoadPlugins();

gulp.task('default', ['webpack']);

gulp.task('go', ['default'], function () {
  gulp.watch('app/assets/styles/scss/**/*.scss', ['styles']);
  gulp.watch('app/vue/**/*.*', ['webpack']);
});

gulp.task('webpack', function(callback) {
  var config = Array.from(webpackConfig);
  webpack(config, function(err, stats) {
    if (err) throw new gutil.PluginError('webpack', err);
    gutil.log("[webpack]", stats.toString({
      colors: true,
      //progress: true
      errorDetails:true
      //reasons: true,
      //modules:true
    }));
    callback();
  });
});

//gulp.task('babel', function() {
//  return gulp.src(
//      [
//
//      ]
//      )
//      .pipe($.babel())
//      .pipe(gulp.dest('.tmp/scripts'))
//});

//gulp.task('build', ['webpack'], function() {
//    return gulp.src(['./.tmp/bundle/*.bundle.js'])
//        .pipe($.sourcemaps.init())
//        .pipe($.concat('main.min.js'))
//        .pipe($.uglify({preserveComments: 'some'}))
//        .pipe($.sourcemaps.write('.'))
//        .pipe(gulp.dest('app/bundle'))
//});