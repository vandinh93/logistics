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
      arial: 'Arial',
      body: 'DM Sans, sans-serif',
      heading: 'GT Super Display',
    },
    fontSize: {
      'fs-0': ['0', { lineHeight: '0' }],
      'fs-12-12': ['12px', { lineHeight: '12px' }],
      'fs-12': ['12px', { lineHeight: '19.5px' }],
      'fs-13': ['13px', { lineHeight: '22px' }],
      'fs-14': ['14px', { lineHeight: '20px' }],
      base: ['16px', { lineHeight: '1.375' }],
      'fs-18': ['18px', { lineHeight: '24px' }],
      'fs-20': ['20px', { lineHeight: '26px' }],
      'fs-22': ['22px', { lineHeight: '28.64px' }],
      'fs-24': ['24px', { lineHeight: '32px' }],
      'fs-25': ['25px', { lineHeight: '1' }],
      'fs-26': ['26px', { lineHeight: '36px' }],
      'fs-30': ['30px', { lineHeight: '34px' }],
      'fs-31': ['31px', { lineHeight: '42px' }],
      'fs-32': ['32px', { lineHeight: '38px' }],
      'fs-34': ['34px', { lineHeight: '1' }],
      'fs-36': ['36px', { lineHeight: '46px' }],
      'fs-44': ['44px', { lineHeight: '1' }],
      'fs-45': ['45px', { lineHeight: '52.06px' }],
      'fs-48': ['48px', { lineHeight: '55.54px' }],
      'fs-55': ['55px', { lineHeight: '1' }],
      '6xl': ['60px', { lineHeight: '1.2' }, { letterSpacing: '-1.2px'}],
    },
    screens: {
      sm: '640px',
      md: '768px',
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
      'black': '#000000',
      'yellow': '#fc9509',
      'orange': '#F68C3E',
      'gray': '#f5f6f7',
      'blue': '#068ac5',
      'light-blue': '#cce4ff',
      'green': '#155724',
      'green-2': '#28a745',
      'error': '#C61D1D'
    },
    extend: {
      borderRadius: {
        none: 0,
        '100': '100px'
      },
    }
  },
  plugins: []
}
