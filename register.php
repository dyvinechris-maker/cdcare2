<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $password = $_POST['password'];
    $referralCode = $_POST['referralCode'];

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Store user info in session
    $_SESSION['user'] = [
        'fullName' => $fullName,
        'email' => $email,
        'phone' => $phone,
        'state' => $state
    ];

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (fullName, email, phone, state, password, referralCode) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullName, $email, $phone, $state, $hashedPassword, $referralCode);

    if ($stmt->execute()) {
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
