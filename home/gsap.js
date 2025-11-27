var timeline = gsap.timeline();
gsap.registerPlugin(ScrollTrigger);


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

var timeline = gsap.timeline({
    scrollTrigger: {
      trigger: ".intro_heading",
      start: "top 80%",
      toggleActions: "play none none none",
    }
  });
  
  timeline.from(".intro-content1", {
      x: 150,
      opacity: 0,
      duration: 1,
  });
  
  timeline.from(".intro-content2", {
      x: -150,
      opacity: 0,
      duration: 1,
  });

  timeline.from(".intro-content3", {
    x: 150,
    opacity: 0,
    duration: 1,
});
  







