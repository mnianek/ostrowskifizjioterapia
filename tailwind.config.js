import defaultTheme from 'tailwindcss/defaultTheme';

export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './storage/framework/views/*.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                heading: ['Space Grotesk', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#eef4ff',
                    100: '#dbe7ff',
                    200: '#c3d6ff',
                    300: '#9dbbff',
                    400: '#7095ff',
                    500: '#446ef1',
                    600: '#1e40af',
                    700: '#19378f',
                    800: '#172f75',
                    900: '#162c5f',
                },
                secondary: {
                    500: '#0ea5a4',
                },
                accent: {
                    500: '#f59e0b',
                },
            },
            boxShadow: {
                glow: '0 12px 45px -20px rgba(30, 64, 175, 0.55)',
            },
            keyframes: {
                'fade-in-up': {
                    '0%': { opacity: 0, transform: 'translateY(16px)' },
                    '100%': { opacity: 1, transform: 'translateY(0)' },
                },
            },
            animation: {
                'fade-in-up': 'fade-in-up 0.5s ease-out both',
            },
        },
    },
};
