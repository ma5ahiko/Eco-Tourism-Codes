document.getElementById("bookingForm").addEventListener("submit", function(e) { 
    e.preventDefault(); 
    const formData = new FormData(this); 

    // Send booking data to server
    fetch('book_service.php', { 
        method: 'POST', 
        body: formData 
    }) 
    .then(response => response.json()) 
    .then(data => { 
        if (data.success) { 
            alert("Booking successful!"); 
        } else { 
            alert("Booking failed: " + data.message); 
        } 
    }); 
});
