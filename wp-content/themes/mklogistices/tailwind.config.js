module.exports = {
  content: [
    './*.php',
    './inc/**/*.php',
    './components/**/*.php',
    './templates/**/*.php',
    './safelist.txt'
  ],
  safelist: [
    'text-center'
  ],
  theme: {
    fontFamily: {
      body: 'DM Sans, sans-serif',
      heading: 'GT Super Display',
    },
    fontSize: {
      'fs-12': ['12px', { lineHeight: '19.5px' }],
      'fs-13': ['13px', { lineHeight: '22px' }],
      base: ['16px', { lineHeight: '1.375' }],
      'fs-18': ['18px', { lineHeight: '24px' }],
      'fs-20': ['20px', { lineHeight: '26px' }],
      'fs-22': ['22px', { lineHeight: '28.64px' }],
      'fs-26': ['26px', { lineHeight: '36px' }],
      'fs-30': ['30px', { lineHeight: '34px' }],
      'fs-31': ['31px', { lineHeight: '42px' }],
      'fs-32': ['32px', { lineHeight: '38px' }],
      'fs-34': ['34px', { lineHeight: '1' }],
      'fs-36': ['36px', { lineHeight: '46px' }],
      'fs-44': ['44px', { lineHeight: '1' }],
      'fs-45': ['45px', { lineHeight: '52.06px' }],
      'fs-48': ['48px', { lineHeight: '55.54px' }],
      'fs-54': ['54px', { lineHeight: '1' }],
      '6xl': ['60px', { lineHeight: '1.2' }, { letterSpacing: '-1.2px'}],
    },
    screens: {
      sm: '640px',
      'md-max': { max: '767px' },
      md: '768px',
      'lg-max': { max: '1199px' },
      lg: '1200px',
      xl: '1280px',
      '2xl': '1440px',
      '3xl': '1600px',
      '4xl': '2000px',
    },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      'white': '#ffffff',
      'white-8': 'rgba(255, 255, 255, 0.08)',
      'black': '#000000',
      'black-2': '#0D0D15',
      'dark-gray': '#DBD8D8',
      'gray': '#EBEBEB',
      'gray-2': '#ECE8E1',
      'cinder': '#0D0D15',
      'green': '#162E26',
      'green-hover': '#032D48',
      'error': '#C61D1D'
    },
    extend: {
      backgroundImage: {
        'gradient-header': 'linear-gradient(180deg, rgba(0, 0, 0, 0.40) 28.24%, rgba(0, 0, 0, 0.00) 100%)'
      },
    }
  },
  plugins: []
}
