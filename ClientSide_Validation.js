function validateBookingForm() { 
    const date = document.getElementById('bookingDate').value; 
    if (new Date(date) < new Date()) { 
        alert("Booking date cannot be in the past."); 
        return false; 
    } 
    return true; 
}
