<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = User::findByUsername($conn, $username);
    if ($user && $password === $user['password']) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];

        if ($user['is_admin']) {
            header('Location: /admin');
        } else {
            header('Location: /');
        }
        exit;

    } else {
        echo "Invalid username or password.";
        header('Location: /login.php');
        exit;
    }
}
?>