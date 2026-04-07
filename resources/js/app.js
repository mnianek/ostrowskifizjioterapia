import './bootstrap';

import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm.js';

window.Alpine = Alpine;
window.Livewire = Livewire;

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

Livewire.start();
