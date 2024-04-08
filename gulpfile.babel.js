/**
 * Gulpfile.
 *
 * Gulp with WordPress.
 *
 * Implements:
 *      1. Live reloads browser with BrowserSync.
 *      2. CSS: Sass to CSS conversion, error catching, Autoprefixing, Sourcemaps,
 *         CSS minification, and Merge Media Queries.
 *      3. JS: Concatenates & uglifies Vendor and Custom JS files.
 *      4. Images: Minifies PNG, JPEG, GIF and SVG images.
 *      5. Watches files for changes in CSS or JS.
 *      6. Watches files for changes in PHP.
 *      7. Corrects the line endings.
 *      8. InjectCSS instead of browser page reload.
 *      9. Generates .pot file for i18n and l10n.
 *
 * @tutorial https://github.com/ahmadawais/WPGulp
 * @author Ahmad Awais <https://twitter.com/MrAhmadAwais/>
 */

/**
 * Load WPGulp Configuration.
 */
const config = require('./wpgulp.config.js')

/**
 * Load Plugins.
 *
 * Load gulp plugins and passing them semantic names.
 */
const gulp = require('gulp') // Gulp of-course.

// CSS related plugins.
const sass = require('gulp-sass')(require('sass')) // Gulp plugin for Sass compilation.
const minifycss = require('gulp-uglifycss') // Minifies CSS files.
const postcss = require('gulp-postcss')
const mmq = require('gulp-merge-media-queries') // Combine matching media queries into one.
const postcssImport = require('postcss-import')
const multipleTailwind = require('postcss-multiple-tailwind')
const autoprefixer = require('autoprefixer')

// JS related plugins.
const concat = require('gulp-concat') // Concatenates JS files.
const uglify = require('gulp-uglify') // Minifies JS files.
const babel = require('gulp-babel') // Compiles ESNext to browser compatible JS

// Utility related plugins.
const rename = require('gulp-rename') // Renames files E.g. style.css -> style.min.css.
const lineec = require('gulp-line-ending-corrector') // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings).
const filter = require('gulp-filter') // Enables you to work on a subset of the original files by filtering them using a glob.
const sourcemaps = require('gulp-sourcemaps') // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css).
const browserSync = require('browser-sync').create() // Reloads browser and injects CSS. Time-saving synchronized browser testing.
const wpPot = require('gulp-wp-pot') // For generating the .pot file.
const sort = require('gulp-sort') // Recommended to prevent unnecessary changes in pot-file.
const remember = require('gulp-remember') //  Adds all the files it has ever seen back into the stream.
const plumber = require('gulp-plumber') // Prevent pipe breaking caused by errors from gulp plugins.
const zip = require('gulp-zip') // Zip plugin or theme file.

/**
 * Custom Error Handler.
 *
 * @param Mixed err
 */
const errorHandler = (r) => {
   console.error(r.message)

   // this.emit('end');
}

/**
 * Task: `browser-sync`.
 *
 * Live Reloads, CSS injections, Localhost tunneling.
 * @link http://www.browsersync.io/docs/options/
 *
 * @param {Mixed} done Done.
 */
const browsersync = (done) => {
   browserSync.init({
      https: true,
      proxy: config.projectURL,
      open: config.browserAutoOpen,
      injectChanges: config.injectChanges,
      watchEvents: ['change', 'add', 'unlink', 'addDir', 'unlinkDir'],
   })
   done()
}

// Helper function to allow browser reload with Gulp 4.
const reload = (done) => {
   browserSync.reload()
   done()
}

/**
 * Task: `styles`.
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source scss file
 *    2. Compiles Sass to CSS
 *    3. Writes Sourcemaps for it
 *    4. Autoprefixes it and generates style.css
 *    5. Renames the CSS file with suffix .min.css
 *    6. Minifies the CSS file and generates style.min.css
 *    7. Injects CSS or reloads the browser via browserSync
 *
 *          .pipe(
            sass({
               errLogToConsole: config.errLogToConsole,
               outputStyle: config.outputStyle,
               precision: config.precision,
            }),
         )
         .on('error', sass.logError)
 */
gulp.task('styles', () => {
   let currentTask
   config.styleFiles.map((file) => {
      currentTask = gulp
         .src(`${config.styleSRC}/${file}.css`, { allowEmpty: true })
         .pipe(sourcemaps.init())
         .pipe(postcss([postcssImport, multipleTailwind, autoprefixer]))
         .pipe(sourcemaps.write({ includeContent: false }))
         .pipe(sourcemaps.init({ loadMaps: true }))
         .pipe(rename({ suffix: '.min' }))
         .pipe(minifycss())
         .pipe(gulp.dest(config.styleDestination))
         .pipe(browserSync.stream())
   })
   return currentTask
})

/**
 * Task: JS Files.
 *
 * Concatenate and uglify JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS files
 *     2. Concatenates all the files
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates *.min.js
 */
gulp.task('js', () => {
   let currentTask
   config.jsFiles.map((folder) => {
      currentTask = gulp
         .src(config.jsDestination + folder + '/*.js')
         .pipe(plumber(errorHandler))
         .pipe(
            babel({
               presets: [
                  [
                     '@babel/preset-env', // Preset to compile your modern JS to ES5.
                     {
                        targets: { browsers: config.BROWSERS_LIST }, // Target browser list to support.
                     },
                  ],
               ],
            }),
         )
         .pipe(remember(config.jsDestination + folder + '/*.js')) // Bring all files back to stream.
         .pipe(concat(folder + '.js'))
         .pipe(lineec()) // Consistent Line Endings for non UNIX systems.
         .pipe(
            rename({
               basename: folder,
               suffix: '.min',
            }),
         )
         .pipe(uglify())
         .pipe(gulp.dest(config.jsDestination))
   })
   return currentTask
})

/**
 * WP POT Translation File Generator.
 *
 * This task does the following:
 * 1. Gets the source of all the PHP files
 * 2. Sort files in stream by path or any custom sort comparator
 * 3. Applies wpPot with the variable set at the top of this file
 * 4. Generate a .pot file of i18n that can be used for l10n to build .mo file
 */
gulp.task('translate', () => {
   return gulp
      .src(config.watchPhp)
      .pipe(sort())
      .pipe(
         wpPot({
            domain: config.textDomain,
            package: config.packageName,
            bugReport: config.bugReport,
            lastTranslator: config.lastTranslator,
            team: config.team,
         }),
      )
      .pipe(gulp.dest(config.translationDestination + '/' + config.translationFile))
})

/**
 * Zips theme or plugin and places in the parent directory
 *
 * zipIncludeGlob: Files to be included in the zip file
 * zipIgnoreGlob: Files to be ignored from the zip file
 * zipDestination: Must be a folder outside of the zip folder.
 * zipName: theme.zip or plugin.zip
 */
gulp.task('zip', () => {
   const src = [...config.zipIncludeGlob, ...config.zipIgnoreGlob]
   return gulp.src(src).pipe(zip(config.zipName)).pipe(gulp.dest(config.zipDestination))
})

gulp.task(
   'default',
   gulp.parallel('styles', 'js', browsersync, () => {
      /**
       * Watch Tasks.
       *
       * Watches for file changes and runs specific tasks.
       */
      gulp.watch([config.watchStyles, config.watchPhp], gulp.parallel('styles'))
      gulp.watch(config.watchPhp, reload)
      gulp.watch(
         config.jsFiles.map((folder) => {
            return `${config.themePath}/assets/js/${folder}/*.js`
         }),
         gulp.series('js', reload),
      )
   }),
)
