function getFormattedDate(date) {
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
    return year + '-' + months[monthIndex] + '-' + (day < 10 ? '0' : '') + day;
}

function updateTime() {
    var currentDate = new Date();
    var dateElement = document.getElementById("date");
    var timeElement = document.getElementById("time");

    // Get the formatted date
    var formattedDate = getFormattedDate(currentDate);

    // Update the date and time elements
    dateElement.innerHTML = formattedDate;
    timeElement.innerHTML = currentDate.toLocaleTimeString();
}

// Update time every second
setInterval(updateTime, 100);

function search() {
    let searchTerm = $('#searchInput').val();
    
    $.ajax({
        url: 'search.php',
        type: 'POST',
        data: { searchTerm: searchTerm },
        success: function(response) {
            $('#resultsBody').html(response);
        }
    });
}

function submitForm() {
    setTimeout(function() {
        document.getElementById("myForm").submit();
    }, 4000); // 5000 milliseconds = 5 seconds
}

// Call the submitForm function when the page loads
window.onload = submitForm;

// Get elements
const popupButton = document.getElementById('popupButton');
const popup = document.getElementById('popup');
const closeBtn = document.querySelector('.close');
const cancelButton = document.getElementById('cancelButton');
const okButton = document.getElementById('okButton');

// Open the popup when the button is clicked
popupButton.addEventListener('click', function(event) {
    event.preventDefault();
    popup.style.display = 'block';
});

// Close the popup when the 'x' button is clicked
closeBtn.addEventListener('click', function() {
    popup.style.display = 'none';
});

// Close the popup when the 'Cancel' button is clicked
cancelButton.addEventListener('click', function() {
    popup.style.display = 'none';
});

// Handle the 'OK' button click
okButton.addEventListener('click', function() {
    popup.style.display = 'none';
});


// No Product Found
function showNoProductPopup() {
    const popupOverlay = document.getElementById('popup-overlay-custom');
    popupOverlay.style.display = 'flex';
}

function closePopup() {
    const popupOverlay = document.getElementById('popup-overlay-custom');
    popupOverlay.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
    const noProductTrigger = document.getElementById('no-product-popup-trigger');
    if (noProductTrigger) {
        showNoProductPopup();
        // Remove the trigger element after showing the popup to reset state
        noProductTrigger.parentNode.removeChild(noProductTrigger);
    }
});

let currentIndex = -1;
const rows = document.querySelectorAll(".products tbody tr");

// Automatically highlight the first row if it exists
if (rows.length > 0) {
    currentIndex = 0;
    rows[currentIndex].classList.add("row-highlight");
}

document.getElementById("box2").addEventListener("click", () => {
    if (currentIndex < rows.length - 1) {
        if (currentIndex >= 0) {
            rows[currentIndex].classList.remove("row-highlight");
        }
        currentIndex++;
        rows[currentIndex].classList.add("row-highlight");
    }
});

document.getElementById("box1").addEventListener("click", () => {
    if (currentIndex > 0) {
        rows[currentIndex].classList.remove("row-highlight");
        currentIndex--;
        rows[currentIndex].classList.add("row-highlight");
    }
});

function highlightUp() {
    let table = document.getElementById('myTable');
    let rows = table.getElementsByTagName('tr');
    let highlightedRow = table.querySelector('.rows-highlight');
    if (highlightedRow) {
        highlightedRow.classList.remove('rows-highlight');
        if (highlightedRow.previousElementSibling) {
            highlightedRow.previousElementSibling.classList.add('rows-highlight');
        } else {
            rows[rows.length - 1].classList.add('rows-highlight'); // Wrap to the last row
        }
    } else {
        rows[1].classList.add('rows-highlight');
    }
}

function highlightDown() {
    let table = document.getElementById('myTable');
    let rows = table.getElementsByTagName('tr');
    let highlightedRow = table.querySelector('.rows-highlight');
    if (highlightedRow) {
        highlightedRow.classList.remove('rows-highlight');
        if (highlightedRow.nextElementSibling) {
            highlightedRow.nextElementSibling.classList.add('rows-highlight');
        } else {
            rows[1].classList.add('rows-highlight'); // Wrap to the first row
        }
    } else {
        rows[1].classList.add('rows-highlight');
    }
}


// Terminal Reading Popup
