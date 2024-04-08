const config = require('../../wpgulp.config.js')

module.exports = {
   content: [
      `${config.themePath}/*.php`,
      `${config.themePath}/**/**/*.php`,
      `${config.themePath}/**/**/*.php`,
      `${config.themePath}/components/*.php`,
      `${config.themePath}/components/**/*.php`,
      './node_modules/flowbite/**/*.js',
   ],
   safelist: [
      'hidden',
      '!hidden'
   ],
   plugins: [require('@tailwindcss/line-clamp')],
   theme: {
      container: {
         center: true,
         padding: {
            DEFAULT: '15px',
         },
         screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1280px',
            '2xl': '1536px',
            '3xl': '1590px',
            '4xl': '1832px',
         }
      },
      fontFamily: {
         primary: [
            'HelveticaNeue',
            'ui-sans-serif',
            'system-ui',
            '-apple-system',
            'BlinkMacSystemFont',
            'Segoe UI',
            'Roboto',
            'Helvetica Neue',
            'Arial',
            'Noto Sans',
            'sans-serif',
            'Apple Color Emoji',
            'Segoe UI Emoji',
            'Segoe UI Symbol',
            'Noto Color Emoji',
         ],
         secondary: [
            'Inter',
            'ui-sans-serif',
            'system-ui',
            '-apple-system',
            'BlinkMacSystemFont',
            'Segoe UI',
            'Roboto',
            'Helvetica Neue',
            'Arial',
            'Noto Sans',
            'sans-serif',
            'Apple Color Emoji',
            'Segoe UI Emoji',
            'Segoe UI Symbol',
            'Noto Color Emoji',
         ],
      },
      extend: {
         screens: {
            'xs': '420px',
            '3xl': '1650px',
            '4xl': '1892px',
         },
         colors: {
            purple: {
               900: '#0C030F'
            },
            gray: {
               600: '#929292',
            },
            yellow: {
               100: '#FCF9EA',
            },
         },
      },
   },
}
