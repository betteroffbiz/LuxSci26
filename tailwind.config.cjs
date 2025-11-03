module.exports = {
  content: [
    './**/*.php',
    './template-parts/**/*.php',
    './assets/js/**/*.ts',
    './block-templates/**/*.html',
    './patterns/**/*.php',
  ],
  theme: {
    container: { center: true, padding: '1rem' },
    extend: {}
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ]
};
