const ticketTypeSelect = document.getElementById("movie");
const silverSeats = document.querySelectorAll(".seat-row.Silver input[type='checkbox']:not(:disabled)");
const goldSeats = document.querySelectorAll(".seat-row.Gold input[type='checkbox']:not(:disabled)");
const platinumSeats = document.querySelectorAll(".seat-row.Platinum input[type='checkbox']:not(:disabled)");
const seats = document.querySelectorAll(".seat-row input[type='checkbox']");
const count = document.getElementById("count");
const total = document.getElementById("total");

let selectedSeats = [];

function updateSelectedCount() {
    selectedSeats = document.querySelectorAll(".seat-row input[type='checkbox']:checked");
    count.innerText = selectedSeats.length;
  
    let totalPrice = 0;
    selectedOption = ticketTypeSelect.value;
    selectedOptionArr = selectedOption.split("|");
    selectedOptionName = selectedOptionArr[0];
    selectedOptionPrice = parseInt(selectedOptionArr[1]);
  
  }
  
  ticketTypeSelect.addEventListener("change", function() {
    const selectedOption = this.value;
    
    if (selectedOption === "Silver|800") {
      disableSeats(goldSeats);
      disableSeats(platinumSeats);
      enableSeats(silverSeats);
    } else if (selectedOption === "Gold|1500") {
      disableSeats(silverSeats);
      disableSeats(platinumSeats);
      enableSeats(goldSeats);
    } else if (selectedOption === "Platinum|2200") {
      disableSeats(silverSeats);
      disableSeats(goldSeats);
      enableSeats(platinumSeats);
    }
  // Reset selected seats
  for (let i = 0; i < selectedSeats.length; i++) {
    selectedSeats[i].checked = false;
    selectedSeats[i].parentNode.classList.remove("selected");
  }
  selectedSeats = [];
  count.innerText = "0";

  updateSelectedCount();
});

function disableSeats(seats) {
  for (let i = 0; i < seats.length; i++) {
    seats[i].disabled = true;
    seats[i].parentNode.classList.add("disabled");
    seats[i].parentNode.style.backgroundColor = "#668E86";
  }
  
}

function enableSeats(seats) {
    for (let i = 0; i < seats.length; i++) {
      seats[i].disabled = false;
      seats[i].parentNode.classList.remove("disabled");
      seats[i].addEventListener("change", function() {
          if (this.checked) {
            this.parentNode.style.backgroundColor = "#DACAC9";
          } else {
            this.parentNode.style.backgroundColor = "#151515";
          }});
    }
  }

for (let i = 0; i < seats.length; i++) {
  seats[i].addEventListener("change", function() {
    updateSelectedCount();
  });
}