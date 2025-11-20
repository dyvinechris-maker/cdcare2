<?php
declare(strict_types=1);

// --- ⚠️ This section simulates basic Session/Controller logic.
// --- In a real application, a dedicated controller would handle this before the view.

session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Better to use a full path or configuration for redirects
    header("Location: /login.php"); // Assuming a modern setup uses login.php instead of sign-up.html
    exit;
}

/**
 * @var array|object $user Contains the logged-in user data.
 * Assuming keys: 'full_name', 'email', 'phone', 'state'.
 */
$user = $_SESSION['user'];

// Helper function to safely get user data from the array (using null coalescing operator)
function getUserData(string $key, array $userData): string {
    // If the data is stored as an object, you'd use $userData->$key ?? 'N/A'
    $value = $userData[$key] ?? 'N/A';
    return htmlspecialchars((string)$value);
}

// Get the specific data points to display
$fullName = getUserData('fullName', $user); // Use snake_case for consistency
$email = getUserData('email', $user);
$phone = getUserData('phone', $user);
$state = getUserData('state', $user);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Account - User Profile</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
    --primary-color: #ff6600; /* Original brand color */
    --secondary-color: #333;
    --background-light: #f9f0e8;
    --background-white: #ffffff;
    --text-dark: #333;
    --text-light: #666;
    --border-color: #ddd;
}

/* Reset and Base Styling */
* {
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: var(--background-light);
    margin: 0;
    padding: 0 0 80px; /* Add padding for the fixed bottom-nav */
    color: var(--text-dark);
}

.container {
    max-width: 900px;
    margin: 20px auto;
    padding: 0 15px;
}

/* Header */
.main-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: var(--background-white);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.main-header h1 {
    margin: 0;
    font-size: 24px;
    color: var(--primary-color);
}

.logout-btn {
    text-decoration: none;
    color: var(--text-light);
    font-size: 14px;
    padding: 5px 10px;
    border: 1px solid var(--border-color);
    border-radius: 6px;
    transition: background-color 0.2s;
}

.logout-btn:hover {
    background-color: #f0f0f0;
}

/* Account Box Styling */
.account-box {
    background: var(--background-white);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.account-box h2 {
    text-align: center;
    color: var(--secondary-color);
    margin-bottom: 25px;
    border-bottom: 2px solid var(--primary-color);
    padding-bottom: 10px;
}

/* Info Grid - Modern layout */
.info-grid {
    display: grid;
    grid-template-columns: 1fr; /* Single column on mobile */
    gap: 15px;
    margin-bottom: 30px;
}

@media (min-width: 600px) {
    .info-grid {
        grid-template-columns: 1fr 1fr; /* Two columns on desktop */
    }
}

.info-item {
    background: var(--background-light);
    padding: 15px;
    border-left: 4px solid var(--primary-color);
    border-radius: 4px;
    margin: 0;
    font-size: 16px;
    display: flex;
    flex-direction: column;
}

.info-item strong {
    color: var(--primary-color);
    font-size: 14px;
    margin-bottom: 5px;
}

/* Action Buttons */
.account-actions {
    display: flex;
    justify-content: space-around;
    gap: 10px;
    margin-top: 30px;
}

.action-btn {
    flex: 1;
    padding: 10px 15px;
    text-align: center;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    transition: transform 0.1s, box-shadow 0.1s;
}

.action-btn i {
    margin-right: 8px;
}

.action-btn.primary {
    background-color: var(--primary-color);
    color: var(--background-white);
    border: none;
}

.action-btn.secondary {
    background-color: #f0f0f0;
    color: var(--secondary-color);
    border: 1px solid var(--border-color);
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Bottom Navigation */
.bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: var(--background-white);
    border-top: 1px solid var(--border-color);
    display: flex;
    justify-content: space-around;
    padding: 5px 0;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
    z-index: 100;
}

.nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    font-size: 12px;
    color: var(--text-light);
    text-decoration: none;
    flex: 1;
    padding: 8px 0;
    transition: color 0.2s;
}

.nav-item i {
    font-size: 20px; /* Icon size */
    margin-bottom: 4px;
}

.nav-item:hover {
    color: var(--secondary-color);
}

.nav-item.active {
    color: var(--primary-color);
    font-weight: bold;
}
    </style>
</head>

<body>

    <header class="main-header">
        <h1>👤 My Account</h1>
        <a href="/logout.php" class="logout-btn">Log Out</a>
    </header>

    <main class="container">
        <section class="account-box">
            <h2>User Profile</h2>

            <div class="info-grid">
                <p class="info-item">
                    <strong><i class="fas fa-user"></i> Full Name:</strong>
                    <span><?php echo $fullName; ?></span>
                </p>
                <p class="info-item">
                    <strong><i class="fas fa-envelope"></i> Email:</strong>
                    <span><?php echo $email; ?></span>
                </p>
                <p class="info-item">
                    <strong><i class="fas fa-phone-alt"></i> Phone:</strong>
                    <span><?php echo $phone; ?></span>
                </p>
                <p class="info-item">
                    <strong><i class="fas fa-map-marker-alt"></i> State:</strong>
                    <span><?php echo $state; ?></span>
                </p>
            </div>

            <div class="account-actions">
                <a href="edit_profile.php" class="action-btn primary"><i class="fas fa-edit"></i> Edit Profile</a>
                <a href="change_password.php" class="action-btn secondary"><i class="fas fa-lock"></i> Change Password</a>
            </div>
        </section>
    </main>

    <nav class="bottom-nav">
        <a href="dashboard.php" class="nav-item">
            <i class="fas fa-store"></i> Shop
        </a>
        <a href="cart.php" class="nav-item">
            <i class="fas fa-shopping-cart"></i> Cart
        </a>
        <a href="history.php" class="nav-item">
            <i class="fas fa-history"></i> History
        </a>
        <a href="wishlist.php" class="nav-item">
            <i class="fas fa-heart"></i> Wishlist
        </a>
        <a href="account.php" class="nav-item active">
            <i class="fas fa-user-circle"></i> Account
        </a>
    </nav>

    <script src="js/main.js"></script>

</body>
</html>