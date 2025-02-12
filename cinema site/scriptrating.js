const stars = document.querySelectorAll('.star');
const reviewContainer = document.querySelector('.review-container');
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
    reviewContainer.style.display = 'block';
  });
});

reviewForm.addEventListener('submit', event => {
  event.preventDefault();
  const reviewInput = document.querySelector('#review-input').value;
  console.log(`Rating: ${rating}, Review: ${reviewInput}`);
  // Send rating and review to server here
});
