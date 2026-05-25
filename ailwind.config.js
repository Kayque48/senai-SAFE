/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./app/**/*.{blade.php,php}",
    "./resources/**/*.{html,blade.php,php,vue,js,ts,jsx,tsx}",
    "./vendor/filament/**/*.blade.php",
  ],
  theme: {
    extend: {
      colors: {
        senai: {
          primary: '#1a1a2e',
          secondary: '#16213e',
          accent: '#0f3460',
          red: '#E30613',
          'red-dark': '#b0041a',
          'bg-primary': '#09090b',
          'bg-surface': '#1a1a2e',
          'glass': 'rgba(22,33,62,0.4)',
          'text-primary': '#f4f4f5',
          'text-secondary': '#a1a1aa',
          'text-tertiary': '#71717a',
          'border': 'rgba(255,255,255,0.08)',
          'border-hover': 'rgba(255,255,255,0.12)',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
        condensed: ['Barlow Condensed', 'system-ui', 'sans-serif'],
      },
      borderRadius: {
        'none': '0',
        'sm': '2px',
        'base': '4px',
        'md': '6px',
        'lg': '8px',
      },
      boxShadow: {
        'glass': '0 8px 32px rgba(0, 0, 0, 0.3)',
        'glow': '0 0 20px rgba(227, 6, 19, 0.15)',
        'glow-sm': '0 0 8px rgba(227, 6, 19, 0.1)',
      },
      backdropBlur: {
        '40': '40px',
      },
      spacing: {
        'safe': '1.75rem',
      },
    },
  },
  plugins: [],
  darkMode: 'class',
}