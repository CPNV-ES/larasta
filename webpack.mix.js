let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix .js('resources/assets/js/visitsList.js', 'public/js')
    .copy('resources/assets/js/utils.js', 'public/js')
    .copy('resources/assets/js/internship.js', 'public/js')
    .js('resources/assets/js/internshipreport.js', 'public/js')
    .js('resources/assets/js/internshipsEdit.js', 'public/js')
    .js('resources/assets/js/wishesMatrix.js', 'public/js')
    .js('resources/assets/js/visits.js', 'public/js')
    .js('resources/assets/js/mailing.js', 'public/js')
    .js('resources/assets/js/cyclelife.js', 'public/js')
    .js('resources/assets/js/uploadfile.js', 'public/js')
    .js('resources/assets/js/editGrid.js', 'public/js')
    .copy('resources/assets/js/entreprise.js', 'public/js')
    .js('resources/assets/js/entreprises.js', 'public/js')
    .js('resources/assets/js/evalgrid.js', 'public/js')
    .js('resources/assets/js/evalgridcreate.js', 'public/js')
    .js('resources/assets/js/people.js', 'public/js')
    .js('resources/assets/js/reconstages.js', 'public/js')
    .js('resources/assets/js/remarkslist.js', 'public/js')
    .js('resources/assets/js/synchro.js', 'public/js')
    .js('resources/assets/js/visit.js', 'public/js')
    .js('resources/assets/js/appjs.js', 'public/js')
    .copy('resources/assets/js/class/FieldsRemarks.js', 'public/js/class')
    .js('resources/assets/js/reconmade.js', 'public/js')
    .copy('resources/assets/js/logbook.js', 'public/js')
    .copy('resources/assets/js/logbookFeedbacksAndAcknowledges.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/recon.scss', 'public/css')
    .sass('resources/assets/sass/documents.scss', 'public/css')
    .sass('resources/assets/sass/editGrid.scss', 'public/css')
    .sass('resources/assets/sass/evalGrid.scss', 'public/css')
    .sass('resources/assets/sass/people.scss', 'public/css')
    .sass('resources/assets/sass/synchro.scss', 'public/css')
    .sass('resources/assets/sass/travelTime.scss', 'public/css')
    .sass('resources/assets/sass/visits.scss', 'public/css')
    .sass('resources/assets/sass/wishesMatrix.scss', 'public/css')
    .sass('resources/assets/sass/mpmenu.scss', 'public/css')
    .sass('resources/assets/sass/internships.scss', 'public/css')
    .sass('resources/assets/sass/mailing.scss', 'public/css')
    .sass('resources/assets/sass/lifeCycle.scss', 'public/css')
    .sass('resources/assets/sass/logbook.scss', 'public/css')
    .sass('resources/assets/sass/flocks.scss', 'public/css')
    .sass('resources/assets/sass/params.scss', 'public/css')
    .copy('resources/assets/css/minimal.css','public/css')
    .copy('node_modules/bootstrap/dist/css/bootstrap.css','public/css')
    .copy('node_modules/bootstrap/dist/css/bootstrap.css.map','public/css')
    .copy('node_modules/ckeditor/ckeditor.js','public/js')
    .copy('node_modules/bootstrap/dist/js/bootstrap.js','public/js')
    .copy('node_modules/bootstrap/dist/js/bootstrap.js.map','public/js')
    .copy('node_modules/jquery/dist/jquery.js','public/js')
    .copy('node_modules/bootstrap/dist/js/bootstrap.js','public/js')
    .copy('node_modules/dropzone/dist/min/dropzone.min.css','public/css')
    .copy('node_modules/dropzone/dist/min/dropzone.min.js','public/js')
    .copy('node_modules/datatables/media/js/jquery.dataTables.js','public/js')
    .copy('node_modules/simplemde/dist/simplemde.min.css','public/css')
    .copy('node_modules/simplemde/dist/simplemde.min.js','public/js')
    .copy('node_modules/showdown/dist/showdown.min.js','public/js')
    .copy('node_modules/showdown/dist/showdown.min.js.map','public/js')
    .copy('node_modules/tinymce/tinymce.min.js','public/js')
    .copyDirectory('node_modules/tinymce/themes','public/js/themes/')
    .copyDirectory('node_modules/tinymce/icons','public/js/icons/')
    .copyDirectory('node_modules/tinymce/skins','public/js/skins/')
    .copyDirectory('node_modules/tinymce/plugins','public/js/plugins/')

