const mix = require('laravel-mix')
const tailwindcss = require("tailwindcss");

require('./nova.mix')

mix
  .setPublicPath('dist')
  .js('resources/js/card.js', 'js')
  .vue({ version: 3 })
  .sass('resources/sass/card.scss', 'css')
  .options({
        processCssUrls: false,
        postCss: [tailwindcss("./tailwind.config.js")],
    })
  .nova('nagyist/cachecardnova4')

