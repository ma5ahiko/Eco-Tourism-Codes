<?php
// Main index.php file for Martini Glamping Park booking and management website
// Includes routes to handle all modules for the Glamping Park packages

session_start();
require 'config.php'; // Database connection file

// Routes to handle each module
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'home':
            include 'modules/home.php';
            break;
        case 'booking':
            include 'modules/booking.php';
            break;
        case 'packages':
            include 'modules/packages.php';
            break;
        case 'feedback':
            include 'modules/feedback.php';
            break;
        case 'user':
            include 'modules/user.php';
            break;
        case 'admin':
            include 'modules/admin.php';
            break;
        case 'login':
            include 'modules/login.php';
            break;
        default:
            include 'modules/home.php';
    }
} else {
    include 'modules/home.php';
}
?>
