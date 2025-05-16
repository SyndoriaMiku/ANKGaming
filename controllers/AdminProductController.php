<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../config/Database.php';

class AdminProductController
{
    public function index()
    {
        global $conn;
        $product = Product::getAll($conn);
        include __DIR__ . '/../views/admin/products/index.php';
    }
    public function create()
    {
        global $conn;
        include __DIR__ . '/../views/admin/products/create.php';
    }

    public function store()
    {
        global $conn;
        if (isset($_POST['id']) && isset($_FILES['image'])) {
            $image = $_FILES['image']['name'];
            $target_dir = __DIR__ . '/../public/images/';
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $image);
            $_POST['image'] = $image;
            Product::create($conn, $_POST);
        }
        
        header('Location: /admin');
    }

    public function edit($id)
    {
        global $conn;
        $product = Product::getById( $id);
        include __DIR__ . '/../views/admin/products/edit.php';
    }

    public function update($id)
    {
        global $conn;
        if (isset($_POST['id'])) {
            if (!empty($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
                $target_dir = __DIR__ . '/../public/images/';
                move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $image);
                $_POST['image'] = $image;
            } else {
                $_POST['image'] = $_POST['old_image'];
            }
            Product::update($conn, $id, $_POST);
        }
        header('Location: /admin');
    }

    public function delete($id)
    {
        global $conn;
        Product::delete($conn, $id);
        header('Location: /admin');
    }
}