import './bootstrap';

import Alpine from 'alpinejs';
import iconPicker from './icon-picker';

window.Alpine = Alpine;
Alpine.data('iconPicker', iconPicker);

Alpine.start();

const themeToggleButtons = document.querySelectorAll('[data-theme-toggle]');

const updateThemeToggleButtons = (isDark) => {
    themeToggleButtons.forEach((button) => {
        const label = isDark ? 'Attiva modalità chiara' : 'Attiva modalità scura';
        button.setAttribute('aria-pressed', String(isDark));
        button.setAttribute('aria-label', label);
        button.setAttribute('title', label);
    });
};

updateThemeToggleButtons(document.documentElement.classList.contains('dark'));

themeToggleButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const isDark = document.documentElement.classList.toggle('dark');
        document.documentElement.dataset.bsTheme = isDark ? 'dark' : 'light';
        try {
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        } catch {
            // Il cambio tema funziona anche senza persistenza.
        }
        updateThemeToggleButtons(isDark);
    });
});
