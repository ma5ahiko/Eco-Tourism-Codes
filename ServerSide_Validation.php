if (empty($_POST['service_id']) || empty($_POST['booking_date'])) { 
    echo json_encode(["success" => false, "message" => "All fields are required."]); 
    exit(); 
}
