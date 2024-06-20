import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        'bg-blue-200',
        'bg-green-200',
        'bg-orange-200',
        'bg-yellow-200',
        'bg-red-200',
        'align-text-bottom',
        'w-12',
        'mt-12',
        'top-1/2',
        '-translate-y-1/2',
        'left-1/2',
        '-translate-x-1/2',
        'top-2.5',
        'right-2.5'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
