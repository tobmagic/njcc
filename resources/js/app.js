import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// resources/js/app.js

document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // When the element scrolls into view, add the 'visible' class
                entry.target.classList.add('visible');
                // Stop observing this element once it's revealed
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    // Select all elements with the .reveal class
    const revealElements = document.querySelectorAll('.reveal');
    revealElements.forEach((el) => observer.observe(el));
});