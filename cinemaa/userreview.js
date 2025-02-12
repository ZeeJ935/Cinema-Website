const stars = document.querySelectorAll('.star');
const reviewForm = document.querySelector('#review-form');

let rating = 0;

stars.forEach((star, index) => {
  star.addEventListener('click', () => {
    rating = index + 1;
    for (let i = 0; i < rating; i++) {
      stars[i].classList.add('selected');
    }
    for (let i = rating; i < stars.length; i++) {
      stars[i].classList.remove('selected');
    }
  });
});
