//automatic-scroll up button
//when window goes below 200 pixels on y axis, scroll back to top with smooth animation

document.addEventListener('DOMContentLoaded', () => {
    const upBtn = document.querySelector('.up-btn');

    const onScroll = () => {
        upBtn.style.display = window.scrollY > 200 ? 'block' : 'none';
    };

    window.addEventListener('scroll', onScroll);
    onScroll();

    upBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});

//makes navbar sticky when user scrolls down

document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('.navbar');

    window.addEventListener('scroll', () => {
        header.classList.toggle('sticky', window.scrollY > 0);
    });
});

