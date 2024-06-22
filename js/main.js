window.onload = function() {
    document.body.style.zoom = "85%";
};


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

    function closePopups() {
        // Find the closest parent element that represents the popup and hide or remove it
        var popup = document.querySelector('.message-warning');
        if (popup) {
            popup.style.display = 'none'; // or remove() if you want to completely remove it from the DOM
        }
    }

document.addEventListener('DOMContentLoaded', (event) => {
    var popupButton = document.getElementById('popupButton');
    var popup = document.getElementById('popup');
    var close = document.getElementsByClassName('close')[0];
    var okButton = document.getElementById('okButton');
    var cancelButton = document.getElementById('cancelButton');
    var quantityInput = document.getElementById('quantityInput');
    var quantityHidden = document.getElementById('quantityHidden');
    var searchForm = document.querySelector('form[action="posResult.php"]');

    popupButton.onclick = function() {
        popup.style.display = "block";
    }

    close.onclick = function() {
        popup.style.display = "none";
    }

    cancelButton.onclick = function() {
        popup.style.display = "none";
    }

    okButton.onclick = function() {
        quantityHidden.value = quantityInput.value || 1; // Set quantityHidden to input value or default to 1
        popup.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == popup) {
            popup.style.display = "none";
        }
    }

    searchForm.onsubmit = function() {
        if (!quantityHidden.value) {
            quantityHidden.value = 1; // Default quantity if not set
        }
    }
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
const rows = document.querySelectorAll(".products tbody tr, .products2 tbody tr");



// Automatically highlight the first row if it exists
if (rows.length > 0) {
    currentIndex = 0;
    rows[currentIndex].classList.add("row-highlight");
}

// Define a function to handle the keydown event
// Function to handle row highlighting
function highlightRow(direction) {
    if (direction === 'prev' && currentIndex > 0) {
        rows[currentIndex].classList.remove("row-highlight");
        currentIndex--;
        rows[currentIndex].classList.add("row-highlight");
    } else if (direction === 'next' && currentIndex < rows.length - 1) {
        if (currentIndex >= 0) {
            rows[currentIndex].classList.remove("row-highlight");
        }
        currentIndex++;
        rows[currentIndex].classList.add("row-highlight");
    }
}

// Click event listeners for box1 and box2
document.getElementById("box1").addEventListener("click", () => {
    highlightRow('prev');
});

document.getElementById("box2").addEventListener("click", () => {
    highlightRow('next');
});






