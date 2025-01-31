// carousel.js
let currentIndex = 0;
const items = document.querySelectorAll('.carousel-item');

function moveCarousel(step) {
    items[currentIndex].classList.remove('active');
    currentIndex = (currentIndex + step + items.length) % items.length;
    items[currentIndex].classList.add('active');
}
