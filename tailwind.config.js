/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  safelist: [
    'text-red-600',
    'text-blue-800',
    'text-green-600',
    'text-gray-500'
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
