import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                white: '#ffffff',
                greenBlue: '#2364aa',
                pictonBlue: '#3DA5D9',
                verdigris: '#73BFB8',
                yellow: '#FEC601',
                pumpkin: '#ea7317',

                hoverPumpkin: '#d96e16',

                contrastPumpkin: '#178eea',

                validationRed: '#D22B2B',
            }
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/forms'),
    ],
};
