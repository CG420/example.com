var gulp = require('gulp');
var watch = require('gulp-watch');
var cleanCSS = require('gulp-clean-css');
var uglify = require('gulp-uglify-es').default;
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var merge = require('merge-stream');
var scss = require('gulp-sass');

gulp.task('default', ['watch']);

gulp.task('build-css', function(){
  //Create an unminified version
  var full = gulp.src([
    'src/scss/main.scss'
  ])
  . pipe(scss())
  . pipe(concat('main.css'))
  . pipe(gulp.dest('dist/css'));

  //Create a minified version
  var min = gulp.src([
    'src/scss/main.scss'
  ])
  . pipe(scss())
  . pipe(cleanCSS())
  . pipe(concat('main.min.css'))
  . pipe(gulp.dest('dist/css'));

  return merge(full, min);
});

gulp.task('watch', function(){
  gulp.watch('.//src/scss/**/*.scss', ['build-css']);
  gulp.watch('.//src/scss/**/*.scss', ['build-resume']);
  gulp.watch('.//src/scss/**/*.scss', ['build-contact']);
  gulp.watch('.//src/scss/**/*.scss', ['build-thanks']);
});

gulp.task('build-resume', function(){
  //Create an unminified version
  var full = gulp.src([
    'src/scss/resume.scss'
  ])
  . pipe(scss())
  . pipe(concat('resume.css'))
  . pipe(gulp.dest('dist/css'));

  //Create a minified version
  var min = gulp.src([
    'src/scss/resume.scss'
  ])
  . pipe(scss())
  . pipe(cleanCSS())
  . pipe(concat('resume.min.css'))
  . pipe(gulp.dest('dist/css'));
});

gulp.task('build-contact', function(){
  //Create an unminified version
  var full = gulp.src([
    'src/scss/contact.scss'
  ])
  . pipe(scss())
  . pipe(concat('contact.css'))
  . pipe(gulp.dest('dist/css'));

  //Create a minified version
  var min = gulp.src([
    'src/scss/contact.scss'
  ])
  . pipe(scss())
  . pipe(cleanCSS())
  . pipe(concat('contact.min.css'))
  . pipe(gulp.dest('dist/css'));
});

gulp.task('build-thanks', function(){
  //Create an unminified version
  var full = gulp.src([
    'src/scss/thanks.scss'
  ])
  . pipe(scss())
  . pipe(concat('thanks.css'))
  . pipe(gulp.dest('dist/css'));

  //Create a minified version
  var min = gulp.src([
    'src/scss/thanks.scss'
  ])
  . pipe(scss())
  . pipe(cleanCSS())
  . pipe(concat('thanks.min.css'))
  . pipe(gulp.dest('dist/css'));
});