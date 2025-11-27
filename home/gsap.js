



window.addEventListener("load", function () {

gsap.registerPlugin(ScrollTrigger);
var timeline = gsap.timeline();

timeline.from(".navbar a", {
    y: -30,
    opacity: 0,
    duration: 0.6,
    stagger: 0.15,
    ease: "power2.out"
});

timeline.from("#stuff div", {
    y: -30,
    opacity: 0,
    duration: 0.6,
    stagger: 0.15,
    ease: "power2.out"
});

timeline.from(".selected-lang", {
    x: -30,
    opacity: 0,
    duration: 0.6,
    stagger: 0.15,
    ease: "power2.out"
});


timeline.from(".hero_heading", {
    y: 100,
    opacity: 0,
    duration: 0.8,
    ease: "power3.out"
});

timeline.from(".hero-content p", {
    x: -100,
    opacity: 0,
    duration: 0.8,
    ease: "power3.out"
});

timeline.from(".cta-buttons a", {
    y: -30,
    opacity: 0,
    duration: 0.6,
    stagger: 0.15,
    ease: "power2.out"
});


  
gsap.from(".intro-content1", {
    x: 150,
    opacity: 0,
    duration: 1,
    rotation:25,
    scrollTrigger: {
        trigger: ".intro-content1",
        start: "top 75%",
        toggleActions: "play none none none",
        markers: false,
    }
});

gsap.from(".intro-content2", {
    x: -150,
    opacity: 0,
    duration: 1,
    rotation:25,
    scrollTrigger: {
        trigger: ".intro-content2",
        start: "top 75%",
        toggleActions: "play none none none",
        markers: false
    }
});

gsap.from(".intro-content3", {
    x: 150,
    opacity: 0,
    duration: 1,
    rotation:25,
    scrollTrigger: {
        trigger: ".intro-content3",
        start: "top 75%",
        toggleActions: "play none none none",
        markers: false
    }
});

gsap.from(".customers_title", {
    y: 100,
    opacity: 0,
    duration: 0.8,
    ease: "power3.out",
    scrollTrigger: {
    trigger: ".customers_title",
    start: "top 70%",
  }
});


gsap.from(".section-desc", {
    y: 100,
    opacity: 0,
    duration: 0.8,
    ease: "power3.out",
     scrollTrigger: {
    trigger: ".section-desc",
    start: "top 70%",
  }
});

gsap.from(".testimonial-grid", {
  y: 20,
  opacity: 0,
  duration: 0.6,
  stagger: 0.2,
    scrollTrigger: {
    trigger: ".testimonial-grid",
    start: "top 70%",
  }
});

gsap.from(".section-title", {
    x: -30,
    opacity: 0,
    duration: 0.6,
    stagger: 0.15,
    ease: "power2.out",
    scrollTrigger: {
    trigger: ".section-title",
    start: "top 70%",
  }
});

gsap.from(".gift-card-wrapper", {
    y: -30,
    opacity: 0,
    duration: 0.6,
    stagger: 0.15,
    ease: "power2.out",
    scrollTrigger: {
    trigger: ".gift-card-wrapper",
    start: "top 70%",
  }
});





});
  







