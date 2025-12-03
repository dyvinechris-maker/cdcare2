<?php
session_start();

// Redirect to sign-up page if user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: sign-up.html");
    exit();
}

// Get user data from session
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>My Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f0e8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            min-height: 50vh;
        }
        .container {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            width: 500px;
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            color: #ff6600;
            margin-bottom: 20px;
        }
        .info-item {
            margin-bottom: 15px;
        }
        .info-item strong {
            color: #ff6600;
            display: block;
            margin-bottom: 5px;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #ff6600;
            color: #fff;
            border-radius: 20px;
            text-decoration: none;
            text-align: center;
        }
        .logout-btn:hover {
            background: #e65c00;
        }
        .bottom-nav {
    position: fixed; bottom: 0; left: 0; right: 0; height: 60px;
    display: flex; background: #fff; border-top: 1px solid #ddd;
    justify-content: space-around; align-items: center; z-index: 100;
  }
  .nav-item { text-align: center; font-size: 12px; color: #333; text-decoration: none; }
  .nav-item i { display: block; font-size: 20px; margin-bottom: 2px; }
  .nav-item.active { color: orange; }
  #account-info { background: #fff; padding: 20px; border-radius: 10px; max-width: 400px; margin: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($user['fullName']); ?>!</h2>
        <div class="info-item">
            <strong>Email:</strong>
            <span><?php echo htmlspecialchars($user['email']); ?></span>
        </div>
        <div class="info-item">
            <strong>Phone:</strong>
            <span><?php echo htmlspecialchars($user['phone']); ?></span>
        </div>
        <div class="info-item">
            <strong>State:</strong>
            <span><?php echo htmlspecialchars($user['state']); ?></span>
        </div>

        <a href="logout.php" class="logout-btn">Log Out</a>
    </div>

    <div class="bottom-nav">
  <a href="dashboard.html" class="nav-item" data-section="shop"><i class="fas fa-store"></i> Shop</a>
  <a href="#cart" class="nav-item" data-section="cart"><i class="fas fa-shopping-cart"></i> Cart</a>
  <a href="#history" class="nav-item" data-section="history"><i class="fas fa-history"></i> History</a>
  <a href="#wishlist" class="nav-item" data-section="wishlist"><i class="fas fa-heart"></i> Wishlist</a>
  <a href="account.php" class="nav-item" data-section="account" id="account-tab"><i class="fas fa-user"></i> Account</a>
</div>

</body>
</html>
