const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
      './resources/views/**/*.blade.php',
      './resources/js/**/*.js',
  ],
  theme: {
    extend: {
        fontFamily: {
            sans: ['Inter var', ...defaultTheme.fontFamily.sans],
        },
    },
  },
  variants: {},
  plugins: [
      require('@tailwindcss/ui'),
  ],
}
