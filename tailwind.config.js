/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/**/*.{html,js,php}"],
  theme: {
    extend: { backgroundImage: {
        'background-alt': "url('/public/assets/images/background_alt_sec.avif')",
      }},
  },
  plugins: [],
}
