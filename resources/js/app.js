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

let scrollRevealObserver = null;

function initScrollReveal() {
    if (scrollRevealObserver) {
        scrollRevealObserver.disconnect();
    }

    scrollRevealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('reveal-in');

                const once = entry.target.getAttribute('data-reveal-once') === 'true';

                if (once && scrollRevealObserver) {
                    scrollRevealObserver.unobserve(entry.target);
                }
            });
        },
        {
            root: null,
            rootMargin: '0px 0px -6% 0px',
            threshold: 0.08,
        },
    );

    document.querySelectorAll('[data-reveal]').forEach((element) => {
        if (!element.classList.contains('reveal-in')) {
            scrollRevealObserver.observe(element);
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initScrollReveal();
});

document.addEventListener('livewire:navigated', () => {
    initScrollReveal();
});
