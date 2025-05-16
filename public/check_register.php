<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = User::findByUsername($conn, $username);
    if ($user) {
        echo "Username already exists.";
        header('Location: /register.php');
        exit;
    }

    $newUserId = User::create($conn, $username, $password);
    

    //Login the user after registration

    $_SESSION['user_id'] = $newUserId;
    $_SESSION['username'] = $username;
    $_SESSION['is_admin'] = 0;
    header('Location: /');
    exit;
}