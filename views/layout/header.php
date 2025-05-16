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
    <div class="header-container">
        <div class="header-logo">
            <a href="/"><img src="images/logo.png" alt="ANK Gaming"></a>
        </div>
        <nav class="navbar">
            <ul>
                <li class="dropdown">
                    <a href="index.php?controller=product&action=filter&keyword=AMD"> AMD CPU</a>
                    <div class="dropdown-content">
                        <a href="index.php?controller=product&action=filter&keyword=ryzen%203">Ryzen 3</a>
                        <a href="index.php?controller=product&action=filter&keyword=ryzen%205">Ryzen 5</a>
                        <a href="index.php?controller=product&action=filter&keyword=ryzen%207">Ryzen 7</a>
                        <a href="index.php?controller=product&action=filter&keyword=ryzen%209">Ryzen 9</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="index.php?controller=product&action=filter&keyword=intel"> Intel CPU</a>
                    <div class="dropdown-content">
                        <a href="index.php?controller=product&action=filter&keyword=core%20i3">Core i3</a>
                        <a href="index.php?controller=product&action=filter&keyword=core%20i5">Core i5</a>
                        <a href="index.php?controller=product&action=filter&keyword=core%20i7">Core i7</a>
                        <a href="index.php?controller=product&action=filter&keyword=core%20i9">Core i9</a>
                        <a href="index.php?controller=product&action=filter&keyword=core%20ultra%203">Core Ultra 3</a>
                        <a href="index.php?controller=product&action=filter&keyword=core%20ultra%205">Core Ultra 5</a>
                        <a href="index.php?controller=product&action=filter&keyword=core%20ultra%207">Core Ultra 7</a>
                        <a href="index.php?controller=product&action=filter&keyword=core%20ultra%209">Core Ultra 9</a>
                    </div>
                </li>
                <li><a href="/cart.php">Cart</a></li>
                <li><a href="/checkout.php">Checkout</a></li>

            </ul>
        </nav>
        <div class="header-login">
            <?php if (isset($_SESSION['username'])): ?>
                <a href="index.php?controller=user&action=logout">Logout</a>
                <a href="index.php?controller=user&action=history">History</a>
            <?php else: ?>
                <a href="/login.php">Login</a>
                <a href="/register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>  

<style>
    .navbar, .header-login {
        font-family: 'Sego UI', sans-serif;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background-color: #e5e5e5;
    }

    .header-logo img {
        height: 72px;
        width: auto;
    }
    .header-login {
        display: flex;
        gap: 25px;
        align-items: center;
    }

    .header-login a {
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 20px;
        transition: all;
    }

    .header-login a[href*="login"],
    .header-login a[href*="register"] {
        color: #2c3e50;
        border: 1px solid #2c3e50;
    }
    
    .header-login a[href*="login"]:hover,
    .header-login a[href*="register"]:hover {
        background-color: #2c3e50;
        color: white;
    }

    .header-login a[href*="logout"],
    .header-login a[href*="history"] {
        color: #e74c3c;
        border: 1px solid #e74c3c;
    }
    
    .header-login a[href*="logout"]:hover,
    .header-login a[href*="history"]:hover {
        background-color: #e74c3c;
        color: white;
    }



     /* Reset CSS cho ul */
    .navbar ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        gap: 25px;
    }
    
    .navbar li {
        display: inline-block;
    }

    .navbar a {
        text-decoration: none;
        color: #ac3e50;
        font-size: 1rem;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: 4px;
        transition: all 0.3s ease;
        position: relative;
    }
    
    
    .navbar a:hover {
        color: #e74c3c;
        background-color: #f8f9fa;
    }

    .navbar a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 50%;
        width: 0;
        height: 2px;
        background-color: #e74c3c;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .navbar a:hover::after {
        width: 70%;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }
    .dropdown > a {
        padding-right: 25px !important;
        position: relative;
    }


    .dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        border-radius: 4px;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        border: 1px solid #e5e5e5;
    }

    .dropdown-content a {
    color: #333 !important;
    padding: 10px 15px !important;
    text-decoration: none !important;
    display: block;
    font-size: 0.9em !important;
    font-weight: normal !important;
    border-bottom: 1px solid #f5f5f5;
    transition: background-color 0.2s;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #f8f8f8;
    color: #e74c3c !important;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .dropdown > a::after {
        right: 5px;
    }
    
    .dropdown-content {
        min-width: 180px;
    }
}


</style>

