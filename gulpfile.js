// https://gist.github.com/leymannx/f7867942184d01aa2311

var gulp = require('gulp'),
	sass = require('gulp-sass'),
	sassLint = require('gulp-sass-lint'),
	sourcemaps = require('gulp-sourcemaps'),
	prefix = require('gulp-autoprefixer'),
	phpcs = require('gulp-phpcs'),
	phpcbf = require('gulp-phpcbf');


// SETTINGS
// ---------------

var sassOptions = {
	outputStyle: 'expanded'
};


// BUILD SUBTASKS
// ---------------

gulp.task('phpcbf', function () {
	return gulp.src(['./**/*/*.php', '!node_modules/**/*', '!vendor/**/*'])
		.pipe(phpcbf({
			bin: './vendor/bin/phpcbf',
			standard: 'WordPress',
			warningSeverity: 0
		}))
		.pipe(gulp.dest('./'));
});

gulp.task('phpcs', function () {
	return gulp.src(['./**/**/*.php', '!src/vendor/**/*.*'])
		// Validate files using PHP Code Sniffer
		.pipe(phpcs({
			bin: './vendor/bin/phpcs',
			standard: 'WordPress',
			warningSeverity: 2
		}))
		// Log all problems that was found
		.pipe(phpcs.reporter('log')); 
});

gulp.task('styles', function () {
	return gulp.src('./admin/assets/css/app.scss')
		.pipe(sourcemaps.init())
		.pipe(sass(sassOptions))
		.pipe(prefix())
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest('./admin/assets/css'));
});

gulp.task('sass-lint', function () {
	return gulp.src('./admin/assets/css/*.scss')
		.pipe(sassLint())
		.pipe(sassLint.format())
		.pipe(sassLint.failOnError());
});

gulp.task('watch', function () {
	gulp.watch('./admin/assets/css/app.scss', gulp.series('styles'));
});


// BUILD TASKS
// ------------

gulp.task('default', gulp.series('styles', 'watch'));
gulp.task('fix', gulp.series('phpcbf'));
gulp.task('build', gulp.series('styles'));
