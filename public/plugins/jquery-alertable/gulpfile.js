'use strict';

var gulp = require('gulp-help')(require('gulp')),
    del = require('del'),
    jshint = require('gulp-jshint'),
    notify = require('gulp-notify'),
    rename = require('gulp-rename'),
    uglify = require('gulp-uglify');

// Clean
gulp.task('clean', 'Clean up!', function() {
    return del('jquery.alertable.min.js');
});

// Minify
gulp.task('minify', 'Minify it!', ['jshint', 'clean'], function() {
    return gulp.src('jquery.alertable.js')
        .pipe(uglify({
            preserveComments: 'license'
        }))
            .on('error', function(err) {
                notify(err).write(err);
                this.emit('end');
            })
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(__dirname));
});

// JSHint
gulp.task('jshint', 'Lint it!', function() {
    return gulp.src('jquery.alertable.js')
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('jshint-stylish'))
            .on('error', function(err) {
                notify(err).write(err);
                this.emit('end');
            });
});

// Watch for changes
gulp.task('watch', 'Watch for changes!', function() {
    gulp.watch('jquery.alertable.js', ['minify']);
});

// Default
gulp.task('default', 'The default task.', ['watch']);