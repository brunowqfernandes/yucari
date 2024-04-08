// Nome abreviado do projeto
// > Se não for igual endereço local, nome da pasta e arquivo de tradução, editar mais abaixo.
const projectKey = '.'
const themePath = projectKey
const projectURL = projectKey + '.local'

const styleFiles = ['all', 'admin']
// Pastas de arquivos com JS
const jsFiles = ['all', 'logged']

const browserAutoOpen = false
const injectChanges = true
const jsDestination = themePath + '/assets/js/'

// STYLES
const styleSRC = themePath + '/assets/tailwind/'
const styleDestination = themePath + '/assets/css'
const outputStyle = 'compressed'
const errLogToConsole = true
const precision = 10
const watchStyles = styleSRC + '**/*.css'

// IMAGE
// Images options.
// Source folder of images which should be optimized and watched.
// > You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
const imgSRC = themePath + '/assets/images/raw/**/*'
// Destination folder of optimized images.
// > Must be different from the imagesSRC folder.
const imgDST = themePath + '/assets/images/'

// Path to all PHP files.
const watchPhp = themePath + '/**/*.php'

// >>>>> Zip file config.
// Must have.zip at the end.
const zipName = projectKey + '.zip'
const zipDestination = './'
const zipIncludeGlob = [themePath + '/**/*']

// Default ignored files and folders for the zip file.
const zipIgnoreGlob = [
   '!./{node_modules,node_modules/**/*}',
   '!./.git',
   '!./.svn',
   '!./gulpfile.babel.js',
   '!./wpgulp.config.js',
   '!./phpcs.xml.dist',
   '!./vscode',
   '!./package.json',
   '!./package-lock.json',
   `!${watchStyles}`,
   `!${themePath}/assets/scss/**/**`,
   `!${themePath}/assets/scss/*`,
   `!${themePath}/assets/scss`,
   `!${imgSRC}`,
   `!${themePath}/assets/images/raw`,
   `!${styleSRC}`,
]

jsFiles.map((folder) => {
   zipIgnoreGlob.push(`!${jsDestination}/${folder}/*`)
   zipIgnoreGlob.push(`!${jsDestination}/${folder}`)
})

// >>>>> Translation options.
// Your text domain here.
const textDomain = projectKey

// Name of the translation file.
const translationFile = projectKey + '.pot'

// Where to save the translation files.
const translationDestination = './languages'

// Package name.
const packageName = projectKey

// Where can users report bugs.
const bugReport = 'https://AhmadAwais.com/contact/'

// Last translator Email ID.
const lastTranslator = 'Fabricandosuaideia <contato@fabricandosuaideia.com.br>'

// Team's Email ID.
const team = 'Fabricandosuaideia <contato@fabricandosuaideia.com.br>'

// Browsers you care about for auto-prefixing. Browserlist https://github.com/ai/browserslist
// The following list is set as per WordPress requirements. Though; Feel free to change.
const BROWSERS_LIST = ['last 2 version', '> 1%']

// Export.
module.exports = {
   projectURL,
   themePath,
   browserAutoOpen,
   injectChanges,
   styleSRC,
   styleFiles,
   styleDestination,
   outputStyle,
   errLogToConsole,
   precision,
   jsDestination,
   jsFiles,
   imgSRC,
   imgDST,
   watchStyles,
   watchPhp,
   zipName,
   zipDestination,
   zipIncludeGlob,
   zipIgnoreGlob,
   textDomain,
   translationFile,
   translationDestination,
   packageName,
   bugReport,
   lastTranslator,
   team,
   BROWSERS_LIST,
}
