session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Fetch user credentials
    $email = $_POST['email']; 
    $password = $_POST['password']; 

    // Query the database for user
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"); 
    $user = mysqli_fetch_assoc($result); 

    // Verify password and start session
    if ($user && password_verify($password, $user['password'])) { 
        $_SESSION['user_id'] = $user['user_id']; 
        header("Location: dashboard.php"); 
    } else { 
        $error = "Invalid email or password."; 
    } 
}


//BOLE UPDATE SINI TERUS HEHEHE :D
