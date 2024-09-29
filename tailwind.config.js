/** @type {import('tailwindcss').Config} */

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        fontFamily: {
            'anton': ['anton', 'sans-serif'],
            'notoSansJP': ['notoSansJP', 'sans-serif'],
            'poppinsSemiBold': ['poppinsSemiBold', 'sans-serif'],
            'poppins': ['poppins', 'sans-serif'],
        },
        boxShadow: {
            'login': '-6px 6px 0 0 #762824'
        },
        colors: {
            'beureum': '#AC2721',
            'koneng': '#EFCC37',
            'oren': '#E85C0D',
        }
    },  },
  plugins: [
    require('flowbite/plugin'),
  ],
}

