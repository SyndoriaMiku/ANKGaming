<?php
require_once __DIR__ . '/../config/database.php';

class Product {
    public static function getAll() {
        global $conn;
        $result = $conn->query("SELECT * FROM products");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create($conn, $data, $imageFile = null) {
        $imagePath = null;
        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/images/'; // Đường dẫn tới thư mục public/images
            $fileName = uniqid() . '_' . basename($imageFile['name']);
            $targetPath = $uploadDir . $fileName;
        
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
        
            if (move_uploaded_file($imageFile['tmp_name'], $targetPath)) {
                $imagePath = 'images/' . $fileName;
            } else {
                throw new Exception("Không thể upload ảnh");
            }
        }

        $data['image'] = $imagePath;
        
        $stmt = $conn->prepare("INSERT INTO products (id, name, core, thread, base_clock, boost_clock, cache_l1, cache_l2, cache_l3, socket, tdp, price, stock, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiddssssidis",
            $data['id'],
            $data['name'],
            $data['core'],
            $data['thread'],
            $data['base_clock'],
            $data['boost_clock'],
            $data['cache_l1'],
            $data['cache_l2'],
            $data['cache_l3'],
            $data['socket'],
            $data['tdp'],
            $data['price'],
            $data['stock'],
            $data['image']
        );
        $stmt->execute();
    }

    public static function update($conn, $id, $data, $imageFile = null) {
        $imagePath = null;
        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/images/'; // Đường dẫn tới thư mục public/images
            $fileName = uniqid() . '_' . basename($imageFile['name']);
            $targetPath = $uploadDir . $fileName;
        
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
        
            if (move_uploaded_file($imageFile['tmp_name'], $targetPath)) {
                $imagePath = 'images/' . $fileName;
            } else {
                throw new Exception("Không thể upload ảnh");
            }
        }
        $data['image'] = $imagePath;
        
        $stmt = $conn->prepare("UPDATE products SET name = ?, core = ?, thread = ?, base_clock = ?, boost_clock = ?, cache_l1 = ?, cache_l2 = ?, cache_l3 = ?, socket = ?, tdp = ?, price = ?, stock = ?, image = ? WHERE id = ?");
        $stmt->bind_param("siiddssssidiss",
            $data['name'],
            $data['core'],
            $data['thread'],
            $data['base_clock'],
            $data['boost_clock'],
            $data['cache_l1'],
            $data['cache_l2'],
            $data['cache_l3'],
            $data['socket'],
            $data['tdp'],
            $data['price'],
            $data['stock'],
            $data['image'],
            $id
        );
        $stmt->execute();
    }

    public static function delete($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }

}