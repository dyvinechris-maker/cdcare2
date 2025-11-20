<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: sign-up.html");
    exit;
}

// Start session for storing user data
session_start();

// Sanitize form inputs
$fullName     = htmlspecialchars($_POST['fullName']);
$email        = htmlspecialchars($_POST['email']);
$phone        = htmlspecialchars($_POST['phone']);
$state        = htmlspecialchars($_POST['state']);
$password     = htmlspecialchars($_POST['password']); // Testing only
$referralCode = htmlspecialchars($_POST['referralCode']);

// Recipient — for MailHog testing
$to = 'test@example.com';
$subject = "New Signup from $fullName";

// Build the message
$message  = "Name: $fullName\n";
$message .= "Email: $email\n";
$message .= "Phone: $phone\n";
$message .= "State: $state\n";
$message .= "Referral Code: $referralCode\n";

// Build full email in RFC822 format
$emailText  = "From: test@example.com\r\n";
$emailText .= "To: $to\r\n";
$emailText .= "Subject: $subject\r\n";
$emailText .= "\r\n";
$emailText .= $message;

// Save to a temporary file
$tmpFile = tempnam(sys_get_temp_dir(), 'mail');
file_put_contents($tmpFile, $emailText);

// Send email using msmtp pointing to MailHog
$cmd = "/usr/bin/env msmtp -t < " . escapeshellarg($tmpFile);
exec($cmd, $output, $return_var);

// Delete temp file
unlink($tmpFile);

// ✅ Store user info in session
$_SESSION['fullName'] = $fullName;
$_SESSION['email'] = $email;
$_SESSION['phone'] = $phone;
$_SESSION['state'] = $state;
$_SESSION['referralCode'] = $referralCode;

// Optional: Save user in database (if needed)
// $stmt = $conn->prepare("INSERT INTO users (fullName, email, phone, state, password, referralCode) VALUES (?, ?, ?, ?, ?, ?)");
// $stmt->bind_param("ssssss", $fullName, $email, $phone, $state, $password, $referralCode);
// $stmt->execute();
// $stmt->close();
// $conn->close();

// ✅ Redirect based on email send result
/*if ($return_var === 0) {
    header("Location: productpage.php");
    exit;
} else {
    header("Location: productpage.php?mail=failed");
    exit;
}*/
?>
