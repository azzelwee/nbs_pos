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

document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('popup');
    const quantityInput = document.getElementById('quantityInput');
    let currentRowIndex;

    document.querySelectorAll('.editQuantityButton').forEach((button, index) => {
        button.addEventListener('click', () => {
            currentRowIndex = index;
            popup.style.display = 'block';
        });
    });

    document.querySelector('.close').addEventListener('click', () => {
        popup.style.display = 'none';
    });

    document.getElementById('cancelButton').addEventListener('click', () => {
        popup.style.display = 'none';
    });

    document.getElementById('okButton').addEventListener('click', () => {
        const newQuantity = quantityInput.value;
        const ln = document.querySelectorAll('tbody tr')[currentRowIndex].dataset.ln;

        // Send the updated quantity to the server via AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_quantity.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Update the displayed quantity
                document.querySelectorAll('tbody tr')[currentRowIndex].querySelector('.qty').textContent = newQuantity;
                popup.style.display = 'none';
            }
        };
        xhr.send(`ln=${ln}&qty=${newQuantity}`);
    });
});