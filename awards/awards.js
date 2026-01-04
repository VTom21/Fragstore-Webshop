


document.querySelectorAll('.learn_more').forEach(btn => {
    btn.addEventListener('mouseenter', e => {
        const span = btn.querySelector('span');
        const rect = btn.getBoundingClientRect();

        span.style.left = `${e.clientX - rect.left}px`;
        span.style.top = `${e.clientY - rect.top}px`;
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


    const tl3 = gsap.timeline();



    tl3.from(".navbar div a", {
        y: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out"
    });

    tl3.from(".hero-title", {
        y: -30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out"
    });

    tl3.from(".hero-subtitle", {
        x: -30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out"
    });

    tl3.from(".buttons a", {
        y: 30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out"
    });


    tl3.from(".arrow_svg", {
        opacity: 0,
        duration: 0.6,
        ease: "power2.out"
    });

    tl3.from(".popup_bar", {
        y: 30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out"
    });

    gsap.from(".game_of_the_year", {
        x: -30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".goty_div",
            start: "top 75%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".goty", {
        x: -30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".game_of_the_year",
            start: "top 75%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".promo", {
        x: -30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".goty",
            start: "top 75%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".featured_winners", {
        y: 30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".promo",
            start: "top 75%",
            toggleActions: "play none none none",
            markers: false,
        }
    });


    gsap.from("#about .container .text", {
        y: 30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".about-section",
            start: "top 75%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".img1", {
        x: -30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".about-section",
            start: "top 75%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from("#mission .container .text", {
        y: 30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".mission-section",
            start: "top 75%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".img2", {
        x: 30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".mission-section",
            start: "top 75%",
            toggleActions: "play none none none",
            markers: false,
        }
    });


    gsap.from(".timeline-header h2", {
        y: 30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".timeline-section",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".timeline-header p", {
        y: 30,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".timeline-section",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".timeline-item", {
        y: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".timeline-section",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from("#why_us", {
        x: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".awards-section",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from("#award-card1", {
        x: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".awards-section",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.to("#award-card1", {
        x: 0,
    });

    gsap.from("#featured_winners h2", {
        y: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: "#featured_winners",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".letters .abc-btn", {
        y: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".letters",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".award-card2", {
        y: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".cards_div",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".experience_div h2", {
        y: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".experience_div",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".video_div div", {
        y: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".video_div",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });


    gsap.from(".trusted", {
        y: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".companies",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".trusted_text", {
        y: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".companies",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    gsap.from(".logos img", {
        y: -30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: "power2.out",
        delay: 0.3,
        scrollTrigger: {
            trigger: ".companies",
            start: "top 65%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

        gsap.from(".footer_div", {
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.3,
        scale: 0.5,
        scrollTrigger: {
            trigger: ".footer",
            start: "top 85%",
            toggleActions: "play none none none",
            markers: false,
        }
    });

    tl.to(".grid1", {
        x: -4500,
        ease: "none",
        duration: 1
    });

    tl.to(".grid2", {
        x: -4830,
        ease: "none",
        duration: 1
    });

});


