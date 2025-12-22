document.querySelectorAll('.learn_more').forEach(btn => {
  btn.addEventListener('mouseenter', e => {
    const span = btn.querySelector('span');
    const rect = btn.getBoundingClientRect();

    span.style.left = `${e.clientX - rect.left}px`;
    span.style.top  = `${e.clientY - rect.top}px`;
  });
});