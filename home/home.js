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

    const header = document.getElementById('header');

    window.addEventListener('scroll', () => {
        header.classList.toggle('sticky', window.scrollY > 0);
    });
});

