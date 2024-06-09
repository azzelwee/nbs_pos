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
