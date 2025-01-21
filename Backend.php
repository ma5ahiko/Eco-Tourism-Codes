if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Check for missing fields
    if (empty($_POST['service_id']) || empty($_POST['booking_date'])) { 
        echo json_encode(["success" => false, "message" => "All fields are required."]); 
        exit(); 
    }

    // Booking logic goes here (e.g., database insertion)

    echo json_encode(["success" => true, "message" => "Booking successful!"]); 
}



///BOLE EDIT SINI HEHEHEHEHEH
