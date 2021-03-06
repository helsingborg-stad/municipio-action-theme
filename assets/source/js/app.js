
import anime from 'animejs/lib/anime.es.js';
import dropdownComponents from './dropdown';
import megaMenu from './megamenu'; 
import newsReel from './newsreel'; 

const codeElements = document.querySelectorAll('section.section .grid [class*="grid-"], .box.box-panel ul li, .post-type-archive .breadcrumbs-wrapper + .grid .grid--columns > [class*="grid-"], .main-footer .widget_text, .main-footer .logotype, .main-footer .widget_nav_menu, .slider .slider-image > span');

const observerConfig = {
    threshold: 0.2,
    rootMargin: '40px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            anime({
                targets: entry.target,
                translateY: ['-20px','0'],	
                easing: 'spring(1, 80, 10, 0)', 
                delay: 150
            });
        }
    });
}, observerConfig);

codeElements.forEach(codeElement => {
    //observer.observe(codeElement);
});

anime({
  targets: '.home .logotype .letter',
  opacity: [0,1],
  delay: anime.stagger(150, {start: 0})
});

let brickTitle = document.querySelectorAll(".home .box.box-post-brick .post-title");
if(brickTitle.length > 0 ){
    window.fitText( brickTitle, .9, {
        minFontSize: '30px',
        maxFontSize: '50px'
    });
}


$( document ).ready(function() {
    $('.section-text').filter(function() {
        var text = $(this).text().replace(/\s*/g, '');
        return !text;
    }).hide();
}); 

window.addEventListener('DOMContentLoaded', function(event) {
    // dropdownComponents();
    megaMenu(); 
    newsReel(); 
});
