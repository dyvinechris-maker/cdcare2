<?php
session_start();

// If the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect form data
    $fullName = $_POST['fullName'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $state    = $_POST['state'];
    $password = $_POST['password'];
    $referral = $_POST['referralCode'];

    // Store user in session (acting as a temporary database)
    $_SESSION['user'] = [
        'fullName' => $fullName,
        'email'    => $email,
        'phone'    => $phone,
        'state'    => $state
    ];

    // Redirect to dashboard
    header("Location: dashboard.html");
    exit;
} else {
    // If someone tries to access without submitting the form
    header("Location: sign-up.html");
    exit;
}
?>
