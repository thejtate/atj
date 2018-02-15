'use strict';

const config = require('./config.json');
const isDevelopment = !process.env.NODE_ENV || process.env.NODE_ENV == 'development';

const gulp = require('gulp');
const sass = require('gulp-sass');
const gulpIf = require('gulp-if');
const myth = require('gulp-myth');
const newer = require('gulp-newer');
const imageMin = require('gulp-imagemin');
const imageminJpegRecompress = require('imagemin-jpeg-recompress');
const spritesmith = require('gulp.spritesmith');
const babel = require('gulp-babel');
const plumber = require('gulp-plumber');

gulp.task('sprite', () => {
  var timestamp = Date.now();

  let spriteData =
    gulp.src(config.sprite.src)
      .pipe(spritesmith({
        imgName: 'sprite.png',
        imgPath: 'sprite.png?t=' + timestamp,
        cssName: '_sprite.scss',
        cssFormat: 'scss',
        algorithm: 'binary-tree',
        cssTemplate: config.sprite.cssTemplate,
        cssVarMap: (sprite) => {
          sprite.name = 's-' + sprite.name;
        }
      }));

  spriteData.img.pipe(gulp.dest(gulpIf(isDevelopment, config.sprite.destImg, config.sprite.buildDestImg)));
  spriteData.css.pipe(gulp.dest(config.sprite.destScss));

  return spriteData;
});

gulp.task('sass', () => {
  return gulp.src(config.scss.src)
    .pipe(sass().on('error', sass.logError))
    .pipe(myth())
    .pipe(gulp.dest(gulpIf(isDevelopment, config.scss.dest, config.scss.buildDest)));
});

gulp.task('js-es6', () => {
  return gulp.src(config.js.src)
    .pipe(plumber({
      errorHandler: function (error) {
        console.log(error.message);
        this.emit('end');
      }
    }))
    .pipe(babel({
      presets: ['es2015'],
    }))
    .pipe(gulp.dest(gulpIf(isDevelopment, config.js.dest, config.js.buildDest)));
});

gulp.task('images', () => {
  return gulp.src(config.img.src)
    .pipe(plumber({
      errorHandler: function (error) {
        console.log(error.message);
        this.emit('end');
      }}))
    .pipe(newer(gulpIf(isDevelopment, config.img.dest, config.img.buildDest)))
    .pipe(imageMin([
      imageminJpegRecompress(),
      imageMin.gifsicle({interlaced: true}),
      imageMin.optipng({optimizationLevel: 5}),
      imageMin.svgo({plugins: [{removeViewBox: true}]}),
    ], {
      verbose: true,
    }))
    .pipe(gulp.dest(gulpIf(isDevelopment, config.img.dest, config.img.buildDest)));
});

gulp.task('watcher', () => {
  gulp.watch(config.sprite.watch, gulp.series('sprite'));
  gulp.watch(config.scss.watch, gulp.series('sass'));
  gulp.watch(config.js.watch,  gulp.series('js-es6'));
  gulp.watch(config.img.watch,  gulp.series('images'));
});

gulp.task('build', gulp.series(gulp.parallel('sass', 'js-es6', 'images')));
gulp.task('watch', gulp.series('build', 'watcher'));
