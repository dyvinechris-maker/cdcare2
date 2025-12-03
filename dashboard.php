<?php
include 'db_connect.php'; // Include your database connection
session_start();

// 1. Check for logged-in status using the user_id
if (empty($_SESSION['user_id'])) {
    // Redirect if the user ID is not set (not logged in)
    header("Location: sign-up.html");
    exit;
}

$user_id = $_SESSION['user_id'];

// 2. Retrieve user data from the database
// We use a prepared statement to securely fetch ALL necessary columns
$stmt = $conn->prepare("SELECT fullName, email, phone, state FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id); // 'i' for integer (user ID)
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // User ID in session is invalid, destroy session and redirect
    session_unset();
    session_destroy();
    header("Location: sign-up.html");
    exit;
}

// Fetch the user data into the $user variable
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($user['fullName']); ?> 👋</h2>

<p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
<p>Phone: <?php echo htmlspecialchars($user['phone']); ?></p>
<p>State: <?php echo htmlspecialchars($user['state']); ?></p>

<a href="logout.php">Logout</a>

</body>
</html>