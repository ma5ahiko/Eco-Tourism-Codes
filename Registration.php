if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['name']); 
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

    // Insert user into database
    $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'Guest')"; 
    if (mysqli_query($conn, $query)) { 
        echo "Registration successful!"; 
    } else { 
        echo "Error: " . mysqli_error($conn); 
    } 
}
