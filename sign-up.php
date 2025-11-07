<?php
// send-mail.php - External form handler

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and sanitize form data
    $fullName     = trim(htmlspecialchars($_POST['fullName'] ?? ''));
    $email        = trim(htmlspecialchars($_POST['email'] ?? ''));
    $phone        = trim(htmlspecialchars($_POST['phone'] ?? ''));
    $state        = $_POST['state'] ?? '';
    $referralCode = trim(htmlspecialchars($_POST['referralCode'] ?? ''));

    // Basic validation
    if (empty($fullName) || empty($email) || empty($phone) || $state === 'Select State') {
        $error = "Please fill all required fields correctly.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {

        // === CHANGE THIS EMAIL ===
        $to = "dyvinechris@gmail.com";  // ← CHANGE TO YOUR EMAIL

        $subject = "New CDcare Signup: $fullName";

        $message = "
        <html>
        <body style='font-family: Arial, sans-serif;'>
            <h2 style='color: #ff6600;'>New User Registration</h2>
            <p><strong>Name:</strong> $fullName</p>
            <p><strong>Email:</strong> <a href='mailto:$email'>$email</a></p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>State:</strong> $state</p>
            <p><strong>Referral Code:</strong> " . ($referralCode ?: 'None') . "</p>
            <hr>
            <small>Sent on: " . date('d M Y, h:i A') . "</small>
        </body>
        </html>
        ";

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "From: CDcare Signup <no-reply@cdcare.com>\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Send email
        if (mail($to, $subject, $message, $headers)) {
            $success = "Thank you! Your signup was successful. We'll contact you soon.";
        } else {
            $error = "Failed to send. Please try again or contact support.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f0e8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
        }
        .success { color: #155724; background: #d4edda; padding: 15px; border-radius: 8px; border: 1px solid #c3e6cb; }
        .error   { color: #721c24; background: #f8d7da; padding: 15px; border-radius: 8px; border: 1px solid #f5c6cb; }
        a { color: #ff6600; text-decoration: none; font-weight: bold; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="box">
        <?php if (isset($success)): ?>
            <div class="success">
                <h3>Success!</h3>
                <p><?= $success ?></p>
                <p><a href="signup.html">← Back to Signup</a></p>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="error">
                <h3>Oops!</h3>
                <p><?= $error ?></p>
                <p><a href="signup.html">← Try Again</a></p>
            </div>
        <?php else: ?>
            <p>Invalid request.</p>
            <p><a href="signup.html">← Go Back</a></p>
        <?php endif; ?>
    </div>
</body>
</html>