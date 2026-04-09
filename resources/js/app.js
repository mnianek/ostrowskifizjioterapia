import './bootstrap';

import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm.js';
import { onCLS, onINP, onLCP } from 'web-vitals';

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

const pendingVitals = [];
let vitalsFlushTimer = null;
const webVitalsEndpoint = '/web-vitals';
const webVitalsSessionToken =
    window.localStorage.getItem('webVitalsSessionToken') ||
    `${Date.now().toString(36)}-${Math.random().toString(36).slice(2, 10)}`;

window.localStorage.setItem('webVitalsSessionToken', webVitalsSessionToken);

function flushWebVitals() {
    if (pendingVitals.length === 0) {
        return;
    }

    const payload = {
        path: `${window.location.pathname}${window.location.search}`,
        session_token: webVitalsSessionToken,
        metrics: pendingVitals.splice(0, pendingVitals.length),
    };

    const body = JSON.stringify(payload);

    if (navigator.sendBeacon) {
        const blob = new Blob([body], { type: 'application/json' });
        navigator.sendBeacon(webVitalsEndpoint, blob);

        return;
    }

    fetch(webVitalsEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        keepalive: true,
        body,
    }).catch(() => {
        // Silently ignore telemetry delivery failures.
    });
}

function scheduleWebVitalsFlush() {
    if (vitalsFlushTimer !== null) {
        window.clearTimeout(vitalsFlushTimer);
    }

    vitalsFlushTimer = window.setTimeout(() => {
        flushWebVitals();
        vitalsFlushTimer = null;
    }, 2500);
}

function queueWebVital(metric) {
    pendingVitals.push({
        name: metric.name,
        value: Number(metric.value ?? 0),
        rating: metric.rating ?? null,
    });

    scheduleWebVitalsFlush();
}

onCLS(queueWebVital, { reportAllChanges: true });
onLCP(queueWebVital, { reportAllChanges: true });
onINP(queueWebVital, { reportAllChanges: true });

document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'hidden') {
        flushWebVitals();
    }
});
