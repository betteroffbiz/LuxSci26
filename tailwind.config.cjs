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
    extend: {
      spacing: {
        '25': '100px',
      },
      fontFamily: {
        'sans': ['Montserrat', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
        'heading': ['Montserrat', 'sans-serif'],
      },
      fontWeight: {
        'light': 300,
        'normal': 400,
        'medium': 500,
        'semibold': 600,
        'bold': 700,
        'extrabold': 800,
      }
    }
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ]
};
