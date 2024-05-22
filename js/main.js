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

document.addEventListener('DOMContentLoaded', (event) => {
    const popupButton = document.getElementById('popupButton');
    const popup = document.getElementById('popup');
    const closeButton = document.querySelector('.close');
    const submitButton = document.getElementById('submit');

    popupButton.addEventListener('click', function(event) {
        event.preventDefault();
        popup.style.display = 'flex';
    });

    closeButton.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    submitButton.addEventListener('click', function() {
        const quantity = document.getElementById('quantityInput').value;
        console.log('Quantity entered:', quantity);
        popup.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });
});


