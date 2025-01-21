<?php
// booking_handler.php - Handles Ajax booking submission
require '../config.php'; // Include database connection
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $user_id = $_SESSION['user_id']; // Assuming user is logged in
    $package_id = $_POST['package_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $num_adults = $_POST['num_adults'];

    // Insert booking into database
    $stmt = $conn->prepare("INSERT INTO Bookings (user_id, service_id, start_date, end_date, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param('iiss', $user_id, $package_id, $start_date, $end_date);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Booking successfully created! Our team will confirm it shortly.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create booking. Please try again later.']);
    }

    $stmt->close();
    exit;
}
?>
