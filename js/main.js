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