/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{php,js,html}","./cssjs/*.{js.php}","./lib/*.{php,html}","./pages/*.{php,html}"],
  darkMode: 'class',
  theme: {
    extend: {
      aspectRatio: {
        '5/3': '5 / 3',
        '4/3': '4 / 3',
        '3/2': '3 / 2',
      },
    },
    zIndex: {
      '0': 0,
      '10': 10,
      '20': 20,
      '30': 30,
      '40': 40,
      '50': 50,
      '60': 60,
      '70': 70,
      '80': 80,
      '90': 90,
       'auto': 'auto',
    },
  },
  plugins: [],
  safelist: [
    'block',
    'sm:block',
    'md:block',
    'xl:block',
    '2xl:block',
    'hidden',
    'sm:hidden',
    'md:hidden',
    'xl:hidden',
    '2xl:hidden',
    {
      pattern: /grid-cols-(1|2|3|4|5|6|7|8|9|10|11|12)/,
      variants: ['sm','md', 'lg', 'xl', '2xl'],
    },
  ],
}
