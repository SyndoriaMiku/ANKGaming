<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ANK Gaming</title>
    <link rel="stylesheet" href="views/layout/style.css">
</head>
<body>
    <div class="header-logo">
        <a href="/"><img src="images/logo.png" alt="ANK Gaming"></a>
    </div>
    <div class="header-login">
        <?php if (isset($_SESSION['username'])): ?>
            <a href="index.php?controller=user&action=logout">Logout</a>
            <a href="index.php?controller=user&action=history">History</a>
        <?php else: ?>
            <a href="/login.php">Login</a>
            <a href="/register.php">Register</a>
        <?php endif; ?>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="/cart.php">Cart</a></li>
            <li><a href="/checkout.php">Checkout</a></li>
            <li><a href="/contact.php">Contact</a></li>
        </ul>
    </nav>

<style>

    .header-logo img {
        height: 48px;
        width: auto;
    }
</style>

