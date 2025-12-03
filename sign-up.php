<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // adjust if you have a password
$dbname = "user_registration"; // make sure this database exists

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $state = $conn->real_escape_string($_POST['state']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password
    $referralCode = $conn->real_escape_string($_POST['referralCode']);

    // Optional: check if email already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        die("Email already registered. Please use another email.");
    }

    // Insert user into database
    $sql = "INSERT INTO users (fullName, email, phone, state, password, referralCode, created_at)
            VALUES ('$fullName', '$email', '$phone', '$state', '$password', '$referralCode', NOW())";

    if ($conn->query($sql) === TRUE) {
        // Save user in session
        $_SESSION['user'] = [
            'fullName' => $fullName,
            'email' => $email,
            'phone' => $phone,
            'state' => $state
        ];

        // Redirect to account page
        header("Location: dashboard.html");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
