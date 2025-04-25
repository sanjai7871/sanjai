const container = document.getElementById('scrollContainer');

container.addEventListener('wheel', (e) => {
  if (Math.abs(e.deltaX) > Math.abs(e.deltaY)) {
    // user scrolled horizontally
    e.preventDefault();
    container.scrollTop += e.deltaX;
  }
});
