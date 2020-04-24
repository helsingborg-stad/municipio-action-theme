var ActionHbg;
import anime from 'animejs/lib/anime.es.js';

/* Sections */ 
const codeElements = document.querySelectorAll('section.section .grid');

const observerConfig = {
    threshold: 0.2
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.intersectionRatio > observerConfig.threshold) {
            anime({
                targets: entry.target,
                opacity: [0,1],
                translateY: ['20px','0px'],
                easing: 'spring(1, 80, 10, 0)',
                delay: 400
            });
        } else {
            anime({
                targets: entry.target,
                opacity: [1,0],
                translateY: ['0','20px'],
                easing: 'spring(1, 80, 10, 0)',
                delay: 400
            });
        }
    });
}, observerConfig);

codeElements.forEach(codeElement => {
    observer.observe(codeElement);
});

/* Menu */
anime({
  targets: '.home .site-header',
  opacity: [0,1],
  delay: 400,
  easing: 'spring(1, 80, 10, 0)'
});