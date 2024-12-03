/** @type {import('tailwindcss').Config} */

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'main-color': '#E77917',
        'secondary-color': '#f1b559',
      }
    },
  },
  plugins: [],
}


