<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Order.php';

class UserController {

    public function index() {
        global $conn;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login.php');
            exit;
        }
        $userId = $_SESSION['user_id'];
        $user = User::getAllUsers($conn, $userId);
        include __DIR__ . '/../views/admin/users/index.php';

    }

    public function register() {
        global $conn;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            if (empty($username) || empty($password)) {
                echo "Vui lòng điền đầy đủ thông tin";
                exit;
            }

            if (User::findByUsername($conn, $username)) {
                echo "Tài khoản đã tồn tại";
                exit;
            }

            if (User::create($conn, $username, $password)) {
                echo "Đăng ký thành công";
            } else {
                echo "Đăng ký thất bại";
            }
        } else {
            include __DIR__ . '/../views/register.php';
        }
    }

    public function login() {
        global $conn;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (empty($username) || empty($password)) {
                echo "Vui lòng điền đầy đủ thông tin";
                exit;
            }

            $user = User::findByUsername($conn, $username);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_admin'] = $user['is_admin'];

                if ($user['is_admin'] == 1) {
                    $_SESSION['admin'] = true;
                    header('Location: /admin');
                } else {
                    header('Location: /');
                }
                exit;

            } else {
                echo "Tài khoản hoặc mật khẩu không đúng";
            }
        }
        include __DIR__ . '/../views/login.php';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }

    public function history() {
        global $conn;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['user_id'];
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login.php');
            exit;
        }
        $userId = $_SESSION['user_id'];
        $orders = Order::getOrderByUserId($conn, $userId);
        include __DIR__ . '/../views/history.php';
    }

    public function delete($id) {
        global $conn;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        User::delete($conn, $id);
        header('Location: /admin/index.php?controller=admin_user&action=index');
        exit;
        
    }
    
}
