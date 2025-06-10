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
        $products = Product::getAll($conn);
        include __DIR__ . '/../views/admin/products/index.php';
    }

    public function create()
    {
        include __DIR__ . '/../views/admin/products/create.php';
    }

    public function store()
    {
        global $conn;

        if (isset($_POST['id'])) {

            $_POST['image'] = $this->handleImageUpload($_FILES['image']);

            Product::create($conn, $_POST);

            $_SESSION['success_message'] = "Thêm sản phẩm thành công!";
            header('Location: /admin/index.php?controller=admin_product&action=index');
            exit;
        }
    }

    public function edit($id)
    {
        global $conn;
        $product = Product::getById($id);
        include __DIR__ . '/../views/admin/products/edit.php';
    }

    public function update($id)
    {
        global $conn;

        if (isset($_POST['id'])) {

            $_POST['image'] = !empty($_FILES['image']['name'])
                ? $this->handleImageUpload($_FILES['image'])
                : $_POST['old_image'];

            Product::update($conn, $id, $_POST);

            $_SESSION['success_message'] = "Cập nhật sản phẩm thành công!";
            header('Location: /admin/index.php?controller=admin_product&action=index');
            exit;
        }
    }

    public function delete($id)
    {
        global $conn;
        Product::delete($conn, $id);

        $_SESSION['success_message'] = "Xóa sản phẩm thành công!";
        header('Location: /admin/index.php?controller=admin_product&action=index');
        exit;
    }

    /**
     * Handle image upload and return image file name.
     */
    private function handleImageUpload($imageFile)
    {
        if (!empty($imageFile['name'])) {
            $imageName = $imageFile['name'];
            $target_dir = __DIR__ . '/../public/images/';
            move_uploaded_file($imageFile['tmp_name'], $target_dir . $imageName);
            return $imageName;
        }
        return null;
    }
}
