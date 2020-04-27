var ActionHbg;
import anime from 'animejs/lib/anime.es.js';

/* Sections */ 
const codeElements = document.querySelectorAll('section.section .grid [class*="grid-"], .box.box-panel ul li, .post-type-archive .breadcrumbs-wrapper + .grid .grid--columns > [class*="grid-"], .main-footer .widget_text, .main-footer .logotype, .main-footer .widget_nav_menu');

const observerConfig = {
    threshold: 0.
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.intersectionRatio > observerConfig.threshold) {
            anime({
                targets: entry.target,
                opacity: [0,1],
                translateY: ['20px','0px'],
                easing: 'spring(1, 80, 10, 0)',
                delay: 150
            });
        } else {
            anime({
                targets: entry.target,
                opacity: [1,0],
                translateY: ['0','20px'],
                easing: 'spring(1, 80, 10, 0)',
                delay: 150
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

anime({
  targets: '.home .logotype .letter',
  opacity: [0,1],
  delay: anime.stagger(150, {start: 0}),
  easing: 'spring(1, 80, 10, 0)'
});



