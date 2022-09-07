/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    'resources/**/*.{vue,js,ts}',
    'resources/**/*.blade.php',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        gray: {
         '050': '#F8FAFC',
         '100': '#EAEFF4',
         '200': '#CFD6DE',
         '300': '#AEB7C3',
         '400': '#86909D',
         '500': '#606A77',
         '600': '#404955',
         '700': '#272E38',
         '800': '#171C24',
         '900': '#0C1016'
        }
      }
    },
  },
  plugins: [],
}
