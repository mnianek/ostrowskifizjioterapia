import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('themeController', () => ({
    darkMode: false,

    init() {
        const storedTheme = localStorage.getItem('theme');

        if (storedTheme) {
            this.darkMode = storedTheme === 'dark';
        } else {
            this.darkMode = document.documentElement.classList.contains('dark');
        }

        this.applyTheme();
    },

    toggle() {
        this.darkMode = !this.darkMode;
        this.applyTheme();
    },

    applyTheme() {
        document.documentElement.classList.toggle('dark', this.darkMode);
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
    },
}));

Alpine.start();
