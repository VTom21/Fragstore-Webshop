


document.querySelectorAll('.learn_more').forEach(btn => {
  btn.addEventListener('mouseenter', e => {
    const span = btn.querySelector('span');
    const rect = btn.getBoundingClientRect();

    span.style.left = `${e.clientX - rect.left}px`;
    span.style.top  = `${e.clientY - rect.top}px`;
  });
});


document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.abc-btn');
    const cards = document.querySelectorAll('.award-card');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.getAttribute('data-filter');


            cards.forEach(card => {
                if (card.hasAttribute('data-letter')) {
                    const letter = card.getAttribute('data-letter').toUpperCase();
                    
                    if (letter !== '') {
                        if (filter === 'all' || letter === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    } else {

                        card.style.display = filter === 'all' ? 'block' : 'none';
                    }
                }
            });
        });
    });
    

    const allButton = document.querySelector('.abc-btn[data-filter="all"]');
    allButton.click();
    
});

gsap.registerPlugin(ScrollTrigger);


const tl = gsap.timeline({
    scrollTrigger: {
        trigger: ".developers-section",
        start: "top top",
        end: "+=6400",  
        scrub: 1,
        pin: true,
    }
})  

tl.to(".grid1", {
    x: -4500,
    ease:"none",
    duration:1
});

tl.to(".grid2", {
    x: -4830,
    ease:"none",
    duration:1
});





