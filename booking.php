<?php
// booking.php - Handles the booking functionality for Martini Glamping Park
session_start();
require '../config.php'; // Include database connection

// Display booking form with Ajax functionality
$packages = $conn->query("SELECT * FROM Services");
?>

<h1>Book Your Stay</h1>
<form id="bookingForm">
    <label for="package_id">Select Package:</label>
    <select name="package_id" id="package_id" required>
        <?php while ($row = $packages->fetch_assoc()) { ?>
            <option value="<?php echo $row['service_id']; ?>" 
                    data-weekend-price="<?php echo $row['weekend_price']; ?>"
                    data-weekday-price="<?php echo $row['weekday_price']; ?>">
                <?php echo $row['name']; ?>
            </option>
        <?php } ?>
    </select>

    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" required />

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date" required />

    <label for="num_adults">Number of Adults:</label>
    <input type="number" name="num_adults" id="num_adults" min="1" max="6" required />

    <p id="priceDisplay">Price: </p>

    <button type="submit">Book Now</button>
</form>

<div id="responseMessage"></div>

<script>
// JavaScript for real-time price updates and Ajax form submission

// Update price dynamically based on package and date
const packageSelect = document.getElementById('package_id');
const startDateInput = document.getElementById('start_date');
const priceDisplay = document.getElementById('priceDisplay');

function updatePrice() {
    const selectedPackage = packageSelect.options[packageSelect.selectedIndex];
    const weekendPrice = selectedPackage.getAttribute('data-weekend-price');
    const weekdayPrice = selectedPackage.getAttribute('data-weekday-price');

    const startDate = new Date(startDateInput.value);
    const day = startDate.getDay();
    const isWeekend = (day === 5 || day === 6 || day === 0); // Friday, Saturday, Sunday

    const price = isWeekend ? weekendPrice : weekdayPrice;
    priceDisplay.textContent = `Price: RM ${price}`;
}

packageSelect.addEventListener('change', updatePrice);
startDateInput.addEventListener('change', updatePrice);

// Handle Ajax form submission
const bookingForm = document.getElementById('bookingForm');
const responseMessage = document.getElementById('responseMessage');

bookingForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(bookingForm);

    fetch('ajax/booking_handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            responseMessage.innerHTML = `<p style='color: green;'>${data.message}</p>`;
        } else {
            responseMessage.innerHTML = `<p style='color: red;'>${data.message}</p>`;
        }
    })
    .catch(error => {
        responseMessage.innerHTML = `<p style='color: red;'>An error occurred. Please try again.</p>`;
    });
});
</script>
