const container = document.querySelector('.container');
const seats = document.querySelectorAll('.row .seat:not(.Occupied');
const count = document.getElementById('count');
const total = document.getElementById('total');
const movieSelect = document.getElementById('movie');
const payNowButton = document.getElementById('pay-now');

//populateUI();
let ticketPrice = +movieSelect.value;


// Save selected movie index and price
function setMovieData(movieIndex, moviePrice) {
  localStorage.setItem('selectedMovieIndex', movieIndex);
  localStorage.setItem('selectedMoviePrice', moviePrice);
}

// update total and count
function updateSelectedCount() {
  const selectedSeats = document.querySelectorAll('.row .seat.Selected');

  const seatsIndex = [...selectedSeats].map((seat) => [...seats].indexOf(seat));

  localStorage.setItem('selectedSeats', JSON.stringify(seatsIndex));

  //copy selected seats into arr
  // map through array
  //return new array of indexes

  const selectedSeatsCount = selectedSeats.length;

  count.innerText = selectedSeatsCount;
  total.innerText = selectedSeatsCount * ticketPrice;
}

// get data from localstorage and populate ui
function populateUI() {
  const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats'));
  if (selectedSeats !== null && selectedSeats.length > 0) {
    seats.forEach((seat, index) => {
      if (selectedSeats.indexOf(index) > -1) {
        seat.classList.add('selected');
      }
    });
  }

  const selectedMovieIndex = localStorage.getItem('selectedMovieIndex');

  if (selectedMovieIndex !== null) {
    movieSelect.selectedIndex = selectedMovieIndex;
  }
}

// Movie select event
movieSelect.addEventListener('change', (e) => {
  ticketPrice = +e.target.value;
  //setMovieData(e.target.selectedIndex, e.target.value);
  updateSelectedCount();
});

// Seat click event
container.addEventListener('click', (e) => {
  if (e.target.classList.contains('seat') && !e.target.classList.contains('Occupied')) {
    e.target.classList.toggle('Selected');

    updateSelectedCount();
  }
});

payNowButton.addEventListener('click', () => {
  checkSelectedSeat();
});

// Function to check if a seat has been selected
function checkSelectedSeat() {
  const selectedSeats = document.querySelectorAll('.row .seat.Selected');
  if (selectedSeats.length === 0) {
    alert('Please select a seat before proceeding to payment.');
  }  
  else{
    window.location.href = "payment_page.html"
  }
}

// intial count and total
updateSelectedCount();



